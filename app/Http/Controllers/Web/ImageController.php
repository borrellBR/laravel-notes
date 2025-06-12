<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Services\Web\ImageService;
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
        return $this->imageService->index($note);

    }

    public function store(Request $request, Note $note)
    {
        return app(ImageService::class)->store($request, $note);
    }

    public function destroy(Image $image)
    {
        // porsiacaso
    }
}
