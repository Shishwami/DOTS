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

 Date: 13/03/2024 09:07:38
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
INSERT INTO `dots_account_info` VALUES (25009, 'Aisha Priya Patel', 'APP', NULL, 1, 'aishappatel', '', 1, 1);
INSERT INTO `dots_account_info` VALUES (27003, 'Sarah Grace Lee', 'SGL', NULL, 2, 'sarahglee', '', 2, 3);
INSERT INTO `dots_account_info` VALUES (29005, 'Emily Mei Chen', 'EMC', NULL, 3, 'emilymchen', '', 3, 2);
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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_attachments
-- ----------------------------
INSERT INTO `dots_attachments` VALUES (1, 1996, 0, '', '../ATTACHMENTS/1996/0/', '65ee798ec6e3c.jpg');
INSERT INTO `dots_attachments` VALUES (2, 1996, 0, '', '../ATTACHMENTS/1996/0/', '65ee798eee7fa.jpg');
INSERT INTO `dots_attachments` VALUES (3, 1996, 0, '', '../ATTACHMENTS/1996/0/', '65ee798f0c9ae.jpg');
INSERT INTO `dots_attachments` VALUES (4, 1996, 0, '', '../ATTACHMENTS/1996/0/', '65ee798f3aa9e.jpg');
INSERT INTO `dots_attachments` VALUES (5, 1996, 0, '', '../ATTACHMENTS/1996/0/', '65ee798f51b2a.jpg');
INSERT INTO `dots_attachments` VALUES (6, 1996, 0, '', '../ATTACHMENTS/1996/0/', '65ee798f5de38.jpg');
INSERT INTO `dots_attachments` VALUES (7, 1996, 0, '', '../ATTACHMENTS/1996/0/', '65ee798f64bbf.jpg');
INSERT INTO `dots_attachments` VALUES (8, 1996, 0, 'a', '../ATTACHMENTS/1996/0/', '65ee8070b9ed5.jpg');

