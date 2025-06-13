<?php

namespace App\Services\Api;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Note;

class ImageService
{

    public function index(Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $images = $note->images()->get();

        return response()->json(['images' => $images], 200);
    }

    public function store(Request $request, Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate(Image::validateImage());

        $path = $request->file('image')->store('images', 'public');

        $image = $note->images()->create([
            'image_url' => asset('storage/' . $path),
        ]);

        return response()->json(['image' => $image], 201);
    }

    public function destroy(Image $image)
    {
        // pendiente (por si acaso)
    }
}
