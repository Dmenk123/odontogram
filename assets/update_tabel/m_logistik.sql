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

 Date: 15/09/2020 14:31:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_logistik
-- ----------------------------
INSERT INTO `m_logistik` VALUES (1, '001', 'Oskadon', 1000, '1500', 2, 1, NULL, NULL, NULL);
INSERT INTO `m_logistik` VALUES (2, '002', 'Masker tes', 1000, '2000', 5, 2, '2020-09-15 11:54:34', '2020-09-15 13:48:10', NULL);

SET FOREIGN_KEY_CHECKS = 1;
