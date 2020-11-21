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

 Date: 22/11/2020 00:19:14
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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_data_medik
-- ----------------------------
INSERT INTO `m_data_medik` VALUES (1, '5', 'O', 'HYPERTENSI', '140/10', 1, 1, 1, 1, 1, 1, 0, NULL, 0, NULL, '2020-09-13 17:53:03', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (2, '6', 'AB', 'HYPERTENSI', '900/21', 1, 0, 0, 0, 1, 0, 1, 'kalpanax', 0, NULL, '2020-09-19 20:28:52', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (3, '7', 'O', 'HYPOTENSI', '8000/2', 1, 1, 1, 1, 1, 0, 1, 'kalpanax', 0, NULL, '2020-10-11 14:47:17', NULL, NULL);

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_jabatan
-- ----------------------------
INSERT INTO `m_jabatan` VALUES (1, 'Dokter Gigi', 'Dokter Gigi Spesialis', '2020-08-30 23:25:53', '2020-09-08 20:07:44', NULL);
INSERT INTO `m_jabatan` VALUES (2, 'Resepsionis', 'Resepsionis', '2020-08-30 23:25:53', NULL, NULL);
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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_jenis_trans
-- ----------------------------
INSERT INTO `m_jenis_trans` VALUES (1, 'logistik');
INSERT INTO `m_jenis_trans` VALUES (2, 'tindakan');
INSERT INTO `m_jenis_trans` VALUES (3, 'obat');

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_klinik
-- ----------------------------
INSERT INTO `m_klinik` VALUES (1, 'KLINIK TONG FANG', 'JALAN RAHASIA DI SURABAYA', 'KEL. RAHASIA', 'KEC. RAHASIA', 'SURABAYA', '60231', 'JAWA TIMUR', '078121981291', 'tongfangpanjang@gmail.com', '', 'DR. FENG HUO', '12671617182129', 'logo.jpeg', '2020-09-07 15:59:09', NULL, '2020-09-26 22:33:56');
INSERT INTO `m_klinik` VALUES (2, 'KLINIK TONG FANG', 'JALAN RAHASIA DI SURABAYA', 'KEL. RAHASIA', 'KEC. RAHASIA', 'SURABAYA', '60231', 'JAWA TIMUR', '12671617182129', 'tongfangpanjang@gmail.com', '', 'DR. FENG HUO', '12671617182129', 'logo.jpg', '2020-09-26 22:33:56', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_logistik
-- ----------------------------
INSERT INTO `m_logistik` VALUES (1, '001', 'Oskadon', 1000, '1500', 250, 1, NULL, '2020-10-11 14:44:42', NULL);
INSERT INTO `m_logistik` VALUES (2, '002', 'Masker tes', 1000, '2000', 5, 2, '2020-09-15 11:54:34', '2020-09-15 13:48:10', NULL);

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
INSERT INTO `m_menu` VALUES (2, 0, 'Setting (Administrator)', 'Setting', NULL, 'flaticon2-gear', 1, 1, 5, 0, 0, 0);
INSERT INTO `m_menu` VALUES (3, 2, 'Setting Menu', 'Setting Menu', 'set_menu', 'flaticon-grid-menu', 1, 2, 2, 1, 1, 1);
INSERT INTO `m_menu` VALUES (4, 2, 'Setting Role', 'Setting Role', 'set_role', 'flaticon-network', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (5, 2, 'bu thak ndogmu', 'aosasi', 'asas', '', 1, 2, 3, 1, 1, 1);
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
INSERT INTO `m_menu` VALUES (26, 9, 'Asuransi', 'Asuransi', 'master_asuransi', 'flaticon2-contract', 1, 3, 5, 1, 1, 1);
INSERT INTO `m_menu` VALUES (27, 10, 'Honor Dokter', 'Honor Dokter', 'honor_dokter', 'flaticon-coins', 1, 3, 5, 1, 1, 1);

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_pasien
-- ----------------------------
INSERT INTO `m_pasien` VALUES (5, 'LU.00.01', 'LUCAS', 'MANOKWARI', '1990-02-05', '38128121291219', 'L', 'PAPUA', 'CHEF PAPEDA', 'JALAN AKSJAKSJAKSJA', NULL, NULL, '0812131212121', 1, '2020-09-13 17:53:03', NULL, NULL);
INSERT INTO `m_pasien` VALUES (6, 'YO.00.01', 'YONO', 'surabaya', '2000-01-04', '1271827182718211', 'L', 'jawa', 'macul', 'asaa', '031281821218', NULL, '08121281921829', 1, '2020-09-19 20:28:52', NULL, NULL);
INSERT INTO `m_pasien` VALUES (7, 'AN.00.01', 'ANWAR', 'surabaya', '1990-03-03', '3578219291829119', 'L', 'bangladesh', 'BURUH PABRIK', 'jalan jalan', NULL, NULL, '081271927192', 1, '2020-10-11 14:47:17', NULL, NULL);

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_pegawai
-- ----------------------------
INSERT INTO `m_pegawai` VALUES ('1', '1', 'PEG-00001', 'Mad Rokim', 'Bulak Banteng 20-C', '1271872817', '712871872187', '2020-11-12 00:29:08', NULL, NULL, 1);
INSERT INTO `m_pegawai` VALUES ('2', '1', 'PEG-00002', 'Rudi Sedati', 'Perum Sedati Tambak Blok Z-39', '09', '', '2020-11-12 00:29:41', NULL, NULL, 1);

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of m_role
-- ----------------------------
INSERT INTO `m_role` VALUES (1, 'developer', 'Level Developer Role', 1);
INSERT INTO `m_role` VALUES (2, 'administrator', 'Level Administrator Role', 1);
INSERT INTO `m_role` VALUES (3, 'Staff Admin', 'Role Untuk Staff Admin', 1);

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
  PRIMARY KEY (`id_tindakan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_tindakan
-- ----------------------------
INSERT INTO `m_tindakan` VALUES (1, 'T001', 'Operasi', 100000, NULL, NULL, NULL);
INSERT INTO `m_tindakan` VALUES (2, 'T002', 'Penambalan Gigi Cuy', 50000, '2020-09-09 14:35:45', '2020-09-09 15:05:11', NULL);
INSERT INTO `m_tindakan` VALUES (3, 'T003', 'Pasang Gigi Beton', 250000, '2020-11-11 10:51:21', '2020-11-11 10:51:35', NULL);

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
INSERT INTO `m_user` VALUES ('1', 1, '1', 'USR-00001', 'admin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2020-11-21 19:52:23', 'user_default.png', '2020-09-06 20:18:00', '2020-11-21 19:52:23', NULL);
INSERT INTO `m_user` VALUES ('2', 2, '2', 'USR-00002', 'cek', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2020-09-14 00:37:31', 'user_default.png', '2020-09-06 20:18:00', '2020-09-14 00:37:31', NULL);
INSERT INTO `m_user` VALUES ('3', 1, '2', 'USR-00003', 'sugiono', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, NULL, 'sugiono-1599399152.jpg', '2020-09-06 20:18:00', '2020-09-06 20:32:32', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_diagnosa
-- ----------------------------
INSERT INTO `t_diagnosa` VALUES (1, 1, 7, '1', '1', '2020-11-21', '2020-11-21 21:12:54', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_diagnosa_det
-- ----------------------------
INSERT INTO `t_diagnosa_det` VALUES (1, 1, 4, 4, '2020-11-21 21:12:54', NULL, NULL);
INSERT INTO `t_diagnosa_det` VALUES (2, 1, 1, 1, '2020-11-21 21:13:02', NULL, NULL);

-- ----------------------------
-- Table structure for t_honor
-- ----------------------------
DROP TABLE IF EXISTS `t_honor`;
CREATE TABLE `t_honor`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_dokter` int(64) NULL DEFAULT NULL,
  `honor_visite` double(20, 2) NULL DEFAULT NULL,
  `tindakan_persen` int(3) NULL DEFAULT NULL,
  `tindakan_lab_persen` int(3) NULL DEFAULT NULL,
  `obat_persen` int(3) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_honor
-- ----------------------------
INSERT INTO `t_honor` VALUES (1, 1, 60000.00, 0, 20, 50, '2020-11-20 22:16:55', '2020-11-21 21:03:10', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_honor_dokter_lab
-- ----------------------------
INSERT INTO `t_honor_dokter_lab` VALUES (1, 2, 2, 30, '2020-11-19 22:26:07', NULL, NULL);
INSERT INTO `t_honor_dokter_lab` VALUES (2, 2, 1, 30, '2020-11-19 22:26:47', NULL, NULL);
INSERT INTO `t_honor_dokter_lab` VALUES (3, 1, 1, 30, '2020-11-19 22:27:27', NULL, '2020-11-20 00:00:23');
INSERT INTO `t_honor_dokter_lab` VALUES (4, 1, 2, 10, '2020-11-19 22:27:35', NULL, '2020-11-20 00:00:20');
INSERT INTO `t_honor_dokter_lab` VALUES (5, 1, 1, 10, '2020-11-20 00:00:29', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_honor_dokter_tindakan
-- ----------------------------
INSERT INTO `t_honor_dokter_tindakan` VALUES (1, 1, 2, 10, '2020-11-19 12:28:30', NULL, '2020-11-19 23:52:52');
INSERT INTO `t_honor_dokter_tindakan` VALUES (2, 2, 2, 10, '2020-11-19 12:31:05', NULL, NULL);
INSERT INTO `t_honor_dokter_tindakan` VALUES (3, 2, 3, 10, '2020-11-19 12:31:14', NULL, NULL);
INSERT INTO `t_honor_dokter_tindakan` VALUES (4, 2, 1, 10, '2020-11-19 12:31:23', NULL, NULL);
INSERT INTO `t_honor_dokter_tindakan` VALUES (5, 1, 3, 50, '2020-11-19 12:40:33', NULL, '2020-11-19 23:59:49');
INSERT INTO `t_honor_dokter_tindakan` VALUES (6, 1, 2, 40, '2020-11-19 23:59:55', NULL, NULL);
INSERT INTO `t_honor_dokter_tindakan` VALUES (7, 1, 1, 20, '2020-11-20 00:00:07', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_logistik
-- ----------------------------
INSERT INTO `t_logistik` VALUES (1, 1, 7, '1', '1', '2020-11-19', '', '2020-11-19 14:44:56', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_logistik_det
-- ----------------------------
INSERT INTO `t_logistik_det` VALUES (1, 1, 1, 1, 1500.00, 1500.00, '2020-11-19 14:44:56', NULL, NULL);

-- ----------------------------
-- Table structure for t_mutasi
-- ----------------------------
DROP TABLE IF EXISTS `t_mutasi`;
CREATE TABLE `t_mutasi`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `tanggal` date NULL DEFAULT NULL,
  `id_registrasi` int(64) NULL DEFAULT NULL,
  `id_jenis_trans` int(2) NULL DEFAULT NULL,
  `id_trans_flag` int(64) NULL DEFAULT NULL COMMENT 'id transaksi pada tabel transaksi di transaksi terkait',
  `id_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `flag_transaksi` int(1) NULL DEFAULT NULL COMMENT '1: penerimaan, 2: pengeluaran',
  `penerimaan_visite` float(20, 2) NULL DEFAULT NULL,
  `total_honor_dokter` float(20, 2) NULL DEFAULT NULL COMMENT 'total honor dokter (persentase honor dari penerimaan gross)',
  `total_penerimaan_gross` float(20, 2) NULL DEFAULT NULL COMMENT 'penerimaan visite, obat, tindakan',
  `total_penerimaan_nett` float(20, 2) NULL DEFAULT NULL COMMENT 'penerimaan klinik (sudah dikurangi diskon dan honor dokter)',
  `total_nilai_diskon` float(20, 2) NULL DEFAULT NULL COMMENT 'besaran diskon (dalam rupiah)',
  `total_pengeluaran` float(20, 2) NULL DEFAULT NULL COMMENT 'pengeluaran, jika flag transaksi = 2',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_mutasi
-- ----------------------------

-- ----------------------------
-- Table structure for t_mutasi_det
-- ----------------------------
DROP TABLE IF EXISTS `t_mutasi_det`;
CREATE TABLE `t_mutasi_det`  (
  `id` int(64) NOT NULL,
  `id_mutasi` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_jenis_trans` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'id m_jenis_trans',
  `id_trans_flag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'id transaksi pada tabel transaksi di transaksi terkait',
  `qty` int(32) NULL DEFAULT NULL,
  `harga` double(20, 2) NULL DEFAULT NULL,
  `subtotal` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_mutasi_det
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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_perawatan
-- ----------------------------
INSERT INTO `t_perawatan` VALUES (1, 1, 7, '1', '2020-11-21', '<p>panuan</p>\n', '2020-11-21 21:12:47', NULL, NULL);

-- ----------------------------
-- Table structure for t_registrasi
-- ----------------------------
DROP TABLE IF EXISTS `t_registrasi`;
CREATE TABLE `t_registrasi`  (
  `id` int(64) NOT NULL,
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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_registrasi
-- ----------------------------
INSERT INTO `t_registrasi` VALUES (1, '7', '000.000.000.001', '2020-11-19', '14:35:00', '1', NULL, '30', '4', NULL, NULL, NULL, NULL, NULL, '2020-11-19 14:36:07', NULL, NULL);

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
INSERT INTO `t_role_menu` VALUES (1, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (2, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (5, 3, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (1, 2, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (17, 2, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (18, 2, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (19, 2, 1, 1, 1);
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
INSERT INTO `t_role_menu` VALUES (2, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (4, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (3, 1, 1, 1, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_tindakan
-- ----------------------------
INSERT INTO `t_tindakan` VALUES (1, 1, 7, '1', '1', '2020-11-21', '2020-11-21 21:13:14', NULL, NULL);

-- ----------------------------
-- Table structure for t_tindakan_det
-- ----------------------------
DROP TABLE IF EXISTS `t_tindakan_det`;
CREATE TABLE `t_tindakan_det`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_t_tindakan` int(64) NULL DEFAULT NULL,
  `id_tindakan` int(32) NULL DEFAULT NULL,
  `gigi` int(32) NULL DEFAULT NULL,
  `harga` float(20, 2) NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_tindakan_det
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
