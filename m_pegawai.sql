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

 Date: 27/12/2021 01:37:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_pasien
-- ----------------------------
DROP TABLE IF EXISTS `m_pasien`;
CREATE TABLE `m_pasien`  (
  `id` int(11) NOT NULL,
  `no_rm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_lahir` date NULL DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis_kelamin` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `suku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_rumah` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `telp_rumah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_kantor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `file_ktp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_pasien
-- ----------------------------
INSERT INTO `m_pasien` VALUES (1, 'AN.1985.03.0001', 'ANDY', 'surabaya', '1985-03-02', '882712121881819', 'L', 'Pribumi', 'Wiraswasta', 'Jl. A Yuni 201 Surabaya', '03128128182', NULL, '071827182718', 1, '2021-12-12 20:35:53', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (2, 'AN.1992.02.0002', 'ANWAR', 'Magetan', '1992-02-14', '18219281928', 'L', 'Negrito', 'PNS', 'Jl. abcd 12', NULL, NULL, '182192819289', 1, '2021-12-12 20:37:36', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (3, 'NI.1997.08.0001', 'NINGSIH', 'Surabaya', '1997-08-14', '1821982919', 'P', 'Pinoy', 'TNI', 'Jl. 1kjakjaksj', NULL, NULL, '18291829182912', 1, '2021-12-12 20:38:59', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (4, 'YA.2012.02.0001', 'YAYAN', 'SURABAYA', '2012-02-04', '-', 'L', 'CAMPURAN', 'PELAJAR', 'JL. abcde', NULL, '-', '08127182718278', 1, '2021-12-16 01:03:00', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (5, 'AG.1954.12.0001', 'AGUS ULUM MULYO, S.KOM., MT', 'Surabaya', '1954-12-12', '357853532353535', 'L', 'Indo', 'asasas', 'Jl. aksjaksjak  akjsk jakjaks', 'asas', 'asdasdas', '0816656560506', 1, '2021-12-20 15:54:22', NULL, NULL, '5-1640456210.jpeg');
INSERT INTO `m_pasien` VALUES (6, 'MA.00.01', 'MARWAH', 'Disana', '2021-12-21', '35131312309223', 'P', 'Dayak', 'Artis', 'sadsa', '00990', 'asdaddads', '0909091', 1, '2021-12-21 04:47:20', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (7, 'YU.00.01', 'YULI', 'Disna', '2021-12-21', '0728192212', 'P', 'Jawa', 'Artis', 'Disna', '08192727191', 'Yuhu', '08829292', 1, '2021-12-21 04:52:55', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (8, 'NU.00.01', 'NUR CAHYONO', 'Surabaya', '1994-08-21', '3578142108940001', 'L', 'Jawa', 'Programmer', 'Jl. raya Tubanan', '', 'Jl. raya Tubanan', '089235432546', 1, '2021-12-21 09:30:58', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (9, 'RO.00.01', 'ROY', 'Mataram', '0000-00-00', '567856786786', 'L', 'Jawa', 'Dokter', 'Jalan Bukit Golf M2/02', '88889982', 'Jalan Bukit Golf M2/02', '081388889982', 1, '2021-12-21 11:44:45', NULL, NULL, NULL);
INSERT INTO `m_pasien` VALUES (10, 'DR.00.01', 'DR ARMAND', 'asasas', '1990-03-03', '357859565656565', 'L', '', 'a', 'as', 'asa', 'as', 'as', 1, '2021-12-23 13:55:33', NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
