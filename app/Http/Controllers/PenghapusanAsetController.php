<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PenghapusanAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deletedBarangs = Barang::onlyTrashed()->get();

        return view('penghapusan-aset.index', [
            'users'          => Auth::user(),
            'deletedBarangs' => $deletedBarangs
        ]);
    }


    public function restore($id)
    {
        $barang = Barang::onlyTrashed()->where('id', $id);
        $barang->restore();
    
        Alert::success('Berhasil', 'Berhasil Mengembalikan Barang');
        return redirect('/penghapusan-aset');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $barang = Barang::onlyTrashed()->where('id', $id);
        $barang->forceDelete();

        Alert::success('Berhasil', 'Berhasil Menghapus Permanent Barang');
        return redirect('/penghapusan-aset');
    }
}