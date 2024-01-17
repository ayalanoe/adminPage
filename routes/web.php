<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\subirHorarioClases;

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


//---------------------------------- RUTAS DEL ADMINISTRADOR ----------------------------------------
/*
    - La estructura de la primer ruta consiste en: get es la peticion http, y recibe 2 parametros. El primero es la ruta que se pasará 
    la cual se escribe entre comillas y el otro parametro es un arreglo el cual contine la clase controladora y la funcion dentro de esa clase,
    es decir que "formularioSubirArchivo" es una funcion en la clases "subirHorarioClases" que será la responsable de retornar la vista.

    - La siguiente ruta es lo mismo solo que contiene un parametro ->name que lo que hace es asignar un nombre a la ruta que 
    hemos establcido para poder llamar a esa ruta en el codigo, sale mejor llamar la ruta por el nombre en lugar de pasar toda la ruta 
    en una varible o en un lugar donde se necesite.
*/
Route::get('/subir-archivo', [subirHorarioClases::class, 'formularioSubirArchivo']);
Route::post('/subir-archivo', [subirHorarioClases::class, 'subirArchivo'])->name('guardar-archivo');
//---------------------------------------------------------------------------------------------------

