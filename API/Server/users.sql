/*
 Navicat Premium Data Transfer

 Source Server         : vako_motors
 Source Server Type    : MySQL
 Source Server Version : 100512
 Source Host           : 45.84.205.0:3306
 Source Schema         : u609332810_wkmtr

 Target Server Type    : MySQL
 Target Server Version : 100512
 File Encoding         : 65001

 Date: 14/05/2022 11:53:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `middlename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `token` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `salutation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `profession` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `addressType` int NULL DEFAULT NULL,
  `institution` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `logged` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `last_ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `last_login_datetime` datetime NULL DEFAULT NULL,
  `reset_key` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `reset_pendding` int NULL DEFAULT NULL,
  `actived` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'Admin', 'Admen', '571197490', 'ucha2bokeria@gmail.com', 'admin', '$2y$10$RoRJd/8k98Tdl/f6vcVADes.UFSs4GDIoAF76/83Ps7.nWzuR9qVq', 'f3b24f95a8891517447c4085fdc9d59232325f30345f31382e3038303435397563686131626f6b6572696140676d61696c2e636f6d', '1', 'Dr', 'Developer', 1, '', '', 'Georgia', 'Tbilisi', '1', '', '2022-04-18 20:32:59', '8c7215f58ca9aa466782b4571a1afb2432325f30335f32302e303930333137db1c82587a52d4068b4b095ea07a3f977563686131626f6b6572696140676d61696c2e636f6d7733703261', 1, 1);
INSERT INTO `users` VALUES (25, 'Nikoloz', 'Tchavtchanidze', 'NTCH', '+995558141190', 'nikolozchavchanidze@gmail.com', 'nchavchanidze', '$2y$10$y6Qt3Bq.E39MljzR04D0ue2MXpdfcrfiXsBCALxOAFhHROmPFy.8q', '', '1', 'Mr.', 'Surgery', 0, 'Institution', 'Department', 'Georgia', 'Tbilisi', '0', '', '2022-05-04 19:03:51', 'a05be47418fbaf276f2da97b5e1882d732325f30335f33312e3036303335329857bc844f6527f16b802bba86c190d66e696b6f6c6f7a636861766368616e69647a6540676d61696c2e636f6d7733703261', 1, 1);

SET FOREIGN_KEY_CHECKS = 1;
