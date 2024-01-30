<?php

namespace App\Http\Controllers;

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





        //----------------------------- FUNCIONES PARA LOS ANUNCIOS ACADÉMICOS ----------------------------------------------------------------------------------------------------------
        public function verAnuncios()
        {
            $contactos = Contacto::all();
            return view('AcademicaFMO/anunciosAAFMO', ['anuncios' => $contactos]);
        }


        //----------------------------- FUNCIONES PARA LOS PLANES DE ESTUDIO ----------------------------------------------------------------------------------------------------------
        public function verPlanes()
        {
            $contactos = Contacto::all();
            return view('AcademicaFMO/planesFMO', ['planes' => $contactos]);
        }

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
}
