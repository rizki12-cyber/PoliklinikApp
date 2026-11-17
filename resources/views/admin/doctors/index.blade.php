{{-- resources/views/admin/doctors/index.blade.php --}}
@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section with Gradient -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h2 class="text-white fw-bold mb-1 fs-4 fs-md-3">
                                <i class="bi bi-person-badge me-2"></i>Manajemen Dokter
                            </h2>
                            <p class="text-white-50 mb-0 small">Kelola data dokter, jadwal praktik, dan kuota pasien</p>
                        </div>
                        <a href="{{ route('admin.doctors.create') }}" class="btn btn-light rounded-pill px-3 px-md-4 py-1 py-md-2 fw-bold shadow-sm btn-sm">
                            <i class="bi bi-plus-circle me-1 me-md-2 text-primary"></i>Tambah Dokter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards - Lebih Ringkas -->
    <div class="row g-2 g-md-4 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 rounded-3 shadow-sm stat-card">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-0 small">Total Dokter</p>
                            <h4 class="fw-bold mb-0 fs-5">{{ $doctors->count() }}</h4>
                        </div>
                        <div class="rounded-circle bg-primary bg-opacity-10 p-2">
                            <i class="bi bi-people fs-6 text-primary"></i>
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
                            <p class="text-muted mb-0 small">Dokter Aktif</p>
                            <h4 class="fw-bold mb-0 fs-5 text-success">{{ $doctors->where('is_active', true)->count() }}</h4>
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
                            <p class="text-muted mb-0 small">Spesialisasi</p>
                            <h4 class="fw-bold mb-0 fs-5 text-info">{{ $doctors->pluck('specialization')->unique()->count() }}</h4>
                        </div>
                        <div class="rounded-circle bg-info bg-opacity-10 p-2">
                            <i class="bi bi-star fs-6 text-info"></i>
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
                            <p class="text-muted mb-0 small">Rata-rata Kuota</p>
                            <h4 class="fw-bold mb-0 fs-5 text-warning">{{ round($doctors->avg('max_booking_per_day')) ?: 0 }}</h4>
                        </div>
                        <div class="rounded-circle bg-warning bg-opacity-10 p-2">
                            <i class="bi bi-calendar-check fs-6 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section - Lebih Ringkas -->
    <div class="card border-0 rounded-3 shadow-sm mb-3">
        <div class="card-body p-2 p-md-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                            <i class="bi bi-search text-muted small"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control form-control-sm border-start-0 rounded-end-pill" placeholder="Cari dokter...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select id="specializationFilter" class="form-select form-select-sm rounded-pill">
                        <option value="">Semua Spesialisasi</option>
                        @foreach($doctors->pluck('specialization')->unique() as $spec)
                            <option value="{{ $spec }}">{{ $spec }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="statusFilter" class="form-select form-select-sm rounded-pill">
                        <option value="all">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Doctors Table - Lebih Ringkas -->
    <div class="card border-0 rounded-3 shadow-sm">
        <div class="card-header bg-white border-0 rounded-top-3 p-2 p-md-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h6 class="fw-bold mb-0">
                    <i class="bi bi-table me-1 text-primary"></i>Daftar Dokter
                </h6>
                <div class="text-muted small">
                    <i class="bi bi-info-circle me-1"></i>Klik foto
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0" id="doctorsTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3 py-2" width="5%">#</th>
                            <th class="py-2" width="8%">Foto</th>
                            <th class="py-2" width="15%">Nama</th>
                            <th class="py-2" width="12%">Spesialisasi</th>
                            <th class="py-2" width="12%">Kontak</th>
                            <th class="py-2 text-center" width="8%">Kuota</th>
                            <th class="py-2" width="10%">Jadwal</th>
                            <th class="py-2 text-center" width="8%">Status</th>
                            <th class="pe-3 py-2 text-end" width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($doctors as $doctor)
                        <tr class="doctor-row" 
                            data-specialization="{{ $doctor->specialization }}"
                            data-status="{{ $doctor->is_active ? 'active' : 'inactive' }}">
                            <td class="ps-3 text-muted small">{{ $loop->iteration }}</td>
                            <td>
                                <div class="position-relative d-inline-block">
                                    <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://ui-avatars.com/api/?background=0891b2&color=fff&name=' . urlencode($doctor->name) . '&size=60' }}" 
                                         class="rounded-circle border border-2 border-white shadow-sm"
                                         width="35" height="35" 
                                         style="object-fit: cover; cursor: pointer;"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#photoModal"
                                         onclick="showPhoto('{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://ui-avatars.com/api/?background=0891b2&color=fff&name=' . urlencode($doctor->name) . '&size=200' }}', '{{ $doctor->name }}')">
                                    <span class="position-absolute bottom-0 end-0 translate-middle p-1 rounded-circle border border-white {{ $doctor->is_active ? 'bg-success' : 'bg-danger' }}" style="width: 8px; height: 8px;"></span>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <span class="fw-bold small">{{ $doctor->name }}</span>
                                    @if($doctor->description)
                                        <br><small class="text-muted" style="font-size: 10px;">{{ Str::limit($doctor->description, 35) }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-2 py-1" style="background: linear-gradient(135deg, #0891b2, #06b6d4); font-size: 10px;">
                                    {{ Str::limit($doctor->specialization, 20) }}
                                </span>
                            </td>
                            <td>
                                <div style="font-size: 11px;">
                                    @if($doctor->phone)
                                        <div><i class="bi bi-telephone-fill text-primary me-1"></i> {{ $doctor->phone }}</div>
                                    @endif
                                    @if($doctor->email)
                                        <div><i class="bi bi-envelope-fill text-primary me-1"></i> {{ Str::limit($doctor->email, 15) }}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-warning bg-opacity-15 text-warning rounded-pill px-2 py-1" style="font-size: 10px;">
                                    <i class="bi bi-people me-1"></i> {{ $doctor->max_booking_per_day }}
                                </span>
                            </td>
                            <td>
                                @if($doctor->schedules->count() > 0)
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($doctor->schedules->take(2) as $schedule)
                                            <span class="badge bg-light text-dark rounded-pill px-1" style="font-size: 9px;">
                                                {{ $schedule->day == 'Monday' ? 'Sen' : ($schedule->day == 'Tuesday' ? 'Sel' : ($schedule->day == 'Wednesday' ? 'Rab' : ($schedule->day == 'Thursday' ? 'Kam' : ($schedule->day == 'Friday' ? 'Jum' : ($schedule->day == 'Saturday' ? 'Sab' : 'Min'))))) }}
                                            </span>
                                        @endforeach
                                        @if($doctor->schedules->count() > 2)
                                            <span class="badge bg-secondary rounded-pill" style="font-size: 9px;">+{{ $doctor->schedules->count() - 2 }}</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted" style="font-size: 11px;">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="form-check form-switch d-flex justify-content-center">
                                    <input type="checkbox" class="form-check-input toggle-status" 
                                           data-id="{{ $doctor->id }}" 
                                           data-url="{{ route('admin.doctors.toggle-status', $doctor) }}"
                                           {{ $doctor->is_active ? 'checked' : '' }}
                                           style="cursor: pointer; transform: scale(1); width: 30px;">
                                </div>
                            </td>
                            <td class="pe-3 text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.doctors.show', $doctor) }}" class="btn btn-sm btn-info text-white rounded-pill px-2 py-0" title="Detail">
                                        <i class="bi bi-eye" style="font-size: 11px;"></i>
                                    </a>
                                    <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-sm btn-warning rounded-pill px-2 py-0 mx-1" title="Edit">
                                        <i class="bi bi-pencil" style="font-size: 11px;"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger rounded-pill px-2 py-0" 
                                            onclick="confirmDelete({{ $doctor->id }})" title="Hapus">
                                        <i class="bi bi-trash" style="font-size: 11px;"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $doctor->id }}" 
                                      action="{{ route('admin.doctors.destroy', $doctor) }}" 
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
                                    <p class="text-muted mb-2 small">Belum ada data dokter</p>
                                    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary rounded-pill px-3 py-1 btn-sm">
                                        <i class="bi bi-plus-circle me-1"></i>Tambah Dokter
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($doctors->count() > 0)
        <div class="card-footer bg-white border-0 rounded-bottom-3 p-2 p-md-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="text-muted small">
                    <i class="bi bi-database me-1"></i><span id="visibleCount">{{ $doctors->count() }}</span> dari {{ $doctors->count() }} dokter
                </div>
                @if(method_exists($doctors, 'links'))
                    <div class="pagination-wrapper">
                        {{ $doctors->links() }}
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal Preview Foto -->
<div class="modal fade" id="photoModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 rounded-3 bg-transparent">
            <div class="modal-body text-center p-0">
                <div class="position-relative d-inline-block">
                    <img id="modalPhoto" src="" class="img-fluid rounded-3 shadow-lg" alt="Foto Dokter" style="max-height: 300px;">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-2 bg-dark rounded-circle p-1" style="font-size: 10px;" data-bs-dismiss="modal"></button>
                </div>
                <h6 id="photoModalTitle" class="text-white mt-2 mb-0 fw-bold"></h6>
            </div>
        </div>
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
    background-color: rgba(8, 145, 178, 0.03);
}

