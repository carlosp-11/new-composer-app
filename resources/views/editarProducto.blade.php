<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edita un producto </title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
            <div class="text-center">                
                    <h1 class="text-center text-secondary pt-5"> Edita un producto </h1>
            </div>               
            <div class="">
                <form method="POST" class="py-3 px-3" id="formulario" >
                    @csrf
                    @method('PUT')                    
                    <div class="mb-3">
                        <label for="Nombre" class="form-label"> Nombre </label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$producto->nombre}}">
                    </div>
                    <div class="mb-3">
                        <label for="Precio" class="form-label"> Precio </label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" value="{{$producto->precio}}">
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select id="categoria" class="form-select" name="categoria" form="formulario">
                            @foreach ($categorias as $option)
                                <option value="{{ $option->id }}" {{ $producto->categoria == $option->id ? 'selected' : '' }} >
                                    {{ $option->categoria }}
                                </option>
                            @endforeach
                        </select>
                </div>
                    <div class="mb-3">
                        <label for="Observaciones" class="form-label"> Observaciones </label>
                        <input type="text" class="form-control" id="observaciones" name="observaciones" value="{{$producto->observaciones}}">
                    </div>
                    <div class="mb-3">  
                        @php
                            $almacenesIds = $productosAlmacenes->where('id_producto', $producto->id)->pluck('id_almacenes');
                            $itsOn='';
                        @endphp
                        <div class="form-check">
                            @foreach ($almacenesIds as $item)                            
                                @if ($item==2)
                                @php
                                    $itsOn= 'checked';
                                @endphp
                                @endif
                            @endforeach
                            <input class="form-check-input" type="checkbox" id="mercadona" name="mercadona" value="2" {{$itsOn}}>
                            <label class="form-check-label" for="mercadona">
                                Mercadona
                            </label>
                        </div>
                        <div class="form-check">
                            @php
                                $itsOn= '';
                            @endphp
                            @foreach ($almacenesIds as $item)                            
                                @if ($item==1)
                                @php
                                    $itsOn= 'checked';
                                @endphp
                                @endif
                            @endforeach                            
                            <input class="form-check-input" type="checkbox" id="alteza" name="alteza" value="1" {{$itsOn}}>
                            <label class="form-check-label" for="alteza">
                                Alteza
                            </label>                    
                        </div>
                        <div class="form-check">
                            @php
                                $itsOn= '';
                            @endphp
                            @foreach ($almacenesIds as $item)                            
                                @if ($item==3)
                                @php
                                    $itsOn= 'checked';
                                @endphp
                                @endif
                            @endforeach                        
                            <input class="form-check-input" type="checkbox" id="lidl" name="lidl" value="3" {{$itsOn}}>
                            <label class="form-check-label" for="lidl">
                                Lidl
                            </label>                    
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary mb-4 text-center"> Editar </button>
                    <a href="{{ url('/') }}" class="btn btn-danger mb-4 text-center"> Cancelar </a>
                </form>
            </div>
        </div>            
    </body>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"> </script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"> </script>
</html>
