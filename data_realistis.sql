-- ============================================
-- DATA REALISTIS INVENTRACK PRO
-- 100 Supplier, 100 Barang, 100 Barang Masuk, 100 Barang Keluar
-- ============================================

-- Kosongkan data lama (kecuali user)
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE barang_keluar;
TRUNCATE TABLE barang_masuk;
TRUNCATE TABLE barang;
TRUNCATE TABLE supplier;
SET FOREIGN_KEY_CHECKS = 1;

-- 100 Data Supplier
INSERT INTO supplier (nama_supplier, kontak, alamat) VALUES
('CV Sentosa Makmur', '08145614226', 'Jl. Gajah Mada No. 58, Mojokerto'),
('CV Surya Gemilang', '08802458591', 'Jl. HR Muhammad No. 109, Malang'),
('PT Maju Bersama', '08384903402', 'Jl. Rungkut Industri No. 155, Surabaya'),
('PT Sumber Makmur', '08808038374', 'Jl. Gajah Mada No. 115, Bojonegoro'),
('UD Tunas Jaya', '08113678638', 'Jl. Basuki Rahmat No. 88, Probolinggo'),
('CV Berkah Ilahi', '08542714803', 'Jl. Gatot Subroto No. 98, Gresik'),
('UD Damai Sentosa', '08885437923', 'Jl. Sudirman No. 187, Jombang'),
('PT Tunas Muda', '08592322047', 'Jl. Margomulyo No. 76, Pacitan'),
('PT Kencana Mulia', '08844226067', 'Jl. Gatot Subroto No. 12, Blitar'),
('PT Anugerah Alam', '08214905582', 'Jl. Diponegoro No. 98, Probolinggo'),
('Toko Sejati Mandiri', '08573728882', 'Jl. Pemuda No. 91, Kediri'),
('CV Tunggal Mandiri', '08203871230', 'Jl. Margomulyo No. 187, Blitar'),
('CV Sumber Jaya', '08595528972', 'Jl. Margomulyo No. 57, Banyuwangi'),
('PT Sinar Harapan', '08184842788', 'Jl. Sudirman No. 207, Banyuwangi'),
('Toko Tunggal Mandiri', '08194539704', 'Jl. HR Muhammad No. 225, Banyuwangi'),
('CV Mulia Karya', '08747637601', 'Jl. Mastrip No. 37, Probolinggo'),
('CV Citra Mandiri', '08825408072', 'Jl. HR Muhammad No. 110, Bojonegoro'),
('Toko Kencana Mulia', '08393320821', 'Jl. Rungkut Industri No. 127, Sidoarjo'),
('PT Mitra Sejahtera', '08253564251', 'Jl. Merdeka No. 203, Lamongan'),
('PT Nusantara Prima', '08607402509', 'Jl. Darmo No. 120, Magetan'),
('UD Sinar Sejati', '08122921859', 'Jl. Margomulyo No. 193, Probolinggo'),
('PT Bintang Abadi', '08542871534', 'Jl. Veteran No. 112, Pasuruan'),
('Toko Maju Jaya', '08449398441', 'Jl. Merdeka No. 130, Gresik'),
('PT Taruna Karya', '08499517169', 'Jl. Darmo No. 51, Mojokerto'),
('UD Permata Indah', '08319897858', 'Jl. Ahmad Yani No. 154, Banyuwangi'),
('Toko Sumber Rejeki', '08257089806', 'Jl. Veteran No. 62, Malang'),
('CV Anugerah Jaya', '08212437026', 'Jl. Kalianak No. 209, Sidoarjo'),
('PT Prima Makmur', '08273154051', 'Jl. Kalianak No. 243, Ngawi'),
('CV Sinar Jaya', '08788099076', 'Jl. Hayam Wuruk No. 238, Ngawi'),
('PT Sentosa Jaya', '08366229731', 'Jl. Pasar Baru No. 172, Madiun'),
('Toko Bunga Mas', '08683030113', 'Jl. Gajah Mada No. 58, Sidoarjo'),
('UD Sumber Rejeki', '08864860684', 'Jl. HR Muhammad No. 57, Surabaya'),
('PT Anugerah Mulia', '08184841005', 'Jl. Gatot Subroto No. 232, Malang'),
('PT Cipta Karya', '08209626108', 'Jl. Gajah Mada No. 72, Nganjuk'),
('CV Sumber Cahaya', '08278930103', 'Jl. Gajah Mada No. 201, Nganjuk'),
('PT Tunas Harapan', '08352582524', 'Jl. Diponegoro No. 169, Lamongan'),
('UD Alam Raya', '08638835373', 'Jl. Sudirman No. 173, Gresik'),
('PT Abdi Karya', '08542833230', 'Jl. Gajah Mada No. 50, Kediri'),
('PT Prima Sejati', '08288077999', 'Jl. Merdeka No. 72, Jombang'),
('CV Bintang Timur', '08672642635', 'Jl. Sudirman No. 167, Ngawi'),
('PT Berkah Abadi', '08224965789', 'Jl. Merdeka No. 105, Nganjuk'),
('Toko Berkah Ilahi', '08621983738', 'Jl. Merdeka No. 98, Surabaya'),
('Toko Sinar Jaya', '08695785687', 'Jl. Basuki Rahmat No. 179, Ngawi'),
('CV Bumi Sejahtera', '08733597059', 'Jl. Hayam Wuruk No. 76, Kediri'),
('PT Cendana Indah', '08802022698', 'Jl. Raya Industri No. 15, Malang'),
('PT Sentral Mandiri', '08759910817', 'Jl. Merdeka No. 15, Magetan'),
('PT Lintas Buana', '08192140194', 'Jl. Gajah Mada No. 104, Gresik'),
('PT Citra Mandiri', '08851666754', 'Jl. Darmo No. 21, Lamongan'),
('CV Cendana Indah', '08839770838', 'Jl. Raya Industri No. 240, Probolinggo'),
('CV Tiga Putra', '08515004485', 'Jl. Thamrin No. 102, Mojokerto'),
('CV Bintang Abadi', '08498670955', 'Jl. Raya Industri No. 238, Sidoarjo'),
('PT Bumi Indah', '08832677407', 'Jl. Gatot Subroto No. 138, Kediri'),
('PT Sinar Jaya', '08276855396', 'Jl. Gatot Subroto No. 226, Blitar'),
('UD Putra Mandiri', '08318351517', 'Jl. Margomulyo No. 181, Jember'),
('PT Tunas Jaya', '08781131249', 'Jl. Margomulyo No. 77, Gresik'),
('PT Surya Gemilang', '08813607983', 'Jl. Thamrin No. 73, Pacitan'),
('UD Prima Sakti', '08449479356', 'Jl. Kalianak No. 65, Malang'),
('PT Sejati Mandiri', '08655641923', 'Jl. Sudirman No. 1, Banyuwangi'),
('PT Jaya Abadi', '08443710895', 'Jl. Mastrip No. 142, Lamongan'),
('PT Bintang Timur', '08301604451', 'Jl. Pemuda No. 150, Ngawi'),
('CV Barokah Sejahtera', '08271701771', 'Jl. Veteran No. 94, Malang'),
('UD Abadi Jaya', '08827817881', 'Jl. Darmo No. 192, Mojokerto'),
('CV Anugerah Sejati', '08337917152', 'Jl. Ahmad Yani No. 46, Banyuwangi'),
('PT Tiga Putra', '08425476257', 'Jl. Merdeka No. 202, Gresik'),
('Toko Karya Mandiri', '08714731818', 'Jl. Hayam Wuruk No. 210, Jombang'),
('UD Maju Sejati', '08404740036', 'Jl. Ahmad Yani No. 169, Kediri'),
('Toko Cipta Karya', '08462164686', 'Jl. Thamrin No. 90, Magetan'),
('Toko Cahaya Sakti', '08796555772', 'Jl. Ahmad Yani No. 30, Probolinggo'),
('UD Karya Mandiri', '08248290770', 'Jl. Pemuda No. 187, Banyuwangi'),
('Toko Mutiara Hitam', '08762940214', 'Jl. Pasar Baru No. 231, Bojonegoro'),
('CV Tiga Saudara', '08168315831', 'Jl. Ahmad Yani No. 134, Ngawi'),
('CV Surya Mandiri', '08367110622', 'Jl. Basuki Rahmat No. 18, Banyuwangi'),
('PT Sumber Barokah', '08266038571', 'Jl. Rungkut Industri No. 80, Lamongan'),
('UD Abdi Karya', '08483135534', 'Jl. Hayam Wuruk No. 108, Tuban'),
('CV Karya Sejati', '08336049101', 'Jl. Pasar Baru No. 141, Surabaya'),
('PT Mulia Karya', '08528801207', 'Jl. Mastrip No. 114, Kediri'),
('PT Mitra Karya', '08322422633', 'Jl. Veteran No. 132, Pacitan'),
('UD Maju Bersama', '08416207974', 'Jl. Gajah Mada No. 207, Kediri'),
('CV Global Teknindo', '08165107776', 'Jl. Kalianak No. 157, Sidoarjo'),
('Toko Cemerlang Abadi', '08844262081', 'Jl. Pasar Baru No. 127, Tuban'),
('CV Cahaya Utama', '08112788238', 'Jl. Basuki Rahmat No. 57, Pasuruan'),
('PT Karya Mas', '08778793853', 'Jl. Sudirman No. 143, Blitar'),
('Toko Mandala Prima', '08709910914', 'Jl. Margomulyo No. 153, Banyuwangi'),
('PT Mentari Jaya', '08899468772', 'Jl. Basuki Rahmat No. 213, Ngawi'),
('Toko Anugerah Sejati', '08718550917', 'Jl. Thamrin No. 193, Blitar'),
('UD Sinar Harapan', '08779130188', 'Jl. Gajah Mada No. 71, Jombang'),
('PT Bumi Sejahtera', '08474934149', 'Jl. Thamrin No. 86, Banyuwangi'),
('PT Cipta Kreasi', '08283530518', 'Jl. Gajah Mada No. 99, Mojokerto'),
('PT Cemerlang Abadi', '08636551268', 'Jl. Margomulyo No. 120, Lamongan'),
('PT Prima Sakti', '08647534336', 'Jl. HR Muhammad No. 243, Surabaya'),
('PT Permata Indah', '08847381734', 'Jl. Kalianak No. 2, Madiun'),
('UD Intan Jaya', '08608030010', 'Jl. Margomulyo No. 192, Ngawi'),
('PT Mutiara Hitam', '08399191131', 'Jl. Gajah Mada No. 70, Lamongan'),
('Toko Global Teknindo', '08606639317', 'Jl. Pasar Baru No. 186, Pasuruan'),
('PT Sumber Jaya', '08279961107', 'Jl. Ahmad Yani No. 233, Tuban'),
('PT Anugerah Jaya', '08142408404', 'Jl. Basuki Rahmat No. 35, Jombang'),
('CV Mitra Sejahtera', '08447360307', 'Jl. Raya Industri No. 55, Jombang'),
('UD Persada Jaya', '08595668371', 'Jl. Basuki Rahmat No. 65, Sidoarjo'),
('PT Damai Sentosa', '08392151225', 'Jl. Sudirman No. 194, Surabaya'),
('CV Sumber Makmur', '08133556551', 'Jl. Gajah Mada No. 33, Nganjuk');

