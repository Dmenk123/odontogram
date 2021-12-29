/*
 Navicat Premium Data Transfer

 Source Server         : local-mysql
 Source Server Type    : MySQL
 Source Server Version : 100413
 Source Host           : localhost:3306
 Source Schema         : odontogram

 Target Server Type    : MySQL
 Target Server Version : 100413
 File Encoding         : 65001

 Date: 30/12/2021 02:14:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_asuransi
-- ----------------------------
DROP TABLE IF EXISTS `m_asuransi`;
CREATE TABLE `m_asuransi`  (
  `id` int(11) NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_asuransi
-- ----------------------------
INSERT INTO `m_asuransi` VALUES (1, 'BPJS', 'BPJS', '2020-09-18 23:31:23', NULL, NULL);
INSERT INTO `m_asuransi` VALUES (2, 'asa', 'as', '2020-09-18 23:31:23', '2020-09-19 21:26:07', '2020-09-19 21:33:05');
INSERT INTO `m_asuransi` VALUES (3, 'Arisan Kampung', 'Arisan Kampung', '2020-09-18 23:31:23', NULL, NULL);
INSERT INTO `m_asuransi` VALUES (4, 'coba', 'coba', '2020-09-19 14:02:09', NULL, NULL);
INSERT INTO `m_asuransi` VALUES (5, 'cek', 'cek', '2020-09-19 14:02:19', NULL, NULL);
INSERT INTO `m_asuransi` VALUES (6, 'select2', 'sel2', '2020-09-19 14:12:08', '2020-09-19 21:23:20', NULL);
INSERT INTO `m_asuransi` VALUES (7, 'asas', 'aad', '2020-09-19 20:41:41', '2020-09-19 21:28:49', '2020-09-19 21:33:01');
INSERT INTO `m_asuransi` VALUES (8, 'Prundential', 'Prudential', '2020-09-19 21:26:22', NULL, NULL);
INSERT INTO `m_asuransi` VALUES (9, 'yoyoi', 'yoyoi', '2020-09-19 21:33:15', NULL, NULL);

-- ----------------------------
-- Table structure for m_bank_kredit
-- ----------------------------
DROP TABLE IF EXISTS `m_bank_kredit`;
CREATE TABLE `m_bank_kredit`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_bank_kredit
-- ----------------------------
INSERT INTO `m_bank_kredit` VALUES (1, 'BCA', 'BCA', NULL, NULL, NULL);
INSERT INTO `m_bank_kredit` VALUES (2, 'Bank Jatim', 'Bank Jatin', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for m_data_medik
-- ----------------------------
DROP TABLE IF EXISTS `m_data_medik`;
CREATE TABLE `m_data_medik`  (
  `id` int(11) NOT NULL,
  `id_pasien` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gol_darah` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tekanan_darah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tekanan_darah_val` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `penyakit_jantung` int(1) NULL DEFAULT NULL,
  `diabetes` int(1) NULL DEFAULT NULL,
  `haemopilia` int(1) NULL DEFAULT NULL,
  `hepatitis` int(1) NULL DEFAULT NULL,
  `gastring` int(1) NULL DEFAULT NULL,
  `penyakit_lainnya` int(1) NULL DEFAULT NULL,
  `hamil` int(11) NULL DEFAULT NULL,
  `alergi_obat` int(1) NULL DEFAULT NULL,
  `alergi_obat_val` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alergi_makanan` int(1) NULL DEFAULT NULL,
  `alergi_makanan_val` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_data_medik
-- ----------------------------
INSERT INTO `m_data_medik` VALUES (1, '5', 'O', 'HYPERTENSI', '140/10', 1, 1, 1, 1, 1, 1, NULL, 0, NULL, 0, NULL, '2020-09-13 17:53:03', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (2, '6', 'AB', 'HYPERTENSI', '900/21', 1, 0, 0, 0, 1, 0, NULL, 1, 'kalpanax', 0, NULL, '2020-09-19 20:28:52', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (3, '7', 'O', 'HYPOTENSI', '8000/2', 1, 1, 1, 1, 1, 0, NULL, 1, 'kalpanax', 0, NULL, '2020-10-11 14:47:17', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (4, '1', 'O', 'HYPERTENSI', '140', 1, 0, 0, 0, 1, 0, 0, 1, 'Minyak Angin', 1, 'Beras', '2021-12-12 20:35:53', '2021-12-27 04:54:42', NULL);
INSERT INTO `m_data_medik` VALUES (5, '2', 'AB', 'HYPOTENSI', '20', 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, '2021-12-12 20:37:36', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (6, '3', 'A', 'NORMAL', '80', 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, '2021-12-12 20:38:59', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (7, '4', '0', 'NORMAL', '80/90', 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, '2021-12-16 01:03:00', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (8, '5', 'O', 'HYPERTENSI', '14', 1, 1, 1, 0, 0, 0, NULL, 1, 'asas', 0, NULL, '2021-12-20 15:54:22', NULL, NULL);

-- ----------------------------
-- Table structure for m_diagnosa
-- ----------------------------
DROP TABLE IF EXISTS `m_diagnosa`;
CREATE TABLE `m_diagnosa`  (
  `id_diagnosa` int(32) NOT NULL AUTO_INCREMENT,
  `kode_diagnosa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_diagnosa` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_diagnosa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_diagnosa
-- ----------------------------
INSERT INTO `m_diagnosa` VALUES (1, 'K.00.1', 'Karies Gigi Dong', '2020-09-07 08:18:56', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (2, 'K.00.2', 'Gigi Berlubang', '2020-09-07 10:24:36', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (3, 'K.00.3', 'Coba Diag', '2020-09-07 10:29:33', NULL, '2020-09-09 09:26:55');
INSERT INTO `m_diagnosa` VALUES (4, 'K.00.3', 'Boyok Linu', '2020-11-11 10:52:27', NULL, NULL);

-- ----------------------------
-- Table structure for m_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `m_jabatan`;
CREATE TABLE `m_jabatan`  (
  `id` int(11) NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_jabatan
-- ----------------------------
INSERT INTO `m_jabatan` VALUES (1, 'Dokter Gigi', 'Dokter Gigi Spesialis', '2020-08-30 23:25:53', '2020-09-08 20:07:44', NULL);
INSERT INTO `m_jabatan` VALUES (2, 'Staff Admin', 'Staff Admin', '2020-08-30 23:25:53', NULL, NULL);
INSERT INTO `m_jabatan` VALUES (3, 'Cleaning Service', 'Resik Resik Klinik', '2020-09-08 19:57:55', NULL, NULL);

-- ----------------------------
-- Table structure for m_jenis_logistik
-- ----------------------------
DROP TABLE IF EXISTS `m_jenis_logistik`;
CREATE TABLE `m_jenis_logistik`  (
  `id_jenis_logistik` int(32) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_jenis_logistik`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_jenis_logistik
-- ----------------------------
INSERT INTO `m_jenis_logistik` VALUES (1, 'Obat', NULL, NULL, NULL);
INSERT INTO `m_jenis_logistik` VALUES (2, 'Bahan Habis Pakai', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for m_jenis_trans
-- ----------------------------
DROP TABLE IF EXISTS `m_jenis_trans`;
CREATE TABLE `m_jenis_trans`  (
  `id` int(11) NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_jenis_trans
-- ----------------------------
INSERT INTO `m_jenis_trans` VALUES (1, 'logistik');
INSERT INTO `m_jenis_trans` VALUES (2, 'tindakan');
INSERT INTO `m_jenis_trans` VALUES (3, 'lab');
INSERT INTO `m_jenis_trans` VALUES (4, 'visite');
INSERT INTO `m_jenis_trans` VALUES (5, 'diskon global');
INSERT INTO `m_jenis_trans` VALUES (6, 'honor dokter');

-- ----------------------------
-- Table structure for m_klinik
-- ----------------------------
DROP TABLE IF EXISTS `m_klinik`;
CREATE TABLE `m_klinik`  (
  `id` int(11) NOT NULL,
  `nama_klinik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kelurahan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kecamatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_pos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `provinsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_dokter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_klinik
-- ----------------------------
INSERT INTO `m_klinik` VALUES (3, 'SOFINE SIMO JAWAR', 'JL. SIMO JAWAR NO.35D', 'KUPANG KRAJAN', 'SAWAHAN', 'SURABAYA', '60281', 'JAWA TIMUR', '0822-2823-2675', 'as@as.com', '', 'ROY TAMARA', '0822-2823-2675', 'logo.PNG', '2021-11-30 23:21:35', '2021-12-20 15:56:35', NULL);
INSERT INTO `m_klinik` VALUES (4, 'SOFINE DRIYOREJO', 'DRIYOREJO 12121', 'KEL 2', 'KEC 2', 'GRESIK', '71872', 'JAWA TIMUR', '18912891829', 'asas@aass.com', '', 'ASASAS', '18912891829', 'cabang-21639246098.jpg', '2021-12-09 23:14:23', '2021-12-20 15:57:01', NULL);

-- ----------------------------
-- Table structure for m_laboratorium
-- ----------------------------
DROP TABLE IF EXISTS `m_laboratorium`;
CREATE TABLE `m_laboratorium`  (
  `id_laboratorium` int(32) NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tindakan_lab` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` int(32) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `disc_persen` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id_laboratorium`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_laboratorium
-- ----------------------------
INSERT INTO `m_laboratorium` VALUES (1, 'L001', 'Periksa Darah', 500000, NULL, '2021-12-16 00:46:45', NULL, 10);
INSERT INTO `m_laboratorium` VALUES (2, 'L002', 'lalala', 100000, '2020-09-17 11:04:30', '2020-09-17 11:27:55', NULL, 0);

-- ----------------------------
-- Table structure for m_layanan
-- ----------------------------
DROP TABLE IF EXISTS `m_layanan`;
CREATE TABLE `m_layanan`  (
  `id_layanan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_layanan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_layanan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dokter` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `waktu_layanan` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_layanan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_layanan
-- ----------------------------
INSERT INTO `m_layanan` VALUES (1, 'LY-0001', 'CABUT GIGI', '1', 'Ini Keterangan aja', '30', '2021-12-22 04:11:33', '2021-12-07 01:45:23', NULL, 'cabut_gigi');
INSERT INTO `m_layanan` VALUES (2, 'LY-0002', 'PASANG KAWAT GGI', '1,2', 'Pasang Kawat Gigi dengan menggunakan kawat baja berkualitas (tahan banting)', '20', '2021-12-22 04:11:36', NULL, NULL, 'kawat_gigi');
INSERT INTO `m_layanan` VALUES (3, 'LY-0003', 'PEMBERSIHAN KARANG GIGI', '1', NULL, '30', '2021-12-22 04:11:38', NULL, NULL, 'gigi_bersih');
INSERT INTO `m_layanan` VALUES (4, 'LY-0004', 'KONSULTASI', '1,2', NULL, '30', '2021-12-22 04:11:40', NULL, NULL, 'dokter');
INSERT INTO `m_layanan` VALUES (5, 'LY-0005', 'TAMBAL GIGI', '1,2', NULL, '60', '2021-12-22 04:11:45', NULL, NULL, 'tambal_gigi');

-- ----------------------------
-- Table structure for m_logistik
-- ----------------------------
DROP TABLE IF EXISTS `m_logistik`;
CREATE TABLE `m_logistik`  (
  `id_logistik` int(32) NOT NULL AUTO_INCREMENT,
  `kode_logistik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_logistik` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_beli` int(100) NULL DEFAULT NULL,
  `harga_jual` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stok` int(255) NULL DEFAULT NULL,
  `id_jenis_logistik` int(32) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_logistik`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_logistik
-- ----------------------------
INSERT INTO `m_logistik` VALUES (1, '001', 'Oskadon', 1000, '1500', 250, 1, NULL, '2020-10-11 14:44:42', '2021-12-13 21:38:49');
INSERT INTO `m_logistik` VALUES (2, '002', 'Masker tes', 1000, '2000', 5, 2, '2020-09-15 11:54:34', '2020-09-15 13:48:10', '2021-12-13 21:39:35');
INSERT INTO `m_logistik` VALUES (3, 'A-001', 'Paracetamol', 0, '0', 300, 1, '2021-12-13 21:40:16', NULL, NULL);
INSERT INTO `m_logistik` VALUES (4, 'A-002', 'Puyer Bintang 7', 0, '0', 50, 1, '2021-12-13 21:41:12', NULL, NULL);

-- ----------------------------
-- Table structure for m_menu
-- ----------------------------
DROP TABLE IF EXISTS `m_menu`;
CREATE TABLE `m_menu`  (
  `id` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `aktif` int(1) NULL DEFAULT NULL,
  `tingkat` int(11) NULL DEFAULT NULL,
  `urutan` int(11) NULL DEFAULT NULL,
  `add_button` int(1) NULL DEFAULT NULL,
  `edit_button` int(1) NULL DEFAULT NULL,
  `delete_button` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of m_menu
-- ----------------------------
INSERT INTO `m_menu` VALUES (1, 0, 'Dashboard', 'Dashboard', 'home', 'flaticon2-architecture-and-city', 1, 1, 1, 0, 0, 0);
INSERT INTO `m_menu` VALUES (2, 0, 'Setting (Administrator)', 'Setting', '', 'flaticon2-gear', 1, 1, 100, 0, 0, 0);
INSERT INTO `m_menu` VALUES (3, 2, 'Setting Menu', 'Setting Menu', 'set_menu', 'flaticon-grid-menu', 1, 2, 2, 1, 1, 1);
INSERT INTO `m_menu` VALUES (4, 2, 'Setting Role', 'Setting Role', 'set_role', 'flaticon-network', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (6, 0, 'Master', 'Master', '', 'flaticon-folder-1', 1, 1, 2, 0, 0, 0);
INSERT INTO `m_menu` VALUES (7, 10, 'Data User', 'Data User', 'master_user', 'flaticon-users', 1, 3, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (8, 10, 'Data Pegawai', 'Master Data Pegawai', 'master_pegawai', 'flaticon-user', 1, 3, 2, 1, 1, 1);
INSERT INTO `m_menu` VALUES (9, 6, 'Data', 'Data', '', 'flaticon-tabs', 1, 2, 2, 0, 0, 0);
INSERT INTO `m_menu` VALUES (10, 6, 'User', 'User', '', 'flaticon-users-1', 1, 2, 3, 0, 0, 0);
INSERT INTO `m_menu` VALUES (11, 6, 'Klinik', 'Klinik', '', 'flaticon-medal', 1, 2, 1, 0, 0, 0);
INSERT INTO `m_menu` VALUES (12, 11, 'Data Klinik', 'Data Klinik', 'master_klinik', 'flaticon-profile', 1, 3, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (13, 9, 'Tindakan', 'Tindakan', 'master_tindakan', 'flaticon2-graph', 1, 3, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (14, 9, 'Diagnosa', 'Diagnosa', 'master_diagnosa', 'flaticon2-contract', 1, 3, 2, 1, 1, 1);
INSERT INTO `m_menu` VALUES (15, 10, 'Pemetaan', 'Pemetaan', 'master_pemetaan', 'flaticon-interface-8', 1, 3, 3, 1, 1, 1);
INSERT INTO `m_menu` VALUES (16, 10, 'Jabatan', 'Master Jabatan', 'master_jabatan', 'flaticon-customer', 1, 3, 4, 1, 1, 1);
INSERT INTO `m_menu` VALUES (17, 0, 'Registrasi', 'Registrasi', '', 'flaticon-list', 1, 1, 3, 0, 0, 0);
INSERT INTO `m_menu` VALUES (18, 17, 'Data Pasien', 'Data pasien', 'data_pasien', 'flaticon-profile-1', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (19, 17, 'Registrasi Pasien', 'Registrasi Pasien', 'reg_pasien', 'flaticon-user-add', 1, 2, 2, 1, 1, 1);
INSERT INTO `m_menu` VALUES (20, 0, 'Rekam Medik', 'Rekam Medik', '', 'flaticon2-heart-rate-monitor', 1, 1, 4, 0, 0, 0);
INSERT INTO `m_menu` VALUES (21, 20, 'Data Rekam Medik', 'Data Rekam Medik', 'rekam_medik', 'flaticon2-medical-records', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (24, 9, 'Logistik dan Obat', 'Logistik dan Obat', 'master_logistik', 'flaticon2-contract', 1, 3, 3, 1, 1, 1);
INSERT INTO `m_menu` VALUES (25, 9, 'Laboratorium', 'Laboratorium', 'master_laboratorium', 'flaticon2-contract', 1, 3, 4, 1, 1, 1);
INSERT INTO `m_menu` VALUES (26, 9, 'Asuransi', 'Asuransi', 'master_asuransi', 'flaticon2-contract', 0, 3, 5, 1, 1, 1);
INSERT INTO `m_menu` VALUES (27, 10, 'Honor Dokter', 'Honor Dokter', 'honor_dokter', 'flaticon-coins', 1, 3, 5, 1, 1, 1);
INSERT INTO `m_menu` VALUES (28, 0, 'Transaksi', 'Transaksi', '', 'flaticon-infinity', 1, 1, 5, 0, 0, 0);
INSERT INTO `m_menu` VALUES (29, 28, 'Pembayaran', 'Pembayaran', 'pembayaran', 'flaticon-coins', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (30, 9, 'Diskon', 'Diskon', 'master_diskon', 'flaticon2-contract', 0, 3, 5, 1, 1, 1);
INSERT INTO `m_menu` VALUES (31, 0, 'Laporan & Monitoring', 'Laporan & Monitoring', '', 'flaticon-analytics', 1, 1, 6, 0, 0, 0);
INSERT INTO `m_menu` VALUES (32, 38, 'Laporan Honor Dokter', 'Laporan Honor Dokter', 'lap_honor_dokter', 'flaticon-profile-1', 1, 3, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (33, 38, 'Laporan Penerimaan Klinik', 'Laporan Penerimaan Klinik', 'lap_penerimaan_klinik', 'flaticon-piggy-bank', 1, 3, 2, 1, 1, 1);
INSERT INTO `m_menu` VALUES (34, 37, 'Monitoring Kunjungan Klinik', 'Monitoring Kunjungan Klinik', 'monitoring_kunjungan', 'flaticon-network', 1, 3, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (35, 0, 'Jadwal Dokter', 'Jadwal Dokter', 'jadwal_dokter', 'flaticon-event-calendar-symbol', 1, 1, 3, 1, 1, 1);
INSERT INTO `m_menu` VALUES (36, 37, 'Monitoring Honor Dokter', 'Monitoring Honor Dokter', 'monitoring_honor', 'flaticon-coins', 1, 3, 2, 1, 1, 1);
INSERT INTO `m_menu` VALUES (37, 31, 'Monitoring', 'Monitoring', '', 'flaticon-presentation-1', 1, 2, 1, 0, 0, 0);
INSERT INTO `m_menu` VALUES (38, 31, 'Laporan', 'Laporan', '', 'flaticon-line-graph', 1, 2, 2, 0, 0, 0);
INSERT INTO `m_menu` VALUES (39, 9, 'Master Non Tunai', 'Master Non Tunai', 'master_nontunai', 'flaticon2-list', 1, 3, 6, 1, 1, 1);

-- ----------------------------
-- Table structure for m_nontunai
-- ----------------------------
DROP TABLE IF EXISTS `m_nontunai`;
CREATE TABLE `m_nontunai`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_nontunai
-- ----------------------------
INSERT INTO `m_nontunai` VALUES (1, 'Ovo', NULL, NULL, '2021-12-28 11:34:53');
INSERT INTO `m_nontunai` VALUES (2, 'Debit', NULL, NULL, NULL);
INSERT INTO `m_nontunai` VALUES (3, 'Shopee', NULL, NULL, NULL);
INSERT INTO `m_nontunai` VALUES (4, 'Dana', NULL, NULL, NULL);
INSERT INTO `m_nontunai` VALUES (5, 'Oyo', '2021-12-28 11:32:28', NULL, NULL);

-- ----------------------------
-- Table structure for m_pasien
-- ----------------------------
DROP TABLE IF EXISTS `m_pasien`;
CREATE TABLE `m_pasien`  (
  `id` int(11) NOT NULL,
  `no_rm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_lahir` date NULL DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis_kelamin` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `suku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_rumah` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `telp_rumah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_kantor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `file_ktp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_pasien
-- ----------------------------
INSERT INTO `m_pasien` VALUES (1, 'AN.1985.03.0001', 'ANDY', 'surabaya', '1985-03-02', '882712121881819', 'L', 'Pribumi', 'Wiraswasta', 'Jl. A Yuni 201 Surabaya', '03128128182', NULL, '071827182718', 1, '2021-12-12 20:35:53', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (2, 'AN.1992.02.0002', 'ANWAR', 'Magetan', '1992-02-14', '18219281928', 'L', 'Negrito', 'PNS', 'Jl. abcd 12', NULL, NULL, '182192819289', 1, '2021-12-12 20:37:36', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (3, 'NI.1997.08.0001', 'NINGSIH', 'Surabaya', '1997-08-14', '1821982919', 'P', 'Pinoy', 'TNI', 'Jl. 1kjakjaksj', NULL, NULL, '18291829182912', 1, '2021-12-12 20:38:59', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (4, 'YA.2012.02.0001', 'YAYAN', 'SURABAYA', '2012-02-04', '-', 'L', 'CAMPURAN', 'PELAJAR', 'JL. abcde', NULL, '-', '08127182718278', 1, '2021-12-16 01:03:00', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (5, 'AG.1954.12.0001', 'AGUS ULUM MULYO, S.KOM., MT', 'Surabaya', '1954-12-12', '357853532353535', 'L', 'Indo', 'asasas', 'Jl. aksjaksjak  akjsk jakjaks', 'asas', 'asdasdas', '0816656560506', 1, '2021-12-20 15:54:22', NULL, NULL, '5-1640456210.jpeg');
INSERT INTO `m_pasien` VALUES (6, 'MA.00.01', 'MARWAH', 'Disana', '2021-12-21', '35131312309223', 'P', 'Dayak', 'Artis', 'sadsa', '00990', 'asdaddads', '0909091', 1, '2021-12-21 04:47:20', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (7, 'YU.00.01', 'YULI', 'Disna', '2021-12-21', '0728192212', 'P', 'Jawa', 'Artis', 'Disna', '08192727191', 'Yuhu', '08829292', 1, '2021-12-21 04:52:55', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (8, 'NU.00.01', 'NUR CAHYONO', 'Surabaya', '1994-08-21', '3578142108940001', 'L', 'Jawa', 'Programmer', 'Jl. raya Tubanan', '', 'Jl. raya Tubanan', '089235432546', 1, '2021-12-21 09:30:58', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (9, 'RO.00.01', 'ROY', 'Mataram', '0000-00-00', '567856786786', 'L', 'Jawa', 'Dokter', 'Jalan Bukit Golf M2/02', '88889982', 'Jalan Bukit Golf M2/02', '081388889982', 1, '2021-12-21 11:44:45', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (10, 'DR.00.01', 'DR ARMAND', 'asasas', '1990-03-03', '357859565656565', 'L', '', 'a', 'as', 'asa', 'as', 'as', 1, '2021-12-23 13:55:33', NULL, NULL, '10-1640801060.png');

-- ----------------------------
-- Table structure for m_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `m_pegawai`;
CREATE TABLE `m_pegawai`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  `id_jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telp_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telp_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT NULL,
  `is_owner` int(1) NULL DEFAULT NULL COMMENT 'jika owner, tidak ada honor dokter',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_pegawai
-- ----------------------------
INSERT INTO `m_pegawai` VALUES ('1', '1', 'PEG-00001', 'Dr. Roy', 'Bulak Banteng 20-C', '1271872817', '712871872187', '2020-11-12 00:29:08', NULL, NULL, 1, 1);
INSERT INTO `m_pegawai` VALUES ('2', '1', 'PEG-00002', 'Drg. Ronald', 'Perum Sedati Tambak Blok Z-39', '1782781278', '17287182718', '2020-11-12 00:29:41', NULL, NULL, 0, NULL);
INSERT INTO `m_pegawai` VALUES ('3', '2', 'PEG-00003', 'Miss Tery', 'Jl. awauwiauwiauw', '19281928192812', '', '2021-12-12 20:41:58', NULL, NULL, 1, NULL);
INSERT INTO `m_pegawai` VALUES ('4', '2', 'PEG-00004', 'Miss Tar', 'asalskalsk', '10210210290129', '', '2021-12-16 23:40:36', NULL, NULL, 1, NULL);
INSERT INTO `m_pegawai` VALUES ('5', '3', 'PEG-00005', 'Suwanto Efendi', 'asasas', '121212', '12121', '2021-12-23 13:22:15', NULL, NULL, 1, NULL);
INSERT INTO `m_pegawai` VALUES ('6', '1', 'PEG-00006', 'Drg Martin', 'Jl, akjskajskaj', '0781212812818', '', '2021-12-25 13:11:04', NULL, NULL, 1, NULL);

-- ----------------------------
-- Table structure for m_pemetaan
-- ----------------------------
DROP TABLE IF EXISTS `m_pemetaan`;
CREATE TABLE `m_pemetaan`  (
  `id` int(10) NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `umur_awal` int(10) NULL DEFAULT NULL,
  `umur_akhir` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_pemetaan
-- ----------------------------
INSERT INTO `m_pemetaan` VALUES (1, 'Balita', 0, 5, '2020-11-19 14:34:28', NULL, NULL);
INSERT INTO `m_pemetaan` VALUES (2, 'Anak-Anak', 6, 10, '2020-11-19 14:34:48', NULL, NULL);
INSERT INTO `m_pemetaan` VALUES (3, 'Remaja', 11, 19, '2020-11-19 14:35:07', NULL, NULL);
INSERT INTO `m_pemetaan` VALUES (4, 'Dewasa', 20, 50, '2020-11-19 14:35:19', NULL, NULL);
INSERT INTO `m_pemetaan` VALUES (5, 'Lansia', 51, 200, '2020-11-19 14:35:37', NULL, NULL);

-- ----------------------------
-- Table structure for m_pesan_blash
-- ----------------------------
DROP TABLE IF EXISTS `m_pesan_blash`;
CREATE TABLE `m_pesan_blash`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pesan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'personal/broadcast',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_pesan_blash
-- ----------------------------

-- ----------------------------
-- Table structure for m_role
-- ----------------------------
DROP TABLE IF EXISTS `m_role`;
CREATE TABLE `m_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  `aktif` int(1) NULL DEFAULT 1,
  `is_all_klinik` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of m_role
-- ----------------------------
INSERT INTO `m_role` VALUES (1, 'developer', 'Level Developer Role', 1, 1);
INSERT INTO `m_role` VALUES (2, 'administrator', 'Level Administrator Role', 1, 1);
INSERT INTO `m_role` VALUES (3, 'Staff Admin Klinik', 'Role Untuk Staff Admin Klinik', 1, NULL);
INSERT INTO `m_role` VALUES (4, 'Dokter Klinik', 'Role Untuk Dokter Klinik', 1, NULL);

-- ----------------------------
-- Table structure for m_tindakan
-- ----------------------------
DROP TABLE IF EXISTS `m_tindakan`;
CREATE TABLE `m_tindakan`  (
  `id_tindakan` int(32) NOT NULL AUTO_INCREMENT,
  `kode_tindakan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_tindakan` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` int(255) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `is_potong_lab_honor_dokter` int(1) NULL DEFAULT NULL,
  `is_all_gigi` int(1) NULL DEFAULT NULL,
  `disc_persen` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id_tindakan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_tindakan
-- ----------------------------
INSERT INTO `m_tindakan` VALUES (1, 'T001', 'Operasi', 100000, NULL, '2021-12-14 21:41:21', NULL, NULL, NULL, 5);
INSERT INTO `m_tindakan` VALUES (2, 'T002', 'Pasang Kawat', 50000, '2020-09-09 14:35:45', '2020-09-09 15:05:11', NULL, 1, 1, 0);
INSERT INTO `m_tindakan` VALUES (3, 'T003', 'Pasang Gigi Palsu', 250000, '2020-11-11 10:51:21', '2020-11-11 10:51:35', NULL, 1, 1, 0);
INSERT INTO `m_tindakan` VALUES (4, '1004', 'Scaling', 100000, '2021-11-20 12:23:46', '2021-12-14 21:39:35', NULL, NULL, 1, 20);
INSERT INTO `m_tindakan` VALUES (5, 'T005', 'Tambal Gigi', 120000, '2021-12-14 21:42:03', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (6, 'T006', 'Bleaching', 3000000, '2021-12-16 23:33:11', '2021-12-16 23:38:58', NULL, NULL, 1, 0);

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user`  (
  `id` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_role` int(11) NULL DEFAULT NULL,
  `id_pegawai` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode_user` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'user_default.png',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES ('1', 1, '1', 'USR-00001', 'admin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-30 01:07:45', 'user_default.png', '2020-09-06 20:18:00', '2021-12-30 01:07:45', NULL);
INSERT INTO `m_user` VALUES ('2', 4, '1', 'USR-00002', 'drg_roy', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-30 00:49:51', 'drg-roy-1639131886.jpg', '2021-12-10 17:24:46', '2021-12-30 00:49:51', NULL);
INSERT INTO `m_user` VALUES ('3', 3, '3', 'USR-00003', 'admin_pusat', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-30 00:50:44', 'admin-pusat-1639316581.jpg', '2021-12-12 20:43:01', '2021-12-30 00:50:44', NULL);
INSERT INTO `m_user` VALUES ('4', 3, '4', 'USR-00004', 'admin_cabang', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-30 00:50:57', 'admin-cabang-1639883750.jpg', '2021-12-19 10:15:50', '2021-12-30 00:50:57', NULL);
INSERT INTO `m_user` VALUES ('5', 4, '6', 'USR-00005', 'drg_martin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-30 00:46:54', 'drg-martin-1640412721.jpg', '2021-12-25 13:12:00', '2021-12-30 00:46:54', NULL);

-- ----------------------------
-- Table structure for t_diagnosa
-- ----------------------------
DROP TABLE IF EXISTS `t_diagnosa`;
CREATE TABLE `t_diagnosa`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_reg` int(64) NULL DEFAULT NULL,
  `id_pasien` int(11) NULL DEFAULT NULL,
  `id_pegawai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_user_adm` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_diagnosa
-- ----------------------------
INSERT INTO `t_diagnosa` VALUES (1, 1, 2, '1', '2', '2021-12-17', '2021-12-17 23:18:19', NULL, NULL);
INSERT INTO `t_diagnosa` VALUES (2, 4, 5, '1', '2', '2021-12-21', '2021-12-21 11:26:42', NULL, NULL);
INSERT INTO `t_diagnosa` VALUES (3, 1, 5, '1', '2', '2021-12-30', '2021-12-30 00:41:38', NULL, NULL);

-- ----------------------------
-- Table structure for t_diagnosa_det
-- ----------------------------
DROP TABLE IF EXISTS `t_diagnosa_det`;
CREATE TABLE `t_diagnosa_det`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_t_diagnosa` int(64) NULL DEFAULT NULL,
  `id_diagnosa` int(32) NULL DEFAULT NULL,
  `gigi` int(32) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_diagnosa_det
-- ----------------------------
INSERT INTO `t_diagnosa_det` VALUES (1, 1, 2, 20, '2021-12-17 23:18:19', NULL, NULL);
INSERT INTO `t_diagnosa_det` VALUES (2, 1, 2, 15, '2021-12-17 23:18:26', NULL, NULL);
INSERT INTO `t_diagnosa_det` VALUES (3, 2, 2, 46, '2021-12-21 11:26:42', NULL, NULL);
INSERT INTO `t_diagnosa_det` VALUES (5, 3, 1, 4, '2021-12-30 00:41:38', NULL, NULL);

-- ----------------------------
-- Table structure for t_diskon
-- ----------------------------
DROP TABLE IF EXISTS `t_diskon`;
CREATE TABLE `t_diskon`  (
  `id` int(11) NOT NULL,
  `id_jenis_trans` int(11) NULL DEFAULT NULL,
  `persentase` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_diskon
-- ----------------------------
INSERT INTO `t_diskon` VALUES (1, 2, 10, '2021-12-13 23:06:03', NULL, '2021-12-13 23:08:25');
INSERT INTO `t_diskon` VALUES (2, 2, 15, '2021-12-13 23:08:25', NULL, '2021-12-13 23:08:59');
INSERT INTO `t_diskon` VALUES (3, 2, 10, '2021-12-13 23:08:59', NULL, '2021-12-13 23:09:55');
INSERT INTO `t_diskon` VALUES (4, 2, 15, '2021-12-13 23:09:55', NULL, '2021-12-13 23:11:09');
INSERT INTO `t_diskon` VALUES (5, 2, 15, '2021-12-13 23:12:21', NULL, NULL);

-- ----------------------------
-- Table structure for t_honor
-- ----------------------------
DROP TABLE IF EXISTS `t_honor`;
CREATE TABLE `t_honor`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_dokter` int(64) NULL DEFAULT NULL,
  `honor_visite` double(20, 2) NULL DEFAULT NULL,
  `tindakan_persen` int(3) NULL DEFAULT 0,
  `tindakan_lab_persen` int(3) NULL DEFAULT 0,
  `obat_persen` int(3) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `tindakan_persen_global` int(3) NULL DEFAULT 0,
  `tindakan_lab_global` int(3) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_honor
-- ----------------------------
INSERT INTO `t_honor` VALUES (1, 1, 0.00, 40, 0, 0, '2021-12-04 14:38:28', NULL, NULL, 0, 0);
INSERT INTO `t_honor` VALUES (2, 6, 0.00, 40, 0, 0, '2021-12-25 13:11:04', NULL, NULL, 0, 0);

-- ----------------------------
-- Table structure for t_honor_dokter_lab
-- ----------------------------
DROP TABLE IF EXISTS `t_honor_dokter_lab`;
CREATE TABLE `t_honor_dokter_lab`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_dokter` int(64) NULL DEFAULT NULL,
  `id_lab` int(64) NULL DEFAULT NULL,
  `persentase` int(3) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_honor_dokter_lab
-- ----------------------------

-- ----------------------------
-- Table structure for t_honor_dokter_tindakan
-- ----------------------------
DROP TABLE IF EXISTS `t_honor_dokter_tindakan`;
CREATE TABLE `t_honor_dokter_tindakan`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_dokter` int(64) NULL DEFAULT NULL,
  `id_tindakan` int(64) NULL DEFAULT NULL,
  `persentase` int(3) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_honor_dokter_tindakan
-- ----------------------------

-- ----------------------------
-- Table structure for t_honor_old
-- ----------------------------
DROP TABLE IF EXISTS `t_honor_old`;
CREATE TABLE `t_honor_old`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_dokter` int(64) NULL DEFAULT NULL,
  `honor_visite` double(20, 2) NULL DEFAULT NULL,
  `tindakan_persen` int(3) NULL DEFAULT 0,
  `tindakan_lab_persen` int(3) NULL DEFAULT 0,
  `obat_persen` int(3) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_honor_old
-- ----------------------------
INSERT INTO `t_honor_old` VALUES (1, 1, 50000.00, 20, 40, 20, '2021-12-04 14:38:28', NULL, NULL);

-- ----------------------------
-- Table structure for t_jadwal_dokter_rutin
-- ----------------------------
DROP TABLE IF EXISTS `t_jadwal_dokter_rutin`;
CREATE TABLE `t_jadwal_dokter_rutin`  (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `id_dokter` int(32) NULL DEFAULT NULL,
  `id_klinik` int(32) NULL DEFAULT NULL,
  `jam_mulai` time(0) NULL DEFAULT NULL,
  `jam_akhir` time(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `hari` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_jadwal_dokter_rutin
-- ----------------------------
INSERT INTO `t_jadwal_dokter_rutin` VALUES (1, 1, 3, '07:00:00', '15:00:00', '2021-12-26 20:17:33', NULL, NULL, 'senin');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (2, 2, 3, '07:00:00', '14:00:00', '2021-12-26 20:19:26', NULL, NULL, 'selasa');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (3, 1, 3, '08:00:00', '12:00:00', '2021-12-26 20:20:08', NULL, NULL, 'rabu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (4, 1, 3, '09:00:00', '14:00:00', '2021-12-26 20:20:40', NULL, NULL, 'kamis');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (5, 2, 3, '07:00:00', '12:00:00', '2021-12-26 20:21:08', NULL, NULL, 'jumat');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (6, 1, 3, '08:00:00', '14:00:00', '2021-12-26 20:21:40', NULL, NULL, 'sabtu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (7, 2, 3, '09:00:00', '16:00:00', '2021-12-26 20:22:10', NULL, NULL, 'minggu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (8, 2, 3, '07:00:00', '14:00:00', '2021-12-26 20:22:44', NULL, NULL, 'rabu');

-- ----------------------------
-- Table structure for t_jadwal_dokter_tidak_rutin
-- ----------------------------
DROP TABLE IF EXISTS `t_jadwal_dokter_tidak_rutin`;
CREATE TABLE `t_jadwal_dokter_tidak_rutin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NULL DEFAULT NULL,
  `id_klinik` int(11) NULL DEFAULT NULL,
  `id_dokter` int(11) NULL DEFAULT NULL,
  `jam_mulai` time(0) NULL DEFAULT NULL,
  `jam_akhir` time(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `is_libur` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_jadwal_dokter_tidak_rutin
-- ----------------------------
INSERT INTO `t_jadwal_dokter_tidak_rutin` VALUES (1, '2021-12-27', 3, 1, '08:00:00', '15:00:00', '2021-12-26 20:26:41', NULL, NULL, NULL);
INSERT INTO `t_jadwal_dokter_tidak_rutin` VALUES (2, '2021-12-30', 3, 1, '07:00:00', '14:00:00', '2021-12-26 20:27:09', NULL, NULL, 1);
INSERT INTO `t_jadwal_dokter_tidak_rutin` VALUES (3, '2022-01-06', 3, 1, '07:00:00', '14:00:00', '2021-12-26 20:27:09', NULL, NULL, 1);

-- ----------------------------
-- Table structure for t_kamera
-- ----------------------------
DROP TABLE IF EXISTS `t_kamera`;
CREATE TABLE `t_kamera`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_reg` int(64) NULL DEFAULT NULL,
  `id_pasien` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_pegawai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_user_adm` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_kamera
-- ----------------------------

-- ----------------------------
-- Table structure for t_kamera_det
-- ----------------------------
DROP TABLE IF EXISTS `t_kamera_det`;
CREATE TABLE `t_kamera_det`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_t_kamera` int(64) NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `nama_gambar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `delete_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_kamera_det
-- ----------------------------

-- ----------------------------
-- Table structure for t_log_jadwal_dokter
-- ----------------------------
DROP TABLE IF EXISTS `t_log_jadwal_dokter`;
CREATE TABLE `t_log_jadwal_dokter`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dokter` int(32) NULL DEFAULT NULL,
  `id_klinik` int(32) NULL DEFAULT NULL,
  `color` varchar(24) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `create_at` datetime(0) NULL DEFAULT NULL,
  `create_by` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `modified_at` datetime(0) NULL DEFAULT NULL,
  `modified_by` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jam_mulai` time(0) NULL DEFAULT NULL,
  `jam_akhir` time(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_log_jadwal_dokter
-- ----------------------------
INSERT INTO `t_log_jadwal_dokter` VALUES (35, 1, 3, '#40E0D0', '2021-12-24', '2021-12-20 13:32:58', '3', NULL, NULL, '09:30:00', '13:30:00');
INSERT INTO `t_log_jadwal_dokter` VALUES (37, 1, 3, '#008000', '2021-12-21', '2021-12-20 13:34:57', '3', NULL, NULL, '07:00:00', '17:00:00');
INSERT INTO `t_log_jadwal_dokter` VALUES (38, 1, 3, '#008000', '2021-12-21', '2021-12-20 13:34:57', '3', NULL, NULL, '07:00:00', '17:00:00');
INSERT INTO `t_log_jadwal_dokter` VALUES (39, 1, 3, '#008000', '2021-12-21', '2021-12-20 13:34:57', '3', NULL, NULL, '07:00:00', '17:00:00');
INSERT INTO `t_log_jadwal_dokter` VALUES (40, 2, 3, '#0071c5', '2021-12-22', '2021-12-21 11:40:16', '3', NULL, NULL, '11:39:00', '11:39:00');
INSERT INTO `t_log_jadwal_dokter` VALUES (41, 1, 3, '#40E0D0', '2021-12-24', '2021-12-22 15:30:48', '3', NULL, NULL, '07:30:00', '20:30:00');
INSERT INTO `t_log_jadwal_dokter` VALUES (42, 1, 3, '#40E0D0', '2021-12-24', '2021-12-22 15:30:48', '3', NULL, NULL, '07:30:00', '20:30:00');
INSERT INTO `t_log_jadwal_dokter` VALUES (43, 1, 3, '#40E0D0', '2021-12-24', '2021-12-22 15:30:48', '3', NULL, NULL, '07:30:00', '20:30:00');
INSERT INTO `t_log_jadwal_dokter` VALUES (44, 1, 3, '#40E0D0', '2021-12-24', '2021-12-22 15:30:48', '3', NULL, NULL, '07:30:00', '20:30:00');

-- ----------------------------
-- Table structure for t_logistik
-- ----------------------------
DROP TABLE IF EXISTS `t_logistik`;
CREATE TABLE `t_logistik`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_reg` int(64) NULL DEFAULT NULL,
  `id_pasien` int(11) NULL DEFAULT NULL,
  `id_pegawai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_user_adm` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `keterangan_resep` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_logistik
-- ----------------------------
INSERT INTO `t_logistik` VALUES (1, 1, 5, '1', '2', '2021-12-30', 'oke', '2021-12-30 00:42:12', '2021-12-30 00:42:17', NULL);

-- ----------------------------
-- Table structure for t_logistik_det
-- ----------------------------
DROP TABLE IF EXISTS `t_logistik_det`;
CREATE TABLE `t_logistik_det`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_t_logistik` int(64) NULL DEFAULT NULL,
  `id_logistik` int(32) NULL DEFAULT NULL,
  `qty` int(32) NULL DEFAULT NULL,
  `harga` float(20, 2) NULL DEFAULT NULL,
  `subtotal` float(20, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_logistik_det
-- ----------------------------
INSERT INTO `t_logistik_det` VALUES (1, 1, 3, 3, 0.00, 0.00, '2021-12-30 00:42:12', NULL, NULL);

-- ----------------------------
-- Table structure for t_mutasi
-- ----------------------------
DROP TABLE IF EXISTS `t_mutasi`;
CREATE TABLE `t_mutasi`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `tanggal` date NULL DEFAULT NULL,
  `id_registrasi` int(64) NULL DEFAULT NULL,
  `id_jenis_trans` int(2) NULL DEFAULT NULL COMMENT 'id m_jenis_trans',
  `id_trans_flag` int(64) NULL DEFAULT NULL COMMENT 'id transaksi pada tabel transaksi di jenis transaksi terkait',
  `id_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `flag_transaksi` int(1) NULL DEFAULT NULL COMMENT '1: penerimaan, 2: pengeluaran',
  `total_honor_dokter` float(20, 2) NULL DEFAULT 0 COMMENT 'honor dokter',
  `total_penerimaan_gross` float(20, 2) NULL DEFAULT 0 COMMENT 'penerimaan keseluruhan (belum dikurangi honor dokter)',
  `total_penerimaan_nett` float(20, 2) NULL DEFAULT 0 COMMENT 'penerimaan klinik',
  `total_pengeluaran` float(20, 2) NULL DEFAULT 0 COMMENT 'pengeluaran, jika flag transaksi = 2',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_mutasi
-- ----------------------------
INSERT INTO `t_mutasi` VALUES (1, '2021-12-30', 1, 2, 1, '2', 1, 0.00, 2095000.00, 2095000.00, 0.00, '2021-12-30 00:41:49', '2021-12-30 00:42:02', NULL);
INSERT INTO `t_mutasi` VALUES (2, '2021-12-30', 1, 3, 1, '2', 1, 0.00, 100000.00, 100000.00, 0.00, '2021-12-30 00:42:30', NULL, NULL);
INSERT INTO `t_mutasi` VALUES (3, '2021-12-30', 5, 2, 2, '2', 1, 0.00, 130000.00, 130000.00, 0.00, '2021-12-30 00:42:57', '2021-12-30 00:43:03', NULL);
INSERT INTO `t_mutasi` VALUES (4, '2021-12-30', 5, 3, 2, '2', 1, 0.00, 100000.00, 100000.00, 0.00, '2021-12-30 00:43:10', NULL, NULL);
INSERT INTO `t_mutasi` VALUES (5, '2021-12-30', 6, 2, 3, '5', 1, 0.00, 130000.00, 130000.00, 0.00, '2021-12-30 00:46:08', '2021-12-30 00:46:12', NULL);
INSERT INTO `t_mutasi` VALUES (6, '2021-12-30', 6, 3, 3, '5', 1, 0.00, 450000.00, 450000.00, 0.00, '2021-12-30 00:46:25', NULL, NULL);
INSERT INTO `t_mutasi` VALUES (7, '2021-12-30', 2, 2, 4, '5', 1, 0.00, 240000.00, 240000.00, 0.00, '2021-12-30 00:47:44', '2021-12-30 00:47:50', NULL);
INSERT INTO `t_mutasi` VALUES (8, '2021-12-30', 3, 2, 5, '5', 1, 0.00, 345000.00, 345000.00, 0.00, '2021-12-30 00:48:11', '2021-12-30 00:48:15', NULL);
INSERT INTO `t_mutasi` VALUES (9, '2021-12-30', 4, 2, 6, '2', 1, 0.00, 370000.00, 370000.00, 0.00, '2021-12-30 00:50:09', '2021-12-30 00:50:14', NULL);
INSERT INTO `t_mutasi` VALUES (10, '2021-12-30', 1, 5, 1, '4', 2, 0.00, 0.00, 0.00, 0.00, '2021-12-30 00:58:56', NULL, NULL);
INSERT INTO `t_mutasi` VALUES (11, '2021-12-30', 5, 5, 2, '4', 2, 0.00, 0.00, 0.00, 0.00, '2021-12-30 01:01:11', NULL, NULL);
INSERT INTO `t_mutasi` VALUES (12, '2021-12-30', 6, 5, 3, '4', 2, 0.00, 0.00, 0.00, 0.00, '2021-12-30 01:04:20', NULL, NULL);
INSERT INTO `t_mutasi` VALUES (13, '2021-12-30', 6, 6, 3, '4', 2, 0.00, 0.00, 0.00, 30000.00, '2021-12-30 01:04:20', NULL, NULL);
INSERT INTO `t_mutasi` VALUES (14, '2021-12-30', 2, 5, 4, '3', 2, 0.00, 0.00, 0.00, 0.00, '2021-12-30 01:05:19', NULL, NULL);
INSERT INTO `t_mutasi` VALUES (15, '2021-12-30', 2, 6, 4, '3', 2, 0.00, 0.00, 0.00, 200000.00, '2021-12-30 01:05:19', NULL, NULL);
INSERT INTO `t_mutasi` VALUES (16, '2021-12-30', 3, 5, 5, '3', 2, 0.00, 0.00, 0.00, 0.00, '2021-12-30 01:05:52', NULL, NULL);
INSERT INTO `t_mutasi` VALUES (17, '2021-12-30', 3, 6, 5, '3', 2, 0.00, 0.00, 0.00, 150000.00, '2021-12-30 01:05:52', NULL, NULL);
INSERT INTO `t_mutasi` VALUES (18, '2021-12-30', 4, 5, 6, '3', 2, 0.00, 0.00, 0.00, 0.00, '2021-12-30 01:06:21', NULL, NULL);

-- ----------------------------
-- Table structure for t_mutasi_det
-- ----------------------------
DROP TABLE IF EXISTS `t_mutasi_det`;
CREATE TABLE `t_mutasi_det`  (
  `id` int(64) NOT NULL,
  `id_mutasi` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_trans_det_flag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'id transaksi pada tabel transaksi detail di transaksi terkait',
  `qty` int(32) NULL DEFAULT NULL,
  `harga` double(20, 2) NULL DEFAULT NULL,
  `subtotal` double(20, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_mutasi_det
-- ----------------------------
INSERT INTO `t_mutasi_det` VALUES (1, '1', '1', NULL, 95000.00, 95000.00, '2021-12-30 00:41:49', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (2, '1', '2', NULL, 2000000.00, 2000000.00, '2021-12-30 00:42:02', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (3, '2', '1', NULL, 100000.00, 100000.00, '2021-12-30 00:42:30', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (4, '3', '3', NULL, 80000.00, 80000.00, '2021-12-30 00:42:57', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (5, '3', '4', NULL, 50000.00, 50000.00, '2021-12-30 00:43:03', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (6, '4', '2', NULL, 100000.00, 100000.00, '2021-12-30 00:43:10', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (7, '5', '5', NULL, 50000.00, 50000.00, '2021-12-30 00:46:08', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (8, '5', '6', NULL, 80000.00, 80000.00, '2021-12-30 00:46:12', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (9, '6', '3', NULL, 450000.00, 450000.00, '2021-12-30 00:46:25', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (10, '7', '7', NULL, 120000.00, 120000.00, '2021-12-30 00:47:44', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (11, '7', '8', NULL, 120000.00, 120000.00, '2021-12-30 00:47:50', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (12, '8', '9', NULL, 95000.00, 95000.00, '2021-12-30 00:48:11', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (13, '8', '10', NULL, 250000.00, 250000.00, '2021-12-30 00:48:15', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (14, '9', '11', NULL, 120000.00, 120000.00, '2021-12-30 00:50:09', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (15, '9', '12', NULL, 250000.00, 250000.00, '2021-12-30 00:50:14', NULL, NULL);

-- ----------------------------
-- Table structure for t_odontogram
-- ----------------------------
DROP TABLE IF EXISTS `t_odontogram`;
CREATE TABLE `t_odontogram`  (
  `id_reg` int(34) NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id` int(34) NOT NULL AUTO_INCREMENT,
  `sebelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dua_belas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tiga_belas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `empat_belas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lima_belas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `enam_belas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tujuh_belas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delapan_belas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dua_satu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dua_dua` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dua_tiga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dua_empat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dua_lima` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dua_enam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dua_tujuh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dua_delapan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tiga_satu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tiga_dua` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tiga_tiga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tiga_empat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tiga_lima` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tiga_enam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tiga_tujuh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tiga_delapan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `empat_satu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `empat_dua` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `empat_tiga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `empat_empat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `empat_lima` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `empat_enam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `empat_tujuh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `empat_delapan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `occlusi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `torus_palatinus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `torus_mandibularis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `palatum` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `diastema` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan_diastema` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gigi_anomali` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan_gigi_anomali` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `d` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `m` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `f` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jumlah_foto` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jumlah_rontgen` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lain_lain` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `satuan_jumlah_foto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `satuan_jumlah_rontgen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_odontogram
-- ----------------------------

-- ----------------------------
-- Table structure for t_pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `t_pembayaran`;
CREATE TABLE `t_pembayaran`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_reg` int(11) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `id_user` int(11) NULL DEFAULT NULL,
  `disc_persen` float NULL DEFAULT NULL,
  `disc_rp` float(20, 2) NULL DEFAULT NULL,
  `disc_nilai` float(20, 2) NULL DEFAULT NULL,
  `total_bruto` float(20, 2) NULL DEFAULT NULL,
  `total_nett` float(20, 2) NULL DEFAULT NULL,
  `is_cash` int(1) NULL DEFAULT NULL COMMENT '1: tunai',
  `reff_trans_kredit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'kode refferensi jika transaksi non tunai (debit, transfer, etc)',
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `rupiah_bayar` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rupiah_kembali` float(20, 2) NULL DEFAULT NULL,
  `is_locked` int(1) NULL DEFAULT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_pembayaran
-- ----------------------------
INSERT INTO `t_pembayaran` VALUES (1, 1, '2021-12-30', 4, 0, 0.00, 0.00, 2195000.00, 2195000.00, NULL, '5', NULL, NULL, '2021-12-30 00:58:56', '2200000.00', 5000.00, 1, 'INV-202112-0001');
INSERT INTO `t_pembayaran` VALUES (2, 5, '2021-12-30', 4, 0, 0.00, 0.00, 230000.00, 230000.00, 1, NULL, NULL, NULL, '2021-12-30 01:01:11', '230000.00', 0.00, 1, 'INV-202112-0002');
INSERT INTO `t_pembayaran` VALUES (3, 6, '2021-12-30', 4, 0, 0.00, 0.00, 580000.00, 580000.00, NULL, NULL, NULL, NULL, '2021-12-30 01:04:20', '600000.00', 20000.00, 1, 'INV-202112-0003');
INSERT INTO `t_pembayaran` VALUES (4, 2, '2021-12-30', 3, 0, 0.00, 0.00, 240000.00, 240000.00, 1, NULL, NULL, NULL, '2021-12-30 01:05:19', '250000.00', 10000.00, 1, 'INV-202112-0004');
INSERT INTO `t_pembayaran` VALUES (5, 3, '2021-12-30', 3, 0, 0.00, 0.00, 345000.00, 345000.00, 1, NULL, NULL, NULL, '2021-12-30 01:05:52', '350000.00', 5000.00, 1, 'INV-202112-0005');
INSERT INTO `t_pembayaran` VALUES (6, 4, '2021-12-30', 3, 0, 0.00, 0.00, 370000.00, 370000.00, 1, NULL, NULL, NULL, '2021-12-30 01:06:21', '370000.00', 0.00, 1, 'INV-202112-0006');

-- ----------------------------
-- Table structure for t_perawatan
-- ----------------------------
DROP TABLE IF EXISTS `t_perawatan`;
CREATE TABLE `t_perawatan`  (
  `id` int(64) NOT NULL,
  `id_reg` int(64) NULL DEFAULT NULL,
  `id_pasien` int(11) NULL DEFAULT NULL,
  `id_pegawai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `anamnesa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_perawatan
-- ----------------------------
INSERT INTO `t_perawatan` VALUES (1, 1, 5, '1', '2021-12-30', '<p>1. oke</p>\n\n<p>2. mantap</p>\n', '2021-12-30 00:41:31', NULL, NULL);

-- ----------------------------
-- Table structure for t_registrasi
-- ----------------------------
DROP TABLE IF EXISTS `t_registrasi`;
CREATE TABLE `t_registrasi`  (
  `id` int(64) NOT NULL,
  `id_klinik` int(11) NULL DEFAULT NULL,
  `id_layanan` int(11) NOT NULL,
  `id_pasien` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_reg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_reg` date NULL DEFAULT NULL,
  `jam_reg` time(0) NULL DEFAULT NULL,
  `estimasi_selesai` time(0) NULL DEFAULT NULL,
  `id_pegawai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_asuransi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '1: Asuransi, null = umum',
  `umur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_pemetaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_asuransi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_asuransi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_pulang` int(1) NULL DEFAULT NULL COMMENT '1: Pulang, null = Masih DIrawat',
  `tanggal_pulang` date NULL DEFAULT NULL,
  `jam_pulang` time(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_registrasi
-- ----------------------------
INSERT INTO `t_registrasi` VALUES (1, 4, 0, '5', '000.000.000.001', '2021-12-29', '23:36:30', NULL, '1', NULL, '67', '5', NULL, NULL, 1, '2021-12-30', '00:42:35', '2021-12-29 23:37:11', '2021-12-30 00:42:35', NULL);
INSERT INTO `t_registrasi` VALUES (2, 3, 0, '1', '000.000.000.002', '2021-12-30', '00:26:15', NULL, '6', NULL, '36', '4', NULL, NULL, 1, '2021-12-30', '00:47:54', '2021-12-30 00:26:34', '2021-12-30 00:47:54', NULL);
INSERT INTO `t_registrasi` VALUES (3, 3, 0, '2', '000.000.000.003', '2021-12-30', '00:26:45', NULL, '6', NULL, '29', '4', NULL, NULL, 1, '2021-12-30', '00:48:20', '2021-12-30 00:26:52', '2021-12-30 00:48:20', NULL);
INSERT INTO `t_registrasi` VALUES (4, 3, 0, '6', '000.000.000.004', '2021-12-30', '00:26:00', NULL, '1', NULL, '0', '1', NULL, NULL, 1, '2021-12-30', '00:50:18', '2021-12-30 00:27:09', '2021-12-30 00:50:18', NULL);
INSERT INTO `t_registrasi` VALUES (5, 4, 0, '8', '000.000.000.005', '2021-12-30', '00:27:15', NULL, '1', NULL, '27', '4', NULL, NULL, 1, '2021-12-30', '00:43:20', '2021-12-30 00:27:36', '2021-12-30 00:43:20', NULL);
INSERT INTO `t_registrasi` VALUES (6, 4, 0, '10', '000.000.000.006', '2021-12-30', '00:27:45', NULL, '6', '1', '31', '4', 'BPJS', '18291829', 1, '2021-12-30', '00:46:31', '2021-12-30 00:28:00', '2021-12-30 00:46:31', NULL);

-- ----------------------------
-- Table structure for t_registrasi_old
-- ----------------------------
DROP TABLE IF EXISTS `t_registrasi_old`;
CREATE TABLE `t_registrasi_old`  (
  `id` int(64) NOT NULL,
  `id_klinik` int(11) NULL DEFAULT NULL,
  `id_pasien` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_reg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_reg` date NULL DEFAULT NULL,
  `jam_reg` time(0) NULL DEFAULT NULL,
  `id_pegawai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_asuransi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '1: Asuransi, null = umum',
  `umur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_pemetaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_asuransi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_asuransi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_pulang` int(1) NULL DEFAULT NULL COMMENT '1: Pulang, null = Masih DIrawat',
  `tanggal_pulang` date NULL DEFAULT NULL,
  `jam_pulang` time(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_registrasi_old
-- ----------------------------

-- ----------------------------
-- Table structure for t_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `t_role_menu`;
CREATE TABLE `t_role_menu`  (
  `id_menu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `add_button` int(1) NULL DEFAULT 0,
  `edit_button` int(1) NULL DEFAULT 0,
  `delete_button` int(1) NULL DEFAULT 0,
  INDEX `f_level_user`(`id_role`) USING BTREE,
  INDEX `id_menu`(`id_menu`) USING BTREE,
  CONSTRAINT `f_level_user` FOREIGN KEY (`id_role`) REFERENCES `m_role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_role_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `m_menu` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of t_role_menu
-- ----------------------------
INSERT INTO `t_role_menu` VALUES (1, 2, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (17, 2, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (18, 2, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (19, 2, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (1, 4, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (20, 4, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (21, 4, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (31, 4, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (37, 4, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (36, 4, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (38, 4, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (32, 4, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (1, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (6, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (9, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (13, 3, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (14, 3, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (24, 3, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (25, 3, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (17, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (18, 3, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (19, 3, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (35, 3, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (28, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (29, 3, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (31, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (37, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (34, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (1, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (6, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (11, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (12, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (9, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (13, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (14, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (24, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (25, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (26, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (39, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (10, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (7, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (8, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (15, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (16, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (27, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (17, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (18, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (19, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (31, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (37, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (34, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (36, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (38, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (32, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (33, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (2, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (4, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (3, 1, 1, 1, 1);

-- ----------------------------
-- Table structure for t_spam
-- ----------------------------
DROP TABLE IF EXISTS `t_spam`;
CREATE TABLE `t_spam`  (
  `id_t_spam` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_layanan` int(11) NULL DEFAULT NULL,
  `id_pegawai` int(11) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `jam` time(0) NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '0=proses, 1=selesai',
  `id_pasien` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_t_spam`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_spam
-- ----------------------------

-- ----------------------------
-- Table structure for t_tindakan
-- ----------------------------
DROP TABLE IF EXISTS `t_tindakan`;
CREATE TABLE `t_tindakan`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_reg` int(64) NULL DEFAULT NULL,
  `id_pasien` int(11) NULL DEFAULT NULL,
  `id_pegawai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_user_adm` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_tindakan
-- ----------------------------
INSERT INTO `t_tindakan` VALUES (1, 1, 5, '1', '2', '2021-12-30', '2021-12-30 00:41:49', NULL, NULL);
INSERT INTO `t_tindakan` VALUES (2, 5, 8, '1', '2', '2021-12-30', '2021-12-30 00:42:57', NULL, NULL);
INSERT INTO `t_tindakan` VALUES (3, 6, 10, '6', '5', '2021-12-30', '2021-12-30 00:46:08', NULL, NULL);
INSERT INTO `t_tindakan` VALUES (4, 2, 1, '6', '5', '2021-12-30', '2021-12-30 00:47:44', NULL, NULL);
INSERT INTO `t_tindakan` VALUES (5, 3, 2, '6', '5', '2021-12-30', '2021-12-30 00:48:11', NULL, NULL);
INSERT INTO `t_tindakan` VALUES (6, 4, 6, '1', '2', '2021-12-30', '2021-12-30 00:50:09', NULL, NULL);

-- ----------------------------
-- Table structure for t_tindakan_det
-- ----------------------------
DROP TABLE IF EXISTS `t_tindakan_det`;
CREATE TABLE `t_tindakan_det`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_t_tindakan` int(64) NULL DEFAULT NULL,
  `id_tindakan` int(32) NULL DEFAULT NULL,
  `gigi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` float(20, 2) NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `diskon_persen` int(11) NULL DEFAULT NULL,
  `diskon_nilai` float(20, 2) NULL DEFAULT NULL,
  `harga_bruto` float(20, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_tindakan_det
-- ----------------------------
INSERT INTO `t_tindakan_det` VALUES (1, 1, 1, '4', 95000.00, '', '2021-12-30 00:41:49', NULL, NULL, 5, 5000.00, 100000.00);
INSERT INTO `t_tindakan_det` VALUES (2, 1, 6, 'all', 2000000.00, '', '2021-12-30 00:42:02', NULL, NULL, 0, 0.00, 2000000.00);
INSERT INTO `t_tindakan_det` VALUES (3, 2, 4, 'all', 80000.00, '', '2021-12-30 00:42:57', NULL, NULL, 20, 20000.00, 100000.00);
INSERT INTO `t_tindakan_det` VALUES (4, 2, 2, 'all', 50000.00, '', '2021-12-30 00:43:03', NULL, NULL, 0, 0.00, 50000.00);
INSERT INTO `t_tindakan_det` VALUES (5, 3, 2, 'all', 50000.00, '', '2021-12-30 00:46:08', NULL, NULL, 0, 0.00, 50000.00);
INSERT INTO `t_tindakan_det` VALUES (6, 3, 4, 'all', 80000.00, '', '2021-12-30 00:46:12', NULL, NULL, 20, 20000.00, 100000.00);
INSERT INTO `t_tindakan_det` VALUES (7, 4, 5, '3', 120000.00, '', '2021-12-30 00:47:44', NULL, NULL, 0, 0.00, 120000.00);
INSERT INTO `t_tindakan_det` VALUES (8, 4, 5, '2', 120000.00, '', '2021-12-30 00:47:50', NULL, NULL, 0, 0.00, 120000.00);
INSERT INTO `t_tindakan_det` VALUES (9, 5, 1, '2', 95000.00, '', '2021-12-30 00:48:11', NULL, NULL, 5, 5000.00, 100000.00);
INSERT INTO `t_tindakan_det` VALUES (10, 5, 3, 'all', 250000.00, '', '2021-12-30 00:48:15', NULL, NULL, 0, 0.00, 250000.00);
INSERT INTO `t_tindakan_det` VALUES (11, 6, 5, '4', 120000.00, '', '2021-12-30 00:50:09', NULL, NULL, 0, 0.00, 120000.00);
INSERT INTO `t_tindakan_det` VALUES (12, 6, 3, 'all', 250000.00, '', '2021-12-30 00:50:14', NULL, NULL, 0, 0.00, 250000.00);

-- ----------------------------
-- Table structure for t_tindakanlab
-- ----------------------------
DROP TABLE IF EXISTS `t_tindakanlab`;
CREATE TABLE `t_tindakanlab`  (
  `id` int(64) NOT NULL,
  `id_reg` int(64) NULL DEFAULT NULL,
  `id_pasien` int(11) NULL DEFAULT NULL,
  `id_pegawai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_user_adm` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_tindakanlab
-- ----------------------------
INSERT INTO `t_tindakanlab` VALUES (1, 1, 5, '1', '2', '2021-12-30', '2021-12-30 00:42:30', NULL, NULL);
INSERT INTO `t_tindakanlab` VALUES (2, 5, 8, '1', '2', '2021-12-30', '2021-12-30 00:43:10', NULL, NULL);
INSERT INTO `t_tindakanlab` VALUES (3, 6, 10, '6', '5', '2021-12-30', '2021-12-30 00:46:25', NULL, NULL);

-- ----------------------------
-- Table structure for t_tindakanlab_det
-- ----------------------------
DROP TABLE IF EXISTS `t_tindakanlab_det`;
CREATE TABLE `t_tindakanlab_det`  (
  `id` int(64) NOT NULL,
  `id_t_tindakanlab` int(64) NULL DEFAULT NULL,
  `id_tindakan_lab` int(32) NULL DEFAULT NULL,
  `harga` float(20, 2) NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `diskon_persen` int(11) NULL DEFAULT NULL,
  `diskon_nilai` float(20, 2) NULL DEFAULT NULL,
  `harga_bruto` float(20, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_tindakanlab_det
-- ----------------------------
INSERT INTO `t_tindakanlab_det` VALUES (1, 1, 2, 100000.00, '', '2021-12-30 00:42:30', NULL, NULL, 0, 0.00, 100000.00);
INSERT INTO `t_tindakanlab_det` VALUES (2, 2, 2, 100000.00, '', '2021-12-30 00:43:10', NULL, NULL, 0, 0.00, 100000.00);
INSERT INTO `t_tindakanlab_det` VALUES (3, 3, 1, 450000.00, '', '2021-12-30 00:46:25', NULL, NULL, 10, 50000.00, 500000.00);

-- ----------------------------
-- Table structure for t_user_klinik
-- ----------------------------
DROP TABLE IF EXISTS `t_user_klinik`;
CREATE TABLE `t_user_klinik`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_klinik` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_user_klinik
-- ----------------------------
INSERT INTO `t_user_klinik` VALUES (3, '2', '4', '2021-12-11 09:49:31', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (4, '2', '3', '2021-12-11 09:49:31', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (5, '3', '3', '2021-12-12 20:43:12', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (7, '4', '4', '2021-12-19 10:15:58', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (8, '5', '4', '2021-12-30 00:45:20', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (9, '5', '3', '2021-12-30 00:45:20', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
