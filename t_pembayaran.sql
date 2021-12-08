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

 Date: 08/12/2021 15:15:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `t_pembayaran`;
CREATE TABLE `t_pembayaran`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_reg` int(11) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `id_user` int(11) NULL DEFAULT NULL,
  `disc_persen` float NULL DEFAULT NULL,
  `disc_rp` float(20, 2) NULL DEFAULT NULL,
  `disc_nilai` float(20, 2) NULL DEFAULT NULL,
  `total_bruto` float(20, 2) NULL DEFAULT NULL,
  `total_nett` float(20, 2) NULL DEFAULT NULL,
  `is_cash` int(1) NULL DEFAULT NULL COMMENT '1: tunai',
  `reff_trans_kredit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'kode refferensi jika transaksi non tunai (debit, transfer, etc)',
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `rupiah_bayar` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rupiah_kembali` float(20, 2) NULL DEFAULT NULL,
  `is_locked` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_pembayaran
-- ----------------------------
INSERT INTO `t_pembayaran` VALUES (1, 1, '2021-12-08', 1, 0, 50000.00, 50000.00, 515000.00, 465000.00, 1, NULL, NULL, NULL, '2021-12-08 14:01:33', '470000.00', 5000.00, 1);

SET FOREIGN_KEY_CHECKS = 1;