.form-check-input:checked {
    background-color: #0891b2;
    border-color: #0891b2;
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.1rem rgba(8, 145, 178, 0.25);
}

.btn-group .btn {
    transition: all 0.2s ease;
}

.btn-group .btn:hover {
    transform: translateY(-1px);
}

.empty-state {
    padding: 1.5rem;
}

.pagination-wrapper nav {
    display: inline-block;
}

.pagination-wrapper .pagination {
    margin-bottom: 0;
}

.pagination-wrapper .page-link {
    border-radius: 0.25rem;
    margin: 0 1px;
    color: #0891b2;
    padding: 0.25rem 0.5rem;
    font-size: 11px;
}

.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(135deg, #0891b2, #06b6d4);
    border-color: #0891b2;
    color: white;
}

.bg-opacity-15 {
    --bs-bg-opacity: 0.15;
}

/* Custom scrollbar untuk tabel */
.table-responsive::-webkit-scrollbar {
    height: 4px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #0891b2;
    border-radius: 10px;
}

@media (max-width: 768px) {
    .btn-group {
        flex-direction: row;
    }
    
    .btn-group .btn {
        margin-bottom: 0;
        width: auto;
        padding: 0.15rem 0.4rem;
    }
    
    .table td, .table th {
        padding: 0.4rem 0.3rem;
    }
}
</style>

