/*
 Navicat Premium Data Transfer

 Source Server         : XAMPP
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : dots

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 07/03/2024 07:50:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for dots_account_info
-- ----------------------------
DROP TABLE IF EXISTS `dots_account_info`;
CREATE TABLE `dots_account_info`  (
  `HRIS_ID` int NOT NULL,
  `FULL_NAME` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `INITIAL` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `OFFICE_ID` int NULL DEFAULT NULL,
  `DEPT_ID` int NULL DEFAULT NULL,
  `USERNAME` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PASSWORD` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `DIVISION` int NOT NULL,
  `DOTS_PRIV` tinyint NULL DEFAULT NULL,
  PRIMARY KEY (`HRIS_ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_account_info
-- ----------------------------
INSERT INTO `dots_account_info` VALUES (25009, 'Aisha Priya Patel', 'APP', NULL, 1, 'aishappatel', '', 1, NULL);
INSERT INTO `dots_account_info` VALUES (27003, 'Sarah Grace Lee', 'SGL', NULL, 2, 'sarahglee', '', 2, NULL);
INSERT INTO `dots_account_info` VALUES (29005, 'Emily Mei Chen', 'EMC', NULL, 3, 'emilymchen', '', 3, NULL);
INSERT INTO `dots_account_info` VALUES (31007, 'Sophia Fatima Khan', 'SFK', NULL, 1, 'sophiafkhan', '', 4, NULL);
INSERT INTO `dots_account_info` VALUES (32001, 'Mia Elizabeth Johnson', 'MEJ', NULL, 2, 'miaejohnson', '', 4, NULL);
INSERT INTO `dots_account_info` VALUES (34010, 'Daniel Thomas White', 'DTW', NULL, 3, 'danieltwhite', '', 5, NULL);
INSERT INTO `dots_account_info` VALUES (36006, 'Jameson Michael Clark', 'JMC', NULL, 4, 'jamesonmclark', '', 2, NULL);
INSERT INTO `dots_account_info` VALUES (38004, 'Diego Alejandro Martinez', 'DAM', NULL, 1, 'diegoamartinez', '', 1, NULL);
INSERT INTO `dots_account_info` VALUES (40008, 'Max Alexander Fischer', 'MAF', NULL, 2, 'maxafischer', '1', 1, NULL);
INSERT INTO `dots_account_info` VALUES (45002, 'Andrei Mikhail Petrov', 'AMP', NULL, 3, 'andreimpetrov', '', 4, NULL);

-- ----------------------------
-- Table structure for dots_attachments
-- ----------------------------
DROP TABLE IF EXISTS `dots_attachments`;
CREATE TABLE `dots_attachments`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_NUM` int NULL DEFAULT NULL,
  `ROUTE_NUM` int NULL DEFAULT NULL,
  `DESCRIPTION` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `FILE_PATH` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `FILE_NAME` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 67 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_attachments
-- ----------------------------
INSERT INTO `dots_attachments` VALUES (1, 0, 0, '', '../ATTACHMENTS///', '0.jpg');
INSERT INTO `dots_attachments` VALUES (2, 1972, 0, '', '../ATTACHMENTS/1972/0/', '65e5433f049f9.jpg');
INSERT INTO `dots_attachments` VALUES (3, 1972, 0, '', '../ATTACHMENTS/1972/0/', '65e5433f26018.jpg');
INSERT INTO `dots_attachments` VALUES (4, 1972, 0, '', '../ATTACHMENTS/1972/0/', '65e5433f31522.jpg');
INSERT INTO `dots_attachments` VALUES (5, 1972, 0, '', '../ATTACHMENTS/1972/0/', '65e5433f49346.jpg');
INSERT INTO `dots_attachments` VALUES (6, 1972, 0, '', '../ATTACHMENTS/1972/0/', '65e5433f4f226.jpg');
INSERT INTO `dots_attachments` VALUES (7, 1972, 0, '', '../ATTACHMENTS/1972/0/', '65e5433f56c1c.jpg');
INSERT INTO `dots_attachments` VALUES (8, 1972, 0, '', '../ATTACHMENTS/1972/0/', '65e5433f5cb32.jpg');
INSERT INTO `dots_attachments` VALUES (9, 1972, 0, '', '../ATTACHMENTS/1972/0/', '65e5433f6a633.jpg');
INSERT INTO `dots_attachments` VALUES (10, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e5637edf423.jpg');
INSERT INTO `dots_attachments` VALUES (11, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e563836ed6d.jpg');
INSERT INTO `dots_attachments` VALUES (12, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e5654311621.jpg');
INSERT INTO `dots_attachments` VALUES (13, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e5654323e9a.jpg');
INSERT INTO `dots_attachments` VALUES (14, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e5654337a3d.jpg');
INSERT INTO `dots_attachments` VALUES (15, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e56543465d4.jpg');
INSERT INTO `dots_attachments` VALUES (16, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e565434d56a.jpg');
INSERT INTO `dots_attachments` VALUES (17, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e5654354bab.jpg');
INSERT INTO `dots_attachments` VALUES (18, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e565435aefe.jpg');
INSERT INTO `dots_attachments` VALUES (19, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e5654365a74.jpg');
INSERT INTO `dots_attachments` VALUES (20, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e565436d178.jpg');
INSERT INTO `dots_attachments` VALUES (21, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e565437339f.jpg');
INSERT INTO `dots_attachments` VALUES (22, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e565437aa4b.jpg');
INSERT INTO `dots_attachments` VALUES (23, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e5654380c59.jpg');
INSERT INTO `dots_attachments` VALUES (24, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e56868c826c.jpg');
INSERT INTO `dots_attachments` VALUES (25, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e56868e25ef.jpg');
INSERT INTO `dots_attachments` VALUES (26, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e56868ea391.jpg');
INSERT INTO `dots_attachments` VALUES (27, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e56868f17ca.jpg');
INSERT INTO `dots_attachments` VALUES (28, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e5686909113.jpg');
INSERT INTO `dots_attachments` VALUES (29, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e5686919977.jpg');
INSERT INTO `dots_attachments` VALUES (30, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e5686926d4c.jpg');
INSERT INTO `dots_attachments` VALUES (31, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e568692e1f6.jpg');
INSERT INTO `dots_attachments` VALUES (32, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e5686934702.jpg');
INSERT INTO `dots_attachments` VALUES (33, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e568693bb11.jpg');
INSERT INTO `dots_attachments` VALUES (34, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e5686941ffe.jpg');
INSERT INTO `dots_attachments` VALUES (35, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e56869493da.jpg');
INSERT INTO `dots_attachments` VALUES (36, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e568f73d567.jpg');
INSERT INTO `dots_attachments` VALUES (37, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e568f74c414.jpg');
INSERT INTO `dots_attachments` VALUES (38, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e568f754169.jpg');
INSERT INTO `dots_attachments` VALUES (39, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e568f75b103.jpg');
INSERT INTO `dots_attachments` VALUES (40, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e568f761a74.jpg');
INSERT INTO `dots_attachments` VALUES (41, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e568f768a6f.jpg');
INSERT INTO `dots_attachments` VALUES (42, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e568f76f42d.jpg');
INSERT INTO `dots_attachments` VALUES (43, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e568f789203.jpg');
INSERT INTO `dots_attachments` VALUES (44, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e568f79f468.jpg');
INSERT INTO `dots_attachments` VALUES (45, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e568f7be07f.jpg');
INSERT INTO `dots_attachments` VALUES (46, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e568f7c608e.jpg');
INSERT INTO `dots_attachments` VALUES (47, 1982, 0, '', '../ATTACHMENTS/1982/0/', '65e568f7cce32.jpg');
INSERT INTO `dots_attachments` VALUES (48, 1984, 1, '', '../ATTACHMENTS/1984/1/', '65e6b6ee7b838.jpg');
INSERT INTO `dots_attachments` VALUES (49, 2013, 0, 'asdfg', '../ATTACHMENTS/2013/0/', '65e81d0186b71.jpg');
INSERT INTO `dots_attachments` VALUES (50, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d75c9f46.jpg');
INSERT INTO `dots_attachments` VALUES (51, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d75dc37d.jpg');
INSERT INTO `dots_attachments` VALUES (52, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d75eb0c2.jpg');
INSERT INTO `dots_attachments` VALUES (53, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d7600788.jpg');
INSERT INTO `dots_attachments` VALUES (54, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d760726c.jpg');
INSERT INTO `dots_attachments` VALUES (55, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d760dfde.jpg');
INSERT INTO `dots_attachments` VALUES (56, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d7617732.jpg');
INSERT INTO `dots_attachments` VALUES (57, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d762a678.jpg');
INSERT INTO `dots_attachments` VALUES (58, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d7637f10.jpg');
INSERT INTO `dots_attachments` VALUES (59, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d763ebfc.jpg');
INSERT INTO `dots_attachments` VALUES (60, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d764af24.jpg');
INSERT INTO `dots_attachments` VALUES (61, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d7673b85.jpg');
INSERT INTO `dots_attachments` VALUES (62, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d76956e3.jpg');
INSERT INTO `dots_attachments` VALUES (63, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d76ac82c.jpg');
INSERT INTO `dots_attachments` VALUES (64, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d76be0e2.jpg');
INSERT INTO `dots_attachments` VALUES (65, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d76c8eb3.jpg');
INSERT INTO `dots_attachments` VALUES (66, 1987, 0, 'SESTESTRRTDS', '../ATTACHMENTS/1987/0/', '65e81d76cf98c.jpg');

-- ----------------------------
-- Table structure for dots_doc_action
-- ----------------------------
DROP TABLE IF EXISTS `dots_doc_action`;
CREATE TABLE `dots_doc_action`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_ACTION` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_doc_action
-- ----------------------------
INSERT INTO `dots_doc_action` VALUES (1, 'SENT');
INSERT INTO `dots_doc_action` VALUES (2, 'RECEIVE');
INSERT INTO `dots_doc_action` VALUES (3, 'CREATE');
INSERT INTO `dots_doc_action` VALUES (4, 'DUPLICATE');
INSERT INTO `dots_doc_action` VALUES (5, 'CANCELLED');

-- ----------------------------
-- Table structure for dots_doc_dept
-- ----------------------------
DROP TABLE IF EXISTS `dots_doc_dept`;
CREATE TABLE `dots_doc_dept`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_DEPT` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_doc_dept
-- ----------------------------
INSERT INTO `dots_doc_dept` VALUES (1, 'ARD');
INSERT INTO `dots_doc_dept` VALUES (2, 'L&D');
INSERT INTO `dots_doc_dept` VALUES (3, 'PIAD');
INSERT INTO `dots_doc_dept` VALUES (4, 'ADMIN');
INSERT INTO `dots_doc_dept` VALUES (5, 'PSYCH');

-- ----------------------------
-- Table structure for dots_doc_division
-- ----------------------------
DROP TABLE IF EXISTS `dots_doc_division`;
CREATE TABLE `dots_doc_division`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_DIVISION` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_doc_division
-- ----------------------------
INSERT INTO `dots_doc_division` VALUES (1, 'ARD');
INSERT INTO `dots_doc_division` VALUES (2, 'L&D');
INSERT INTO `dots_doc_division` VALUES (3, 'PIAD');

-- ----------------------------
-- Table structure for dots_doc_office
-- ----------------------------
DROP TABLE IF EXISTS `dots_doc_office`;
CREATE TABLE `dots_doc_office`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_OFFICE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_doc_office
-- ----------------------------
INSERT INTO `dots_doc_office` VALUES (1, 'CMO');
INSERT INTO `dots_doc_office` VALUES (2, 'GSO');
INSERT INTO `dots_doc_office` VALUES (3, 'SP');
INSERT INTO `dots_doc_office` VALUES (4, 'CPO');
INSERT INTO `dots_doc_office` VALUES (5, 'CPDSO');
INSERT INTO `dots_doc_office` VALUES (6, 'CBAO');

-- ----------------------------
-- Table structure for dots_doc_prps
-- ----------------------------
DROP TABLE IF EXISTS `dots_doc_prps`;
CREATE TABLE `dots_doc_prps`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_PRPS` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_doc_prps
-- ----------------------------
INSERT INTO `dots_doc_prps` VALUES (1, 'Review');
INSERT INTO `dots_doc_prps` VALUES (2, 'Comment/Observation');
INSERT INTO `dots_doc_prps` VALUES (3, 'Initial/Signature');
INSERT INTO `dots_doc_prps` VALUES (4, 'Approval');

-- ----------------------------
-- Table structure for dots_doc_status
-- ----------------------------
DROP TABLE IF EXISTS `dots_doc_status`;
CREATE TABLE `dots_doc_status`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_STATUS` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_doc_status
-- ----------------------------
INSERT INTO `dots_doc_status` VALUES (1, 'Pending');
INSERT INTO `dots_doc_status` VALUES (2, 'Filed');
INSERT INTO `dots_doc_status` VALUES (3, 'Returned');
INSERT INTO `dots_doc_status` VALUES (4, 'Approved');
INSERT INTO `dots_doc_status` VALUES (5, 'On Hand');

-- ----------------------------
-- Table structure for dots_doc_type
-- ----------------------------
DROP TABLE IF EXISTS `dots_doc_type`;
CREATE TABLE `dots_doc_type`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_TYPE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_doc_type
-- ----------------------------
INSERT INTO `dots_doc_type` VALUES (1, 'Admin. Order/EO');
INSERT INTO `dots_doc_type` VALUES (2, 'Indorsement');
INSERT INTO `dots_doc_type` VALUES (3, 'Letter/Invitation');

-- ----------------------------
-- Table structure for dots_document
-- ----------------------------
DROP TABLE IF EXISTS `dots_document`;
CREATE TABLE `dots_document`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_NUM` int NOT NULL,
  `ROUTE_NUM` int NOT NULL,
  `DOC_SUBJECT` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `DOC_TYPE_ID` int NOT NULL,
  `LETTER_DATE` date NOT NULL,
  `DOC_NOTES` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `S_OFFICE_ID` int NOT NULL,
  `S_DEPT_ID` int NOT NULL,
  `S_USER_ID` int NOT NULL,
  `R_OFFICE_ID` int NOT NULL,
  `R_DEPT_ID` int NOT NULL,
  `R_USER_ID` int NOT NULL,
  `DATE_TIME_RECEIVED` datetime(6) NOT NULL,
  `DOC_STATUS` int NOT NULL,
  `ACTION_ID` int NOT NULL,
  `ROUTED` int NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document
-- ----------------------------
INSERT INTO `dots_document` VALUES (1, 1987, 0, 'asdasdasd', 3, '2024-03-06', '', 4, 0, 0, 0, 2, 27003, '2024-03-06 10:52:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (2, 1988, 0, 'asdasdasd', 2, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 10:54:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (3, 1989, 0, '', 1, '2024-03-06', '', 1, 0, 0, 0, 0, 0, '2024-03-06 10:54:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (4, 1990, 0, '', 2, '2024-03-06', '', 3, 0, 0, 0, 0, 0, '2024-03-06 10:54:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (5, 1991, 0, 'asd', 1, '2024-03-06', '', 1, 0, 0, 0, 2, 27003, '2024-03-06 10:55:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (6, 1992, 0, 'asd', 1, '2024-03-06', '', 1, 0, 0, 0, 2, 27003, '2024-03-06 10:55:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (7, 1992, 1, 'asd', 1, '2024-03-06', '', 1, 0, 0, 0, 2, 27003, '2024-03-06 10:55:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (8, 1993, 0, '', 1, '2024-03-06', '', 3, 0, 0, 0, 2, 27003, '2024-03-06 12:58:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (9, 1994, 0, '', 1, '2024-03-06', '', 1, 0, 0, 0, 2, 27003, '2024-03-06 13:01:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (10, 1995, 0, '', 1, '2024-03-06', '', 4, 0, 0, 0, 2, 27003, '2024-03-06 13:01:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (11, 1996, 0, '', 0, '2024-03-06', '', 0, 0, 0, 0, 2, 27003, '2024-03-06 13:03:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (12, 1997, 0, '', 3, '2024-03-06', '', 1, 0, 0, 0, 2, 27003, '2024-03-06 13:04:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (13, 1998, 0, '', 0, '2024-03-06', '', 0, 0, 0, 0, 2, 27003, '2024-03-06 13:04:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (14, 1999, 0, '', 2, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:04:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (15, 2000, 0, '', 1, '2024-03-06', '', 1, 0, 0, 0, 2, 27003, '2024-03-06 13:07:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (16, 2001, 0, '', 1, '2024-03-06', '', 1, 0, 0, 0, 2, 27003, '2024-03-06 13:09:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (17, 2002, 0, '', 0, '2024-03-06', '', 0, 0, 0, 0, 2, 27003, '2024-03-06 13:09:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (18, 2003, 0, '', 0, '2024-03-06', '', 0, 0, 0, 0, 2, 27003, '2024-03-06 13:09:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (19, 2004, 0, 'asdasd', 0, '2024-03-06', '', 0, 0, 0, 0, 2, 27003, '2024-03-06 13:10:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (20, 2005, 0, '', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:11:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (21, 2006, 0, '', 2, '2024-03-06', '', 3, 0, 0, 0, 2, 27003, '2024-03-06 13:15:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (22, 2007, 0, 'asdasdasdads', 0, '2024-03-06', '', 0, 0, 0, 0, 2, 27003, '2024-03-06 13:15:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (23, 2008, 0, '', 0, '2024-03-06', '', 0, 0, 0, 0, 2, 27003, '2024-03-06 13:15:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (24, 2009, 0, 'asd', 1, '2024-03-06', '', 3, 0, 0, 0, 2, 27003, '2024-03-06 13:16:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (25, 2010, 0, 'gdsgssggds', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:17:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (26, 2011, 0, 'asd', 2, '2024-03-06', '', 1, 0, 0, 0, 2, 27003, '2024-03-06 13:18:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (27, 2012, 0, 'jkb', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:28:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (28, 2012, 1, 'jkb', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:28:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (29, 2012, 2, 'jkb', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:28:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (30, 2012, 3, 'jkb', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:28:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (31, 2012, 4, 'jkb', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:28:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (32, 2012, 5, 'jkb', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:28:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (33, 2012, 6, 'jkb', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:28:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (34, 2012, 7, 'jkb', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:28:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (35, 2012, 8, 'jkb', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:28:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (36, 2012, 9, 'jkb', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:28:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (37, 2012, 10, 'jkb', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:28:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (38, 2012, 11, 'jkb', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:28:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (39, 2012, 12, 'jkb', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:28:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (40, 2012, 13, 'jkb', 3, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 13:28:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (41, 2013, 0, 'asd', 2, '2024-03-06', '', 2, 0, 0, 0, 2, 27003, '2024-03-06 15:33:00.000000', 5, 2, 0);

-- ----------------------------
-- Table structure for dots_document_inbound
-- ----------------------------
DROP TABLE IF EXISTS `dots_document_inbound`;
CREATE TABLE `dots_document_inbound`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_NUM` int NOT NULL,
  `ROUTE_NUM` int NOT NULL,
  `DOC_NOTES` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PRPS_ID` int NOT NULL,
  `S_OFFICE_ID` int NOT NULL,
  `S_USER_ID` int NOT NULL,
  `S_DEPT_ID` int NOT NULL,
  `R_OFFICE_ID` int NOT NULL,
  `R_USER_ID` int NOT NULL,
  `R_DEPT_ID` int NOT NULL,
  `DATE_TIME_RECEIVED` datetime NULL DEFAULT NULL,
  `DATE_TIME_SEND` datetime NULL DEFAULT NULL,
  `ACTION_ID` int NOT NULL,
  `ROUTED` tinyint(1) NOT NULL DEFAULT 1,
  `OUTBOUND_ID` int NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document_inbound
-- ----------------------------
INSERT INTO `dots_document_inbound` VALUES (1, 1992, 0, '', 0, 0, 27003, 2, 0, 0, 0, NULL, '2024-03-06 10:56:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (2, 1992, 1, '', 4, 0, 27003, 2, 0, 27003, 2, '2024-03-06 11:18:00', '2024-03-06 10:58:00', 2, 1, 1);
INSERT INTO `dots_document_inbound` VALUES (3, 2012, 0, '', 1, 0, 27003, 2, 0, 31007, 1, NULL, '2024-03-06 13:34:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (4, 2012, 1, '', 0, 0, 27003, 2, 0, 0, 0, NULL, '2024-03-06 13:38:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (5, 2012, 2, 'asdfgh', 1, 0, 27003, 2, 0, 38004, 1, NULL, '2024-03-06 13:48:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (6, 2012, 3, 'asd', 1, 0, 27003, 2, 0, 25009, 1, NULL, '2024-03-06 13:56:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (7, 2012, 4, 'asd', 1, 0, 27003, 2, 0, 25009, 1, NULL, '2024-03-06 13:56:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (8, 2012, 5, 'asd', 1, 0, 27003, 2, 0, 25009, 1, NULL, '2024-03-06 13:56:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (9, 2012, 6, 'asd', 1, 0, 27003, 2, 0, 25009, 1, NULL, '2024-03-06 13:56:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (10, 2012, 7, 'asd', 1, 0, 27003, 2, 0, 25009, 1, NULL, '2024-03-06 13:56:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (11, 2012, 8, 'asd', 1, 0, 27003, 2, 0, 25009, 1, NULL, '2024-03-06 13:56:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (12, 2012, 9, 'asd', 1, 0, 27003, 2, 0, 25009, 1, NULL, '2024-03-06 13:56:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (13, 2012, 10, 'asd', 1, 0, 27003, 2, 0, 31007, 1, NULL, '2024-03-06 13:59:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (14, 2012, 11, '', 1, 0, 27003, 2, 0, 25009, 1, NULL, '2024-03-06 13:59:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (15, 2012, 12, '', 2, 0, 27003, 2, 0, 25009, 1, NULL, '2024-03-06 14:00:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (16, 2012, 13, '', 1, 0, 27003, 2, 0, 25009, 1, NULL, '2024-03-06 14:02:00', 1, 1, NULL);

-- ----------------------------
-- Table structure for dots_document_outbound
-- ----------------------------
DROP TABLE IF EXISTS `dots_document_outbound`;
CREATE TABLE `dots_document_outbound`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_NUM` int NOT NULL,
  `ROUTE_NUM` int NOT NULL,
  `DOC_NOTES` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PRPS_ID` int NOT NULL,
  `S_OFFICE_ID` int NOT NULL,
  `S_USER_ID` int NOT NULL,
  `S_DEPT_ID` int NOT NULL,
  `R_OFFICE_ID` int NOT NULL,
  `R_USER_ID` int NOT NULL,
  `R_DEPT_ID` int NOT NULL,
  `DATE_TIME_RECEIVED` datetime NULL DEFAULT NULL,
  `DATE_TIME_SEND` datetime NULL DEFAULT NULL,
  `ACTION_ID` int NOT NULL,
  `ROUTED` tinyint(1) NOT NULL DEFAULT 1,
  `INBOUND_ID` int NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document_outbound
-- ----------------------------
INSERT INTO `dots_document_outbound` VALUES (1, 1992, 1, '', 0, 0, 27003, 2, 0, 0, 0, '2024-03-06 11:18:00', NULL, 2, 0, NULL);

-- ----------------------------
-- Table structure for dots_document_sub
-- ----------------------------
DROP TABLE IF EXISTS `dots_document_sub`;
CREATE TABLE `dots_document_sub`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_NUM` int NOT NULL,
  `ROUTE_NUM` int NOT NULL,
  `DOC_NOTES` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PRPS_ID` int NOT NULL,
  `S_OFFICE_ID` int NOT NULL,
  `S_USER_ID` int NOT NULL,
  `S_DEPT_ID` int NOT NULL,
  `R_OFFICE_ID` int NOT NULL,
  `R_USER_ID` int NOT NULL,
  `R_DEPT_ID` int NOT NULL,
  `DATE_TIME_RECEIVED` datetime(6) NOT NULL,
  `ACTION_ID` int NOT NULL,
  `ROUTED` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document_sub
-- ----------------------------

-- ----------------------------
-- Table structure for dots_num_sequence
-- ----------------------------
DROP TABLE IF EXISTS `dots_num_sequence`;
CREATE TABLE `dots_num_sequence`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `current_value` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_num_sequence
-- ----------------------------
INSERT INTO `dots_num_sequence` VALUES (1, 2014);

-- ----------------------------
-- Table structure for dots_tracking
-- ----------------------------
DROP TABLE IF EXISTS `dots_tracking`;
CREATE TABLE `dots_tracking`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_NUM` int NULL DEFAULT NULL,
  `ROUTE_NUM` int NULL DEFAULT NULL,
  `ACTION_ID` int NULL DEFAULT NULL,
  `HRIS_ID` int NULL DEFAULT NULL,
  `DATE_TIME_ACTION` datetime NULL DEFAULT NULL,
  `NOTES_USER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `NOTES_SERVER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_tracking
-- ----------------------------
INSERT INTO `dots_tracking` VALUES (1, 1987, 0, 2, 27003, '2024-03-06 10:53:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (2, 1988, 0, 2, 27003, '2024-03-06 10:54:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (3, 1989, 0, 2, 27003, '2024-03-06 10:54:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (4, 1990, 0, 2, 27003, '2024-03-06 10:54:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (5, 1991, 0, 2, 27003, '2024-03-06 10:55:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (6, 1992, 0, 2, 27003, '2024-03-06 10:55:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (7, 1992, 0, 1, 27003, '2024-03-06 10:56:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (8, 1992, 1, 4, 27003, '2024-03-06 10:58:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (9, 1992, 1, 1, 27003, '2024-03-06 10:58:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (10, 1992, 1, 2, 27003, '2024-03-06 11:19:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (11, 1993, 0, 2, 27003, '2024-03-06 12:58:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (12, 1994, 0, 2, 27003, '2024-03-06 13:01:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (13, 1995, 0, 2, 27003, '2024-03-06 13:03:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (14, 1996, 0, 2, 27003, '2024-03-06 13:03:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (15, 1997, 0, 2, 27003, '2024-03-06 13:04:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (16, 1998, 0, 2, 27003, '2024-03-06 13:04:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (17, 1999, 0, 2, 27003, '2024-03-06 13:04:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (18, 2000, 0, 2, 27003, '2024-03-06 13:07:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (19, 2001, 0, 2, 27003, '2024-03-06 13:09:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (20, 2002, 0, 2, 27003, '2024-03-06 13:09:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (21, 2003, 0, 2, 27003, '2024-03-06 13:09:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (22, 2004, 0, 2, 27003, '2024-03-06 13:10:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (23, 2005, 0, 2, 27003, '2024-03-06 13:11:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (24, 2006, 0, 2, 27003, '2024-03-06 13:15:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (25, 2007, 0, 2, 27003, '2024-03-06 13:15:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (26, 2008, 0, 2, 27003, '2024-03-06 13:15:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (27, 2009, 0, 2, 27003, '2024-03-06 13:16:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (28, 2010, 0, 2, 27003, '2024-03-06 13:17:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (29, 2011, 0, 2, 27003, '2024-03-06 13:18:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (30, 2012, 0, 2, 27003, '2024-03-06 13:28:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (31, 2012, 0, 1, 27003, '2024-03-06 13:34:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (32, 2012, 1, 4, 27003, '2024-03-06 13:38:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (33, 2012, 1, 1, 27003, '2024-03-06 13:38:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (34, 2012, 2, 4, 27003, '2024-03-06 13:49:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (35, 2012, 2, 1, 27003, '2024-03-06 13:49:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (36, 2012, 3, 4, 27003, '2024-03-06 13:56:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (37, 2012, 3, 1, 27003, '2024-03-06 13:56:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (38, 2012, 4, 4, 27003, '2024-03-06 13:56:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (39, 2012, 4, 1, 27003, '2024-03-06 13:56:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (40, 2012, 5, 4, 27003, '2024-03-06 13:57:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (41, 2012, 5, 1, 27003, '2024-03-06 13:57:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (42, 2012, 6, 4, 27003, '2024-03-06 13:57:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (43, 2012, 6, 1, 27003, '2024-03-06 13:57:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (44, 2012, 7, 4, 27003, '2024-03-06 13:57:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (45, 2012, 7, 1, 27003, '2024-03-06 13:57:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (46, 2012, 8, 4, 27003, '2024-03-06 13:57:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (47, 2012, 8, 1, 27003, '2024-03-06 13:57:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (48, 2012, 9, 4, 27003, '2024-03-06 13:58:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (49, 2012, 9, 1, 27003, '2024-03-06 13:58:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (50, 2012, 10, 4, 27003, '2024-03-06 13:59:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (51, 2012, 10, 1, 27003, '2024-03-06 13:59:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (52, 2012, 11, 4, 27003, '2024-03-06 13:59:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (53, 2012, 11, 1, 27003, '2024-03-06 13:59:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (54, 2012, 12, 4, 27003, '2024-03-06 14:00:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (55, 2012, 12, 1, 27003, '2024-03-06 14:00:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (56, 2012, 13, 4, 27003, '2024-03-06 14:02:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (57, 2012, 13, 1, 27003, '2024-03-06 14:02:00', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (58, 2013, 0, 2, 27003, '2024-03-06 15:33:00', NULL, NULL);

-- ----------------------------
-- Triggers structure for table dots_document
-- ----------------------------
DROP TRIGGER IF EXISTS `trigger_auto_increment_doc_num`;
delimiter ;;
CREATE TRIGGER `trigger_auto_increment_doc_num` BEFORE INSERT ON `dots_document` FOR EACH ROW BEGIN
    IF NEW.doc_num IS NULL OR NEW.doc_num = '' THEN
        SET @new_doc_num := (SELECT current_value FROM dots_num_sequence);
        UPDATE dots_num_sequence
        SET current_value = current_value + 1;
        SET NEW.doc_num = @new_doc_num;
    END IF;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
