<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswas.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas',
            'email' => 'required|email|unique:mahasiswas',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:1024', // 1MB Max
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/fotos');
            $validated['foto'] = $path;
        }

        Mahasiswa::create($validated);
        return redirect()->route('mahasiswas.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswas.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswas.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas,nim,' . $mahasiswa->id,
            'email' => 'required|email|unique:mahasiswas,email,' . $mahasiswa->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:1024', // Boleh null saat update
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($mahasiswa->foto) {
                Storage::delete($mahasiswa->foto);
            }
            $path = $request->file('foto')->store('public/fotos');
            $validated['foto'] = $path;
        }

        $mahasiswa->update($validated);
        return redirect()->route('mahasiswas.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        // Hapus foto dari storage
        if ($mahasiswa->foto) {
            Storage::delete($mahasiswa->foto);
        }
        
        $mahasiswa->delete();
        return redirect()->route('mahasiswas.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}