<?php

namespace App\Services\Web;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Note;
class ImageService
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $images = $note->images()->get();

        return redirect()->back()->with('images', $images);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        $request->validate(Image::validateImage());

        $path = $request->file('image')->store('images', 'public');

        $image = $note->images()->create([
            'image_url' => asset('storage/' . $path),
        ]);

        return redirect()->back()->with('message', 'Image uploaded successfully')->with('image', $image);
    }


    public function destroy(Image $image)
    {
        // por si acaso futuro
    }
}
