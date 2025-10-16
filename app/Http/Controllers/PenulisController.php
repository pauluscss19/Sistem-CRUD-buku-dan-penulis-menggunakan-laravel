<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Http\Request;

class PenulisController extends Controller
{
    public function index()
    {
        $penulis = Penulis::withCount('buku')->latest()->paginate(10);
        return view('penulis.index', compact('penulis'));
    }

    public function create()
    {
        return view('penulis.create');
    }

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

    public function show(Penulis $penuli)
    {
        $penuli->load('buku');
        return view('penulis.show', compact('penuli'));
    }

    public function edit(Penulis $penuli)
    {
        return view('penulis.edit', compact('penuli'));
    }

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

    public function destroy(Penulis $penuli)
    {
        $penuli->delete();

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil dihapus!');
    }
}