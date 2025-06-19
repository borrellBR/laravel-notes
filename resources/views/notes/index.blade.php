
@include ('layouts.main-header')

    <div class="display-inline" style="margin-top:-2rem; display: flex; justify-content: center; align-items: center; width: 100%; gap: 20px;">

        <form action="{{ route('notes.search') }}" method="GET" class="form-inline" style="flex: 1; display: flex; justify-content: center; align-items: center;">
            <div class="form-group;" style="width: 80%;">

                  <input type="text" name="search" class="form-control" placeholder=" 🔎 Buscar..." style="width: 100%;">
            </div>
        </form>

        <form action="{{ route('notes.search-date') }}" method="GET" class="form-inline" style="flex: 1; display: flex; justify-content: center; align-items: center;">
            <div class="form-group" style="width: 80%;">
                <input type="date" name="search" class="form-control" placeholder="Buscar por fecha" style="width: 100%;">
            </div>
            <button type="submit" style= "color:white; background-color:black; border-color:black; "class="btn btn-primary ml-2">Search</button>
        </form>

    </div>

    <div class="display-inline" style="display: flex;padding-bottom: -4rem; margin-bottom:-2rem;  justify-content: space-between; align-items: center;">
        <h3 class="col-md-4">Mis notas</h3>
        <a style= "color:rgb(255, 255, 255);margin-bottom:-2rem; padding-top: 0.6rem; width:15rem;  height:3rem; background-color:black; margin-right:4rem; border-radius:8px" class="col-md-2 col-md-offset-9" href="{{ route('notes.create') }}">
            <i class="fi fi-br-plus"></i> Añadir
        </a>
    </div>

<hr style="border: 1px solid #cbc9c9; margin: 20px 0;">


<div style="margin:4rem;" class="row">

    @if ($notes->isEmpty())
        <div style="color:#b7b7b7;margin-top: 35rem; text-align: center;"class="no-notes">
            <h3> ¡Oops! </h3>
            <h3> Parece que tus notas están vacías :(</h3>
        </div>
    @else
        @foreach ($notes as $note)
                <div class="col-sm-3 d-flex">
                    <a href="{{ route('notes.show', $note->id) }}" style="text-decoration: none; width: 100%; color:black;">
                        <div class="card w-100" style="height: 370px;">
                            <div class="card-body" style="margin-top:-2rem; height:330px; border-radius:6px; background-color:#e9e7e2; flex; flex-direction: column; justify-content: space-between;">
                                <strong>
                                    <span style="font-size:20px; padding-left:1rem; color:black;">{{ $note->header }}</span>
                                </strong>
                                <br> <br>
                                <div>
                                    @if($note->images->isEmpty())
                                        <p style="text-align: center; padding-left:2rem; padding-right:2rem; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 10; -webkit-box-orient: vertical;">
                                            {{ $note->text }}
                                        </p>
                                    @else
                                        @foreach ($note->images as $image)
                                            <img src="{{ asset('storage/' . $image->image_url) }}" alt="Imagen de la nota" style="padding-left:1rem; padding-right:1rem; border-radius:20px; width: 100%; height: 250px; object-fit: cover;">
                                        @endforeach
                                    @endif
                                    </a>


                                        <div style="padding-top:0.45rem; border-radius:8px; display: flex; align-items: center; justify-content: flex-end;">

                                            <form method="POST" action="{{ route('notes.destroy', $note->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="submit" style= "border: none; background-color:#e9e7e2;">
                                                    <i class="fi fi-ss-trash"></i>
                                                </button>
                                            </form>

                                            <form method="GET" action="{{ route('notes.edit', $note->id) }}">
                                                @csrf
                                                @method('GET')
                                                <button class="submit" style= "border: none; background-color:#e9e7e2;">
                                                    <i class="fi fi-sr-pencil"></i>
                                                </button>
                                            </form>

                                            <button class="pin-btn" data-id="{{ $note->id }}" style= "border: none; background-color:#e9e7e2;">
                                                @if ($note->pinned)
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
                </div>
        @endforeach
     @endif
</div>


@if (session('status'))
    <div>{{ session('status') }}</div>
@endif



