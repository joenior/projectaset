<?php

namespace App\Http\Controllers;

use App\Models\Subdivisi;
use App\Models\Subkategori;
use Illuminate\Http\Request;

class SubdivisiController extends Controller
{
    public function index()
    {
        $subdivisis = Subdivisi::all();
        return view('subdivisi.index', compact('subdivisis'));
    }

    public function create()
    {
        $subkategoris = Subkategori::all();
        return view('subdivisi.create', compact('subkategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'subkategori_id' => 'required|exists:subkategoris,id',
        ]);

        Subdivisi::create($validated);
        return redirect('/subdivisi')->with('success', 'Subdivisi berhasil ditambahkan');
    }

    public function edit(Subdivisi $subdivisi)
    {
        $subkategoris = Subkategori::all();
        return view('subdivisi.edit', compact('subdivisi', 'subkategoris'));
    }

    public function update(Request $request, Subdivisi $subdivisi)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'subkategori_id' => 'required|exists:subkategoris,id',
        ]);

        $subdivisi->update($validated);
        return redirect('/subdivisi')->with('success', 'Subdivisi berhasil diperbarui');
    }

    public function destroy(Subdivisi $subdivisi)
    {
        $subdivisi->delete();
        return redirect('/subdivisi')->with('success', 'Subdivisi berhasil dihapus');
    }
}