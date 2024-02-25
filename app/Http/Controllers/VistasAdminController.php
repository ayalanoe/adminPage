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
use App\Models\HorarioAtencion;
use Illuminate\Support\Facades\Storage;



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
        
        public function gestionCarrerasPregrado(string $departamento)
        {
            $carrerasDePregrado = Carrera::where('tipoCarrera', 'Carrera_Pregrado')->where('departamento', $departamento)->get();

            return view("VistasAdministrador/gestionCarrerasPregrado", [

                'carrerasPregrado' => $carrerasDePregrado
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

    //----------------------------------------- FILTRO POR DEPARTAMENTO PARA LA GESTION DE CARRERAS --------------------------------------------------------------------------------
        public function filtrarDepartamento()
        {
            return view('VistasAdministrador/departamentosPregrado');
        }

        public function regresarAdepartementos()
        {
            return redirect()->route('departamentosPregrado');
        }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LA GESTION DE FACULTADES ------------------------------------------------------------------------------------
        public function verDatosFacultad()
        {
            $facultades = Facultad::all();
            return view('VistasAdministrador/gestionFacultades', ['facultad' => $facultades]);
        }


        public function insertarFacultades(Request $request)
        {
            $contFacultad = new Facultad(); // Se crea una nueva instacia
            
            $contFacultad->facultad = $request->nombreFacultad;
            $contFacultad->correo = $request->correoFacultad;
            $contFacultad->contacto = $request->numeroFacultad;

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

    //----------------------------- FUNCIONES PARA LA GESTION DE LA GALERIA ------------------------------------------------------------------------------------
       
        public function verGaleria()
        {
            $galeria = Galeria::all();
            return view('VistasAdministrador/gestionGaleria', ['directorio' => $galeria]);
        }


            //----------------------------- FUNCIONES PARA LA GESTION DE ANUNCIOS ------------------------------------------------------------------------------------
            public function verAnuncios()
            {
                $anuncios = Anuncios::all();
                return view('VistasAdministrador/gestionAnuncios', ['directorio' => $anuncios]);
            }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LA GESTION DE ANUNCIOS ------------------------------------------------------------------------------------
    public function verHorarioAtencion()
    {
        $horarioA = HorarioAtencion::all();
        return view('VistasAdministrador/gestionHorario', ['directorio' => $horarioA]);
    }
}
