<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\ImageService;
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
        return $this->imageService->index($note);
    }

    public function store(Request $request, Note $note)
    {
        return app(ImageService::class)->store($request, $note);
    }

    public function destroy(Image $image)
    {
        //PORSIACASO
    }
}
