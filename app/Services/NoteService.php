<?php

namespace App\Services;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile;

class NoteService
{

  public function index(): Collection {

    $notes = Note::with('images')
    ->where('user_id', auth()->id())
    ->orderBy('pinned', 'desc')
    ->orderBy('created_at', 'desc')
    ->get();

    return $notes;
    }

    public function store(array $data, Request $request) {

        $note = Note::create($data + ['user_id' => auth()->id()]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $note->images()->create(['image_url' => $path]);
        }
     return $note;
    }

    public function show(Note $note): Note {
      $this->requireOwner($note->user_id);
      return $note->load('images');
    }


  public function update(array $data, $note, ?UploadedFile $image = null)
  {
    $this->requireOwner($note->user_id);

    $note->update($data);

        if ($image) {
            $path = $image->store('images', 'public');
            $note->images()->create(['image_url' => $path]);
        }
        return $note;
    }

  public function destroy(Note $note): void
  {
    $this->requireOwner($note->user_id);
    $note->delete();
  }

  private function requireOwner(int $userId): void
  {
      if ($userId !== auth()->id()) {
          abort(403,'Unauthorized');
      }
  }
}
