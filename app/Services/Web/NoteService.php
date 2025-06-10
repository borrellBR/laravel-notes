<?php

namespace App\Services\Web;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;



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
      return redirect()->back()->with('message', 'No notes found.');
    }

    $notes = Note::with('images')
    ->where('user_id', auth()->id())
    ->orderBy('pinned', 'desc')
    ->orderBy('created_at', 'desc')
    ->get();
    return redirect()->back()->with('notes', $notes);
  }

  public function store(Request $request)
  {

    if ($request->user()->id !== auth()->id()) {
      return redirect()->back()->with('error', 'Unauthorized');
    }

    $request->validate(Note::validateNote());

    Note::create([
      'header' => $request->header,
      'text' => $request->text,
      'pinned' => $request->pinned,
      'reminder' => $request->reminder,
      'user_id' => auth()->id(),
    ]);

    return redirect()->back()->with('message', 'Note created successfully');
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
        return redirect()->back()->with('error', 'Unauthorized');
    }

    $note = Note::with("images")->where('user_id', auth()->id())->findOrFail($id);

    if (!$note) {
        return redirect()->back()->with('error', 'Note not found');
    }

    return redirect()->back()->with('note', $note);
  }

  public function update(Request $request, Note $note)
  {
    if ($note->user_id !== auth()->id()) {
      return redirect()->back()->with('error', 'Unauthorized');
    }

    $request->validate(Note::validateNote());

    $note->update([
        'header' => $request->header,
        'text' => $request->text,
        'pinned' => $request->pinned,
        'reminder' => $request->reminder,
    ]);
    return redirect()->back()->with('message', 'Note updated successfully');
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
