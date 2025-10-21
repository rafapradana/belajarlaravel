<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\admin;
use App\Models\guru;
use App\Models\walas;
use App\Models\kelas;


class siswaController extends Controller
{
    public function home()
{
    if (!session()->has('admin_id')) {
        return redirect()->route('login');
    }

    $adminId = session('admin_id');
    $adminRole = session('admin_role');
    $adminUsername = session('admin_username');

    // Get user-specific data based on role
    $userInfo = null;
    $kelasInfo = null;
    $walasInfo = null;
    $siswaWalas = collect();

    if ($adminRole === 'siswa') {
        // Cari data siswa berdasarkan admin_id yang sesuai dengan foreign key di tabel siswa
        $userInfo = siswa::where('id', $adminId)->first();
        if ($userInfo) {
            // Cari kelas siswa dan info walas
            $kelasInfo = kelas::where('idsiswa', $userInfo->idsiswa)
                             ->with(['walas.guru'])
                             ->first();
        }
    } elseif ($adminRole === 'guru') {
        // Cari data guru berdasarkan admin_id yang sesuai dengan foreign key di tabel guru
        $userInfo = guru::where('id', $adminId)->first();
        if ($userInfo) {
            // Cek apakah guru ini adalah walas
            $walasInfo = walas::where('idguru', $userInfo->idguru)->first();
            if ($walasInfo) {
                // Jika walas, ambil semua siswa di kelasnya
                $siswaWalas = kelas::where('idwalas', $walasInfo->idwalas)
                                  ->with('siswa')
                                  ->get()
                                  ->pluck('siswa');
            }
        }
    }

    // Get all students data (for admin to view) - removed for Ajax implementation
    // $siswa = siswa::all();

    return view('home', compact('userInfo', 'adminRole', 'adminUsername', 'kelasInfo', 'walasInfo', 'siswaWalas'));
}

public function getData() 
{ 
    $siswa = Siswa::all(); 
    return response()->json($siswa); 
}

public function search(Request $request)
{ 
    $keyword = strtolower($request->input('q')); 
    $siswa = Siswa::whereRaw('LOWER(nama) LIKE ?', ["%{$keyword}%"])
                ->get(); 
    return response()->json($siswa); 
}

public function create()
{
    return view('siswa.create');

}

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'tb' => 'required|integer',
        'bb' => 'required|numeric',
        'username' => 'required|string|max:255|unique:dataadmin,username',
        'password' => 'required|string|min:6',
    ]);

    // 1. Simpan ke dataadmin
    $admin = new \App\Models\admin();
    $admin->username = $request->username;
    $admin->password = bcrypt($request->password);
    $admin->role = 'siswa';
    $admin->save();

    // 2. Simpan ke datasiswa dengan id dari dataadmin
    $siswa = new Siswa();
    $siswa->nama = $request->nama;
    $siswa->tb = $request->tb;
    $siswa->bb = $request->bb;
    $siswa->id = $admin->id; // foreign key ke dataadmin
    $siswa->save();

    return redirect()->route('home')->with('success', 'Data siswa berhasil ditambahkan');
}

public function edit($id)
{
    $siswa = siswa::where('idsiswa', $id)->firstOrFail();
    return view('siswa.edit', compact('siswa'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'tb' => 'required|integer',
        'bb' => 'required|numeric'
    ]);

    // Find the student by idsiswa
    $siswa = Siswa::where('idsiswa', $id)->firstOrFail();
    
    $siswa->nama = $request->nama;
    $siswa->tb = $request->tb;
    $siswa->bb = $request->bb;
    $siswa->save();

    return redirect()->route('home')->with('success', 'Data siswa berhasil diperbarui');
}

public function destroy($id)
{
    $siswa = siswa::where('idsiswa', $id)->firstOrFail();
    $siswa->delete();

    return redirect()->route('home');
}

}

