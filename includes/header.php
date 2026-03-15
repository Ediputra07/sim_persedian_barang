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
    <link rel="icon" type="image/png" 
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/icons/box-seam.svg">
</head>
<body>
<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

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
                <!-- Dashboard — semua role -->
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'dashboard.php' ? 'active fw-bold' : '' ?>" href="<?= BASE_URL ?>/pages/dashboard.php">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>

                <!-- Hanya owner & admin gudang -->
                <?php if (in_array($_SESSION['role'], ['owner', 'admin_gudang'])): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'data_barang.php' ? 'active fw-bold' : '' ?>" href="<?= BASE_URL ?>/pages/data_barang.php">
                        <i class="bi bi-archive"></i> Data Barang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'data_supplier.php' ? 'active fw-bold' : '' ?>" href="<?= BASE_URL ?>/pages/data_supplier.php">
                        <i class="bi bi-truck"></i> Supplier
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'barang_masuk.php' ? 'active fw-bold' : '' ?>" href="<?= BASE_URL ?>/pages/barang_masuk.php">
                        <i class="bi bi-box-arrow-in-down"></i> Barang Masuk
                    </a>
                </li>
                <?php endif; ?>

                <!-- Hanya owner & kasir -->
                <?php if (in_array($_SESSION['role'], ['owner', 'kasir'])): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'barang_keluar.php' ? 'active fw-bold' : '' ?>" href="<?= BASE_URL ?>/pages/barang_keluar.php">
                        <i class="bi bi-box-arrow-up"></i> Barang Keluar
                    </a>
                </li>
                <?php endif; ?>

                <!-- Semua role -->
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'laporan.php' ? 'active fw-bold' : '' ?>" href="<?= BASE_URL ?>/pages/laporan.php">
                        <i class="bi bi-file-earmark-bar-graph"></i> Laporan
                    </a>
                </li>

                <!-- Hanya owner -->
                <?php if ($_SESSION['role'] === 'owner'): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'manajemen_user.php' ? 'active fw-bold' : '' ?>" href="<?= BASE_URL ?>/pages/manajemen_user.php">
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
                        <span class="badge bg-<?= $_SESSION['role'] === 'owner' ? 'success' : 'info' ?> text-white ms-1">
                            <?= ucfirst(str_replace('_', ' ', $_SESSION['role'])) ?>
                        </span>
                    </span>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link <?= $current_page === 'ubah_password.php' ? 'active fw-bold' : '' ?>" href="<?= BASE_URL ?>/pages/ubah_password.php">
                        <i class="bi bi-key"></i> Ubah Password
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="#"
                    data-bs-toggle="modal" data-bs-target="#modalLogout">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Logout -->
<div class="modal fade" id="modalLogout" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-0">Yakin ingin keluar dari sistem?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Batal
                </button>
                <a href="<?= BASE_URL ?>/process/auth/logout.php" class="btn btn-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Konten utama -->
<div class="container-fluid mt-4 px-4">