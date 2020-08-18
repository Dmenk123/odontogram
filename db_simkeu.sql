/*
 Navicat Premium Data Transfer

 Source Server         : lokal
 Source Server Type    : MySQL
 Source Server Version : 100131
 Source Host           : localhost:3306
 Source Schema         : db_simkeu

 Target Server Type    : MySQL
 Target Server Version : 100131
 File Encoding         : 65001

 Date: 01/12/2019 22:50:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_guru
-- ----------------------------
DROP TABLE IF EXISTS `tbl_guru`;
CREATE TABLE `tbl_guru`  (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode_jabatan` int(12) NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_lahir` date NULL DEFAULT NULL,
  `jenis_kelamin` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'L: Laki2, P: Perempuan',
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  `is_guru` int(1) NULL DEFAULT 1,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `kode_jabatan`(`kode_jabatan`) USING BTREE,
  CONSTRAINT `tbl_guru_ibfk_1` FOREIGN KEY (`kode_jabatan`) REFERENCES `tbl_jabatan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_guru
-- ----------------------------
INSERT INTO `tbl_guru` VALUES (1, '1827188812718281', 'Michael Schumacher', 1, 'lalat xxx', 'asaasa', '1992-09-04', 'L', 'michael-schumacher-1572368322.jpg', 1, 1, NULL);
INSERT INTO `tbl_guru` VALUES (2, '35820', 'Djatmiko', 6, 'akjskja ajsuias iasuiasj ajs', 'Baghdad', '1965-07-04', 'L', 'djatmiko-1573004526.jpeg', 1, 0, NULL);
INSERT INTO `tbl_guru` VALUES (3, '89650', 'Frengki', 3, 'asdasdasd aD ASD', 'Manokwari', '1951-06-05', 'L', 'frengki-1573004595.jpg', 1, 0, NULL);
INSERT INTO `tbl_guru` VALUES (4, '1859878812718281', 'Mad Drai', 5, 'hashd ashdjash djash djashdj', 'Pamekasan', '1975-03-25', 'L', 'mad-drai-1573004669.jpg', 1, 1, NULL);
INSERT INTO `tbl_guru` VALUES (5, '1899818812718281', 'Agnes', 2, 'asg  gg', 'Bandung', '1965-10-08', 'P', 'agnes-1573004764.jpg', 1, 1, NULL);

-- ----------------------------
-- Table structure for tbl_hak_akses
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hak_akses`;
CREATE TABLE `tbl_hak_akses`  (
  `id_menu` int(11) NOT NULL,
  `id_level_user` int(11) NOT NULL,
  `add_button` int(1) NULL DEFAULT NULL,
  `edit_button` int(1) NULL DEFAULT NULL,
  `delete_button` int(1) NULL DEFAULT NULL,
  INDEX `f_level_user`(`id_level_user`) USING BTREE,
  INDEX `id_menu`(`id_menu`) USING BTREE,
  CONSTRAINT `f_level_user` FOREIGN KEY (`id_level_user`) REFERENCES `tbl_level_user` (`id_level_user`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_hak_akses_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `tbl_menu` (`id_menu`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_hak_akses
-- ----------------------------
INSERT INTO `tbl_hak_akses` VALUES (1, 5, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (108, 5, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (119, 5, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (120, 5, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (1, 1, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (104, 1, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (105, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (106, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (107, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (114, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (116, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (117, 1, 1, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (100, 1, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (101, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (102, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (103, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (127, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (110, 1, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (111, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (113, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (118, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (99, 1, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (98, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (97, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (108, 1, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (119, 1, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (109, 1, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (121, 1, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (123, 1, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (124, 1, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (125, 1, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (126, 1, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (122, 1, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (120, 1, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (1, 3, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (104, 3, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (106, 3, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (107, 3, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (100, 3, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (102, 3, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (103, 3, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (127, 3, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (110, 3, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (111, 3, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (113, 3, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (118, 3, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (108, 3, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (119, 3, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (109, 3, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (121, 3, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (123, 3, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (124, 3, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (125, 3, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (126, 3, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (120, 3, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (1, 2, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (104, 2, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (105, 2, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (114, 2, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (117, 2, 1, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (100, 2, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (101, 2, 1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (120, 2, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (1, 4, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (100, 4, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (102, 4, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (103, 4, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (127, 4, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (108, 4, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (119, 4, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (109, 4, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (121, 4, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (123, 4, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (124, 4, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (125, 4, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (126, 4, 0, 0, 0);
INSERT INTO `tbl_hak_akses` VALUES (120, 4, 0, 0, 0);

-- ----------------------------
-- Table structure for tbl_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_jabatan`;
CREATE TABLE `tbl_jabatan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tunjangan` double(20, 2) NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_jabatan
-- ----------------------------
INSERT INTO `tbl_jabatan` VALUES (1, 'WALI KELAS', 75000.00, 1);
INSERT INTO `tbl_jabatan` VALUES (2, 'KEPALA SEKOLAH', 1235000.00, 1);
INSERT INTO `tbl_jabatan` VALUES (3, 'KEPALA TU', 0.00, 1);
INSERT INTO `tbl_jabatan` VALUES (4, 'STAFF TU', 0.00, 1);
INSERT INTO `tbl_jabatan` VALUES (5, 'GURU', 0.00, 1);
INSERT INTO `tbl_jabatan` VALUES (6, 'SATPAM', 0.00, 1);

-- ----------------------------
-- Table structure for tbl_lap_bku
-- ----------------------------
DROP TABLE IF EXISTS `tbl_lap_bku`;
CREATE TABLE `tbl_lap_bku`  (
  `kode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bulan` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tahun` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `saldo_awal` double(20, 2) NULL DEFAULT NULL,
  `saldo_akhir` double(20, 2) NULL DEFAULT NULL,
  `created` datetime(0) NULL DEFAULT NULL,
  `updated` datetime(0) NULL DEFAULT NULL,
  `is_delete` int(1) NULL DEFAULT 0,
  `is_kunci` int(1) NULL DEFAULT 0,
  PRIMARY KEY (`kode`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_lap_bku
-- ----------------------------
INSERT INTO `tbl_lap_bku` VALUES ('BKU101900001', '10', '2019', 0.00, 47555000.00, '2019-10-20 23:32:14', '2019-10-20 23:36:21', 1, 0);
INSERT INTO `tbl_lap_bku` VALUES ('BKU101900002', '10', '2019', 0.00, 47555000.00, '2019-10-20 23:36:21', NULL, 0, 0);
INSERT INTO `tbl_lap_bku` VALUES ('BKU111900001', '11', '2019', 0.00, 28103000.00, '2019-11-19 18:51:14', NULL, 1, 0);
INSERT INTO `tbl_lap_bku` VALUES ('BKU111900002', '11', '2019', 0.00, 28103000.00, '2019-11-19 18:51:39', NULL, 1, 0);
INSERT INTO `tbl_lap_bku` VALUES ('BKU111900003', '11', '2019', 0.00, 28103000.00, '2019-11-19 18:53:41', NULL, 1, 0);
INSERT INTO `tbl_lap_bku` VALUES ('BKU111900004', '11', '2019', 0.00, 28103000.00, '2019-11-19 18:54:54', '2019-11-19 18:58:18', 1, 0);
INSERT INTO `tbl_lap_bku` VALUES ('BKU111900005', '11', '2019', 0.00, 28103000.00, '2019-11-19 18:58:18', '2019-11-19 18:58:32', 1, 0);
INSERT INTO `tbl_lap_bku` VALUES ('BKU111900006', '11', '2019', 0.00, 28103000.00, '2019-11-19 18:58:32', '2019-11-19 18:59:52', 1, 0);
INSERT INTO `tbl_lap_bku` VALUES ('BKU111900007', '11', '2019', 0.00, 28103000.00, '2019-11-19 18:59:52', '2019-10-21 00:08:42', 1, 0);
INSERT INTO `tbl_lap_bku` VALUES ('BKU111900008', '11', '2019', 0.00, 75658000.00, '2019-10-21 00:08:42', NULL, 0, 0);

-- ----------------------------
-- Table structure for tbl_lap_bku_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_lap_bku_detail`;
CREATE TABLE `tbl_lap_bku_detail`  (
  `kode_header` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bulan` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tahun` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `bukti` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `penerimaan` double(20, 2) NULL DEFAULT NULL,
  `pengeluaran` double(20, 2) NULL DEFAULT NULL,
  `saldo` double(20, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `is_delete` int(1) NULL DEFAULT 0,
  `is_kunci` int(1) NULL DEFAULT 0
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_level_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_level_user`;
CREATE TABLE `tbl_level_user`  (
  `id_level_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level_user` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan_level_user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  `aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_level_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_level_user
-- ----------------------------
INSERT INTO `tbl_level_user` VALUES (1, 'administrator', 'Untuk Administor (Super User)', 1);
INSERT INTO `tbl_level_user` VALUES (2, 'tu', 'Untuk Tata Usaha', 1);
INSERT INTO `tbl_level_user` VALUES (3, 'keuangan', 'Untuk Keuangan', 1);
INSERT INTO `tbl_level_user` VALUES (4, 'kepsek', 'Untuk Kepala Sekolah', 1);
INSERT INTO `tbl_level_user` VALUES (5, 'guru', 'Untuk Guru', 1);

-- ----------------------------
-- Table structure for tbl_log_kunci
-- ----------------------------
DROP TABLE IF EXISTS `tbl_log_kunci`;
CREATE TABLE `tbl_log_kunci`  (
  `bulan` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tahun` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_kunci` int(1) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_log_kunci
-- ----------------------------
INSERT INTO `tbl_log_kunci` VALUES ('11', '2019', 'USR00001', 0, '2019-11-19 23:46:59', NULL);
INSERT INTO `tbl_log_kunci` VALUES ('02', '2019', 'USR00001', 1, '2019-11-19 23:58:05', NULL);
INSERT INTO `tbl_log_kunci` VALUES ('10', '2019', 'USR00001', 1, '2019-10-20 23:07:11', NULL);

-- ----------------------------
-- Table structure for tbl_master_kode_akun
-- ----------------------------
DROP TABLE IF EXISTS `tbl_master_kode_akun`;
CREATE TABLE `tbl_master_kode_akun`  (
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tipe` int(1) NULL DEFAULT NULL,
  `kode` int(3) NULL DEFAULT NULL,
  `sub_1` int(3) NULL DEFAULT NULL,
  `sub_2` int(3) NULL DEFAULT NULL,
  `kode_in_text` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  INDEX `tipe`(`tipe`) USING BTREE,
  INDEX `kode`(`kode`) USING BTREE,
  INDEX `sub_1`(`sub_1`) USING BTREE,
  INDEX `sub_2`(`sub_2`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_master_kode_akun
-- ----------------------------
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengembangan kompetensi sekolah', 1, 1, NULL, NULL, '1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan Kompetensi Ketuntasan Minimal', 1, 1, 1, NULL, '1.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan kreteria kenaikan kelas', 1, 1, 2, NULL, '1.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pelaksanaan Uji Coba UASBN/UN TK.LP MA\'ARIF', 1, 1, 3, NULL, '1.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pelaksanaan Uji Coba UASBN/UN TK.Kota', 1, 1, 4, NULL, '1.4', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengembangan standar isi', 1, 2, NULL, NULL, '2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan pembagian tugas guru dan jadwal pelajaran', 1, 2, 1, NULL, '2.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan program tahunan', 1, 2, 2, NULL, '2.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan Program Semester', 1, 2, 3, NULL, '2.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan silabus', 1, 2, 4, NULL, '2.4', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Kegiatan MGMP dan diskusi jum\'at LP Ma\'arif', 1, 2, 5, NULL, '2.5', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan RPP', 1, 2, 6, NULL, '2.6', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengembangan standar Proses', 1, 3, NULL, NULL, '3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Kegiatan Pengelolaan Kegiatan Belajar Mengajar', 1, 3, 1, NULL, '3.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengadaan sarana penunjang KBM(ATK KBM)', 1, 3, 1, 1, '3.1.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengembangan Alat Pembelajaran(seluruh mapel termasuk OR)', 1, 3, 1, 2, '3.1.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Program Kesiswaan', 1, 3, 2, NULL, '3.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pelaksanaan program perlombaan 17 Agustus', 1, 3, 2, 1, '3.2.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pelaksanaan Pendaftaran Peserta Didik Baru(PPDB)', 1, 3, 2, 2, '3.2.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pelaksanaan kegiatan los', 1, 3, 2, 3, '3.2.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pelaksanaan pertandingan futsal', 1, 3, 2, 4, '3.2.4', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pelaksanaan Penyembelihan hewan qurban', 1, 3, 2, 5, '3.2.5', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Program Ekstrakulikuler', 1, 3, 3, NULL, '3.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan program kesiswaan', 1, 3, 3, 1, '3.3.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('pelaksanaan ekstrakulikuler kepramukaan', 1, 3, 3, 2, '3.3.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengembangan Pendidik dan Tenaga Kependidikan', 1, 4, NULL, NULL, '4', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pembinaan Guru di Gugus', 1, 4, 1, NULL, '4.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Peningkatan kualitas guru kelas,mata pelajaran', 1, 4, 1, 1, '4.1.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Peningkatan Kompetensi Kepala Sekolah', 1, 4, 1, 2, '4.1.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pembinaan Tenaga Kependidikan :', 1, 4, 2, NULL, '4.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pembinaan Tenaga Ketatausahaan', 1, 4, 2, 1, '4.2.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pembinaan Kepsek,WK.Kesiswaan,BK,Osis', 1, 4, 2, 2, '4.2.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengembangan sarana dan prasarana sekolah', 1, 5, NULL, NULL, '5', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengadaan,pemeliharaan dan perawatan alat kantor/inventaris kantor', 1, 5, 1, NULL, '5.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('service printer', 1, 5, 1, 1, '5.1.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pembelian bola sepak', 1, 5, 1, 2, '5.1.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('batrei spiker,corong toa,ampli targa', 1, 5, 1, 3, '5.1.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('eccosp panasonik,print raport,modem,bor ,mata bor', 1, 5, 1, 4, '5.1.4', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('kipas angin dan hexos,alat kebersihan', 1, 5, 1, 5, '5.1.5', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pemeliharaan dan perbaikan gudang :', 1, 5, 2, NULL, '5.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengelasan pagar besi', 1, 5, 2, 1, '5.2.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pemasangan Keramik ruang kelas', 1, 5, 2, 2, '5.2.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pembuatan Papan tulis whaiteboard', 1, 5, 2, 3, '5.2.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengadaan dan perawatan Meubelair :', 1, 5, 3, NULL, '5.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Meja kursi murid', 1, 5, 3, 1, '5.3.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Meja kursi guru', 1, 5, 3, 2, '5.3.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengembangan standar pengelolaan', 1, 6, NULL, NULL, '6', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Kegiatan pengembangan manajemen sekolah', 1, 6, 1, NULL, '6.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan Visi dan Misi', 1, 6, 1, 1, '6.1.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan Profil Sekolah', 1, 6, 1, 2, '6.1.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Kegiatan pengelolaan perkantoran', 1, 6, 2, NULL, '6.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan program ketatausahaan', 1, 6, 2, 1, '6.2.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengadaan sarana pendukung perkantoran', 1, 6, 2, 2, '6.2.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Kegiatan supervisi,Monitoring dan Evaluasi', 1, 6, 3, NULL, '6.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan Program supervisi,Monitoring dan Evaluasi', 1, 6, 3, 1, '6.3.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('supervisi akademik', 1, 6, 3, 2, '6.3.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Kegiatan Hubungan Masyarakat', 1, 6, 4, NULL, '6.4', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengembangan sistem informasi manajemen', 1, 6, 4, 1, '6.4.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan Leafleat', 1, 6, 4, 2, '6.4.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengembangan standar pembiayaan', 1, 7, NULL, NULL, '7', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Kegiatan rumah tangga sekolah,daya dan jasa', 1, 7, 1, NULL, '7.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Konsumsi Rapat Dinas', 1, 7, 1, 1, '7.1.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Konsumsi 1 Muharam', 1, 7, 1, 2, '7.1.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Konsumsi Jalan sehat 10 November', 1, 7, 1, 3, '7.1.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Biaya Transportasi kegiatan guru', 1, 7, 1, 4, '7.1.4', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Biaya Transportasi kegiatan siswa', 1, 7, 1, 5, '7.1.5', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pengembangan dan implementasi sistem penilaian', 1, 8, NULL, NULL, '8', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan kisi-kisi :', 1, 8, 1, NULL, '8.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Ulangan harian', 1, 8, 1, 1, '8.1.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Ulangan Tengah semester', 1, 8, 1, 2, '8.1.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Ulangan Akhir semester', 1, 8, 1, 3, '8.1.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Ujian praktek Agama', 1, 8, 1, 4, '8.1.4', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penyusunan soal', 1, 8, 2, NULL, '8.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Ulangan harian', 1, 8, 2, 1, '8.2.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Ulangan Tengah semester', 1, 8, 2, 2, '8.2.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Ulangan Akhir semester', 1, 8, 2, 3, '8.2.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pelaksanaan Penilaian', 1, 8, 3, NULL, '8.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Ulangan harian', 1, 8, 3, 1, '8.3.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Ulangan Tengah semester', 1, 8, 3, 2, '8.3.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Ulangan Akhir semester', 1, 8, 3, 3, '8.3.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Ulangan kenaikan kelas', 1, 8, 3, 4, '8.3.4', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pelaksanaan ujian praktek', 1, 8, 4, NULL, '8.4', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('tindak lanjut hasil penilaian', 1, 8, 5, NULL, '8.5', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('analisis', 1, 8, 5, 1, '8.5.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('remedial', 1, 8, 5, 2, '8.5.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('pengayaan', 1, 8, 5, 3, '8.5.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penilaian lainnya', 1, 8, 6, NULL, '8.6', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Portofolio', 1, 8, 6, 1, '8.6.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Proyek', 1, 8, 6, 2, '8.6.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penugasan', 1, 8, 6, 3, '8.6.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Inovasi model penilaian', 1, 8, 7, NULL, '8.7', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('workshop', 1, 8, 7, 1, '8.7.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('IHT', 1, 8, 7, 2, '8.7.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Pelatihan', 1, 8, 7, 3, '8.7.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Study banding', 1, 8, 7, 4, '8.7.4', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Penggunaan Dana Lainnya', 2, 2, NULL, NULL, '2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Belanja Alat tulis kantor', 2, 2, 1, NULL, '2.1', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Belanja Bahan dan alat habis pakai', 2, 2, 2, NULL, '2.2', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('Belanja Pegawai', 2, 2, 3, NULL, '2.3', 1);
INSERT INTO `tbl_master_kode_akun` VALUES ('coba coba', 1, 1, 5, NULL, '1.5', 0);
INSERT INTO `tbl_master_kode_akun` VALUES ('coba sub 2', 1, 1, NULL, NULL, NULL, 0);
INSERT INTO `tbl_master_kode_akun` VALUES ('coba sub 2', 1, 1, NULL, NULL, NULL, 0);
INSERT INTO `tbl_master_kode_akun` VALUES ('coba sub 2', 1, 1, NULL, NULL, NULL, 0);
INSERT INTO `tbl_master_kode_akun` VALUES ('coba migelas', 1, 1, 5, 1, '1.5.1', 0);
INSERT INTO `tbl_master_kode_akun` VALUES ('coba migelas yang kedua puluh', 1, 1, 5, 2, '1.5.2', 0);

-- ----------------------------
-- Table structure for tbl_master_kode_akun_internal
-- ----------------------------
DROP TABLE IF EXISTS `tbl_master_kode_akun_internal`;
CREATE TABLE `tbl_master_kode_akun_internal`  (
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode` int(3) NULL DEFAULT NULL,
  `sub_1` int(3) NULL DEFAULT NULL,
  `sub_2` int(3) NULL DEFAULT NULL,
  `tipe_bos` int(3) NULL DEFAULT NULL,
  `kode_bos` int(3) NULL DEFAULT NULL,
  `kode_bos_sub1` int(3) NULL DEFAULT NULL,
  `kode_bos_sub2` int(3) NULL DEFAULT NULL,
  `kode_in_text` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  INDEX `kode_bos`(`kode_bos`) USING BTREE,
  INDEX `kode_bos_sub1`(`kode_bos_sub1`) USING BTREE,
  INDEX `kode_bos_sub2`(`kode_bos_sub2`) USING BTREE,
  INDEX `tbl_master_kode_akun_internal_ibfk_1`(`tipe_bos`) USING BTREE,
  CONSTRAINT `tbl_master_kode_akun_internal_ibfk_1` FOREIGN KEY (`tipe_bos`) REFERENCES `tbl_master_kode_akun` (`tipe`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_master_kode_akun_internal_ibfk_2` FOREIGN KEY (`kode_bos`) REFERENCES `tbl_master_kode_akun` (`kode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_master_kode_akun_internal_ibfk_3` FOREIGN KEY (`kode_bos_sub1`) REFERENCES `tbl_master_kode_akun` (`sub_1`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_master_kode_akun_internal_ibfk_4` FOREIGN KEY (`kode_bos_sub2`) REFERENCES `tbl_master_kode_akun` (`sub_2`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_master_kode_akun_internal
-- ----------------------------
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Alat Tulis Sekolah', 1, NULL, NULL, 2, 2, 1, NULL, '1', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('spidol boardmarkers', 1, 1, NULL, NULL, NULL, NULL, NULL, '1.1', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('pulpen', 1, 2, NULL, NULL, NULL, NULL, NULL, '1.2', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Penghapus White board', 1, 3, NULL, NULL, NULL, NULL, NULL, '1.3', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('FD Kingston 16 GB', 1, 4, NULL, NULL, NULL, NULL, NULL, '1.4', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('FD Kingston 8 GB', 1, 5, NULL, NULL, NULL, NULL, NULL, '1.5', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Mouse', 1, 6, NULL, NULL, NULL, NULL, NULL, '1.6', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Pensil', 1, 7, NULL, NULL, NULL, NULL, NULL, '1.7', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Penghapus pensil', 1, 8, NULL, NULL, NULL, NULL, NULL, '1.8', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Stipo', 1, 9, NULL, NULL, NULL, NULL, NULL, '1.9', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('CD-R', 1, 10, NULL, NULL, NULL, NULL, NULL, '1.10', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('CD-RW', 1, 11, NULL, NULL, NULL, NULL, NULL, '1.11', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Keplek', 1, 12, NULL, NULL, NULL, NULL, NULL, '1.12', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Biaya Bahan dan Alat Habis Pakai', 2, NULL, NULL, 2, 2, 2, NULL, '2', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Penyusunan pembagian tugas guru dan jadwal pelajaran', 2, 1, NULL, NULL, NULL, NULL, NULL, '2.1', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('foto copy', 2, 2, NULL, NULL, NULL, NULL, NULL, '2.2', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('kertas cd', 2, 3, NULL, NULL, NULL, NULL, NULL, '2.3', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('map snel', 2, 4, NULL, NULL, NULL, NULL, NULL, '2.4', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Minum', 2, 5, NULL, NULL, NULL, NULL, NULL, '2.5', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('matrei 6000', 2, 6, NULL, NULL, NULL, NULL, NULL, '2.6', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Matrei 3000', 2, 7, NULL, NULL, NULL, NULL, NULL, '2.7', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('tinta print hitam', 2, 8, NULL, NULL, NULL, NULL, NULL, '2.8', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('tinta print warna', 2, 9, NULL, NULL, NULL, NULL, NULL, '2.9', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('service komputer dan printer', 2, 10, NULL, NULL, NULL, NULL, NULL, '2.10', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('kertas kop', 2, 11, NULL, NULL, NULL, NULL, NULL, '2.11', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('amplop kop', 2, 12, NULL, NULL, NULL, NULL, NULL, '2.12', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Isi spidol boardmarker', 2, 13, NULL, NULL, NULL, NULL, NULL, '2.13', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Isi Steples kecil', 2, 14, NULL, NULL, NULL, NULL, NULL, '2.14', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('isolasi besar putih', 2, 15, NULL, NULL, NULL, NULL, NULL, '2.15', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Isolasi besar hitam', 2, 16, NULL, NULL, NULL, NULL, NULL, '2.16', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Kapur tulis', 2, 17, NULL, NULL, NULL, NULL, NULL, '2.17', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Service Kipas angin', 2, 18, NULL, NULL, NULL, NULL, NULL, '2.18', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Pemeliharaan dan perbaikan ringan', 3, NULL, NULL, 1, 5, NULL, NULL, '3', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Perbaikan Kelas', 3, 1, NULL, NULL, NULL, NULL, NULL, '3.1', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Pengecatan Ruang kelas', 3, 2, NULL, NULL, NULL, NULL, NULL, '3.2', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Pengecatan Ruang kantor', 3, 3, NULL, NULL, NULL, NULL, NULL, '3.4', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Perbaikan meja dan kursi', 3, 4, NULL, NULL, NULL, NULL, NULL, '3.5', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Biaya Transport', 4, NULL, NULL, 1, 7, NULL, NULL, '4', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Perjalanan Dinas Luar kota', 4, 1, NULL, NULL, NULL, NULL, NULL, '4.1', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Perjalanan Dalam Kota', 4, 2, NULL, NULL, NULL, NULL, NULL, '4.2', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Biaya Konsumsi', 5, NULL, NULL, 1, 7, NULL, NULL, '5', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Konsumsi Rapat UTS dan UAS ', 5, 1, NULL, NULL, NULL, NULL, NULL, '5.1', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Konsumsi Kegiatan Keagamaan', 5, 2, NULL, NULL, NULL, NULL, NULL, '5.2', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Konsumsi Ujian nasional', 5, 3, NULL, NULL, NULL, NULL, NULL, '5.3', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Konsumsi Kegiatan LDKS dan KTS', 5, 4, NULL, NULL, NULL, NULL, NULL, '5.4', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Biaya Pembinaan siswa/Ekstrakulikuler', 6, NULL, NULL, 1, 3, NULL, NULL, '6', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('LDKS', 6, 1, NULL, NULL, NULL, NULL, NULL, '6.1', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('PMB', 6, 2, NULL, NULL, NULL, NULL, NULL, '6.2', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('MOS', 6, 3, NULL, NULL, NULL, NULL, NULL, '6.3', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Kegiatan Keagamaan', 6, 4, NULL, NULL, NULL, NULL, NULL, '6.4', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('KTS', 6, 5, NULL, NULL, NULL, NULL, NULL, '6.5', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Biaya uji kompetensi', 7, NULL, NULL, 1, 1, NULL, NULL, '7', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Biaya Praktek kerja industri', 8, NULL, NULL, 1, 6, NULL, NULL, '8', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Biaya Pelaporan', 9, NULL, NULL, 1, 2, NULL, NULL, '9', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Pelaporan Proposal BOS ', 9, 1, NULL, NULL, NULL, NULL, NULL, '9.1', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Pelaporan SPJ Bopda', 9, 2, NULL, NULL, NULL, NULL, NULL, '9.2', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Peningkatan Mutu Pendidik dan Tenaga Kependidikan', 10, NULL, NULL, 1, 4, NULL, NULL, '10', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Penyusunan RPP', 10, 1, NULL, NULL, NULL, NULL, NULL, '10.1', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('MGMP Ma\'arif', 10, 2, NULL, NULL, NULL, NULL, NULL, '10.2', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Iuran MGMP MKKS', 10, 3, NULL, NULL, NULL, NULL, NULL, '10.3', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Biaya Transportasi MGMP MKKS', 10, 4, NULL, NULL, NULL, NULL, NULL, '10.4', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Work shop', 10, 5, NULL, NULL, NULL, NULL, NULL, '10.5', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Rapat kerja kepala sekolah', 10, 6, NULL, NULL, NULL, NULL, NULL, '10.6', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Pengembangan Kurikulum', 11, NULL, NULL, 1, 8, NULL, NULL, '11', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('UTS Semester I dan II', 11, 1, NULL, NULL, NULL, NULL, NULL, '11.1', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('UAS Semester I dan II', 11, 2, NULL, NULL, NULL, NULL, NULL, '11.2', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Ujian Ma\'arif', 11, 3, NULL, NULL, NULL, NULL, NULL, '11.3', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Ujian Sekolah', 11, 4, NULL, NULL, NULL, NULL, NULL, '11.4', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Ujian Praktek', 11, 5, NULL, NULL, NULL, NULL, NULL, '11.5', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Tri Out', 11, 6, NULL, NULL, NULL, NULL, NULL, '11.6', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Ujian Nasional', 11, 7, NULL, NULL, NULL, NULL, NULL, '11.7', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Ulangan Harian sem.I dan II', 11, 8, NULL, NULL, NULL, NULL, NULL, '11.8', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Pembelian/Pengadaan sarana dan prasarana  Pemb', 12, NULL, NULL, 1, 5, NULL, NULL, '12', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Pembelian sarana Olah raga', 12, 1, NULL, NULL, NULL, NULL, NULL, '12.1', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Pembelian sarana dan bahan kebersihan', 12, 2, NULL, NULL, NULL, NULL, NULL, '12.2', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Pembelian Perlengkapan kelas', 12, 3, NULL, NULL, NULL, NULL, NULL, '12.3', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Pengadaan buku ', 12, 4, NULL, NULL, NULL, NULL, NULL, '12.4', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Biaya Daya dan Jasa', 13, NULL, NULL, 1, 7, NULL, NULL, '13', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Rekening telepon', 13, 1, NULL, NULL, NULL, NULL, NULL, '13.1', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Rekening listrik', 13, 2, NULL, NULL, NULL, NULL, NULL, '13.2', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Biaya Upah /Gaji /Honorarium tenaga pendidik dan tenaga kependidikan', 14, NULL, NULL, 2, 2, 3, NULL, '14', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Honorarium Guru dan karyawan', 14, 1, NULL, NULL, NULL, NULL, NULL, '14.1', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Honorarium Pemb.ekstra,satpam,pak bon', 14, 2, NULL, NULL, NULL, NULL, NULL, '14.2', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Coba ya', 7, 1, NULL, NULL, NULL, NULL, NULL, '7.1', 1);
INSERT INTO `tbl_master_kode_akun_internal` VALUES ('Kupluk', 1, 13, NULL, NULL, NULL, NULL, NULL, '1.13', 1);

-- ----------------------------
-- Table structure for tbl_menu
-- ----------------------------
DROP TABLE IF EXISTS `tbl_menu`;
CREATE TABLE `tbl_menu`  (
  `id_menu` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `nama_menu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `judul_menu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `link_menu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icon_menu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `aktif_menu` int(1) NULL DEFAULT NULL,
  `tingkat_menu` int(11) NULL DEFAULT NULL,
  `urutan_menu` int(11) NULL DEFAULT NULL,
  `add_button` int(1) NULL DEFAULT NULL,
  `edit_button` int(1) NULL DEFAULT NULL,
  `delete_button` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_menu
-- ----------------------------
INSERT INTO `tbl_menu` VALUES (1, 0, 'Dashboard', 'Dashboard', 'home', 'fa fa-dashboard', 1, 1, 1, 0, 0, 0);
INSERT INTO `tbl_menu` VALUES (97, 99, 'Setting Menu', 'Setting Menu', 'set_menu_adm', NULL, 1, 2, 2, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (98, 99, 'Setting Role', 'Setting Role', 'set_role_adm', '', 1, 2, 1, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (99, 0, 'Setting (Administrator)', 'Setting', NULL, 'fa fa-gear', 1, 1, 5, 0, 0, 0);
INSERT INTO `tbl_menu` VALUES (100, 0, 'Transaksi', 'Transaksi', ' ', 'fa fa-retweet', 1, 1, 3, 0, 0, 0);
INSERT INTO `tbl_menu` VALUES (101, 100, 'Pengeluaran Harian', 'Pengeluaran Harian', 'pengeluaran', '', 1, 2, 1, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (102, 100, 'Verifikasi Pengeluaran', 'Verifikasi Pengeluaran', 'verifikasi_out', '', 1, 2, 2, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (103, 100, 'Penerimaan', 'Transaksi Penerimaan', 'penerimaan', '', 1, 2, 3, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (104, 0, 'Master', 'Master', ' ', 'fa fa-database', 1, 1, 2, 0, 0, 0);
INSERT INTO `tbl_menu` VALUES (105, 104, 'Master Satuan', 'Master Satuan', 'master_satuan', '', 1, 2, 1, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (106, 104, 'Master Akun Internal', 'Master Akun Internal', 'master_akun_internal', '', 1, 2, 2, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (107, 104, 'Master Akun Eksternal', 'Master Akun Eksternal', 'master_akun_eksternal', '', 1, 2, 3, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (108, 0, 'Laporan', 'Laporan', ' ', 'fa fa-line-chart', 1, 1, 5, 0, 0, 0);
INSERT INTO `tbl_menu` VALUES (109, 108, 'Buku Kas Umum', 'Buku Kas Umum', 'lap_bku', '', 1, 2, 2, 0, 0, 0);
INSERT INTO `tbl_menu` VALUES (110, 0, 'Penggajian', 'Penggajian', ' ', 'fa fa-money', 1, 1, 4, 0, 0, 0);
INSERT INTO `tbl_menu` VALUES (111, 110, 'Setting Gaji Guru / Karyawan', 'Setting Gaji Guru / Karyawan', 'set_gaji_guru', '', 1, 2, 1, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (112, 110, 'Setting Gaji Karyawan', 'Setting Gaji Karyawan', 'set_gaji_karyawan', '', 0, 2, 2, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (113, 110, 'Proses Penggajian', 'Proses Penggajian', 'proses_gaji', '', 1, 2, 3, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (114, 104, 'Master Guru dan Staff', 'Master Guru dan Staff', 'master_guru', '', 1, 2, 4, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (115, 104, 'Master Karyawan', 'Master Karyawan', 'master_karyawan', '', 0, 2, 5, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (116, 104, 'Master User', 'Master User', 'master_user', '', 1, 2, 6, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (117, 104, 'Master Jabatan', 'Master Jabatan', 'master_jabatan', NULL, 1, 2, 7, 1, NULL, NULL);
INSERT INTO `tbl_menu` VALUES (118, 110, 'Konfirmasi Penggajian', 'Konfirmasi Penggajian', 'konfirm_gaji', '', 1, 2, 3, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (119, 108, 'Laporan Slip Gaji', 'Laporan Slip Gaji', 'slip_gaji', ' ', 1, 2, 1, 0, 0, 0);
INSERT INTO `tbl_menu` VALUES (120, 0, 'Profil', 'Profil', 'profil', 'fa fa-user', 1, 1, 6, 0, 0, 0);
INSERT INTO `tbl_menu` VALUES (121, 108, 'Laporan K7', 'Laporan K7', 'lap_k7', '', 1, 2, 3, 0, 0, 0);
INSERT INTO `tbl_menu` VALUES (122, 108, 'Kunci Laporan', 'Kunci Laporan', 'kunci_lap', '', 1, 2, 20, 1, 1, 1);
INSERT INTO `tbl_menu` VALUES (123, 108, 'Laporan K2', 'Laporan K2', 'lap_k2', ' ', 1, 2, 4, 0, 0, 0);
INSERT INTO `tbl_menu` VALUES (124, 108, 'Laporan K1', 'Laporan K1', 'lap_k1', '', 1, 2, 5, 0, 0, 0);
INSERT INTO `tbl_menu` VALUES (125, 108, 'Laporan Pengeluaran', 'Laporan Pengeluaran', 'lap_keluar', ' ', 1, 2, 6, 0, 0, 0);
INSERT INTO `tbl_menu` VALUES (126, 108, 'Laporan Penerimaan', 'Laporan Penerimaan', 'lap_masuk', ' ', 1, 2, 7, 0, 0, 0);
INSERT INTO `tbl_menu` VALUES (127, 100, 'RAPBS', 'RAPBS', 'trans_rapbs', ' ', 1, 2, 4, 1, 1, 1);

-- ----------------------------
-- Table structure for tbl_penggajian
-- ----------------------------
DROP TABLE IF EXISTS `tbl_penggajian`;
CREATE TABLE `tbl_penggajian`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_guru` int(12) NULL DEFAULT NULL,
  `id_jabatan` int(12) NULL DEFAULT NULL,
  `bulan` int(2) NULL DEFAULT NULL,
  `tahun` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_guru` int(1) NULL DEFAULT 1,
  `gaji_pokok` double(20, 2) NULL DEFAULT NULL,
  `gaji_perjam` double(20, 2) NULL DEFAULT NULL,
  `gaji_tunjangan_jabatan` double(20, 2) NULL DEFAULT NULL,
  `gaji_tunjangan_lain` double(20, 2) NULL DEFAULT NULL,
  `jumlah_jam_kerja` int(5) NULL DEFAULT NULL,
  `potongan_lain` double(20, 2) NULL DEFAULT NULL,
  `total_take_home_pay` double(20, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `is_confirm` int(1) NULL DEFAULT 0,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_guru`(`id_guru`) USING BTREE,
  INDEX `id_jabatan`(`id_jabatan`) USING BTREE,
  CONSTRAINT `tbl_penggajian_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `tbl_guru` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_penggajian_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `tbl_jabatan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_penggajian
-- ----------------------------
INSERT INTO `tbl_penggajian` VALUES (1, 5, 2, 11, '2019', 1, 0.00, 2500.00, 1235000.00, 7500000.00, 48, 20000.00, 8835000.00, '2019-11-06 08:50:24', 1, 1);
INSERT INTO `tbl_penggajian` VALUES (2, 2, 6, 11, '2019', 0, 1000000.00, 0.00, 0.00, 0.00, 40, 0.00, 1100000.00, '2019-11-06 08:51:22', 1, 1);
INSERT INTO `tbl_penggajian` VALUES (3, 3, 3, 11, '2019', 0, 1200000.00, 0.00, 0.00, 200000.00, 40, 0.00, 1500000.00, '2019-11-06 08:51:54', 0, 0);
INSERT INTO `tbl_penggajian` VALUES (4, 4, 5, 11, '2019', 1, 0.00, 2500.00, 0.00, 5000000.00, 42, 35000.00, 5070000.00, '2019-11-06 08:52:34', 1, 1);
INSERT INTO `tbl_penggajian` VALUES (5, 1, 1, 11, '2019', 1, 0.00, 2500.00, 75000.00, 5200000.00, 50, 10000.00, 5390000.00, '2019-11-06 08:53:37', 1, 1);
INSERT INTO `tbl_penggajian` VALUES (6, 3, 3, 11, '2019', 0, 1200000.00, 0.00, 0.00, 0.00, 20, 0.00, 1250000.00, '2019-11-13 00:00:01', 1, 1);
INSERT INTO `tbl_penggajian` VALUES (7, 5, 2, 10, '2019', 1, 0.00, 2500.00, 1235000.00, 8000000.00, 60, 30000.00, 9355000.00, '2019-10-20 23:28:53', 1, 1);
INSERT INTO `tbl_penggajian` VALUES (8, 2, 6, 10, '2019', 0, 1000000.00, 0.00, 0.00, 100000.00, 40, 30000.00, 1100000.00, '2019-10-20 23:29:21', 1, 1);
INSERT INTO `tbl_penggajian` VALUES (9, 3, 3, 10, '2019', 0, 1200000.00, 2500.00, 0.00, 600000.00, 40, 30000.00, 1900000.00, '2019-10-20 23:29:48', 1, 1);

-- ----------------------------
-- Table structure for tbl_rapbs
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rapbs`;
CREATE TABLE `tbl_rapbs`  (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_rapbs
-- ----------------------------
INSERT INTO `tbl_rapbs` VALUES (4, '2019', 'USR00001', '2019-11-27 23:23:58', NULL, '2019-11-28 20:19:30');
INSERT INTO `tbl_rapbs` VALUES (5, '2019', 'USR00001', '2019-11-28 20:19:30', NULL, NULL);

-- ----------------------------
-- Table structure for tbl_rapbs_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rapbs_detail`;
CREATE TABLE `tbl_rapbs_detail`  (
  `id_header` int(14) NULL DEFAULT NULL,
  `uraian` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `qty` int(32) NULL DEFAULT NULL,
  `nama_satuan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga_satuan` double(20, 2) NULL DEFAULT NULL,
  `harga_total` double(20, 2) NULL DEFAULT NULL,
  `gaji_swasta` double(20, 2) NULL DEFAULT NULL,
  `bosnas` double(20, 2) NULL DEFAULT NULL,
  `hibah_bopda` double(20, 2) NULL DEFAULT NULL,
  `jumlah_total` double(20, 2) NULL DEFAULT NULL,
  `keterangan_belanja` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_sub` int(1) NULL DEFAULT 1,
  `urut` int(32) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `kode` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  INDEX `id_header`(`id_header`) USING BTREE,
  CONSTRAINT `tbl_rapbs_detail_ibfk_1` FOREIGN KEY (`id_header`) REFERENCES `tbl_rapbs` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_rapbs_detail
-- ----------------------------
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Alat Tulis Sekolah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '1');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'spidol boardmarkers', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 1, 2, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '1.1');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'pulpen', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 1, 3, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '1.2');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Penghapus White board', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 1, 4, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '1.3');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'FD Kingston 16 GB', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 1, 5, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '1.4');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'FD Kingston 8 GB', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 1, 6, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '1.5');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Mouse', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 1, 7, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '1.6');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Pensil', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 1, 8, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '1.7');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Penghapus pensil', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 1, 9, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '1.8');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Stipo', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 1, 10, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '1.9');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'CD-R', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 1, 11, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '1.10');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'CD-RW', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 1, 12, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '1.11');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Keplek', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 1, 13, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '1.12');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Kupluk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 14, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '1.13');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Biaya Bahan dan Alat Habis Pakai', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 15, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Penyusunan pembagian tugas guru dan jadwal pelajaran', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 1, 16, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.1');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'foto copy', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 1, 17, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.2');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'kertas cd', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 1, 18, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.3');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'map snel', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 1, 19, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.4');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Minum', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 1, 20, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.5');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'matrei 6000', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 1, 21, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.6');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Matrei 3000', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 1, 22, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.7');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'tinta print hitam', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 1, 23, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.8');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'tinta print warna', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 1, 24, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.9');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'service komputer dan printer', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 1, 25, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.10');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'kertas kop', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 1, 26, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.11');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'amplop kop', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 1, 27, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.12');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Isi spidol boardmarker', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 28, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.13');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Isi Steples kecil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 29, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.14');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'isolasi besar putih', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 30, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.15');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Isolasi besar hitam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 31, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.16');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Kapur tulis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 32, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.17');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Service Kipas angin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 33, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '2.18');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Pemeliharaan dan perbaikan ringan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 34, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '3');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Perbaikan Kelas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 35, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '3.1');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Pengecatan Ruang kelas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 36, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '3.2');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Pengecatan Ruang kantor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 37, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '3.4');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Perbaikan meja dan kursi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 38, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '3.5');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Biaya Transport', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 39, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '4');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Perjalanan Dinas Luar kota', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 40, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '4.1');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Perjalanan Dalam Kota', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 41, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '4.2');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Biaya Konsumsi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 42, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '5');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Konsumsi Rapat UTS dan UAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 43, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '5.1');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Konsumsi Kegiatan Keagamaan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 44, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '5.2');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Konsumsi Ujian nasional', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 45, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '5.3');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Konsumsi Kegiatan LDKS dan KTS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 46, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '5.4');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Biaya Pembinaan siswa/Ekstrakulikuler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 47, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '6');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'LDKS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 48, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '6.1');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'PMB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 49, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '6.2');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'MOS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 50, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '6.3');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Kegiatan Keagamaan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 51, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '6.4');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'KTS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 52, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '6.5');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Biaya uji kompetensi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 53, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '7');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Coba ya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 54, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '7.1');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Biaya Praktek kerja industri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 55, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '8');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Biaya Pelaporan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 56, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '9');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Pelaporan Proposal BOS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 57, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '9.1');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Pelaporan SPJ Bopda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 58, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '9.2');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Peningkatan Mutu Pendidik dan Tenaga Kependidikan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 59, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '10');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Penyusunan RPP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 60, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '10.1');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'MGMP Ma\'arif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 61, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '10.2');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Iuran MGMP MKKS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 62, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '10.3');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Biaya Transportasi MGMP MKKS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 63, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '10.4');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Work shop', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 64, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '10.5');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Rapat kerja kepala sekolah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 65, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '10.6');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Pengembangan Kurikulum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 66, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '11');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'UTS Semester I dan II', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 67, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '11.1');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'UAS Semester I dan II', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 68, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '11.2');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Ujian Ma\'arif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 69, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '11.3');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Ujian Sekolah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 70, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '11.4');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Ujian Praktek', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 71, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '11.5');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Tri Out', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 72, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '11.6');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Ujian Nasional', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 73, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '11.7');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Ulangan Harian sem.I dan II', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 74, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '11.8');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Pembelian/Pengadaan sarana dan prasarana  Pemb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 75, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '12');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Pembelian sarana Olah raga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 76, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '12.1');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Pembelian sarana dan bahan kebersihan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 77, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '12.2');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Pembelian Perlengkapan kelas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 78, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '12.3');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Pengadaan buku', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 79, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '12.4');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Biaya Daya dan Jasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 80, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '13');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Rekening telepon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 81, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '13.1');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Rekening listrik', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 82, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '13.2');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Biaya Upah /Gaji /Honorarium tenaga pendidik dan tenaga kependidikan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 83, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '14');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Honorarium Guru dan karyawan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 84, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '14.1');
INSERT INTO `tbl_rapbs_detail` VALUES (4, 'Honorarium Pemb.ekstra,satpam,pak bon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 85, '2019-11-27 23:23:57', NULL, '2019-11-28 20:19:30', '14.2');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Alat Tulis Sekolah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2019-11-28 20:19:30', NULL, NULL, '1');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'spidol boardmarkers', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 0, 2, '2019-11-28 20:19:30', NULL, NULL, '1.1');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'pulpen', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 0, 3, '2019-11-28 20:19:30', NULL, NULL, '1.2');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Penghapus White board', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 0, 4, '2019-11-28 20:19:30', NULL, NULL, '1.3');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'FD Kingston 16 GB', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 0, 5, '2019-11-28 20:19:30', NULL, NULL, '1.4');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'FD Kingston 8 GB', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 0, 6, '2019-11-28 20:19:30', NULL, NULL, '1.5');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Mouse', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 0, 7, '2019-11-28 20:19:30', NULL, NULL, '1.6');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Pensil', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 0, 8, '2019-11-28 20:19:30', NULL, NULL, '1.7');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Penghapus pensil', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 0, 9, '2019-11-28 20:19:30', NULL, NULL, '1.8');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Stipo', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 0, 10, '2019-11-28 20:19:30', NULL, NULL, '1.9');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'CD-R', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 0, 11, '2019-11-28 20:19:30', NULL, NULL, '1.10');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'CD-RW', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 0, 12, '2019-11-28 20:19:30', NULL, NULL, '1.11');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Keplek', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 0, 13, '2019-11-28 20:19:30', NULL, NULL, '1.12');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Kupluk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 14, '2019-11-28 20:19:30', NULL, NULL, '1.13');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Biaya Bahan dan Alat Habis Pakai', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 15, '2019-11-28 20:19:30', NULL, NULL, '2');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Penyusunan pembagian tugas guru dan jadwal pelajaran', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 0, 16, '2019-11-28 20:19:30', NULL, NULL, '2.1');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'foto copy', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 0, 17, '2019-11-28 20:19:30', NULL, NULL, '2.2');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'kertas cd', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 0, 18, '2019-11-28 20:19:30', NULL, NULL, '2.3');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'map snel', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 0, 19, '2019-11-28 20:19:30', NULL, NULL, '2.4');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Minum', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 0, 20, '2019-11-28 20:19:30', NULL, NULL, '2.5');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'matrei 6000', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 0, 21, '2019-11-28 20:19:30', NULL, NULL, '2.6');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Matrei 3000', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 0, 22, '2019-11-28 20:19:30', NULL, NULL, '2.7');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'tinta print hitam', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 0, 23, '2019-11-28 20:19:30', NULL, NULL, '2.8');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'tinta print warna', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 0, 24, '2019-11-28 20:19:30', NULL, NULL, '2.9');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'service komputer dan printer', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 0, 25, '2019-11-28 20:19:30', NULL, NULL, '2.10');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'kertas kop', 29, 'PACK', 800000.00, 90000000.00, 891000.00, NULL, 1000000.00, NULL, 'ONDE-ONDE', 0, 26, '2019-11-28 20:19:30', NULL, NULL, '2.11');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'amplop kop', 80, 'KLEP', 90000.00, 8002900.00, NULL, NULL, 90000.00, NULL, 'JAJUK', 0, 27, '2019-11-28 20:19:30', NULL, NULL, '2.12');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Isi spidol boardmarker', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 28, '2019-11-28 20:19:30', NULL, NULL, '2.13');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Isi Steples kecil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 29, '2019-11-28 20:19:30', NULL, NULL, '2.14');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'isolasi besar putih', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 30, '2019-11-28 20:19:30', NULL, NULL, '2.15');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Isolasi besar hitam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 31, '2019-11-28 20:19:30', NULL, NULL, '2.16');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Kapur tulis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 32, '2019-11-28 20:19:30', NULL, NULL, '2.17');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Service Kipas angin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 33, '2019-11-28 20:19:30', NULL, NULL, '2.18');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Pemeliharaan dan perbaikan ringan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 34, '2019-11-28 20:19:30', NULL, NULL, '3');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Perbaikan Kelas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 35, '2019-11-28 20:19:30', NULL, NULL, '3.1');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Pengecatan Ruang kelas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 36, '2019-11-28 20:19:30', NULL, NULL, '3.2');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Pengecatan Ruang kantor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 37, '2019-11-28 20:19:30', NULL, NULL, '3.4');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Perbaikan meja dan kursi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 38, '2019-11-28 20:19:30', NULL, NULL, '3.5');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Biaya Transport', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 39, '2019-11-28 20:19:30', NULL, NULL, '4');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Perjalanan Dinas Luar kota', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 40, '2019-11-28 20:19:30', NULL, NULL, '4.1');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Perjalanan Dalam Kota', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 41, '2019-11-28 20:19:30', NULL, NULL, '4.2');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Biaya Konsumsi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 42, '2019-11-28 20:19:30', NULL, NULL, '5');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Konsumsi Rapat UTS dan UAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 43, '2019-11-28 20:19:30', NULL, NULL, '5.1');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Konsumsi Kegiatan Keagamaan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 44, '2019-11-28 20:19:30', NULL, NULL, '5.2');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Konsumsi Ujian nasional', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 45, '2019-11-28 20:19:30', NULL, NULL, '5.3');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Konsumsi Kegiatan LDKS dan KTS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 46, '2019-11-28 20:19:30', NULL, NULL, '5.4');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Biaya Pembinaan siswa/Ekstrakulikuler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 47, '2019-11-28 20:19:30', NULL, NULL, '6');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'LDKS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 48, '2019-11-28 20:19:30', NULL, NULL, '6.1');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'PMB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 49, '2019-11-28 20:19:30', NULL, NULL, '6.2');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'MOS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 50, '2019-11-28 20:19:30', NULL, NULL, '6.3');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Kegiatan Keagamaan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 51, '2019-11-28 20:19:30', NULL, NULL, '6.4');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'KTS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 52, '2019-11-28 20:19:30', NULL, NULL, '6.5');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Biaya uji kompetensi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 53, '2019-11-28 20:19:30', NULL, NULL, '7');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Coba ya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 54, '2019-11-28 20:19:30', NULL, NULL, '7.1');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Biaya Praktek kerja industri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 55, '2019-11-28 20:19:30', NULL, NULL, '8');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Biaya Pelaporan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 56, '2019-11-28 20:19:30', NULL, NULL, '9');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Pelaporan Proposal BOS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 57, '2019-11-28 20:19:30', NULL, NULL, '9.1');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Pelaporan SPJ Bopda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 58, '2019-11-28 20:19:30', NULL, NULL, '9.2');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Peningkatan Mutu Pendidik dan Tenaga Kependidikan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 59, '2019-11-28 20:19:30', NULL, NULL, '10');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Penyusunan RPP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 60, '2019-11-28 20:19:30', NULL, NULL, '10.1');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'MGMP Ma\'arif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 61, '2019-11-28 20:19:30', NULL, NULL, '10.2');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Iuran MGMP MKKS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 62, '2019-11-28 20:19:30', NULL, NULL, '10.3');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Biaya Transportasi MGMP MKKS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 63, '2019-11-28 20:19:30', NULL, NULL, '10.4');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Work shop', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 64, '2019-11-28 20:19:30', NULL, NULL, '10.5');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Rapat kerja kepala sekolah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 65, '2019-11-28 20:19:30', NULL, NULL, '10.6');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Pengembangan Kurikulum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 66, '2019-11-28 20:19:30', NULL, NULL, '11');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'UTS Semester I dan II', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 67, '2019-11-28 20:19:30', NULL, NULL, '11.1');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'UAS Semester I dan II', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 68, '2019-11-28 20:19:30', NULL, NULL, '11.2');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Ujian Ma\'arif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 69, '2019-11-28 20:19:30', NULL, NULL, '11.3');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Ujian Sekolah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 70, '2019-11-28 20:19:30', NULL, NULL, '11.4');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Ujian Praktek', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 71, '2019-11-28 20:19:30', NULL, NULL, '11.5');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Tri Out', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 72, '2019-11-28 20:19:30', NULL, NULL, '11.6');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Ujian Nasional', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 73, '2019-11-28 20:19:30', NULL, NULL, '11.7');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Ulangan Harian sem.I dan II', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 74, '2019-11-28 20:19:30', NULL, NULL, '11.8');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Pembelian/Pengadaan sarana dan prasarana  Pemb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 75, '2019-11-28 20:19:30', NULL, NULL, '12');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Pembelian sarana Olah raga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 76, '2019-11-28 20:19:30', NULL, NULL, '12.1');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Pembelian sarana dan bahan kebersihan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 77, '2019-11-28 20:19:30', NULL, NULL, '12.2');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Pembelian Perlengkapan kelas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 78, '2019-11-28 20:19:30', NULL, NULL, '12.3');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Pengadaan buku', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 79, '2019-11-28 20:19:30', NULL, NULL, '12.4');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Biaya Daya dan Jasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 80, '2019-11-28 20:19:30', NULL, NULL, '13');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Rekening telepon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 81, '2019-11-28 20:19:30', NULL, NULL, '13.1');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Rekening listrik', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 82, '2019-11-28 20:19:30', NULL, NULL, '13.2');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Biaya Upah /Gaji /Honorarium tenaga pendidik dan tenaga kependidikan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 83, '2019-11-28 20:19:30', NULL, NULL, '14');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Honorarium Guru dan karyawan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 84, '2019-11-28 20:19:30', NULL, NULL, '14.1');
INSERT INTO `tbl_rapbs_detail` VALUES (5, 'Honorarium Pemb.ekstra,satpam,pak bon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 85, '2019-11-28 20:19:30', NULL, NULL, '14.2');

-- ----------------------------
-- Table structure for tbl_satuan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_satuan`;
CREATE TABLE `tbl_satuan`  (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_satuan
-- ----------------------------
INSERT INTO `tbl_satuan` VALUES (1, 'PCS', 'Pieces', 1);
INSERT INTO `tbl_satuan` VALUES (2, 'PACK', 'Pack', 1);
INSERT INTO `tbl_satuan` VALUES (3, 'BOX', 'Box', 1);
INSERT INTO `tbl_satuan` VALUES (4, 'KG', 'Kilogram', 1);
INSERT INTO `tbl_satuan` VALUES (5, 'DUZ', 'Duz', 1);
INSERT INTO `tbl_satuan` VALUES (6, 'LBR', 'Lembar', 1);
INSERT INTO `tbl_satuan` VALUES (7, 'UANG', 'Satuan Uang', 1);
INSERT INTO `tbl_satuan` VALUES (8, 'ASASF', 'asf', 1);
INSERT INTO `tbl_satuan` VALUES (9, 'RP', 'Satuan Rupiah', 1);

-- ----------------------------
-- Table structure for tbl_set_gaji
-- ----------------------------
DROP TABLE IF EXISTS `tbl_set_gaji`;
CREATE TABLE `tbl_set_gaji`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jabatan` int(14) NULL DEFAULT NULL,
  `gaji_pokok` double(20, 2) NULL DEFAULT NULL,
  `gaji_perjam` double(20, 2) NULL DEFAULT NULL,
  `gaji_tunjangan_jabatan` double(20, 2) NULL DEFAULT NULL,
  `is_guru` int(1) NULL DEFAULT 1,
  `is_aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_jabatan`(`id_jabatan`) USING BTREE,
  CONSTRAINT `tbl_set_gaji_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `tbl_jabatan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_set_gaji
-- ----------------------------
INSERT INTO `tbl_set_gaji` VALUES (1, 1, 0.00, 2500.00, 75000.00, 1, 1);
INSERT INTO `tbl_set_gaji` VALUES (2, 5, 0.00, 2500.00, 0.00, 1, 1);
INSERT INTO `tbl_set_gaji` VALUES (3, 2, 0.00, 2500.00, 1235000.00, 1, 1);
INSERT INTO `tbl_set_gaji` VALUES (4, 6, 1000000.00, 0.00, 0.00, 0, 1);
INSERT INTO `tbl_set_gaji` VALUES (5, 4, 1100000.00, 0.00, 0.00, 0, 1);
INSERT INTO `tbl_set_gaji` VALUES (6, 3, 1200000.00, 2500.00, 0.00, 0, 1);

-- ----------------------------
-- Table structure for tbl_trans_keluar
-- ----------------------------
DROP TABLE IF EXISTS `tbl_trans_keluar`;
CREATE TABLE `tbl_trans_keluar`  (
  `id` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_id` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pemohon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL COMMENT '1: belum diverifikasi, 0: sudah diverifikasi',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `tbl_trans_keluar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_trans_keluar
-- ----------------------------
INSERT INTO `tbl_trans_keluar` VALUES ('OUT101900001', 'USR00001', 'baedah', '2019-10-20', 0, '2019-10-20 22:49:20', NULL);
INSERT INTO `tbl_trans_keluar` VALUES ('OUT101900002', 'USR00001', 'GAJI BULANAN', '2019-10-31', 0, '2019-10-20 23:30:23', NULL);
INSERT INTO `tbl_trans_keluar` VALUES ('OUT101900003', 'USR00001', 'GAJI BULANAN', '2019-10-31', 0, '2019-10-20 23:30:31', NULL);
INSERT INTO `tbl_trans_keluar` VALUES ('OUT111900002', 'USR00001', 'Sueb', '2019-11-05', 0, '2019-11-05 14:44:32', NULL);
INSERT INTO `tbl_trans_keluar` VALUES ('OUT111900003', 'USR00001', 'GAJI BULANAN', '2019-11-30', 0, '2019-11-07 23:31:23', NULL);
INSERT INTO `tbl_trans_keluar` VALUES ('OUT111900004', 'USR00001', 'GAJI BULANAN', '2019-11-30', 0, '2019-11-13 00:10:54', NULL);
INSERT INTO `tbl_trans_keluar` VALUES ('OUT111900005', 'USR00001', 'yanto', '2019-11-29', 1, '2019-11-29 18:30:36', NULL);

-- ----------------------------
-- Table structure for tbl_trans_keluar_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_trans_keluar_detail`;
CREATE TABLE `tbl_trans_keluar_detail`  (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `id_trans_keluar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `satuan` int(4) NULL DEFAULT NULL,
  `qty` int(32) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0 COMMENT '1:sudah diverifikasi, 0: belum',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_trans_keluar`(`id_trans_keluar`) USING BTREE,
  INDEX `satuan`(`satuan`) USING BTREE,
  CONSTRAINT `tbl_trans_keluar_detail_ibfk_1` FOREIGN KEY (`id_trans_keluar`) REFERENCES `tbl_trans_keluar` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_trans_keluar_detail_ibfk_2` FOREIGN KEY (`satuan`) REFERENCES `tbl_satuan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_trans_keluar_detail
-- ----------------------------
INSERT INTO `tbl_trans_keluar_detail` VALUES (13, 'OUT111900002', 'lontong kupang', 1, 6, 1);
INSERT INTO `tbl_trans_keluar_detail` VALUES (14, 'OUT111900002', 'Gado-Gado', 1, 12, 1);
INSERT INTO `tbl_trans_keluar_detail` VALUES (22, 'OUT111900003', 'Gaji Bulanan Guru', 9, 1, 1);
INSERT INTO `tbl_trans_keluar_detail` VALUES (28, 'OUT111900004', 'Gaji Bulanan Staff/Karyawan', 9, 1, 1);
INSERT INTO `tbl_trans_keluar_detail` VALUES (29, 'OUT101900001', 'kripik udang', 1, 6, 1);
INSERT INTO `tbl_trans_keluar_detail` VALUES (30, 'OUT101900002', 'Gaji Bulanan Staff/Karyawan', 9, 1, 1);
INSERT INTO `tbl_trans_keluar_detail` VALUES (31, 'OUT101900003', 'Gaji Bulanan Guru', 9, 1, 1);
INSERT INTO `tbl_trans_keluar_detail` VALUES (32, 'OUT111900005', 'beli pensil', 1, 12, 0);

-- ----------------------------
-- Table structure for tbl_trans_masuk
-- ----------------------------
DROP TABLE IF EXISTS `tbl_trans_masuk`;
CREATE TABLE `tbl_trans_masuk`  (
  `id` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_id` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0 COMMENT '0: Belum diverifikasi, 1: sudah diverifikasi',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `is_bos` int(1) NULL DEFAULT 0 COMMENT '0: Bukan Bos, 1: Dari Bos',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `tbl_trans_masuk_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_trans_masuk
-- ----------------------------
INSERT INTO `tbl_trans_masuk` VALUES ('MSK101900001', 'USR00001', '2019-10-20', 1, '2019-10-20 23:27:05', NULL, 1);
INSERT INTO `tbl_trans_masuk` VALUES ('MSK111900001', 'USR00001', '2019-11-06', 0, '2019-11-06 09:57:03', NULL, 1);

-- ----------------------------
-- Table structure for tbl_trans_masuk_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_trans_masuk_detail`;
CREATE TABLE `tbl_trans_masuk_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trans_masuk` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `satuan` int(10) NULL DEFAULT NULL,
  `qty` int(10) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL COMMENT '0: Belum diverifikasi, 1: Sudah diverifikasi',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_trans_masuk`(`id_trans_masuk`) USING BTREE,
  INDEX `satuan`(`satuan`) USING BTREE,
  CONSTRAINT `tbl_trans_masuk_detail_ibfk_1` FOREIGN KEY (`id_trans_masuk`) REFERENCES `tbl_trans_masuk` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_trans_masuk_detail_ibfk_2` FOREIGN KEY (`satuan`) REFERENCES `tbl_satuan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_trans_masuk_detail
-- ----------------------------
INSERT INTO `tbl_trans_masuk_detail` VALUES (1, 'MSK111900001', 'Bantuan BOS November 2019', 9, 1, 0);
INSERT INTO `tbl_trans_masuk_detail` VALUES (2, 'MSK101900001', 'BOS OKTOBER 2019', 9, 1, 1);

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `id_user` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_level_user` int(11) NULL DEFAULT NULL,
  `id_pegawai` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('USR00001', 'ADMIN', 'kmJnZmZo', 1, NULL, 1, NULL, '2019-10-05 21:34:14', '2019-12-01 22:50:04');
INSERT INTO `tbl_user` VALUES ('USR00002', 'KEPSEK', 'kmJnZmZo', 4, NULL, 1, NULL, '2019-11-09 19:36:13', '2019-12-01 22:49:22');
INSERT INTO `tbl_user` VALUES ('USR00003', 'KEUANGAN', 'kmJnZmZo', 3, NULL, 1, NULL, '2019-11-09 19:43:19', '2019-12-01 22:49:04');
INSERT INTO `tbl_user` VALUES ('USR00004', 'TATAUSAHA', 'kmJnZmZo', 2, NULL, 1, NULL, '2019-11-09 19:45:18', '2019-12-01 22:49:40');

-- ----------------------------
-- Table structure for tbl_user_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_detail`;
CREATE TABLE `tbl_user_detail`  (
  `id_user_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_lengkap_user` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Akun Baru',
  `alamat_user` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `tanggal_lahir_user` date NULL DEFAULT '1970-01-01',
  `jenis_kelamin_user` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_telp_user` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar_user` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'user_default.png',
  `thumb_gambar_user` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'user_default_thumb.png',
  PRIMARY KEY (`id_user_detail`) USING BTREE,
  UNIQUE INDEX `id_user`(`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user_detail
-- ----------------------------
INSERT INTO `tbl_user_detail` VALUES (1, 'USR00001', 'Rizky Yuanda', 'Jl. Ngagel Tirto IIB/6 Surabaya, Jawa Timur, Indonesia', '1991-04-03', 'L', '081703403473', 'admin-1573576263.jpg', 'admin-1573576263_thumb.jpg');
INSERT INTO `tbl_user_detail` VALUES (8, 'USR00002', 'Kepala Sekolah', 'aifudf nisduf sidufis ndudrs', '1945-10-09', 'L', '0819218129121', 'kepsek-1573302973.jpg', 'kepsek-1573302973_thumb.jpg');
INSERT INTO `tbl_user_detail` VALUES (9, 'USR00003', 'Keuangan', 'asfsd', '1963-02-14', 'L', '121312', 'keuangan-1573303398.jpg', 'keuangan-1573303398_thumb.jpg');
INSERT INTO `tbl_user_detail` VALUES (10, 'USR00004', 'Tata Usaha', 'dsdsdfs', '1945-01-01', 'P', '7397293892', 'tatausaha-1573303518.png', 'tatausaha-1573303518_thumb.png');

-- ----------------------------
-- Table structure for tbl_verifikasi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_verifikasi`;
CREATE TABLE `tbl_verifikasi`  (
  `id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_out` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_out_detail` int(32) NULL DEFAULT NULL,
  `id_in` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_in_detail` int(32) NULL DEFAULT NULL,
  `user_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `gambar_bukti` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga_satuan` double(20, 2) NULL DEFAULT NULL,
  `harga_total` double(20, 2) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `tipe_akun` int(1) NULL DEFAULT NULL,
  `kode_akun` int(1) NULL DEFAULT NULL,
  `sub1_akun` int(1) NULL DEFAULT NULL,
  `sub2_akun` int(1) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `tipe_transaksi` int(1) NULL DEFAULT 2 COMMENT '1: Penerimaan, 2: Pengeluaran',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_out`(`id_out`) USING BTREE,
  INDEX `id_out_detail`(`id_out_detail`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `tbl_verifikasi_ibfk_1` FOREIGN KEY (`id_out`) REFERENCES `tbl_trans_keluar` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_verifikasi_ibfk_2` FOREIGN KEY (`id_out_detail`) REFERENCES `tbl_trans_keluar_detail` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_verifikasi_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_verifikasi
-- ----------------------------
INSERT INTO `tbl_verifikasi` VALUES ('VRY101900001', 'OUT101900001', 29, NULL, NULL, 'USR00001', '2019-10-20', 'images.jpg', 15000.00, 90000.00, 1, 1, 2, 5, NULL, '2019-10-20 23:21:21', NULL, 2);
INSERT INTO `tbl_verifikasi` VALUES ('VRY101900002', NULL, NULL, 'MSK101900001', 2, 'USR00001', '2019-10-20', 'img_USR00006.PNG', 60000000.00, 60000000.00, 1, NULL, NULL, NULL, NULL, '2019-10-20 23:27:05', NULL, 1);
INSERT INTO `tbl_verifikasi` VALUES ('VRY101900003', 'OUT101900002', 30, NULL, NULL, 'USR00001', '2019-10-31', NULL, 3000000.00, 3000000.00, 2, 2, 2, 3, NULL, '2019-10-20 23:30:23', NULL, 2);
INSERT INTO `tbl_verifikasi` VALUES ('VRY101900004', 'OUT101900003', 31, NULL, NULL, 'USR00001', '2019-10-31', NULL, 9355000.00, 9355000.00, 2, 2, 2, 3, NULL, '2019-10-20 23:30:31', NULL, 2);
INSERT INTO `tbl_verifikasi` VALUES ('VRY111900001', 'OUT111900002', 13, NULL, NULL, 'USR00001', '2019-11-05', 'images.jpg', 12000.00, 72000.00, 1, 1, 7, 1, 1, '2019-11-05 15:12:13', NULL, 2);
INSERT INTO `tbl_verifikasi` VALUES ('VRY111900002', 'OUT111900002', 14, NULL, NULL, 'USR00001', '2019-11-05', 'images.jpg', 15000.00, 180000.00, 1, 1, 7, 1, 1, '2019-11-05 15:12:13', NULL, 2);
INSERT INTO `tbl_verifikasi` VALUES ('VRY111900006', 'OUT111900003', 22, NULL, NULL, 'USR00001', '2019-11-30', NULL, 19295000.00, 19295000.00, 2, 2, 2, 3, NULL, '2019-11-07 23:31:23', NULL, 2);
INSERT INTO `tbl_verifikasi` VALUES ('VRY111900007', 'OUT111900004', 28, NULL, NULL, 'USR00001', '2019-11-30', NULL, 2350000.00, 2350000.00, 2, 2, 2, 3, NULL, '2019-11-13 00:10:54', NULL, 2);

SET FOREIGN_KEY_CHECKS = 1;
