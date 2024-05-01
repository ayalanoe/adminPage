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
use App\Models\NuevoIngreso;
use App\Models\PreguntaFrecuente;
use App\Models\Tramite;
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
            $planesPosgrado = Carrera::where('tipoCarrera', 'Carrera_Posgrado')->get();
            return view('AcademicaFMO/planesPos', ['planesPosgrado' => $planesPosgrado]);
        }

        public function verDiplomados()
        {
            $planesDiplomados = Carrera::where('tipoCarrera', 'Diplomado')->get();
            return view('AcademicaFMO/planesDiplomados', ['diplomadosPlanes' => $planesDiplomados]);
        }

        public function verPlanesTecnicos()
        {
            $planesTecnicos = Carrera::where('tipoCarrera', 'Carrera_Tecnica')->get();
            return view('AcademicaFMO/planesTecnicos', ['carrerasTecnicas' => $planesTecnicos]);
        }

        public function verPlanesComplementarios()
        {
            $planComplementario = Carrera::where('departamento', 'PLCOM')->get();
            return view('AcademicaFMO/planesComplementarios', ['planesComplementarios' => $planComplementario]);
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
            $ingresosType = NuevoIngreso::where('tipoConsulta', 'Tipo_ingreso')->get();
            return view('AcademicaFMO/NuevoIngreso/tiposIngresos', ['tiposDeIngreso' => $ingresosType]);
        }


        public function verRequisitosFechas()
        {
            $reqFechaNewIngreso = NuevoIngreso::where('tipoConsulta', 'Req_fecha')->get();
            return view('AcademicaFMO/NuevoIngreso/requisitosFechas', ['requisitosFecha' => $reqFechaNewIngreso]);
        }

        public function verAplicarLinea()
        {
            $aplicarEnLinea = NuevoIngreso::where('tipoConsulta', 'Apl_linea')->get();
            return view('AcademicaFMO/NuevoIngreso/aplicarLinea', ['datosApliLinea' => $aplicarEnLinea]);
        }

        public function verOfertAcademica()
        {
            $ofertaCarreras = Carrera::all();
            return view('AcademicaFMO/NuevoIngreso/ofertaAcademica', ['carrerasOferta' => $ofertaCarreras]);
        }

        public function verCatalogoAcademico()
        {
            $publicCatalogo = NuevoIngreso::where('tipoConsulta', 'Catalogo')->get();
            return view('AcademicaFMO/NuevoIngreso/catalogoAcademico',[
                'mostrarCatalogo' => $publicCatalogo
            ]);
        }

        public function mostrarCatalogo($id)
        {
            $archivoCatalogo = NuevoIngreso::find($id);
            
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($archivoCatalogo->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
        }

        
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

}
