{{-- resources/views/landing/index.blade.php --}}
@extends('layouts.landing')

@section('content')
<!-- Hero Section dengan Particle Background -->
<section id="home" class="hero-section min-vh-100 d-flex align-items-center position-relative overflow-hidden">
    <canvas id="particle-canvas" class="position-absolute top-0 start-0 w-100 h-100" style="z-index: 0;"></canvas>
    <div id="mouse-trail" class="mouse-trail"></div>
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                <div class="hero-badge mb-3 d-inline-block">
                    <i class="bi bi-shield-check me-1"></i> Klinik Terpercaya
                </div>
                <h1 class="display-3 fw-bold mb-4">
                    <span class="text-gradient"></span><br>
                    <div class="typing-wrapper">
                        <span id="typing-text" class="text-primary"></span>
                        <span class="cursor-blink"></span>
                    </div>
                </h1>
                <p class="lead text-muted mb-4 typing-paragraph" style="opacity: 0;">
                    {{ $clinic->description ?? 'Klinik kesehatan dengan pelayanan terbaik dan tenaga medis profesional siap membantu Anda 24/7.' }}
                </p>
                <div class="d-flex flex-wrap gap-3 fade-in-buttons" style="opacity: 0;">
                    <a href="#booking" class="btn btn-primary-custom px-5 py-3 rounded-pill">
                        <i class="bi bi-calendar-check me-2"></i>Booking Sekarang
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <a href="#services" class="btn btn-outline-custom px-5 py-3 rounded-pill">
                        <i class="bi bi-play-circle me-2"></i>Lihat Layanan
                    </a>
                </div>
                <div class="row mt-5 g-3 fade-in-stats" style="opacity: 0;">
                    <div class="col-4">
                        <div class="stat-mini-card">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-primary-soft me-3">
                                    <i class="bi bi-person-check-fill text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0 counter" data-target="50">0</h4>
                                    <small class="text-muted">Dokter Spesialis</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-mini-card">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-primary-soft me-3">
                                    <i class="bi bi-people-fill text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0 counter" data-target="15000">0</h4>
                                    <small class="text-muted">Pasien Puas</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-mini-card">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-primary-soft me-3">
                                    <i class="bi bi-star-fill text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0 counter" data-target="99">0</h4>
                                    <small class="text-muted">Kepuasan Pasien</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="hero-image-wrapper position-relative">
                    <div class="floating-shape shape-1"></div>
                    <div class="floating-shape shape-2"></div>
                    <div class="floating-shape shape-3"></div>
                    <div class="hero-image-container">
                        @php
                            $heroImageUrl = $clinic->logo ?? null;
                            if (!$heroImageUrl) {
                                $heroImageUrl = 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=500&h=400&fit=crop';
                            } else {
                                $heroImageUrl = asset('storage/' . $clinic->logo);
                            }
                        @endphp
                        <img src="{{ $heroImageUrl }}" 
                             alt="Hero Image" 
                             class="hero-main-image"
                             onerror="this.src='https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=500&h=400&fit=crop'">
                        <div class="floating-card bg-white rounded-3 shadow p-2 p-md-3 position-absolute">
                            <i class="bi bi-heart-fill text-danger me-1 me-md-2"></i>
                            <span class="small">+1000 Pasien Puas</span>
                        </div>
                        <div class="floating-card2 bg-white rounded-3 shadow p-2 p-md-3 position-absolute">
                            <i class="bi bi-star-fill text-warning me-1 me-md-2"></i>
                            <span class="small">Rating 4.9/5.0</span>
                        </div>
                        <div class="floating-card3 bg-white rounded-3 shadow p-2 p-md-3 position-absolute">
                            <i class="bi bi-clock-fill text-primary me-1 me-md-2"></i>
                            <span class="small">24/7 Emergency</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-wave-bottom">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

<!-- About Section dengan Visi & Misi -->
<section id="about" class="py-5 position-relative">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
            <span class="section-badge">Tentang Kami</span>
            <h2 class="section-title">Mengapa Memilih <span class="text-gradient">Klinik Kami?</span></h2>
            <div class="title-underline mx-auto"></div>
            <p class="lead text-muted mt-3">Kami berkomitmen memberikan pelayanan kesehatan terbaik untuk Anda dan keluarga</p>
        </div>
        <div class="row g-5">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="800" data-aos-delay="100">
                <div class="about-image position-relative">
                    <div class="about-image-container">
                        @php
                            $aboutImageUrl = $clinic->logo ?? null;
                            if (!$aboutImageUrl) {
                                $aboutImageUrl = 'https://images.unsplash.com/photo-1587351021759-3e566b6af7cc?w=500&h=400&fit=crop';
                            } else {
                                $aboutImageUrl = asset('storage/' . $clinic->logo);
                            }
                        @endphp
                        <img src="{{ $aboutImageUrl }}" 
                             class="about-main-image" 
                             alt="About Us"
                             onerror="this.src='https://images.unsplash.com/photo-1587351021759-3e566b6af7cc?w=500&h=400&fit=crop'">
                    </div>
                    <div class="experience-badge">
                        <span class="display-5 fw-bold">10+</span>
                        <span>Tahun Pengalaman</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                <div class="about-content">
                    <h3 class="fw-bold mb-4">{{ $clinic->name ?? 'Klinik Kesehatan Modern dengan Teknologi Terbaru' }}</h3>
                    <p class="text-muted mb-4">{{ $clinic->description ?? 'Kami menyediakan layanan kesehatan komprehensif dengan didukung tenaga medis profesional dan peralatan medis modern.' }}</p>
                    
                    @if($clinic->vision || $clinic->mission)
                    <div class="vision-mission-box bg-light p-4 rounded-4 mb-4">
                        @if($clinic->vision)
                        <div class="vision mb-4">
                            <h5 class="fw-bold text-primary mb-2">
                                <i class="bi bi-eye-fill me-2"></i>Visi
                            </h5>
                            <p class="text-muted mb-0">{{ $clinic->vision }}</p>
                        </div>
                        @endif
                        
                        @if($clinic->mission)
                        <div class="mission">
                            <h5 class="fw-bold text-primary mb-2">
                                <i class="bi bi-bullseye me-2"></i>Misi
                            </h5>
                            <p class="text-muted mb-0">{{ $clinic->mission }}</p>
                        </div>
                        @endif
                    </div>
                    @endif
                    
                    <div class="feature-list">
                        <div class="feature-item d-flex align-items-start mb-4">
                            <div class="feature-icon">
                                <i class="bi bi-check2-circle text-primary fs-4"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-bold mb-1">Dokter Berpengalaman</h6>
                                <p class="text-muted small mb-0">Tim dokter spesialis dengan pengalaman lebih dari 10 tahun</p>
                            </div>
                        </div>
                        <div class="feature-item d-flex align-items-start mb-4">
                            <div class="feature-icon">
                                <i class="bi bi-check2-circle text-primary fs-4"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-bold mb-1">Fasilitas Modern</h6>
                                <p class="text-muted small mb-0">Peralatan medis terkini untuk diagnosis akurat</p>
                            </div>
                        </div>
                        <div class="feature-item d-flex align-items-start mb-4">
                            <div class="feature-icon">
                                <i class="bi bi-check2-circle text-primary fs-4"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-bold mb-1">Layanan 24/7</h6>
                                <p class="text-muted small mb-0">Pelayanan darurat siap membantu kapan saja</p>
                            </div>
                        </div>
                        <div class="feature-item d-flex align-items-start">
                            <div class="feature-icon">
                                <i class="bi bi-check2-circle text-primary fs-4"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-bold mb-1">Harga Terjangkau</h6>
                                <p class="text-muted small mb-0">Biaya medis yang kompetitif dengan kualitas terbaik</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
            <span class="section-badge">Layanan Kami</span>
            <h2 class="section-title">Layanan <span class="text-gradient">Medis Terbaik</span></h2>
            <div class="title-underline mx-auto"></div>
            <p class="lead text-muted mt-3">Kami menyediakan berbagai layanan kesehatan terbaik untuk Anda</p>
        </div>
        <div class="row g-4">
            @forelse($services as $service)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="service-card-modern bg-white p-4 shadow-sm rounded-4 text-center">
                    <div class="service-icon-modern mb-4 mx-auto">
                        <i class="bi bi-{{ $service->icon ?? 'heart-pulse' }} fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-3">{{ $service->name }}</h5>
                    <p class="text-muted">{{ Str::limit($service->description, 100) }}</p>
                    <a href="#" class="btn-link-custom">Selengkapnya <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada data layanan</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Doctors Section -->
