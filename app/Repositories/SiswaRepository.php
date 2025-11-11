<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Siswa;

class SiswaRepository
{
    /**
     * create
     *
     * Membuat akun admin (untuk login) dan data siswa berdasarkan input dari form.
     * - Langkah 1: simpan data ke tabel dataadmin (username, password, role)
     * - Langkah 2: simpan data ke tabel datasiswa (id admin, nama, tb, bb)
     *
     * Kenapa dipisah? Agar logika akses database rapi dan mudah diuji.
     */
    public function create(array $data): Siswa
    {
        // 1) Buat akun admin untuk login
        //    - username dan password diambil dari form
        //    - role ditetapkan sebagai 'siswa'
        $admin = Admin::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']), // enkripsi password agar aman
            'role'     => 'siswa',
        ]);

        // 2) Buat data siswa yang terhubung dengan admin melalui kolom 'id'
        $siswa = Siswa::create([
            'id'   => $admin->id,   // foreign key ke tabel dataadmin
            'nama' => $data['nama'],
            'tb'   => $data['tb'],
            'bb'   => $data['bb'],
        ]);

        return $siswa;
    }
}