-- 100 Data Barang (stok awal 0, akan update dari barang_masuk)
INSERT INTO barang (nama_barang, jenis_barang, harga_barang, jumlah_stok, id_supplier) VALUES
('Laptop Lenovo ThinkPad E14', 'Elektronik', 12000000, 0, 86),
('Laptop Asus VivoBook 14', 'Elektronik', 8500000, 0, 15),
('Laptop HP Pavilion 15', 'Elektronik', 10500000, 0, 73),
('Laptop Acer Aspire 5', 'Elektronik', 7800000, 0, 28),
('Laptop Dell Inspiron 3511', 'Elektronik', 9200000, 0, 60),
('PC Desktop Intel i5', 'Elektronik', 7500000, 0, 90),
('PC Desktop AMD Ryzen 5', 'Elektronik', 8200000, 0, 33),
('Monitor Samsung 24 inch', 'Elektronik', 3500000, 0, 99),
('Monitor LG UltraWide 29', 'Elektronik', 4800000, 0, 48),
('Monitor Dell P2422H', 'Elektronik', 3200000, 0, 22),
('Monitor AOC 22 inch', 'Elektronik', 1800000, 0, 78),
('Printer Canon PIXMA G3020', 'Elektronik', 2800000, 0, 78),
('Printer Epson L3210', 'Elektronik', 2500000, 0, 96),
('Printer HP LaserJet Pro', 'Elektronik', 3500000, 0, 92),
('Printer Brother HL-L2370DW', 'Elektronik', 2900000, 0, 15),
('Scanner Epson V39', 'Elektronik', 1800000, 0, 100),
('Scanner Canon LiDE 300', 'Elektronik', 1500000, 0, 21),
('Proyektor Epson EB-X06', 'Elektronik', 6500000, 0, 40),
('Proyektor BenQ MS550', 'Elektronik', 4800000, 0, 14),
('UPS APC 650VA', 'Elektronik', 850000, 0, 75),
('UPS ICA CP1200', 'Elektronik', 1200000, 0, 4),
('Stabilizer Matsunaga 1000VA', 'Elektronik', 450000, 0, 40),
('Hardisk External 1TB WD', 'Elektronik', 950000, 0, 74),
('Hardisk External 2TB Seagate', 'Elektronik', 1250000, 0, 87),
('SSD External Samsung T7 500GB', 'Elektronik', 1500000, 0, 49),
('Mouse Wireless Logitech M185', 'Aksesori', 150000, 0, 51),
('Mouse Wireless Logitech M331', 'Aksesori', 250000, 0, 92),
('Mouse Gaming Razer DeathAdder', 'Aksesori', 750000, 0, 26),
('Keyboard Logitech K380', 'Aksesori', 550000, 0, 10),
('Keyboard Mechanical Rexus', 'Aksesori', 450000, 0, 76),
('Keyboard Gaming Fantech K613L', 'Aksesori', 350000, 0, 89),
('Headset Logitech H390', 'Aksesori', 450000, 0, 81),
('Headset Gaming HyperX Cloud', 'Aksesori', 850000, 0, 32),
('Webcam Logitech C270', 'Aksesori', 450000, 0, 14),
('Webcam Logitech C922 Pro', 'Aksesori', 1650000, 0, 90),
('Flashdisk Sandisk 32GB', 'Aksesori', 75000, 0, 99),
('Flashdisk Sandisk 64GB', 'Aksesori', 120000, 0, 39),
('Flashdisk Kingston 128GB', 'Aksesori', 180000, 0, 88),
('Kabel HDMI 2 meter Ugreen', 'Aksesori', 85000, 0, 77),
('Kabel HDMI 5 meter', 'Aksesori', 145000, 0, 16),
('Kabel USB Type-C Anker', 'Aksesori', 95000, 0, 73),
('Kabel LAN Cat 6 10m', 'Aksesori', 75000, 0, 6),
('USB Hub 4 Port', 'Aksesori', 65000, 0, 45),
('Card Reader Multi Format', 'Aksesori', 55000, 0, 69),
('Powerbank Anker 10000mAh', 'Aksesori', 350000, 0, 55),
('Charger Laptop Universal', 'Aksesori', 250000, 0, 85),
('Cooling Pad Notebook', 'Aksesori', 150000, 0, 48),
('Mouse Pad Gaming', 'Aksesori', 75000, 0, 9),
('Kertas HVS A4 80gr Sinar Dunia', 'ATK', 55000, 0, 65),
('Kertas HVS F4 70gr Paper One', 'ATK', 60000, 0, 83),
('Kertas HVS A3 80gr', 'ATK', 95000, 0, 44),
('Tinta Printer Canon Hitam', 'ATK', 85000, 0, 2),
('Tinta Printer Epson 664 Hitam', 'ATK', 95000, 0, 54),
('Tinta Printer Canon Color Set', 'ATK', 250000, 0, 63),
('Toner HP 12A', 'ATK', 750000, 0, 14),
('Toner Brother TN-2025', 'ATK', 650000, 0, 56),
('Pulpen Standard AE7', 'ATK', 5000, 0, 47),
('Pulpen Pilot BPS-GP', 'ATK', 8500, 0, 82),
('Pulpen Snowman Drawing Pen', 'ATK', 12000, 0, 59),
('Pensil Mekanik Pentel 0.5mm', 'ATK', 25000, 0, 91),
('Pensil 2B Faber Castell', 'ATK', 4500, 0, 20),
('Penghapus Staedtler', 'ATK', 8000, 0, 56),
('Penggaris Butterfly 30cm', 'ATK', 12000, 0, 23),
('Stapler Kenko HD-10', 'ATK', 35000, 0, 94),
('Isi Stapler No.10 Kenko', 'ATK', 5500, 0, 67),
('Paper Clip Joyko', 'ATK', 8500, 0, 84),
('Binder Clip 25mm', 'ATK', 12000, 0, 35),
('Map Plastik Snelhecter', 'ATK', 4500, 0, 79),
('Ordner Folio Bantex', 'ATK', 35000, 0, 69),
('Amplop Coklat 110x230', 'ATK', 1500, 0, 100),
('Isolasi Bening 1 inch', 'ATK', 8500, 0, 62),
('Double Tape Nachi', 'ATK', 15000, 0, 60),
('Lem Kertas UHU Stic', 'ATK', 12000, 0, 56),
('Spidol Whiteboard Snowman', 'ATK', 12000, 0, 94),
('Spidol Permanent Snowman', 'ATK', 9500, 0, 76),
('Highlighter Stabilo Boss', 'ATK', 18000, 0, 35),
('Buku Tulis Sinar Dunia 58', 'ATK', 8500, 0, 42),
('Buku Agenda Hardcover', 'ATK', 45000, 0, 32),
('Post It Sticky Notes', 'ATK', 15000, 0, 12),
('Tipe-X Kenko', 'ATK', 8500, 0, 36),
('Kursi Kantor Ergonomis', 'Perabot', 1850000, 0, 58),
('Kursi Tamu Fabric', 'Perabot', 950000, 0, 32),
('Meja Kerja 120cm', 'Perabot', 2500000, 0, 97),
('Meja Kerja 160cm L-Shape', 'Perabot', 3500000, 0, 60),
('Lemari Arsip 4 Pintu', 'Perabot', 2800000, 0, 73),
('Filing Cabinet 4 Laci', 'Perabot', 1650000, 0, 79),
('Rak Buku 5 Tingkat', 'Perabot', 850000, 0, 86),
('Whiteboard 120x240', 'Perabot', 650000, 0, 49),
('Mading Gabus 80x120', 'Perabot', 250000, 0, 44),
('Dispenser Sanken', 'Elektronik', 850000, 0, 4),
('Galon Air 19L Aqua', 'Konsumsi', 22000, 0, 64),
('Kopi Kapal Api Special', 'Konsumsi', 15000, 0, 42),
('Teh Celup Sariwangi', 'Konsumsi', 12000, 0, 24),
('Gula Pasir 1kg Gulaku', 'Konsumsi', 18000, 0, 63),
('Creamer Indocafe 1kg', 'Konsumsi', 45000, 0, 28),
('Tisu Paseo Multifungsi', 'Konsumsi', 22000, 0, 46),
('Sapu Ijuk', 'Kebersihan', 35000, 0, 34),
('Pel Microfiber', 'Kebersihan', 65000, 0, 44),
('Kemoceng Bulu Ayam', 'Kebersihan', 25000, 0, 36),
('Tempat Sampah 20L', 'Kebersihan', 85000, 0, 77);

