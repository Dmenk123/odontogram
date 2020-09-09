/*
 Navicat Premium Data Transfer

 Source Server         : sql local
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : odontogram

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 09/09/2020 15:09:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_tindakan
-- ----------------------------
INSERT INTO `m_tindakan` VALUES (1, 'T001', 'Operasi', 100000, NULL, NULL, NULL);
INSERT INTO `m_tindakan` VALUES (2, 'T002', 'Penambalan Gigi Cuy', 50000, '2020-09-09 14:35:45', '2020-09-09 15:05:11', NULL);

SET FOREIGN_KEY_CHECKS = 1;
