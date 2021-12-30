-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 31, 2021 at 02:38 AM
-- Server version: 10.3.32-MariaDB-cll-lve
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1696524_sofine`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_asuransi`
--

DROP TABLE IF EXISTS `m_asuransi`;
CREATE TABLE `m_asuransi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_asuransi`
--

INSERT INTO `m_asuransi` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BPJS', 'BPJS', '2020-09-18 23:31:23', NULL, NULL),
(2, 'asa', 'as', '2020-09-18 23:31:23', '2020-09-19 21:26:07', '2020-09-19 21:33:05'),
(3, 'Arisan Kampung', 'Arisan Kampung', '2020-09-18 23:31:23', NULL, NULL),
(4, 'coba', 'coba', '2020-09-19 14:02:09', NULL, NULL),
(5, 'cek', 'cek', '2020-09-19 14:02:19', NULL, NULL),
(6, 'select2', 'sel2', '2020-09-19 14:12:08', '2020-09-19 21:23:20', NULL),
(7, 'asas', 'aad', '2020-09-19 20:41:41', '2020-09-19 21:28:49', '2020-09-19 21:33:01'),
(8, 'Prundential', 'Prudential', '2020-09-19 21:26:22', NULL, NULL),
(9, 'yoyoi', 'yoyoi', '2020-09-19 21:33:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_bank_kredit`
--

DROP TABLE IF EXISTS `m_bank_kredit`;
CREATE TABLE `m_bank_kredit` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_bank_kredit`
--

INSERT INTO `m_bank_kredit` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BCA', 'BCA', NULL, NULL, NULL),
(2, 'Bank Jatim', 'Bank Jatin', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_data_medik`
--

DROP TABLE IF EXISTS `m_data_medik`;
CREATE TABLE `m_data_medik` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `gol_darah` varchar(2) DEFAULT NULL,
  `tekanan_darah` varchar(255) DEFAULT NULL,
  `tekanan_darah_val` varchar(255) DEFAULT NULL,
  `penyakit_jantung` int(1) DEFAULT NULL,
  `diabetes` int(1) DEFAULT NULL,
  `haemopilia` int(1) DEFAULT NULL,
  `hepatitis` int(1) DEFAULT NULL,
  `gastring` int(1) DEFAULT NULL,
  `penyakit_lainnya` int(1) DEFAULT NULL,
  `hamil` int(11) DEFAULT NULL,
  `alergi_obat` int(1) DEFAULT NULL,
  `alergi_obat_val` varchar(255) DEFAULT NULL,
  `alergi_makanan` int(1) DEFAULT NULL,
  `alergi_makanan_val` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_data_medik`
--

INSERT INTO `m_data_medik` (`id`, `id_pasien`, `gol_darah`, `tekanan_darah`, `tekanan_darah_val`, `penyakit_jantung`, `diabetes`, `haemopilia`, `hepatitis`, `gastring`, `penyakit_lainnya`, `hamil`, `alergi_obat`, `alergi_obat_val`, `alergi_makanan`, `alergi_makanan_val`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 'O', 'HYPERTENSI', '140/10', 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, '2020-09-13 17:53:03', '2021-12-30 08:37:21', NULL),
(2, 6, 'AB', 'HYPERTENSI', '900/21', 1, 0, 0, 0, 1, 0, NULL, 1, 'kalpanax', 0, NULL, '2020-09-19 20:28:52', NULL, NULL),
(3, 7, 'O', 'HYPOTENSI', '8000/2', 1, 1, 1, 1, 1, 0, NULL, 1, 'kalpanax', 0, NULL, '2020-10-11 14:47:17', NULL, NULL),
(4, 1, 'O', 'HYPERTENSI', '140', 0, 0, 0, 0, 0, 0, 0, 1, 'Minyak Angin', 1, 'Beras', '2021-12-12 20:35:53', '2021-12-28 15:12:45', NULL),
(5, 2, 'AB', 'HYPOTENSI', '20', 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, '2021-12-12 20:37:36', '2021-12-31 00:48:32', NULL),
(6, 3, 'A', 'NORMAL', '80', 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, '2021-12-12 20:38:59', NULL, NULL),
(7, 4, '0', 'NORMAL', '80/90', 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, '2021-12-16 01:03:00', NULL, NULL),
(8, 5, 'O', 'HYPERTENSI', '14', 1, 1, 1, 0, 0, 0, NULL, 1, 'asas', 0, NULL, '2021-12-20 15:54:22', NULL, NULL),
(9, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, '2021-12-30 23:52:53', NULL, NULL),
(10, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2021-12-31 00:12:39', NULL, NULL),
(11, 7, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2021-12-31 00:15:33', NULL, NULL),
(12, 8, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2021-12-31 00:49:31', NULL, NULL),
(13, 9, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2021-12-31 00:51:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_diagnosa`
--

DROP TABLE IF EXISTS `m_diagnosa`;
CREATE TABLE `m_diagnosa` (
  `id_diagnosa` int(32) NOT NULL,
  `kode_diagnosa` varchar(255) DEFAULT NULL,
  `nama_diagnosa` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_diagnosa`
--

INSERT INTO `m_diagnosa` (`id_diagnosa`, `kode_diagnosa`, `nama_diagnosa`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'K.00.1', 'Karies Gigi Dong', '2020-09-07 08:18:56', NULL, NULL),
(2, 'K.00.2', 'Gigi Berlubang', '2020-09-07 10:24:36', NULL, NULL),
(3, 'K.00.3', 'Coba Diag', '2020-09-07 10:29:33', NULL, '2020-09-09 09:26:55'),
(4, 'K.00.3', 'Boyok Linu', '2020-11-11 10:52:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_jabatan`
--

DROP TABLE IF EXISTS `m_jabatan`;
CREATE TABLE `m_jabatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_jabatan`
--

INSERT INTO `m_jabatan` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dokter Gigi', 'Dokter Gigi Spesialis', '2020-08-30 23:25:53', '2020-09-08 20:07:44', NULL),
(2, 'Staff Admin', 'Staff Admin', '2020-08-30 23:25:53', NULL, NULL),
(3, 'Cleaning Service', 'Resik Resik Klinik', '2020-09-08 19:57:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_logistik`
--

DROP TABLE IF EXISTS `m_jenis_logistik`;
CREATE TABLE `m_jenis_logistik` (
  `id_jenis_logistik` int(32) NOT NULL,
  `jenis` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_jenis_logistik`
--

INSERT INTO `m_jenis_logistik` (`id_jenis_logistik`, `jenis`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Obat', NULL, NULL, NULL),
(2, 'Bahan Habis Pakai', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_trans`
--

DROP TABLE IF EXISTS `m_jenis_trans`;
CREATE TABLE `m_jenis_trans` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_jenis_trans`
--

INSERT INTO `m_jenis_trans` (`id`, `nama`) VALUES
(1, 'logistik'),
(2, 'tindakan'),
(3, 'lab'),
(4, 'visite'),
(5, 'diskon global'),
(6, 'honor dokter');

-- --------------------------------------------------------

--
-- Table structure for table `m_klinik`
--

DROP TABLE IF EXISTS `m_klinik`;
CREATE TABLE `m_klinik` (
  `id` int(11) NOT NULL,
  `nama_klinik` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `nama_dokter` varchar(255) DEFAULT NULL,
  `sip` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_klinik`
--

INSERT INTO `m_klinik` (`id`, `nama_klinik`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `provinsi`, `telp`, `email`, `website`, `nama_dokter`, `sip`, `gambar`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'SOFINE SIMO JAWAR', 'JL. SIMO JAWAR NO.35D', 'KUPANG KRAJAN', 'SAWAHAN', 'SURABAYA', '60281', 'JAWA TIMUR', '0822-2823-2675', 'as@as.com', '', 'ROY TAMARA', '0822-2823-2675', 'logo.PNG', '2021-11-30 23:21:35', '2021-12-20 15:56:35', NULL),
(4, 'SOFINE DRIYOREJO', 'DRIYOREJO 12121', 'KEL 2', 'KEC 2', 'GRESIK', '71872', 'JAWA TIMUR', '18912891829', 'asas@aass.com', '', 'ASASAS', '18912891829', 'cabang-21639246098.jpg', '2021-12-09 23:14:23', '2021-12-20 15:57:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_laboratorium`
--

DROP TABLE IF EXISTS `m_laboratorium`;
CREATE TABLE `m_laboratorium` (
  `id_laboratorium` int(32) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `tindakan_lab` varchar(500) DEFAULT NULL,
  `harga` int(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `disc_persen` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_laboratorium`
--

INSERT INTO `m_laboratorium` (`id_laboratorium`, `kode`, `tindakan_lab`, `harga`, `created_at`, `updated_at`, `deleted_at`, `disc_persen`) VALUES
(1, 'L001', 'Periksa Darah', 500000, NULL, '2021-12-16 00:46:45', NULL, 10),
(2, 'L002', 'lalala', 100000, '2020-09-17 11:04:30', '2020-09-17 11:27:55', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_layanan`
--

DROP TABLE IF EXISTS `m_layanan`;
CREATE TABLE `m_layanan` (
  `id_layanan` int(11) NOT NULL,
  `kode_layanan` varchar(255) DEFAULT NULL,
  `nama_layanan` varchar(255) DEFAULT NULL,
  `dokter` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `waktu_layanan` char(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_layanan`
--

INSERT INTO `m_layanan` (`id_layanan`, `kode_layanan`, `nama_layanan`, `dokter`, `keterangan`, `waktu_layanan`, `created_at`, `updated_at`, `deleted_at`, `icon`) VALUES
(1, 'LY-00001', 'CABUT GIGI', '1,6,7,8', 'Ini Keterangan aja', '60', '2021-12-30 13:07:45', '2021-12-30 12:40:25', NULL, 'cabut_gigi'),
(2, 'LY-00002', 'KAWAT GGI', '1', '', '90', '2021-12-30 13:07:49', '2021-12-30 12:45:33', NULL, 'kawat_gigi'),
(3, 'LY-00003', 'PEMBERSIHAN KARANG GIGI', '6,7,8', NULL, '30', '2021-12-30 13:07:52', NULL, NULL, 'gigi_bersih'),
(4, 'LY-00004', 'KONSULTASI', '1,2', NULL, '30', '2021-12-30 13:07:56', NULL, NULL, 'dokter'),
(5, 'LY-00005', 'TAMBAL GIGI', '1,6,7,8', NULL, '60', '2021-12-30 13:08:00', NULL, NULL, 'tambal_gigi'),
(6, 'LY-00006', 'KONTROL KAWAT GIGI', '1', 'kontrol kawat gigi', '30', '2021-12-30 13:08:03', '2021-12-30 12:35:16', NULL, 'kontrol_kawat'),
(7, 'LY-00007', 'SCALING & TAMBAL', '1,6,7,8', 'Paket :\r\n- Scaling\r\n- Tambal', '90', '2021-12-30 13:08:07', NULL, NULL, NULL),
(8, 'LY-00008', 'SCALING & CABUT', '1,6,7,8', 'Paket : \r\n- Scaling\r\n- Cabut', '90', '2021-12-30 13:08:11', NULL, NULL, NULL),
(9, 'LY-00009', 'PERAWATAN SALURAN AKAR', '1,6,7,8', '', '60', '2021-12-30 13:08:14', NULL, NULL, NULL),
(10, 'LY-00010', 'GIGI PALSU', '1', '', '60', '2021-12-30 13:08:18', NULL, NULL, NULL),
(11, 'LY-00011', 'KONTROL KAWAT GIGI', NULL, '', '30', '2021-12-30 13:08:21', NULL, '2021-12-30 12:52:19', NULL),
(12, 'LY-00012', 'BLEACHING', '1', '', '90', '2021-12-30 13:08:24', NULL, NULL, NULL),
(13, 'LY-00013', 'VENEER', '1', '', '90', '2021-12-30 13:08:27', NULL, NULL, NULL),
(14, 'LY-00014', 'OPERASI', '1', '', '120', '2021-12-30 13:08:31', NULL, NULL, NULL),
(15, 'LY-00015', 'KONTROL PEMBEDAHAN/OPERASI', '1', '', '30', '2021-12-30 13:08:34', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_logistik`
--

DROP TABLE IF EXISTS `m_logistik`;
CREATE TABLE `m_logistik` (
  `id_logistik` int(32) NOT NULL,
  `kode_logistik` varchar(255) DEFAULT NULL,
  `nama_logistik` varchar(500) DEFAULT NULL,
  `harga_beli` int(100) DEFAULT NULL,
  `harga_jual` varchar(255) DEFAULT NULL,
  `stok` int(255) DEFAULT NULL,
  `id_jenis_logistik` int(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_logistik`
--

INSERT INTO `m_logistik` (`id_logistik`, `kode_logistik`, `nama_logistik`, `harga_beli`, `harga_jual`, `stok`, `id_jenis_logistik`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '001', 'Oskadon', 1000, '1500', 250, 1, NULL, '2020-10-11 14:44:42', '2021-12-13 21:38:49'),
(2, '002', 'Masker tes', 1000, '2000', 5, 2, '2020-09-15 11:54:34', '2020-09-15 13:48:10', '2021-12-13 21:39:35'),
(3, 'A-001', 'Paracetamol', 0, '0', 300, 1, '2021-12-13 21:40:16', NULL, NULL),
(4, 'A-002', 'Puyer Bintang 7', 0, '0', 50, 1, '2021-12-13 21:41:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_menu`
--

DROP TABLE IF EXISTS `m_menu`;
CREATE TABLE `m_menu` (
  `id` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `aktif` int(1) DEFAULT NULL,
  `tingkat` int(11) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `add_button` int(1) DEFAULT NULL,
  `edit_button` int(1) DEFAULT NULL,
  `delete_button` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `m_menu`
--

INSERT INTO `m_menu` (`id`, `id_parent`, `nama`, `judul`, `link`, `icon`, `aktif`, `tingkat`, `urutan`, `add_button`, `edit_button`, `delete_button`) VALUES
(1, 0, 'Dashboard', 'Dashboard', 'home', 'flaticon2-architecture-and-city', 1, 1, 1, 0, 0, 0),
(2, 0, 'Setting (Administrator)', 'Setting', '', 'flaticon2-gear', 1, 1, 100, 0, 0, 0),
(3, 2, 'Setting Menu', 'Setting Menu', 'set_menu', 'flaticon-grid-menu', 1, 2, 2, 1, 1, 1),
(4, 2, 'Setting Role', 'Setting Role', 'set_role', 'flaticon-network', 1, 2, 1, 1, 1, 1),
(6, 0, 'Master', 'Master', '', 'flaticon-folder-1', 1, 1, 2, 0, 0, 0),
(7, 10, 'Data User', 'Data User', 'master_user', 'flaticon-users', 1, 3, 1, 1, 1, 1),
(8, 10, 'Data Pegawai', 'Master Data Pegawai', 'master_pegawai', 'flaticon-user', 1, 3, 2, 1, 1, 1),
(9, 6, 'Data', 'Data', '', 'flaticon-tabs', 1, 2, 2, 0, 0, 0),
(10, 6, 'User', 'User', '', 'flaticon-users-1', 1, 2, 3, 0, 0, 0),
(11, 6, 'Klinik', 'Klinik', '', 'flaticon-medal', 1, 2, 1, 0, 0, 0),
(12, 11, 'Data Klinik', 'Data Klinik', 'master_klinik', 'flaticon-profile', 1, 3, 1, 1, 1, 1),
(13, 9, 'Tindakan', 'Tindakan', 'master_tindakan', 'flaticon2-graph', 1, 3, 1, 1, 1, 1),
(14, 9, 'Diagnosa', 'Diagnosa', 'master_diagnosa', 'flaticon2-contract', 1, 3, 2, 1, 1, 1),
(15, 10, 'Pemetaan', 'Pemetaan', 'master_pemetaan', 'flaticon-interface-8', 1, 3, 3, 1, 1, 1),
(16, 10, 'Jabatan', 'Master Jabatan', 'master_jabatan', 'flaticon-customer', 1, 3, 4, 1, 1, 1),
(17, 0, 'Registrasi', 'Registrasi', '', 'flaticon-list', 1, 1, 3, 0, 0, 0),
(18, 17, 'Data Pasien', 'Data pasien', 'data_pasien', 'flaticon-profile-1', 1, 2, 1, 1, 1, 1),
(19, 17, 'Registrasi Pasien', 'Registrasi Pasien', 'reg_pasien', 'flaticon-user-add', 1, 2, 2, 1, 1, 1),
(20, 0, 'Rekam Medik', 'Rekam Medik', '', 'flaticon2-heart-rate-monitor', 1, 1, 4, 0, 0, 0),
(21, 20, 'Data Rekam Medik', 'Data Rekam Medik', 'rekam_medik', 'flaticon2-medical-records', 1, 2, 1, 1, 1, 1),
(24, 9, 'Logistik dan Obat', 'Logistik dan Obat', 'master_logistik', 'flaticon2-contract', 1, 3, 3, 1, 1, 1),
(25, 9, 'Laboratorium', 'Laboratorium', 'master_laboratorium', 'flaticon2-contract', 1, 3, 4, 1, 1, 1),
(26, 9, 'Asuransi', 'Asuransi', 'master_asuransi', 'flaticon2-contract', 0, 3, 5, 1, 1, 1),
(27, 10, 'Honor Dokter', 'Honor Dokter', 'honor_dokter', 'flaticon-coins', 1, 3, 5, 1, 1, 1),
(28, 0, 'Transaksi', 'Transaksi', '', 'flaticon-infinity', 1, 1, 5, 0, 0, 0),
(29, 28, 'Pembayaran', 'Pembayaran', 'pembayaran', 'flaticon-coins', 1, 2, 1, 1, 1, 1),
(30, 9, 'Diskon', 'Diskon', 'master_diskon', 'flaticon2-contract', 0, 3, 5, 1, 1, 1),
(31, 0, 'Laporan & Monitoring', 'Laporan & Monitoring', '', 'flaticon-analytics', 1, 1, 6, 0, 0, 0),
(32, 38, 'Laporan Honor Dokter', 'Laporan Honor Dokter', 'lap_honor_dokter', 'flaticon-profile-1', 1, 3, 1, 1, 1, 1),
(33, 38, 'Laporan Penerimaan Klinik', 'Laporan Penerimaan Klinik', 'lap_penerimaan_klinik', 'flaticon-piggy-bank', 1, 3, 2, 1, 1, 1),
(34, 37, 'Monitoring Kunjungan Klinik', 'Monitoring Kunjungan Klinik', 'monitoring_kunjungan', 'flaticon-network', 1, 3, 1, 1, 1, 1),
(35, 0, 'Jadwal Dokter', 'Jadwal Dokter', 'jadwal_dokter', 'flaticon-event-calendar-symbol', 1, 1, 3, 1, 1, 1),
(36, 37, 'Monitoring Honor Dokter', 'Monitoring Honor Dokter', 'monitoring_honor', 'flaticon-coins', 1, 3, 2, 1, 1, 1),
(37, 31, 'Monitoring', 'Monitoring', '', 'flaticon-presentation-1', 1, 2, 1, 0, 0, 0),
(38, 31, 'Laporan', 'Laporan', '', 'flaticon-line-graph', 1, 2, 2, 0, 0, 0),
(39, 9, 'Master Non Tunai', 'Master Non Tunai', 'master_nontunai', 'flaticon2-list', 1, 3, 6, 1, 1, 1),
(40, 2, 'Setting Pesan', 'Setting Pesan', 'set_pesan', 'flaticon-whatsapp', 1, 2, 3, 1, 1, 1),
(41, 9, 'Layanan', 'layanan', 'master_layanan', 'flaticon-businesswoman', 1, 3, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_nontunai`
--

DROP TABLE IF EXISTS `m_nontunai`;
CREATE TABLE `m_nontunai` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_nontunai`
--

INSERT INTO `m_nontunai` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ovo', NULL, NULL, NULL),
(2, 'Debit', NULL, NULL, NULL),
(3, 'Shopee', NULL, NULL, NULL),
(4, 'Dana', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_pasien`
--

DROP TABLE IF EXISTS `m_pasien`;
CREATE TABLE `m_pasien` (
  `id` int(11) NOT NULL,
  `no_rm` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `suku` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `alamat_rumah` text DEFAULT NULL,
  `telp_rumah` varchar(255) DEFAULT NULL,
  `alamat_kantor` text DEFAULT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `is_aktif` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `file_ktp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_pasien`
--

INSERT INTO `m_pasien` (`id`, `no_rm`, `nama`, `tempat_lahir`, `tanggal_lahir`, `nik`, `jenis_kelamin`, `suku`, `pekerjaan`, `alamat_rumah`, `telp_rumah`, `alamat_kantor`, `hp`, `is_aktif`, `created_at`, `updated_at`, `deleted_at`, `file_ktp`) VALUES
(1, 'AN.1985.03.0001', 'ANDY', 'surabaya', '1985-03-02', '882712121881819', 'L', 'Pribumi', 'Wiraswasta', 'Jl. A Yuni 201 Surabaya', '03128128182', NULL, '071827182718', 1, '2021-12-12 20:35:53', NULL, NULL, NULL),
(2, 'AN.1992.02.0002', 'ANWAR', 'Magetan', '1992-02-14', '18219281928', 'L', 'Negrito', 'PNS', 'Jl. abcd 12', NULL, NULL, '182192819289', 1, '2021-12-12 20:37:36', NULL, NULL, NULL),
(3, 'NI.1997.08.0001', 'NINGSIH', 'Surabaya', '1997-08-14', '1821982919', 'P', 'Pinoy', 'TNI', 'Jl. 1kjakjaksj', NULL, NULL, '18291829182912', 1, '2021-12-12 20:38:59', NULL, NULL, NULL),
(4, 'YA.2012.02.0001', 'YAYAN', 'SURABAYA', '2012-02-04', '-', 'L', 'CAMPURAN', 'PELAJAR', 'JL. abcde', NULL, '-', '08127182718278', 1, '2021-12-16 01:03:00', NULL, NULL, NULL),
(5, 'AG.1954.12.0001', 'AGUS ULUM MULYO, S.KOM., MT', 'Surabaya', '1954-12-12', '357853532353535', 'L', 'Indo', 'asasas', 'Jl. aksjaksjak  akjsk jakjaks', 'asas', 'asdasdas', '0816656560506', 1, '2021-12-20 15:54:22', NULL, NULL, '5-1640456210.jpeg'),
(6, 'BA.1987.02.0001', 'BAMBANG PAMUNGKAS', 'Belanda', '1987-02-06', '3578192819281912', 'L', NULL, NULL, 'Jlaskajsk', NULL, NULL, '08121281828128', 1, '2021-12-31 00:12:39', NULL, NULL, NULL),
(7, 'MI.1956.12.0001', 'MICHAEL', 'Frankfurt', '1956-12-08', '3571627162716271', 'L', NULL, NULL, '127182', NULL, NULL, '018291829128', 1, '2021-12-31 00:15:33', NULL, NULL, NULL),
(8, 'BA.1967.07.0002', 'BAEDAH', 'Madura', '1967-07-04', '35612717291821992', 'L', NULL, NULL, 'askjaks', NULL, NULL, '102102910291029', 1, '2021-12-31 00:49:31', NULL, NULL, NULL),
(9, 'CH.1993.02.0001', 'CHANATIP', 'Bangkok', '1993-02-05', '31928192819281', 'L', NULL, NULL, 'jkdajkasdj', NULL, NULL, '10920129012910', 1, '2021-12-31 00:51:23', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_pegawai`
--

DROP TABLE IF EXISTS `m_pegawai`;
CREATE TABLE `m_pegawai` (
  `id` int(11) NOT NULL DEFAULT 1,
  `id_jabatan` int(11) DEFAULT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telp_1` varchar(255) DEFAULT NULL,
  `telp_2` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `is_aktif` int(1) DEFAULT NULL,
  `is_owner` int(1) DEFAULT NULL COMMENT 'jika owner, tidak ada honor dokter'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_pegawai`
--

INSERT INTO `m_pegawai` (`id`, `id_jabatan`, `kode`, `nama`, `alamat`, `telp_1`, `telp_2`, `created_at`, `updated_at`, `deleted_at`, `is_aktif`, `is_owner`) VALUES
(1, 1, 'PEG-00001', 'Drg. Roy Tamara', 'Bulak Banteng 20-C', '1271872817', '712871872187', '2020-11-12 00:29:08', NULL, NULL, 1, 1),
(2, 1, 'PEG-00002', 'Drg. Ronald', 'Perum Sedati Tambak Blok Z-39', '1782781278', '17287182718', '2020-11-12 00:29:41', NULL, NULL, 0, NULL),
(3, 2, 'PEG-00003', 'Miss Tery', 'Jl. awauwiauwiauw', '19281928192812', '', '2021-12-12 20:41:58', NULL, NULL, 1, NULL),
(4, 2, 'PEG-00004', 'Miss Tar', 'asalskalsk', '10210210290129', '', '2021-12-16 23:40:36', NULL, NULL, 1, NULL),
(5, 3, 'PEG-00005', 'Suwanto Efendi', 'asasas', '121212', '12121', '2021-12-23 13:22:15', NULL, NULL, 1, NULL),
(6, 1, 'PEG-00006', 'Drg. Martin Andriastuti', 'Jl, akjskajskaj', '0781212812818', '', '2021-12-25 13:11:04', NULL, NULL, 1, NULL),
(7, 1, 'PEG-00007', 'Drg. Vita Sepfina', 'Jl. ini alamatnya', '08214235355', '', '2021-12-30 13:23:54', NULL, NULL, 1, NULL),
(8, 1, 'PEG-00008', 'Drg. Rauhansen Bosafine R', 'Jl. Ini alamatnya', '081232134244', '', '2021-12-30 13:36:44', NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_pemetaan`
--

DROP TABLE IF EXISTS `m_pemetaan`;
CREATE TABLE `m_pemetaan` (
  `id` int(10) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `umur_awal` int(10) DEFAULT NULL,
  `umur_akhir` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_pemetaan`
--

INSERT INTO `m_pemetaan` (`id`, `keterangan`, `umur_awal`, `umur_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Balita', 0, 5, '2020-11-19 14:34:28', NULL, NULL),
(2, 'Anak-Anak', 6, 10, '2020-11-19 14:34:48', NULL, NULL),
(3, 'Remaja', 11, 19, '2020-11-19 14:35:07', NULL, NULL),
(4, 'Dewasa', 20, 50, '2020-11-19 14:35:19', NULL, NULL),
(5, 'Lansia', 51, 200, '2020-11-19 14:35:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_pesan_blash`
--

DROP TABLE IF EXISTS `m_pesan_blash`;
CREATE TABLE `m_pesan_blash` (
  `id` int(11) NOT NULL,
  `pesan` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL COMMENT 'personal/broadcast',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_role`
--

DROP TABLE IF EXISTS `m_role`;
CREATE TABLE `m_role` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `keterangan` varchar(255) DEFAULT '',
  `aktif` int(1) DEFAULT 1,
  `is_all_klinik` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `m_role`
--

INSERT INTO `m_role` (`id`, `nama`, `keterangan`, `aktif`, `is_all_klinik`) VALUES
(1, 'developer', 'Level Developer Role', 1, 1),
(2, 'administrator', 'Level Administrator Role', 1, 1),
(3, 'Staff Admin Klinik', 'Role Untuk Staff Admin Klinik', 1, NULL),
(4, 'Dokter Klinik', 'Role Untuk Dokter Klinik', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_tindakan`
--

DROP TABLE IF EXISTS `m_tindakan`;
CREATE TABLE `m_tindakan` (
  `id_tindakan` int(32) NOT NULL,
  `kode_tindakan` varchar(255) DEFAULT NULL,
  `nama_tindakan` varchar(500) DEFAULT NULL,
  `harga` int(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `is_potong_lab_honor_dokter` int(1) DEFAULT NULL,
  `is_all_gigi` int(1) DEFAULT NULL,
  `disc_persen` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_tindakan`
--

INSERT INTO `m_tindakan` (`id_tindakan`, `kode_tindakan`, `nama_tindakan`, `harga`, `created_at`, `updated_at`, `deleted_at`, `is_potong_lab_honor_dokter`, `is_all_gigi`, `disc_persen`) VALUES
(1, 'T001', 'Operasi', 100000, NULL, '2021-12-14 21:41:21', NULL, NULL, NULL, 5),
(2, 'T002', 'Pasang Kawat', 50000, '2020-09-09 14:35:45', '2020-09-09 15:05:11', NULL, 1, 1, 0),
(3, 'T003', 'Pasang Gigi Palsu', 250000, '2020-11-11 10:51:21', '2020-11-11 10:51:35', NULL, 1, 1, 0),
(4, '1004', 'Scaling', 100000, '2021-11-20 12:23:46', '2021-12-14 21:39:35', NULL, NULL, 1, 20),
(5, 'T005', 'Tambal Gigi', 120000, '2021-12-14 21:42:03', NULL, NULL, NULL, NULL, 0),
(6, 'T006', 'Bleaching', 3000000, '2021-12-16 23:33:11', '2021-12-16 23:38:58', NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user` (
  `id` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `kode_user` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'user_default.png',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id`, `id_role`, `id_pegawai`, `kode_user`, `username`, `password`, `status`, `last_login`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'USR-00001', 'admin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-31 01:05:46', 'user_default.png', '2020-09-06 20:18:00', '2021-12-31 01:05:46', NULL),
(2, 4, 1, 'USR-00002', 'drg_roy', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-31 01:05:28', 'drg-roy-.jpeg', '2021-12-10 17:24:46', '2021-12-31 01:05:28', NULL),
(3, 3, 3, 'USR-00003', 'admin_pusat', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-31 00:54:46', 'admin-pusat-1639316581.jpg', '2021-12-12 20:43:01', '2021-12-31 00:54:46', NULL),
(4, 3, 4, 'USR-00004', 'admin_cabang', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-30 20:19:46', 'admin-cabang-1639883750.jpg', '2021-12-19 10:15:50', '2021-12-30 20:19:46', NULL),
(5, 4, 6, 'USR-00005', 'drg_martin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-31 00:54:02', 'drg-martin-.jpeg', '2021-12-25 13:12:00', '2021-12-31 00:54:02', NULL),
(6, 4, 7, 'USR-00006', 'drg_vita', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, NULL, 'drg-vita-1640845499.jpeg', '2021-12-30 13:24:59', NULL, NULL),
(7, 4, 8, 'USR-00007', 'drg_rauhansen', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, NULL, 'drg-rauhansen-1640846267.jpeg', '2021-12-30 13:37:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_diagnosa`
--

DROP TABLE IF EXISTS `t_diagnosa`;
CREATE TABLE `t_diagnosa` (
  `id` int(64) NOT NULL,
  `id_reg` int(64) DEFAULT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `id_user_adm` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `t_diagnosa_det`
--

DROP TABLE IF EXISTS `t_diagnosa_det`;
CREATE TABLE `t_diagnosa_det` (
  `id` int(64) NOT NULL,
  `id_t_diagnosa` int(64) DEFAULT NULL,
  `id_diagnosa` int(32) DEFAULT NULL,
  `gigi` int(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `t_diskon`
--

DROP TABLE IF EXISTS `t_diskon`;
CREATE TABLE `t_diskon` (
  `id` int(11) NOT NULL,
  `id_jenis_trans` int(11) DEFAULT NULL,
  `persentase` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_diskon`
--

INSERT INTO `t_diskon` (`id`, `id_jenis_trans`, `persentase`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 10, '2021-12-13 23:06:03', NULL, '2021-12-13 23:08:25'),
(2, 2, 15, '2021-12-13 23:08:25', NULL, '2021-12-13 23:08:59'),
(3, 2, 10, '2021-12-13 23:08:59', NULL, '2021-12-13 23:09:55'),
(4, 2, 15, '2021-12-13 23:09:55', NULL, '2021-12-13 23:11:09'),
(5, 2, 15, '2021-12-13 23:12:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_honor`
--

DROP TABLE IF EXISTS `t_honor`;
CREATE TABLE `t_honor` (
  `id` int(64) NOT NULL,
  `id_dokter` int(64) DEFAULT NULL,
  `honor_visite` double(20,2) DEFAULT NULL,
  `tindakan_persen` int(3) DEFAULT 0,
  `tindakan_lab_persen` int(3) DEFAULT 0,
  `obat_persen` int(3) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `tindakan_persen_global` int(3) DEFAULT 0,
  `tindakan_lab_global` int(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_honor`
--

INSERT INTO `t_honor` (`id`, `id_dokter`, `honor_visite`, `tindakan_persen`, `tindakan_lab_persen`, `obat_persen`, `created_at`, `updated_at`, `deleted_at`, `tindakan_persen_global`, `tindakan_lab_global`) VALUES
(1, 1, 0.00, 40, 0, 0, '2021-12-04 14:38:28', NULL, NULL, 0, 0),
(2, 6, 0.00, 40, 0, 0, '2021-12-25 13:11:04', NULL, NULL, 0, 0),
(3, 7, 0.00, 40, 0, 0, '2021-12-30 13:23:54', NULL, NULL, 0, 0),
(4, 8, 0.00, 40, 0, 0, '2021-12-30 13:36:44', NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_honor_dokter_lab`
--

DROP TABLE IF EXISTS `t_honor_dokter_lab`;
CREATE TABLE `t_honor_dokter_lab` (
  `id` int(64) NOT NULL,
  `id_dokter` int(64) DEFAULT NULL,
  `id_lab` int(64) DEFAULT NULL,
  `persentase` int(3) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `t_honor_dokter_tindakan`
--

DROP TABLE IF EXISTS `t_honor_dokter_tindakan`;
CREATE TABLE `t_honor_dokter_tindakan` (
  `id` int(64) NOT NULL,
  `id_dokter` int(64) DEFAULT NULL,
  `id_tindakan` int(64) DEFAULT NULL,
  `persentase` int(3) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `t_honor_old`
--

DROP TABLE IF EXISTS `t_honor_old`;
CREATE TABLE `t_honor_old` (
  `id` int(64) NOT NULL,
  `id_dokter` int(64) DEFAULT NULL,
  `honor_visite` double(20,2) DEFAULT NULL,
  `tindakan_persen` int(3) DEFAULT 0,
  `tindakan_lab_persen` int(3) DEFAULT 0,
  `obat_persen` int(3) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_honor_old`
--

INSERT INTO `t_honor_old` (`id`, `id_dokter`, `honor_visite`, `tindakan_persen`, `tindakan_lab_persen`, `obat_persen`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 50000.00, 20, 40, 20, '2021-12-04 14:38:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_jadwal_dokter_rutin`
--

DROP TABLE IF EXISTS `t_jadwal_dokter_rutin`;
CREATE TABLE `t_jadwal_dokter_rutin` (
  `id` int(32) NOT NULL,
  `id_dokter` int(32) DEFAULT NULL,
  `id_klinik` int(32) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `hari` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_jadwal_dokter_rutin`
--

INSERT INTO `t_jadwal_dokter_rutin` (`id`, `id_dokter`, `id_klinik`, `jam_mulai`, `jam_akhir`, `created_at`, `updated_at`, `deleted_at`, `hari`) VALUES
(1, 1, 3, '07:00:00', '15:00:00', '2021-12-26 20:17:33', NULL, '2021-12-30 20:13:05', 'senin'),
(2, 2, 3, '07:00:00', '14:00:00', '2021-12-26 20:19:26', NULL, '2021-12-30 20:13:09', 'selasa'),
(3, 1, 3, '08:00:00', '12:00:00', '2021-12-26 20:20:08', NULL, '2021-12-30 20:13:11', 'rabu'),
(4, 1, 3, '09:00:00', '14:00:00', '2021-12-26 20:20:40', NULL, '2021-12-30 20:13:14', 'kamis'),
(5, 2, 3, '07:00:00', '12:00:00', '2021-12-26 20:21:08', NULL, '2021-12-30 20:13:16', 'jumat'),
(6, 1, 3, '08:00:00', '14:00:00', '2021-12-26 20:21:40', NULL, '2021-12-30 20:13:19', 'sabtu'),
(7, 2, 3, '09:00:00', '16:00:00', '2021-12-26 20:22:10', NULL, '2021-12-30 20:13:22', 'minggu'),
(8, 2, 3, '07:00:00', '14:00:00', '2021-12-26 20:22:44', NULL, '2021-12-30 20:13:24', 'rabu'),
(9, 1, 4, '15:00:00', '21:00:00', '2021-12-30 20:11:05', NULL, '2021-12-30 20:12:28', 'selasa'),
(10, 1, 4, '15:00:00', '21:00:00', '2021-12-30 20:11:55', NULL, '2021-12-30 20:12:31', 'kamis'),
(11, 1, 3, '15:00:00', '21:00:00', '2021-12-30 20:13:39', NULL, '2021-12-30 20:15:02', 'senin'),
(12, 1, 3, '15:00:00', '21:00:00', '2021-12-30 20:13:57', NULL, NULL, 'kamis'),
(13, 6, 3, '15:00:00', '19:00:00', '2021-12-30 20:14:34', NULL, NULL, 'jumat'),
(14, 1, 3, '15:00:00', '21:00:00', '2021-12-30 20:15:24', NULL, NULL, 'selasa'),
(15, 1, 3, '15:00:00', '21:00:00', '2021-12-30 20:15:24', NULL, '2021-12-30 20:15:37', 'selasa'),
(16, 7, 3, '15:00:00', '19:00:00', '2021-12-30 20:16:13', NULL, NULL, 'senin'),
(17, 7, 3, '14:00:00', '17:00:00', '2021-12-30 20:16:45', NULL, NULL, 'sabtu'),
(18, 8, 3, '15:00:00', '19:00:00', '2021-12-30 20:17:20', NULL, NULL, 'rabu'),
(19, 8, 4, '15:00:00', '21:00:00', '2021-12-30 20:20:16', NULL, NULL, 'senin'),
(20, 7, 4, '15:00:00', '21:00:00', '2021-12-30 20:21:00', NULL, NULL, 'rabu'),
(21, 6, 4, '15:00:00', '21:00:00', '2021-12-30 20:22:21', NULL, NULL, 'selasa'),
(22, 6, 4, '15:00:00', '21:00:00', '2021-12-30 20:23:04', NULL, NULL, 'kamis'),
(23, 6, 4, '15:00:00', '21:00:00', '2021-12-30 20:23:24', NULL, NULL, 'sabtu'),
(24, 1, 4, '14:00:00', '21:00:00', '2021-12-30 20:23:46', NULL, NULL, 'jumat');

-- --------------------------------------------------------

--
-- Table structure for table `t_jadwal_dokter_tidak_rutin`
--

DROP TABLE IF EXISTS `t_jadwal_dokter_tidak_rutin`;
CREATE TABLE `t_jadwal_dokter_tidak_rutin` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_klinik` int(11) DEFAULT NULL,
  `id_dokter` int(11) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `is_libur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_jadwal_dokter_tidak_rutin`
--

INSERT INTO `t_jadwal_dokter_tidak_rutin` (`id`, `tanggal`, `id_klinik`, `id_dokter`, `jam_mulai`, `jam_akhir`, `created_at`, `updated_at`, `deleted_at`, `is_libur`) VALUES
(1, '2021-12-27', 3, 1, '08:00:00', '15:00:00', '2021-12-26 20:26:41', NULL, NULL, NULL),
(2, '2021-12-30', 3, 1, '07:00:00', '14:00:00', '2021-12-26 20:27:09', NULL, NULL, 1),
(3, '2022-01-06', 3, 1, '07:00:00', '14:00:00', '2021-12-26 20:27:09', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_kamera`
--

DROP TABLE IF EXISTS `t_kamera`;
CREATE TABLE `t_kamera` (
  `id` int(64) NOT NULL,
  `id_reg` int(64) DEFAULT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `id_user_adm` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_kamera`
--

INSERT INTO `t_kamera` (`id`, `id_reg`, `id_pasien`, `id_pegawai`, `id_user_adm`, `tanggal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 8, 6, 5, '2021-12-31', '2021-12-31 01:00:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_kamera_det`
--

DROP TABLE IF EXISTS `t_kamera_det`;
CREATE TABLE `t_kamera_det` (
  `id` int(64) NOT NULL,
  `id_t_kamera` int(64) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `nama_gambar` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_kamera_det`
--

INSERT INTO `t_kamera_det` (`id`, `id_t_kamera`, `keterangan`, `nama_gambar`, `created_at`, `updated_at`, `delete_at`) VALUES
(1, 1, '', '4_192128900.png', '2021-12-31 01:00:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_logistik`
--

DROP TABLE IF EXISTS `t_logistik`;
CREATE TABLE `t_logistik` (
  `id` int(64) NOT NULL,
  `id_reg` int(64) DEFAULT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `id_user_adm` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan_resep` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_logistik`
--

INSERT INTO `t_logistik` (`id`, `id_reg`, `id_pasien`, `id_pegawai`, `id_user_adm`, `tanggal`, `keterangan_resep`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 8, 6, 5, '2021-12-31', 'beli sendiri ya di warung', '2021-12-31 00:56:49', '2021-12-31 00:57:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_logistik_det`
--

DROP TABLE IF EXISTS `t_logistik_det`;
CREATE TABLE `t_logistik_det` (
  `id` int(64) NOT NULL,
  `id_t_logistik` int(64) DEFAULT NULL,
  `id_logistik` int(32) DEFAULT NULL,
  `qty` int(32) DEFAULT NULL,
  `harga` float(20,2) DEFAULT NULL,
  `subtotal` float(20,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_logistik_det`
--

INSERT INTO `t_logistik_det` (`id`, `id_t_logistik`, `id_logistik`, `qty`, `harga`, `subtotal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 4, 4, 0.00, 0.00, '2021-12-31 00:56:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_log_jadwal_dokter`
--

DROP TABLE IF EXISTS `t_log_jadwal_dokter`;
CREATE TABLE `t_log_jadwal_dokter` (
  `id` int(11) NOT NULL,
  `id_dokter` int(32) DEFAULT NULL,
  `id_klinik` int(32) DEFAULT NULL,
  `color` varchar(24) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` varchar(64) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(64) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `t_mutasi`
--

DROP TABLE IF EXISTS `t_mutasi`;
CREATE TABLE `t_mutasi` (
  `id` int(64) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_registrasi` int(64) DEFAULT NULL,
  `id_jenis_trans` int(2) DEFAULT NULL COMMENT 'id m_jenis_trans',
  `id_trans_flag` int(64) DEFAULT NULL COMMENT 'id transaksi pada tabel transaksi di jenis transaksi terkait',
  `id_user` int(11) DEFAULT NULL,
  `flag_transaksi` int(1) DEFAULT NULL COMMENT '1: penerimaan, 2: pengeluaran',
  `total_honor_dokter` float(20,2) DEFAULT 0.00 COMMENT 'honor dokter',
  `total_penerimaan_gross` float(20,2) DEFAULT 0.00 COMMENT 'penerimaan keseluruhan (belum dikurangi honor dokter)',
  `total_penerimaan_nett` float(20,2) DEFAULT 0.00 COMMENT 'penerimaan klinik',
  `total_pengeluaran` float(20,2) DEFAULT 0.00 COMMENT 'pengeluaran, jika flag transaksi = 2',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_mutasi`
--

INSERT INTO `t_mutasi` (`id`, `tanggal`, `id_registrasi`, `id_jenis_trans`, `id_trans_flag`, `id_user`, `flag_transaksi`, `total_honor_dokter`, `total_penerimaan_gross`, `total_penerimaan_nett`, `total_pengeluaran`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2021-12-31', 4, 2, 1, 5, 1, 0.00, 330000.00, 330000.00, 0.00, '2021-12-31 00:56:28', '2021-12-31 00:56:34', NULL),
(2, '2021-12-31', 1, 2, 2, 5, 1, 0.00, 120000.00, 120000.00, 0.00, '2021-12-31 01:01:06', NULL, NULL),
(3, '2021-12-31', 4, 5, 1, 3, 2, 0.00, 0.00, 0.00, 0.00, '2021-12-31 01:02:24', NULL, NULL),
(4, '2021-12-31', 4, 6, 1, 3, 2, 0.00, 0.00, 0.00, 400000.00, '2021-12-31 01:02:24', NULL, NULL),
(5, '2021-12-31', 1, 5, 2, 3, 2, 0.00, 0.00, 0.00, 0.00, '2021-12-31 01:03:01', NULL, NULL),
(6, '2021-12-31', 1, 6, 2, 3, 2, 0.00, 0.00, 0.00, 320000.00, '2021-12-31 01:03:01', NULL, NULL),
(7, '2021-12-31', 5, 2, 3, 2, 1, 0.00, 3250000.00, 3250000.00, 0.00, '2021-12-31 01:04:11', '2021-12-31 01:04:16', NULL),
(8, '2021-12-31', 2, 2, 4, 2, 1, 0.00, 300000.00, 300000.00, 0.00, '2021-12-31 01:04:39', '2021-12-31 01:04:49', NULL),
(9, '2021-12-31', 2, 3, 1, 2, 1, 0.00, 450000.00, 450000.00, 0.00, '2021-12-31 01:04:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_mutasi_det`
--

DROP TABLE IF EXISTS `t_mutasi_det`;
CREATE TABLE `t_mutasi_det` (
  `id` int(64) NOT NULL,
  `id_mutasi` int(64) DEFAULT NULL,
  `id_trans_det_flag` varchar(255) DEFAULT NULL COMMENT 'id transaksi pada tabel transaksi detail di transaksi terkait',
  `qty` int(32) DEFAULT NULL,
  `harga` double(20,2) DEFAULT NULL,
  `subtotal` double(20,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_mutasi_det`
--

INSERT INTO `t_mutasi_det` (`id`, `id_mutasi`, `id_trans_det_flag`, `qty`, `harga`, `subtotal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '1', NULL, 250000.00, 250000.00, '2021-12-31 00:56:28', NULL, NULL),
(2, 1, '2', NULL, 80000.00, 80000.00, '2021-12-31 00:56:34', NULL, NULL),
(3, 2, '3', NULL, 120000.00, 120000.00, '2021-12-31 01:01:06', NULL, NULL),
(4, 7, '4', NULL, 250000.00, 250000.00, '2021-12-31 01:04:11', NULL, NULL),
(5, 7, '5', NULL, 3000000.00, 3000000.00, '2021-12-31 01:04:16', NULL, NULL),
(6, 8, '6', NULL, 50000.00, 50000.00, '2021-12-31 01:04:39', NULL, NULL),
(7, 8, '7', NULL, 50000.00, 50000.00, '2021-12-31 01:04:39', NULL, '2021-12-31 01:04:44'),
(8, 8, '8', NULL, 250000.00, 250000.00, '2021-12-31 01:04:49', NULL, NULL),
(9, 9, '1', NULL, 450000.00, 450000.00, '2021-12-31 01:04:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_odontogram`
--

DROP TABLE IF EXISTS `t_odontogram`;
CREATE TABLE `t_odontogram` (
  `id_reg` int(34) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `id` int(34) NOT NULL,
  `sebelas` varchar(255) DEFAULT NULL,
  `dua_belas` varchar(255) DEFAULT NULL,
  `tiga_belas` varchar(255) DEFAULT NULL,
  `empat_belas` varchar(255) DEFAULT NULL,
  `lima_belas` varchar(255) DEFAULT NULL,
  `enam_belas` varchar(255) DEFAULT NULL,
  `tujuh_belas` varchar(255) DEFAULT NULL,
  `delapan_belas` varchar(255) DEFAULT NULL,
  `dua_satu` varchar(255) DEFAULT NULL,
  `dua_dua` varchar(255) DEFAULT NULL,
  `dua_tiga` varchar(255) DEFAULT NULL,
  `dua_empat` varchar(255) DEFAULT NULL,
  `dua_lima` varchar(255) DEFAULT NULL,
  `dua_enam` varchar(255) DEFAULT NULL,
  `dua_tujuh` varchar(255) DEFAULT NULL,
  `dua_delapan` varchar(255) DEFAULT NULL,
  `tiga_satu` varchar(255) DEFAULT NULL,
  `tiga_dua` varchar(255) DEFAULT NULL,
  `tiga_tiga` varchar(255) DEFAULT NULL,
  `tiga_empat` varchar(255) DEFAULT NULL,
  `tiga_lima` varchar(255) DEFAULT NULL,
  `tiga_enam` varchar(255) DEFAULT NULL,
  `tiga_tujuh` varchar(255) DEFAULT NULL,
  `tiga_delapan` varchar(255) DEFAULT NULL,
  `empat_satu` varchar(255) DEFAULT NULL,
  `empat_dua` varchar(255) DEFAULT NULL,
  `empat_tiga` varchar(255) DEFAULT NULL,
  `empat_empat` varchar(255) DEFAULT NULL,
  `empat_lima` varchar(255) DEFAULT NULL,
  `empat_enam` varchar(255) DEFAULT NULL,
  `empat_tujuh` varchar(255) DEFAULT NULL,
  `empat_delapan` varchar(255) DEFAULT NULL,
  `occlusi` varchar(255) DEFAULT NULL,
  `torus_palatinus` varchar(255) DEFAULT NULL,
  `torus_mandibularis` varchar(255) DEFAULT NULL,
  `palatum` varchar(255) DEFAULT NULL,
  `diastema` varchar(255) DEFAULT NULL,
  `keterangan_diastema` varchar(255) DEFAULT NULL,
  `gigi_anomali` varchar(255) DEFAULT NULL,
  `keterangan_gigi_anomali` varchar(255) DEFAULT NULL,
  `d` varchar(10) DEFAULT NULL,
  `m` varchar(10) DEFAULT NULL,
  `f` varchar(255) DEFAULT NULL,
  `jumlah_foto` varchar(30) DEFAULT NULL,
  `jumlah_rontgen` varchar(30) DEFAULT NULL,
  `lain_lain` varchar(300) DEFAULT NULL,
  `satuan_jumlah_foto` varchar(50) DEFAULT NULL,
  `satuan_jumlah_rontgen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_odontogram`
--

INSERT INTO `t_odontogram` (`id_reg`, `gambar`, `id`, `sebelas`, `dua_belas`, `tiga_belas`, `empat_belas`, `lima_belas`, `enam_belas`, `tujuh_belas`, `delapan_belas`, `dua_satu`, `dua_dua`, `dua_tiga`, `dua_empat`, `dua_lima`, `dua_enam`, `dua_tujuh`, `dua_delapan`, `tiga_satu`, `tiga_dua`, `tiga_tiga`, `tiga_empat`, `tiga_lima`, `tiga_enam`, `tiga_tujuh`, `tiga_delapan`, `empat_satu`, `empat_dua`, `empat_tiga`, `empat_empat`, `empat_lima`, `empat_enam`, `empat_tujuh`, `empat_delapan`, `occlusi`, `torus_palatinus`, `torus_mandibularis`, `palatum`, `diastema`, `keterangan_diastema`, `gigi_anomali`, `keterangan_gigi_anomali`, `d`, `m`, `f`, `jumlah_foto`, `jumlah_rontgen`, `lain_lain`, `satuan_jumlah_foto`, `satuan_jumlah_rontgen`) VALUES
(4, '4.png', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_pembayaran`
--

DROP TABLE IF EXISTS `t_pembayaran`;
CREATE TABLE `t_pembayaran` (
  `id` int(11) NOT NULL,
  `id_reg` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `disc_persen` float DEFAULT NULL,
  `disc_rp` float(20,2) DEFAULT NULL,
  `disc_nilai` float(20,2) DEFAULT NULL,
  `total_bruto` float(20,2) DEFAULT NULL,
  `total_nett` float(20,2) DEFAULT NULL,
  `is_cash` int(1) DEFAULT NULL COMMENT '1: tunai',
  `reff_trans_kredit` varchar(255) DEFAULT NULL COMMENT 'kode refferensi jika transaksi non tunai (debit, transfer, etc)',
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `rupiah_bayar` varchar(20) DEFAULT NULL,
  `rupiah_kembali` float(20,2) DEFAULT NULL,
  `is_locked` int(1) DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_pembayaran`
--

INSERT INTO `t_pembayaran` (`id`, `id_reg`, `tanggal`, `id_user`, `disc_persen`, `disc_rp`, `disc_nilai`, `total_bruto`, `total_nett`, `is_cash`, `reff_trans_kredit`, `updated_at`, `deleted_at`, `created_at`, `rupiah_bayar`, `rupiah_kembali`, `is_locked`, `kode`) VALUES
(1, 4, '2021-12-31', 3, 0, 0.00, 0.00, 330000.00, 330000.00, 1, NULL, NULL, NULL, '2021-12-31 01:02:24', '330000.00', 0.00, 1, 'INV-202112-0001'),
(2, 1, '2021-12-31', 3, 0, 0.00, 0.00, 120000.00, 120000.00, NULL, '1', NULL, NULL, '2021-12-31 01:03:01', '120000.00', 0.00, 1, 'INV-202112-0002');

-- --------------------------------------------------------

--
-- Table structure for table `t_perawatan`
--

DROP TABLE IF EXISTS `t_perawatan`;
CREATE TABLE `t_perawatan` (
  `id` int(64) NOT NULL,
  `id_reg` int(64) DEFAULT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `anamnesa` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_perawatan`
--

INSERT INTO `t_perawatan` (`id`, `id_reg`, `id_pasien`, `id_pegawai`, `tanggal`, `anamnesa`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 8, 6, '2021-12-31', '<p>1. oke</p>\n', '2021-12-31 00:56:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_registrasi`
--

DROP TABLE IF EXISTS `t_registrasi`;
CREATE TABLE `t_registrasi` (
  `id` int(64) NOT NULL,
  `id_klinik` int(11) DEFAULT NULL,
  `id_layanan` int(11) NOT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `no_reg` varchar(255) DEFAULT NULL,
  `tanggal_reg` date DEFAULT NULL,
  `jam_reg` time DEFAULT NULL,
  `estimasi_selesai` time DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `is_asuransi` varchar(255) DEFAULT NULL COMMENT '1: Asuransi, null = umum',
  `umur` varchar(255) DEFAULT NULL,
  `id_pemetaan` int(11) DEFAULT NULL,
  `nama_asuransi` varchar(255) DEFAULT NULL,
  `no_asuransi` varchar(255) DEFAULT NULL,
  `is_pulang` int(1) DEFAULT NULL COMMENT '1: Pulang, null = Masih DIrawat',
  `tanggal_pulang` date DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_registrasi`
--

INSERT INTO `t_registrasi` (`id`, `id_klinik`, `id_layanan`, `id_pasien`, `no_reg`, `tanggal_reg`, `jam_reg`, `estimasi_selesai`, `id_pegawai`, `is_asuransi`, `umur`, `id_pemetaan`, `nama_asuransi`, `no_asuransi`, `is_pulang`, `tanggal_pulang`, `jam_pulang`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 3, 6, '000.000.000.001', '2021-12-31', '16:00:00', '16:30:00', 6, NULL, NULL, NULL, NULL, NULL, 1, '2021-12-31', '01:01:11', '2021-12-30 23:52:53', '2021-12-31 01:01:11', NULL),
(2, 4, 5, 7, '000.000.000.002', '2021-12-31', '14:00:00', '15:00:00', 1, NULL, NULL, NULL, NULL, NULL, 1, '2021-12-31', '01:05:01', '2021-12-31 00:15:33', '2021-12-31 01:05:01', NULL),
(3, 3, 4, 2, '000.000.000.003', '2022-01-01', '09:00:00', '09:30:00', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-31 00:48:32', NULL, NULL),
(4, 3, 1, 8, '000.000.000.004', '2021-12-31', '17:00:00', '18:00:00', 6, NULL, NULL, NULL, NULL, NULL, 1, '2021-12-31', '01:00:28', '2021-12-31 00:49:31', '2021-12-31 01:00:28', NULL),
(5, 4, 1, 9, '000.000.000.005', '2021-12-31', '15:00:00', '16:00:00', 1, NULL, NULL, NULL, NULL, NULL, 1, '2021-12-31', '01:04:21', '2021-12-31 00:51:23', '2021-12-31 01:04:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_registrasi_old`
--

DROP TABLE IF EXISTS `t_registrasi_old`;
CREATE TABLE `t_registrasi_old` (
  `id` int(64) NOT NULL,
  `id_klinik` int(11) DEFAULT NULL,
  `id_pasien` varchar(255) DEFAULT NULL,
  `no_reg` varchar(255) DEFAULT NULL,
  `tanggal_reg` date DEFAULT NULL,
  `jam_reg` time DEFAULT NULL,
  `id_pegawai` varchar(255) DEFAULT NULL,
  `is_asuransi` varchar(255) DEFAULT NULL COMMENT '1: Asuransi, null = umum',
  `umur` varchar(255) DEFAULT NULL,
  `id_pemetaan` varchar(255) DEFAULT NULL,
  `id_asuransi` varchar(255) DEFAULT NULL,
  `no_asuransi` varchar(255) DEFAULT NULL,
  `is_pulang` int(1) DEFAULT NULL COMMENT '1: Pulang, null = Masih DIrawat',
  `tanggal_pulang` date DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `t_role_menu`
--

DROP TABLE IF EXISTS `t_role_menu`;
CREATE TABLE `t_role_menu` (
  `id_menu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `add_button` int(1) DEFAULT 0,
  `edit_button` int(1) DEFAULT 0,
  `delete_button` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_role_menu`
--

INSERT INTO `t_role_menu` (`id_menu`, `id_role`, `add_button`, `edit_button`, `delete_button`) VALUES
(1, 2, 0, 0, 0),
(17, 2, 0, 0, 0),
(18, 2, 1, 1, 1),
(19, 2, 1, 1, 1),
(1, 3, 0, 0, 0),
(6, 3, 0, 0, 0),
(9, 3, 0, 0, 0),
(13, 3, 1, 1, 1),
(14, 3, 1, 1, 1),
(24, 3, 1, 1, 1),
(25, 3, 1, 1, 1),
(17, 3, 0, 0, 0),
(18, 3, 1, 1, 1),
(19, 3, 1, 1, 1),
(35, 3, 1, 1, 1),
(28, 3, 0, 0, 0),
(29, 3, 1, 1, 1),
(31, 3, 0, 0, 0),
(37, 3, 0, 0, 0),
(34, 3, 0, 0, 0),
(1, 1, 0, 0, 0),
(6, 1, 0, 0, 0),
(11, 1, 0, 0, 0),
(12, 1, 1, 1, 1),
(9, 1, 0, 0, 0),
(13, 1, 1, 1, 1),
(14, 1, 1, 1, 1),
(24, 1, 1, 1, 1),
(25, 1, 1, 1, 1),
(26, 1, 1, 1, 1),
(39, 1, 1, 1, 1),
(41, 1, 1, 1, 1),
(10, 1, 0, 0, 0),
(7, 1, 1, 1, 1),
(8, 1, 1, 1, 1),
(15, 1, 1, 1, 1),
(16, 1, 1, 1, 1),
(27, 1, 1, 1, 1),
(17, 1, 0, 0, 0),
(18, 1, 1, 1, 1),
(19, 1, 1, 1, 1),
(31, 1, 0, 0, 0),
(37, 1, 0, 0, 0),
(34, 1, 1, 1, 1),
(36, 1, 1, 1, 1),
(38, 1, 0, 0, 0),
(32, 1, 1, 1, 1),
(33, 1, 1, 1, 1),
(2, 1, 0, 0, 0),
(4, 1, 1, 1, 1),
(3, 1, 1, 1, 1),
(40, 1, 1, 1, 1),
(1, 4, 0, 0, 0),
(20, 4, 0, 0, 0),
(21, 4, 1, 1, 1),
(31, 4, 0, 0, 0),
(37, 4, 0, 0, 0),
(36, 4, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_spam`
--

DROP TABLE IF EXISTS `t_spam`;
CREATE TABLE `t_spam` (
  `id_t_spam` bigint(20) NOT NULL,
  `id_layanan` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `status` char(1) DEFAULT NULL COMMENT '0=proses, 1=selesai',
  `id_pasien` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `t_tindakan`
--

DROP TABLE IF EXISTS `t_tindakan`;
CREATE TABLE `t_tindakan` (
  `id` int(64) NOT NULL,
  `id_reg` int(64) DEFAULT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `id_user_adm` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_tindakan`
--

INSERT INTO `t_tindakan` (`id`, `id_reg`, `id_pasien`, `id_pegawai`, `id_user_adm`, `tanggal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 8, 6, 5, '2021-12-31', '2021-12-31 00:56:28', NULL, NULL),
(2, 1, 6, 6, 5, '2021-12-31', '2021-12-31 01:01:06', NULL, NULL),
(3, 5, 9, 1, 2, '2021-12-31', '2021-12-31 01:04:11', NULL, NULL),
(4, 2, 7, 1, 2, '2021-12-31', '2021-12-31 01:04:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_tindakanlab`
--

DROP TABLE IF EXISTS `t_tindakanlab`;
CREATE TABLE `t_tindakanlab` (
  `id` int(64) NOT NULL,
  `id_reg` int(64) DEFAULT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `id_user_adm` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_tindakanlab`
--

INSERT INTO `t_tindakanlab` (`id`, `id_reg`, `id_pasien`, `id_pegawai`, `id_user_adm`, `tanggal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 7, 1, 2, '2021-12-31', '2021-12-31 01:04:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_tindakanlab_det`
--

DROP TABLE IF EXISTS `t_tindakanlab_det`;
CREATE TABLE `t_tindakanlab_det` (
  `id` int(64) NOT NULL,
  `id_t_tindakanlab` int(64) DEFAULT NULL,
  `id_tindakan_lab` int(32) DEFAULT NULL,
  `harga` float(20,2) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `diskon_persen` int(11) DEFAULT NULL,
  `diskon_nilai` float(20,2) DEFAULT NULL,
  `harga_bruto` float(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_tindakanlab_det`
--

INSERT INTO `t_tindakanlab_det` (`id`, `id_t_tindakanlab`, `id_tindakan_lab`, `harga`, `keterangan`, `created_at`, `updated_at`, `deleted_at`, `diskon_persen`, `diskon_nilai`, `harga_bruto`) VALUES
(1, 1, 1, 450000.00, '', '2021-12-31 01:04:56', NULL, NULL, 10, 50000.00, 500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t_tindakan_det`
--

DROP TABLE IF EXISTS `t_tindakan_det`;
CREATE TABLE `t_tindakan_det` (
  `id` int(64) NOT NULL,
  `id_t_tindakan` int(64) DEFAULT NULL,
  `id_tindakan` int(32) DEFAULT NULL,
  `gigi` varchar(255) DEFAULT NULL,
  `harga` float(20,2) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `diskon_persen` int(11) DEFAULT NULL,
  `diskon_nilai` float(20,2) DEFAULT NULL,
  `harga_bruto` float(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_tindakan_det`
--

INSERT INTO `t_tindakan_det` (`id`, `id_t_tindakan`, `id_tindakan`, `gigi`, `harga`, `keterangan`, `created_at`, `updated_at`, `deleted_at`, `diskon_persen`, `diskon_nilai`, `harga_bruto`) VALUES
(1, 1, 3, 'all', 250000.00, 'bahan plastik', '2021-12-31 00:56:28', NULL, NULL, 0, 0.00, 250000.00),
(2, 1, 4, 'all', 80000.00, '', '2021-12-31 00:56:34', NULL, NULL, 20, 20000.00, 100000.00),
(3, 2, 5, '3', 120000.00, '', '2021-12-31 01:01:06', NULL, NULL, 0, 0.00, 120000.00),
(4, 3, 3, 'all', 250000.00, '', '2021-12-31 01:04:11', NULL, NULL, 0, 0.00, 250000.00),
(5, 3, 6, 'all', 3000000.00, '', '2021-12-31 01:04:16', NULL, NULL, 0, 0.00, 3000000.00),
(6, 4, 2, 'all', 50000.00, '', '2021-12-31 01:04:39', NULL, NULL, 0, 0.00, 50000.00),
(7, 4, 2, 'all', 50000.00, '', '2021-12-31 01:04:39', NULL, '2021-12-31 01:04:44', 0, 0.00, 50000.00),
(8, 4, 3, 'all', 250000.00, '', '2021-12-31 01:04:49', NULL, NULL, 0, 0.00, 250000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t_user_klinik`
--

DROP TABLE IF EXISTS `t_user_klinik`;
CREATE TABLE `t_user_klinik` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_klinik` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_user_klinik`
--

INSERT INTO `t_user_klinik` (`id`, `id_user`, `id_klinik`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 2, 4, '2021-12-11 09:49:31', NULL, NULL),
(4, 2, 3, '2021-12-11 09:49:31', NULL, NULL),
(5, 3, 3, '2021-12-12 20:43:12', NULL, NULL),
(7, 4, 4, '2021-12-19 10:15:58', NULL, NULL),
(8, 6, 4, '2021-12-30 13:37:54', NULL, NULL),
(9, 6, 3, '2021-12-30 13:37:54', NULL, NULL),
(10, 7, 4, '2021-12-30 13:38:00', NULL, NULL),
(11, 7, 3, '2021-12-30 13:38:00', NULL, NULL),
(12, 5, 4, '2021-12-30 13:38:10', NULL, NULL),
(13, 5, 3, '2021-12-30 13:38:10', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_asuransi`
--
ALTER TABLE `m_asuransi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `m_bank_kredit`
--
ALTER TABLE `m_bank_kredit`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `m_data_medik`
--
ALTER TABLE `m_data_medik`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `m_diagnosa`
--
ALTER TABLE `m_diagnosa`
  ADD PRIMARY KEY (`id_diagnosa`) USING BTREE;

--
-- Indexes for table `m_jabatan`
--
ALTER TABLE `m_jabatan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `m_jenis_logistik`
--
ALTER TABLE `m_jenis_logistik`
  ADD PRIMARY KEY (`id_jenis_logistik`) USING BTREE;

--
-- Indexes for table `m_jenis_trans`
--
ALTER TABLE `m_jenis_trans`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `m_klinik`
--
ALTER TABLE `m_klinik`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `m_laboratorium`
--
ALTER TABLE `m_laboratorium`
  ADD PRIMARY KEY (`id_laboratorium`) USING BTREE;

--
-- Indexes for table `m_layanan`
--
ALTER TABLE `m_layanan`
  ADD PRIMARY KEY (`id_layanan`) USING BTREE;

--
-- Indexes for table `m_logistik`
--
ALTER TABLE `m_logistik`
  ADD PRIMARY KEY (`id_logistik`) USING BTREE,
  ADD KEY `id_jenis_logistik` (`id_jenis_logistik`);

--
-- Indexes for table `m_menu`
--
ALTER TABLE `m_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `m_nontunai`
--
ALTER TABLE `m_nontunai`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `m_pasien`
--
ALTER TABLE `m_pasien`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `m_pegawai`
--
ALTER TABLE `m_pegawai`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `m_pemetaan`
--
ALTER TABLE `m_pemetaan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `m_pesan_blash`
--
ALTER TABLE `m_pesan_blash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_role`
--
ALTER TABLE `m_role`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `m_tindakan`
--
ALTER TABLE `m_tindakan`
  ADD PRIMARY KEY (`id_tindakan`) USING BTREE;

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `t_diagnosa`
--
ALTER TABLE `t_diagnosa`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_reg` (`id_reg`),
  ADD KEY `id_user_adm` (`id_user_adm`);

--
-- Indexes for table `t_diagnosa_det`
--
ALTER TABLE `t_diagnosa_det`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_diagnosa` (`id_diagnosa`),
  ADD KEY `id_t_diagnosa` (`id_t_diagnosa`);

--
-- Indexes for table `t_diskon`
--
ALTER TABLE `t_diskon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_honor`
--
ALTER TABLE `t_honor`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `t_honor_dokter_lab`
--
ALTER TABLE `t_honor_dokter_lab`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `t_honor_dokter_tindakan`
--
ALTER TABLE `t_honor_dokter_tindakan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `t_honor_old`
--
ALTER TABLE `t_honor_old`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `t_jadwal_dokter_rutin`
--
ALTER TABLE `t_jadwal_dokter_rutin`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_klinik` (`id_klinik`);

--
-- Indexes for table `t_jadwal_dokter_tidak_rutin`
--
ALTER TABLE `t_jadwal_dokter_tidak_rutin`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_klinik` (`id_klinik`);

--
-- Indexes for table `t_kamera`
--
ALTER TABLE `t_kamera`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_reg` (`id_reg`),
  ADD KEY `id_user_adm` (`id_user_adm`);

--
-- Indexes for table `t_kamera_det`
--
ALTER TABLE `t_kamera_det`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_t_kamera` (`id_t_kamera`);

--
-- Indexes for table `t_logistik`
--
ALTER TABLE `t_logistik`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_reg` (`id_reg`),
  ADD KEY `id_user_adm` (`id_user_adm`);

--
-- Indexes for table `t_logistik_det`
--
ALTER TABLE `t_logistik_det`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_logistik` (`id_logistik`),
  ADD KEY `id_t_logistik` (`id_t_logistik`);

--
-- Indexes for table `t_log_jadwal_dokter`
--
ALTER TABLE `t_log_jadwal_dokter`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_klinik` (`id_klinik`);

--
-- Indexes for table `t_mutasi`
--
ALTER TABLE `t_mutasi`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_jenis_trans` (`id_jenis_trans`),
  ADD KEY `id_registrasi` (`id_registrasi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `t_mutasi_det`
--
ALTER TABLE `t_mutasi_det`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_mutasi` (`id_mutasi`);

--
-- Indexes for table `t_odontogram`
--
ALTER TABLE `t_odontogram`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_reg` (`id_reg`);

--
-- Indexes for table `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_reg` (`id_reg`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `t_perawatan`
--
ALTER TABLE `t_perawatan`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_reg` (`id_reg`);

--
-- Indexes for table `t_registrasi`
--
ALTER TABLE `t_registrasi`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_klinik` (`id_klinik`),
  ADD KEY `id_layanan` (`id_layanan`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_pemetaan` (`id_pemetaan`);

--
-- Indexes for table `t_registrasi_old`
--
ALTER TABLE `t_registrasi_old`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `t_role_menu`
--
ALTER TABLE `t_role_menu`
  ADD KEY `f_level_user` (`id_role`) USING BTREE,
  ADD KEY `id_menu` (`id_menu`) USING BTREE;

--
-- Indexes for table `t_spam`
--
ALTER TABLE `t_spam`
  ADD PRIMARY KEY (`id_t_spam`) USING BTREE;

--
-- Indexes for table `t_tindakan`
--
ALTER TABLE `t_tindakan`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `t_tindakan_ibfk_2` (`id_pegawai`),
  ADD KEY `id_reg` (`id_reg`),
  ADD KEY `id_user_adm` (`id_user_adm`);

--
-- Indexes for table `t_tindakanlab`
--
ALTER TABLE `t_tindakanlab`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_reg` (`id_reg`),
  ADD KEY `id_user_adm` (`id_user_adm`);

--
-- Indexes for table `t_tindakanlab_det`
--
ALTER TABLE `t_tindakanlab_det`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_tindakan_lab` (`id_tindakan_lab`),
  ADD KEY `id_t_tindakanlab` (`id_t_tindakanlab`);

--
-- Indexes for table `t_tindakan_det`
--
ALTER TABLE `t_tindakan_det`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_tindakan` (`id_tindakan`),
  ADD KEY `id_t_tindakan` (`id_t_tindakan`);

--
-- Indexes for table `t_user_klinik`
--
ALTER TABLE `t_user_klinik`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_bank_kredit`
--
ALTER TABLE `m_bank_kredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_diagnosa`
--
ALTER TABLE `m_diagnosa`
  MODIFY `id_diagnosa` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_jenis_logistik`
--
ALTER TABLE `m_jenis_logistik`
  MODIFY `id_jenis_logistik` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_laboratorium`
--
ALTER TABLE `m_laboratorium`
  MODIFY `id_laboratorium` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_layanan`
--
ALTER TABLE `m_layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `m_logistik`
--
ALTER TABLE `m_logistik`
  MODIFY `id_logistik` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_nontunai`
--
ALTER TABLE `m_nontunai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_pesan_blash`
--
ALTER TABLE `m_pesan_blash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_role`
--
ALTER TABLE `m_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_tindakan`
--
ALTER TABLE `m_tindakan`
  MODIFY `id_tindakan` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_diagnosa`
--
ALTER TABLE `t_diagnosa`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_diagnosa_det`
--
ALTER TABLE `t_diagnosa_det`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_honor`
--
ALTER TABLE `t_honor`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_honor_dokter_lab`
--
ALTER TABLE `t_honor_dokter_lab`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_honor_dokter_tindakan`
--
ALTER TABLE `t_honor_dokter_tindakan`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_honor_old`
--
ALTER TABLE `t_honor_old`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_jadwal_dokter_rutin`
--
ALTER TABLE `t_jadwal_dokter_rutin`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `t_jadwal_dokter_tidak_rutin`
--
ALTER TABLE `t_jadwal_dokter_tidak_rutin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_kamera`
--
ALTER TABLE `t_kamera`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_kamera_det`
--
ALTER TABLE `t_kamera_det`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_logistik`
--
ALTER TABLE `t_logistik`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_logistik_det`
--
ALTER TABLE `t_logistik_det`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_log_jadwal_dokter`
--
ALTER TABLE `t_log_jadwal_dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `t_mutasi`
--
ALTER TABLE `t_mutasi`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_odontogram`
--
ALTER TABLE `t_odontogram`
  MODIFY `id` int(34) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_spam`
--
ALTER TABLE `t_spam`
  MODIFY `id_t_spam` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_tindakan`
--
ALTER TABLE `t_tindakan`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_tindakan_det`
--
ALTER TABLE `t_tindakan_det`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_user_klinik`
--
ALTER TABLE `t_user_klinik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_data_medik`
--
ALTER TABLE `m_data_medik`
  ADD CONSTRAINT `m_data_medik_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`);

--
-- Constraints for table `m_logistik`
--
ALTER TABLE `m_logistik`
  ADD CONSTRAINT `m_logistik_ibfk_1` FOREIGN KEY (`id_jenis_logistik`) REFERENCES `m_jenis_logistik` (`id_jenis_logistik`);

--
-- Constraints for table `m_pegawai`
--
ALTER TABLE `m_pegawai`
  ADD CONSTRAINT `m_pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `m_jabatan` (`id`);

--
-- Constraints for table `m_user`
--
ALTER TABLE `m_user`
  ADD CONSTRAINT `m_user_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`),
  ADD CONSTRAINT `m_user_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `m_pemetaan` (`id`);

--
-- Constraints for table `t_diagnosa`
--
ALTER TABLE `t_diagnosa`
  ADD CONSTRAINT `t_diagnosa_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`),
  ADD CONSTRAINT `t_diagnosa_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`),
  ADD CONSTRAINT `t_diagnosa_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`),
  ADD CONSTRAINT `t_diagnosa_ibfk_4` FOREIGN KEY (`id_user_adm`) REFERENCES `m_user` (`id`);

--
-- Constraints for table `t_diagnosa_det`
--
ALTER TABLE `t_diagnosa_det`
  ADD CONSTRAINT `t_diagnosa_det_ibfk_1` FOREIGN KEY (`id_diagnosa`) REFERENCES `m_diagnosa` (`id_diagnosa`),
  ADD CONSTRAINT `t_diagnosa_det_ibfk_2` FOREIGN KEY (`id_t_diagnosa`) REFERENCES `t_diagnosa` (`id`);

--
-- Constraints for table `t_honor`
--
ALTER TABLE `t_honor`
  ADD CONSTRAINT `t_honor_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `m_pegawai` (`id`);

--
-- Constraints for table `t_jadwal_dokter_rutin`
--
ALTER TABLE `t_jadwal_dokter_rutin`
  ADD CONSTRAINT `t_jadwal_dokter_rutin_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `m_pegawai` (`id`),
  ADD CONSTRAINT `t_jadwal_dokter_rutin_ibfk_2` FOREIGN KEY (`id_klinik`) REFERENCES `m_klinik` (`id`);

--
-- Constraints for table `t_jadwal_dokter_tidak_rutin`
--
ALTER TABLE `t_jadwal_dokter_tidak_rutin`
  ADD CONSTRAINT `t_jadwal_dokter_tidak_rutin_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `m_pegawai` (`id`),
  ADD CONSTRAINT `t_jadwal_dokter_tidak_rutin_ibfk_2` FOREIGN KEY (`id_klinik`) REFERENCES `m_klinik` (`id`);

--
-- Constraints for table `t_kamera`
--
ALTER TABLE `t_kamera`
  ADD CONSTRAINT `t_kamera_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`),
  ADD CONSTRAINT `t_kamera_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`),
  ADD CONSTRAINT `t_kamera_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`),
  ADD CONSTRAINT `t_kamera_ibfk_4` FOREIGN KEY (`id_user_adm`) REFERENCES `m_user` (`id`);

--
-- Constraints for table `t_kamera_det`
--
ALTER TABLE `t_kamera_det`
  ADD CONSTRAINT `t_kamera_det_ibfk_1` FOREIGN KEY (`id_t_kamera`) REFERENCES `t_kamera` (`id`);

--
-- Constraints for table `t_logistik`
--
ALTER TABLE `t_logistik`
  ADD CONSTRAINT `t_logistik_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`),
  ADD CONSTRAINT `t_logistik_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`),
  ADD CONSTRAINT `t_logistik_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`),
  ADD CONSTRAINT `t_logistik_ibfk_4` FOREIGN KEY (`id_user_adm`) REFERENCES `m_user` (`id`);

--
-- Constraints for table `t_logistik_det`
--
ALTER TABLE `t_logistik_det`
  ADD CONSTRAINT `t_logistik_det_ibfk_1` FOREIGN KEY (`id_logistik`) REFERENCES `m_logistik` (`id_logistik`),
  ADD CONSTRAINT `t_logistik_det_ibfk_2` FOREIGN KEY (`id_t_logistik`) REFERENCES `t_logistik` (`id`);

--
-- Constraints for table `t_log_jadwal_dokter`
--
ALTER TABLE `t_log_jadwal_dokter`
  ADD CONSTRAINT `t_log_jadwal_dokter_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `m_pegawai` (`id`),
  ADD CONSTRAINT `t_log_jadwal_dokter_ibfk_2` FOREIGN KEY (`id_klinik`) REFERENCES `m_klinik` (`id`);

--
-- Constraints for table `t_mutasi`
--
ALTER TABLE `t_mutasi`
  ADD CONSTRAINT `t_mutasi_ibfk_1` FOREIGN KEY (`id_jenis_trans`) REFERENCES `m_jenis_trans` (`id`),
  ADD CONSTRAINT `t_mutasi_ibfk_2` FOREIGN KEY (`id_registrasi`) REFERENCES `t_registrasi` (`id`),
  ADD CONSTRAINT `t_mutasi_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `m_user` (`id`);

--
-- Constraints for table `t_mutasi_det`
--
ALTER TABLE `t_mutasi_det`
  ADD CONSTRAINT `t_mutasi_det_ibfk_1` FOREIGN KEY (`id_mutasi`) REFERENCES `t_mutasi` (`id`);

--
-- Constraints for table `t_odontogram`
--
ALTER TABLE `t_odontogram`
  ADD CONSTRAINT `t_odontogram_ibfk_1` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`);

--
-- Constraints for table `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  ADD CONSTRAINT `t_pembayaran_ibfk_1` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`),
  ADD CONSTRAINT `t_pembayaran_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `m_user` (`id`);

--
-- Constraints for table `t_perawatan`
--
ALTER TABLE `t_perawatan`
  ADD CONSTRAINT `t_perawatan_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`),
  ADD CONSTRAINT `t_perawatan_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`),
  ADD CONSTRAINT `t_perawatan_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`);

--
-- Constraints for table `t_registrasi`
--
ALTER TABLE `t_registrasi`
  ADD CONSTRAINT `t_registrasi_ibfk_1` FOREIGN KEY (`id_klinik`) REFERENCES `m_klinik` (`id`),
  ADD CONSTRAINT `t_registrasi_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `m_layanan` (`id_layanan`),
  ADD CONSTRAINT `t_registrasi_ibfk_3` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`),
  ADD CONSTRAINT `t_registrasi_ibfk_4` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`),
  ADD CONSTRAINT `t_registrasi_ibfk_5` FOREIGN KEY (`id_pemetaan`) REFERENCES `m_pemetaan` (`id`);

--
-- Constraints for table `t_role_menu`
--
ALTER TABLE `t_role_menu`
  ADD CONSTRAINT `f_level_user` FOREIGN KEY (`id_role`) REFERENCES `m_role` (`id`),
  ADD CONSTRAINT `t_role_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `m_menu` (`id`);

--
-- Constraints for table `t_tindakan`
--
ALTER TABLE `t_tindakan`
  ADD CONSTRAINT `t_tindakan_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`),
  ADD CONSTRAINT `t_tindakan_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`),
  ADD CONSTRAINT `t_tindakan_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`),
  ADD CONSTRAINT `t_tindakan_ibfk_4` FOREIGN KEY (`id_user_adm`) REFERENCES `m_user` (`id`);

--
-- Constraints for table `t_tindakanlab`
--
ALTER TABLE `t_tindakanlab`
  ADD CONSTRAINT `t_tindakanlab_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`),
  ADD CONSTRAINT `t_tindakanlab_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`),
  ADD CONSTRAINT `t_tindakanlab_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`),
  ADD CONSTRAINT `t_tindakanlab_ibfk_4` FOREIGN KEY (`id_user_adm`) REFERENCES `m_user` (`id`);

--
-- Constraints for table `t_tindakanlab_det`
--
ALTER TABLE `t_tindakanlab_det`
  ADD CONSTRAINT `t_tindakanlab_det_ibfk_1` FOREIGN KEY (`id_tindakan_lab`) REFERENCES `m_laboratorium` (`id_laboratorium`),
  ADD CONSTRAINT `t_tindakanlab_det_ibfk_2` FOREIGN KEY (`id_t_tindakanlab`) REFERENCES `t_tindakanlab` (`id`);

--
-- Constraints for table `t_tindakan_det`
--
ALTER TABLE `t_tindakan_det`
  ADD CONSTRAINT `t_tindakan_det_ibfk_1` FOREIGN KEY (`id_tindakan`) REFERENCES `m_tindakan` (`id_tindakan`),
  ADD CONSTRAINT `t_tindakan_det_ibfk_2` FOREIGN KEY (`id_t_tindakan`) REFERENCES `t_tindakan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
