@extends('layouts.app')

@section('content')

    <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-xl border border-slate-100">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-slate-900">Edit Task</h2>
            <p class="text-slate-500 mt-2">Update your task details.</p>
        </div>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $task->title) }}"
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Priority</label>
                    <select name="priority" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                        <option value="Low" {{ $task->priority == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ $task->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ $task->priority == 'High' ? 'selected' : '' }}>High</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Status</label>
                    <select name="status" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                        <option value="Todo" {{ $task->status == 'Todo' ? 'selected' : '' }}>Todo</option>
                        <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Due Date</label>
                <input type="date" name="deadline" 
       value="{{ old('deadline', $task->deadline ? $task->deadline->format('Y-m-d') : '') }}"
       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none">
     </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Description</label>
                <textarea name="description" rows="3" 
                          class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none resize-none">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <a href="{{ route('tasks.index') }}" class="w-1/3 py-3 text-center text-slate-700 font-bold bg-slate-100 rounded-xl hover:bg-slate-200 transition">
                    Cancel
                </a>
                <button type="submit" class="w-2/3 py-3 text-white font-bold bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 transition">
                    Update Task
                </button>
            </div>

        </form>
    </div>

@endsection