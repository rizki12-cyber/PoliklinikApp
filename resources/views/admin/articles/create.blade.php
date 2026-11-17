{{-- resources/views/admin/articles/create.blade.php --}}
@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                            <i class="bi bi-plus-circle fs-4 text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-white fw-bold mb-1 fs-4 fs-md-3">Tambah Artikel Baru</h2>
                            <p class="text-white-50 mb-0 small">Buat artikel kesehatan baru untuk website</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Terjadi Kesalahan!</strong>
        </div>
        <ul class="mb-0 mt-2 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card border-0 rounded-3 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
                @csrf
                
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label fw-bold">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control rounded-pill @error('title') is-invalid @enderror" 
                               value="{{ old('title') }}" placeholder="Masukkan judul artikel" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label fw-bold">Slug <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light rounded-start-pill">
                                <i class="bi bi-link-45deg"></i>
                            </span>
                            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                                   value="{{ old('slug') }}" placeholder="url-unik-artikel" required>
                            <button type="button" class="btn btn-outline-secondary rounded-end-pill" onclick="generateSlug()">
                                <i class="bi bi-arrow-repeat"></i> Generate
                            </button>
                        </div>
                        <small class="text-muted">URL unik untuk artikel (contoh: cara-menjaga-kesehatan)</small>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label fw-bold">Ringkasan</label>
                        <textarea name="summary" class="form-control rounded-3 @error('summary') is-invalid @enderror" 
                                  rows="3" placeholder="Tulis ringkasan singkat artikel...">{{ old('summary') }}</textarea>
                        <small class="text-muted">Ringkasan singkat yang akan tampil di halaman utama (opsional)</small>
                        @error('summary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label fw-bold">Konten Artikel <span class="text-danger">*</span></label>
                        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" 
                                  rows="15" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Gambar Utama</label>
                        <div class="upload-area border-2 border-dashed rounded-3 p-3 text-center" style="border-color: #dee2e6; background: #f8f9fa;">
                            <input type="file" name="image" id="imageInput" class="d-none @error('image') is-invalid @enderror" 
                                   accept="image/jpeg,image/png,image/jpg" onchange="previewImage(this)">
                            <label for="imageInput" class="d-block" style="cursor: pointer;">
                                <div id="uploadIcon">
                                    <i class="bi bi-cloud-upload fs-2 text-primary"></i>
                                    <p class="mt-2 mb-0 small">Klik untuk upload gambar</p>
                                    <small class="text-muted">JPG, PNG (Max: 2MB)</small>
                                </div>
                                <div id="imagePreviewContainer" class="d-none mt-2">
                                    <img id="imagePreview" class="img-fluid rounded-3" style="max-height: 150px;">
                                </div>
                            </label>
                        </div>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card bg-light border-0 rounded-3">
                            <div class="card-body">
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="is_published" class="form-check-input" value="1" id="is_published" checked>
                                    <label class="form-check-label fw-bold" for="is_published">
                                        <i class="bi bi-globe me-1"></i> Publikasikan Sekarang
                                    </label>
                                </div>
                                <small class="text-muted">Jika tidak dipublikasi, artikel akan disimpan sebagai draft</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <hr>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold" id="submitBtn">
                                <i class="bi bi-save me-2"></i>Simpan Artikel
                            </button>
                            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary rounded-pill px-4 py-2">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.border-dashed {
    border: 2px dashed #dee2e6;
    transition: all 0.3s ease;
}

.upload-area {
    transition: all 0.3s ease;
    cursor: pointer;
}

.upload-area:hover {
    border-color: #10b981;
    background-color: rgba(16, 185, 129, 0.05);
}

.form-control:focus, .form-select:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
}

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

.btn-loading {
    pointer-events: none;
    opacity: 0.7;
}

.btn-loading i {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>

<!-- CKEditor 4 (lebih stabil) -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    let editor;
    
    // Initialize CKEditor
    if (document.getElementById('content')) {
        editor = CKEDITOR.replace('content', {
            toolbar: [
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat' ] },
                { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', 'Blockquote' ] },
                { name: 'links', items: [ 'Link', 'Unlink' ] },
                { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule' ] },
                { name: 'styles', items: [ 'Format', 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                { name: 'tools', items: [ 'Maximize' ] }
            ],
            height: 400,
            removeButtons: 'Source',
            format_tags: 'p;h1;h2;h3;h4'
        });
        
        editor.on('change', function() {
            editor.updateElement();
        });
    }
    
    function generateSlug() {
        const title = document.getElementById('title').value;
        if (title) {
            const slug = title.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
            document.getElementById('slug').value = slug;
        }
    }
    
    // Auto generate slug
    let typingTimer;
    document.getElementById('title').addEventListener('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            if (!document.getElementById('slug').value || 
                document.getElementById('slug').value === document.getElementById('title').value.toLowerCase().replace(/\s+/g, '-')) {
                generateSlug();
            }
        }, 500);
    });
    
    function previewImage(input) {
        const uploadIcon = document.getElementById('uploadIcon');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const preview = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            if (!file.type.match('image.*')) {
                Swal.fire('Error', 'File harus berupa gambar', 'error');
                input.value = '';
                return;
            }
            
            if (file.size > 2 * 1024 * 1024) {
                Swal.fire('Error', 'Ukuran gambar maksimal 2MB', 'error');
                input.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                uploadIcon.classList.add('d-none');
                previewContainer.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        }
    }
    
    // Form submit with loading state
    document.getElementById('articleForm').addEventListener('submit', function(e) {
        if (editor) {
            editor.updateElement();
        }
        
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.classList.add('btn-loading');
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Menyimpan...';
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection