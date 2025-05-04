@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card note-card">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title text-center mb-0">Tambah Catatan Baru</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('notes.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Catatan</label>
                        <input type="text" class="form-control" id="judul" name="judul" required
                            placeholder="Masukkan judul catatan">
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi Catatan</label>
                        <textarea class="form-control" id="isi" name="isi" rows="5" required
                            placeholder="Tulis isi catatan Anda di sini..."></textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('notes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
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
@endsection