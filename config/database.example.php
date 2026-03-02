<?php
  $host     = 'localhost';
  $username = 'root';
  $password = 'GANTI_DENGAN_PASSWORD_MYSQL_KAMU';
  $database = 'inventtrack_pro';

  $conn = mysqli_connect($host, $username, $password, $database);

  if (!$conn) {
      die("Koneksi gagal: " . mysqli_connect_error());
  }

  mysqli_set_charset($conn, 'utf8');
?>