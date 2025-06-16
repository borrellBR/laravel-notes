<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use App\Models\Image;
use App\Models\Note;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(Note $note)
    {
        $images = $this->imageService->index($note);

        return response()->json(['images' => $images], 200);
    }

    public function store(Request $request, Note $note)
    {
        $request->validate(Image::validateImage());

        $image = $request->file('image');
        $savedImage = $this->imageService->store($note, $image);

        return response()->json(['image' => $savedImage], 201);
    }

    public function destroy(Image $image)
    {
        //PORSIACASO
    }
}
