<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VistasAdminController;
use App\Http\Controllers\VistasAsistenteController;
use App\Http\Controllers\VistasPublicasController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('AcademicaFMO/index');
});
*/

//Para la pagina principal 
Route::get('/', [VistasPublicasController::class, 'vistaPrincipal']);




/*//-------------------- RUTAS DEL PUBLICAS PARA LA PARTE PUBLICA DE LA WEB ---------------------------------------------------------------------------------------------------*/
    
    //------------------------------ OTRAS RUTAS PUBLICAS --------------------------------------------------------------------------------------------------------------------
        Route::get('AcademicaFMO/directorio', [VistasPublicasController::class, 'verDatosDirectorios'])->name('directorio');

        Route::get('/AcademicaFMO/tramite-academico/{id}', [VistasPublicasController::class, 'verTramite'])->name('verTramiteAcademico');
        Route::get('/AcademicaFMO/formato-tramite/{id}', [VistasPublicasController::class, 'descargarFormatoTramite'])-> name('publicDescargarFormato');

        Route::get('AcademicaFMO/anuncios-oficiales', [VistasPublicasController::class, 'verAnuncios'])->name('anuncios');

        Route::get('/AcademicaFMO/preguntas-frecuentes', [VistasPublicasController::class, 'verPreguntas'])->name('preguntas');

        Route::get('/AcademicaFMO/croquis-de-la-FMO',[VistasPublicasController::class, 'mostrarPdfCroquis'])->name('verPdfCroquis');

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    

    /*------------------------------ RUTAS PUBLICAS DE NUEVO INGRESO -------------------------------------------------------------------------------------------------------*/
        //Aquí y jando siempre la identacion desgraciado
        Route::get('/NuevoIngreso/tipos-de-ingreso', [VistasPublicasController::class, 'verTiposIngreso'])->name('tiposIngresos');
        Route::get('/NuevoIngreso/requisitos-y-fechas', [VistasPublicasController::class, 'verRequisitosFechas'])->name('requisitosFechas');
        Route::get('/NuevoIngreso/aplicar-en-linea', [VistasPublicasController::class, 'verAplicarLinea'])->name('enLinea');
        Route::get('/NuevoIngreso/oferta-academica', [VistasPublicasController::class, 'verOfertAcademica'])->name('oferta');

        Route::get('/NuevoIngreso/catalogo-academico', [VistasPublicasController::class, 'verCatalogoAcademico'])->name('catalogoAcademico');
        Route::get('NuevoIngreso/mostrar-catalogo-academico/{id}', [VistasPublicasController::class, 'mostrarCatalogo'])->name('mostrarCatalogoPdf');
    /*----------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    
    //----------------------------- RUTAS PUBLICAS EDUCACION A DISTANCIA-----------------------------------------------------------------------------------------------------
        Route::get('/AcademicaFMO/educacion-a-distancia', [VistasPublicasController::class, 'verInfoEduDistancia'])->name('educDistancia');
        Route::get('AcademicaFMO/info-educacion-distacia/{id}', [VistasPublicasController::class, 'mostrarPdfCarDistancia'])->name('publicVerPdfCarDis');

        Route::get('/Educacion-a-distancia-FMO', [VistasPublicasController::class, 'verEduDistanciaFMO'])->name('distanciaFMO');
        Route::get('/Informacion-carreras-a-distancia-FMO/{id}', [VistasPublicasController::class, 'infoEduDistanciaFMO'])->name('infoDistanciaFMO');
        Route::get('/Informacion-carrera-distancia/fmo/{id}', [VistasPublicasController::class, 'mostrarInfoCarDisFMO'])->name('mostrarPdfCarDisFmo');
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------


    //------------------------------RUTAS PUBLICAS DE LAS FACULTADES ---------------------------------------------------------------------------------------------------------
        Route::get('/AcademicaFMO/facultades', [VistasPublicasController::class, 'verFacultadesNacional'])->name('verContactosFacultad');
        Route::get('/AcademicaFMO/facultades/directorio/{facultadContactos}', [VistasPublicasController::class, 'verDirectorioFacultades'])->name('facultadDirectorio');
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
    

    //------------------------------RUTAS PÚBLICAS DE PLANES DE ESTUDIO ---------------------------------------------------------------------------------------------------/
        Route::get('Planes-de-estudio/Carreras-Pregrado', [VistasPublicasController::class, 'verPlanesPregrado'])->name('planesPre');
        Route::get('/AcademicaFMO/plan-carrera-pregrado/{id}', [VistasPublicasController::class, 'verArchivoPdfPregrado'])->name('publicArchivoPregrado');

        Route::get('Planes-de-estudio/Carreras-Posgrado', [VistasPublicasController::class, 'verPlanesPosgrado'])->name('planesPos');
        Route::get('Planes-de-estudio/Diplomados', [VistasPublicasController::class, 'verDiplomados'])->name('diplomados');
        Route::get('Planes-de-estudio/Carreras-Técnicas', [VistasPublicasController::class, 'verPlanesTecnicos'])->name('tecnicos');
        Route::get('Planes-de-estudio/Complementarios', [VistasPublicasController::class, 'verPlanesComplementarios'])->name('complementarios');
    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //-------------------------------RUTAS PUBLICAS CALENDARIO ADMIN Y ACADEMICO --------------------------------------------------------------------------------------------
        Route::get('/AcademicaFMO/calendario-administrativo', [VistasPublicasController::class, 'verPublicCalendarioAdministrativo'])->name('publicVerCalAdmin');
        Route::get('/AcademicaFMO/calendario-academico', [VistasPublicasController::class, 'verPublicCalendarioAcademico'])->name('publicVerCalAcademico');
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------




//--------------------- RUTAS PUBLICAS QUE NO LLEVAN MIDDLEWARE, ES DECIR LAS QUE SE OCUPAN PARA INICIAR SESION ----------------------------------------------
    Route::view('login-admin', 'VistasAdministrador.loginAdministrativo')->name('login');
    Route::view('password', 'VistasAdministrador.passwordAdministrativo')->name("password")->middleware('verificarCorreo'); //Ruta protegida
    Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

    Route::post('/inicia-sesion',[LoginController::class, 'login'])->name('inicia-sesion');
    Route::post('/validar-password', [LoginController::class, 'verificarPassword'])->name('validar-password');
//-----------------------------------------------------------------------------------------------------------------------------------------------------------




//--------------------- RUTAS DEL ASISTENTE CON ROL 2 -------------------------------------------------------------------------------------------------------
    Route::middleware(['auth', 'rol:2'])->group(function(){

        Route::view('dashboard-asistente', 'VistasAsistente.indexAsistente')->name('vistaPrincipalAsistente');
        Route::view('acceso-denegado', 'VistasAsistente.accesoDenegado')->name('accesoDenegado');

        Route::get('/asistente-registro-constancias', [VistasAsistenteController::class, 'vistaCrearConstancia'])->name('registrosConstanciasAsis');
        Route::post('/asistente-registrar-constancias', [VistasAsistenteController::class, 'guardarConstancias'])->name('registrarConstanciasAsis');
        Route::get('/asistente-informe-constancias', [VistasAsistenteController::class, 'verInformeConstancias'])->name('informeConstanciasAsis');
        Route::post('/asistente-estadisticas-constancias', [VistasAsistenteController::class, 'totalConstancias'])->name('totalConstanciasAsis');

        Route::post('/actualizar/{id}/datos-asistente', [VistasAsistenteController::class, 'editarDatosUsuario'])->name('actulizarDatosUsuarioAsis');
        Route::post('/actualizar/{id}/password-asistente', [VistasAsistenteController::class, 'cambiarPassword'])->name('actulizarPasswordAsis');

    });

//-----------------------------------------------------------------------------------------------------------------------------------------------------------




//---------------------------------- RUTAS DEL ADMINISTRADOR ---------------------------------------------------------------------------------------------------
    /*
        - La estructura de la primer ruta consiste en: get es la peticion http, y recibe 2 parametros. El primero es la ruta que se pasará 
        la cual se escribe entre comillas y el otro parametro es un arreglo el cual contine la clase controladora y la funcion dentro de esa clase.
        ->name que lo que hace es asignar un nombre a la ruta que 
        hemos establcido para poder llamar a esa ruta en el codigo, sale mejor llamar la ruta por el nombre en lugar de pasar toda la ruta 
        en una varible o en un lugar donde se necesite.
    */

    Route::middleware(['auth', 'rol:1'])->group(function(){

        //Ruta principal
        Route::view('dashboard-admin', 'VistasAdministrador.indexAdmin')->name('privada'); //Ruta protegidaf

        //-------------- Rutas para el manejo de las vistas en el dashboard ----------------------------------------------------------------------------------------------------------
        Route::view('registro-admin','VistasAdministrador.crearUsuario')->name('registro');
        Route::post('/validar-registro',[VistasAdminController::class, 'register'])->name('validar-registro');
        Route::post('/actualizar/{id}/datos-usuario', [VistasAdminController::class, 'editarDatosUsuario'])->name('actulizarDatosUsuario');
        Route::post('/actualizar/{id}/password-user', [VistasAdminController::class, 'cambiarPassword'])->name('actulizarPassword');

        Route::get('/calendario-clases', [VistasAdminController::class, 'formularioSubirArchivo'])->name('subirHorarioClases');
        Route::post('/calendario-clases', [VistasAdminController::class, 'subirArchivo'])->name('guardar-archivo');
        Route::delete('/eliminar/{id}-calendario-clases', [VistasAdminController::class, 'eliminarHorarioAcademico'])->name('eliminarHorarioAcademico');
        Route::get('/calendario-academico/{id}', [VistasAdminController::class, 'verHorarioClases'])->name('contenidoCalendarioAcademico');

        Route::get('/gestion-cal-administrativo', [VistasAdminController::class, 'mostrarVistaCalendarioAdmin'])->name('mostrarCalendarioAdmin');
        Route::post('/subir-calendarioAdmin', [VistasAdminController::class, 'subirArchivoCalAdmin'])->name('subirCalAdmin');
        Route::delete('/eliminar-calendarioAdmin/{id}', [VistasAdminController::class, 'eliminarCalAdmin'])->name('eliminarCalAdmin');
        Route::get('/calendario-admin/{id}', [VistasAdminController::class, 'verCalAdmin'])->name('mostrarCalAdmin');
                
        Route::get('gestion-usuarios', [VistasAdminController::class, 'gestionUsuarios'])->name('gestionUsuarios');
        Route::delete('/usuarios/{id}', [VistasAdminController::class, 'destroy'])->name('usuarios.destroy');
        Route::post('/usuarios/{id}/reset-pass', [VistasAdminController::class, 'restablecerContrasenia'])->name('resetPass');

        Route::get('gestion-directorio', [VistasAdminController::class, 'verDatosDirectorios'])->name('gestionDirectorio');
        Route::post('ingresar-contacto', [VistasAdminController::class, 'insertarDatosDirectorio'])->name('insertarContacto');
        Route::delete('eliminar-contacto/{id}', [VistasAdminController::class, 'eliminarContactoDirectorio'])->name('eliminarContacto');
        Route::post('/editar-contacto/{id}',[VistasAdminController::class, 'editarDatosContacto'])->name('editarContacto');

        Route::get('/gestion-carrerasPregrado/{departamento}', [VistasAdminController::class, 'gestionCarrerasPregrado'])->name('carrerasPregrado');
        Route::post('/registrar-carrera-pregrado', [VistasAdminController::class, 'registrarCarreraPregrado'])->name('carreraPregradoIngresar');
        Route::delete('/eliminar-carrera-pregrado/{id}', [VistasAdminController::class, 'eliminarCarreraPregado'])->name('eliminarCarreraDePregrado');
        Route::get('/editar-carrera-pregrado/{id}',[VistasAdminController::class, 'editarCarreraPregrado'])->name("editarCarreraDePregrado");
        Route::delete('/eliminarPdf-carreraPregrado/{id}', [VistasAdminController::class, 'eliminarPlanCarreraPregrado'])->name("eliminarPdfCarreraPregrado");
        Route::post('/new-plan-carreraPregrado/{id}', [VistasAdminController::class, 'subirNuevoPlanCarrPregrado'])->name('nuevoPlanCarrPregado');
        Route::post('/new-datos-carreraPregrado/{id}/{depto}', [VistasAdminController::class, 'guardarNewDatosCarreraPregrado'])->name('guardarNuevosDatosCarrPre');
        Route::get('/cancelar-update-carreraPregrado/{depto}', [VistasAdminController::class, 'cancelarActulizarCarreraPregrado'])->name('cancelarCarrPre');
        Route::get('/ver-plan-carreraPregrado/{id}', [VistasAdminController::class, 'verPlanCarreraPregrado'])->name('verPlanCarrPre');

        Route::get('/departamentos-pregrado', [VistasAdminController::class, 'filtrarDepartamento'])->name('departamentosPregrado');
        Route::get('/volver-a-departamentos', [VistasAdminController::class, 'regresarAdepartementos'])->name('regresarA_Departamentos');

        Route::get('/gestion-carrerasPosgrado', [VistasAdminController::class, 'gestionCarrerasPosgrado'])->name('carrerasPosgrado');
        Route::post('/registrar-carrera-posgrado', [VistasAdminController::class, 'registrarCarreraPosgrado'])->name('carreraPosgradoIngresar');
        Route::get('/editar-carrera-posgrado/{id}',[VistasAdminController::class, 'editarCarreraPosgrado'])->name("editarCarreraPosgrado");
        Route::post('/new-datos-carreraPosgrado/{id}', [VistasAdminController::class, 'guardarNewDatosCarreraPosgrado'])->name('guardarNuevosDatosCarrPos');
        Route::post('/new-plan-carreraPosgrado/{id}', [VistasAdminController::class, 'subirNuevoPlanCarrPosgrado'])->name('nuevoPlanCarrPosgado');
        Route::delete('/eliminarPdf-carreraPosgrado/{id}', [VistasAdminController::class, 'eliminarPlanCarreraPosgrado'])->name("eliminarPdfCarreraPosgrado");
        Route::get('/ver-plan-carreraPosgrado/{id}', [VistasAdminController::class, 'verPlanCarreraPosgrado'])->name('verPlanCarrPos');
        Route::get('/cancelar-update-carreraPosgrado', [VistasAdminController::class, 'cancelarActulizarCarreraPosgrado'])->name('cancelarCarrPos');
        Route::delete('/eliminar-carrera-posgrado/{id}', [VistasAdminController::class, 'eliminarCarreraPosgrado'])->name('eliminarCarreraPosgrado');

        Route::get('/gestion-diplomados', [VistasAdminController::class, 'gestionDiplomados'])->name('verListaDiplomados');
        Route::post('/registrar-diplomado', [VistasAdminController::class, 'registrarDiplomado'])->name('ingresarDiplomado');
        Route::delete('/eliminar-diplomado/{id}', [VistasAdminController::class, 'eliminarDiplomado'])->name('diplomadoEliminar');
        Route::get('/editar-diplomado/{id}', [VistasAdminController::class, 'vistaEditDiplomado'])->name('vistaEditarDiplomado');
        Route::post('/actualizar-datos-diplomado/{id}',[VistasAdminController::class, 'guardarNewDatosDiploomado'])->name('actualizarDiplomado');
        Route::get('/ver-pdf-diplomado/{id}', [VistasAdminController::class, 'verPdfDiplomados'])->name('verPdfDiplomados');

        Route::get('/gestion-carrerasTecnicas', [VistasAdminController::class, 'gestionCarrerasTecnicas'])->name('carrerasTecnicas');
        Route::post('/registrar-carrera-tecnica', [VistasAdminController::class, 'registrarCarreraTecnica'])->name('carreraTecnicaIngresar');
        Route::get('/editar-carrera-tecnica/{id}', [VistasAdminController::class, 'editarCarreraTecnica'])->name('editarCarreraTecnica');
        Route::post('/new-datos-carreraTecnica/{id}', [VistasAdminController::class, 'guardarNewDatosCarreraTecnica'])->name('guardarNuevosDatosCarrTecnica');
        Route::post('/new-plan-carreraTecnica/{id}', [VistasAdminController::class, 'subirNuevoPlanCarrTecnica'])->name('nuevoPlanCarrTecnica');
        Route::delete('/eliminarPdf-carreraTecnica/{id}', [VistasAdminController::class, 'eliminarPlanCarreraTecnica'])->name("eliminarPdfCarreraTecnica");
        Route::get('/ver-plan-carreraTecnica/{id}', [VistasAdminController::class, 'verPlanCarreraTecnica'])->name('verPlanCarrTecnica');
        Route::get('/cancelar-update-carreraTecnica', [VistasAdminController::class, 'cancelarActulizarCarreraTecnica'])->name('cancelarCarrTecnica');
        Route::delete('/eliminar-carrera-tecnica/{id}', [VistasAdminController::class, 'eliminarCarreraTecnica'])->name('eliminarCarreraTecnica');

        Route::get('/gestion-facultades/{facultad}', [VistasAdminController::class, 'verDatosFacultad'])->name('gestionFacultades');
        Route::post('/ingresar-contacto-facultad', [VistasAdminController::class, 'insertarFacultades'])->name('insertarContactoFacultad');
        Route::delete('/eliminar-facultad/{id}', [VistasAdminController::class, 'eliminarFacultad'])->name('eliminarFacultad');
        Route::post('/editar-facultad/{id}', [VistasAdminController::class, 'editarDatosFacultad'])->name('editarFacultad');
        Route::get('/filtro-contacto-facultades', [VistasAdminController::class, 'filtrarFacultades'])->name('filtroContactosFacultades');
        Route::get('/volver-a-contactosFacultad', [VistasAdminController::class, 'regresarAcontactosFacu'])->name('volverAContactosFacultad');

        Route::get('/crear-anuncioAcademico', [VistasAdminController::class, 'vistaCrarAnuncio'])->name('vistaCrearAnuncio');
        Route::get('gestion-anuncios', [VistasAdminController::class, 'verAnuncios'])->name('gestionAnuncios');
        Route::post('/crear-anuncio', [VistasAdminController::class, 'crearAnuncio'])->name('crearAnuncio');    
        Route::delete('/eliminar-anuncio/{id}',[VistasAdminController::class, 'eliminarAnucio'])->name('eliminarAnuncio');
        Route::get('/editar-anuncio/{id}', [VistasAdminController::class, 'editarAnuncio'])->name('vistaEditarAnuncio');
        Route::post('/nuevos-datos-anuncio/{id}', [VistasAdminController::class, 'guardarNuevosDatosAnuncios'])->name('nuevosDatosAnuncio');
        Route::post('/nueva-imagen-anuncio/{id}', [VistasAdminController::class, 'subirNuevoArchivoAnuncio'])->name('nuevaImagenAnuncio');
        Route::delete('/eliminar-archivo-anuncio/{id}', [VistasAdminController::class, 'eliminarArchivoAnuncio'])->name('eliminarArchivoAnuncio');
        Route::get('/ver-archivo-anuncio/{id}', [VistasAdminController::class, 'verArchivoAnuncios'])->name('verArchivoAnuncio');
        Route::get('/cancelar-editar-anuncio', [VistasAdminController::class, 'cancelarEditarAnuncio'])->name('cancelarEditAnuncio');
        Route::get('/cancelar-crear-anuncio', [VistasAdminController::class, 'cancelarCrearAnuncio'])->name('cancelarCrearAnuncio');
        
        Route::get('gestion-horario-atencion', [VistasAdminController::class, 'verHorarioAtencion'])->name('gestionHorario');
        Route::post('/registar-horario-atencion', [VistasAdminController::class, 'guardarHorarioAtencion'])->name('registrarHorarioAtencion');
        Route::delete('/eliminar-horario-atencion', [VistasAdminController::class, 'eliminarHorarioAtencion'])->name('eliminarHorarioAtencion');

        Route::get('/tramites-academicos', [VistasAdminController::class, 'mostrarTramites'])->name("verTramitesAcademicos");
        Route::view('/vista-crear-tramite', 'VistasAdministrador/crearTramiteAcademico')->name("crearTramiteAcademico");
        Route::post('/guardar-tramite', [VistasAdminController::class, 'guardarTramite'])->name('crearTramite');
        Route::delete('/eliminar-tramite/{id}', [VistasAdminController::class, 'eliminarTramite'])->name('eliminarTramite');
        Route::get('/editar-tramite/{id}', [VistasAdminController::class, 'vistaEditarTramite'])->name('editarTramite');
        Route::post('/guardar-nuevos-datos-tramite/{id}', [VistasAdminController::class, 'editarTramiteAcademico'])->name('guardarNuevosDatosTramite');
        Route::post('/subir-new-formato-tramite/{id}', [VistasAdminController::class, 'subirNuevoFormatoTramite'])->name('nuevoArchivoTramite');
        Route::delete('/eliminar-archivo-tramite/{id}', [VistasAdminController::class, 'eliminarFormatoTramite'])->name('eliminarArchivoTramite');
        Route::get('/ver-archivo-tramite/{id}', [VistasAdminController::class, 'verArchivoTramite'])->name('verArchivoTramite');
        Route::get('/descargar-formato/{id}', [VistasAdminController::class, 'descargarFormatoTramite'])->name('descargarFormatoTramite');

        Route::get('/educacion-a-distancia', [VistasAdminController::class, 'mostrarCarrerasDistancia'])->name("carrerasDistancia");
        Route::post('registrar-car-distancia', [VistasAdminController::class, 'guardarCarreraDistancia'])->name('guardarCarDistancia');
        Route::delete('/eliminar-carrera-distancia/{id}', [VistasAdminController::class, 'eliminarCarDistancia'])->name('eliminarCarDistancia');
        Route::get('/editar-carrera-distancia/{id}', [VistasAdminController::class, 'vistaEditarCarDistrancia'])->name('vistaEditarCarDistancia');
        Route::delete('eliminar-pdf-car-dis/{id}', [VistasAdminController::class, 'eliminarPdfCarDistancia'])->name('elimarPdfCarDistancia');
        Route::post('/nuevo-pdf-car-distancia/{id}', [VistasAdminController::class, 'subirNewPdfCarDistancia'])->name('nuevoPdfCarDis');
        Route::post('/nuevo-name-car-distancia/{id}', [VistasAdminController::class, 'editarNombreCarDis'])->name('nuevoNombreCarDis');
        Route::get('/ver-pdf-car-distancia/{id}', [VistasAdminController::class, 'verPdfCarDis'])->name('verPdfCarDistancia');

        Route::get('/carreras-distancia-fmo', [VistasAdminController::class, 'gestioCarDistanciaFmo'])->name('carrerasDistanciaFmo');
        Route::get('/crear-carrera-distancia-fmo', [VistasAdminController::class, 'crearCarDisFmo'])->name('vistaCrearCarDisFmo');
        Route::post('/guardar-car-dis-fmo', [VistasAdminController::class, 'guardarCarDisFmo'])->name('guardarCarDisFMO');
        Route::get('/editar-carrera-distancia/fmo/{id}', [VistasAdminController::class, 'vistaEditCarDisFmo'])->name('vistaEditarCarDisFMO');
        Route::post('/editar-car-dis-fmo/{id}', [VistasAdminController::class, 'newDatosCarDisFMO'])->name('guardarNewDatosCarDisFmo');
        Route::delete('/elimar-car-dis-fmo/{id}', [VistasAdminController::class, 'eliminarCarDisFMO'])->name('elimarCarDisFmo');
        Route::get('/ver-pdf-car-distancia/fmo/{id}', [VistasAdminController::class, 'verPdfCarDisFMO'])->name('verPDFCarreraDisFmo');
    
        Route::get('/ver-preguntas-frecuentes', [VistasAdminController::class, 'mostrarPreguntas'])->name('verPreguntasFrecuentes');
        Route::view('/ingresar-pregunta-frecuente', 'VistasAdministrador/crearPregunta')->name('vistaIngresarPregunta');
        Route::post('/guardar-pregunta', [VistasAdminController::class, 'guardarPregunta'])->name('guardarPregunta');
        Route::delete('/eliminar-pregunta/{id}', [VistasAdminController::class, 'eliminarPregunta'])->name('eliminarPreguntaFrecuente');
        Route::get('editar-pregunta/{id}', [VistasAdminController::class, 'vistaEditarPregunta'])->name('editarPreguntaVista');
        Route::post('editar-pregunta-guardar/{id}', [VistasAdminController::class, 'editarPreguntaFrecuente'])->name('guardarNewDatosPregunta');
        Route::get('/cancelar-pregunta', [VistasAdminController::class, 'cancelarPregunta'])->name('regrersarPregunta');


        Route::get('/registro-constancias', [VistasAdminController::class, 'vistaCrearConstancia'])->name('registrosConstancias');
        Route::get('/informe-constancias', [VistasAdminController::class, 'verInformeConstancias'])->name('informeConstancias');
        Route::post('/registrar-constancias', [VistasAdminController::class, 'guardarConstancias'])->name('registrarConstancias');
        Route::post('/estadisticas-constancias', [VistasAdminController::class, 'totalConstancias'])->name('totalConstancias');

        Route::get('/gestion-galeria', [VistasAdminController::class, 'verGaleria'])->name('gestionGaleria');
        Route::post('/resgistrar-foto-galeria', [VistasAdminController::class, 'guardarFotoGaleria'])->name('guardarGaleria');
        Route::delete('/elimar-foto-galeria/{id}', [VistasAdminController::class, 'eliminarFotoGaleria'])->name('eliminarFotoGaleria');
        Route::get('/ver-foto-galeria/{id}', [VistasAdminController::class, 'verFotoGaleria'])->name('verFotoGaleriaAdmin');

        Route::get('/Administracion/tipos-de-ingreso', [VistasAdminController::class, 'mostrarTiposIngreso'])->name("vertiposingreso");
        Route::get('/crear-tipo-de-ingreso', [VistasAdminController::class, 'vistaCrearTipoIngreso'])->name("crearTipoIngreso");
        Route::post('/crear-tipo-ingreso', [VistasAdminController::class, 'guardarTipoIngreso'])->name('guardarTipoIngreso');
        Route::delete('/eliminar-tipo-ingreso/{id}', [VistasAdminController::class, 'eliminarTipoIngreso'])->name('eliminarTipoIngreso');
        Route::get('/editar-tipo-de-ingreso/{id}', [VistasAdminController::class, 'vistaEditarTipoIngreso'])->name('vistaEditarIngresoTipo');
        Route::post('/nuevos-datos-tipo-ingreso/{id}', [VistasAdminController::class, 'newDatosTipoIngreso'])->name('nuevosDatosTipoIngreso');

        Route::get('/nuevo-ingreso/requisitos-y-fechas', [VistasAdminController::class, 'requisitosFechas'])->name("ReqFe");
        Route::get('/nuevo-ingreso/requisitos-y-fechas/agregar-informacion', [VistasAdminController::class, 'crearRequisitosFechas'])->name("infoReqFe");
        Route::post('/nuevo-ingreso/guardar-req-fecha', [VistasAdminController::class, 'guardarRequisitosFecha'])->name('guardarReqFechaIngreso');
        Route::delete('/nuevo-ingreso/eliminar-rquisitos-y-fecha/{id}', [VistasAdminController::class, 'eliminarReqFechas'])->name('eliminarReqFechaIngreso');
        Route::get('/nuevo-ingreso-editar-req-fecha/{id}', [VistasAdminController::class, 'vistaEditarReqFecha'])->name('vistaReqFechaEditar');
        Route::post('/nuevo-ingreso-actulizar-req-fecha/{id}', [VistasAdminController::class, 'actulizarReqFecha'])->name('guardarNewDatosReqFecha');
        
        Route::get('/nuevo-ingreso/aplicar-en-linea', [VistasAdminController::class, 'aplicarEnLinea'])->name("aplicarLinea");
        Route::get('/nuevo-ingreso/aplicar-en-linea/agregar-informacion', [VistasAdminController::class, 'vistaCrearAplicarEnLinea'])->name("infoAplicarLinea");
        Route::post('/nuevo-ingreso/guardar/aplicar-en-linea', [VistasAdminController::class, 'guardarAplicarEnLinea'])->name('aplicarEnLineaGuardar');
        Route::delete('/nuevo-ingreso/eliminar-aplicar-en-linea/{id}', [VistasAdminController::class, 'eliminarAplicarEnLinea'])->name('aplicarEnLineaEliminar');
        Route::get('/nuevo-ingreso/editar-aplicar-en-linea/{id}', [VistasAdminController::class, 'vistaEditarAplicar'])->name('vistaEditarAplyLinea');
        Route::post('/nuevo-ingreso/actulizar-aplicar-en-linea/{id}', [VistasAdminController::class, 'guardarNewApliEnLinea'])->name('guardarNewDatosAplicar');
    
        Route::get('/nuevo-ingreso/catalogo-Academico', [VistasAdminController::class, 'mostrarCatalogoAcademico'])->name('verCatalogo');
        Route::post('/nuevo-ingreso/subir-catalogo', [VistasAdminController::class, 'subirCatalogo'])->name('subirCatalogoNuevoIngreso');
        Route::delete('/nuevo-ingreso/eliminar-catalogo/{id}', [VistasAdminController::class, 'eliminarCatalogo'])->name('elimnarCatalogoAca');
        Route::get('/nuevo-ingreso/archivo-catalogo/{id}', [VistasAdminController::class, 'mostrarPdfCatalogo'])->name('verPdfCatalogo');

        Route::get('/gestion-croquis', [VistasAdminController::class, 'mostrarVistaCroquis'])->name('croquis');
        Route::post('/subir-croquis', [VistasAdminController::class, 'subirCroquis'])->name('enviarCroquis');
        Route::delete('/eliminar-croquis/{id}', [VistasAdminController::class, 'eliminarCroquis'])->name('deleteCroquis');
        Route::get('/croquis/{id}', [VistasAdminController::class, 'verCroquis'])->name('mostrarCroquis');
       


    });


    



//---------------------------------------------------------------------------------------------------------------------------------------------------------------


