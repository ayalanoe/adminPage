<?php

namespace App\Http\Controllers;

use App\Models\AtencionHorario;
use App\Models\CalendarioAdministrativo;

use App\Models\CalendarioClase;
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
                'preguntaFrecuente' => $preguntas,
            ]);
        }
    //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA EL DIRECTORIO PERSONAL ACADÉMICO ----------------------------------------------------------------------------------------------------------
        public function verDatosDirectorios()
        {
            $contactos = Contacto::all();
            return view('AcademicaFMO/directorio', ['directorio' => $contactos]);
        }
    //---------------------------------------------------------------------------------------------------


    //----------------------------- FUNCIONES PARA LOS ANUNCIOS ACADÉMICOS ----------------------------------------------------------------------------------------------------------
        public function verAnuncios()
        {
            $contactos = Contacto::all();
            return view('AcademicaFMO/anunciosAAFMO', ['anuncios' => $contactos]);
        }
    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    //----------------------------- FUNCIONES PARA LOS PLANES DE ESTUDIO ----------------------------------------------------------------------------------------------------------
        public function verPlanes()
        {
            $contactos = Contacto::all();
            return view('AcademicaFMO/planesFMO', ['planes' => $contactos]);
        }

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    // ----------------------------- FUNCIONES PARA LOS CALENDARIOS ----------------------------------------------------------------------------------------------------------------

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

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    //----------------------------- FUNCIONES PARA EL DIRECTORIO DE LAS FACULTADES ----------------------------------------------------------------------------------------------------------
        public function verFacultadesNacional()
        {
            $facultades = Facultad::all();
            return view('AcademicaFMO/facultades', ['facultad' => $facultades]);
        }

        public function verDirectorioFacultades()
        {
            $facultades = Facultad::all();
            return view('AcademicaFMO/facultadesInfo', ['facultadDirectorio' => $facultades]);
        }
    //---------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LOS ANUNCIOS ACADÉMICOS ----------------------------------------------------------------------------------------------------------
        public function verInfoEduDistancia()
        {
            $contactos = Contacto::all();
            return view('AcademicaFMO/eduDistancia', ['educDistancia' => $contactos]);
        }
    //

    //----------------------------- FUNCIONES PARA LOS TRÀMITES ACADÉMICOS ----------------------------------------------------------------------------------------------------------
        public function verTramite($id)
        {
            $tramite = Tramite::find($id);
            return view('AcademicaFMO/tramites', ['tramiteAcademico' => $tramite]);
        }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    //----------------------------- FUNCIONES PARA LAS PREGUNTAS FRECUENTES ----------------------------------------------------------------------------------------------------------
        public function verPreguntas()
        {
            $contactos = Contacto::all();
            return view('AcademicaFMO/preguntasFrecuentes', ['preguntas' => $contactos]);
        }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

}
