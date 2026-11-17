@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                            <i class="bi bi-person-plus fs-4 text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-white fw-bold mb-2">Tambah Dokter Baru</h2>
                            <p class="text-white-50 mb-0">Isi formulir berikut untuk menambahkan dokter dan jadwal praktik</p>
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
                    <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data" id="doctorForm">
                        @csrf
                        
                        <!-- Informasi Dasar -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-info-circle text-primary me-2"></i>Informasi Dasar
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="name" 
                                           class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror" 
                                           value="{{ old('name') }}" 
                                           placeholder="dr. John Doe">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Spesialisasi <span class="text-danger">*</span></label>
                                    <select name="specialization" class="form-select form-select-lg rounded-3 @error('specialization') is-invalid @enderror" required>
                                        <option value="">Pilih Spesialisasi</option>
                                        <option value="Spesialis Penyakit Dalam" {{ old('specialization') == 'Spesialis Penyakit Dalam' ? 'selected' : '' }}>Spesialis Penyakit Dalam</option>
                                        <option value="Spesialis Anak" {{ old('specialization') == 'Spesialis Anak' ? 'selected' : '' }}>Spesialis Anak</option>
                                        <option value="Spesialis Bedah" {{ old('specialization') == 'Spesialis Bedah' ? 'selected' : '' }}>Spesialis Bedah</option>
                                        <option value="Spesialis Kandungan" {{ old('specialization') == 'Spesialis Kandungan' ? 'selected' : '' }}>Spesialis Kandungan</option>
                                        <option value="Spesialis Jantung" {{ old('specialization') == 'Spesialis Jantung' ? 'selected' : '' }}>Spesialis Jantung</option>
                                        <option value="Spesialis Saraf" {{ old('specialization') == 'Spesialis Saraf' ? 'selected' : '' }}>Spesialis Saraf</option>
                                        <option value="Spesialis Mata" {{ old('specialization') == 'Spesialis Mata' ? 'selected' : '' }}>Spesialis Mata</option>
                                        <option value="Dokter Gigi" {{ old('specialization') == 'Dokter Gigi' ? 'selected' : '' }}>Dokter Gigi</option>
                                        <option value="Dokter Umum" {{ old('specialization') == 'Dokter Umum' ? 'selected' : '' }}>Dokter Umum</option>
                                    </select>
                                    @error('specialization')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kontak -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-envelope fs-5 text-primary me-2"></i>Kontak
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light rounded-3 me-2">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <input type="email" name="email" 
                                               class="form-control rounded-3 @error('email') is-invalid @enderror" 
                                               value="{{ old('email') }}" 
                                               placeholder="doctor@example.com">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nomor Telepon</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light rounded-3 me-2">
                                            <i class="bi bi-telephone"></i>
                                        </span>
                                        <input type="text" name="phone" 
                                               class="form-control rounded-3 @error('phone') is-invalid @enderror" 
                                               value="{{ old('phone') }}" 
                                               placeholder="0812-3456-7890">
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kuota dan Foto -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-calendar-check fs-5 text-primary me-2"></i>Kuota & Foto
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Kuota Booking per Hari <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light rounded-3 me-2">
                                            <i class="bi bi-people"></i>
                                        </span>
                                        <input type="number" name="max_booking_per_day" 
                                               class="form-control rounded-3 @error('max_booking_per_day') is-invalid @enderror" 
                                               value="{{ old('max_booking_per_day', 10) }}" 
                                               min="1" max="50" required>
                                    </div>
                                    <small class="text-muted">Jumlah maksimal pasien yang dapat dilayani per hari (1-50)</small>
                                    @error('max_booking_per_day')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Foto Dokter</label>
                                    <div class="upload-area border-2 border-dashed rounded-3 p-3 text-center" style="border-color: #dee2e6; background: #f8f9fa; transition: all 0.3s ease;">
                                        <input type="file" name="photo" id="photoInput" 
                                               class="d-none @error('photo') is-invalid @enderror" 
                                               accept="image/jpeg,image/png,image/jpg" onchange="previewImage(this)">
                                        <label for="photoInput" class="d-block" style="cursor: pointer;">
                                            <div id="uploadIcon">
                                                <i class="bi bi-cloud-upload fs-2 text-primary"></i>
                                                <p class="mt-2 mb-0 small">Klik untuk upload foto</p>
                                                <small class="text-muted">JPG, PNG (Max: 2MB)</small>
                                            </div>
                                            <div id="imagePreviewContainer" class="d-none mt-2">
                                                <img id="imagePreview" class="img-fluid rounded-3" style="max-height: 150px;">
                                            </div>
                                        </label>
                                    </div>
                                    @error('photo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="bi bi-file-text text-primary me-2"></i>Deskripsi / Bio
                            </label>
                            <textarea name="description" 
                                      class="form-control rounded-3 @error('description') is-invalid @enderror" 
                                      rows="4" 
                                      placeholder="Tuliskan riwayat pendidikan, pengalaman, keahlian khusus, dll...">{{ old('description') }}</textarea>
                            <small class="text-muted">Deskripsi akan membantu pasien mengenal dokter lebih baik</small>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Jadwal Praktik -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-calendar-week text-primary me-2"></i>Jadwal Praktik
                            </h5>
                            <div id="schedules-container">
                                <div class="schedule-item bg-light rounded-3 p-3 mb-3">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold">Hari</label>
                                            <select name="schedules[0][day]" class="form-select rounded-3" required>
                                                <option value="">Pilih Hari</option>
                                                <option value="Monday">Senin</option>
                                                <option value="Tuesday">Selasa</option>
                                                <option value="Wednesday">Rabu</option>
                                                <option value="Thursday">Kamis</option>
                                                <option value="Friday">Jumat</option>
                                                <option value="Saturday">Sabtu</option>
                                                <option value="Sunday">Minggu</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Jam Mulai</label>
                                            <input type="time" name="schedules[0][start_time]" class="form-control rounded-3" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Jam Selesai</label>
                                            <input type="time" name="schedules[0][end_time]" class="form-control rounded-3" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger remove-schedule w-100 rounded-3" style="display: none;">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="add-schedule" class="btn btn-outline-primary rounded-pill px-4">
                                <i class="bi bi-plus-circle me-2"></i>Tambah Jadwal
                            </button>
                        </div>
                        
                        <!-- Tombol Aksi -->
                        <hr class="my-4">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold" id="submitBtn">
                                <i class="bi bi-save me-2"></i>Simpan Dokter
                            </button>
                            <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary rounded-pill px-4 py-2">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 rounded-4 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-info-circle-fill text-primary me-2"></i>Panduan Pengisian
                    </h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Nama lengkap sesuai dengan gelar
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Spesialisasi yang jelas dan akurat
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Kuota realistis (1-50 pasien per hari)
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Foto dengan resolusi minimal 300x300px
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Jadwal tidak boleh bentrok
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-clock text-primary me-2"></i>Tips Jadwal
                    </h6>
                    <p class="small text-muted mb-2">• Pisahkan jadwal pagi dan sore</p>
                    <p class="small text-muted mb-2">• Istirahat minimal 1 jam antar jadwal</p>
                    <p class="small text-muted mb-0">• Sesuaikan dengan ketersediaan ruangan</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-dashed {
    border: 2px dashed #dee2e6;
    transition: all 0.3s ease;
}

.border-dashed:hover {
    border-color: #0891b2;
    background-color: rgba(8, 145, 178, 0.05);
}

.upload-area {
    transition: all 0.3s ease;
    cursor: pointer;
}

.upload-area:hover {
    border-color: #0891b2;
    background-color: rgba(8, 145, 178, 0.05);
}

.form-control:focus, .form-select:focus {
    border-color: #0891b2;
    box-shadow: 0 0 0 0.2rem rgba(8, 145, 178, 0.25);
}

.schedule-item {
    transition: all 0.3s ease;
    animation: slideIn 0.3s ease-out;
}

.schedule-item:hover {
    transform: translateX(5px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
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
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style>

<script>
let scheduleIndex = 1;

function previewImage(input) {
    const uploadIcon = document.getElementById('uploadIcon');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const preview = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Validasi tipe file
        if (!file.type.match('image.*')) {
            Swal.fire('Error', 'File harus berupa gambar', 'error');
            input.value = '';
            return;
        }
        
        // Validasi ukuran file (max 2MB)
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

document.getElementById('add-schedule').addEventListener('click', function() {
    const container = document.getElementById('schedules-container');
    const newItem = document.createElement('div');
    newItem.className = 'schedule-item bg-light rounded-3 p-3 mb-3';
    newItem.innerHTML = `
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small fw-bold">Hari</label>
                <select name="schedules[${scheduleIndex}][day]" class="form-select rounded-3" required>
                    <option value="">Pilih Hari</option>
                    <option value="Monday">Senin</option>
                    <option value="Tuesday">Selasa</option>
                    <option value="Wednesday">Rabu</option>
                    <option value="Thursday">Kamis</option>
                    <option value="Friday">Jumat</option>
                    <option value="Saturday">Sabtu</option>
                    <option value="Sunday">Minggu</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Jam Mulai</label>
                <input type="time" name="schedules[${scheduleIndex}][start_time]" class="form-control rounded-3" required>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Jam Selesai</label>
                <input type="time" name="schedules[${scheduleIndex}][end_time]" class="form-control rounded-3" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-schedule w-100 rounded-3">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </div>
        </div>
    `;
    container.appendChild(newItem);
    scheduleIndex++;
    
    newItem.querySelector('.remove-schedule').addEventListener('click', function() {
        newItem.remove();
    });
});

// Show remove buttons for existing schedules
document.querySelectorAll('.schedule-item').forEach(item => {
    const removeBtn = item.querySelector('.remove-schedule');
    if (removeBtn && item.querySelector('select[name*="[day]"]').value) {
        removeBtn.style.display = 'block';
        removeBtn.addEventListener('click', () => item.remove());
    }
});

// Form validation
document.getElementById('doctorForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.classList.add('btn-loading');
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Menyimpan...';
    }
    
    let isValid = true;
    let errorMessage = '';
    
    // Check if at least one schedule is added
    const schedules = document.querySelectorAll('.schedule-item');
    if (schedules.length === 0) {
        errorMessage = 'Minimal harus menambahkan 1 jadwal praktik';
        isValid = false;
    }
    
    // Check schedule conflicts
    const scheduleData = [];
    schedules.forEach(schedule => {
        const day = schedule.querySelector('select[name*="[day]"]').value;
        const startTime = schedule.querySelector('input[name*="[start_time]"]').value;
        const endTime = schedule.querySelector('input[name*="[end_time]"]').value;
        
        if (day && startTime && endTime) {
            scheduleData.push({ day, startTime, endTime });
        }
    });
    
    // Check for duplicate days
    const days = scheduleData.map(s => s.day);
    const hasDuplicate = days.some((day, index) => days.indexOf(day) !== index);
    if (hasDuplicate) {
        errorMessage = 'Tidak boleh ada jadwal dengan hari yang sama';
        isValid = false;
    }
    
    if (!isValid) {
        e.preventDefault();
        Swal.fire('Perhatian', errorMessage, 'warning');
        if (submitBtn) {
            submitBtn.classList.remove('btn-loading');
            submitBtn.innerHTML = '<i class="bi bi-save me-2"></i>Simpan Dokter';
        }
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection