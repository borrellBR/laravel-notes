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


        </div>
        {{-- <hr style="border: 1px solid #cbc9c9; margin: 20px 0;"> --}}


        <p style="outline:none; border:none; padding-top:2rem; padding-right:4rem; padding-left:4rem; padding-bottom:45rem; background:transparent; font-weight:bold; resize:none; font-size:1.2rem; width:100%">
            {{ $note->text }}</p>
            @if ($note->reminder)
                <p>
                    <strong>Reminder:</strong> {{ $note->reminder ?? '' }}
                </p>
            @endif

        <div style="margin-bottom: 3rem">
            @foreach ($note->images as $image)
                <img src="{{ asset('storage/' . $image->image_url) }}" alt="Imagen de la nota" style="border-radius:4rem; margin-left:10rem; margin-top:4rem; max-width: 300px; min-height: 275px;">
            @endforeach
        </div>

    @elseif ($mode === 'create')
    <nav style="margin-top:2rem; border-radius:8px; display: flex; justify-content: space-between; align-items: center;">

        <div style="flex: 1; display: flex; justify-content: center; align-items: center; margin-left:">
            <a href ="{{ route('index') }}">
                <img src="/../Scribl2.png" alt="Scribl Logo" style="max-width:20rem">
            </a>

        </div>
    </nav>

            <form method="POST" action="{{ route('notes.store') }}" enctype="multipart/form-data">
                @csrf
                <br>
                <input style= "outline:none; padding:4rem; border:none; background:transparent; font-weight:bold; font-size:2rem; width:100%" type="text" name="header" id="header" placeholder="Encabezado" required>
                <br> <br>

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

            <nav style="margin-top:2rem; border-radius:8px; display: flex; justify-content: space-between; align-items: center;">

                <div style="margin-right:20rem; flex: 1; display: flex; justify-content: flex-end; align-items: center; margin-left:">
                    <a href ="{{ route('index') }}">
                        <img src="/../Scribl2.png" alt="Scribl Logo" style="max-width:20rem">
                    </a>

                </div>



        <form method="POST" action="{{ route('notes.update', $note->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div style="display: flex; flex-direction: row; align-items: flex-center; gap: 0.5rem; margin-right: 2rem;">
                <div>
                    <label for="reminder">Recordatorio:</label>
                    <input type="date" id="reminder" name="reminder" value="{{ old('reminder', $note->reminder ?? '') }}">
                </div>

                    <label for="image">Imagen</label>
                    <input type="file" name="image" id="image" accept="image/*">

                    <button type="submit">Update Note</button>
            </div>
        </nav>
            <div>
                <input style= "margin-left:4rem; outline:none; border:none; background:transparent; font-weight:bold; font-size:2.8rem; width:100%" type="text" id="header" name="header" value="{{ old('header', $note->header) }}" required>

            </div>

            <div>
                <textarea style= "outline:none; border:none; padding:4rem; padding-bottom:45rem;background:transparent; font-weight:bold; resize:none; font-size:1.2rem; width:100%"  id="text" name="text" required>{{ old('text', $note->text) }}</textarea>
            </div>


            @foreach ($note->images as $image)
                <img src="{{ asset('storage/' . $image->image_url) }}" alt="Imagen de la nota" style=" margin-bottom:4rem; border-radius:4rem; margin-right:0rem; margin-left:4rem; max-width: 300px; min-height: 275px;">
            @endforeach

        </form>
    @endif

