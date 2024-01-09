<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlmacenesController extends Controller
{
    public function index()
    {
        $almacenes = Almacenes::all();
        return view('index',compact('almacenes'));
    }
   
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        $almacenes = Almacenes::find($id);
        return view('index',compact('almacenes'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
