-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2024 at 12:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dots`
--
CREATE DATABASE IF NOT EXISTS `dots` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dots`;

-- --------------------------------------------------------

--
-- Table structure for table `dots_account_info`
--

DROP TABLE IF EXISTS `dots_account_info`;
CREATE TABLE `dots_account_info` (
  `HRIS_ID` int(11) NOT NULL,
  `FULL_NAME` varchar(255) NOT NULL,
  `INITIAL` varchar(255) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `DIVISION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dots_account_info`
--

INSERT INTO `dots_account_info` (`HRIS_ID`, `FULL_NAME`, `INITIAL`, `USERNAME`, `PASSWORD`, `DIVISION`) VALUES
(25009, 'Aisha Priya Patel', 'APP', 'aishappatel', '', 1),
(27003, 'Sarah Grace Lee', 'SGL', 'sarahglee', '', 2),
(29005, 'Emily Mei Chen', 'EMC', 'emilymchen', '', 3),
(31007, 'Sophia Fatima Khan', 'SFK', 'sophiafkhan', '', 4),
(32001, 'Mia Elizabeth Johnson', 'MEJ', 'miaejohnson', '', 4),
(34010, 'Daniel Thomas White', 'DTW', 'danieltwhite', '', 5),
(36006, 'Jameson Michael Clark', 'JMC', 'jamesonmclark', '', 2),
(38004, 'Diego Alejandro Martinez', 'DAM', 'diegoamartinez', '', 1),
(40008, 'Max Alexander Fischer', 'MAF', 'maxafischer', '1', 1),
(45002, 'Andrei Mikhail Petrov', 'AMP', 'andreimpetrov', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `dots_document`
--

DROP TABLE IF EXISTS `dots_document`;
CREATE TABLE `dots_document` (
  `DOC_NUM` int(11) NOT NULL,
  `DOC_SUBJECT` varchar(255) NOT NULL,
  `DOC_TYPE` varchar(255) NOT NULL,
  `DOC_OFFICE` varchar(255) NOT NULL,
  `LETTER_DATE` varchar(255) NOT NULL,
  `RECEIVED_BY` varchar(255) NOT NULL,
  `DATE_TIME_RECEIVED` varchar(255) NOT NULL,
  `DOC_STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dots_document`
--

INSERT INTO `dots_document` (`DOC_NUM`, `DOC_SUBJECT`, `DOC_TYPE`, `DOC_OFFICE`, `LETTER_DATE`, `RECEIVED_BY`, `DATE_TIME_RECEIVED`, `DOC_STATUS`) VALUES
(1, 'asdasdasd', '2', '1', '2024-02-06', '40008', '2024-02-06T15:35', 0),
(2, 'asdasdasd', '2', '1', '2024-02-06', '40008', '2024-02-06T15:35', 2),
(3, 'asdasdasd', '2', '1', '2024-02-06', '40008', '2024-02-06T15:35', 2);

-- --------------------------------------------------------

--
-- Table structure for table `dots_doc_division`
--

DROP TABLE IF EXISTS `dots_doc_division`;
CREATE TABLE `dots_doc_division` (
  `ID` int(11) NOT NULL,
  `DOC_DIVISION_NAME` varchar(255) NOT NULL,
  `DOC_DIVISION_CODE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dots_doc_division`
--

INSERT INTO `dots_doc_division` (`ID`, `DOC_DIVISION_NAME`, `DOC_DIVISION_CODE`) VALUES
(1, 'ARD', ''),
(2, 'L&D', ''),
(3, 'PIAD', '');

-- --------------------------------------------------------

--
-- Table structure for table `dots_doc_office`
--

DROP TABLE IF EXISTS `dots_doc_office`;
CREATE TABLE `dots_doc_office` (
  `ID` int(11) NOT NULL,
  `DOC_OFFICE_NAME` varchar(255) NOT NULL,
  `DOC_OFFICE_CODE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dots_doc_office`
--

INSERT INTO `dots_doc_office` (`ID`, `DOC_OFFICE_NAME`, `DOC_OFFICE_CODE`) VALUES
(1, 'CMOo', '');

-- --------------------------------------------------------

--
-- Table structure for table `dots_doc_prps`
--

DROP TABLE IF EXISTS `dots_doc_prps`;
CREATE TABLE `dots_doc_prps` (
  `ID` int(11) NOT NULL,
  `DOC_PRPS_NAME` varchar(255) NOT NULL,
  `DOC_PRPS_CODE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dots_doc_prps`
--

INSERT INTO `dots_doc_prps` (`ID`, `DOC_PRPS_NAME`, `DOC_PRPS_CODE`) VALUES
(1, 'Review', ''),
(2, 'Comment/Observation\r\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `dots_doc_status`
--

DROP TABLE IF EXISTS `dots_doc_status`;
CREATE TABLE `dots_doc_status` (
  `ID` int(11) NOT NULL,
  `DOC_STATUS_NAME` varchar(255) NOT NULL,
  `DOC_STATUS_CODE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dots_doc_status`
--

INSERT INTO `dots_doc_status` (`ID`, `DOC_STATUS_NAME`, `DOC_STATUS_CODE`) VALUES
(0, 'Received', ''),
(1, 'Sent', ''),
(2, 'Pending', ''),
(3, 'Filed', ''),
(4, 'Complete', ''),
(5, 'Returned', '');

-- --------------------------------------------------------

--
-- Table structure for table `dots_doc_type`
--

DROP TABLE IF EXISTS `dots_doc_type`;
CREATE TABLE `dots_doc_type` (
  `ID` int(11) NOT NULL,
  `DOC_TYPE_NAME` varchar(255) NOT NULL,
  `DOC_TYPE_CODE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dots_doc_type`
--

INSERT INTO `dots_doc_type` (`ID`, `DOC_TYPE_NAME`, `DOC_TYPE_CODE`) VALUES
(1, 'Admin. Order/EO', ''),
(2, 'Indorsement', ''),
(3, 'Letter/Invitation', '');

-- --------------------------------------------------------

--
-- Table structure for table `dots_outbound`
--

DROP TABLE IF EXISTS `dots_outbound`;
CREATE TABLE `dots_outbound` (
  `DOC_NUM` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `DOC_PRPS` int(11) NOT NULL,
  `DOC_ADDRESSEE` int(11) NOT NULL,
  `DOC_NOTES` varchar(255) NOT NULL,
  `DOC_ACTION` int(11) NOT NULL,
  `DOC_LOCATION` int(11) NOT NULL,
  `DOC_DIVISION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dots_outbound`
--

INSERT INTO `dots_outbound` (`DOC_NUM`, `ID`, `DOC_PRPS`, `DOC_ADDRESSEE`, `DOC_NOTES`, `DOC_ACTION`, `DOC_LOCATION`, `DOC_DIVISION`) VALUES
(2, 1, 1, 36006, '', 3, 40008, 2),
(2, 2, 1, 29005, '', 3, 40008, 3),
(3, 3, 1, 25009, '', 3, 40008, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dots_account_info`
--
ALTER TABLE `dots_account_info`
  ADD PRIMARY KEY (`HRIS_ID`);

--
-- Indexes for table `dots_document`
--
ALTER TABLE `dots_document`
  ADD PRIMARY KEY (`DOC_NUM`);

--
-- Indexes for table `dots_doc_division`
--
ALTER TABLE `dots_doc_division`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dots_doc_office`
--
ALTER TABLE `dots_doc_office`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dots_doc_prps`
--
ALTER TABLE `dots_doc_prps`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dots_doc_status`
--
ALTER TABLE `dots_doc_status`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dots_doc_type`
--
ALTER TABLE `dots_doc_type`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dots_outbound`
--
ALTER TABLE `dots_outbound`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dots_document`
--
ALTER TABLE `dots_document`
  MODIFY `DOC_NUM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dots_doc_division`
--
ALTER TABLE `dots_doc_division`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dots_doc_office`
--
ALTER TABLE `dots_doc_office`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dots_doc_prps`
--
ALTER TABLE `dots_doc_prps`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dots_doc_status`
--
ALTER TABLE `dots_doc_status`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dots_doc_type`
--
ALTER TABLE `dots_doc_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dots_outbound`
--
ALTER TABLE `dots_outbound`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
