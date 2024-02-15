<ul class="nav bg-white m-0 p-0 fixed-top justify-content-between" style="min-height: 60px;">
    <span class="navbar-brand fs-4 fw-bolder text-primary placeholder-glow align-self-center">
        CRUD APP
    </span>
    <div class="row">
        <li class= "col-4 align-self-center">
            <a class="nav-link position-relative" href="/almacenes" id="btnNavAlmacen">
                <i class="fa-solid fa-warehouse fs-4 text-secondary"></i>
                <span class="badge text-bg-danger position-absolute top-50 start-0 translate-middle">
                    {{ session('numAlmacenes') <= 99? session('numAlmacenes') : '+99' }}
                </span>
            </a>
        </li>
        <li class= "col-4 align-self-center">
            <a class="nav-link position-relative" href="/categorias" id="btnNavCategoria">
                <i class="fa-solid fa-tags fs-4 text-secondary"></i>
                <span class="badge text-bg-danger position-absolute top-50 start-0 translate-middle">
                    {{ session('numCategorias') <= 99?  session('numCategorias') : '+99' }}
                </span>
            </a>
        </li>
        <li class= "col-4 align-self-center">
            <a class="nav-link position-relative" href="/productos">
                <i class="fa-solid fa-boxes-stacked fs-4 text-secondary"></i>
                <span class="badge text-bg-danger position-absolute top-50 start-0 translate-middle">
                    {{ session('numProductos') <= 99?  session('numProductos') : '+99' }}
                </span>
            </a>
        </li>
    </div>
    <span class= "align-self-center">
    <li>                              
        <a class="nav-link dropdown-toggle" href="#" role="button" 
            data-bs-toggle="dropdown" aria-expanded="false"
        >
        <i class="fa-solid fa-user fs-4"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end bg-light">
            <div>
                <a class="dropdown-item" href="/private">
                    Área Personal
                </a>
            </div>
            <div>
                <button type="button" class="btn dropdown-item" data-bs-toggle="modal" 
                    data-bs-target="#sessionModal"
                >
                        Cerrar sesión
                </button>
            </div>
        </ul>
    </li>
    </span>
</ul>

<!-- Modal -->
<div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="sessionModalLabel" 
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="sessionModalLabel">
                    ¿Seguro que quieres cerrar sesión?
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                aria-label="Close">
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <form method="POST" action= "{{ url('/logout') }}">
                    @csrf
                        <button type="submit" class="btn btn-primary">
                            Cerrar sesión
                        </button>
                </form>
            </div>
        </div>
    </div>
</div>
