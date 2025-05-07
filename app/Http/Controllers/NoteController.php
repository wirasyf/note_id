<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoteController extends Controller
{
  public function index()
  {
    $notes = Note::latest()->paginate(8);
    return view('notes.index', compact('notes'));
  }

  public function create()
  {
    return view('notes.create');
  }

  public function store(Request $request)
{
    try {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string|min:10'
        ], [
            'judul.required' => 'Judul wajib diisi',
            'judul.max' => 'Judul maksimal 255 karakter',
            'isi.required' => 'Isi catatan wajib diisi',
            'isi.min' => 'Isi catatan minimal 10 karakter'
        ]);

        $note = Note::create($request->all());
        
        return response()->json([
            'success' => true,
            'message' => 'Catatan berhasil dibuat',
            'data' => $note
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 422);
    }
}

  public function edit(Note $note)
  {
    return view('notes.edit', compact('note'));
  }

  public function update(Request $request, Note $note)
  {
    $request->validate([
      'judul' => 'required|string|max:255',
      'isi' => 'required|string|min:10'
    ]);

    $note->update($request->all());

    return redirect()->route('notes.index')
      ->with('success', 'Catatan berhasil diubah.');
  }

  public function destroy(Note $note)
  {
    $note->delete();

    return redirect()->route('notes.index')
      ->with('success', 'Catatan berhasil dihapus.');
  }
}
