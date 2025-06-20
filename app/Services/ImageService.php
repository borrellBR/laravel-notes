<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Note;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\UploadedFile;

class ImageService
{

    public function index(Note $note)
    {
        $this->authorize($note);
        return $note->images()->get(); // duda, paginate?
    }

    public function store(Note $note, UploadedFile $image)
    {
        $this->authorize($note);

        $path = $image->store('images', 'public');

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
