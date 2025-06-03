<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>scribl</h1>

    <h2>Editar Perfil</h2>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>




    <h2>Notas</h2>
    <h2>Añadir</h2>


    <p>Bienvenido a tu aplicación de notas.</p>

    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
</body>
</html>
