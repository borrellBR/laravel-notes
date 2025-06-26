
    @include('layouts.main-header')

    <div class="searchbars">
        <form action="{{ route('notes.search') }}" method="GET" class="searchbox">
            <div class="search-input">
                <input type="text" name="search" class="search-text" placeholder=" 🔎 Buscar…">
            </div>
        </form>

        <form action="{{ route('notes.search-date') }}" method="GET" class="searchbox">
            <div class="search-input">
                <input type="date" name="search" class="search-text" placeholder="Buscar por fecha">
                <button type="submit" class="btn btn-primary ml-2 btn-hidden">Search</button>
            </div>
        </form>
    </div>

    <div class="notas-title">
        <h3>Mis notas</h3>
        <a id="añadir-nota" href="{{ route('notes.create') }}">
            <i class="fi fi-br-plus"></i> Añadir
        </a>
    </div>

    <hr class="hr-gray">

    <div id="notes-grid" class="row">

    @forelse($notes as $note)
        <div class="note-col col-sm-3 d-flex">
            <a href="{{ route('notes.show', $note->id) }}" class="note-link">
                <div class="card note-card">
                    <div class="card-body note-body">

                        <strong class="note-title">{{ $note->header }}</strong>

                        @if($note->images->isEmpty())
                            <p class="note-text">{{ $note->text }}</p>
                        @else
                            <img src="{{ asset('storage/' . $note->images->first()->image_url) }}"
                                 class="note-image" alt="Imagen de la nota">
                        @endif

                        <div class="actions">

                            <form method="POST" action="{{ route('notes.destroy', $note->id) }}">
                                @csrf @method('DELETE')
                                <button class="btn-icon"><i class="fi fi-ss-trash"></i></button>
                            </form>


                            <form method="GET" action="{{ route('notes.edit', $note->id) }}">
                                <button class="btn-icon"><i class="fi fi-sr-pencil"></i></button>
                            </form>

                            <button class="btn-icon pin-btn" data-id="{{ $note->id }}">
                                @if($note->pinned)
                                    <i class="fi fi-sr-thumbtack"></i>
                                @else
                                    <i class="fi fi-rr-thumbtack"></i>
                                @endif
                            </button>
                        </div>

                    </div>
                </div>
            </a>
        </div>
    @empty
        <div class="no-notes">
            <h3>¡Oops!</h3><h3>Parece que tus notas están vacías :(</h3>
        </div>
    @endforelse
    </div>

    @if(session('status'))
        <div>{{ session('status') }}</div>
    @endif
