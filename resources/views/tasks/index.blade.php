@extends('layouts.app')

@section('content')

    <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Dashboard</h1>
            <p class="text-slate-500 mt-2 text-lg">Welcome back, <span class="font-bold text-indigo-600">{{ auth()->user()->name }}</span>! 👋</p>
        </div>
        <a href="{{ route('tasks.create') }}" class="group flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-6 rounded-2xl shadow-lg shadow-indigo-500/30 transition-all transform hover:-translate-y-1">
            <svg class="w-6 h-6 transition-transform group-hover:rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            <span>New Task</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        
        <div class="bg-gradient-to-br from-indigo-500 to-blue-600 rounded-3xl p-6 text-white shadow-xl shadow-indigo-500/20 relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
            <p class="text-indigo-100 font-medium mb-1">Total Tasks</p>
            <h3 class="text-4xl font-extrabold">{{ $stats['total'] }}</h3>
            <div class="mt-4 flex items-center text-sm text-indigo-100 bg-white/20 w-fit px-3 py-1 rounded-full">
                <span>📊 All time</span>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-lg relative group hover:border-orange-200 transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 font-bold text-sm uppercase tracking-wider">To Do</p>
                    <h3 class="text-3xl font-black text-slate-800 mt-2">{{ $stats['todo'] }}</h3>
                </div>
                <div class="p-3 bg-orange-100 text-orange-600 rounded-2xl group-hover:bg-orange-500 group-hover:text-white transition">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-orange-500 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['todo'] / $stats['total']) * 100 : 0 }}%"></div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-lg relative group hover:border-emerald-200 transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 font-bold text-sm uppercase tracking-wider">Completed</p>
                    <h3 class="text-3xl font-black text-slate-800 mt-2">{{ $stats['done'] }}</h3>
                </div>
                <div class="p-3 bg-emerald-100 text-emerald-600 rounded-2xl group-hover:bg-emerald-500 group-hover:text-white transition">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['done'] / $stats['total']) * 100 : 0 }}%"></div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-lg relative group hover:border-red-200 transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 font-bold text-sm uppercase tracking-wider">Overdue</p>
                    <h3 class="text-3xl font-black text-red-600 mt-2">{{ $stats['overdue'] }}</h3>
                </div>
                <div class="p-3 bg-red-100 text-red-600 rounded-2xl group-hover:bg-red-500 group-hover:text-white transition">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-red-500 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['overdue'] / $stats['total']) * 100 : 0 }}%"></div>
            </div>
        </div>

    </div>

    <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-col md:flex-row gap-4 mb-8">
        
        <div class="relative flex-1">
            <svg class="absolute left-4 top-3.5 w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Search tasks..." 
                   class="w-full pl-12 pr-4 py-3 rounded-2xl border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 bg-white shadow-sm transition placeholder-slate-400">
        </div>

        <div class="flex gap-2">
            <select name="priority" onchange="this.form.submit()" class="px-5 py-3 bg-white text-slate-600 font-bold rounded-2xl ring-1 ring-slate-200 shadow-sm hover:bg-slate-50 transition outline-none cursor-pointer">
                <option value="All">⚡ All Priorities</option>
                <option value="Low" {{ request('priority') == 'Low' ? 'selected' : '' }}>🟢 Low</option>
                <option value="Medium" {{ request('priority') == 'Medium' ? 'selected' : '' }}>🟠 Medium</option>
                <option value="High" {{ request('priority') == 'High' ? 'selected' : '' }}>🔴 High</option>
            </select>

            <select name="sort" onchange="this.form.submit()" class="px-5 py-3 bg-white text-slate-600 font-bold rounded-2xl ring-1 ring-slate-200 shadow-sm hover:bg-slate-50 transition outline-none cursor-pointer">
                <option value="latest">🕒 Newest</option>
                <option value="deadline_asc" {{ request('sort') == 'deadline_asc' ? 'selected' : '' }}>⬆️ Date (Close)</option>
                <option value="deadline_desc" {{ request('sort') == 'deadline_desc' ? 'selected' : '' }}>⬇️ Date (Far)</option>
            </select>
            
            @if(request('search') || (request('priority') && request('priority') !== 'All') || (request('sort') && request('sort') !== 'latest'))
                <a href="{{ route('tasks.index') }}" class="px-5 py-3 bg-slate-200 text-slate-600 font-bold rounded-2xl hover:bg-slate-300 transition flex items-center">
                    ✕
                </a>
            @endif
        </div>
        
    </form>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 align-start">

        <div class="bg-slate-100/50 p-5 rounded-[2rem] border border-slate-200/60 min-h-[500px]">
            <div class="flex items-center justify-between mb-6 px-2">
                <h3 class="font-black text-slate-700 text-lg">To Do</h3>
                <span class="bg-white text-slate-700 px-3 py-1 rounded-xl text-xs font-extrabold shadow-sm border border-slate-100">{{ $tasks->where('status', 'Todo')->count() }}</span>
            </div>
            
            <div class="space-y-4">
                @foreach($tasks->where('status', 'Todo') as $task)
                    @include('tasks.partials.task-card', ['task' => $task])
                @endforeach
                
                @if($tasks->where('status', 'Todo')->count() == 0)
                     <div class="text-center py-10 text-slate-400 text-sm border-2 border-dashed border-slate-200 rounded-2xl">No tasks here</div>
                @endif
            </div>
        </div>

        <div class="bg-blue-50/50 p-5 rounded-[2rem] border border-blue-100/60 min-h-[500px]">
            <div class="flex items-center justify-between mb-6 px-2">
                <h3 class="font-black text-blue-700 text-lg">In Progress</h3>
                <span class="bg-white text-blue-700 px-3 py-1 rounded-xl text-xs font-extrabold shadow-sm border border-blue-100">{{ $tasks->where('status', 'In Progress')->count() }}</span>
            </div>

            <div class="space-y-4">
                @foreach($tasks->where('status', 'In Progress') as $task)
                    @include('tasks.partials.task-card', ['task' => $task])
                @endforeach
                
                @if($tasks->where('status', 'In Progress')->count() == 0)
                     <div class="text-center py-10 text-blue-300 text-sm border-2 border-dashed border-blue-200 rounded-2xl">Nothing in progress</div>
                @endif
            </div>
        </div>

        <div class="bg-green-50/50 p-5 rounded-[2rem] border border-green-100/60 min-h-[500px]">
            <div class="flex items-center justify-between mb-6 px-2">
                <h3 class="font-black text-green-700 text-lg">Done</h3>
                <span class="bg-white text-green-700 px-3 py-1 rounded-xl text-xs font-extrabold shadow-sm border border-green-100">{{ $tasks->where('status', 'Done')->count() }}</span>
            </div>

            <div class="space-y-4">
                @foreach($tasks->where('status', 'Done') as $task)
                    @include('tasks.partials.task-card', ['task' => $task])
                @endforeach
                
                @if($tasks->where('status', 'Done')->count() == 0)
                     <div class="text-center py-10 text-green-300 text-sm border-2 border-dashed border-green-200 rounded-2xl">No completed tasks</div>
                @endif
            </div>
        </div>

    </div>

    <div class="mt-12 mb-8 ">
        {{ $tasks->appends(request()->query())->links() }}
    </div>

@endsection