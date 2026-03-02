<?php
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }

  // Tolak akses langsung ke file ini tanpa POST
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: /sim_persedian_barang/login.php');
      exit();
  }

  require_once __DIR__ . '/../../config/database.php';

  $username = trim($_POST['username'] ?? '');
  $password = trim($_POST['password'] ?? '');

  // Validasi input tidak boleh kosong
  if (empty($username) || empty($password)) {
      $_SESSION['error'] = 'Username dan password wajib diisi.';
      header('Location: /sim_persedian_barang/login.php');
      exit();
  }

  // Cari user di database
  $stmt = mysqli_prepare($conn, "SELECT id_user, username, password, role FROM users WHERE username = ?");
  mysqli_stmt_bind_param($stmt, 's', $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $users = mysqli_fetch_assoc($result);

  // Cek apakah user ditemukan dan password cocok
  if (!$users || !password_verify($password, $users['password'])) {
      $_SESSION['error'] = 'Username atau password salah.';
      header('Location: /sim_persedian_barang/login.php');
      exit();
  }

  // Login berhasil — simpan session
  $_SESSION['id_user']  = $users['id_user'];
  $_SESSION['username'] = $users['username'];
  $_SESSION['role']     = $users['role'];

  // Pastikan session tersimpan sebelum redirect
  session_write_close();

  // Redirect ke dashboard
  header('Location: /sim_persedian_barang/pages/dashboard.php');
  exit();
?>