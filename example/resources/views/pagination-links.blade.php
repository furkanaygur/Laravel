@section('head')
<style>
    .aa-blog-archive-pagination {
        display: inline;
        float: left;
        text-align: center;
        width: 100%;
    }
    .aa-blog-archive-pagination .pagination {
        border: 1px solid #ccc;
        border-radius: 0;
    }
    
    .aa-blog-archive-pagination
    .pagination
    li:first-child
    a,
    .aa-blog-archive-pagination
    .pagination
    li:first-child
    span {
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
    }
    
    .aa-blog-archive-pagination
    .pagination
    li:last-child
    a,
    .aa-blog-archive-pagination
    .pagination
    li:last-child
    span {
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
    }
    
    .aa-blog-archive-pagination
    .pagination
    li
    a,
    .aa-blog-archive-pagination
    .pagination
    li
    span {
        border: none;
        color: #888;
        margin-left: 0px;
    }
    
    .aa-blog-archive-pagination
    .pagination
    li
    a:hover,
    .aa-blog-archive-pagination
    .pagination
    li
    span:hover {
        background-color: #fff;
        color: #37c6f5;
    }
    
    .aa-blog-archive-pagination
    .pagination
    li
    span{
        background-color: #37c6f5;
        color:#fff;
    }
    
    .aa-blog-archive-pagination
    .pagination
    .active
    a {
        color: #fff;
    }
    
    </style>
@endsection

<div class="aa-blog-archive-pagination">
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @endif
        </ul>
    </nav>
@endif
</div>