@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 rounded-4 overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h2 class="text-white fw-bold mb-2">
                                <i class="bi bi-eye me-3"></i>Detail Layanan
                            </h2>
                            <p class="text-white-50 mb-0">Lihat informasi lengkap layanan medis</p>
                        </div>
                        <div>
                            <a href="{{ route('admin.services.index') }}" class="btn btn-light rounded-pill px-4 py-2 me-2">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-warning rounded-pill px-4 py-2 text-white">
                                <i class="bi bi-pencil me-2"></i>Edit Layanan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Kiri - Informasi Utama -->
        <div class="col-lg-8">
            <div class="card border-0 rounded-4 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-circle bg-gradient-primary p-3 me-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width: 70px; height: 70px;">
                            <i class="bi bi-{{ $service->icon }} text-white fs-2 d-flex justify-content-center align-items-center h-100"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">{{ $service->name }}</h3>
                            <span class="badge {{ $service->is_active ? 'bg-success' : 'bg-danger' }} rounded-pill px-3 py-2">
                                <i class="bi {{ $service->is_active ? 'bi-check-circle' : 'bi-x-circle' }} me-1"></i>
                                {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-file-text me-2 text-primary"></i>Deskripsi Layanan
                            </h5>
                            <div class="text-muted" style="line-height: 1.8;">
                                {!! nl2br(e($service->description)) !!}
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-info-circle me-2 text-primary"></i>Informasi Lainnya
                            </h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted ps-0">ID Layanan</td>
                                    <td width="10%" class="text-muted">:</td>
                                    <td class="fw-bold ps-0">#{{ $service->id }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Nama Layanan</td>
                                    <td class="text-muted">:</td>
                                    <td class="fw-bold ps-0">{{ $service->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Icon</td>
                                    <td class="text-muted">:</td>
                                    <td class="ps-0">
                                        <code class="bg-light p-1 rounded">bi bi-{{ $service->icon }}</code>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Status</td>
                                    <td class="text-muted">:</td>
                                    <td class="ps-0">
                                        <span class="badge {{ $service->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Dibuat Pada</td>
                                    <td class="text-muted">:</td>
                                    <td class="ps-0">{{ $service->created_at->format('d F Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Terakhir Diupdate</td>
                                    <td class="text-muted">:</td>
                                    <td class="ps-0">{{ $service->updated_at->format('d F Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan - Gambar dan Aksi -->
        <div class="col-lg-4">
            <div class="card border-0 rounded-4 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-image me-2 text-primary"></i>Gambar Layanan
                    </h5>
                    
                    @if($service->image)
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $service->image) }}" 
                                 class="img-fluid rounded-3 shadow-sm mb-3" 
                                 alt="{{ $service->name }}"
                                 style="cursor: pointer; max-height: 300px; width: auto;"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal"
                                 onclick="showImage('{{ asset('storage/' . $service->image) }}')">
                            <div class="text-muted small">
                                <i class="bi bi-info-circle"></i> Klik gambar untuk memperbesar
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 150px; height: 150px;">
                                <i class="bi bi-image-slash text-muted fs-1"></i>
                            </div>
                            <p class="text-muted">Tidak ada gambar</p>
                        </div>
                    @endif
                </div>
            </div>

          
                    
                    <form id="delete-form-{{ $service->id }}" 
                          action="{{ route('admin.services.destroy', $service) }}" 
                          method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
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

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hover-shadow:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
}

.table-borderless td {
    padding: 0.5rem 0;
}

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

.form-check-input:checked {
    background-color: #198754;
    border-color: #198754;
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
}
</style>

<script>
function showImage(src) {
    const modalImage = document.getElementById('modalImage');
    modalImage.style.opacity = '0';
    modalImage.src = src;
    setTimeout(() => {
        modalImage.style.opacity = '1';
    }, 100);
}

// Toggle status dengan AJAX
document.querySelector('.toggle-status')?.addEventListener('change', function() {
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
            showNotification('Status berhasil diupdate', 'success');
            // Update badge status
            const statusBadge = document.querySelector('.badge:contains("Aktif"), .badge:contains("Nonaktif")');
            if (statusBadge) {
                if (checkbox.checked) {
                    statusBadge.className = 'badge bg-success rounded-pill px-3 py-2';
                    statusBadge.innerHTML = '<i class="bi bi-check-circle me-1"></i>Aktif';
                } else {
                    statusBadge.className = 'badge bg-danger rounded-pill px-3 py-2';
                    statusBadge.innerHTML = '<i class="bi bi-x-circle me-1"></i>Nonaktif';
                }
            }
        } else {
            checkbox.checked = !checkbox.checked;
            showNotification(data.message || 'Gagal mengupdate status', 'error');
        }
    })
    .catch(error => {
        checkbox.checked = !checkbox.checked;
        showNotification('Terjadi kesalahan pada server', 'error');
    })
    .finally(() => {
        checkbox.disabled = false;
    });
});

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

// Notifikasi
function showNotification(message, type) {
    const toast = document.createElement('div');
    toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} shadow-lg rounded-4`;
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
            <button type="button" class="btn-close" onclick="this.closest('.alert').remove()"></button>
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
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection