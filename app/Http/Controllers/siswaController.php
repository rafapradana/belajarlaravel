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

    // Get all students data (for admin to view)
    $siswa = siswa::all();

    return view('home', compact('siswa', 'userInfo', 'adminRole', 'adminUsername', 'kelasInfo', 'walasInfo', 'siswaWalas'));
}

public function create()
{
    return view('siswa.create');

}

public function store(Request $request)
{
    siswa::create($request->only('nama', 'tb', 'bb'));
    return redirect()->route('home');
}

public function edit($id)
{
    $siswa = siswa::where('idsiswa', $id)->firstOrFail();
    return view('siswa.edit', compact('siswa'));
}

public function update(Request $request, $id)
{
    $siswa = siswa::where('idsiswa', $id)->firstOrFail();
    $siswa->update($request->only('nama', 'tb', 'bb'));

    return redirect()->route('home');
}

public function destroy($id)
{
    $siswa = siswa::where('idsiswa', $id)->firstOrFail();
    $siswa->delete();

    return redirect()->route('home');
}

}

