@extends('layout')

@section('title', 'Edit Proyek')

@section('content')
    <form action="{{ route('proyeks.update', $proyek->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div>
            <label for="judul">Judul Proyek:</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $proyek->judul) }}">
            @error('judul') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $proyek->deskripsi) }}</textarea>
            @error('deskripsi') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="mahasiswa_id">Mahasiswa:</label>
            <select name="mahasiswa_id" id="mahasiswa_id">
                <option value="">Pilih Mahasiswa</option>
                @foreach ($mahasiswas as $mahasiswa)
                    <option value="{{ $mahasiswa->id }}" {{ old('mahasiswa_id', $proyek->mahasiswa_id) == $mahasiswa->id ? 'selected' : '' }}>
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
                    <option value="{{ $dosen->id }}" {{ old('dosen_id', $proyek->dosen_id) == $dosen->id ? 'selected' : '' }}>
                        {{ $dosen->nama }}
                    </option>
                @endforeach
            </select>
            @error('dosen_id') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="pending" {{ old('status', $proyek->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="on-progress" {{ old('status', $proyek->status) == 'on-progress' ? 'selected' : '' }}>On Progress</option>
                <option value="completed" {{ old('status', $proyek->status) == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            @error('status') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="dokumen">Dokumen (Kosongkan jika tidak ingin diubah):</label>
            @if ($proyek->dokumen)
                <p>Dokumen saat ini: <a href="{{ Storage::url($proyek->dokumen) }}" target="_blank">Lihat Dokumen</a></p>
            @endif
            <input type="file" id="dokumen" name="dokumen">
            @error('dokumen') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Update</button>
    </form>
@endsection