<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <title>Document</title>
</head>
<body>
    <nav style="display: flex; align-items: center; gap: 1rem;">

    <a href ="{{ route('index') }}">
        <img src="Scribl.png" alt="Scribl Logo" style="max-width:5rem">
    </a>

    <a href="{{ route('edit-password.get') }}">Editar contraseña</a>
    </nav>
</body>
</html>

