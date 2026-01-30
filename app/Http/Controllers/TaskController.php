<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();

        $stats = [
            'total' => $tasks->count(),
            'todo' => $tasks->where('status', 'Todo')->count(),
            'done' => $tasks->where('status', 'Done')->count(),
            'overdue' => $tasks->where('deadline', '<', now())->where('status', '!=', 'Done')->count(),
        ];

        return view('tasks.index', compact('tasks', 'stats'));
    }

    public function list()
    {
        $query = auth()->user()->tasks();

        if (request('search')) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . request('search') . '%')
                  ->orWhere('description', 'like', '%' . request('search') . '%');
            });
        }

        if (request('status') && request('status') !== 'All') {
            $query->where('status', request('status'));
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

        $tasks = $query->paginate(10);

        return view('tasks.list', compact('tasks'));
    }

    public function updateStatus(Request $request, Task $task)
    {
        $task->update(['status' => $request->status]);

        if ($request->isJson()) {
            $newHtml = view('tasks.partials.task-card', compact('task'))->render();

            return response()->json([
                'success' => true,
                'html' => $newHtml 
            ]);
        }

        return back();
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|in:Low,Medium,High',
            'deadline' => 'nullable|date',
            'status' => 'required|in:Todo,In Progress,Done',
        ]);

        auth()->user()->tasks()->create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'priority' => 'required|in:Low,Medium,High',
            'deadline' => 'nullable|date',
            'status' => 'required|in:Todo,In Progress,Done',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated!');
    }

    public function destroy(Task $task)
    {
        $task->delete(); 
        return back()->with('success', 'Task moved to trash!');
    }

    public function trash()
    {
        $tasks = auth()->user()->tasks()->onlyTrashed()->get();
        return view('tasks.trash', compact('tasks'));
    }

    public function restore($id)
    {
        $task = auth()->user()->tasks()->onlyTrashed()->findOrFail($id);
        $task->restore();
        return back()->with('success', 'Task restored!');
    }

    public function forceDelete($id)
    {
        $task = auth()->user()->tasks()->onlyTrashed()->findOrFail($id);
        $task->forceDelete();
        return back()->with('success', 'Task deleted permanently!');
    }
}