<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use App\Models\Subdivisi;
use App\Models\Subkategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SubkategoriController;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $satuans = Satuan::with('subdivisi')->get();
        return view('satuan.index', compact('satuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subkategoris = Subkategori::all();
        $subdivisis = Subdivisi::all();
        return view('satuan.create', compact('subkategoris', 'subdivisis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'subdivisi_id' => 'required|exists:subdivisis,id',
        ]);

        $validated['user_id'] = auth()->user()->id;

        Satuan::create($validated);
        Alert::success('Berhasil', 'Berhasil Menambahkan Unit Baru !');
        return redirect('/satuan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Satuan $satuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Satuan $satuan)
    {
        $subdivisis = Subdivisi::all();
        return view('satuan.edit', [
            'users'  => Auth::user(),
            'satuan' => $satuan,
            'subdivisis' => $subdivisis
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        \Log::info("Update dipanggil untuk ID: " . $id);

        $rules = [
            'nama' => 'required',
            'deskripsi' => 'required',
            'subdivisi_id' => 'required|exists:subdivisis,id',
        ];

        $validated = $request->validate($rules);

        $satuan = Satuan::findOrFail($id);
        $satuan->update($validated);

        Alert::success('Berhasil', 'Berhasil Mengedit Satuan');
        return redirect('/satuan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Satuan $satuan)
    {
        // Cek apakah satuan masih digunakan oleh barang
        if ($satuan->barangs()->exists()) {
            return redirect('/satuan')->with('error', 'Satuan ini tidak dapat dihapus karena masih digunakan oleh barang.');
        }

        $satuan->delete();
        Alert::success('Berhasil', 'Berhasil menghapus Satuan');
        return redirect('/satuan');
    }
}