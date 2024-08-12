<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'datauser'  => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = ['admin', 'user', 'auditor']; // Daftar roles yang tersedia

        return view('datauser.create', [
             'users' => Auth::user(),
             'roles' => $roles
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
            'Roles' => 'required'
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
        $roles = ['admin', 'user', 'auditor']; // Daftar roles yang tersedia

        return view('datauser.edit', [
            'users' => Auth::user(),
            'user'  => User::findOrFail($id),
            'roles' => $roles
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
            'Roles' => 'required'
        ]);
    
        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->Roles = $validatedData['Roles'];
    
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
    
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