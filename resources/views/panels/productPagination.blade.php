
    <div class="my-5 mx-auto animated fadeInDown">
        <nav class="py-5  mx-auto" aria-label="Page navigation example" id="pagination-container">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $productos->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $productos->previousPageUrl() }}">
                        Anterior
                    </a>
                </li

                @foreach ($productos->getUrlRange(1, $productos->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $productos->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">
                            {{ $page }}
                        </a>
                    </li>
                @endforeach
                <li class="page-item {{ $productos->currentPage() == $productos->lastPage() ? 
                    'disabled' : '' }}"
                >
                    <a class="page-link" href="{{ $productos->nextPageUrl() }}">
                        Siguiente
                    </a>
                </li>
            </ul>
        </nav> 
    </div>
