@extends('layouts.app')

@section('content')

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Tasks List</h1>
            <p class="text-slate-500 mt-1">Search, filter and manage your tasks efficiently.</p>
        </div>
        <a href="{{ route('tasks.index') }}" class="group flex items-center gap-2 text-indigo-600 font-bold hover:text-indigo-700 transition">
            <span class="transform group-hover:-translate-x-1 transition-transform">←</span>
            <span>Back to Board</span>
        </a>
    </div>

    <form method="GET" action="{{ route('tasks.list') }}" class="bg-white p-5 rounded-[2rem] shadow-lg shadow-slate-200/50 border border-slate-100 mb-8">
        <div class="flex flex-col md:flex-row gap-4">
            
            <div class="relative flex-1">
                <svg class="absolute left-4 top-3.5 w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Search by title or description..." 
                       class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition bg-slate-50 focus:bg-white">
            </div>

            <select name="status" onchange="this.form.submit()" class="px-5 py-3 rounded-2xl border border-slate-200 bg-white font-bold text-slate-600 outline-none hover:border-indigo-300 transition cursor-pointer">
                <option value="All">📌 All Status</option>
                <option value="Todo" {{ request('status') == 'Todo' ? 'selected' : '' }}>Todo</option>
                <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Done" {{ request('status') == 'Done' ? 'selected' : '' }}>Done</option>
            </select>

            <select name="priority" onchange="this.form.submit()" class="px-5 py-3 rounded-2xl border border-slate-200 bg-white font-bold text-slate-600 outline-none hover:border-indigo-300 transition cursor-pointer">
                <option value="All">⚡ All Priorities</option>
                <option value="Low" {{ request('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ request('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ request('priority') == 'High' ? 'selected' : '' }}>High</option>
            </select>

            @if(request()->has('search') || (request('status') && request('status') !== 'All') || (request('priority') && request('priority') !== 'All'))
                <a href="{{ route('tasks.list') }}" class="px-6 py-3 bg-slate-100 text-slate-600 font-bold rounded-2xl hover:bg-slate-200 transition flex items-center justify-center">
                    Reset
                </a>
            @endif
        </div>
    </form>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/80 border-b border-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                    <th class="p-6 font-bold pl-8">Title</th>
                    <th class="p-6 font-bold">Status</th>
                    <th class="p-6 font-bold">Priority</th>
                    <th class="p-6 font-bold">Due Date</th>
                    <th class="p-6 font-bold text-right pr-8">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($tasks as $task)
                <tr class="hover:bg-slate-50/80 transition duration-150 group">
                    <td class="p-6 pl-8">
                        <div class="font-bold text-slate-800 text-lg">{{ $task->title }}</div>
                        <div class="text-sm text-slate-400 line-clamp-1 mt-1">{{ Str::limit($task->description, 60) }}</div>
                    </td>
                    <td class="p-6">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold border
                            {{ $task->status == 'Done' ? 'bg-green-50 text-green-700 border-green-100' : 
                              ($task->status == 'In Progress' ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-slate-100 text-slate-600 border-slate-200') }}">
                            <span class="w-2 h-2 rounded-full {{ $task->status == 'Done' ? 'bg-green-500' : ($task->status == 'In Progress' ? 'bg-blue-500' : 'bg-slate-400') }}"></span>
                            {{ $task->status }}
                        </span>
                    </td>
                    <td class="p-6">
                        <span class="font-bold text-sm flex items-center gap-1
                            {{ $task->priority == 'High' ? 'text-red-500' : 
                              ($task->priority == 'Medium' ? 'text-orange-500' : 'text-emerald-500') }}">
                            {{ $task->priority }}
                        </span>
                    </td>
                    <td class="p-6 text-sm font-medium text-slate-500">
                        @if($task->deadline)
                            <div class="flex items-center gap-2 {{ $task->deadline < now() && $task->status != 'Done' ? 'text-red-500' : '' }}">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                {{ $task->deadline->format('M d, Y') }}
                            </div>
                        @else
                            <span class="text-slate-300">-</span>
                        @endif
                    </td>
                    <td class="p-6 pr-8 text-right">
                        <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            </a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                @csrf @method('DELETE')
                                <button class="p-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($tasks->count() == 0)
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <div class="bg-slate-50 p-6 rounded-full mb-4">
                    <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="text-slate-800 font-bold text-lg">No tasks found</h3>
                <p class="text-slate-500 mt-1 max-w-sm">Try adjusting your filters or search query to find what you're looking for.</p>
                <a href="{{ route('tasks.list') }}" class="mt-6 text-indigo-600 font-bold hover:underline">Clear Filters</a>
            </div>
        @endif
    </div>

    <div class="mt-8 mb-12 flex justify-center">
{{ $tasks->appends(request()->query())->links('pagination.custom') }}    </div>

@endsection