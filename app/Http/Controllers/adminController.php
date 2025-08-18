<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\admin;
use App\Models\siswa;

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

        admin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Registrasi berhasil!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Registrasi gagal: '. $e->getMessage());
    }
}

}
