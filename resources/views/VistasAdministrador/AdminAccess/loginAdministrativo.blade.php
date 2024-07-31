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

    <!-- Modal -->
    <div class="modal fade" id="modalLoginAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Ayuda</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <ul>
                        <li><b>Nombre de usuario:</b></li>
                            <ul>
                                <li>Digite el nombre de su usuario institucional o carnet, sin
                                    @ues.edu.sv
                                </li>
                            </ul>
                        <li><b>Contraseña:</b></li>
    
                            <ul>
                                <li>Digite la contraseña de su usuario institucional</li>
                            </ul>
                        
                        <li><b>Código de verificación:</b></li>
                            <ul>
                                <li>Digite el código númerico enviado a su correo electrónico
                                    institucional (@ues.edu.sv)
                                </li>
                            </ul>
                    </ul>
                </div>
            </div>
            
        </div>
        </div>
    </div>


    <div class="login-container">
        <img src="{{ asset('imagesAdmin/usuario.png') }}" alt="LogoUser">
        <h2>Bienvenido</h2>

        <form action="{{ route('inicia-sesion') }}" method="post">
            @csrf
            
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Continuar</button>
        </form>

        <a href="#" data-bs-toggle="modal" data-bs-target="#modalLoginAdmin">Ayuda</a>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
