<?php

namespace App\Http\Controllers;

//Son como los imports en java, decir archivos y clases en otros directorios, necesarios para que funcione el controlador
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //Funcion para el registro 
    public function register(Request $request){

        $user = new User();
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =Hash::make($request->password);

        $user->save();

        Auth::login($user);

        return redirect(route('privada'));
    }

    public function login(Request $request){

        $credenciales = [
            "email" => $request->email,
            "password" => $request->password,
        ];

        if (Auth::attempt($credenciales, true)) {
            
            $request->session()->regenerate(); // regenere la sesion, por si hay una sesion perdida
            return redirect()->intended(route('privada')); //

        }
        else{
            return redirect('login');
        }

    }

    public function logout(Request $request){

        Auth::logout();

        //Resetear la sesion para evitar que quede algo abierto 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect(route('login'));

    }
}
