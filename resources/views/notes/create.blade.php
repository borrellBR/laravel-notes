
@include ('layouts.submain-header')
    <h1>Crear Nota</h1>


<form method="POST" action="{{ route('notes.store') }}" enctype="multipart/form-data">
    @csrf

    <label for="header">Encabezado</label>
    <input type="text" name="header" id="header" required>
    <br>

    <label for="text">Texto</label>
    <textarea name="text" id="text" required></textarea>
    <br>

    <br>

    <label for="reminder">Recordatorio</label>
    <input type="date" name="reminder" id="reminder">
    <br>

    <label for="image">Imagen</label>
    <input type="file" name="image" id="image" accept="image/*">
    <br>

    <button type="submit">Guardar</button>
</form>


    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
