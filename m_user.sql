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

 Date: 17/12/2021 15:31:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user`  (
  `id` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_role` int(11) NULL DEFAULT NULL,
  `id_pegawai` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode_user` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `last_login` datetime NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'user_default.png',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES ('1', 1, '1', 'USR-00001', 'admin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-17 14:36:25', 'user_default.png', '2020-09-06 20:18:00', '2021-12-17 14:36:25', NULL);
INSERT INTO `m_user` VALUES ('2', 4, '1', 'USR-00002', 'drg_roy', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-17 10:24:41', 'drg-roy-1639131886.jpg', '2021-12-10 17:24:46', '2021-12-17 10:24:41', NULL);
INSERT INTO `m_user` VALUES ('3', 3, '3', 'USR-00003', 'admin_pusat', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-17 15:19:14', 'admin-pusat-1639316581.jpg', '2021-12-12 20:43:01', '2021-12-17 15:19:14', NULL);

SET FOREIGN_KEY_CHECKS = 1;
