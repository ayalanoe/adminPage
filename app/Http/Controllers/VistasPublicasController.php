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
use App\Models\Croquis;
use Illuminate\Support\Facades\Storage;

class VistasPublicasController extends Controller
{
    //------------------------ PARA LA VISTA PRINCIPAL ES DECIR LA VISTA PUBLICA ------------------------------------------------------------------------------------------------------------
        public function vistaPrincipal(){

            $horarioAtencion = AtencionHorario::all();
            $tramites = Tramite::orderBy('tramite')->get();
            $galeria = Galeria::all();
            $anunciosAcademicos = Anuncios::all();
            return view('AcademicaFMO/cover', [
                'horarioLaboral' => $horarioAtencion,
                'tramitesAcademicos' => $tramites,
                'fotosGaleria' => $galeria,
                'anunciosAcademicos' => $anunciosAcademicos,
            ]);
        }
        
    //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA EL DIRECTORIO PERSONAL ACADÉMICO ----------------------------------------------------------------------------------------------------------
        public function verDatosDirectorios()
        {
            $contactos = Contacto::all();
            return view('AcademicaFMO/Directorio/directorio', ['directorio' => $contactos]);
        }
    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LOS ANUNCIOS ACADÉMICOS ------------------------------------------------------------------------------------------------------------------
        public function verAnuncios()
        {
            $anuncios = Anuncios::orderBy('fechaPublicacion', 'desc')->get();
            return view('AcademicaFMO/AnunciosAcademicos/anunciosAAFMO', ['anunciosAcademicos' => $anuncios]);
        }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LOS PLANES DE ESTUDIO -------------------------------------------------------------------------------------------------------------------
        public function verPlanesPregrado()
        {
            $planesPregrado = Carrera::where('tipoCarrera', 'Carrera_Pregrado')->orderBy('carrera')->get();
            return view('AcademicaFMO/PlanesEstudio/planesFMO', ['planesPregrado' => $planesPregrado]);
        }

