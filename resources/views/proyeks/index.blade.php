@extends('layout')

@section('title', 'Data Proyek')

@section('content')
    <a href="{{ route('proyeks.create') }}">Tambah Proyek Baru</a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Mahasiswa (NIM)</th>
                <th>Dosen Pembimbing</th>
                <th>Status</th>
                <th>Dokumen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($proyeks as $proyek)
                <tr>
                    <td>{{ $proyek->id }}</td>
                    <td>{{ $proyek->judul }}</td>
                    <td>{{ $proyek->mahasiswa->nama ?? 'N/A' }} ({{ $proyek->mahasiswa->nim ?? 'N/A' }})</td>
                    <td>{{ $proyek->dosen->nama ?? 'N/A' }}</td>
                    <td>{{ $proyek->status }}</td>
                    <td>
                        @if ($proyek->dokumen)
                            <a href="{{ Storage::url($proyek->dokumen) }}" target="_blank">Lihat Dokumen</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('proyeks.edit', $proyek->id) }}">Edit</a>
                        <form action="{{ route('proyeks.destroy', $proyek->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data proyek.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection