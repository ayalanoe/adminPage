

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

    <div class="scheduleIcon iconoOpciones">
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#ModalHorario">
            <i class="fa-solid fa-clock"></i>
        </button>
    </div>

    <div class="questionsIcon iconoOpciones">            
        <a href="{{ route('preguntas') }}">
            <i class="fa-solid fa-circle-question"></i>
        </a>
    </div>

    <div class="croquisIcon iconoOpciones">            
        <a href="{{route('verPdfCroquis')}}" target="_blank">
            <i class="fa-solid fa-map-location-dot"></i>
        </a>
    </div>
    <div class="FacebookIcon iconoOpciones">            
        <a href="https://www.facebook.com/fmoues.oficial" target="_blank">
            <i class="fa-brands fa-facebook"></i>
        </a>
    </div>

        
<div class="offcanvas offcanvas-start modal-z-index" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <div class="row">
            <div class="col-10">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">¿SOBRE CUÁL TRÁMITE NECESITAS INFORMACIÓN?</h5>
            </div>
            <div class="col-2">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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


<div class="container__cover">

    <div class="container__info">
        <h1>ADMINISTRACIÓN</h1>
        <h2>ACADÉMICA FMO</h2>
        <p class="bienvenidaFMO">Bienvenidos al sitio web oficial de la Unidad de Administración Académica de la Facultad Multidisciplinaria Oriental
            de la Universidad de El Salvador. Encontrarás información detallada sobre trámites académicos relevantes, así como anuncios y otros aspectos de interés para nuestra comunidad educativa.</p>

                <a class="btn btn-primary btn-principal" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                Trámites
                </a>

                <a class="btn btn-primary btn-principal" href="{{ route('anuncios') }}">
                    Anuncios Oficiales
                    </a>

                    <a class="btn btn-primary btn-principal" href="{{ route('preguntas') }}">
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



@endsection