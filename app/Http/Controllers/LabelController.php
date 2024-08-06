<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LabelController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();

        return view('/label.index', [
            'users'     => Auth::user(),
            'gedungs'   => Gedung::all(),
            'lantais'   => Lantai::all(),
            'ruangans'  => Ruangan::all(),
            'barangs'   => $barangs
        ]);
    }
}