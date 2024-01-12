<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $urlImagen = asset('img/crud.jpg');
        return view('index', ['urlImagen' => $urlImagen]); 
    }
}