<script>
let currentVisibleCount = {{ $doctors->count() }};

function filterTable() {
    let searchText = document.getElementById('searchInput')?.value.toLowerCase() || '';
    let specialization = document.getElementById('specializationFilter')?.value || '';
    let status = document.getElementById('statusFilter')?.value || 'all';
    let rows = document.querySelectorAll('#doctorsTable tbody tr.doctor-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        let rowSpecialization = row.dataset.specialization || '';
        let rowStatus = row.dataset.status || '';
        
        let matchesSearch = text.includes(searchText);
        let matchesSpecialization = !specialization || rowSpecialization === specialization;
        let matchesStatus = status === 'all' || rowStatus === status;
        
        if (matchesSearch && matchesSpecialization && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    document.getElementById('visibleCount').textContent = visibleCount;
}

// Event listeners
document.getElementById('searchInput')?.addEventListener('keyup', filterTable);
document.getElementById('specializationFilter')?.addEventListener('change', filterTable);
document.getElementById('statusFilter')?.addEventListener('change', filterTable);

// Toggle status dengan AJAX
document.querySelectorAll('.toggle-status').forEach(toggle => {
    toggle.addEventListener('change', function() {
        let checkbox = this;
        let url = checkbox.dataset.url;
        
        checkbox.disabled = true;
        
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ is_active: checkbox.checked })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Status berhasil diubah', 'success');
                let row = checkbox.closest('tr');
                if (row) {
                    row.dataset.status = checkbox.checked ? 'active' : 'inactive';
                    let statusDot = row.querySelector('.position-absolute');
                    if (statusDot) {
                        statusDot.className = `position-absolute bottom-0 end-0 translate-middle p-1 rounded-circle border border-white ${checkbox.checked ? 'bg-success' : 'bg-danger'}`;
                    }
                }
                updateStatistics();
            } else {
                checkbox.checked = !checkbox.checked;
                showNotification(data.message || 'Gagal mengubah status', 'error');
            }
        })
        .catch(error => {
            checkbox.checked = !checkbox.checked;
            showNotification('Terjadi kesalahan', 'error');
        })
        .finally(() => {
            checkbox.disabled = false;
        });
    });
});

function updateStatistics() {
    let totalCount = document.querySelectorAll('.toggle-status').length;
    let activeCount = document.querySelectorAll('.toggle-status:checked').length;
    let inactiveCount = totalCount - activeCount;
    
    let statCards = document.querySelectorAll('.stat-card .fw-bold');
    if (statCards.length >= 4) {
        statCards[0].textContent = totalCount;
        statCards[1].textContent = activeCount;
        statCards[2].textContent = inactiveCount;
    }
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Dokter?',
        text: "Data dokter dan jadwal akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#0891b2',
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

function showPhoto(src, name) {
    document.getElementById('modalPhoto').src = src;
    document.getElementById('photoModalTitle').innerHTML = name;
}

function showNotification(message, type) {
    const toast = document.createElement('div');
    toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} shadow-sm rounded-3`;
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        animation: slideInRight 0.3s ease-out;
        min-width: 250px;
        font-size: 12px;
        padding: 0.5rem 1rem;
    `;
    toast.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill'} me-2"></i>
            <div class="flex-grow-1">${message}</div>
            <button type="button" class="btn-close btn-sm" onclick="this.closest('.alert').remove()"></button>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        if (toast && toast.remove) {
            toast.remove();
        }
    }, 3000);
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

// Keyboard shortcut untuk search
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === '/') {
        e.preventDefault();
        document.getElementById('searchInput')?.focus();
    }
});
</script>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection