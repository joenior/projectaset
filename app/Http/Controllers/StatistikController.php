<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\Ruangan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StatistikController extends Controller
{
    public function index()
    {
        $barang = Barang::selectRaw('YEAR(tanggal) as tahun, COUNT(*) as total')
                    ->groupBy('tahun')
                    ->get();

        $chart = new \stdClass();
        $chart->type    = 'line';
        $chart->labels  = $barang->pluck('tahun');
        $chart->data    = $barang->pluck('total');

        // Pie Statistik Kategori
        $kategori = Kategori::all();

        $pieChart = new \stdClass();
        $pieChart->labels = $kategori->pluck('nama');
        $pieChart->data   = $kategori->map(function($k) {
            return $k->barangs->count();
        });

        // Pie Statistik Gedung
        $gedung = Gedung::select('nama_gedung', DB::raw('(SELECT COUNT(*) FROM barangs WHERE gedung_id = gedungs.id) as total'))
                    ->get();

        $gedungChart = new \stdClass();
        $gedungChart->type      = 'pie';
        $gedungChart->labels    = $gedung->pluck('nama_gedung');
        $gedungChart->data      = $gedung->pluck('total');

        // Pie Statistik Lantai
        $lantai = Lantai::select('nama_lantai', DB::raw('(SELECT COUNT(*) FROM barangs WHERE lantai_id = lantais.id) as total'))
                    ->get();

        $lantaiChart = new \stdClass();
        $lantaiChart->type      = 'pie';
        $lantaiChart->labels    = $lantai->pluck('nama_lantai');
        $lantaiChart->data      = $lantai->pluck('total');

        // Pie Statistik Ruangan
        $ruangan = Ruangan::select('nama_ruangan', DB::raw('(SELECT COUNT(*) FROM barangs WHERE ruangan_id = ruangans.id) as total'))
                    ->get();

        $ruanganChart = new \stdClass();
        $ruanganChart->type      = 'pie';
        $ruanganChart->labels    = $ruangan->pluck('nama_ruangan');
        $ruanganChart->data      = $ruangan->pluck('total');

        // Total Harga Statistik
        $totalHarga = DB::table('barangs')
            ->selectRaw('YEAR(tanggal) AS tahun, SUM(harga) AS totalHarga')
            ->groupBy('tahun')
            ->get();

        $keuanganChart = new \stdClass();
        $keuanganChart->type      = 'pie';
        $keuanganChart->labels    = $totalHarga->pluck('tahun');
        $keuanganChart->data      = $totalHarga->pluck('totalHarga');

        return view('statistik.index', [
            'chart'         => $chart,
            'pieChart'      => $pieChart,
            'kategori'      => $kategori,
            'gedungChart'   => $gedungChart,
            'gedung'        => $gedung,
            'lantaiChart'   => $lantaiChart,
            'lantai'        => $lantai,
            'ruanganChart'  => $ruanganChart,
            'ruangan'       => $ruangan,
            'keuanganChart' => $keuanganChart,
        ]);
    }
}