<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Services\NoteService;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    protected $noteService;

  public function __construct(NoteService $noteService)
  {
    $this->noteService = $noteService;
  }

  public function index()
  {
      $notes = $this->noteService->index();
      return view('notes.index', compact('notes'));
  }


  public function store(Request $request)
  {
    $data = $request -> validate(Note::validateNote());
    $this->noteService->store($data, $request);

    return redirect()->route('index')
                        ->with('message', 'Nota creada correctamente');
  }

  public function create()
  {
    return view('notes.form', ['mode' => 'create']);
}

  public function show(Note $note)
  {
    $note = $this->noteService->show($note);
    // return view('notes.show', compact('note'));
    return view('notes.form', ['mode' => 'edit',  'note' => $note]);
  }

  public function edit (Note $note)
  {
    return view('notes.form', ['mode' => 'edit',  'note' => $note]);
    }

  public function update(Request $request, Note $note)
  {
    $data = $request->validate(Note::validateNote());
    $image = $request->file('image');

    $this->noteService->update($data, $note, $image);

    return redirect()->route('index')
                     ->with('message', 'Nota actualizada');
}

  public function destroy(Note $note)
  {
    $this->noteService->destroy($note);
    return redirect()->route('index')
                     ->with('message', 'Nota eliminada correctamente');
}

public function searchNoteName(Request $request){
    $search = $request -> input('search');
    $notes = Note::where('header','like', "%$search%")->where('user_id', auth()->id())-> get();

    return view('notes.index', ['notes' => $notes]);
  }

  public function searchNoteDate(Request $request){
    $search = $request -> input('search');

    $notes = Note::whereDate('reminder','like',"%$search%")->get();

    return view('notes.index', ['notes' => $notes]);
  }

  public function togglePin(Note $note) {
    $note ->pinned =! $note->pinned;
    $note ->save();

    return response()->json(['pinned' => $note -> pinned]);
  }

}
