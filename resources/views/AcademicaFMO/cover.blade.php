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
                            <th scope="row"> {{$item->dias}} </th>
                            <td>De {{ DateTime::createFromFormat('H:i:s', $item->horaInicio)->format('h:i a') }} a {{ DateTime::createFromFormat('H:i:s', $item->horaCierre)->format('h:i a') }}</td>
                        </tr>
                    
                        <tr>
                            <th scope="row"> {{$item->otrosDias}} </th>
                            <td>De {{ DateTime::createFromFormat('H:i:s', $item->horaInicioOtro)->format('h:i a') }} a {{ DateTime::createFromFormat('H:i:s', $item->horaCierreOtro)->format('h:i a') }} </td>
                        </tr>

                            <tr>
                                @if ($item->estadoMediodia == "abierto")
                                    <th><strong>*Abierto al mediodía</strong></th>
                                @else
                                    <th><strong>*Cerrado al mediodía</strong></th>
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
            <button type="button" class="btn iconoOpciones" data-bs-toggle="modal" data-bs-target="#ModalPreguntas">
                <i class="fa-solid fa-circle-question"></i>
            </button>
    </div>

        
<div class="offcanvas offcanvas-start modal-z-index" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">¿SOBRE CUÁL TRÁMITE NECESITAS INFORMACIÓN?</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
    
        <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">CERTIFICACIONES DE NOTAS</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Equivalencias</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">EXPEDIENTES DE GRADUACIÓN</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Cambio de Carrera</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Traslado</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Retiro Oficial</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Activación</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Reingreso</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Modificar/Actualizar Nombre</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Recuperar contraseña del EEL</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Confrontación de documentos</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Otros</a>
                    </li>
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
                Ver Trámites Académicos
                </a>

                <a class="btn btn-primary btn-tramites" href="{{ route('anuncios') }}">
                    Anuncios Oficiales
                    </a>

    </div>

    <div class="container__vector">
        <div id="carouselExampleFade" class="carousel slide carousel-fade">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="data:image/jpeg;base64,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" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="https://diarioelsalvador.com/wp-content/uploads/2022/09/IMG-20220913-WA0040.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1pwbDB9CMZxIbPkMSA2nreJmC0AdLrjamPA&usqp=CAU" class="d-block w-100" alt="...">
              </div>
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