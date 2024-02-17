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

 Date: 17/02/2024 17:48:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for doc_num_sequence
-- ----------------------------
DROP TABLE IF EXISTS `doc_num_sequence`;
CREATE TABLE `doc_num_sequence`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `current_value` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of doc_num_sequence
-- ----------------------------
INSERT INTO `doc_num_sequence` VALUES (1, 29);

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document
-- ----------------------------
INSERT INTO `dots_document` VALUES (1, 1, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (2, 2, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (3, 3, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (4, 4, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (5, 5, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (6, 6, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (7, 7, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 4, 2, 1);
INSERT INTO `dots_document` VALUES (8, 7, 1, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 4, 2, 1);
INSERT INTO `dots_document` VALUES (9, 7, 2, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 4, 2, 1);
INSERT INTO `dots_document` VALUES (10, 7, 3, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 4, 2, 1);
INSERT INTO `dots_document` VALUES (11, 8, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (12, 9, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (13, 10, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (14, 11, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (15, 12, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (16, 13, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (17, 14, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (18, 15, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (19, 16, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (20, 17, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (21, 18, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (22, 19, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (23, 20, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (24, 21, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (25, 22, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (26, 23, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (27, 24, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (28, 25, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (29, 26, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (30, 27, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);
INSERT INTO `dots_document` VALUES (31, 28, 0, '', 0, '2024-02-17', '', 0, 0, 0, 0, 2, 27003, '2024-02-17 14:22:00.000000', 5, 2, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document_sub
-- ----------------------------
INSERT INTO `dots_document_sub` VALUES (1, 1, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:03:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (2, 1, 0, '', 0, 0, 27003, 2, 0, 40008, 2, '2024-02-17 13:03:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (3, 2, 0, '', 1, 0, 27003, 2, 0, 40008, 2, '2024-02-17 13:04:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (4, 2, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:04:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (5, 2, 2, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:05:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (6, 2, 3, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:06:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (7, 2, 4, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:07:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (8, 2, 5, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:09:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (9, 3, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:10:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (10, 4, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:11:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (11, 4, 1, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:12:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (12, 5, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:13:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (13, 5, 1, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:13:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (14, 6, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:21:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (15, 7, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:24:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (16, 8, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:24:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (17, 9, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:25:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (18, 10, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:26:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (19, 10, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:26:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (20, 10, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:26:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (21, 10, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:27:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (22, 5, 2, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:27:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (23, 5, 3, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:27:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (24, 10, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:32:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (25, 15, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 13:35:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (26, 7, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 14:22:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (27, 7, 1, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 14:22:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (28, 7, 2, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 14:22:00.000000', 1, 1);
INSERT INTO `dots_document_sub` VALUES (29, 7, 3, '', 0, 0, 27003, 2, 0, 0, 0, '2024-02-17 14:22:00.000000', 1, 1);

-- ----------------------------
-- Triggers structure for table dots_document
-- ----------------------------
DROP TRIGGER IF EXISTS `trigger_auto_increment_doc_num`;
delimiter ;;
CREATE TRIGGER `trigger_auto_increment_doc_num` BEFORE INSERT ON `dots_document` FOR EACH ROW BEGIN
    IF NEW.doc_num IS NULL OR NEW.doc_num = '' THEN
        SET @new_doc_num := (SELECT current_value FROM doc_num_sequence);
        UPDATE doc_num_sequence
        SET current_value = current_value + 1;
        SET NEW.doc_num = @new_doc_num;
    END IF;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
