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
  $stmt = mysqli_prepare($conn, "SELECT user_id, username, password, role FROM user WHERE username = ?");
  mysqli_stmt_bind_param($stmt, 's', $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $user = mysqli_fetch_assoc($result);

  // Cek apakah user ditemukan dan password cocok
  if (!$user || !password_verify($password, $user['password'])) {
      $_SESSION['error'] = 'Username atau password salah.';
      header('Location: /sim_persedian_barang/login.php');
      exit();
  }

  // Login berhasil — simpan session
  $_SESSION['user_id']  = $user['user_id'];
  $_SESSION['username'] = $user['username'];
  $_SESSION['role']     = $user['role'];

  // Redirect ke dashboard
  header('Location: /sim_persedian_barang/pages/dashboard.php');
  exit();
?>