<?php

namespace App\Http\Controllers;
use App\Models\Productos;
use App\Models\Categorias;
use App\Models\Almacenes;
use App\Models\User;
use App\Models\Productos_has_categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
//use Sanctum\Http\Controllers\HandlesSanctumLogin;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    //use HandlesSanctumLogin;
    public function index()
    {
        //Auth::check()
        //if(Auth::check())  return redirect()->back();
        $modo = 'login';
        if (auth()->check()) {
            return $this->show();
            //return view('pages.private.private'); 
        } else {
            return view('pages.login.login', compact('modo'));
        }
    }

    public function create()
    {
        $modo = 'signup';
        return view('pages.login.login', compact('modo')); 
    }

    public function show()
{
    $user = Auth::user();
    $userId = auth()->id();
    $numeroCategorias = Categorias::where('id_user', $userId)->count();            
    $numeroAlmacenes = Almacenes::where('id_user', $userId)->count();
    $numeroProductos = Productos::where('id_user', $userId)->count();
    $fechaCreacion = $user->created_at->format('d-m-Y');
    $correoElectronico = $user->email;

    $numProductos = Session::get('numProductos', function () use ($userId) {
        $count = Productos::where('id_user', $userId)->count();
        Session::put('numProductos', $count);
        return $count;
    });

    $numAlmacenes = Session::get('numAlmacenes', function () use ($userId) {
        $count = Almacenes::where('id_user', $userId)->count();
        Session::put('numAlmacenes', $count);
        return $count;
    });

    $numCategorias = Session::get('numCategorias', function () use ($userId) {
        $count = Categorias::where('id_user', $userId)->count();
        Session::put('numCategorias', $count);
        return $count;
    });

    return view('pages.private.private', compact('numeroAlmacenes', 'numeroCategorias', 'numeroProductos', 'fechaCreacion', 'correoElectronico', 'numProductos', 'numAlmacenes', 'numCategorias')); 
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
           
            Auth::login($nuevoUsuario);

            return redirect('/')->with('success', 'Usuario registirado correctamente');
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
                return redirect()->intended('/private');
            } else { 
            return  redirect()->back()->withError('El usuario y/o la contraseña no coinciden con ningún registro');
            }
    }

    public function logout() {
        Auth::logout();
        Session::put('numAlmacenes', 0);
        Session::put('numProductos', 0);
        Session::put('numCategorias', 0);
        return redirect('/login')->with('success', 'Sesión cerrada correctamente');
    }


 
    public function remember (Request $request) {
        $request->validate(['email' => 'required|email']);
        
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }
}
