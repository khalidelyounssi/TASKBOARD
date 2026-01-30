@extends('layouts.app')

@section('content')

    <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Kanban Board</h1>
            <p class="text-slate-500 mt-2 text-lg">Welcome back, <span class="font-bold text-indigo-600">{{ auth()->user()->name }}</span>!</p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('tasks.list') }}" class="flex items-center gap-2 bg-white border border-slate-200 text-slate-600 font-bold py-3.5 px-6 rounded-2xl hover:bg-slate-50 transition shadow-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                <span>List & Search</span>
            </a>

            <a href="{{ route('tasks.create') }}" class="group flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-6 rounded-2xl shadow-lg shadow-indigo-500/30 transition-all transform hover:-translate-y-1">
                <svg class="w-6 h-6 transition-transform group-hover:rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                <span>New Task</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-gradient-to-br from-indigo-500 to-blue-600 rounded-3xl p-6 text-white shadow-xl shadow-indigo-500/20 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-10 -mt-10"></div>
            <p class="text-indigo-100 font-medium mb-1">Total Tasks</p>
            <h3 class="text-4xl font-extrabold">{{ $stats['total'] }}</h3>
        </div>
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-lg relative">
            <p class="text-slate-500 font-bold text-sm uppercase tracking-wider">To Do</p>
            <h3 class="text-3xl font-black text-slate-800 mt-2">{{ $stats['todo'] }}</h3>
            <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-orange-500 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['todo'] / $stats['total']) * 100 : 0 }}%"></div>
            </div>
        </div>
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-lg relative">
            <p class="text-slate-500 font-bold text-sm uppercase tracking-wider">Completed</p>
            <h3 class="text-3xl font-black text-slate-800 mt-2">{{ $stats['done'] }}</h3>
            <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['done'] / $stats['total']) * 100 : 0 }}%"></div>
            </div>
        </div>
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-lg relative">
            <p class="text-slate-500 font-bold text-sm uppercase tracking-wider">Overdue</p>
            <h3 class="text-3xl font-black text-red-600 mt-2">{{ $stats['overdue'] }}</h3>
            <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-red-500 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['overdue'] / $stats['total']) * 100 : 0 }}%"></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 align-start pb-20">

        <div class="bg-slate-100/50 p-5 rounded-[2rem] border border-slate-200/60 min-h-[500px]">
            <div class="flex items-center justify-between mb-6 px-2">
                <h3 class="font-black text-slate-700 text-lg">To Do</h3>
                <span class="bg-white text-slate-700 px-3 py-1 rounded-xl text-xs font-extrabold shadow-sm border border-slate-100">{{ $tasks->where('status', 'Todo')->count() }}</span>
            </div>
            <div id="todo-list" data-status="Todo" class="drag-area space-y-4 min-h-[100px]">
                @foreach($tasks->where('status', 'Todo') as $task)
                    <div data-id="{{ $task->id }}" class="cursor-move">
                        @include('tasks.partials.task-card', ['task' => $task])
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-blue-50/50 p-5 rounded-[2rem] border border-blue-100/60 min-h-[500px]">
            <div class="flex items-center justify-between mb-6 px-2">
                <h3 class="font-black text-blue-700 text-lg">In Progress</h3>
                <span class="bg-white text-blue-700 px-3 py-1 rounded-xl text-xs font-extrabold shadow-sm border border-blue-100">{{ $tasks->where('status', 'In Progress')->count() }}</span>
            </div>
            <div id="progress-list" data-status="In Progress" class="drag-area space-y-4 min-h-[100px]">
                @foreach($tasks->where('status', 'In Progress') as $task)
                    <div data-id="{{ $task->id }}" class="cursor-move">
                        @include('tasks.partials.task-card', ['task' => $task])
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-green-50/50 p-5 rounded-[2rem] border border-green-100/60 min-h-[500px]">
            <div class="flex items-center justify-between mb-6 px-2">
                <h3 class="font-black text-green-700 text-lg">Done</h3>
                <span class="bg-white text-green-700 px-3 py-1 rounded-xl text-xs font-extrabold shadow-sm border border-green-100">{{ $tasks->where('status', 'Done')->count() }}</span>
            </div>
            <div id="done-list" data-status="Done" class="drag-area space-y-4 min-h-[100px]">
                @foreach($tasks->where('status', 'Done') as $task)
                    <div data-id="{{ $task->id }}" class="cursor-move">
                        @include('tasks.partials.task-card', ['task' => $task])
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dragAreas = document.querySelectorAll('.drag-area');

            dragAreas.forEach(area => {
                new Sortable(area, {
                    group: 'kanban',
                    animation: 150,
                    ghostClass: 'bg-indigo-50',
                    onEnd: function (evt) {
                        const itemEl = evt.item;
                        const newStatus = evt.to.getAttribute('data-status');
                        const taskId = itemEl.getAttribute('data-id');

                        if (evt.from === evt.to) return; 

                        // AJAX 
                        fetch(`/tasks/${taskId}/status`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ status: newStatus })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                itemEl.innerHTML = data.html;
                            }
                        })
                        .catch((error) => {
                            alert('Connection Error!');
                        });
                    }
                });
            });
        });
    </script>

@endsection