-- 100 Data Barang Masuk
INSERT INTO barang_masuk (id_barang, id_supplier, id_user, tanggal_masuk, jumlah_barang_masuk, keterangan) VALUES
(65, 35, 1, '2026-01-05', 25, NULL),
(89, 39, 1, '2026-01-08', 5, 'Pesanan khusus'),
(63, 70, 1, '2026-01-09', 15, 'Restock bulanan'),
(44, 24, 1, '2026-01-11', 25, 'Pengadaan rutin'),
(60, 53, 1, '2026-01-11', 20, 'Restock cepat'),
(73, 80, 1, '2026-01-12', 15, NULL),
(23, 71, 1, '2026-01-14', 15, 'Stok awal'),
(34, 85, 1, '2026-01-15', 15, 'Tambahan stok'),
(77, 37, 1, '2026-01-17', 40, 'Tambahan stok'),
(13, 57, 1, '2026-01-17', 20, 'Pengadaan rutin'),
(82, 91, 1, '2026-01-17', 10, 'Pengadaan baru'),
(26, 55, 1, '2026-01-19', 20, 'Tambahan stok'),
(33, 42, 1, '2026-01-19', 25, 'Stok tambahan'),
(15, 60, 1, '2026-01-20', 8, 'Pengadaan baru'),
(59, 71, 1, '2026-01-23', 50, 'Tambahan stok'),
(2, 93, 1, '2026-01-23', 50, NULL),
(64, 75, 1, '2026-01-23', 20, 'Pengadaan rutin'),
(31, 91, 1, '2026-01-25', 25, 'Restock cepat'),
(10, 8, 1, '2026-01-26', 25, 'Restock akhir bulan'),
(88, 24, 1, '2026-01-26', 15, 'Restock bulanan'),
(74, 6, 1, '2026-01-27', 10, 'Restock cepat'),
(59, 39, 1, '2026-01-30', 50, 'Pengadaan rutin'),
(13, 98, 1, '2026-01-31', 8, 'Tambahan stok'),
(98, 7, 1, '2026-01-31', 25, 'Restock cepat'),
(24, 25, 1, '2026-02-01', 12, 'Pengadaan rutin'),
(38, 5, 1, '2026-02-03', 25, NULL),
(25, 11, 1, '2026-02-04', 12, 'Stok tambahan'),
(63, 72, 1, '2026-02-04', 12, 'Pengadaan rutin'),
(90, 59, 1, '2026-02-08', 25, 'Restock akhir bulan'),
(83, 20, 1, '2026-02-08', 40, 'Pengadaan baru'),
(84, 57, 1, '2026-02-09', 15, 'Pengisian kembali'),
(85, 51, 1, '2026-02-09', 5, 'Pengisian kembali'),
(2, 60, 1, '2026-02-10', 8, 'Restock cepat'),
(3, 12, 1, '2026-02-11', 20, 'Stok tambahan'),
(64, 92, 1, '2026-02-11', 20, NULL),
(20, 73, 1, '2026-02-12', 10, 'Tambahan stok'),
(89, 32, 1, '2026-02-13', 8, 'Pengisian kembali'),
(45, 53, 1, '2026-02-16', 30, NULL),
(14, 21, 1, '2026-02-16', 50, NULL),
(8, 38, 1, '2026-02-19', 30, 'Stok tambahan'),
(38, 30, 1, '2026-02-20', 15, 'Restock akhir bulan'),
(14, 31, 1, '2026-02-22', 15, 'Pesanan khusus'),
(15, 9, 1, '2026-02-25', 10, 'Restock bulanan'),
(2, 71, 1, '2026-02-26', 10, 'Tambahan stok'),
(50, 30, 1, '2026-02-26', 5, 'Pesanan khusus'),
(16, 72, 1, '2026-02-27', 15, 'Pengisian kembali'),
(36, 99, 1, '2026-02-27', 30, NULL),
(39, 82, 1, '2026-02-28', 12, 'Restock akhir bulan'),
(96, 12, 1, '2026-03-01', 10, NULL),
(17, 37, 1, '2026-03-02', 12, 'Pengadaan rutin'),
(21, 10, 1, '2026-03-02', 30, 'Pengisian kembali'),
(37, 90, 1, '2026-03-04', 10, NULL),
(71, 5, 1, '2026-03-04', 10, 'Pesanan khusus'),
(82, 33, 1, '2026-03-04', 25, NULL),
(74, 37, 1, '2026-03-06', 10, 'Pengadaan rutin'),
(20, 10, 1, '2026-03-06', 25, 'Restock akhir bulan'),
(35, 54, 1, '2026-03-07', 10, 'Tambahan stok'),
(83, 92, 1, '2026-03-08', 10, NULL),
(17, 82, 1, '2026-03-08', 10, 'Stok awal'),
(56, 82, 1, '2026-03-08', 10, 'Pengadaan rutin'),
(47, 80, 1, '2026-03-09', 8, 'Pengadaan rutin'),
(52, 35, 1, '2026-03-10', 20, 'Pengadaan rutin'),
(5, 17, 1, '2026-03-10', 15, 'Pesanan khusus'),
(80, 29, 1, '2026-03-12', 50, 'Pengadaan rutin'),
(19, 32, 1, '2026-03-13', 50, 'Pengisian kembali'),
(16, 96, 1, '2026-03-14', 25, NULL),
(2, 91, 1, '2026-03-14', 15, 'Restock akhir bulan'),
(20, 58, 1, '2026-03-14', 10, 'Pesanan khusus'),
(43, 71, 1, '2026-03-15', 50, 'Pengadaan rutin'),
(48, 61, 1, '2026-03-16', 20, 'Pesanan khusus'),
(55, 96, 1, '2026-03-16', 30, 'Pesanan khusus'),
(6, 7, 1, '2026-03-16', 25, NULL),
(90, 36, 1, '2026-03-17', 5, 'Restock cepat'),
(77, 96, 1, '2026-03-18', 25, 'Pengadaan rutin'),
(39, 76, 1, '2026-03-20', 8, 'Pengadaan rutin'),
(36, 93, 1, '2026-03-21', 25, 'Restock cepat'),
(57, 39, 1, '2026-03-21', 50, 'Restock akhir bulan'),
(57, 11, 1, '2026-03-22', 5, 'Stok tambahan'),
(95, 42, 1, '2026-03-23', 25, 'Stok awal'),
(79, 49, 1, '2026-03-25', 8, 'Tambahan stok'),
(30, 34, 1, '2026-03-26', 15, NULL),
(16, 4, 1, '2026-03-26', 15, NULL),
(49, 41, 1, '2026-03-26', 12, NULL),
(50, 85, 1, '2026-03-29', 15, 'Pengadaan rutin'),
(64, 37, 1, '2026-03-30', 50, NULL),
(66, 1, 1, '2026-03-30', 40, 'Restock cepat'),
(12, 30, 1, '2026-04-01', 40, 'Pengisian kembali'),
(76, 3, 1, '2026-04-01', 40, 'Restock akhir bulan'),
(11, 43, 1, '2026-04-01', 40, 'Restock cepat'),
(74, 81, 1, '2026-04-02', 5, 'Pengadaan baru'),
(31, 81, 1, '2026-04-02', 25, 'Tambahan stok'),
(53, 58, 1, '2026-04-03', 15, 'Pengadaan rutin'),
(16, 60, 1, '2026-04-03', 25, NULL),
(44, 80, 1, '2026-04-03', 50, NULL),
(42, 25, 1, '2026-04-04', 20, 'Pengisian kembali'),
(74, 38, 1, '2026-04-04', 25, 'Stok awal'),
(96, 61, 1, '2026-04-05', 25, 'Stok tambahan'),
(30, 16, 1, '2026-04-07', 20, 'Pesanan khusus'),
(77, 66, 1, '2026-04-10', 15, 'Restock bulanan'),
(88, 100, 1, '2026-04-10', 5, 'Pengisian kembali');

