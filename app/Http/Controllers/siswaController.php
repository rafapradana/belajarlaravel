<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\admin;
use App\Models\guru;


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
    if ($adminRole === 'siswa') {
        $userInfo = siswa::where('id', $adminId)->first();
    } elseif ($adminRole === 'guru') {
        $userInfo = guru::where('id', $adminId)->first();
    }
    
    // Get all students data (for admin and guru to view)
    $siswa = siswa::all();
    
    return view('home', compact('siswa', 'userInfo', 'adminRole', 'adminUsername'));
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
    $siswa = siswa::findOrFail($id);
    return view('siswa.edit', compact('siswa'));
}

public function update(Request $request, $id)
{
    $siswa = siswa::findOrFail($id);
    $siswa->update($request->only('nama', 'tb', 'bb'));

    return redirect()->route('home');
}

public function destroy($id)
{
    $siswa = siswa::findOrFail($id);
    $siswa->delete();

    return redirect()->route('home');
}

}

