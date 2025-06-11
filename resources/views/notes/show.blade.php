<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Nota</title>
</head>
<body>
    @include ('layouts.header')
    <h1>{{ $note->header }}</h1>
    <p>{{ $note->text }}</p>
    <p><strong>Pinned:</strong> {{ $note->pinned ? 'Yes' : 'No' }}</p>
    @if ($note->reminder)
        <p><strong>Reminder:</strong> {{ $note->reminder ?? '' }}</p>
    @endif

    <a href="{{ route('notes.edit', $note->id) }}">Edit Note</a>
    <form method="POST" action="{{ route('notes.destroy', $note->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Note</button>
    </form>

    <a href="{{ route('index') }}">Back to Notes</a>
</body>
</html>