-- 100 Data Barang Keluar
INSERT INTO barang_keluar (id_barang, id_user, tanggal_keluar, jumlah_barang_keluar) VALUES
(44, 1, '2026-01-15', 12),
(12, 1, '2026-01-16', 13),
(83, 1, '2026-01-17', 20),
(76, 2, '2026-01-17', 11),
(53, 3, '2026-01-19', 5),
(23, 1, '2026-01-21', 5),
(83, 1, '2026-01-22', 12),
(59, 1, '2026-01-22', 1),
(17, 1, '2026-01-22', 5),
(73, 1, '2026-01-23', 4),
(88, 1, '2026-01-23', 16),
(63, 1, '2026-01-24', 15),
(73, 1, '2026-01-25', 10),
(12, 1, '2026-01-26', 3),
(95, 1, '2026-01-26', 1),
(64, 1, '2026-01-27', 4),
(52, 2, '2026-01-27', 4),
(66, 2, '2026-01-28', 19),
(52, 1, '2026-01-28', 14),
(96, 1, '2026-01-29', 3),
(84, 2, '2026-01-29', 7),
(33, 3, '2026-01-29', 1),
(56, 1, '2026-01-29', 2),
(34, 3, '2026-01-30', 9),
(36, 3, '2026-01-30', 7),
(47, 1, '2026-01-31', 6),
(43, 1, '2026-01-31', 8),
(36, 2, '2026-01-31', 5),
(85, 1, '2026-01-31', 1),
(19, 2, '2026-01-31', 3),
(31, 1, '2026-02-01', 18),
(60, 2, '2026-02-02', 3),
(52, 1, '2026-02-02', 1),
(33, 1, '2026-02-03', 2),
(59, 3, '2026-02-04', 11),
(47, 2, '2026-02-05', 1),
(96, 3, '2026-02-06', 14),
(98, 2, '2026-02-10', 18),
(89, 2, '2026-02-11', 6),
(20, 1, '2026-02-12', 16),
(76, 1, '2026-02-13', 7),
(56, 2, '2026-02-13', 4),
(57, 1, '2026-02-14', 15),
(2, 1, '2026-02-14', 12),
(59, 1, '2026-02-17', 12),
(85, 3, '2026-02-18', 3),
(57, 2, '2026-02-18', 14),
(48, 1, '2026-02-19', 4),
(96, 1, '2026-02-20', 16),
(55, 2, '2026-02-20', 2),
(56, 1, '2026-02-20', 1),
(33, 1, '2026-02-21', 16),
(77, 2, '2026-02-21', 17),
(82, 3, '2026-02-22', 15),
(6, 2, '2026-02-22', 2),
(6, 3, '2026-02-22', 17),
(13, 1, '2026-02-23', 2),
(24, 2, '2026-02-23', 5),
(12, 1, '2026-02-25', 10),
(80, 1, '2026-02-25', 18),
(48, 1, '2026-02-25', 5),
(66, 1, '2026-02-28', 4),
(30, 1, '2026-03-01', 20),
(77, 1, '2026-03-01', 10),
(49, 3, '2026-03-03', 11),
(50, 1, '2026-03-03', 15),
(56, 3, '2026-03-03', 1),
(71, 3, '2026-03-04', 6),
(43, 1, '2026-03-08', 4),
(74, 1, '2026-03-10', 8),
(11, 1, '2026-03-12', 9),
(53, 1, '2026-03-14', 6),
(14, 1, '2026-03-16', 8),
(15, 1, '2026-03-16', 3),
(14, 1, '2026-03-20', 19),
(17, 1, '2026-03-23', 14),
(76, 1, '2026-03-23', 2),
(26, 1, '2026-03-25', 5),
(13, 3, '2026-03-25', 6),
(84, 1, '2026-03-26', 6),
(76, 1, '2026-03-27', 18),
(14, 1, '2026-03-27', 12),
(24, 2, '2026-03-28', 2),
(57, 2, '2026-03-30', 2),
(96, 3, '2026-03-31', 1),
(43, 3, '2026-04-01', 5),
(11, 2, '2026-04-02', 11),
(59, 3, '2026-04-02', 17),
(55, 3, '2026-04-02', 16),
(13, 1, '2026-04-03', 16),
(65, 1, '2026-04-03', 8),
(82, 1, '2026-04-04', 7),
(20, 2, '2026-04-04', 3),
(33, 1, '2026-04-05', 5),
(36, 2, '2026-04-06', 20),
(79, 2, '2026-04-07', 2),
(80, 1, '2026-04-07', 20),
(20, 1, '2026-04-08', 14),
(59, 3, '2026-04-09', 3),
(55, 1, '2026-04-10', 11);

