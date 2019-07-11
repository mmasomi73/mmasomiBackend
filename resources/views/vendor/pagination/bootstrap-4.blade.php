@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item @if($paginator->currentPage() == 1) disabled @endif"><a class="page-link" href="#">Previous</a></li>
            @if ($paginator->onFirstPage())
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            @else
            <li class="page-item"><a class="page-link" href="#">{{ $paginator->previousPageUrl() }}</a></li>
            @endif
            @foreach ($elements as $element)

                @if (is_string($element))
                    <li class="page-item"><a class="page-link" href="#">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item"><a class="page-link" href="#">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
            @endif
            <li class="page-item"><a class="page-link" href="#"></a></li>
        </ul>
    </nav>
@endif
