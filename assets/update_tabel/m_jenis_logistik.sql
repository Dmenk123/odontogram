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

 Date: 15/09/2020 14:31:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_jenis_logistik
-- ----------------------------
INSERT INTO `m_jenis_logistik` VALUES (1, 'Obat', NULL, NULL, NULL);
INSERT INTO `m_jenis_logistik` VALUES (2, 'Bahan Habis Pakai', NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
