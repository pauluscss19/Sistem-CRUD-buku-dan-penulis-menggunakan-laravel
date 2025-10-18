<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Mengatur pengkodean karakter dan responsivitas untuk tampilan di berbagai perangkat -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Menentukan judul halaman dengan fallback default jika tidak ditentukan -->
    <title>@yield('title', 'Sistem Manajemen Buku & Penulis')</title>
    
    <!-- Mengimpor Bootstrap CSS untuk desain responsif -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Mengimpor Bootstrap Icons untuk ikon visual -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Gaya kustom untuk sidebar, navbar, kartu, dan tombol dengan efek gradien dan transisi -->
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
        }
        .navbar-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #5568d3 0%, #6a3f8f 100%);
        }
    </style>
</head>
<body>
    <!-- Navbar utama untuk navigasi situs -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <!-- Logo dan nama aplikasi -->
            <a class="navbar-brand fw-bold" href="/">
                <i class="bi bi-book-half me-2"></i>Sistem Manajemen Buku
            </a>
            <!-- Tombol toggler untuk menu responsif di perangkat kecil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menu navigasi untuk halaman Buku dan Penulis -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('buku.index') }}">
                            <i class="bi bi-book me-1"></i>Buku
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('penulis.index') }}">
                            <i class="bi bi-people me-1"></i>Penulis
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Layout utama dengan struktur dua kolom (sidebar dan konten utama) -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar untuk navigasi tambahan, hanya tampil di layar besar -->
            <div class="col-md-2 sidebar d-none d-md-block p-0">
                <div class="p-3">
                    <h5 class="text-white mb-4 mt-3">Menu</h5>
                    <!-- Navigasi sidebar untuk Data Buku dan Data Penulis -->
                    <nav class="nav flex-column">
                        <a class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }}" href="{{ route('buku.index') }}">
                            <i class="bi bi-book me-2"></i>Data Buku
                        </a>
                        <a class="nav-link {{ request()->routeIs('penulis.*') ? 'active' : '' }}" href="{{ route('penulis.index') }}">
                            <i class="bi bi-people me-2"></i>Data Penulis
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Area konten utama -->
            <div class="col-md-10 p-4">
                <!-- Menampilkan pesan sukses jika ada -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Menampilkan pesan error jika ada -->
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Placeholder untuk konten spesifik dari halaman lain -->
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Mengimpor Bootstrap JS untuk fungsionalitas interaktif seperti toggler dan alert -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Placeholder untuk script tambahan dari halaman lain -->
    @yield('scripts')
</body>
</html>