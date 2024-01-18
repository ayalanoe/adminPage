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
        <img src="minerva.png" alt="Logo">
        <h4>Administracion Academica - FMO</h4>
    </div>

    <div class="login-container">
        <img src="pass.png" alt="Logo">
        <h2>Bienvenido, nombre</h2>
        <form action="#" method="post">
            <label for="email">Contraseña:</label>
            <input type="password" id="email" name="email" required>

            <button type="submit">Iniciar Sesión</button>
        </form>

        <a href="#">Ayuda</a>
    </div>

</body>
</html>
