<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lokasi;
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
            'lokasis'   => Lokasi::all(),
            'barangs'   => $barangs
        ]);
    }
}