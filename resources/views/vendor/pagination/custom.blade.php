@if ($paginator->hasPages())
    <div class="kt-section">
        <div class="kt-section__content">
            <!--begin: Pagination-->
            <div class="kt-pagination kt-pagination--brand">
                <ul class="kt-pagination__links">
                    {{-- First Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="kt-pagination__link--first disabled">
                            <span><i class="fa fa-angle-double-left kt-font-brand"></i></span>
                        </li>
                    @else
                        <li class="kt-pagination__link--first">
                            <a href="{{ $paginator->url(1) }}"><i class="fa fa-angle-double-left kt-font-brand"></i></a>
                        </li>
                    @endif

                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="kt-pagination__link--next disabled">
                            <span><i class="fa fa-angle-left kt-font-brand"></i></span>
                        </li>
                    @else
                        <li class="kt-pagination__link--next">
                            <a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left kt-font-brand"></i></a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li>
                                <span>...</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="kt-pagination__link--active">
                                        <span>{{ $page }}</span>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="kt-pagination__link--prev">
                            <a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right kt-font-brand"></i></a>
                        </li>
                    @else
                        <li class="kt-pagination__link--prev disabled">
                            <span><i class="fa fa-angle-right kt-font-brand"></i></span>
                        </li>
                    @endif

                    {{-- Last Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="kt-pagination__link--last">
                            <a href="{{ $paginator->url($paginator->lastPage()) }}"><i class="fa fa-angle-double-right kt-font-brand"></i></a>
                        </li>
                    @else
                        <li class="kt-pagination__link--last disabled">
                            <span><i class="fa fa-angle-double-right kt-font-brand"></i></span>
                        </li>
                    @endif
                </ul>

                <div class="kt-pagination__toolbar">
                    <select class="form-control kt-font-brand" style="width: 60px;" onchange="changePerPage(this.value)">
                        <option value="10" {{ $paginator->perPage() == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ $paginator->perPage() == 20 ? 'selected' : '' }}>20</option>
                        <option value="30" {{ $paginator->perPage() == 30 ? 'selected' : '' }}>30</option>
                        <option value="50" {{ $paginator->perPage() == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $paginator->perPage() == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span class="pagination__desc">
                        {{ __('messages.displaying') ?? 'Displaying' }}
                        {{ $paginator->firstItem() }}
                        {{ __('messages.to') ?? 'to' }}
                        {{ $paginator->lastItem() }}
                        {{ __('messages.of') ?? 'of' }}
                        {{ $paginator->total() }}
                        {{ __('messages.records') ?? 'records' }}
                    </span>
                </div>
            </div>
            <!--end: Pagination-->
        </div>
    </div>

    <script>
        function changePerPage(perPage) {
            const url = new URL(window.location);
            url.searchParams.set('per_page', perPage);
            url.searchParams.delete('page'); // Reset to first page
            window.location.href = url.toString();
        }
    </script>
@endif
