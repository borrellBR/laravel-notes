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
        $request->validate(Image::validateImage());

        $image = $this->imageService->store($request, $note);

        return back()
            ->with('message', 'Imagen subida correctamente')
            ->with('image', $image);
    }

    public function destroy(Image $image)
    {
        // porsiacaso
    }
}
