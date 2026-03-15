<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!defined('BASE_URL')) {
    define('BASE_URL', '/sim_persedian_barang');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan — InvenTrack Pro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
<div class="d-flex align-items-center justify-content-center" style="min-height:100vh">
    <div class="text-center">
        <i class="bi bi-exclamation-circle text-primary" style="font-size:5rem"></i>
        <h1 class="fw-bold mt-3" style="font-size:4rem">404</h1>
        <h5 class="text-muted mb-4">Halaman tidak ditemukan</h5>
        <?php if (isset($_SESSION['id_user'])): ?>
            <a href="<?= BASE_URL ?>/pages/dashboard.php" class="btn btn-primary">
                <i class="bi bi-speedometer2"></i> Kembali ke Dashboard
            </a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>/login.php" class="btn btn-primary">
                <i class="bi bi-box-arrow-in-right"></i> Kembali ke Login
            </a>
        <?php endif; ?>
    </div>
</div>
</body>
</html>