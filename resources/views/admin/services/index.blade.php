{{-- resources/views/admin/services/index.blade.php --}}
@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section dengan Gradient Modern -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 rounded-4 overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h2 class="text-white fw-bold mb-2">
                                <i class="bi bi-grid-3x3-gap-fill me-3"></i>Manajemen Layanan
                            </h2>
                            <p class="text-white-50 mb-0">Kelola semua layanan medis yang tersedia di sistem</p>
                        </div>
                        <a href="{{ route('admin.services.create') }}" class="btn btn-light rounded-pill px-4 py-2 fw-bold shadow-sm">
                            <i class="bi bi-plus-circle me-2 text-primary"></i>Tambah Layanan Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards dengan Animasi -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 rounded-4 shadow-sm hover-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Layanan</p>
                            <h3 class="fw-bold mb-0">{{ $services->count() }}</h3>
                        </div>
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="bi bi-hospital fs-2 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 rounded-4 shadow-sm hover-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Layanan Aktif</p>
                            <h3 class="fw-bold mb-0 text-success">{{ $services->where('is_active', true)->count() }}</h3>
                        </div>
                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="bi bi-check-circle fs-2 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 rounded-4 shadow-sm hover-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Layanan Nonaktif</p>
                            <h3 class="fw-bold mb-0 text-danger">{{ $services->where('is_active', false)->count() }}</h3>
                        </div>
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3">
                            <i class="bi bi-x-circle fs-2 text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 rounded-4 shadow-sm hover-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Dengan Gambar</p>
                            <h3 class="fw-bold mb-0 text-info">{{ $services->whereNotNull('image')->count() }}</h3>
                        </div>
                        <div class="rounded-circle bg-info bg-opacity-10 p-3">
                            <i class="bi bi-image fs-2 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter dan Search Bar -->
    <div class="card border-0 rounded-4 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Cari layanan...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select id="statusFilter" class="form-select">
                        <option value="all">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="imageFilter" class="form-select">
                        <option value="all">Semua Layanan</option>
                        <option value="has-image">Dengan Gambar</option>
                        <option value="no-image">Tanpa Gambar</option>
                    </select>
                </div>
                <div class="col-md-2 text-md-end">
                    <button class="btn btn-outline-secondary rounded-pill" id="resetFilters">
                        <i class="bi bi-arrow-repeat me-1"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Layanan dengan Desain Modern -->
    <div class="card border-0 rounded-4 shadow-sm">
        <div class="card-header bg-white border-0 rounded-top-4 p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-table me-2 text-primary"></i>Daftar Layanan
                </h5>
                <div class="text-muted small">
                    <i class="bi bi-info-circle"></i> Klik gambar untuk memperbesar
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="servicesTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3" width="5%">No</th>
                            <th class="py-3" width="10%">Icon</th>
                            <th class="py-3" width="15%">Nama Layanan</th>
                            <th class="py-3" width="30%">Deskripsi</th>
                            <th class="py-3" width="15%">Gambar</th>
                            <th class="py-3" width="10%">Status</th>
                            <th class="pe-4 py-3 text-end" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                        <tr data-status="{{ $service->is_active ? 'active' : 'inactive' }}" 
                            data-image="{{ $service->image ? 'has-image' : 'no-image' }}">
                            <td class="ps-4 fw-bold text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <div class="rounded-circle bg-gradient-primary p-2 d-inline-flex" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width: 45px; height: 45px;">
                                    <i class="bi bi-{{ $service->icon }} text-white fs-5 m-auto"></i>
                                </div>
                            </td>
                            <td class="fw-bold">{{ $service->name }}</td>
                            <td>
                                <div class="text-muted description-cell" style="max-width: 300px;">
                                    {{ Str::limit($service->description, 80) }}
                                    @if(strlen($service->description) > 80)
                                        <a href="#" class="text-primary read-more" data-bs-toggle="modal" data-bs-target="#descriptionModal" data-description="{{ $service->description }}" data-title="{{ $service->name }}">
                                            Baca Selengkapnya
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($service->image)
                                    <div class="image-preview" style="cursor: pointer;">
                                        <img src="{{ asset('storage/' . $service->image) }}" 
                                             class="rounded-3 shadow-sm hover-zoom" 
                                             width="60" height="60" 
                                             style="object-fit: cover;"
                                             data-bs-toggle="modal" 
                                             data-bs-target="#imageModal"
                                             onclick="showImage('{{ asset('storage/' . $service->image) }}')">
                                    </div>
                                @else
                                    <div class="rounded-3 bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="bi bi-image-slash text-muted fs-4"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input toggle-status" 
                                           data-id="{{ $service->id }}"
                                           data-url="{{ route('admin.services.toggle-status', $service) }}"
                                           {{ $service->is_active ? 'checked' : '' }}
                                           style="cursor: pointer; transform: scale(1.2);">
                                </div>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.services.show', $service) }}" class="btn btn-sm btn-info text-white rounded-pill me-1" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-warning rounded-pill me-1" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger rounded-pill" 
                                            onclick="confirmDelete({{ $service->id }})" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $service->id }}" 
                                      action="{{ route('admin.services.destroy', $service) }}" 
                                      method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                    <p class="text-muted mb-3">Belum ada data layanan</p>
                                    <a href="{{ route('admin.services.create') }}" class="btn btn-primary rounded-pill px-4">
                                        <i class="bi bi-plus-circle me-2"></i>Tambah Layanan Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($services->count() > 0)
        <div class="card-footer bg-white border-0 rounded-bottom-4 p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="text-muted small">
                    <i class="bi bi-database me-1"></i>Menampilkan {{ $services->count() }} data
                </div>
                @if(method_exists($services, 'links'))
                    <div class="pagination-wrapper">
                        {{ $services->links() }}
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal untuk Preview Gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body text-center p-0">
                <div class="position-relative">
                    <img id="modalImage" src="" class="img-fluid rounded-4 shadow-lg" alt="Preview">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Deskripsi Lengkap -->
