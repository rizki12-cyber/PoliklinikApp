{{-- resources/views/layouts/landing.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $clinic->name ?? 'Klinik Kesehatan' }} - Solusi Kesehatan Terpercaya</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- qr code.js -->
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    
    <style>
        :root {
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --primary-light: #e0f2fe;
            --secondary: #10b981;
            --secondary-dark: #059669;
            --accent: #8b5cf6;
            --dark: #0f172a;
            --gray: #64748b;
            --light: #f8fafc;
            --gradient-primary: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
            --gradient-dark: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-md: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
        }
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            overflow-x: hidden;
            background-color: var(--light);
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }
        
        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            box-shadow: var(--shadow-sm);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 1rem 0;
        }
        
        .navbar.scrolled {
            padding: 0.75rem 0;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: var(--shadow-md);
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.75rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: scale(1.02);
        }
        
        .nav-link {
            font-weight: 600;
            color: var(--dark) !important;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 1rem !important;
            margin: 0 0.25rem;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--gradient-primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 2px;
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 70%;
        }
        
        .nav-link:hover {
            color: var(--primary) !important;
            transform: translateY(-2px);
        }
        
        /* Buttons */
        .btn-primary-custom {
            background: var(--gradient-primary);
            border: none;
            padding: 12px 32px;
            border-radius: 50px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
            color: white;
        }
        
        .btn-outline-custom {
            border: 2px solid var(--primary);
            background: transparent;
            padding: 12px 32px;
            border-radius: 50px;
            font-weight: 600;
            color: var(--primary);
            transition: all 0.3s ease;
        }
        
        .btn-outline-custom:hover {
            background: var(--gradient-primary);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }
        
        /* Cards */
        .service-card, .doctor-card, .article-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            border-radius: 28px;
            overflow: hidden;
            background: white;
            box-shadow: var(--shadow);
        }
        
        .service-card:hover, .doctor-card:hover, .article-card:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow-xl);
        }
        
        .service-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-light) 0%, #d1fae5 100%);
            border-radius: 24px;
            font-size: 2.25rem;
            color: var(--primary);
            transition: all 0.3s ease;
        }
        
        .service-card:hover .service-icon {
            transform: scale(1.1) rotate(5deg);
            background: var(--gradient-primary);
            color: white;
        }
        
        /* Doctor Card */
        .doctor-card {
            position: relative;
        }
        
        .doctor-img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .doctor-card:hover .doctor-img {
            transform: scale(1.05);
        }
        
        .doctor-social {
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 12px;
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .doctor-card:hover .doctor-social {
            bottom: 20px;
            opacity: 1;
        }
        
        .doctor-social a {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 50%;
            color: var(--primary);
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
        }
        
        .doctor-social a:hover {
            background: var(--gradient-primary);
            color: white;
            transform: translateY(-3px);
        }
        
        /* Section Title */
        .section-title {
            font-weight: 800;
            margin-bottom: 3rem;
            position: relative;
            font-size: 2.5rem;
            color: var(--dark);
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: 4px;
        }
        
        .section-subtitle {
            color: var(--gray);
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto 3rem;
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 2000 1500'%3E%3Cpath fill='%230ea5e9' fill-opacity='0.05' d='M0,0 L2000,0 L2000,1500 L0,1500 Z'/%3E%3C/svg%3E");
            background-size: cover;
            pointer-events: none;
        }
        
        .hero-badge {
            display: inline-block;
            background: rgba(14, 165, 233, 0.1);
            color: var(--primary);
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(4px);
        }
        
        /* Stats Section */
        .stat-card {
            background: white;
            border-radius: 28px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Schedule Badge */
        .schedule-badge {
            background: linear-gradient(135deg, var(--primary-light), #d1fae5);
            color: var(--primary-dark);
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
            margin: 2px;
        }
        
        /* Footer */
        footer {
            background: var(--gradient-dark);
            color: white;
            position: relative;
        }
        
        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }
        
        .footer-link {
            color: #94a3b8;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .footer-link:hover {
            color: white;
            transform: translateX(5px);
            display: inline-block;
        }
        
        /* Booking Form */
        .booking-card {
            background: white;
            border-radius: 32px;
            box-shadow: var(--shadow-xl);
            overflow: hidden;
        }
        
        .booking-header {
            background: var(--gradient-primary);
            padding: 2rem;
            color: white;
        }
        
        .form-control, .form-select {
            border-radius: 16px;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }
        
        /* Contact Info */
        .contact-info-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: white;
            border-radius: 20px;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }
        
        .contact-info-item:hover {
            transform: translateX(10px);
            box-shadow: var(--shadow);
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-light), #d1fae5);
            border-radius: 16px;
            font-size: 1.5rem;
            color: var(--primary);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                min-height: auto;
                padding: 100px 0 60px;
            }
            
            .display-3 {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 1.75rem;
            }
            
            .navbar-brand {
                font-size: 1.5rem;
            }
        }
        
        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        /* Back to Top */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 45px;
            height: 45px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: var(--shadow-lg);
        }
        
        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            transform: translateY(-5px);
            color: white;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <i class="bi bi-heart-pulse-fill me-2"></i>{{ $clinic->name ?? 'Klinik Sehat' }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#home">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="#doctors">Dokter</a></li>
                <li class="nav-item"><a class="nav-link" href="#schedule">Jadwal</a></li>
                <li class="nav-item"><a class="nav-link" href="#articles">Artikel</a></li>
                <li class="nav-item"><a class="nav-link" href="#booking">Booking</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
            </ul>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<!-- Footer -->
<footer class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-heart-pulse-fill me-2"></i>{{ $clinic->name ?? 'Klinik Sehat' }}
                </h5>
                <p class="text-secondary mb-3">{{ Str::limit($clinic->description ?? 'Klinik kesehatan terpercaya dengan pelayanan terbaik untuk Anda dan keluarga.', 150) }}</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-secondary-hover"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-secondary-hover"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-secondary-hover"><i class="bi bi-twitter fs-5"></i></a>
                    <a href="#" class="text-secondary-hover"><i class="bi bi-youtube fs-5"></i></a>
                </div>
            </div>
            <div class="col-lg-2">
                <h6 class="fw-bold mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#home" class="footer-link">Beranda</a></li>
                    <li class="mb-2"><a href="#about" class="footer-link">Tentang</a></li>
                    <li class="mb-2"><a href="#services" class="footer-link">Layanan</a></li>
                    <li class="mb-2"><a href="#doctors" class="footer-link">Dokter</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h6 class="fw-bold mb-3">Jam Operasional</h6>
                <ul class="list-unstyled text-secondary">
                    <li class="mb-2"><i class="bi bi-clock me-2"></i> Senin - Sabtu</li>
                    <li class="mb-2 ms-4">{{ $clinic->operational_start ?? '08:00' }} - {{ $clinic->operational_end ?? '20:00' }}</li>
                    <li class="mb-2"><i class="bi bi-calendar-x me-2"></i> Minggu & Hari Libur: Tutup</li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h6 class="fw-bold mb-3">Kontak Kami</h6>
                <ul class="list-unstyled text-secondary">
                    <li class="mb-2"><i class="bi bi-geo-alt-fill me-2"></i> {{ $clinic->address ?? 'Jakarta, Indonesia' }}</li>
                    <li class="mb-2"><i class="bi bi-telephone-fill me-2"></i> {{ $clinic->phone ?? '(021) 1234-5678' }}</li>
                    <li class="mb-2"><i class="bi bi-envelope-fill me-2"></i> {{ $clinic->email ?? 'info@kliniksehat.com' }}</li>
                </ul>
            </div>
        </div>
        <hr class="my-4 opacity-25">
        <div class="text-center text-secondary">
            <p class="mb-0">&copy; {{ date('Y') }} {{ $clinic->name ?? 'Klinik Kesehatan' }}. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<div class="back-to-top">
    <i class="bi bi-arrow-up"></i>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true, offset: 100 });
    
    // Smooth scroll with active link update
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    
    function updateActiveLink() {
        const scrollPosition = window.scrollY + 100;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionBottom = sectionTop + section.offsetHeight;
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                const currentId = section.getAttribute('id');
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${currentId}`) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                // Close mobile menu if open
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    navbarCollapse.classList.remove('show');
                }
            }
        });
    });
    
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        const backToTop = document.querySelector('.back-to-top');
        
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        if (window.scrollY > 300) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
        
        updateActiveLink();
    });
    
    // Back to top functionality
    document.querySelector('.back-to-top').addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // Trigger initial update
    updateActiveLink();
</script>
@stack('scripts')
</body>
</html>