<?php

namespace App\Http\Controllers;

use App\Models\Lantai;
use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LantaiController extends Controller
{
    public function index()
    {
        return view('lantai.index', [
            'users'  => Auth::user(),
            'lantais' => Lantai::all()
        ]);
    }

    public function create()
    {
        return view('lantai.create', [
            'users' => Auth::user(),
            'gedungs' => Gedung::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lantai' => 'required',
            'deskripsi' => 'required',
            'gedung_id' => 'required'
        ]);

        $validated['user_id'] = auth()->user()->id;

        Lantai::create($validated);
        Alert::success('Berhasil', 'Berhasil Menambahkan Lantai !');
        return redirect('/lantai');
    }

    public function edit(Lantai $lantai)
    {
        return view('lantai.edit', [
            'users'  => Auth::user(),
            'lantai' => $lantai,
            'gedungs' => Gedung::all()
        ]);
    }

    public function update(Request $request, Lantai $lantai)
    {
        $rules = [
            'nama_lantai' => 'required',
            'deskripsi' => 'required',
            'gedung_id' => 'required'
        ];

        $validated = $request->validate($rules);

        $validated['user_id'] = auth()->user()->id;

        Lantai::where('id', $lantai->id)
            ->update($validated);
        
        Alert::success('Berhasil !', 'Berhasil Mengedit Lantai');
        return redirect('/lantai');
    }

    public function destroy(Lantai $lantai)
    {
        Lantai::destroy($lantai->id);
        Alert::success('Berhasil', 'Berhasil Menghapus Lantai');
        return redirect('/lantai');
    }
}