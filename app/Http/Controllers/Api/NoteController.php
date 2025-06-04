<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\NoteService;
use Illuminate\Http\Request;

class NoteController extends Controller
{
  public function __construct(private NoteService $noteService)
  {
  }


  public function index()
  {
    /* Simplemente delega al service */
    return $this->noteService->index();
  }


  public function store(Request $request)
  {
    /* Valida y delega */
    return $this->noteService->store($request);
  }

  public function show($id)
  {
  }
  public function update(Request $req, $id)
  {
  }
  public function destroy($id)
  {
  }
}
