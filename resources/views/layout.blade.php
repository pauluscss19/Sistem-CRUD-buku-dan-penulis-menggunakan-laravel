<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Proyek')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        nav { margin-bottom: 20px; }
        nav a { margin-right: 15px; text-decoration: none; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; }
        .alert-success { color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; }
        .alert-danger { color: #a94442; background-color: #f2dede; border-color: #ebccd1; }
        form div { margin-bottom: 15px; }
        form label { display: block; margin-bottom: 5px; }
        form input, form textarea, form select { width: 100%; padding: 8px; box-sizing: border-box; }
        .error { color: red; font-size: 0.9em; }
    </style>
</head>
<body>

    <nav>
        <a href="{{ route('mahasiswas.index') }}">Mahasiswa</a>
        <a href="{{ route('dosens.index') }}">Dosen</a>
        <a href="{{ route('proyeks.index') }}">Proyek</a>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>@yield('title')</h1>
        
        @yield('content')
    </div>

</body>
</html>