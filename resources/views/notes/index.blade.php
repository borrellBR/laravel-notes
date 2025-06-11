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
    <p>AQUI IRA LA SEARCHBAR QUE AUN NO ESTA HECHA</p>
    <h2>Mis notas</h2>
    <a href="{{ route('notes.create') }}">Crear Nota</a>
    <ul>
        @foreach ($notes as $note)
            <li>
                <a href="{{ route('notes.show', $note->id) }}">{{ $note->header }}</a>
                <p>{{ $note->text }}</p>
                <form method="POST" action="{{ route('notes.destroy', $note->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                    <a href="{{ route('notes.edit', $note->id) }}">Editar</a>
                </form>
            </li>
        @endforeach

    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
</body>
</html>
