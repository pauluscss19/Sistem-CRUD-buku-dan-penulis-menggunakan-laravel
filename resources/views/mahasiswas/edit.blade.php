@extends('layout')

@section('title', 'Edit Mahasiswa')

@section('content')
    <form action="{{ route('mahasiswas.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}">
            @error('nama') <div class="error">{{ $message }}</div> @enderror
        </div>
        
        <div>
            <label for="nim">NIM:</label>
            <input type="text" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}">
            @error('nim') <div class="error">{{ $message }}</div> @enderror
        </div>
        
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $mahasiswa->email) }}">
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>
        
        <div>
            <label for="foto">Foto (Kosongkan jika tidak ingin diubah):</label>
            @if ($mahasiswa->foto)
                <img src="{{ Storage::url($mahasiswa->foto) }}" alt="Foto" width="100">
            @endif
            <input type="file" id="foto" name="foto">
            @error('foto') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Update</button>
    </form>
@endsection