<div class="modal fade" id="descriptionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="descriptionModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="descriptionModalText" class="text-muted"></p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Animasi dan efek hover */
.transition {
    transition: all 0.3s ease;
}

.hover-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.hover-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
}

.hover-zoom {
    transition: transform 0.3s ease;
    cursor: pointer;
}

.hover-zoom:hover {
    transform: scale(1.1);
}

.table tbody tr {
    transition: background-color 0.2s ease;
}

.table tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.05);
}

/* Custom switch styling */
.form-check-input {
    width: 3em;
    height: 1.5em;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: #198754;
    border-color: #198754;
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
}

/* Button styling */
.btn-group .btn {
    transition: all 0.2s ease;
}

.btn-group .btn:hover {
    transform: translateY(-2px);
}

/* Search input styling */
.input-group-text {
    background-color: white;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Empty state styling */
.empty-state {
    padding: 3rem;
}

/* Read more link styling */
.read-more {
    text-decoration: none;
    font-size: 0.85rem;
    margin-left: 5px;
}

.read-more:hover {
    text-decoration: underline;
}

/* Description cell */
.description-cell {
    line-height: 1.5;
}

/* Pagination styling */
.pagination-wrapper nav {
    display: inline-block;
}

.pagination-wrapper .pagination {
    margin-bottom: 0;
}

.pagination-wrapper .page-link {
    border-radius: 0.375rem;
    margin: 0 2px;
    color: #667eea;
}

.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
}

/* Responsive design */
@media (max-width: 768px) {
    .btn-group {
        flex-direction: column;
    }
    
    .btn-group .btn {
        margin-bottom: 5px;
        width: 100%;
    }
    
    .table-responsive {
        font-size: 0.9rem;
    }
    
    .description-cell {
        max-width: 200px !important;
    }
}

/* Loading animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeIn 0.5s ease-out;
}

/* Tooltip styling */
[data-bs-toggle="tooltip"] {
    cursor: pointer;
}

/* Image preview container */
.image-preview {
    position: relative;
    display: inline-block;
}

/* Toast notification */
.toast-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    animation: slideInRight 0.3s ease-out;
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
</style>

