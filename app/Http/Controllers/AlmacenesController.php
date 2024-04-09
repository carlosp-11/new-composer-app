<?php

namespace App\Http\Controllers;
use App\Models\Almacenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AlmacenesController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $almacenes = Almacenes::where('id_user', $userId)
                              ->orderBy('nombre', 'asc')
                              ->paginate(12);
        return view('pages.almacenes.pizarra', compact('almacenes'));
    }
   
    public function create()
    {
        $modo ='crear';
        return view('pages.almacenes.formulario', compact('modo'));
    }

    public function store(Request $request)
    {
        $userId = auth()->id();
        $request->validate([
            'nombre' => 'required|min:3|max:50',
        ]);
        DB::beginTransaction();
        
        try {
            $nuevoAlmacen = new Almacenes([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'slots' => $request->slots,
                'id_user' => $userId,
            ]);
            $nuevoAlmacen->save();            
            DB::commit();     
            Session::increment('numAlmacenes');       
            return redirect('/almacenes')->with('success', 'Almacén creado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en la creación del almacén: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
       //
    }

    public function edit(string $id)
    {
        $almacen = Almacenes::findOrFail($id);
        $modo ='editar';
        return view('pages.almacenes.formulario',compact('almacen', 'modo'));
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
            Session::decrement('numAlmacenes');
            return redirect('/almacenes')->with('success', 'Almacén eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error en la eliminación del almacén: ' . $e->getMessage());
        }
    }
}
