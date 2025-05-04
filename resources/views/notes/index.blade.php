@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <!-- Form Tambah Catatan -->
            <div class="col-md-12">
                <div class="form-container">
                    <div class="form-card">
                        <div class="card-header bg-primary">
                            <h2 class="card-title text-center mb-0">Tambah Catatan Baru</h2>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('notes.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="judul" class="form-label">Judul Catatan</label>
                                    <input type="text" class="form-control" id="judul" name="judul" required
                                        placeholder="Masukkan judul catatan">
                                </div>
                                <div class="form-group">
                                    <label for="isi" class="form-label">Isi Catatan</label>
                                    <textarea class="form-control" id="isi" name="isi" rows="5" required
                                        placeholder="Tulis isi catatan Anda di sini..."></textarea>
                                </div>
                                <div class="btn-container">
                                    <a href="{{ route('notes.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Catatan -->
            <div class="col-md-12">
                <div class="notes-grid">
                    @forelse($notes as $note)
                    <div class="card note-card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">{{ $note->judul }}</h5>
                            <div class="note-content">
                                <p class="card-text text-muted mb-4">
                                    {{ Str::limit($note->isi, 100) }}
                                </p>
                            </div>
                            <div class="note-actions">
                                <a href="{{ route('notes.show', $note->id) }}" class="btn btn-info me-2">
                                    <i class="fas fa-eye me-2"></i> Lihat
                                </a>
                                <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning me-2">
                                    <i class="fas fa-edit me-2"></i> Ubah
                                </a>
                                <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus catatan ini?')">
                                        <i class="fas fa-trash me-2"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="card note-card">
                        <div class="card-body">
                            <h3 class="text-muted text-center py-5">Belum ada catatan</h3>
                            <p class="text-muted text-center">Silakan tambahkan catatan baru</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection