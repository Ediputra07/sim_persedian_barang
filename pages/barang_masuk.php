<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../config/database.php'; ?>

<?php
$success = $_SESSION['success'] ?? '';
$error   = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);

// Query semua barang masuk
$result = mysqli_query($conn, "
    SELECT bm.*, b.nama_barang, s.nama_supplier
    FROM barang_masuk bm
    JOIN barang b ON bm.id_barang = b.id_barang
    LEFT JOIN supplier s ON bm.id_supplier = s.id_supplier
    ORDER BY bm.tanggal_masuk DESC
");

// Dropdown barang & supplier
$barang_list   = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_barang ASC");
$supplier_list = mysqli_query($conn, "SELECT * FROM supplier ORDER BY nama_supplier ASC");
?>

<h5 class="fw-bold mb-4"><i class="bi bi-box-arrow-in-down"></i> Barang Masuk</h5>

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
            <i class="bi bi-plus-lg"></i> Input Barang Masuk
        </button>
    </div>
</div>

<!-- List Barang Masuk -->
<div class="row g-3">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-start border-success border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="fw-bold"><?= htmlspecialchars($row['nama_barang']) ?></h6>
                        <span class="badge bg-success">+<?= $row['jumlah_barang_masuk'] ?></span>
                    </div>
                    <p class="mb-1 text-muted small">
                        <i class="bi bi-truck"></i> <?= htmlspecialchars($row['nama_supplier'] ?? '-') ?>
                    </p>
                    <p class="mb-1 text-muted small">
                        <i class="bi bi-calendar"></i> <?= format_tanggal($row['tanggal_masuk']) ?>
                    </p>
                    <?php if (!empty($row['keterangan'])): ?>
                    <p class="mb-0 text-muted small">
                        <i class="bi bi-chat-left-text"></i> <?= htmlspecialchars($row['keterangan']) ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center text-muted py-5">
                    <i class="bi bi-box-arrow-in-down fs-1"></i>
                    <p class="mt-2">Belum ada data barang masuk</p>
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
                <h5 class="modal-title"><i class="bi bi-box-arrow-in-down"></i> Input Barang Masuk</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="/sim_persedian_barang/process/barang_masuk/simpan.php" method="POST" id="formBarangMasuk">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Barang</label>
                        <select name="id_barang" class="form-select" required>
                            <option value="">-- Pilih Barang --</option>
                            <?php while ($b = mysqli_fetch_assoc($barang_list)): ?>
                                <option value="<?= $b['id_barang'] ?>">
                                    <?= htmlspecialchars($b['nama_barang']) ?>
                                    (Stok: <?= $b['jumlah_stok'] ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Supplier</label>
                        <select name="id_supplier" class="form-select" required>
                            <option value="">-- Pilih Supplier --</option>
                            <?php while ($s = mysqli_fetch_assoc($supplier_list)): ?>
                                <option value="<?= $s['id_supplier'] ?>">
                                    <?= htmlspecialchars($s['nama_supplier']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jumlah</label>
                        <input type="number" name="jumlah_barang_masuk" class="form-control" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="tanggal_masuk" class="form-control" 
                                value="<?= date('Y-m-d') ?>" 
                                max="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2" 
                                placeholder="Opsional"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="konfirmasiSimpan()">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan library SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function konfirmasiSimpan() {
    const form = document.getElementById('formBarangMasuk');
    const barang = form.querySelector('select[name="id_barang"]');
    const supplier = form.querySelector('select[name="id_supplier"]');
    const jumlah = form.querySelector('input[name="jumlah_barang_masuk"]');
    const tanggal = form.querySelector('input[name="tanggal_masuk"]');
    const keterangan = form.querySelector('textarea[name="keterangan"]');

    // 1. Validasi Input Kosong
    if (!barang.value || !supplier.value || !jumlah.value || !tanggal.value) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Mohon lengkapi semua data yang wajib diisi.',
            confirmButtonText: 'Oke'
        });
        return;
    }

    // 2. Validasi Jumlah Positif
    if (parseInt(jumlah.value) <= 0) {
         Swal.fire({
            icon: 'error',
            title: 'Jumlah Tidak Valid',
            text: 'Jumlah barang masuk harus lebih dari 0.',
            confirmButtonText: 'Oke'
        });
        return;
    }

    // Ambil detail data untuk ditampilkan di popup
    const namaBarangTeks = barang.options[barang.selectedIndex].text.split('(')[0].trim();
    const namaSupplierTeks = supplier.options[supplier.selectedIndex].text;
    const keteranganValue = keterangan.value.trim() || '-';

    const detailHtml = `
        <div style="text-align: left; padding: 0 1rem;">
            <p class="mb-1"><strong>Barang:</strong><br>${namaBarangTeks}</p>
            <p class="mb-1"><strong>Supplier:</strong><br>${namaSupplierTeks}</p>
            <p class="mb-1"><strong>Jumlah:</strong><br>${jumlah.value}</p>
            <p class="mb-1"><strong>Tanggal:</strong><br>${tanggal.value}</p>
            <p class="mb-0"><strong>Keterangan:</strong><br>${keteranganValue}</p>
        </div>
    `;

    // 3. Jika tidak ada error, tampilkan Konfirmasi Simpan
    Swal.fire({
        title: 'Simpan Data Ini?',
        html: detailHtml,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Simpan',
        cancelButtonText: 'Batalkan',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>