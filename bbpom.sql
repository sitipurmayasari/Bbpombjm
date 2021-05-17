-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for bbpom
CREATE DATABASE IF NOT EXISTS `bbpom` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bbpom`;

-- Dumping structure for table bbpom.aduan
CREATE TABLE IF NOT EXISTS `aduan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_aduan` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `aduan_status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0 => belum diperiksa, 1 => selesai diperiksa',
  `pegawai_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpom.aduan: ~14 rows (approximately)
/*!40000 ALTER TABLE `aduan` DISABLE KEYS */;
INSERT INTO `aduan` (`id`, `no_aduan`, `tanggal`, `aduan_status`, `pegawai_id`, `created_at`, `updated_at`) VALUES
	(1, '001/SPI/BBPOM/04/2021', '2021-03-19', 1, 4, '2021-04-20 00:36:56', '2021-04-22 01:46:18'),
	(2, '002/SPI/BBPOM/04/2021', '2021-04-20', 0, 6, '2021-04-20 01:16:08', '2021-04-20 01:16:08'),
	(3, '003/SPI/BBPOM/04/2021', '2021-04-20', 0, 6, '2021-04-20 01:29:24', '2021-04-20 01:29:24'),
	(4, '004/SPI/BBPOM/04/2021', '2021-03-20', 1, 1, '2021-04-20 01:34:23', '2021-04-20 01:34:23'),
	(5, '005/SPI/BBPOM/04/2021', '2021-04-20', 0, 1, '2021-04-20 04:10:09', '2021-04-20 04:10:09'),
	(6, '006/SPI/BBPOM/04/2021', '2021-04-21', 0, 5, '2021-04-21 02:37:57', '2021-04-21 02:37:57'),
	(7, '007/SPI/BBPOM/04/2021', '2021-04-21', 0, 8, '2021-04-21 02:42:19', '2021-04-21 02:42:19'),
	(8, '008/SPI/BBPOM/04/2021', '2021-04-21', 0, 4, '2021-04-21 02:53:34', '2021-04-21 02:53:34'),
	(9, '009/SPI/BBPOM/04/2021', '2021-04-21', 0, 5, '2021-04-21 02:57:21', '2021-04-21 02:57:21'),
	(10, '010/SPI/BBPOM/04/2021', '2021-04-21', 0, 8, '2021-04-21 06:03:34', '2021-04-21 06:03:34'),
	(11, '011/SPI/BBPOM/04/2021', '2021-04-21', 0, 8, '2021-04-21 06:16:57', '2021-04-21 06:16:57'),
	(12, '012/SPI/BBPOM/04/2021', '2021-04-22', 0, 7, '2021-04-22 00:02:31', '2021-04-22 00:02:31'),
	(13, '013/SPI/BBPOM/04/2021', '2021-05-22', 0, 1, '2021-04-22 01:36:33', '2021-04-22 01:36:33'),
	(14, '014/SPI/BBPOM/04/2021', '2021-04-22', 1, 8, '2021-04-22 01:37:08', '2021-04-22 01:49:43');
/*!40000 ALTER TABLE `aduan` ENABLE KEYS */;

-- Dumping structure for table bbpom.aduan_detail
CREATE TABLE IF NOT EXISTS `aduan_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `aduan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inventaris_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '0 => belum diperiksa, 1 => sudah diperbaiki, 2 => tidak dapat diperbaiki',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aduan_detail_aduan_id_index` (`aduan_id`),
  KEY `aduan_detail_inventaris_id_index` (`inventaris_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bbpom.aduan_detail: ~18 rows (approximately)
/*!40000 ALTER TABLE `aduan_detail` DISABLE KEYS */;
INSERT INTO `aduan_detail` (`id`, `aduan_id`, `inventaris_id`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
	(1, '1', '2', 'Pina cacat', 1, '2021-04-20 00:36:56', '2021-04-22 01:46:18'),
	(2, '1', '3', 'Tes', 2, '2021-04-20 00:36:56', '2021-04-22 01:46:18'),
	(3, '2', '4', 'rusak coks', 0, '2021-04-20 01:16:08', '2021-04-20 01:16:08'),
	(4, '2', '5', '2', 0, '2021-04-20 01:16:08', '2021-04-20 01:16:08'),
	(5, '2', '3', 'hh', 0, '2021-04-20 01:16:08', '2021-04-20 01:16:08'),
	(6, '3', '3', 'sekali pakai langsung rusak', 0, '2021-04-20 01:29:24', '2021-04-20 03:53:41'),
	(7, '4', '1', 'sekali pakai langsung rusak', 0, '2021-04-20 01:34:23', '2021-04-20 02:13:33'),
	(8, '5', '1', 'testing', 0, '2021-04-20 04:10:09', '2021-04-20 04:10:09'),
	(9, '6', '1', 'llll', 0, '2021-04-21 02:37:57', '2021-04-21 02:37:57'),
	(10, '7', '4', 'testing1', 0, '2021-04-21 02:42:19', '2021-04-21 02:42:19'),
	(11, '8', '2', 'rusak coks', 0, '2021-04-21 02:53:34', '2021-04-21 02:53:34'),
	(12, '9', '3', 'sekali pakai langsung rusak', 0, '2021-04-21 02:57:21', '2021-04-21 02:57:21'),
	(13, '10', '1', 'testing', 0, '2021-04-21 06:03:34', '2021-04-22 01:35:41'),
	(14, '11', '4', 'Pina cacat', 0, '2021-04-21 06:16:57', '2021-04-21 06:16:57'),
	(15, '11', '5', 'testing1', 0, '2021-04-21 06:16:57', '2021-04-21 06:16:57'),
	(16, '12', '1', 'sekali pakai langsung rusak', 0, '2021-04-22 00:02:31', '2021-04-22 00:02:31'),
	(17, '12', '5', 'testing1', 0, '2021-04-22 00:02:31', '2021-04-22 00:02:31'),
	(18, '13', '2', 'sekali pakai langsung rusak', 0, '2021-04-22 01:36:33', '2021-04-22 01:36:33'),
	(19, '14', '4', 'sekali pakai langsung rusak', 1, '2021-04-22 01:37:08', '2021-04-22 01:49:43');
/*!40000 ALTER TABLE `aduan_detail` ENABLE KEYS */;

-- Dumping structure for table bbpom.barang_rusak
CREATE TABLE IF NOT EXISTS `barang_rusak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aduan_id` int(11) NOT NULL DEFAULT '0',
  `inventaris_id` int(11) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table bbpom.barang_rusak: ~0 rows (approximately)
/*!40000 ALTER TABLE `barang_rusak` DISABLE KEYS */;
/*!40000 ALTER TABLE `barang_rusak` ENABLE KEYS */;

-- Dumping structure for table bbpom.divisi
CREATE TABLE IF NOT EXISTS `divisi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bbpom.divisi: ~6 rows (approximately)
/*!40000 ALTER TABLE `divisi` DISABLE KEYS */;
INSERT INTO `divisi` (`id`, `nama`, `lokasi`, `created_at`, `updated_at`) VALUES
	(1, 'Tata Usaha', 'R. TU', '2021-04-06 13:09:00', '2021-04-15 01:42:45'),
	(3, 'Penindakan', 'Lab Napza', '2021-04-06 13:12:08', '2021-04-15 01:51:43'),
	(4, 'Pengujian', 'LAB Kosmetik', '2021-04-06 13:12:43', '2021-04-15 01:51:30'),
	(5, 'Informasi dan Komunikasi', 'R. Infokom', '2021-04-09 06:06:57', '2021-04-15 01:14:30'),
	(6, 'Pemeriksaan', 'r. pemeriksaan', '2021-04-15 01:42:23', '2021-04-15 01:42:23'),
	(7, 'Balai Besar POM', 'R. Kepala', NULL, NULL);
/*!40000 ALTER TABLE `divisi` ENABLE KEYS */;

-- Dumping structure for table bbpom.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bbpom.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table bbpom.inventaris
CREATE TABLE IF NOT EXISTS `inventaris` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_barang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int(11) NOT NULL DEFAULT '0',
  `kode_bmn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `jumlah_barang` int(11) NOT NULL DEFAULT '0',
  `tanggal_diterima` date NOT NULL,
  `merk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_seri` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` int(11) NOT NULL DEFAULT '0',
  `penanggung_jawab` int(11) NOT NULL DEFAULT '0',
  `file_user_manual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_trouble` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ika` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_barang` enum('baik','rusak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `spesifikasi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bbpom.inventaris: ~5 rows (approximately)
/*!40000 ALTER TABLE `inventaris` DISABLE KEYS */;
INSERT INTO `inventaris` (`id`, `nama_barang`, `kode_barang`, `harga`, `kode_bmn`, `jenis_barang`, `jumlah_barang`, `tanggal_diterima`, `merk`, `no_seri`, `lokasi`, `penanggung_jawab`, `file_user_manual`, `file_trouble`, `file_ika`, `file_foto`, `status_barang`, `spesifikasi`, `created_at`, `updated_at`) VALUES
	(1, 'tas', 'kode01', 0, NULL, 'Pakaian', 0, '2021-07-21', 'gucci', 'seri', 1, 1, NULL, NULL, NULL, NULL, 'baik', NULL, '2021-04-08 04:50:53', '2021-04-14 02:56:51'),
	(2, 'makeup bekas', 'kode02', 0, NULL, 'lainnya', 2, '2021-07-21', 'merk', 'seri001', 4, 1, NULL, NULL, NULL, NULL, 'baik', NULL, '2021-04-08 04:50:53', '2021-04-14 02:57:02'),
	(3, 'barang baru', 'kode001', 0, NULL, 'LAB', 3, '2021-04-13', 'hitachi', '00kk898-9999', 3, 1, NULL, NULL, NULL, NULL, 'baik', NULL, '2021-04-09 06:05:24', '2021-04-14 02:57:14'),
	(4, 'aa3g', 'kk001', 0, NULL, 'LAB', 1, '2021-04-07', 'itu nah', NULL, 1, 6, '-Surat Penggalangan Donasi Bencana Banjir Bandang di Nusa Tenggara Timur (2)-converted.pdf', NULL, NULL, NULL, 'baik', NULL, '2021-04-12 01:43:09', '2021-04-12 03:02:36'),
	(5, 'test gambar', 'gambar', 0, NULL, 'LAB', 3, '2021-04-20', 'merk_gambar', '089788687', 1, 6, '-Surat Penggalangan Donasi Bencana Banjir Bandang di Nusa Tenggara Timur (2)-converted.pdf', '-Surat Penggalangan Donasi Bencana Banjir Bandang di Nusa Tenggara Timur (2)-converted.pdf', '-Surat Penggalangan Donasi Bencana Banjir Bandang di Nusa Tenggara Timur (2)-converted.pdf', 'WhatsApp Image 2021-04-05 at 08.18.22.jpeg', 'baik', 'oke', '2021-04-12 01:54:57', '2021-04-13 01:54:31');
/*!40000 ALTER TABLE `inventaris` ENABLE KEYS */;

-- Dumping structure for table bbpom.jabatan
CREATE TABLE IF NOT EXISTS `jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpom.jabatan: ~6 rows (approximately)
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT INTO `jabatan` (`id`, `jabatan`, `updated_at`, `created_at`) VALUES
	(5, 'SubKoordinator', '2021-04-15 01:06:38', '2021-04-07 03:24:17'),
	(6, 'Kepala Badan', '2021-04-16 06:27:31', '2021-04-07 03:24:57'),
	(7, 'Koordinator', '2021-04-15 01:06:13', '2021-04-07 03:25:05'),
	(8, 'Staff', '2021-04-07 03:25:08', '2021-04-07 03:25:08'),
	(9, 'Magang', '2021-04-09 06:05:58', '2021-04-09 06:05:58'),
	(10, 'Outsorcing', '2021-04-09 06:06:07', '2021-04-09 06:06:07'),
	(11, 'Kepala Bagian', '2021-04-15 04:25:03', '2021-04-15 04:24:55');
/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;

-- Dumping structure for table bbpom.jadwal_main
CREATE TABLE IF NOT EXISTS `jadwal_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventaris_id` int(11) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpom.jadwal_main: ~5 rows (approximately)
/*!40000 ALTER TABLE `jadwal_main` DISABLE KEYS */;
INSERT INTO `jadwal_main` (`id`, `inventaris_id`, `tanggal`, `created_at`, `updated_at`) VALUES
	(1, 2, '2021-04-05', '2021-04-08 05:58:39', '2021-04-08 05:58:39'),
	(2, 5, '2021-07-01', '2021-04-12 05:06:12', '2021-04-12 05:06:12'),
	(3, 5, '2021-05-01', '2021-04-12 05:08:00', '2021-04-12 05:08:00'),
	(4, 5, '2021-04-14', '2021-04-13 02:17:52', '2021-04-13 02:17:52'),
	(5, 5, '2021-04-30', '2021-04-13 02:19:53', '2021-04-13 02:19:53');
/*!40000 ALTER TABLE `jadwal_main` ENABLE KEYS */;

-- Dumping structure for table bbpom.lokasi
CREATE TABLE IF NOT EXISTS `lokasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpom.lokasi: ~4 rows (approximately)
/*!40000 ALTER TABLE `lokasi` DISABLE KEYS */;
INSERT INTO `lokasi` (`id`, `nama`, `updated_at`, `created_at`) VALUES
	(1, 'lab1', '2021-04-15 02:28:33', '2021-04-15 02:28:33'),
	(2, 'satpam1', '2021-04-15 02:30:13', '2021-04-15 02:28:43'),
	(3, 'ruang Tata Usaha', '2021-04-16 02:11:03', '2021-04-16 02:11:03'),
	(4, 'Infokom', '2021-04-16 02:11:13', '2021-04-16 02:11:13');
/*!40000 ALTER TABLE `lokasi` ENABLE KEYS */;

-- Dumping structure for table bbpom.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `link` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpom.menu: ~5 rows (approximately)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `nama`, `link`) VALUES
	(1, 'Pegawai', '/pegawai'),
	(2, 'Inventaris', NULL),
	(3, 'Aduan', NULL),
	(4, 'Laporan', NULL),
	(5, 'Setup', NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table bbpom.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bbpom.migrations: ~5 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2021_04_06_115911_create_divisi_table', 1),
	(5, '2021_04_06_121017_create_inventaris', 2),
	(7, '2021_04_20_000130_aduan_detail', 3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table bbpom.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bbpom.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table bbpom.pejabat
CREATE TABLE IF NOT EXISTS `pejabat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan_id` int(11) NOT NULL,
  `divisi_id` int(11) DEFAULT NULL,
  `subdivisi_id` int(11) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `pjs` varchar(50) DEFAULT NULL,
  `dari` date NOT NULL,
  `sampai` date NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpom.pejabat: ~12 rows (approximately)
/*!40000 ALTER TABLE `pejabat` DISABLE KEYS */;
INSERT INTO `pejabat` (`id`, `jabatan_id`, `divisi_id`, `subdivisi_id`, `users_id`, `pjs`, `dari`, `sampai`, `updated_at`, `created_at`) VALUES
	(8, 6, 7, NULL, 11, NULL, '2021-04-11', '2021-12-31', '2021-04-21 05:13:35', '2021-04-21 05:13:35'),
	(9, 11, 1, NULL, 12, NULL, '2021-04-01', '2021-04-30', '2021-04-21 05:14:19', '2021-04-21 05:14:07'),
	(10, 5, 1, 1, 1, NULL, '2021-04-01', '2021-04-30', '2021-04-21 05:15:22', '2021-04-21 05:15:02'),
	(11, 5, 1, 3, 14, NULL, '2021-04-01', '2021-04-30', '2021-04-21 05:17:23', '2021-04-21 05:17:23'),
	(12, 7, 5, NULL, 15, NULL, '2021-04-01', '2021-04-30', '2021-04-21 05:17:48', '2021-04-21 05:17:48'),
	(13, 7, 5, NULL, 6, 'Pjs.', '2021-05-01', '2021-05-05', '2021-04-22 02:20:09', '2021-04-22 02:20:09'),
	(14, 7, 3, NULL, 22, NULL, '2021-04-01', '2021-04-30', '2021-04-22 04:45:35', '2021-04-22 04:45:35'),
	(15, 7, 4, NULL, 16, NULL, '2021-04-01', '2021-04-30', '2021-04-22 04:45:53', '2021-04-22 04:45:53'),
	(16, 5, 4, 2, 17, NULL, '2021-04-01', '2021-04-30', '2021-04-22 04:46:15', '2021-04-22 04:46:15'),
	(17, 5, 4, 4, 18, NULL, '2021-04-01', '2021-04-30', '2021-04-22 04:46:36', '2021-04-22 04:46:36'),
	(18, 7, 6, NULL, 19, NULL, '2021-04-01', '2021-04-30', '2021-04-22 04:46:57', '2021-04-22 04:46:57'),
	(19, 5, 6, 5, 20, NULL, '2021-04-01', '2021-04-30', '2021-04-22 04:47:19', '2021-04-22 04:47:19'),
	(20, 5, 6, 6, 21, NULL, '2021-04-01', '2021-04-30', '2021-04-22 04:47:48', '2021-04-22 04:47:48');
/*!40000 ALTER TABLE `pejabat` ENABLE KEYS */;

-- Dumping structure for table bbpom.pemeliharaan
CREATE TABLE IF NOT EXISTS `pemeliharaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_pelihara` date NOT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL,
  `no_pemeliharaan` varchar(50) DEFAULT NULL,
  `pegawai_id` int(11) NOT NULL,
  `inventaris_id` int(11) NOT NULL,
  `kegiatan` varchar(50) DEFAULT NULL,
  `hasil` varchar(50) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpom.pemeliharaan: ~0 rows (approximately)
/*!40000 ALTER TABLE `pemeliharaan` DISABLE KEYS */;
INSERT INTO `pemeliharaan` (`id`, `tgl_pelihara`, `updated_at`, `created_at`, `no_pemeliharaan`, `pegawai_id`, `inventaris_id`, `kegiatan`, `hasil`, `keterangan`) VALUES
	(1, '2021-04-27', '2021-04-20 05:29:42', '2021-04-13 02:45:26', '2o', 4, 3, 'ok', 'perbaiki', '"876768"'),
	(2, '2021-04-13', '2021-04-20 04:57:18', '2021-04-20 04:57:18', '00080', 6, 2, 'apa ya', 'perbaiki', 'sukses');
/*!40000 ALTER TABLE `pemeliharaan` ENABLE KEYS */;

-- Dumping structure for table bbpom.petugas
CREATE TABLE IF NOT EXISTS `petugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpom.petugas: ~1 rows (approximately)
/*!40000 ALTER TABLE `petugas` DISABLE KEYS */;
INSERT INTO `petugas` (`id`, `jenis`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Petugas Perlengkapan', 7, '2021-04-16 07:26:05', '2021-04-19 00:11:16'),
	(2, 'Manager Teknis', 10, '2021-04-21 02:01:40', '2021-04-21 02:01:40');
/*!40000 ALTER TABLE `petugas` ENABLE KEYS */;

-- Dumping structure for table bbpom.subdivisi
CREATE TABLE IF NOT EXISTS `subdivisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `divisi_id` int(11) DEFAULT NULL,
  `nama_subdiv` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpom.subdivisi: ~6 rows (approximately)
/*!40000 ALTER TABLE `subdivisi` DISABLE KEYS */;
INSERT INTO `subdivisi` (`id`, `divisi_id`, `nama_subdiv`, `updated_at`, `created_at`) VALUES
	(1, 1, 'Program dan Evaluasi', '2021-04-16 01:21:57', '2021-04-16 01:21:57'),
	(2, 4, 'Kimia', '2021-04-16 01:24:13', '2021-04-16 01:24:13'),
	(3, 1, 'Umum', '2021-04-16 01:28:41', '2021-04-16 01:28:41'),
	(4, 4, 'Mikrobiologi', '2021-04-16 01:29:03', '2021-04-16 01:29:03'),
	(5, 6, 'Inspeksi', '2021-04-16 01:40:06', '2021-04-16 01:29:35'),
	(6, 6, 'Sertifikasi', '2021-04-22 04:42:49', '2021-04-22 04:42:49');
/*!40000 ALTER TABLE `subdivisi` ENABLE KEYS */;

-- Dumping structure for table bbpom.submenu
CREATE TABLE IF NOT EXISTS `submenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `link` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table bbpom.submenu: ~11 rows (approximately)
/*!40000 ALTER TABLE `submenu` DISABLE KEYS */;
INSERT INTO `submenu` (`id`, `menu_id`, `nama`, `link`) VALUES
	(1, 2, 'Data Inventaris', '/inventaris'),
	(2, 2, 'Maintenance', '/maintenance'),
	(3, 3, 'Aduan Kerusakan', '/aduan/create'),
	(4, 3, 'Daftar Aduan', '/aduan'),
	(5, 4, 'Laporan Inventaris', '/laporan'),
	(6, 5, 'Kelompok Substansi', '/divisi'),
	(7, 5, 'Pejabat', '/jabatan'),
	(8, 5, 'Lokasi', '/lokasi'),
	(9, 5, 'Petugas', '/petugas'),
	(10, 5, 'Hak Akses', '/akses'),
	(11, 1, 'Pegawai', '/pegawai');
/*!40000 ALTER TABLE `submenu` ENABLE KEYS */;

-- Dumping structure for table bbpom.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `no_pegawai` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lhr` date NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `telp` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan_id` int(11) NOT NULL DEFAULT '0',
  `status` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi_id` int(1) NOT NULL,
  `subdivisi_id` int(1) DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `akses` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bbpom.users: ~19 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `no_pegawai`, `name`, `username`, `email`, `email_verified_at`, `password`, `tgl_lhr`, `alamat`, `telp`, `jabatan_id`, `status`, `divisi_id`, `subdivisi_id`, `foto`, `remember_token`, `created_at`, `updated_at`, `akses`) VALUES
	(1, '0001-PN-2002', 'bapak A', 'hvghdfd', 'maya_hikari@yahoo.com', NULL, '$2y$10$1Y/Yt2X4VgoTt9nMdEK2zOR4lFvoWp3Shtd22ZvmgeBu9j9nyhTkK', '2021-04-21', 'jhj', '6553465465767', 11, 'PNS', 1, NULL, 'WhatsApp Image 2021-04-12 at 16.11.45.jpeg', '20VHJD6GCEbRNxOR5nabW9pTE5s0ihe32TZU0LjJtw6yJdbOi7p8UirguubJ', '2021-04-08 03:57:49', '2021-04-21 04:19:58', NULL),
	(4, '0002-PN-2002', 'Ibu A', 'jhghjgjh', 'mayabeautu@yahoo.com', NULL, '$2y$10$sGKb7GW2.l6OQCj.41hp1.L4gKU5nCVUk2bTbqqH7tRFVdnzggJDW', '2021-04-21', 'jhj', '6553465465767', 8, 'PNS', 3, NULL, NULL, 'sbsttQyNM4PxFOWArKkpDgPfDtPQ7sJDkgUw7bgdm5WUtWDDSUQxlNpudMJV', '2021-04-08 03:57:49', '2021-04-21 05:01:08', NULL),
	(5, '0003-PN-2002', 'Bapak C', 'vhvb', 'vivu@yahoo.com', NULL, '$2y$10$fbF9elXuc6YK5oSDEMvWmuXxKj2blqqNLn3P/ViW8aMT1Sx073542', '2021-04-21', 'jhj', '6553465465767', 8, 'PNS', 5, NULL, NULL, 'HCtiGBEcgm6vFj82iFpstRKPdkTkB4NufoTEmvt048mqhggox9k2jnVJCcqn', '2021-04-08 03:57:49', '2021-04-21 05:00:36', NULL),
	(6, '0001-PN-2003', 'Ibu B', 'avadakedabra', 'lulaby@itu.com', NULL, '$2y$10$eWwYPMNVS4M/1lV2aBf2Cen8JNIegsxZYuI6YBWoGtMTwwt8RKwIu', '2021-04-07', 'jl. itu', '34232545435', 8, 'PNS', 1, 1, 'background.jpg', 'K9Jl77HA5kdtYfoGbZ5IsjLoaK02LZCsVvXE0toqLxVaBTF8UkZyWU25JwRO', '2021-04-09 01:07:01', '2021-04-21 05:09:42', NULL),
	(7, '83001', 'Ibu C', 'admin', 'contoh@gmail.com', NULL, '$2y$10$z6cCHJ3q2b3fDKk9hF5BT.b0qYSx2oMOZS3u90uwYKPZKTDIuwrfi', '1993-05-25', 'BJm', '082240300501', 8, 'OSC', 5, NULL, 'userman.png', 'zK2vcfryg56EzaJADBzyssKixG8ygwuYH8Tj11LmiYlpTwdCamTsfUpFob2G', '2021-04-13 11:14:38', '2021-04-21 04:21:41', NULL),
	(8, '0001/KT/4/2021', 'maya', 'maya', 'example@gmail.com', NULL, '$2y$10$i9/h8gSFiIJoVpL6bMUOLe0Eg5GyfrEy7Ne/c3V4.PzH0BHRvIS9e', '1992-10-30', 'Jl. Veteran', '087841346020', 8, 'Kontrak', 1, 3, 'usergirl.png', 'wV4sWJ92ybX41pTu2WvC8q6tn5knijvKzToYpuHGQvGCAmic41obhfhWpuwt', '2021-04-13 23:55:08', '2021-04-21 04:17:37', NULL),
	(9, 'asalaja', 'Bapak B', 'asaluser', 'asal@mail.com', NULL, '$2y$10$KZJtKpAaSs2QtObo.2UoI.6y0kYZ6Jpd4uTO149oyicSSQsMN4OOq', '2021-03-28', 'asalaja', '121212121', 10, 'OSC', 3, 5, 'userman.png', 'Zmu20KxetdyFehIceUXjxXZmJZpQ6RDNnG5ujgxXJjKvNoOjWcvdL3DWERGU', '2021-04-14 01:58:01', '2021-04-22 01:31:45', NULL),
	(10, '002', 'Babah', 'babah', 'raf@gmail.com', NULL, '$2y$10$XvpapbDXw.eGrlXLNyR/qu.B.4WzclxMIfU4dUf2Hq3gr19HWJaL6', '2021-04-20', 'BJM', '0822', 8, 'PNS', 4, 2, '', 'xjuWyEKZldjLk0MmPFZtbNGhRZYgLpco8iRuHhZKI0j59tZmHnzq7mkbbwpt', '2021-04-16 02:23:33', '2021-04-21 05:00:01', NULL),
	(11, 'KEBAL-001', 'Leo', 'leokebal', 'leo@kebal.com', NULL, '$2y$10$JyX4CeXURWjCcJL0LvU80OztXEJF2ZcNJTisS5rh6yJa5.poWNFoS', '2021-04-21', NULL, NULL, 6, 'PNS', 7, NULL, '', 'fY8H2nbrAhsU6DNzRwGK9BElqq8B57DutKTzZJDwIyJ6Hk4RDElmlF4WuTsu', '2021-04-21 05:02:06', '2021-04-21 05:02:06', NULL),
	(12, 'KABAGTU', 'TOM', 'kabagtudong', 'kabagtu@gmail.com', NULL, '$2y$10$gJgBw97pZJphlEMt9abva.Zy79/p6YVYT9Gj1V.7y9o5KLHTU98/.', '2021-04-20', NULL, NULL, 11, 'PNS', 1, NULL, '', '6vpbiMkuBN4TtZTlYV6xDrPrVgL9fcvUMOHuVk8qJ6UYmyMkCdsjB2jdZ2FG', '2021-04-21 05:03:31', '2021-04-21 05:03:31', NULL),
	(13, 'STU-001', 'Ria', 'subkoorprog', 'subkoortu01@gmail.com', NULL, '$2y$10$68XdFGWhFLCe8P2tggLCv.6aNSjwepmjFNug6ORKtXfe9LRQ1z6M.', '2021-04-20', NULL, NULL, 5, 'PNS', 1, 1, '', 'j6THgMysA9VqQkW4UuWtkWN1H8763y9dCd2z61ksUfAYWWJOTSgjx9wDVqK2', '2021-04-21 05:04:43', '2021-04-21 05:04:43', NULL),
	(14, 'STU-002', 'mira', 'subumum', 'subkoortu02@gmail.com', NULL, '$2y$10$PpWUOQSujNn5jc8pUzx79OOAVKNo6PVBInRq424oM.x.rJdmZjAEm', '2021-04-14', NULL, NULL, 5, 'PNS', 1, 3, '', 'L7ErmrD4R9RYvy3ad8KULBOl1huv5dtfi80U0N8V0xQajm1jzBpIrFVtNdo4', '2021-04-21 05:05:55', '2021-04-21 05:05:55', NULL),
	(15, 'KIK-PN-2002', 'selfi', 'mimindong', 'ketua@gmail.com', NULL, '$2y$10$P2QuGnjxTJUHjlihRhRec.BxIDdE6vH24tGQVvjxNN3dFgnHeMqua', '2021-04-22', NULL, NULL, 7, 'PNS', 5, NULL, '', 'hOIf7atRifFz7LaPR6xGMjQ3fKKsjAZD67UlMDDM8tkVgnkDCrKLjDoFq8Rm', '2021-04-21 05:07:57', '2021-04-21 05:07:57', NULL),
	(16, '0001-KPJ-0001', 'Ari', 'keluji01', 'keluji01@gmail.com', NULL, '$2y$10$SEuJAWHKuw2DH7Qd35YvluPZFTRoa.MMbcw90J3c65ny1omeRK6MC', '2021-04-28', NULL, NULL, 7, 'PNS', 4, NULL, '', '6IpoqDfCeOv49uTow5JJJMm0Qieef1Q9fRkV0ma9on8COuMfAUguWIwEnZCN', '2021-04-22 04:31:05', '2021-04-22 04:31:05', NULL),
	(17, '0002-KPJ-0001', 'ahmad', 'kpj01', 'kpj01@gmail.com', NULL, '$2y$10$kEqhXL5sCDUcwLe0NdRdRercyoB0r1hbMX1nosM4NpPjRIdKfJp9G', '2021-04-21', NULL, NULL, 5, 'PNS', 4, 2, '', 'hKNxy8GMEh1vglXTHMZK50X4mCLbSceP22BF4Aj9RBO11HmtATVLIiNDPgGQ', '2021-04-22 04:32:34', '2021-04-22 04:36:21', NULL),
	(18, '0003-PN-2003', 'anto', 'antogun', 'antogun@gmail.com', NULL, '$2y$10$/8bR400c6uQb2wRpLoPM9.MazQA82TUYykslXMXvDObRKbldZ5OkW', '2021-04-01', NULL, NULL, 5, 'PNS', 4, 4, '', 'bCDsZ5R6WZyi9YtR6rFZWTtRrV2KsRvoKzF4VBt2Gi8OnNXMJczthB9126Sd', '2021-04-22 04:38:58', '2021-04-22 04:38:58', NULL),
	(19, '0005-PN-2003', 'dira', 'diradara', 'dira@dara.com', NULL, '$2y$10$jGvmUdCCr0XGVWfc99W//unrDzorlVxjlVHx9saHePd6/xDys264m', '2021-04-04', NULL, NULL, 7, 'PNS', 6, NULL, '', 'G6ZTcBMyQTUf1hwUox7fXwoqx7ywyQaBjNaH6kNUx9kXjwnb3OQ3BBVm5gwF', '2021-04-22 04:40:11', '2021-04-22 04:40:11', NULL),
	(20, '0006-PN-2003', 'dian', 'dianaja', 'dian@ini.com', NULL, '$2y$10$Nypg/aFoHLYynTRZgfp7KuDL5tbiL1UKHVUasjS82ThFFa7D5jyCi', '2021-04-01', 'jl. iu', NULL, 5, 'PNS', 6, 5, '', 'Gl8tcJ5S6ZN83vNiHelxMfMFVuwkGR2kcnD4UqTxlzCgFKlDRNQL7kOneaUn', '2021-04-22 04:41:12', '2021-04-22 04:41:12', NULL),
	(21, '0001-PN-2009', 'Dika', 'Dika', 'Dika@itu.com', NULL, '$2y$10$UDqbXTs3.4zQuNkxMvdTC./sU7rE3ajx.qQu.8st6LRY0Yb21W9M2', '2021-03-31', NULL, NULL, 5, 'PNS', 6, 6, '', 'FtyfO3tbH4zydhu4gxOToiB0D38Xuptzn7IWynvGGLXJgcrU79p9VpSb0S1O', '2021-04-22 04:43:45', '2021-04-22 04:43:45', NULL),
	(22, '0009-PN-2002', 'sera', 'sera@ini', 'sera@ini.com', NULL, '$2y$10$mvHrpSsuHUiP/UUBs82ZeuIAjgY4HzlXVf68YBDHVpO7hxPXq7Wsa', '2021-03-28', NULL, '6553465465767', 7, 'PNS', 3, NULL, '', 'OmdZ0ZtmybziJbCiYUrgqfFJSvtVjQ59HUdxHA11y35XBrWOfYQfcvyIz3bs', '2021-04-22 04:44:40', '2021-04-22 04:44:40', NULL),
	(23, '000-PN-2002', 'TESTING', 'asaldch', 'ant@gmail.com', NULL, '$2y$10$tyN0sxsKUbUpT6vkLee5u.UN/8kyk2P1l8Zb1hqlRGPqTXtKyja/y', '2021-04-01', NULL, NULL, 5, 'Magang', 5, NULL, '', 'Q4RIMLNwDPm885o32n8qgbmRLduAYu9sxOA1XIfRuBEQPcYHfTL8s0qPza4B', '2021-04-22 05:03:34', '2021-04-22 05:03:34', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
