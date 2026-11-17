{{-- resources/views/admin/doctors/show.blade.php --}}
@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                                <i class="bi bi-person-badge fs-4 text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-white fw-bold mb-2">Detail Dokter</h2>
                                <p class="text-white-50 mb-0">Informasi lengkap tentang dokter dan jadwal praktik</p>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light rounded-pill px-4 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i> Aksi
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.doctors.edit', $doctor) }}">
                                        <i class="bi bi-pencil-square text-warning me-2"></i>Edit Dokter
                                    </a>
                                </li>
                                <li>
                                    <button class="dropdown-item text-danger" onclick="confirmDelete({{ $doctor->id }})">
                                        <i class="bi bi-trash me-2"></i>Hapus Dokter
                                    </button>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.doctors.index') }}">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Kiri - Profil -->
        <div class="col-lg-4 mb-4">
            <!-- Profil Card -->
            <div class="card border-0 rounded-4 shadow-sm mb-4">
                <div class="card-body p-4 text-center">
                    <div class="position-relative d-inline-block mb-3">
                        <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://ui-avatars.com/api/?background=0891b2&color=fff&name=' . urlencode($doctor->name) . '&size=200' }}" 
                             class="rounded-circle shadow-lg" 
                             width="180" height="180" 
                             style="object-fit: cover; border: 4px solid white;">
                        <span class="position-absolute bottom-0 end-0 p-2 rounded-circle {{ $doctor->is_active ? 'bg-success' : 'bg-danger' }} border border-white"></span>
                    </div>
                    
                    <h4 class="fw-bold mb-1">{{ $doctor->name }}</h4>
                    <span class="badge bg-gradient rounded-pill px-3 py-2 mb-3" style="background: linear-gradient(135deg, #0891b2, #06b6d4);">
                        {{ $doctor->specialization }}
                    </span>
                    
                    <div class="d-flex justify-content-center gap-3 mb-3">
                        <div class="text-center">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-2 mb-1">
                                <i class="bi bi-people text-primary"></i>
                            </div>
                            <small class="text-muted">Kuota/Hari</small>
                            <div class="fw-bold">{{ $doctor->max_booking_per_day }} pasien</div>
                        </div>
                        <div class="text-center">
                            <div class="rounded-circle bg-info bg-opacity-10 p-2 mb-1">
                                <i class="bi bi-calendar-check text-info"></i>
                            </div>
                            <small class="text-muted">Total Jadwal</small>
                            <div class="fw-bold">{{ $doctor->schedules->count() }} hari</div>
                        </div>
                        <div class="text-center">
                            <div class="rounded-circle bg-{{ $doctor->is_active ? 'success' : 'danger' }} bg-opacity-10 p-2 mb-1">
                                <i class="bi bi-{{ $doctor->is_active ? 'check-circle' : 'x-circle' }} text-{{ $doctor->is_active ? 'success' : 'danger' }}"></i>
                            </div>
                            <small class="text-muted">Status</small>
                            <div class="fw-bold">{{ $doctor->is_active ? 'Aktif' : 'Nonaktif' }}</div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="text-start">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-info-circle text-primary me-2"></i>Informasi Kontak
                        </h6>
                        @if($doctor->email)
                        <div class="mb-2 d-flex align-items-center">
                            <div class="rounded-circle bg-light p-2 me-3" style="width: 35px; height: 35px; text-align: center;">
                                <i class="bi bi-envelope text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Email</small>
                                <a href="mailto:{{ $doctor->email }}" class="text-decoration-none">{{ $doctor->email }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @if($doctor->phone)
                        <div class="mb-2 d-flex align-items-center">
                            <div class="rounded-circle bg-light p-2 me-3" style="width: 35px; height: 35px; text-align: center;">
                                <i class="bi bi-telephone text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Telepon</small>
                                <a href="tel:{{ $doctor->phone }}" class="text-decoration-none">{{ $doctor->phone }}</a>
                            </div>
                        </div>
                        @endif
                        
                        <div class="mb-2 d-flex align-items-center">
                            <div class="rounded-circle bg-light p-2 me-3" style="width: 35px; height: 35px; text-align: center;">
                                <i class="bi bi-calendar text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Bergabung Sejak</small>
                                <span>{{ $doctor->created_at->format('d F Y') }}</span>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-light p-2 me-3" style="width: 35px; height: 35px; text-align: center;">
                                <i class="bi bi-clock-history text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Terakhir Update</small>
                                <span>{{ $doctor->updated_at->format('d F Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-lightning-charge text-warning me-2"></i>Aksi Cepat
                    </h6>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary rounded-pill" onclick="copyDoctorInfo()">
                            <i class="bi bi-clipboard me-2"></i>Salin Informasi
                        </button>
                        <button class="btn btn-outline-success rounded-pill" onclick="window.print()">
                            <i class="bi bi-printer me-2"></i>Cetak Profil
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Kolom Kanan - Detail -->
        <div class="col-lg-8">
            <!-- Deskripsi Card -->
            <div class="card border-0 rounded-4 shadow-sm mb-4">
                <div class="card-header bg-white border-0 rounded-top-4 p-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-file-text text-primary me-2"></i>Tentang Dokter
                    </h5>
                </div>
                <div class="card-body p-4 pt-0">
                    @if($doctor->description)
                        <div class="p-3 bg-light rounded-3">
                            <p class="mb-0 text-secondary">{{ $doctor->description }}</p>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-file-text fs-1 text-muted"></i>
                            <p class="text-muted mt-2 mb-0">Belum ada deskripsi</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Jadwal Praktik Card -->
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-header bg-white border-0 rounded-top-4 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-calendar-week text-primary me-2"></i>Jadwal Praktik
                        </h5>
                        <span class="badge bg-primary rounded-pill">{{ $doctor->schedules->count() }} Jadwal</span>
                    </div>
                </div>
                <div class="card-body p-4 pt-0">
                    @if($doctor->schedules->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="rounded-start">Hari</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Durasi</th>
                                        <th class="rounded-end">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $daysOrder = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                        $daysIndonesian = [
                                            'Monday' => 'Senin',
                                            'Tuesday' => 'Selasa',
                                            'Wednesday' => 'Rabu',
                                            'Thursday' => 'Kamis',
                                            'Friday' => 'Jumat',
                                            'Saturday' => 'Sabtu',
                                            'Sunday' => 'Minggu'
                                        ];
                                        $sortedSchedules = $doctor->schedules->sortBy(function($schedule) use ($daysOrder) {
                                            return array_search($schedule->day, $daysOrder);
                                        });
                                    @endphp
                                    
                                    @foreach($sortedSchedules as $schedule)
                                        @php
                                            $start = \Carbon\Carbon::parse($schedule->start_time);
                                            $end = \Carbon\Carbon::parse($schedule->end_time);
                                            $duration = $start->diffInMinutes($end);
                                            $hours = floor($duration / 60);
                                            $minutes = $duration % 60;
                                            $durationText = $hours > 0 ? $hours . ' jam ' . ($minutes > 0 ? $minutes . ' menit' : '') : $minutes . ' menit';
                                            $isActiveSchedule = now()->format('l') === $schedule->day && 
                                                                now()->format('H:i') >= $schedule->start_time && 
                                                                now()->format('H:i') <= $schedule->end_time;
                                        @endphp
                                        <tr>
                                            <td class="fw-bold">
                                                <i class="bi bi-calendar-day text-primary me-2"></i>
                                                {{ $daysIndonesian[$schedule->day] ?? $schedule->day }}
                                            </td>
                                            <td>
                                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill">
                                                    <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill">
                                                    <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                                </span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    <i class="bi bi-hourglass-split"></i> {{ $durationText }}
                                                </small>
                                            </td>
                                            <td>
                                                @if($isActiveSchedule)
                                                    <span class="badge bg-success rounded-pill">
                                                        <i class="bi bi-play-fill"></i> Sedang Praktik
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary rounded-pill">
                                                        <i class="bi bi-pause-fill"></i> Off
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Ringkasan Jadwal -->
                        <div class="alert alert-info bg-opacity-10 border-0 rounded-3 mt-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-info-circle-fill fs-4 me-3 text-info"></i>
                                <div>
                                    <small class="text-info fw-bold">Informasi Jadwal</small>
                                    <p class="mb-0 small">Dokter praktik selama {{ $doctor->schedules->count() }} hari dalam seminggu. Kuota maksimal {{ $doctor->max_booking_per_day }} pasien per hari.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-calendar-x fs-1 text-muted"></i>
                            <p class="text-muted mt-2 mb-0">Belum ada jadwal praktik</p>
                            <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-sm btn-primary rounded-pill mt-3">
                                <i class="bi bi-plus-circle"></i> Tambah Jadwal
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Statistik Booking (Optional) -->
            @if(isset($doctor->bookings) && $doctor->bookings->count() > 0)
            <div class="card border-0 rounded-4 shadow-sm mt-4">
                <div class="card-header bg-white border-0 rounded-top-4 p-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-graph-up text-primary me-2"></i>Statistik Booking
                    </h5>
                </div>
                <div class="card-body p-4 pt-0">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="border rounded-3 p-3 text-center">
                                <small class="text-muted">Total Booking</small>
                                <h3 class="fw-bold mb-0 text-primary">{{ $doctor->bookings->count() }}</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded-3 p-3 text-center">
                                <small class="text-muted">Booking Selesai</small>
                                <h3 class="fw-bold mb-0 text-success">{{ $doctor->bookings->where('status', 'completed')->count() }}</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded-3 p-3 text-center">
                                <small class="text-muted">Booking Menunggu</small>
                                <h3 class="fw-bold mb-0 text-warning">{{ $doctor->bookings->where('status', 'pending')->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Form -->
<form id="delete-form-{{ $doctor->id }}" action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

<style>
.bg-gradient {
    background: linear-gradient(135deg, #0891b2, #06b6d4);
}
.table > :not(caption) > * > * {
    padding: 1rem 0.75rem;
}
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-2px);
}
</style>

<script>
// Copy doctor information
function copyDoctorInfo() {
    const info = `Nama: {{ $doctor->name }}
Spesialisasi: {{ $doctor->specialization }}
Email: {{ $doctor->email ?? '-' }}
Telepon: {{ $doctor->phone ?? '-' }}
Kuota per Hari: {{ $doctor->max_booking_per_day }} pasien
Status: {{ $doctor->is_active ? 'Aktif' : 'Nonaktif' }}
Jadwal Praktik:
@foreach($doctor->schedules as $schedule)
- {{ $schedule->day }}: {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
@endforeach`;

    navigator.clipboard.writeText(info).then(() => {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Informasi dokter telah disalin ke clipboard',
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    });
}

// Confirm delete
function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Dokter?',
        text: "Data dokter dan semua jadwalnya akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#0891b2',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    });
}

// Show toast notification on page load if there's session message
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
    });
@endif
</script>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection