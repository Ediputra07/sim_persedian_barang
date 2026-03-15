<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../config/database.php'; ?>

<?php
$success = $_SESSION['success'] ?? '';
$error   = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);

$result = mysqli_query($conn, "
    SELECT bk.*, b.nama_barang, b.jumlah_stok
    FROM barang_keluar bk
    JOIN barang b ON bk.id_barang = b.id_barang
    ORDER BY bk.tanggal_keluar DESC
");

$barang_list = mysqli_query($conn, "SELECT * FROM barang WHERE jumlah_stok > 0 ORDER BY nama_barang ASC");
?>

<h5 class="fw-bold mb-4"><i class="bi bi-box-arrow-up"></i> Barang Keluar</h5>

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
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i> Input Barang Keluar
        </button>
    </div>
</div>

<!-- List Barang Keluar -->
<div class="row g-3">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-start border-danger border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="fw-bold"><?= htmlspecialchars($row['nama_barang']) ?></h6>
                        <span class="badge bg-danger">-<?= $row['jumlah_barang_keluar'] ?></span>
                    </div>
                    <p class="mb-1 text-muted small">
                        <i class="bi bi-calendar"></i> <?= format_tanggal($row['tanggal_keluar']) ?>
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
                    <i class="bi bi-box-arrow-up fs-1 text-primary opacity-50"></i>
                    <h6 class="mt-3">Belum ada data barang keluar</h6>
                    <p class="small">Klik tombol "Input Barang Keluar" untuk menambahkan data</p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="bi bi-box-arrow-up"></i> Input Barang Keluar</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="/sim_persedian_barang/process/barang_keluar/simpan.php" method="POST" id="formBarangKeluar">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Barang</label>
                        <select name="id_barang" id="selectBarang" class="form-select" required>
                            <option value="">-- Pilih Barang --</option>
                            <?php while ($b = mysqli_fetch_assoc($barang_list)): ?>
                                <option value="<?= $b['id_barang'] ?>" 
                                        data-stok="<?= $b['jumlah_stok'] ?>">
                                    <?= htmlspecialchars($b['nama_barang']) ?>
                                    (Stok: <?= $b['jumlah_stok'] ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <!-- Info stok tersedia -->
                        <small class="text-muted" id="infoStok"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jumlah</label>
                        <input type="number" name="jumlah_barang_keluar" id="inputJumlah"
                              class="form-control" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="tanggal_keluar" class="form-control"
                              value="<?= date('Y-m-d') ?>"
                              max="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2" 
                                placeholder="Contoh: Rusak, Kadaluarsa, Terjual, dll"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="konfirmasiSimpan()">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan library SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Tampilkan info stok saat barang dipilih
document.getElementById('selectBarang').addEventListener('change', function () {
    const stok = this.options[this.selectedIndex].dataset.stok;
    const infoStok = document.getElementById('infoStok');
    const inputJumlah = document.getElementById('inputJumlah');

    if (stok !== undefined) {
        infoStok.textContent = 'Stok tersedia: ' + stok;
        inputJumlah.max = stok;
    } else {
        infoStok.textContent = '';
        inputJumlah.max = '';
    }
});

function konfirmasiSimpan() {
    const form = document.getElementById('formBarangKeluar');
    const barang = document.getElementById('selectBarang');
    const jumlah = document.getElementById('inputJumlah');
    const tanggal = form.querySelector('input[name="tanggal_keluar"]');
    const keterangan = form.querySelector('textarea[name="keterangan"]');

    // 1. Validasi Input Kosong
    if (!barang.value || !jumlah.value || !tanggal.value) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Mohon lengkapi semua data yang wajib diisi.',
            confirmButtonText: 'Oke'
        });
        return;
    }

    // 2. Validasi Logika Stok
    const stokTersedia = parseInt(barang.options[barang.selectedIndex].dataset.stok || 0);
    const jumlahKeluar = parseInt(jumlah.value);

    if (jumlahKeluar <= 0) {
        Swal.fire({
            icon: 'error',
            title: 'Jumlah Tidak Valid',
            text: 'Jumlah barang keluar harus lebih dari 0.',
            confirmButtonText: 'Oke'
        });
        return;
    }

    if (jumlahKeluar > stokTersedia) {
        Swal.fire({
            icon: 'error',
            title: 'Stok Tidak Cukup',
            text: `Stok saat ini hanya ${stokTersedia}. Anda mencoba mengeluarkan ${jumlahKeluar}.`,
            confirmButtonText: 'Oke'
        });
        return;
    }

    // Ambil detail data untuk ditampilkan di popup
    const namaBarangTeks = barang.options[barang.selectedIndex].text;
    const namaBarang = namaBarangTeks.split('(')[0].trim();
    const keteranganValue = keterangan.value.trim() || '-';

    const detailHtml = `
        <div style="text-align: left; padding: 0 1rem;">
            <p class="mb-1"><strong>Nama Barang:</strong><br>${namaBarang}</p>
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
        confirmButtonColor: '#dc3545',
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