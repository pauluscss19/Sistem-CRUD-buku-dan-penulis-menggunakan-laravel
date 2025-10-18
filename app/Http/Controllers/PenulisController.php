<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Http\Request;

class PenulisController extends Controller
{
    // Menampilkan daftar penulis dengan jumlah buku dan paginasi, diurutkan terbaru
    public function index()
    {
        $penulis = Penulis::withCount('buku')->latest()->paginate(10);
        return view('penulis.index', compact('penulis'));
    }

    // Menampilkan form untuk membuat penulis baru
    public function create()
    {
        return view('penulis.create');
    }

    // Menyimpan data penulis baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:penulis,email',
            'biografi' => 'nullable|string',
            'negara' => 'nullable|string|max:100'
        ]);

        Penulis::create($validated);

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil ditambahkan!');
    }

    // Menampilkan detail penulis beserta daftar bukunya
    public function show(Penulis $penuli)
    {
        $penuli->load('buku');
        return view('penulis.show', compact('penuli'));
    }

    // Menampilkan form untuk mengedit penulis
    public function edit(Penulis $penuli)
    {
        return view('penulis.edit', compact('penuli'));
    }

    // Memperbarui data penulis di database
    public function update(Request $request, Penulis $penuli)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:penulis,email,' . $penuli->id,
            'biografi' => 'nullable|string',
            'negara' => 'nullable|string|max:100'
        ]);

        $penuli->update($validated);

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil diperbarui!');
    }

    // Menghapus penulis dari database
    public function destroy(Penulis $penuli)
    {
        $penuli->delete();

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil dihapus!');
    }
}