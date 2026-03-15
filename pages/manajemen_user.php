<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../config/database.php'; ?>

<?php
// Hanya owner yang boleh akses
if ($_SESSION['role'] !== 'owner') {
    header('Location: /sim_persedian_barang/pages/dashboard.php');
    exit();
}

$success = $_SESSION['success'] ?? '';
$error   = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);

$result = mysqli_query($conn, "SELECT * FROM users ORDER BY role ASC, username ASC");
?>

<h5 class="fw-bold mb-4"><i class="bi bi-people"></i> Manajemen User</h5>

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

<!-- Toolbar -->
<div class="card mb-3">
    <div class="card-body d-flex justify-content-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-person-plus"></i> Tambah User
        </button>
    </div>
</div>

<!-- Kartu User -->
<div class="row g-3">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-4 col-sm-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                             style="width:48px;height:48px">
                            <i class="bi bi-person-fill text-white fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold"><?= htmlspecialchars($row['username']) ?></h6>
                            <span class="badge 
                                <?php
                                    if ($row['role'] === 'owner') echo 'bg-danger';
                                    elseif ($row['role'] === 'admin_gudang') echo 'bg-primary';
                                    else echo 'bg-success';
                                ?>">
                                <?= ucfirst(str_replace('_', ' ', $row['role'])) ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <!-- Tidak bisa edit/hapus akun diri sendiri -->
                    <?php if ($row['id_user'] !== $_SESSION['id_user']): ?>
                        <button class="btn btn-sm btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEdit"
                            data-id="<?= $row['id_user'] ?>"
                            data-username="<?= htmlspecialchars($row['username']) ?>"
                            data-role="<?= $row['role'] ?>">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#modalHapus"
                            data-id="<?= $row['id_user'] ?>"
                            data-username="<?= htmlspecialchars($row['username']) ?>">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    <?php else: ?>
                        <span class="text-muted small fst-italic">Akun aktif</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center text-muted py-5">
                    <i class="bi bi-people fs-1 text-primary opacity-50"></i>
                    <h6 class="mt-3">Belum ada data user</h6>
                    <p class="small">Klik tombol "Tambah User" untuk menambahkan data</p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="bi bi-person-plus"></i> Tambah User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="/sim_persedian_barang/process/user/tambah.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Minimal 6 karakter" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin_gudang">Admin Gudang</option>
                            <option value="kasir">Kasir</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title"><i class="bi bi-pencil"></i> Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/sim_persedian_barang/process/user/edit.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_user" id="edit_id">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username</label>
                        <input type="text" name="username" id="edit_username"
                               class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Baru</label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Role</label>
                        <select name="role" id="edit_role" class="form-select" required>
                            <option value="admin_gudang">Admin Gudang</option>
                            <option value="kasir">Kasir</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="bi bi-trash"></i> Hapus User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="/sim_persedian_barang/process/user/hapus.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_user" id="hapus_id">
                    <p>Yakin ingin menghapus user <strong id="hapus_username"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('modalEdit').addEventListener('show.bs.modal', function (e) {
    const btn = e.relatedTarget;
    document.getElementById('edit_id').value       = btn.dataset.id;
    document.getElementById('edit_username').value = btn.dataset.username;
    document.getElementById('edit_role').value     = btn.dataset.role;
});

document.getElementById('modalHapus').addEventListener('show.bs.modal', function (e) {
    const btn = e.relatedTarget;
    document.getElementById('hapus_id').value             = btn.dataset.id;
    document.getElementById('hapus_username').textContent = btn.dataset.username;
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>