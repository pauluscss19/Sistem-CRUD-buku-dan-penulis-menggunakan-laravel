@extends('layouts.app')

@section('title', 'Data Penulis')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">
        <i class="bi bi-people text-primary me-2"></i>Data Penulis
    </h2>
    <a href="{{ route('penulis.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>Tambah Penulis
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Nama Penulis</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 15%;">Negara</th>
                        <th style="width: 10%;">Jumlah Buku</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penulis as $item)
                        <tr>
                            <td>{{ $loop->iteration + ($penulis->currentPage() - 1) * $penulis->perPage() }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->negara ?? '-' }}</td>
                            <td>
                                <span class="badge bg-info">{{ $item->buku_count }} buku</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('penulis.show', $item->id) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('penulis.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('penulis.destroy', $item->id) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Yakin ingin menghapus penulis ini? Semua buku terkait akan ikut terhapus!')">
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
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data penulis
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $penulis->links() }}
        </div>
    </div>
</div>
@endsection