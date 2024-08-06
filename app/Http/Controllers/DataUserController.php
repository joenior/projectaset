<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DataUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('datauser.index', [
            'users'     => Auth::user(),
            'datauser'  => User::all(),
            'gedungs'   => Gedung::all(),
            'lantais'   => Lantai::all(),
            'ruangans'  => Ruangan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('datauser.create', [
             'users'     => Auth::user(),
             'gedungs'   => Gedung::all(),
             'lantais'   => Lantai::all(),
             'ruangans'  => Ruangan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'gedung_id' => 'nullable|exists:gedungs,id',
            'lantai_id' => 'nullable|exists:lantais,id',
            'ruangan_id' => 'nullable|exists:ruangans,id',
        ]);

        $validatedData['password'] = bcrypt('password');

        User::create($validatedData);

        Alert::success('Berhasil', 'Berhasil Menambahkan Data User');
        return redirect('/datauser');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('datauser.edit', [
            'users'     => Auth::user(),
            'user'      => User::findOrFail($id),
            'gedungs'   => Gedung::all(),
            'lantais'   => Lantai::all(),
            'ruangans'  => Ruangan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'gedung_id' => 'nullable|exists:gedungs,id',
            'lantai_id' => 'nullable|exists:lantais,id',
            'ruangan_id' => 'nullable|exists:ruangans,id',
        ]);
    
        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->gedung_id = $validatedData['gedung_id'];
        $user->lantai_id = $validatedData['lantai_id'];
        $user->ruangan_id = $validatedData['ruangan_id'];
    
        $user->save();
    
        Alert::success('Berhasil', 'Berhasil Memperbarui Data User');
        return redirect('/datauser');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $userDelete = User::where('id', $id)->firstOrFail();
        $userDelete->delete();

        Alert::success('Berhasil', 'Berhasil Menghapus User');
        return redirect('/datauser');
    }
}