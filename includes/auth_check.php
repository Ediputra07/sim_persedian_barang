<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined('BASE_URL')) {
    define('BASE_URL', '/sim_persedian_barang');
}

require_once __DIR__ . '/../config/database.php';

// Session timeout otomatis setelah 30 menit tidak aktif
$timeout = 1800; // 30 menit dalam detik

if (isset($_SESSION['last_activity'])) {
    if (time() - $_SESSION['last_activity'] > $timeout) {
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . '/login.php?timeout=1');
        exit();
    }
}
$_SESSION['last_activity'] = time();

// Cek apakah user yang sedang login masih ada di database
if (isset($_SESSION['id_user'])) {
    $cek_user = mysqli_prepare($conn, "SELECT id_user FROM users WHERE id_user = ?");
    mysqli_stmt_bind_param($cek_user, 'i', $_SESSION['id_user']);
    mysqli_stmt_execute($cek_user);
    mysqli_stmt_store_result($cek_user);

    if (mysqli_stmt_num_rows($cek_user) === 0) {
        // Akun sudah dihapus, paksa logout
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . '/login.php');
        exit();
    }
}

$current_file = basename($_SERVER['PHP_SELF']);

// Halaman yang boleh diakses tanpa login
$public_pages = ['login.php'];

if (!isset($_SESSION['id_user']) && !in_array($current_file, $public_pages)) {
    header('Location: ' . BASE_URL . '/login.php');
    exit();
}

// Aturan akses per role per halaman
$akses = [
    'admin_gudang' => [
        'dashboard.php',
        'data_barang.php',
        'data_supplier.php',
        'barang_masuk.php',
        'laporan.php',
        'ubah_password.php'
    ],
    'kasir' => [
        'dashboard.php',
        'barang_keluar.php',
        'laporan.php',
        'ubah_password.php'
    ],
    'owner' => [
        'dashboard.php',
        'data_barang.php',
        'data_supplier.php',
        'barang_masuk.php',
        'barang_keluar.php',
        'laporan.php',
        'manajemen_user.php',
        'ubah_password.php'
    ]
];

$current_path = $_SERVER['PHP_SELF'];
$is_process   = strpos($current_path, '/process/') !== false;

// Cek akses hanya untuk halaman di folder pages/
if (!$is_process && isset($_SESSION['role']) && !in_array($current_file, $public_pages)) {
    $role = $_SESSION['role'];
    if (isset($akses[$role]) && !in_array($current_file, $akses[$role])) {
        $_SESSION['error'] = "Anda tidak memiliki akses ke halaman tersebut.";
        header('Location: ' . BASE_URL . '/pages/dashboard.php');
        exit();
    }
}
?>