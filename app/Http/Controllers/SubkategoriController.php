<?php

namespace App\Http\Controllers;

use App\Models\Subkategori;
use App\Models\Kategori;
use Illuminate\Http\Request;

class SubkategoriController extends Controller
{
    public function index()
    {
        $subkategories = Subkategori::with('kategori')->get();
        $kategoris = Kategori::all();
        return view('subkategori.index', compact('subkategories', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('subkategori.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        Subkategori::create($validated);
        return redirect('/subkategori')->with('success', 'Subkategori berhasil ditambahkan');
    }

    public function edit(Subkategori $subkategori)
    {
        $kategoris = Kategori::all();
        return view('subkategori.edit', compact('subkategori', 'kategoris'));
    }

    public function update(Request $request, Subkategori $subkategori)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $subkategori->update($validated);
        return redirect('/subkategori')->with('success', 'Subkategori berhasil diperbarui');
    }

    public function destroy(Subkategori $subkategori)
    {
        // Cek apakah subkategori masih digunakan oleh barang
        if ($subkategori->barangs()->exists()) {
            return redirect('/subkategori')->with('error', 'Subkategori ini tidak dapat dihapus karena masih digunakan oleh barang.');
        }

        $subkategori->delete();
        return redirect('/subkategori')->with('success', 'Subkategori berhasil dihapus');
    }
}