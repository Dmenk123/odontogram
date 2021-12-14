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

 Date: 14/12/2021 10:29:38
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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `m_data_medik` VALUES (1, '5', 'O', 'HYPERTENSI', '140/10', 1, 1, 1, 1, 1, 1, 0, NULL, 0, NULL, '2020-09-13 17:53:03', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (2, '6', 'AB', 'HYPERTENSI', '900/21', 1, 0, 0, 0, 1, 0, 1, 'kalpanax', 0, NULL, '2020-09-19 20:28:52', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (3, '7', 'O', 'HYPOTENSI', '8000/2', 1, 1, 1, 1, 1, 0, 1, 'kalpanax', 0, NULL, '2020-10-11 14:47:17', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (4, '1', 'O', 'HYPERTENSI', '140', 0, 0, 0, 0, 0, 0, 1, 'Minyak Angin', 1, 'Beras', '2021-12-12 20:35:53', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (5, '2', 'AB', 'HYPOTENSI', '20', 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, '2021-12-12 20:37:36', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (6, '3', 'A', 'NORMAL', '80', 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, '2021-12-12 20:38:59', NULL, NULL);

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
INSERT INTO `m_klinik` VALUES (3, 'SOFINE CABANG PUSAT', 'JL. SIMO JAWAR NO.35D', 'KUPANG KRAJAN', 'SAWAHAN', 'SURABAYA', '60281', 'JAWA TIMUR', '0822-2823-2675', 'as@as.com', '', 'ROY TAMARA', '0822-2823-2675', 'logo.PNG', '2021-11-30 23:21:35', '2021-12-12 01:02:41', NULL);
INSERT INTO `m_klinik` VALUES (4, 'CABANG 2', 'JL. CABANG 2', 'KEL 2', 'KEC 2', 'SURABAYA', '71872', 'JAWA TIMUR', '18912891829', 'asas@aass.com', '', 'ASASAS', '18912891829', 'cabang-21639246098.jpg', '2021-12-09 23:14:23', '2021-12-12 01:08:18', NULL);

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
  PRIMARY KEY (`id_laboratorium`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_laboratorium
-- ----------------------------
INSERT INTO `m_laboratorium` VALUES (1, 'L001', 'coba tes', 2000, NULL, NULL, NULL);
INSERT INTO `m_laboratorium` VALUES (2, 'L002', 'lalala', 100000, '2020-09-17 11:04:30', '2020-09-17 11:27:55', NULL);

-- ----------------------------
-- Table structure for m_layanan
-- ----------------------------
DROP TABLE IF EXISTS `m_layanan`;
CREATE TABLE `m_layanan`  (
  `id_layanan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_layanan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_layanan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `waktu_layanan` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_layanan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_layanan
-- ----------------------------
INSERT INTO `m_layanan` VALUES (1, 'LY-0001', 'Cabut Gigi', 'Ini Keterangan aja', '30', '2021-12-07 01:45:23', '2021-12-07 01:45:23', NULL);
INSERT INTO `m_layanan` VALUES (2, 'LY-0002', 'PASANG KAWAT GIGI', 'Pasang Kawat Gigi dengan menggunakan kawat baja berkualitas (tahan banting)', '20', '2021-12-07 01:46:19', NULL, NULL);

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
INSERT INTO `m_menu` VALUES (30, 9, 'Diskon', 'Diskon', 'master_diskon', 'flaticon2-contract', 1, 3, 5, 1, 1, 1);

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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_pasien
-- ----------------------------
INSERT INTO `m_pasien` VALUES (1, 'AN.1985.03.0001', 'ANDY', 'surabaya', '1985-03-02', '882712121881819', 'L', 'Pribumi', 'Wiraswasta', 'Jl. A Yuni 201 Surabaya', '03128128182', NULL, '071827182718', 1, '2021-12-12 20:35:53', NULL, NULL);
INSERT INTO `m_pasien` VALUES (2, 'AN.1992.02.0002', 'ANWAR', 'Magetan', '1992-02-14', '18219281928', 'L', 'Negrito', 'PNS', 'Jl. abcd 12', NULL, NULL, '182192819289', 1, '2021-12-12 20:37:36', NULL, NULL);
INSERT INTO `m_pasien` VALUES (3, 'NI.1997.08.0001', 'NINGSIH', 'Surabaya', '1997-08-14', '1821982919', 'P', 'Pinoy', 'TNI', 'Jl. 1kjakjaksj', NULL, NULL, '18291829182912', 1, '2021-12-12 20:38:59', NULL, NULL);

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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_pegawai
-- ----------------------------
INSERT INTO `m_pegawai` VALUES ('1', '1', 'PEG-00001', 'Dr. Roy', 'Bulak Banteng 20-C', '1271872817', '712871872187', '2020-11-12 00:29:08', NULL, NULL, 1);
INSERT INTO `m_pegawai` VALUES ('2', '1', 'PEG-00002', 'Drg. Ronald', 'Perum Sedati Tambak Blok Z-39', '1782781278', '17287182718', '2020-11-12 00:29:41', NULL, NULL, 1);
INSERT INTO `m_pegawai` VALUES ('3', '2', 'PEG-00003', 'Miss Tery', 'Jl. awauwiauwiauw', '19281928192812', '', '2021-12-12 20:41:58', NULL, NULL, 1);

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
  PRIMARY KEY (`id_tindakan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_tindakan
-- ----------------------------
INSERT INTO `m_tindakan` VALUES (1, 'T001', 'Operasi', 100000, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_tindakan` VALUES (2, 'T002', 'Pasang Kawat', 50000, '2020-09-09 14:35:45', '2020-09-09 15:05:11', NULL, 1, 1);
INSERT INTO `m_tindakan` VALUES (3, 'T003', 'Pasang Gigi Palsu', 250000, '2020-11-11 10:51:21', '2020-11-11 10:51:35', NULL, 1, 1);
INSERT INTO `m_tindakan` VALUES (4, '1004', 'Scaling', 100000, '2021-11-20 12:23:46', NULL, NULL, NULL, 1);

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
INSERT INTO `m_user` VALUES ('1', 1, '1', 'USR-00001', 'admin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-14 08:40:56', 'user_default.png', '2020-09-06 20:18:00', '2021-12-14 08:40:56', NULL);
INSERT INTO `m_user` VALUES ('2', 4, '1', 'USR-00002', 'drg_roy', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-14 08:41:19', 'drg-roy-1639131886.jpg', '2021-12-10 17:24:46', '2021-12-14 08:41:19', NULL);
INSERT INTO `m_user` VALUES ('3', 3, '3', 'USR-00003', 'admin_pusat', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-14 10:27:48', 'admin-pusat-1639316581.jpg', '2021-12-12 20:43:01', '2021-12-14 10:27:48', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_diagnosa
-- ----------------------------
INSERT INTO `t_diagnosa` VALUES (1, 2, 7, '1', '1', '2021-12-10', '2021-12-10 20:44:20', NULL, NULL);
INSERT INTO `t_diagnosa` VALUES (2, 1, 2, '1', '2', '2021-12-14', '2021-12-14 01:00:19', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_diagnosa_det
-- ----------------------------
INSERT INTO `t_diagnosa_det` VALUES (1, 1, 2, 41, '2021-12-10 20:44:20', NULL, NULL);
INSERT INTO `t_diagnosa_det` VALUES (2, 2, 1, 1, '2021-12-14 01:00:19', NULL, NULL);
INSERT INTO `t_diagnosa_det` VALUES (3, 2, 2, 1, '2021-12-14 01:00:25', NULL, NULL);

-- ----------------------------
-- Table structure for t_diskon
-- ----------------------------
DROP TABLE IF EXISTS `t_diskon`;
CREATE TABLE `t_diskon`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis_trans` int(11) NULL DEFAULT NULL,
  `persentase` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_honor
-- ----------------------------
INSERT INTO `t_honor` VALUES (1, 1, NULL, 40, NULL, NULL, '2021-12-04 14:38:28', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_logistik
-- ----------------------------
INSERT INTO `t_logistik` VALUES (1, 1, 2, '1', '2', '2021-12-14', NULL, '2021-12-14 10:04:30', NULL, NULL);
INSERT INTO `t_logistik` VALUES (2, NULL, NULL, NULL, '2', '2021-12-14', '3 x sehari', '2021-12-14 10:08:33', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_logistik_det
-- ----------------------------
INSERT INTO `t_logistik_det` VALUES (1, 1, 3, 12, 0.00, 0.00, '2021-12-14 10:04:30', NULL, NULL);
INSERT INTO `t_logistik_det` VALUES (2, 1, 4, 2, 0.00, 0.00, '2021-12-14 10:08:24', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_mutasi
-- ----------------------------
INSERT INTO `t_mutasi` VALUES (1, '2021-12-14', 1, 2, 1, '2', 1, 0.00, 340000.00, 340000.00, 0.00, '2021-12-14 09:07:53', '2021-12-14 09:08:05', NULL);
INSERT INTO `t_mutasi` VALUES (2, '2021-12-14', 1, 3, 1, '2', 1, 0.00, 100000.00, 100000.00, 0.00, '2021-12-14 10:26:28', NULL, NULL);

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
INSERT INTO `t_mutasi_det` VALUES (1, '1', '1', NULL, 85000.00, 85000.00, '2021-12-14 09:07:53', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (2, '1', '2', NULL, 212500.00, 212500.00, '2021-12-14 09:07:59', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (3, '1', '3', NULL, 42500.00, 42500.00, '2021-12-14 09:08:05', NULL, NULL);
INSERT INTO `t_mutasi_det` VALUES (4, '2', '1', NULL, 100000.00, 100000.00, '2021-12-14 10:26:28', NULL, NULL);

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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_pembayaran
-- ----------------------------

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
INSERT INTO `t_perawatan` VALUES (1, 1, 2, '1', '2021-12-14', '<p>1. Ketuhanan yang maha esa</p>\n\n<p>2. Kemanusiaan yang adil dan beradap</p>\n', '2021-12-14 00:48:55', NULL, NULL);

-- ----------------------------
-- Table structure for t_registrasi
-- ----------------------------
DROP TABLE IF EXISTS `t_registrasi`;
CREATE TABLE `t_registrasi`  (
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
INSERT INTO `t_registrasi` VALUES (1, 3, '2', '000.000.000.001', '2021-12-13', '21:41:45', '1', NULL, '29', '4', NULL, NULL, 1, '2021-12-14', '10:26:36', '2021-12-13 21:42:04', '2021-12-14 10:26:36', NULL);

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
INSERT INTO `t_role_menu` VALUES (1, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (17, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (18, 3, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (19, 3, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (28, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (29, 3, 1, 1, 1);
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
INSERT INTO `t_role_menu` VALUES (30, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (10, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (7, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (8, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (15, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (16, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (27, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (17, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (18, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (19, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (20, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (21, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (28, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (29, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (2, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (4, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (3, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (1, 4, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (20, 4, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (21, 4, 1, 1, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_spam
-- ----------------------------
INSERT INTO `t_spam` VALUES (1, 2, NULL, NULL, NULL, NULL, NULL, '2021-12-08 04:55:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `t_spam` VALUES (2, 2, NULL, NULL, NULL, NULL, NULL, '2021-12-08 05:03:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `t_spam` VALUES (3, 1, NULL, NULL, NULL, NULL, NULL, '2021-12-08 20:02:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `t_spam` VALUES (4, 0, 1, '2021-12-08', '23:00:00', '0', NULL, '2021-12-08 21:02:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `t_spam` VALUES (5, 0, 0, '2021-12-08', '01:13:00', '0', NULL, '2021-12-08 21:13:29', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `t_spam` VALUES (6, 1, 1, '2021-12-08', '02:13:00', '0', NULL, '2021-12-08 21:13:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `t_spam` VALUES (7, 2, 2, '2021-12-09', '15:46:00', '0', NULL, '2021-12-09 15:46:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `t_spam` VALUES (8, 1, 2, '2021-12-11', '07:51:00', '0', NULL, '2021-12-10 07:50:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `t_spam` VALUES (9, 2, 2, '2021-12-10', '08:15:00', '0', NULL, '2021-12-10 08:15:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `t_spam` VALUES (10, 1, 2, '2021-12-10', '19:45:00', '0', NULL, '2021-12-10 18:44:12', NULL, NULL);
INSERT INTO `t_spam` VALUES (11, 1, 1, '2021-12-10', '20:00:00', '0', NULL, '2021-12-10 20:01:02', NULL, NULL);
INSERT INTO `t_spam` VALUES (12, 1, 2, '2021-12-10', '22:13:00', '0', NULL, '2021-12-10 20:12:02', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_tindakan
-- ----------------------------
INSERT INTO `t_tindakan` VALUES (1, 1, 2, '1', '2', '2021-12-14', '2021-12-14 09:07:53', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_tindakan_det
-- ----------------------------
INSERT INTO `t_tindakan_det` VALUES (1, 1, 1, '4', 85000.00, '', '2021-12-14 09:07:53', NULL, NULL, 15, 15000.00, 100000.00);
INSERT INTO `t_tindakan_det` VALUES (2, 1, 3, 'all', 212500.00, '', '2021-12-14 09:07:59', NULL, NULL, 15, 37500.00, 250000.00);
INSERT INTO `t_tindakan_det` VALUES (3, 1, 2, 'all', 42500.00, '', '2021-12-14 09:08:05', NULL, NULL, 15, 7500.00, 50000.00);

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
INSERT INTO `t_tindakanlab` VALUES (1, 1, 2, '1', '2', '2021-12-14', '2021-12-14 10:26:28', NULL, NULL);

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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_tindakanlab_det
-- ----------------------------
INSERT INTO `t_tindakanlab_det` VALUES (1, 1, 2, 100000.00, '', '2021-12-14 10:26:28', NULL, NULL);

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
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_user_klinik
-- ----------------------------
INSERT INTO `t_user_klinik` VALUES (3, '2', '4', '2021-12-11 09:49:31', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (4, '2', '3', '2021-12-11 09:49:31', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (5, '3', '3', '2021-12-12 20:43:12', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
