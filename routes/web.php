<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VistasAdminController;
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




/*//---------------------------------- RUTAS DEL USUARIO ---------------------------------------------------------------------------------------------------*/
    Route::get('AcademicaFMO/directorio', [VistasPublicasController::class, 'verDatosDirectorios'])->name('directorio');

    Route::get('/AcademicaFMO/educación-a-distancia', [VistasPublicasController::class, 'verInfoEduDistancia'])->name('educDistancia');

    Route::get('/AcademicaFMO/contacto-facultades', [VistasPublicasController::class, 'verFacultadesNacional'])->name('verContactosFacultad');

    Route::get('AcademicaFMO/anuncios-oficiales', [VistasPublicasController::class, 'verAnuncios'])->name('anuncios');

    Route::get('AcademicaFMO/planes-de-estudio', [VistasPublicasController::class, 'verPlanes'])->name('planes');

    Route::get('/AcademicaFMO/calendario-administrativo', [VistasPublicasController::class, 'verPublicCalendarioAdministrativo'])->name('publicVerCalAdmin');
    Route::get('/AcademicaFMO/calendario-academico', [VistasPublicasController::class, 'verPublicCalendarioAcademico'])->name('publicVerCalAcademico');

//------------------------------------------------------------------------------------------------------------------------------------------------------------


//---------------------------------- RUTAS DEL ADMINISTRADOR ---------------------------------------------------------------------------------------------------
    /*
        - La estructura de la primer ruta consiste en: get es la peticion http, y recibe 2 parametros. El primero es la ruta que se pasará 
        la cual se escribe entre comillas y el otro parametro es un arreglo el cual contine la clase controladora y la funcion dentro de esa clase.
        ->name que lo que hace es asignar un nombre a la ruta que 
        hemos establcido para poder llamar a esa ruta en el codigo, sale mejor llamar la ruta por el nombre en lugar de pasar toda la ruta 
        en una varible o en un lugar donde se necesite.
    */

    //------------- Rutas para el inicio de sesion y poder ingresar al dashboard ----------------------------------------------------------------
    Route::view('login-admin', 'VistasAdministrador.loginAdministrativo')->name('login');
    Route::view('password', 'VistasAdministrador.passwordAdministrativo')->name("password")->middleware('verificarCorreo'); //Ruta protegida
    Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

    Route::post('/inicia-sesion',[LoginController::class, 'login'])->name('inicia-sesion');
    Route::post('/validar-password', [LoginController::class, 'verificarPassword'])->name('validar-password');

    Route::middleware(['auth'])->group(function(){

        //Ruta principal
        Route::view('dashboard-admin', 'VistasAdministrador.indexAdmin')->name('privada'); //Ruta protegida

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

        Route::get('/gestion-carrerasPosgrado', [VistasAdminController::class, 'gestionCarrerasPosgrado'])->name('carrerasPosgrado');
        Route::post('/registrar-carrera-posgrado', [VistasAdminController::class, 'registrarCarreraPosgrado'])->name('carreraPosgradoIngresar');
        Route::get('/editar-carrera-posgrado/{id}',[VistasAdminController::class, 'editarCarreraPosgrado'])->name("editarCarreraPosgrado");
        Route::post('/new-datos-carreraPosgrado/{id}', [VistasAdminController::class, 'guardarNewDatosCarreraPosgrado'])->name('guardarNuevosDatosCarrPos');
        Route::post('/new-plan-carreraPosgrado/{id}', [VistasAdminController::class, 'subirNuevoPlanCarrPosgrado'])->name('nuevoPlanCarrPosgado');
        Route::delete('/eliminarPdf-carreraPosgrado/{id}', [VistasAdminController::class, 'eliminarPlanCarreraPosgrado'])->name("eliminarPdfCarreraPosgrado");
        Route::get('/ver-plan-carreraPosgrado/{id}', [VistasAdminController::class, 'verPlanCarreraPosgrado'])->name('verPlanCarrPos');
        Route::get('/cancelar-update-carreraPosgrado', [VistasAdminController::class, 'cancelarActulizarCarreraPosgrado'])->name('cancelarCarrPos');
        Route::delete('/eliminar-carrera-posgrado/{id}', [VistasAdminController::class, 'eliminarCarreraPosgrado'])->name('eliminarCarreraPosgrado');

        Route::get('/gestion-carrerasTecnicas', [VistasAdminController::class, 'gestionCarrerasTecnicas'])->name('carrerasTecnicas');
        Route::post('/registrar-carrera-tecnica', [VistasAdminController::class, 'registrarCarreraTecnica'])->name('carreraTecnicaIngresar');
        Route::get('/editar-carrera-tecnica/{id}', [VistasAdminController::class, 'editarCarreraTecnica'])->name('editarCarreraTecnica');
        Route::post('/new-datos-carreraTecnica/{id}', [VistasAdminController::class, 'guardarNewDatosCarreraTecnica'])->name('guardarNuevosDatosCarrTecnica');
        Route::post('/new-plan-carreraTecnica/{id}', [VistasAdminController::class, 'subirNuevoPlanCarrTecnica'])->name('nuevoPlanCarrTecnica');
        Route::delete('/eliminarPdf-carreraTecnica/{id}', [VistasAdminController::class, 'eliminarPlanCarreraTecnica'])->name("eliminarPdfCarreraTecnica");
        Route::get('/ver-plan-carreraTecnica/{id}', [VistasAdminController::class, 'verPlanCarreraTecnica'])->name('verPlanCarrTecnica');
        Route::get('/cancelar-update-carreraTecnica', [VistasAdminController::class, 'cancelarActulizarCarreraTecnica'])->name('cancelarCarrTecnica');
        Route::delete('/eliminar-carrera-tecnica/{id}', [VistasAdminController::class, 'eliminarCarreraTecnica'])->name('eliminarCarreraTecnica');

        Route::get('/departamentos-pregrado', [VistasAdminController::class, 'filtrarDepartamento'])->name('departamentosPregrado');
        Route::get('/volver-a-departamentos', [VistasAdminController::class, 'regresarAdepartementos'])->name('regresarA_Departamentos');

        Route::get('gestion-facultades', [VistasAdminController::class, 'verDatosFacultad'])->name('gestionFacultades');
        Route::post('ingresar-contacto-facultad', [VistasAdminController::class, 'insertarFacultades'])->name('insertarContactoFacultad');
        Route::delete('/eliminar-facultad/{id}', [VistasAdminController::class, 'eliminarFacultad'])->name('eliminarFacultad');
        Route::post('/editar-facultad/{id}', [VistasAdminController::class, 'editarDatosFacultad'])->name('editarFacultad');

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
        Route::delete('/eliminar-horario-atencion/{id}', [VistasAdminController::class, 'eliminarHorarioAtencion'])->name('eliminarHorarioAtencion');

    });

    Route::get('/gestion-galeria', [VistasAdminController::class, 'verGaleria'])->name('gestionGaleria');







//---------------------------------- OTRAS RUTAS QUE PUEDAS OCUPAR --------------------------------------


