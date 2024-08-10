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
        <form id="formCrearUsuario" action="{{ route('validar-registro') }}" method="post">
            @csrf
            <label for="name">Nombre de usuario:</label>
            <input type="text" id="newUser" name="name" required>
            <label for="rol">Rol de usuario:</label>
            <select name="rolUsuario" id="userTipo" class="form-select" aria-label="Default select example">
                <option value="" selected>Seleccione una opcion</option>
                <option value="1">Administrador</option>
                <option value="2">Asistente</option>
            </select>
            <br>
            <label for="genero">Género de usuario:</label>
            <select name="generoUsuario" id="generoUsu" class="form-select" aria-label="Default select example">
                <option value="" selected>Seleccione una opcion</option>
                <option value="1">Femenino</option>
                <option value="2">Masculino</option>
            </select>
            <br>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="emailNuevoUser" name="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="passIngresar" name="password" required>
            <label for="password">Confirmar Contraseña:</label>
            <input type="password" id="passConfirmar" name="password2" required>
            
            <button type="submit">Registrar</button>
        </form>
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

    <!-- Codigo de validacion y respues para el modal del cambiar password -->
    <script>
        $('#formCrearUsuario').on('submit', function(e){
            e.preventDefault();
    
            var usuarioWeb = $('#userTipo').val();
            var passwordIn = $('#passIngresar').val();
            var passwordConfirmar = $('#passConfirmar').val();
            var email = $('#emailNuevoUser').val();
            var generoUsuario = $('#generoUsu').val();
    
            // Verificar que se haya seleccionado una opción de tipo de usuario
            if (usuarioWeb === "") {
                Swal.fire({
                    title: "Información",
                    text: "Por favor seleccione un tipo de usuario",
                    icon: "error"
                });
                return;
            }

            // Validar el correo electrónico
            if (!isValidEmail(email)) {
                Swal.fire({
                    title: "Informacion",
                    text: "Por favor ingrese un correo institucional válido(@ues.edu.sv)",
                    icon: "error"
                });
                return;
            }
    
            // Validar las contraseñas
            if (!isValidPassword(passwordIn)) {
                Swal.fire({
                    title: "Informacion",
                    text: "La contraseña debe tener al menos 6 caracteres, una mayúscula y un número",
                    icon: "error"
                });
                return;
            }
    
            // Verificar que las contraseñas coincidan
            if (passwordIn !== passwordConfirmar) {
                Swal.fire({
                    title: "Informacion",
                    text: "Las contraseñas no coinciden",
                    icon: "error"
                });
                return;
            }

            // Verificar que se haya seleccionado una opción de género
            if (generoUsuario === "") {
                Swal.fire({
                    title: "Información",
                    text: "Por favor seleccione una opción para el género",
                    icon: "error"
                });
                return;
            }
            
            // Si la validación es exitosa, enviar el formulario
            this.submit();
        });
    
        function isValidEmail(email) {
            // Expresión regular para validar el correo electrónico de la UES
            var regex = /^[a-zA-Z0-9._-]+@ues\.edu\.sv$/;
            return regex.test(email);
        }
    
        function isValidPassword(password) {
            // La contraseña debe tener al menos 6 caracteres, una mayúscula y un número
            var regex = /^(?=.*[A-Z])(?=.*\d).{6,}$/;
            return regex.test(password);
        }
    </script>
    
@endsection

