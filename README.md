# InvenTrack Pro
> Sistem Informasi Manajemen Persediaan Barang untuk UMKM

![PHP](https://img.shields.io/badge/PHP-Native-777BB4?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap)

---

## Tentang Proyek

InvenTrack Pro adalah aplikasi web berbasis PHP Native untuk membantu UMKM mengelola persediaan barang secara efisien. Dikembangkan sebagai proyek mata kuliah Implementasi, Pengukuran, dan Penjaminan Perangkat Lunak — Semester 4.

---

## Fitur Utama

- Login dengan autentikasi berbasis role (Owner, Admin Gudang, Kasir)
- Manajemen data barang dan supplier
- Pencatatan barang masuk dan keluar dengan update stok otomatis
- Laporan stok, barang masuk, dan barang keluar dengan filter periode
- Notifikasi stok menipis
- Manajemen user (khusus Owner)
- Session timeout otomatis

---

## Role & Hak Akses

| Fitur | Owner | Admin Gudang | Kasir |
|---|:---:|:---:|:---:|
| Dashboard | ✅ | ✅ | ✅ |
| Data Barang | ❌ | ✅ | ❌ |
| Data Supplier | ❌ | ✅ | ❌ |
| Barang Masuk | ❌ | ✅ | ❌ |
| Barang Keluar | ❌ | ❌ | ✅ |
| Laporan | ✅ | ✅ | ✅ |
| Manajemen User | ✅ | ❌ | ❌ |
| Ubah Password | ✅ | ✅ | ✅ |

---

## Teknologi

| Komponen | Teknologi |
|---|---|
| Backend | PHP Native |
| Database | MySQL |
| Frontend | Bootstrap 5.3, Plus Jakarta Sans |
| Server | Apache (XAMPP) |
| Version Control | Git & GitHub |

---

## Instalasi

### Prasyarat
- XAMPP (Apache + MySQL)
- PHP >= 8.0
- Browser modern (Chrome, Firefox, Edge)

### Langkah Instalasi

**1. Clone repository**
```bash
git clone https://github.com/Ediputra07/sim_persedian_barang.git
```

**2. Pindahkan ke folder htdocs**
```bash
# Pastikan folder ada di:
C:/xampp/htdocs/sim_persedian_barang
```

**3. Import database**
- Buka phpMyAdmin → `http://localhost/phpmyadmin`
- Buat database baru bernama `inventtrack_pro`
- Klik tab **Import** → pilih file `database.sql` dari folder project
- Klik **Go**

**4. Buat file konfigurasi database**
```bash
# Salin file contoh
cp config/database.example.php config/database.php
```
Lalu buka `config/database.php` dan sesuaikan:
```php
$host     = 'localhost';
$username = 'root';
$password = ''; // password MySQL kamu
$database = 'inventtrack_pro';
```

**4b. (Opsional) Import data dummy realistis**

Jika ingin testing dengan data yang lebih banyak (100 supplier, 100 barang, 100 transaksi masuk, 100 transaksi keluar):

- Buka phpMyAdmin → pilih database `inventtrack_pro`
- Klik tab **Import**
- Pilih file `data_realistis.sql` dari folder project
- Klik **Go**

> ⚠️ File ini akan mengosongkan data lama pada tabel supplier, barang, barang_masuk, dan barang_keluar. Akun user tidak akan terhapus.

**5. Jalankan aplikasi**

Buka browser → akses: http://localhost/sim_persedian_barang

---

## Akun Default

| Role | Username | Password |
|---|---|---|
| Owner | owner | password |

> ⚠️ Segera ubah password setelah login pertama kali.

---

```bash
## Struktur Folder
sim_persedian_barang/
├── assets/
│   ├── css/          # Stylesheet
│   └── js/           # JavaScript
├── config/
│   ├── database.php          # Koneksi DB (tidak di-push)
│   └── database.example.php  # Template koneksi DB
├── includes/
│   ├── auth_check.php  # Proteksi halaman & role access
│   ├── header.php      # Sidebar & topbar
│   ├── footer.php      # Footer & modal logout
│   └── helper.php      # Helper functions
├── pages/              # Halaman utama aplikasi
├── process/            # Proses form (CRUD)
├── database.sql        # File SQL database
├── index.php           # Entry point
└── login.php           # Halaman login
```

---

## Tim Pengembang

| Nama | Peran |
|---|---|
| Edi Putra | Project Lead & UI/UX |
| Destya Nurfaiza Muslim | Backend Auth & User |
| Oktavia Putri Roichatul Jannah | Backend Master Data |
| Moh Fadil | Backend Transaksi |
| Ahmad Warisi | Backend Laporan & QA |

**Kelompok 4 — Semester 4**
Mata Kuliah: Implementasi, Pengukuran, dan Penjaminan Perangkat Lunak

---

## Lisensi

Proyek ini dibuat untuk keperluan akademik.