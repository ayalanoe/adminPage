@extends('Layouts.dashboard')

<!--Titulo de la pagina, es decir el que aparece en la pestaña, recibe dos parametros
    el parametro 'titulo' es obligatorio y el otro parametro es el nombre que queramos que aparezca en la pestaña
-->
@section('titulo', '- Registro de Usuarios') 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/registroUsuarios.css') }}">
@endsection

@section('contenido')
        
    <div class="login-container">
        <img src="{{ asset('imagesAdmin/usuario.png') }}" alt="LogoUser">
        <h2>Crear Usuario</h2>
        <form action="{{ route('validar-registro') }}" method="post">
            @csrf
            <label for="name">Nombre de usuario:</label>
            <input type="text" id="newUser" name="name" required>
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="emailNuevoUser" name="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="passwordNuser" name="password" required>
            <label for="rol">Rol de usuario:</label>

            <select name="rolUsuario" class="form-select" aria-label="Default select example">
                <option selected>Selccione una opcion</option>
                <option value="1">Administrador</option>
                <option value="2">Asistente</option>
            </select>

            <button type="submit">Registrar</button>
        </form>

        <a href="#">Ayuda</a>
    </div>

@endsection

@section('jsVistasAdmin')
    @if (Session::has('crearUsuarioRespuesta'))
        <script>
            Swal.fire({
                title: "Informacion",
                text: "{{ session('crearUsuarioRespuesta') }}",
                icon: "success"
            });
        </script>   
    @endif
@endsection

