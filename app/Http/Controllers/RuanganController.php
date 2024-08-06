<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Lantai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RuanganController extends Controller
{
    public function index()
    {
        return view('ruangan.index', [
            'users'  => Auth::user(),
            'ruangans' => Ruangan::all()
        ]);
    }

    public function create()
    {
        return view('ruangan.create', [
            'users' => Auth::user(),
            'lantais' => Lantai::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required',
            'deskripsi' => 'required',
            'lantai_id' => 'required'
        ]);

        $validated['user_id'] = auth()->user()->id;

        Ruangan::create($validated);
        Alert::success('Berhasil', 'Berhasil Menambahkan Ruangan !');
        return redirect('/ruangan');
    }

    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.edit', [
            'users'  => Auth::user(),
            'ruangan' => $ruangan,
            'lantais' => Lantai::all()
        ]);
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $rules = [
            'nama_ruangan' => 'required',
            'deskripsi' => 'required',
            'lantai_id' => 'required'
        ];

        $validated = $request->validate($rules);

        $validated['user_id'] = auth()->user()->id;

        Ruangan::where('id', $ruangan->id)
            ->update($validated);
        
        Alert::success('Berhasil !', 'Berhasil Mengedit Ruangan');
        return redirect('/ruangan');
    }

    public function destroy(Ruangan $ruangan)
    {
        Ruangan::destroy($ruangan->id);
        Alert::success('Berhasil', 'Berhasil Menghapus Ruangan');
        return redirect('/ruangan');
    }
}