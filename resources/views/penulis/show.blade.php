@extends('layouts.app')

@section('title', 'Detail Penulis')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">
        <i class="bi bi-info-circle text-primary me-2"></i>Detail Penulis
    </h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('penulis.index') }}">Data Penulis</a></li>
            <li class="breadcrumb-item active">Detail Penulis</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="bi bi-person-circle display-1 text-primary"></i>
                </div>
                <h4 class="fw-bold">{{ $penuli->nama }}</h4>
                <p class="text-muted">{{ $penuli->email }}</p>
                @if($penuli->negara)
                    <p><i class="bi bi-geo-alt me-1"></i>{{ $penuli->negara }}</p>
                @endif
                <div class="mt-3">
                    <span class="badge bg-info fs-6">{{ $penuli->buku->count() }} Buku</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Informasi Penulis</h5>
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 30%;">Nama Lengkap</th>
                        <td>: {{ $penuli->nama }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: {{ $penuli->email }}</td>
                    </tr>
                    <tr>
                        <th>Negara</th>
                        <td>: {{ $penuli->negara ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Ditambahkan</th>
                        <td>: {{ $penuli->created_at->format('d F Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diubah</th>
                        <td>: {{ $penuli->updated_at->format('d F Y, H:i') }}</td>
                    </tr>
                </table>

                @if($penuli->biografi)
                    <div class="mt-3">
                        <h6 class="fw-bold">Biografi</h6>
                        <p class="text-justify">{{ $penuli->biografi }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-book me-2"></i>Daftar Buku</h5>
            </div>
            <div class="card-body">
                @if($penuli->buku->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>ISBN</th>
                                    <th>Tahun</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penuli->buku as $buku)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $buku->judul }}</td>
                                        <td><span class="badge bg-secondary">{{ $buku->isbn }}</span></td>
                                        <td>{{ $buku->tahun_terbit }}</td>
                                        <td>Rp {{ number_format($buku->harga, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                        Penulis ini belum memiliki buku
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <a href="{{ route('penulis.edit', $penuli->id) }}" class="btn btn-warning">
        <i class="bi bi-pencil me-1"></i>Edit
    </a>
    <form action="{{ route('penulis.destroy', $penuli->id) }}" method="POST" class="d-inline" 
          onsubmit="return confirm('Yakin ingin menghapus penulis ini? Semua buku terkait akan ikut terhapus!')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <i class="bi bi-trash me-1"></i>Hapus
        </button>
    </form>
    <a href="{{ route('penulis.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>
@endsection