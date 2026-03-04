<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../config/database.php'; ?>

<?php
// Ambil pesan sukses/error jika ada
$success = $_SESSION['success'] ?? '';
$error   = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);

// Query semua barang + nama supplier
$keyword = trim($_GET['search'] ?? '');
if ($keyword !== '') {
    $stmt = mysqli_prepare($conn, "
        SELECT b.*, s.nama_supplier 
        FROM barang b 
        LEFT JOIN supplier s ON b.id_supplier = s.id_supplier
        WHERE b.nama_barang LIKE ?
        ORDER BY b.nama_barang ASC
    ");
    $like = "%$keyword%";
    mysqli_stmt_bind_param($stmt, 's', $like);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query($conn, "
        SELECT b.*, s.nama_supplier 
        FROM barang b 
        LEFT JOIN supplier s ON b.id_supplier = s.id_supplier
        ORDER BY b.nama_barang ASC
    ");
}

// Ambil semua supplier untuk dropdown form
$suppliers = mysqli_query($conn, "SELECT * FROM supplier ORDER BY nama_supplier ASC");
?>

<h5 class="fw-bold mb-4"><i class="bi bi-archive"></i> Data Barang</h5>

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
    <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-2">
        <!-- Form Pencarian -->
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" 
                    placeholder="Cari nama barang..." 
                    value="<?= htmlspecialchars($keyword) ?>">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i>
            </button>
            <?php if ($keyword): ?>
                <a href="/sim_persedian_barang/pages/data_barang.php" class="btn btn-secondary">
                    <i class="bi bi-x"></i>
                </a>
            <?php endif; ?>
        </form>

        <!-- Tombol Tambah -->
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i> Tambah Barang
        </button>
    </div>
</div>

<!-- Tabel Data Barang -->
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Supplier</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                        <td>Rp <?= number_format($row['harga_barang'], 0, ',', '.') ?></td>
                        <td>
                            <?php if ($row['jumlah_stok'] == 0): ?>
                                <span class="badge bg-danger">Habis</span>
                            <?php elseif ($row['jumlah_stok'] <= 5): ?>
                                <span class="badge bg-warning text-dark"><?= $row['jumlah_stok'] ?></span>
                            <?php else: ?>
                                <span class="badge bg-success"><?= $row['jumlah_stok'] ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['nama_supplier'] ?? '-') ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalEdit"
                                data-id="<?= $row['id_barang'] ?>"
                                data-nama="<?= htmlspecialchars($row['nama_barang']) ?>"
                                data-deskripsi="<?= htmlspecialchars($row['deskripsi']) ?>"
                                data-harga="<?= $row['harga_barang'] ?>"
                                data-stok="<?= $row['jumlah_stok'] ?>"
                                data-supplier="<?= $row['id_supplier'] ?>">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#modalHapus"
                                data-id="<?= $row['id_barang'] ?>"
                                data-nama="<?= htmlspecialchars($row['nama_barang']) ?>">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-3">
                            <?= $keyword ? "Tidak ada barang dengan kata kunci \"$keyword\"" : "Belum ada data barang" ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="bi bi-plus-lg"></i> Tambah Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="/sim_persedian_barang/process/barang/tambah.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi Barang</label>
                        <input type="text" name="deskripsi" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga_barang" class="form-control" min="0" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Supplier</label>
                        <select name="id_supplier" class="form-select" required>
                            <option value="">-- Pilih Supplier --</option>
                            <?php 
                            mysqli_data_seek($suppliers, 0);
                            while ($s = mysqli_fetch_assoc($suppliers)): ?>
                                <option value="<?= $s['id_supplier'] ?>">
                                    <?= htmlspecialchars($s['nama_supplier']) ?>
                                </option>
                            <?php endwhile; ?>
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
                <h5 class="modal-title"><i class="bi bi-pencil"></i> Edit Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/sim_persedian_barang/process/barang/edit.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_barang" id="edit_id">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Barang</label>
                        <input type="text" name="nama_barang" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi Barang</label>
                        <input type="text" name="deskripsi" id="edit_deskripsi" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga_barang" id="edit_harga" class="form-control" min="0" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Supplier</label>
                        <select name="id_supplier" id="edit_supplier" class="form-select" required>
                            <option value="">-- Pilih Supplier --</option>
                            <?php 
                            mysqli_data_seek($suppliers, 0);
                            while ($s = mysqli_fetch_assoc($suppliers)): ?>
                                <option value="<?= $s['id_supplier'] ?>">
                                    <?= htmlspecialchars($s['nama_supplier']) ?>
                                </option>
                            <?php endwhile; ?>
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
                <h5 class="modal-title"><i class="bi bi-trash"></i> Hapus Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="/sim_persedian_barang/process/barang/hapus.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_barang" id="hapus_id">
                    <p>Yakin ingin menghapus barang <strong id="hapus_nama"></strong>?</p>
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
// Isi data ke modal edit
document.getElementById('modalEdit').addEventListener('show.bs.modal', function (e) {
    const btn = e.relatedTarget;
    document.getElementById('edit_id').value       = btn.dataset.id;
    document.getElementById('edit_nama').value     = btn.dataset.nama;
    document.getElementById('edit_deskripsi').value    = btn.dataset.deskripsi;
    document.getElementById('edit_harga').value    = btn.dataset.harga;
    document.getElementById('edit_supplier').value = btn.dataset.supplier;
});

// Isi data ke modal hapus
document.getElementById('modalHapus').addEventListener('show.bs.modal', function (e) {
    const btn = e.relatedTarget;
    document.getElementById('hapus_id').value   = btn.dataset.id;
    document.getElementById('hapus_nama').textContent = btn.dataset.nama;
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>