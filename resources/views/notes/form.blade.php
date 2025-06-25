@include ('layouts.show_note-header')

    @if($mode === 'show')
        <div style="display:flex; align-items:center;"class="titulo">
            <strong style="font-size:2.8rem; margin-left: 4rem;">{{ $note->header }}</h1></strong>

            <form style="margin-left: 120rem;" method="GET" action="{{ route('notes.edit', $note->id) }}">
                @csrf
                @method('GET')
                <button style=""class="submit" style= "border: none; background-color:#e9e7e2;">
                    <i class="fi fi-sr-pencil"></i>Editar Nota
                </button>
            </form>

</style>
        </div>
        {{-- <hr style="border: 1px solid #cbc9c9; margin: 20px 0;"> --}}


        <p style="outline:none; border:none; padding-top:2rem; padding-right:4rem; padding-left:4rem; padding-bottom:45rem; background:transparent; font-weight:bold; resize:none; font-size:1.2rem; width:100%">
            {{ $note->text }}</p>
            @if ($note->reminder)
                <p>
                    <strong>Reminder:</strong> {{ $note->reminder ?? '' }}
                </p>
            @endif

        <div>
            @foreach ($note->images as $image)
                <img src="{{ asset('storage/' . $image->image_url) }}" alt="Imagen de la nota" style=" margin-bottom:3rem; border-radius:4rem; margin-left:10rem; margin-top:4rem; max-width: 300px; min-height: 275px;">
            @endforeach
        </div>

    @elseif ($mode === 'create')

            <form method="POST" action="{{ route('notes.store') }}" enctype="multipart/form-data">
                @csrf
                <br>
                <input style= "outline:none; padding:4rem; border:none; background:transparent; font-weight:bold; font-size:2rem; width:100%" type="text" name="header" id="header" placeholder="Encabezado" required>
                <br> <br>

                {{-- <label for="text">Texto</label> --}}
                <textarea style= "outline:none; border:none; padding-top:2rem; padding-right:4rem; padding-left:4rem; padding-bottom:45rem; background:transparent; font-weight:bold; resize:none; font-size:1.2rem; width:100%" name="text" id="text" placeholder="Texto" required></textarea>

                <div style="margin-left:135rem; margin-top:-69rem; display:flex;"class="top-right">
                <label for="reminder">Recordatorio</label>
                <input type="date" name="reminder" id="reminder">
                <br>

                <label for="image">Imagen</label>
                <input type="file" name="image" id="image" accept="image/*">
                <br>

                <button type="submit">Guardar</button>
            </div>
            </form>


            @if (session('status'))
                <div>{{ session('status') }}</div>
            @endif


    @elseif ($mode === 'edit')


        <form method="POST" action="{{ route('notes.update', $note->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                {{-- <strong for="header">Header:</strong> --}}
                <input style= "margin-left:4rem; outline:none; border:none; background:transparent; font-weight:bold; font-size:2.8rem; width:100%" type="text" id="header" name="header" value="{{ old('header', $note->header) }}" required>

            </div>

            <div>
                {{-- <label for="text">Text:</label> --}}
                <textarea style= "outline:none; border:none; padding:4rem; padding-bottom:45rem;background:transparent; font-weight:bold; resize:none; font-size:1.2rem; width:100%"  id="text" name="text" required>{{ old('text', $note->text) }}</textarea>
            </div>

            @foreach ($note->images as $image)
                <img src="{{ asset('storage/' . $image->image_url) }}" alt="Imagen de la nota" style=" border-radius:4rem; margin-left:4rem; max-width: 300px; min-height: 275px;">
            @endforeach


            @if($note ->images->isEmpty())

                <div style="margin-left:135rem; margin-top:-61rem; display:flex;"class="top-right">
                    <div>
                        <label for="reminder">Recordatorio:</label>
                        <input type="date" id="reminder" name="reminder" value="{{ old('reminder', $note->reminder ?? '') }}">
                    </div>

                        <label for="image">Imagen</label>
                        <input type="file" name="image" id="image" accept="image/*">

                        <button type="submit">Update Note</button>
                </div>
            @elseif(! $note ->images->isEmpty() && $note->images->count() <= 5)

                <div style="margin-left:135rem; margin-top:-88rem; display:flex;"class="top-right">
                    <div>
                        <label for="reminder">Recordatorio:</label>
                        <input type="date" id="reminder" name="reminder" value="{{ old('reminder', $note->reminder ?? '') }}">
                    </div>

                    <label for="image">Imagen</label>
                    <input type="file" name="image" id="image" accept="image/*">

                    <button type="submit">Update Note</button>
                </div>
            @elseif($note ->images->count() > 5)
            <div style="margin-left:135rem; margin-top:-116rem; display:flex;"class="top-right">
                <div>
                    <label for="reminder">Recordatorio:</label>
                    <input type="date" id="reminder" name="reminder" value="{{ old('reminder', $note->reminder ?? '') }}">
                </div>

                <label for="image">Imagen</label>
                <input type="file" name="image" id="image" accept="image/*">

                <button type="submit">Update Note</button>
            </div>
            @endif


        </form>

    @endif

