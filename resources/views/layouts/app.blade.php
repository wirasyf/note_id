<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f6fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            border-radius: 8px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .note-card {
            transition: all 0.3s ease;
        }

        .note-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
        }

        .note-content {
            white-space: pre-wrap;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Modal Add Note -->
    <div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addNoteModalLabel">Tambah Catatan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addNoteForm" method="POST" action="{{ route('notes.store') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text"
                                class="form-control @error('judul') is-invalid @enderror"
                                id="judul"
                                name="judul"
                                required
                                autocomplete="off">
                            @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="valid-feedback">
                                Judul tersedia!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="isi" class="form-label">Isi Catatan</label>
                            <textarea class="form-control @error('isi') is-invalid @enderror"
                                id="isi"
                                name="isi"
                                rows="6"
                                required
                                style="resize: vertical"
                                autocomplete="off"></textarea>
                            @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="valid-feedback">
                                Isi tersedia!
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">Minimal 10 karakter untuk isi catatan</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-arrow-left"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" form="addNoteForm">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tombol untuk membuka modal
        const btnAddNote = document.querySelector('.btn-add-note');
        const modal = new bootstrap.Modal(document.getElementById('addNoteModal'));

        // Buka modal saat tombol diklik
        btnAddNote?.addEventListener('click', () => modal.show());

        // Reset form saat modal ditutup
        document.getElementById('addNoteModal')?.addEventListener('hidden.bs.modal', function() {
            document.getElementById('addNoteForm').reset();
        });

        // Handle submit form
        document.getElementById('addNoteForm')?.addEventListener('submit', async function(e) {
            e.preventDefault();

            try {
                const formData = new FormData(this);
                const response = await fetch(this.action, {
                    method: this.method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const result = await response.json();

                if (result.success) {
                    // Tutup modal
                    modal.hide();

                    // Reset form
                    this.reset();

                    // Muat ulang halaman
                    location.reload();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data');
            }
        });
    });
</script>

</html>