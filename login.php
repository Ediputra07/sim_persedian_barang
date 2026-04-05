<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header('Location: /sim_persedian_barang/pages/dashboard.php');
    exit();
}

$error = $_SESSION['error'] ?? '';
$timeout_msg = isset($_GET['timeout']) ? 'Sesi Anda telah berakhir. Silakan login kembali.' : '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — InvenTrack Pro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/sim_persedian_barang/assets/css/style.css">
    <link rel="icon" type="image/svg+xml" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/icons/box-seam.svg">
    <style>
        .login-page {
            min-height: 100vh;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .login-page::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            background: #ede9fe;
            border-radius: 50%;
            opacity: 0.6;
        }
        .login-page::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -60px;
            width: 240px;
            height: 240px;
            background: #d1fae5;
            border-radius: 50%;
            opacity: 0.5;
        }
        .login-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            padding: 36px;
            position: relative;
            z-index: 1;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
        }
        .login-logo {
            width: 52px;
            height: 52px;
            background: #6366f1;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        .login-title {
            text-align: center;
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
        }
        .login-subtitle {
            text-align: center;
            font-size: 0.8rem;
            color: #64748b;
            margin-top: 4px;
            margin-bottom: 24px;
        }
    </style>
</head>
<body>
<div class="login-page">
    <div class="login-card">
        <div class="login-logo">
            <i class="bi bi-box-seam text-white" style="font-size:1.4rem"></i>
        </div>
        <div class="login-title">InvenTrack Pro</div>
        <div class="login-subtitle">Sistem Manajemen Inventaris UMKM</div>

        <?php if ($timeout_msg): ?>
            <div class="alert alert-warning mb-3">
                <i class="bi bi-clock"></i> <?= $timeout_msg ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-3">
                <i class="bi bi-exclamation-triangle"></i> <?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="/sim_persedian_barang/process/auth/login_process.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control" name="username"
                           placeholder="Masukkan username" required autofocus>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" name="password"
                           id="password" placeholder="Masukkan password" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary" style="padding:10px;font-size:0.88rem;">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    const pwd = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');
    if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        pwd.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
});
</script>
</body>
</html>