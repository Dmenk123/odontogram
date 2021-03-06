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

 Date: 30/09/2020 23:14:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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

SET FOREIGN_KEY_CHECKS = 1;
