<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $urlImagen = asset('img/crud.jpg');
        return view('pages.home.index', ['urlImagen' => $urlImagen]); 
    }
}
