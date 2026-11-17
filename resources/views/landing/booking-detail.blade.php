<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="theme-color" content="#0ea5e9">
    <title>Detail Booking - {{ $booking->booking_code }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            min-height: 100vh;
            padding: 20px;
            position: relative;
        }
        
        /* Background pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='40' fill='white' fill-opacity='0.05'/%3E%3C/svg%3E");
            background-size: 60px 60px;
            pointer-events: none;
        }
        
        .booking-card {
            max-width: 520px;
            margin: 0 auto;
            background: white;
            border-radius: 40px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Header */
        .booking-header {
            background: linear-gradient(135deg, #0ea5e9, #10b981);
            padding: 35px 25px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .booking-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        
        .qr-icon {
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            backdrop-filter: blur(10px);
            font-size: 2rem;
        }
        
        .booking-header h3 {
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            margin-top: 12px;
            backdrop-filter: blur(10px);
        }
        
        .status-confirmed {
            background: rgba(16, 185, 129, 0.9);
            color: white;
        }
        
        .status-pending {
            background: rgba(245, 158, 11, 0.9);
            color: white;
        }
        
        .status-cancelled {
            background: rgba(239, 68, 68, 0.9);
            color: white;
        }
        
        .status-checked_in {
            background: rgba(59, 130, 246, 0.9);
            color: white;
        }
        
        /* Body */
        .booking-body {
            padding: 30px;
        }
        
        /* Queue Number Card */
        .queue-card {
            background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
            border-radius: 24px;
            padding: 20px;
            text-align: center;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }
        
        .queue-card::after {
            content: '⏰';
            position: absolute;
            bottom: 10px;
            right: 15px;
            font-size: 3rem;
            opacity: 0.1;
        }
        
        .queue-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            opacity: 0.9;
            margin-bottom: 8px;
        }
        
        .queue-number {
            font-size: 3rem;
            font-weight: 800;
            font-family: monospace;
            letter-spacing: 4px;
            line-height: 1;
        }
        
        .queue-sub {
            font-size: 0.7rem;
            opacity: 0.9;
            margin-top: 8px;
        }
        
        /* Info Section */
        .info-section {
            margin-bottom: 25px;
            background: #f8fafc;
            border-radius: 20px;
            padding: 16px;
            transition: all 0.3s ease;
        }
        
        .info-section:hover {
            transform: translateX(5px);
            background: #f1f5f9;
        }
        
        .info-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #94a3b8;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .info-label i {
            font-size: 0.9rem;
            color: #0ea5e9;
        }
        
        .info-value {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin-left: 28px;
            word-break: break-word;
        }
        
        .info-value strong {
            color: #0ea5e9;
        }
        
        /* Doctor Chip */
        .doctor-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 8px 16px;
            border-radius: 50px;
            margin-top: 8px;
        }
        
        .doctor-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #0ea5e9, #10b981);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 12px;
            margin: 25px 0 20px;
        }
        
        .btn-custom {
            flex: 1;
            padding: 12px 16px;
            border-radius: 60px;
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #0ea5e9, #10b981);
            color: white;
            box-shadow: 0 4px 14px rgba(14, 165, 233, 0.3);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4);
        }
        
        .btn-outline-custom {
            background: white;
            border: 1.5px solid #e2e8f0;
            color: #475569;
        }
        
        .btn-outline-custom:hover {
            border-color: #0ea5e9;
            color: #0ea5e9;
            transform: translateY(-2px);
        }
        
        .btn-danger-custom {
            background: #fee2e2;
            color: #ef4444;
        }
        
        .btn-danger-custom:hover {
            background: #ef4444;
            color: white;
            transform: translateY(-2px);
        }
        
        /* Footer */
        .footer-note {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            padding: 15px 20px;
            text-align: center;
            font-size: 0.7rem;
            color: #92400e;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        /* Save to Home Screen */
        .install-prompt {
            background: #f1f5f9;
            margin: 15px 30px 20px;
            padding: 12px 16px;
            border-radius: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.7rem;
        }
        
        .install-prompt button {
            background: none;
            border: none;
            color: #0ea5e9;
            font-weight: 600;
        }
        
        /* Animations */
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite;
        }
        
        @media (max-width: 480px) {
            body {
                padding: 10px;
            }
            
            .booking-body {
                padding: 20px;
            }
            
            .action-buttons {
                flex-wrap: wrap;
            }
            
            .btn-custom {
                min-width: calc(50% - 6px);
            }
        }
        
        /* Print styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .action-buttons,
            .install-prompt,
            .footer-note {
                display: none;
            }
            
            .booking-card {
                box-shadow: none;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
    <div class="booking-card">
        <!-- Header -->
        <div class="booking-header">
            <div class="qr-icon">
                <i class="bi bi-qr-code-scan"></i>
            </div>
            <h3>Detail Booking</h3>
            <p style="font-size: 0.8rem; opacity: 0.9; margin: 0;">Simpan halaman ini untuk check-in</p>
            <div class="status-badge status-{{ strtolower($booking->status) }}">
                <i class="bi bi-{{ $booking->status == 'confirmed' ? 'check-circle-fill' : ($booking->status == 'pending' ? 'clock-fill' : ($booking->status == 'checked_in' ? 'check-lg' : 'x-circle-fill')) }}"></i>
                @if($booking->status == 'confirmed')
                    TERKONFIRMASI
                @elseif($booking->status == 'pending')
                    MENUNGGU
                @elseif($booking->status == 'checked_in')
                    SUDAH CHECK-IN
                @else
                    DIBATALKAN
                @endif
            </div>
        </div>
        
        <div class="booking-body">
            <!-- Kode Booking -->
            <div class="info-section">
                <div class="info-label">
                    <i class="bi bi-upc-scan"></i>
                    KODE BOOKING
                </div>
                <div class="info-value" style="font-family: 'Courier New', monospace; font-size: 1.1rem; letter-spacing: 2px; background: white; padding: 8px 12px; border-radius: 12px; display: inline-block;">
                    {{ $booking->booking_code }}
                </div>
                <button onclick="copyBookingCode()" style="background: none; border: none; color: #0ea5e9; font-size: 0.7rem; margin-left: 10px;">
                    <i class="bi bi-copy"></i> Salin
                </button>
            </div>
            
            <!-- Nomor Antrian -->
            @if($booking->queue_number)
            <div class="queue-card">
                <div class="queue-label">
                    <i class="bi bi-person-standing"></i> NOMOR ANTRIAN
                </div>
                <div class="queue-number">{{ $booking->queue_number }}</div>
                <div class="queue-sub">
                    <i class="bi bi-info-circle"></i> Harap menunggu panggilan
                </div>
            </div>
            @endif
            
            <!-- Data Pasien -->
            <div class="info-section">
                <div class="info-label">
                    <i class="bi bi-person-fill"></i>
                    DATA PASIEN
                </div>
                <div class="info-value">
                    <i class="bi bi-person-circle me-2"></i> <strong>{{ $booking->patient_name }}</strong>
                </div>
                @if($booking->phone)
                <div class="info-value mt-2" style="font-size: 0.85rem;">
                    <i class="bi bi-whatsapp me-2" style="color: #25D366;"></i> {{ $booking->phone }}
                </div>
                @endif
                @if($booking->email)
                <div class="info-value mt-1" style="font-size: 0.85rem;">
                    <i class="bi bi-envelope me-2"></i> {{ $booking->email }}
                </div>
                @endif
            </div>
            
            <!-- Dokter & Jadwal -->
            <div class="info-section">
                <div class="info-label">
                    <i class="bi bi-hospital-fill"></i>
                    DOKTER & JADWAL
                </div>
                <div class="info-value">
                    <div class="doctor-chip">
                        <div class="doctor-avatar">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <div>
                            <strong>{{ $booking->doctor->name }}</strong><br>
                            <small style="font-size: 0.7rem; color: #0ea5e9;">{{ $booking->doctor->specialization }}</small>
                        </div>
                    </div>
                </div>
                <div class="info-value mt-2">
                    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                        <span><i class="bi bi-calendar3" style="color: #0ea5e9;"></i> {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}</span>
                        <span><i class="bi bi-clock" style="color: #10b981;"></i> {{ date('H:i', strtotime($booking->booking_time)) }} WIB</span>
                    </div>
                </div>
            </div>
            
            <!-- Keluhan -->
            @if($booking->complaint)
            <div class="info-section">
                <div class="info-label">
                    <i class="bi bi-chat-dots-fill"></i>
                    KELUHAN
                </div>
                <div class="info-value">
                    <span style="background: white; padding: 8px 12px; border-radius: 16px; display: inline-block;">
                        {{ $booking->complaint }}
                    </span>
                </div>
            </div>
            @endif
            
            <!-- Lokasi Klinik -->
            @if($clinic)
            <div class="info-section">
                <div class="info-label">
                    <i class="bi bi-building"></i>
                    LOKASI KLINIK
                </div>
                <div class="info-value">
                    <strong>{{ $clinic->name ?? 'Klinik Medis' }}</strong>
                </div>
                <div class="info-value mt-2" style="font-size: 0.85rem;">
                    <i class="bi bi-geo-alt-fill" style="color: #ef4444;"></i> {{ $clinic->address ?? 'Jl. Kesehatan No. 123, Jakarta' }}
                </div>
                @if($clinic->phone)
                <div class="info-value mt-1" style="font-size: 0.85rem;">
                    <i class="bi bi-telephone-fill"></i> {{ $clinic->phone }}
                </div>
                @endif
            </div>
            @endif
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="https://maps.google.com/?q={{ urlencode($clinic->address ?? 'Klinik Medis Jakarta') }}" 
                   target="_blank" 
                   class="btn-custom btn-outline-custom">
                    <i class="bi bi-map"></i> Maps
                </a>
                <a href="tel:{{ $clinic->phone ?? '081234567890' }}" 
                   class="btn-custom btn-outline-custom">
                    <i class="bi bi-telephone-fill"></i> Call
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $clinic->whatsapp_number ?? $clinic->phone ?? '081234567890') }}?text=Halo%2C%20saya%20{{ urlencode($booking->patient_name) }}%20dengan%20kode%20booking%20{{ $booking->booking_code }}%20ingin%20bertanya" 
                   target="_blank" 
                   class="btn-custom btn-outline-custom">
                    <i class="bi bi-whatsapp"></i> WA
                </button>
            </div>
            
            @if($booking->status == 'confirmed')
            <div class="action-buttons">
                <button onclick="addToCalendar()" class="btn-custom btn-primary-custom">
                    <i class="bi bi-calendar-plus-fill"></i> Tambah ke Kalender
                </button>
                <button onclick="shareBooking()" class="btn-custom btn-primary-custom">
                    <i class="bi bi-share-fill"></i> Bagikan
                </button>
            </div>
            @endif
            
            <!-- Tombol Batal (jika perlu) -->
            @if($booking->status == 'confirmed')
            <div class="action-buttons">
                <button onclick="cancelBooking('{{ $booking->booking_code }}')" class="btn-custom btn-danger-custom">
                    <i class="bi bi-x-circle-fill"></i> Batalkan Booking
                </button>
            </div>
            @endif
        </div>
        
        <!-- Install to Home Screen Prompt -->
        <div class="install-prompt" id="installPrompt" style="display: none;">
            <span><i class="bi bi-download"></i> Simpan ke layar utama</span>
            <button onclick="installToHomeScreen()"><i class="bi bi-plus-lg"></i> Install</button>
        </div>
        
        <div class="footer-note">
            <i class="bi bi-info-circle-fill"></i>
            <span>Harap tunjukkan halaman ini atau screenshot saat check-in</span>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Copy kode booking
        function copyBookingCode() {
            const code = '{{ $booking->booking_code }}';
            navigator.clipboard.writeText(code).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Kode booking telah disalin',
                    timer: 1500,
                    showConfirmButton: false,
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-4'
                    }
                });
            });
        }
        
        // Tambah ke kalender
        function addToCalendar() {
            const startDateTime = '{{ $booking->booking_date }} {{ $booking->booking_time }}';
            const startTime = new Date(startDateTime);
            const endTime = new Date(startTime.getTime() + 60*60*1000);
            
            const formatDate = (date) => {
                return date.toISOString().replace(/-|:|\./g, '');
            };
            
            const calendarUrl = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=Booking%20Dokter%20-%20{{ urlencode($booking->doctor->name) }}&dates=${formatDate(startTime)}/${formatDate(endTime)}&details=Pasien:%20{{ urlencode($booking->patient_name) }}%0AKeluhan:%20{{ urlencode($booking->complaint) }}%0AKode%20Booking:%20{{ $booking->booking_code }}%0A%0AHarap%20datang%2015%20menit%20sebelum%20jadwal.&location={{ urlencode($clinic->address ?? 'Klinik Medis Jakarta') }}&sf=true&output=xml`;
            
            window.open(calendarUrl, '_blank');
            
            Swal.fire({
                icon: 'info',
                title: 'Buka Google Calendar?',
                text: 'Anda akan diarahkan ke Google Calendar',
                confirmButtonText: 'Lanjutkan',
                confirmButtonColor: '#0ea5e9',
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open(calendarUrl, '_blank');
                }
            });
        }
        
        // Share booking
        function shareBooking() {
            const shareData = {
                title: 'Booking Klinik - {{ $booking->doctor->name }}',
                text: `Halo, saya ${bookingData.patient_name} melakukan booking dengan detail:\nKode: {{ $booking->booking_code }}\nDokter: {{ $booking->doctor->name }}\nTanggal: {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}\nJam: {{ date('H:i', strtotime($booking->booking_time)) }} WIB`,
                url: window.location.href
            };
            
            if (navigator.share) {
                navigator.share(shareData).catch(() => {});
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Bagikan',
                    html: `<p>Salin link ini untuk dibagikan:</p>
                           <input type="text" value="${window.location.href}" class="form-control" id="shareLink" readonly>
                           <button class="btn btn-primary mt-2" onclick="copyShareLink()">Salin Link</button>`,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'rounded-4'
                    }
                });
            }
        }
        
        function copyShareLink() {
            const linkInput = document.getElementById('shareLink');
            if (linkInput) {
                linkInput.select();
                document.execCommand('copy');
                Swal.fire({
                    icon: 'success',
                    title: 'Tersalin!',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }
        
        // Batalkan booking
        function cancelBooking(bookingCode) {
            Swal.fire({
                title: 'Batalkan Booking?',
                text: 'Apakah Anda yakin ingin membatalkan booking ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Batalkan',
                cancelButtonText: 'Tidak, Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/api/booking/${bookingCode}/cancel`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Booking Dibatalkan',
                                text: 'Booking Anda telah berhasil dibatalkan',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message || 'Gagal membatalkan booking'
                            });
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan, silakan coba lagi'
                        });
                    });
                }
            });
        }
        
        // Install to Home Screen (PWA)
        let deferredPrompt;
        
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            document.getElementById('installPrompt').style.display = 'flex';
        });
        
        function installToHomeScreen() {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === 'accepted') {
                        console.log('User accepted the install prompt');
                    }
                    deferredPrompt = null;
                    document.getElementById('installPrompt').style.display = 'none';
                });
            }
        }
        
        // Simpan ke localStorage untuk riwayat
        const bookingCode = '{{ $booking->booking_code }}';
        const viewedBookings = JSON.parse(localStorage.getItem('viewedBookings') || '[]');
        if (!viewedBookings.includes(bookingCode)) {
            viewedBookings.unshift(bookingCode);
            if (viewedBookings.length > 10) viewedBookings.pop();
            localStorage.setItem('viewedBookings', JSON.stringify(viewedBookings));
        }
        
        // Efek loading selesai
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.booking-card').style.animation = 'slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
        });
        
        // Tampilkan waktu sekarang
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            const timeElement = document.querySelector('.queue-sub');
            if (timeElement && !timeElement.innerHTML.includes('WIB')) {
                // Optional: update waktu realtime
            }
        }
        setInterval(updateTime, 1000);
    </script>
</body>
</html>