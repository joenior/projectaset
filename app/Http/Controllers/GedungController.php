<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class GedungController extends Controller
{
    public function index()
    {
        return view('gedung.index', [
            'users'  => Auth::user(),
            'gedungs' => Gedung::all()
        ]);
    }

    public function create()
    {
        return view('gedung.create', [
            'users' => Auth::user()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_gedung' => 'required',
            'deskripsi' => 'required'
        ]);

        $validated['user_id'] = auth()->user()->id;

        Gedung::create($validated);
        Alert::success('Berhasil', 'Berhasil Menambahkan Gedung !');
        return redirect('/gedung');
    }

    public function edit(Gedung $gedung)
    {
        return view('gedung.edit', [
            'users'  => Auth::user(),
            'gedung' => $gedung
        ]);
    }

    public function update(Request $request, Gedung $gedung)
    {
        $rules = [
            'nama_gedung' => 'required',
            'deskripsi' => 'required',
        ];

        $validated = $request->validate($rules);

        $validated['user_id'] = auth()->user()->id;

        Gedung::where('id', $gedung->id)
            ->update($validated);
        
        Alert::success('Berhasil !', 'Berhasil Mengedit Gedung');
        return redirect('/gedung');
    }

    public function destroy(Gedung $gedung)
    {
        Gedung::destroy($gedung->id);
        Alert::success('Berhasil', 'Berhasil Menghapus Gedung');
        return redirect('/gedung');
    }
}