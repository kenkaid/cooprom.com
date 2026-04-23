@if ($paginator->hasPages())
    <ul class="clearfix">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="prev disabled"><a><span class="fa fa-angle-left"></span></a></li>
        @else
            <li class="prev"><a href="{{ $paginator->previousPageUrl() }}"><span class="fa fa-angle-left"></span></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><a>{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a>{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="next"><a href="{{ $paginator->nextPageUrl() }}"><span class="fa fa-angle-right"></span></a></li>
        @else
            <li class="next disabled"><a><span class="fa fa-angle-right"></span></a></li>
        @endif
    </ul>
@endif
