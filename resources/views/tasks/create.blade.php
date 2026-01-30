@extends('layouts.app')

@section('content')

    <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-xl border border-slate-100">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-slate-900">New Task</h2>
            <p class="text-slate-500 mt-2">What's on your mind?</p>
        </div>

        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                       placeholder="e.g. Learn Blade Layouts">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Priority</label>
                    <select name="priority" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                        <option value="Low">Low</option>
                        <option value="Medium" selected>Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Due Date</label>
                    <input type="date" name="deadline" value="{{ old('deadline') }}"
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Description</label>
                <textarea name="description" rows="3" 
                          class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none resize-none"
                          placeholder="Details...">{{ old('description') }}</textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <a href="{{ route('tasks.index') }}" class="w-1/3 py-3 text-center text-slate-700 font-bold bg-slate-100 rounded-xl hover:bg-slate-200 transition">
                    Cancel
                </a>
                <button type="submit" class="w-2/3 py-3 text-white font-bold bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 transition">
                    Save Task
                </button>
            </div>

        </form>
    </div>

@endsection