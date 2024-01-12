<?php

namespace App\Http\Controllers;
use App\Models\Productos;
use App\Models\Categorias;
use App\Models\Almacenes;
use App\Models\Productos_has_categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();            
        $productos = Productos::all();
        $almacenes = Almacenes::all();
        $productosCategorias = Productos_has_categorias::all();
        return view('gestionProductos', compact('productos', 'categorias', 'almacenes', 'productosCategorias')); 
    }

    public function create()
    {
        $almacenes = Almacenes::all();
        $categorias = Categorias::all();          
        return view('crearProducto', compact('categorias', 'almacenes')); 
    }

    public function store(Request $request)
    {
        //dd($request);
        $this->validateData($request);
        DB::beginTransaction();

        try {
            $producto = new Productos([
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'observaciones' => $request->observaciones,
                'almacen' => $request->almacen,
            ]);

            $producto->save();
            
            $id = $producto->id;
            
            $categoriasIds = $request->input('categorias');

            foreach ($categoriasIds as $categoriaId) {
                Productos_has_categorias::firstOrCreate([
                    'id_producto' => $id,
                    'id_categoria' => $categoriaId,
                ]);
            }
         
            DB::commit();            
            return redirect('/lista-productos')->with('success', 'Producto creado correctamente');
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
        $producto = Productos::findOrFail($id);        
        $categorias = Categorias::all();
        $almacenes = Almacenes::all();
        $productosCategorias = Productos_has_categorias::all();
        $categoriasRelacionadas = $productosCategorias->pluck('id_categoria')->toArray();
        foreach ($categorias as $categoria) {
            $categoria->relationExists = $productosCategorias->contains(function ($value) use ($categoria, $producto) {
                return $value->id_categoria === $categoria->id && $value->id_producto === $producto->id;
            });
        }
        return view('editarProducto',compact('producto', 'categorias', 'almacenes', 'productosCategorias', 'categoriasRelacionadas'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    { 
        $this->validateData($request);
        DB::beginTransaction();
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
            return redirect('/productos')->with('success', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error en la eliminación del producto: ' . $e->getMessage());
        }
    }  

    public function validateData(Request $request){
        $request->validate([
            'nombre' => 'required|min:3|max:150',
            'precio' => 'required|numeric|min:0.01',
            'observaciones' => 'nullable|string|max:255',
            'almacen' => 'required|integer|exists:almacenes,id',
            'categorias' => 'required|array',
        ]);
    }
 
}
