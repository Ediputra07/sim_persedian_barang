<?php
require_once __DIR__ . '/auth_check.php';
require_once __DIR__ . '/helper.php';

$current_page = basename($_SERVER['PHP_SELF']);

// Inisial nama user untuk avatar
function getInitials($username) {
    $words = explode('_', $username);
    $initials = '';
    foreach ($words as $word) {
        $initials .= strtoupper(substr($word, 0, 1));
    }
    return substr($initials, 0, 2);
}

// Label role
function getRoleLabel($role) {
    $labels = [
        'owner'        => 'Owner',
        'admin_gudang' => 'Admin Gudang',
        'kasir'        => 'Kasir'
    ];
    return $labels[$role] ?? $role;
}

// Topbar title sesuai halaman
$page_titles = [
    'dashboard.php'       => 'Dashboard',
    'data_barang.php'     => 'Data Barang',
    'data_supplier.php'   => 'Data Supplier',
    'barang_masuk.php'    => 'Barang Masuk',
    'barang_keluar.php'   => 'Barang Keluar',
    'laporan.php'         => 'Laporan',
    'manajemen_user.php'  => 'Manajemen User',
    'ubah_password.php'   => 'Ubah Password',
];
$topbar_title = $page_titles[$current_page] ?? 'InvenTrack Pro';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $topbar_title ?> — InvenTrack Pro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <link rel="icon" type="image/svg+xml" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/icons/box-seam.svg">
</head>
<body>

<div class="app-wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon">
                <i class="bi bi-box-seam text-white" style="font-size:1rem"></i>
            </div>
            <div>
                <div class="sidebar-brand-text">InvenTrack Pro</div>
                <div class="sidebar-brand-sub">Manajemen Inventaris</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section-label">Menu Utama</div>

            <a href="<?= BASE_URL ?>/pages/dashboard.php"
               class="sidebar-link <?= $current_page === 'dashboard.php' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <?php if (in_array($_SESSION['role'],['admin_gudang'])): ?>
            <a href="<?= BASE_URL ?>/pages/data_barang.php"
               class="sidebar-link <?= $current_page === 'data_barang.php' ? 'active' : '' ?>">
                <i class="bi bi-archive"></i> Data Barang
            </a>

            <a href="<?= BASE_URL ?>/pages/data_supplier.php"
               class="sidebar-link <?= $current_page === 'data_supplier.php' ? 'active' : '' ?>">
                <i class="bi bi-truck"></i> Supplier
            </a>

            <a href="<?= BASE_URL ?>/pages/barang_masuk.php"
               class="sidebar-link <?= $current_page === 'barang_masuk.php' ? 'active' : '' ?>">
                <i class="bi bi-box-arrow-in-down"></i> Barang Masuk
            </a>
            <?php endif; ?>

            <?php if (in_array($_SESSION['role'], ['kasir'])): ?>
            <a href="<?= BASE_URL ?>/pages/barang_keluar.php"
               class="sidebar-link <?= $current_page === 'barang_keluar.php' ? 'active' : '' ?>">
                <i class="bi bi-box-arrow-up"></i> Barang Keluar
            </a>
            <?php endif; ?>

            <a href="<?= BASE_URL ?>/pages/laporan.php"
               class="sidebar-link <?= $current_page === 'laporan.php' ? 'active' : '' ?>">
                <i class="bi bi-file-earmark-bar-graph"></i> Laporan
            </a>

            <?php if ($_SESSION['role'] === 'owner'): ?>
            <div class="sidebar-section-label" style="margin-top:8px">Pengaturan</div>
            <a href="<?= BASE_URL ?>/pages/manajemen_user.php"
               class="sidebar-link <?= $current_page === 'manajemen_user.php' ? 'active' : '' ?>">
                <i class="bi bi-people"></i> Manajemen User
            </a>
            <?php endif; ?>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-user-avatar">
                    <?= getInitials($_SESSION['username']) ?>
                </div>
                <div style="overflow:hidden">
                    <div class="sidebar-user-name"><?= htmlspecialchars($_SESSION['username']) ?></div>
                    <div class="sidebar-user-role"><?= getRoleLabel($_SESSION['role']) ?></div>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN WRAPPER -->
    <div class="main-wrapper">

        <!-- TOPBAR -->
        <header class="topbar">
            <div class="topbar-left">
                <span class="topbar-title">
                    <?= $topbar_title ?>
                </span>
            </div>
            <div class="topbar-right">
                <a href="<?= BASE_URL ?>/pages/ubah_password.php"
                   class="topbar-btn <?= $current_page === 'ubah_password.php' ? 'active' : '' ?>">
                    <i class="bi bi-key"></i> Ubah Password
                </a>
                <a href="#" class="topbar-btn logout"
                   data-bs-toggle="modal" data-bs-target="#modalLogout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="page-content">