        public function verArchivoPdfPregrado($id)
        {
            $archivoPregrado = Carrera::find($id);
            
            if (!$archivoPregrado) {

                abort(404);
            }

            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($archivoPregrado->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
        }

        public function verPlanesPosgrado()
        {
            $planesPosgrado = Carrera::where('tipoCarrera', 'Carrera_Posgrado')->orderBy('carrera')->get();
            return view('AcademicaFMO/PlanesEstudio/planesPos', ['planesPosgrado' => $planesPosgrado]);
        }

        public function verArchivoPdfPosgrado($id)
        {
            $archivoPosgrado = Carrera::find($id);

            if (!$archivoPosgrado) {

                abort(404);
            }
            

            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($archivoPosgrado->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
        }

        public function verDiplomados()
        {
            $planesDiplomados = Carrera::where('tipoCarrera', 'Diplomado')->orderBy('carrera')->get();
            return view('AcademicaFMO/PlanesEstudio/planesDiplomados', [
                'diplomadosPlanes' => $planesDiplomados
            ]);
        }

        public function infoDiplomados($idDiplomado)
        {
            $diplomadoImpartido = Carrera::find($idDiplomado);

            return view('AcademicaFMO/PlanesEstudio/infoDiplomados', [
                'diplomadoInfo' => $diplomadoImpartido
            ]);
        }

        public function verPlanesTecnicos()
        {
            $planesTecnicos = Carrera::where('tipoCarrera', 'Carrera_Tecnica')->orderBy('carrera')->get();
            return view('AcademicaFMO/PlanesEstudio/planesTecnicos', ['carrerasTecnicas' => $planesTecnicos]);
        }

        public function verArchivoPdfCarTecnica($id)
        {
            $archivoCarTecnica = Carrera::find($id);

            if (!$archivoCarTecnica) {

                abort(404);
            }
            
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($archivoCarTecnica->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
        }

        public function verPlanesComplementarios()
        {
            $planComplementario = Carrera::where('departamento', 'PLCOM')->orderBy('carrera')->get();
            return view('AcademicaFMO/PlanesEstudio/planesComplementarios', ['planesComplementarios' => $planComplementario]);
        }

        public function verArchivoPdfPlnCom($id)
        {
            $archivoPlnCom = Carrera::find($id);

            if (!$archivoPlnCom) {

                abort(404);
            }
            
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($archivoPlnCom->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
        }

        
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    // ----------------------------- FUNCIONES PARA LOS CALENDARIOS ------------------------------------------------------------------------------------------------------------------------

        public function verPublicCalendarioAdministrativo(){
            
            $calAdmin = CalendarioAdministrativo::first();

            
            if (!$calAdmin) {

                return back()->with('errorPublicCalAdmin','El calendario administrativo aún no ha sido publicado.');
            }

            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($calAdmin->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
        
        }

        public function verPublicCalendarioAcademico(){
            
            $calendarioAcademico = CalendarioClase::first();

            
            if (!$calendarioAcademico) {

                return back()->with('errorPublicCalAcademico','El calendario académico aún no ha sido publicado.');
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
            return view('AcademicaFMO/Facultades/listaFacultades');
        }

        public function verDirectorioFacultades($facultadContactos)
        {
            $facultades = Facultad::where('facultad', $facultadContactos)->get();
            return view('AcademicaFMO/Facultades/facultadesInfo', [
            
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

            if (!$pdfCarDis) {

                abort(404);
            }

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


        public function infoEduDistanciaFMO($id)
        {
            $fmoCarDistancia = CarreraDistancia::find($id);

            if (!$fmoCarDistancia) {
                abort(404);
            }

            return view('AcademicaFMO/EducacionDistancia/infoEduFMO', [
                'datosCarDisFmo' => $fmoCarDistancia
            ]);
        }

        public function mostrarInfoCarDisFMO($id)
        {
            $pdfCarDisFmo = CarreraDistancia::find($id);

            // Verificar si la carrera de distancia fue encontrada
            if (!$pdfCarDisFmo) {

                abort(404);
            }

            // Se accede al storage de laravel para mostrar el archivo
            $contenidoPdfCarDis = Storage::disk('public')->get($pdfCarDisFmo->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoPdfCarDis, 200)->header('Content-Type', 'application/pdf')->header('Content-Disposition', 'inline; filename="CarreraDistanciaFMO.pdf"');
        }
    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA LOS TRÁMITES ACADÉMICOS ----------------------------------------------------------------------------------------------------------------
        public function verTramite($id)
        {
            $tramite = Tramite::find($id);

            if (!$tramite) {
                abort(404);
            }
            return view('AcademicaFMO/Tramites/tramites', ['tramiteAcademico' => $tramite]);
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
            return view('AcademicaFMO/PreguntasFrecuentes/preguntasFrecuentes', ['preguntasFrecuntes' => $preguntasFre]);
        }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCIONES PARA NUEVO INGRESO ----------------------------------------------------------------------------------------------------------
        public function verTiposIngreso()
        {
            $ingresosType = NuevoIngreso::where('tipoConsulta', 'Tipo_ingreso')->get();
            return view('AcademicaFMO/NuevoIngreso/tiposIngresos', ['tiposDeIngreso' => $ingresosType]);
        }

        public function infoTiposIngresos($id)
        {
            $infoTipoIngreso = NuevoIngreso::find($id);

            return view('AcademicaFMO/NuevoIngreso/infoTipIngresos', [
                'tipoDeIngreso' => $infoTipoIngreso
            ]);
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
            $ofertaCarreras = Carrera::orderBy('carrera')->get();
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

            if (!$archivoCatalogo) {
                abort(404);
            }
            
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($archivoCatalogo->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
        }

        
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------- FUNCION PARA EL CROQUIS -----------------------------------------------------------------------------------------------------------------------------
        public function mostrarPdfCroquis()
        {
            $archivoCroquis = Croquis::first();

            if (!$archivoCroquis) {
                return back()->with('resErrorCrquis', 'No se ha encontrado el croquis');
            }
            
            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::disk('public')->get($archivoCroquis->rutaArchivo);

            // Devolver la respuesta con el contenido del archivo
            return response($contenidoArchivo, 200)->header('Content-Type', 'application/pdf');
        }


    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

}
