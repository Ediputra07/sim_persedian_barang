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
DROP DATABASE IF EXISTS inventtrack_pro;
CREATE DATABASE inventtrack_pro;
USE inventtrack_pro;

-- --------------------------------------------------------
-- 1. TABEL USERS (Dibuat pertama karena mandiri)
-- --------------------------------------------------------
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin_gudang','kasir','owner') NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'owner', '$2y$10$Ud93MHq4xb6Vgfj1zL301OcfmBUgm7f818HAz03uVG/rDz9xMyBSO', 'owner'),
(2, 'admin_gudang', '$2y$10$l5zbxs.7ODX8IV6wNdjizOQtX7aZ3cd3u1sRT17qUmGuR3cKKP6I6', 'admin_gudang'),
(3, 'kasir', '$2y$10$2IBNsB5KbCVuCtY/iLWwJewvH5wZRE1ECY9qMyqp9tg6w5tWmXzt6', 'kasir');

-- --------------------------------------------------------
-- 2. TABEL SUPPLIER (Dibuat sebelum tabel barang)
-- --------------------------------------------------------
CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(100) NOT NULL,
  `kontak` varchar(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `kontak`, `alamat`) VALUES
(1, 'PT Maju Jaya', '081234567890', 'Jl. Raya Surabaya No. 12, Surabaya'),
(2, 'CV Berkah Abadi', '082345678901', 'Jl. Ahmad Yani No. 45, Malang'),
(3, 'Toko Sumber Rejeki', '083456789012', 'Jl. Pahlawan No. 8, Sidoarjo'),
(4, 'PT Global Teknindo', '084567890123', 'Jl. Industri No. 99, Gresik'),
(5, 'PT Tech Utama', '085678901234', 'Jl. Pemuda No. 10, Jakarta'),
(6, 'CV ATK Makmur', '086789012345', 'Jl. Gajah Mada No. 22, Bandung'),
(7, 'Toko Tinta Mas', '087890123456', 'Jl. Diponegoro No. 5, Semarang'),
(8, 'PT Data Storage', '088901234567', 'Jl. Asia Afrika No. 7, Yogyakarta'),
(9, 'CV Kabelindo', '089012345678', 'Jl. Sudirman No. 88, Solo'),
(10, 'PT Power Solusi', '081122334455', 'Jl. Gatot Subroto No. 14, Surabaya');

-- --------------------------------------------------------
-- 3. TABEL BARANG
-- --------------------------------------------------------
CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `id_supplier` int(11) DEFAULT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `deskripsi` varchar(50) DEFAULT NULL,
  `harga_barang` double NOT NULL DEFAULT 0,
  `jumlah_stok` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_barang`),
  KEY `id_supplier` (`id_supplier`),
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- 4. TABEL BARANG_MASUK
-- --------------------------------------------------------
CREATE TABLE `barang_masuk` (
  `id_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah_barang_masuk` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_masuk`),
  KEY `id_barang` (`id_barang`),
  KEY `id_supplier` (`id_supplier`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE,
  CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE,
  CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `barang_masuk` (`id_masuk`, `id_barang`, `id_supplier`, `id_user`, `tanggal_masuk`, `jumlah_barang_masuk`, `keterangan`) VALUES
(1, 1, 1, 1, '2026-02-25', 10, 'Stok awal laptop'),
(2, 2, 1, 1, '2026-02-25', 20, 'Stok awal mouse'),
(3, 3, 1, 1, '2026-02-26', 15, 'Stok awal keyboard'),
(4, 4, 1, 1, '2026-02-26', 8, 'Stok awal monitor'),
(5, 5, 2, 1, '2026-02-27', 5, 'Stok awal printer'),
(6, 6, 3, 1, '2026-03-01', 100, 'Stok kertas bulan Maret'),
(7, 7, 4, 1, '2026-03-01', 45, 'Stok tinta bulan Maret'),
(8, 8, 5, 1, '2026-03-05', 60, 'Stok flashdisk'),
(9, 9, 5, 1, '2026-03-05', 25, 'Stok kabel HDMI'),
(10, 10, 6, 1, '2026-03-10', 3, 'Stok UPS'),
(11, 1, 1, 1, '2026-03-10', 5, 'Restock laptop');

-- --------------------------------------------------------
-- 5. TABEL BARANG_KELUAR
-- --------------------------------------------------------
CREATE TABLE `barang_keluar` (
  `id_keluar` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah_barang_keluar` int(11) NOT NULL,
  PRIMARY KEY (`id_keluar`),
  KEY `id_barang` (`id_barang`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE,
  CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
