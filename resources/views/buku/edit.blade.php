<!-- Menggunakan layout utama dari layouts.app -->
@extends('layouts.app')

<!-- Menentukan judul halaman -->
@section('title', 'Edit Buku')

<!-- Konten utama halaman -->
@section('content')
<!-- Header dan breadcrumb untuk navigasi -->
<div class="mb-4">
    <h2 class="fw-bold">
        <i class="bi bi-pencil text-primary me-2"></i>Edit Buku
    </h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('buku.index') }}">Data Buku</a></li>
            <li class="breadcrumb-item active">Edit Buku</li>
        </ol>
    </nav>
</div>

<!-- Kartu untuk form pengeditan buku -->
<div class="card">
    <div class="card-body">
        <!-- Form untuk mengupdate data buku -->
        <form action="{{ route('buku.update', $buku->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Input untuk judul dan ISBN -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="judul" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                           id="judul" name="judul" value="{{ old('judul', $buku->judul) }}" required>
                    <!-- Pesan error untuk validasi judul -->
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="isbn" class="form-label">ISBN <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                           id="isbn" name="isbn" value="{{ old('isbn', $buku->isbn) }}" required>
                    <!-- Pesan error untuk validasi ISBN -->
                    @error('isbn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Input untuk penulis, tahun terbit, dan jumlah halaman -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="penulis_id" class="form-label">Penulis <span class="text-danger">*</span></label>
                    <select class="form-select @error('penulis_id') is-invalid @enderror" 
                            id="penulis_id" name="penulis_id" required>
                        <option value="">-- Pilih Penulis --</option>
                        <!-- Looping untuk opsi penulis -->
                        @foreach($penulis as $p)
                            <option value="{{ $p->id }}" 
                                {{ old('penulis_id', $buku->penulis_id) == $p->id ? 'selected' : '' }}>
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                    <!-- Pesan error untuk validasi penulis -->
                    @error('penulis_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" 
                           id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" 
                           min="1900" max="{{ date('Y') }}" required>
                    <!-- Pesan error untuk validasi tahun terbit -->
                    @error('tahun_terbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="jumlah_halaman" class="form-label">Jumlah Halaman <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('jumlah_halaman') is-invalid @enderror" 
                           id="jumlah_halaman" name="jumlah_halaman" value="{{ old('jumlah_halaman', $buku->jumlah_halaman) }}" 
                           min="1" required>
                    <!-- Pesan error untuk validasi jumlah halaman -->
                    @error('jumlah_halaman')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Input untuk harga -->
            <div class="mb-3">
                <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                       id="harga" name="harga" value="{{ old('harga', $buku->harga) }}" 
                       min="0" step="0.01" required>
                <!-- Pesan error untuk validasi harga -->
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input untuk sinopsis -->
            <div class="mb-3">
                <label for="sinopsis" class="form-label">Sinopsis</label>
                <textarea class="form-control @error('sinopsis') is-invalid @enderror" 
                          id="sinopsis" name="sinopsis" rows="4">{{ old('sinopsis', $buku->sinopsis) }}</textarea>
                <!-- Pesan error untuk validasi sinopsis -->
                @error('sinopsis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol untuk submit form dan batal -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Update
                </button>
                <a href="{{ route('buku.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection