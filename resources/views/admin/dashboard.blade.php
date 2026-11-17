@extends('admin.layouts.admin')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Dashboard</h2>
    <p class="text-muted">Selamat datang kembali, {{ Auth::user()->name }}!</p>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Dokter</p>
                    <h2 class="fw-bold mb-0">{{ $totalDoctors ?? 0 }}</h2>
                </div>
                <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                    <i class="bi bi-person-badge fs-3 text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Layanan</p>
                    <h2 class="fw-bold mb-0">{{ $totalServices ?? 0 }}</h2>
                </div>
                <div class="bg-success bg-opacity-10 rounded-circle p-3">
                    <i class="bi bi-grid-3x3-gap-fill fs-3 text-success"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Booking</p>
                    <h2 class="fw-bold mb-0">{{ $totalBookings ?? 0 }}</h2>
                </div>
                <div class="bg-info bg-opacity-10 rounded-circle p-3">
                    <i class="bi bi-calendar-check fs-3 text-info"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Pending Booking</p>
                    <h2 class="fw-bold mb-0">{{ $pendingBookings ?? 0 }}</h2>
                </div>
                <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                    <i class="bi bi-clock-history fs-3 text-warning"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="stat-card">
            <h5 class="fw-bold mb-3">Grafik Booking per Bulan {{ date('Y') }}</h5>
            <canvas id="bookingChart" height="250"></canvas>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="stat-card">
            <h5 class="fw-bold mb-3">Status Booking</h5>
            <canvas id="statusChart" height="250"></canvas>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="stat-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Booking Terbaru</h5>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentBookings ?? [] as $booking)
                <tr>
                    <td class="fw-bold">{{ $booking->patient_name }}</td>
                    <td>{{ $booking->doctor->name ?? '-' }}</td>
                    <td>{{ date('d/m/Y', strtotime($booking->booking_date)) }}</td>
                    <td>
                        @php
                            $badgeClass = [
                                'pending' => 'bg-warning text-dark',
                                'confirmed' => 'bg-success',
                                'cancelled' => 'bg-danger',
                                'completed' => 'bg-info'
                            ][$booking->status] ?? 'bg-secondary';
                        @endphp
                        <span class="badge {{ $badgeClass }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">
                        <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                        <p class="text-muted mb-0">Belum ada booking</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Booking Chart
        const bookingCtx = document.getElementById('bookingChart')?.getContext('2d');
        if (bookingCtx) {
            const bookingData = {{ json_encode($bookingsPerMonth ?? array_fill(0, 12, 0)) }};
            new Chart(bookingCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Jumlah Booking',
                        data: bookingData,
                        borderColor: '#0891b2',
                        backgroundColor: 'rgba(8, 145, 178, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#0891b2',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }
        
        // Status Chart
        const statusCtx = document.getElementById('statusChart')?.getContext('2d');
        if (statusCtx) {
            const statusData = {{ json_encode($statusData ?? ['pending' => 0, 'confirmed' => 0, 'completed' => 0, 'cancelled' => 0]) }};
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Confirmed', 'Completed', 'Cancelled'],
                    datasets: [{
                        data: [
                            statusData.pending || 0,
                            statusData.confirmed || 0,
                            statusData.completed || 0,
                            statusData.cancelled || 0
                        ],
                        backgroundColor: ['#ffc107', '#28a745', '#17a2b8', '#dc3545'],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '60%'
                }
            });
        }
    });
</script>
@endsection