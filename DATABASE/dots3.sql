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

 Date: 06/03/2024 08:53:37
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
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document_inbound
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document_outbound
-- ----------------------------

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
INSERT INTO `dots_num_sequence` VALUES (1, 1987);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_tracking
-- ----------------------------

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
