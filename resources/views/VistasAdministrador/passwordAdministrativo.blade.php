<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/password.css') }}">
</head>
<body>

    <div class="navbar">
        <img src="{{ asset('imagesAdmin/minerva.png') }}" alt="Logo">
        <h4>Administracion Academica - FMO</h4>
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

        <a href="#">Ayuda</a>
    </div>

</body>
</html>
