<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/login.css') }}">
</head>
<body>

    <div class="navbar">
        <img src="{{ asset('imagesAdmin/minerva.png') }}" alt="Logo">
        
        <h4>Administracion Academica - FMO</h4>
    </div>

    <div class="login-container">
        <img src="{{ asset('imagesAdmin/usuario.png') }}" alt="LogoUser">
        <h2>Crear Usuario</h2>
        <form action="#" method="post">
            <label for="name">Nombre de usuario:</label>
            <input type="text" id="newUser" name="nameUser" required>
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="emailNuevoUser" name="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="passwordNuser" name="password" required>

            <button type="submit">Registrar</button>
        </form>

        <a href="#">Ayuda</a>
    </div>

</body>
</html>
