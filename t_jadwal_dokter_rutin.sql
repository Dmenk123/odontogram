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

 Date: 02/01/2022 21:00:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_jadwal_dokter_rutin
-- ----------------------------
DROP TABLE IF EXISTS `t_jadwal_dokter_rutin`;
CREATE TABLE `t_jadwal_dokter_rutin`  (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `id_dokter` int(32) NULL DEFAULT NULL,
  `id_klinik` int(32) NULL DEFAULT NULL,
  `jam_mulai` time(0) NULL DEFAULT NULL,
  `jam_akhir` time(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `hari` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_dokter`(`id_dokter`) USING BTREE,
  INDEX `id_klinik`(`id_klinik`) USING BTREE,
  CONSTRAINT `t_jadwal_dokter_rutin_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `m_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_jadwal_dokter_rutin_ibfk_2` FOREIGN KEY (`id_klinik`) REFERENCES `m_klinik` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_jadwal_dokter_rutin
-- ----------------------------
INSERT INTO `t_jadwal_dokter_rutin` VALUES (1, 1, 3, '07:00:00', '15:00:00', '2021-12-26 20:17:33', NULL, '2021-12-30 20:13:05', 'senin');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (2, 2, 3, '07:00:00', '14:00:00', '2021-12-26 20:19:26', NULL, '2021-12-30 20:13:09', 'selasa');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (3, 1, 3, '08:00:00', '12:00:00', '2021-12-26 20:20:08', NULL, '2021-12-30 20:13:11', 'rabu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (4, 1, 3, '09:00:00', '14:00:00', '2021-12-26 20:20:40', NULL, '2021-12-30 20:13:14', 'kamis');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (5, 2, 3, '07:00:00', '12:00:00', '2021-12-26 20:21:08', NULL, '2021-12-30 20:13:16', 'jumat');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (6, 1, 3, '08:00:00', '14:00:00', '2021-12-26 20:21:40', NULL, '2021-12-30 20:13:19', 'sabtu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (7, 2, 3, '09:00:00', '16:00:00', '2021-12-26 20:22:10', NULL, '2021-12-30 20:13:22', 'minggu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (8, 2, 3, '07:00:00', '14:00:00', '2021-12-26 20:22:44', NULL, '2021-12-30 20:13:24', 'rabu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (9, 1, 4, '15:00:00', '21:00:00', '2021-12-30 20:11:05', NULL, '2021-12-30 20:12:28', 'selasa');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (10, 1, 4, '15:00:00', '21:00:00', '2021-12-30 20:11:55', NULL, '2021-12-30 20:12:31', 'kamis');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (11, 1, 3, '15:00:00', '21:00:00', '2021-12-30 20:13:39', NULL, '2021-12-30 20:15:02', 'senin');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (12, 1, 3, '15:00:00', '21:00:00', '2021-12-30 20:13:57', NULL, NULL, 'kamis');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (13, 6, 3, '15:00:00', '19:00:00', '2021-12-30 20:14:34', NULL, NULL, 'jumat');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (14, 1, 3, '15:00:00', '21:00:00', '2021-12-30 20:15:24', NULL, NULL, 'selasa');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (15, 1, 3, '15:00:00', '21:00:00', '2021-12-30 20:15:24', NULL, '2021-12-30 20:15:37', 'selasa');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (16, 7, 3, '15:00:00', '19:00:00', '2021-12-30 20:16:13', NULL, NULL, 'senin');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (17, 7, 3, '14:00:00', '17:00:00', '2021-12-30 20:16:45', NULL, NULL, 'sabtu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (18, 8, 3, '15:00:00', '19:00:00', '2021-12-30 20:17:20', NULL, NULL, 'rabu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (19, 8, 4, '15:00:00', '21:00:00', '2021-12-30 20:20:16', NULL, NULL, 'senin');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (20, 7, 4, '15:00:00', '21:00:00', '2021-12-30 20:21:00', NULL, NULL, 'rabu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (21, 6, 4, '15:00:00', '21:00:00', '2021-12-30 20:22:21', NULL, NULL, 'selasa');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (22, 6, 4, '15:00:00', '21:00:00', '2021-12-30 20:23:04', NULL, NULL, 'kamis');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (23, 6, 4, '15:00:00', '21:00:00', '2021-12-30 20:23:24', NULL, NULL, 'sabtu');
INSERT INTO `t_jadwal_dokter_rutin` VALUES (24, 1, 4, '14:00:00', '21:00:00', '2021-12-30 20:23:46', NULL, NULL, 'jumat');

SET FOREIGN_KEY_CHECKS = 1;
