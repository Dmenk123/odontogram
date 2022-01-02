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

 Date: 03/01/2022 00:53:06
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
  `id_pasien` int(11) NULL DEFAULT NULL,
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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pasien`(`id_pasien`) USING BTREE,
  CONSTRAINT `m_data_medik_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_data_medik
-- ----------------------------
INSERT INTO `m_data_medik` VALUES (1, 5, NULL, 'HYPERTENSI', '140/10', 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, '2020-09-13 17:53:03', '2022-01-02 22:21:31', NULL);
INSERT INTO `m_data_medik` VALUES (2, 6, 'AB', 'HYPERTENSI', '900/21', 1, 0, 0, 0, 1, 0, NULL, 1, 'kalpanax', 0, NULL, '2020-09-19 20:28:52', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (4, 1, 'O', 'HYPERTENSI', '140', 0, 0, 0, 0, 0, 0, 0, 1, 'Minyak Angin', 1, 'Beras', '2021-12-12 20:35:53', '2022-01-02 20:28:04', NULL);
INSERT INTO `m_data_medik` VALUES (5, 2, 'AB', 'HYPOTENSI', '20', 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, '2021-12-12 20:37:36', '2021-12-31 00:48:32', NULL);
INSERT INTO `m_data_medik` VALUES (6, 3, 'A', 'NORMAL', '80', 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, '2021-12-12 20:38:59', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (7, 4, '0', 'NORMAL', '80/90', 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, '2021-12-16 01:03:00', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (8, 5, 'O', 'HYPERTENSI', '14', 1, 1, 1, 0, 0, 0, NULL, 1, 'asas', 0, NULL, '2021-12-20 15:54:22', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (9, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, '2021-12-30 23:52:53', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (10, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2021-12-31 00:12:39', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (22, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2022-01-02 21:10:15', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (23, 2, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2022-01-02 22:05:54', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (24, 3, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2022-01-02 22:15:57', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (25, 4, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2022-01-02 22:17:51', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (26, 5, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2022-01-02 22:20:18', NULL, NULL);
INSERT INTO `m_data_medik` VALUES (27, 6, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2022-01-02 22:40:18', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_diagnosa
-- ----------------------------
INSERT INTO `m_diagnosa` VALUES (1, 'K.00.1', 'Karies Gigi Dong', '2020-09-07 08:18:56', NULL, '2022-01-02 11:43:36');
INSERT INTO `m_diagnosa` VALUES (2, 'K.00.2', 'Gigi Berlubang', '2020-09-07 10:24:36', NULL, '2022-01-02 11:43:30');
INSERT INTO `m_diagnosa` VALUES (3, 'K.00.3', 'Coba Diag', '2020-09-07 10:29:33', NULL, '2020-09-09 09:26:55');
INSERT INTO `m_diagnosa` VALUES (4, 'K.00.3', 'Boyok Linu', '2020-11-11 10:52:27', NULL, '2022-01-02 11:43:25');
INSERT INTO `m_diagnosa` VALUES (5, 'D-001', 'Pulpitis Reversible', '2022-01-01 17:19:53', NULL, '2022-01-02 11:43:20');
INSERT INTO `m_diagnosa` VALUES (6, 'D-002', 'Pulpitis Reversible', '2022-01-02 11:44:50', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (7, 'D-003', 'Pulpitis Irreversible', '2022-01-02 11:45:03', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (8, 'D-004', 'Nekrosis Pulpa Totalis', '2022-01-02 11:45:13', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (9, 'D-005', 'Nekrosis Pulpa Partialis', '2022-01-02 11:45:26', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (10, 'D-006', 'Abses Periapikal', '2022-01-02 11:45:37', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (11, 'D-007', 'GIngivitis Marginalis Akut', '2022-01-02 11:46:00', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (12, 'D-008', 'Gingivitis Marginalis Kronis', '2022-01-02 11:46:14', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (13, 'D-009', 'Periodontitis', '2022-01-02 11:46:29', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (14, 'D-010', 'Abses Gingival', '2022-01-02 11:47:14', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (15, 'D-011', 'Abses Periodontal', '2022-01-02 11:47:23', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (16, 'D-012', 'Epulis', '2022-01-02 11:47:34', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (17, 'D-013', 'Polip Gingiva', '2022-01-02 11:47:47', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (18, 'D-014', 'Polip Pulpa', '2022-01-02 11:47:58', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (19, 'D-015', 'Polip Jaringan Ikat', '2022-01-02 11:48:11', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (20, 'D-016', 'Persistensi', '2022-01-02 11:48:27', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (21, 'D-017', 'Impaksi', '2022-01-02 11:48:38', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (22, 'D-018', 'Partial Eruptio', '2022-01-02 11:48:49', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (23, 'D-019', 'Edentulous Ridge', '2022-01-02 11:49:17', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (24, 'D-020', 'Uneruptio', '2022-01-02 11:49:36', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (25, 'D-021', 'Teething Syndrome', '2022-01-02 11:49:45', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (26, 'D-022', 'Gangren Radiks', '2022-01-02 11:50:01', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (27, 'D-023', 'Ulkus Dekubitus', '2022-01-02 11:50:10', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (28, 'D-024', 'Dental Granuloma', '2022-01-02 11:50:25', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (29, 'D-025', 'Kista Periapikal', '2022-01-02 11:50:47', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (30, 'D-026', 'Traumatic Ulcer', '2022-01-02 11:51:03', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (31, 'D-027', 'Recurrent Aphthous Stomatitis', '2022-01-02 11:51:53', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (32, 'D-028', 'Eksostosis', '2022-01-02 11:52:07', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (33, 'D-029', 'Supernumerary Tooth', '2022-01-02 11:52:25', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (34, 'D-030', 'Maloklusi Klas I', '2022-01-02 11:52:44', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (35, 'D-031', 'Maloklusi Klas II', '2022-01-02 11:52:55', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (36, 'D-032', 'Maloklusi Klas III', '2022-01-02 11:53:05', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (37, 'D-033', 'Abnormal Frenulum Labialis', '2022-01-02 11:53:38', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (38, 'D-034', 'Abnormal Frenulum Lingualis', '2022-01-02 11:53:51', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (39, 'D-035', 'Resesi Gingiva', '2022-01-02 11:54:21', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (40, 'D-036', 'Luksasi', '2022-01-02 11:54:35', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (41, 'D-037', 'Normal / T.A.K', '2022-01-02 11:54:59', '2022-01-02 11:57:07', NULL);
INSERT INTO `m_diagnosa` VALUES (42, 'D-038', 'Perikoronitis', '2022-01-02 11:55:25', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (43, 'D-039', 'Mucocele', '2022-01-02 13:33:30', NULL, NULL);
INSERT INTO `m_diagnosa` VALUES (44, 'D-040', 'Fibroma', '2022-01-02 13:34:18', NULL, NULL);

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
INSERT INTO `m_jabatan` VALUES (3, 'Cleaning Service', 'Resik Resik Klinik', '2020-09-08 19:57:55', NULL, '2021-12-31 20:27:42');

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
  `token_wa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_klinik
-- ----------------------------
INSERT INTO `m_klinik` VALUES (3, 'SOFINE SIMO JAWAR', 'JL. SIMO JAWAR NO.35D', 'KUPANG KRAJAN', 'SAWAHAN', 'SURABAYA', '60281', 'JAWA TIMUR', '082228232675', 'Sofinedentalkf@gmail.com', '', 'ROY TAMARA', '0822-2823-2675', 'logo.PNG', '2021-11-30 23:21:35', '2022-01-01 14:29:17', NULL, 'kfhQFDo7oj7je2SUwrYj');
INSERT INTO `m_klinik` VALUES (4, 'SOFINE DRIYOREJO', 'BATU MULIA 12E / J6A2, KOTA BARU DRIYOREJO', 'PETIKEN', 'DRIYOREJO', 'GRESIK', '71872', 'JAWA TIMUR', '081280077092', 'asas@aass.com', '', 'DRG ROY TAMARA', '18912891829', 'cabang-21639246098.jpg', '2021-12-09 23:14:23', '2021-12-31 20:24:55', NULL, 'hFZeF4nJfKYZr9HbbYwt');

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
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_laboratorium
-- ----------------------------
INSERT INTO `m_laboratorium` VALUES (1, 'L001', 'Crown/Bridge PFM', 450000, NULL, '2022-01-02 12:29:04', NULL, 0);
INSERT INTO `m_laboratorium` VALUES (2, 'L002', 'Crown/Bridge Emax', 900000, '2020-09-17 11:04:30', '2022-01-02 12:29:18', NULL, 0);
INSERT INTO `m_laboratorium` VALUES (3, 'LAB-003', 'Crown/Bridge PFZ', 1100000, '2022-01-02 12:28:43', '2022-01-02 12:29:29', NULL, 0);
INSERT INTO `m_laboratorium` VALUES (4, 'LAB-004', 'Crown Zirconia Monolithic', 750000, '2022-01-02 12:30:04', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (5, 'LAB-005', 'Night Guard', 300000, '2022-01-02 12:33:56', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (6, 'LAB-006', 'Clear Retainer', 220000, '2022-01-02 12:34:09', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (7, 'LAB-007', 'GTSL Valplast', 200000, '2022-01-02 12:35:46', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (8, 'LAB-008', 'GTSL Vertex Thermosens', 250000, '2022-01-02 12:36:12', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (9, 'LAB-009', 'Anasir Gigi Valplast 1', 40000, '2022-01-02 12:40:38', '2022-01-02 12:41:25', NULL, 0);
INSERT INTO `m_laboratorium` VALUES (10, 'LAB-010', 'Anasir Gigi Valplast 2', 80000, '2022-01-02 12:40:57', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (11, 'LAB-011', 'Anasir Gigi Valplast 3', 120000, '2022-01-02 12:41:46', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (12, 'LAB-012', 'Anasir Gigi Valplast 4', 160000, '2022-01-02 12:42:03', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (13, 'LAB-013', 'Anasir Gigi Valplast 5', 200000, '2022-01-02 12:42:12', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (14, 'LAB-014', 'Anasir Gigi Valplast 6', 240000, '2022-01-02 12:42:33', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (15, 'LAB-015', 'Anasir Gigi Valplast 7', 280000, '2022-01-02 12:42:44', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (16, 'LAB-016', 'Anasir Gigi Valplast 8', 320000, '2022-01-02 12:43:13', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (17, 'LAB-017', 'Anasir Gigi Valplast 9', 360000, '2022-01-02 12:43:27', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (18, 'LAB-018', 'Anasir Gigi Valplast 10', 400000, '2022-01-02 12:43:45', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (19, 'LAB-019', 'Anasir Gigi Vertex Thermosens 1', 50000, '2022-01-02 12:44:07', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (20, 'LAB-020', 'Anasir Gigi Vertex Thermosens 2', 100000, '2022-01-02 12:45:57', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (21, 'LAB-021', 'Anasir Gigi Vertex Thermosens 3', 150000, '2022-01-02 12:46:08', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (22, 'LAB-022', 'Anasir Gigi Vertex Thermosens 4', 200000, '2022-01-02 12:46:17', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (23, 'LAB-023', 'Anasir Gigi Vertex Thermosens 5', 250000, '2022-01-02 12:46:31', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (24, 'LAB-024', 'Anasir Gigi Vertex Thermosens 6', 300000, '2022-01-02 12:46:41', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (25, 'LAB-025', 'Anasir Gigi Vertex Thermosens 7', 350000, '2022-01-02 12:46:53', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (26, 'LAB-026', 'Anasir Gigi Vertex Thermosens 8', 400000, '2022-01-02 12:47:06', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (27, 'LAB-027', 'Anasir Gigi Vertex Thermosens 9', 450000, '2022-01-02 12:47:18', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (28, 'LAB-028', 'Anasir Gigi Vertex Thermosens 10', 500000, '2022-01-02 12:47:28', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (29, 'LAB-029', 'Full Denture Akrilik 2 Rahang', 800000, '2022-01-02 12:47:56', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (30, 'LAB-030', 'Full Denture Akrilik 1 Rahang', 400000, '2022-01-02 12:48:20', '2022-01-02 12:48:42', NULL, 0);
INSERT INTO `m_laboratorium` VALUES (31, 'LAB-031', 'Inlay / Onlay / Overlay Metal', 100000, '2022-01-02 13:05:32', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (32, 'LAB-032', 'Inlay / Onlay / Overlay Emax', 800000, '2022-01-02 13:14:48', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (33, 'LAB-033', 'Veneer Indirect Emax', 900000, '2022-01-02 13:17:17', NULL, NULL, 0);
INSERT INTO `m_laboratorium` VALUES (34, 'LAB-034', 'Inlay / Onlay / Overlay PFM', 450000, '2022-01-02 13:19:20', NULL, NULL, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_layanan
-- ----------------------------
INSERT INTO `m_layanan` VALUES (1, 'LY-00001', 'CABUT GIGI', '1,6,7,8', '', '60', '2022-01-02 11:41:01', '2022-01-02 11:41:01', NULL, 'cabut_gigi');
INSERT INTO `m_layanan` VALUES (2, 'LY-00002', 'KAWAT GIGI', '1', '', '90', '2022-01-02 09:35:18', '2022-01-02 09:35:18', NULL, 'kawat_gigi');
INSERT INTO `m_layanan` VALUES (3, 'LY-00003', 'SCALING/PEMBERSIHAN KARANG GIGI', '6,7,8', '', '60', '2022-01-02 11:42:57', '2022-01-02 11:42:57', NULL, 'gigi_bersih');
INSERT INTO `m_layanan` VALUES (4, 'LY-00004', 'KONSULTASI', '1,2', NULL, '30', '2021-12-31 20:43:54', NULL, '2021-12-31 20:43:54', 'dokter');
INSERT INTO `m_layanan` VALUES (5, 'LY-00005', 'TAMBAL GIGI', '1,6,7,8', NULL, '60', '2021-12-30 20:08:00', NULL, NULL, 'tambal_gigi');
INSERT INTO `m_layanan` VALUES (6, 'LY-00006', 'KONTROL KAWAT GIGI', '1', 'kontrol kawat gigi', '30', '2022-01-02 20:56:51', '2021-12-30 19:35:16', NULL, 'kawat_gigi');
INSERT INTO `m_layanan` VALUES (7, 'LY-00007', 'SCALING & TAMBAL', '1,6,7,8', 'Paket :\r\n- Scaling\r\n- Tambal', '90', '2022-01-02 20:34:17', NULL, NULL, 'gigi_bersih');
INSERT INTO `m_layanan` VALUES (8, 'LY-00008', 'SCALING & CABUT', '1,6,7,8', 'Paket : \r\n- Scaling\r\n- Cabut', '90', '2022-01-02 20:34:20', NULL, NULL, 'gigi_bersih');
INSERT INTO `m_layanan` VALUES (9, 'LY-00009', 'PERAWATAN SALURAN AKAR', '1,6,7,8', '', '60', '2022-01-02 20:34:23', NULL, NULL, 'gigi_bersih');
INSERT INTO `m_layanan` VALUES (10, 'LY-00010', 'GIGI PALSU', '1', '', '60', '2022-01-02 20:34:26', NULL, NULL, 'gigi_bersih');
INSERT INTO `m_layanan` VALUES (11, 'LY-00011', 'KONTROL KAWAT GIGI', NULL, '', '30', '2022-01-02 20:34:28', NULL, '2021-12-30 19:52:19', 'gigi_bersih');
INSERT INTO `m_layanan` VALUES (12, 'LY-00012', 'LASER BLEACHING', '1', '', '90', '2022-01-02 20:34:32', '2022-01-02 11:42:00', NULL, 'gigi_bersih');
INSERT INTO `m_layanan` VALUES (13, 'LY-00013', 'VENEER', '1', '', '90', '2022-01-02 20:34:34', NULL, NULL, 'gigi_bersih');
INSERT INTO `m_layanan` VALUES (14, 'LY-00014', 'PEMBEDAHAN/OPERASI', '1', '', '120', '2022-01-02 20:34:37', '2022-01-02 11:41:36', NULL, 'gigi_bersih');
INSERT INTO `m_layanan` VALUES (15, 'LY-00015', 'KONTROL PEMBEDAHAN/OPERASI', '1', '', '30', '2022-01-02 20:34:39', NULL, NULL, 'gigi_bersih');

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
  PRIMARY KEY (`id_logistik`) USING BTREE,
  INDEX `id_jenis_logistik`(`id_jenis_logistik`) USING BTREE,
  CONSTRAINT `m_logistik_ibfk_1` FOREIGN KEY (`id_jenis_logistik`) REFERENCES `m_jenis_logistik` (`id_jenis_logistik`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_logistik
-- ----------------------------
INSERT INTO `m_logistik` VALUES (1, '001', 'Oskadon', 1000, '1500', 250, 1, NULL, '2020-10-11 14:44:42', '2021-12-13 21:38:49');
INSERT INTO `m_logistik` VALUES (2, '002', 'Masker tes', 1000, '2000', 5, 2, '2020-09-15 11:54:34', '2020-09-15 13:48:10', '2021-12-13 21:39:35');
INSERT INTO `m_logistik` VALUES (3, 'A-001', 'Parasetamol', 0, '', 500, 1, '2021-12-13 21:40:16', '2022-01-02 12:09:39', NULL);
INSERT INTO `m_logistik` VALUES (4, 'A-002', 'Puyer Bintang 7', 0, '0', 50, 1, '2021-12-13 21:41:12', NULL, '2022-01-02 12:07:25');
INSERT INTO `m_logistik` VALUES (5, 'L-003', 'Sanmol', 0, '', 500, 1, '2022-01-02 12:08:42', '2022-01-02 12:09:49', NULL);
INSERT INTO `m_logistik` VALUES (6, 'L-004', 'Amoxicilin', 0, '', 500, 1, '2022-01-02 12:09:16', '2022-01-02 12:10:50', NULL);
INSERT INTO `m_logistik` VALUES (7, 'L-005', 'Amoxan', 0, '0', 500, 1, '2022-01-02 12:11:04', NULL, NULL);
INSERT INTO `m_logistik` VALUES (8, 'L-006', 'Clindamycin', 0, '0', 500, 1, '2022-01-02 12:11:21', NULL, NULL);
INSERT INTO `m_logistik` VALUES (9, 'L-007', 'Prolic', 0, '0', 500, 1, '2022-01-02 12:11:57', NULL, NULL);
INSERT INTO `m_logistik` VALUES (10, 'L-008', 'Metronidazol', 0, '0', 500, 1, '2022-01-02 12:12:10', NULL, NULL);
INSERT INTO `m_logistik` VALUES (11, 'L-009', 'Trichodazol', 0, '0', 500, 1, '2022-01-02 12:12:59', NULL, NULL);
INSERT INTO `m_logistik` VALUES (12, 'L-010', 'Asam Mefenamat', 0, '0', 500, 1, '2022-01-02 12:13:17', NULL, NULL);
INSERT INTO `m_logistik` VALUES (13, 'L-011', 'Ponstan', 0, '0', 500, 1, '2022-01-02 12:13:26', NULL, NULL);
INSERT INTO `m_logistik` VALUES (14, 'L-012', 'Natrium DIklofenak', 0, '0', 500, 1, '2022-01-02 12:13:52', NULL, NULL);
INSERT INTO `m_logistik` VALUES (15, 'L-013', 'Voltadex', 0, '0', 500, 1, '2022-01-02 12:14:56', NULL, NULL);
INSERT INTO `m_logistik` VALUES (16, 'L-014', 'Lincomycin', 0, '0', 500, 1, '2022-01-02 12:15:07', NULL, NULL);
INSERT INTO `m_logistik` VALUES (17, 'L-015', 'Nolipo', 0, '0', 500, 1, '2022-01-02 12:15:17', NULL, NULL);
INSERT INTO `m_logistik` VALUES (18, 'L-016', 'Kalium Diklofenak', 0, '0', 500, 1, '2022-01-02 12:15:32', NULL, NULL);
INSERT INTO `m_logistik` VALUES (19, 'L-017', 'Cataflam', 0, '0', 500, 1, '2022-01-02 12:15:43', NULL, NULL);
INSERT INTO `m_logistik` VALUES (20, 'L-018', 'Analsik', 0, '0', 500, 1, '2022-01-02 12:15:52', NULL, NULL);
INSERT INTO `m_logistik` VALUES (21, 'L-019', 'Arcoxia', 0, '0', 500, 1, '2022-01-02 12:16:02', NULL, NULL);
INSERT INTO `m_logistik` VALUES (22, 'L-020', 'Becom C', 0, '0', 500, 1, '2022-01-02 12:16:14', NULL, NULL);
INSERT INTO `m_logistik` VALUES (23, 'L-021', 'Dexamethasone', 0, '0', 500, 1, '2022-01-02 12:17:00', NULL, NULL);
INSERT INTO `m_logistik` VALUES (24, 'L-022', 'Neurobion', 0, '0', 500, 1, '2022-01-02 12:17:45', NULL, NULL);
INSERT INTO `m_logistik` VALUES (25, 'L-023', 'Aloclair Plus Spray', 0, '0', 500, 1, '2022-01-02 12:19:32', NULL, NULL);
INSERT INTO `m_logistik` VALUES (26, 'L-024', 'Aloclair Gel', 0, '0', 500, 1, '2022-01-02 12:19:44', NULL, NULL);
INSERT INTO `m_logistik` VALUES (27, 'L-025', 'Cooling 5 Plus Spray', 0, '0', 500, 1, '2022-01-02 12:20:03', NULL, NULL);
INSERT INTO `m_logistik` VALUES (28, 'L-026', 'Povidone Iodine / Betadine Gargle', 0, '0', 500, 1, '2022-01-02 12:23:40', NULL, NULL);
INSERT INTO `m_logistik` VALUES (29, 'L-027', 'Chlorhexidine / Minosep Gargle', 0, '', 500, 1, '2022-01-02 12:24:02', '2022-01-02 12:25:10', NULL);
INSERT INTO `m_logistik` VALUES (30, 'L-028', 'Listerine', 0, '0', 500, 1, '2022-01-02 12:25:33', NULL, NULL);
INSERT INTO `m_logistik` VALUES (31, 'L-029', 'Methycobal', 0, '0', 500, 1, '2022-01-02 13:29:43', NULL, NULL);

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
INSERT INTO `m_menu` VALUES (40, 2, 'Setting Pesan', 'Setting Pesan', 'set_pesan', 'flaticon-whatsapp', 1, 2, 3, 1, 1, 1);
INSERT INTO `m_menu` VALUES (41, 9, 'Layanan', 'layanan', 'master_layanan', 'flaticon-businesswoman', 1, 3, 1, 1, 1, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_nontunai
-- ----------------------------
INSERT INTO `m_nontunai` VALUES (1, 'Ovo', NULL, NULL, '2022-01-02 13:24:47');
INSERT INTO `m_nontunai` VALUES (2, 'Debit', NULL, NULL, NULL);
INSERT INTO `m_nontunai` VALUES (3, 'Shopee', NULL, NULL, NULL);
INSERT INTO `m_nontunai` VALUES (4, 'Dana', NULL, NULL, '2022-01-02 13:24:56');

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
INSERT INTO `m_pasien` VALUES (1, 'NU.2022.01.0001', 'NURUL', 'Mataram', '2022-01-12', '12345', 'P', NULL, NULL, 'Jalan Bukit Golf M2/02', NULL, NULL, '1243545', 1, '2022-01-02 21:10:15', NULL, '2022-01-02 21:44:37', NULL);
INSERT INTO `m_pasien` VALUES (2, 'NA.2004.05.0001', 'NASWA YUANSYAH PUTRI', 'Jombang', '2004-05-06', '3517184505040002', 'P', NULL, NULL, 'Ngelom Rolak RT 01 RW 04', NULL, 'Ngelom Rolak RT 01 RW 04', '085161863602', 1, '2022-01-02 22:05:54', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (3, 'AY.1997.01.0001', 'AYU PARAMITHA', 'Surabaya', '1997-01-23', '3578306301970003', 'P', NULL, NULL, 'Pondok Benowo Indah blok FH - 02\r\nRT 04/RW12', NULL, 'Pondok Benowo Indah blok FH - 02\r\nRT 04/RW12', '081395555832', 1, '2022-01-02 22:15:57', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (4, 'RE.1993.04.0001', 'REZKY CAHYA PRADANA', 'Bekasi', '1993-04-25', '321602254930010', 'L', NULL, NULL, 'Pekuncen RT 02/RW03 ngawen sidayu gresik', NULL, 'Ruko rungkut makmur square blok C no 30', '081395555831', 1, '2022-01-02 22:17:51', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (5, 'NU.2007.03.0002', 'NUR FADILAH', 'Gresik', '1996-03-19', '3525135903960005', 'P', NULL, NULL, 'Setro RT 08/RW 04 menganti', NULL, NULL, '089676494551', 1, '2022-01-02 22:20:18', '2022-01-02 22:21:31', NULL, NULL);
INSERT INTO `m_pasien` VALUES (6, 'TE.2022.01.0001', 'TESTING', 'Disna', '2022-01-02', '3512140903940002', 'L', NULL, NULL, 'Alamat KTP', NULL, 'Alamat Domisili', '081216862095', 1, '2022-01-02 22:40:18', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for m_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `m_pegawai`;
CREATE TABLE `m_pegawai`  (
  `id` int(11) NOT NULL DEFAULT 1,
  `id_jabatan` int(11) NULL DEFAULT NULL,
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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_jabatan`(`id_jabatan`) USING BTREE,
  CONSTRAINT `m_pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `m_jabatan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_pegawai
-- ----------------------------
INSERT INTO `m_pegawai` VALUES (1, 1, 'PEG-00001', 'drg. Roy Tamara', 'Bulak Banteng 20-C', '1271872817', '712871872187', '2020-11-12 00:29:08', NULL, NULL, 1, 1);
INSERT INTO `m_pegawai` VALUES (2, 1, 'PEG-00002', 'Drg. Ronald', 'Perum Sedati Tambak Blok Z-39', '1782781278', '17287182718', '2020-11-12 00:29:41', NULL, '2021-12-31 06:07:32', 0, NULL);
INSERT INTO `m_pegawai` VALUES (3, 2, 'PEG-00003', 'Miss Tery', 'Jl. awauwiauwiauw', '19281928192812', '', '2021-12-12 20:41:58', NULL, NULL, 1, NULL);
INSERT INTO `m_pegawai` VALUES (4, 2, 'PEG-00004', 'Miss Tar', 'asalskalsk', '10210210290129', '', '2021-12-16 23:40:36', NULL, NULL, 1, NULL);
INSERT INTO `m_pegawai` VALUES (5, 3, 'PEG-00005', 'Suwanto Efendi', 'asasas', '121212', '12121', '2021-12-23 13:22:15', NULL, '2021-12-31 20:26:17', 1, NULL);
INSERT INTO `m_pegawai` VALUES (6, 1, 'PEG-00006', 'drg. Martin Andriastuti', 'Jl, akjskajskaj', '0781212812818', '', '2021-12-25 13:11:04', NULL, NULL, 1, NULL);
INSERT INTO `m_pegawai` VALUES (7, 1, 'PEG-00007', 'drg. Vita Sepfina', 'Jl. ini alamatnya', '08214235355', '', '2021-12-30 13:23:54', NULL, NULL, 1, NULL);
INSERT INTO `m_pegawai` VALUES (8, 1, 'PEG-00008', 'drg. Rauhansen Bosafino R', 'Jl. Ini alamatnya', '081232134244', '', '2021-12-30 13:36:44', NULL, NULL, 1, NULL);

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
INSERT INTO `m_pemetaan` VALUES (5, 'Lansia', 51, 80, '2020-11-19 14:35:37', '2021-12-31 20:26:50', NULL);

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
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_pesan_blash
-- ----------------------------
INSERT INTO `m_pesan_blash` VALUES (1, 'Terimakasih telah melakukan pendaftaran Kak #NAMA# di #KLINIK#. Selanjutnya anda akan menerima pesan Whatsapp dari team kami sebagai reminder.', 'personal', '2022-01-02 19:53:21', '2022-01-02 21:53:44', NULL);
INSERT INTO `m_pesan_blash` VALUES (3, 'Selamat Pagi, kami dari #KLINIK# memberitahukan bahwa hari ini kak #NAMA# ada jadwal kunjungan pukul #WAKTU#. Mohon untuk memberikan konfirmasi kehadiran dengan membalas WA ini. Terimakasih', 'broadcast', '2022-01-02 19:53:21', '2022-01-02 21:43:58', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 133 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_tindakan
-- ----------------------------
INSERT INTO `m_tindakan` VALUES (1, 'T001', 'Operasi', 100000, NULL, '2021-12-14 21:41:21', '2022-01-02 08:21:39', NULL, NULL, 5);
INSERT INTO `m_tindakan` VALUES (2, 'T002', 'Pasang Kawat', 50000, '2020-09-09 14:35:45', '2020-09-09 15:05:11', '2022-01-02 08:21:54', 1, 1, 0);
INSERT INTO `m_tindakan` VALUES (3, 'T003', 'Pasang Gigi Palsu', 250000, '2020-11-11 10:51:21', '2020-11-11 10:51:35', '2022-01-02 08:21:49', 1, 1, 0);
INSERT INTO `m_tindakan` VALUES (4, '1004', 'Scaling', 100000, '2021-11-20 12:23:46', '2021-12-14 21:39:35', '2022-01-02 08:21:59', NULL, 1, 20);
INSERT INTO `m_tindakan` VALUES (5, 'T005', 'Tambal Gigi', 120000, '2021-12-14 21:42:03', NULL, '2022-01-02 08:22:03', NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (6, 'T006', 'Bleaching', 3000000, '2021-12-16 23:33:11', '2021-12-16 23:38:58', '2022-01-02 08:21:45', NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (7, 'T007', 'Bracket Removal 1', 150000, '2022-01-02 08:45:58', '2022-01-02 08:50:00', NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (8, 'T008', 'Bracket Removal 2', 200000, '2022-01-02 08:46:14', '2022-01-02 08:49:37', NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (9, 'T009', 'Bracket Removal 3', 250000, '2022-01-02 08:46:30', '2022-01-02 08:50:23', NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (10, 'T010', 'Bracket Removal 4', 300000, '2022-01-02 08:46:46', '2022-01-02 08:50:46', NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (11, 'T011', 'Frenektomi 1', 1000000, '2022-01-02 08:51:40', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (12, 'T012', 'Frenektomi 2', 1500000, '2022-01-02 08:51:59', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (13, 'T013', 'Crown Removal', 300000, '2022-01-02 08:52:44', NULL, '2022-01-02 09:09:42', NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (14, 'T014', 'Devitalisasi Gigi', 200000, '2022-01-02 08:53:19', NULL, '2022-01-02 09:11:23', NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (15, 'T015', 'Eksisi Polip', 300000, '2022-01-02 08:53:39', '2022-01-02 08:56:20', '2022-01-02 09:11:27', NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (16, 'T016', 'PFM', 1500000, '2022-01-02 09:02:50', NULL, '2022-01-02 09:10:57', NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (17, 'T017', 'EMAX', 3000000, '2022-01-02 09:03:09', NULL, '2022-01-02 09:11:14', NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (18, 'T018', 'Zirconia', 3500000, '2022-01-02 09:03:34', NULL, '2022-01-02 09:11:02', NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (19, 'T019', 'Akrilik', 800000, '2022-01-02 09:04:37', NULL, '2022-01-02 09:09:12', 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (20, 'T020', 'Valplast', 1200000, '2022-01-02 09:04:59', NULL, '2022-01-02 09:11:06', 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (21, 'T021', 'Vertex Thermosens', 1500000, '2022-01-02 09:05:44', NULL, '2022-01-02 09:11:10', 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (22, 'T022', 'Crown Removal', 300000, '2022-01-02 09:12:34', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (23, 'T023', 'Devitalisasi Gigi', 200000, '2022-01-02 09:13:20', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (24, 'T024', 'Eksisi Polip', 300000, '2022-01-02 09:13:41', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (25, 'T025', 'Crown / Bridge PFM', 2000000, '2022-01-02 09:14:27', '2022-01-02 13:05:54', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (26, 'T026', 'Crown / Bridge Emax', 3000000, '2022-01-02 09:14:52', '2022-01-02 13:06:05', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (27, 'T027', 'Crown / Bridge PFZ', 3500000, '2022-01-02 09:15:19', '2022-01-02 13:06:13', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (28, 'T028', 'Gigi Tiruan Sebagian Lepasan Akrilik', 1000000, '2022-01-02 09:16:16', '2022-01-02 11:08:47', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (29, 'T029', 'Gigi Tiruan Sebagian Lepasan Valplast', 1200000, '2022-01-02 09:16:39', NULL, NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (30, 'T030', 'Gigi Tiruan Sebagian Lepasan Vertex Thermosens', 1500000, '2022-01-02 09:17:18', NULL, NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (31, 'T031', 'Konsultasi', 50000, '2022-01-02 09:17:44', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (32, 'T032', 'Laser Bleaching', 2000000, '2022-01-02 09:18:04', '2022-01-02 09:37:43', NULL, NULL, 1, 25);
INSERT INTO `m_tindakan` VALUES (33, 'T033', 'Night Guard', 1500000, '2022-01-02 09:18:40', NULL, NULL, 1, 1, 0);
INSERT INTO `m_tindakan` VALUES (34, 'T034', 'Pasak Fiber', 500000, '2022-01-02 09:19:09', '2022-01-02 09:19:52', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (35, 'T035', 'Reinsersi Crown / Bridge 1', 300000, '2022-01-02 09:20:22', '2022-01-02 13:06:35', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (36, 'T036', 'Inlay / Onlay / Overlay Metal', 1000000, '2022-01-02 09:39:51', '2022-01-02 13:18:29', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (37, 'T037', 'Inlay / Onlay / Overlay Emax', 3000000, '2022-01-02 09:40:12', '2022-01-02 11:31:29', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (38, 'T038', 'Inlay / Onlay / Overlay Zirconia', 3500000, '2022-01-02 09:40:51', NULL, '2022-01-02 13:17:40', 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (39, 'T039', 'Kawat Gigi Metal', 7500000, '2022-01-02 09:41:58', '2022-01-02 13:04:58', NULL, NULL, 1, 40);
INSERT INTO `m_tindakan` VALUES (40, 'T040', 'Cicilan Kawat Gigi', 500000, '2022-01-02 09:42:23', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (41, 'T041', 'DP Kawat Gigi', 1500000, '2022-01-02 09:43:33', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (42, 'T042', 'Kontrol Kawat 1', 100000, '2022-01-02 09:44:27', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (43, 'T043', 'Kontrol Kawat 2', 150000, '2022-01-02 09:44:39', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (44, 'T044', 'Kontrol Kawat 3', 200000, '2022-01-02 09:44:53', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (45, 'T045', 'Kontrol Kawat 4', 250000, '2022-01-02 09:45:10', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (46, 'T046', 'Kontrol Kawat 5', 300000, '2022-01-02 09:45:29', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (47, 'T047', 'Operasi Gigi Bungsu 1', 1500000, '2022-01-02 09:47:17', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (48, 'T048', 'Operasi Gigi Bungsu 2', 2000000, '2022-01-02 09:47:35', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (49, 'T049', 'Operasi Gigi Bungsu 3', 2500000, '2022-01-02 09:47:52', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (50, 'T050', 'Operasi Gigi Bungsu 4', 3000000, '2022-01-02 09:48:11', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (51, 'T051', 'Operasi Gigi Bungsu 5', 3500000, '2022-01-02 09:48:25', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (52, 'T052', 'Acc Orto Open Coil', 100000, '2022-01-02 09:50:54', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (53, 'T053', 'Acc Orto Crimpable Hook', 100000, '2022-01-02 09:51:23', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (54, 'T054', 'Acc Orto Elastic Orto', 50000, '2022-01-02 09:51:48', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (55, 'T055', 'Acc Orto Button', 100000, '2022-01-02 09:52:15', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (56, 'T056', 'Perawatan Saluran Akar 1', 300000, '2022-01-02 10:08:01', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (57, 'T057', 'Perawatan Saluran Akar 2', 400000, '2022-01-02 10:08:28', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (58, 'T058', 'Perawatan Saluran Akar 3', 500000, '2022-01-02 10:08:43', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (59, 'T059', 'Perawatan Saluran Akar 1 Visit', 2000000, '2022-01-02 10:09:08', '2022-01-02 10:48:19', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (60, 'T060', 'Veneer Direct', 500000, '2022-01-02 10:13:06', '2022-01-02 10:29:09', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (61, 'T061', 'Veneer Indirect Emax', 3000000, '2022-01-02 10:14:03', '2022-01-02 11:15:19', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (62, 'T062', 'Reinsersi Bracket Lama', 200000, '2022-01-02 10:22:54', '2022-01-02 10:23:10', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (63, 'T063', 'Reinsersi Bracket Baru', 250000, '2022-01-02 10:23:35', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (64, 'T064', 'Pengisian Saluran Akar 1', 300000, '2022-01-02 10:45:58', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (65, 'T065', 'Pengisian Saluran Akar 2', 400000, '2022-01-02 10:46:10', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (66, 'T066', 'Pencabutan Gigi Permanen 1', 250000, '2022-01-02 10:46:57', NULL, '2022-01-02 11:16:56', NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (67, 'T067', 'Pencabutan Gigi Permanen 1', 300000, '2022-01-02 10:47:32', '2022-01-02 11:17:16', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (68, 'T068', 'Pencabutan Gigi Permanen 2', 350000, '2022-01-02 10:51:31', '2022-01-02 11:18:17', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (69, 'T069', 'Pencabutan Gigi Permanen 3', 400000, '2022-01-02 10:51:51', '2022-01-02 11:18:26', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (70, 'T070', 'Pencabutan Gigi Permanen 4', 450000, '2022-01-02 10:52:02', '2022-01-02 11:18:57', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (71, 'T071', 'Pencabutan Gigi Permanen 5', 500000, '2022-01-02 10:52:32', '2022-01-02 11:19:07', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (72, 'T072', 'Pencabutan Gigi Sulung 1', 200000, '2022-01-02 10:52:59', '2022-01-02 11:19:23', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (73, 'T073', 'Pencabutan Gigi Sulung 2', 250000, '2022-01-02 10:53:15', '2022-01-02 11:19:36', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (74, 'T074', 'Clear Retainer', 1500000, '2022-01-02 10:53:58', NULL, NULL, 1, 1, 0);
INSERT INTO `m_tindakan` VALUES (75, 'T075', 'Promo Scaling Simo', 500000, '2022-01-02 10:54:32', '2022-01-02 11:21:43', NULL, NULL, 1, 80);
INSERT INTO `m_tindakan` VALUES (76, 'T076', 'Promo Scaling KBD', 400000, '2022-01-02 10:55:03', '2022-01-02 11:21:55', NULL, NULL, 1, 80);
INSERT INTO `m_tindakan` VALUES (77, 'T077', 'Promo Scaling Stain 1', 150000, '2022-01-02 10:55:35', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (78, 'T078', 'Promo Scaling Stain 2', 200000, '2022-01-02 10:55:51', NULL, NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (79, 'T079', 'Promo Scaling Behel 1', 200000, '2022-01-02 10:56:35', '2022-01-02 10:57:02', NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (80, 'T080', 'Promo Scaling Behel 2', 250000, '2022-01-02 10:56:49', '2022-01-02 10:57:14', NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (81, 'T081', 'Sterilisasi Pulpa I', 200000, '2022-01-02 10:57:48', '2022-01-02 13:07:49', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (82, 'T082', 'Tambalan Sementara', 200000, '2022-01-02 10:58:07', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (83, 'T083', 'Tambal Gigi Composite Estetik 1', 350000, '2022-01-02 10:59:54', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (84, 'T084', 'Tambal Gigi Composite Estetik 2', 400000, '2022-01-02 11:00:16', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (85, 'T085', 'Tambal Gigi Composite Estetik 3', 450000, '2022-01-02 11:00:40', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (86, 'T086', 'Tambal Gigi Composite Estetik 4', 500000, '2022-01-02 11:00:54', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (87, 'T087', 'Tambal Gigi Glassionomer 1', 300000, '2022-01-02 11:01:49', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (88, 'T088', 'Tambal Gigi Glassionomer 2', 350000, '2022-01-02 11:02:17', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (89, 'T089', 'Tambal Gigi Glassionomer 3', 400000, '2022-01-02 11:02:34', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (90, 'T090', 'Tambal Gigi Glassionomer 4', 450000, '2022-01-02 11:02:50', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (91, 'T091', 'Tambal Gigi Composite 1', 200000, '2022-01-02 11:03:43', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (92, 'T092', 'Tambal Gigi Composite 2', 250000, '2022-01-02 11:04:01', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (93, 'T093', 'Tambal Gigi Composite 3', 300000, '2022-01-02 11:04:10', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (94, 'T094', 'Tambal Gigi Composite Estetik 5', 550000, '2022-01-02 11:04:36', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (95, 'T095', 'Tambal Gigi Composite Estetik 6', 600000, '2022-01-02 11:04:51', '2022-01-02 11:05:13', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (96, 'T096', 'Tambal Gigi Composite Estetik 7', 650000, '2022-01-02 11:05:25', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (97, 'T097', 'Tambal Gigi Composite Estetik 8', 700000, '2022-01-02 11:05:40', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (98, 'T098', 'Liner 1', 50000, '2022-01-02 11:06:05', '2022-01-02 11:24:25', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (99, 'T099', 'Crown / Bridge Zirconia Monolithic', 2500000, '2022-01-02 11:07:40', '2022-01-02 13:08:47', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (100, 'T100', 'Anasir Gigi 1', 200000, '2022-01-02 11:09:20', NULL, NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (101, 'T101', 'Anasir Gigi 2', 400000, '2022-01-02 11:09:37', '2022-01-02 11:25:09', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (102, 'T102', 'Anasir Gigi 3', 600000, '2022-01-02 11:09:55', '2022-01-02 11:25:19', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (103, 'T103', 'Anasir Gigi 4', 800000, '2022-01-02 11:10:12', '2022-01-02 11:25:29', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (104, 'T104', 'Anasir Gigi 5', 1000000, '2022-01-02 11:10:38', '2022-01-02 11:25:54', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (105, 'T105', 'Anasir Gigi 6', 1200000, '2022-01-02 11:11:10', '2022-01-02 11:26:05', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (106, 'T106', 'Anasir Gigi 7', 1400000, '2022-01-02 11:11:24', '2022-01-02 11:26:39', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (107, 'T107', 'Anasir Gigi 8', 1600000, '2022-01-02 11:11:42', '2022-01-02 11:27:00', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (108, 'T108', 'Anasir Gigi 9', 1800000, '2022-01-02 11:11:56', '2022-01-02 11:27:10', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (109, 'T109', 'Anasir Gigi 10', 2000000, '2022-01-02 11:12:10', '2022-01-02 11:27:21', NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (110, 'T110', 'Veneer Indirect PFZ', 3500000, '2022-01-02 11:16:13', NULL, NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (111, 'T111', 'Pencabutan Gigi Sulung 3', 300000, '2022-01-02 11:20:01', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (112, 'T112', 'Promo Scaling Stain 3', 250000, '2022-01-02 11:21:07', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (113, 'T113', 'Promo Scaling Stain 4', 300000, '2022-01-02 11:21:26', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (114, 'T114', 'Promo Scaling Behel 3', 300000, '2022-01-02 11:22:18', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (115, 'T115', 'Tambal Gigi Glassionomer 5', 500000, '2022-01-02 11:23:14', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (116, 'T116', 'Liner 2', 100000, '2022-01-02 11:24:37', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (117, 'T117', 'Reinsersi Crown / Bridge 2', 350000, '2022-01-02 11:30:10', '2022-01-02 13:09:25', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (118, 'T118', 'Reinsersi Crown / Bridge 2', 350000, '2022-01-02 11:30:51', '2022-01-02 13:09:34', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (119, 'T119', 'Reinsersi Crown / Bridge 3', 400000, '2022-01-02 11:31:08', '2022-01-02 13:09:45', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (120, 'T120', 'DP Kawat Gigi Shopee', 500000, '2022-01-02 11:32:13', '2022-01-02 11:33:36', NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (121, 'T121', 'Kawat Gigi Ceramic', 10000000, '2022-01-02 11:37:33', NULL, NULL, NULL, 1, 30);
INSERT INTO `m_tindakan` VALUES (122, 'T122', 'Kawat Gigi Self Ligating', 20000000, '2022-01-02 11:38:57', NULL, NULL, NULL, 1, 15);
INSERT INTO `m_tindakan` VALUES (123, 'T123', 'Gigi Tiruan Penuh Akrilik 1 Rahang', 2500000, '2022-01-02 12:51:58', '2022-01-02 13:10:21', NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (124, 'T124', 'Gigi Tiruan Penuh Akrilik 2 Rahang', 5000000, '2022-01-02 12:52:16', '2022-01-02 13:10:36', NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (125, 'T125', 'DP Gigi Tiruan', 1000000, '2022-01-02 12:55:04', '2022-01-02 12:55:20', NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (126, 'T126', 'Pelunasan Gigi TIruan', 2000000, '2022-01-02 12:57:04', NULL, '2022-01-02 13:11:36', NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (127, 'T127', 'Pelunasan Kawat GIgi Shopee', 4080000, '2022-01-02 13:02:02', '2022-01-02 17:59:34', NULL, NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (128, 'T128', 'Pelunasan Kawat Gigi', 3000000, '2022-01-02 13:02:58', NULL, '2022-01-02 13:11:44', NULL, 1, 0);
INSERT INTO `m_tindakan` VALUES (129, 'T129', 'Sterilisasi Pulpa 2', 300000, '2022-01-02 13:08:08', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (130, 'T130', 'Inlay / Onlay / Overlay PFM', 2000000, '2022-01-02 13:18:49', NULL, NULL, 1, NULL, 0);
INSERT INTO `m_tindakan` VALUES (131, 'T131', 'Core Built Up 1', 200000, '2022-01-02 13:40:28', NULL, NULL, NULL, NULL, 0);
INSERT INTO `m_tindakan` VALUES (132, 'T132', 'Core Built Up 2', 300000, '2022-01-02 13:40:44', NULL, NULL, NULL, NULL, 0);

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user`  (
  `id` int(11) NOT NULL,
  `id_role` int(11) NULL DEFAULT NULL,
  `id_pegawai` int(11) NULL DEFAULT NULL,
  `kode_user` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'user_default.png',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pegawai`(`id_pegawai`) USING BTREE,
  INDEX `id_role`(`id_role`) USING BTREE,
  CONSTRAINT `m_user_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `m_user_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `m_pemetaan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES (1, 1, 1, 'USR-00001', 'admin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2022-01-02 23:06:43', 'user_default.png', '2020-09-06 20:18:00', '2022-01-02 23:06:43', NULL);
INSERT INTO `m_user` VALUES (2, 4, 1, 'USR-00002', 'drg_roy', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2022-01-02 16:28:37', 'drg-roy-.jpeg', '2021-12-10 17:24:46', '2022-01-02 16:28:37', NULL);
INSERT INTO `m_user` VALUES (3, 3, 3, 'USR-00003', 'admin_pusat', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2022-01-02 22:59:33', 'admin-pusat-1639316581.jpg', '2021-12-12 20:43:01', '2022-01-02 22:59:33', NULL);
INSERT INTO `m_user` VALUES (4, 3, 4, 'USR-00004', 'admin_cabang', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2022-01-02 23:02:07', 'admin-cabang-1639883750.jpg', '2021-12-19 10:15:50', '2022-01-02 23:02:07', NULL);
INSERT INTO `m_user` VALUES (5, 4, 6, 'USR-00005', 'drg_martin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2022-01-02 21:14:41', 'drg-martin-.jpeg', '2021-12-25 13:12:00', '2022-01-02 21:14:41', NULL);
INSERT INTO `m_user` VALUES (6, 4, 7, 'USR-00006', 'drg_vita', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-31 20:46:22', 'drg-vita-1640845499.jpeg', '2021-12-30 13:24:59', '2021-12-31 20:46:22', NULL);
INSERT INTO `m_user` VALUES (7, 4, 8, 'USR-00007', 'drg_rauhansen', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2022-01-02 23:07:48', 'drg-rauhansen-1640846267.jpeg', '2021-12-30 13:37:47', '2022-01-02 23:07:48', NULL);

-- ----------------------------
-- Table structure for t_diagnosa
-- ----------------------------
DROP TABLE IF EXISTS `t_diagnosa`;
CREATE TABLE `t_diagnosa`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_reg` int(64) NULL DEFAULT NULL,
  `id_pasien` int(11) NULL DEFAULT NULL,
  `id_pegawai` int(11) NULL DEFAULT NULL,
  `id_user_adm` int(11) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pasien`(`id_pasien`) USING BTREE,
  INDEX `id_pegawai`(`id_pegawai`) USING BTREE,
  INDEX `id_reg`(`id_reg`) USING BTREE,
  INDEX `id_user_adm`(`id_user_adm`) USING BTREE,
  CONSTRAINT `t_diagnosa_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_diagnosa_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_diagnosa_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_diagnosa_ibfk_4` FOREIGN KEY (`id_user_adm`) REFERENCES `m_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_diagnosa
-- ----------------------------
INSERT INTO `t_diagnosa` VALUES (4, 1, 1, 6, 5, '2022-01-02', '2022-01-02 21:12:36', NULL, NULL);

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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_diagnosa`(`id_diagnosa`) USING BTREE,
  INDEX `id_t_diagnosa`(`id_t_diagnosa`) USING BTREE,
  CONSTRAINT `t_diagnosa_det_ibfk_1` FOREIGN KEY (`id_diagnosa`) REFERENCES `m_diagnosa` (`id_diagnosa`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_diagnosa_det_ibfk_2` FOREIGN KEY (`id_t_diagnosa`) REFERENCES `t_diagnosa` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_diagnosa_det
-- ----------------------------
INSERT INTO `t_diagnosa_det` VALUES (7, 4, 29, 12, '2022-01-02 21:13:00', NULL, NULL);
INSERT INTO `t_diagnosa_det` VALUES (8, 4, 8, 11, '2022-01-02 21:14:01', NULL, NULL);
INSERT INTO `t_diagnosa_det` VALUES (9, 4, 17, 11, '2022-01-02 21:14:10', NULL, NULL);

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
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_diskon
-- ----------------------------

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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_dokter`(`id_dokter`) USING BTREE,
  CONSTRAINT `t_honor_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `m_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_honor
-- ----------------------------
INSERT INTO `t_honor` VALUES (1, 1, 0.00, 100, 0, 0, '2021-12-04 14:38:28', '2021-12-31 06:09:32', NULL, 0, 0);
INSERT INTO `t_honor` VALUES (2, 6, 0.00, 40, 0, 0, '2021-12-25 13:11:04', NULL, NULL, 0, 0);
INSERT INTO `t_honor` VALUES (3, 7, 0.00, 40, 0, 0, '2021-12-30 13:23:54', NULL, NULL, 0, 0);
INSERT INTO `t_honor` VALUES (4, 8, 0.00, 40, 0, 0, '2021-12-30 13:36:44', NULL, NULL, 0, 0);

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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_dokter`(`id_dokter`) USING BTREE,
  INDEX `id_klinik`(`id_klinik`) USING BTREE,
  CONSTRAINT `t_jadwal_dokter_rutin_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `m_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_jadwal_dokter_rutin_ibfk_2` FOREIGN KEY (`id_klinik`) REFERENCES `m_klinik` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_jadwal_dokter_rutin
-- ----------------------------
INSERT INTO `t_jadwal_dokter_rutin` VALUES (1, 1, 3, '07:00:00', '15:00:00', '2021-12-26 20:17:33', NULL, '2021-12-30 20:13:05', 'senin');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (2, 2, 3, '07:00:00', '14:00:00', '2021-12-26 20:19:26', NULL, '2021-12-30 20:13:09', 'selasa');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (3, 1, 3, '08:00:00', '12:00:00', '2021-12-26 20:20:08', NULL, '2021-12-30 20:13:11', 'rabu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (4, 1, 3, '09:00:00', '14:00:00', '2021-12-26 20:20:40', NULL, '2021-12-30 20:13:14', 'kamis');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (5, 2, 3, '07:00:00', '12:00:00', '2021-12-26 20:21:08', NULL, '2021-12-30 20:13:16', 'jumat');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (6, 1, 3, '08:00:00', '14:00:00', '2021-12-26 20:21:40', NULL, '2021-12-30 20:13:19', 'sabtu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (7, 2, 3, '09:00:00', '16:00:00', '2021-12-26 20:22:10', NULL, '2021-12-30 20:13:22', 'minggu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (8, 2, 3, '07:00:00', '14:00:00', '2021-12-26 20:22:44', NULL, '2021-12-30 20:13:24', 'rabu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (9, 1, 4, '15:00:00', '21:00:00', '2021-12-30 20:11:05', NULL, '2021-12-30 20:12:28', 'selasa');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (10, 1, 4, '15:00:00', '21:00:00', '2021-12-30 20:11:55', NULL, '2021-12-30 20:12:31', 'kamis');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (11, 1, 3, '15:00:00', '21:00:00', '2021-12-30 20:13:39', NULL, '2021-12-30 20:15:02', 'senin');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (12, 1, 3, '15:00:00', '21:00:00', '2021-12-30 20:13:57', NULL, NULL, 'kamis');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (13, 6, 3, '15:00:00', '19:00:00', '2021-12-30 20:14:34', NULL, NULL, 'jumat');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (14, 1, 3, '15:00:00', '21:00:00', '2021-12-30 20:15:24', NULL, NULL, 'selasa');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (15, 1, 3, '15:00:00', '21:00:00', '2021-12-30 20:15:24', NULL, '2021-12-30 20:15:37', 'selasa');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (16, 7, 3, '15:00:00', '19:00:00', '2021-12-30 20:16:13', NULL, NULL, 'senin');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (17, 7, 3, '14:00:00', '17:00:00', '2021-12-30 20:16:45', NULL, NULL, 'sabtu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (18, 8, 3, '15:00:00', '19:00:00', '2021-12-30 20:17:20', NULL, NULL, 'rabu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (19, 8, 4, '15:00:00', '21:00:00', '2021-12-30 20:20:16', NULL, '2022-01-02 23:00:38', 'senin');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (20, 7, 4, '15:00:00', '21:00:00', '2021-12-30 20:21:00', NULL, '2022-01-02 23:01:17', 'rabu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (21, 6, 4, '15:00:00', '21:00:00', '2021-12-30 20:22:21', NULL, '2022-01-02 23:00:43', 'selasa');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (22, 6, 4, '15:00:00', '21:00:00', '2021-12-30 20:23:04', NULL, '2022-01-02 23:00:48', 'kamis');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (23, 6, 4, '15:00:00', '21:00:00', '2021-12-30 20:23:24', NULL, '2022-01-02 23:00:52', 'sabtu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (24, 1, 4, '14:00:00', '21:00:00', '2021-12-30 20:23:46', NULL, '2022-01-02 23:01:32', 'jumat');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (26, 1, 4, '14:00:00', '21:00:00', '2021-12-31 13:41:18', NULL, '2021-12-31 14:03:14', 'jumat');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (27, 6, 4, '15:00:00', '20:00:00', '2021-12-31 13:41:50', NULL, '2021-12-31 13:43:35', 'selasa');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (28, 6, 4, '15:00:00', '21:00:00', '2021-12-31 13:43:28', NULL, '2021-12-31 14:03:29', 'selasa');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (29, 6, 4, '15:00:00', '21:00:00', '2021-12-31 13:45:29', NULL, '2021-12-31 14:03:33', 'kamis');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (30, 8, 4, '15:00:00', '19:00:00', '2022-01-01 17:17:48', NULL, '2022-01-02 23:01:00', 'senin');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (31, 6, 4, '15:00:00', '19:00:00', '2022-01-01 17:18:50', NULL, '2022-01-02 23:01:10', 'selasa');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (32, 7, 4, '15:00:00', '19:00:00', '2022-01-01 17:21:12', NULL, '2022-01-02 23:01:04', 'rabu');

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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_dokter`(`id_dokter`) USING BTREE,
  INDEX `id_klinik`(`id_klinik`) USING BTREE,
  CONSTRAINT `t_jadwal_dokter_tidak_rutin_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `m_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_jadwal_dokter_tidak_rutin_ibfk_2` FOREIGN KEY (`id_klinik`) REFERENCES `m_klinik` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_jadwal_dokter_tidak_rutin
-- ----------------------------
INSERT INTO `t_jadwal_dokter_tidak_rutin` VALUES (1, '2021-12-27', 3, 1, '08:00:00', '15:00:00', '2021-12-26 20:26:41', NULL, '2022-01-02 20:36:09', NULL);
INSERT INTO `t_jadwal_dokter_tidak_rutin` VALUES (2, '2021-12-30', 3, 1, '07:00:00', '14:00:00', '2021-12-26 20:27:09', NULL, '2022-01-02 20:36:09', 1);
INSERT INTO `t_jadwal_dokter_tidak_rutin` VALUES (3, '2022-01-06', 3, 1, '07:00:00', '14:00:00', '2021-12-26 20:27:09', NULL, '2022-01-02 20:36:09', 1);

-- ----------------------------
-- Table structure for t_kamera
-- ----------------------------
DROP TABLE IF EXISTS `t_kamera`;
CREATE TABLE `t_kamera`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_reg` int(64) NULL DEFAULT NULL,
  `id_pasien` int(11) NULL DEFAULT NULL,
  `id_pegawai` int(11) NULL DEFAULT NULL,
  `id_user_adm` int(11) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pasien`(`id_pasien`) USING BTREE,
  INDEX `id_pegawai`(`id_pegawai`) USING BTREE,
  INDEX `id_reg`(`id_reg`) USING BTREE,
  INDEX `id_user_adm`(`id_user_adm`) USING BTREE,
  CONSTRAINT `t_kamera_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_kamera_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_kamera_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_kamera_ibfk_4` FOREIGN KEY (`id_user_adm`) REFERENCES `m_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_t_kamera`(`id_t_kamera`) USING BTREE,
  CONSTRAINT `t_kamera_det_ibfk_1` FOREIGN KEY (`id_t_kamera`) REFERENCES `t_kamera` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_kamera_det
-- ----------------------------

-- ----------------------------
-- Table structure for t_log_aktifitas
-- ----------------------------
DROP TABLE IF EXISTS `t_log_aktifitas`;
CREATE TABLE `t_log_aktifitas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `aksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `new_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `old_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_user`(`id_user`) USING BTREE,
  CONSTRAINT `t_log_aktifitas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `m_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 132 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_log_aktifitas
-- ----------------------------
INSERT INTO `t_log_aktifitas` VALUES (1, 1, 'http://localhost/odontogram/data_pasien/delete_data?', 'HAPUS DATA PASIEN', NULL, 'null', '2022-01-01 18:33:36', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (2, 1, 'http://localhost/odontogram/data_pasien/delete_data?', 'HAPUS DATA PASIEN', NULL, 'null', '2022-01-01 18:33:46', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (3, 1, 'http://localhost/odontogram/data_pasien/delete_data?', 'HAPUS DATA PASIEN', NULL, '{\"id\":\"4\",\"no_rm\":\"YA.2012.02.0001\",\"nama\":\"ANDY WAN\",\"tempat_lahir\":\"surabaya\",\"tanggal_lahir\":\"1985-03-02\",\"nik\":\"882712121881819\",\"jenis_kelamin\":\"L\",\"suku\":null,\"pekerjaan\":null,\"alamat_rumah\":\"Jl. A Yuni 201 Surabaya\",\"telp_rumah\":null,\"alamat_kantor\":null,\"hp\":\"071827182718\",\"is_aktif\":\"1\",\"created_at\":\"2021-12-16 01:03:00\",\"updated_at\":\"2022-01-01 18:15:36\",\"deleted_at\":\"2022-01-01 18:33:46\",\"file_ktp\":null}', '2022-01-01 18:34:03', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (4, 1, 'http://localhost/odontogram/login/proses?', 'LOGIN', NULL, NULL, '2022-01-01 21:46:35', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (5, 1, 'http://localhost/odontogram/reg_pasien/simpan_data?', 'TAMBAH DATA REGISTRASI', '{\"id_pasien\":\"8\",\"tanggal_reg\":\"2022-01-01\",\"jam_reg\":\"22:08:00\",\"id_pegawai\":\"8\",\"is_asuransi\":null,\"nama_asuransi\":null,\"no_asuransi\":null,\"id_klinik\":\"3\",\"umur\":\"54\",\"id_pemetaan\":\"5\",\"id_layanan\":\"7\",\"id\":6,\"no_reg\":\"000.000.000.006\",\"created_at\":\"2022-01-01 22:08:21\"}', NULL, '2022-01-01 22:08:21', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (6, 1, 'http://localhost/odontogram/reg_pasien/simpan_data?', 'UBAH DATA REGISTRASI', '{\"id\":\"6\",\"id_pasien\":\"8\",\"tanggal_reg\":\"2022-01-01\",\"jam_reg\":\"22:20:00\",\"id_pegawai\":\"8\",\"is_asuransi\":null,\"nama_asuransi\":null,\"no_asuransi\":null,\"id_klinik\":\"3\",\"umur\":\"54\",\"id_pemetaan\":\"5\",\"id_layanan\":\"3\",\"updated_at\":\"2022-01-01 22:09:46\"}', '{\"id\":\"6\",\"id_klinik\":\"3\",\"id_layanan\":\"7\",\"id_pasien\":\"8\",\"no_reg\":\"000.000.000.006\",\"tanggal_reg\":\"2022-01-01\",\"jam_reg\":\"22:08:00\",\"estimasi_selesai\":null,\"id_pegawai\":\"8\",\"is_asuransi\":null,\"umur\":\"54\",\"id_pemetaan\":\"5\",\"nama_asuransi\":null,\"no_asuransi\":null,\"is_pulang\":null,\"tanggal_pulang\":null,\"jam_pulang\":null,\"created_at\":\"2022-01-01 22:08:21\",\"updated_at\":null,\"deleted_at\":null}', '2022-01-01 22:09:46', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (7, 1, 'http://localhost/odontogram/reg_pasien/delete_data?', 'HAPUS DATA REGISTRASI', NULL, '{\"id\":\"6\",\"id_klinik\":\"3\",\"id_layanan\":\"3\",\"id_pasien\":\"8\",\"no_reg\":\"000.000.000.006\",\"tanggal_reg\":\"2022-01-01\",\"jam_reg\":\"22:20:00\",\"estimasi_selesai\":null,\"id_pegawai\":\"8\",\"is_asuransi\":null,\"umur\":\"54\",\"id_pemetaan\":\"5\",\"nama_asuransi\":null,\"no_asuransi\":null,\"is_pulang\":null,\"tanggal_pulang\":null,\"jam_pulang\":null,\"created_at\":\"2022-01-01 22:08:21\",\"updated_at\":\"2022-01-01 22:09:46\",\"deleted_at\":null}', '2022-01-01 22:10:41', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (8, 1, 'http://localhost/odontogram/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-01 22:12:30', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (9, 5, 'http://localhost/odontogram/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-01 22:12:40', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (10, 5, 'http://localhost/odontogram/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-01 22:12:56', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (11, 1, 'http://localhost/odontogram/login/proses?', 'LOGIN', NULL, NULL, '2022-01-01 22:13:03', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (12, 1, 'http://localhost/odontogram/reg_pasien/simpan_data?', 'TAMBAH DATA REGISTRASI', '{\"id_pasien\":\"11\",\"tanggal_reg\":\"2022-01-01\",\"jam_reg\":\"22:13:15\",\"id_pegawai\":\"6\",\"is_asuransi\":null,\"nama_asuransi\":null,\"no_asuransi\":null,\"id_klinik\":\"4\",\"umur\":\"36\",\"id_pemetaan\":\"4\",\"id_layanan\":\"3\",\"id\":7,\"no_reg\":\"000.000.000.007\",\"created_at\":\"2022-01-01 22:13:40\"}', NULL, '2022-01-01 22:13:40', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (13, 1, 'http://localhost/odontogram/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-01 22:13:53', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (14, 5, 'http://localhost/odontogram/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-01 22:14:04', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (15, 5, 'http://localhost/odontogram/rekam_medik/simpan_form_anamnesa?', 'TAMBAH DATA ANAMNESA (REKAM MEDIK)', '{\"id_pasien\":\"11\",\"id_pegawai\":\"6\",\"id_reg\":\"7\",\"anamnesa\":\"<p>1. Lombok 1kg<\\/p>\\n\\n<p>2. Gula 2kg<\\/p>\\n\\n<p>3. micin 3 ons<\\/p>\\n\",\"id\":2,\"tanggal\":\"2022-01-01\",\"created_at\":\"2022-01-01 22:32:15\"}', NULL, '2022-01-01 22:32:15', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (16, 5, 'http://localhost/odontogram/rekam_medik/simpan_form_diagnosa?', 'TAMBAH DATA DIAGNOSA (REKAM MEDIK)', '{\"id_pasien\":\"11\",\"id_pegawai\":\"6\",\"id_reg\":\"7\",\"id_user_adm\":\"5\",\"tanggal\":\"2022-01-01\",\"created_at\":\"2022-01-01 22:39:11\"}', NULL, '2022-01-01 22:39:11', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (17, 5, 'http://localhost/odontogram/rekam_medik/simpan_form_diagnosa?', 'TAMBAH DATA DIAGNOSA DETAIL (REKAM MEDIK)', '{\"id_t_diagnosa\":\"3\",\"id_diagnosa\":\"4\",\"gigi\":\"3\",\"created_at\":\"2022-01-01 22:39:11\"}', NULL, '2022-01-01 22:39:11', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (18, 5, 'http://localhost/odontogram/rekam_medik/simpan_form_diagnosa?', 'TAMBAH DATA DIAGNOSA DETAIL (REKAM MEDIK)', '{\"id_t_diagnosa\":\"3\",\"id_diagnosa\":\"1\",\"gigi\":\"3\",\"created_at\":\"2022-01-01 22:42:07\"}', NULL, '2022-01-01 22:42:07', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (19, 5, 'http://localhost/odontogram/rekam_medik/delete_data_diagnosa_det?', 'HAPUS DATA DIAGNOSA DETAIL (REKAM MEDIK)', NULL, '{\"id\":\"6\",\"id_t_diagnosa\":\"3\",\"id_diagnosa\":\"1\",\"gigi\":\"3\",\"created_at\":\"2022-01-01 22:42:07\",\"updated_at\":null,\"deleted_at\":null}', '2022-01-01 22:43:54', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (20, 5, 'http://localhost/odontogram/rekam_medik/simpan_form_tindakan?', 'TAMBAH DATA TINDAKAN (REKAM MEDIK)', '{\"id\":5,\"id_pasien\":\"11\",\"id_pegawai\":\"6\",\"id_reg\":\"7\",\"id_user_adm\":\"5\",\"tanggal\":\"2022-01-01\",\"created_at\":\"2022-01-01 22:57:54\"}', NULL, '2022-01-01 22:57:54', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (21, 5, 'http://localhost/odontogram/rekam_medik/simpan_form_tindakan?', 'TAMBAH DATA TINDAKAN DETAIL (REKAM MEDIK)', '{\"id\":9,\"id_t_tindakan\":\"5\",\"id_tindakan\":\"1\",\"gigi\":\"5\",\"harga\":95000,\"diskon_persen\":\"5\",\"diskon_nilai\":5000,\"harga_bruto\":100000,\"keterangan\":\"\",\"created_at\":\"2022-01-01 22:57:54\"}', NULL, '2022-01-01 22:57:54', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (22, 5, 'http://localhost/odontogram/rekam_medik/simpan_form_tindakan?', 'TAMBAH DATA TINDAKAN DETAIL (REKAM MEDIK)', '{\"id\":10,\"id_t_tindakan\":\"5\",\"id_tindakan\":\"4\",\"gigi\":\"all\",\"harga\":80000,\"diskon_persen\":\"20\",\"diskon_nilai\":20000,\"harga_bruto\":100000,\"keterangan\":\"\",\"created_at\":\"2022-01-01 22:58:00\"}', NULL, '2022-01-01 22:58:00', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (23, 5, 'http://localhost/odontogram/rekam_medik/delete_data_tindakan_det?', 'HAPUS DATA TINDAKAN DETAIL (REKAM MEDIK)', NULL, '{\"id\":\"9\",\"id_t_tindakan\":\"5\",\"id_tindakan\":\"1\",\"gigi\":\"5\",\"harga\":\"95000.00\",\"keterangan\":\"\",\"created_at\":\"2022-01-01 22:57:54\",\"updated_at\":null,\"deleted_at\":null,\"diskon_persen\":\"5\",\"diskon_nilai\":\"5000.00\",\"harga_bruto\":\"100000.00\",\"id_reg\":\"7\",\"id_pegawai\":\"6\"}', '2022-01-01 22:58:52', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (24, 5, 'http://localhost/odontogram/rekam_medik/simpan_form_logistik?', 'TAMBAH DATA LOGISTIK (REKAM MEDIK)', '{\"id\":2,\"id_pasien\":\"11\",\"id_pegawai\":\"6\",\"id_reg\":\"7\",\"id_user_adm\":\"5\",\"tanggal\":\"2022-01-01\",\"created_at\":\"2022-01-01 23:06:42\"}', NULL, '2022-01-01 23:06:42', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (25, 5, 'http://localhost/odontogram/rekam_medik/simpan_form_logistik?', 'TAMBAH DATA LOGISTIK DETAIL (REKAM MEDIK)', '{\"id\":2,\"id_t_logistik\":\"2\",\"id_logistik\":\"3\",\"qty\":\"6\",\"harga\":0,\"subtotal\":0,\"created_at\":\"2022-01-01 23:06:42\"}', NULL, '2022-01-01 23:06:42', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (26, 5, 'http://localhost/odontogram/rekam_medik/simpan_form_logistik?', 'TAMBAH DATA LOGISTIK DETAIL (REKAM MEDIK)', '{\"id\":3,\"id_t_logistik\":\"2\",\"id_logistik\":\"3\",\"qty\":\"6\",\"harga\":0,\"subtotal\":0,\"created_at\":\"2022-01-01 23:06:43\"}', NULL, '2022-01-01 23:06:43', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (27, 5, 'http://localhost/odontogram/rekam_medik/simpan_form_logistik?', 'TAMBAH DATA LOGISTIK DETAIL (REKAM MEDIK)', '{\"id\":4,\"id_t_logistik\":\"2\",\"id_logistik\":\"4\",\"qty\":\"6\",\"harga\":0,\"subtotal\":0,\"created_at\":\"2022-01-01 23:07:54\"}', NULL, '2022-01-01 23:07:54', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (28, 5, 'http://localhost/odontogram/rekam_medik/delete_data_logistik_det?', 'HAPUS DATA LOGISTIK DETAIL (REKAM MEDIK)', NULL, '{\"id\":\"4\",\"id_t_logistik\":\"2\",\"id_logistik\":\"4\",\"qty\":\"6\",\"harga\":\"0.00\",\"subtotal\":\"0.00\",\"created_at\":\"2022-01-01 23:07:54\",\"updated_at\":null,\"deleted_at\":null,\"id_reg\":\"7\",\"id_pegawai\":\"6\"}', '2022-01-01 23:08:05', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (29, 5, 'http://localhost/odontogram/rekam_medik/save_odontogram?', 'TAMBAH DATA GAMBAR ODONTO (REKAM MEDIK)', '{\"gambar\":\"7.png\",\"id_reg\":\"7\"}', NULL, '2022-01-01 23:13:08', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (30, 5, 'http://localhost/odontogram/rekam_medik/save_odontogram?', 'UBAH DATA GAMBAR ODONTO (REKAM MEDIK)', '{\"gambar\":\"7.png\",\"id_reg\":\"7\"}', '{\"id_reg\":\"7\",\"gambar\":\"7.png\",\"id\":\"3\",\"sebelas\":null,\"dua_belas\":null,\"tiga_belas\":null,\"empat_belas\":null,\"lima_belas\":null,\"enam_belas\":null,\"tujuh_belas\":null,\"delapan_belas\":null,\"dua_satu\":null,\"dua_dua\":null,\"dua_tiga\":null,\"dua_empat\":null,\"dua_lima\":null,\"dua_enam\":null,\"dua_tujuh\":null,\"dua_delapan\":null,\"tiga_satu\":null,\"tiga_dua\":null,\"tiga_tiga\":null,\"tiga_empat\":null,\"tiga_lima\":null,\"tiga_enam\":null,\"tiga_tujuh\":null,\"tiga_delapan\":null,\"empat_satu\":null,\"empat_dua\":null,\"empat_tiga\":null,\"empat_empat\":null,\"empat_lima\":null,\"empat_enam\":null,\"empat_tujuh\":null,\"empat_delapan\":null,\"occlusi\":null,\"torus_palatinus\":null,\"torus_mandibularis\":null,\"palatum\":null,\"diastema\":null,\"keterangan_diastema\":null,\"gigi_anomali\":null,\"keterangan_gigi_anomali\":null,\"d\":null,\"m\":null,\"f\":null,\"jumlah_foto\":null,\"jumlah_rontgen\":null,\"lain_lain\":null,\"satuan_jumlah_foto\":null,\"satuan_jumlah_rontgen\":null}', '2022-01-01 23:13:45', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (31, 5, 'http://localhost/odontogram/rekam_medik/save_formulir_odonto?id_reg=7', 'UBAH DATA FORM ODONTO (REKAM MEDIK)', '{\"sebelas\":\"\",\"dua_belas\":\"\",\"tiga_belas\":\"\",\"empat_belas\":\"\",\"lima_belas\":\"\",\"enam_belas\":\"\",\"tujuh_belas\":\"\",\"delapan_belas\":\"\",\"dua_satu\":\"\",\"dua_dua\":\"\",\"dua_tiga\":\"\",\"dua_empat\":\"\",\"dua_lima\":\"\",\"dua_enam\":\"\",\"dua_tujuh\":\"\",\"dua_delapan\":\"\",\"tiga_satu\":\"\",\"tiga_dua\":\"\",\"tiga_tiga\":\"\",\"tiga_empat\":\"\",\"tiga_lima\":\"\",\"tiga_enam\":\"\",\"tiga_tujuh\":\"\",\"tiga_delapan\":\"\",\"empat_satu\":\"\",\"empat_dua\":\"\",\"empat_tiga\":\"\",\"empat_empat\":\"\",\"empat_lima\":\"\",\"empat_enam\":\"\",\"empat_tujuh\":\"\",\"empat_delapan\":\"\",\"occlusi\":\"\",\"torus_palatinus\":null,\"torus_mandibularis\":null,\"palatum\":\"\",\"diastema\":null,\"keterangan_diastema\":\"\",\"gigi_anomali\":null,\"keterangan_gigi_anomali\":\"\",\"lain_lain\":\"\",\"d\":\"\",\"m\":\"\",\"f\":\"\",\"jumlah_rontgen\":\"\",\"jumlah_foto\":\"\"}', '{\"id_reg\":\"7\",\"gambar\":\"7.png\",\"id\":\"3\",\"sebelas\":null,\"dua_belas\":null,\"tiga_belas\":null,\"empat_belas\":null,\"lima_belas\":null,\"enam_belas\":null,\"tujuh_belas\":null,\"delapan_belas\":null,\"dua_satu\":null,\"dua_dua\":null,\"dua_tiga\":null,\"dua_empat\":null,\"dua_lima\":null,\"dua_enam\":null,\"dua_tujuh\":null,\"dua_delapan\":null,\"tiga_satu\":null,\"tiga_dua\":null,\"tiga_tiga\":null,\"tiga_empat\":null,\"tiga_lima\":null,\"tiga_enam\":null,\"tiga_tujuh\":null,\"tiga_delapan\":null,\"empat_satu\":null,\"empat_dua\":null,\"empat_tiga\":null,\"empat_empat\":null,\"empat_lima\":null,\"empat_enam\":null,\"empat_tujuh\":null,\"empat_delapan\":null,\"occlusi\":null,\"torus_palatinus\":null,\"torus_mandibularis\":null,\"palatum\":null,\"diastema\":null,\"keterangan_diastema\":null,\"gigi_anomali\":null,\"keterangan_gigi_anomali\":null,\"d\":null,\"m\":null,\"f\":null,\"jumlah_foto\":null,\"jumlah_rontgen\":null,\"lain_lain\":null,\"satuan_jumlah_foto\":null,\"satuan_jumlah_rontgen\":null}', '2022-01-01 23:18:15', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (32, 5, 'http://localhost/odontogram/rekam_medik/simpan_form_kamera?', 'TAMBAH DATA X-RAY (REKAM MEDIK)', '{\"id_pasien\":\"11\",\"id_pegawai\":\"6\",\"id_reg\":\"7\",\"id_user_adm\":\"5\",\"tanggal\":\"2022-01-01\",\"created_at\":\"2022-01-01 23:20:21\"}', NULL, '2022-01-01 23:20:21', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (33, 5, 'http://localhost/odontogram/rekam_medik/simpan_form_kamera?', 'TAMBAH DATA X-RAY DETAIL (REKAM MEDIK)', '{\"id_t_kamera\":\"2\",\"keterangan\":\"k\",\"nama_gambar\":\"7_1154652277.jpg\",\"created_at\":\"2022-01-01 23:20:21\"}', NULL, '2022-01-01 23:20:21', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (34, 5, 'http://localhost/odontogram/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 08:05:00', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (35, 5, 'http://localhost/odontogram/rekam_medik/pulangkan_pasien?', 'REKAM MEDIK SELESAI', '{\"tanggal_pulang\":\"2022-01-02\",\"jam_pulang\":\"08:25:56\",\"is_pulang\":1,\"updated_at\":\"2022-01-02 08:25:56\",\"id\":\"7\"}', NULL, '2022-01-02 08:25:56', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (36, 5, 'http://localhost/odontogram/rekam_medik/batal_pulangkan_pasien?', 'PEMBATALAN REKAM MEDIK SELESAI', '{\"tanggal_pulang\":\"2022-01-02\",\"jam_pulang\":\"08:26:13\",\"is_pulang\":1,\"updated_at\":\"2022-01-02 08:26:13\",\"id\":\"7\"}', NULL, '2022-01-02 08:26:13', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (37, 5, 'http://localhost/odontogram/rekam_medik/pulangkan_pasien?', 'REKAM MEDIK SELESAI', '{\"tanggal_pulang\":\"2022-01-02\",\"jam_pulang\":\"08:26:38\",\"is_pulang\":1,\"updated_at\":\"2022-01-02 08:26:38\",\"id\":\"7\"}', NULL, '2022-01-02 08:26:38', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (38, 5, 'http://localhost/odontogram/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 08:26:48', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (39, 4, 'http://localhost/odontogram/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 08:27:01', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (40, 4, 'http://localhost/odontogram/pembayaran/simpan_data?', 'TAMBAH DATA PEMBAYARAN', '{\"id\":3,\"id_reg\":\"7\",\"tanggal\":\"2022-01-02\",\"id_user\":\"4\",\"disc_persen\":\"0\",\"disc_rp\":\"\",\"disc_nilai\":\"0\",\"total_bruto\":\"80000\",\"total_nett\":\"80000\",\"is_locked\":1,\"rupiah_bayar\":\"100000.00\",\"rupiah_kembali\":\"20000.00\",\"kode\":\"INV-202201-0001\",\"is_cash\":1,\"reff_trans_kredit\":null,\"created_at\":\"2022-01-02 09:29:51\"}', NULL, '2022-01-02 09:29:51', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (41, 4, 'http://localhost/odontogram/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 09:30:24', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (42, 1, 'http://localhost/odontogram/login/proses?', 'LOGIN', NULL, NULL, '2022-01-02 09:30:43', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (43, 1, 'http://localhost/odontogram/login/proses?', 'LOGIN', NULL, NULL, '2022-01-02 17:38:45', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (44, 1, 'http://localhost/odontogram/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 18:01:24', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (45, 4, 'http://localhost/odontogram/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 18:08:33', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (46, 4, 'http://localhost/odontogram/data_pasien/simpan_data?', 'TAMBAH DATA PASIEN', '{\"nama\":\"NUR CAHYONO\",\"nik\":\"19281928192812\",\"tempat_lahir\":\"SURABAYA\",\"tanggal_lahir\":\"1990-01-01\",\"jenis_kelamin\":\"L\",\"suku\":null,\"pekerjaan\":null,\"hp\":\"089612897848\",\"telp_rumah\":null,\"alamat_rumah\":\"JALAN JALAN\",\"alamat_kantor\":null,\"id\":13,\"no_rm\":\"NU.1990.01.0001\",\"created_at\":\"2022-01-02 18:13:46\",\"is_aktif\":1}', NULL, '2022-01-02 18:13:46', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (47, 4, 'http://localhost/odontogram/data_pasien/simpan_data?', 'TAMBAH DATA MEDIK', '{\"gol_darah\":\"Z\",\"tekanan_darah\":\"HYPERTENSI\",\"tekanan_darah_val\":\"2\",\"penyakit_jantung\":\"0\",\"diabetes\":\"0\",\"haemopilia\":\"0\",\"hepatitis\":\"0\",\"gastring\":\"0\",\"penyakit_lainnya\":\"0\",\"alergi_obat\":\"0\",\"alergi_obat_val\":null,\"alergi_makanan\":\"0\",\"alergi_makanan_val\":null,\"id\":17,\"id_pasien\":13,\"created_at\":\"2022-01-02 18:13:46\"}', NULL, '2022-01-02 18:13:46', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (48, 4, 'http://localhost/odontogram/reg_pasien/simpan_data?', 'TAMBAH DATA REGISTRASI', '{\"id_pasien\":\"13\",\"tanggal_reg\":\"2022-01-02\",\"jam_reg\":\"18:13:45\",\"id_pegawai\":\"1\",\"is_asuransi\":null,\"nama_asuransi\":null,\"no_asuransi\":null,\"id_klinik\":\"4\",\"umur\":\"32\",\"id_pemetaan\":\"4\",\"id_layanan\":\"1\",\"id\":8,\"no_reg\":\"000.000.000.008\",\"created_at\":\"2022-01-02 18:14:07\"}', NULL, '2022-01-02 18:14:07', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (49, 3, 'https://admin.sofineclinic.com/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 20:27:08', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (50, 1, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 20:27:20', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (51, 1, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 20:27:21', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (52, 3, 'https://admin.sofineclinic.com/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 20:27:39', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (53, 1, 'https://admin.sofineclinic.com/login/proses?', 'LOGIN', NULL, NULL, '2022-01-02 20:28:00', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (54, 3, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 20:29:36', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (55, 1, 'https://admin.sofineclinic.com/login/proses?', 'LOGIN', NULL, NULL, '2022-01-02 20:29:43', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (56, 3, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 20:29:55', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (57, 1, 'https://admin.sofineclinic.com/login/proses?', 'LOGIN', NULL, NULL, '2022-01-02 20:30:06', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (58, 1, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 20:31:49', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (59, 3, 'https://admin.sofineclinic.com/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 20:31:59', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (60, 1, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 20:35:49', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (61, 4, 'https://admin.sofineclinic.com/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 20:36:02', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (62, 4, 'https://admin.sofineclinic.com/data_pasien/simpan_data?', 'TAMBAH DATA PASIEN', '{\"nama\":\"NUR\",\"nik\":\"182918291289\",\"tempat_lahir\":\"hutan\",\"tanggal_lahir\":\"2012-02-02\",\"jenis_kelamin\":\"L\",\"suku\":null,\"pekerjaan\":null,\"hp\":\"089612897848\",\"telp_rumah\":null,\"alamat_rumah\":\"91829182\",\"alamat_kantor\":null,\"id\":16,\"no_rm\":\"NU.2012.02.0003\",\"created_at\":\"2022-01-02 20:37:04\",\"is_aktif\":1}', NULL, '2022-01-02 20:37:04', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (63, 4, 'https://admin.sofineclinic.com/data_pasien/simpan_data?', 'TAMBAH DATA MEDIK', '{\"gol_darah\":\"12\",\"tekanan_darah\":\"HYPOTENSI\",\"tekanan_darah_val\":\"12\",\"penyakit_jantung\":\"0\",\"diabetes\":\"0\",\"haemopilia\":\"0\",\"hepatitis\":\"0\",\"gastring\":\"0\",\"penyakit_lainnya\":\"0\",\"alergi_obat\":\"0\",\"alergi_obat_val\":null,\"alergi_makanan\":\"0\",\"alergi_makanan_val\":null,\"id\":20,\"id_pasien\":16,\"created_at\":\"2022-01-02 20:37:04\"}', NULL, '2022-01-02 20:37:04', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (64, 3, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 20:37:17', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (65, 4, 'https://admin.sofineclinic.com/reg_pasien/simpan_data?', 'TAMBAH DATA REGISTRASI', '{\"id_pasien\":\"16\",\"tanggal_reg\":\"2022-01-02\",\"jam_reg\":\"20:37:00\",\"id_pegawai\":\"1\",\"is_asuransi\":null,\"nama_asuransi\":null,\"no_asuransi\":null,\"id_klinik\":\"4\",\"umur\":\"9\",\"id_pemetaan\":\"2\",\"id_layanan\":\"5\",\"id\":13,\"no_reg\":\"000.000.000.013\",\"created_at\":\"2022-01-02 20:37:22\"}', NULL, '2022-01-02 20:37:22', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (66, 1, 'https://admin.sofineclinic.com/login/proses?', 'LOGIN', NULL, NULL, '2022-01-02 20:37:29', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (67, 4, 'https://admin.sofineclinic.com/data_pasien/simpan_data?', 'TAMBAH DATA PASIEN', '{\"nama\":\"RISKI\",\"nik\":\"0192018291829\",\"tempat_lahir\":\"surabaya\",\"tanggal_lahir\":\"2000-01-03\",\"jenis_kelamin\":\"L\",\"suku\":null,\"pekerjaan\":null,\"hp\":\"081338332158\",\"telp_rumah\":null,\"alamat_rumah\":\"kjskajsk\",\"alamat_kantor\":null,\"id\":17,\"no_rm\":\"RI.2000.01.0001\",\"created_at\":\"2022-01-02 20:39:49\",\"is_aktif\":1}', NULL, '2022-01-02 20:39:49', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (68, 4, 'https://admin.sofineclinic.com/data_pasien/simpan_data?', 'TAMBAH DATA MEDIK', '{\"gol_darah\":\"2\",\"tekanan_darah\":\"HYPOTENSI\",\"tekanan_darah_val\":\"1\",\"penyakit_jantung\":\"0\",\"diabetes\":\"0\",\"haemopilia\":\"0\",\"hepatitis\":\"0\",\"gastring\":\"0\",\"penyakit_lainnya\":\"0\",\"alergi_obat\":\"0\",\"alergi_obat_val\":null,\"alergi_makanan\":\"0\",\"alergi_makanan_val\":null,\"id\":21,\"id_pasien\":17,\"created_at\":\"2022-01-02 20:39:49\"}', NULL, '2022-01-02 20:39:49', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (69, 4, 'https://admin.sofineclinic.com/reg_pasien/simpan_data?', 'TAMBAH DATA REGISTRASI', '{\"id_pasien\":\"17\",\"tanggal_reg\":\"2022-01-02\",\"jam_reg\":\"20:39:45\",\"id_pegawai\":\"6\",\"is_asuransi\":null,\"nama_asuransi\":null,\"no_asuransi\":null,\"id_klinik\":\"4\",\"umur\":\"21\",\"id_pemetaan\":\"4\",\"id_layanan\":\"5\",\"id\":14,\"no_reg\":\"000.000.000.014\",\"created_at\":\"2022-01-02 20:40:10\"}', NULL, '2022-01-02 20:40:10', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (70, 4, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 20:44:34', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (71, 3, 'https://admin.sofineclinic.com/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 20:44:45', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (72, 3, 'https://admin.sofineclinic.com/reg_pasien/simpan_data?', 'TAMBAH DATA REGISTRASI', '{\"id_pasien\":\"17\",\"tanggal_reg\":\"2022-01-02\",\"jam_reg\":\"20:44:00\",\"id_pegawai\":\"1\",\"is_asuransi\":null,\"nama_asuransi\":null,\"no_asuransi\":null,\"id_klinik\":\"3\",\"umur\":\"21\",\"id_pemetaan\":\"4\",\"id_layanan\":\"5\",\"id\":15,\"no_reg\":\"000.000.000.015\",\"created_at\":\"2022-01-02 20:45:10\"}', NULL, '2022-01-02 20:45:10', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (73, 1, 'https://admin.sofineclinic.com/login/proses?', 'LOGIN', NULL, NULL, '2022-01-02 20:50:21', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (74, 1, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 20:53:44', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (75, 5, 'https://admin.sofineclinic.com/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 21:05:42', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (76, 5, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 21:07:33', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (77, 5, 'https://admin.sofineclinic.com/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 21:07:39', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (78, 5, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 21:10:37', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (79, 5, 'https://admin.sofineclinic.com/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 21:10:43', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (80, 5, 'https://admin.sofineclinic.com/rekam_medik/simpan_form_anamnesa?', 'TAMBAH DATA ANAMNESA (REKAM MEDIK)', '{\"id_pasien\":\"1\",\"id_pegawai\":\"6\",\"id_reg\":\"1\",\"anamnesa\":\"<p>pasien datang dengan keluhan gigi sakit ingin ditambal<\\/p>\\n\",\"id\":1,\"tanggal\":\"2022-01-02\",\"created_at\":\"2022-01-02 21:12:08\"}', NULL, '2022-01-02 21:12:08', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (81, 5, 'https://admin.sofineclinic.com/rekam_medik/simpan_form_diagnosa?', 'TAMBAH DATA DIAGNOSA (REKAM MEDIK)', '{\"id_pasien\":\"1\",\"id_pegawai\":\"6\",\"id_reg\":\"1\",\"id_user_adm\":\"5\",\"tanggal\":\"2022-01-02\",\"created_at\":\"2022-01-02 21:12:36\"}', NULL, '2022-01-02 21:12:36', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (82, 5, 'https://admin.sofineclinic.com/rekam_medik/simpan_form_diagnosa?', 'TAMBAH DATA DIAGNOSA DETAIL (REKAM MEDIK)', '{\"id_t_diagnosa\":\"4\",\"id_diagnosa\":\"10\",\"gigi\":\"11\",\"created_at\":\"2022-01-02 21:12:36\"}', NULL, '2022-01-02 21:12:36', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (83, 5, 'https://admin.sofineclinic.com/rekam_medik/simpan_form_diagnosa?', 'TAMBAH DATA DIAGNOSA DETAIL (REKAM MEDIK)', '{\"id_t_diagnosa\":\"4\",\"id_diagnosa\":\"29\",\"gigi\":\"12\",\"created_at\":\"2022-01-02 21:13:00\"}', NULL, '2022-01-02 21:13:00', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (84, 5, 'https://admin.sofineclinic.com/rekam_medik/simpan_form_diagnosa?', 'TAMBAH DATA DIAGNOSA DETAIL (REKAM MEDIK)', '{\"id_t_diagnosa\":\"4\",\"id_diagnosa\":\"8\",\"gigi\":\"11\",\"created_at\":\"2022-01-02 21:14:01\"}', NULL, '2022-01-02 21:14:01', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (85, 1, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 21:14:05', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (86, 5, 'https://admin.sofineclinic.com/rekam_medik/simpan_form_diagnosa?', 'TAMBAH DATA DIAGNOSA DETAIL (REKAM MEDIK)', '{\"id_t_diagnosa\":\"4\",\"id_diagnosa\":\"17\",\"gigi\":\"11\",\"created_at\":\"2022-01-02 21:14:10\"}', NULL, '2022-01-02 21:14:10', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (87, 5, 'https://admin.sofineclinic.com/rekam_medik/delete_data_diagnosa_det?', 'HAPUS DATA DIAGNOSA DETAIL (REKAM MEDIK)', NULL, '{\"id\":\"6\",\"id_t_diagnosa\":\"4\",\"id_diagnosa\":\"10\",\"gigi\":\"11\",\"created_at\":\"2022-01-02 21:12:36\",\"updated_at\":null,\"deleted_at\":null}', '2022-01-02 21:14:20', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (88, 5, 'https://admin.sofineclinic.com/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 21:14:41', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (89, 5, 'https://admin.sofineclinic.com/rekam_medik/simpan_form_tindakan?', 'TAMBAH DATA TINDAKAN (REKAM MEDIK)', '{\"id\":1,\"id_pasien\":\"1\",\"id_pegawai\":\"6\",\"id_reg\":\"1\",\"id_user_adm\":\"5\",\"tanggal\":\"2022-01-02\",\"created_at\":\"2022-01-02 21:15:33\"}', NULL, '2022-01-02 21:15:33', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (90, 5, 'https://admin.sofineclinic.com/rekam_medik/simpan_form_tindakan?', 'TAMBAH DATA TINDAKAN DETAIL (REKAM MEDIK)', '{\"id\":1,\"id_t_tindakan\":\"1\",\"id_tindakan\":\"71\",\"gigi\":\"11\",\"harga\":500000,\"diskon_persen\":\"0\",\"diskon_nilai\":0,\"harga_bruto\":500000,\"keterangan\":\"pro kontrol 1 minggu untuk melepas suture\",\"created_at\":\"2022-01-02 21:15:33\"}', NULL, '2022-01-02 21:15:33', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (91, 5, 'https://admin.sofineclinic.com/rekam_medik/simpan_form_logistik?', 'TAMBAH DATA LOGISTIK (REKAM MEDIK)', '{\"id\":1,\"id_pasien\":\"1\",\"id_pegawai\":\"6\",\"id_reg\":\"1\",\"id_user_adm\":\"5\",\"tanggal\":\"2022-01-02\",\"created_at\":\"2022-01-02 21:19:35\"}', NULL, '2022-01-02 21:19:35', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (92, 5, 'https://admin.sofineclinic.com/rekam_medik/simpan_form_logistik?', 'TAMBAH DATA LOGISTIK DETAIL (REKAM MEDIK)', '{\"id\":1,\"id_t_logistik\":\"1\",\"id_logistik\":\"13\",\"qty\":\"10\",\"harga\":0,\"subtotal\":0,\"created_at\":\"2022-01-02 21:19:35\"}', NULL, '2022-01-02 21:19:35', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (93, 5, 'https://admin.sofineclinic.com/rekam_medik/save_odontogram?', 'TAMBAH DATA GAMBAR ODONTO (REKAM MEDIK)', '{\"gambar\":\"1.png\",\"id_reg\":\"1\"}', NULL, '2022-01-02 21:22:36', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (94, 5, 'https://admin.sofineclinic.com/rekam_medik/save_odontogram?', 'UBAH DATA GAMBAR ODONTO (REKAM MEDIK)', '{\"gambar\":\"1.png\",\"id_reg\":\"1\"}', '{\"id_reg\":\"1\",\"gambar\":\"1.png\",\"id\":\"3\",\"sebelas\":null,\"dua_belas\":null,\"tiga_belas\":null,\"empat_belas\":null,\"lima_belas\":null,\"enam_belas\":null,\"tujuh_belas\":null,\"delapan_belas\":null,\"dua_satu\":null,\"dua_dua\":null,\"dua_tiga\":null,\"dua_empat\":null,\"dua_lima\":null,\"dua_enam\":null,\"dua_tujuh\":null,\"dua_delapan\":null,\"tiga_satu\":null,\"tiga_dua\":null,\"tiga_tiga\":null,\"tiga_empat\":null,\"tiga_lima\":null,\"tiga_enam\":null,\"tiga_tujuh\":null,\"tiga_delapan\":null,\"empat_satu\":null,\"empat_dua\":null,\"empat_tiga\":null,\"empat_empat\":null,\"empat_lima\":null,\"empat_enam\":null,\"empat_tujuh\":null,\"empat_delapan\":null,\"occlusi\":null,\"torus_palatinus\":null,\"torus_mandibularis\":null,\"palatum\":null,\"diastema\":null,\"keterangan_diastema\":null,\"gigi_anomali\":null,\"keterangan_gigi_anomali\":null,\"d\":null,\"m\":null,\"f\":null,\"jumlah_foto\":null,\"jumlah_rontgen\":null,\"lain_lain\":null,\"satuan_jumlah_foto\":null,\"satuan_jumlah_rontgen\":null}', '2022-01-02 21:22:41', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (95, 5, 'https://admin.sofineclinic.com/rekam_medik/save_odontogram?', 'UBAH DATA GAMBAR ODONTO (REKAM MEDIK)', '{\"gambar\":\"1.png\",\"id_reg\":\"1\"}', '{\"id_reg\":\"1\",\"gambar\":\"1.png\",\"id\":\"3\",\"sebelas\":null,\"dua_belas\":null,\"tiga_belas\":null,\"empat_belas\":null,\"lima_belas\":null,\"enam_belas\":null,\"tujuh_belas\":null,\"delapan_belas\":null,\"dua_satu\":null,\"dua_dua\":null,\"dua_tiga\":null,\"dua_empat\":null,\"dua_lima\":null,\"dua_enam\":null,\"dua_tujuh\":null,\"dua_delapan\":null,\"tiga_satu\":null,\"tiga_dua\":null,\"tiga_tiga\":null,\"tiga_empat\":null,\"tiga_lima\":null,\"tiga_enam\":null,\"tiga_tujuh\":null,\"tiga_delapan\":null,\"empat_satu\":null,\"empat_dua\":null,\"empat_tiga\":null,\"empat_empat\":null,\"empat_lima\":null,\"empat_enam\":null,\"empat_tujuh\":null,\"empat_delapan\":null,\"occlusi\":null,\"torus_palatinus\":null,\"torus_mandibularis\":null,\"palatum\":null,\"diastema\":null,\"keterangan_diastema\":null,\"gigi_anomali\":null,\"keterangan_gigi_anomali\":null,\"d\":null,\"m\":null,\"f\":null,\"jumlah_foto\":null,\"jumlah_rontgen\":null,\"lain_lain\":null,\"satuan_jumlah_foto\":null,\"satuan_jumlah_rontgen\":null}', '2022-01-02 21:22:41', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (96, 5, 'https://admin.sofineclinic.com/rekam_medik/save_odontogram?', 'UBAH DATA GAMBAR ODONTO (REKAM MEDIK)', '{\"gambar\":\"1.png\",\"id_reg\":\"1\"}', '{\"id_reg\":\"1\",\"gambar\":\"1.png\",\"id\":\"3\",\"sebelas\":null,\"dua_belas\":null,\"tiga_belas\":null,\"empat_belas\":null,\"lima_belas\":null,\"enam_belas\":null,\"tujuh_belas\":null,\"delapan_belas\":null,\"dua_satu\":null,\"dua_dua\":null,\"dua_tiga\":null,\"dua_empat\":null,\"dua_lima\":null,\"dua_enam\":null,\"dua_tujuh\":null,\"dua_delapan\":null,\"tiga_satu\":null,\"tiga_dua\":null,\"tiga_tiga\":null,\"tiga_empat\":null,\"tiga_lima\":null,\"tiga_enam\":null,\"tiga_tujuh\":null,\"tiga_delapan\":null,\"empat_satu\":null,\"empat_dua\":null,\"empat_tiga\":null,\"empat_empat\":null,\"empat_lima\":null,\"empat_enam\":null,\"empat_tujuh\":null,\"empat_delapan\":null,\"occlusi\":null,\"torus_palatinus\":null,\"torus_mandibularis\":null,\"palatum\":null,\"diastema\":null,\"keterangan_diastema\":null,\"gigi_anomali\":null,\"keterangan_gigi_anomali\":null,\"d\":null,\"m\":null,\"f\":null,\"jumlah_foto\":null,\"jumlah_rontgen\":null,\"lain_lain\":null,\"satuan_jumlah_foto\":null,\"satuan_jumlah_rontgen\":null}', '2022-01-02 21:22:42', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (97, 5, 'https://admin.sofineclinic.com/rekam_medik/save_odontogram?', 'UBAH DATA GAMBAR ODONTO (REKAM MEDIK)', '{\"gambar\":\"1.png\",\"id_reg\":\"1\"}', '{\"id_reg\":\"1\",\"gambar\":\"1.png\",\"id\":\"3\",\"sebelas\":null,\"dua_belas\":null,\"tiga_belas\":null,\"empat_belas\":null,\"lima_belas\":null,\"enam_belas\":null,\"tujuh_belas\":null,\"delapan_belas\":null,\"dua_satu\":null,\"dua_dua\":null,\"dua_tiga\":null,\"dua_empat\":null,\"dua_lima\":null,\"dua_enam\":null,\"dua_tujuh\":null,\"dua_delapan\":null,\"tiga_satu\":null,\"tiga_dua\":null,\"tiga_tiga\":null,\"tiga_empat\":null,\"tiga_lima\":null,\"tiga_enam\":null,\"tiga_tujuh\":null,\"tiga_delapan\":null,\"empat_satu\":null,\"empat_dua\":null,\"empat_tiga\":null,\"empat_empat\":null,\"empat_lima\":null,\"empat_enam\":null,\"empat_tujuh\":null,\"empat_delapan\":null,\"occlusi\":null,\"torus_palatinus\":null,\"torus_mandibularis\":null,\"palatum\":null,\"diastema\":null,\"keterangan_diastema\":null,\"gigi_anomali\":null,\"keterangan_gigi_anomali\":null,\"d\":null,\"m\":null,\"f\":null,\"jumlah_foto\":null,\"jumlah_rontgen\":null,\"lain_lain\":null,\"satuan_jumlah_foto\":null,\"satuan_jumlah_rontgen\":null}', '2022-01-02 21:22:42', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (98, 5, 'https://admin.sofineclinic.com/rekam_medik/save_odontogram?', 'UBAH DATA GAMBAR ODONTO (REKAM MEDIK)', '{\"gambar\":\"1.png\",\"id_reg\":\"1\"}', '{\"id_reg\":\"1\",\"gambar\":\"1.png\",\"id\":\"3\",\"sebelas\":null,\"dua_belas\":null,\"tiga_belas\":null,\"empat_belas\":null,\"lima_belas\":null,\"enam_belas\":null,\"tujuh_belas\":null,\"delapan_belas\":null,\"dua_satu\":null,\"dua_dua\":null,\"dua_tiga\":null,\"dua_empat\":null,\"dua_lima\":null,\"dua_enam\":null,\"dua_tujuh\":null,\"dua_delapan\":null,\"tiga_satu\":null,\"tiga_dua\":null,\"tiga_tiga\":null,\"tiga_empat\":null,\"tiga_lima\":null,\"tiga_enam\":null,\"tiga_tujuh\":null,\"tiga_delapan\":null,\"empat_satu\":null,\"empat_dua\":null,\"empat_tiga\":null,\"empat_empat\":null,\"empat_lima\":null,\"empat_enam\":null,\"empat_tujuh\":null,\"empat_delapan\":null,\"occlusi\":null,\"torus_palatinus\":null,\"torus_mandibularis\":null,\"palatum\":null,\"diastema\":null,\"keterangan_diastema\":null,\"gigi_anomali\":null,\"keterangan_gigi_anomali\":null,\"d\":null,\"m\":null,\"f\":null,\"jumlah_foto\":null,\"jumlah_rontgen\":null,\"lain_lain\":null,\"satuan_jumlah_foto\":null,\"satuan_jumlah_rontgen\":null}', '2022-01-02 21:22:44', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (99, 5, 'https://admin.sofineclinic.com/rekam_medik/save_odontogram?', 'UBAH DATA GAMBAR ODONTO (REKAM MEDIK)', '{\"gambar\":\"1.png\",\"id_reg\":\"1\"}', '{\"id_reg\":\"1\",\"gambar\":\"1.png\",\"id\":\"3\",\"sebelas\":null,\"dua_belas\":null,\"tiga_belas\":null,\"empat_belas\":null,\"lima_belas\":null,\"enam_belas\":null,\"tujuh_belas\":null,\"delapan_belas\":null,\"dua_satu\":null,\"dua_dua\":null,\"dua_tiga\":null,\"dua_empat\":null,\"dua_lima\":null,\"dua_enam\":null,\"dua_tujuh\":null,\"dua_delapan\":null,\"tiga_satu\":null,\"tiga_dua\":null,\"tiga_tiga\":null,\"tiga_empat\":null,\"tiga_lima\":null,\"tiga_enam\":null,\"tiga_tujuh\":null,\"tiga_delapan\":null,\"empat_satu\":null,\"empat_dua\":null,\"empat_tiga\":null,\"empat_empat\":null,\"empat_lima\":null,\"empat_enam\":null,\"empat_tujuh\":null,\"empat_delapan\":null,\"occlusi\":null,\"torus_palatinus\":null,\"torus_mandibularis\":null,\"palatum\":null,\"diastema\":null,\"keterangan_diastema\":null,\"gigi_anomali\":null,\"keterangan_gigi_anomali\":null,\"d\":null,\"m\":null,\"f\":null,\"jumlah_foto\":null,\"jumlah_rontgen\":null,\"lain_lain\":null,\"satuan_jumlah_foto\":null,\"satuan_jumlah_rontgen\":null}', '2022-01-02 21:22:45', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (100, 5, 'https://admin.sofineclinic.com/rekam_medik/save_odontogram?', 'UBAH DATA GAMBAR ODONTO (REKAM MEDIK)', '{\"gambar\":\"1.png\",\"id_reg\":\"1\"}', '{\"id_reg\":\"1\",\"gambar\":\"1.png\",\"id\":\"3\",\"sebelas\":null,\"dua_belas\":null,\"tiga_belas\":null,\"empat_belas\":null,\"lima_belas\":null,\"enam_belas\":null,\"tujuh_belas\":null,\"delapan_belas\":null,\"dua_satu\":null,\"dua_dua\":null,\"dua_tiga\":null,\"dua_empat\":null,\"dua_lima\":null,\"dua_enam\":null,\"dua_tujuh\":null,\"dua_delapan\":null,\"tiga_satu\":null,\"tiga_dua\":null,\"tiga_tiga\":null,\"tiga_empat\":null,\"tiga_lima\":null,\"tiga_enam\":null,\"tiga_tujuh\":null,\"tiga_delapan\":null,\"empat_satu\":null,\"empat_dua\":null,\"empat_tiga\":null,\"empat_empat\":null,\"empat_lima\":null,\"empat_enam\":null,\"empat_tujuh\":null,\"empat_delapan\":null,\"occlusi\":null,\"torus_palatinus\":null,\"torus_mandibularis\":null,\"palatum\":null,\"diastema\":null,\"keterangan_diastema\":null,\"gigi_anomali\":null,\"keterangan_gigi_anomali\":null,\"d\":null,\"m\":null,\"f\":null,\"jumlah_foto\":null,\"jumlah_rontgen\":null,\"lain_lain\":null,\"satuan_jumlah_foto\":null,\"satuan_jumlah_rontgen\":null}', '2022-01-02 21:22:45', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (101, 5, 'https://admin.sofineclinic.com/rekam_medik/save_odontogram?', 'UBAH DATA GAMBAR ODONTO (REKAM MEDIK)', '{\"gambar\":\"1.png\",\"id_reg\":\"1\"}', '{\"id_reg\":\"1\",\"gambar\":\"1.png\",\"id\":\"3\",\"sebelas\":null,\"dua_belas\":null,\"tiga_belas\":null,\"empat_belas\":null,\"lima_belas\":null,\"enam_belas\":null,\"tujuh_belas\":null,\"delapan_belas\":null,\"dua_satu\":null,\"dua_dua\":null,\"dua_tiga\":null,\"dua_empat\":null,\"dua_lima\":null,\"dua_enam\":null,\"dua_tujuh\":null,\"dua_delapan\":null,\"tiga_satu\":null,\"tiga_dua\":null,\"tiga_tiga\":null,\"tiga_empat\":null,\"tiga_lima\":null,\"tiga_enam\":null,\"tiga_tujuh\":null,\"tiga_delapan\":null,\"empat_satu\":null,\"empat_dua\":null,\"empat_tiga\":null,\"empat_empat\":null,\"empat_lima\":null,\"empat_enam\":null,\"empat_tujuh\":null,\"empat_delapan\":null,\"occlusi\":null,\"torus_palatinus\":null,\"torus_mandibularis\":null,\"palatum\":null,\"diastema\":null,\"keterangan_diastema\":null,\"gigi_anomali\":null,\"keterangan_gigi_anomali\":null,\"d\":null,\"m\":null,\"f\":null,\"jumlah_foto\":null,\"jumlah_rontgen\":null,\"lain_lain\":null,\"satuan_jumlah_foto\":null,\"satuan_jumlah_rontgen\":null}', '2022-01-02 21:22:45', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (102, 5, 'https://admin.sofineclinic.com/rekam_medik/save_odontogram?', 'UBAH DATA GAMBAR ODONTO (REKAM MEDIK)', '{\"gambar\":\"1.png\",\"id_reg\":\"1\"}', '{\"id_reg\":\"1\",\"gambar\":\"1.png\",\"id\":\"3\",\"sebelas\":null,\"dua_belas\":null,\"tiga_belas\":null,\"empat_belas\":null,\"lima_belas\":null,\"enam_belas\":null,\"tujuh_belas\":null,\"delapan_belas\":null,\"dua_satu\":null,\"dua_dua\":null,\"dua_tiga\":null,\"dua_empat\":null,\"dua_lima\":null,\"dua_enam\":null,\"dua_tujuh\":null,\"dua_delapan\":null,\"tiga_satu\":null,\"tiga_dua\":null,\"tiga_tiga\":null,\"tiga_empat\":null,\"tiga_lima\":null,\"tiga_enam\":null,\"tiga_tujuh\":null,\"tiga_delapan\":null,\"empat_satu\":null,\"empat_dua\":null,\"empat_tiga\":null,\"empat_empat\":null,\"empat_lima\":null,\"empat_enam\":null,\"empat_tujuh\":null,\"empat_delapan\":null,\"occlusi\":null,\"torus_palatinus\":null,\"torus_mandibularis\":null,\"palatum\":null,\"diastema\":null,\"keterangan_diastema\":null,\"gigi_anomali\":null,\"keterangan_gigi_anomali\":null,\"d\":null,\"m\":null,\"f\":null,\"jumlah_foto\":null,\"jumlah_rontgen\":null,\"lain_lain\":null,\"satuan_jumlah_foto\":null,\"satuan_jumlah_rontgen\":null}', '2022-01-02 21:22:45', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (103, 5, 'https://admin.sofineclinic.com/rekam_medik/save_odontogram?', 'UBAH DATA GAMBAR ODONTO (REKAM MEDIK)', '{\"gambar\":\"1.png\",\"id_reg\":\"1\"}', '{\"id_reg\":\"1\",\"gambar\":\"1.png\",\"id\":\"3\",\"sebelas\":null,\"dua_belas\":null,\"tiga_belas\":null,\"empat_belas\":null,\"lima_belas\":null,\"enam_belas\":null,\"tujuh_belas\":null,\"delapan_belas\":null,\"dua_satu\":null,\"dua_dua\":null,\"dua_tiga\":null,\"dua_empat\":null,\"dua_lima\":null,\"dua_enam\":null,\"dua_tujuh\":null,\"dua_delapan\":null,\"tiga_satu\":null,\"tiga_dua\":null,\"tiga_tiga\":null,\"tiga_empat\":null,\"tiga_lima\":null,\"tiga_enam\":null,\"tiga_tujuh\":null,\"tiga_delapan\":null,\"empat_satu\":null,\"empat_dua\":null,\"empat_tiga\":null,\"empat_empat\":null,\"empat_lima\":null,\"empat_enam\":null,\"empat_tujuh\":null,\"empat_delapan\":null,\"occlusi\":null,\"torus_palatinus\":null,\"torus_mandibularis\":null,\"palatum\":null,\"diastema\":null,\"keterangan_diastema\":null,\"gigi_anomali\":null,\"keterangan_gigi_anomali\":null,\"d\":null,\"m\":null,\"f\":null,\"jumlah_foto\":null,\"jumlah_rontgen\":null,\"lain_lain\":null,\"satuan_jumlah_foto\":null,\"satuan_jumlah_rontgen\":null}', '2022-01-02 21:22:46', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (104, 5, 'https://admin.sofineclinic.com/rekam_medik/pulangkan_pasien?', 'REKAM MEDIK SELESAI', '{\"tanggal_pulang\":\"2022-01-02\",\"jam_pulang\":\"21:31:06\",\"is_pulang\":1,\"updated_at\":\"2022-01-02 21:31:06\",\"id\":\"1\"}', NULL, '2022-01-02 21:31:06', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (105, 5, 'https://admin.sofineclinic.com/rekam_medik/batal_pulangkan_pasien?', 'PEMBATALAN REKAM MEDIK SELESAI', '{\"tanggal_pulang\":\"2022-01-02\",\"jam_pulang\":\"21:34:25\",\"is_pulang\":1,\"updated_at\":\"2022-01-02 21:34:25\",\"id\":\"1\"}', NULL, '2022-01-02 21:34:25', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (106, 5, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 21:37:01', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (107, 1, 'https://admin.sofineclinic.com/login/proses?', 'LOGIN', NULL, NULL, '2022-01-02 21:37:06', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (108, 1, 'https://admin.sofineclinic.com/data_pasien/delete_data?', 'HAPUS DATA PASIEN', NULL, '{\"id\":\"1\",\"no_rm\":\"NU.2022.01.0001\",\"nama\":\"NURUL\",\"tempat_lahir\":\"Mataram\",\"tanggal_lahir\":\"2022-01-12\",\"nik\":\"12345\",\"jenis_kelamin\":\"P\",\"suku\":null,\"pekerjaan\":null,\"alamat_rumah\":\"Jalan Bukit Golf M2\\/02\",\"telp_rumah\":null,\"alamat_kantor\":null,\"hp\":\"1243545\",\"is_aktif\":\"1\",\"created_at\":\"2022-01-02 21:10:15\",\"updated_at\":null,\"deleted_at\":null,\"file_ktp\":null}', '2022-01-02 21:44:37', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (109, 1, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 21:48:08', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (110, 3, 'https://admin.sofineclinic.com/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 21:48:20', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (111, 3, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 21:52:44', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (112, 1, 'https://admin.sofineclinic.com/login/proses?', 'LOGIN', NULL, NULL, '2022-01-02 21:53:01', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (113, 1, 'https://admin.sofineclinic.com/data_pasien/simpan_data?', 'UBAH DATA PASIEN', '{\"id\":\"5\",\"nama\":\"NUR FADILAH\",\"nik\":\"3525135903960005\",\"tempat_lahir\":\"Gresik\",\"tanggal_lahir\":\"2996-03-19\",\"jenis_kelamin\":\"P\",\"suku\":null,\"pekerjaan\":null,\"hp\":\"089676494551\",\"telp_rumah\":null,\"alamat_rumah\":\"Setro RT 08\\/RW 04 menganti\",\"alamat_kantor\":null,\"updated_at\":\"2022-01-02 22:21:06\"}', '{\"id\":\"5\",\"no_rm\":\"NU.2007.03.0002\",\"nama\":\"NUR FADILAH\",\"tempat_lahir\":\"Gresik\",\"tanggal_lahir\":\"2007-03-19\",\"nik\":\"3525135903960005\",\"jenis_kelamin\":\"P\",\"suku\":null,\"pekerjaan\":null,\"alamat_rumah\":\"Setro RT 08\\/RW 04 menganti\",\"telp_rumah\":null,\"alamat_kantor\":\"Setro RT 08\\/RW 04 menganti\",\"hp\":\"089676494551\",\"is_aktif\":\"1\",\"created_at\":\"2022-01-02 22:20:18\",\"updated_at\":null,\"deleted_at\":null,\"file_ktp\":null}', '2022-01-02 22:21:06', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (114, 1, 'https://admin.sofineclinic.com/data_pasien/simpan_data?', 'UBAH DATA MEDIK', '{\"id\":\"1\",\"gol_darah\":null,\"tekanan_darah\":\"HYPERTENSI\",\"tekanan_darah_val\":\"140\\/10\",\"penyakit_jantung\":\"0\",\"diabetes\":\"1\",\"haemopilia\":\"0\",\"hepatitis\":\"0\",\"gastring\":\"0\",\"penyakit_lainnya\":\"1\",\"alergi_obat\":\"0\",\"alergi_obat_val\":null,\"alergi_makanan\":\"0\",\"alergi_makanan_val\":null,\"updated_at\":\"2022-01-02 22:21:06\"}', '{\"id\":\"1\",\"id_pasien\":\"5\",\"gol_darah\":\"O\",\"tekanan_darah\":\"HYPERTENSI\",\"tekanan_darah_val\":\"140\\/10\",\"penyakit_jantung\":\"0\",\"diabetes\":\"0\",\"haemopilia\":\"0\",\"hepatitis\":\"0\",\"gastring\":\"0\",\"penyakit_lainnya\":\"0\",\"hamil\":\"0\",\"alergi_obat\":\"0\",\"alergi_obat_val\":null,\"alergi_makanan\":\"0\",\"alergi_makanan_val\":null,\"created_at\":\"2020-09-13 17:53:03\",\"updated_at\":\"2021-12-30 08:37:21\",\"deleted_at\":null}', '2022-01-02 22:21:06', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (115, 1, 'https://admin.sofineclinic.com/data_pasien/simpan_data?', 'UBAH DATA PASIEN', '{\"id\":\"5\",\"nama\":\"NUR FADILAH\",\"nik\":\"3525135903960005\",\"tempat_lahir\":\"Gresik\",\"tanggal_lahir\":\"1996-03-19\",\"jenis_kelamin\":\"P\",\"suku\":null,\"pekerjaan\":null,\"hp\":\"089676494551\",\"telp_rumah\":null,\"alamat_rumah\":\"Setro RT 08\\/RW 04 menganti\",\"alamat_kantor\":null,\"updated_at\":\"2022-01-02 22:21:31\"}', '{\"id\":\"5\",\"no_rm\":\"NU.2007.03.0002\",\"nama\":\"NUR FADILAH\",\"tempat_lahir\":\"Gresik\",\"tanggal_lahir\":\"2996-03-19\",\"nik\":\"3525135903960005\",\"jenis_kelamin\":\"P\",\"suku\":null,\"pekerjaan\":null,\"alamat_rumah\":\"Setro RT 08\\/RW 04 menganti\",\"telp_rumah\":null,\"alamat_kantor\":null,\"hp\":\"089676494551\",\"is_aktif\":\"1\",\"created_at\":\"2022-01-02 22:20:18\",\"updated_at\":\"2022-01-02 22:21:06\",\"deleted_at\":null,\"file_ktp\":null}', '2022-01-02 22:21:31', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (116, 1, 'https://admin.sofineclinic.com/data_pasien/simpan_data?', 'UBAH DATA MEDIK', '{\"id\":\"1\",\"gol_darah\":null,\"tekanan_darah\":\"HYPERTENSI\",\"tekanan_darah_val\":\"140\\/10\",\"penyakit_jantung\":\"0\",\"diabetes\":\"0\",\"haemopilia\":\"0\",\"hepatitis\":\"0\",\"gastring\":\"0\",\"penyakit_lainnya\":\"0\",\"alergi_obat\":\"0\",\"alergi_obat_val\":null,\"alergi_makanan\":\"0\",\"alergi_makanan_val\":null,\"updated_at\":\"2022-01-02 22:21:31\"}', '{\"id\":\"1\",\"id_pasien\":\"5\",\"gol_darah\":null,\"tekanan_darah\":\"HYPERTENSI\",\"tekanan_darah_val\":\"140\\/10\",\"penyakit_jantung\":\"0\",\"diabetes\":\"1\",\"haemopilia\":\"0\",\"hepatitis\":\"0\",\"gastring\":\"0\",\"penyakit_lainnya\":\"1\",\"hamil\":\"0\",\"alergi_obat\":\"0\",\"alergi_obat_val\":null,\"alergi_makanan\":\"0\",\"alergi_makanan_val\":null,\"created_at\":\"2020-09-13 17:53:03\",\"updated_at\":\"2022-01-02 22:21:06\",\"deleted_at\":null}', '2022-01-02 22:21:31', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (117, 1, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 22:22:55', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (118, 1, 'https://admin.sofineclinic.com/login/proses?', 'LOGIN', NULL, NULL, '2022-01-02 22:23:40', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (119, 1, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 22:24:14', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (120, 7, 'https://admin.sofineclinic.com/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 22:24:28', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (121, 7, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 22:42:06', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (122, 1, 'https://admin.sofineclinic.com/login/proses?', 'LOGIN', NULL, NULL, '2022-01-02 22:42:09', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (123, 1, 'https://admin.sofineclinic.com/login/proses?', 'LOGIN', NULL, NULL, '2022-01-02 22:58:01', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (124, 1, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 22:59:21', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (125, 3, 'https://admin.sofineclinic.com/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 22:59:33', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (126, 3, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 23:01:57', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (127, 4, 'https://admin.sofineclinic.com/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 23:02:07', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (128, 4, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 23:06:28', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (129, 1, 'https://admin.sofineclinic.com/login/proses?', 'LOGIN', NULL, NULL, '2022-01-02 23:06:43', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (130, 1, 'https://admin.sofineclinic.com/login/logout_proc?', 'LOGOUT', NULL, NULL, '2022-01-02 23:07:31', NULL, NULL);
INSERT INTO `t_log_aktifitas` VALUES (131, 7, 'https://admin.sofineclinic.com/login/confirm_middle_login?', 'LOGIN', NULL, NULL, '2022-01-02 23:07:48', NULL, NULL);

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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_dokter`(`id_dokter`) USING BTREE,
  INDEX `id_klinik`(`id_klinik`) USING BTREE,
  CONSTRAINT `t_log_jadwal_dokter_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `m_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_log_jadwal_dokter_ibfk_2` FOREIGN KEY (`id_klinik`) REFERENCES `m_klinik` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_log_jadwal_dokter
-- ----------------------------

-- ----------------------------
-- Table structure for t_logistik
-- ----------------------------
DROP TABLE IF EXISTS `t_logistik`;
CREATE TABLE `t_logistik`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_reg` int(64) NULL DEFAULT NULL,
  `id_pasien` int(11) NULL DEFAULT NULL,
  `id_pegawai` int(11) NULL DEFAULT NULL,
  `id_user_adm` int(11) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `keterangan_resep` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pasien`(`id_pasien`) USING BTREE,
  INDEX `id_pegawai`(`id_pegawai`) USING BTREE,
  INDEX `id_reg`(`id_reg`) USING BTREE,
  INDEX `id_user_adm`(`id_user_adm`) USING BTREE,
  CONSTRAINT `t_logistik_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_logistik_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_logistik_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_logistik_ibfk_4` FOREIGN KEY (`id_user_adm`) REFERENCES `m_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_logistik
-- ----------------------------
INSERT INTO `t_logistik` VALUES (1, 1, 1, 6, 5, '2022-01-02', '', '2022-01-02 21:19:35', '2022-01-02 21:20:20', NULL);

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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_logistik`(`id_logistik`) USING BTREE,
  INDEX `id_t_logistik`(`id_t_logistik`) USING BTREE,
  CONSTRAINT `t_logistik_det_ibfk_1` FOREIGN KEY (`id_logistik`) REFERENCES `m_logistik` (`id_logistik`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_logistik_det_ibfk_2` FOREIGN KEY (`id_t_logistik`) REFERENCES `t_logistik` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_logistik_det
-- ----------------------------
INSERT INTO `t_logistik_det` VALUES (1, 1, 13, 10, 0.00, 0.00, '2022-01-02 21:19:35', NULL, NULL);

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
  `id_user` int(11) NULL DEFAULT NULL,
  `flag_transaksi` int(1) NULL DEFAULT NULL COMMENT '1: penerimaan, 2: pengeluaran',
  `total_honor_dokter` float(20, 2) NULL DEFAULT 0 COMMENT 'honor dokter',
  `total_penerimaan_gross` float(20, 2) NULL DEFAULT 0 COMMENT 'penerimaan keseluruhan (belum dikurangi honor dokter)',
  `total_penerimaan_nett` float(20, 2) NULL DEFAULT 0 COMMENT 'penerimaan klinik',
  `total_pengeluaran` float(20, 2) NULL DEFAULT 0 COMMENT 'pengeluaran, jika flag transaksi = 2',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_jenis_trans`(`id_jenis_trans`) USING BTREE,
  INDEX `id_registrasi`(`id_registrasi`) USING BTREE,
  INDEX `id_user`(`id_user`) USING BTREE,
  CONSTRAINT `t_mutasi_ibfk_1` FOREIGN KEY (`id_jenis_trans`) REFERENCES `m_jenis_trans` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_mutasi_ibfk_2` FOREIGN KEY (`id_registrasi`) REFERENCES `t_registrasi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_mutasi_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `m_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_mutasi
-- ----------------------------
INSERT INTO `t_mutasi` VALUES (1, '2022-01-02', 1, 2, 1, 5, 1, 0.00, 500000.00, 500000.00, 0.00, '2022-01-02 21:15:33', NULL, NULL);

-- ----------------------------
-- Table structure for t_mutasi_det
-- ----------------------------
DROP TABLE IF EXISTS `t_mutasi_det`;
CREATE TABLE `t_mutasi_det`  (
  `id` int(64) NOT NULL,
  `id_mutasi` int(64) NULL DEFAULT NULL,
  `id_trans_det_flag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'id transaksi pada tabel transaksi detail di transaksi terkait',
  `qty` int(32) NULL DEFAULT NULL,
  `harga` double(20, 2) NULL DEFAULT NULL,
  `subtotal` double(20, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_mutasi`(`id_mutasi`) USING BTREE,
  CONSTRAINT `t_mutasi_det_ibfk_1` FOREIGN KEY (`id_mutasi`) REFERENCES `t_mutasi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_mutasi_det
-- ----------------------------
INSERT INTO `t_mutasi_det` VALUES (29, 1, '1', NULL, 500000.00, 500000.00, '2022-01-02 21:15:33', NULL, NULL);

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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_reg`(`id_reg`) USING BTREE,
  CONSTRAINT `t_odontogram_ibfk_1` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_odontogram
-- ----------------------------
INSERT INTO `t_odontogram` VALUES (1, '1.png', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_reg`(`id_reg`) USING BTREE,
  INDEX `id_user`(`id_user`) USING BTREE,
  CONSTRAINT `t_pembayaran_ibfk_1` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_pembayaran_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `m_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

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
  `id_pegawai` int(11) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `anamnesa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pasien`(`id_pasien`) USING BTREE,
  INDEX `id_pegawai`(`id_pegawai`) USING BTREE,
  INDEX `id_reg`(`id_reg`) USING BTREE,
  CONSTRAINT `t_perawatan_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_perawatan_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_perawatan_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_perawatan
-- ----------------------------
INSERT INTO `t_perawatan` VALUES (1, 1, 1, 6, '2022-01-02', '<p>pasien datang dengan keluhan gigi sakit ingin ditambal</p>\n', '2022-01-02 21:12:08', NULL, NULL);

-- ----------------------------
-- Table structure for t_registrasi
-- ----------------------------
DROP TABLE IF EXISTS `t_registrasi`;
CREATE TABLE `t_registrasi`  (
  `id` int(64) NOT NULL,
  `id_klinik` int(11) NULL DEFAULT NULL,
  `id_layanan` int(11) NOT NULL,
  `id_pasien` int(11) NULL DEFAULT NULL,
  `no_reg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_reg` date NULL DEFAULT NULL,
  `jam_reg` time(0) NULL DEFAULT NULL,
  `estimasi_selesai` time(0) NULL DEFAULT NULL,
  `id_pegawai` int(11) NULL DEFAULT NULL,
  `is_asuransi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '1: Asuransi, null = umum',
  `umur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_pemetaan` int(11) NULL DEFAULT NULL,
  `nama_asuransi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_asuransi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_pulang` int(1) NULL DEFAULT NULL COMMENT '1: Pulang, null = Masih DIrawat',
  `tanggal_pulang` date NULL DEFAULT NULL,
  `jam_pulang` time(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `is_send_broadcast` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_klinik`(`id_klinik`) USING BTREE,
  INDEX `id_layanan`(`id_layanan`) USING BTREE,
  INDEX `id_pasien`(`id_pasien`) USING BTREE,
  INDEX `id_pegawai`(`id_pegawai`) USING BTREE,
  INDEX `id_pemetaan`(`id_pemetaan`) USING BTREE,
  CONSTRAINT `t_registrasi_ibfk_1` FOREIGN KEY (`id_klinik`) REFERENCES `m_klinik` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_registrasi_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `m_layanan` (`id_layanan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_registrasi_ibfk_3` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_registrasi_ibfk_4` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_registrasi_ibfk_5` FOREIGN KEY (`id_pemetaan`) REFERENCES `m_pemetaan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_registrasi
-- ----------------------------
INSERT INTO `t_registrasi` VALUES (1, 3, 1, 1, '000.000.000.001', '2022-01-07', '15:00:00', '16:00:00', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-02 21:10:15', '2022-01-02 21:34:25', NULL, NULL);
INSERT INTO `t_registrasi` VALUES (2, 4, 3, 2, '000.000.000.002', '2022-01-03', '16:00:00', '17:00:00', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-02 22:05:54', NULL, NULL, NULL);
INSERT INTO `t_registrasi` VALUES (3, 4, 3, 3, '000.000.000.003', '2022-01-03', '19:00:00', '20:00:00', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-02 22:15:57', NULL, NULL, NULL);
INSERT INTO `t_registrasi` VALUES (4, 4, 3, 4, '000.000.000.004', '2022-01-03', '20:00:00', '21:00:00', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-02 22:17:51', NULL, NULL, NULL);
INSERT INTO `t_registrasi` VALUES (5, 4, 3, 5, '000.000.000.005', '2022-01-03', '18:00:00', '19:00:00', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-02 22:20:18', NULL, NULL, NULL);
INSERT INTO `t_registrasi` VALUES (6, 4, 1, 6, '000.000.000.006', '2022-01-07', '14:00:00', '15:00:00', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-02 22:40:18', NULL, NULL, NULL);

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
INSERT INTO `t_role_menu` VALUES (41, 1, 1, 1, 1);
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
INSERT INTO `t_role_menu` VALUES (40, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (1, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (17, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (18, 3, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (19, 3, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (35, 3, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (28, 3, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (29, 3, 1, 1, 1);
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
  `id_pegawai` int(11) NULL DEFAULT NULL,
  `id_user_adm` int(11) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pasien`(`id_pasien`) USING BTREE,
  INDEX `t_tindakan_ibfk_2`(`id_pegawai`) USING BTREE,
  INDEX `id_reg`(`id_reg`) USING BTREE,
  INDEX `id_user_adm`(`id_user_adm`) USING BTREE,
  CONSTRAINT `t_tindakan_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_tindakan_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_tindakan_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_tindakan_ibfk_4` FOREIGN KEY (`id_user_adm`) REFERENCES `m_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_tindakan
-- ----------------------------
INSERT INTO `t_tindakan` VALUES (1, 1, 1, 6, 5, '2022-01-02', '2022-01-02 21:15:33', NULL, NULL);

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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_tindakan`(`id_tindakan`) USING BTREE,
  INDEX `id_t_tindakan`(`id_t_tindakan`) USING BTREE,
  CONSTRAINT `t_tindakan_det_ibfk_1` FOREIGN KEY (`id_tindakan`) REFERENCES `m_tindakan` (`id_tindakan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_tindakan_det_ibfk_2` FOREIGN KEY (`id_t_tindakan`) REFERENCES `t_tindakan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_tindakan_det
-- ----------------------------
INSERT INTO `t_tindakan_det` VALUES (1, 1, 71, '11', 500000.00, 'pro kontrol 1 minggu untuk melepas suture', '2022-01-02 21:15:33', NULL, NULL, 0, 0.00, 500000.00);

-- ----------------------------
-- Table structure for t_tindakanlab
-- ----------------------------
DROP TABLE IF EXISTS `t_tindakanlab`;
CREATE TABLE `t_tindakanlab`  (
  `id` int(64) NOT NULL,
  `id_reg` int(64) NULL DEFAULT NULL,
  `id_pasien` int(11) NULL DEFAULT NULL,
  `id_pegawai` int(11) NULL DEFAULT NULL,
  `id_user_adm` int(11) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pasien`(`id_pasien`) USING BTREE,
  INDEX `id_pegawai`(`id_pegawai`) USING BTREE,
  INDEX `id_reg`(`id_reg`) USING BTREE,
  INDEX `id_user_adm`(`id_user_adm`) USING BTREE,
  CONSTRAINT `t_tindakanlab_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `m_pasien` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_tindakanlab_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_tindakanlab_ibfk_3` FOREIGN KEY (`id_reg`) REFERENCES `t_registrasi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_tindakanlab_ibfk_4` FOREIGN KEY (`id_user_adm`) REFERENCES `m_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_tindakanlab
-- ----------------------------

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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_tindakan_lab`(`id_tindakan_lab`) USING BTREE,
  INDEX `id_t_tindakanlab`(`id_t_tindakanlab`) USING BTREE,
  CONSTRAINT `t_tindakanlab_det_ibfk_1` FOREIGN KEY (`id_tindakan_lab`) REFERENCES `m_laboratorium` (`id_laboratorium`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_tindakanlab_det_ibfk_2` FOREIGN KEY (`id_t_tindakanlab`) REFERENCES `t_tindakanlab` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_tindakanlab_det
-- ----------------------------

-- ----------------------------
-- Table structure for t_user_klinik
-- ----------------------------
DROP TABLE IF EXISTS `t_user_klinik`;
CREATE TABLE `t_user_klinik`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `id_klinik` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_user_klinik
-- ----------------------------
INSERT INTO `t_user_klinik` VALUES (3, 2, 4, '2021-12-11 09:49:31', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (4, 2, 3, '2021-12-11 09:49:31', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (5, 3, 3, '2021-12-12 20:43:12', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (7, 4, 4, '2021-12-19 10:15:58', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (8, 6, 4, '2021-12-30 13:37:54', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (9, 6, 3, '2021-12-30 13:37:54', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (10, 7, 4, '2021-12-30 13:38:00', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (11, 7, 3, '2021-12-30 13:38:00', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (12, 5, 4, '2021-12-30 13:38:10', NULL, NULL);
INSERT INTO `t_user_klinik` VALUES (13, 5, 3, '2021-12-30 13:38:10', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
