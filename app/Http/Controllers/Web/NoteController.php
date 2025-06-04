<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Services\Web\NoteService;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{

  public function __construct(private NoteService $noteService)
  {
  }

  public function index()
  {
    return $this->noteService->index();
  }

  public function create()
  {
    return $this->noteService->create();
  }

  public function store(Request $request)
  {
    return $this->noteService->store($request);
  }

  public function show(Note $note)
  {
    //
  }

  public function edit(Note $note)
  {
    //
  }

  public function update(Request $request, Note $note)
  {
    //
  }

  public function destroy(Note $note)
  {
    //
  }
}
