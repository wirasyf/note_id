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
$request->validate([
'judul' => 'required|string|max:255',
'isi' => 'required|string'
]);

Note::create($request->all());

return redirect()->route('notes.index')
->with('success','Catatan berhasil dibuat.');
}

public function show(Note $note)
{
return view('notes.show', compact('note'));
}

public function edit(Note $note)
{
return view('notes.edit', compact('note'));
}

public function update(Request $request, Note $note)
{
$request->validate([
'judul' => 'required|string|max:255',
'isi' => 'required|string'
]);

$note->update($request->all());

return redirect()->route('notes.index')
->with('success','Catatan berhasil diubah.');
}

public function destroy(Note $note)
{
$note->delete();

return redirect()->route('notes.index')
->with('success','Catatan berhasil dihapus.');
}
}