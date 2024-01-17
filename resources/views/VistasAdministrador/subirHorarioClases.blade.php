<!-- resources/views/subir_archivo.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivo</title>
    <link rel="stylesheet" href="{{ asset('css/cssAdministrador/estiloSubirHorario.css')}}">
</head>
<body>
    <div class="formulario">
        <h2>Subir Horario de Clases</h2>

        <!-- Esta parte es para mostrar un mensaje si se subio el archivo correctamente -->
        @if(session('mensaje'))
            <div style="color: green; margin-bottom: 10px;">{{ session('mensaje') }}</div>
        @endif
        
        
        <form method="post" enctype="multipart/form-data">
            @csrf
            <label for="nombreArchivo">Nombre del Archivo:</label>
            <input type="text" name="nombreArchivo" required>
            
            <label for="archivo">Seleccionar Archivo (PDF o Imagen):</label>
            <input type="file" name="archivo" accept=".pdf, .jpg, .jpeg, .png" required>
            
            <button type="submit">Subir Archivo</button>
        </form>
    </div>
</body>
</html>
