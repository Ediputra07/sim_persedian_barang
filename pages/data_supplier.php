<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../config/database.php'; ?>

<?php
$success = $_SESSION['success'] ?? '';
$error   = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);

$result = mysqli_query($conn, "SELECT * FROM supplier ORDER BY nama_supplier ASC");
?>

<h5 class="fw-bold mb-4"><i class="bi bi-truck"></i> Data Supplier</h5>

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
            <i class="bi bi-plus-lg"></i> Tambah Supplier
        </button>
    </div>
</div>

<!-- Kartu Supplier -->
<div class="row g-3">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-4 col-sm-6">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-title fw-bold">
                        <i class="bi bi-building"></i>
                        <?= htmlspecialchars($row['nama_supplier']) ?>
                    </h6>
                    <p class="card-text mb-1">
                        <i class="bi bi-telephone text-muted"></i>
                        <?= htmlspecialchars($row['kontak'] ?? '-') ?>
                    </p>
                    <p class="card-text mb-0">
                        <i class="bi bi-geo-alt text-muted"></i>
                        <?= htmlspecialchars($row['alamat'] ?? '-') ?>
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#modalEdit"
                        data-id="<?= $row['id_supplier'] ?>"
                        data-nama="<?= htmlspecialchars($row['nama_supplier']) ?>"
                        data-kontak="<?= htmlspecialchars($row['kontak']) ?>"
                        data-alamat="<?= htmlspecialchars($row['alamat']) ?>">
                        <i class="bi bi-pencil"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#modalHapus"
                        data-id="<?= $row['id_supplier'] ?>"
                        data-nama="<?= htmlspecialchars($row['nama_supplier']) ?>">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center text-muted py-5">
                    <i class="bi bi-truck fs-1"></i>
                    <p class="mt-2">Belum ada data supplier</p>
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
                <h5 class="modal-title"><i class="bi bi-plus-lg"></i> Tambah Supplier</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="/sim_persedian_barang/process/supplier/tambah.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kontak</label>
                        <input type="text" name="kontak" class="form-control" placeholder="No. HP / Telepon">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap"></textarea>
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
                <h5 class="modal-title"><i class="bi bi-pencil"></i> Edit Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/sim_persedian_barang/process/supplier/edit.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_supplier" id="edit_id">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Supplier</label>
                        <input type="text" name="nama_supplier" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kontak</label>
                        <input type="text" name="kontak" id="edit_kontak" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea name="alamat" id="edit_alamat" class="form-control" rows="3"></textarea>
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
                <h5 class="modal-title"><i class="bi bi-trash"></i> Hapus Supplier</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="/sim_persedian_barang/process/supplier/hapus.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_supplier" id="hapus_id">
                    <p>Yakin ingin menghapus supplier <strong id="hapus_nama"></strong>?</p>
                    <small class="text-muted">Supplier yang masih memiliki barang tidak bisa dihapus.</small>
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
    document.getElementById('edit_id').value      = btn.dataset.id;
    document.getElementById('edit_nama').value    = btn.dataset.nama;
    document.getElementById('edit_kontak').value  = btn.dataset.kontak;
    document.getElementById('edit_alamat').value  = btn.dataset.alamat;
});

document.getElementById('modalHapus').addEventListener('show.bs.modal', function (e) {
    const btn = e.relatedTarget;
    document.getElementById('hapus_id').value            = btn.dataset.id;
    document.getElementById('hapus_nama').textContent    = btn.dataset.nama;
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>