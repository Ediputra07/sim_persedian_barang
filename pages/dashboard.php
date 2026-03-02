<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../config/database.php'; ?>

<?php
// Query ringkasan data
$total_barang    = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM barang"))[0];
$total_supplier  = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM supplier"))[0];
$total_masuk     = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM barang_masuk"))[0];
$total_keluar    = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM barang_keluar"))[0];

// Query barang dengan stok 0
$stok_habis = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM barang WHERE jumlah_stok = 0"))[0];

// Query 5 transaksi terakhir
$query_terakhir = mysqli_query($conn, "
    SELECT b.nama_barang, bm.jumlah_barang_masuk AS jumlah, bm.tanggal_masuk AS tanggal, 'Masuk' AS tipe
    FROM barang_masuk bm
    JOIN barang b ON bm.id_barang = b.id_barang
    UNION ALL
    SELECT b.nama_barang, bk.jumlah_barang_keluar AS jumlah, bk.tanggal_keluar AS tanggal, 'Keluar' AS tipe
    FROM barang_keluar bk
    JOIN barang b ON bk.id_barang = b.id_barang
    ORDER BY tanggal DESC
    LIMIT 5
");
?>

<!-- Alert stok habis -->
<?php if ($stok_habis > 0): ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle-fill"></i>
    <strong><?= $stok_habis ?> barang</strong> memiliki stok habis! 
    <a href="/sim_persedian_barang/pages/data_barang.php" class="alert-link">Lihat data barang</a>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<h5 class="fw-bold mb-4"><i class="bi bi-speedometer2"></i> Dashboard</h5>

<!-- Kartu Ringkasan -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="card text-white bg-primary h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-2 fw-bold"><?= $total_barang ?></div>
                    <div>Total Barang</div>
                </div>
                <i class="bi bi-archive fs-1 opacity-50"></i>
            </div>
            <div class="card-footer">
                <a href="/sim_persedian_barang/pages/data_barang.php" class="text-white text-decoration-none">
                    Lihat detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card text-white bg-success h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-2 fw-bold"><?= $total_supplier ?></div>
                    <div>Total Supplier</div>
                </div>
                <i class="bi bi-truck fs-1 opacity-50"></i>
            </div>
            <div class="card-footer">
                <a href="/sim_persedian_barang/pages/data_supplier.php" class="text-white text-decoration-none">
                    Lihat detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card text-white bg-info h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-2 fw-bold"><?= $total_masuk ?></div>
                    <div>Barang Masuk</div>
                </div>
                <i class="bi bi-box-arrow-in-down fs-1 opacity-50"></i>
            </div>
            <div class="card-footer">
                <a href="/sim_persedian_barang/pages/barang_masuk.php" class="text-white text-decoration-none">
                    Lihat detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card text-white bg-danger h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-2 fw-bold"><?= $total_keluar ?></div>
                    <div>Barang Keluar</div>
                </div>
                <i class="bi bi-box-arrow-up fs-1 opacity-50"></i>
            </div>
            <div class="card-footer">
                <a href="/sim_persedian_barang/pages/barang_keluar.php" class="text-white text-decoration-none">
                    Lihat detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Transaksi Terakhir -->
<div class="card">
    <div class="card-header bg-primary text-white">
        <i class="bi bi-clock-history"></i> Transaksi Terakhir
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Tipe</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($query_terakhir) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($query_terakhir)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                        <td>
                            <?php if ($row['tipe'] === 'Masuk'): ?>
                                <span class="badge bg-success">Masuk</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Keluar</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">
                            Belum ada transaksi
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>