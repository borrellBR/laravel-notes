<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Note;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


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

    public function destroy(Image $image): void
    {
        $this->requireOwner($image->note->user_id);

        if (Storage::exists($image->image_url)) {
            Storage::delete($image->image_url);
        }

        $image->delete();
    }

    private function requireOwner(int $userId): void
    {
        if ($userId !== auth()->id()) {
            abort(403,'Unauthorized');
        }
    }

    private function authorize(Note $note): void
    {
        if ($note->user_id !== auth()->id()) {
            throw new AuthorizationException('Unauthorized');
        }
    }
}
