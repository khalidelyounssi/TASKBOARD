<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // --- READ (Index) ---
    public function index()
{
    $query = auth()->user()->tasks();

    if (request('search')) {
        $query->where(function($q) {
            $q->where('title', 'like', '%' . request('search') . '%')
              ->orWhere('description', 'like', '%' . request('search') . '%');
        });
    }

    if (request('priority') && request('priority') !== 'All') {
        $query->where('priority', request('priority'));
    }

    if (request('sort') == 'deadline_asc') {
        $query->orderBy('deadline', 'asc'); 
    } elseif (request('sort') == 'deadline_desc') {
        $query->orderBy('deadline', 'desc'); 
    } else {
        $query->latest(); 
    }

    $tasks = $query->paginate(9);

    $allTasks = auth()->user()->tasks()->get();

    $stats = [
        'total' => $allTasks->count(),
        'todo' => $allTasks->where('status', 'Todo')->count(),
        'done' => $allTasks->where('status', 'Done')->count(),
        'overdue' => $allTasks->where('deadline', '<', now())->where('status', '!=', 'Done')->count(),
    ];

    return view('tasks.index', compact('tasks', 'stats'));
}
    // --- CREATE (Formulaire) ---
    public function create()
    {
        return view('tasks.create');
    }

    // --- STORE (Enregistrer) ---
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|in:Low,Medium,High',
            'deadline' => 'nullable|date',
        ]);

        // Default status is 'Todo'
        $validated['status'] = 'Todo';

        auth()->user()->tasks()->create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    // --- EDIT (Formulaire de modification) ---
    public function edit(Task $task)
    {
        // Security: Ensure user owns the task
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
        return view('tasks.edit', compact('task'));
    }

    // --- UPDATE (Sauvegarder les modifications) ---
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Todo,In Progress,Done',
            'deadline' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    // --- SOFT DELETE (Mettre à la corbeille) ---
    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
        
        $task->delete(); // This performs a Soft Delete because of the Trait in Model

        return redirect()->route('tasks.index')->with('success', 'Task moved to trash.');
    }

    // --- TRASH LIST (Voir la corbeille) ---
    public function trash()
    {
        // Get only tasks that have been soft deleted
        $tasks = auth()->user()->tasks()->onlyTrashed()->get();
        return view('tasks.trash', compact('tasks'));
    }

    // --- RESTORE (Récupérer de la corbeille) ---
    public function restore($id)
    {
        // Find the task even if it's deleted
        $task = auth()->user()->tasks()->withTrashed()->findOrFail($id);
        
        $task->restore();

        return redirect()->route('tasks.trash')->with('success', 'Task restored successfully!');
    }

    // --- HARD DELETE (Supprimer définitivement) ---
    public function forceDelete($id)
    {
        $task = auth()->user()->tasks()->withTrashed()->findOrFail($id);
        
        $task->forceDelete(); // Bye bye forever

        return redirect()->route('tasks.trash')->with('success', 'Task deleted permanently.');
    }
    public function updateStatus(Request $request, Task $task)
{
    $task->update([
        'status' => $request->status
    ]);

    return back(); 
}
}