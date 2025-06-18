<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\NoteService;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    protected $noteService;

  public function __construct(NoteService $noteService)
  {
    $this->noteService = $noteService;
  }

  public function index()
  {
    return response()->json(['notes' => $this->noteService->index()]);
    }

  public function store(Request $request)
  {
    $data = $request -> validate(Note::validateNote());
    $note = $this->noteService->store($data, $request);

    return response()->json(['note' => $note], 201);
  }


  public function show(Note $note)
  {
      return response()->json(['note' => $this->noteService->show($note)]);
    }

    public function update(Request $request, Note $note)
    {
        $data = $request->validate(Note::validateNote());
        $image = $request->file('image');

        $updated = $this->noteService->update($data, $note, $image);
        return response()->json(['note' => $updated]);

    }

    public function destroy(Note $note)
    {
        $this->noteService->destroy($note);
        return response()->json(['message' => 'Note deleted successfully']);
    }

    public function searchNoteName(Request $request){
      $search = $request -> input('search');
      $notes = Note::where('header','like', "%$search%")->where('user_id', auth()->id())-> get();

      return response()->json(['notes' => $notes]);
    }

    public function searchNoteDate(Request $request){
      $search = $request -> input('search');

      $notes = Note::whereDate('reminder','like',"%$search%")->get();

      return response()->json(['notes' => $notes]);
    }

    public function togglePin(Note $note) {
        $note ->pinned =! $note->pinned;
        $note ->save();

        return response()->json(['pinned' => $note -> pinned]);
  }
}
