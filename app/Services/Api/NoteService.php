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
    $notes = Note::all();
    return response()->json($notes);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
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
    Note::create([
      'header' => $request->header,
      'text' => $request->text,
      'pinned' => $request->pinned,
      'reminder' => $request->reminder,
      'user_id' => auth()->id(),
    ]);

    return response()->json([
      'message' => 'Note created successfully',
    ], 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Note  $note
   * @return \Illuminate\Http\Response
   */
  public function show(Note $note)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Note  $note
   * @return \Illuminate\Http\Response
   */
  public function edit(Note $note)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Note  $note
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Note $note)
  {
    //
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
