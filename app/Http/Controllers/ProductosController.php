<?php

namespace App\Http\Controllers;
use App\Models\Productos;
use App\Models\Categorias;
use App\Models\Almacenes;
use App\Models\Productos_has_categorias;
use App\Models\User_has_productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductosController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $categorias = Categorias::where('id_user', $userId)->get();            
        $almacenes = Almacenes::where('id_user', $userId)->get();
        $productosCategorias = Productos_has_categorias::all();
        $productos = Productos::where('id_user', $userId)->paginate(10);
        return view('pages.productos.pizarra', compact(
            'productos', 
            'categorias', 'almacenes', 'productosCategorias')); 
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
        DB::beginTransaction();
        $userId = auth()->id();
        try {
            $producto = new Productos([
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'observaciones' => $request->observaciones,
                'almacen' => $request->almacen,
                'id_user' => $userId,
            ]);

            $producto->save();

            $idProducto = $producto->id;
            
            $categoriasIds = $request->input('categorias');   
            foreach ($categoriasIds as $categoriaId) {
                Productos_has_categorias::firstOrCreate([
                    'id_producto' => $idProducto,
                    'id_categoria' => $categoriaId,
                ]);
            }
            DB::commit(); 
            
            Session::increment('numProductos');
            return redirect('/productos')->with('success', 'Producto creado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en la creación del producto: ' . $e->getMessage());
        }
        /* Codigo anterior sin commit, y/o rollback
        $producto = new Productos($request->all());
        $producto->saveOrFail();
        $id = $producto->id;
        $this->almacenes($request, $id);
        return redirect('/');
        */
    }

    public function show(Request $request)
    {
        $filtro = $request->input('filtro');
        $userId = auth()->id();
        if ($request->filtro === 'categoria'){
            if($request->termino != 'null'){
                $idProductos = Productos_has_categorias::where('id_categoria', $request->termino)
                ->pluck('id_producto');
                $productos = Productos::whereIn('id', $idProductos)->paginate(10);
            }
            if ($request->termino == 'null') {
                $idProductos = Productos_has_categorias::pluck('id_producto');
                $productos = Productos::whereNotIn('id', $idProductos)->paginate(10);
            }
            
        }
        if ($request->filtro === 'almacen'){             
             if($request->termino != 'null'){
                $productos = $request->filtro == 'almacen'? Productos::where('almacen', $request->termino)->paginate(10) : '' ;
             }
             if($request->termino == 'null'){
                $productos = $request->filtro == 'almacen' ? Productos::whereNull('almacen')->paginate(10) : '';
             }
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
            'observaciones' => 'required|string|max:255',
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


}
