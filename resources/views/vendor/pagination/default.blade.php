@if ($paginator->hasPages())
    <ul class="pagination pagination-lg">
        @if ($paginator->onFirstPage())
            <li class="disabled"><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-long-arrow-left"></i></a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-long-arrow-left"></i></a></li>
        @endif

        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a href="javascript:void(0)">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-long-arrow-right"></i></a></li>
        @else
            <li class="disabled"><a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-long-arrow-right"></i></a></li>
        @endif
    </ul>
@endif
