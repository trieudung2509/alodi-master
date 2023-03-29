@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            @if($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span>« {{ translate('Previous') }}</span>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">« {{ translate('Previous') }}</a>
                </li>
            @endif

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">{{ translate('Next') }} »</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span>{{ translate('Next') }} »</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
