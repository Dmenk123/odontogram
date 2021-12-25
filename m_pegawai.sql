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

 Date: 25/12/2021 13:12:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
INSERT INTO `m_pegawai` VALUES ('2', '1', 'PEG-00002', 'Drg. Ronald', 'Perum Sedati Tambak Blok Z-39', '1782781278', '17287182718', '2020-11-12 00:29:41', NULL, NULL, 1, NULL);
INSERT INTO `m_pegawai` VALUES ('3', '2', 'PEG-00003', 'Miss Tery', 'Jl. awauwiauwiauw', '19281928192812', '', '2021-12-12 20:41:58', NULL, NULL, 1, NULL);
INSERT INTO `m_pegawai` VALUES ('4', '2', 'PEG-00004', 'Miss Tar', 'asalskalsk', '10210210290129', '', '2021-12-16 23:40:36', NULL, NULL, 1, NULL);
INSERT INTO `m_pegawai` VALUES ('5', '3', 'PEG-00005', 'Suwanto Efendi', 'asasas', '121212', '12121', '2021-12-23 13:22:15', NULL, NULL, 1, NULL);
INSERT INTO `m_pegawai` VALUES ('6', '1', 'PEG-00006', 'Drg Martin', 'Jl, akjskajskaj', '0781212812818', '', '2021-12-25 13:11:04', NULL, NULL, 1, NULL);

SET FOREIGN_KEY_CHECKS = 1;
