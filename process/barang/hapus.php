<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sim_persedian_barang/pages/data_barang.php');
    exit();
}

$id = $_POST['id_barang'];

// Ambil nama barang dulu untuk pesan sukses
$cek = mysqli_query($conn, "SELECT nama_barang FROM barang WHERE id_barang = $id");
$barang = mysqli_fetch_assoc($cek);

$stmt = mysqli_prepare($conn, "DELETE FROM barang WHERE id_barang = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Barang \"{$barang['nama_barang']}\" berhasil dihapus.";
} else {
    $_SESSION['error'] = "Gagal menghapus barang. Mungkin barang ini masih memiliki transaksi.";
}

header('Location: /sim_persedian_barang/pages/data_barang.php');
exit();
?>