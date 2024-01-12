<?php

namespace App\Http\Controllers;
use App\Models\Almacenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlmacenesController extends Controller
{
    public function index()
    {
        $almacenes = Almacenes::all();
        return view('gestionAlmacenes', compact('almacenes'));
    }
   
    public function create()
    {
        return view('crearAlmacen');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3|max:50',
        ]);
        DB::beginTransaction();

        try {
            $nuevoAlmacen = new Almacenes([
                'nombre' => $request->nombre,
            ]);
            $nuevoAlmacen->save();            
            DB::commit();            
            return redirect('/lista-almacenes')->with('success', 'Almacén creado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en la creación del almacén: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $almacen = Almacenes::findOrFail($id);
        return view('editarAlmacen',compact('almacen'));
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
            $almacen = Almacenes::findOrFail($id);
            $almacen->fill($request->input())->save();            
            DB::commit();  
            return redirect('/almacenes')->with('success', 'Almacén actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en la actualización del almacén: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $almacen = Almacenes::findOrFail($id);
            $almacen->delete();
            return redirect('/almacenes')->with('success', 'Almacén eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error en la eliminación del almacén: ' . $e->getMessage());
        }
    }
}
