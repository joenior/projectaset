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
use App\Models\Pengadaan;

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
            'subdivisi_id'   => 'required',
            'umur_ekonomis' => 'required|numeric|min:1'
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
            'subdivisi_id'   => 'required',
            'umur_ekonomis' => 'required|numeric|min:1'
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

    public function createFromPengadaan(Request $request)
    {
        $pengadaan = Pengadaan::findOrFail($request->pengadaan_id);
        $kategoris = Kategori::all();
        $gedungs = Gedung::all();
        $lantais = Lantai::all();
        $ruangans = Ruangan::all();
        $satuans = Satuan::all();
        $subkategoris = Subkategori::all();
        $subdivisis = Subdivisi::all();

        return view('barang.create', [
            'pengadaan' => $pengadaan,
            'kategoris' => $kategoris,
            'gedungs'   => $gedungs,
            'lantais'   => $lantais,
            'ruangans'  => $ruangans,
            'satuans'   => $satuans,
            'subkategoris' => $subkategoris,
            'subdivisis' => $subdivisis
        ]);
    }

    public function storeFromPengadaan($id)
    {
        \Log::info("storeFromPengadaan dipanggil untuk ID: " . $id);

        $pengadaan = Pengadaan::findOrFail($id);

        $barang = new Barang();
        $barang->nama = $pengadaan->nama_pengadaan;
        $barang->quantity = $pengadaan->quantity;
        $barang->unit = $pengadaan->unit;
        $barang->gedung_id = $pengadaan->gedung_id;
        $barang->lantai_id = $pengadaan->lantai_id;
        $barang->ruangan_id = $pengadaan->ruangan_id;
        $barang->deskripsi = $pengadaan->deskripsi;
        $barang->user_id = auth()->user()->id;

        // Validasi relasi
        if (!$pengadaan->kategori_id || !$pengadaan->subkategori_id || !$pengadaan->subdivisi_id || !$pengadaan->satuan_id) {
            \Log::error("Validasi gagal untuk ID: " . $id);
            return redirect()->back()->withErrors(['msg' => 'Kategori, Subkategori, Subdivisi, atau Satuan tidak valid.']);
        }

        $barang->kategori_id = $pengadaan->kategori_id;
        $barang->subkategori_id = $pengadaan->subkategori_id;
        $barang->subdivisi_id = $pengadaan->subdivisi_id;
        $barang->satuan_id = $pengadaan->satuan_id;

        $barang->save();

        Alert::success('Berhasil', 'Barang berhasil ditambahkan dari pengadaan yang disetujui.');
        return redirect('/barang');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids) {
            Barang::whereIn('id', $ids)->delete();
            return redirect()->route('barang.index')->with('success', 'Barang terpilih berhasil dihapus.');
        }
        return redirect()->route('barang.index')->with('error', 'Tidak ada barang yang dipilih.');
    }

    public function calculateDepreciation($id)
    {
        $barang = Barang::find($id);
        $umurEkonomis = $barang->umur_ekonomis; 
        $penyusutanPerTahun = $barang->harga / $umurEkonomis;
        $tahunBerjalan = now()->year - $barang->tanggal->year;

        // Tambahkan log untuk debugging
        \Log::info("Harga Barang: {$barang->harga}");
        \Log::info("Umur Ekonomis: {$umurEkonomis}");
        \Log::info("Penyusutan Per Tahun: {$penyusutanPerTahun}");
        \Log::info("Tahun Berjalan: {$tahunBerjalan}");
        \Log::info("Tanggal Barang: {$barang->tanggal}");

        $penyusutan = $penyusutanPerTahun * $tahunBerjalan;

        $barang->penyusutan = $penyusutan;
        $barang->save();

        return redirect()->route('barang.show', $id)->with('success', 'Penyusutan berhasil dihitung.');
    }
}