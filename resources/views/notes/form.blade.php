@include('layouts.show_note-header')

    @if ($mode === 'create')

    <nav class="note-nav">
        <div class="logo-wrap logo-center">
            <a href="{{ route('index') }}"><img src="/../Scribl2.png" alt="Scribl Logo" class="logo-img"></a>
        </div>
    </nav>

    <form method="POST" action="{{ route('notes.store') }}" enctype="multipart/form-data">
        @csrf

        <input type="text" name="header" id="header" placeholder="Encabezado"
               class="note-header-create" required>

        <textarea name="text" id="text" placeholder="Texto"
                  class="note-textarea" required></textarea>

        <div class="form-tools-create top-right">
            <label for="reminder">Recordatorio</label>
            <input type="date" name="reminder" id="reminder">

            <label for="image">Imagen</label>
            <input type="file" name="image" id="image" accept="image/*">

            <button type="submit">Guardar</button>
        </div>
    </form>

    @if(session('status'))
        <div>{{ session('status') }}</div>
    @endif



    @elseif ($mode === 'edit')

    <nav class="note-nav">
        <div class="logo-wrap logo-end">
            <a href="{{ route('index') }}"><img src="/../Scribl2.png" alt="Scribl Logo" class="logo-img"></a>
        </div>

        <form method="POST" action="{{ route('notes.update', $note->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-tools-edit">
                <div>
                    <label for="reminder">Recordatorio:</label>
                    <input type="date" id="reminder" name="reminder"
                           value="{{ old('reminder', $note->reminder ?? '') }}">
                </div>

                <label for="image">Imagen</label>
                <input type="file" name="image" id="image" accept="image/*">

                <button type="submit">Actualizar Nota</button>

    </nav>
    <input type="text" id="header" name="header" class="note-header-edit" value="{{ old('header', $note->header) }}"  required>

    <textarea id="text" name="text" class="note-textarea" required> {{ old('text', $note->text) }} </textarea>


 </form>


    {{-- Galería de imágenes --}}
    <div class="image-card">
    @foreach ($note->images as $image)
        <div class="image-wrapper">
            <img src="{{ asset('storage/' . $image->image_url) }}"
                 alt="Imagen de la nota" class="note-image">

            <form id="delete{{ $image->id }}" method="POST" action="{{ route('image.destroy', $image) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="img-delete-btn">
                    <i class="fi fi-ss-trash"></i>
                </button>
            </form>
        </div>
    @endforeach
    </div>

    @endif
