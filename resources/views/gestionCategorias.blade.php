<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Lista de Categorias </title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('includes.navbar')
        <div class="container-fluid">            
            <div class="row pt-5">
                <div  class="col"> 
                    <h1 class="text-center text-secondary"> Categorias </h1>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row pt-3">
                <div  class="col"> 
                    <div class="table responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorias as $row)
                                    <tr> 
                                        <td> {{ $row->nombre }} </td>
                                        <td> <a href="{{ url('categorias/'. $row->id) }}" class="btn btn-warning">Editar</a> </td>
                                        <td>
                                            <form method="POST" action= "{{url('categorias/'. $row->id)}}">
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
                <a href="{{ url('/nueva-categoria') }}" class="btn btn-success"> Crear nueva Categoría </a>
            </div>      
        </div>
    </body>
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"> </script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"> </script>
</html>
