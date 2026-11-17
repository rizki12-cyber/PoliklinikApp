{{-- resources/views/admin/doctors/edit.blade.php --}}
@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                            <i class="bi bi-pencil-square fs-4 text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-white fw-bold mb-2">Edit Dokter</h2>
                            <p class="text-white-50 mb-0">Update informasi dokter dan jadwal praktik</p>
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
                    <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data" id="doctorForm">
                        @csrf
                        @method('PUT')
                        
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
                                           value="{{ old('name', $doctor->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Spesialisasi <span class="text-danger">*</span></label>
                                    <select name="specialization" class="form-select form-select-lg rounded-3 @error('specialization') is-invalid @enderror" required>
                                        <option value="">Pilih Spesialisasi</option>
                                        <option value="Spesialis Penyakit Dalam" {{ old('specialization', $doctor->specialization) == 'Spesialis Penyakit Dalam' ? 'selected' : '' }}>Spesialis Penyakit Dalam</option>
                                        <option value="Spesialis Anak" {{ old('specialization', $doctor->specialization) == 'Spesialis Anak' ? 'selected' : '' }}>Spesialis Anak</option>
                                        <option value="Spesialis Bedah" {{ old('specialization', $doctor->specialization) == 'Spesialis Bedah' ? 'selected' : '' }}>Spesialis Bedah</option>
                                        <option value="Spesialis Kandungan" {{ old('specialization', $doctor->specialization) == 'Spesialis Kandungan' ? 'selected' : '' }}>Spesialis Kandungan</option>
                                        <option value="Spesialis Jantung" {{ old('specialization', $doctor->specialization) == 'Spesialis Jantung' ? 'selected' : '' }}>Spesialis Jantung</option>
                                        <option value="Spesialis Saraf" {{ old('specialization', $doctor->specialization) == 'Spesialis Saraf' ? 'selected' : '' }}>Spesialis Saraf</option>
                                        <option value="Spesialis Mata" {{ old('specialization', $doctor->specialization) == 'Spesialis Mata' ? 'selected' : '' }}>Spesialis Mata</option>
                                        <option value="Dokter Gigi" {{ old('specialization', $doctor->specialization) == 'Dokter Gigi' ? 'selected' : '' }}>Dokter Gigi</option>
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
                                               value="{{ old('email', $doctor->email) }}">
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
                                               value="{{ old('phone', $doctor->phone) }}">
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
                                               value="{{ old('max_booking_per_day', $doctor->max_booking_per_day) }}" 
                                               min="1" max="50" required>
                                    </div>
                                    @error('max_booking_per_day')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Foto Dokter</label>
                                    @if($doctor->photo)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $doctor->photo) }}" 
                                                 class="rounded-3 shadow-sm" 
                                                 style="max-height: 80px;">
                                        </div>
                                    @endif
                                    <div class="border-2 border-dashed rounded-3 p-3 text-center" style="border-color: #dee2e6; background: #f8f9fa;">
                                        <input type="file" name="photo" id="photoInput" 
                                               class="d-none @error('photo') is-invalid @enderror" 
                                               accept="image/*" onchange="previewImage(this)">
                                        <label for="photoInput" class="d-block" style="cursor: pointer;">
                                            <div id="uploadIcon">
                                                <i class="bi bi-cloud-upload fs-2 text-primary"></i>
                                                <p class="mt-2 mb-0 small">Klik untuk mengganti foto</p>
                                                <small class="text-muted">Kosongkan jika tidak ingin mengubah</small>
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
                                      placeholder="Tuliskan riwayat pendidikan, pengalaman, keahlian khusus, dll...">{{ old('description', $doctor->description) }}</textarea>
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
                                @foreach($doctor->schedules as $index => $schedule)
                                <div class="schedule-item bg-light rounded-3 p-3 mb-3">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold">Hari</label>
                                            <select name="schedules[{{ $index }}][day]" class="form-select rounded-3" required>
                                                <option value="">Pilih Hari</option>
                                                <option value="Monday" {{ $schedule->day == 'Monday' ? 'selected' : '' }}>Senin</option>
                                                <option value="Tuesday" {{ $schedule->day == 'Tuesday' ? 'selected' : '' }}>Selasa</option>
                                                <option value="Wednesday" {{ $schedule->day == 'Wednesday' ? 'selected' : '' }}>Rabu</option>
                                                <option value="Thursday" {{ $schedule->day == 'Thursday' ? 'selected' : '' }}>Kamis</option>
                                                <option value="Friday" {{ $schedule->day == 'Friday' ? 'selected' : '' }}>Jumat</option>
                                                <option value="Saturday" {{ $schedule->day == 'Saturday' ? 'selected' : '' }}>Sabtu</option>
                                                <option value="Sunday" {{ $schedule->day == 'Sunday' ? 'selected' : '' }}>Minggu</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Jam Mulai</label>
                                            <input type="time" name="schedules[{{ $index }}][start_time]" 
                                                   class="form-control rounded-3" 
                                                   value="{{ $schedule->start_time }}" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Jam Selesai</label>
                                            <input type="time" name="schedules[{{ $index }}][end_time]" 
                                                   class="form-control rounded-3" 
                                                   value="{{ $schedule->end_time }}" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger remove-schedule w-100 rounded-3">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-schedule" class="btn btn-outline-primary rounded-pill px-4">
                                <i class="bi bi-plus-circle me-2"></i>Tambah Jadwal
                            </button>
                        </div>
                        
                        <!-- Tombol Aksi -->
                        <hr class="my-4">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold">
                                <i class="bi bi-save me-2"></i>Update Dokter
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
                        <i class="bi bi-clock-history text-primary me-2"></i>Informasi
                    </h6>
                    <div class="mb-2">
                        <small class="text-muted d-block">Dibuat pada</small>
                        <strong>{{ $doctor->created_at->format('d F Y H:i') }}</strong>
                    </div>
                    <div>
                        <small class="text-muted d-block">Terakhir diupdate</small>
                        <strong>{{ $doctor->updated_at->format('d F Y H:i') }}</strong>
                    </div>
                </div>
            </div>
            
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-exclamation-triangle text-warning me-2"></i>Catatan
                    </h6>
                    <p class="small text-muted mb-0">
                        Perubahan data akan langsung berpengaruh pada sistem booking pasien. Pastikan data yang diupdate sudah benar.
                    </p>
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
    border-color: #f59e0b;
    box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
}
.schedule-item {
    transition: all 0.3s ease;
}
.schedule-item:hover {
    transform: translateX(5px);
}
</style>

<script>
let scheduleIndex = {{ $doctor->schedules->count() }};

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

// Add remove functionality to existing remove buttons
document.querySelectorAll('.remove-schedule').forEach(btn => {
    btn.addEventListener('click', function() {
        this.closest('.schedule-item').remove();
    });
});
</script>
@endsection