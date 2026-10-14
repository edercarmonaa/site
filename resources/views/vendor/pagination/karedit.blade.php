@if ($paginator->hasPages())
    <nav class="pagination-nav" role="navigation" aria-label="Paginacion">
        <div class="pagination-mobile">
            @if ($paginator->onFirstPage())
                <span class="pagination-button pagination-button-disabled" aria-disabled="true" aria-label="Pagina anterior">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
                    <span class="sr-only">Anterior</span>
                </span>
            @else
                <a class="pagination-button" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Pagina anterior">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
                    <span class="sr-only">Anterior</span>
                </a>
            @endif

            <span class="pagination-status">Pagina {{ $paginator->currentPage() }} de {{ $paginator->lastPage() }}</span>

            @if ($paginator->hasMorePages())
                <a class="pagination-button" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Pagina siguiente">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                    <span class="sr-only">Siguiente</span>
                </a>
            @else
                <span class="pagination-button pagination-button-disabled" aria-disabled="true" aria-label="Pagina siguiente">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                    <span class="sr-only">Siguiente</span>
                </span>
            @endif
        </div>

        <div class="pagination-desktop">
            @if ($paginator->onFirstPage())
                <span class="pagination-link pagination-link-disabled" aria-disabled="true">Anterior</span>
            @else
                <a class="pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Anterior</a>
            @endif

            <div class="pagination-pages" aria-label="Paginas">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="pagination-page pagination-link-disabled" aria-disabled="true">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="pagination-page pagination-page-active" aria-current="page">{{ $page }}</span>
                            @else
                                <a class="pagination-page" href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            @if ($paginator->hasMorePages())
                <a class="pagination-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Siguiente</a>
            @else
                <span class="pagination-link pagination-link-disabled" aria-disabled="true">Siguiente</span>
            @endif
        </div>
    </nav>
@endif
