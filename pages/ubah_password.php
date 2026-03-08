<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../config/database.php'; ?>

<?php
$success = $_SESSION['success'] ?? '';
$error   = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>

<h5 class="fw-bold mb-4"><i class="bi bi-key"></i> Ubah Password</h5>

<div class="row justify-content-center">
    <div class="col-md-6">

        <?php if ($success): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle"></i> <?= htmlspecialchars($success) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle"></i> <?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-shield-lock"></i> Ganti Password Akun
            </div>
            <div class="card-body">
                <form action="/sim_persedian_barang/process/user/ubah_password.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Lama</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password_lama" id="pass_lama"
                                   class="form-control" required>
                            <button type="button" class="btn btn-outline-secondary toggle-pass"
                                    data-target="pass_lama">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password_baru" id="pass_baru"
                                   class="form-control"
                                   placeholder="Minimal 6 karakter" required>
                            <button type="button" class="btn btn-outline-secondary toggle-pass"
                                    data-target="pass_baru">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="konfirmasi_password" id="pass_konfirm"
                                   class="form-control"
                                   placeholder="Ulangi password baru" required>
                            <button type="button" class="btn btn-outline-secondary toggle-pass"
                                    data-target="pass_konfirm">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <!-- Indikator cocok/tidak -->
                        <small id="infoKonfirm" class="mt-1 d-block"></small>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Simpan Password Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
// Toggle show/hide password
document.querySelectorAll('.toggle-pass').forEach(function (btn) {
    btn.addEventListener('click', function () {
        const target = document.getElementById(this.dataset.target);
        const icon   = this.querySelector('i');
        if (target.type === 'password') {
            target.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            target.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    });
});

// Cek kecocokan password baru & konfirmasi secara realtime
document.getElementById('pass_konfirm').addEventListener('input', function () {
    const baru    = document.getElementById('pass_baru').value;
    const konfirm = this.value;
    const info    = document.getElementById('infoKonfirm');

    if (konfirm === '') {
        info.textContent = '';
    } else if (baru === konfirm) {
        info.textContent = '✅ Password cocok';
        info.className   = 'mt-1 d-block text-success';
    } else {
        info.textContent = '❌ Password tidak cocok';
        info.className   = 'mt-1 d-block text-danger';
    }
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>