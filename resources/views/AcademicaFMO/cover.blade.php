@extends('Layouts.index') 
@section('css-publico')
    <link rel="stylesheet" href="{{ asset('css/cover.css') }}">
@endsection

@section('contenido-publico')
<!-- Modal DEL HORARIO DE ATENCIÓN-->
<div class="modal fade" id="ModalHorario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">HORARIO DE ATENCIÓN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                    </thead>
                    <tbody>
                        
                        @foreach ($horarioLaboral as $item)

                            <tr>
                                <th scope="row"> {{$item->diasLaborales}} </th>
                                <td>De {{ DateTime::createFromFormat('H:i:s', $item->horaInicio)->format('h:i a') }} a {{ DateTime::createFromFormat('H:i:s', $item->horaCierre)->format('h:i a') }}</td>
                                <td>
                                    @if ($item->estadoMedioDia == "abierto")
                                    <th><strong>*Abierto al mediodía</strong></th>
                    
                                    @elseif ($item->estadoMedioDia == "cerrado")
                                        <th><strong>*Cerrado al mediodía</strong></th>

                                    @else
                                        <th></th>
                                    @endif
                                </td>
                                
                            </tr>
                            
                        @endforeach
                        
                    </tbody>
                    
                </table>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
            </div>

        </div>
    </div>
</div>


<div class="offcanvas offcanvas-start modal-z-index" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <div class="row">
            <div class="col-10">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">¿SOBRE CUÁL TRÁMITE NECESITAS INFORMACIÓN?</h5>
            </div>
            <div class="col-2">
                <button type="button" class="btn-close close-z-index" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <div class="offcanvas-body">
    
        <ul class="sidebar-nav">
                    
                    @foreach ($tramitesAcademicos as $item)
                        <li class="sidebar-item">
                            <a href="{{ route('verTramiteAcademico', $item->id) }}" class="sidebar-link"> {{ mb_strtoupper($item->tramite) }} </a>
                        </li>
                    @endforeach

                    
        </ul>


    </div>
</div>


    <div class="container_table">      



        <div class="container">
            
            <div class="row justify-content-between">

                <div class="col-12 col-lg-6 mb-4">
                    <div class="text-container">
                        <h1 class="custom-heading">ADMINISTRACIÓN</h1>
                        <h2 class="custom-subheading">ACADÉMICA FMO</h2>
                    </div>
                    <p class="bienvenidaFMO">Bienvenidos al sitio web oficial de la Unidad de Administración Académica de la Facultad Multidisciplinaria Oriental
                        de la Universidad de El Salvador. Encontrarás información detallada sobre trámites académicos relevantes, así como anuncios y otros aspectos de interés para nuestra comunidad educativa.
                    </p>
                
                    <!-- Botones en forma de lista desde 768px en adelante -->
                    <div class="d-grid gap-2 d-sm-block d-none d-lg-block">

                        <a class="btn btn-primary btn-principal mb-2" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                            <i class="fa-solid fa-file-alt pe-2"></i> Trámites
                        </a>
                        <a class="btn btn-primary btn-principal mb-2" href="{{ route('anuncios') }}">
                            <i class="fa-solid fa-bullhorn pe-2"></i> Anuncios
                        </a>
                        <a class="btn btn-primary btn-principal mb-2" href="{{ route('preguntas') }}">
                            <i class="fa-solid fa-question-circle pe-2"></i> Preguntas
                        </a>
                        <button type="button" class="btn btn-primary btn-principal mb-2" data-bs-toggle="modal" data-bs-target="#ModalHorario">
                            <i class="fa-solid fa-clock"></i> Horario
                        </button>

                    </div>
                
                    <!-- Botones en forma de cuadrícula hasta 768px -->
                    <div class="container d-lg-none">
                        <div class="row text-center justify-content-between">

                            <div class="col-6 col-md-3 mb-3">
                                <a class="btn btn-cuadro" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                    <i class="fa-solid fa-file-alt iconos-cover"></i>
                                    <p>Trámites Académicos</p>
                                </a>
                            </div>
                            <div class="col-6 col-md-3 mb-3">
                                <a class="btn btn-cuadro" href="{{ route('anuncios') }}">
                                    <i class="fa-solid fa-bullhorn"></i>
                                    <p>Anuncios Oficiales</p>
                                </a>
                            </div>
                            <div class="col-6 col-md-3 mb-3">
                                <a class="btn btn-cuadro" href="{{ route('preguntas') }}">
                                    <i class="fa-solid fa-question-circle"></i>
                                    <p>Preguntas Frecuentes</p>
                                </a>
                            </div>

                            <div class="col-6 col-md-3 mb-3">
                                <button type="button" class="btn btn-cuadro" data-bs-toggle="modal" data-bs-target="#ModalHorario">
                                    <i class="fa-solid fa-clock"></i>
                                    <p>Horario de Atención</p>
                                </button>
                            </div>

                        </div>
                    </div>


                </div>
                

                <div class="col-12 col-lg-6 contenedor-carrusel">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            @foreach ($fotosGaleria as $index => $foto)
                                <div class="carousel-item @if($index == 0) active @endif">
                                    <img src="{{ asset('storage/'.$foto->rutaArchivo) }}" class="d-block w-100 carousel-image" alt="...">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                
                
        </div>

        <br>
    </div>


@endsection