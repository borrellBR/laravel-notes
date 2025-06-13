<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Auth\Access\AuthorizationException;

class ImageService
{

    public function index(Note $note)
    {
        $this->authorize($note);
        return $note->images()->get();
    }

    public function store(Request $request, Note $note)
    {
        $this->authorize($note);

        $request->validate(Image::validateImage());

        $path = $request->file('image')->store('images', 'public');

        $url  = asset('storage/'.$path);

        return $note->images()->create([
            'image_url' => $url,
        ]);
    }

    private function authorize(Note $note): void
    {
        if ($note->user_id !== auth()->id()) {
            throw new AuthorizationException('Unauthorized');
        }
    }

    public function destroy(Image $image)
    {
        // pendiente (por si acaso)
    }
}
