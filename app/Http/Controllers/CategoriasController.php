<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();
        return view('gestionCategorias', compact('categorias')); 
    }

    public function create()
    {
        return view('crearCategoria');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3|max:50',
        ]);
        DB::beginTransaction();

        try {
            $nuevaCategoria = new Categorias([
                'nombre' => $request->nombre,
            ]);
            $nuevaCategoria->saveOrFail();            
            DB::commit();            
            return redirect('/lista-categorias')->with('success', 'Categoria creada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en la creación de la categoría: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $categoria = Categorias::findOrFail($id);        
        return view('editarCategoria', compact('categoria'));
    }

    public function edit(string $id)
    {
       //
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|min:3|max:50',
        ]);
        DB::beginTransaction();

        try {        
            $categoriaEditada = Categorias::findOrFail($id);
            $categoriaEditada->fill($request->input())->save();            
            DB::commit();  
            return redirect('/categorias')->with('success', 'Categoria actualizada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en la actualización de la categoría: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $categoria = Categorias::findOrFail($id);
            $categoria->delete();
            return redirect('/categorias')->with('success', 'Categoría eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error en la eliminación de la categoría: ' . $e->getMessage());
        }
    }
}
