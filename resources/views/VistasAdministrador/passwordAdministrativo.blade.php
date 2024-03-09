<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="shortcut icon" href="{{ asset('iconoFacultad/logoues.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/password.css') }}">
</head>
<body>

    <div class="navbar">
        <img src="{{ asset('imagesAdmin/minerva.png') }}" alt="Logo">
        <h4>Administracion Academica - FMO</h4>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalPassAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            ...
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </div>

    <div class="login-container">
        <img src="{{ asset('imagesAdmin/pass.png') }}" alt="Logo">
        <h2>Bienvenido, nombre</h2>

        <form action="{{ route('validar-password') }}" method="post">
            @csrf
            <label for="email">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Iniciar Sesión</button>
        </form>

        <a href="#" data-bs-toggle="modal" data-bs-target="#modalPassAdmin">Ayuda</a>
    </div>

</body>
</html>
