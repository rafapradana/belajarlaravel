<?php

namespace App\Services;

use App\Repositories\SiswaRepository;

class SiswaService
{
    protected $repo;

    public function __construct(SiswaRepository $repo)
    {
        // Service bertugas menampung logika bisnis.
        // Di sini kita menerima data dari Controller,
        // lalu meneruskannya ke Repository untuk disimpan ke database.
        $this->repo = $repo;
    }

    public function createSiswa(array $data)
    {
        // Teruskan data yang sudah tervalidasi ke Repository.
        // Jika ada aturan bisnis tambahan, bisa diletakkan di sini.
        return $this->repo->create($data);
    }
}