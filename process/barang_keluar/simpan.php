<?php
  require_once __DIR__ . '/../../includes/auth_check.php';
  require_once __DIR__ . '/../../config/database.php';

  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: /sim_persedian_barang/pages/barang_keluar.php');
      exit();
  }

  $id_barang = $_POST['id_barang'];
  $jumlah    = (int) $_POST['jumlah_barang_keluar'];
  $tanggal   = $_POST['tanggal_keluar'];
  $id_user   = $_SESSION['id_user'];

  // Validasi jumlah
  if ($jumlah <= 0) {
      $_SESSION['error'] = "Jumlah barang keluar harus lebih dari 0.";
      header('Location: /sim_persedian_barang/pages/barang_keluar.php');
      exit();
  }

  // Validasi tanggal
  if (empty($tanggal) || !strtotime($tanggal)) {
      $_SESSION['error'] = "Format tanggal tidak valid.";
      header('Location: /sim_persedian_barang/pages/barang_keluar.php');
      exit();
  }

  if ($tanggal > date('Y-m-d')) {
      $_SESSION['error'] = "Tanggal tidak boleh melebihi hari ini.";
      header('Location: /sim_persedian_barang/pages/barang_keluar.php');
      exit();
  }

  // Cek stok mencukupi
  $cek_stok = mysqli_prepare($conn, "SELECT nama_barang, jumlah_stok FROM barang WHERE id_barang = ?");
  mysqli_stmt_bind_param($cek_stok, 'i', $id_barang);
  mysqli_stmt_execute($cek_stok);
  $stok_result = mysqli_stmt_get_result($cek_stok);
  $barang = mysqli_fetch_assoc($stok_result);

  if (!$barang) {
      $_SESSION['error'] = "Barang tidak ditemukan.";
      header('Location: /sim_persedian_barang/pages/barang_keluar.php');
      exit();
  }

  if ($barang['jumlah_stok'] < $jumlah) {
      $_SESSION['error'] = "Stok \"{$barang['nama_barang']}\" tidak mencukupi. Stok tersedia: {$barang['jumlah_stok']}.";
      header('Location: /sim_persedian_barang/pages/barang_keluar.php');
      exit();
  }

  // Simpan transaksi
  mysqli_begin_transaction($conn);

  try {
      // 1. Simpan ke tabel barang_keluar
      $stmt = mysqli_prepare($conn, "
          INSERT INTO barang_keluar (id_barang, id_user, tanggal_keluar, jumlah_barang_keluar)
          VALUES (?, ?, ?, ?)
      ");
      mysqli_stmt_bind_param($stmt, 'iisi', $id_barang, $id_user, $tanggal, $jumlah);
      mysqli_stmt_execute($stmt);

      // 2. Kurangi stok
      $update = mysqli_prepare($conn, "
          UPDATE barang SET jumlah_stok = jumlah_stok - ? WHERE id_barang = ?
      ");
      mysqli_stmt_bind_param($update, 'ii', $jumlah, $id_barang);
      mysqli_stmt_execute($update);

      mysqli_commit($conn);
      $_SESSION['success'] = "Barang keluar berhasil dicatat. Stok telah diperbarui.";

  } catch (Exception $e) {
      mysqli_rollback($conn);
      $_SESSION['error'] = "Gagal menyimpan data. Silakan coba lagi.";
  }

  header('Location: /sim_persedian_barang/pages/barang_keluar.php');
  exit();
?>