<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\NoteService;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
  public function __construct(private NoteService $noteService)
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

  public function show($id)
  {
    return $this->noteService->show($id);
  }
  public function update(Request $request, Note $note)
  {
    return $this->noteService->update($request, $note);
  }
  public function destroy($id)
  {
  }
}
