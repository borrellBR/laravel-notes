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

    $this->noteService->store($request);

    return redirect()->route('index')
                        ->with('message', 'Nota creada correctamente');
  }

  public function create(Request $request)
  {
    return view('notes.create');
}

  public function show($id)
  {
    $note = $this->noteService->show($id);
    return view('notes.show', compact('note'));
}

  public function edit (Note $note)
  {
    return view('notes.edit', compact('note'));
}

  public function update(Request $request, Note $note)
  {
    $this->noteService->update($request, $note);

    return redirect()->route('index')
                     ->with('message', 'Nota actualizada');
}

  public function destroy(Note $note)
  {
    $this->noteService->destroy($note);
    return redirect()->route('index')
                     ->with('message', 'Nota eliminada correctamente');
}

  public function pin(Note $note)
  {
 //implementar
  }

  public function unpin(Note $note)
  {
 //implementar
  }

}
