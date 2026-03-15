<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sim_persedian_barang/pages/data_barang.php');
    exit();
}

$nama_barang = trim($_POST['nama_barang'] ?? '');
$deskripsi   = trim($_POST['deskripsi'] ?? '');
$harga       = $_POST['harga_barang'] ?? '';
$id_supplier = $_POST['id_supplier'] ?? '';

// 1. Validasi input tidak boleh kosong
if (empty($nama_barang) || empty($deskripsi) || $harga === '' || empty($id_supplier)) {
    $_SESSION['error'] = "Semua kolom wajib diisi.";
    header('Location: /sim_persedian_barang/pages/data_barang.php');
    exit();
}

// 2. Cek duplikasi nama barang
$stmt_cek = mysqli_prepare($conn, "SELECT id_barang FROM barang WHERE nama_barang = ?");
mysqli_stmt_bind_param($stmt_cek, 's', $nama_barang);
mysqli_stmt_execute($stmt_cek);
mysqli_stmt_store_result($stmt_cek);

if (mysqli_stmt_num_rows($stmt_cek) > 0) {
    $_SESSION['error'] = "Barang dengan nama \"$nama_barang\" sudah ada.";
    header('Location: /sim_persedian_barang/pages/data_barang.php');
    exit();
}

// 3. Simpan ke database (Stok awal 0)
$stmt_insert = mysqli_prepare($conn, "INSERT INTO barang (id_supplier, nama_barang, deskripsi, harga_barang, jumlah_stok) VALUES (?, ?, ?, ?, 0)");
// Tipe data: i (integer), s (string), s (string), d (double)
mysqli_stmt_bind_param($stmt_insert, 'issd', $id_supplier, $nama_barang, $deskripsi, $harga);

if (mysqli_stmt_execute($stmt_insert)) {
    $_SESSION['success'] = "Barang \"$nama_barang\" berhasil ditambahkan.";
} else {
    $_SESSION['error'] = "Gagal menyimpan barang: " . mysqli_error($conn);
}

header('Location: /sim_persedian_barang/pages/data_barang.php');
exit();
?>