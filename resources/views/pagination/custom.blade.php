@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center mt-8">
        <div class="flex items-center gap-2 bg-white p-2 rounded-2xl shadow-sm border border-slate-100">

            {{-- Previous Button --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-slate-300 bg-slate-50 rounded-xl cursor-not-allowed flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    <span>Prev</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-4 py-2 text-slate-600 bg-white hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition flex items-center gap-2 font-bold">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    <span>Prev</span>
                </a>
            @endif

            {{-- Page Numbers --}}
            <div class="hidden md:flex gap-1">
                @foreach ($elements as $element)
                    
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="px-3 py-2 text-slate-400 font-bold">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="w-10 h-10 flex items-center justify-center bg-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-indigo-500/30">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl font-bold transition">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-4 py-2 text-slate-600 bg-white hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition flex items-center gap-2 font-bold">
                    <span>Next</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>
            @else
                <span class="px-4 py-2 text-slate-300 bg-slate-50 rounded-xl cursor-not-allowed flex items-center gap-2">
                    <span>Next</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </span>
            @endif

        </div>
    </nav>
@endif