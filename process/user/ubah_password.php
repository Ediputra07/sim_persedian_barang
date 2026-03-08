<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sim_persedian_barang/pages/ubah_password.php');
    exit();
}

$id_user          = $_SESSION['id_user'];
$password_lama    = $_POST['password_lama'];
$password_baru    = $_POST['password_baru'];
$konfirmasi       = $_POST['konfirmasi_password'];

// Validasi password baru minimal 6 karakter
if (strlen($password_baru) < 6) {
    $_SESSION['error'] = "Password baru minimal 6 karakter.";
    header('Location: /sim_persedian_barang/pages/ubah_password.php');
    exit();
}

// Validasi password baru dan konfirmasi harus sama
if ($password_baru !== $konfirmasi) {
    $_SESSION['error'] = "Password baru dan konfirmasi tidak cocok.";
    header('Location: /sim_persedian_barang/pages/ubah_password.php');
    exit();
}

// Ambil password lama dari database
$stmt = mysqli_prepare($conn, "SELECT password FROM users WHERE id_user = ?");
mysqli_stmt_bind_param($stmt, 'i', $id_user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user   = mysqli_fetch_assoc($result);

// Verifikasi password lama
if (!password_verify($password_lama, $user['password'])) {
    $_SESSION['error'] = "Password lama tidak sesuai.";
    header('Location: /sim_persedian_barang/pages/ubah_password.php');
    exit();
}

// Pastikan password baru tidak sama dengan password lama
if (password_verify($password_baru, $user['password'])) {
    $_SESSION['error'] = "Password baru tidak boleh sama dengan password lama.";
    header('Location: /sim_persedian_barang/pages/ubah_password.php');
    exit();
}

// Simpan password baru
$hashed = password_hash($password_baru, PASSWORD_DEFAULT);
$update = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE id_user = ?");
mysqli_stmt_bind_param($update, 'si', $hashed, $id_user);

if (mysqli_stmt_execute($update)) {
    $_SESSION['success'] = "Password berhasil diubah.";
} else {
    $_SESSION['error'] = "Gagal mengubah password.";
}

header('Location: /sim_persedian_barang/pages/ubah_password.php');
exit();
?>