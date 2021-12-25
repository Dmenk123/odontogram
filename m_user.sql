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

 Date: 25/12/2021 13:12:34
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
  `last_login` datetime(0) NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'user_default.png',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES ('1', 1, '1', 'USR-00001', 'admin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-25 11:55:04', 'user_default.png', '2020-09-06 20:18:00', '2021-12-25 11:55:04', NULL);
INSERT INTO `m_user` VALUES ('2', 4, '1', 'USR-00002', 'drg_roy', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-25 12:38:18', 'drg-roy-1639131886.jpg', '2021-12-10 17:24:46', '2021-12-25 12:38:18', NULL);
INSERT INTO `m_user` VALUES ('3', 3, '3', 'USR-00003', 'admin_pusat', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-25 11:54:04', 'admin-pusat-1639316581.jpg', '2021-12-12 20:43:01', '2021-12-25 11:54:04', NULL);
INSERT INTO `m_user` VALUES ('4', 3, '4', 'USR-00004', 'admin_cabang', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-12-20 11:21:50', 'admin-cabang-1639883750.jpg', '2021-12-19 10:15:50', '2021-12-20 11:21:50', NULL);
INSERT INTO `m_user` VALUES ('5', 4, '6', 'USR-00005', 'drg_martin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, NULL, 'drg-martin-1640412721.jpg', '2021-12-25 13:12:00', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
