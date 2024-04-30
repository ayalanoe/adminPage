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
use App\Models\Galeria;
use App\Models\PreguntaFrecuente;
use App\Models\Tramite;
use App\Models\Croquis;
use Illuminate\Support\Facades\Storage;

class VistasPublicasController extends Controller
{
    //------------------------ PARA LA VISTA PRINCIPAL ES DECIR LA VISTA PUBLICA ------------------------------------------------------------------------------------------------------------
        public function vistaPrincipal(){

            $horarioAtencion = AtencionHorario::all();
            $tramites = Tramite::all();
            $galeria = Galeria::all();
            return view('AcademicaFMO/cover', [
                'horarioLaboral' => $horarioAtencion,
                'tramitesAcademicos' => $tramites,
                'fotosGaleria' => $galeria,
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

        public function verArchivoPdfPregrado($id)
        {
            $archivoPregrado = Carrera::find($id);
            
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($archivoPregrado->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
        }

        public function verPlanesPosgrado()
        {
            $planesPosgrado = Carrera::where('tipoCarrera', 'Carrera_Pregrado')->get();
            return view('AcademicaFMO/planesPos', ['planesPosgrado' => $planesPosgrado]);
        }

        public function verDiplomados()
        {
            $planesDiplomados = Carrera::where('tipoCarrera', 'Carrera_Pregrado')->get();
            return view('AcademicaFMO/planesDiplomados', ['planesDiplomados' => $planesDiplomados]);
        }

        public function verPlanesTecnicos()
        {
            $planesTecnicos = Carrera::where('tipoCarrera', 'Carrera_Pregrado')->get();
            return view('AcademicaFMO/planesTecnicos', ['planesTecnicos' => $planesTecnicos]);
        }

        public function verPlanesComplementarios()
        {
            $planComplementario = Carrera::where('tipoCarrera', 'Carrera_Pregrado')->get();
            return view('AcademicaFMO/planesComplementarios', ['planComplementario' => $planComplementario]);
        }

        
        
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    // ----------------------------- FUNCIONES PARA LOS CALENDARIOS ------------------------------------------------------------------------------------------------------------------------

        public function verPublicCalendarioAdministrativo(){
            
            $calAdmin = CalendarioAdministrativo::first();

            
            if (!$calAdmin) {

                return back()->with('errorPublicCalAdmin','Aún no se ha subido calendario administrativo');
            }

            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($calAdmin->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
        
        }

        public function verPublicCalendarioAcademico(){
            
            $calendarioAcademico = CalendarioClase::first();

            
            if (!$calendarioAcademico) {

                return back()->with('errorPublicCalAcademico','Aún no se ha subido calendario academico');
            }
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($calendarioAcademico->rutaArchivo);
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
            $carDistanciaOtraFacultad = CarreraDistancia::where('facultad', 'OTRA_FACULTAD')->get();
            return view('AcademicaFMO/EducacionDistancia/eduDistancia', ['eduDisOtraFacultad' => $carDistanciaOtraFacultad]);
        }

        public function mostrarPdfCarDistancia($id)
        {
            $pdfCarDis = CarreraDistancia::find($id);
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoPdfCarDis = Storage::disk('public')->get($pdfCarDis->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoPdfCarDis, 200)->header('Content-Type', 'application/pdf');
        }


        public function verEduDistanciaFMO()
        {
            $carDistaciaFMO = CarreraDistancia::where('facultad', 'FMO')->get();
            return view('AcademicaFMO/EducacionDistancia/eduDistanciaFMO', ['distanciaFMO' => $carDistaciaFMO]);
        }


        public function infoEduDistanciaFMO()
        {
            return view('AcademicaFMO/EducacionDistancia/infoEduFMO');
        }
    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LOS TRÁMITES ACADÉMICOS ----------------------------------------------------------------------------------------------------------------
        public function verTramite($id)
        {
            $tramite = Tramite::find($id);
            return view('AcademicaFMO/tramites', ['tramiteAcademico' => $tramite]);
        }

        public function descargarFormatoTramite($id)
        {
            $formato = Tramite::find($id);
            $rutaTramite = storage_path('app/public/'.$formato->rutaFormato);

            $nombreOriginal = basename($formato->rutaFormato);
            $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
            $nombreArchivo = 'formatoTramite.' . $extension;

            return response()->download($rutaTramite, $nombreArchivo);
        }
    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LAS PREGUNTAS FRECUENTES ----------------------------------------------------------------------------------------------------------
        public function verPreguntas()
        {
            $preguntasFre = PreguntaFrecuente::all();
            return view('AcademicaFMO/preguntasFrecuentes', ['preguntasFrecuntes' => $preguntasFre]);
        }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    //----------------------------- FUNCIONES PARA NUEVO INGRESO ----------------------------------------------------------------------------------------------------------
    public function verTiposIngreso()
    {
        $ingresosType = PreguntaFrecuente::all();
        return view('AcademicaFMO/NuevoIngreso/tiposIngresos', ['preguntasFrecuntes' => $ingresosType]);
    }


    public function verRequisitosFechas()
    {
        $ingresosType = PreguntaFrecuente::all();
        return view('AcademicaFMO/NuevoIngreso/requisitosFechas', ['preguntasFrecuntes' => $ingresosType]);
    }

    public function verAplicarLinea()
    {
        $ingresosType = PreguntaFrecuente::all();
        return view('AcademicaFMO/NuevoIngreso/aplicarLinea', ['preguntasFrecuntes' => $ingresosType]);
    }

    public function verOfertAcademica()
    {
        $ingresosType = PreguntaFrecuente::all();
        return view('AcademicaFMO/NuevoIngreso/ofertaAcademica', ['preguntasFrecuntes' => $ingresosType]);
    }


        public function infoTiposIngreso()
        {
            return view('AcademicaFMO/NuevoIngreso/infoTipIngresos');
        }
    // ----------------------------- FUNCION PARA EL CROQUIS ------------------------------------------------------------------------------------------------------------------------

        public function verPublicCroquisFMO(){      
            $croq = Croquis::first();

            if (!$croq) {
                return back()->with('errorPublicCalAdmin','Aún no se ha subido el croquis de la FMO.');
            }

            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($croq->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
        }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

}
