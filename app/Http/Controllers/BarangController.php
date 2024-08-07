<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\Ruangan;
use App\Models\Satuan;
use App\Models\Kategori;
use App\Models\Subkategori;
use App\Models\Subdivisi;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Dompdf\Dompdf;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::all();
        
        return view('barang.index', [
            'users'   => Auth::user(),
            'barangs' => $barangs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $kategoris = Kategori::all();
        $gedungs = Gedung::all();
        $lantais = Lantai::all();
        $ruangans = Ruangan::all();
        $satuans = Satuan::all();
        $subkategoris = Subkategori::all();
        $subdivisis = Subdivisi::all();

        return view('barang.create', [
            'users'     => Auth::user(),
            'kategoris' => $kategoris,
            'gedungs'   => $gedungs,
            'lantais'   => $lantais,
            'ruangans'  => $ruangans,
            'satuans'   => $satuans,
            'subkategoris' => $subkategoris,
            'subdivisis' => $subdivisis
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required',
            'deskripsi'     => 'required',
            'gambar'        => 'required|mimes:jpeg,png,jpg',
            'harga'         => 'required|numeric',
            'kategori_id'   => 'required',
            'gedung_id'     => 'required',
            'lantai_id'     => 'required',
            'ruangan_id'    => 'required',
            'satuan_id'     => 'required',
            'subkategori_id' => 'required',
            'subdivisi_id'   => 'required'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = $file->getClientOriginalName();
            Storage::disk('public')->put('gambar-barang/'.$fileName, file_get_contents($file));
            $validated['gambar'] = 'gambar-barang/'.$fileName;
        }
              
        // Generate kode_barang in the format A.01.01.01.0001
        $kategori = Kategori::find($validated['kategori_id']);
        $subkategori = Subkategori::find($validated['subkategori_id']);
        $subdivisi = Subdivisi::find($validated['subdivisi_id']);
        $satuan = Satuan::find($validated['satuan_id']);

        // Generate unique serial number
        $serial = str_pad(Barang::withTrashed()->max('id') + 1, 4, '0', STR_PAD_LEFT);

        $validated['kode_barang'] = $kategori->id_kategoris . '.' . $subkategori->id_subkategori . '.' . $subdivisi->id_subdivisi . '.' . $satuan->id_satuan . '.' . $serial;

        $qrCode = new QrCode($validated['kode_barang']);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $image = $result->getDataUri();
        Storage::disk('public')->put('qrcode-barang/'. $validated['kode_barang'] . '.png', file_get_contents($image));

        $validated['tanggal'] = now();
        $validated['user_id'] = auth()->user()->id;

        Barang::create($validated);
        Alert::success('Berhasil', 'Berhasil Menambahkan Barang !');
        return redirect('/barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        $qrCode = new QrCode($barang->kode_barang);
        return view('barang.show', [
            'users'     => Auth::user(),
            'barang'    => $barang,
            'qrCode'    => $qrCode
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        $gedungs = Gedung::all();
        $lantais = Lantai::all();
        $ruangans = Ruangan::all();
        $satuans = Satuan::all();
        $subkategoris = Subkategori::all();
        $subdivisis = Subdivisi::all();

        return view('barang.edit', [
            'users'     => Auth::user(),
            'barang'    => $barang,
            'kategoris' => $kategoris,
            'gedungs'   => $gedungs,
            'lantais'   => $lantais,
            'ruangans'  => $ruangans,
            'satuans'   => $satuans,
            'subkategoris' => $subkategoris,
            'subdivisis' => $subdivisis
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $rules = [
            'nama'          => 'required',
            'deskripsi'     => 'required',
            'gambar'        => 'image|file',
            'harga'         => 'required|numeric',
            'kategori_id'   => 'required',
            'gedung_id'     => 'required',
            'lantai_id'     => 'required',
            'ruangan_id'    => 'required',
            'satuan_id'     => 'required',
            'subkategori_id' => 'required',
            'subdivisi_id'   => 'required'
        ];

        $validated = $request->validate($rules);

        if($request->hasFile('gambar')){
            if($barang->gambar){
                Storage::delete($barang->gambar);
            }
            $file = $request->file('gambar');
            $fileName = $file->getClientOriginalName();
            Storage::disk('public')->put('gambar-barang/' .$fileName, file_get_contents($file));
            $validated['gambar'] = 'gambar-barang/' .$fileName;
        }

        $validated['user_id'] = auth()->user()->id;

        Barang::where('id', $barang->id)
            ->update($validated);
        
        Alert::success('Berhasil !', 'Berhasil Mengedit Barang');
        return redirect('/barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        Alert::success('Berhasil', 'Berhasil Menghapus Barang');
        return redirect('/barang');
    }

    public function cetakLabel(Barang $id)
    { 
        $barang = Barang::find($id->id);

        $qrCodePath = storage_path('app/public/qrcode-barang/' . $barang->kode_barang . '.png');
        $logoInstansiPath = storage_path('app/public/logo-instansi/logo.png');

        if (!file_exists($qrCodePath)) {
            // Handle the case where the QR code image does not exist
            abort(404, 'QR code image not found.');
        }

        $qrCode = base64_encode(file_get_contents($qrCodePath));
        $logoInstansi = base64_encode(file_get_contents($logoInstansiPath));

        $pdf = Pdf::loadView('barang.label', [
            'users'         => Auth::user(),
            'barang'        => $barang,
            'qrCode'        => $qrCode,
            'logoInstansi'  => $logoInstansi
        ]);

        return $pdf->stream('label.pdf');
    }
}