@extends('Layouts.index') 

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
                            </tr>


                            <tr>

                                @if ($item->estadoMedioDia == "abierto")
                                    <th><strong>*Abierto al mediodía</strong></th>
                    
                                @elseif ($item->estadoMedioDia == "cerrado")
                                    <th><strong>*Cerrado al mediodía</strong></th>

                                @else
                                    <th></th>
                                @endif
                                
                            </tr>
                            
                        @endforeach
                        
                    </tbody>
                    
                </table>

            </div>
        </div>
    </div>
</div>


<!-- Modal DE LAS PREGUNTAS PRECUENTES-->
<div class="modal fade" id="ModalPreguntas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">PREGUNTAS FRECUENTES</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        
      </div>
    </div>
  </div>

    <div class="prueba">
        <button type="button" class="btn iconoOpciones" data-bs-toggle="modal" data-bs-target="#ModalHorario">
            <i class="fa-solid fa-clock"></i>
        </button>
    </div>

    <div class="prueba2">            
        <a href="{{ route('preguntas') }}" class="btn iconoOpciones">
            <i class="fa-solid fa-circle-question"></i>
        </a>
    </div>

    <div class="croquisIcon">            
        <a href="{{ route('pubCroqFMO') }}" class="btn iconoOpciones" target="_blank">
            <i class="fa-solid fa-map-location-dot"></i>
        </a>
    </div>

        
<div class="offcanvas offcanvas-start modal-z-index" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">¿SOBRE CUÁL TRÁMITE NECESITAS INFORMACIÓN?</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
    
        <ul class="sidebar-nav">
                    @foreach ($tramitesAcademicos as $item)
                        <li class="sidebar-item">
                            <a href="{{ route('verTramiteAcademico', $item->id) }}" class="sidebar-link"> {{$item->tramite}} </a>
                        </li>
                    @endforeach
                    
        </ul>


    </div>
</div>


<div class="container__cover">

    <div class="container__info">
        <h1>ADMINISTRACIÓN</h1>
        <h2>ACADÉMICA FMO</h2>
        <p class="bienvenidaFMO">Bienvenidos al sitio web oficial de la Administración Académica de la Facultad Multidisciplinario Oriental
            de la Universidad de El Salvador. Encontrarás información relacionada a trámites académicos de tu interés, así como anuncios,
            entre otros asuntos importantes.</p>

                <a class="btn btn-primary btn-tramites" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                Trámites
                </a>

                <a class="btn btn-primary btn-tramites" href="{{ route('anuncios') }}">
                    Anuncios Oficiales
                    </a>

                    <a class="btn btn-primary btn-tramites" href="{{ route('preguntas') }}">
                        Preguntas Frecuentes
                        </a>

    </div>

    <div class="container__vector">
        <div id="carouselExampleFade" class="carousel slide carousel-fade">
            <div class="carousel-inner">    

                @foreach ($fotosGaleria as $foto)

                    <div class="carousel-item active">
                        <img src="{{asset('storage/'.$foto->rutaArchivo)}}" class="d-block w-100" alt="...">
                    </div>
                    
                @endforeach

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>
    </div>
    
    
</div>

<i class="fa-solid fa-chevron-down fa-3x"></i>


@endsection