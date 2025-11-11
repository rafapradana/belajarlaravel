<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSiswaRequest;
use App\Services\SiswaService;
use App\Models\siswa;
use App\Models\admin;
use App\Models\guru;
use App\Models\walas;
use App\Models\kelas;


class siswaController extends Controller
{
    protected $service;

    public function __construct(SiswaService $service)
    {
        // Dependency Injection (DI):
        // Laravel otomatis memasukkan (inject) object SiswaService ke controller.
        // Tujuan: memisahkan logika bisnis dari controller agar kode lebih rapi.
        $this->service = $service;
    }
    public function home()
{
    if (!session()->has('admin_id')) {
        return redirect()->route('login');
    }

    $adminId = session('admin_id');
    $adminRole = session('admin_role');
    $adminUsername = session('admin_username');

    // Tambahkan koleksi siswa untuk kebutuhan statistik admin
    $siswa = collect();

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
    } elseif ($adminRole === 'admin') {
        // Ambil semua data siswa untuk statistik di dashboard admin
        $siswa = \App\Models\siswa::all();
    }

    return view('home', compact('userInfo', 'adminRole', 'adminUsername', 'kelasInfo', 'walasInfo', 'siswaWalas', 'siswa'));
}

public function getData()
{
    $adminRole = session('admin_role');
    $adminId = session('admin_id');

    $siswa = collect();

    if ($adminRole === 'admin') {
        $siswa = siswa::orderBy('nama')->get();
    } elseif ($adminRole === 'guru') {
        $guru = guru::where('id', $adminId)->first();
        if ($guru) {
            $walasInfo = walas::where('idguru', $guru->idguru)->first();
            if ($walasInfo) {
                $siswa = kelas::where('idwalas', $walasInfo->idwalas)
                              ->with('siswa')
                              ->get()
                              ->pluck('siswa');
            }
        }
    }

    return view('siswa.table', compact('siswa'));
}

public function search(Request $request)
{
    $keyword = strtolower($request->input('query', $request->input('q', '')));
    $adminRole = session('admin_role');
    $adminId = session('admin_id');

    $siswa = collect();

    if ($adminRole === 'admin') {
        $siswa = siswa::whereRaw('LOWER(nama) LIKE ?', ["%{$keyword}%"]) 
                      ->orderBy('nama')
                      ->get();
    } elseif ($adminRole === 'guru') {
        $guru = guru::where('id', $adminId)->first();
        if ($guru) {
            $walasInfo = walas::where('idguru', $guru->idguru)->first();
            if ($walasInfo) {
                $siswa = kelas::where('idwalas', $walasInfo->idwalas)
                              ->with('siswa')
                              ->get()
                              ->pluck('siswa')
                              ->filter(function ($s) use ($keyword) {
                                  return $keyword === '' || stripos($s->nama, $keyword) !== false;
                              })
                              ->values();
            }
        }
    }

    return view('siswa.table', compact('siswa'));
}

public function create()
{
    return view('siswa.create');

}

public function store(StoreSiswaRequest $request)
{
    // 1) Validasi input:
    //    StoreSiswaRequest akan otomatis memvalidasi field dari form.
    //    Jika ada yang salah, Laravel akan kembali ke form dengan pesan error.

    // 2) Simpan data:
    //    Data yang sudah "bersih" (validated) diteruskan ke Service.
    //    Service akan mengatur proses penyimpanan (melalui Repository).
    $this->service->createSiswa($request->validated());

    // 3) Kembali ke halaman utama dengan pesan sukses.
    return redirect()->route('home')->with('success', 'Data siswa berhasil ditambahkan!');
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
    $siswa = siswa::where('idsiswa', $id)->firstOrFail();
    
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

