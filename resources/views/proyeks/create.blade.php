@extends('layout')

@section('title', 'Tambah Proyek')

@section('content')
    <form action="{{ route('proyeks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div>
            <label for="judul">Judul Proyek:</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul') }}">
            @error('judul') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="mahasiswa_id">Mahasiswa:</label>
            <select name="mahasiswa_id" id="mahasiswa_id">
                <option value="">Pilih Mahasiswa</option>
                @foreach ($mahasiswas as $mahasiswa)
                    <option value="{{ $mahasiswa->id }}" {{ old('mahasiswa_id') == $mahasiswa->id ? 'selected' : '' }}>
                        {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})
                    </option>
                @endforeach
            </select>
            @error('mahasiswa_id') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="dosen_id">Dosen Pembimbing:</label>
            <select name="dosen_id" id="dosen_id">
                <option value="">Pilih Dosen</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                        {{ $dosen->nama }}
                    </option>
                @endforeach
            </select>
            @error('dosen_id') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="on-progress" {{ old('status') == 'on-progress' ? 'selected' : '' }}>On Progress</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            @error('status') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="dokumen">Dokumen (pdf, docx | max: 2MB):</label>
            <input type="file" id="dokumen" name="dokumen">
            @error('dokumen') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Simpan</button>
    </form>
@endsection