<section id="doctors" class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
            <span class="section-badge">Tim Medis</span>
            <h2 class="section-title">Dokter <span class="text-gradient">Profesional</span></h2>
            <div class="title-underline mx-auto"></div>
            <p class="lead text-muted mt-3">Tenaga medis profesional siap melayani Anda</p>
        </div>
        <div class="row g-4">
            @forelse($doctors as $doctor)
            <div class="col-lg-3 col-md-6" data-aos="flip-left" data-aos-duration="800" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="doctor-card-modern bg-white text-center rounded-4 overflow-hidden">
                    <div class="doctor-img-wrapper position-relative">
                        <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://ui-avatars.com/api/?background=0ea5e9&color=fff&name=' . urlencode($doctor->name) }}" 
                             class="w-100" style="height: 280px; object-fit: cover;">
                        <div class="doctor-overlay">
                            <div class="doctor-social-icons">
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                                <a href="#"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h5 class="fw-bold mb-1">{{ $doctor->name }}</h5>
                        <p class="text-primary mb-2">{{ $doctor->specialization }}</p>
                        <div class="doctor-rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-half text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada data dokter</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Schedule Section -->
<section id="schedule" class="py-5 bg-gradient-schedule">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
            <span class="section-badge bg-white text-primary">Jadwal Praktik</span>
            <h2 class="section-title text-white">Jadwal <span class="text-white">Praktik Dokter</span></h2>
            <div class="title-underline bg-white mx-auto"></div>
            <p class="lead text-white-50 mt-3">Informasi jadwal praktik dokter spesialis kami</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="100">
                <div class="schedule-timeline">
                    @forelse($doctors as $doctor)
                        @foreach($doctor->schedules as $schedule)
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="timeline-content bg-white rounded-4 p-4 shadow-sm">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <h5 class="fw-bold mb-1">{{ $doctor->name }}</h5>
                                        <p class="text-primary small mb-0">{{ $doctor->specialization }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="schedule-day">
                                            <i class="bi bi-calendar-week me-2"></i>{{ $schedule->day }}
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="schedule-time">
                                            <i class="bi bi-clock me-2"></i>
                                            {{ date('H:i', strtotime($schedule->start_time)) }} - {{ date('H:i', strtotime($schedule->end_time)) }}
                                        </span>
                                        <span class="schedule-status available">
                                            <i class="bi bi-check-circle"></i> Tersedia
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @empty
                        <div class="text-center py-5">
                            <p class="text-white">Belum ada data jadwal</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Articles Section dengan Search -->
<section id="articles" class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
            <span class="section-badge">Artikel Terbaru</span>
            <h2 class="section-title">Artikel <span class="text-gradient">Kesehatan</span></h2>
            <div class="title-underline mx-auto"></div>
            <p class="lead text-muted mt-3">Informasi kesehatan terkini untuk Anda</p>
        </div>
        
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="search-container">
                    <div class="input-group shadow-sm rounded-pill overflow-hidden">
                        <span class="input-group-text bg-white border-0 ps-4">
                            <i class="bi bi-search text-primary"></i>
                        </span>
                        <input type="text" 
                               id="searchInput" 
                               class="form-control border-0 py-3" 
                               placeholder="Cari artikel kesehatan..."
                               autocomplete="off">
                        <button class="btn btn-primary-custom rounded-0 px-4" type="button" id="searchBtn">
                            <i class="bi bi-search me-2"></i>Cari
                        </button>
                    </div>
                    <div id="searchResults" class="search-results-dropdown mt-2" style="display: none;"></div>
                </div>
            </div>
        </div>
        
        <div class="row g-4" id="articlesGrid">
            @forelse($articles as $article)
            <div class="col-lg-4 col-md-6 article-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="article-card-modern bg-white rounded-4 overflow-hidden shadow-sm">
                    <div class="article-img-wrapper position-relative">
                        <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://placehold.co/600x400/0ea5e9/white?text=' . urlencode($article->title) }}" 
                             class="w-100" style="height: 240px; object-fit: cover;">
                        <div class="article-category">
                            <i class="bi bi-newspaper me-1"></i> Kesehatan
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="article-meta mb-2">
                            <span><i class="bi bi-calendar3 me-1"></i> {{ $article->created_at->format('d M Y') }}</span>
                            <span class="ms-3"><i class="bi bi-clock me-1"></i> 5 min read</span>
                        </div>
                        <h5 class="fw-bold mb-2">{{ Str::limit($article->title, 60) }}</h5>
                        <p class="text-muted small">{{ Str::limit($article->summary ?? strip_tags($article->content), 100) }}</p>
                        <a href="{{ route('article.show', $article->slug) }}" class="btn-link-custom">
                            Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada artikel</p>
            </div>
            @endforelse
        </div>
        
        <div id="noResults" class="text-center py-5" style="display: none;">
            <i class="bi bi-search fs-1 text-muted mb-3 d-block"></i>
            <h5 class="text-muted">Tidak ada artikel ditemukan</h5>
            <p class="text-muted">Coba dengan kata kunci yang berbeda</p>
        </div>
    </div>
</section>

<!-- Booking Section dengan Form Modern - UPDATE -->
<section id="booking" class="py-5 position-relative">
    <div class="booking-bg-pattern"></div>
    <div class="container position-relative">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
            <span class="section-badge">Booking Online</span>
            <h2 class="section-title">Mudah & <span class="text-gradient">Cepat</span></h2>
            <div class="title-underline mx-auto"></div>
            <p class="lead text-muted mt-3">Isi formulir berikut untuk melakukan booking</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                <div class="booking-card-modern border-0 rounded-4 overflow-hidden shadow-lg">
                    <div class="booking-header-modern p-4">
                        <h4 class="mb-0 text-white"><i class="bi bi-calendar-plus me-2"></i> Formulir Booking Pasien</h4>
                        <p class="text-white-50 mb-0 small">Isi data dengan benar untuk memudahkan proses pendaftaran</p>
                    </div>
                    <div class="p-5">
                        <form action="{{ route('booking.submit') }}" method="POST" id="bookingForm">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-person-fill text-primary me-2"></i>Nama Lengkap
                                    </label>
                                    <input type="text" name="patient_name" class="form-control form-control-lg @error('patient_name') is-invalid @enderror" 
                                           value="{{ old('patient_name') }}" placeholder="Masukkan nama lengkap" required>
                                    @error('patient_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-phone-fill text-primary me-2"></i>Nomor HP
                                    </label>
                                    <input type="tel" name="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" 
                                           value="{{ old('phone') }}" placeholder="Contoh: 081234567890" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-envelope-fill text-primary me-2"></i>Email (Opsional)
                                    </label>
                                    <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                           value="{{ old('email') }}" placeholder="email@example.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-person-badge-fill text-primary me-2"></i>Pilih Dokter
                                    </label>
                                    <select name="doctor_id" id="doctor_id" class="form-select form-select-lg @error('doctor_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Dokter --</option>
                                        @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->name }} - {{ $doctor->specialization }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('doctor_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-calendar-fill text-primary me-2"></i>Tanggal Booking
                                    </label>
                                    <select name="booking_date" id="booking_date" 
                                            class="form-select form-select-lg @error('booking_date') is-invalid @enderror" 
                                            required disabled>
                                        <option value="">-- Pilih Dokter Terlebih Dahulu --</option>
                                    </select>
                                    @error('booking_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-clock-fill text-primary me-2"></i>Jam Booking
                                    </label>
                                    <select name="booking_time" id="booking_time" class="form-select form-select-lg" required disabled>
                                        <option value="">Pilih jam tersedia</option>
                                    </select>
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-chat-dots-fill text-primary me-2"></i>Keluhan
                                    </label>
                                    <textarea name="complaint" class="form-control form-control-lg @error('complaint') is-invalid @enderror" 
                                              rows="3" placeholder="Jelaskan keluhan Anda" required>{{ old('complaint') }}</textarea>
                                    @error('complaint')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <div id="scheduleInfo" class="alert d-none rounded-4">
                                        <i class="bi bi-info-circle"></i> <span id="scheduleMessage"></span>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary-custom w-100 py-3 rounded-pill fw-bold fs-5" id="submitBookingBtn">
                                        <i class="bi bi-calendar-check me-2"></i>Booking Sekarang
                                        <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
            <span class="section-badge">Hubungi Kami</span>
            <h2 class="section-title">Kontak & <span class="text-gradient">Lokasi</span></h2>
            <div class="title-underline mx-auto"></div>
            <p class="lead text-muted mt-3">Hubungi kami atau kunjungi klinik kami</p>
        </div>
        <div class="row g-5">
            <div class="col-lg-5" data-aos="fade-right" data-aos-duration="800" data-aos-delay="100">
                <div class="contact-card bg-white p-4 rounded-4 shadow-sm">
                    <h4 class="fw-bold mb-4"><i class="bi bi-info-circle-fill text-primary me-2"></i>Informasi Kontak</h4>
                    <div class="contact-item d-flex mb-4">
                        <div class="contact-icon-modern bg-primary-soft rounded-circle me-3">
                            <i class="bi bi-geo-alt-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Alamat</h6>
                            <p class="text-muted mb-0">{{ $clinic->address ?? 'Jl. Kesehatan No. 123, Jakarta' }}</p>
                        </div>
                    </div>
                    <div class="contact-item d-flex mb-4">
                        <div class="contact-icon-modern bg-primary-soft rounded-circle me-3">
                            <i class="bi bi-telephone-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Telepon</h6>
                            <p class="text-muted mb-0">{{ $clinic->phone ?? '(021) 1234-5678' }}</p>
                        </div>
                    </div>
                    <div class="contact-item d-flex mb-4">
                        <div class="contact-icon-modern bg-primary-soft rounded-circle me-3">
                            <i class="bi bi-envelope-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Email</h6>
                            <p class="text-muted mb-0">{{ $clinic->email ?? 'info@kliniksehat.com' }}</p>
                        </div>
                    </div>
                    <div class="contact-item d-flex">
                        <div class="contact-icon-modern bg-primary-soft rounded-circle me-3">
                            <i class="bi bi-whatsapp text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">WhatsApp</h6>
                            <p class="text-muted mb-0">{{ $clinic->whatsapp_number ?? '0812-3456-7890' }}</p>
                        </div>
                    </div>
                    
                    @if($clinic->operational_start && $clinic->operational_end)
                    <hr class="my-4">
                    <div class="contact-item d-flex">
                        <div class="contact-icon-modern bg-primary-soft rounded-circle me-3">
                            <i class="bi bi-clock-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Jam Operasional</h6>
                            <p class="text-muted mb-0">{{ $clinic->operational_start }} - {{ $clinic->operational_end }}</p>
                        </div>
                    </div>
                    @endif
                    
                    <hr class="my-4">
                    <div class="social-media-links">
                        <h6 class="fw-bold mb-3">Ikuti Kami</h6>
                        <div class="d-flex gap-3">
                            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                <div class="map-card rounded-4 overflow-hidden shadow-sm">
                    <div class="map-wrapper" style="height: 400px; width: 100%; background: #e2e8f0;">
                        @php
                            $mapUrl = $clinic->map_embed_url ?? '';
                            if (!empty($mapUrl) && !str_contains($mapUrl, '<iframe')) {
                                if (str_contains($mapUrl, 'google.com/maps/embed')) {
                                    $mapUrl = '<iframe src="' . $mapUrl . '" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
                                }
                                elseif (str_contains($mapUrl, 'google.com/maps')) {
                                    preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $mapUrl, $matches);
                                    if (isset($matches[1]) && isset($matches[2])) {
                                        $embedUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966!2d{$matches[2]}!3d{$matches[1]}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z{$matches[1]},{$matches[2]}!5e0!3m2!1sen!2sid!4v1";
                                        $mapUrl = '<iframe src="' . $embedUrl . '" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
                                    }
                                }
                            }
                        @endphp
                        
                        @if(!empty($mapUrl))
                            {!! $mapUrl !!}
                        @else
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted">
                                <i class="bi bi-map fs-1 mb-3"></i>
                                <p>Belum ada peta yang diatur.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* ========== ALL STYLES ========== */
.text-gradient {
    background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.section-badge {
    display: inline-block;
    background: linear-gradient(135deg, #e0f2fe 0%, #d1fae5 100%);
    color: #0ea5e9;
    padding: 6px 20px;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.hero-badge {
    background: rgba(14, 165, 233, 0.1);
    backdrop-filter: blur(10px);
    padding: 8px 20px;
    border-radius: 50px;
    color: #0ea5e9;
    font-weight: 600;
    opacity: 0;
    animation: fadeInDown 0.8s ease forwards;
}

.hero-wave-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1;
}

.typing-wrapper {
    display: inline-block;
    position: relative;
}

#typing-text {
    display: inline-block;
    position: relative;
    background: linear-gradient(135deg, #0ea5e9, #10b981);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.cursor-blink {
    display: inline-block;
    width: 3px;
    height: 1.2em;
    background: linear-gradient(135deg, #0ea5e9, #10b981);
    margin-left: 5px;
    animation: blink 0.8s infinite;
    vertical-align: middle;
}

@keyframes blink {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0; }
}

.typing-paragraph {
    animation: fadeInUp 0.6s ease 2.5s forwards;
}
.fade-in-buttons { animation: fadeInUp 0.6s ease 2.8s forwards; }
.fade-in-stats { animation: fadeInUp 0.6s ease 3.1s forwards; }

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Hero Image */
.hero-image-wrapper {
    position: relative;
    padding: 10px;
    opacity: 0;
    animation: fadeInRight 0.8s ease 0.5s forwards;
}
@keyframes fadeInRight {
    from { opacity: 0; transform: translateX(30px); }
    to { opacity: 1; transform: translateX(0); }
}

.hero-image-container {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    width: 100%;
    max-width: 670px;
    margin: 0;
    margin-left: auto;
    margin-right: 0;
}

.hero-main-image {
    width: 100%;
    height: auto;
    aspect-ratio: 4/3;
    object-fit: cover;
    transition: transform 0.5s ease;
    display: block;
}
.hero-main-image:hover { transform: scale(1.02); }

/* About Image */
.about-image {
    position: relative;
    padding: 10px;
}
.about-image-container {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    width: 100%;
    max-width: 420px;
    margin: 0 auto;
}
.about-main-image {
    width: 100%;
    height: auto;
    aspect-ratio: 4/3;
    object-fit: cover;
    transition: transform 0.5s ease;
    display: block;
}
.about-main-image:hover { transform: scale(1.02); }

/* Floating Cards */
.floating-card {
    position: absolute;
    top: 5%;
    left: -5px;
    background: white;
    padding: 6px 14px;
    border-radius: 40px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    animation: float-card 4s ease-in-out infinite;
    font-size: 0.75rem;
    white-space: nowrap;
    z-index: 2;
}
.floating-card2 {
    position: absolute;
    bottom: 10%;
    right: -5px;
    background: white;
    padding: 6px 14px;
    border-radius: 40px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    animation: float-card 4s ease-in-out infinite 1s;
    font-size: 0.75rem;
    white-space: nowrap;
    z-index: 2;
}
.floating-card3 {
    position: absolute;
    top: 35%;
    right: -8px;
    background: white;
    padding: 6px 14px;
    border-radius: 40px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    animation: float-card 4s ease-in-out infinite 1.5s;
    font-size: 0.75rem;
    white-space: nowrap;
    z-index: 2;
}

/* Experience Badge */
.experience-badge {
    position: absolute;
    bottom: -10px;
    right: 10px;
    background: white;
    padding: 8px 16px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    text-align: center;
    min-width: 100px;
    z-index: 2;
}
.experience-badge .display-5 {
    font-size: 1.4rem;
    font-weight: bold;
    color: #0ea5e9;
    line-height: 1;
    display: block;
}
.experience-badge span:last-child {
    font-size: 0.7rem;
    color: #64748b;
    display: block;
}

/* Floating Shapes */
.floating-shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.08;
    animation: float 6s ease-in-out infinite;
    z-index: 0;
}
.shape-1 { width: 60px; height: 60px; background: #0ea5e9; top: 5%; right: 0; animation-delay: 0s; }
.shape-2 { width: 40px; height: 40px; background: #10b981; bottom: 10%; left: 0; animation-delay: 1s; }
.shape-3 { width: 30px; height: 30px; background: #8b5cf6; top: 45%; right: 10%; animation-delay: 2s; }

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-12px); }
}
@keyframes float-card {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-6px); }
}

/* Mouse Trail */
.mouse-trail {
    position: fixed;
    width: 40px;
    height: 40px;
    border: 2px solid rgba(14, 165, 233, 0.5);
    border-radius: 50%;
    pointer-events: none;
    z-index: 9999;
    transition: all 0.1s ease;
    opacity: 0;
}
.mouse-trail.active { opacity: 1; animation: trailPulse 0.5s ease-out; }
@keyframes trailPulse {
    0% { transform: scale(1); opacity: 0.5; }
    100% { transform: scale(2); opacity: 0; }
}

/* Stat Mini Card */
.stat-mini-card {
    background: white;
    padding: 10px;
    border-radius: 14px;
    transition: all 0.3s ease;
}
.stat-mini-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
.icon-circle {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

/* Vision Mission Box */
.vision-mission-box {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-left: 4px solid #0ea5e9;
}

/* Service Card */
.service-card-modern {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(0,0,0,0.05);
    position: relative;
    overflow: hidden;
}
.service-card-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(14, 165, 233, 0.1), transparent);
    transition: left 0.6s ease;
}
.service-card-modern:hover::before { left: 100%; }
.service-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    border-color: transparent;
}
.service-icon-modern {
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e0f2fe 0%, #d1fae5 100%);
    border-radius: 20px;
    transition: all 0.3s ease;
}
.service-card-modern:hover .service-icon-modern {
    background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
    transform: rotateY(180deg);
}
.service-card-modern:hover .service-icon-modern i {
    color: white !important;
    transform: rotateY(-180deg);
}
.service-icon-modern i {
    transition: all 0.3s ease;
    font-size: 1.8rem;
    color: #0ea5e9;
}

