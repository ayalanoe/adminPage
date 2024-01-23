<!-- resources/views/subir_archivo.blade.php -->
@extends('Layouts.dashboard')

@section('titulo', 'Horario De Claes')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/estiloSubirHorario.css')}}">   
@endsection

@section('contenido')
        
    <h2>Horario de Clases</h2>
    <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre del archivo</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @php
                $numero = 1 
            @endphp
            @foreach ($horario as $horarioClase)
                <tr>
                    <th scope="row">{{$numero}}</th>  
                    <td>{{$horarioClase->nombreArchivo}}</td>
                    <td>

                        <form class="fluid" action="{{route('eliminarHorarioAcademico', $horarioClase->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        
                        <a href="{{ route('contenidoCalendarioAcademico', $horarioClase->id) }}" class="btn btn-secondary" target="_blank"><i class="fa-solid fa-eye"></i></a>
                        
                    </td>
                </tr>
                @php
                    $numero++
                @endphp
            @endforeach
            </tbody>
    </table>


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
