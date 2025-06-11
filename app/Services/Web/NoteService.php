<?php

namespace App\Services\Web;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;



class NoteService
{
  public function index()
  {
      if (!auth()->check()) {
          return redirect()->route('login')->with('error', 'No autorizado');
      }

      $notes = Note::with('images')
          ->where('user_id', auth()->id())
          ->orderBy('pinned', 'desc')
          ->orderBy('created_at', 'desc')
          ->get();

        if (!$notes) {
            return redirect()->back()->with('error', 'No notes found');
        }

      return view('notes.index', compact('notes'));
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

    return redirect()->route('index')->with('message', 'Nota creada correctamente');
}

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

  public function create()
  {

    if (!auth()->check()) {
      return redirect()->route('login')->with('error', 'Unauthorized');
    }

    return view('notes.create');
  }

  public function edit(Note $note)
  {

    if ($note->user_id !== auth()->id()) {
      return redirect()->back()->with('error', 'Unauthorized');
    }


    return view('notes.edit', compact('note'));
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
    return redirect()->route('index', $note->id)->with('message', 'Note updated successfully');
  }


  public function destroy($id)
  {
    $note = Note::findOrFail($id);

    if ($note->user_id !== auth()->id()) {
      return redirect()->back()->with('error', 'Unauthorized');
    }

    $note->delete();
    return redirect()->route('index')->with('message', 'Note deleted successfully');
  }

}
