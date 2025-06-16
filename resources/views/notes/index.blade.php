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
    <p>ESPACIO PARA SEARCHBAR</p>
    <h2>Mis notas</h2>
    <a href="{{ route('notes.create') }}">Crear Nota</a>
    <ul>
        @foreach ($notes as $note)
    <li>
        <a href="{{ route('notes.show', $note->id) }}">{{ $note->header }}</a>
        <p>{{ $note->text }}</p>

        <p><strong>Fijada:</strong> {{ $note->pinned ? 'Sí' : 'No' }}</p>


        @if ($note->reminder)
            <p><strong>Recordatorio:</strong> {{ $note->reminder ?? '' }}</p>
        @endif

        <div>
            @foreach ($note->images as $image)
                <img src="{{ asset('storage/' . $image->image_url) }}" alt="Imagen de la nota" style="max-width: 300px; max-height: 300px;">
            @endforeach
        </div>


        <form method="POST" action="{{ route('notes.destroy', $note->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
            <a href="{{ route('notes.edit', $note->id) }}">Editar</a>
        </form>
        <br>
    </li>
@endforeach

    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
</body>
</html>
