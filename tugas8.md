# **Tugas Laravel ke 8**

## **Skenario**

* Skenario kali ini terkait penggunaan **Ajax**.
* **AJAX** adalah teknik untuk berkomunikasi antara browser dan server tanpa memuat ulang halaman web.
* **AJAX** biasanya menggunakan **JavaScript (atau jQuery)** untuk mengirim data ke server, dan server mengembalikan **response JSON**.

### **Alur Kerja AJAX**

1. Pengguna melakukan aksi (klik tombol / isi form).
2. JavaScript mengirimkan permintaan ke server (request).
3. Server (Laravel) memproses data dan mengembalikan response JSON.
4. JavaScript menerima response dan menampilkan hasil di halaman tanpa reload.

* Sebelumnya data dari tabel siswa ditampilkan dengan cara **load dari controller**.
* Tujuan kali ini: **menampilkan data dari tabel siswa tanpa reload halaman (melalui Ajax).**

---

## **Langkah-langkah**

### **1. Memodifikasi Controller**

Ubah fungsi berikut:

```php
public function home(){ 
    $siswa = siswa::all(); 
    return view('home'); 
}
```

Menjadi:

```php
public function home(){ 
    return view('home'); 
}

public function getData() 
{ 
    $siswa = Siswa::all(); 
    return response()->json($siswa); 
}
```

---

### **2. Memodifikasi View**

Hapus baris berikut:

```php
@foreach($siswa as $i => $s)
<tr>
    <td>{{ $i + 1 }}</td>
    <td>{{ $s->nama }}</td>
    <td>{{ $s->tb }}</td>
    <td>{{ $s->bb }}</td>
    @if (session('admin_role') === 'admin')
    <td>
        <a href="{{ route('siswa.edit', $s->idsiswa) }}">Edit</a> | 
        <a href="{{ route('siswa.delete', $s->idsiswa) }}" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
    </td>
    @endif
</tr>
@endforeach
```

Gantikan dengan:

```html
<script>
$(document).ready(function(){

    function renderTable(data) {
        let rows = '';
        if (data.length === 0) {
            rows = '<tr><td colspan="5">Tidak ada data ditemukan</td></tr>';
        } else {
            data.forEach((s, index) => {
                rows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${s.nama}</td>
                        <td>${s.tb}</td>
                        <td>${s.bb}</td>
                        @if (session('admin_role') === 'admin')
                        <td>
                            <a href="/siswa/edit/${s.idsiswa}">Edit</a> |
                            <a href="/siswa/delete/${s.idsiswa}" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                        @endif
                    </tr>
                `;
            });
        }
        $('#tabel-siswa tbody').html(rows);
    }

    function loadSiswa() {
        $.ajax({
            url: "{{ route('siswa.data') }}",
            method: "GET",
            success: function(response) {
                renderTable(response);
            },
            error: function() {
                alert('Gagal memuat data siswa.');
            }
        });
    }

    loadSiswa();
});
</script>
```

---

### **3. Tambahkan ID pada Tabel**

Tambahkan atribut `id="tabel-siswa"` di dalam tag `<table>` yang menampilkan data siswa.

---

### **4. Tambahkan jQuery di Head**

Tambahkan baris berikut di dalam tag `<head>`:

```html
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
```

---

## **Menambahkan Fitur Pencarian Tanpa Reload**

### **1. Tambahkan Input Pencarian**

Tambahkan baris berikut di atas tabel data siswa:

```html
<p>
    <label>Cari Siswa: </label>
    <input type="text" id="search" placeholder="Ketik nama...">
</p>
```

---

### **2. Tambahkan Function Pencarian di Controller**

```php
public function search(Request $request)
{ 
    $keyword = strtolower($request->input('q')); 
    $siswa = Siswa::whereRaw('LOWER(nama) LIKE ?', ["%{$keyword}%"])
                ->get(); 
    return response()->json($siswa); 
}
```

---

### **3. Tambahkan Script Pencarian di View**

Tambahkan script berikut di dalam tag `<script>` di bawah `loadSiswa`:

```js
function searchSiswa(keyword) {
    $.ajax({
        url: "{{ route('siswa.search') }}",
        method: "GET",
        data: { q: keyword },
        success: function(response) {
            renderTable(response);
        },
        error: function() {
            console.error('Gagal mencari data siswa.');
        }
    });
}

$('#search').on('keyup', function() {
    const keyword = $(this).val().trim();
    if (keyword.length > 0) {
        searchSiswa(keyword);
    } else {
        loadSiswa();
    }
});
```

---

## **Tugas**

> Adakah yang bisa di Ajax juga?

---
