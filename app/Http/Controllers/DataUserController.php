<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lokasi;
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
            'lokasis'   => Lokasi::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('datauser.create', [
             'users'     => Auth::user(),
             'lokasis'   => Lokasi::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6',
            'lokasi_id' => 'nullable|exists:lokasis,id'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['roles'] = 'admin'; 

        User::create($validated);
        Alert::success('Berhasil', 'Berhasil Menambahkan User Baru');
        return redirect('/datauser');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('datauser.edit', [
            'users'     => Auth::user(),
            'user'      => User::findOrFail($id),
            'lokasis'   => Lokasi::all()
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
            'lokasi_id' => 'nullable|exists:lokasis,id',
        ]);
    
        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->lokasi_id = $validatedData['lokasi_id'];
    
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