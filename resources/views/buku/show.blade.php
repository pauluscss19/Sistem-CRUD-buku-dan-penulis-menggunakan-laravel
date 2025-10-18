<!-- Menggunakan layout utama dari layouts.app -->
@extends('layouts.app')

<!-- Menentukan judul halaman -->
@section('title', 'Detail Buku')

<!-- Konten utama halaman -->
@section('content')
<!-- Header dan breadcrumb untuk navigasi -->
<div class="mb-4">
    <h2 class="fw-bold">
        <i class="bi bi-info-circle text-primary me-2"></i>Detail Buku
    </h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('buku.index') }}">Data Buku</a></li>
            <li class="breadcrumb-item active">Detail Buku</li>
        </ol>
    </nav>
</div>

<!-- Kartu untuk menampilkan detail buku -->
<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Tabel untuk menampilkan informasi buku -->
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 30%;">Judul Buku</th>
                        <td>: {{ $buku->judul }}</td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: <span class="badge bg-secondary">{{ $buku->isbn }}</span></td>
                    </tr>
                    <tr>
                        <th>Penulis</th>
                        <td>: <a href="{{ route('penulis.show', $buku->penulis->id) }}" class="text-decoration-none">
                            {{ $buku->penulis->nama }}
                        </a></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: {{ $buku->tahun_terbit }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Halaman</th>
                        <td>: {{ $buku->jumlah_halaman }} halaman</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: <span class="fw-bold text-success">Rp {{ number_format($buku->harga, 0, ',', '.') }}</span></td>
                    </tr>
                    <tr>
                        <th>Ditambahkan</th>
                        <td>: {{ $buku->created_at->format('d F Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diubah</th>
                        <td>: {{ $buku->updated_at->format('d F Y, H:i') }}</td>
                    </tr>
                </table>

                <!-- Menampilkan sinopsis buku jika ada -->
                @if($buku->sinopsis)
                    <div class="mt-4">
                        <h5 class="fw-bold mb-3">Sinopsis</h5>
                        <p class="text-justify">{{ $buku->sinopsis }}</p>
                    </div>
                @endif
            </div>

            <!-- Kartu kecil untuk menampilkan ikon dan ringkasan buku -->
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <i class="bi bi-book display-1 text-primary mb-3"></i>
                        <h5 class="card-title">{{ $buku->judul }}</h5>
                        <p class="text-muted small">ISBN: {{ $buku->isbn }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol aksi untuk edit, hapus, dan kembali -->
        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-1"></i>Edit
            </a>
            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="d-inline" 
                  onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash me-1"></i>Hapus
                </button>
            </form>
            <a href="{{ route('buku.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>
</div>
@endsection