<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\User;
use App\Models\Barang;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\Kategori;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GrafikController extends Controller
{
    public function index()
    {
        $barang = Barang::selectRaw('YEAR(tanggal) as tahun, COUNT(*) as total')
                    ->groupBy('tahun')
                    ->get();

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