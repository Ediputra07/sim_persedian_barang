<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../config/database.php';

if ($_SESSION['role'] !== 'owner') {
    header('Location: /sim_persedian_barang/pages/dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sim_persedian_barang/pages/manajemen_user.php');
    exit();
}

$id = $_POST['id_user'];

// Tidak bisa hapus diri sendiri
if ($id == $_SESSION['id_user']) {
    $_SESSION['error'] = "Tidak bisa menghapus akun yang sedang digunakan.";
    header('Location: /sim_persedian_barang/pages/manajemen_user.php');
    exit();
}

$cek = mysqli_query($conn, "SELECT username FROM users WHERE id_user = $id");
$user = mysqli_fetch_assoc($cek);

$stmt = mysqli_prepare($conn, "DELETE FROM users WHERE id_user = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "User \"{$user['username']}\" berhasil dihapus.";
} else {
    $_SESSION['error'] = "Gagal menghapus user.";
}

header('Location: /sim_persedian_barang/pages/manajemen_user.php');
exit();
?>