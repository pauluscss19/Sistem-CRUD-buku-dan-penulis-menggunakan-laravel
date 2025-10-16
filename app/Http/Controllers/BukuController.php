<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penulis;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::with('penulis')->latest()->paginate(10);
        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        $penulis = Penulis::all();
        return view('buku.create', compact('penulis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isbn' => 'required|string|unique:buku,isbn',
            'penulis_id' => 'required|exists:penulis,id',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'jumlah_halaman' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'sinopsis' => 'nullable|string'
        ]);

        Buku::create($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(Buku $buku)
    {
        $buku->load('penulis');
        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        $penulis = Penulis::all();
        return view('buku.edit', compact('buku', 'penulis'));
    }

    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isbn' => 'required|string|unique:buku,isbn,' . $buku->id,
            'penulis_id' => 'required|exists:penulis,id',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'jumlah_halaman' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'sinopsis' => 'nullable|string'
        ]);

        $buku->update($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}