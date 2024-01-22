<!-- resources/views/subir_archivo.blade.php -->
@extends('Layouts.dashboard')

@section('titulo', 'Horario De Claes')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/estiloSubirHorario.css')}}">   
@endsection

@section('contenido')
    


    <div class="formulario">
        <h2>Subir Horario de Clases</h2>
        

        <!-- Esta parte es para mostrar un mensaje si se subio el archivo correctamente -->
        @if(session('mensaje'))
            <div style="color: green; margin-bottom: 10px;">{{ session('mensaje') }}</div>
        @endif
        
        
        <form method="post" enctype="multipart/form-data">
            @csrf
            <label for="nombreArchivo">Nombre del Archivo:</label>
            <input type="text" name="nombreArchivo" required>
            
            <label for="archivo">Seleccionar Archivo (PDF o Imagen):</label>
            <input type="file" name="archivo" accept=".pdf, .jpg, .jpeg, .png" required>
            
            <button type="submit">Subir Archivo</button>
        </form>
    </div>

@endsection
