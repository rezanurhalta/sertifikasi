<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengelolaan Data Peserta Sertifikasi</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    @auth
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            {{-- Brand / Logo menyesuaikan halaman berdasarkan role --}}
            @if(Auth::user()->role === 'admin')
                <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">LSP JWD - Admin</a>
            @else
                <a class="navbar-brand fw-bold" href="{{ route('dashboard.user') }}">LSP JWD - Peserta</a>
            @endif

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @if(Auth::user()->role === 'admin')
                        {{-- Menu Khusus Admin --}}
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('skema.index') }}">Data Skema</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('peserta.index') }}">Data Peserta</a></li>
                    @else
                        {{-- Menu Khusus Peserta / User --}}
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.user') }}">Dashboard Peserta</a></li>
                    @endif
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <span class="text-white fw-medium me-2">
                         {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-light btn-sm text-primary rounded-pill px-3 fw-semibold" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    <main class="container flex-1">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @yield('content')
    </main>

    <footer class="text-center py-3 bg-white border-top mt-auto text-muted small">
        &copy; {{ date('Y') }} LSP JWD - Aplikasi Pengelolaan Data Sertifikasi
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>