@extends('Layouts.index') 

@section('titulo-publico', '- Anuncios Académicos')

@section('css-publico')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/anunciosPublic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tituloEncabezadoGlobal.css') }}">

    <!-- Link de css para darle formato a la tabla que se crea con el CKeditor desde el admin -->
    <link rel="stylesheet" href="{{ asset('css/formatoTablaCKEditor.css') }}">
@endsection

@section('contenido-publico')

    <div class="container margen-titulo">

        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <h3 class="title-text text-center">ANUNCIOS ACADÉMICOS</h3>
            </div>
        </div>

        <div class="container_table">

            @if ($anunciosAcademicos->isEmpty())
                <div class="alert alert-success text-center">
                    No hay registro
                </div>
                <br><br><br><br><br>
            @else
                
            <div class="row">

                @foreach ($anunciosAcademicos as $anuncio)
                    <div class="col-12 col-md-4 d-flex">
                        <div class="card flex-fill custom-card" style="width: 18rem;">
                            <img src="{{ asset('images/fmo.png') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"> {{$anuncio->titulo}} </h5>
                                <p>Publicacion: {{ date('d-m-Y', strtotime($anuncio->fechaPublicacion)) }}</p>
                                <p class="card-text">{!! Str::limit($anuncio->cuerpo, $limit = 40, $end = ' ...') !!} </p>
                                <button type="button" class="btn btn-ver" data-bs-toggle="modal" data-bs-target="#modalAnuncios{{$anuncio->id}}">
                                    Leer más
                                </button>
        
                            </div>
                        </div>  
                    </div> 
    
                    <!-- Modal -->
                    <div class="modal fade" id="modalAnuncios{{$anuncio->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ mb_strtoupper($anuncio->titulo) }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {!! $anuncio->cuerpo !!}
                                    @if ($anuncio->rutaArchivo)
                                        <img src="{{ asset('storage/' . $anuncio->rutaArchivo) }}" class="d-block w-100" alt="...">
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
    
                    
                @endforeach

            @endif
        </div>

        <br>
    </div>


@endsection