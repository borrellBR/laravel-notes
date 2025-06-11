<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Note</title>
</head>
<body>
    @include ('layouts.header')
    <h1>Edit Note</h1>
    <form method="POST" action="{{ route('notes.update', $note->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="header">Header:</label>
            <input type="text" id="header" name="header" value="{{ old('header', $note->header) }}" required>
        </div>
        <div>
            <label for="text">Text:</label>
            <textarea id="text" name="text" required>{{ old('text', $note->text) }}</textarea>
        </div>
        <div>
            <label for="pinned">Pinned:</label>
            <input type="hidden" name="pinned" value="0">
            <input type="checkbox" id="pinned" name="pinned" value="1" {{ $note->pinned ? 'checked' : '' }}>
        </div>
        <div>
            <label for="reminder">Reminder:</label>
            <input type="datetime-local" id="reminder" name="reminder" value="{{ old('reminder', $note->reminder ?? '') }}">
        </div>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="submit">Update Note</button>

    </form>

    <a href="{{ route('index') }}">Back to Notes</a>
    <a href="{{ route('notes.show', $note->id) }}">View Note</a>
</body>
</html>
