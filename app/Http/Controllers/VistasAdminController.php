<?php

namespace App\Http\Controllers;

use App\Models\CalendarioAdministrativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\CalendarioClase;
use App\Models\Carrera;
use App\Models\Contacto;
use App\Models\Facultad;
use App\Models\Galeria;
use App\Models\Anuncios;
use App\Models\AtencionHorario;
use App\Models\PreguntaFrecuente;
use App\Models\Tramite;
use App\Models\Constancias;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VistasAdminController extends Controller
{
    //----------------------------- FUNCIONES PARA LA GESTION DE USUARIOS ----------------------------------------------------------------------------------------------------------
        public function gestionUsuarios()
        {
            if (Auth::check()) {
                $usuarios = User::all();
                return view('VistasAdministrador/gestionUsuarios', ['usuarios' => $usuarios]);
            }
            else{
                return redirect()->route('login');
            }
        }

        public function editarDatosUsuario(Request $request, $id){
            
            $usuario = User::find($id);

            if (!$usuario) {
                // Manejar el caso donde el usuario no existe
                return back()->with('errorUsuario', 'Usuario no encontrado');
            }

            $usuario->name = $request->Nombre;
            $usuario->email = $request->Correo; 
            $usuario->save();
            return back()->with('successDatosPerfil', 'Perfil actualizado correctamente');
        }

        public function destroy($id)
        {
            $usuario = User::find($id);

            if (!$usuario) {
                // Manejar el caso donde el usuario no existe
                return redirect()->route('gestionUsuarios')->with('error', 'Usuario no encontrado');
            }

            $usuario->delete();
            return back()->with('usuarioEliminarRespuesta', 'Usuario eliminado correctamente');
        }

        public function restablecerContrasenia($id)
        {
            $usuario = User::find($id);
            if (!$usuario) {
                return redirect()->route('gestionUsuarios')->with('error', 'Usuario no encontrado');
            }

            $usuario->password = Hash::make('academica.24fmo');
            $usuario->save();

            return back()->with('usuarioRestPassRespuesta', 'Se restablecio la contraseña del usuario');
        }

        public function cambiarPassword(Request $request, $id)
        {
            $usuario = User::find($id);

            if (!$usuario) {
                
                return back()->with('errorUsuario', 'Usuario no encontrado');
            }

            $passActual = $request->passwordActual;

            if (Hash::check($passActual, $usuario->password)) {

                $usuario->password = Hash::make($request->newPassword);
                $usuario->save();
                return back()->with('passActulizada', 'Contraseña actulizada correctamente');
            }

            return back()->with('passError', 'La contraseña actual no es la correcta');

        }

        //Funcion para el registro de usuarios, es decir que en esta funcion se crearan los usuarios que tendran acceso al sistema 
        public function register(Request $request){

            $user = new User(); //La clase User es la que tiene laravel podefecto
            
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->rol = $request->rolUsuario;

            $user->save(); //Insersion en la base de datos
            return back()->with('crearUsuarioRespuesta', "Usuario creado correctamente");
        } 

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //--------------------------- FUNCIONES PARA EL CALENDARIO DE CLASES --------------------------------------------------------------------------------------------------------------
        
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
            
            //La clase storage contiene el metodo delete, el cual recibe la ruta guardada en el objeto y elimina el archivo
            Storage::delete($archivo->rutaArchivo);
            return back()->with('resEliminarCalendarioAcademico', 'Horario eliminado correctamente');
            
        }

        public function verHorarioClases($id){
            

            $horarioClase = CalendarioClase::find($id);

            if (!$horarioClase) {
                return redirect()->route('subirHorarioClases')->with('error', 'Horario académico no encontrado');
            }

            // Puedes usar el facade Storage para obtener el contenido del archivo
            $contenidoArchivo = Storage::get($horarioClase->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');

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
            $ruta = Storage::disk('local')->put('calendarioAcademico', $archivo); //---> Se establece la ruta

            
            //Insersion en la base de datos usando el modelo de la tabala para almacenar el archivo
            CalendarioClase::create([
                'nombreArchivo' => $nombreArchivo, 
                'rutaArchivo' => $ruta,
            ]);
            
            return back()->with('resCalendarioAcademico', 'Archivo subido correctamente');
        }

    // -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LA GESTION DEL DIRECTORIO PERSONAL ACADÉMICO ------------------------------------------------------------------------------------
        public function verDatosDirectorios()
        {
            $contactos = Contacto::all();
            return view('VistasAdministrador/gestionDirectorio', ['directorio' => $contactos]);
        }

        public function insertarDatosDirectorio(Request $request)
        {
            $contancto = new Contacto(); // Se crea una nueva instacia
            
            $contancto->nombre = $request->nombreContacto;
            $contancto->correo = $request->correoContacto;
            $contancto->contacto = $request->numeroContacto;
            $contancto->tramitesAsignado = $request->tramitesAcargo;

            $contancto->save();
            return back()->with('respuestaContactoCrear', 'Contacto creado correctamente');

        }

        public function eliminarContactoDirectorio($id)
        {
            $contacto = Contacto::find($id);

            if (!$contacto) {
                // Manejar el caso donde el usuario no existe
                return back()->with('errorContacto', 'Contacto no encontrado');
            }

            $contacto->delete();
            return back()->with('contactoEliminarRespuesta', 'Contacto eliminado correctamente');
        }

        public function editarDatosContacto(Request $request, $id){
            
            $contacto = Contacto::find($id);

            if (!$contacto) {
                // Manejar el caso donde el usuario no existe
                return back()->with('errorContacto', 'Contacto no encontrado');
            }

            $contacto->nombre = $request->editarNombreContacto;
            $contacto->correo = $request->editarCorreoContacto;
            $contacto->contacto = $request->editarNumeroContacto;
            $contacto->tramitesAsignado = $request->editarTramitesAcargo;


            $contacto->save();
            return back()->with('respuestaEditarContacto', 'Contacto actualizado correctamente');
        }

        

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNIONES PARA LA GESTION DE LOS CALENDARIOS ADMINISTRATIVOS -------------------------------------------------------------------------------------

        public function mostrarVistaCalendarioAdmin()
        {
            $calendarioAdmin = CalendarioAdministrativo::all();

            return view('VistasAdministrador/gestionCalendarioAdministrativo', [

                'calAdmin' => $calendarioAdmin 
            ]);

        }

        public function subirArchivoCalAdmin(Request $request)
        {
            $request->validate([
                'archivo' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);
            
            /*  El formato es definir una variable en php no se especifica el tipo. Con on objeto request se accede y se especifica 
                el tipo de input el cual va recibir un parametro que es el nombre del input en el html
            */
            $nombreCalAdmin = $request->input('nombreArchivo');
            $archivo = $request->file('archivo');
            $ruta = Storage::disk('local')->put('Calendario_Administrativo', $archivo); //---> Se establece la ruta

            
            //Insersion en la base de datos usando el modelo de la tabala para almacenar el archivo
            CalendarioAdministrativo::create([
                'nombreArchivo' => $nombreCalAdmin, 
                'rutaArchivo' => $ruta,
            ]);
            
            return back()->with('resSubirCalAdmin', 'Se ha subido el archivo correctamente');

        }
        
        public function eliminarCalAdmin($id)
        {
            $archivo = CalendarioAdministrativo::find($id);

            if (!$archivo) {

                return back('eliminarCalendarioCx')->with('error', 'Archivo no encontrado');
            } 
                
            $archivo->delete();

            Storage::delete($archivo->rutaArchivo);

            return back()->with('resEliminarCalAdmin', 'Calendario administrativo eliminado correctamente');
            
        }



        public function verCalAdmin($id){
            

            $calAdmin = CalendarioAdministrativo::find($id);

            if (!$calAdmin) {
                return redirect()->route('subirHorarioClases')->with('error', 'Horario académico no encontrado');
            }

            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::get($calAdmin->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');

        }


    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    //----------------------------- FUCIONES PARA LOS PLANES DE ESTUDIO DE PREGRADO -------------------------------------------------------------------------------------------------------------
        
        public function filtrarDepartamento()
        {
            return view('VistasAdministrador/departamentosPregrado');
        }

        public function regresarAdepartementos()
        {
            return redirect()->route('departamentosPregrado');
        }

        public function gestionCarrerasPregrado(string $departamento)
        {
            $carrerasDePregrado = Carrera::where('tipoCarrera', 'Carrera_Pregrado')->where('departamento', $departamento)->get();

            return view("VistasAdministrador/gestionCarrerasPregrado", [

                'carrerasPregrado' => $carrerasDePregrado,
                'departamento' => $departamento //Se manda el parametro departamento que se recibe por url para poder mostrar el nombre del depto en la vista
            ]);
        }

        public function registrarCarreraPregrado(Request $request)
        {

            $carrera = new Carrera();

            $carrera->tipoCarrera = $request->tipoCarreraPregrado;
            $carrera->carrera = $request->namePregradoCarrera;
            $carrera->codigoCarrera = $request->codigoCarreraPregrado;
            $carrera->departamento = $request->departamentoCarreraPregrado;

            $request->validate([
                'archivoPregradoCarrera' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $archivo = $request->file('archivoPregradoCarrera');
            $ruta = Storage::disk('local')->put('Carreras_PreGrado', $archivo); //---> Se establece la ruta

            $carrera->rutaArchivo = $ruta;
            $carrera->estadoArchivo = true;

            $carrera->save();
            return back()->with("resCarreraPregrado", "Carrera registrada con exito");

        }

        public function eliminarCarreraPregado($id)
        {
            $carrera = Carrera::find($id);

            if (!$carrera) {
                return back()->with('error', 'Carrera no encontrada');
            }
        
            $rutaArchivo = $carrera->rutaArchivo; // se accede al campo ruta del archivo para poder eliminar el pdf del storage también
        
            // Eliminar el archivo utilizando el sistema de archivos de Laravel
            if (Storage::disk('local')->exists($rutaArchivo)) {
                Storage::disk('local')->delete($rutaArchivo);
            }
        
            // Eliminar el registro de la base de datos
            $carrera->delete();
        
            return back()->with('resEliminarCarreraPregrado', 'Carrera eliminada correctamente');
        }

        public function editarCarreraPregrado($id)
        {
            $carrera = Carrera::find($id);

            return view("VistasAdministrador/editarCarreraPregrado", [

                'carreraPregradoEdit' => $carrera
            ]);
        }

        public function eliminarPlanCarreraPregrado($id)
        {
            $carreraEliminar = Carrera::find($id);
            $rutaEliminar = $carreraEliminar->rutaArchivo;

            if (Storage::exists($rutaEliminar)) {
                
                Storage::delete($rutaEliminar);
            }

            // Actualizar el modelo
            $carreraEliminar->rutaArchivo = "-"; // O puedes asignar una cadena vacía: ''
            $carreraEliminar->estadoArchivo = false;
            $carreraEliminar->save();

            return back()->with("resEliminarPdfCarPre", "Archivo eliminado correctamente");

        }
        
        public function subirNuevoPlanCarrPregrado(Request $datos, $id)
        {
            $carreraNewPlan = Carrera::find($id);

            $datos->validate([
                'editNewPlanCarPre' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $archivo = $datos->file('editNewPlanCarPre');
            $ruta = Storage::disk('local')->put('Carreras_PreGrado', $archivo); //---> Se establece la ruta

            $carreraNewPlan->rutaArchivo = $ruta;
            $carreraNewPlan->estadoArchivo = true;

            $carreraNewPlan->save();
            
            return back()->with("resSubirNewPlanCarrPre", "Archivo subido con exito !!");
            
        }

        public function guardarNewDatosCarreraPregrado(Request $nuevosDatos, $id, string $depto)
        {
            $carreNewDatos = Carrera::find($id);

            if ($carreNewDatos->estadoArchivo) {

                $carreNewDatos->carrera = $nuevosDatos->editarNombreCarreraPre;
                $carreNewDatos->codigoCarrera = $nuevosDatos->editarCodigoCarreraPre;
                $carreNewDatos->departamento = $nuevosDatos->editarDeptoCarreraPre;

                $carreNewDatos->save();


                return redirect(route('carrerasPregrado', ['departamento' => $depto]))->with("resUpdateCarrPre", 'Carrera de pregrado actulizada');
            }
            else{

                return back()->with("resSinArchivoCarrePre", 'Tiene que subir un plan de estudios');
            }

        }

        public function verPlanCarreraPregrado($id)
        {
            $plan = Carrera::find($id);
            
            /*
            if (!$plan) {
                return redirect()->route('subirHorarioClases')->with('error', 'Horario académico no encontrado');
            }*/

            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::get($plan->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');

        }

        public function cancelarActulizarCarreraPregrado(string $depto)
        {
            return redirect()->route('carrerasPregrado', ['departamento' => $depto]);
        }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    //----------------------------- FUNCIONES PARA LAS CARRERAS DE POSTGRADO -------------------------------------------------------------------------------------------------------
        
        public function gestionCarrerasPosgrado()
        {
            $carrerasPosgrado = Carrera::where('tipoCarrera', 'Carrera_Posgrado')->get();

            return view("VistasAdministrador/gestionCarrerasPosgrado", [

                'carrerasPosgrado' => $carrerasPosgrado
            ]);
        }

        public function registrarCarreraPosgrado(Request $request)
        {

            $carrera = new Carrera();

            $carrera->tipoCarrera = $request->tipoCarreraPosgrado;
            $carrera->carrera = $request->namePosgradoCarrera;
            $carrera->codigoCarrera = $request->codigoCarreraPosgrado;
            $carrera->departamento = $request->departamentoCarreraPosgrado;

            $request->validate([
                'archivoPosgradoCarrera' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $archivo = $request->file('archivoPosgradoCarrera');
            $ruta = Storage::disk('local')->put('Carreras_PosGrado', $archivo); //---> Se establece la ruta

            $carrera->rutaArchivo = $ruta;
            $carrera->estadoArchivo = true;

            $carrera->save();
            return back()->with("resCarreraPosgrado", "Carrera registrada con exito");

        }

        public function editarCarreraPosgrado($id)
        {
            $carrera = Carrera::find($id);

            return view("VistasAdministrador/editarCarreraPosgrado", [

                'carreraPosgradoEdit' => $carrera
            ]);
        }
        
        public function guardarNewDatosCarreraPosgrado(Request $nuevosDatos, $id)
        {
            $carreNewDatos = Carrera::find($id);

            if ($carreNewDatos->estadoArchivo) {

                $carreNewDatos->carrera = $nuevosDatos->editarNombreCarreraPos;
                $carreNewDatos->codigoCarrera = $nuevosDatos->editarCodigoCarreraPos;
                $carreNewDatos->departamento = $nuevosDatos->editarDeptoCarreraPos;

                $carreNewDatos->save();

                //Se redireige a la vista donde estan todas la carreras de pos grado
                return redirect(route('carrerasPosgrado'))->with("resUpdateCarrPos", 'Carrera de posgrado actulizada');
            }
            else{
                return back()->with("resSinArchivoCarrePos", 'Tiene que subir un plan de estudios');
            }

        }

        public function eliminarPlanCarreraPosgrado($id)
        {
            $carreraEliminar = Carrera::find($id);
            $rutaEliminar = $carreraEliminar->rutaArchivo;

            if (Storage::exists($rutaEliminar)) {
                
                Storage::delete($rutaEliminar);
            }

            // Actualizar el modelo
            $carreraEliminar->rutaArchivo = "-"; // O puedes asignar una cadena vacía: ''
            $carreraEliminar->estadoArchivo = false;
            $carreraEliminar->save();

            return back()->with("resEliminarPdfCarPos", "Archivo eliminado correctamente");

        }

        public function subirNuevoPlanCarrPosgrado(Request $datos, $id)
        {
            $carreraNewPlan = Carrera::find($id);

            $datos->validate([
                'editNewPlanCarPos' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $archivo = $datos->file('editNewPlanCarPos');
            $ruta = Storage::disk('local')->put('Carreras_PosGrado', $archivo); //---> Se establece la ruta

            $carreraNewPlan->rutaArchivo = $ruta;
            $carreraNewPlan->estadoArchivo = true;

            $carreraNewPlan->save();
            
            return back()->with("resSubirNewPlanCarrPos", "Archivo subido con exito !!");
            
        }

        public function verPlanCarreraPosgrado($id)
        {
            $plan = Carrera::find($id);
            
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::get($plan->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');

        }

        public function eliminarCarreraPosgrado($id)
        {
            $carrera = Carrera::find($id);

            if (!$carrera) {
                return back()->with('error', 'Carrera no encontrada');
            }
        
            $rutaArchivo = $carrera->rutaArchivo; // se accede al campo ruta del archivo para poder eliminar el pdf del storage también
        
            // Eliminar el archivo utilizando el sistema de archivos de Laravel
            if (Storage::disk('local')->exists($rutaArchivo)) {
                Storage::disk('local')->delete($rutaArchivo);
            }
        
            // Eliminar el registro de la base de datos
            $carrera->delete();
        
            return back()->with('resEliminarCarreraPosgrado', 'Carrera eliminada correctamente');
        }

        public function cancelarActulizarCarreraPosgrado()
        {
            return redirect(route('carrerasPosgrado'));
            
        }

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    //------------------------------- FUNCIONES PARA LAS CARRERAS TECNICAS ---------------------------------------------------------------------------------------------------------
        
        public function gestionCarrerasTecnicas()
        {
            $carrerasTecnicas = Carrera::where('tipoCarrera', 'Carrera_Tecnica')->get();

            return view("VistasAdministrador/gestionCarrerasTecnicas", [

                'carrerasTecnicas' => $carrerasTecnicas
            ]);
        }

        public function registrarCarreraTecnica(Request $request)
        {

            $carrera = new Carrera();

            $carrera->tipoCarrera = $request->tipoCarreraTecnica;
            $carrera->carrera = $request->nameCarreraTecnica;
            $carrera->codigoCarrera = $request->codigoCarreraTecnica;
            $carrera->departamento = $request->departamentoCarreraTecnica;

            $request->validate([
                'archivoCarreraTecnica' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $archivo = $request->file('archivoCarreraTecnica');
            $ruta = Storage::disk('local')->put('Carreras_Tecnicas', $archivo); //---> Se establece la ruta

            $carrera->rutaArchivo = $ruta;
            $carrera->estadoArchivo = true;

            $carrera->save();
            return back()->with("resCarreraTecnica", "Carrera registrada con exito");

        }

        public function editarCarreraTecnica($id)
        {
            $carrera = Carrera::find($id);

            return view("VistasAdministrador/editarCarreraTecnica", [

                'carreraTecnicaEdit' => $carrera
            ]);
        }

        public function guardarNewDatosCarreraTecnica(Request $nuevosDatos, $id)
        {
            $carreNewDatos = Carrera::find($id);

            if ($carreNewDatos->estadoArchivo) {

                $carreNewDatos->carrera = $nuevosDatos->editarNombreCarreraTecnica;
                $carreNewDatos->codigoCarrera = $nuevosDatos->editarCodigoCarreraTecnica;
                $carreNewDatos->departamento = $nuevosDatos->editarDeptoCarreraTecnica;

                $carreNewDatos->save();

                //Se redireige a la vista donde estan todas la carreras de pos grado
                return redirect(route('carrerasTecnicas'))->with("resUpdateCarrTecnica", 'Carrera tecnica actulizada');
            }
            else{
                return back()->with("resSinArchivoCarreTecnica", 'Tiene que subir un plan de estudios');
            }

        }

        public function eliminarPlanCarreraTecnica($id)
        {
            $carreraEliminar = Carrera::find($id);
            $rutaEliminar = $carreraEliminar->rutaArchivo;

            if (Storage::exists($rutaEliminar)) {
                
                Storage::delete($rutaEliminar);
            }

            // Actualizar el modelo
            $carreraEliminar->rutaArchivo = "-"; // O puedes asignar una cadena vacía: ''
            $carreraEliminar->estadoArchivo = false;
            $carreraEliminar->save();

            return back()->with("resEliminarPdfCarTecnica", "Archivo eliminado correctamente");

        }

        public function subirNuevoPlanCarrTecnica(Request $datos, $id)
        {
            $carreraNewPlan = Carrera::find($id);

            $datos->validate([
                'editNewPlanCarTecnica' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $archivo = $datos->file('editNewPlanCarTecnica');
            $ruta = Storage::disk('local')->put('Carreras_Tecnicas', $archivo); //---> Se establece la ruta

            $carreraNewPlan->rutaArchivo = $ruta;
            $carreraNewPlan->estadoArchivo = true;

            $carreraNewPlan->save();
            
            return back()->with("resSubirNewPlanCarrTecnica", "Archivo subido con exito !!");
            
        }

        public function verPlanCarreraTecnica($id)
        {
            $plan = Carrera::find($id);
            
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::get($plan->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');

        }

        public function eliminarCarreraTecnica($id)
        {
            $carrera = Carrera::find($id);

            if (!$carrera) {
                return back()->with('error', 'Carrera no encontrada');
            }
        
            $rutaArchivo = $carrera->rutaArchivo; // se accede al campo ruta del archivo para poder eliminar el pdf del storage también
        
            // Eliminar el archivo utilizando el sistema de archivos de Laravel
            if (Storage::disk('local')->exists($rutaArchivo)) {
                Storage::disk('local')->delete($rutaArchivo);
            }
        
            // Eliminar el registro de la base de datos
            $carrera->delete();
        
            return back()->with('resEliminarCarreraTecnica', 'Carrera eliminada correctamente');
        }

        public function cancelarActulizarCarreraTecnica()
        {
            return redirect(route('carrerasTecnicas'));
            
        }

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LA GESTION DE LOS CONTACTOS DE LA FACULTADES --------------------------------------------------------------------------------------------------------
        public function filtrarFacultades()
        {
            return view('VistasAdministrador/contactosFacultades');
        }

        public function regresarAcontactosFacu()
        {
            return redirect()->route('filtroContactosFacultades');
        }

    
        public function verDatosFacultad($pertenceFacultad)
        {
            $facultades = Facultad::where('facultad', $pertenceFacultad)->get();
            return view('VistasAdministrador/gestionFacultades', [

                /*
                    El primer parametro contiene todos los resultados de la consulta anterior es decir 
                    los contactos según la facultad

                    El suguendo parametro contiene el nombre de la facultada para que poder ponerlo en la vista 
                    por defecto cuando se vaya a registrar la oficina o infraescrito de una facultad
                */
                'facultad' => $facultades,
                'facultadPertenece' => $pertenceFacultad
            ]);
        }


        public function insertarFacultades(Request $request)
        {
            $contFacultad = new Facultad(); // Se crea una nueva instacia
            
            $contFacultad->facultad = $request->facultadOrigen;
            $contFacultad->oficina = $request->nombreOficina;
            $contFacultad->correo = $request->correoOficina;
            $contFacultad->contacto = $request->contactoOficina;

            $contFacultad->save();
            return back()->with('respuestaFacultadCrear', 'Facultad creada correctamente');

        }

        public function eliminarFacultad($id)
        {
            $facultad = Facultad::find($id);

            if (!$facultad) {
                // Manejar el caso donde el usuario no existe
                return back()->with('errorFacultad', 'Facultad no encontrado');
            }

            $facultad->delete();
            return back()->with('facultadEliminarRespuesta', 'Facultad eliminado correctamente');
        }

        public function editarDatosFacultad(Request $request, $id){
            
            $facultad = Facultad::find($id);

            if (!$facultad) {
                // Manejar el caso donde el usuario no existe
                return back()->with('errorFacultad', 'Facultad no encontrado');
            }

            $facultad->facultad = $request->editarNombreFacultad;
            $facultad->correo = $request->editarCorreoFacultad;
            $facultad->contacto = $request->editarNumeroFacultad;


            $facultad->save();
            return back()->with('respuestaEditarFacultad', 'Facultad actualizada correctamente');
        }



    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //------------------------------ FUNCIONES PARA LA GESTION DE ANUNCIOS -----------------------------------------------------------------------------------------------------------
    
        public function verAnuncios()
        {
            $listaAnuncios = Anuncios::all();
            return view('VistasAdministrador/gestionAnunciosAcademicos', ['anuncios' => $listaAnuncios]);
        }

        public function vistaCrarAnuncio(){

            return view('VistasAdministrador/crearAnuncioAcademico');
        }

        public function crearAnuncio(Request $datosAnucio)
        {
            $anuncio = new Anuncios();

            $anuncio->titulo = $datosAnucio->tituloAnuncio;
            $anuncio->fechaExpiracion = $datosAnucio->fechaExpiracionAnuncio;

            $datosAnucio->validate([
                'archivoAnuncio' => 'file|nullable',
            ]);
            
            if ($datosAnucio->hasFile('archivoAnuncio')) {

                $archivo = $datosAnucio->file('archivoAnuncio');
                $ruta = Storage::disk('local')->put('Archivos_Anunucios', $archivo);

                $anuncio->rutaArchivo = $ruta;
            } 
            $anuncio->cuerpo = $datosAnucio->cuerpoAnuncio;
            
            //Obtener la fecha actual
            $fechaActual = date('Y-m-d');
            $anuncio->fechaPublicacion = $fechaActual;

            $anuncio->save();
            return redirect()->route('gestionAnuncios')->with('resCrearAnuncio', 'Anuncio creado correctamente');
            
        }


        public function eliminarAnucio($id)
        {
            $anuncio = Anuncios::find($id);
            
            if (!$anuncio) {

                return back()->with('anucioEncontrado', 'Anuncio no encontrada');
            }
        
            $rutaArchivo = $anuncio->rutaArchivo; // se accede al campo ruta del archivo para poder eliminar el pdf del storage también
        
            if ($rutaArchivo !== null) {
    
                if (Storage::disk('local')->exists($rutaArchivo)) {
                    Storage::disk('local')->delete($rutaArchivo);
                }
            }
        
            // Eliminar el registro de la base de datos
            $anuncio->delete();
        
            return back()->with('resEliminarAnuncio', 'Anuncio eliminado correctamente');
        }
    
        public function editarAnuncio($id)
        {
            $anuncio = Anuncios::find($id);
            if (!$anuncio) {

                return back()->with('anucioEncontrado', 'Anuncio no encontrada');
            }

            return view('VistasAdministrador/editarAnuncioAcademico', [

                'anuncioEditar' => $anuncio
            ]);


        }

        public function guardarNuevosDatosAnuncios(Request $newDatosAnuncio, $id)
        {
            $anuncio = Anuncios::find($id);
            if (!$anuncio) {

                return back()->with('anucioEncontrado', 'Anuncio no encontrada');
            }

            $anuncio->titulo = $newDatosAnuncio->editarTituloAnuncio;
            $anuncio->fechaExpiracion = $newDatosAnuncio->editarFechaExpiracion;
            $anuncio->cuerpo = $newDatosAnuncio->editarCuerpoAnuncio;

            $anuncio->save();
            return redirect()->route('gestionAnuncios')->with('resEditarAnuncio', 'El anuncio se ha editado correctamente');
        }

        public function subirNuevoArchivoAnuncio(Request $nuevoArchivo, $id)
        {
            $newArchivo = Anuncios::find($id);

            if (!$newArchivo) {

                return back()->with('anucioEncontrado', 'Anuncio no encontrada');
            }

            $nuevoArchivo->validate([
                'editarArchivoAnuncio' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

    
            $archivo = $nuevoArchivo->file('editarArchivoAnuncio');
            $ruta = Storage::disk('local')->put('Archivos_Anunucios', $archivo); //---> Se establece la ruta

            $newArchivo->rutaArchivo = $ruta;

            $newArchivo->save();
            
            return back()->with("resSubirArchivoAnuncio", "Archivo subido con exito !!");
        }

        public function eliminarArchivoAnuncio($id)
        {
            $anuncio = Anuncios::find($id);
            if (!$anuncio) {

                return back()->with('anucioEncontrado', 'Anuncio no encontrada');
            }

            $rutaArchivoEliminar = $anuncio->rutaArchivo; // se accede al campo ruta del archivo para poder eliminar el pdf del storage también
        
            // Eliminar el archivo utilizando el sistema de archivos de Laravel
            if (Storage::disk('local')->exists($rutaArchivoEliminar)) {
                Storage::disk('local')->delete($rutaArchivoEliminar);
            }

            $anuncio->rutaArchivo = null;
            $anuncio->save();
        
            return back()->with('resEliminarArchivoAnuncio', 'Archivo del anuncio eliminado correctamente');
        }

        public function verArchivoAnuncios($id)
        {
            $archivo = Anuncios::find($id);

            // Obtener la extensión del archivo
            $extension = pathinfo($archivo->rutaArchivo, PATHINFO_EXTENSION);

            // Se accede al storage de Laravel para obtener el contenido del archivo
            $contenidoArchivo = Storage::get($archivo->rutaArchivo);

            // Verificar si la extensión es de un PDF
            if (strtolower($extension) === 'pdf') {
                // Devolver la respuesta con el contenido del archivo como PDF
                return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
                
            } elseif (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) {
                // Si es una imagen, devolver la respuesta con el contenido de la imagen
                return response($contenidoArchivo, 200)->header('Content-Type', 'image/' . $extension);
            } else {
                // Si no es ni PDF ni imagen, puedes manejarlo según tus necesidades
                return response()->json(['error' => 'El archivo no es un PDF o una imagen'], 400);
            }

        }

        public function cancelarEditarAnuncio()
        {
            return redirect()->route('gestionAnuncios');
        }

        public function cancelarCrearAnuncio()
        {
            return redirect()->route('gestionAnuncios');
        }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LA GESTION DE HORARIO DE ATENCION ------------------------------------------------------------------------------------
        public function verHorarioAtencion()
        {
            $horarioA = AtencionHorario::all();
            return view('VistasAdministrador/gestionHorario', ['horarioAtencion' => $horarioA]);
        }

        public function guardarHorarioAtencion(Request $datosAtencionHorario)
        {
            /*
                En Este caso se usan dos objetos de la misma clase para asignar el horario de los dias 
                normales de atencion y el dia sabado si se quiere registrar. En todo caso el sabado por lo
                general se trabaja hasta medio dia, por eso de seja un valor por defecto al campo 
                En todo casi habrá solo dos registro en la tabla de horario de atencion
            */

            $horarioDiasNormal = new AtencionHorario();
            $horarioOtroDia = new AtencionHorario();

            $horarioDiasNormal->diasLaborales = $datosAtencionHorario->diasNormalAtencion;
            $horarioDiasNormal->horaInicio = $datosAtencionHorario->normalHoraInicio;
            $horarioDiasNormal->horaCierre = $datosAtencionHorario->normalHoraCierre;
            $horarioDiasNormal->estadoMedioDia = $datosAtencionHorario->estadoMediodia;

            $horarioOtroDia->diasLaborales = $datosAtencionHorario->otroDiaAtencion;
            $horarioOtroDia->horaInicio = $datosAtencionHorario->otroDiaHoraInicio;
            $horarioOtroDia->horaCierre = $datosAtencionHorario->otroDiaHoraCierre;
            $horarioOtroDia->estadoMedioDia = 'No Asignado';

            $horarioDiasNormal->save();
            $horarioOtroDia->save();

            return back()->with('resHorarioAtencion', 'El horario de atencion se ha registrado con éxito');

        }

        public function eliminarHorarioAtencion()
        {
            try {
                AtencionHorario::truncate();
                return back()->with('resEliminarHorarioAtencion', 'Se ha eliminado con exito');

            } catch (\Exception $e) {
                return back()->with('horarioNoEncontrado', 'Horario no encontrado');
            }
            
        }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    //---------------------------------- FUNCIONES PARA LOS TRAMITES ACADEMICOS --------------------------------------------------------------------------------------------------------
        public function mostrarTramites(){

            $tramites = Tramite::all();

            return view('VistasAdministrador/gestionTramitesAcademicos', [

                'datosTramites' => $tramites
            ]);
            
        }

        public function guardarTramite(Request $datosTramite)
        {
            $nuevoTramite = new Tramite();

            $nuevoTramite->tramite = $datosTramite->tituloTramite;
            $nuevoTramite->contenido = $datosTramite->contenidoTramite;

            $datosTramite->validate([
                'archivoTramite' => 'file|nullable',
            ]);
            
            if ($datosTramite->hasFile('archivoTramite')) {

                $archivo = $datosTramite->file('archivoTramite');
                $ruta = Storage::disk('local')->put('Archivos_TramitesAcademicos', $archivo);

                $nuevoTramite->rutaFormato = $ruta;
            } 

            $nuevoTramite->save();

            return redirect()->route('verTramitesAcademicos')->with('resCrearTramite', 'Tramite creado con exito');

        }

        public function eliminarTramite($id)
        {
            $tramiteEliminar = Tramite::find($id);

            if (!$tramiteEliminar) {
                
                return back()->with('tramiteNoEncontrado', 'Tramite no encontrado !!');
            }

            $rutaEliminar = $tramiteEliminar->rutaFormato;

            //Se verifica que la ruta no sea null antes de elimanr el tramite para que no de error el server
            if ($rutaEliminar !== null ) {
                
                if (Storage::disk('local')->exists($rutaEliminar)) {
                    Storage::disk('local')->delete($rutaEliminar);
                }
            }

            $tramiteEliminar->delete();

            return back()->with('resEliminarTramite', 'El tramite se ha eliminado correctamente');
            
        }

        public function vistaEditarTramite($id)
        {
            $tramiteEditar = Tramite::find($id);

            if (!$tramiteEditar) {
                
                return back()->with('tramiteNoEncontrado', 'Tramite no encontrado !!');
            }

            return view('VistasAdministrador/editarTramite', [

                'datosTramiteEditar' => $tramiteEditar
            ]);

        }
        
        public function editarTramiteAcademico(Request $newDatosTramite, $id){

            $tramiteEditarDatos = Tramite::find($id);

            if (!$tramiteEditarDatos) {
                return back()->with('tramiteNoEncontrado', 'Tramite no encontrado !!');
            }

            $tramiteEditarDatos->tramite = $newDatosTramite->editarTramite;
            $tramiteEditarDatos->contenido = $newDatosTramite->editarContenidoTramite;

            $tramiteEditarDatos->save();

            return redirect()->route('verTramitesAcademicos')->with('resEditarTramite', 'Se ha editado el tramite correctamente');

        }

        public function subirNuevoFormatoTramite(Request $newTramiteArchivo, $id)
        {
            $nuevoArchivoTramite = Tramite::find($id);

            $archivo = $newTramiteArchivo->file('editarNuevoFormatoTramite');
            $ruta = Storage::disk('local')->put('Archivos_TramitesAcademicos', $archivo); //---> Se establece la ruta
            $nuevoArchivoTramite->rutaFormato = $ruta;
            $nuevoArchivoTramite->save();

            return back()->with('resSubirArchivoTramite', 'Formato subido con exito !!');

        }

        public function eliminarFormatoTramite($id)
        {
            $archivoTramiteEliminar = Tramite::find($id);
            $rutaEliminar = $archivoTramiteEliminar->rutaFormato;

            if (Storage::disk('local')->exists($rutaEliminar)) {

                Storage::disk('local')->delete($rutaEliminar);
            }

            $archivoTramiteEliminar->rutaFormato = null;
            $archivoTramiteEliminar->save();

            return back()->with('resEliminarArchivoTramite', 'Se ha eliminado el formato con exito');

        }

        public function verArchivoTramite($id)
        {
            $archivo = Tramite::find($id);

            // Obtener la extensión del archivo
            $extension = pathinfo($archivo->rutaFormato, PATHINFO_EXTENSION);
            $contenidoArchivo = Storage::get($archivo->rutaFormato);

            // Verificar si la extensión es de un PDF
            if (strtolower($extension) === 'pdf') {
                // Devolver la respuesta con el contenido del archivo como PDF
                return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
                
            } elseif (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) {
                // Si es una imagen, devolver la respuesta con el contenido de la imagen
                return response($contenidoArchivo, 200)->header('Content-Type', 'image/' . $extension);
            } else {
                // Si no es ni PDF ni imagen, puedes manejarlo según tus necesidades
                return response()->json(['error' => 'El archivo no es un PDF o una imagen'], 400);
            }

        }

        public function descargarFormatoTramite($id)
        {
            //Esta funcion es por el echo de que no se puede ver el archivo word en el navegador
            // Para ello y sabe rque se ha subido tendra que descargar el archivo y veridicarlo su maquina 

            $tramite = Tramite::find($id);

            if (!$tramite) {
                abort(404); // Manejar el caso en el que no se encuentre el tramite
            }
        
            // Verificar que la ruta del formato existe y tiene la extensión correcta
            $extension = strtolower(pathinfo($tramite->rutaFormato, PATHINFO_EXTENSION));
            if (!in_array($extension, ['doc', 'docx'])) {
                abort(400, 'El archivo no es un documento de Word.');
            }
        
            // Obtener el contenido del archivo
            $contenidoArchivo = Storage::get($tramite->rutaFormato);
        
            // Devolver la respuesta para descargar el archivo
            return response()->download(storage_path('app/' . $tramite->rutaFormato), 'formatoSubido.docx');
        }

    //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //---------------------------------- FUNCIONES PARA LAS PREGUNTAS FRECUENTES ------------------------------------------------------------------------------------------------------

        public function mostrarPreguntas(){

            $preguntas = PreguntaFrecuente::all();

            return view('VistasAdministrador/gestionPreguntasFrecuentes', [

                'preguntasFrecuentes' => $preguntas
            ]);
            
        }

        public function guardarPregunta(Request $pregunta)
        {
            $nuevaPregunta = new PreguntaFrecuente();

            $nuevaPregunta->pregunta = $pregunta->tituloPregunta;
            $nuevaPregunta->respuesta = $pregunta->respuestaPreguntaFrecuente;

            $nuevaPregunta->save();

            return redirect()->route('verPreguntasFrecuentes')->with('resCrearPregunta', 'Se ha agregado la pregunta correctamente');

        }

        public function eliminarPregunta($id)
        {
            $eliminarPregunta = PreguntaFrecuente::find($id);

            if (!$eliminarPregunta) {
                
                return back()->with('preguntaNoEncontrada', 'Pregunta no encontrada');
            }

        
            $eliminarPregunta->delete();

            return back()->with('resEliminarPregunta', 'La pregunta se ha eliminado correctamente');
            
        }

        public function vistaEditarPregunta($id)
        {
            $editarPregunta = PreguntaFrecuente::find($id);

            if (!$editarPregunta) {
                
                return back()->with('preguntaNoEncontrada', 'Pregunta no encontrada');
            }

            return view('VistasAdministrador/editarPregunta', [

                'datosEditarPregunta' => $editarPregunta
            ]);

        }
        
        public function editarPreguntaFrecuente(Request $nuevosDatosPregunta, $id){

            $pregunta = PreguntaFrecuente::find($id);

            if (!$pregunta) {
                return back()->with('tramiteNoEncontrado', 'Tramite no encontrado !!');
            }

            $pregunta->pregunta = $nuevosDatosPregunta->editarPregunta;
            $pregunta->respuesta = $nuevosDatosPregunta->editarRespuestaPregunta;

            $pregunta->save();

            return redirect()->route('verPreguntasFrecuentes')->with('resEditarPregunta', 'Se ha editado la pregunta correctamente');

        }

        public function cancelarPregunta()
        {
            return redirect()->route('verPreguntasFrecuentes');
        }
    //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LA GESTION DE CONSTANCIAS --------------------------------------------------------------------------------------------------------
        public function verInformeConstancias()
        {
            return view('VistasAdministrador/gestionConstancias');
        }


        public function vistaCrearConstancia()
        {
            return view('VistasAdministrador/registrarConstancia');
        }

        public function guardarConstancias(Request $datosConstancias)
        {
            $datosSeleccionados = $datosConstancias->input('checkboxDatos');

            $fechaActual = date('Y-m-d');

            // Verificar si hay datos seleccionados
            if (!empty($datosSeleccionados)) {

                foreach ($datosSeleccionados as $dato) {
                    // Crear un nuevo objeto Constancias y asignar el valor del checkbox
                    $constancia = new Constancias();
                    $constancia->tipoConstancia = $dato;  // Asigna el valor que corresponde a tu modelo
                    $constancia->fechaRegistro = $fechaActual;

                    // Guardar el nuevo registro en la base de datos
                    $constancia->save();
                }

                return back()->with('resGuardarConstancias', 'Las constancias se han guradado correctamente');
                
            } else {
                
                return back()->with('resNoGuardarConstancias', 'Las constancias no se registraron');
            }
        }

        public function totalConstancias(Request $fechasFiltro){


            // Obtén los totales agrupados por tipo de constancia, filtrando por rango de fechas
            $totalesPorTipo = Constancias::select('tipoConstancia', DB::raw('count(*) as total'))
            ->whereBetween('fechaRegistro', [$fechasFiltro->fechaInicialConstancia, $fechasFiltro->fechaFinalConstancia])
            ->groupBy('tipoConstancia')
            ->get();

            // Calcula el total general
            $totalGeneralConstancias = $totalesPorTipo->sum('total');

            return view('VistasAdministrador/estadisticasConstancias', [
                'totalConstancias' => $totalesPorTipo,
                'fechaInicial' => $fechasFiltro->fechaInicialConstancia,
                'fechaFinal' => $fechasFiltro->fechaFinalConstancia,
                'totalGeneral' => $totalGeneralConstancias
            ]);

        }

    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LA GESTION DE LA GALERIA ----------------------------------------------------------------------------------------------------------
        public function verGaleria()
        {
            $galeria = Galeria::all();
            return view('VistasAdministrador/gestionGaleriaInstitucional', ['galeriaFotos' => $galeria]);
        }

        public function guardarFotoGaleria(Request $datosGaleria)
        {
            $nuevaFoto = new Galeria();

            $nuevaFoto->nombreFoto = $datosGaleria->nombreGaleria;
            $nuevaFoto->fechaPublicacion = Carbon::now()->toDateString();

            $datosGaleria->validate([
                'fotoGaleria' => 'file|nullable',
            ]);
            
            if ($datosGaleria->hasFile('fotoGaleria')) {

                $archivo = $datosGaleria->file('fotoGaleria');
                $ruta = Storage::disk('local')->put('Galeria', $archivo);

                $nuevaFoto->rutaArchivo = $ruta;
            } 

            $nuevaFoto->save();

            return back()->with('resCrarGaleria', 'Foto publicada con exito !!');

        }

        public function eliminarFotoGaleria($id)
        {
            $fotoEliminar = Galeria::find($id);
            
            if (!$fotoEliminar) {

                return back()->with('fotoNoEncontrada', 'Foto no encontrada');
            }
        
            $rutaArchivo = $fotoEliminar->rutaArchivo; // se accede al campo ruta del archivo para poder eliminar el pdf del storage también
        
            if ($rutaArchivo !== null) {
    
                if (Storage::disk('local')->exists($rutaArchivo)) {

                    Storage::disk('local')->delete($rutaArchivo);
                }
            }
        
            // Eliminar el registro de la base de datos
            $fotoEliminar->delete();
        
            return back()->with('resEliminarFotoGaleria', 'Foto eliminada correctamente');
        }

        public function verFotoGaleria($id)
        {
            $verFotoGaleria = Galeria::find($id);

            // Obtener la extensión del archivo
            $extension = pathinfo($verFotoGaleria->rutaArchivo, PATHINFO_EXTENSION);

            // Se accede al storage de Laravel para obtener el contenido del archivo
            $contenidoArchivo = Storage::get($verFotoGaleria->rutaArchivo);

            if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) {
                
                return response($contenidoArchivo, 200)->header('Content-Type', 'image/' . $extension);
    
            }
            else {
                return response()->json(['error' => 'El archivo no tiene un formato admitido'], 400);
            }

        }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

}
