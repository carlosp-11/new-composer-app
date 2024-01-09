<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Lista de Productos </title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">            
            <div class="row pt-5">
                <div  class="col"> 
                    <h1 class="text-center text-secondary"> Productos </h1>
                </div>
            </div>
            <div class="row pt-3">
                <div  class="col"> 
                    <div class="table responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Observaciones</th>
                                    <th scope="col">Almacenes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Producto 1</td>
                                    <td> Precio 1 </td>
                                    <td> Catergoria 1 </td>
                                    <td> Observaciones 1 </td>
                                    <td> Almacenes </td>
                                    <td> <button type="button" class="btn btn-warning">Editar</button> </td>
                                    <td> <button type="button" class="btn btn-danger">Borrar</button> </td>  
                                </tr>
                                <tr>
                                    <td scope="row">Producto 2</td>
                                    <td> Precio 2 </td>
                                    <td> Catergoria 2 </td>
                                    <td> Observaciones 2 </td>
                                    <td> Almacenes </td>
                                    <td> <button type="button" class="btn btn-warning">Editar</button> </td>
                                    <td> <button type="button" class="btn btn-danger">Borrar</button> </td>                                
                                </tr>
                                <tr>
                                    <td scope="row">Producto 3</td>
                                    <td> Precio 3 </td>
                                    <td> Catergoria 3 </td>
                                    <td> Observaciones 3 </td>
                                    <td> Almacenes </td>
                                    <td> <button type="button" class="btn btn-warning">Editar</button> </td>
                                    <td> <button type="button" class="btn btn-danger">Borrar</button> </td>  
                                </tr>                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="pt-5 text-center"> 
                <button type="button" class="btn btn-success"> Crear nuevo Producto </button>
            </div>      
        </div>
    </body>
</html>
