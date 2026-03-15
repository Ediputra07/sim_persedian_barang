<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../config/database.php'; ?>

<?php
// Filter tanggal
$tgl_mulai = $_GET['tgl_mulai'] ?? date('Y-m-01'); // default awal bulan ini
$tgl_akhir = $_GET['tgl_akhir'] ?? date('Y-m-d');  // default hari ini
$tipe      = $_GET['tipe'] ?? 'stok';               // default laporan stok

// Filter tambahan untuk stok
$status_stok = $_GET['status_stok'] ?? '';
$id_supplier = $_GET['id_supplier'] ?? '';
?>

<h5 class="fw-bold mb-4"><i class="bi bi-file-earmark-bar-graph"></i> Laporan</h5>

<!-- Tab Pilihan Laporan -->
<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex gap-2 flex-wrap">
            <a href="?tipe=stok"
              class="btn <?= $tipe === 'stok' ? 'btn-primary' : 'btn-outline-primary' ?>">
                <i class="bi bi-archive"></i> Stok Barang
            </a>
            <a href="?tipe=masuk&tgl_mulai=<?= $tgl_mulai ?>&tgl_akhir=<?= $tgl_akhir ?>"
              class="btn <?= $tipe === 'masuk' ? 'btn-success' : 'btn-outline-success' ?>">
                <i class="bi bi-box-arrow-in-down"></i> Barang Masuk
            </a>
            <a href="?tipe=keluar&tgl_mulai=<?= $tgl_mulai ?>&tgl_akhir=<?= $tgl_akhir ?>"
              class="btn <?= $tipe === 'keluar' ? 'btn-danger' : 'btn-outline-danger' ?>">
                <i class="bi bi-box-arrow-up"></i> Barang Keluar
            </a>
        </div>
    </div>
</div>

