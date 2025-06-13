<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\NoteService;
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
    $note = $this->noteService->store($request);
    return response()->json(['note' => $note], 201);  }

  public function show($id)
  {
    return response()->json(['note' => $this->noteService->show($id)]);
}

  public function update(Request $request, Note $note)
  {
    $updated = $this->noteService->update($request, $note);
    return response()->json(['note' => $updated]);

  }

  public function destroy(Note $note)
  {
    $this->noteService->destroy($note);
    return response()->json(['message' => 'Note deleted successfully']);
}
}
