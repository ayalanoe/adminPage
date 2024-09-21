<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="shortcut icon" href="{{ asset('iconoFacultad/logoues.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/login.css') }}">
</head>
<body>

    <div class="navbar">
        <img src="{{ asset('imagesAdmin/minerva.png') }}" alt="Logo">
        
        <h4>Administracion Academica - FMO</h4>
    </div>

    <div class="login-container">
        <img src="{{ asset('imagesAdmin/usuario.png') }}" alt="LogoUser">
        <h2>Inicio de Sesión</h2>
        <br>
        @if(session('error'))
            <div id="alertCorreo" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('inicia-sesion') }}" method="post">
            @csrf
            
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Continuar</button>
            
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Se demora 5 segundos (5000 milisegundos) y luego oculta la alerta
        setTimeout(function() {
            var alert = document.getElementById('alertCorreo');
            if (alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close(); // Cierra la alerta usando el método de Bootstrap bsAlert

                // Con esto se ajusta la altura de la tarjeta después de que se cierre la alerta
                var loginContainer = document.querySelector('.login-container');
                setTimeout(function() {
                    loginContainer.style.height = 'auto'; // Vuelve a la altura automática basada en el contenido de loginContainer
                }, 8000); 
            }
        }, 5000);
    </script>
</body>
</html>
