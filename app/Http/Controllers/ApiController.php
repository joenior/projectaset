<?php

namespace App\Http\Controllers;

use App\Models\Subkategori;
use App\Models\Subdivisi;
use App\Models\Satuan;
use App\Models\Lantai;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getSubkategori($kategoriId)
    {
        try {
            $subkategoris = Subkategori::where('kategori_id', $kategoriId)->get();
            return response()->json($subkategoris);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getSubdivisi($subkategoriId)
    {
        return Subdivisi::where('subkategori_id', $subkategoriId)->get();
    }

    public function getSatuan($subdivisiId)
    {
        return Satuan::where('subdivisi_id', $subdivisiId)->get();
    }

    public function getLantai($gedungId)
    {
        return Lantai::where('gedung_id', $gedungId)->get();
    }

    public function getRuangan($lantaiId)
    {
        return Ruangan::where('lantai_id', $lantaiId)->get();
    }
}