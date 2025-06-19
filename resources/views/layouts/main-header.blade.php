<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@flaticon/flaticon-uicons/css/all/all.css" rel="stylesheet">
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

    <title>Document</title>
</head>
<body>


<nav style="display: flex; justify-content: flex-end; align-items: center; gap: 1rem; padding: 10px;">
    <a href="{{ route('edit-profile.get') }}">Editar perfil</a>

    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
        @csrf
        <button type="submit" style="background: none; border: none; padding: 0; color: blue; cursor: pointer;">
            Cerrar sesión
        </button>
    </form>
</nav>

<div style="text-align: center; margin-top: 10px;">
    <img src="Scribl.png" alt="Scribl Logo" style="max-width:15rem">
</div>

</body>
</html>
