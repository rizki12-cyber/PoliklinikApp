{{-- resources/views/admin/services/create.blade.php --}}
@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                            <i class="bi bi-plus-lg fs-4 text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-white fw-bold mb-2">Tambah Layanan Baru</h2>
                            <p class="text-white-50 mb-0">Isi formulir berikut untuk menambahkan layanan medis baru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" id="serviceForm">
                        @csrf
                        
                        <!-- Nama Layanan -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="bi bi-tag me-2 text-primary"></i>Nama Layanan
                            </label>
                            <input type="text" name="name" 
                                   class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" 
                                   placeholder="Contoh: Pemeriksaan Kesehatan Umum"
                                   required>
                            <small class="text-muted">Masukkan nama layanan yang jelas dan mudah dipahami</small>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Icon dan Status -->
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-star me-2 text-primary"></i>Icon (Bootstrap Icons)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white rounded-3 me-2" id="iconPreview">
                                        <i class="bi bi-{{ old('icon', 'heart-pulse') }} fs-5"></i>
                                    </span>
                                    <input type="text" name="icon" 
                                           class="form-control rounded-3 @error('icon') is-invalid @enderror" 
                                           value="{{ old('icon', 'heart-pulse') }}" 
                                           placeholder="Contoh: heart-pulse, activity, hospital"
                                           id="iconInput">
                                </div>
                                <small class="text-muted">
                                    <i class="bi bi-info-circle"></i> 
                                    Lihat semua icon di <a href="https://icons.getbootstrap.com/" target="_blank" class="text-decoration-none">Bootstrap Icons</a>
                                </small>
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-toggle-on me-2 text-primary"></i>Status
                                </label>
                                <div class="form-check form-switch mt-2">
                                    <input type="checkbox" name="is_active" class="form-check-input" value="1" checked style="transform: scale(1.3);">
                                    <label class="form-check-label ms-2 fw-bold">Aktifkan Layanan</label>
                                </div>
                                <small class="text-muted">Nonaktifkan jika layanan sedang tidak tersedia</small>
                            </div>
                        </div>
                        
                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="bi bi-file-text me-2 text-primary"></i>Deskripsi Layanan
                            </label>
                            <textarea name="description" 
                                      class="form-control rounded-3 @error('description') is-invalid @enderror" 
                                      rows="6" 
                                      placeholder="Jelaskan secara detail tentang layanan ini, manfaat, prosedur, dll..."
                                      required>{{ old('description') }}</textarea>
                            <small class="text-muted">Deskripsi yang baik akan membantu pasien memahami layanan</small>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Gambar -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="bi bi-image me-2 text-primary"></i>Gambar Layanan
                            </label>
                            <div class="border-2 border-dashed rounded-3 p-4 text-center" style="border-color: #dee2e6; background: #f8f9fa;">
                                <input type="file" name="image" id="imageInput" 
                                       class="d-none @error('image') is-invalid @enderror" 
                                       accept="image/*" onchange="previewImage(this)">
                                <label for="imageInput" class="d-block" style="cursor: pointer;">
                                    <div id="uploadIcon">
                                        <i class="bi bi-cloud-upload fs-1 text-primary"></i>
                                        <p class="mt-2 mb-0">Klik untuk upload gambar</p>
                                        <small class="text-muted">Format: JPG, PNG, JPEG (Max: 2MB)</small>
                                    </div>
                                    <div id="imagePreviewContainer" class="d-none mt-3">
                                        <img id="imagePreview" class="img-fluid rounded-3" style="max-height: 200px;">
                                        <p class="mt-2 text-success">Gambar siap diupload</p>
                                    </div>
                                </label>
                            </div>
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Tombol Aksi -->
                        <hr class="my-4">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold">
                                <i class="bi bi-save me-2"></i>Simpan Layanan
                            </button>
                            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary rounded-pill px-4 py-2">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <div class="card border-0 rounded-4 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-info-circle-fill text-primary me-2"></i>Tips Mengisi
                    </h6>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <small>Gunakan nama layanan yang spesifik dan mudah diingat</small>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <small>Pilih icon yang merepresentasikan layanan dengan baik</small>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <small>Tulis deskripsi yang informatif dan menarik</small>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <small>Upload gambar dengan resolusi minimal 300x300px</small>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-stars text-warning me-2"></i>Icon Populer
                    </h6>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" onclick="setIcon('heart-pulse')">
                            <i class="bi bi-heart-pulse"></i> heart-pulse
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" onclick="setIcon('activity')">
                            <i class="bi bi-activity"></i> activity
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" onclick="setIcon('hospital')">
                            <i class="bi bi-hospital"></i> hospital
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" onclick="setIcon('capsule')">
                            <i class="bi bi-capsule"></i> capsule
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" onclick="setIcon('bandaid')">
                            <i class="bi bi-bandaid"></i> bandaid
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-dashed {
    border: 2px dashed #dee2e6;
}
.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}
</style>

<script>
function previewImage(input) {
    const uploadIcon = document.getElementById('uploadIcon');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const preview = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            uploadIcon.classList.add('d-none');
            previewContainer.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function setIcon(iconName) {
    document.getElementById('iconInput').value = iconName;
    document.getElementById('iconPreview').innerHTML = `<i class="bi bi-${iconName} fs-5"></i>`;
}

// Live preview icon
document.getElementById('iconInput').addEventListener('input', function() {
    const iconName = this.value;
    document.getElementById('iconPreview').innerHTML = `<i class="bi bi-${iconName} fs-5"></i>`;
});
</script>
@endsection