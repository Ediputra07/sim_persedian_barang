<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sim_persedian_barang/pages/data_supplier.php');
    exit();
}

$id = $_POST['id_supplier'];

// Ambil nama supplier
$cek = mysqli_prepare($conn, "SELECT nama_supplier FROM supplier WHERE id_supplier = ?");
mysqli_stmt_bind_param($cek, 'i', $id);
mysqli_stmt_execute($cek);
$result = mysqli_stmt_get_result($cek);
$supplier = mysqli_fetch_assoc($result);

if (!$supplier) {
    $_SESSION['error'] = "Supplier tidak ditemukan.";
    header('Location: /sim_persedian_barang/pages/data_supplier.php');
    exit();
}

// Cek apakah supplier masih terhubung ke barang
$cek_barang = mysqli_prepare($conn, "SELECT COUNT(*) as total FROM barang WHERE id_supplier = ?");
mysqli_stmt_bind_param($cek_barang, 'i', $id);
mysqli_stmt_execute($cek_barang);
$total_barang = mysqli_fetch_assoc(mysqli_stmt_get_result($cek_barang))['total'];

// Cek apakah supplier masih punya transaksi masuk
$cek_masuk = mysqli_prepare($conn, "SELECT COUNT(*) as total FROM barang_masuk WHERE id_supplier = ?");
mysqli_stmt_bind_param($cek_masuk, 'i', $id);
mysqli_stmt_execute($cek_masuk);
$total_masuk = mysqli_fetch_assoc(mysqli_stmt_get_result($cek_masuk))['total'];

if ($total_barang > 0 || $total_masuk > 0) {
    $_SESSION['error'] = "Supplier \"{$supplier['nama_supplier']}\" tidak bisa dihapus karena masih terhubung dengan data barang atau transaksi.";
    header('Location: /sim_persedian_barang/pages/data_supplier.php');
    exit();
}

$stmt = mysqli_prepare($conn, "DELETE FROM supplier WHERE id_supplier = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Supplier \"{$supplier['nama_supplier']}\" berhasil dihapus.";
} else {
    $_SESSION['error'] = "Gagal menghapus supplier.";
}

header('Location: /sim_persedian_barang/pages/data_supplier.php');
exit();
?>