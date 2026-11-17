{{-- resources/views/admin/bookings/show.blade.php --}}
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
                                <i class="bi bi-calendar-check me-2"></i>Detail Booking
                            </h2>
                            <p class="text-white-50 mb-0 small">Informasi lengkap booking pasien</p>
                        </div>
                        <div>
                            {!! $booking->status_badge !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Informasi Pasien -->
            <div class="card border-0 rounded-3 shadow-sm mb-4">
                <div class="card-header bg-white border-0 rounded-top-3 p-3">
                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-person-circle text-primary me-2"></i>Informasi Pasien
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">Nama Lengkap</small>
                                <div class="fw-bold">{{ $booking->patient_name }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">Nomor HP</small>
                                <div class="fw-bold">{{ $booking->phone }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">Email</small>
                                <div class="fw-bold">{{ $booking->email ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">Dibuat Pada</small>
                                <div class="fw-bold">{{ $booking->created_at->format('d F Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Informasi Booking -->
            <div class="card border-0 rounded-3 shadow-sm mb-4">
                <div class="card-header bg-white border-0 rounded-top-3 p-3">
                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-info-circle text-primary me-2"></i>Informasi Booking
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3">
                                <small class="text-muted d-block mb-1">Dokter</small>
                                <div class="fw-bold">{{ $booking->doctor->name ?? '-' }}</div>
                                <small class="text-muted">{{ $booking->doctor->specialization ?? '' }}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3">
                                <small class="text-muted d-block mb-1">Tanggal Booking</small>
                                <div class="fw-bold">{{ date('d F Y', strtotime($booking->booking_date)) }}</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="border rounded-3 p-3">
                                <small class="text-muted d-block mb-1">Keluhan</small>
                                <div class="fw-bold">{{ $booking->complaint }}</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="border rounded-3 p-3">
                                <small class="text-muted d-block mb-1">Catatan</small>
                                <div class="fw-bold">{{ $booking->notes ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Update Status -->
            <div class="card border-0 rounded-3 shadow-sm mb-4">
                <div class="card-header bg-white border-0 rounded-top-3 p-3">
                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-arrow-repeat text-primary me-2"></i>Update Status
                    </h6>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST" id="updateStatusForm">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Status Booking</label>
                            <select name="status" class="form-select rounded-pill" required>
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>✓ Confirmed</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>🏆 Completed</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>✗ Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Catatan (Opsional)</label>
                            <textarea name="notes" class="form-control rounded-3" rows="3" placeholder="Tambahkan catatan untuk pasien...">{{ old('notes', $booking->notes) }}</textarea>
                            <small class="text-muted">Catatan akan tersimpan dan terlihat di detail booking</small>
                        </div>
                        <button type="submit" class="btn btn-primary rounded-pill w-100">
                            <i class="bi bi-save me-2"></i>Update Status
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Aksi Cepat -->
            <div class="card border-0 rounded-3 shadow-sm">
                <div class="card-header bg-white border-0 rounded-top-3 p-3">
                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-lightning-charge text-primary me-2"></i>Aksi Cepat
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="d-grid gap-2">
                        @if($booking->phone)
                            @php
                                // Format nomor telepon untuk WhatsApp
                                $phoneNumber = preg_replace('/[^0-9]/', '', $booking->phone);
                                // Hapus 0 di depan jika ada, ganti dengan 62
                                if (substr($phoneNumber, 0, 1) == '0') {
                                    $phoneNumber = '62' . substr($phoneNumber, 1);
                                }
                                // Hapus + di depan jika ada
                                if (substr($phoneNumber, 0, 1) == '+') {
                                    $phoneNumber = substr($phoneNumber, 1);
                                }
                                
                                // Buat pesan berdasarkan status
                                $statusMessages = [
                                    'pending' => 'sedang dalam proses verifikasi oleh admin kami.',
                                    'confirmed' => 'telah dikonfirmasi. Silakan datang tepat waktu.',
                                    'completed' => 'telah selesai. Terima kasih telah menggunakan layanan kami.',
                                    'cancelled' => 'dibatalkan. Silakan hubungi admin untuk informasi lebih lanjut.'
                                ];
                                
                                $statusText = $statusMessages[$booking->status] ?? 'sedang diproses.';
                                $message = "Halo {$booking->patient_name},\n\n";
                                $message .= "Booking Anda dengan detail:\n";
                                $message .= "📅 Tanggal: " . date('d/m/Y', strtotime($booking->booking_date)) . "\n";
                                $message .= "👨‍⚕️ Dokter: {$booking->doctor->name}\n";
                                $message .= "📋 Status: " . strtoupper($booking->status) . "\n\n";
                                $message .= $statusText . "\n\n";
                                $message .= "Terima kasih 🙏";
                                
                                $encodedMessage = urlencode($message);
                            @endphp
                            
                            <button type="button" class="btn btn-success rounded-pill" onclick="sendWhatsApp('{{ $phoneNumber }}', '{{ $encodedMessage }}')">
                                <i class="bi bi-whatsapp me-2"></i>Hubungi via WhatsApp
                            </button>
                            
                            <!-- Tombol dengan pesan custom -->
                            <button type="button" class="btn btn-outline-success rounded-pill" data-bs-toggle="modal" data-bs-target="#customMessageModal">
                                <i class="bi bi-chat-dots me-2"></i>Kirim Pesan Custom
                            </button>
                        @endif
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary rounded-pill">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Custom Message -->
<div class="modal fade" id="customMessageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-chat-dots text-success me-2"></i>Kirim Pesan WhatsApp
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="customWhatsAppForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Tujuan</label>
                        <input type="text" class="form-control rounded-pill" id="waPhoneNumber" readonly value="{{ $booking->phone }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pesan</label>
                        <textarea class="form-control rounded-3" id="waMessage" rows="5" placeholder="Tulis pesan Anda..."></textarea>
                    </div>
                    <div class="alert alert-info small">
                        <i class="bi bi-info-circle me-2"></i>
                        Pastikan nomor WhatsApp aktif dan terdaftar.
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success rounded-pill" onclick="sendCustomMessage()">
                        <i class="bi bi-send me-2"></i>Kirim Pesan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.border {
    transition: all 0.2s ease;
}

.border:hover {
    border-color: #6366f1 !important;
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
}

.form-control:focus, .form-select:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
}

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}
</style>

<script>
// Fungsi untuk mengirim WhatsApp
function sendWhatsApp(phoneNumber, message) {
    // Buat URL WhatsApp
    const whatsappUrl = `https://wa.me/${phoneNumber}?text=${message}`;
    
    // Buka di tab baru
    window.open(whatsappUrl, '_blank');
}

function sendCustomMessage() {
    let phoneNumber = document.getElementById('waPhoneNumber').value;
    let message = document.getElementById('waMessage').value;
    
    if (!message.trim()) {
        Swal.fire({
            icon: 'warning',
            title: 'Pesan Kosong',
            text: 'Silakan tulis pesan terlebih dahulu',
            confirmButtonColor: '#6366f1'
        });
        return;
    }
    
    // Format nomor telepon
    let formattedNumber = phoneNumber.replace(/[^0-9]/g, '');
    if (formattedNumber.substring(0, 1) == '0') {
        formattedNumber = '62' + formattedNumber.substring(1);
    }
    if (formattedNumber.substring(0, 1) == '+') {
        formattedNumber = formattedNumber.substring(1);
    }
    
    // Encode message
    let encodedMessage = encodeURIComponent(message);
    
    // Buka WhatsApp
    const whatsappUrl = `https://wa.me/${formattedNumber}?text=${encodedMessage}`;
    window.open(whatsappUrl, '_blank');
    
    // Tutup modal
    bootstrap.Modal.getInstance(document.getElementById('customMessageModal')).hide();
    
    // Reset form
    document.getElementById('waMessage').value = '';
}

// Prefill message dengan template berdasarkan status
function prefillMessage() {
    const status = '{{ $booking->status }}';
    const patientName = '{{ $booking->patient_name }}';
    const doctorName = '{{ $booking->doctor->name }}';
    const bookingDate = '{{ date("d/m/Y", strtotime($booking->booking_date)) }}';
    
    let message = `Halo ${patientName},\n\n`;
    
    switch(status) {
        case 'pending':
            message += `Booking Anda dengan detail:\n`;
            message += `📅 Tanggal: ${bookingDate}\n`;
            message += `👨‍⚕️ Dokter: ${doctorName}\n`;
            message += `📋 Status: PENDING\n\n`;
            message += `Booking Anda sedang dalam proses verifikasi. Kami akan segera mengonfirmasi. Terima kasih 🙏`;
            break;
        case 'confirmed':
            message += `Booking Anda telah dikonfirmasi!\n\n`;
            message += `📅 Tanggal: ${bookingDate}\n`;
            message += `👨‍⚕️ Dokter: ${doctorName}\n\n`;
            message += `Mohon datang tepat waktu. Terima kasih 🙏`;
            break;
        case 'completed':
            message += `Terima kasih telah menggunakan layanan kami!\n\n`;
            message += `Semoga lekas sembuh. Jaga kesehatan selalu 🙏`;
            break;
        case 'cancelled':
            message += `Booking Anda dibatalkan.\n\n`;
            message += `Silakan hubungi admin untuk informasi lebih lanjut. Terima kasih 🙏`;
            break;
        default:
            message += `Booking Anda dengan detail:\n`;
            message += `📅 Tanggal: ${bookingDate}\n`;
            message += `👨‍⚕️ Dokter: ${doctorName}\n\n`;
            message += `Terima kasih 🙏`;
    }
    
    document.getElementById('waMessage').value = message;
}

// Event listener untuk modal
document.getElementById('customMessageModal').addEventListener('show.bs.modal', function() {
    prefillMessage();
});

document.getElementById('updateStatusForm')?.addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Menyimpan...';
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

@if($errors->any())
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ $errors->first() }}',
        confirmButtonColor: '#6366f1'
    });
@endif
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection