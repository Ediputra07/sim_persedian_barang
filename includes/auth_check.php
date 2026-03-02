<?php
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }

  // Definisikan BASE_URL hanya jika belum didefinisikan
  if (!defined('BASE_URL')) {
      define('BASE_URL', '/sim_persedian_barang');
  }

  // Ambil nama file yang sedang diakses
  $current_file = basename($_SERVER['PHP_SELF']);

  // Jika belum login DAN bukan di halaman login, redirect ke login
  if (!isset($_SESSION['id_user']) && $current_file !== 'login.php') {
      header('Location: ' . BASE_URL . '/login.php');
      exit();
  }
?>