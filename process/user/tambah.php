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

$username = trim($_POST['username']);
$password = $_POST['password'];
$role     = $_POST['role'];

// Validasi panjang password
if (strlen($password) < 6) {
    $_SESSION['error'] = "Password minimal 6 karakter.";
    header('Location: /sim_persedian_barang/pages/manajemen_user.php');
    exit();
}

// Cek duplikasi username
$cek = mysqli_prepare($conn, "SELECT id_user FROM users WHERE username = ?");
mysqli_stmt_bind_param($cek, 's', $username);
mysqli_stmt_execute($cek);
mysqli_stmt_store_result($cek);

if (mysqli_stmt_num_rows($cek) > 0) {
    $_SESSION['error'] = "Username \"$username\" sudah digunakan.";
    header('Location: /sim_persedian_barang/pages/manajemen_user.php');
    exit();
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conn, "INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'sss', $username, $hashed, $role);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "User \"$username\" berhasil ditambahkan.";
} else {
    $_SESSION['error'] = "Gagal menambahkan user.";
}

header('Location: /sim_persedian_barang/pages/manajemen_user.php');
exit();
?>