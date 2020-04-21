@if ($paginator->hasPages())
    <ul>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><button class="no-round-btn smooth"><i class="fas fa-caret-left"></i></button></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><button class="no-round-btn smooth"><i class="fas fa-caret-left"></i></button></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><button class="no-round-btn smooth">{{ $element }}</button></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><button class="no-round-btn smooth active">{{ $page }}</button></li>
                    @else
                        <li><a href="{{ $url }}"><button class="no-round-btn smooth">{{ $page }}</button></a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><button class="no-round-btn smooth"><i class="fas fa-caret-right"></i></button></a></li>
        @else
            <li class="disabled"><button class="no-round-btn smooth"><i class="fas fa-caret-right"></i></button></li>
        @endif
    </ul>
@endif
