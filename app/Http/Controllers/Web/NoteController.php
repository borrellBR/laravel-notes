<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Services\Web\NoteService;
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
    return $this->noteService->index();
  }

  public function store(Request $request)
  {
    return $this->noteService->store($request);
  }

  public function create(Request $request)
  {
    return $this->noteService->create($request);
  }

  public function show($id)
  {
    return $this->noteService->show($id);
  }

  public function edit (Note $note)
  {
    return $this->noteService->edit($note);
  }

  public function update(Request $request, Note $note)
  {
    return $this->noteService->update($request, $note);
  }

  public function destroy($id)
  {
    return $this->noteService->destroy($id);
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
