@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="admin-pagination-nav">
        <div class="admin-pagination-info">
            Showing <span class="fw-bold">{{ $paginator->firstItem() }}</span> to <span class="fw-bold">{{ $paginator->lastItem() }}</span> of <span class="fw-bold">{{ $paginator->total() }}</span> results
        </div>

        <ul class="admin-pagination-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="admin-page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="admin-page-link" aria-hidden="true">&lsaquo; Prev</span>
                </li>
            @else
                <li class="admin-page-item">
                    <a class="admin-page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo; Prev</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="admin-page-item disabled" aria-disabled="true"><span class="admin-page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="admin-page-item active" aria-current="page"><span class="admin-page-link">{{ $page }}</span></li>
                        @else
                            <li class="admin-page-item"><a class="admin-page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="admin-page-item">
                    <a class="admin-page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next &rsaquo;</a>
                </li>
            @else
                <li class="admin-page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="admin-page-link" aria-hidden="true">Next &rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
