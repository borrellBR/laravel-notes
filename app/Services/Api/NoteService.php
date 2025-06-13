<?php

namespace App\Services\Api;

use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Collection;

class NoteService
{

  public function index(): Collection
  {
    $this->requireAuth();
    // no creo que haga falta, ya que el middleware de auth se encarga de esto

    return Note::with('images')
            ->where('user_id', auth()->id())
            ->orderBy('pinned', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
    }


    public function store(Request $request)
  {
    $this->requireAuth();    // no creo que haga falta, ya que el middleware de auth se encarga de esto

    $data = $request->validate(Note::validateNote());
    $note = Note::create($data + ['user_id' => auth()->id()]);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $note->images()->create(['image_url' => $path]);
    }
    return $note;
  }

  public function show(Note $note): Note
  {
      $this->requireOwner($note->user_id);
      return $note->load('images');
  }


  public function update(Request $request, Note $note)
  {
    $this->requireOwner($note->user_id);

    $data = $request->validate(Note::validateNote());
        $note->update($data);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $note->images()->create(['image_url' => $path]);
        }
        return $note;
    }

  public function destroy(Note $note): void
  {
    $this->requireOwner($note->user_id);
    $note->delete();
  }

  private function requireAuth(): void
  {
      if (! auth()->check()) {
          throw new AuthorizationException('Unauthorized');
      }
  }

  private function requireOwner(int $userId): void
  {
      if ($userId !== auth()->id()) {
          throw new AuthorizationException('Unauthorized');
      }
  }
}
