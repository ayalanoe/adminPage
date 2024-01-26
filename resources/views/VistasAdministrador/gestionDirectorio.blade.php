@extends('Layouts.dashboard')
@section('titulo', '- Directorio') 
@section('contenido')
<div class="container">
    <h2>DIRECTORIO</h2>
    <p>cONTACTOS DE ACADEMICA...</p>
    <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Encargado</th>
                <th scope="col">Correo Electrónico</th>
                <th scope="col">Trámites a cargo</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @php
                 $numero = 1 
              @endphp
              @foreach ($usuarios as $usuario)
                <tr>
                  <th scope="row">{{$numero}}</th>  
                  <td>{{$usuario->name}}</td>
                  <td>{{$usuario->email}}</td>
                  <td>{{$usuario->email}}</td><!--Actualizar agregando campo tramites-->
                  <td class="d-flex">

                        <form class="formEliminarUsuario" action="{{route('usuarios.destroy', $usuario->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                        </form> 
                        <form class="formEliminarUsuario" action="{{route('usuarios.destroy', $usuario->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary mx-1"><i class="fa-solid fa-pen-to-square"></i></button>
                        </form> 
                    
                    
                    
                    </td>
                </tr>
                @php
                    $numero++
                @endphp
              @endforeach
            </tbody>
      </table>
    </div>

      <div class="container">
        <button type="submit" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#ModalNuevoContacto"><i class="fa-solid fa-user-plus"></i> Nuevo Contacto</button>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="ModalNuevoContacto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Contactos Administrativos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    

                    <form id="formActulizarDatos" action="{{route('actulizarDatosUsuario', Auth::user()->id) }}" method="POST" class="row g-3 needs-validation" novalidate>
                        @csrf

                        <div class="col-md-12">
                            <label for="validationCustomUser" class="form-label">Nombre Completo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-user"></i></span>
                                    <input name="Nombre" type="text" class="form-control" id="validaUser" required value="{{Auth::user()->name}}">
                                <div class="valid-feedback">
                                    Usuario Válido!
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Correo Electrónico</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-at"></i></span>
                                <input name="Correo" type="text" class="form-control" id="validaCorreo" aria-describedby="inputGroupPrepend" required value="{{Auth::user()->email}}">
                                <div class="invalid-feedback">
                                    Please choose a username.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustomCorreo" class="form-label">Trámites a cargo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-list"></i></span>
                                <input name="Correo" type="text" class="form-control" id="validaCorreo" aria-describedby="inputGroupPrepend" required value="{{Auth::user()->email}}">
                                <div class="invalid-feedback">
                                    Please choose a username.
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelPerfil">Cancelar</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="ActualizaPerfil">Crear Contacto</button>
                        </div>

                    </form>

                </div>
                
            </div>
        </div>
    </div>
@endsection

@section('jsVistasAdmin')
  <script>
    $('.formEliminarUsuario').on('submit', function(e){
      e.preventDefault();
      Swal.fire({
        title: "¿Está seguro?",
        text: "Se eliminará el usuario",
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

    $('.formResetPassUsuario').on('submit', function(event){
      event.preventDefault();
      Swal.fire({
        title: "¿Está seguro?",
        text: "Se restablecerá la contraseña",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, restablecer"
      }).then((result) => {
        if (result.isConfirmed) {
          this.submit()
        } 
      });
    })
    
  </script>


  @if (Session::has('usuarioEliminarRespuesta'))
    <script>
      Swal.fire({
          title: "Informacion",
          text: "{{ session('usuarioEliminarRespuesta') }}",
          icon: "success"
      });
    </script>  
  @endif

  @if (Session::has('usuarioRestPassRespuesta'))
    <script>
      Swal.fire({
          title: "Informacion",
          text: "{{ session('usuarioRestPassRespuesta') }}",
          icon: "success"
      });
    </script>  
  @endif
    
@endsection