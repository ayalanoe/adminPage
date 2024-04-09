@extends('Layouts.index') 

@section('titulo-publico', '- Anuncios Académicos')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/anunciosPublic.css') }}">
@endsection

@section('contenido-publico')

    <div class="container">
        <h3>ANUNCIOS ACADÉMICOS</h3>
        <i class="fa-solid fa-chevron-down fa-3x"></i>
    </div>

        
    <div class="container">
        <!-- contenedor de tarjetas de plataformas-->
        <div class="row">

            @foreach ($anunciosAcademicos as $anuncio)
                <div class="col-12 col-md-4 d-flex">
                    <div class="card flex-fill border-0 illustration" style="width: 18rem;">
                        <img src="{{ asset('images/fmo.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"> {{$anuncio->titulo}} </h5>
                            <p>Publicacion: {{ date('d-m-Y', strtotime($anuncio->fechaPublicacion)) }}</p>
                            <p class="card-text">{!! Str::limit($anuncio->cuerpo, $limit = 100, $end = ' ...') !!} </p>
                            <a href="#" class="btn btn-primary">Leer más</a>
                        </div>
                    </div>  
                </div> 
            @endforeach

        </div>
    </div>

@endsection