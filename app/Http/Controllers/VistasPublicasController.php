<?php

namespace App\Http\Controllers;

use App\Models\CalendarioAdminCx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\CalendarioClase;
use App\Models\Contacto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VistasPublicasController extends Controller
{

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
            
            $calAdminCx = CalendarioAdminCx::first();

            
            if (!$calAdminCx) {

                return back()->with('errorPublicCalAdmin','Aún no se ha subido calendario administrativo');
            }

            // Se accede al storage de laravel para mostrar el archivo
            $contenidoArchivo = Storage::get($calAdminCx->rutaArchivo);

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
        $contactos = Facultad::all();
        return view('AcademicaFMO/facultades', ['directorio' => $contactos]);
    }
//---------------------------------------------------------------------------------------------------


}
