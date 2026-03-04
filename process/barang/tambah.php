<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sim_persedian_barang/pages/data_barang.php');
    exit();
}

$nama    = trim($_POST['nama_barang']);
$jenis   = trim($_POST['jenis_barang']);
$harga   = $_POST['harga_barang'];
$sup_id  = $_POST['id_supplier'];

// Cek duplikasi nama barang
$cek = mysqli_prepare($conn, "SELECT id_barang FROM barang WHERE nama_barang = ?");
mysqli_stmt_bind_param($cek, 's', $nama);
mysqli_stmt_execute($cek);
mysqli_stmt_store_result($cek);

if (mysqli_stmt_num_rows($cek) > 0) {
    $_SESSION['error'] = "Barang \"$nama\" sudah ada di database.";
    header('Location: /sim_persedian_barang/pages/data_barang.php');
    exit();
}

$stmt = mysqli_prepare($conn, "INSERT INTO barang (nama_barang, jenis_barang, harga_barang, jumlah_stok, id_supplier) VALUES (?, ?, ?, 0, ?)");
mysqli_stmt_bind_param($stmt, 'ssdi', $nama, $jenis, $harga, $sup_id);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Barang \"$nama\" berhasil ditambahkan.";
} else {
    $_SESSION['error'] = "Gagal menambahkan barang.";
}

header('Location: /sim_persedian_barang/pages/data_barang.php');
exit();
?>