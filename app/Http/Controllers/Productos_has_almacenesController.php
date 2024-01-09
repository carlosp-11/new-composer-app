<?php

namespace App\Http\Controllers;

use App\Models\Productos_has_almacenes;
use Illuminate\Http\Request;

class Productos_has_almacenesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productosAlmacenes = Productos_has_Almacenes::find($id);
        return view('index',compact('productosAlmacenes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
