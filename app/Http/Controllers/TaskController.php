<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // Fetch user tasks ordered by latest
        $tasks = auth()->user()->tasks()->latest()->get();
        
        // Calculate basic stats for the dashboard
        $stats = [
            'total' => $tasks->count(),
            'todo' => $tasks->where('status', 'Todo')->count(),
            'done' => $tasks->where('status', 'Done')->count(),
        ];

        return view('tasks.index', compact('tasks', 'stats'));
    }

    // We will add other methods (create, store...) later
}