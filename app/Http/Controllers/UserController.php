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
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

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
            //return view('pages.home.index'); 
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
    
    return view('pages.home.index'); 
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

            return redirect('/')->with('success', 'Usuario registrado correctamente');
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


 
    public function remember (Request $request) {
        $request->validate(['email' => 'required|email']);
        
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function sendWelcomeEmail(Request $request)
    {
        // Aquí puedes agregar la lógica de validación de la solicitud si es necesario

        // Obtener la dirección de correo electrónico del usuario (si está disponible)
        $userEmail = $request->user()->email;

        // Enviar el correo electrónico de bienvenida
        Mail::to($userEmail)->send(new WelcomeEmail());

        // Redireccionar a una página de confirmación u otra página de tu elección
        return redirect(('/private'))->with('success', 'El correo de bienvenida ha sido enviado exitosamente.');
    }

}
