{{-- resources/views/admin/articles/index.blade.php --}}
@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h2 class="text-white fw-bold mb-1 fs-4 fs-md-3">
                                <i class="bi bi-newspaper me-2"></i>Manajemen Artikel
                            </h2>
                            <p class="text-white-50 mb-0 small">Kelola artikel kesehatan untuk website</p>
                        </div>
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-light rounded-pill px-3 px-md-4 py-1 py-md-2 fw-bold shadow-sm btn-sm">
                            <i class="bi bi-plus-circle me-1 me-md-2 text-success"></i>Tambah Artikel
                        </a>
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
                            <p class="text-muted mb-0 small">Total Artikel</p>
                            <h4 class="fw-bold mb-0 fs-5">{{ $articles->total() }}</h4>
                        </div>
                        <div class="rounded-circle bg-primary bg-opacity-10 p-2">
                            <i class="bi bi-newspaper fs-6 text-primary"></i>
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
                            <p class="text-muted mb-0 small">Published</p>
                            <h4 class="fw-bold mb-0 fs-5 text-success">{{ $articles->where('is_published', true)->count() }}</h4>
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
                            <p class="text-muted mb-0 small">Draft</p>
                            <h4 class="fw-bold mb-0 fs-5 text-warning">{{ $articles->where('is_published', false)->count() }}</h4>
                        </div>
                        <div class="rounded-circle bg-warning bg-opacity-10 p-2">
                            <i class="bi bi-pencil fs-6 text-warning"></i>
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
                            <p class="text-muted mb-0 small">Total Views</p>
                            <h4 class="fw-bold mb-0 fs-5 text-info">{{ $articles->sum('views') }}</h4>
                        </div>
                        <div class="rounded-circle bg-info bg-opacity-10 p-2">
                            <i class="bi bi-eye fs-6 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card border-0 rounded-3 shadow-sm mb-3">
        <div class="card-body p-2 p-md-3">
            <div class="row g-2">
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                            <i class="bi bi-search text-muted small"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control form-control-sm border-start-0 rounded-end-pill" placeholder="Cari artikel...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select id="statusFilter" class="form-select form-select-sm rounded-pill">
                        <option value="all">Semua Status</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="sortFilter" class="form-select form-select-sm rounded-pill">
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="popular">Terpopuler (Views)</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill w-100" id="resetFilters">
                        <i class="bi bi-arrow-repeat me-1"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Articles Table -->
    <div class="card border-0 rounded-3 shadow-sm">
        <div class="card-header bg-white border-0 rounded-top-3 p-2 p-md-3">
            <h6 class="fw-bold mb-0">
                <i class="bi bi-table me-1 text-primary"></i>Daftar Artikel
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0" id="articlesTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3 py-2" width="5%">#</th>
                            <th class="py-2" width="10%">Gambar</th>
                            <th class="py-2" width="20%">Judul</th>
                            <th class="py-2" width="25%">Ringkasan</th>
                            <th class="py-2 text-center" width="8%">Views</th>
                            <th class="py-2 text-center" width="10%">Status</th>
                            <th class="py-2" width="10%">Tanggal</th>
                            <th class="pe-3 py-2 text-end" width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                        <tr class="article-row" data-status="{{ $article->is_published ? 'published' : 'draft' }}" data-views="{{ $article->views }}" data-date="{{ $article->created_at }}">
                            <td class="ps-3 text-muted small">{{ $loop->iteration }}</td>
                            <td>
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" 
                                         class="rounded-2 shadow-sm article-img" 
                                         width="45" height="45" 
                                         style="object-fit: cover; cursor: pointer;"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#imageModal"
                                         onclick="showImage('{{ asset('storage/' . $article->image) }}', '{{ $article->title }}')">
                                @else
                                    <div class="rounded-2 bg-light d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="bi bi-image-slash text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold small">{{ Str::limit($article->title, 45) }}</span>
                            </td>
                            <td>
                                <div class="small text-muted" style="max-width: 250px;">
                                    {{ Str::limit($article->summary ?? strip_tags($article->content), 60) }}
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-2 py-1" style="font-size: 10px;">
                                    <i class="bi bi-eye me-1"></i> {{ number_format($article->views) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="form-check form-switch d-flex justify-content-center">
                                    <input type="checkbox" class="form-check-input toggle-status" 
                                           data-id="{{ $article->id }}" 
                                           data-url="{{ route('admin.articles.toggle-status', $article) }}"
                                           {{ $article->is_published ? 'checked' : '' }}
                                           style="cursor: pointer; transform: scale(1); width: 30px;">
                                </div>
                            </td>
                            <td class="small">{{ $article->created_at->format('d/m/Y') }}</td>
                            <td class="pe-3 text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('article.show', $article->slug) }}" class="btn btn-sm btn-info text-white rounded-pill px-2 py-0" target="_blank" title="Lihat">
                                        <i class="bi bi-eye" style="font-size: 11px;"></i>
                                    </a>
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-warning rounded-pill px-2 py-0 mx-1" title="Edit">
                                        <i class="bi bi-pencil" style="font-size: 11px;"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger rounded-pill px-2 py-0" 
                                            onclick="confirmDelete({{ $article->id }})" title="Hapus">
                                        <i class="bi bi-trash" style="font-size: 11px;"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $article->id }}" 
                                      action="{{ route('admin.articles.destroy', $article) }}" 
                                      method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="bi bi-inbox fs-2 text-muted d-block mb-2"></i>
                                    <p class="text-muted mb-2 small">Belum ada artikel</p>
                                    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary rounded-pill px-3 py-1 btn-sm">
                                        <i class="bi bi-plus-circle me-1"></i>Tambah Artikel
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($articles->total() > 0)
        <div class="card-footer bg-white border-0 rounded-bottom-3 p-2 p-md-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="text-muted small">
                    <i class="bi bi-database me-1"></i>Menampilkan <span id="visibleCount">{{ $articles->count() }}</span> dari {{ $articles->total() }} artikel
                </div>
                <div class="pagination-wrapper">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal Preview Gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 rounded-3 bg-transparent">
            <div class="modal-body text-center p-0">
                <div class="position-relative d-inline-block">
                    <img id="modalImage" src="" class="img-fluid rounded-3 shadow-lg" alt="Preview" style="max-height: 300px;">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-2 bg-dark rounded-circle p-1" style="font-size: 10px;" data-bs-dismiss="modal"></button>
                </div>
                <h6 id="modalImageTitle" class="text-white mt-2 mb-0 fw-bold"></h6>
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

