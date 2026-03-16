-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Mar 2026 pada 05.45
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventtrack_pro`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `deskripsi` varchar(50) DEFAULT NULL,
  `harga_barang` double NOT NULL DEFAULT 0,
  `jumlah_stok` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `id_supplier`, `nama_barang`, `deskripsi`, `harga_barang`, `jumlah_stok`) VALUES
(1, 1, 'Laptop Lenovo ThinkPad', 'Elektronik', 12000000, 15),
(2, 1, 'Mouse Wireless Logitech', 'Aksesori', 250000, 30),
(3, 1, 'Keyboard Mechanical', 'Aksesori', 450000, 20),
(4, 1, 'Monitor Samsung 24 inch', 'Elektronik', 3500000, 8),
(5, 2, 'Printer Canon PIXMA', 'Elektronik', 1800000, 5),
(6, 3, 'Kertas HVS A4 500 lembar', 'ATK', 55000, 100),
(7, 4, 'Tinta Printer Hitam', 'ATK', 85000, 45),
(8, 5, 'Flashdisk 32GB', 'Aksesori', 75000, 60),
(9, 5, 'Kabel HDMI 2 meter', 'Aksesori', 45000, 25),
(10, 6, 'UPS APC 650VA', 'Elektronik', 850000, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah_barang_keluar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `id_barang`, `id_user`, `tanggal_keluar`, `jumlah_barang_keluar`) VALUES
(1, 1, 1, '2026-03-01', 2),
(2, 2, 1, '2026-03-02', 5),
(3, 3, 1, '2026-03-03', 3),
(4, 4, 1, '2026-03-05', 2),
(5, 5, 1, '2026-03-07', 20),
(6, 6, 1, '2026-03-08', 10),
(7, 7, 1, '2026-03-10', 15),
(8, 8, 1, '2026-03-11', 5),
(9, 9, 1, '2026-03-12', 1),
(10, 10, 1, '2026-03-14', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah_barang_masuk` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `id_barang`, `id_supplier`, `id_user`, `tanggal_masuk`, `jumlah_barang_masuk`, `keterangan`) VALUES
(1, 1, 1, 1, '2026-02-25', 10, 'Stok awal laptop'),
(2, 2, 2, 1, '2026-02-25', 20, 'Stok awal mouse'),
(3, 3, 3, 1, '2026-02-26', 15, 'Stok awal keyboard'),
(4, 4, 4, 1, '2026-02-26', 8, 'Stok awal monitor'),
(5, 5, 5, 1, '2026-02-27', 5, 'Stok awal printer'),
(6, 6, 6, 1, '2026-03-01', 100, 'Stok kertas bulan Maret'),
(7, 7, 7, 1, '2026-03-01', 45, 'Stok tinta bulan Maret'),
(8, 8, 8, 1, '2026-03-05', 60, 'Stok flashdisk'),
(9, 9, 9, 1, '2026-03-05', 25, 'Stok kabel HDMI'),
(10, 10, 10, 1, '2026-03-10', 3, 'Stok UPS'),
(11, 1, 1, 1, '2026-03-10', 5, 'Restock laptop');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `kontak` varchar(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `kontak`, `alamat`) VALUES
(1, 'PT Maju Jaya', '081234567890', 'Jl. Raya Surabaya No. 12, Surabaya'),
(2, 'CV Berkah Abadi', '082345678901', 'Jl. Ahmad Yani No. 45, Malang'),
(3, 'Toko Sumber Rejeki', '083456789012', 'Jl. Pahlawan No. 8, Sidoarjo'),
(4, 'PT Global Teknindo', '084567890123', 'Jl. Industri No. 99, Gresik'),
(5, 'PT Maju Jaya', '081234567890', 'Jl. Raya Surabaya No. 12, Surabaya'),
(6, 'CV Berkah Abadi', '082345678901', 'Jl. Ahmad Yani No. 45, Malang'),
(7, 'Toko Sumber Rejeki', '083456789012', 'Jl. Pahlawan No. 8, Sidoarjo'),
(8, 'PT Global Teknindo', '084567890123', 'Jl. Industri No. 99, Gresik'),
(9, 'PT Maju Jaya', '081234567890', 'Jl. Raya Surabaya No. 12, Surabaya'),
(10, 'CV Berkah Abadi', '082345678901', 'Jl. Ahmad Yani No. 45, Malang'),
(11, 'Toko Sumber Rejeki', '083456789012', 'Jl. Pahlawan No. 8, Sidoarjo'),
(12, 'PT Global Teknindo', '084567890123', 'Jl. Industri No. 99, Gresik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin_gudang','kasir','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'owner', '$2y$10$Ud93MHq4xb6Vgfj1zL301OcfmBUgm7f818HAz03uVG/rDz9xMyBSO', 'owner'),
(2, 'admin_gudang', '$2y$10$l5zbxs.7ODX8IV6wNdjizOQtX7aZ3cd3u1sRT17qUmGuR3cKKP6I6', 'admin_gudang'),
(3, 'kasir', '$2y$10$2IBNsB5KbCVuCtY/iLWwJewvH5wZRE1ECY9qMyqp9tg6w5tWmXzt6', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
