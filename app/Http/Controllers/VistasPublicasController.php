<?php

namespace App\Http\Controllers;

use App\Models\Anuncios;
use App\Models\AtencionHorario;
use App\Models\CalendarioAdministrativo;

use App\Models\CalendarioClase;
use App\Models\Carrera;
use App\Models\CarreraDistancia;
use App\Models\Contacto;
use App\Models\Facultad;
use App\Models\PreguntaFrecuente;
use App\Models\Tramite;
use Illuminate\Support\Facades\Storage;
use Spatie\Backtrace\Backtrace;

class VistasPublicasController extends Controller
{
    //------------------------ PARA LA VISTA PRINCIPAL ES DECIR LA VISTA PUBLICA ------------------------------------------------------------------------------------------------------------
        public function vistaPrincipal(){

            $horarioAtencion = AtencionHorario::all();
            $tramites = Tramite::all();
            $preguntas = PreguntaFrecuente::all();

            return view('AcademicaFMO/cover', [

                'horarioLaboral' => $horarioAtencion,
                'tramitesAcademicos' => $tramites,
            ]);
        }
    //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA EL DIRECTORIO PERSONAL ACADÉMICO ----------------------------------------------------------------------------------------------------------
        public function verDatosDirectorios()
        {
            $contactos = Contacto::all();
            return view('AcademicaFMO/directorio', ['directorio' => $contactos]);
        }
    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LOS ANUNCIOS ACADÉMICOS ------------------------------------------------------------------------------------------------------------------
        public function verAnuncios()
        {
            $anuncios = Anuncios::all();
            return view('AcademicaFMO/anunciosAAFMO', ['anunciosAcademicos' => $anuncios]);
        }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LOS PLANES DE ESTUDIO -------------------------------------------------------------------------------------------------------------------
        public function verPlanesPregrado()
        {
            $planesPregrado = Carrera::where('tipoCarrera', 'Carrera_Pregrado')->get();
            return view('AcademicaFMO/planesFMO', ['planesPregrado' => $planesPregrado]);
        }

    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    // ----------------------------- FUNCIONES PARA LOS CALENDARIOS ------------------------------------------------------------------------------------------------------------------------

        public function verPublicCalendarioAdministrativo(){
            
            $calAdmin = CalendarioAdministrativo::first();

            
            if (!$calAdmin) {

                return back()->with('errorPublicCalAdmin','Aún no se ha subido calendario administrativo');
            }

            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::get($calAdmin->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
        
        }

        public function verPublicCalendarioAcademico(){
            
            $calendarioAcademico = CalendarioClase::first();

            
            if (!$calendarioAcademico) {

                return back()->with('errorPublicCalAcademico','Aún no se ha subido calendario academico');
            }
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::get($calendarioAcademico->rutaArchivo);
            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
        
        }

    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA EL DIRECTORIO DE LAS FACULTADES ---------------------------------------------------------------------------------------------------------
        public function verFacultadesNacional()
        {
            return view('AcademicaFMO/facultades');
        }

        public function verDirectorioFacultades($facultadContactos)
        {
            $facultades = Facultad::where('facultad', $facultadContactos)->get();
            return view('AcademicaFMO/facultadesInfo', [
            
                'facultadDirectorio' => $facultades,
                'tituloFacultad' => $facultadContactos
            ]);
        }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LAS CARRERAS A DISTANCIA ----------------------------------------------------------------------------------------------------------------
        public function verInfoEduDistancia()
        {
            $publicCarDistancia = CarreraDistancia::all();
            return view('AcademicaFMO/eduDistancia', ['educDistancia' => $publicCarDistancia]);
        }

        public function mostrarPdfCarDistancia($id)
        {
            $pdfCarDis = CarreraDistancia::find($id);
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoPdfCarDis = Storage::get($pdfCarDis->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoPdfCarDis, 200)->header('Content-Type', 'application/pdf');
        }
    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LOS TRÀMITES ACADÉMICOS ----------------------------------------------------------------------------------------------------------------
        public function verTramite($id)
        {
            $tramite = Tramite::find($id);
            return view('AcademicaFMO/tramites', ['tramiteAcademico' => $tramite]);
        }
    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LAS PREGUNTAS FRECUENTES ----------------------------------------------------------------------------------------------------------
        public function verPreguntas()
        {
            $preguntasFre = PreguntaFrecuente::all();
            return view('AcademicaFMO/preguntasFrecuentes', ['preguntasFrecuntes' => $preguntasFre]);
        }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

}
