
@include ('layouts.main-header')
<br>

    <form action ="{{route('notes.search')}}" method ="GET">
        <input type = "text" name = "search" placeholder = "Search Notes">
        <button type = "submit">Search </button>
    </form>

    <form action ="{{route('notes.search-date')}}" method ="GET">
        <input type = "date" name = "search" placeholder = "Search Notes by Date">
        <button type = "submit">Search </button>
    </form>

   <h2>Mis notas</h2>
    <a href="{{ route('notes.create') }}">Crear Nota</a>
    <ul>
        @foreach ($notes as $note)
    <li>
        <a href="{{ route('notes.show', $note->id) }}">{{ $note->header }}</a>
        <p>{{ $note->text }}</p>

        <div>
            <p><strong>Pinned:</strong> {{ $note->pinned ? 'Si' : 'No' }}</p>
        </div>

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

