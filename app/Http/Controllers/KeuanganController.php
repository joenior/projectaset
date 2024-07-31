<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Barang;
use App\Models\Lokasi;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hargaBarangs = Barang::all();

        return view('keuangan.index', [
            'users'             => Auth::user(),
            'hargaBarangs'      => $hargaBarangs,
            'lokasis'           => Lokasi::all(),
            'totalHarga'        => Barang::sum('harga'),
            'totalHargaUsaha'   => Barang::sum('harga')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cetakLaporanKeuangan()
    {
        $hargaBarangs = Barang::all();

        $logoInstansiPath = storage_path('app/public/logo-instansi/logo.png');
        $logoInstansi = base64_encode(file_get_contents($logoInstansiPath));

        $pdf = new Dompdf();
        $pdf = PDF::loadView('keuangan.laporan-keuangan', [
            'hargaBarangs'      => $hargaBarangs,
            'logoInstansi'      => $logoInstansi,
            'totalHarga'        => Barang::sum('harga'),
            'totalHargaUsaha'   => Barang::sum('harga')
        ]);

        return $pdf->download('laporan-keuangan.pdf');
    }
}