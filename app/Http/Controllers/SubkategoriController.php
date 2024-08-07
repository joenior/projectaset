<?php

namespace App\Http\Controllers;

use App\Models\Subkategori;
use Illuminate\Http\Request;

class SubkategoriController extends Controller
{
    public function index()
    {
        $subkategories = Subkategori::all();
        return view('subkategori.index', compact('subkategories'));
    }

    public function create()
    {
        return view('subkategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
        ]);

        Subkategori::create($validated);
        return redirect('/subkategori')->with('success', 'Subkategori berhasil ditambahkan');
    }

    public function edit(Subkategori $subkategori)
    {
        return view('subkategori.edit', compact('subkategori'));
    }

    public function update(Request $request, Subkategori $subkategori)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $subkategori->update($validated);
        return redirect('/subkategori')->with('success', 'Subkategori berhasil diperbarui');
    }

    public function destroy(Subkategori $subkategori)
    {
        $subkategori->delete();
        return redirect('/subkategori')->with('success', 'Subkategori berhasil dihapus');
    }
}