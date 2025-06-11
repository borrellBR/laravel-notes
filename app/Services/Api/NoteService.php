<?php

namespace App\Services\Api;

use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteService
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (!auth()->check()) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    if (Note::where('user_id', auth()->id())->doesntExist()) {
      return response()->json(['message' => 'No notes found'], 404);
    }

    $notes = Note::with('images')
    ->where('user_id', auth()->id())
    ->orderBy('pinned', 'desc')
    ->orderBy('created_at', 'desc')
    ->get();
    return response()->json(['notes' => $notes], 200);
  }

  public function store(Request $request)
  {

    if ($request->user()->id !== auth()->id()) {
      return response()->json(['error' => 'Unauthorized'], 403);
    }

    $request->validate(Note::validateNote());

    Note::create([
      'header' => $request->header,
      'text' => $request->text,
      'pinned' => $request->pinned,
      'reminder' => $request->reminder,
      'user_id' => auth()->id(),
    ]);

    return response()->json(['message' => 'Note created successfully'], 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Note  $note
   * @return \Illuminate\Http\Response
   */
  public function show(int $id)
  {

    if (!auth()->check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $note = Note::with("images")->where('user_id', auth()->id())->findOrFail($id);

    if (!$note) {
        return response()->json(['error' => 'Note not found'], 404);
    }

    return response()->json(['note' => $note],200);
  }


  public function update(Request $request, Note $note)
  {
    if ($note->user_id !== auth()->id()) {
      return response()->json(['error' => 'Unauthorized'], 403);
    }

    $request->validate(Note::validateNote());

    $note->update([
        'header' => $request->header,
        'text' => $request->text,
        'pinned' => $request->pinned,
        'reminder' => $request->reminder,
    ]);
    return response()->json(['note' => $note], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Note  $note
   * @return \Illuminate\Http\Response
   */
  public function destroy(Note $note)
  {
    if ($note->user_id !== auth()->id()) {
      return response()->json(['error' => 'Unauthorized'], 403);
    }

    $note->delete();
    return response()->json(['message' => 'Note deleted successfully'], 200);
  }

}
