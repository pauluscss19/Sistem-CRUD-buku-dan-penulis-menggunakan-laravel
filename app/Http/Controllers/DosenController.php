<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::all();
        return view('dosens.index', compact('dosens'));
    }

    public function create()
    {
        return view('dosens.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:dosens',
            'email' => 'required|email|unique:dosens',
            'bidang_keahlian' => 'required|string',
        ]);

        Dosen::create($validated);
        return redirect()->route('dosens.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function show(Dosen $dosen)
    {
        return view('dosens.show', compact('dosen'));
    }

    public function edit(Dosen $dosen)
    {
        return view('dosens.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:dosens,nip,' . $dosen->id,
            'email' => 'required|email|unique:dosens,email,' . $dosen->id,
            'bidang_keahlian' => 'required|string',
        ]);

        $dosen->update($validated);
        return redirect()->route('dosens.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dosens.index')->with('success', 'Data dosen berhasil dihapus.');
    }
}