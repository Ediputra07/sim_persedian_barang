<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sim_persedian_barang/pages/data_supplier.php');
    exit();
}

$id     = $_POST['id_supplier'];
$nama   = trim($_POST['nama_supplier']);
$kontak = trim($_POST['kontak']);
$alamat = trim($_POST['alamat']);

$stmt = mysqli_prepare($conn, "UPDATE supplier SET nama_supplier=?, kontak=?, alamat=? WHERE id_supplier=?");
mysqli_stmt_bind_param($stmt, 'sssi', $nama, $kontak, $alamat, $id);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Supplier \"$nama\" berhasil diupdate.";
} else {
    $_SESSION['error'] = "Gagal mengupdate supplier.";
}

header('Location: /sim_persedian_barang/pages/data_supplier.php');
exit();
?>