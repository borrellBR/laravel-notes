<?php

namespace App\Services\Api;

use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class NoteService
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $notes = Note::where('user_id', auth()->id())->get();

    return response()->json(['notes' => $notes], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function store(Request $request)
  {

    $request->validate(Note::validateNote());

    $note = $request->user()->notes()->create([
        'header' => $request->header,
        'text' => $request->text,
        'pinned' => $request->pinned,
        'reminder' => $request->reminder,
    ]);

return response()->json(['note' => $note], 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Note  $note
   * @return \Illuminate\Http\Response
   */
  public function show(int $id)
  {
    $note = Note::find($id);
    if (!$note) {
      return response()->json(['error' => 'Note not found'], 404);
  }
    if ($note->user_id !== auth()->id()) {
      return response()->json(['error' => 'Unauthorized'], 403);
    }

    return response()->json(['note' => $note]);
  }


  public function update(Request $request, Note $note)
  {
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
    //
  }

}
