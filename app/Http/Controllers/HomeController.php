<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\Kategori;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userLogin = auth()->user()->roles;

        if($userLogin == 'admin'){
            $barang = Barang::selectRaw('YEAR(tanggal) as tahun, COUNT(*) as total')
                        ->groupBy('tahun')
                        ->get();
        } else {
            $barang = collect(); // Inisialisasi $barang sebagai koleksi kosong jika bukan admin
        }

        $chart = new \stdClass();
        $chart->type    = 'bar';
        $chart->labels  = $barang->pluck('tahun');
        $chart->data    = $barang->pluck('total');

        $countBarang    = Barang::all()->count();
        $countGedung    = Gedung::all()->count();
        $countLantai    = Lantai::all()->count();
        $countRuangan   = Ruangan::all()->count();
        $countKategori  = Kategori::all()->count();
        $countUsers     = User::all()->count();
        return view('/home', [
            'users'         => Auth::user(),
            'chart'         => $chart,
            'countBarang'   => $countBarang,
            'countGedung'   => $countGedung,
            'countLantai'   => $countLantai,
            'countRuangan'  => $countRuangan,
            'countKategori' => $countKategori,
            'countUsers'    => $countUsers,
        ]);
    }
}