@extends('layouts.main')

@section('title', 'CATEGORIAS')

@section('content')
    <div class="row pt-5 px-0 mx-5">
        <div  class="col"> 
            <h1 class="text-center text-secondary  fw-light"> Categorias </h1>
        </div>
    </div>   
    <div class="row pt-3 px-0 mx-5">
        <div  class="col"> 
            <div class="table responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="col-10">Nombre</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $row)
                            <tr> 
                                <td> {{ $row->nombre }} </td>
                                <td> 
                                    <a href="{{ url('categorias/'. $row->id.'/editar') }}" 
                                    class="btn btn-warning">
                                        <i class="fa-solid fa-pen"></i>
                                    </a> 
                                </td>
                                <td>
                                    <form method="POST" action= "{{url('categorias/'. $row->id)}}">
                                        @csrf
                                        @method('DELETE')  
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>                                    
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header text-center">
                                                <h5 class="modal-title"> ¿Seguro que deseas borrar? </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                <p class=""> Este cambio puede afectar a los productos asociados a esta categoría </p>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Borrar</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>                                    
                                    </form> 
                                </td>  
                            
                            
                            
                            
                            </tr>                                 
                        @endforeach                               
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="pt-5 text-center"> 
        <a href="{{ url('/crear-categoria') }}" class="btn btn-primary"> Crear nueva Categoría </a>
    </div>

    

@endsection