<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\UploadedFile;

class ImageService
{

    public function index(Note $note)
    {
        $this->authorize($note);
        return $note->images()->get();
    }

    public function store(Note $note, UploadedFile $image)
    {
        $path = $image->file('image')->store('images', 'public');

        $url  = asset('storage/'.$path);

        return $note->images()->create([
            'image_url' => $url,
        ]);
    }


    // public function store(array $data, Request $request) {

    //     $note = Note::create($data + ['user_id' => auth()->id()]);

    //     if ($request->hasFile('image')) {
    //         $path = $request->file('image')->store('images', 'public');
    //         $note->images()->create(['image_url' => $path]);
    //     }
    //  return $note;
    // }

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
