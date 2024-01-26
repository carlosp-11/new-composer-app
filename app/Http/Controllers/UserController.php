<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//use Sanctum\Http\Controllers\HandlesSanctumLogin;

class UserController extends Controller
{
    //use HandlesSanctumLogin;
    public function index()
    {
        //$urlImagen = asset('img/crud.jpg');
        //Auth::check()
        //if(Auth::check())  return redirect()->back();
        $modo = 'login';
        return view('pages.login.login', compact('modo')); 
    }

    public function create()
    {
        $modo = 'signup';
        return view('pages.login.login', compact('modo')); 
    }

    public function store(Request $request) {
        $request->validate([
            //'nombre' => 'required|min:3|max:50',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        

        DB::beginTransaction();

        try {
            $nuevoUsuario = new User([
                'name' => 'usuario',
                'email' => $request->email,
                'password' => $request->password,
            ]);
            $nuevoUsuario->save();            
            DB::commit();            
            return redirect('/login')->with('success', 'Usuario registirado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en el registro del usuario: ' . $e->getMessage());
        }
    }
/*
    public function login(Request $request)
    {
        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'Autenticación exitosa']);
        }

        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }
    */
    
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                //Auth::logout();
                return redirect()->intended('/');
            } else { 
            return  redirect()->back()->withError('El usuario y/o la contraseña no coinciden con ningún registro');
            }
    }

    public function logout() {
        Auth::logout();
        return redirect('/login')->with('success', 'Sesión cerrada correctamente');
    }

}
