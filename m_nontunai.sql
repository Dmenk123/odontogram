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

 Date: 25/12/2021 23:08:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_nontunai
-- ----------------------------
INSERT INTO `m_nontunai` VALUES (1, 'Ovo', NULL, NULL, NULL);
INSERT INTO `m_nontunai` VALUES (2, 'Debit', NULL, NULL, NULL);
INSERT INTO `m_nontunai` VALUES (3, 'Shopee', NULL, NULL, NULL);
INSERT INTO `m_nontunai` VALUES (4, 'Dana', NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
