@extends('layouts.app')

@section('title', 'Data Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">
        <i class="bi bi-book text-primary me-2"></i>Data Buku
    </h2>
    <a href="{{ route('buku.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>Tambah Buku
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Judul Buku</th>
                        <th style="width: 15%;">ISBN</th>
                        <th style="width: 20%;">Penulis</th>
                        <th style="width: 10%;">Tahun</th>
                        <th style="width: 10%;">Harga</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($buku as $item)
                        <tr>
                            <td>{{ $loop->iteration + ($buku->currentPage() - 1) * $buku->perPage() }}</td>
                            <td>{{ $item->judul }}</td>
                            <td><span class="badge bg-secondary">{{ $item->isbn }}</span></td>
                            <td>{{ $item->penulis->nama }}</td>
                            <td>{{ $item->tahun_terbit }}</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('buku.show', $item->id) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('buku.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('buku.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data buku
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $buku->links() }}
        </div>
    </div>
</div>
@endsection