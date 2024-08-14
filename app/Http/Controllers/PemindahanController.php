<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\Ruangan;
use App\Models\RiwayatPemindahan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PemindahanController extends Controller
{
    public function create($id)
    {
        $barang = Barang::findOrFail($id);
        $gedungs = Gedung::all();
        $lantais = Lantai::all();
        $ruangans = Ruangan::all();

        return view('pemindahan.create', compact('barang', 'gedungs', 'lantais', 'ruangans'));
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'gedung_id' => 'required',
            'lantai_id' => 'required',
            'ruangan_id' => 'required',
        ]);

        $barang = Barang::findOrFail($id);

        RiwayatPemindahan::create([
            'barang_id' => $barang->id,
            'gedung_id' => $validated['gedung_id'],
            'lantai_id' => $validated['lantai_id'],
            'ruangan_id' => $validated['ruangan_id'],
            'previous_gedung_id' => $barang->gedung_id,
            'previous_lantai_id' => $barang->lantai_id,
            'previous_ruangan_id' => $barang->ruangan_id,
            'tanggal_pemindahan' => now(),
        ]);

        $barang->update($validated);

        Alert::success('Berhasil', 'Berhasil Memindahkan Lokasi Barang');
        return redirect('/barang');
    }

    public function index()
    {
        $riwayatPemindahans = RiwayatPemindahan::with(['barang', 'gedung', 'lantai', 'ruangan', 'previousGedung', 'previousLantai', 'previousRuangan'])->get();

        return view('pemindahan.index', compact('riwayatPemindahans'));
    }
}