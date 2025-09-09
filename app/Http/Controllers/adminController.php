<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\admin;
use App\Models\siswa;
use App\Models\guru;

class adminController extends Controller
{
    //
    public function landing()
{
    $siswa = siswa::all();
    return view('landing', compact('siswa'));
}
  
public function formLogin()
{
    return view('login');
}


public function prosesLogin(Request $request)
{
    $admin = admin::where('username', $request->username)->first();

    if ($admin && Hash::check($request->password, $admin->password)) {
        // Simpan data ke dalam session
        session([
            'admin_id' => $admin->id,
            'admin_username' => $admin->username,
            'admin_role'=> $admin->role
        ]);

        return redirect()->route('home');
    }

    return back()->with('error', 'Username atau password salah.');
}

public function logout()
{
    // Hapus data session login
    session()->forget(['admin_id', 'admin_username', 'admin_role']);

    return redirect()->route('landing');
}

public function formRegister()
{
    return view('register');
}

public function prosesRegister(Request $request)
{
    try {
        $request->validate([
            'username' => 'required|string|max:50|unique:dataadmin,username',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,guru,siswa',
        ]);

        // Additional validation based on role
        if ($request->role == 'siswa') {
            $request->validate([
                'nama' => 'required|string|max:255',
                'tb' => 'required|integer|min:50|max:250',
                'bb' => 'required|numeric|min:10|max:200',
            ]);
        } elseif ($request->role == 'guru') {
            $request->validate([
                'nama_guru' => 'required|string|max:255',
                'mapel' => 'required|string|max:255',
            ]);
        }

        // Create admin record
        $admin = admin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Create related records based on role
        if ($request->role == 'siswa') {
            siswa::create([
                'id' => $admin->id,
                'nama' => $request->nama,
                'tb' => $request->tb,
                'bb' => $request->bb,
            ]);
        } elseif ($request->role == 'guru') {
            guru::create([
                'id' => $admin->id,
                'nama' => $request->nama_guru,
                'mapel' => $request->mapel,
            ]);
        }

        return redirect()->back()->with('success', 'Registrasi berhasil! Akun dan data detail telah dibuat.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Registrasi gagal: '. $e->getMessage());
    }
}

}
