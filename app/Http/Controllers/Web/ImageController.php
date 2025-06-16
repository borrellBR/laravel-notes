<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Services\ImageService;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Note;


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
        return back()->with('images', $images);
    }

    public function store(Request $request, Note $note)
    {
        $this->authorize($note);

        $request->validate(Image::validateImage());

        $image = $request->file('image');

        $savedImage = $this->imageService->store($note, $image);

        return back()
            ->with('message', 'Imagen subida correctamente')
            ->with('image', $savedImage);
    }

    public function destroy(Image $image)
    {
        // porsiacaso
    }
}
