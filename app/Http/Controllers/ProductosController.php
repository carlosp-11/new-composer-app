<?php

namespace App\Http\Controllers;
use App\Models\Productos;
use App\Models\Categorias;
use App\Models\Almacenes;
use App\Models\Productos_has_almacenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();            
        $productos = Productos::all();
        $almacenes = Almacenes::all();
        $productosAlmacenes = Productos_has_almacenes::all();
        return view('index', compact('productos', 'categorias', 'almacenes', 'productosAlmacenes')); 
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
           // 'nombre' => 'required|min:3|max:255|unique:productos',
            'precio' => 'required|numeric|min:0.01',
            'observaciones' => 'nullable|string|max:255',
            'categoria' => 'required|exists:categorias,id',
            'mercadona' => 'nullable|required_without_all:alteza,lidl',
            'alteza' => 'nullable|required_without_all:mercadona,lidl',
            'lidl' => 'nullable|required_without_all:mercadona,alteza',
        ]);

        DB::beginTransaction();

        try {
            $producto = new Productos([
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'observaciones' => $request->observaciones,
                'categoria_id' => $request->categoria,
            ]);

            $producto->save();
            $id = $producto->id;
            $this->almacenes($request, $id);
            DB::commit();            
            return redirect()->with('success', 'Producto creado correctamente');
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

    public function show(string $id)
    {
        $categorias = Categorias::all();
        $productosAlmacenes = Productos_has_almacenes::all();
        $producto = Productos::find($id);
        
        return view('editarProducto',compact('producto', 'categorias', 'productosAlmacenes'));
    }

    public function edit(string $id)
    {
        $productosAlmacenes = Productos_has_almacenes::all();
        $categorias = Categorias::all(); 
        
        return view('editarProducto', compact('categorias', 'productosAlmacenes'));
    }

    public function update(Request $request, string $id)
    { 
        $productosAlmacenes = Productos_has_almacenes::where('id_producto', $id)->delete();
        $this->almacenes($request, $id);
        $producto = Productos::find($id);
        $producto->fill($request->input())->saveOrFail();
        return redirect('/');
    }

    public function destroy(string $id)
    {
        $productosAlmacenes = Productos_has_almacenes::where('id_producto', $id)->delete();
        $producto = Productos::find($id);
        $producto->delete();
        return redirect('/');
    }

    public function almacenes (Request $request, string $id)
    {
        if (!is_null($request->mercadona)){
            $mercadona = $request->mercadona;
            $productoAlmacen = new Productos_has_almacenes([                
                'id_producto' => $id,
                'id_almacenes' =>$mercadona
            ]);
            $productoAlmacen->saveOrFail();
        } 
        if (!is_null($request->alteza)){
            $alteza = $request->alteza;
            $productoAlmacen = new Productos_has_almacenes([                
                'id_producto' => $id,
                'id_almacenes' =>$alteza
            ]);
            $productoAlmacen->saveOrFail();
        } 
        if (!is_null($request->lidl)){
            $lidl = $request->lidl;
            $productoAlmacen = new Productos_has_almacenes([                
                'id_producto' => $id,
                'id_almacenes' =>$lidl
            ]);
            $productoAlmacen->saveOrFail();
        } 
    }
}
