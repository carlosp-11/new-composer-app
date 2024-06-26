<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoriasController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $categorias = Categorias::where('id_user', $userId)
                                ->orderBy('nombre', 'asc')
                                ->paginate(12);
                                
        return view('pages.categorias.pizarra', compact('categorias')); 
    }

    public function create()
    {
        $modo = 'crear';
        return view('pages.categorias.formulario', compact('modo'));
    }

    public function store(Request $request)
    {
        $userId = auth()->id();
        $request->validate([
            'nombre' => 'required|min:3|max:50',
        ]);

        DB::beginTransaction();

        try {
            $nuevaCategoria = new Categorias([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'id_user' => $userId,
            ]);
            $nuevaCategoria->save();            
            DB::commit();
            Session::increment('numCategorias');            
            return redirect('/categorias')->with('success', 'Categoria creada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en la creación de la categoría: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
       // 
    }

    public function edit(string $id)
    {
        $categoria = Categorias::findOrFail($id);
        $modo = 'editar';        
        return view('pages.categorias.formulario', compact('categoria', 'modo'));
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
            Session::decrement('numCategorias');
            return redirect('/categorias')->with('success', 'Categoría eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error en la eliminación de la categoría: ' . $e->getMessage());
        }
    }
}
