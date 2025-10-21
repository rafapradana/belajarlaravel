# 🧩 Tugas Laravel ke-6

## Deskripsi

Pada scenario kali ini, kita akan menambahkan **1 tabel baru** yaitu `datakbm`.

Tabel tersebut memiliki **relasi many-to-many** dengan tabel `dataguru` dan tabel `datawalas`.
Artinya:

* Guru bisa mengajar banyak kelas
* Kelas diajar oleh banyak guru
  (Sesuai kebutuhan mata pelajarannya)

Tabel `datakbm` menyimpan:

* `idguru` → referensi dari tabel `dataguru`
* `idwalas` → referensi dari tabel `datawalas`
* `idkbm`, `hari`, `mulai`, dan `selesai`

---

## 🧱 Langkah-langkah

### 1. Membuat model

```bash
php artisan make:model kbm
```

### 2. Membuat migrasi

```bash
php artisan make:migration datakbm
```

### 3. Membuat controller

```bash
php artisan make:controller kbmController
```

---

### 4. Modifikasi model `kbm`

Tambahkan:

```php
protected $table = 'datakbm';
```

---

### 5. Modifikasi schema di migrasi `datakbm`

```php
$table->id('idkbm');
$table->unsignedBigInteger('idguru')->unique();
$table->foreign('idguru')->references('idguru')->on('dataguru')->onDelete('cascade');

$table->unsignedBigInteger('idwalas')->unique();
$table->foreign('idwalas')->references('idwalas')->on('datawalas')->onDelete('cascade');

$table->string('hari');
$table->string('mulai');
$table->string('selesai');
$table->timestamps();
```

---

### 6. Tambahkan `$fillable` di model `kbm`

```php
protected $fillable = [
    'idguru',
    'idwalas',
    'hari',
    'mulai',
    'selesai',
];
```

---

### 7. Tambahkan relasi di model `kbm`

```php
public function guru()
{
    return $this->belongsTo(guru::class);
}

public function walas()
{
    return $this->belongsTo(walas::class);
}
```

---

### 8. Tambahkan relasi di model `guru`

```php
public function kbm()
{
    return $this->hasMany(kbm::class);
}
```

---

### 9. Tambahkan relasi di model `walas`

```php
public function kbm()
{
    return $this->hasMany(kbm::class);
}
```

---

### 10. Membuat factory untuk `datakbm`

```bash
php artisan make:factory kbmFactory
```

Tambahkan di model `kbm`:

```php
use HasFactory;
```

---

### 11. Modifikasi function `definition` pada `kbmFactory`

```php
$guruIds = guru::pluck('idguru')->toArray();
$kelasIds = walas::pluck('idwalas')->toArray();

return [
    'idguru' => $this->faker->randomElement($guruIds),
    'idwalas' => $this->faker->randomElement($kelasIds),
    'hari' => $this->faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
    'mulai' => $this->faker->randomElement(['07:00', '08:30', '10:00', '11:30', '13:00']),
    'selesai' => $this->faker->randomElement(['08:30', '10:00', '11:30', '13:00', '14:30']),
];
```

---

### 12. Modifikasi `DatabaseSeeder`

```php
kbm::factory(5)->create();
```

---

### 13. Mengambil semua data `datakbm`

```php
$jadwals = kbm::with(['guru', 'walas'])->get();
return view('arahkan ke view', compact('jadwals'));
```

---

### 14. Mengambil data `datakbm` berdasarkan **guru tertentu**

```php
$guru = guru::with(['kbm.walas'])->findOrFail($idguru);
return view('arahkan ke view', compact('guru'));
```

---

### 15. Mengambil data `datakbm` berdasarkan **kelas tertentu**

```php
$kelas = kelas::with(['kbm.guru'])->findOrFail($idwalas);
return view('arahkan ke view', compact('kelas'));
```

---

### 16. Contoh tampilan data pada view

```html
<table class="table table-bordered table-striped align-middle">
    <thead class="table-primary text-center">
        <tr>
            <th>No</th>
            <th>Nama Guru</th>
            <th>Mata Pelajaran</th>
            <th>Kelas</th>
            <th>Hari</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($jadwals as $i => $jadwal)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $jadwal->guru->nama }}</td>
                <td>{{ $jadwal->guru->mapel }}</td>
                <td>{{ $jadwal->kelas->nama_kelas }}</td>
                <td>{{ $jadwal->hari }}</td>
                <td>{{ $jadwal->jam_mulai }}</td>
                <td>{{ $jadwal->jam_selesai }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted">Belum ada jadwal pelajaran</td>
            </tr>
        @endforelse
    </tbody>
</table>
```

---

## 🎯 Tugas

> Akses untuk melihat jadwal sesuai dengan **role-nya masing-masing**.