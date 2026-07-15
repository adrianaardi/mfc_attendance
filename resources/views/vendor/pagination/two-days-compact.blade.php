@if ($paginator->hasPages())
    <div class="two-days-pagination" role="navigation" aria-label="Pagination Navigation">
        <div class="two-days-pagination-summary">
            Showing {{ $paginator->firstItem() ?? 0 }} to {{ $paginator->lastItem() ?? 0 }} of {{ $paginator->total() }}
        </div>

        <div class="two-days-pagination-links">
            @if ($paginator->onFirstPage())
                <span class="page-btn disabled" aria-disabled="true">Prev</span>
            @else
                <a class="page-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev">Prev</a>
            @endif

            @php
                $start = max(1, $paginator->currentPage() - 2);
                $end = min($paginator->lastPage(), $paginator->currentPage() + 2);
            @endphp

            @if($start > 1)
                <a class="page-number" href="{{ $paginator->url(1) }}">1</a>
                @if($start > 2)
                    <span class="page-ellipsis">...</span>
                @endif
            @endif

            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $paginator->currentPage())
                    <span class="page-number active" aria-current="page">{{ $page }}</span>
                @else
                    <a class="page-number" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                @endif
            @endfor

            @if($end < $paginator->lastPage())
                @if($end < $paginator->lastPage() - 1)
                    <span class="page-ellipsis">...</span>
                @endif
                <a class="page-number" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
            @endif

            @if ($paginator->hasMorePages())
                <a class="page-btn" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
            @else
                <span class="page-btn disabled" aria-disabled="true">Next</span>
            @endif
        </div>
    </div>
@endif