/* Doctor Card */
.doctor-card-modern {
    transition: all 0.4s ease;
}
.doctor-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}
.doctor-img-wrapper img {
    height: 260px !important;
    object-fit: cover;
}
.doctor-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(14, 165, 233, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}
.doctor-card-modern:hover .doctor-overlay { opacity: 1; }
.doctor-social-icons { display: flex; gap: 12px; }
.doctor-social-icons a {
    width: 36px;
    height: 36px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0ea5e9;
    transition: all 0.3s ease;
    text-decoration: none;
}
.doctor-social-icons a:hover {
    transform: scale(1.1);
    background: #0ea5e9;
    color: white;
}

/* Schedule Timeline */
.bg-gradient-schedule {
    background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
    position: relative;
}
.schedule-timeline {
    position: relative;
    padding-left: 30px;
}
.schedule-timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: rgba(255,255,255,0.3);
}
.timeline-item {
    position: relative;
    margin-bottom: 20px;
    opacity: 0;
    transform: translateX(-30px);
    transition: all 0.5s ease;
}
.timeline-item.visible { opacity: 1; transform: translateX(0); }
.timeline-icon {
    position: absolute;
    left: -30px;
    top: 18px;
    width: 36px;
    height: 36px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0ea5e9;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    z-index: 1;
}
.timeline-content {
    margin-left: 20px;
    transition: all 0.3s ease;
}
.timeline-content:hover { transform: translateX(8px); }
.schedule-day { font-weight: 600; color: #0ea5e9; }
.schedule-time { font-weight: 600; color: #10b981; margin-right: 15px; }
.schedule-status {
    font-size: 0.7rem;
    padding: 3px 8px;
    border-radius: 20px;
}
.schedule-status.available { background: #d1fae5; color: #10b981; }

/* Article Card */
.article-card-modern {
    transition: all 0.4s ease;
    overflow: hidden;
}
.article-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}
.article-img-wrapper { overflow: hidden; position: relative; }
.article-img-wrapper img { transition: transform 0.5s ease; height: 220px !important; object-fit: cover; }
.article-card-modern:hover .article-img-wrapper img { transform: scale(1.08); }
.article-category {
    position: absolute;
    top: 12px;
    right: 12px;
    background: white;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
    color: #0ea5e9;
}
.article-meta { font-size: 0.7rem; color: #94a3b8; }
.btn-link-custom {
    color: #0ea5e9;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-link-custom:hover {
    color: #10b981;
    letter-spacing: 1px;
}

/* Search */
.search-container { position: relative; }
.search-results-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    z-index: 1000;
    max-height: 400px;
    overflow-y: auto;
}
.search-result-item {
    padding: 12px;
    border-bottom: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    cursor: pointer;
}
.search-result-item:hover { background: #f8fafc; }

/* Booking */
.booking-bg-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='40' fill='%230ea5e9' fill-opacity='0.05'/%3E%3C/svg%3E");
    background-size: 60px 60px;
    pointer-events: none;
}
.booking-card-modern { background: white; }
.booking-header-modern { background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%); }

/* Contact */
.contact-card { transition: all 0.3s ease; }
.contact-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}
.contact-icon-modern {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.social-icon {
    width: 40px;
    height: 40px;
    background: #f1f5f9;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0ea5e9;
    transition: all 0.3s ease;
    text-decoration: none;
}
.social-icon:hover {
    background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
    color: white;
    transform: translateY(-3px);
}

/* Map */
.map-wrapper {
    position: relative;
    overflow: hidden;
    height: 380px;
}
.map-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100% !important;
    height: 100% !important;
    border: 0;
}

