@extends('layout')

@section('title', 'Data Mahasiswa')

@section('content')
    <a href="{{ route('mahasiswas.create') }}">Tambah Mahasiswa Baru</a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswas as $mahasiswa)
                <tr>
                    <td>{{ $mahasiswa->id }}</td>
                    <td>
                        @if ($mahasiswa->foto)
                            <img src="{{ Storage::url($mahasiswa->foto) }}" alt="Foto" width="50">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $mahasiswa->nama }}</td>
                    <td>{{ $mahasiswa->nim }}</td>
                    <td>{{ $mahasiswa->email }}</td>
                    <td>
                        <a href="{{ route('mahasiswas.edit', $mahasiswa->id) }}">Edit</a>
                        <form action="{{ route('mahasiswas.destroy', $mahasiswa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection