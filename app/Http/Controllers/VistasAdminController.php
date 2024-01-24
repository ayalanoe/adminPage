<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CalendarioClase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VistasAdminController extends Controller
{
    //----------------------------- FUNCIONES PARA LA GESTION DE USUARIOS ----------------------------------------------------------------------------------------------------------
        public function gestionUsuarios()
        {
            $usuarios = User::all();

            return view('VistasAdministrador/gestionUsuarios', ['usuarios' => $usuarios]);
        }

        public function editarDatosUsuario(Request $request, $id){

            $usuario = User::find($id);

            if (!$usuario) {
                // Manejar el caso donde el usuario no existe
                return redirect()->route('privada')->with('error', 'Usuario no encontrado');
            }

            $usuario->name = $request->Nombre;
            $usuario->email = $request->Correo; 

            $usuario->save();

            return redirect()->route('gestionUsuarios');
  
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
            return redirect(route('privada'));
        } 

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    
    //--------------------------- FUNCIONES PARA EL HORARIO DE CLASES Y EL HORARIO ADMINISTRATIVO ----------------------------------------------------------------------------------
        
            

        public function formularioSubirArchivo()
        {
            $horarioAcademico = CalendarioClase::all();

            // Se carga la vista correspondiente para subir el archivo
            return view('VistasAdministrador/subirHorarioClases', ['horario' => $horarioAcademico]);
        }

        public function eliminarHorarioAcademico($id)
        {
            $archivo = CalendarioClase::find($id);

            if (!$archivo) {

                return redirect()->route('subirHorarioClases')->with('error', 'Archivo no encontrado');
            } 
                
            $archivo->delete();
            return redirect()->route('subirHorarioClases')->with('error', 'Archivo no encontrado');
            
        }

        public function verHorarioClases($id){
            

            $horarioClase = CalendarioClase::find($id);

            if (!$horarioClase) {
                return redirect()->route('subirHorarioClases')->with('error', 'Horario académico no encontrado');
            }

            // Puedes usar el facade Storage para obtener el contenido del archivo
            $contenidoArchivo = Storage::get($horarioClase->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)
                ->header('Content-Type', 'application/pdf');

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
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
}
