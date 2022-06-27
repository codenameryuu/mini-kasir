@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <i class="mdi mdi-chevron-left"></i>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" aria-label="@lang('pagination.previous')">
                    <i class="mdi mdi-chevron-left"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true">
                    {{ $element }}
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page">
                            <a href="javascript:void(0)">
                                {{ $page }}
                            </a>
                        </li>
                    @else
                        <li class="waves-effect">
                            <a href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <i class="mdi mdi-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <i class="mdi mdi-chevron-right"></i>
            </li>
        @endif
    </ul>
@endif
