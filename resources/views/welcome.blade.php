<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengelolaan Data Peserta Sertifikasi</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .hero-section {
            background: linear-gradient(135deg, #4083e7 0%, #4658fc 100%);
            color: white;
            padding: 100px 0;
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 50%;
            backdrop-filter: blur(5px);
        }

        .feature-card {
            transition: transform 0.3s ease;
            border: none;
            border-radius: 15px;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>

    <!-- Navbar / Menu Atas -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-mortarboard-fill me-2"></i> LSP JWD
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-2">
                    <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fitur">Tentang & Fitur</a></li>
                    <div class="d-flex justify-content-center gap-3">
                        @auth
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('dashboard') }}"
                                    class="btn btn-light text-primary fw-semibold px-3">Dashboard Admin</a>
                            @else
                                <a href="{{ route('dashboard.user') }}"
                                    class="btn btn-light text-primary fw-semibold px-3">Dashboard Peserta</a>
                            @endif

                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light px-3">Login</a>
                            <a href="{{ route('register') }}"
                                class="btn btn-light text-primary fw-semibold px-3">Register</a>
                        @endauth
                    </div>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section (Banner Utama) -->
    <header class="hero-section text-center mt-5">
        <div class="container">
            <div class="logo-circle mb-4 mx-auto shadow-sm">
                <i class="bi bi-mortarboard-fill fs-2"></i>
            </div>
            <h1 class="fw-bold display-5 mb-3">Sistem Pengelolaan Data Peserta Sertifikasi</h1>
            <p class="lead mb-4 mx-auto" style="max-width: 700px;">
                Platform resmi Lembaga Sertifikasi Profesi (LSP) untuk memudahkan manajemen data peserta ujian, master
                data skema sertifikasi, serta pencatatan yang terintegrasi.
            </p>
            <div class="d-flex justify-content-center gap-3">
                @auth
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="btn btn-light text-primary fw-semibold px-3">Dashboard
                            Admin</a>
                    @else
                        <a href="{{ route('dashboard.user') }}"
                            class="btn btn-light text-primary fw-semibold px-3">Dashboard Peserta</a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light px-3">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-light text-primary fw-semibold px-3">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Section Penjelasan Fitur Website -->
    <section id="fitur" class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark">Fitur Utama Sistem</h2>
                <p class="text-muted">Keunggulan dan modul yang tersedia di dalam aplikasi pengelolaan sertifikasi ini.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card shadow-sm p-4 h-100 bg-white">
                        <div class="text-primary mb-3 fs-1">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <h4 class="fw-bold fs-5">Autentikasi Aman</h4>
                        <p class="text-muted small mb-0">Sistem proteksi login dan registrasi berbasis sesi untuk
                            memastikan hanya administrator terverifikasi yang dapat mengelola data.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card shadow-sm p-4 h-100 bg-white">
                        <div class="text-primary mb-3 fs-1">
                            <i class="bi bi-journal-code"></i>
                        </div>
                        <h4 class="fw-bold fs-5">Manajemen Skema</h4>
                        <p class="text-muted small mb-0">Kelola master data skema sertifikasi (KKNI, Klaster, Okupasi,
                            dan Unit Kompetensi) secara terstruktur dan terstandar.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card shadow-sm p-4 h-100 bg-white">
                        <div class="text-primary mb-3 fs-1">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h4 class="fw-bold fs-5">Pengolahan Data Peserta</h4>
                        <p class="text-muted small mb-0">Fitur CRUD lengkap untuk peserta ujian, dilengkapi validasi
                            input form yang ketat serta relasi data otomatis dengan tabel skema.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">
            <p class="mb-1 fw-semibold">Sistem Pengelolaan Data Peserta Sertifikasi</p>
            <p class="text-white-50 small mb-0">Uji Kompetensi Keahlian (UKK) / USK Skema Junior Web Developer</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
