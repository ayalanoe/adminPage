<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HOLA ADMIN @auth {{Auth::user()->name}} @endauth</h1>
    <a href="{{ route('logout') }}"><button>Salir</button></a>
</body>
</html>