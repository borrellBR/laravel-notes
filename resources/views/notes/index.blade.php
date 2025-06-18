
@include ('layouts.main-header')
<br>

<div class="display-inline" style="display: flex; justify-content: center; align-items: center; width: 100%; gap: 20px;">

    <form action="{{ route('notes.search') }}" method="GET" class="form-inline" style="flex: 1; display: flex; justify-content: center; align-items: center;">
        <div class="form-group" style="width: 80%;">
            <input type="text" name="search" class="form-control" placeholder="Search Notes" style="width: 100%;">
        </div>
    </form>

    <form action="{{ route('notes.search-date') }}" method="GET" class="form-inline" style="flex: 1; display: flex; justify-content: center; align-items: center;">
        <div class="form-group" style="width: 80%;">
            <input type="date" name="search" class="form-control" placeholder="Search Notes by Date" style="width: 100%;">
        </div>
        <button type="submit" class="btn btn-primary ml-2">Search</button>
    </form>

</div>

    <div class="display-inline" style="display: flex; justify-content: space-between; align-items: center;">
        <h3 class="col-md-4">Mis notas</h3>
        <a class="col-md-4 col-md-offset-9" href="{{ route('notes.create') }}">Crear Nota</a>
    </div>
    <hr style="border: 1px solid #cbc9c9; margin: 20px 0;">

    <div style="margin:4rem;" class="row">
        @foreach ($notes as $note)
            <div class="col-sm-3 d-flex">
                <div class="card w-100">
                    <div class="card-body">
                        <a href="{{ route('notes.show', $note->id) }}">{{ $note->header }}</a>
                        <p>{{ $note->text }}</p>
                        <div>
                            @foreach ($note->images as $image)
                                <img src="{{ asset('storage/' . $image->image_url) }}" alt="Imagen de la nota" style="max-width: 100%; height: auto;">
                            @endforeach

                                <div style="display: flex; align-items: center; justify-content: flex-end;">

                                    <form method="POST" action="{{ route('notes.destroy', $note->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Eliminar</button>
                                    </form>
                                    <a href="{{ route('notes.edit', $note->id) }}">Editar</a>
                                    <button class="pin-btn" data-id="{{ $note->id }}" style="display: flex; align-items: center; gap: 5px;">
                                        @if ($note->pinned)
                                            <i class="fi fi-sr-thumbtack"></i>
                                                 @else
                                            <i class="fi fi-rr-thumbtack"></i>
                                         @endif
                                    </button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

     {{-- @if ($note->reminder)
                                        <p><strong>Recordatorio:</strong> {{ $note->reminder }}</p>
                                    @endif --}}


    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif



