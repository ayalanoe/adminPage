@extends('Layouts.index') 

@section('titulo-publico', '- Diplomados detalles')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cssPublic/PlanesStyle/infoDiplomado.css') }}">
     <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">
@endsection

@section('contenido-publico')

    <div class="container margen-titulo">

        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <h3 class="title-text text-center">{{ mb_strtoupper ($diplomadoInfo->carrera) }}</h3>
            </div>
        </div>

        <div class="container_table">

            <div class="container">
                <p class="card-text">¡La Facultad Multidisciplinaria Oriental te invita a ser parte del diplomado {{ mb_strtoupper ($diplomadoInfo->carrera) }}!</p>
                <p class="card-text">Para obtener más información y asegurar tu lugar, contáctanos a través de nuestro canal oficial:
                    <a href="https://wa.link/jimdzt" target="_blank">WhatsApp</a>
                </p>

                <img src="{{asset('storage/'.$diplomadoInfo->rutaArchivo)}}" class="d-block w-100" alt="...">

            </div>

        </div>

    </div>

@endsection 