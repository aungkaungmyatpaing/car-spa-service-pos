@if ($paginator->hasPages())
    <nav class="flex flex-row items-center">
        <span class="mr-5 text-gray-600">
            Showing {{$paginator->firstItem()}} to {{$paginator->lastItem()}} of {{$paginator->total()}} results
        </span>
        <div class="pagination flex flex-row items-center gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())

            @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                <div class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full">
                    <i class="fa-solid fa-chevron-left text-sm"></i>
                </div>
            </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <div class="disabled  w-8 h-8 flex items-center justify-center bg-green-500" aria-disabled="true"><span>{{ $element }}</span></div>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <div class="active cursor-pointer w-8 h-8 flex items-center justify-center bg-blue-500 rounded-full text-white" aria-current="page"><span>{{ $page }}</span></div>
                        @else
                            <a href="{{ $url }}">
                                <div class=" w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full">
                                    {{ $page }}
                                </div>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())

                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <div class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full">
                        <i class="fa-solid fa-chevron-right text-sm"></i>
                    </div>
                </a>

            @else

            @endif
        </div>
    </nav>
@endif
