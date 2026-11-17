@extends('admin.layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Scan QR Code Pasien</h5>
                </div>
                <div class="card-body">
                    <div id="qr-reader" style="width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" id="booking-info" style="display: none;">
                <div class="card-header bg-success text-white">
                    <h5><i class="bi bi-check-circle"></i> Informasi Booking</h5>
                </div>
                <div class="card-body" id="booking-details">
                    <!-- Detail booking akan muncul di sini -->
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" onclick="confirmCheckin()">
                        <i class="bi bi-check-lg"></i> Konfirmasi Check-in
                    </button>
                    <button class="btn btn-danger" onclick="cancelBooking()">
                        <i class="bi bi-x-lg"></i> Batalkan Booking
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/html5-qrcode@2.3.8/minified/html5-qrcode.min.js"></script>
<script>
let currentBookingCode = null;
let currentBookingData = null;

function onScanSuccess(decodedText, decodedResult) {
    // Cek apakah decodedText adalah URL
    let bookingCode = decodedText;
    
    // Jika URL, extract kode booking dari URL
    if (decodedText.includes('/booking/detail/')) {
        const parts = decodedText.split('/booking/detail/');
        bookingCode = parts[parts.length - 1];
    }
    
    // Fetch data booking
    fetch(`/api/booking/${bookingCode}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                currentBookingCode = bookingCode;
                currentBookingData = data.booking;
                displayBookingInfo(data.booking);
                html5QrcodeScanner.stop();
            } else {
                alert('Booking tidak ditemukan!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengambil data booking');
        });
}

function displayBookingInfo(booking) {
    const html = `
        <p><strong>Kode Booking:</strong> ${booking.booking_code}</p>
        <p><strong>Pasien:</strong> ${booking.patient_name}</p>
        <p><strong>No. HP:</strong> ${booking.phone || '-'}</p>
        <p><strong>Dokter:</strong> ${booking.doctor.name}</p>
        <p><strong>Tanggal:</strong> ${new Date(booking.booking_date).toLocaleDateString('id-ID')}</p>
        <p><strong>Jam:</strong> ${booking.booking_time}</p>
        <p><strong>Keluhan:</strong> ${booking.complaint || '-'}</p>
        <p><strong>Status:</strong> 
            <span class="badge bg-${booking.status === 'confirmed' ? 'success' : 'warning'}">
                ${booking.status}
            </span>
        </p>
    `;
    
    document.getElementById('booking-details').innerHTML = html;
    document.getElementById('booking-info').style.display = 'block';
}

function confirmCheckin() {
    if (currentBookingCode) {
        fetch(`/api/booking/${currentBookingCode}/checkin`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Check-in berhasil!');
                location.reload();
            } else {
                alert('Gagal check-in: ' + data.message);
            }
        });
    }
}

function cancelBooking() {
    if (currentBookingCode && confirm('Yakin ingin membatalkan booking ini?')) {
        fetch(`/api/booking/${currentBookingCode}/cancel`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Booking dibatalkan!');
                location.reload();
            } else {
                alert('Gagal membatalkan: ' + data.message);
            }
        });
    }
}

const html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { 
    fps: 10, 
    qrbox: 250 
});
html5QrcodeScanner.render(onScanSuccess);
</script>
@endsection