#particle-canvas { pointer-events: none; }

.form-control, .form-select {
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}
.form-control:focus, .form-select:focus {
    border-color: #0ea5e9;
    box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
}

.scroll-progress {
    position: fixed;
    top: 0;
    left: 0;
    width: 0%;
    height: 3px;
    background: linear-gradient(90deg, #0ea5e9, #10b981);
    z-index: 10000;
    transition: width 0.3s ease;
}

.btn-primary-custom {
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #0ea5e9, #10b981);
    border: none;
    color: white;
    transition: all 0.3s ease;
}
.btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(14, 165, 233, 0.3);
    color: white;
}
.btn-primary-custom::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255,255,255,0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}
.btn-primary-custom:active::before {
    width: 300px;
    height: 300px;
}
.btn-outline-custom {
    background: transparent;
    border: 2px solid #0ea5e9;
    color: #0ea5e9;
    transition: all 0.3s ease;
}
.btn-outline-custom:hover {
    background: linear-gradient(135deg, #0ea5e9, #10b981);
    border-color: transparent;
    color: white;
    transform: translateY(-2px);
}

/* SweetAlert */
.premium-swal-popup {
    borderRadius: 24px !important;
    padding: 0 !important;
    overflow: hidden !important;
}
.premium-confirm-btn {
    background: linear-gradient(135deg, #0ea5e9, #10b981) !important;
    border: none !important;
    padding: 10px 24px !important;
    font-weight: 600 !important;
    border-radius: 50px !important;
    transition: all 0.3s ease !important;
}
.premium-confirm-btn:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px rgba(14, 165, 233, 0.4) !important;
}

.premium-cancel-btn {
    background: linear-gradient(135deg, #0ea5e9, #3b82f6) !important;
    border: none !important;
    padding: 10px 24px !important;
    font-weight: 600 !important;
    border-radius: 50px !important;
    transition: all 0.3s ease !important;
    color: white !important;
}
.premium-cancel-btn:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px rgba(14, 165, 233, 0.4) !important;
}

/* Responsive */
@media (max-width: 992px) {
    .hero-image-container, .about-image-container { max-width: 380px; }
    .floating-card, .floating-card2, .floating-card3 { padding: 4px 12px; font-size: 0.7rem; }
}
@media (max-width: 768px) {
    .hero-image-wrapper, .about-image { padding: 8px; }
    .hero-image-container, .about-image-container { max-width: 320px; }
    .timeline-item { margin-left: 20px; }
    .timeline-icon { left: -20px; width: 32px; height: 32px; }
    .timeline-content { margin-left: 20px; }
    .floating-card, .floating-card2, .floating-card3 { display: none; }
    .experience-badge { padding: 6px 12px; min-width: 85px; right: 8px; bottom: -8px; }
    .experience-badge .display-5 { font-size: 1.2rem; }
    .experience-badge span:last-child { font-size: 0.6rem; }
    .shape-1 { width: 40px; height: 40px; }
    .shape-2 { width: 30px; height: 30px; }
    .shape-3 { width: 20px; height: 20px; }
}
@media (max-width: 576px) {
    .hero-image-container, .about-image-container { max-width: 280px; }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>

    // ========== BOOKING FORM - UPDATED ==========
const doctorSelect = document.getElementById('doctor_id');
const dateSelect = document.getElementById('booking_date');
const timeSelect = document.getElementById('booking_time');
const scheduleInfo = document.getElementById('scheduleInfo');
const scheduleMessage = document.getElementById('scheduleMessage');

// Fungsi untuk mengambil tanggal-tanggal yang tersedia
function loadAvailableDates(doctorId) {
    if (!doctorId) {
        dateSelect.innerHTML = '<option value="">-- Pilih Dokter Terlebih Dahulu --</option>';
        dateSelect.disabled = true;
        timeSelect.innerHTML = '<option value="">Pilih jam tersedia</option>';
        timeSelect.disabled = true;
        return;
    }
    
    // Tampilkan loading
    dateSelect.innerHTML = '<option value="">Memuat tanggal tersedia...</option>';
    dateSelect.disabled = true;
    
    fetch(`/doctor-available-dates/${doctorId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success && data.dates.length > 0) {
                let options = '<option value="">-- Pilih Tanggal Booking --</option>';
                data.dates.forEach(date => {
                    options += `<option value="${date.date}" data-slots="${date.remaining_slots}">
                        ${date.day}, ${new Date(date.date).toLocaleDateString('id-ID')} 
                        (Sisa: ${date.remaining_slots} kuota)
                    </option>`;
                });
                dateSelect.innerHTML = options;
                dateSelect.disabled = false;
                scheduleInfo.classList.add('d-none');
            } else {
                dateSelect.innerHTML = '<option value="">Tidak ada tanggal tersedia</option>';
                dateSelect.disabled = true;
                scheduleInfo.classList.remove('d-none');
                scheduleInfo.classList.add('alert-warning');
                scheduleMessage.innerHTML = '<i class="bi bi-calendar-x"></i> Dokter tidak memiliki jadwal dalam 30 hari ke depan';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            dateSelect.innerHTML = '<option value="">Gagal memuat tanggal</option>';
            dateSelect.disabled = true;
        });
}

// Fungsi untuk mengambil jam tersedia berdasarkan tanggal yang dipilih
function loadAvailableTimes() {
    const doctorId = doctorSelect.value;
    const bookingDate = dateSelect.value;
    
    if (!doctorId || !bookingDate) {
        timeSelect.innerHTML = '<option value="">Pilih jam tersedia</option>';
        timeSelect.disabled = true;
        return;
    }
    
    // Tampilkan loading
    timeSelect.innerHTML = '<option value="">Memuat jam tersedia...</option>';
    timeSelect.disabled = true;
    
    fetch(`/doctor-schedule/${doctorId}/${bookingDate}`)
        .then(response => response.json())
        .then(data => {
            if (data.available && data.available_slots && data.available_slots.length > 0) {
                let options = '<option value="">-- Pilih Jam Booking --</option>';
                data.available_slots.forEach(slot => {
                    options += `<option value="${slot}">${slot} WIB</option>`;
                });
                timeSelect.innerHTML = options;
                timeSelect.disabled = false;
                
                scheduleInfo.classList.remove('d-none', 'alert-danger', 'alert-warning');
                scheduleInfo.classList.add('alert-info');
                scheduleMessage.innerHTML = `<i class="bi bi-check-circle"></i> ${data.message}`;
            } else {
                timeSelect.innerHTML = '<option value="">Tidak ada jam tersedia</option>';
                timeSelect.disabled = true;
                scheduleInfo.classList.remove('d-none', 'alert-info');
                scheduleInfo.classList.add('alert-danger');
                scheduleMessage.innerHTML = `<i class="bi bi-exclamation-triangle"></i> ${data.message}`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            timeSelect.innerHTML = '<option value="">Gagal memuat jam</option>';
            timeSelect.disabled = true;
        });
}

// Event listeners
if (doctorSelect) {
    doctorSelect.addEventListener('change', function() {
        const doctorId = this.value;
        if (doctorId) {
            loadAvailableDates(doctorId);
            // Reset time select
            timeSelect.innerHTML = '<option value="">Pilih jam tersedia</option>';
            timeSelect.disabled = true;
            scheduleInfo.classList.add('d-none');
        } else {
            dateSelect.innerHTML = '<option value="">-- Pilih Dokter Terlebih Dahulu --</option>';
            dateSelect.disabled = true;
            timeSelect.innerHTML = '<option value="">Pilih jam tersedia</option>';
            timeSelect.disabled = true;
        }
    });
}

if (dateSelect) {
    dateSelect.addEventListener('change', function() {
        if (this.value) {
            loadAvailableTimes();
        } else {
            timeSelect.innerHTML = '<option value="">Pilih jam tersedia</option>';
            timeSelect.disabled = true;
        }
    });
}

// Jika ada old value saat form error, load data yang sesuai
document.addEventListener('DOMContentLoaded', function() {
    const oldDoctorId = '{{ old('doctor_id') }}';
    const oldBookingDate = '{{ old('booking_date') }}';
    
    if (oldDoctorId) {
        doctorSelect.value = oldDoctorId;
        loadAvailableDates(oldDoctorId);
        
        if (oldBookingDate) {
            setTimeout(() => {
                dateSelect.value = oldBookingDate;
                loadAvailableTimes();
            }, 500);
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Scroll Progress Bar
    const progressBar = document.createElement('div');
    progressBar.className = 'scroll-progress';
    document.body.appendChild(progressBar);
    window.addEventListener('scroll', () => {
        const windowHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrolled = (window.scrollY / windowHeight) * 100;
        progressBar.style.width = scrolled + '%';
    });
    
    // SweetAlert untuk Booking Success dengan QR Code (URL-based)
    @if(session('booking_success') && session('booking_data'))
    setTimeout(function() {
        const bookingData = @json(session('booking_data'));
        
        // Konfeti effect
        if (typeof canvasConfetti !== 'undefined') {
            canvasConfetti({ particleCount: 150, spread: 70, origin: { x: 0, y: 0.5 }, startVelocity: 20, colors: ['#0ea5e9', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'] });
            canvasConfetti({ particleCount: 150, spread: 70, origin: { x: 1, y: 0.5 }, startVelocity: 20, colors: ['#0ea5e9', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'] });
            setTimeout(() => { canvasConfetti({ particleCount: 200, spread: 100, origin: { y: 0 }, startVelocity: 25, colors: ['#0ea5e9', '#10b981', '#fbbf24', '#f97316'] }); }, 150);
            
            let duration = 2000, end = Date.now() + duration;
            (function frame() {
                canvasConfetti({ particleCount: 3, angle: 60, spread: 55, origin: { x: 0 }, colors: ['#0ea5e9', '#10b981'] });
                canvasConfetti({ particleCount: 3, angle: 120, spread: 55, origin: { x: 1 }, colors: ['#0ea5e9', '#10b981'] });
                if (Date.now() < end) requestAnimationFrame(frame);
            }());
        }
        
        // Buat URL untuk detail booking (INI YANG AKAN DISCAN)
        const bookingDetailUrl = `${window.location.origin}/booking/detail/${bookingData.code}`;
        
        // Buat container untuk QR Code
        const qrContainerId = 'qrcode-container-' + Date.now();
        
        Swal.fire({
            title: '🎉 BOOKING BERHASIL! 🎉',
            html: `
                <div class="premium-alert" style="font-family: system-ui, sans-serif;">
                    <div style="background: linear-gradient(135deg, #0ea5e9, #10b981); margin: -1rem -1rem 1rem -1rem; padding: 1.5rem; border-radius: 20px 20px 0 0;">
                        <div style="background: white; width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                            <i class="bi bi-check-lg" style="font-size: 2.5rem; color: #10b981;"></i>
                        </div>
                        <h3 style="color: white; margin-top: 1rem; font-weight: 700;">Booking Berhasil!</h3>
                        <p style="color: rgba(255,255,255,0.9); margin: 0;">Terima kasih telah mempercayakan kesehatan Anda kepada kami</p>
                    </div>
                    
                    <!-- QR CODE SECTION - SCAN INI AKAN BUKA HALAMAN DETAIL -->
                    <div style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); border-radius: 20px; padding: 1rem; margin-bottom: 1rem; text-align: center;">
                        <div style="display: inline-flex; align-items: center; gap: 8px; background: white; padding: 5px 15px; border-radius: 50px; margin-bottom: 12px;">
                            <i class="bi bi-upc-scan" style="font-size: 1rem; color: #0ea5e9;"></i>
                            <span style="font-size: 0.7rem; font-weight: 600; color: #0ea5e9;">SCAN QR CODE</span>
                        </div>
                        <div id="${qrContainerId}" style="display: flex; justify-content: center; margin: 10px 0;"></div>
                        <p style="font-size: 0.65rem; color: #64748b; margin-top: 8px;">
                            <i class="bi bi-camera-fill"></i> Scan QR code dengan kamera HP untuk melihat detail booking
                        </p>
                    </div>
                    
                    <div style="background: linear-gradient(135deg, #f0f9ff, #ecfdf5); border-radius: 16px; padding: 1rem; margin-bottom: 1rem; text-align: center;">
                        <div style="display: inline-flex; align-items: center; gap: 10px; background: white; padding: 8px 20px; border-radius: 50px; margin-bottom: 12px;">
                            <i class="bi bi-upc-scan" style="font-size: 1.2rem; color: #0ea5e9;"></i>
                            <span style="font-size: 0.75rem; color: #64748b;">KODE BOOKING</span>
                        </div>
                        <div style="font-family: monospace; font-size: 1.3rem; font-weight: bold; letter-spacing: 3px; background: white; padding: 8px; border-radius: 12px; display: inline-block;">
                            ${bookingData.code}
                        </div>
                        <p style="font-size: 0.65rem; color: #64748b; margin-top: 8px;">
                            <i class="bi bi-copy"></i> Atau gunakan kode ini untuk check-in manual
                        </p>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <div style="display: flex; align-items: center; gap: 12px; padding: 10px; background: #f8fafc; border-radius: 14px; margin-bottom: 8px;">
                            <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #0ea5e9, #10b981); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-person-fill" style="font-size: 1rem; color: white;"></i>
                            </div>
                            <div style="flex: 1; text-align: left;">
                                <small style="color: #64748b; display: block;">NAMA PASIEN</small>
                                <strong style="font-size: 0.9rem;">${bookingData.patient_name}</strong>
                            </div>
                        </div>
                        
                        <div style="display: flex; align-items: center; gap: 12px; padding: 10px; background: #f8fafc; border-radius: 14px; margin-bottom: 8px;">
                            <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #0ea5e9, #10b981); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-hospital-fill" style="font-size: 1rem; color: white;"></i>
                            </div>
                            <div style="flex: 1; text-align: left;">
                                <small style="color: #64748b; display: block;">DOKTER</small>
                                <strong style="font-size: 0.9rem;">${bookingData.doctor_name}</strong>
                            </div>
                        </div>
                        
                        <div style="display: flex; align-items: center; gap: 12px; padding: 10px; background: #f8fafc; border-radius: 14px; margin-bottom: 8px;">
                            <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #f59e0b, #f97316); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-calendar-check-fill" style="font-size: 1rem; color: white;"></i>
                            </div>
                            <div style="flex: 1; text-align: left;">
                                <small style="color: #64748b; display: block;">TANGGAL & WAKTU</small>
                                <strong style="font-size: 0.9rem;">${bookingData.date} • ${bookingData.time} WIB</strong>
                            </div>
                        </div>
                        
                        ${bookingData.phone ? `
                        <div style="display: flex; align-items: center; gap: 12px; padding: 10px; background: #f8fafc; border-radius: 14px; margin-bottom: 8px;">
                            <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #8b5cf6, #a78bfa); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-phone-fill" style="font-size: 1rem; color: white;"></i>
                            </div>
                            <div style="flex: 1; text-align: left;">
                                <small style="color: #64748b; display: block;">NOMOR HP</small>
                                <strong style="font-size: 0.9rem;">${bookingData.phone}</strong>
                            </div>
                        </div>
                        ` : ''}
                    </div>
                    
                    <div style="background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 14px; padding: 10px; margin-top: 0.5rem; display: flex; align-items: center; gap: 10px;">
                        <i class="bi bi-bell-fill" style="font-size: 1.2rem; color: #d97706;"></i>
                        <div style="flex: 1; text-align: left;">
                            <small style="color: #92400e; font-weight: 600;">PENGINGAT</small>
                            <p style="color: #78350f; margin: 0; font-size: 0.7rem;">Harap datang 15 menit sebelum jadwal dan tunjukkan QR code ini</p>
                        </div>
                    </div>
                </div>
            `,
            showConfirmButton: true,
            showCancelButton: true,
            cancelButtonText: '<i class="bi bi-download me-2"></i>Download QR',
            confirmButtonText: '<i class="bi bi-check-lg me-2"></i>OK, Saya Mengerti',
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#0ea5e9',
            background: '#ffffff',
            width: '500px',
            padding: '0',
            borderRadius: '24px',
            customClass: { 
                popup: 'premium-swal-popup', 
                confirmButton: 'premium-confirm-btn',
                cancelButton: 'premium-cancel-btn'
            }
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.cancel) {
                // Download QR Code
                const qrContainer = document.getElementById(qrContainerId);
                const qrImage = qrContainer.querySelector('img');
                if (qrImage) {
                    const link = document.createElement('a');
                    link.download = `booking-${bookingData.code}.png`;
                    link.href = qrImage.src;
                    link.click();
                    
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'QR Code berhasil di download',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            }
        });
        
        // Generate QR Code dengan URL (bukan JSON)
        setTimeout(() => {
            const qrContainer = document.getElementById(qrContainerId);
            const bookingDetailUrl = `${window.location.origin}/booking/detail/${bookingData.code}`;
            
            if (qrContainer && typeof QRCode !== 'undefined') {
                new QRCode(qrContainer, {
                    text: bookingDetailUrl,  // URL, bukan JSON!
                    width: 180,
                    height: 180,
                    colorDark: '#0ea5e9',
                    colorLight: '#ffffff',
                    correctLevel: QRCode.CorrectLevel.H
                });
            } else if (qrContainer) {
                qrContainer.innerHTML = `
                    <div style="background: #f0f9ff; border-radius: 16px; padding: 20px; text-align: center;">
                        <i class="bi bi-upc-scan" style="font-size: 3rem; color: #0ea5e9;"></i>
                        <p style="font-size: 0.7rem; margin-top: 8px;">Klik link: <a href="${bookingDetailUrl}" target="_blank">${bookingDetailUrl}</a></p>
                    </div>
                `;
            }
        }, 100);
        
    }, 500);
    @endif
    
    // SweetAlert untuk Error
    @if(session('error'))
    Swal.fire({
        title: '❌ Oops!',
        html: `
            <div style="padding: 10px 0;">
                <div style="background: linear-gradient(135deg, #fef2f2, #fee2e2); border-radius: 20px; padding: 20px; margin-bottom: 15px;">
                    <i class="bi bi-emoji-frown" style="font-size: 3rem; color: #ef4444;"></i>
                    <p style="color: #991b1b; margin-top: 10px; font-weight: 500;">{{ session('error') }}</p>
                </div>
                <div style="background: #f0f9ff; border-radius: 14px; padding: 12px; text-align: left;">
                    <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 8px;">
                        <i class="bi bi-lightbulb" style="color: #0ea5e9;"></i>
                        <strong>💡 Saran:</strong>
                    </div>
                    <ul style="margin: 0; padding-left: 1.5rem; font-size: 0.8rem; color: #475569;">
                        <li>Periksa kembali data yang Anda masukkan</li>
                        <li>Coba pilih dokter atau jadwal lain</li>
                        <li>Hubungi admin jika masalah berlanjut</li>
                    </ul>
                </div>
            </div>
        `,
        icon: 'error',
        confirmButtonText: '<i class="bi bi-arrow-repeat me-2"></i>Coba Lagi',
        confirmButtonColor: '#ef4444',
        background: '#ffffff',
        borderRadius: '24px'
    });
    @endif
    
    // Particle Background Effect (sama seperti sebelumnya)
    const canvas = document.getElementById('particle-canvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        let particles = [];
        let animationId;
        let mouseX = 0, mouseY = 0;
        
        canvas.addEventListener('mousemove', (e) => {
            const rect = canvas.getBoundingClientRect();
            mouseX = e.clientX - rect.left;
            mouseY = e.clientY - rect.top;
        });
        
        function resizeCanvas() {
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
        }
        
        function createParticles() {
            const particleCount = 80;
            for (let i = 0; i < particleCount; i++) {
                particles.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    radius: Math.random() * 3 + 1,
                    alpha: Math.random() * 0.5 + 0.2,
                    speedX: (Math.random() - 0.5) * 0.5,
                    speedY: (Math.random() - 0.5) * 0.5,
                    originalX: Math.random() * canvas.width,
                    originalY: Math.random() * canvas.height
                });
            }
        }
        
        function drawParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(particle => {
                const dx = mouseX - particle.x;
                const dy = mouseY - particle.y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                const maxDistance = 150;
                
                if (distance < maxDistance) {
                    const angle = Math.atan2(dy, dx);
                    const force = (maxDistance - distance) / maxDistance;
                    particle.x -= Math.cos(angle) * force * 2;
                    particle.y -= Math.sin(angle) * force * 2;
                } else {
                    particle.x += (particle.originalX - particle.x) * 0.05;
                    particle.y += (particle.originalY - particle.y) * 0.05;
                }
                
                ctx.beginPath();
                ctx.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(14, 165, 233, ${particle.alpha})`;
                ctx.fill();
                
                particle.originalX += (particle.x - particle.originalX) * 0.01;
                particle.originalY += (particle.y - particle.originalY) * 0.01;
            });
            animationId = requestAnimationFrame(drawParticles);
        }
        
        function initParticles() {
            resizeCanvas();
            createParticles();
            drawParticles();
        }
        
        window.addEventListener('resize', () => {
            resizeCanvas();
            particles = [];
            createParticles();
        });
        initParticles();
    }
    
    // Typing effect (sama seperti sebelumnya)
    const phrases = ['Solusi Kesehatan', 'Layanan Terbaik', 'Kesehatan Keluarga', 'Pelayanan Prima'];
    let currentPhraseIndex = 0, currentCharIndex = 0, isDeleting = false;
    const typingElement = document.getElementById('typing-text');
    let typeSpeed = 80, deleteSpeed = 40, pauseBetween = 2000;
    
    function typeEffect() {
        if (!typingElement) return;
        const currentPhrase = phrases[currentPhraseIndex];
        if (isDeleting) {
            typingElement.textContent = currentPhrase.substring(0, currentCharIndex - 1);
            currentCharIndex--;
            typeSpeed = deleteSpeed;
        } else {
            typingElement.textContent = currentPhrase.substring(0, currentCharIndex + 1);
            currentCharIndex++;
            typeSpeed = 80;
        }
        if (!isDeleting && currentCharIndex === currentPhrase.length) {
            isDeleting = true;
            typeSpeed = pauseBetween;
            setTimeout(typeEffect, pauseBetween);
            return;
        }
        if (isDeleting && currentCharIndex === 0) {
            isDeleting = false;
            currentPhraseIndex = (currentPhraseIndex + 1) % phrases.length;
            typeSpeed = 80;
            setTimeout(typeEffect, 300);
            return;
        }
        setTimeout(typeEffect, typeSpeed);
    }
    setTimeout(typeEffect, 500);
    
    setInterval(() => {
        if (typingElement && !isDeleting) {
            typingElement.style.transform = 'scale(1.02)';
            setTimeout(() => { if (typingElement) typingElement.style.transform = 'scale(1)'; }, 100);
        }
    }, 1500);
    
    // Mouse Trail (sama seperti sebelumnya)
    const mouseTrail = document.getElementById('mouse-trail');
    if (mouseTrail) {
        let mouseX = 0, mouseY = 0, trailX = 0, trailY = 0;
        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            mouseTrail.classList.add('active');
            setTimeout(() => { if (mouseTrail.classList.contains('active')) mouseTrail.classList.remove('active'); }, 100);
        });
        function animateTrail() {
            trailX += (mouseX - trailX) * 0.1;
            trailY += (mouseY - trailY) * 0.1;
            mouseTrail.style.left = trailX - 20 + 'px';
            mouseTrail.style.top = trailY - 20 + 'px';
            requestAnimationFrame(animateTrail);
        }
        animateTrail();
    }
    
    // Counter animation (sama seperti sebelumnya)
    const counters = document.querySelectorAll('.counter');
    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-target'));
        let count = 0;
        const increment = target / 60;
        const updateCount = () => {
            if (count < target) {
                count += increment;
                counter.innerText = Math.ceil(count);
                setTimeout(updateCount, 20);
            } else {
                counter.innerText = target.toLocaleString();
            }
        };
        updateCount();
    };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => { if (entry.isIntersecting) { animateCounter(entry.target); observer.unobserve(entry.target); } });
    }, { threshold: 0.3 });
    counters.forEach(counter => observer.observe(counter));
    
    // Search functionality (sama seperti sebelumnya)
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    const searchResults = document.getElementById('searchResults');
    let searchTimeout;
    
    function performSearch() {
        const keyword = searchInput.value.trim();
        if (keyword.length < 2) { searchResults.style.display = 'none'; return; }
        fetch(`/search-articles?q=${encodeURIComponent(keyword)}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.articles.data.length > 0) {
                    let html = '';
                    data.articles.data.forEach(article => {
                        html += `<div class="search-result-item" onclick="window.location.href='/article/${article.slug}'">
                            <div class="d-flex gap-3">
                                ${article.image ? `<img src="/storage/${article.image}" class="rounded-3" style="width: 60px; height: 60px; object-fit: cover;">` : ''}
                                <div>
                                    <h6 class="mb-1">${article.title}</h6>
                                    <small class="text-muted">${new Date(article.created_at).toLocaleDateString('id-ID')}</small>
                                    <p class="small text-muted mb-0">${article.summary ? article.summary.substring(0, 100) : ''}...</p>
                                </div>
                            </div>
                        </div>`;
                    });
                    searchResults.innerHTML = html;
                    searchResults.style.display = 'block';
                } else {
                    searchResults.innerHTML = '<div class="p-3 text-center text-muted">Tidak ada artikel ditemukan</div>';
                    searchResults.style.display = 'block';
                }
            })
            .catch(error => console.error('Search error:', error));
    }
    
    if (searchInput) {
        searchInput.addEventListener('keyup', () => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(performSearch, 500);
        });
        searchInput.addEventListener('blur', () => { setTimeout(() => searchResults.style.display = 'none', 200); });
        if (searchBtn) searchBtn.addEventListener('click', performSearch);
    }
    
    // Schedule check (sama seperti sebelumnya)
    const doctorSelect = document.getElementById('doctor_id');
    const dateInput = document.getElementById('booking_date');
    const timeSelect = document.getElementById('booking_time');
    const scheduleInfo = document.getElementById('scheduleInfo');
    const scheduleMessage = document.getElementById('scheduleMessage');
    
    function generateTimeSlots(startTime, endTime, interval = 30) {
        const slots = [];
        let start = new Date(`2000-01-01 ${startTime}`);
        let end = new Date(`2000-01-01 ${endTime}`);
        while (start < end) {
            const timeString = start.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            slots.push(timeString);
            start.setMinutes(start.getMinutes() + interval);
        }
        return slots;
    }
    
    function checkSchedule() {
        const doctorId = doctorSelect.value;
        const bookingDate = dateInput.value;
        if (doctorId && bookingDate) {
            fetch(`/doctor-schedule/${doctorId}/${bookingDate}`)
                .then(response => response.json())
                .then(data => {
                    if (data.available) {
                        scheduleInfo.classList.remove('d-none', 'alert-danger');
                        scheduleInfo.classList.add('alert-info');
                        scheduleMessage.innerHTML = `<i class="bi bi-check-circle"></i> ${data.message}. Sisa kuota: ${data.remaining_slots} pasien.`;
                        if (data.available_slots && data.available_slots.length > 0) {
                            timeSelect.innerHTML = '<option value="">Pilih jam tersedia</option>' + data.available_slots.map(slot => `<option value="${slot}">${slot} WIB</option>`).join('');
                            timeSelect.disabled = false;
                        } else if (data.schedule && data.schedule.start_time && data.schedule.end_time) {
                            const slots = generateTimeSlots(data.schedule.start_time, data.schedule.end_time);
                            timeSelect.innerHTML = '<option value="">Pilih jam tersedia</option>' + slots.map(slot => `<option value="${slot}">${slot} WIB</option>`).join('');
                            timeSelect.disabled = false;
                        } else {
                            timeSelect.innerHTML = '<option value="">Jam tidak tersedia</option>';
                            timeSelect.disabled = true;
                        }
                    } else {
                        scheduleInfo.classList.remove('d-none', 'alert-info');
                        scheduleInfo.classList.add('alert-danger');
                        scheduleMessage.innerHTML = `<i class="bi bi-exclamation-triangle"></i> ${data.message}`;
                        timeSelect.innerHTML = '<option value="">Pilih jam tersedia</option>';
                        timeSelect.disabled = true;
                    }
                })
                .catch(error => { console.error('Error:', error); });
        } else {
            scheduleInfo.classList.add('d-none');
            timeSelect.innerHTML = '<option value="">Pilih jam tersedia</option>';
            timeSelect.disabled = true;
        }
    }
    
    if (doctorSelect && dateInput && timeSelect) {
        doctorSelect.addEventListener('change', checkSchedule);
        dateInput.addEventListener('change', checkSchedule);
    }
    
    // Smooth scroll (sama seperti sebelumnya)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - offset;
                window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
            }
        });
    });
    
    // Scroll reveal (sama seperti sebelumnya)
    const revealElements = document.querySelectorAll('.service-card-modern, .doctor-card-modern, .article-card-modern');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => { if (entry.isIntersecting) { entry.target.style.opacity = '1'; entry.target.style.transform = 'translateY(0)'; } });
    }, { threshold: 0.1 });
    revealElements.forEach(el => { el.style.opacity = '0'; el.style.transform = 'translateY(30px)'; el.style.transition = 'all 0.6s ease'; revealObserver.observe(el); });
    
    // Timeline animation (sama seperti sebelumnya)
    const timelineItems = document.querySelectorAll('.timeline-item');
    const timelineObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => { if (entry.isIntersecting) { entry.target.classList.add('visible'); timelineObserver.unobserve(entry.target); } });
    }, { threshold: 0.1 });
    timelineItems.forEach(item => timelineObserver.observe(item));
    
    // Form submission (sama seperti sebelumnya)
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function() {
            const submitBtn = document.getElementById('submitBookingBtn');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memproses...';
                submitBtn.disabled = true;
            }
        });
    }
    
    // Parallax effect (sama seperti sebelumnya)
    const heroImage = document.querySelector('.hero-main-image');
    if (heroImage) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * 0.3;
            heroImage.style.transform = `translateY(${rate}px)`;
        });
    }
});
</script>
@endsection