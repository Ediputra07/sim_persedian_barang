<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sim_persedian_barang/pages/data_supplier.php');
    exit();
}

$nama   = trim($_POST['nama_supplier']);
$kontak = trim($_POST['kontak']);
$alamat = trim($_POST['alamat']);

// Cek duplikasi nama supplier
$cek = mysqli_prepare($conn, "SELECT id_supplier FROM supplier WHERE nama_supplier = ?");
mysqli_stmt_bind_param($cek, 's', $nama);
mysqli_stmt_execute($cek);
mysqli_stmt_store_result($cek);

if (mysqli_stmt_num_rows($cek) > 0) {
    $_SESSION['error'] = "Supplier \"$nama\" sudah ada di database.";
    header('Location: /sim_persedian_barang/pages/data_supplier.php');
    exit();
}

$stmt = mysqli_prepare($conn, "INSERT INTO supplier (nama_supplier, kontak, alamat) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'sss', $nama, $kontak, $alamat);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Supplier \"$nama\" berhasil ditambahkan.";
} else {
    $_SESSION['error'] = "Gagal menambahkan supplier.";
}

header('Location: /sim_persedian_barang/pages/data_supplier.php');
exit();
?>