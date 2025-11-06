@extends('layout')

@section('title', 'Edit Dosen')

@section('content')
    <form action="{{ route('dosens.update', $dosen->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $dosen->nama) }}">
            @error('nama') <div class="error">{{ $message }}</div> @enderror
        </div>
        
        <div>
            <label for="nip">NIP:</label>
            <input type="text" id="nip" name="nip" value="{{ old('nip', $dosen->nip) }}">
            @error('nip') <div class="error">{{ $message }}</div> @enderror
        </div>
        
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $dosen->email) }}">
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>
        
        <div>
            <label for="bidang_keahlian">Bidang Keahlian:</label>
            <input type="text" id="bidang_keahlian" name="bidang_keahlian" value="{{ old('bidang_keahlian', $dosen->bidang_keahlian) }}">
            @error('bidang_keahlian') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Update</button>
    </form>
@endsection