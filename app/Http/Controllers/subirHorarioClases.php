<?php

namespace App\Http\Controllers;

//Son como los imports en java, decir archivos y clases en otros directorios, necesarios para que funcione el controlador
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CalendarioClase;

class subirHorarioClases extends Controller
{
    public function formularioSubirArchivo()
    {
        // Se carga la vista correspondiente para subir el archivo
        return view('VistasAdministrador/subirHorarioClases');
    }

    //Se crea una una funcnion para subir el archivo y se crea un objeto de tipo Requets para acceder a la informacion
    public function subirArchivo(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        
        /*  El formato es definir una variable en php no se especifica el tipo. Con on objeto request se accede y se especifica 
            el tipo de input el cual va recibir un parametro que es el nombre del input en el html
        */
        $nombreArchivo = $request->input('nombreArchivo');
        $archivo = $request->file('archivo');
        $ruta = Storage::disk('local')->put('archivos', $archivo); //---> Se establece la ruta

        
        //Insersion en la base de datos usando el modelo de la tabala para almacenar el archivo
        CalendarioClase::create([
            'nombreArchivo' => $nombreArchivo, 
            'rutaArchivo' => $ruta,
        ]);
        

        return redirect()->back()->with('mensaje', 'Archivo subido correctamente.');
    }
}
