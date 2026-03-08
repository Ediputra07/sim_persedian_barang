<?php 
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/helper.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InvenTrack Pro</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>/pages/dashboard.php">
            <i class="bi bi-box-seam"></i> InvenTrack Pro
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/pages/dashboard.php">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/pages/data_barang.php">
                        <i class="bi bi-archive"></i> Data Barang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/pages/data_supplier.php">
                        <i class="bi bi-truck"></i> Supplier
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/pages/barang_masuk.php">
                        <i class="bi bi-box-arrow-in-down"></i> Barang Masuk
                    </a>
                </li>

                <?php if ($_SESSION['role'] !== 'admin_gudang'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/pages/barang_keluar.php">
                        <i class="bi bi-box-arrow-up"></i> Barang Keluar
                    </a>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/pages/laporan.php">
                        <i class="bi bi-file-earmark-bar-graph"></i> Laporan
                    </a>
                </li>

                <?php if ($_SESSION['role'] === 'owner'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/pages/manajemen_user.php">
                        <i class="bi bi-people"></i> User
                    </a>
                </li>
                <?php endif; ?>
            </ul>

            <!-- Info user & logout -->
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-3">
                    <span class="text-white">
                        <i class="bi bi-person-circle"></i>
                        <?= htmlspecialchars($_SESSION['username']) ?>
                        <span class="badge bg-warning text-dark ms-1">
                            <?= ucfirst(str_replace('_', ' ', $_SESSION['role'])) ?>
                        </span>
                    </span>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link" href="<?= BASE_URL ?>/pages/ubah_password.php">
                        <i class="bi bi-key"></i> Ubah Password
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="<?= BASE_URL ?>/process/auth/logout.php"
                    onclick="return confirm('Yakin ingin logout?')">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Konten utama -->
<div class="container-fluid mt-4 px-4">