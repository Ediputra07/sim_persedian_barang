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

$id       = $_POST['id_user'];
$username = trim($_POST['username']);
$password = $_POST['password'];
$role     = $_POST['role'];

// Cek duplikasi username kecuali dirinya sendiri
$cek = mysqli_prepare($conn, "SELECT id_user FROM users WHERE username = ? AND id_user != ?");
mysqli_stmt_bind_param($cek, 'si', $username, $id);
mysqli_stmt_execute($cek);
mysqli_stmt_store_result($cek);

if (mysqli_stmt_num_rows($cek) > 0) {
    $_SESSION['error'] = "Username \"$username\" sudah digunakan user lain.";
    header('Location: /sim_persedian_barang/pages/manajemen_user.php');
    exit();
}

// Kalau password diisi, update sekalian. Kalau kosong, biarkan password lama
if (!empty($password)) {
    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password minimal 6 karakter.";
        header('Location: /sim_persedian_barang/pages/manajemen_user.php');
        exit();
    }
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, "UPDATE users SET username=?, password=?, role=? WHERE id_user=?");
    mysqli_stmt_bind_param($stmt, 'sssi', $username, $hashed, $role, $id);
} else {
    $stmt = mysqli_prepare($conn, "UPDATE users SET username=?, role=? WHERE id_user=?");
    mysqli_stmt_bind_param($stmt, 'ssi', $username, $role, $id);
}

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "User \"$username\" berhasil diupdate.";
} else {
    $_SESSION['error'] = "Gagal mengupdate user.";
}

header('Location: /sim_persedian_barang/pages/manajemen_user.php');
exit();
?>