-- Update stok akhir sesuai transaksi
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 1;
UPDATE barang SET jumlah_stok = 71 WHERE id_barang = 2;
UPDATE barang SET jumlah_stok = 20 WHERE id_barang = 3;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 4;
UPDATE barang SET jumlah_stok = 15 WHERE id_barang = 5;
UPDATE barang SET jumlah_stok = 6 WHERE id_barang = 6;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 7;
UPDATE barang SET jumlah_stok = 30 WHERE id_barang = 8;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 9;
UPDATE barang SET jumlah_stok = 25 WHERE id_barang = 10;
UPDATE barang SET jumlah_stok = 20 WHERE id_barang = 11;
UPDATE barang SET jumlah_stok = 14 WHERE id_barang = 12;
UPDATE barang SET jumlah_stok = 4 WHERE id_barang = 13;
UPDATE barang SET jumlah_stok = 26 WHERE id_barang = 14;
UPDATE barang SET jumlah_stok = 15 WHERE id_barang = 15;
UPDATE barang SET jumlah_stok = 80 WHERE id_barang = 16;
UPDATE barang SET jumlah_stok = 3 WHERE id_barang = 17;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 18;
UPDATE barang SET jumlah_stok = 47 WHERE id_barang = 19;
UPDATE barang SET jumlah_stok = 12 WHERE id_barang = 20;
UPDATE barang SET jumlah_stok = 30 WHERE id_barang = 21;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 22;
UPDATE barang SET jumlah_stok = 10 WHERE id_barang = 23;
UPDATE barang SET jumlah_stok = 5 WHERE id_barang = 24;
UPDATE barang SET jumlah_stok = 12 WHERE id_barang = 25;
UPDATE barang SET jumlah_stok = 15 WHERE id_barang = 26;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 27;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 28;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 29;
UPDATE barang SET jumlah_stok = 15 WHERE id_barang = 30;
UPDATE barang SET jumlah_stok = 32 WHERE id_barang = 31;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 32;
UPDATE barang SET jumlah_stok = 1 WHERE id_barang = 33;
UPDATE barang SET jumlah_stok = 6 WHERE id_barang = 34;
UPDATE barang SET jumlah_stok = 10 WHERE id_barang = 35;
UPDATE barang SET jumlah_stok = 23 WHERE id_barang = 36;
UPDATE barang SET jumlah_stok = 10 WHERE id_barang = 37;
UPDATE barang SET jumlah_stok = 40 WHERE id_barang = 38;
UPDATE barang SET jumlah_stok = 20 WHERE id_barang = 39;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 40;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 41;
UPDATE barang SET jumlah_stok = 20 WHERE id_barang = 42;
UPDATE barang SET jumlah_stok = 33 WHERE id_barang = 43;
UPDATE barang SET jumlah_stok = 63 WHERE id_barang = 44;
UPDATE barang SET jumlah_stok = 30 WHERE id_barang = 45;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 46;
UPDATE barang SET jumlah_stok = 1 WHERE id_barang = 47;
UPDATE barang SET jumlah_stok = 11 WHERE id_barang = 48;
UPDATE barang SET jumlah_stok = 1 WHERE id_barang = 49;
UPDATE barang SET jumlah_stok = 5 WHERE id_barang = 50;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 51;
UPDATE barang SET jumlah_stok = 1 WHERE id_barang = 52;
UPDATE barang SET jumlah_stok = 4 WHERE id_barang = 53;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 54;
UPDATE barang SET jumlah_stok = 1 WHERE id_barang = 55;
UPDATE barang SET jumlah_stok = 2 WHERE id_barang = 56;
UPDATE barang SET jumlah_stok = 24 WHERE id_barang = 57;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 58;
UPDATE barang SET jumlah_stok = 56 WHERE id_barang = 59;
UPDATE barang SET jumlah_stok = 17 WHERE id_barang = 60;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 61;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 62;
UPDATE barang SET jumlah_stok = 12 WHERE id_barang = 63;
UPDATE barang SET jumlah_stok = 86 WHERE id_barang = 64;
UPDATE barang SET jumlah_stok = 17 WHERE id_barang = 65;
UPDATE barang SET jumlah_stok = 17 WHERE id_barang = 66;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 67;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 68;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 69;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 70;
UPDATE barang SET jumlah_stok = 4 WHERE id_barang = 71;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 72;
UPDATE barang SET jumlah_stok = 1 WHERE id_barang = 73;
UPDATE barang SET jumlah_stok = 42 WHERE id_barang = 74;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 75;
UPDATE barang SET jumlah_stok = 2 WHERE id_barang = 76;
UPDATE barang SET jumlah_stok = 53 WHERE id_barang = 77;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 78;
UPDATE barang SET jumlah_stok = 6 WHERE id_barang = 79;
UPDATE barang SET jumlah_stok = 12 WHERE id_barang = 80;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 81;
UPDATE barang SET jumlah_stok = 13 WHERE id_barang = 82;
UPDATE barang SET jumlah_stok = 18 WHERE id_barang = 83;
UPDATE barang SET jumlah_stok = 2 WHERE id_barang = 84;
UPDATE barang SET jumlah_stok = 1 WHERE id_barang = 85;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 86;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 87;
UPDATE barang SET jumlah_stok = 4 WHERE id_barang = 88;
UPDATE barang SET jumlah_stok = 7 WHERE id_barang = 89;
UPDATE barang SET jumlah_stok = 30 WHERE id_barang = 90;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 91;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 92;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 93;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 94;
UPDATE barang SET jumlah_stok = 24 WHERE id_barang = 95;
UPDATE barang SET jumlah_stok = 1 WHERE id_barang = 96;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 97;
UPDATE barang SET jumlah_stok = 7 WHERE id_barang = 98;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 99;
UPDATE barang SET jumlah_stok = 0 WHERE id_barang = 100;

-- Selesai. Total: 100 Supplier, 100 Barang, 100 Barang Masuk, 100 Barang Keluar