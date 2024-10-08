<?php

namespace App\Http\Controllers;

//Son como los imports en java, decir archivos y clases en otros directorios, necesarios para que funcione el controlador
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request){

        //Usamos el metodo where para evaluar si existe el correo en la base de datos
        $usuario = User::where('email', $request->email)->first();

        if ($usuario) {

            /*
                Se guarda el id del usuario para poder verificarlo una vez en el metodo de la contraseña, 
                eso se hace para verificar si el usuario existe.
                En la varible usuario se guarda el objeto que se ha buscado en la base de datos si se encuantra se accede al id
                y se guarda en la varible usuarioId para poder guardarlo en la sesion 
            */
            $usuarioId = $usuario->id;
            $nombreUsuario = $usuario->name;

            /*
                Se obtiene el nombre del usuario luego se hace un array segun el nombre del usuario 
                para obtener solo el primer nombre, ya que en la base de datos el campo name 
                contiene el nombre completo del usuario, por ejemplo Juan Peréz Pérez, por lo tanto
                solo queremos bostrar en la vista Bievenido, Juan. No se desea mostrar todo el nombre del 
                usuario. Entonces cuando ya se tiene el nombre en eun array se accede a la posicion 
                cero que es donde está el primer nombre y luego se guarda ese datos en la sesion
            */
            $nombrePartes = explode(' ', $nombreUsuario);
            $primerNombre = $nombrePartes[0];
            session([
                'usuarioId' => $usuarioId,
                'userName' => $primerNombre,
            ]);
            return redirect(route('password')); //Si el correo es correcto se regirige la password

        }else{
            return redirect(route('login'))->with('error', 'Correo no valido'); //Se retorna nuevamente al login
        }

    }

    //En esta funcion se evalua el password una vez se haya comprobado que el usuario si existe
    public function verificarPassword(Request $request)
    {
        /*
            Primero se se accede a la sesion y se verifica si la varible que ha guradad tiene un valor y se le asigna a la varible usuarioId.
            Una vez se guarda el valor del id del usuario se verifica si el id es un valor o es nulo si el id no existe o es null se redirige al login.
            Por ultimo si el id del usuario es correcto en la varible $usuario se guarda un objeto del usuario que se encuentra con al funcion find de laravel.
        */
        $usuarioId = session('usuarioId');
        if (!$usuarioId) {
            return redirect(route('login'))->with('error', 'Usuario no encontrado.');
        }
        $usuario = User::find($usuarioId);
        if (!$usuario) {
            return redirect(route('login'))->with('error', 'Usuario no encontrado.');
        }
        
        //Se crea un objeto con las credenciales para iniciar sesion y los valores los obtenemos del obejto que se ha guradado en la varible $usuario
        $credenciales = [
            'email' => $usuario->email,
            'password' => $request->password,
        ];

        if ($usuario->rol == 1) {
            
            if (Auth::attempt($credenciales, true)) { 
                $request->session()->regenerate(); //Se creae la sesion y se redirige a la sesion, en este caso al dashboard.blade
                return redirect()->intended(route('privada'));
    
            } else {
                return redirect(route('password'))->with('error', 'Contraseña incorrecta.');
            }

        }
        elseif($usuario->rol == 2)
        {
            if (Auth::attempt($credenciales, true)) { 
                $request->session()->regenerate(); //Se creae la sesion y se redirige a la sesion, en este caso al dashboard.blade
                return redirect()->intended(route('vistaPrincipalAsistente'));
    
            } else {
                return redirect(route('password'))->with('error', 'Contraseña incorrecta.');
            }
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
