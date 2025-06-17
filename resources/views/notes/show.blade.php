
@include ('layouts.submain-header')
    <h1>{{ $note->header }}</h1>
    <p>{{ $note->text }}</p>
    <p><strong>Pinned:</strong> {{ $note->pinned ? 'Yes' : 'No' }}</p>
    @if ($note->reminder)
        <p><strong>Reminder:</strong> {{ $note->reminder ?? '' }}</p>
    @endif

    <div>
        @foreach ($note->images as $image)
            <img src="{{ asset('storage/' . $image->image_url) }}" alt="Imagen de la nota" style="max-width: 300px; max-height: 300px;">
        @endforeach
    </div>

