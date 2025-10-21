# Tugas Laravel v7

## Scenario

* Skenario kali ini terkait penggunaan **middleware**.
* Sebelumnya middleware telah diterapkan menggunakan logika sederhana dengan seleksi kondisi atau `if`.
* Sebagai contoh baris:

```php
if (!session()->has('admin_id')) {
    return redirect()->route('login');
}
```

Baris tersebut digunakan untuk memastikan bahwa terdapat user yang sedang login. Jika belum login maka akan diarahkan ke halaman login.

---

## Cara Kerja Middleware

```
User request -> Middleware -> Controller -> Response -> Middleware -> Browser
```

Middleware berfungsi sebagai **penjaga gerbang (gatekeeper)** antara user dan controller.
Jadi, middleware akan memeriksa request sebelum sampai ke controller, dan bisa juga memodifikasi response sebelum dikirim ke browser.

---

## Langkah-Langkah

### 1. Membuat Middleware Baru

Buat middleware baru untuk memeriksa login dengan perintah berikut:

```bash
php artisan make:middleware ceklogin
```

---

### 2. Modifikasi Function `handle`

Edit function `handle` dari middleware `ceklogin` dengan menambahkan baris berikut **sebelum baris `return`**:

```php
if (!session()->has('admin_id')) {
    return redirect()->route('login');
}
```

---

### 3. Tambahkan di File `app/Http/Kernel.php`

Tambahkan baris berikut di dalam bagian **route middleware**:

```php
'ceklogin' => \App\Http\Middleware\ceklogin::class,
```

Jika file `Kernel.php` tidak ditemukan, maka buat file baru di `app/Http` dengan isi berikut:

```php
<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // Middleware global Laravel
        \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        \Illuminate\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'ceklogin' => \App\Http\Middleware\ceklogin::class, // tambahannya ada di sini
    ];
}
```

---

### 4. Modifikasi Route `home`

**Before:**

```php
Route::get('/home', [siswaController::class, 'home'])->name('home');
```

**After:**

```php
Route::get('/home', [siswaController::class, 'home'])->name('home')->middleware('ceklogin');
```

---

### 5. Contoh Jika Ada Lebih dari 1 Route yang Membutuhkan Middleware `ceklogin`

```php
Route::middleware(['ceklogin'])->group(function () {

    Route::get('/home', [siswaController::class, 'home'])->name('home'); // contoh route 1
    Route::get('/home2', [siswaController2::class, 'home2'])->name('home2'); // contoh route 2

});
```

---

## Tugas

Sepertinya ada logika lain yang bisa dibuatkan middleware.
Tetapi jika memang tidak ada, maka tidak ada tugas tambahan untuk pertemuan minggu ini.
Cukup menerapkan yang ada di module saja.

---