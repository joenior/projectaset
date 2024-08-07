<?php

namespace App\Http\Controllers;

use App\Models\Subdivisi;
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
        return view('subdivisi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
        ]);

        Subdivisi::create($validated);
        return redirect('/subdivisi')->with('success', 'Subdivisi berhasil ditambahkan');
    }

    public function edit(Subdivisi $subdivisi)
    {
        return view('subdivisi.edit', compact('subdivisi'));
    }

    public function update(Request $request, Subdivisi $subdivisi)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
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