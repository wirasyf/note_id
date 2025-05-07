@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Daftar Catatan</h2>
            <button type="button" class="btn btn-primary btn-add-note" data-bs-toggle="modal" data-bs-target="#addNoteModal">
                <i class="fas fa-plus me-2"></i> Tambah Catatan Baru
            </button>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row">
            @forelse($notes as $note)
            <div class="col-md-4 mb-4">
                <div class="card note-card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">{{ $note->judul }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text note-content">{!! nl2br(e(\Illuminate\Support\Str::limit($note->isi, 150))) !!}</p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                {{ $note->created_at->diffForHumans() }}
                            </small>
                            <div class="btn-group">
                                <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('notes.destroy', $note->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus catatan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card text-center py-5">
                    <div class="card-body">
                        <h3 class="text-muted">Belum ada catatan</h3>
                        <p class="text-muted">Silakan tambahkan catatan baru</p>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        {{ $notes->links() }}
    </div>
</div>
@endsection