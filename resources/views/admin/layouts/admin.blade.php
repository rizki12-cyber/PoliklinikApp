{{-- resources/views/admin/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HealthCore i9 Ultra - Admin Panel</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 280px;
            --primary: #0891b2;
            --primary-dark: #0e7490;
            --secondary: #14b8a6;
            --secondary-dark: #0d9488;
            --dark: #0f172a;
            --darker: #0a0f1c;
        }
        
        * {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
        
        body {
            background: #f0f2f5;
        }
        
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar - Premium Design */
        .admin-sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #0f172a 0%, #0a0f1c 100%);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }
        
        .admin-sidebar::-webkit-scrollbar {
            width: 5px;
        }
        
        .admin-sidebar::-webkit-scrollbar-track {
            background: #1e293b;
        }
        
        .admin-sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #0891b2, #14b8a6);
            border-radius: 5px;
        }
        
        /* Sidebar Header - HealthCore i9 Ultra Brand */
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background: linear-gradient(135deg, rgba(8, 145, 178, 0.15) 0%, rgba(20, 184, 166, 0.05) 100%);
        }
        
        .sidebar-brand-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #0891b2, #14b8a6);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px auto;
            box-shadow: 0 8px 20px rgba(8, 145, 178, 0.3);
        }
        
        .sidebar-brand-icon i {
            font-size: 1.8rem;
            color: white;
        }
        
        .sidebar-brand {
            font-size: 1.3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #a5f3fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }
        
        .sidebar-subtitle {
            font-size: 0.65rem;
            color: rgba(255, 255, 255, 0.5);
            letter-spacing: 1px;
        }
        
        /* Sidebar Menu */
        .sidebar-menu {
            list-style: none;
            padding: 1rem 0;
            margin: 0;
        }
        
        .sidebar-menu .menu-label {
            padding: 12px 24px 6px 24px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.4);
        }
        
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            gap: 12px;
            position: relative;
            margin: 2px 8px;
            border-radius: 12px;
        }
        
        .sidebar-menu li a:hover {
            background: rgba(8, 145, 178, 0.15);
            color: white;
            transform: translateX(4px);
        }
        
        .sidebar-menu li a.active {
            background: linear-gradient(135deg, rgba(8, 145, 178, 0.25) 0%, rgba(20, 184, 166, 0.15) 100%);
            color: white;
            border-left: 3px solid #0891b2;
        }
        
        .sidebar-menu li a i {
            width: 24px;
            font-size: 1.2rem;
        }
        
        .sidebar-menu li a .badge {
            margin-left: auto;
            background: linear-gradient(135deg, #0891b2, #14b8a6);
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 20px;
        }
        
        /* Main Content */
        .admin-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            background: #f0f2f5;
            min-height: 100vh;
        }
        
        /* Navbar Premium */
        .admin-navbar {
            background: white;
            padding: 1rem 1.8rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 99;
        }
        
        .navbar-title {
            font-weight: 600;
            color: #1e293b;
        }
        
        .navbar-title span {
            background: linear-gradient(135deg, #0891b2, #14b8a6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Mobile Toggle */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #0891b2;
            transition: all 0.3s ease;
        }
        
        .sidebar-toggle:hover {
            transform: scale(1.1);
        }
        
        /* User Dropdown Premium */
        .user-dropdown {
            position: relative;
            cursor: pointer;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #0891b2, #14b8a6);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .user-dropdown:hover .user-avatar {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(8, 145, 178, 0.3);
        }
        
        .user-info {
            line-height: 1.3;
        }
        
        .user-info strong {
            font-size: 0.9rem;
            color: #1e293b;
        }
        
        .user-info small {
            font-size: 0.7rem;
        }
        
        .user-dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            min-width: 250px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            margin-top: 10px;
        }
        
        .user-dropdown:hover .user-dropdown-menu {
            opacity: 1;
            visibility: visible;
            margin-top: 5px;
        }
        
        .dropdown-item-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #475569;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .dropdown-item-custom:hover {
            background: #f8fafc;
            color: #0891b2;
        }
        
        /* Content Area */
        .admin-content-inner {
            padding: 1.8rem;
        }
        
        /* Page Title */
        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #1e293b, #475569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }
        
        .page-subtitle {
            color: #64748b;
            font-size: 0.9rem;
        }
        
        /* Card Styles Premium */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(135deg, #0891b2, #14b8a6);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .stat-icon {
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, rgba(8, 145, 178, 0.1), rgba(20, 184, 166, 0.1));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .stat-icon i {
            font-size: 1.8rem;
            color: #0891b2;
        }
        
        /* Table Styles Premium */
        .table-custom {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        
        .table-custom thead th {
            background: #f8fafc;
            color: #1e293b;
            font-weight: 600;
            border-bottom: none;
            padding: 1rem;
        }
        
        .table-custom tbody td {
            padding: 1rem;
            vertical-align: middle;
        }
        
        /* Button Styles Premium */
        .btn-primary-custom {
            background: linear-gradient(135deg, #0891b2 0%, #14b8a6 100%);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(8, 145, 178, 0.4);
            color: white;
        }
        
        .btn-outline-custom {
            border: 1.5px solid #0891b2;
            background: transparent;
            color: #0891b2;
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-outline-custom:hover {
            background: linear-gradient(135deg, #0891b2, #14b8a6);
            border-color: transparent;
            color: white;
            transform: translateY(-2px);
        }
        
        /* Alert Animation */
        .alert {
            animation: slideIn 0.3s ease;
            border-radius: 16px;
            border: none;
        }
        
        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                box-shadow: none;
            }
            
            .admin-sidebar.show {
                transform: translateX(0);
                box-shadow: 4px 0 20px rgba(0, 0, 0, 0.2);
            }
            
            .admin-content {
                margin-left: 0;
            }
            
            .sidebar-toggle {
                display: block;
            }
            
            .admin-content-inner {
                padding: 1rem;
            }
            
            .user-info {
                display: none;
            }
        }
        
        /* Loading Spinner */
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid #e2e8f0;
            border-top: 3px solid #0891b2;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <div class="admin-sidebar" id="sidebar">
            <div class="sidebar-header text-center">
                <div class="sidebar-brand-icon">
                    <i class="bi bi-cpu"></i>
                </div>
                <div class="sidebar-brand">HealthCore i9 Ultra</div>
                <div class="sidebar-subtitle">Premium Healthcare Management</div>
            </div>
            
            <ul class="sidebar-menu">
                <li class="menu-label">MAIN MENU</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <span>Layanan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.doctors.index') }}" class="{{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge"></i>
                        <span>Dokter</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.bookings.index') }}" class="{{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check"></i>
                        <span>Booking</span>
                        @php
                            $pendingBookings = \App\Models\Booking::where('status', 'pending')->count();
                        @endphp
                        @if($pendingBookings > 0)
                            <span class="badge">{{ $pendingBookings }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.articles.index') }}" class="{{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                        <i class="bi bi-newspaper"></i>
                        <span>Artikel</span>
                    </a>
                </li>
                
                <li class="menu-label mt-3">SETTINGS</li>
                <li>
                    <a href="{{ route('admin.clinic-profile.edit') }}" class="{{ request()->routeIs('admin.clinic-profile.*') ? 'active' : '' }}">
                        <i class="bi bi-building"></i>
                        <span>Profil Klinik</span>
                    </a>
                </li>
                
                <li class="menu-label mt-3">SYSTEM</li>
                <li>
                    <a href="{{ route('landing') }}" target="_blank">
                        <i class="bi bi-eye"></i>
                        <span>Lihat Website</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="admin-content">
            <div class="admin-navbar">
                <div class="d-flex align-items-center gap-3">
                    <button class="sidebar-toggle" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="navbar-title">
                        <i class="bi bi-cpu text-primary"></i>
                        <span>HealthCore i9 Ultra</span> v2.0
                    </div>
                </div>
                
                <div class="user-dropdown">
                    <div class="d-flex align-items-center gap-3">
                        <div class="user-avatar">
                            <i class="bi bi-person-fill text-white"></i>
                        </div>
                        <div class="user-info">
                            <strong>{{ Auth::user()->name }}</strong>
                            <br>
                            <small class="text-muted">
                                <i class="bi bi-shield-check text-success"></i> 
                                {{ Auth::user()->role ?? 'Super Admin' }}
                            </small>
                        </div>
                        <i class="bi bi-chevron-down text-muted"></i>
                    </div>
                    <div class="user-dropdown-menu">
                        <div class="px-3 py-3 border-bottom">
                            <strong>{{ Auth::user()->name }}</strong>
                            <br>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </div>
                        <a href="#" class="dropdown-item-custom">
                            <i class="bi bi-person-circle"></i>
                            <span>My Profile</span>
                        </a>
                        <a href="#" class="dropdown-item-custom">
                            <i class="bi bi-shield-lock"></i>
                            <span>Change Password</span>
                        </a>
                        <div class="border-top mt-2 pt-2">
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item-custom text-danger">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="admin-content-inner">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill fs-5"></i>
                            <div>
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                            <div>
                                <strong>Error!</strong> {{ session('error') }}
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Toggle
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
            
            // Close sidebar on click outside (mobile)
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (sidebar && sidebarToggle) {
                        if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                            sidebar.classList.remove('show');
                        }
                    }
                }
            });
        });
        
        // Global Confirm Delete Function
        function confirmDelete(formId, title = 'Apakah Anda yakin?', text = 'Data yang dihapus tidak dapat dikembalikan!') {
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#0891b2',
                confirmButtonText: '<i class="bi bi-trash me-1"></i> Ya, hapus!',
                cancelButtonText: '<i class="bi bi-x-circle me-1"></i> Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
        
        // Global Toast Notification
        function showToast(message, type = 'success') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            
            Toast.fire({
                icon: type,
                title: message
            });
        }
        
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });
        
        // Auto hide alert after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
        
        // Add active class to current menu
        const currentPath = window.location.pathname;
        document.querySelectorAll('.sidebar-menu li a').forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>