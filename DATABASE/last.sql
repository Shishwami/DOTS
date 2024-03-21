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

 Date: 22/03/2024 07:56:55
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
  `USERNAME` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `PASSWORD` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `DIVISION` int NOT NULL,
  `DOTS_PRIV` tinyint NULL DEFAULT NULL,
  PRIMARY KEY (`HRIS_ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_account_info
-- ----------------------------
INSERT INTO `dots_account_info` VALUES (25009, 'Aisha Priya Patel', 'APP', NULL, 1, 'aishappatel', '', 1, 2);
INSERT INTO `dots_account_info` VALUES (27003, 'Sarah Grace Lee', 'SGL', NULL, 2, 'sarahglee', '', 2, 3);
INSERT INTO `dots_account_info` VALUES (29005, 'Emily Mei Chen', 'EMC', NULL, 3, 'emilymchen', '', 3, 2);
INSERT INTO `dots_account_info` VALUES (31007, 'Sophia Fatima Khan', 'SFK', NULL, 1, 'sophiafkhan', '', 4, 2);
INSERT INTO `dots_account_info` VALUES (32001, 'Mia Elizabeth Johnson', 'MEJ', NULL, 2, 'miaejohnson', '', 4, 1);
INSERT INTO `dots_account_info` VALUES (34010, 'Daniel Thomas White', 'DTW', NULL, 3, 'danieltwhite', '', 5, 0);
INSERT INTO `dots_account_info` VALUES (36006, 'Jameson Michael Clark', 'JMC', NULL, 4, 'jamesonmclark', '', 2, 2);
INSERT INTO `dots_account_info` VALUES (38004, 'Diego Alejandro Martinez', 'DAM', NULL, 1, 'diegoamartinez', '', 1, 2);
INSERT INTO `dots_account_info` VALUES (40008, 'Max Alexander Fischer', 'MAF', NULL, 2, 'maxafischer', '1', 1, 2);
INSERT INTO `dots_account_info` VALUES (45002, 'Andrei Mikhail Petrov', 'AMP', NULL, 3, 'andreimpetrov', '', 4, 2);

-- ----------------------------
-- Table structure for dots_attachments
-- ----------------------------
DROP TABLE IF EXISTS `dots_attachments`;
CREATE TABLE `dots_attachments`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DOC_NUM` int NULL DEFAULT NULL,
  `ROUTE_NUM` int NULL DEFAULT NULL,
  `HRIS_ID` int NULL DEFAULT NULL,
  `DESCRIPTION` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `FILE_PATH` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `FILE_NAME` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_attachments
-- ----------------------------
INSERT INTO `dots_attachments` VALUES (1, 7683, 0, 27003, 'asd', NULL, NULL);
INSERT INTO `dots_attachments` VALUES (2, 7683, 0, 27003, 'asdasdasdasd', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_doc_prps
-- ----------------------------
INSERT INTO `dots_doc_prps` VALUES (1, 'Review');
INSERT INTO `dots_doc_prps` VALUES (2, 'Comment/Observation');
INSERT INTO `dots_doc_prps` VALUES (3, 'Initial/Signature');
INSERT INTO `dots_doc_prps` VALUES (4, 'Approval');
INSERT INTO `dots_doc_prps` VALUES (5, 'Implementation');
INSERT INTO `dots_doc_prps` VALUES (6, 'Info & Guidance');
INSERT INTO `dots_doc_prps` VALUES (7, 'For Payment');
INSERT INTO `dots_doc_prps` VALUES (8, 'Study/Attend');
INSERT INTO `dots_doc_prps` VALUES (9, 'Urgent Act');
INSERT INTO `dots_doc_prps` VALUES (10, 'Prepare Reply');
INSERT INTO `dots_doc_prps` VALUES (11, 'Finalize');
INSERT INTO `dots_doc_prps` VALUES (12, 'Note And Return File');

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
  `DATE_TIME_RECEIVED` datetime NOT NULL,
  `DOC_STATUS` int NOT NULL,
  `ACTION_ID` int NOT NULL,
  `ROUTED` int NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document
-- ----------------------------
INSERT INTO `dots_document` VALUES (1, 7683, 0, 'asd', 1, '2024-03-21', '', 1, 0, 0, 0, 2, 27003, '2024-03-21 13:32:00', 1, 2, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document_inbound
-- ----------------------------
INSERT INTO `dots_document_inbound` VALUES (1, 7683, 0, 'asdasdasd', 3, 0, 27003, 2, 0, 27003, 2, '0000-00-00 00:00:00', '2024-03-21 13:52:00', 5, 1, 3);
INSERT INTO `dots_document_inbound` VALUES (2, 7683, 0, 'asdasd', 3, 0, 27003, 2, 0, 27003, 2, '2024-03-21 14:11:00', '2024-03-21 14:02:00', 2, 1, 5);
INSERT INTO `dots_document_inbound` VALUES (3, 7683, 0, 'asdasdas', 3, 0, 27003, 2, 0, 40008, 2, NULL, '2024-03-21 14:45:00', 5, 1, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_document_outbound
-- ----------------------------
INSERT INTO `dots_document_outbound` VALUES (1, 7683, 0, 'asdasd', 3, 0, 27003, 2, 0, 27003, 2, NULL, '2024-03-21 14:02:00', 1, 1, 2);
INSERT INTO `dots_document_outbound` VALUES (2, 7683, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-03-21 13:53:00', NULL, 5, 0, NULL);
INSERT INTO `dots_document_outbound` VALUES (3, 7683, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-03-21 13:54:00', NULL, 5, 0, NULL);
INSERT INTO `dots_document_outbound` VALUES (4, 7683, 0, '', 0, 0, 27003, 2, 0, 0, 0, '2024-03-21 14:02:00', NULL, 5, 0, NULL);
INSERT INTO `dots_document_outbound` VALUES (5, 7683, 0, 'asdasdas', 0, 0, 27003, 2, 0, 0, 0, '2024-03-21 14:11:00', '0000-00-00 00:00:00', 2, 0, 3);

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
-- Table structure for dots_filter_year
-- ----------------------------
DROP TABLE IF EXISTS `dots_filter_year`;
CREATE TABLE `dots_filter_year`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `YEAR` year NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dots_filter_year
-- ----------------------------
INSERT INTO `dots_filter_year` VALUES (1, 2023);
INSERT INTO `dots_filter_year` VALUES (2, 2024);

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
INSERT INTO `dots_num_sequence` VALUES (1, 7684);

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
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dots_tracking
-- ----------------------------
INSERT INTO `dots_tracking` VALUES (1, 7683, 0, 2, 27003, '2024-03-21 13:32:00', NULL, 'Document Created/Received at the receiving station', '2024-03-21 13:32:00');
INSERT INTO `dots_tracking` VALUES (2, 7683, 0, 1, 27003, '2024-03-21 13:52:00', 'asdasdasd', 'Document 7683 sent to L&D-Sarah Grace Lee', '2024-03-21 13:53:00');
INSERT INTO `dots_tracking` VALUES (3, 7683, 0, 2, 27003, '2024-03-21 13:53:00', NULL, 'Document Received by the user', '2024-03-21 13:53:00');
INSERT INTO `dots_tracking` VALUES (4, 7683, 0, 5, 27003, NULL, 'hj', 'Receiving canceled by user', '2024-03-21 13:53:00');
INSERT INTO `dots_tracking` VALUES (5, 7683, 0, 2, 27003, '2024-03-21 13:54:00', NULL, 'Document Received by the user', '2024-03-21 13:54:00');
INSERT INTO `dots_tracking` VALUES (6, 7683, 0, 5, 27003, NULL, 'fyu\n\n\n\n\n;l;\n\n\n\nl;', 'Receiving canceled by user', '2024-03-21 13:54:00');
INSERT INTO `dots_tracking` VALUES (7, 7683, 0, 5, 27003, NULL, 'xtyctuvbionk;m', 'Sending Document canceled by sender', '2024-03-21 13:55:00');
INSERT INTO `dots_tracking` VALUES (8, 7683, 0, 1, 27003, '2024-03-21 14:02:00', 'asdasd', 'Document 7683 sent to L&D-Sarah Grace Lee', '2024-03-21 14:02:00');
INSERT INTO `dots_tracking` VALUES (9, 7683, 0, 2, 27003, '2024-03-21 14:02:00', NULL, 'Document Received by the user', '2024-03-21 14:02:00');
INSERT INTO `dots_tracking` VALUES (10, 7683, 0, 5, 27003, NULL, 'hi', 'Receiving canceled by user', '2024-03-21 14:10:00');
INSERT INTO `dots_tracking` VALUES (11, 7683, 0, 2, 27003, '2024-03-21 14:11:00', NULL, 'Document Received by the user', '2024-03-21 14:11:00');
INSERT INTO `dots_tracking` VALUES (12, 7683, 0, 1, 27003, '2024-03-21 14:45:00', 'asdasdas', 'Document 7683 sent to L&D-Max Alexander Fischer', '2024-03-21 14:45:00');
INSERT INTO `dots_tracking` VALUES (13, 7683, 0, 5, 27003, NULL, 'asd', 'Sending Document canceled by sender', '2024-03-21 14:45:00');

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
