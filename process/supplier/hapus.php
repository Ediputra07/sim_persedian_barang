<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sim_persedian_barang/pages/data_supplier.php');
    exit();
}

$id = $_POST['id_supplier'];

$cek = mysqli_query($conn, "SELECT nama_supplier FROM supplier WHERE id_supplier = $id");
$supplier = mysqli_fetch_assoc($cek);

$stmt = mysqli_prepare($conn, "DELETE FROM supplier WHERE id_supplier = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Supplier \"{$supplier['nama_supplier']}\" berhasil dihapus.";
} else {
    $_SESSION['error'] = "Gagal menghapus supplier. Supplier ini masih terhubung dengan data barang.";
}

header('Location: /sim_persedian_barang/pages/data_supplier.php');
exit();
?>