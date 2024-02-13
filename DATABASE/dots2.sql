/*
MySQL Backup
Database: dots
Backup Time: 2024-02-13 14:52:48
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `dots`.`dots_account_info`;
DROP TABLE IF EXISTS `dots`.`dots_doc_action`;
DROP TABLE IF EXISTS `dots`.`dots_doc_dept`;
DROP TABLE IF EXISTS `dots`.`dots_doc_division`;
DROP TABLE IF EXISTS `dots`.`dots_doc_office`;
DROP TABLE IF EXISTS `dots`.`dots_doc_prps`;
DROP TABLE IF EXISTS `dots`.`dots_doc_status`;
DROP TABLE IF EXISTS `dots`.`dots_doc_type`;
DROP TABLE IF EXISTS `dots`.`dots_document`;
DROP TABLE IF EXISTS `dots`.`dots_document_sub`;
CREATE TABLE `dots_account_info` (
  `HRIS_ID` int(11) NOT NULL,
  `FULL_NAME` varchar(255) NOT NULL,
  `INITIAL` varchar(255) NOT NULL,
  `OFFICE_ID` int(11) DEFAULT NULL,
  `DEPT_ID` int(11) DEFAULT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `DIVISION` int(11) NOT NULL,
  PRIMARY KEY (`HRIS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `dots_doc_action` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_ACTION` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `dots_doc_dept` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_DEPT` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `dots_doc_division` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_DIVISION` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `dots_doc_office` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_OFFICE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `dots_doc_prps` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_PRPS` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `dots_doc_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_STATUS` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `dots_doc_type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_TYPE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `dots_document` (
  `DOC_NUM` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_SUBJECT` varchar(255) DEFAULT NULL,
  `DOC_TYPE_ID` int(11) DEFAULT NULL,
  `LETTER_DATE` date DEFAULT NULL,
  `DOC_NOTES` varchar(255) NOT NULL,
  `S_OFFICE_ID` int(11) DEFAULT NULL,
  `S_DEPT_ID` int(11) NOT NULL,
  `S_USER_ID` int(11) NOT NULL,
  `R_OFFICE_ID` int(11) DEFAULT NULL,
  `R_DEPT_ID` int(11) NOT NULL,
  `R_USER_ID` int(11) NOT NULL,
  `DATE_TIME_RECEIVED` datetime(6) NOT NULL,
  `DOC_STATUS` int(11) NOT NULL,
  `ACTION_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`DOC_NUM`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `dots_document_sub` (
  `DOC_NUM` int(11) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_NOTES` varchar(255) NOT NULL,
  `PRPS_ID` int(11) NOT NULL,
  `S_OFFICE_ID` int(11) DEFAULT NULL,
  `S_USER_ID` int(11) NOT NULL,
  `S_DEPT_ID` int(11) NOT NULL,
  `R_OFFICE_ID` int(11) DEFAULT NULL,
  `R_USER_ID` int(11) NOT NULL,
  `R_DEPT_ID` int(11) NOT NULL,
  `DATE_TIME_RECEIVED` datetime(6) NOT NULL,
  `ACTION_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
BEGIN;
LOCK TABLES `dots`.`dots_account_info` WRITE;
DELETE FROM `dots`.`dots_account_info`;
INSERT INTO `dots`.`dots_account_info` (`HRIS_ID`,`FULL_NAME`,`INITIAL`,`OFFICE_ID`,`DEPT_ID`,`USERNAME`,`PASSWORD`,`DIVISION`) VALUES (25009, 'Aisha Priya Patel', 'APP', NULL, 1, 'aishappatel', '', 1),(27003, 'Sarah Grace Lee', 'SGL', NULL, 2, 'sarahglee', '', 2),(29005, 'Emily Mei Chen', 'EMC', NULL, 3, 'emilymchen', '', 3),(31007, 'Sophia Fatima Khan', 'SFK', NULL, 1, 'sophiafkhan', '', 4),(32001, 'Mia Elizabeth Johnson', 'MEJ', NULL, 2, 'miaejohnson', '', 4),(34010, 'Daniel Thomas White', 'DTW', NULL, 3, 'danieltwhite', '', 5),(36006, 'Jameson Michael Clark', 'JMC', NULL, 4, 'jamesonmclark', '', 2),(38004, 'Diego Alejandro Martinez', 'DAM', NULL, 1, 'diegoamartinez', '', 1),(40008, 'Max Alexander Fischer', 'MAF', NULL, 2, 'maxafischer', '1', 1),(45002, 'Andrei Mikhail Petrov', 'AMP', NULL, 3, 'andreimpetrov', '', 4)
;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `dots`.`dots_doc_action` WRITE;
DELETE FROM `dots`.`dots_doc_action`;
INSERT INTO `dots`.`dots_doc_action` (`ID`,`DOC_ACTION`) VALUES (1, 'SENT'),(2, 'RECEIVE'),(3, 'CREATE')
;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `dots`.`dots_doc_dept` WRITE;
DELETE FROM `dots`.`dots_doc_dept`;
INSERT INTO `dots`.`dots_doc_dept` (`ID`,`DOC_DEPT`) VALUES (1, 'ARD'),(2, 'L&D'),(3, 'PIAD')
;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `dots`.`dots_doc_division` WRITE;
DELETE FROM `dots`.`dots_doc_division`;
INSERT INTO `dots`.`dots_doc_division` (`ID`,`DOC_DIVISION`) VALUES (1, 'ARD'),(2, 'L&D'),(3, 'PIAD')
;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `dots`.`dots_doc_office` WRITE;
DELETE FROM `dots`.`dots_doc_office`;
INSERT INTO `dots`.`dots_doc_office` (`ID`,`DOC_OFFICE`) VALUES (1, 'CMOo')
;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `dots`.`dots_doc_prps` WRITE;
DELETE FROM `dots`.`dots_doc_prps`;
INSERT INTO `dots`.`dots_doc_prps` (`ID`,`DOC_PRPS`) VALUES (1, 'Review'),(2, 'Comment/Observation'),(3, 'Initial/Signature'),(4, 'Approval')
;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `dots`.`dots_doc_status` WRITE;
DELETE FROM `dots`.`dots_doc_status`;
INSERT INTO `dots`.`dots_doc_status` (`ID`,`DOC_STATUS`) VALUES (1, 'Pending'),(2, 'Filed'),(3, 'Returned'),(4, 'Approved')
;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `dots`.`dots_doc_type` WRITE;
DELETE FROM `dots`.`dots_doc_type`;
INSERT INTO `dots`.`dots_doc_type` (`ID`,`DOC_TYPE`) VALUES (1, 'Admin. Order/EO'),(2, 'Indorsement'),(3, 'Letter/Invitation')
;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `dots`.`dots_document` WRITE;
DELETE FROM `dots`.`dots_document`;
INSERT INTO `dots`.`dots_document` (`DOC_NUM`,`DOC_SUBJECT`,`DOC_TYPE_ID`,`LETTER_DATE`,`DOC_NOTES`,`S_OFFICE_ID`,`S_DEPT_ID`,`S_USER_ID`,`R_OFFICE_ID`,`R_DEPT_ID`,`R_USER_ID`,`DATE_TIME_RECEIVED`,`DOC_STATUS`,`ACTION_ID`) VALUES (1, NULL, NULL, NULL, '2024-02-06', NULL, 0, 0, NULL, 0, 0, '2024-02-06 15:35:00.000000', 1, NULL),(2, NULL, NULL, NULL, '2024-02-06', NULL, 0, 0, NULL, 0, 0, '2024-02-06 15:35:00.000000', 2, NULL),(3, NULL, NULL, NULL, '2024-02-06', NULL, 0, 0, NULL, 0, 0, '2024-02-06 15:35:00.000000', 2, NULL),(4, NULL, NULL, NULL, '2024-02-08', NULL, 0, 0, NULL, 0, 0, '2024-02-08 08:24:00.000000', 2, NULL),(5, NULL, NULL, NULL, '2024-02-08', NULL, 0, 0, NULL, 0, 0, '2024-02-08 12:00:00.000000', 1, NULL),(6, NULL, NULL, NULL, '2024-02-08', NULL, 0, 0, NULL, 0, 0, '2024-02-08 12:00:00.000000', 2, NULL),(7, NULL, NULL, NULL, '2024-02-08', NULL, 0, 0, NULL, 0, 0, '2024-02-08 12:00:00.000000', 2, NULL),(8, NULL, NULL, NULL, '2024-02-08', NULL, 0, 0, NULL, 0, 0, '2024-02-08 12:54:00.000000', 2, NULL),(9, NULL, NULL, NULL, '2024-02-08', NULL, 0, 0, NULL, 0, 0, '2024-02-08 12:54:00.000000', 2, NULL),(10, '', NULL, '2024-02-12', '', NULL, 0, 0, NULL, 0, 0, '2024-02-12 09:28:00.000000', 1, NULL),(11, '', 1, '2024-02-12', '', 1, 0, 0, NULL, 0, 0, '2024-02-12 09:28:00.000000', 1, NULL),(12, '', 2, '2024-02-12', '', 1, 0, 0, NULL, 0, 0, '2024-02-12 09:30:00.000000', 1, NULL),(13, 'asddsasda', 1, '2024-02-12', '', 1, 0, 0, NULL, 0, 0, '2024-02-12 09:31:00.000000', 1, NULL),(14, 'DSADSASDA', 2, '2024-02-12', '', 1, 0, 0, NULL, 0, 0, '2024-02-12 11:55:00.000000', 0, NULL),(15, 'ads', 1, '2024-02-12', '', 1, 0, 0, NULL, 0, 0, '2024-02-12 13:12:00.000000', 0, NULL),(16, 'sad', 1, '2024-02-12', '', 1, 0, 0, NULL, 0, 0, '2024-02-12 13:23:00.000000', 1, 2),(17, 'sad', 1, '2024-02-12', '', 1, 0, 0, NULL, 0, 0, '2024-02-12 13:23:00.000000', 1, 3),(18, 'asdsadasasdad', 2, '2024-02-12', '', 1, 0, 0, NULL, 2, 27003, '2024-02-12 14:00:00.000000', 1, 2),(19, 'test 1', 1, '2024-02-12', '', 1, 0, 0, NULL, 2, 27003, '2024-02-12 14:02:00.000000', 1, 3),(20, 'gssffg', 1, '2024-02-12', '', 1, 0, 0, NULL, 2, 27003, '2024-02-12 14:29:00.000000', 1, 3),(21, 'yhhht', 1, '2024-02-12', '', 1, 0, 0, NULL, 2, 27003, '2024-02-12 15:10:00.000000', 1, 2),(22, '', NULL, '2024-02-12', '', NULL, 0, 0, NULL, 2, 27003, '2024-02-12 15:15:00.000000', 1, 2),(23, 'TeST', 2, '2024-02-13', '', 1, 0, 0, NULL, 3, 34010, '2024-02-13 09:16:00.000000', 1, 2),(24, 'dadaadadadadada', 1, '2024-02-13', '', 1, 0, 0, NULL, 3, 34010, '2024-02-13 09:29:00.000000', 1, 3)
;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `dots`.`dots_document_sub` WRITE;
DELETE FROM `dots`.`dots_document_sub`;
INSERT INTO `dots`.`dots_document_sub` (`DOC_NUM`,`ID`,`DOC_NOTES`,`PRPS_ID`,`S_OFFICE_ID`,`S_USER_ID`,`S_DEPT_ID`,`R_OFFICE_ID`,`R_USER_ID`,`R_DEPT_ID`,`DATE_TIME_RECEIVED`,`ACTION_ID`) VALUES (10, 14, 'asdasdasd', 2, NULL, 25009, 0, NULL, 27003, 2, '2024-02-12 09:45:00.000000', 3),(11, 15, 'kkkk', 1, NULL, 25009, 0, NULL, 25009, 1, '2024-02-12 09:49:00.000000', 3),(12, 16, 'adsdassad', 1, NULL, 25009, 0, NULL, 25009, 1, '2024-02-12 09:45:00.000000', 3),(13, 17, 'dssadsadsad', 1, NULL, 25009, 0, NULL, 38004, 1, '2024-02-12 09:44:00.000000', 3),(13, 19, 'asdasdasdasdasdasdas', 1, NULL, 25009, 0, NULL, 25009, 1, '2024-02-12 13:10:00.000000', 3),(20, 20, 'thsi is a test', 1, NULL, 34010, 0, NULL, 32001, 2, '2024-02-13 09:18:00.000000', 3),(2, 21, 'asdasd', 1, NULL, 34010, 0, NULL, 34010, 3, '2024-02-13 10:58:00.000000', 3),(1, 22, 'da', 4, NULL, 34010, 0, NULL, 34010, 3, '2024-02-13 10:59:00.000000', 3),(1, 23, 'da', 4, NULL, 34010, 0, NULL, 45002, 3, '2024-02-13 10:59:00.000000', 3),(23, 24, 'adsasdasdasd', 3, NULL, 0, 0, NULL, 32001, 2, '2024-02-13 14:14:00.000000', 1),(7, 25, 'adsasdasdasdsad', 1, NULL, 0, 0, NULL, 31007, 1, '2024-02-13 14:16:00.000000', 1),(2, 26, 'asdasdasdasdasdasd', 2, NULL, 40008, 0, NULL, 34010, 3, '2024-02-13 14:18:00.000000', 1),(1, 27, 'sdasdasd', 1, NULL, 40008, 0, NULL, 25009, 1, '2024-02-13 14:19:00.000000', 1),(1, 28, 'SDASDAS', 0, NULL, 40008, 0, NULL, 32001, 2, '2024-02-13 14:26:00.000000', 1),(22, 29, 'TEASTSST', 2, NULL, 40008, 2, NULL, 25009, 1, '2024-02-13 14:29:00.000000', 1)
;
UNLOCK TABLES;
COMMIT;
