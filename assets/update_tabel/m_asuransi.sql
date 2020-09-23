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

 Date: 23/09/2020 12:45:35
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

SET FOREIGN_KEY_CHECKS = 1;
