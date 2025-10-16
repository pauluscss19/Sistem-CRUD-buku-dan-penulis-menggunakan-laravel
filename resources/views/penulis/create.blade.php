@extends('layouts.app')

@section('title', 'Tambah Penulis')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">
        <i class="bi bi-plus-circle text-primary me-2"></i>Tambah Penulis Baru
    </h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('penulis.index') }}">Data Penulis</a></li>
            <li class="breadcrumb-item active">Tambah Penulis</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('penulis.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label">Nama Penulis <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                           id="nama" name="nama" value="{{ old('nama') }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="negara" class="form-label">Negara</label>
                <input type="text" class="form-control @error('negara') is-invalid @enderror" 
                       id="negara" name="negara" value="{{ old('negara') }}">
                @error('negara')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="biografi" class="form-label">Biografi</label>
                <textarea class="form-control @error('biografi') is-invalid @enderror" 
                          id="biografi" name="biografi" rows="4">{{ old('biografi') }}</textarea>
                @error('biografi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Simpan
                </button>
                <a href="{{ route('penulis.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection