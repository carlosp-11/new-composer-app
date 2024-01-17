@extends('layouts.main')

@section('title', 'ALMACENES')

@section('content')

    <div class="row pt-5 px-0 mx-5">
        <div  class="col"> 
            <h1 class="text-center text-secondary"> Almacenes </h1>
        </div>
    </div>            
    <div class="row pt-3 px-0 mx-5">
        <div class="col"> 
            <div class="table responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="col-10">Nombre</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($almacenes as $row)
                            <tr> 
                                <td> {{ $row->nombre }} </td>
                                <td> <a href="{{ url('almacenes/'. $row->id).'/editar' }}" class="btn btn-warning">Editar</a> </td>
                                <td>
                                    <form method="POST" action= "{{url('almacenes/'. $row->id)}}">
                                        @csrf
                                        @method('DELETE')  
                                        <button type="submit" class="btn btn-danger">Borrar</button>
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
        <a href="{{ url('/crear-almacen') }}" class="btn btn-success"> Crear nuevo Almacén </a>
    </div>  
@endsection