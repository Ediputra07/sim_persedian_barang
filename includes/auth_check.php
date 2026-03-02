<?php
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }

  // Definisikan BASE_URL agar link tidak rusak di subfolder manapun
  define('BASE_URL', '/sim_persedian_barang');

  // Jika belum login, redirect ke halaman login
  if (!isset($_SESSION['user_id'])) {
      header('Location: ' . BASE_URL . '/login.php');
      exit();
  }
?>