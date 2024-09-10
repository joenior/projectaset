<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Pengadaan;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Models\Statuspengadaan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Ramsey\Uuid\Uuid;

class PengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengadaan.index', [
            'users'      => Auth::user(),
            'pengadaans' => Pengadaan::leftJoinSub(
                                DB::table('statuspengadaans')
                                    ->select('pengadaan_id', DB::raw('MAX(created_at) as latest_created_at'))
                                    ->groupBy('pengadaan_id'),
                                'latest_status',
                                function ($join) {
                                    $join->on('pengadaans.id', '=', 'latest_status.pengadaan_id');
                                }
                            )
                                ->leftJoin('statuspengadaans', function ($join) {
                                    $join->on('latest_status.pengadaan_id', '=', 'statuspengadaans.pengadaan_id')
                                        ->on('latest_status.latest_created_at', '=', 'statuspengadaans.created_at');
                                })
                                ->select('pengadaans.*', 'statuspengadaans.status')
                                ->orderBy('created_at', 'desc')
                                ->get()
        ]);
    }

    public function create()
    {
        return view('pengadaan.create', [
            'users'   => Auth::user(),
            'gedungs' => Gedung::all(),
            'lantais' => Lantai::all(),
            'ruangans' => Ruangan::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengadaan.*' => 'required|string|max:255',
            'quantity.*' => 'required|integer',
            'unit.*' => 'required|string',
            'gedung_id' => 'required|exists:gedungs,id',
            'lantai_id' => 'required|exists:lantais,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'deskripsi' => 'required|string',
        ]);

        if (!is_array($request->nama_pengadaan)) {
            return redirect()->back()->withErrors(['msg' => 'Invalid input data.']);
        }

        foreach ($request->nama_pengadaan as $index => $nama_pengadaan) {
            $pengadaan = new Pengadaan();
            $pengadaan->nama_pengadaan = $nama_pengadaan;
            $pengadaan->quantity = $request->quantity[$index];
            $pengadaan->unit = $request->unit[$index];
            $pengadaan->gedung_id = $request->gedung_id;
            $pengadaan->lantai_id = $request->lantai_id;
            $pengadaan->ruangan_id = $request->ruangan_id;
            $pengadaan->deskripsi = $request->deskripsi;
            $pengadaan->tanggal_pengajuan = now();
            $pengadaan->user_id = $request->user_id;

            // Generate unique id_pengadaans using Ramsey\Uuid\Uuid
            $pengadaan->id_pengadaans = Uuid::uuid4()->toString();

            $pengadaan->save();

            $status = new Statuspengadaan;
            $status->status = 'pending';
            $status->pengadaan_id = $pengadaan->id;
            $status->save();
        }

        Alert::success('Berhasil', 'Berhasil Mengajukan Barang');
        return redirect('/pengadaan');
    }


    public function show($id)
    {
        return view('pengadaan.show', [
            'users'     => Auth::user(),
            'pengadaan' => Pengadaan::find($id),
            'status'    => Statuspengadaan::find($id)
        ]);
    }


    public function edit(Pengadaan $pengadaan)
    {
        return view('pengadaan.edit', [
            'users'     => Auth::user(),
            'pengadaan' => $pengadaan,
            'gedungs'   => Gedung::all(),
            'lantais'   => Lantai::all(),
            'ruangans'  => Ruangan::all(),
        ]);
    }

    public function update(Request $request, Pengadaan $pengadaan)
    {
        $rules = [
            'nama_pengadaan'    => 'required',
            'quantity'          => 'required|numeric',
            'deskripsi'         => 'required',
            'gedung_id'         => 'required',
            'lantai_id'         => 'required',
            'ruangan_id'        => 'required',
        ];

        $validated = $request->validate($rules);
        $validated['user_id'] = auth()->user()->id;

        $pengadaan->update($validated);

        Alert::success('Berhasil !', 'Berhasil Mengedit Pengajuan');
        return redirect('/pengadaan');   
    }


    public function destroy(Pengadaan $pengadaan)
    {
        $pengadaan->delete();
        Statuspengadaan::where('pengadaan_id', $pengadaan->id)->delete();

        Alert::success('Berhasil', 'Berhasil Menghapus Pengadaan');
        return redirect('/pengadaan');
    }


    public function approved()
    {
        $approvedPengadaans = Pengadaan::with('statuspengadaan')
            ->whereHas('statuspengadaan', function ($query) {
                $query->where('status', 'disetujui');
            })->get();

        return view('pengadaan.approved', [
            'users' => Auth::user(),
            'pengadaans' => $approvedPengadaans
        ]);
    }
}