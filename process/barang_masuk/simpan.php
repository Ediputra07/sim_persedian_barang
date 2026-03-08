<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../config/database.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sim_persedian_barang/pages/barang_masuk.php');
    exit();
}

$id_barang   = $_POST['id_barang'];
$id_supplier = $_POST['id_supplier'];
$jumlah      = (int) $_POST['jumlah_barang_masuk'];
$tanggal     = $_POST['tanggal_masuk'];
$keterangan  = trim($_POST['keterangan'] ?? '');
$id_user     = $_SESSION['id_user'];

// Validasi jumlah harus lebih dari 0
if ($jumlah <= 0) {
    $_SESSION['error'] = "Jumlah barang masuk harus lebih dari 0.";
    header('Location: /sim_persedian_barang/pages/barang_masuk.php');
    exit();
}

// Validasi format tanggal
if (empty($tanggal) || !strtotime($tanggal)) {
    $_SESSION['error'] = "Format tanggal tidak valid.";
    header('Location: /sim_persedian_barang/pages/barang_masuk.php');
    exit();
}

// Pastikan tidak melebihi hari ini
if ($tanggal > date('Y-m-d')) {
    $_SESSION['error'] = "Tanggal tidak boleh melebihi hari ini.";
    header('Location: /sim_persedian_barang/pages/barang_masuk.php');
    exit();
}
// Mulai transaksi — pastikan kedua query berhasil atau keduanya dibatalkan
mysqli_begin_transaction($conn);

try {
    // 1. Simpan ke tabel barang_masuk
    $stmt = mysqli_prepare($conn, "
        INSERT INTO barang_masuk (id_barang, id_supplier, id_user, tanggal_masuk, jumlah_barang_masuk, keterangan)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    mysqli_stmt_bind_param($stmt, 'iiisis', $id_barang, $id_supplier, $id_user, $tanggal, $jumlah, $keterangan);
    mysqli_stmt_execute($stmt);

    // 2. Update stok di tabel barang
    $update = mysqli_prepare($conn, "
        UPDATE barang SET jumlah_stok = jumlah_stok + ? WHERE id_barang = ?
    ");
    mysqli_stmt_bind_param($update, 'ii', $jumlah, $id_barang);
    mysqli_stmt_execute($update);

    // Commit jika kedua query berhasil
    mysqli_commit($conn);
    $_SESSION['success'] = "Barang masuk berhasil dicatat. Stok telah diperbarui.";

} catch (Exception $e) {
    // Rollback jika ada yang gagal
    mysqli_rollback($conn);
    $_SESSION['error'] = "Gagal menyimpan data. Silakan coba lagi.";
}

header('Location: /sim_persedian_barang/pages/barang_masuk.php');
exit();
?>