# SIM Persediaan Barang — InvenTrack Pro

Sistem Informasi Manajemen Persediaan Barang berbasis web untuk UMKM.

## Tim Pengembang
- Edi Putra — Project Lead & UI
- Destya Nurfaiza Muslim — Backend Auth & User  
- Oktavia Putri Roichatul Jannah — Backend Master Data
- Moh Fadil — Backend Transaksi
- NAhmad Warisi — Backend Laporan & QA

## Teknologi
- PHP Native
- MySQL
- Bootstrap 5
- Apache (XAMPP)

## Cara Instalasi
1. Clone repository ini
2. Letakkan di folder `htdocs/sim_persedian_barang`
3. Import file `database.sql` ke phpMyAdmin
4. Buat file `config/database.php` dari `config/database.example.php`
5. Akses `http://localhost/sim_persedian_barang`

## Akun Default
| Role | Username | Password |
|---|---|---|
| Owner | owner | password |

## Fitur
- Login dengan role based access control
- Manajemen data barang dan supplier
- Pencatatan barang masuk dan keluar
- Laporan stok, barang masuk, dan barang keluar
- Manajemen user (khusus Owner)