-- ----------------------------
-- Table structure for dots_doc_action
-- ----------------------------
DROP TABLE IF EXISTS `dots_doc_action`;
CREATE TABLE `dots_doc_action`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_ACTION` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_doc_action
-- ----------------------------
INSERT INTO `dots_doc_action` VALUES (1, 'SENT');
INSERT INTO `dots_doc_action` VALUES (2, 'RECEIVED');
INSERT INTO `dots_doc_action` VALUES (3, 'CREATED');
INSERT INTO `dots_doc_action` VALUES (4, 'DUPLICATED');
INSERT INTO `dots_doc_action` VALUES (5, 'CANCELLED');
INSERT INTO `dots_doc_action` VALUES (6, 'EDITED');

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
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document
-- ----------------------------
INSERT INTO `dots_document` VALUES (1, 1994, 0, 'asd', 1, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:38:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (2, 1995, 0, 'asd', 1, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:41:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (3, 1996, 0, 'asdasda', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (4, 1996, 1, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (5, 1996, 2, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (6, 1996, 3, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (7, 1996, 4, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (8, 1996, 5, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (9, 1996, 6, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (10, 1996, 7, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (11, 1996, 8, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (12, 1996, 9, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (13, 1996, 10, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (14, 1996, 11, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (15, 1996, 12, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (16, 1996, 13, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (17, 1996, 14, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (18, 1996, 15, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (19, 1996, 16, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (20, 1996, 17, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (21, 1996, 18, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (22, 1996, 19, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (23, 1996, 20, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);
INSERT INTO `dots_document` VALUES (24, 1996, 21, 'asd', 2, '2024-03-11', '', 1, 0, 0, 0, 2, 27003, '2024-03-11 10:43:00.000000', 1, 2, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document_inbound
-- ----------------------------
INSERT INTO `dots_document_inbound` VALUES (1, 1996, 0, '123123123', 2, 0, 27003, 2, 0, 27003, 2, '0000-00-00 00:00:00', '2024-03-11 10:46:00', 5, 1, 30);
INSERT INTO `dots_document_inbound` VALUES (2, 1996, 1, 'asd', 2, 0, 27003, 2, 0, 27003, 2, NULL, '2024-03-11 10:46:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (3, 1996, 2, 'asdasdasdasd', 2, 0, 27003, 2, 0, 40008, 2, NULL, '2024-03-11 10:54:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (4, 1996, 3, 'asdasdad1231', 2, 0, 27003, 2, 0, 27003, 2, NULL, '2024-03-11 10:53:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (5, 1996, 4, 'asdasdasdasd notes logs', 2, 0, 27003, 2, 0, 27003, 2, NULL, '2024-03-11 10:56:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (6, 1996, 5, 'log s', 2, 0, 27003, 2, 0, 27003, 2, NULL, '2024-03-11 10:58:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (7, 1996, 6, 'asd', 2, 0, 27003, 2, 0, 27003, 2, '0000-00-00 00:00:00', '2024-03-11 11:03:00', 5, 1, 15);
INSERT INTO `dots_document_inbound` VALUES (8, 1996, 7, 'asda', 2, 0, 27003, 2, 0, 32001, 2, NULL, '2024-03-11 11:04:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (9, 1996, 8, 'asdasdad', 2, 0, 27003, 2, 0, 40008, 2, NULL, '2024-03-11 11:05:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (10, 1996, 9, 'asdasdasdasdasd', 2, 0, 27003, 2, 0, 45002, 3, NULL, '2024-03-11 11:06:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (11, 1996, 10, 'asdasdasd', 2, 0, 27003, 2, 0, 31007, 1, NULL, '2024-03-11 11:06:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (12, 1996, 11, 'asdasd', 3, 0, 27003, 2, 0, 29005, 3, NULL, '2024-03-11 11:11:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (13, 1996, 12, ' asdadasd', 2, 0, 27003, 2, 0, 25009, 1, NULL, '2024-03-11 11:12:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (14, 1996, 13, 'log test', 2, 0, 27003, 2, 0, 31007, 1, NULL, '2024-03-11 11:13:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (15, 1996, 14, 'log tet 12', 2, 0, 27003, 2, 0, 27003, 2, NULL, '2024-03-11 11:18:00', 5, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (16, 1996, 15, 'send docn user', 2, 0, 27003, 2, 0, 27003, 2, '0000-00-00 00:00:00', '2024-03-11 11:21:00', 5, 1, 20);
INSERT INTO `dots_document_inbound` VALUES (17, 1996, 0, '1234', 2, 0, 27003, 2, 0, 27003, 2, '0000-00-00 00:00:00', '2024-03-11 11:31:00', 1, 1, 23);
INSERT INTO `dots_document_inbound` VALUES (18, 1996, 16, 'sdasd', 2, 0, 27003, 2, 0, 27003, 2, NULL, '2024-12-11 11:42:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (19, 1996, 17, 'asd', 1, 0, 27003, 2, 0, 34010, 3, NULL, '2024-03-11 11:47:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (20, 1996, 18, 'asdasd', 2, 0, 27003, 2, 0, 32001, 2, NULL, '2024-03-11 11:48:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (21, 1996, 19, ' asdasd', 2, 0, 27003, 2, 0, 36006, 4, NULL, '2024-03-11 11:48:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (22, 1996, 20, 'asdasd', 2, 0, 27003, 2, 0, 32001, 2, NULL, '2024-03-11 11:49:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (23, 1996, 21, 'asd', 2, 0, 27003, 2, 0, 40008, 2, NULL, '2024-03-11 11:50:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (24, 1996, 0, 'asd', 1, 0, 27003, 2, 0, 27003, 2, '2024-03-13 08:41:00', '2024-03-13 08:40:00', 2, 1, 32);
INSERT INTO `dots_document_inbound` VALUES (25, 1996, 0, 'asd', 2, 0, 27003, 2, 0, 34010, 3, NULL, '2024-03-13 08:41:00', 1, 1, NULL);
INSERT INTO `dots_document_inbound` VALUES (26, 1996, 0, 'asdasdasdasdqweqweqe', 3, 0, 27003, 2, 0, 27003, 2, '2024-03-13 08:42:00', '2024-03-13 08:42:00', 2, 1, 33);
INSERT INTO `dots_document_inbound` VALUES (27, 1996, 0, 'asasdad', 2, 0, 27003, 2, 0, 40008, 2, NULL, '2024-03-13 08:42:00', 1, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document_outbound
-- ----------------------------
INSERT INTO `dots_document_outbound` VALUES (1, 1996, 0, 'asd', 1, 0, 27003, 2, 0, 27003, 2, NULL, '2024-03-13 08:40:00', 1, 1, 24);
INSERT INTO `dots_document_outbound` VALUES (2, 1996, 1, 'asd', 2, 0, 27003, 2, 0, 27003, 2, NULL, '2024-03-11 10:46:00', 1, 1, 2);
INSERT INTO `dots_document_outbound` VALUES (3, 1996, 2, 'asdasdasdasd', 2, 0, 27003, 2, 0, 40008, 2, NULL, '2024-03-11 10:54:00', 1, 1, 3);
INSERT INTO `dots_document_outbound` VALUES (4, 1996, 3, 'asdasdad1231', 2, 0, 27003, 2, 0, 27003, 2, NULL, '2024-03-11 10:53:00', 1, 1, 4);
INSERT INTO `dots_document_outbound` VALUES (5, 1996, 4, 'asdasdasdasd notes logs', 2, 0, 27003, 2, 0, 27003, 2, NULL, '2024-03-11 10:56:00', 1, 1, 5);
INSERT INTO `dots_document_outbound` VALUES (6, 1996, 5, 'log s', 2, 0, 27003, 2, 0, 27003, 2, NULL, '2024-03-11 10:58:00', 1, 1, 6);
INSERT INTO `dots_document_outbound` VALUES (7, 1996, 6, 'asd', 0, 0, 27003, 2, 0, 0, 0, NULL, '0000-00-00 00:00:00', 2, 0, 7);
INSERT INTO `dots_document_outbound` VALUES (8, 1996, 7, 'asda', 2, 0, 27003, 2, 0, 32001, 2, NULL, '2024-03-11 11:04:00', 1, 1, 8);
INSERT INTO `dots_document_outbound` VALUES (9, 1996, 8, 'asdasdad', 2, 0, 27003, 2, 0, 40008, 2, NULL, '2024-03-11 11:05:00', 1, 1, 9);
INSERT INTO `dots_document_outbound` VALUES (10, 1996, 9, 'asdasdasdasdasd', 2, 0, 27003, 2, 0, 45002, 3, NULL, '2024-03-11 11:06:00', 1, 1, 10);
INSERT INTO `dots_document_outbound` VALUES (11, 1996, 10, 'asdasdasd', 2, 0, 27003, 2, 0, 31007, 1, NULL, '2024-03-11 11:06:00', 1, 1, 11);
INSERT INTO `dots_document_outbound` VALUES (12, 1996, 11, 'asdasd', 3, 0, 27003, 2, 0, 29005, 3, NULL, '2024-03-11 11:11:00', 1, 1, 12);
INSERT INTO `dots_document_outbound` VALUES (13, 1996, 12, ' asdadasd', 2, 0, 27003, 2, 0, 25009, 1, NULL, '2024-03-11 11:12:00', 1, 1, 13);
INSERT INTO `dots_document_outbound` VALUES (14, 1996, 13, 'log test', 2, 0, 27003, 2, 0, 31007, 1, NULL, '2024-03-11 11:13:00', 1, 1, 14);
INSERT INTO `dots_document_outbound` VALUES (15, 1996, 6, '', 0, 0, 27003, 2, 0, 0, 0, '2024-03-11 11:14:00', NULL, 5, 0, NULL);
INSERT INTO `dots_document_outbound` VALUES (16, 1996, 0, '1234', 2, 0, 27003, 2, 0, 27003, 2, '2024-03-11 11:16:00', '2024-03-11 11:31:00', 5, 1, 17);
INSERT INTO `dots_document_outbound` VALUES (17, 1996, 14, '123123123', 0, 0, 27003, 2, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 15);
INSERT INTO `dots_document_outbound` VALUES (18, 1996, 15, '123123123', 0, 0, 27003, 2, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0, 16);
INSERT INTO `dots_document_outbound` VALUES (19, 1996, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-03-11 11:31:00', NULL, 5, 0, NULL);
INSERT INTO `dots_document_outbound` VALUES (20, 1996, 15, '', 0, 0, 27003, 2, 0, 0, 0, '2024-03-11 11:31:00', NULL, 5, 0, NULL);
INSERT INTO `dots_document_outbound` VALUES (21, 1996, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-03-11 11:34:00', NULL, 5, 0, NULL);
INSERT INTO `dots_document_outbound` VALUES (22, 1996, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-03-11 11:34:00', NULL, 5, 0, NULL);
INSERT INTO `dots_document_outbound` VALUES (23, 1996, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-03-11 11:37:00', NULL, 5, 0, NULL);
INSERT INTO `dots_document_outbound` VALUES (24, 1996, 16, 'log s', 2, 0, 27003, 2, 0, 27003, 2, '0000-00-00 00:00:00', '2024-12-11 11:42:00', 1, 1, 18);
INSERT INTO `dots_document_outbound` VALUES (25, 1996, 17, '123123123', 2, 0, 27003, 2, 0, 27003, 2, '0000-00-00 00:00:00', '2024-03-11 11:47:00', 1, 1, 19);
INSERT INTO `dots_document_outbound` VALUES (26, 1996, 18, '123123123', 2, 0, 27003, 2, 0, 27003, 2, '0000-00-00 00:00:00', '2024-03-11 11:48:00', 1, 1, 20);
INSERT INTO `dots_document_outbound` VALUES (27, 1996, 19, '123123123', 2, 0, 27003, 2, 0, 27003, 2, '0000-00-00 00:00:00', '2024-03-11 11:48:00', 1, 1, 21);
INSERT INTO `dots_document_outbound` VALUES (28, 1996, 20, '123123123', 2, 0, 27003, 2, 0, 27003, 2, '0000-00-00 00:00:00', '2024-03-11 11:49:00', 1, 1, 22);
INSERT INTO `dots_document_outbound` VALUES (29, 1996, 21, '123123123', 2, 0, 27003, 2, 0, 27003, 2, '0000-00-00 00:00:00', '2024-03-11 11:50:00', 1, 1, 23);
INSERT INTO `dots_document_outbound` VALUES (30, 1996, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-03-13 08:40:00', NULL, 5, 0, NULL);
INSERT INTO `dots_document_outbound` VALUES (31, 1996, 0, 'asd', 2, 0, 27003, 2, 0, 34010, 3, '2024-03-13 08:41:00', '2024-03-13 08:41:00', 5, 1, 25);
INSERT INTO `dots_document_outbound` VALUES (32, 1996, 0, 'asdasdasdasdqweqweqe', 3, 0, 27003, 2, 0, 27003, 2, '2024-03-13 08:41:00', '2024-03-13 08:42:00', 1, 1, 26);
INSERT INTO `dots_document_outbound` VALUES (33, 1996, 0, 'asasdad', 2, 0, 27003, 2, 0, 40008, 2, '2024-03-13 08:42:00', '2024-03-13 08:42:00', 1, 1, 27);

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
INSERT INTO `dots_num_sequence` VALUES (1, 1997);

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
  `NOTE_USER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `NOTE_SERVER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `DATE_TIME_SERVER` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 85 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_tracking
-- ----------------------------
INSERT INTO `dots_tracking` VALUES (1, 1994, 0, 2, 27003, '2024-03-11 10:38:00', NULL, NULL, NULL);
INSERT INTO `dots_tracking` VALUES (2, 1995, 0, 2, 27003, '2024-03-11 10:41:00', NULL, 'Document Created/Received at the receiving station', NULL);
INSERT INTO `dots_tracking` VALUES (3, 1996, 0, 2, 27003, '2024-03-11 10:43:00', NULL, 'Document Created/Received at the receiving station', '2024-03-11 10:43:00');
INSERT INTO `dots_tracking` VALUES (4, 1996, 0, 1, 27003, '2024-03-11 10:46:00', NULL, NULL, NULL);
INSERT INTO `dots_tracking` VALUES (5, 1996, 1, 4, 27003, '2024-03-11 10:46:00', NULL, NULL, '2024-03-11 10:52:00');
INSERT INTO `dots_tracking` VALUES (6, 1996, 1, 1, 27003, '2024-03-11 10:52:00', NULL, NULL, NULL);
INSERT INTO `dots_tracking` VALUES (7, 1996, 2, 4, 27003, '2024-03-11 10:54:00', NULL, NULL, NULL);
INSERT INTO `dots_tracking` VALUES (8, 1996, 2, 1, 27003, '2024-03-11 10:54:00', NULL, NULL, '2024-03-11 10:52:00');
INSERT INTO `dots_tracking` VALUES (9, 1996, 3, 4, 27003, '2024-03-11 10:53:00', 'asdasdad1231', NULL, '2024-03-11 10:55:00');
INSERT INTO `dots_tracking` VALUES (10, 1996, 3, 1, 27003, '2024-03-11 10:53:00', NULL, NULL, '2024-03-11 10:55:00');
INSERT INTO `dots_tracking` VALUES (11, 1996, 4, 4, 27003, '2024-03-11 10:56:00', 'asdasdasdasd notes logs', NULL, '2024-03-11 10:57:00');
INSERT INTO `dots_tracking` VALUES (12, 1996, 4, 1, 27003, '2024-03-11 10:56:00', NULL, 'Document Sent', '2024-03-11 10:57:00');
INSERT INTO `dots_tracking` VALUES (13, 1996, 5, 4, 27003, '2024-03-11 10:58:00', 'log s', 'Document already routed, Document has been duplicated', '2024-03-11 10:58:00');
INSERT INTO `dots_tracking` VALUES (14, 1996, 5, 1, 27003, '2024-03-11 10:58:00', 'log s', 'Document Sent', '2024-03-11 10:58:00');
INSERT INTO `dots_tracking` VALUES (15, 1996, 6, 4, 27003, '2024-03-11 11:03:00', 'asd', 'Document already routed, Document has been duplicated', '2024-03-11 11:03:00');
INSERT INTO `dots_tracking` VALUES (16, 1996, 6, 1, 27003, '2024-03-11 11:03:00', 'asd', 'Document Sent', '2024-03-11 11:03:00');
INSERT INTO `dots_tracking` VALUES (17, 1996, 7, 4, 27003, '2024-03-11 11:04:00', 'asda', 'Document already routed, Document has been duplicated', '2024-03-11 11:05:00');
INSERT INTO `dots_tracking` VALUES (18, 1996, 7, 1, 27003, '2024-03-11 11:04:00', 'asda', 'Document Sent to 2-27003', '2024-03-11 11:05:00');
INSERT INTO `dots_tracking` VALUES (19, 1996, 8, 4, 27003, '2024-03-11 11:05:00', 'asdasdad', 'Document already routed, Document has been duplicated', '2024-03-11 11:05:00');
INSERT INTO `dots_tracking` VALUES (20, 1996, 8, 1, 27003, '2024-03-11 11:05:00', 'asdasdad', 'Document Sent to 2-Sarah Grace Lee', '2024-03-11 11:05:00');
INSERT INTO `dots_tracking` VALUES (21, 1996, 9, 4, 27003, '2024-03-11 11:06:00', 'asdasdasdasdasd', 'Document already routed, Document has been duplicated', '2024-03-11 11:06:00');
INSERT INTO `dots_tracking` VALUES (22, 1996, 9, 1, 27003, '2024-03-11 11:06:00', 'asdasdasdasdasd', 'Document Sent to 2-Sarah Grace Lee', '2024-03-11 11:06:00');
INSERT INTO `dots_tracking` VALUES (23, 1996, 10, 4, 27003, '2024-03-11 11:06:00', 'asdasdasd', 'Document already routed, Document has been duplicated', '2024-03-11 11:06:00');
INSERT INTO `dots_tracking` VALUES (24, 1996, 10, 1, 27003, '2024-03-11 11:06:00', 'asdasdasd', 'Document Sent to 1-Sophia Fatima Khan', '2024-03-11 11:06:00');
INSERT INTO `dots_tracking` VALUES (25, 1996, 11, 4, 27003, '2024-03-11 11:11:00', 'asdasd', 'Document already routed, Document has been duplicated', '2024-03-11 11:11:00');
INSERT INTO `dots_tracking` VALUES (26, 1996, 11, 1, 27003, '2024-03-11 11:11:00', 'asdasd', 'Document Sent to -Emily Mei Chen', '2024-03-11 11:11:00');
INSERT INTO `dots_tracking` VALUES (27, 1996, 12, 4, 27003, '2024-03-11 11:12:00', ' asdadasd', 'Document already routed, Document has been duplicated', '2024-03-11 11:12:00');
INSERT INTO `dots_tracking` VALUES (28, 1996, 12, 1, 27003, '2024-03-11 11:12:00', ' asdadasd', 'Document Sent to ARD-Aisha Priya Patel', '2024-03-11 11:12:00');
INSERT INTO `dots_tracking` VALUES (29, 1996, 13, 4, 27003, '2024-03-11 11:13:00', 'log test', 'Document already routed, Document has been duplicated', '2024-03-11 11:14:00');
INSERT INTO `dots_tracking` VALUES (30, 1996, 13, 1, 27003, '2024-03-11 11:13:00', 'log test', 'Document Sent to ARD-Sophia Fatima Khan', '2024-03-11 11:14:00');
INSERT INTO `dots_tracking` VALUES (31, 1996, 6, 2, 27003, '2024-03-11 11:14:00', NULL, NULL, NULL);
INSERT INTO `dots_tracking` VALUES (32, 1996, 0, 2, 27003, '2024-03-11 11:16:00', NULL, 'Document Received by the user', '2024-03-11 11:18:00');
INSERT INTO `dots_tracking` VALUES (33, 1996, 14, 4, 27003, '2024-03-11 11:18:00', 'log tet 12', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (34, 1996, 14, 1, 27003, '2024-03-11 11:18:00', 'log tet 12', NULL, NULL);
INSERT INTO `dots_tracking` VALUES (35, 1996, 15, 4, 27003, '2024-03-11 11:21:00', 'send docn user', 'Document already routed, Document has been duplicated', '2024-03-11 11:21:00');
INSERT INTO `dots_tracking` VALUES (36, 1996, 15, 1, 27003, '2024-03-11 11:21:00', 'send docn user', 'Document Sent to', '2024-03-11 11:21:00');
INSERT INTO `dots_tracking` VALUES (37, 1996, 0, 1, 27003, '2024-03-11 11:31:00', '1234', 'Document Sent to', '2024-03-11 11:31:00');
INSERT INTO `dots_tracking` VALUES (38, 1996, 0, 2, 27003, '2024-03-11 11:31:00', NULL, 'Document Received by the user', '2024-03-11 11:31:00');
INSERT INTO `dots_tracking` VALUES (39, 1996, 15, 2, 27003, '2024-03-11 11:31:00', NULL, 'Document Received by the user', '2024-03-11 11:31:00');
INSERT INTO `dots_tracking` VALUES (40, 1996, 0, 2, 27003, '2024-03-11 11:34:00', NULL, 'Document Received by the user', '2024-03-11 11:34:00');
INSERT INTO `dots_tracking` VALUES (41, 1996, 0, 2, 27003, NULL, NULL, 'Receiving canceled by user', '2024-03-11 11:35:00');
INSERT INTO `dots_tracking` VALUES (42, 1996, 0, 2, 27003, '2024-03-11 11:34:00', NULL, 'Document Received by the user', '2024-03-11 11:35:00');
INSERT INTO `dots_tracking` VALUES (43, 1996, 0, 2, 27003, NULL, 'asdasdasd', 'Receiving canceled by user', '2024-03-11 11:36:00');
INSERT INTO `dots_tracking` VALUES (44, 1996, 0, 2, 27003, '2024-03-11 11:37:00', NULL, 'Document Received by the user', '2024-03-11 11:37:00');
INSERT INTO `dots_tracking` VALUES (45, 1996, 0, 5, 27003, NULL, 'this is a note for cancelsation', 'Receiving canceled by user', '2024-03-11 11:37:00');
INSERT INTO `dots_tracking` VALUES (46, 1996, 15, 5, 27003, NULL, '', 'Sending Document canceled by sender', '2024-03-11 11:39:00');
INSERT INTO `dots_tracking` VALUES (47, 1996, 14, 5, 27003, NULL, 'this is a cancalsdjkasdjal sending', 'Sending Document canceled by sender', '2024-03-11 11:40:00');
INSERT INTO `dots_tracking` VALUES (48, 1996, 6, 5, 27003, NULL, 'asd send', 'Sending Document canceled by sender', '2024-03-11 11:40:00');
INSERT INTO `dots_tracking` VALUES (49, 1996, 16, 4, 27003, '2024-12-11 11:42:00', 'sdasd', 'Document already routed, Document has been duplicated', '2024-03-11 11:42:00');
INSERT INTO `dots_tracking` VALUES (50, 1996, 16, 1, 27003, '2024-12-11 11:42:00', 'sdasd', 'Document Sent to', '2024-03-11 11:42:00');
INSERT INTO `dots_tracking` VALUES (51, 1996, 17, 4, 27003, '2024-03-11 11:47:00', 'asd', 'Document already routed, Document has been duplicated', '2024-03-11 11:48:00');
INSERT INTO `dots_tracking` VALUES (52, 1996, 17, 1, 27003, '2024-03-11 11:47:00', 'asd', 'Document Sent to', '2024-03-11 11:48:00');
INSERT INTO `dots_tracking` VALUES (53, 1996, 18, 4, 27003, '2024-03-11 11:48:00', 'asdasd', 'Document already routed, Document has been duplicated', '2024-03-11 11:48:00');
INSERT INTO `dots_tracking` VALUES (54, 1996, 18, 1, 27003, '2024-03-11 11:48:00', 'asdasd', 'Document Sent to', '2024-03-11 11:48:00');
INSERT INTO `dots_tracking` VALUES (55, 1996, 19, 4, 27003, '2024-03-11 11:48:00', ' asdasd', 'Document already routed, Document has been duplicated', '2024-03-11 11:48:00');
INSERT INTO `dots_tracking` VALUES (56, 1996, 19, 1, 27003, '2024-03-11 11:48:00', ' asdasd', 'Document Sent to', '2024-03-11 11:48:00');
INSERT INTO `dots_tracking` VALUES (57, 1996, 20, 4, 27003, '2024-03-11 11:49:00', 'asdasd', 'Document already routed, Document has been duplicated', '2024-03-11 11:49:00');
INSERT INTO `dots_tracking` VALUES (58, 1996, 20, 1, 27003, '2024-03-11 11:49:00', 'asdasd', 'Document Sent to L&D-Mia Elizabeth Johnson', '2024-03-11 11:49:00');
INSERT INTO `dots_tracking` VALUES (59, 1996, 21, 4, 27003, '2024-03-11 11:50:00', 'asd', 'Document already routed, Document has been duplicated', '2024-03-11 11:50:00');
INSERT INTO `dots_tracking` VALUES (60, 1996, 21, 1, 27003, '2024-03-11 11:50:00', 'asd', 'Document Sent to L&D-Max Alexander Fischer', '2024-03-11 11:50:00');
INSERT INTO `dots_tracking` VALUES (61, 0, 0, NULL, 27003, '2024-03-11 10:43:00', NULL, 'Receiving canceled by user', '2024-03-13 08:06:00');
INSERT INTO `dots_tracking` VALUES (62, 0, 0, NULL, 27003, '2024-03-11 10:43:00', NULL, 'Receiving canceled by user', '2024-03-13 08:06:00');
INSERT INTO `dots_tracking` VALUES (63, 0, 0, NULL, 27003, '2024-03-11 10:43:00', NULL, 'Receiving canceled by user', '2024-03-13 08:06:00');
INSERT INTO `dots_tracking` VALUES (64, 0, 0, NULL, 27003, '2024-03-11 10:43:00', NULL, 'Receiving canceled by user', '2024-03-13 08:07:00');
INSERT INTO `dots_tracking` VALUES (65, 0, 0, NULL, 27003, '2024-03-11 10:43:00', NULL, 'Receiving canceled by user', '2024-03-13 08:08:00');
INSERT INTO `dots_tracking` VALUES (66, 1996, 0, NULL, 27003, '2024-03-11 10:43:00', NULL, 'Receiving canceled by user', '2024-03-13 08:11:00');
INSERT INTO `dots_tracking` VALUES (67, 1996, 1, NULL, 27003, '2024-03-11 10:43:00', NULL, 'Receiving canceled by user', '2024-03-13 08:11:00');
INSERT INTO `dots_tracking` VALUES (68, 1996, 0, NULL, 27003, '2024-03-11 10:43:00', NULL, 'Receiving canceled by user', '2024-03-13 08:16:00');
INSERT INTO `dots_tracking` VALUES (71, 1996, 0, 6, 27003, '2024-03-11 10:43:00', NULL, 'Receiving canceled by user', '2024-03-13 08:28:00');
INSERT INTO `dots_tracking` VALUES (72, 1996, 0, 6, 27003, '2024-03-11 10:43:00', NULL, 'Receiving canceled by user', '2024-03-13 08:33:00');
INSERT INTO `dots_tracking` VALUES (73, 1996, 0, 5, 27003, '0000-00-00 00:00:00', 'asdasd', 'Receiving canceled by user', '2024-03-13 08:39:00');
INSERT INTO `dots_tracking` VALUES (74, 1996, 0, 2, 27003, '2024-03-13 08:40:00', NULL, 'Document Received by the user', '2024-03-13 08:40:00');
INSERT INTO `dots_tracking` VALUES (75, 1996, 0, 5, 27003, NULL, 'asd', 'Receiving canceled by user', '2024-03-13 08:40:00');
INSERT INTO `dots_tracking` VALUES (76, 1996, 0, 5, 27003, NULL, 'asd', 'Sending Document canceled by sender', '2024-03-13 08:40:00');
INSERT INTO `dots_tracking` VALUES (77, 1996, 0, 1, 27003, '2024-03-13 08:40:00', 'asd', 'Document Sent to L&D-Sarah Grace Lee', '2024-03-13 08:40:00');
INSERT INTO `dots_tracking` VALUES (78, 1996, 0, 2, 27003, '2024-03-13 08:41:00', NULL, 'Document Received by the user', '2024-03-13 08:41:00');
INSERT INTO `dots_tracking` VALUES (79, 1996, 0, 1, 27003, '2024-03-13 08:41:00', 'asd', 'Document Sent to PIAD-Daniel Thomas White', '2024-03-13 08:41:00');
INSERT INTO `dots_tracking` VALUES (80, 1996, 0, 5, 27003, NULL, 'asd', 'Receiving canceled by user', '2024-03-13 08:41:00');
INSERT INTO `dots_tracking` VALUES (81, 1996, 0, 2, 27003, '2024-03-13 08:41:00', NULL, 'Document Received by the user', '2024-03-13 08:41:00');
INSERT INTO `dots_tracking` VALUES (82, 1996, 0, 1, 27003, '2024-03-13 08:42:00', 'asdasdasdasdqweqweqe', 'Document Sent to L&D-Sarah Grace Lee', '2024-03-13 08:42:00');
INSERT INTO `dots_tracking` VALUES (83, 1996, 0, 2, 27003, '2024-03-13 08:42:00', NULL, 'Document Received by the user', '2024-03-13 08:42:00');
INSERT INTO `dots_tracking` VALUES (84, 1996, 0, 1, 27003, '2024-03-13 08:42:00', 'asasdad', 'Document Sent to L&D-Max Alexander Fischer', '2024-03-13 08:42:00');

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
