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

 Date: 13/02/2024 16:32:35
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
  PRIMARY KEY (`HRIS_ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dots_account_info
-- ----------------------------
INSERT INTO `dots_account_info` VALUES (25009, 'Aisha Priya Patel', 'APP', NULL, 1, 'aishappatel', '', 1);
INSERT INTO `dots_account_info` VALUES (27003, 'Sarah Grace Lee', 'SGL', NULL, 2, 'sarahglee', '', 2);
INSERT INTO `dots_account_info` VALUES (29005, 'Emily Mei Chen', 'EMC', NULL, 3, 'emilymchen', '', 3);
INSERT INTO `dots_account_info` VALUES (31007, 'Sophia Fatima Khan', 'SFK', NULL, 1, 'sophiafkhan', '', 4);
INSERT INTO `dots_account_info` VALUES (32001, 'Mia Elizabeth Johnson', 'MEJ', NULL, 2, 'miaejohnson', '', 4);
INSERT INTO `dots_account_info` VALUES (34010, 'Daniel Thomas White', 'DTW', NULL, 3, 'danieltwhite', '', 5);
INSERT INTO `dots_account_info` VALUES (36006, 'Jameson Michael Clark', 'JMC', NULL, 4, 'jamesonmclark', '', 2);
INSERT INTO `dots_account_info` VALUES (38004, 'Diego Alejandro Martinez', 'DAM', NULL, 1, 'diegoamartinez', '', 1);
INSERT INTO `dots_account_info` VALUES (40008, 'Max Alexander Fischer', 'MAF', NULL, 2, 'maxafischer', '1', 1);
INSERT INTO `dots_account_info` VALUES (45002, 'Andrei Mikhail Petrov', 'AMP', NULL, 3, 'andreimpetrov', '', 4);

-- ----------------------------
-- Table structure for dots_doc_action
-- ----------------------------
DROP TABLE IF EXISTS `dots_doc_action`;
CREATE TABLE `dots_doc_action`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_ACTION` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dots_doc_action
-- ----------------------------
INSERT INTO `dots_doc_action` VALUES (1, 'SENT');
INSERT INTO `dots_doc_action` VALUES (2, 'RECEIVE');
INSERT INTO `dots_doc_action` VALUES (3, 'CREATE');

-- ----------------------------
-- Table structure for dots_doc_dept
-- ----------------------------
DROP TABLE IF EXISTS `dots_doc_dept`;
CREATE TABLE `dots_doc_dept`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_DEPT` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dots_doc_status
-- ----------------------------
INSERT INTO `dots_doc_status` VALUES (1, 'Pending');
INSERT INTO `dots_doc_status` VALUES (2, 'Filed');
INSERT INTO `dots_doc_status` VALUES (3, 'Returned');
INSERT INTO `dots_doc_status` VALUES (4, 'Approved');

-- ----------------------------
-- Table structure for dots_doc_type
-- ----------------------------
DROP TABLE IF EXISTS `dots_doc_type`;
CREATE TABLE `dots_doc_type`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_TYPE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
  `DOC_NUM` int NOT NULL AUTO_INCREMENT,
  `DOC_SUBJECT` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `DOC_TYPE_ID` int NULL DEFAULT NULL,
  `LETTER_DATE` date NULL DEFAULT NULL,
  `DOC_NOTES` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `S_OFFICE_ID` int NULL DEFAULT NULL,
  `S_DEPT_ID` int NOT NULL,
  `S_USER_ID` int NOT NULL,
  `R_OFFICE_ID` int NULL DEFAULT NULL,
  `R_DEPT_ID` int NOT NULL,
  `R_USER_ID` int NOT NULL,
  `DATE_TIME_RECEIVED` datetime(6) NOT NULL,
  `DOC_STATUS` int NOT NULL,
  `ACTION_ID` int NULL DEFAULT NULL,
  PRIMARY KEY (`DOC_NUM`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dots_document
-- ----------------------------
INSERT INTO `dots_document` VALUES (1, 'a', 1, '2024-02-13', '', 1, 0, 0, NULL, 2, 40008, '2024-02-13 15:04:00.000000', 1, 2);
INSERT INTO `dots_document` VALUES (2, 'asd', 1, '2024-02-13', '', 5, 0, 0, NULL, 2, 40008, '2024-02-13 15:57:00.000000', 1, 2);
INSERT INTO `dots_document` VALUES (3, ';;lllkopkop', 2, '2024-02-13', '', 6, 0, 0, NULL, 2, 40008, '2024-02-13 16:01:00.000000', 1, 2);
INSERT INTO `dots_document` VALUES (4, 'kain', 3, '2024-02-13', '', 6, 0, 0, NULL, 2, 40008, '2024-02-13 16:10:00.000000', 1, 3);
INSERT INTO `dots_document` VALUES (5, '', 2, '2024-02-13', '', 2, 0, 0, NULL, 4, 36006, '2024-02-13 16:19:00.000000', 1, 2);
INSERT INTO `dots_document` VALUES (6, '', 3, '2024-02-13', '', 1, 0, 0, NULL, 2, 40008, '2024-02-13 16:20:00.000000', 1, 2);

-- ----------------------------
-- Table structure for dots_document_sub
-- ----------------------------
DROP TABLE IF EXISTS `dots_document_sub`;
CREATE TABLE `dots_document_sub`  (
  `DOC_NUM` int NOT NULL,
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_NOTES` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PRPS_ID` int NOT NULL,
  `S_OFFICE_ID` int NULL DEFAULT NULL,
  `S_USER_ID` int NOT NULL,
  `S_DEPT_ID` int NOT NULL,
  `R_OFFICE_ID` int NULL DEFAULT NULL,
  `R_USER_ID` int NOT NULL,
  `R_DEPT_ID` int NOT NULL,
  `DATE_TIME_RECEIVED` datetime(6) NOT NULL,
  `ACTION_ID` int NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dots_document_sub
-- ----------------------------
INSERT INTO `dots_document_sub` VALUES (1, 1, 'a', 1, NULL, 40008, 2, NULL, 40008, 2, '2024-02-13 15:04:00.000000', 1);
INSERT INTO `dots_document_sub` VALUES (1, 2, '1', 2, NULL, 40008, 2, NULL, 25009, 1, '2024-02-13 15:55:00.000000', 1);
INSERT INTO `dots_document_sub` VALUES (1, 3, '1', 2, NULL, 40008, 2, NULL, 31007, 1, '2024-02-13 15:55:00.000000', 1);
INSERT INTO `dots_document_sub` VALUES (1, 4, '1', 2, NULL, 40008, 2, NULL, 38004, 1, '2024-02-13 15:55:00.000000', 1);
INSERT INTO `dots_document_sub` VALUES (1, 5, '4', 2, NULL, 40008, 2, NULL, 34010, 3, '2024-02-13 15:57:00.000000', 1);

SET FOREIGN_KEY_CHECKS = 1;
