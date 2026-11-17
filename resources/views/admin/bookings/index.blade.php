{{-- resources/views/admin/bookings/index.blade.php --}}
@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h2 class="text-white fw-bold mb-1 fs-4 fs-md-3">
                                <i class="bi bi-calendar-check me-2"></i>Manajemen Booking
                            </h2>
                            <p class="text-white-50 mb-0 small">Kelola dan monitoring semua booking pasien</p>
                        </div>
                        <button type="button" class="btn btn-light rounded-pill px-3 px-md-4 py-1 py-md-2 fw-bold shadow-sm btn-sm" data-bs-toggle="modal" data-bs-target="#exportModal">
                            <i class="bi bi-file-excel me-1 me-md-2 text-success"></i>Export Excel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-2 g-md-4 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 rounded-3 shadow-sm stat-card">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-0 small">Total Booking</p>
                            <h4 class="fw-bold mb-0 fs-5">{{ $bookings->total() }}</h4>
                        </div>
                        <div class="rounded-circle bg-primary bg-opacity-10 p-2">
                            <i class="bi bi-calendar fs-6 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 rounded-3 shadow-sm stat-card">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-0 small">Pending</p>
                            <h4 class="fw-bold mb-0 fs-5 text-warning">{{ $bookings->where('status', 'pending')->count() }}</h4>
                        </div>
                        <div class="rounded-circle bg-warning bg-opacity-10 p-2">
                            <i class="bi bi-clock-history fs-6 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 rounded-3 shadow-sm stat-card">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-0 small">Confirmed</p>
                            <h4 class="fw-bold mb-0 fs-5 text-success">{{ $bookings->where('status', 'confirmed')->count() }}</h4>
                        </div>
                        <div class="rounded-circle bg-success bg-opacity-10 p-2">
                            <i class="bi bi-check-circle fs-6 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 rounded-3 shadow-sm stat-card">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-0 small">Completed</p>
                            <h4 class="fw-bold mb-0 fs-5 text-info">{{ $bookings->where('status', 'completed')->count() }}</h4>
                        </div>
                        <div class="rounded-circle bg-info bg-opacity-10 p-2">
                            <i class="bi bi-award fs-6 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card border-0 rounded-3 shadow-sm mb-3">
        <div class="card-body p-2 p-md-3">
            <form method="GET" class="row g-2">
                <div class="col-md-3">
                    <input type="date" name="date" class="form-control form-control-sm rounded-pill" value="{{ request('date') }}" placeholder="Tanggal">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm rounded-pill">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="doctor_id" class="form-select form-select-sm rounded-pill">
                        <option value="">Semua Dokter</option>
                        @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ request('doctor_id') == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-sm rounded-pill w-100">
                        <i class="bi bi-search me-1"></i>Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Export Modal -->
    <div class="modal fade" id="exportModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <form action="{{ route('admin.bookings.export') }}" method="GET">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold">
                            <i class="bi bi-file-excel text-success me-2"></i>Export Data Booking
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control rounded-pill" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Akhir</label>
                            <input type="date" name="end_date" class="form-control rounded-pill" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success rounded-pill px-4">
                            <i class="bi bi-download me-2"></i>Export
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="card border-0 rounded-3 shadow-sm">
        <div class="card-header bg-white border-0 rounded-top-3 p-2 p-md-3">
            <h6 class="fw-bold mb-0">
                <i class="bi bi-table me-1 text-primary"></i>Daftar Booking
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3 py-2" width="5%">No</th>
                            <th class="py-2" width="15%">Pasien</th>
                            <th class="py-2" width="10%">Kontak</th>
                            <th class="py-2" width="15%">Dokter</th>
                            <th class="py-2" width="10%">Tanggal</th>
                            <th class="py-2" width="20%">Keluhan</th>
                            <th class="py-2" width="10%">Status</th>
                            <th class="py-2" width="10%">Dibuat</th>
                            <th class="pe-3 py-2 text-end" width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td class="ps-3 text-muted small">{{ $loop->iteration }}</td>
                            <td>
                                <span class="fw-bold small">{{ $booking->patient_name }}</span>
                            </td>
                            <td>
                                <div class="small">
                                    @if($booking->phone)
                                        <div><i class="bi bi-telephone-fill text-primary me-1"></i> {{ $booking->phone }}</div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="small">{{ $booking->doctor->name ?? '-' }}</span>
                                <br><small class="text-muted">{{ $booking->doctor->specialization ?? '' }}</small>
                            </td>
                            <td class="small">{{ date('d/m/Y', strtotime($booking->booking_date)) }}</td>
                            <td>
                                <div class="small text-muted" style="max-width: 200px;">
                                    {{ Str::limit($booking->complaint, 40) }}
                                </div>
                            </td>
                            <td>{!! $booking->status_badge !!}</td>
                            <td class="small">{{ $booking->created_at->diffForHumans() }}</td>
                            <td class="pe-3 text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-info text-white rounded-pill px-2 py-0" title="Detail">
                                        <i class="bi bi-eye" style="font-size: 11px;"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger rounded-pill px-2 py-0 ms-1" 
                                            onclick="confirmDelete({{ $booking->id }})" title="Hapus">
                                        <i class="bi bi-trash" style="font-size: 11px;"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $booking->id }}" 
                                      action="{{ route('admin.bookings.destroy', $booking) }}" 
                                      method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="bi bi-inbox fs-2 text-muted d-block mb-2"></i>
                                    <p class="text-muted mb-2 small">Belum ada data booking</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($bookings->total() > 0)
        <div class="card-footer bg-white border-0 rounded-bottom-3 p-2 p-md-3">
            <div class="d-flex justify-content-center">
                {{ $bookings->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.stat-card {
    transition: all 0.2s ease;
    cursor: pointer;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15) !important;
}

.table tbody tr:hover {
    background-color: rgba(99, 102, 241, 0.03);
}

.empty-state {
    padding: 1.5rem;
}

.pagination {
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .btn-group .btn {
        padding: 0.15rem 0.4rem;
    }
    
    .table td, .table th {
        padding: 0.4rem 0.3rem;
    }
}
</style>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Booking?',
        text: "Data booking akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6366f1',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Menghapus...',
                text: 'Mohon tunggu',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            document.getElementById(`delete-form-${id}`).submit();
        }
    });
}

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection