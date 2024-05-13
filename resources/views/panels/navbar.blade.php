<ul class="nav bg-white m-0 p-0 fixed-top justify-content-center" style="min-height: 60px;">
        
    <span class="row">
        <a class=" align-self-center" href="/"> 
            <img  src="{{ asset('img/cdepot_icon.png') }}" alt="CDEPOT" style="height:3rem;" >   
        </a>
    </span>
    <span class= "align-self-center">
    <li>                              
        <a class="nav-link dropdown-toggle" href="#" role="button" 
            data-bs-toggle="dropdown" aria-expanded="false"
        >
        <i class="fa-solid fa-user fs-4"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end bg-light">
            <div>
            <button type="button" class="btn dropdown-item text-center" data-bs-toggle="modal" 
                    data-bs-target="#helpModal"
                >
                        Ayuda
                </button>
                <button type="button" class="btn dropdown-item text-center" data-bs-toggle="modal" 
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

<!-- Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">¿Por dónde comenzar?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>1.- Comienza creando los almacenes en los que se guardarán los productos.</p> <br/>
                <p>2.- Crea las categorías que necesites para agrupar tus productos.</p> <br/>
                <p>3.- Ya puedes empezar a registrar productos.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
