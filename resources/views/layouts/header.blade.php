<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href ="{{ route('index') }}">Inicio</a>
    <a href ="{{ route('index') }}">Scrible</a>

    <a href="{{ route('edit-profile') }}">Editar Perfil</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar Sesión</button>
    </form>


</body>
</html>
