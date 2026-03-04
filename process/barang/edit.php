<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sim_persedian_barang/pages/data_barang.php');
    exit();
}

$id      = $_POST['id_barang'];
$nama    = trim($_POST['nama_barang']);
$jenis   = trim($_POST['deskripsi']);
$harga   = $_POST['harga_barang'];
$sup_id  = $_POST['id_supplier'];

$stmt = mysqli_prepare($conn, "UPDATE barang SET nama_barang=?, deskripsi=?, harga_barang=?, id_supplier=? WHERE id_barang=?");
mysqli_stmt_bind_param($stmt, 'ssdii', $nama, $deskripsi, $harga, $sup_id, $id);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Barang \"$nama\" berhasil diupdate.";
} else {
    $_SESSION['error'] = "Gagal mengupdate barang.";
}

header('Location: /sim_persedian_barang/pages/data_barang.php');
exit();
?>