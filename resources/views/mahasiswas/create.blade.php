@extends('layout')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <form action="{{ route('mahasiswas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama') }}">
            @error('nama') <div class="error">{{ $message }}</div> @enderror
        </div>
        
        <div>
            <label for="nim">NIM:</label>
            <input type="text" id="nim" name="nim" value="{{ old('nim') }}">
            @error('nim') <div class="error">{{ $message }}</div> @enderror
        </div>
        
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>
        
        <div>
            <label for="foto">Foto (jpg, jpeg, png | max: 1MB):</label>
            <input type="file" id="foto" name="foto">
            @error('foto') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Simpan</button>
    </form>
@endsection