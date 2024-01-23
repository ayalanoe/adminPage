<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CalendarioClase;
use Illuminate\Support\Facades\Storage;

class VistasAdminController extends Controller
{
    public function gestionUsuarios()
    {
        $usuarios = User::all();

        return view('VistasAdministrador/gestionUsuarios', ['usuarios' => $usuarios]);
    }

    public function destroy($id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            // Manejar el caso donde el usuario no existe
            return redirect()->route('gestionUsuarios')->with('error', 'Usuario no encontrado');
        }

        $usuario->delete();

        return redirect()->route('gestionUsuarios')->with('success', 'Usuario eliminado correctamente');
    }

    public function restablecerContrasenia($id)
    {
        $usuario = User::find($id);
        if (!$usuario) {
            return redirect()->route('gestionUsuarios')->with('error', 'Usuario no encontrado');
        }

        $usuario->password = Hash::make('academica.24fmo');
        $usuario->save();

        return redirect()->route('gestionUsuarios')->with('success', 'Contraseña restablecida correctamente');

    }

    //Funcion para el registro de usuarios, es decir que en esta funcion se crearan los usuarios que tendran acceso al sistema 
    public function register(Request $request){

        $user = new User(); //La clase User es la que tiene laravel podefecto
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save(); //Insersion en la base de datos
        Auth::login($user); //Se crea una sesion, con esto se redirige al dasboard
        return redirect(route('registro'));
    } 

    public function formularioSubirArchivo()
    {
        // Se carga la vista correspondiente para subir el archivo
        return view('VistasAdministrador/subirHorarioClases');
    }

    //Se crea una una funcnion para subir el archivo y se crea un objeto de tipo Requets para acceder a la informacion
    public function subirArchivo(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        
        /*  El formato es definir una variable en php no se especifica el tipo. Con on objeto request se accede y se especifica 
            el tipo de input el cual va recibir un parametro que es el nombre del input en el html
        */
        $nombreArchivo = $request->input('nombreArchivo');
        $archivo = $request->file('archivo');
        $ruta = Storage::disk('local')->put('archivos', $archivo); //---> Se establece la ruta

        
        //Insersion en la base de datos usando el modelo de la tabala para almacenar el archivo
        CalendarioClase::create([
            'nombreArchivo' => $nombreArchivo, 
            'rutaArchivo' => $ruta,
        ]);
        

        return redirect()->back()->with('mensaje', 'Archivo subido correctamente.');
    }
}
