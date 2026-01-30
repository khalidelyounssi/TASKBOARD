@extends('layouts.app')

@section('content')

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-red-600">Trash Bin 🗑️</h1>
            <p class="text-slate-500 mt-1">Manage your deleted tasks.</p>
        </div>
        <a href="{{ route('tasks.index') }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition">
            &larr; Back to Dashboard
        </a>
    </div>

    @if($tasks->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tasks as $task)
                <div class="bg-red-50 rounded-2xl p-6 border border-red-100 opacity-80 hover:opacity-100 transition">
                    
                    <h3 class="text-lg font-bold text-slate-800 mb-2 line-through decoration-red-500">{{ $task->title }}</h3>
                    <p class="text-slate-500 text-sm mb-4">{{ $task->description }}</p>

                    <div class="flex gap-3 mt-4 pt-4 border-t border-red-100">
                        
                        <form action="{{ route('tasks.restore', $task->id) }}" method="POST" class="w-1/2">
                            @csrf
                            @method('PUT') <button type="submit" class="w-full py-2 bg-white border border-slate-300 text-slate-700 font-bold rounded-lg hover:bg-slate-50 text-sm">
                                ♻️ Restore
                            </button>
                        </form>

                        <form action="{{ route('tasks.force-delete', $task->id) }}" method="POST" class="w-1/2" onsubmit="return confirm('Are you sure? This cannot be undone!');">
                            @csrf
                            @method('DELETE') <button type="submit" class="w-full py-2 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 text-sm">
                                🔥 Delete
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-20">
            <div class="bg-slate-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4 text-slate-400">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800">Trash is Empty</h3>
            <p class="text-slate-500">No deleted tasks found.</p>
        </div>
    @endif

@endsection