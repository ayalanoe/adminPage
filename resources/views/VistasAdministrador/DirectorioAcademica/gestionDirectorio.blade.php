@extends('Layouts.dashboard')
@section('titulo', '- Directorio') 

@section('contenido')
  <div class="container">
    <h2 class="global-tittle">GESTIÓN DEL DIRECTORIO ADMINISTRATIVO</h2>
    <br>
    <div class="container">
      <button type="submit" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#ModalNuevoContacto"><i class="fa-solid fa-user-plus"></i> Nuevo Contacto</button>
    </div>
    <br><br>
    @if ($directorio->isEmpty())
            <div class="alert alert-empty text-center">
                ¡No se creado el directorio!
            </div>
            <br><br><br><br><br>
      @else
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Encargado</th>
            <th scope="col">Correo Electrónico</th>
            <th scope="col">Contacto</th>
            <th scope="col">Trámites a cargo</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @php
            $numero = 1 
          @endphp

          @foreach ($directorio as $contacto)
            <tr>
              <th scope="row">{{$numero}}</th>  
              <td>{{$contacto->nombre}}</td>
              <td>{{$contacto->correo}}</td>
              <td>{{$contacto->contacto}}</td>
              <td>{{$contacto->tramitesAsignado}}</td><!--Actualizar agregando campo tramites-->
              <td class="d-flex">

                <form class="formEliminarContacto" action="{{route('eliminarContacto', $contacto->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                </form> 

                <button type="button" class="btn btn-primary mx-1 btnAbrirModalEditarContacto" data-bs-toggle="modal" data-bs-target="#modalEditarContacto{{$contacto->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
              </td>
            </tr>
            @php
              $numero++
            @endphp
          @endforeach
        </tbody>
      </table>
      @endif
  </div>

  <!-- Modal Para ingresar un contacto-->
  <div class="modal fade" id="ModalNuevoContacto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Contactos Administrativos</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form id="formEnviarContacto" action="{{ route('insertarContacto') }}" method="POST" class="row g-3 needs-validation" novalidate>
            @csrf

            <div class="col-md-12">
              <label for="validationCustomUser" class="form-label">Nombre Completo</label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-user"></i></span>
                <input name="nombreContacto" type="text" class="form-control" id="validaUser" required>
                <div class="invalid-feedback">
                  Ingrese un nombre!
                </div>
              </div>
            </div>
                        
            <div class="col-md-12">
              <label for="validationCustomCorreo" class="form-label">Correo Electrónico</label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-at"></i></span>
                <input name="correoContacto" type="text" class="form-control" id="validaCorreo" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                  Ingrese un correo!
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <label for="validationCustomCorreo" class="form-label">Contacto</label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-address-book"></i></span>
                <input name="numeroContacto" type="text" class="form-control" id="validaCorreo" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                  Ingrese un numero telefónico!
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <label for="validationCustomCorreo" class="form-label">Trámites a cargo</label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-list"></i></span>
                <textarea name="tramitesAcargo" type="text" class="form-control" id="validaCorreo" aria-describedby="inputGroupPrepend" required></textarea>
                <div class="invalid-feedback">
                  Ingrese un texto.
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelContacto">Cancelar</button>
              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="btnCrearContacto">Crear Contacto</button>
            </div>

          </form>

        </div>       
      </div>
    </div>
  </div>

  @foreach ($directorio as $contactoId)

    <div role="" class="modal fade" id="modalEditarContacto{{$contactoId->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar contacto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="{{ route('editarContacto', $contactoId->id) }}" id="formEditarContacto" method="POST" class="row g-3 needs-validation" novalidate>
              @csrf

              <div class="col-md-12">
                <label for="validationCustomUser" class="form-label">Nombre Completo</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-user"></i></span>
                  <input value="{{$contactoId->nombre}}" name="editarNombreContacto" type="text" class="form-control" id="txtEditarNombreContacto" required>
                  <div class="invalid-feedback">
                    Ingrese un nombre !
                  </div>
                </div>
              </div>
                          
              <div class="col-md-12">
                <label for="validationCustomCorreo" class="form-label">Correo Electrónico</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-at"></i></span>
                  <input value="{{$contactoId->correo}}" name="editarCorreoContacto" type="text" class="form-control" id="txtEditarCorreoContacto" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Ingrese un correo !
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <label for="validationCustomCorreo" class="form-label">Contacto</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-address-book"></i></span>
                  <input value="{{$contactoId->contacto}}" name="editarNumeroContacto" type="text" class="form-control" id="txtEditarContacto" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Ingrese un numero telefónico !
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <label for="validationCustomCorreo" class="form-label">Trámites a cargo</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-list"></i></span>
                  <textarea name="editarTramitesAcargo" type="text" class="form-control" id="txtEditarTramiteContacto" aria-describedby="inputGroupPrepend" required>{{$contactoId->tramitesAsignado}}</textarea>
                  <div class="invalid-feedback">
                    Ingrese un texto !
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelEditarContacto">Cancelar</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="btnEditarContacto">Guardar Cambios</button>
              </div>

            </form>

          </div>       
        </div>
      </div>
    </div>
      
  @endforeach

@endsection

@section('jsVistasAdmin')
  <script>
    $('.formEliminarContacto').on('submit', function(e){
      e.preventDefault();
      Swal.fire({
        title: "¿Está seguro?",
        text: "Se eliminará el contacto",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar"
      }).then((result) => {
        if (result.isConfirmed) {
          this.submit()
        } 
      });
    })
  </script>


  @if (Session::has('respuestaContactoCrear'))
    <script>
      Swal.fire({
          title: "Informacion",
          text: "{{ session('respuestaContactoCrear') }}",
          icon: "success"
      });
    </script>  
  @endif

  @if (Session::has('contactoEliminarRespuesta'))
    <script>
      Swal.fire({
        title: "Informacion",
        text: "{{ session('contactoEliminarRespuesta') }}",
        icon: "success"
      });
    </script>  
  @endif

  @if (Session::has('respuestaEditarContacto'))
    <script>
      Swal.fire({
        title: "Informacion",
        text: "{{ session('respuestaEditarContacto') }}",
        icon: "success"
      });
    </script>  
  @endif

  @if (Session::has('errorContacto'))
    <script>
      Swal.fire({
        title: "Informacion",
        text: "{{ session('errorContacto') }}",
        icon: "error"
      });
    </script>  
  @endif

    
@endsection