@extends('Layouts.dashboard')
@section('titulo', '- Gestión de Usuarios') 
@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/textoGestionGlobal.css') }}">   
@endsection
@section('contenido')
<div class="container">
    <h2 class="global-tittle">GESTIÓN DE USUARIOS EN SITIO WEB</h2>
    <hr>
    <br>
    
    <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo Electrónico</th>
                <th scope="col">Rol de usuario</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @php
                $numero = 1 
              @endphp
              @foreach ($usuarios as $usuario)

                @if ($usuario->id !== Auth::user()->id)
                  <tr>
                    <th scope="row">{{$numero}}</th>  
                    <td>{{$usuario->name}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>
                      @if($usuario->rol == 1)
                          Admin
                      @elseif($usuario->rol == 2)
                          Asistente
                      @endif
                  </td>
                    <td class="d-flex">

                      <form class="formEliminarUsuario" action="{{route('usuarios.destroy', $usuario->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mx-1"><i class="fa-solid fa-trash"></i></button>
                      </form> 
                      
                      <form class="formResetPassUsuario" action="{{ route('resetPass', $usuario->id)}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-secondary mx-1">Restablecer contraseña</button>
                      </form>
                      
                    </td>
                  </tr>
                  @php
                      $numero++
                  @endphp
                @endif

              @endforeach
            </tbody>
      </table>
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
        text: "Se restablecerá la contraseña del usuario. Nueva contraseña: academica.24fmo",
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