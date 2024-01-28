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

Route::get('/', function () {
    return view('AcademicaFMO/index');
});


/*//---------------------------------- RUTAS DEL USUARIO ---------------------------------------------------------------------------------------------------*/
Route::get('AcademicaFMO/directorio', [VistasPublicasController::class, 'verDatosDirectorios'])->name('directorio');








/*//---------------------------------- RUTAS DEL ADMINISTRADOR ---------------------------------------------------------------------------------------------------

    - La estructura de la primer ruta consiste en: get es la peticion http, y recibe 2 parametros. El primero es la ruta que se pasará 
    la cual se escribe entre comillas y el otro parametro es un arreglo el cual contine la clase controladora y la funcion dentro de esa clase.
    ->name que lo que hace es asignar un nombre a la ruta que 
    hemos establcido para poder llamar a esa ruta en el codigo, sale mejor llamar la ruta por el nombre en lugar de pasar toda la ruta 
    en una varible o en un lugar donde se necesite.
*/

    //Rutas para el inicio de sesion y poder ingresar al dashboard
    Route::view('login-admin', 'VistasAdministrador.loginAdministrativo')->name('login');
    Route::view('password', 'VistasAdministrador.passwordAdministrativo')->name("password")->middleware('verificarCorreo'); //Ruta protegida
    Route::view('dasboard-admin', 'VistasAdministrador.indexAdmin')->name('privada')->middleware('auth'); //Ruta protegida
    Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

    Route::post('/inicia-sesion',[LoginController::class, 'login'])->name('inicia-sesion');
    Route::post('/validar-password', [LoginController::class, 'verificarPassword'])->name('validar-password');
    

    //------------ Rutas para el manejo de las vistas en el dashboard ------------
    Route::view('registro-admin','VistasAdministrador.crearUsuario')->name('registro')->middleware('auth');
    Route::post('/validar-registro',[VistasAdminController::class, 'register'])->name('validar-registro');
    Route::post('/actualizar/{id}/datos-usuario', [VistasAdminController::class, 'editarDatosUsuario'])->name('actulizarDatosUsuario');
    Route::post('/actualizar/{id}/password-user', [VistasAdminController::class, 'cambiarPassword'])->name('actulizarPassword');

    Route::get('/calendario-clases', [VistasAdminController::class, 'formularioSubirArchivo'])->name('subirHorarioClases');
    Route::post('/calendario-clases', [VistasAdminController::class, 'subirArchivo'])->name('guardar-archivo');
    Route::delete('/eliminar/{id}-calendario-clases', [VistasAdminController::class, 'eliminarHorarioAcademico'])->name('eliminarHorarioAcademico');
    Route::get('/mostrar-calendario-clases/{id}', [VistasAdminController::class, 'verHorarioClases'])->name('contenidoCalendarioAcademico')->middleware('auth');


    Route::get('gestion-usuarios', [VistasAdminController::class, 'gestionUsuarios'])->name('gestionUsuarios');
    Route::delete('/usuarios/{id}', [VistasAdminController::class, 'destroy'])->name('usuarios.destroy');
    Route::post('/usuarios/{id}/reset-pass', [VistasAdminController::class, 'restablecerContrasenia'])->name('resetPass');

    Route::get('gestion-directorio', [VistasAdminController::class, 'verDatosDirectorios'])->name('gestionDirectorio');
    Route::post('ingresar-contacto', [VistasAdminController::class, 'insertarDatosDirectorio'])->name('insertarContacto');
    Route::delete('eliminar-contacto/{id}', [VistasAdminController::class, 'eliminarContactoDirectorio'])->name('eliminarContacto');
    Route::post('/editar-contacto/{id}',[VistasAdminController::class, 'editarDatosContacto'])->name('editarContacto');
//---------------------------------------------------------------------------------------------------------------------------------------------------------------



//---------------------------------- OTRAS RUTAS QUE PUEDAS OCUPAR --------------------------------------

// -----------------------------------------------------------------------------------------------------

