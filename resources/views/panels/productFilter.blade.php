<div class="row row-cols-1 mx-0 p-0 mt-4 justify-content-center">
    <div class="col ms-auto me-auto"> 
        <div class="card mb-3 px-0 mx-auto animated fadeInDown shadow " style="max-width: 600px;">
            <div class="row g-0">
                <div class="col ">
                    <div class="card-body"> 
                        <div class="row gx-1 justify-content-center">
                            <div class="col-2 text-center align-self-center align-items-center">
                                <a href="/qrscanner" class="align-self-center ">
                                    <i class="fa-solid fa-qrcode fs-1 text-secondary align-self-center pt-1"></i>
                                </a>
                            </div>
                            <form id="searchForm" class=" col-10 align-items-center pe-1">
                                <div class="row gx-2">
                                    <div class="align-items-center col-10">
                                        <input type="text" class="form-control" name="q" 
                                            id="searchInput" placeholder="Buscar productos por nombre"
                                        >
                                    </div>
                                    <button type="submit" class="btn btn-primary col-2" >  
                                        <i class="fa-solid fa-magnifying-glass fs-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-0">
                <div class="col ">
                    <div class="card-body">                                    
                        <div id="filtro" class="row gx-1">
                            <div class="col-3 align-self-center">
                                <div class="row g-0 justify-content-around ">
                                    <button id="btnCategoria" type="button"  
                                        onclick="filterRequest('categoria')" 
                                        class="btn col-auto text-secondary m-0 p-0 align-self-center" 
                                        aria-pressed="false"
                                    > 
                                        <i class="fa-solid fa-tags fs-3"></i>
                                    </button>
                                <button id="btnAlmacen" type="button" 
                                    onclick="filterRequest('almacen')" 
                                    class="btn col-auto text-secondary m-0 p-0 align-self-center"
                                > 
                                    <i class="fa-solid fa-warehouse fs-3"></i>
                                </button>
                                </div>
                            </div>
                            <div class="col-7 justify-content-center text-center align-self-center">
                                <select class="form-select" id="termino" name="termino">
                                    <option> Selecciona una opción </option>
                                </select>
                            </div>  
                            <div class="col-2 justify-content-center text-center align-self-center">
                                <button type="submit" class="btn btn-secondary w-100 align-self-center" id="buscarBtn">
                                    <i class="fa-solid fa-filter fs-3 align-self-center"></i>
                                </button>
                            </div>
                        </div>                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
