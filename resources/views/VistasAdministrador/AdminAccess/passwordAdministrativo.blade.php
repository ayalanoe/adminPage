<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="shortcut icon" href="{{ asset('iconoFacultad/logoues.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/password.css') }}">
</head>
<body>

    <div class="navbar">
        <img src="{{ asset('imagesAdmin/minerva.png') }}" alt="Logo">
        <h4>Administracion Academica - FMO</h4>
    </div>

    <div class="login-container">
        <img src="{{ asset('imagesAdmin/pass.png') }}" alt="Logo">
        <h2>¡Hola, {{Session::get('userName')}}! </h2>
        <br>
        @if(session('error'))
            <div id="alertPass" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('validar-password') }}" method="post">
            @csrf
            <label for="email">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Espera 5 segundos (5000 milisegundos) y luego oculta la alerta
        setTimeout(function() {
            var alert = document.getElementById('alertPass');
            if (alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close(); // Cierra la alerta usando el método de Bootstrap

                // Ajusta la altura de la tarjeta después de que se cierre la alerta
                var loginContainer = document.querySelector('.login-container');
                setTimeout(function() {
                    loginContainer.style.height = 'auto'; // Vuelve a la altura automática basada en el contenido
                }, 4000); // Tiempo de espera para que la transición de Bootstrap termine antes de ajustar la altura
            }
        }, 5000);
    </script>
</body>
</html>