.article-img {
    transition: transform 0.2s ease;
    cursor: pointer;
}

.article-img:hover {
    transform: scale(1.05);
}

.table tbody tr:hover {
    background-color: rgba(16, 185, 129, 0.03);
}

.form-check-input:checked {
    background-color: #10b981;
    border-color: #10b981;
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.1rem rgba(16, 185, 129, 0.25);
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
    color: #10b981;
    padding: 0.25rem 0.5rem;
    font-size: 11px;
}

.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(135deg, #10b981, #059669);
    border-color: #10b981;
    color: white;
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
function filterTable() {
    let searchText = document.getElementById('searchInput')?.value.toLowerCase() || '';
    let status = document.getElementById('statusFilter')?.value || 'all';
    let sort = document.getElementById('sortFilter')?.value || 'newest';
    let rows = document.querySelectorAll('#articlesTable tbody tr.article-row');
    let visibleCount = 0;
    let visibleRows = [];
    
    // Filter rows
    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        let rowStatus = row.dataset.status || '';
        
        let matchesSearch = text.includes(searchText);
        let matchesStatus = status === 'all' || rowStatus === status;
        
        if (matchesSearch && matchesStatus) {
            row.style.display = '';
            visibleCount++;
            visibleRows.push(row);
        } else {
            row.style.display = 'none';
        }
    });
    
    // Sort rows
    if (sort === 'popular') {
        visibleRows.sort((a, b) => {
            let viewsA = parseInt(a.dataset.views) || 0;
            let viewsB = parseInt(b.dataset.views) || 0;
            return viewsB - viewsA;
        });
    } else if (sort === 'oldest') {
        visibleRows.sort((a, b) => {
            let dateA = new Date(a.dataset.date);
            let dateB = new Date(b.dataset.date);
            return dateA - dateB;
        });
    } else {
        visibleRows.sort((a, b) => {
            let dateA = new Date(a.dataset.date);
            let dateB = new Date(b.dataset.date);
            return dateB - dateA;
        });
    }
    
    // Reorder rows in DOM
    const tbody = document.querySelector('#articlesTable tbody');
    visibleRows.forEach(row => {
        tbody.appendChild(row);
    });
    
    // Update numbering
    visibleRows.forEach((row, index) => {
        const noCell = row.querySelector('td:first-child');
        if (noCell) {
            noCell.textContent = index + 1;
        }
    });
    
    document.getElementById('visibleCount').textContent = visibleCount;
}

// Event listeners
document.getElementById('searchInput')?.addEventListener('keyup', filterTable);
document.getElementById('statusFilter')?.addEventListener('change', filterTable);
document.getElementById('sortFilter')?.addEventListener('change', filterTable);
document.getElementById('resetFilters')?.addEventListener('click', function() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = 'all';
    document.getElementById('sortFilter').value = 'newest';
    filterTable();
});

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
            body: JSON.stringify({ is_published: checkbox.checked })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Status artikel berhasil diubah', 'success');
                let row = checkbox.closest('tr');
                if (row) {
                    row.dataset.status = checkbox.checked ? 'published' : 'draft';
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
    let publishedCount = document.querySelectorAll('.toggle-status:checked').length;
    let draftCount = totalCount - publishedCount;
    let totalViews = 0;
    
    document.querySelectorAll('.article-row').forEach(row => {
        let views = parseInt(row.dataset.views) || 0;
        totalViews += views;
    });
    
    let statCards = document.querySelectorAll('.stat-card .fw-bold');
    if (statCards.length >= 4) {
        statCards[0].textContent = totalCount;
        statCards[1].textContent = publishedCount;
        statCards[2].textContent = draftCount;
        statCards[3].textContent = totalViews.toLocaleString();
    }
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Artikel?',
        text: "Artikel akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#10b981',
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

function showImage(src, title) {
    document.getElementById('modalImage').src = src;
    document.getElementById('modalImageTitle').innerHTML = title;
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