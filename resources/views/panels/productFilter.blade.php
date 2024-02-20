<div class="card mb-3" style="width: 600px;">
    <div class="row g-0">
        <div class="col">
            <div class="card-body">                                    
                <div id="filtro" class="row">
                    <div class="col-2">
                        <div class="row">
                        <button id="btnCategoria" type="button"  
                            onclick="filterRequest('categoria')" 
                            class="btn col text-secondary " aria-pressed="false"
                        > 
                            <i class="fa-solid fa-tags"></i>
                        </button> 
                        <button id="btnAlmacen" type="button" 
                            onclick="filterRequest('almacen')" 
                            class="btn col text-secondary"
                        > 
                            <i class="fa-solid fa-warehouse"></i>
                        </button>
                        </div>
                    </div>
                    <div class="col-8 justify-content-center text-center align-self-center">
                        <select class="form-select" id="termino" name="termino">
                            <option> Selecciona una opción </option>
                        </select>
                    </div>  
                    <div class="col-2 justify-content-center text-center align-self-center">
                        <button type="submit" class="btn btn-secondary w-100" id="buscarBtn">
                            Filtrar
                        </button>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
 
