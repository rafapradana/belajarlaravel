<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\siswa;
use App\Models\admin;
use App\Models\guru;
use App\Models\konten;
use App\Models\walas;
use App\Models\kelas;
use App\Models\kbm;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //username dan password admin, admin
        admin::factory()->dataadmin1()->create();

        //username dan password guru, guru
        $adminGuru = admin::factory()->dataadmin2()->create();

        //membuat 5 data untuk tabel konten
        konten::factory()->count(5)->create();

        //Penambahan dari scenario kali ini mulai dari baris ini
        //membuat data guru untuk admin guru
        guru::factory()->create(['id' => $adminGuru->id]);

        //membuat 4 data tambahan untuk tabel guru, dan disimpan di variabel objek gurus
        $gurus = guru::factory(4)->create();

        //gabungkan semua guru (termasuk admin guru)
        $allGurus = guru::all();

        //membuat 25 data untuk tabel siswa, dan disimpan di variabel objek siswas
        $siswas = siswa::factory(25)->create();

        //mengambil 3 data secara random dari semua guru
        $guruRandom = $allGurus->random(3);

        //3 guru random dijadikan walas
        foreach ($guruRandom as $guru) {
            walas::factory()->create([
                'idguru' => $guru->idguru
            ]);
        }

        //mengambil data semua walas
        $waliKelasIds = walas::pluck('idwalas')->toArray();

        //mengacak urutan siswa
        $randomSiswas = $siswas->shuffle();

        //mendistribusikan siswa menjadi 3 kelompok sesuai jumlah wali kelas
        $chunks = $randomSiswas->chunk(ceil($randomSiswas->count() / count($waliKelasIds)));

        //perulangan tiap wali kelas dan siswanya
        foreach ($waliKelasIds as $index => $idwalas) {
            if (isset($chunks[$index])) {
                foreach ($chunks[$index] as $siswa) {
                    kelas::create([
                        'idwalas' => $idwalas,
                        'idsiswa' => $siswa->idsiswa
                    ]);
                }
            }
        }

        //membuat 15 data untuk tabel kbm (jadwal KBM)
        kbm::factory(15)->create();
    }
}