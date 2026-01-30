<div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition group relative flex flex-col h-full">
    
    <div class="flex justify-between items-start mb-3">
        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider
            {{ $task->priority == 'High' ? 'bg-red-50 text-red-600' : 
              ($task->priority == 'Medium' ? 'bg-orange-50 text-orange-600' : 'bg-emerald-50 text-emerald-600') }}">
            {{ $task->priority }}
        </span>
        
        <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
            <a href="{{ route('tasks.edit', $task->id) }}" class="p-1 text-slate-400 hover:text-indigo-600" title="Edit">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
            </a>
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-1 text-slate-400 hover:text-red-600" title="Delete">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </button>
            </form>
        </div>
    </div>

    <div class="mb-4 flex-grow">
        <h4 class="font-bold text-slate-800 text-sm mb-1">{{ $task->title }}</h4>
        <p class="text-xs text-slate-500 line-clamp-2">{{ $task->description }}</p>
    </div>

    <div class="pt-3 border-t border-slate-50 flex items-center justify-between">
        
        @if($task->deadline)
            <div class="flex items-center gap-1 text-[10px] font-semibold {{ $task->deadline->isPast() && $task->status != 'Done' ? 'text-red-500' : 'text-slate-400' }}" title="{{ $task->deadline->format('Y-m-d') }}">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                <span>{{ $task->deadline->format('M d') }}</span>
            </div>
        @else
            <span class="text-[10px] text-slate-300">No Date</span>
        @endif

        <div>
            @if($task->status == 'Todo')
                <form action="{{ route('tasks.status', $task->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="In Progress">
                    <button type="submit" class="flex items-center gap-1 text-[10px] font-bold bg-blue-50 text-blue-600 px-2 py-1 rounded hover:bg-blue-100 transition">
                        Start 🚀
                    </button>
                </form>
            @elseif($task->status == 'In Progress')
                <form action="{{ route('tasks.status', $task->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="Done">
                    <button type="submit" class="flex items-center gap-1 text-[10px] font-bold bg-green-50 text-green-600 px-2 py-1 rounded hover:bg-green-100 transition">
                        Done ✅
                    
                </form>
            @else
                <form action="{{ route('tasks.status', $task->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="Todo">
                    <button type="submit" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 transition" title="Re-open Task">
                        ↺ Re-open
                    </button>
                </form>
            @endif
        </div>

    </div>
</div>