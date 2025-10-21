<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kbm;
use App\Models\guru;
use App\Models\walas;
use App\Models\admin;

class kbmController extends Controller
{
    // Method untuk menampilkan jadwal berdasarkan role
    public function index()
    {
        // Cek apakah user sudah login
        if (!session()->has('admin_id')) {
            return redirect()->route('login');
        }
        
        $adminId = session('admin_id');
        $role = session('admin_role');
        
        if ($role == 'admin') {
            // Admin bisa melihat semua jadwal KBM
            $jadwal = kbm::with(['guru', 'walas'])->get();
            return view('kbm.admin', compact('jadwal'));
        } 
        elseif ($role == 'guru') {
            $guru = guru::where('id', $adminId)->first();
            if ($guru) {
                // Cek apakah guru ini adalah walas
                $walas = walas::where('idguru', $guru->idguru)->first();
                
                if ($walas) {
                    // Jika guru adalah walas, tampilkan semua jadwal guru yang mengajar di kelasnya
                    $jadwal = kbm::with(['guru', 'walas'])
                        ->where('idwalas', $walas->idwalas)
                        ->get();
                    return view('kbm.walas', compact('jadwal', 'guru', 'walas'));
                } else {
                    // Jika guru biasa, hanya tampilkan jadwal yang dia ajar
                    $jadwal = kbm::with(['guru', 'walas'])
                        ->where('idguru', $guru->idguru)
                        ->get();
                    return view('kbm.guru', compact('jadwal', 'guru'));
                }
            }
        } 
        elseif ($role == 'siswa') {
            // Siswa hanya bisa melihat jadwal KBM dari kelas mereka
            $siswa = \App\Models\siswa::where('id', $adminId)->first();
            if ($siswa) {
                $kelas = \App\Models\kelas::where('idsiswa', $siswa->idsiswa)->first();
                if ($kelas) {
                    $jadwal = kbm::with(['guru', 'walas'])
                        ->where('idwalas', $kelas->idwalas)
                        ->get();
                    return view('kbm.siswa', compact('jadwal', 'siswa'));
                }
            }
        }
        
        return redirect()->back()->with('error', 'Tidak dapat mengakses jadwal KBM');
    }

    // Method untuk admin mengelola jadwal KBM
    public function create()
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->has('admin_id') || session('admin_role') !== 'admin') {
            return redirect()->route('login');
        }
        
        $guru = guru::all();
        $walas = walas::all();
        return view('kbm.create', compact('guru', 'walas'));
    }

    public function store(Request $request)
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->has('admin_id') || session('admin_role') !== 'admin') {
            return redirect()->route('login');
        }
        
        $request->validate([
            'idguru' => 'required|exists:dataguru,idguru',
            'idwalas' => 'required|exists:datawalas,idwalas',
            'hari' => 'required|string',
            'mulai' => 'required',
            'selesai' => 'required|after:mulai'
        ]);

        kbm::create($request->all());
        return redirect()->route('kbm.index')->with('success', 'Jadwal KBM berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->has('admin_id') || session('admin_role') !== 'admin') {
            return redirect()->route('login');
        }
        
        $kbm = kbm::findOrFail($id);
        $guru = guru::all();
        $walas = walas::all();
        return view('kbm.edit', compact('kbm', 'guru', 'walas'));
    }

    public function update(Request $request, $id)
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->has('admin_id') || session('admin_role') !== 'admin') {
            return redirect()->route('login');
        }
        
        $request->validate([
            'idguru' => 'required|exists:dataguru,idguru',
            'idwalas' => 'required|exists:datawalas,idwalas',
            'hari' => 'required|string',
            'mulai' => 'required',
            'selesai' => 'required|after:mulai'
        ]);

        $kbm = kbm::findOrFail($id);
        $kbm->update($request->all());
        return redirect()->route('kbm.index')->with('success', 'Jadwal KBM berhasil diupdate');
    }

    public function destroy($id)
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->has('admin_id') || session('admin_role') !== 'admin') {
            return redirect()->route('login');
        }
        
        $kbm = kbm::findOrFail($id);
        $kbm->delete();
        return redirect()->route('kbm.index')->with('success', 'Jadwal KBM berhasil dihapus');
    }
}
