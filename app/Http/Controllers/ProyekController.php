<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProyekController extends Controller
{
    public function index()
    {
        // Ambil data proyek beserta relasi mahasiswa dan dosen
        $proyeks = Proyek::with(['mahasiswa', 'dosen'])->get();
        return view('proyeks.index', compact('proyeks'));
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        return view('proyeks.create', compact('mahasiswas', 'dosens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'mahasiswa_id' => 'required|exists:mahasiswas,id|unique:proyeks,mahasiswa_id', // Mahasiswa hanya boleh punya 1 proyek
            'dosen_id' => 'required|exists:dosens,id',
            'status' => 'required|string',
            'dokumen' => 'required|file|mimes:pdf,docx|max:2048', // 2MB Max
        ]);

        if ($request->hasFile('dokumen')) {
            $path = $request->file('dokumen')->store('public/dokumens');
            $validated['dokumen'] = $path;
        }

        Proyek::create($validated);
        return redirect()->route('proyeks.index')->with('success', 'Data proyek berhasil ditambahkan.');
    }
    
    public function show(Proyek $proyek)
    {
        return view('proyeks.show', compact('proyek'));
    }

    public function edit(Proyek $proyek)
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        return view('proyeks.edit', compact('proyek', 'mahasiswas', 'dosens'));
    }

    public function update(Request $request, Proyek $proyek)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'mahasiswa_id' => 'required|exists:mahasiswas,id|unique:proyeks,mahasiswa_id,' . $proyek->id,
            'dosen_id' => 'required|exists:dosens,id',
            'status' => 'required|string',
            'dokumen' => 'nullable|file|mimes:pdf,docx|max:2048', // Boleh null saat update
        ]);

        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama jika ada
            if ($proyek->dokumen) {
                Storage::delete($proyek->dokumen);
            }
            $path = $request->file('dokumen')->store('public/dokumens');
            $validated['dokumen'] = $path;
        }

        $proyek->update($validated);
        return redirect()->route('proyeks.index')->with('success', 'Data proyek berhasil diperbarui.');
    }

    public function destroy(Proyek $proyek)
    {
        // Hapus dokumen dari storage
        if ($proyek->dokumen) {
            Storage::delete($proyek->dokumen);
        }
        
        $proyek->delete();
        return redirect()->route('proyeks.index')->with('success', 'Data proyek berhasil dihapus.');
    }
}