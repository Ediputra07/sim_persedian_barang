<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../config/database.php';

// Hanya user dengan role 'kasir' atau 'owner' yang bisa input barang keluar
if (!in_array($_SESSION['role'], ['kasir', 'owner'])) {
    $_SESSION['error'] = "Anda tidak memiliki akses untuk melakukan aksi ini.";
    header('Location: /sim_persedian_barang/pages/dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sim_persedian_barang/pages/barang_keluar.php');
    exit();
}

// Ambil data dari form
$id_barang            = $_POST['id_barang'] ?? null;
$jumlah_barang_keluar = $_POST['jumlah_barang_keluar'] ?? null;
$tanggal_keluar       = $_POST['tanggal_keluar'] ?? null;
$id_user              = $_SESSION['id_user'];

// 1. Validasi input
if (empty($id_barang) || empty($jumlah_barang_keluar) || empty($tanggal_keluar)) {
    $_SESSION['error'] = "Semua kolom wajib diisi, kecuali keterangan.";
    header('Location: /sim_persedian_barang/pages/barang_keluar.php');
    exit();
}

if (!is_numeric($jumlah_barang_keluar) || $jumlah_barang_keluar <= 0) {
    $_SESSION['error'] = "Jumlah barang keluar harus berupa angka positif.";
    header('Location: /sim_persedian_barang/pages/barang_keluar.php');
    exit();
}

// Mulai transaksi untuk menjaga konsistensi data
mysqli_begin_transaction($conn);

try {
    // 2. Cek stok barang saat ini (dengan locking untuk mencegah race condition)
    $stmt_cek = mysqli_prepare($conn, "SELECT jumlah_stok, nama_barang FROM barang WHERE id_barang = ? FOR UPDATE");
    mysqli_stmt_bind_param($stmt_cek, 'i', $id_barang);
    mysqli_stmt_execute($stmt_cek);
    $result_cek = mysqli_stmt_get_result($stmt_cek);
    $barang = mysqli_fetch_assoc($result_cek);

    if (!$barang) {
        throw new Exception("Barang tidak ditemukan.");
    }

    if ($barang['jumlah_stok'] < $jumlah_barang_keluar) {
        throw new Exception("Stok barang \"{$barang['nama_barang']}\" tidak mencukupi. Stok tersedia: {$barang['jumlah_stok']}.");
    }

    // 3. Kurangi stok di tabel `barang`
    $stmt_update = mysqli_prepare($conn, "UPDATE barang SET jumlah_stok = jumlah_stok - ? WHERE id_barang = ?");
    mysqli_stmt_bind_param($stmt_update, 'ii', $jumlah_barang_keluar, $id_barang);
    if (!mysqli_stmt_execute($stmt_update)) {
        throw new Exception("Gagal mengupdate stok barang.");
    }

    // 4. Catat di tabel `barang_keluar`
    $stmt_insert = mysqli_prepare($conn, "INSERT INTO barang_keluar (id_barang, id_user, jumlah_barang_keluar, tanggal_keluar) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt_insert, 'iiis', $id_barang, $id_user, $jumlah_barang_keluar, $tanggal_keluar);
    if (!mysqli_stmt_execute($stmt_insert)) {
        throw new Exception("Gagal mencatat transaksi barang keluar.");
    }

    // Jika semua berhasil, commit transaksi
    mysqli_commit($conn);
    $_SESSION['success'] = "Data barang keluar berhasil disimpan.";

} catch (Exception $e) {
    // Jika ada error, rollback transaksi
    mysqli_rollback($conn);
    $_SESSION['error'] = $e->getMessage();
}

// Redirect kembali ke halaman barang keluar
header('Location: /sim_persedian_barang/pages/barang_keluar.php');
exit();
?>
