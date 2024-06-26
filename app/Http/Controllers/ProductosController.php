<?php

namespace App\Http\Controllers;
use App\Models\Productos;
use App\Models\Categorias;
use App\Models\Almacenes;
use App\Models\Productos_has_categorias;
use App\Models\User_has_productos;
use App\Models\Images;
use App\Models\Estados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Testing\FileFactory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $categorias = Categorias::where('id_user', $userId)->get();            
        $almacenes = Almacenes::where('id_user', $userId)->get();
        $productosCategorias = Productos_has_categorias::all();
        $imagenes = Images::all();
        $productos = Productos::where('id_user', $userId)
                                ->orderBy('nombre', 'asc')
                                ->paginate(12);
        return view('pages.productos.pizarra', compact(
            'productos', 
            'categorias', 'almacenes', 'productosCategorias', 'imagenes')); 
    }

    public function create()
    {
        $userId = auth()->id();
        $almacenes = Almacenes::where('id_user', $userId)->get();
        $categorias = Categorias::where('id_user', $userId)->get();
        $modo = 'crear';
        return view('pages.productos.formulario', compact('categorias', 'almacenes', 'modo')); 
    }

    public function store(Request $request)
    {
        $this->validateData($request);
        $userId = auth()->id();
        try {
            DB::beginTransaction();
            $producto = new Productos([
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'descripcion' => $request->descripcion,
                'almacen' => $request->almacen,
                'id_user' => $userId,
            ]);

            $producto->save();

            $idProducto = $producto->id;
            $categoriasIds = $request->input('categorias');   
            //dd($categoriasIds);
            foreach ($categoriasIds as $categoriaId) {
                Productos_has_categorias::firstOrCreate([
                    'id_producto' => $idProducto,
                    'id_categoria' => $categoriaId,
                ]);
            }
            DB::commit();
            $estado = new Estados();
            $estado->id_producto =$idProducto;
            $estado->descripcion = "producto registrado"; // Valor por defecto
            $estado->save(); 
            $this->requestQRCode($idProducto);
            return redirect('/productos')->with('success', 'Producto creado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en la creación del producto: ' . $e->getMessage());
        }
    }

    public function show(Request $request)
    {
        $filtro = $request->input('filtro');
        $userId = auth()->id();
        if($request->filtro !== null){
        if ($request->filtro === 'categoria'){
            if($request->termino != 'null'){
                $idProductos = Productos_has_categorias::where('id_categoria', $request->termino)
                ->pluck('id_producto');
                $productos = Productos::whereIn('id', $idProductos)
                                        ->orderBy('nombre', 'asc')
                                        ->paginate(12);
            }
            if ($request->termino == 'null') {
                $idProductos = Productos_has_categorias::pluck('id_producto');
                $productos = Productos::whereNotIn('id', $idProductos)
                                        ->orderBy('nombre', 'asc')
                                        ->paginate(12);
            }
            
        }
        if ($request->filtro === 'almacen'){             
             if($request->termino != 'null'){
                $productos = $request->filtro == 'almacen'? Productos::where('almacen', $request->termino) 
                                                                        ->orderBy('nombre', 'asc')
                                                                        ->paginate(12) : '' ;
             }
             if($request->termino == 'null'){
                $productos = $request->filtro == 'almacen' ? Productos::whereNull('almacen') 
                                                                        ->orderBy('nombre', 'asc')
                                                                        ->paginate(12) : '';
             }
        }
        } else {
            $productos = Productos::where('nombre', 'like', '%' . $request->termino . '%') 
                                    ->orderBy('nombre', 'asc')
                                    ->paginate(12);
        }
        $filtro = $request->input('filtro');
        $categorias = Categorias::where('id_user', $userId)->get();            
        $almacenes = Almacenes::where('id_user', $userId)->get();
        $productosCategorias = Productos_has_categorias::all();
        
        
        $productosHtml = view('panels.productTable')
        ->with('productos', $productos)
        ->with('categorias', $categorias)
        ->with('almacenes', $almacenes)
        ->with('productosCategorias', $productosCategorias)
        ->render();

      
        
        $productosPaginationHtml = view('panels.productPagination')
        ->with('productos', $productos)
        ->render();
    
        return response()->json([
            'productosHtml' => $productosHtml,
            'productos' => $productos,
            'productosPaginationHtml' => $productosPaginationHtml,
        ]);



        //return response()->json(['productos' => $productos, 'almacenes'=> $almacenes, 'categorias' => $categorias, 'productosCategorias' => $productosCategorias]);
        //return view('pages.productos.pizarra', compact('productos', 'categorias', 'almacenes', 'productosCategorias')); 
        //return response()->json(['productosHtml' => view('pages.productos.pizarra', compact('productos', 'almacenes', 'categorias', 'productosCategorias'))->render()]);
        // Renderiza la vista "pizarra" y devuelve la respuesta
    //return response()->json([
      //  'productosHtml' => view('pages.productos.pizarra', compact('productos', 'almacenes', 'categorias', 'productosCategorias'))->render()
    //]);
    //return view('pages.productos.pizarra', compact('productos', 'almacenes', 'categorias', 'productosCategorias'));
    }

    public function display (Request $request) 
    {
            $userId = auth()->id();
            $productos = Productos::where('nombre', 'like', '%' . $request->q . '%') 
                                    ->orderBy('nombre', 'asc')
                                    ->paginate(12);
            $categorias = Categorias::where('id_user', $userId)->get();            
            $almacenes = Almacenes::where('id_user', $userId)->get();
            $productosCategorias = Productos_has_categorias::all();
            $productosHtml = view('panels.productTable')
            ->with('productos', $productos)
            ->with('categorias', $categorias)
            ->with('almacenes', $almacenes)
            ->with('productosCategorias', $productosCategorias)
            ->render();
    
          
            
            $productosPaginationHtml = view('panels.productPagination')
        ->with('productos', $productos)
        ->render();
        
            return response()->json([
                'productosHtml' => $productosHtml,
                'productos' => $productos,
                'productosPaginationHtml' => $productosPaginationHtml,
            ]);
    
    }

    public function edit(string $id)
    {
        $userId = auth()->id();
        $producto = Productos::findOrFail($id);        
        $categorias = Categorias::where('id_user', $userId)->get();            
        $almacenes = Almacenes::where('id_user', $userId)->get();
        $modo = 'editar';
        $productosCategorias = Productos_has_categorias::all();
        $categoriasRelacionadas = $productosCategorias->pluck('id_categoria')->toArray();
        foreach ($categorias as $categoria) {
            $categoria->relationExists = $productosCategorias->contains(function ($value) use ($categoria, $producto) {
                return $value->id_categoria === $categoria->id && $value->id_producto === $producto->id;
            });
        }
        return view('pages.productos.formulario',compact('producto', 'categorias', 'almacenes', 'productosCategorias', 'categoriasRelacionadas', 'modo'));
    }

    public function detail(string $id)
    {
        $userId = auth()->id();
        $producto = Productos::findOrFail($id);        
        $categorias = Categorias::where('id_user', $userId)->get();            
        $almacenes = Almacenes::where('id_user', $userId)->get();
        $modo = 'editar';
        $productosCategorias = Productos_has_categorias::all();
        $categoriasRelacionadas = $productosCategorias->pluck('id_categoria')->toArray();
        foreach ($categorias as $categoria) {
            $categoria->relationExists = $productosCategorias->contains(function ($value) use ($categoria, $producto) {
                return $value->id_categoria === $categoria->id && $value->id_producto === $producto->id;
            });
        }
        $status = $this->getStatus($id);
        return view('pages.productos.detalle',compact('producto', 'categorias', 'almacenes', 'productosCategorias', 'categoriasRelacionadas', 'status'));
    }

    public function update(Request $request, string $id)
    { 
        $this->validateData($request);
        DB::beginTransaction();
        $userId = auth()->id();
        try{            
            $producto = Productos::findOrFail($id);
            $producto->fill($request->input())->save();
            $categoriasIds = $request->input('categorias');

            Productos_has_categorias::where('id_producto', $id)
            ->whereNotIn('id_categoria', $categoriasIds)
            ->delete();

            foreach ($categoriasIds as $categoriaId) {
            Productos_has_categorias::firstOrCreate([
                'id_producto' => $id,
                'id_categoria' => $categoriaId,
            ]);
            }

            DB::commit();  
            return redirect('/productos')->with('success', 'Producto actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en la actualización del producto: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $producto = Productos::findOrFail($id);
            $productosCategorias = Productos_has_categorias::where('id_producto', $id)->delete();
            $producto->delete();
            Session::decrement('numProductos');
            return redirect('/productos')->with('success', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error en la eliminación del producto: ' . $e->getMessage());
        }
    }  

    public function validateData(Request $request){
        $request->validate([
            'nombre' => 'required|min:3|max:150',
            'precio' => 'required|numeric|min:0.01',
            'descripcion' => 'required|string|max:255',
            'almacen' => 'required|integer|exists:almacenes,id',
            'categorias' => 'required|array',
        ]);
    }
    
    public function filterOptions(Request $request)
    {
        $userId = auth()->id();
        $filtro = $request->query('filtro');       
        $categorias = Categorias::where('id_user', $userId)->get();            
        $almacenes = Almacenes::where('id_user', $userId)->get();
        $productosCategorias = Productos_has_categorias::all();
        $productos = Productos::where('id_user', $userId)->get();
        return view('pages.productos.pizarra', compact('productos', 'categorias', 'almacenes', 'productosCategorias', 'filtro')); 

    }

    public function requestQRCode(string $id)
    {
        //$productURL='http://new-composer-app.test/productos/'.$id;
        $productURL= env('APP_URL') . '/productos/' . $id;
        $urlAPI = 'https://getqrcode.p.rapidapi.com/api/getQR';
        $queryParams = [
            'forQR' => $productURL,
        ];
        $headers = [
            'X-RapidAPI-Key' => env('X_RAPID_API_KEY'),
            'X-RapidAPI-Host' => 'getqrcode.p.rapidapi.com',
        ];

        try {
            $client = new Client();
            $response = $client->request('GET', $urlAPI, [
                'query' => $queryParams,
                'headers' => $headers,
            ]);
           $result = $response->getBody()->getContents();
           $this->uploadFile($result, $id); 
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al generar el código QR: ' . $e->getMessage());
        }
    }

    public function uploadFile($file, $id_upload) 
    {
        try {
        $archivoTemporal = tempnam(sys_get_temp_dir(), 'archivo_temporal');
        file_put_contents($archivoTemporal, $file);
    
        // Subir el archivo a Cloudinary
        $cloudinaryResponse = Cloudinary::upload($archivoTemporal)->getSecurePath();

        $this->saveQR( $cloudinaryResponse, $id_upload);
    
        // Eliminar el archivo temporal
        unlink($archivoTemporal);
     } catch (\Exception $e) {
         return redirect()->back()->with('error', 'Error al subir archivo: ' . $e->getMessage());
     }
    }

    public function getStatus($id_producto) 
    {
        $status = Estados::where('id_producto', $id_producto)->get();
        
        // Verificar si se encontraron registros
        $status = Estados::where('id_producto', $id_producto)->get();
        // Retornar los registros encontrados
        return $status;
    }

    public function updateStatus(Request $request){

        try {
        $estado = new Estados([
            'id_producto' =>  $request->id_producto,
            'descripcion' => $request->descripcion,
            'status' => $request->status,
        ]);
        $estado->save();
        return redirect('/productos')->with('success', 'Status del producto actualizado correctamente'); 
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al subir archivo: ' . $e->getMessage());
        }
    }

    public function saveQR ($url, $id_upload) {
        try {
            $image = new Images([
                'nombre' => 'QR_Producto',
                'url' => $url,
                'id_producto' =>  $id_upload,
            ]);
            $image->save();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error al guardar imagen QR: ' . $e->getMessage());
            }
    } 
}
