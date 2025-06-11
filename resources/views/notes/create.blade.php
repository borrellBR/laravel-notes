<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@include ('layouts.header')
    <h1>Crear Nota</h1>


<form method="POST" action="{{ route('notes.store') }}">
    @csrf

    <label for="header">Encabezado</label>
    <input type="text" name="header" id="header" required>
<br>
    <label for="text">Texto</label>
    <textarea name="text" id="text" required></textarea>
    <br>
    <input type="hidden" name="pinned" value="0">
    <label for="pinned">Fijar</label>
    <input type="checkbox" name="pinned" id="pinned" value="1">
    <br>
    <label for="reminder">Recordatorio</label>
    <input type="date" name="reminder" id="reminder">
    <br><br>
    <button type="submit">Guardar</button>
</form>


    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
</body>
</html>
