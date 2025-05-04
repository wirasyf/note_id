@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card note-card">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title mb-0">{{ $note->judul }}</h2>
            </div>
            <div class="card-body">
                <p class="card-text">{!! nl2br(e($note->isi)) !!}</p>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('notes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection