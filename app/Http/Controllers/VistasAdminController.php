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
use App\Models\CarreraDistancia;
use App\Models\PreguntaFrecuente;
use App\Models\Tramite;
use App\Models\Constancias;
use App\Models\NuevoIngreso;
use Carbon\Carbon;
use Exception;
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
            Storage::disk('public')->delete($archivo->rutaArchivo);
            return back()->with('resEliminarCalendarioAcademico', 'Horario eliminado correctamente');
            
        }

        public function verHorarioClases($id){
            

            $horarioClase = CalendarioClase::find($id);

            if (!$horarioClase) {
                return redirect()->route('subirHorarioClases')->with('error', 'Horario académico no encontrado');
            }

            // Puedes usar el facade Storage para obtener el contenido del archivo
            $contenidoArchivo = Storage::disk('public')->get($horarioClase->rutaArchivo);

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
            $ruta = Storage::disk('public')->put('calendarioAcademico', $archivo); //---> Se establece la ruta

            
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
            $ruta = Storage::disk('public')->put('Calendario_Administrativo', $archivo); //---> Se establece la ruta

            
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

            Storage::disk('public')->delete($archivo->rutaArchivo);

            return back()->with('resEliminarCalAdmin', 'Calendario administrativo eliminado correctamente');
            
        }



        public function verCalAdmin($id){
            

            $calAdmin = CalendarioAdministrativo::find($id);

            if (!$calAdmin) {
                return redirect()->route('subirHorarioClases')->with('error', 'Horario académico no encontrado');
            }

            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($calAdmin->rutaArchivo);

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
                'archivoPregradoCarrera' => 'required|mimes:pdf|max:2048',
            ]);

            $archivo = $request->file('archivoPregradoCarrera');
            $ruta = Storage::disk('public')->put('Carreras_PreGrado', $archivo); //---> Se establece la ruta

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
            if (Storage::disk('public')->exists($rutaArchivo)) {
                Storage::disk('public')->delete($rutaArchivo);
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

            if (Storage::disk('public')->exists($rutaEliminar)) {
                
                Storage::disk('public')->delete($rutaEliminar);
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
                'editNewPlanCarPre' => 'required|mimes:pdf',
            ]);

            $archivo = $datos->file('editNewPlanCarPre');
            $ruta = Storage::disk('public')->put('Carreras_PreGrado', $archivo); //---> Se establece la ruta

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
            
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($plan->rutaArchivo);

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
            $ruta = Storage::disk('public')->put('Carreras_PosGrado', $archivo); //---> Se establece la ruta

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

            if (Storage::disk('public')->exists($rutaEliminar)) {
                
                Storage::disk('public')->delete($rutaEliminar);
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
            $ruta = Storage::disk('public')->put('Carreras_PosGrado', $archivo); //---> Se establece la ruta

            $carreraNewPlan->rutaArchivo = $ruta;
            $carreraNewPlan->estadoArchivo = true;

            $carreraNewPlan->save();
            
            return back()->with("resSubirNewPlanCarrPos", "Archivo subido con exito !!");
            
        }

        public function verPlanCarreraPosgrado($id)
        {
            $plan = Carrera::find($id);
            
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($plan->rutaArchivo);

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
            if (Storage::disk('public')->exists($rutaArchivo)) {
                Storage::disk('public')->delete($rutaArchivo);
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
    
    //------------------------------ FUNCIONES PARA LOS DIPLOMADOS ----------------------------------------------------------------------------------------------------------------
    
        public function gestionDiplomados()
        {
            $listaDiplomados = Carrera::where('tipoCarrera', 'Diplomado')->get();

            return view("VistasAdministrador/gestionDiplomados", [

                'listadoDiplomados' => $listaDiplomados
            ]);
        }

        public function registrarDiplomado(Request $request)
        {

            $diplomado = new Carrera();

            $diplomado->tipoCarrera = $request->tipoCarreraDiplomado;
            $diplomado->carrera = $request->nombreDiplomado;
            $diplomado->codigoCarrera = $request->codigoDiplomado;
            $diplomado->departamento = $request->deptoDiplomado;

            $request->validate([
                'archivoDiplomado' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $archivo = $request->file('archivoDiplomado');
            $ruta = Storage::disk('public')->put('Diplomados', $archivo); //---> Se establece la ruta

            $diplomado->rutaArchivo = $ruta;
            $diplomado->estadoArchivo = true;

            $diplomado->save();
            return back()->with("resDiplomado", "Diplomado registrado con exito");

        }

        public function eliminarDiplomado($id)
        {
            $diplomadoEliminar = Carrera::find($id);
            $rutaEliminar = $diplomadoEliminar->rutaArchivo;

            if (Storage::disk('public')->exists($rutaEliminar)) {
                
                Storage::disk('public')->delete($rutaEliminar);
            }

            $diplomadoEliminar->delete();

            return back()->with("resDelDiplomado", "Diplomado eliminado correctamente");

        }

        public function vistaEditDiplomado($id)
        {
            $diplomadoEdit = Carrera::find($id);

            return view("VistasAdministrador/editarDiplomado", [

                'diplomadoEditar' => $diplomadoEdit
            ]);
        }

        public function guardarNewDatosDiploomado(Request $newDataDiplomado, $id)
        {
            $diplomadoEdit = Carrera::find($id);

            $diplomadoEdit->carrera = $newDataDiplomado->editDiploNombre;
            $diplomadoEdit->codigoCarrera = $newDataDiplomado->editDiploCodigo;
            $diplomadoEdit->departamento = $newDataDiplomado->editDiploDepto;

            $diplomadoEdit->save();

            //Se redireige a la vista donde estan todas la carreras de pos grado
            return redirect(route('verListaDiplomados'))->with("resEditDiplomado", 'Diplomado actualizado con exito');
            

        }

        public function verPdfDiplomados($id)
        {
            $pdfDiplomado = Carrera::find($id);

            // Se accede al storage de laravel para mostrar el archivo
            $contenidoPdf = Storage::disk('public')->get($pdfDiplomado->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoPdf, 200)->header('Content-Type', 'application/pdf');

        }
        
        
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

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
            $ruta = Storage::disk('public')->put('Carreras_Tecnicas', $archivo); //---> Se establece la ruta

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

            if (Storage::disk('public')->exists($rutaEliminar)) {
                
                Storage::disk('public')->delete($rutaEliminar);
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
            $ruta = Storage::disk('public')->put('Carreras_Tecnicas', $archivo); //---> Se establece la ruta

            $carreraNewPlan->rutaArchivo = $ruta;
            $carreraNewPlan->estadoArchivo = true;

            $carreraNewPlan->save();
            
            return back()->with("resSubirNewPlanCarrTecnica", "Archivo subido con exito !!");
            
        }

        public function verPlanCarreraTecnica($id)
        {
            $plan = Carrera::find($id);
            
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($plan->rutaArchivo);

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
            if (Storage::disk('public')->exists($rutaArchivo)) {
                Storage::disk('public')->delete($rutaArchivo);
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

            $facultad->oficina = $request->editarNombreFacultad;
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
            $fechaActual = now();

            // Filtrar los anuncios cuya fecha de expiración ha pasado
            $anunciosExpirados = $listaAnuncios->filter(function ($anuncio) use ($fechaActual) {
                return $anuncio->fechaExpiracion < $fechaActual;
            });

            // Eliminar los anuncios expirados
            foreach ($anunciosExpirados as $anuncioEliminar) {

                if ($anuncioEliminar->rutaArchivo !== null) {
    
                    if (Storage::disk('public')->exists($anuncioEliminar->rutaArchivo)) {
                        Storage::disk('public')->delete($anuncioEliminar->rutaArchivo);
                    }
                }

                $anuncioEliminar->delete();
            }

            // Volver a cargar la lista de anuncios para reflejar los cambios
            $listaAnuncios = Anuncios::all();

            // Retornar la vista con la lista actualizada de anuncios
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
                $ruta = Storage::disk('public')->put('Archivos_Anunucios', $archivo);

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
    
                if (Storage::disk('public')->exists($rutaArchivo)) {
                    Storage::disk('public')->delete($rutaArchivo);
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
            $ruta = Storage::disk('public')->put('Archivos_Anunucios', $archivo); //---> Se establece la ruta

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
            if (Storage::disk('public')->exists($rutaArchivoEliminar)) {
                Storage::disk('public')->delete($rutaArchivoEliminar);
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
            $contenidoArchivo = Storage::disk('public')->get($archivo->rutaArchivo);

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
        public function mostrarTramites()
        {

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
                $ruta = Storage::disk('public')->put('Archivos_TramitesAcademicos', $archivo);

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
                
                if (Storage::disk('public')->exists($rutaEliminar)) {
                    Storage::disk('public')->delete($rutaEliminar);
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
            $ruta = Storage::disk('public')->put('Archivos_TramitesAcademicos', $archivo); //---> Se establece la ruta
            $nuevoArchivoTramite->rutaFormato = $ruta;
            $nuevoArchivoTramite->save();

            return back()->with('resSubirArchivoTramite', 'Formato subido con exito !!');

        }

        public function eliminarFormatoTramite($id)
        {
            $archivoTramiteEliminar = Tramite::find($id);
            $rutaEliminar = $archivoTramiteEliminar->rutaFormato;

            if (Storage::disk('public')->exists($rutaEliminar)) {

                Storage::disk('public')->delete($rutaEliminar);
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
            $contenidoArchivo = Storage::disk('public')->get($archivo->rutaFormato);

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
            $contenidoArchivo = Storage::disk('public')->get($tramite->rutaFormato);
        
            // Devolver la respuesta para descargar el archivo
            return response()->download(storage_path('app/public/' . $tramite->rutaFormato), 'formatoTramite.docx');
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
                $ruta = Storage::disk('public')->put('Galeria', $archivo);

                $nuevaFoto->rutaArchivo = $ruta;

                $nuevaFoto->save();

                return back()->with('resCrarGaleria', 'Foto publicada con exito !!');
            } 
            else {
                #Colocar un mensaje si no se completa la accion
                #Borrar estos comentarios cuandon se ponga el mensaje correspondienrte
            }

            

        }

        public function eliminarFotoGaleria($id)
        {
            $fotoEliminar = Galeria::find($id);
            
            if (!$fotoEliminar) {

                return back()->with('fotoNoEncontrada', 'Foto no encontrada');
            }
        
            $rutaArchivo = $fotoEliminar->rutaArchivo; // se accede al campo ruta del archivo para poder eliminar el pdf del storage también
        
            if ($rutaArchivo !== null) {
    
                if (Storage::disk('public')->exists($rutaArchivo)) {

                    Storage::disk('public')->delete($rutaArchivo);
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
            $contenidoArchivo = Storage::disk('public')->get($verFotoGaleria->rutaArchivo);

            if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) {
                
                return response($contenidoArchivo, 200)->header('Content-Type', 'image/' . $extension);
    
            }
            else {
                return response()->json(['error' => 'El archivo no tiene un formato admitido'], 400);
            }

        }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //---------------------------------- FUNCIONES PARA LAS CARRERAS A DISTANCIA --------------------------------------------------------------------------------------------------------
        public function mostrarCarrerasDistancia()
        {
            $carrerasDistancia = CarreraDistancia::where('facultad', 'OTRA_FACULTAD')->get();

            return view('VistasAdministrador/gestionEducacionDistancia', [

                'educacionDistancia' => $carrerasDistancia
            ]);
            
        }

        public function guardarCarreraDistancia(Request $datosCarDistancia)
        {
            $carDistancia = new CarreraDistancia();

            $carDistancia->carrera = $datosCarDistancia->nombreCarDistancia;
            $carDistancia->facultad = "OTRA_FACULTAD";

            $banner = $datosCarDistancia->file('bannerCarDistancia');
            $planPdf = $datosCarDistancia->file('planCarDistancia');

            $bannerRuta = Storage::disk('public')->put('CarrerasDistancia', $banner);
            $planRuta = Storage::disk('public')->put('CarrerasDistancia', $planPdf);

            $carDistancia->rutaBanner = $bannerRuta;
            $carDistancia->rutaArchivo = $planRuta;

            $carDistancia->save();
            return back()->with('resGuardarCarDistancia', 'Carrera registrada con exito !!');

        }

        public function eliminarCarDistancia($id)
        {
            $carDistanciaEliminar = CarreraDistancia::find($id);

            if (!$carDistanciaEliminar) {

                return back()->with('carDisNoEncontrada', 'Carrera a distancia no encontrada');
            }

            $rutaPdfCarDistancia = $carDistanciaEliminar->rutaArchivo; // se accede al campo ruta del archivo para poder eliminar el pdf del storage también
            $rutaBannerCarDistancia = $carDistanciaEliminar->rutaBanner;
        
            if ($rutaPdfCarDistancia !== null ) {
    
                if (Storage::disk('public')->exists($rutaPdfCarDistancia)) {
                    Storage::disk('public')->delete($rutaPdfCarDistancia);
                }
            }

            if ($rutaBannerCarDistancia !== null ) {

                if (Storage::disk('public')->exists($rutaBannerCarDistancia)) {
                    Storage::disk('public')->delete($rutaBannerCarDistancia);
                }
            }

            $carDistanciaEliminar->delete();

            return back()->with('resEliminarCarDistancia', 'Se ha elimando la carrera a distancia');

        }


        public function vistaEditarCarDistrancia($id)
        {
            $carrera = CarreraDistancia::find($id);

            return view("VistasAdministrador/editarCarDistancia", [

                'carreraDisEdiar' => $carrera
            ]);
        }


        public function eliminarPdfCarDistancia($id)
        {
            $carDisPdfEliminar = CarreraDistancia::find($id);

            if ($carDisPdfEliminar->rutaArchivo !== null ) {
    
                if (Storage::disk('public')->exists($carDisPdfEliminar->rutaArchivo)) {
                    Storage::disk('public')->delete($carDisPdfEliminar->rutaArchivo);
                }
            }

            //No establcer un (-) ya que el campo en la vista compurba si el campo es null para mostrar el boton 
            //de subir un pdf y si el campo no es null siginifca que existe el archivo entonces hay que mostrar
            // los bitones de elinminar y ver el archivo pd
            $carDisPdfEliminar->rutaArchivo = null; 
            $carDisPdfEliminar->save();
            return back()->with('resEliminarPdfCarDis', 'El pdf se ha eliminado correctamente');
        }

        public function subirNewPdfCarDistancia(Request $newPdfCarDis, $id)
        {
            $nuevoPdfCarDis = CarreraDistancia::find($id);

            $archivo = $newPdfCarDis->file('editNuevoPlanCarDis');
            $ruta = Storage::disk('public')->put('CarrerasDistancia', $archivo); //---> Se establece la ruta

            $nuevoPdfCarDis->rutaArchivo = $ruta;
            $nuevoPdfCarDis->save();

            return back()->with('resNewPdfCarDis', 'Se ha subido el nuevo pdf correctamente');

        }

        public function editarNombreCarDis(Request $nuevoNombreCarDis,$id)
        {
            $newNameCarDis = CarreraDistancia::find($id);

            if (!$newNameCarDis) {

                return back()->with('carDisNoEncontrada', 'Carrera a distancia no encontrada');
            }

            if (!$newNameCarDis->rutaArchivo) {

                return back()->with('errorNewNameCarDis', 'Tiene que subir un archivo pdf de informacion o pensum');
            }
            else{
                $newNameCarDis->carrera = $nuevoNombreCarDis->nombreCarDistancia;
                $newNameCarDis->save();

                return redirect()->route('carrerasDistancia')->with('resNewNameCarDis', 'Se actulizado correctamente');
            }
        }

        public function verPdfCarDis($id)
        {
            $pdfCarDis = CarreraDistancia::find($id);

            // Se accede al storage de laravel para mostrar el archivo
            $contenidoPdf = Storage::disk('public')->get($pdfCarDis->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoPdf, 200)->header('Content-Type', 'application/pdf');

        }
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //--------------- FUNCIONES PARA LAS CARRERAS A DISTANCIAS DE LA FMO-----------------------------------------------------------------------------------------------------------------

        public function gestioCarDistanciaFmo()
        {
            $carDisFMO = CarreraDistancia::where('facultad', 'FMO')->get();

            return view('VistasAdministrador/gestionEduDistanciaFmo', [

                'carrerasDisFMO' => $carDisFMO
                
            ]);
        }

        public function crearCarDisFmo()
        {
            return view('VistasAdministrador/crearCarDistanciaFmo');
        }

        public function guardarCarDisFmo(Request $datosCarDisFMO)
        {
            $carDistanciaFMO = new CarreraDistancia();

            $carDistanciaFMO->carrera = $datosCarDisFMO->nombreCarDisFMO;
            $carDistanciaFMO->facultad = $datosCarDisFMO->facultadCarDisFMO;
            $carDistanciaFMO->contenido = $datosCarDisFMO->contenidoCarDisFMO;

            $banner = $datosCarDisFMO->file('bannerCarDisFMO');
            $planPdf = $datosCarDisFMO->file('archivoCarDisFMO');

            $bannerRuta = Storage::disk('public')->put('CarrerasDistancia', $banner);
            $planRuta = Storage::disk('public')->put('CarrerasDistancia', $planPdf);

            $carDistanciaFMO->rutaBanner = $bannerRuta;
            $carDistanciaFMO->rutaArchivo = $planRuta;

            $carDistanciaFMO->save();
            return redirect()->route('carrerasDistanciaFmo')->with('resGuardarCarDisFMO', 'Carrera a distancia de la fmo guardada');

        }

        public function vistaEditCarDisFmo($id)
        {
            $carDisFmoEdit = CarreraDistancia::find($id);

            return view("VistasAdministrador/editarCarDisFmo", [

                'carreraDisFmoEdit' => $carDisFmoEdit
            ]);
        }

        public function newDatosCarDisFMO(Request $datosCarDisFMO, $id)
        {
            $newCarDisFMO = CarreraDistancia::find($id);

            $newCarDisFMO->carrera = $datosCarDisFMO->editCarDisFMO;
            $newCarDisFMO->contenido = $datosCarDisFMO->editContenidoCarDisFMO;

            $newCarDisFMO->save();

            return redirect()->route('carrerasDistanciaFmo')->with('resNewDatosCarDisFMO', 'Se actulizado la carrera a distancia de la fmo');
            
        }

        public function eliminarCarDisFMO($id)
        {
            $EliminarCarDisFMO = CarreraDistancia::find($id);

            $rutaPdfCarDistancia = $EliminarCarDisFMO->rutaArchivo; // se accede al campo ruta del archivo para poder eliminar el pdf del storage también
            $rutaBannerCarDistancia = $EliminarCarDisFMO->rutaBanner;
        
            if ($rutaPdfCarDistancia !== null ) {
    
                if (Storage::disk('public')->exists($rutaPdfCarDistancia)) {
                    Storage::disk('public')->delete($rutaPdfCarDistancia);
                }
            }

            if ($rutaBannerCarDistancia !== null ) {

                if (Storage::disk('public')->exists($rutaBannerCarDistancia)) {
                    Storage::disk('public')->delete($rutaBannerCarDistancia);
                }
            }

            $EliminarCarDisFMO->delete();

            return back()->with('resEliminarCarDistanciaFMO', 'Se ha elimando la carrera a distancia de la fmo');

        }

        public function verPdfCarDisFMO($id)
        {
            $pdfCarDis = CarreraDistancia::find($id);

            // Se accede al storage de laravel para mostrar el archivo
            $contenidoPdf = Storage::disk('public')->get($pdfCarDis->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoPdf, 200)->header('Content-Type', 'application/pdf');

        }

    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNIONES PARA LA GESTION DE NUEVO INGRESO -------------------------------------------------------------------------------------------------------------
        
        //------------ Tipos de Ingreso--------------------------------------------------------------------------------------------------------------------------------------------------
            public function mostrarTiposIngreso()
            {
                $tiposDeIngreso = NuevoIngreso::where('tipoConsulta', 'Tipo_ingreso')->get();

                return view('VistasAdministrador/NuevoIngreso/TiposIngreso/gestionTiposIngreso', [
                    
                    'newIngresoTipos' => $tiposDeIngreso
                ]); 
            }

            public function vistaCrearTipoIngreso()
            {
                return view('VistasAdministrador/NuevoIngreso/TiposIngreso/crearTiposIngreso');
            }

            public function guardarTipoIngreso(Request $datosTipoIngreso)
            {
                $tipoIngreso = new NuevoIngreso();

                try{

                    $tipoIngreso->titulo = $datosTipoIngreso->tituloTipoIngreso;
                    $tipoIngreso->tipoConsulta = $datosTipoIngreso->tipoConsultaTipoIngreso;
                    $tipoIngreso->descripcion = $datosTipoIngreso->descripIngreso;
                    $tipoIngreso->fechaPublicacion = date('Y-m-d');

                    $datosTipoIngreso->validate([
                        'archivoTipoIngreso' => 'file|nullable',
                    ]);
                    
                    if ($datosTipoIngreso->hasFile('archivoTipoIngreso')) {

                        $archivo = $datosTipoIngreso->file('archivoTipoIngreso');
                        $ruta = Storage::disk('public')->put('Nuevo_Ingreso', $archivo);

                        $tipoIngreso->rutaArchivo = $ruta;

                        $tipoIngreso->save();

                        return redirect()->route('vertiposingreso')->with('resGuardarTipoIngreso', 'Tipo de ingreso creado con éxito !!');
                    } 

                }catch(Exception $e)
                {
                    return redirect()->route('vertiposingreso')->with('resErrorTipoIngreso', 'No se pudo registrar el tipo de ingreso');
                }
                
            }

            public function eliminarTipoIngreso($id)
            {
                $tipoIngresoEliminar = NuevoIngreso::find($id);
                $rutaArchivo = $tipoIngresoEliminar->rutaArchivo; // se accede al campo ruta del archivo para poder eliminar el pdf del storage también
            
                if ($rutaArchivo !== null) {
        
                    if (Storage::disk('public')->exists($rutaArchivo)) {
                        Storage::disk('public')->delete($rutaArchivo);
                    }
                }
            
                // Eliminar el registro de la base de datos
                $tipoIngresoEliminar->delete();
            
                return back()->with('resEliminarTipoIngreso', 'Tipo de ingreso eliminado correctamente');
            }

            public function vistaEditarTipoIngreso($id)
            {
                $tipoIngresoEdit = NuevoIngreso::find($id);
                return view('VistasAdministrador/NuevoIngreso/TiposIngreso/editarTipoIngreso', [
                    'tipoDeIngresoEditar' => $tipoIngresoEdit
                ]);
            }

            public function newDatosTipoIngreso(Request $editTipoIngreso, $id)
            {
                $editarTipoIngreso = NuevoIngreso::find($id);

                $editarTipoIngreso->titulo = $editTipoIngreso->editTituloTipoIngreso;
                $editarTipoIngreso->descripcion = $editTipoIngreso->editDescripcion;

                $editarTipoIngreso->save();

                return redirect()->route('vertiposingreso')->with('resEditarTipoIngreso', 'Se ha editado el tipo de ingreso con éxito');

            }

        //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        //------------- Requisitos y fecha -----------------------------------------------------------------------------------------------------------------------------------------------
            public function requisitosFechas()
            {
                $requisitosFechas = NuevoIngreso::where('tipoConsulta','Req_fecha')->get();
                return view('VistasAdministrador/NuevoIngreso/RequisitosFechas/gestionReqFechas',[
                    'requisitosYfechas' => $requisitosFechas
                ]); 
            }

            
            public function crearRequisitosFechas()
            {
                return view('VistasAdministrador/NuevoIngreso/RequisitosFechas/infoReqFechas');
            }

            public function guardarRequisitosFecha(Request $datosReqFecha)
            {
                $reqFechaIngreso = new NuevoIngreso();

                try{

                    $reqFechaIngreso->titulo = $datosReqFecha->titReqFechas;
                    $reqFechaIngreso->tipoConsulta = $datosReqFecha->tipoReqFechIngreso;
                    $reqFechaIngreso->contenido = $datosReqFecha->detallesReqFechas;
                    $reqFechaIngreso->fechaPublicacion = date('Y-m-d');

                    $reqFechaIngreso->save();

                    return redirect()->route('ReqFe')->with('resReqFechaIngres', 'Los requisitos y fechas se han registrado correctamente ');
                    

                }catch(Exception)
                {
                    return redirect()->route('ReqFe')->with('errorReqFechaIngreso', 'No se pudo registrar los requisitos y fecha');
                }
                
            }

            public function eliminarReqFechas($id)
            {
                $eliminarReqFecha = NuevoIngreso::find($id);

                try{
                    $eliminarReqFecha->delete();

                    return redirect()->route('ReqFe')->with('resEliminarReqFecha', 'Se ha eliminado el registro de requsitos y fehas');

                }catch(Exception)
                {
                    return redirect()->route('ReqFe')->with('resErrorEliminarReqFecha', 'No se pudo eliminar el registro de requsitos y fecha');
                }
            }

            public function vistaEditarReqFecha($id)
            {
                $reqFechaEdit = NuevoIngreso::find($id);
                return view('VistasAdministrador/NuevoIngreso/RequisitosFechas/editarReqFechas',[
                    'editarReqFecha' => $reqFechaEdit
                ]); 
            }

            public function actulizarReqFecha(Request $newDatosReqFecha, $id)
            {
                $nuevosDatosReqFecha = NuevoIngreso::find($id);

                $nuevosDatosReqFecha->titulo = $newDatosReqFecha->editTituloReqFecha;
                $nuevosDatosReqFecha->contenido = $newDatosReqFecha->editContentReqFecha;

                $nuevosDatosReqFecha->save();
                
                return redirect()->route('ReqFe')->with('resEditReqFecha', 'El registro de requisitos y fecha se ha actulizado');
            }

        //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        //---------------- Aplicar en linea ----------------------------------------------------------------------------------------------------------------------------------------------

            public function aplicarEnLinea()
            {
                $listaAplicarEnLinea = NuevoIngreso::where('tipoConsulta', 'Apl_linea')->get();
                return view('VistasAdministrador/NuevoIngreso/AplicarLinea/gestionAplicarLinea',[
                    'datosAplyEnLinea' => $listaAplicarEnLinea
                ]); 
            }

            
            public function vistaCrearAplicarEnLinea()
            {
                return view('VistasAdministrador/NuevoIngreso/AplicarLinea/crearInfoAplicar');

            }

            public function guardarAplicarEnLinea(Request $datosAplicarEnLinea)
            {
                $aplyEnLina = new NuevoIngreso();

                try{

                    $aplyEnLina->titulo = $datosAplicarEnLinea->titAplicar;
                    $aplyEnLina->tipoConsulta = $datosAplicarEnLinea->tipoConsultaAplyLinea;
                    $aplyEnLina->contenido = $datosAplicarEnLinea->detalleAplicar;
                    $aplyEnLina->fechaPublicacion = date('Y-m-d');

                    $aplyEnLina->save();

                    return redirect()->route('aplicarLinea')->with('resGuardarAplyLinea', 'El registro de aplicar en línea se ha guardado correctamente');
                    

                }catch(Exception)
                {
                    return redirect()->route('aplicarLinea')->with('errorRegistroAplyLinea', 'No se pudo hacer el registro de aplicacion en línea');
                }
                
            }

            public function eliminarAplicarEnLinea($id)
            {
                $aplicarEliminar = NuevoIngreso::find($id);
                $aplicarEliminar->delete();

                return redirect()->route('aplicarLinea')->with('resEliminarAplicarEnLinea', 'Se ha eliminado el registro de aplicar en línea');
            }

            public function vistaEditarAplicar($id)
            {
                $registroEditAplicar = NuevoIngreso::find($id);
                return view('VistasAdministrador/NuevoIngreso/AplicarLinea/editarAplicarEnLinea', [
                    'editApliEnLinea' => $registroEditAplicar
                ]);
            }

            public function guardarNewApliEnLinea(Request $newDatosApliLinea, $id)
            {
                $actulizarApliLinea = NuevoIngreso::find($id);

                $actulizarApliLinea->titulo = $newDatosApliLinea->editTitAplicar;
                $actulizarApliLinea->contenido = $newDatosApliLinea->editDetalleAplicar;
                $actulizarApliLinea->save();

                return redirect()->route('aplicarLinea')->with('resEditApliLinea', 'Se ha editado el registro de aplicar en linea correctamente');

            }

            
        //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        //----------------- Catalogo de la fmo ---------------------------------------------------------------------------------------------------------------------------------------------
            public function mostrarCatalogoAcademico()
            {
                $catalogo = NuevoIngreso::where('tipoConsulta', 'Catalogo')->get();

                return view('VistasAdministrador/NuevoIngreso/catalogo', [
                    'catalogoDisponible' => $catalogo
                ]);

            }

            public function subirCatalogo(Request $datosCatalogo)
            {
                $cargarCatalogo = new NuevoIngreso();
                $cargarCatalogo->titulo = $datosCatalogo->tituloCatalogo;
                $cargarCatalogo->tipoConsulta = $datosCatalogo->tipoConsultaCatalogo;
                $cargarCatalogo->descripcion = $datosCatalogo->descripcionCatalogo;
                $cargarCatalogo->fechaPublicacion = date('Y-m-d');

                $datosCatalogo->validate([
                    'archivoCatalogo' => 'file|nullable',
                ]);
                
                if ($datosCatalogo->hasFile('archivoCatalogo')) {

                    $archivo = $datosCatalogo->file('archivoCatalogo');
                    $ruta = Storage::disk('public')->put('Catalogo', $archivo);

                    $cargarCatalogo->rutaArchivo = $ruta;

                    $cargarCatalogo->save();

                    return back()->with('resSubirCatalogo', 'Catálogo subido correctamente');
                } 
                else {
                    #Colocar un mensaje si no se completa la accion
                    #Borrar estos comentarios cuandon se ponga el mensaje correspondienrte
                }

            }

            public function eliminarCatalogo($id)
            {
                $catalogoEliminar = NuevoIngreso::find($id);
                $rutaCatalogo = $catalogoEliminar->rutaArchivo;

                if ($rutaCatalogo != null) {
        
                    if (Storage::disk('public')->exists($rutaCatalogo)) {
                        Storage::disk('public')->delete($rutaCatalogo);
                    }
                }
            
                // Eliminar el registro de la base de datos
                $catalogoEliminar->delete();
            
                return back()->with('resEliminarCatalogo', 'El catalogo académico se ha eliminado correctamente');

            }

            public function mostrarPdfCatalogo($id)
            {
                $archivoCatalogo = NuevoIngreso::find($id);
                
                // Se accede al storage de laravel para mostrar el archivo
                $contenidoArchivo = Storage::disk('public')->get($archivoCatalogo->rutaArchivo);

                // Devolver la respuesta con el contenido del archivo
                return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
            }

            
        //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    
    //----------------------------- FUNIONES PARA EL CROQUIS  -------------------------------------------------------------------------------------

        public function mostrarVistaCroquis()
        {
            //$calendarioAdmin = CalendarioAdministrativo::all();

        return view('VistasAdministrador/Croquis/gestionCroquis'/*, ['calAdmin' => $calendarioAdmin ]*/);

        }

    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
}