<script>
// Search functionality dengan multiple filter
function filterTable() {
    let searchText = document.getElementById('searchInput')?.value.toLowerCase() || '';
    let statusFilter = document.getElementById('statusFilter')?.value || 'all';
    let imageFilter = document.getElementById('imageFilter')?.value || 'all';
    let tableRows = document.querySelectorAll('#servicesTable tbody tr');
    let visibleCount = 0;
    
    tableRows.forEach(row => {
        if (row.querySelector('td[colspan]')) return;
        
        let text = row.textContent.toLowerCase();
        let status = row.dataset.status;
        let image = row.dataset.image;
        
        let matchesSearch = text.includes(searchText);
        let matchesStatus = statusFilter === 'all' || status === statusFilter;
        let matchesImage = imageFilter === 'all' || image === imageFilter;
        
        if (matchesSearch && matchesStatus && matchesImage) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update info jumlah data yang ditampilkan
    updateResultsCount(visibleCount);
}

function updateResultsCount(count) {
    let footer = document.querySelector('.card-footer .text-muted');
    if (footer && count !== undefined) {
        footer.innerHTML = `<i class="bi bi-database me-1"></i>Menampilkan ${count} data`;
    }
}

// Event listeners untuk filter
document.getElementById('searchInput')?.addEventListener('keyup', filterTable);
document.getElementById('statusFilter')?.addEventListener('change', filterTable);
document.getElementById('imageFilter')?.addEventListener('change', filterTable);
document.getElementById('resetFilters')?.addEventListener('click', function() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = 'all';
    document.getElementById('imageFilter').value = 'all';
    filterTable();
});

// Toggle status dengan AJAX
document.querySelectorAll('.toggle-status').forEach(toggle => {
    toggle.addEventListener('change', function() {
        let checkbox = this;
        let url = checkbox.dataset.url;
        let originalState = checkbox.checked;
        
        // Disable checkbox selama proses
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
                showNotification('Status berhasil diupdate', 'success');
                // Update dataset status untuk filter
                let row = checkbox.closest('tr');
                if (row) {
                    row.dataset.status = checkbox.checked ? 'active' : 'inactive';
                }
                // Update statistik
                updateStatistics();
            } else {
                checkbox.checked = !checkbox.checked;
                showNotification(data.message || 'Gagal mengupdate status', 'error');
            }
        })
        .catch(error => {
            checkbox.checked = !checkbox.checked;
            showNotification('Terjadi kesalahan pada server', 'error');
            console.error('Error:', error);
        })
        .finally(() => {
            checkbox.disabled = false;
        });
    });
});

// Update statistik cards
function updateStatistics() {
    let activeCount = document.querySelectorAll('.toggle-status:checked').length;
    let totalCount = document.querySelectorAll('.toggle-status').length;
    let inactiveCount = totalCount - activeCount;
    let hasImageCount = document.querySelectorAll('[data-image="has-image"]').length;
    
    // Update angka di cards
    let statsCards = document.querySelectorAll('.stats-card .fw-bold');
    if (statsCards.length >= 4) {
        statsCards[0].textContent = totalCount;
        statsCards[1].textContent = activeCount;
        statsCards[2].textContent = inactiveCount;
        statsCards[3].textContent = hasImageCount;
    }
}

// Konfirmasi hapus dengan SweetAlert
function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data layanan akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading
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

// Preview gambar di modal dengan animasi
function showImage(src) {
    const modalImage = document.getElementById('modalImage');
    modalImage.style.opacity = '0';
    modalImage.src = src;
    setTimeout(() => {
        modalImage.style.opacity = '1';
    }, 100);
}

// Notifikasi modern
function showNotification(message, type) {
    // Hapus notifikasi yang sudah ada
    const existingToast = document.querySelector('.toast-notification');
    if (existingToast) {
        existingToast.remove();
    }
    
    // Buat elemen notifikasi
    const toast = document.createElement('div');
    toast.className = `toast-notification alert alert-${type === 'success' ? 'success' : 'danger'} shadow-lg rounded-4`;
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        animation: slideInRight 0.3s ease-out;
        min-width: 300px;
    `;
    toast.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill'} me-2 fs-5"></i>
            <div class="flex-grow-1">${message}</div>
            <button type="button" class="btn-close" onclick="this.closest('.toast-notification').remove()"></button>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Auto remove setelah 3 detik
    setTimeout(() => {
        if (toast && toast.remove) {
            toast.remove();
        }
    }, 3000);
}

// Modal deskripsi
document.querySelectorAll('.read-more').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const description = this.dataset.description;
        const title = this.dataset.title;
        document.getElementById('descriptionModalTitle').textContent = title;
        document.getElementById('descriptionModalText').textContent = description;
    });
});

// Inisialisasi tooltip
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});

// Keyboard shortcut untuk search (Ctrl + /)
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === '/') {
        e.preventDefault();
        document.getElementById('searchInput')?.focus();
    }
});

// Auto refresh statistik setiap 30 detik
if (document.querySelector('.toggle-status').length > 0) {
    setInterval(updateStatistics, 30000);
}
</script>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection