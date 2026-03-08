<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined('BASE_URL')) {
    define('BASE_URL', '/sim_persedian_barang');
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

// Cek akses jika sudah login
if (isset($_SESSION['role']) && !in_array($current_file, $public_pages)) {
    $role = $_SESSION['role'];
    if (isset($akses[$role]) && !in_array($current_file, $akses[$role])) {
        // Redirect ke dashboard dengan pesan error
        $_SESSION['error'] = "Anda tidak memiliki akses ke halaman tersebut.";
        header('Location: ' . BASE_URL . '/pages/dashboard.php');
        exit();
    }
}
?>