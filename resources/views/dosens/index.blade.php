@extends('layout')

@section('title', 'Data Dosen')

@section('content')
    <a href="{{ route('dosens.create') }}">Tambah Dosen Baru</a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Email</th>
                <th>Bidang Keahlian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dosens as $dosen)
                <tr>
                    <td>{{ $dosen->id }}</td>
                    <td>{{ $dosen->nama }}</td>
                    <td>{{ $dosen->nip }}</td>
                    <td>{{ $dosen->email }}</td>
                    <td>{{ $dosen->bidang_keahlian }}</td>
                    <td>
                        <a href="{{ route('dosens.edit', $dosen->id) }}">Edit</a>
                        <form action="{{ route('dosens.destroy', $dosen->id) }}" method="POST" style="display:inline;">
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