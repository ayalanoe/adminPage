<?php

namespace App\Http\Controllers;

//Son como los imports en java, decir archivos y clases en otros directorios, necesarios para que funcione el controlador
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CalendarioClase;

class LoginController extends Controller
{
    public function formularioLogin()
    {
        // Se carga la vista correspondiente AL LOGIN PARA ACCEDER AL BACKEND DEL SITIO WEB
        return view('VistasAdministrador/loginAdministrativo');
    }
}
