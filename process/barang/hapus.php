<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sim_persedian_barang/pages/data_barang.php');
    exit();
}

$id = $_POST['id_barang'];

// Ambil nama barang dulu untuk pesan sukses
$cek = mysqli_prepare($conn, "SELECT nama_barang FROM barang WHERE id_barang = ?");
mysqli_stmt_bind_param($cek, 'i', $id);
mysqli_stmt_execute($cek);
$result = mysqli_stmt_get_result($cek);
$barang = mysqli_fetch_assoc($result);

if (!$barang) {
    $_SESSION['error'] = "Barang tidak ditemukan.";
    header('Location: /sim_persedian_barang/pages/data_barang.php');
    exit();
}

// Cek apakah barang masih punya transaksi masuk
$cek_masuk = mysqli_prepare($conn, "SELECT COUNT(*) as total FROM barang_masuk WHERE id_barang = ?");
mysqli_stmt_bind_param($cek_masuk, 'i', $id);
mysqli_stmt_execute($cek_masuk);
$total_masuk = mysqli_fetch_assoc(mysqli_stmt_get_result($cek_masuk))['total'];

// Cek apakah barang masih punya transaksi keluar
$cek_keluar = mysqli_prepare($conn, "SELECT COUNT(*) as total FROM barang_keluar WHERE id_barang = ?");
mysqli_stmt_bind_param($cek_keluar, 'i', $id);
mysqli_stmt_execute($cek_keluar);
$total_keluar = mysqli_fetch_assoc(mysqli_stmt_get_result($cek_keluar))['total'];

if ($total_masuk > 0 || $total_keluar > 0) {
    $_SESSION['error'] = "Barang \"{$barang['nama_barang']}\" tidak bisa dihapus karena masih memiliki riwayat transaksi.";
    header('Location: /sim_persedian_barang/pages/data_barang.php');
    exit();
}

$stmt = mysqli_prepare($conn, "DELETE FROM barang WHERE id_barang = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Barang \"{$barang['nama_barang']}\" berhasil dihapus.";
} else {
    $_SESSION['error'] = "Gagal menghapus barang.";
}

header('Location: /sim_persedian_barang/pages/data_barang.php');
exit();
?>