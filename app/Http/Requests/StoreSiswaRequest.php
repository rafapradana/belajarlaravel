<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Aturan validasi disesuaikan dengan field yang ada di form
        // Tujuan: memastikan data yang masuk sudah benar sebelum diproses
        return [
            // Nama lengkap siswa (teks, wajib diisi)
            'nama' => 'required|string|max:255',

            // Username untuk login (unik di tabel dataadmin)
            'username' => 'required|string|max:255|unique:dataadmin,username',

            // Password untuk login (minimal 6 karakter)
            'password' => 'required|string|min:6',

            // Tinggi badan dalam cm (angka, antara 50 sampai 250)
            'tb'   => 'required|numeric|min:50|max:250',

            // Berat badan dalam kg (angka, antara 10 sampai 200)
            'bb'   => 'required|numeric|min:10|max:200',
        ];
    }
}