<nav class="navbar navbar-expand-lg bg-info m-0 p-0 " style="min-height: 60px;">
    <div class="container-fluid row">
        <div class="col-2">
        <a class="navbar-brand fs-3 text-light fw-bold" href="/" 
        style="-webkit-text-stroke: 1px black;">
            CRUD APP
        </a>
        </div>
        <div class="col-2 text-end">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
        aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"/>
        </button>
        </div>
        
        <div class="collapse navbar-collapse col-8" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" 
                    data-bs-toggle="dropdown" aria-expanded="false">
                        Almacenes
                    </a>
                    <ul class="dropdown-menu bg-light">
                        <li>
                            <a class="dropdown-item" href="/almacenes">
                                Lista de almacenes
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/crear-almacen">
                                Crear nuevo almacen
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" 
                    data-bs-toggle="dropdown" aria-expanded="false">
                        Categorías
                    </a>
                    <ul class="dropdown-menu bg-light">
                        <li>
                            <a class="dropdown-item" href="/categorias">
                                Lista de categorías
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/crear-categoria">
                                Crear nueva categoría
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" 
                    data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu bg-light">
                        <li>
                            <a class="dropdown-item" href="/productos">
                                Lista de productos
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/crear-producto">
                                Crear nuevo producto
                            </a>
                        </li>
                    </ul>                                
                </li>                
                <li>
                    @guest
                        <a class="nav-link " href="/login" role="button">
                            Iniciar sesión
                        </a>
                    @else
                        <button type="button" class="btn " data-bs-toggle="modal" 
                        data-bs-target="#sessionModal">
                            Cerrar sesión
                        </button>
                    @endguest
                </li>                         
            </ul>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="sessionModalLabel" 
aria-hidden="true">
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