<!-- Filter Area -->
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="d-flex gap-2 flex-wrap align-items-end">
            <input type="hidden" name="tipe" value="<?= $tipe ?>">
            
            <?php if ($tipe === 'stok'): ?>
                <!-- Filter Stok -->
                <div>
                    <label class="form-label fw-semibold mb-1">Status Stok</label>
                    <select name="status_stok" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="tersedia" <?= $status_stok === 'tersedia' ? 'selected' : '' ?>>Tersedia (>5)</option>
                        <option value="menipis" <?= $status_stok === 'menipis' ? 'selected' : '' ?>>Menipis (≤5)</option>
                        <option value="habis" <?= $status_stok === 'habis' ? 'selected' : '' ?>>Habis (0)</option>
                    </select>
                </div>
                <div>
                    <label class="form-label fw-semibold mb-1">Supplier</label>
                    <select name="id_supplier" class="form-select">
                        <option value="">Semua Supplier</option>
                        <?php 
                        $suppliers = mysqli_query($conn, "SELECT * FROM supplier ORDER BY nama_supplier ASC");
                        while ($s = mysqli_fetch_assoc($suppliers)): 
                        ?>
                            <option value="<?= $s['id_supplier'] ?>" <?= $id_supplier == $s['id_supplier'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($s['nama_supplier']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            <?php else: ?>
                <!-- Filter Tanggal -->
                <div>
                    <label class="form-label fw-semibold mb-1">Dari Tanggal</label>
                    <input type="date" name="tgl_mulai" class="form-control"
                          value="<?= $tgl_mulai ?>" max="<?= date('Y-m-d') ?>">
                </div>
                <div>
                    <label class="form-label fw-semibold mb-1">Sampai Tanggal</label>
                    <input type="date" name="tgl_akhir" class="form-control"
                          value="<?= $tgl_akhir ?>" max="<?= date('Y-m-d') ?>">
                </div>
            <?php endif; ?>

            <div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-filter"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tombol Cetak -->
<div class="d-flex justify-content-end mb-3">
    <button onclick="cetakLaporan()" class="btn btn-secondary">
        <i class="bi bi-printer"></i> Cetak Laporan
    </button>
</div>

<!-- Konten Laporan -->
<div class="card" id="area-cetak">
    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <span>
            <?php if ($tipe === 'stok'): ?>
                <i class="bi bi-archive"></i> Laporan Stok Barang
            <?php elseif ($tipe === 'masuk'): ?>
                <i class="bi bi-box-arrow-in-down"></i> Laporan Barang Masuk
            <?php else: ?>
                <i class="bi bi-box-arrow-up"></i> Laporan Barang Keluar
            <?php endif; ?>
        </span>
        <?php if ($tipe !== 'stok'): ?>
        <small><?= date('d M Y', strtotime($tgl_mulai)) ?> — <?= date('d M Y', strtotime($tgl_akhir)) ?></small>
        <?php endif; ?>
    </div>
    <div class="card-body p-0">

        <?php if ($tipe === 'stok'): ?>
        <!-- LAPORAN STOK -->
        <?php
        $sql = "SELECT b.*, s.nama_supplier 
                FROM barang b 
                LEFT JOIN supplier s ON b.id_supplier = s.id_supplier 
                WHERE 1=1";

        if ($status_stok === 'tersedia') {
            $sql .= " AND b.jumlah_stok > 5";
        } elseif ($status_stok === 'menipis') {
            $sql .= " AND (b.jumlah_stok <= 5 AND b.jumlah_stok > 0)";
        } elseif ($status_stok === 'habis') {
            $sql .= " AND b.jumlah_stok = 0";
        }

        if (!empty($id_supplier)) {
            $sql .= " AND b.id_supplier = " . (int)$id_supplier;
        }

        $sql .= " ORDER BY b.nama_barang ASC";
        $data = mysqli_query($conn, $sql);
        ?>
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Jenis</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Supplier</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($data) > 0): ?>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                        <td>Rp <?= number_format($row['harga_barang'], 0, ',', '.') ?></td>
                        <td><?= $row['jumlah_stok'] ?></td>
                        <td><?= htmlspecialchars($row['nama_supplier'] ?? '-') ?></td>
                        <td>
                            <?php if ($row['jumlah_stok'] == 0): ?>
                                <span class="badge bg-danger">Habis</span>
                            <?php elseif ($row['jumlah_stok'] <= 5): ?>
                                <span class="badge bg-warning text-dark">Menipis</span>
                            <?php else: ?>
                                <span class="badge bg-success">Tersedia</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center text-muted py-3">Belum ada data</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php elseif ($tipe === 'masuk'): ?>
        <!-- LAPORAN BARANG MASUK -->
        <?php
        $stmt = mysqli_prepare($conn, "
            SELECT bm.*, b.nama_barang, s.nama_supplier
            FROM barang_masuk bm
            JOIN barang b ON bm.id_barang = b.id_barang
            JOIN supplier s ON bm.id_supplier = s.id_supplier
            WHERE bm.tanggal_masuk BETWEEN ? AND ?
            ORDER BY bm.tanggal_masuk DESC
        ");
        mysqli_stmt_bind_param($stmt, 'ss', $tgl_mulai, $tgl_akhir);
        mysqli_stmt_execute($stmt);
        $data = mysqli_stmt_get_result($stmt);
        ?>
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Supplier</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($data) > 0): ?>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= format_tanggal($row['tanggal_masuk']) ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                        <td><?= htmlspecialchars($row['nama_supplier']) ?></td>
                        <td><?= $row['jumlah_barang_masuk'] ?></td>
                        <td><?= htmlspecialchars($row['keterangan'] ?? '-') ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center text-muted py-3">Tidak ada data pada periode ini</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php else: ?>
        <!-- LAPORAN BARANG KELUAR -->
        <?php
        $stmt = mysqli_prepare($conn, "
            SELECT bk.*, b.nama_barang
            FROM barang_keluar bk
            JOIN barang b ON bk.id_barang = b.id_barang
            WHERE bk.tanggal_keluar BETWEEN ? AND ?
            ORDER BY bk.tanggal_keluar DESC
        ");
        mysqli_stmt_bind_param($stmt, 'ss', $tgl_mulai, $tgl_akhir);
        mysqli_stmt_execute($stmt);
        $data = mysqli_stmt_get_result($stmt);
        ?>
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($data) > 0): ?>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= format_tanggal($row['tanggal_keluar']) ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                        <td><?= $row['jumlah_barang_keluar'] ?></td>
                        <td><?= htmlspecialchars($row['keterangan'] ?? '-') ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center text-muted py-3">Tidak ada data pada periode ini</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php endif; ?>

    </div>
</div>

<script>
function cetakLaporan() {
    const area = document.getElementById('area-cetak').innerHTML;
    const win = window.open('', '', 'width=900,height=700');
    win.document.write(`
        <html>
        <head>
            <title>Laporan InvenTrack Pro</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            <style>
                body { padding: 20px; font-family: sans-serif; }
                table { width: 100%; border-collapse: collapse; }
                th, td { border: 1px solid #dee2e6; padding: 8px; }
                @media print { body { padding: 0; } }
            </style>
        </head>
        <body>
            <h5 class="mb-3">InvenTrack Pro — Laporan</h5>
            ${area}
            <script>window.print();<\/script>
        </body>
        </html>
    `);
    win.document.close();
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>