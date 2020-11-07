-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2020 at 01:44 PM
-- Server version: 8.0.21-0ubuntu0.20.04.4
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `gid` int NOT NULL,
  `grade` int NOT NULL,
  `sid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`gid`, `grade`, `sid`) VALUES
(1, 7, 1),
(2, 9, 1),
(3, 6, 2),
(4, 6, 2),
(5, 7, 2),
(6, 9, 3),
(7, 8, 3),
(8, 6, 4),
(9, 7, 4),
(10, 6, 5),
(11, 8, 5),
(12, 10, 5),
(13, 6, 6),
(14, 7, 6),
(15, 7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `school_board`
--

CREATE TABLE `school_board` (
  `sbid` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `data_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `school_board`
--

INSERT INTO `school_board` (`sbid`, `name`, `data_type`) VALUES
(1, 'CSM', 'json'),
(2, 'CSMB', 'xml');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sid` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `sbid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sid`, `name`, `sbid`) VALUES
(1, 'Olive Yew', 1),
(2, 'Allie Grater', 1),
(3, 'Eileen Sideways', 2),
(4, 'Percy Kewshun', 2),
(5, 'Anita Bath', 2),
(6, 'Willie Makit', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`gid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `school_board`
--
ALTER TABLE `school_board`
  ADD PRIMARY KEY (`sbid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `sbid` (`sbid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `gid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `school_board`
--
ALTER TABLE `school_board`
  MODIFY `sbid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `fk_sid` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_sbid` FOREIGN KEY (`sbid`) REFERENCES `school_board` (`sbid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
