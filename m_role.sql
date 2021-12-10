/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50731
 Source Host           : localhost:3306
 Source Schema         : odontogram

 Target Server Type    : MySQL
 Target Server Version : 50731
 File Encoding         : 65001

 Date: 10/12/2021 08:37:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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

SET FOREIGN_KEY_CHECKS = 1;
