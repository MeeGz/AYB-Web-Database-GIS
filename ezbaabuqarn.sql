-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2016 at 01:14 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ezbaabuqarn`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'meegz', '01010'),
(2, 'joe', '9129288'),
(3, 'mohamed', 'magdy'),
(34, 'yousifelhady', '9129288'),
(35, 'joeelhady', '9129288');

-- --------------------------------------------------------

--
-- Table structure for table `aybmember`
--

CREATE TABLE `aybmember` (
  `AYBMemberID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `university` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `studyYear` varchar(100) NOT NULL,
  `residence` varchar(100) NOT NULL,
  `AYBYear` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aybmember`
--

INSERT INTO `aybmember` (`AYBMemberID`, `name`, `phone`, `email`, `university`, `faculty`, `studyYear`, `residence`, `AYBYear`) VALUES
(1, 'joe', '010', 'yousifelhady@aybasu,com', 'asu', 'eng', '4th', 'eldaher', '14-15-16-17'),
(2, 'bogy', '011', 'bogy.@bogy.com', 'asu', 'eng', '4th', 'nasr city', '2015-16-17'),
(3, 'Magdy', '010', 'meg.com', 'asu', 'eng', '4th', 'el7daye2', '0'),
(4, 'mido', '011', 'mido.com', 'asu', 'eng', '4th', 'elzatoon', '0'),
(5, '3ezz', '0', '3ezzawy.com', 'asu', 'eng', '4th', '3een shams', '0'),
(6, 'nash2at', '0000', 'nash_2at.com', 'asu', 'eng', '4th', 'elharam :O', '5555'),
(11, '3ebs', '0101010', '3ebs@mips.com', 'asu', 'engi', '2015', 'gesr el swees', '2015');

-- --------------------------------------------------------

--
-- Table structure for table `ezbamember`
--

CREATE TABLE `ezbamember` (
  `memberID` int(11) NOT NULL,
  `familyID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `famName` varchar(50) DEFAULT NULL,
  `sex` varchar(5) NOT NULL,
  `birthDate` varchar(10) NOT NULL,
  `educationCond` varchar(50) NOT NULL,
  `educationLevel` varchar(50) NOT NULL,
  `educationExpenses` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ezbamember`
--

INSERT INTO `ezbamember` (`memberID`, `familyID`, `name`, `famName`, `sex`, `birthDate`, `educationCond`, `educationLevel`, `educationExpenses`) VALUES
(3, 5, 'shokry', 'shokoz', 'male', '4 4 ', '3', '6', '7998'),
(4, 6, 'omar', '3omar', 'male', '5 5', '4', '4', '564'),
(5, 7, 'abdulla', '3obad', 'male', '6 6', '5', '8', '345'),
(6, 8, 'hossam', 'hoss', 'male', '7 7', '6', '7', '564'),
(7, 4, 'abbas', '3ebs', 'male', '8 8', '7', '9', '3455'),
(24, 66, 'nabil', 'bolbol', 'male', '1980', '0', '0', '0'),
(25, 4, 'ana', 'wana', 'male', '1455', 'dsfdsf', 'dsfdsf', '666'),
(26, 4, 'edy', 'gamed', 'male', '555', '444', '333', '222');

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `familyID` int(11) NOT NULL,
  `houseCode` varchar(5) NOT NULL,
  `noFamilyMembers` int(11) DEFAULT '0',
  `floorNo` varchar(50) DEFAULT NULL,
  `appartmentNo` varchar(50) DEFAULT NULL,
  `familyIncome` int(11) DEFAULT '0',
  `roof` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`familyID`, `houseCode`, `noFamilyMembers`, `floorNo`, `appartmentNo`, `familyIncome`, `roof`) VALUES
(4, 'A1', 3, '2', '1', 1599, 'yes'),
(7, 'A1', 0, '2', '1', 0, 'no'),
(8, 'C1', 0, '1', '1', 0, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `area` varchar(2) NOT NULL,
  `houseCode` varchar(5) NOT NULL,
  `noOfFloors` varchar(50) DEFAULT NULL,
  `noOfAppartments` varchar(50) DEFAULT NULL,
  `specialSign` varchar(100) DEFAULT NULL,
  `sanitation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`area`, `houseCode`, `noOfFloors`, `noOfAppartments`, `specialSign`, `sanitation`) VALUES
('B', 'B1', '5', '10', 'ay 7aga', 'yes'),
('M', 'M1', '2', '4', 'جنب جامع أم اسامة', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `inferior`
--

CREATE TABLE `inferior` (
  `memberID` int(11) NOT NULL,
  `conditionn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inferior`
--

INSERT INTO `inferior` (`memberID`, `conditionn`) VALUES
(2, ' cc'),
(25, ' hey enta');

-- --------------------------------------------------------

--
-- Table structure for table `manage`
--

CREATE TABLE `manage` (
  `AYBMemberID` int(11) NOT NULL,
  `projectID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manage`
--

INSERT INTO `manage` (`AYBMemberID`, `projectID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 5),
(1, 7),
(2, 3),
(2, 4),
(3, 5),
(3, 7),
(4, 5),
(5, 1),
(6, 3),
(10, 7),
(11, 1),
(11, 3),
(11, 8),
(12, 1),
(12, 5),
(12, 6),
(12, 7);

-- --------------------------------------------------------

--
-- Table structure for table `participate`
--

CREATE TABLE `participate` (
  `memberID` int(11) NOT NULL,
  `projectID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participate`
--

INSERT INTO `participate` (`memberID`, `projectID`) VALUES
(1, 1),
(1, 5),
(2, 1),
(2, 2),
(2, 7),
(3, 2),
(3, 3),
(3, 4),
(3, 7),
(4, 2),
(4, 3),
(4, 5),
(4, 6),
(4, 7),
(4, 9),
(5, 2),
(5, 3),
(5, 4),
(5, 8),
(6, 2),
(6, 5),
(6, 8),
(6, 9),
(7, 2),
(25, 6),
(26, 8);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `projectID` int(11) NOT NULL,
  `projectName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projectID`, `projectName`) VALUES
(2, 'masharee3 saghira'),
(3, 'Troos'),
(4, 'Warsha'),
(5, 'Meshkah'),
(6, 'kindergarten'),
(7, 'Literacy'),
(8, 'Charity'),
(10, 'medical care');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `memberID` int(11) NOT NULL,
  `skill` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`memberID`, `skill`) VALUES
(1, 'fast'),
(2, 'few'),
(3, 'waa'),
(3, 'wooo'),
(4, 'qadd'),
(4, 'waaaass'),
(5, 'qaaax'),
(5, 'saaaw'),
(6, 'ssdddc'),
(6, 'zcgg'),
(7, 'qwcdz'),
(24, 'baltagy'),
(26, 'baltagy');

-- --------------------------------------------------------

--
-- Table structure for table `superior`
--

CREATE TABLE `superior` (
  `memberID` int(11) NOT NULL,
  `income` int(11) NOT NULL,
  `work` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `superior`
--

INSERT INTO `superior` (`memberID`, `income`, `work`) VALUES
(1, 222, 'asd'),
(2, 222, 'asd'),
(3, 22, 'qwe'),
(4, 22, 'qwe'),
(5, 22, 'qwe'),
(6, 22, 'qwe'),
(7, 0, ''),
(24, 900, '7ares el maqar'),
(26, 900, 'baltagy');

-- --------------------------------------------------------

--
-- Table structure for table `telephone`
--

CREATE TABLE `telephone` (
  `memberID` int(11) NOT NULL,
  `telephoneNo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `telephone`
--

INSERT INTO `telephone` (`memberID`, `telephoneNo`) VALUES
(1, '1234'),
(2, '12'),
(2, '123456'),
(3, '1236435'),
(3, '33'),
(4, '23456'),
(4, '441'),
(5, '2143'),
(5, '63463'),
(6, '4576'),
(7, '12334563'),
(7, '543'),
(10, '463'),
(24, '01222222'),
(25, '101010'),
(26, '01010');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `aybmember`
--
ALTER TABLE `aybmember`
  ADD PRIMARY KEY (`AYBMemberID`);

--
-- Indexes for table `ezbamember`
--
ALTER TABLE `ezbamember`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`familyID`);

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`houseCode`);

--
-- Indexes for table `inferior`
--
ALTER TABLE `inferior`
  ADD PRIMARY KEY (`memberID`,`conditionn`);

--
-- Indexes for table `manage`
--
ALTER TABLE `manage`
  ADD PRIMARY KEY (`AYBMemberID`,`projectID`);

--
-- Indexes for table `participate`
--
ALTER TABLE `participate`
  ADD PRIMARY KEY (`memberID`,`projectID`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`projectID`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`memberID`,`skill`);

--
-- Indexes for table `superior`
--
ALTER TABLE `superior`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `telephone`
--
ALTER TABLE `telephone`
  ADD PRIMARY KEY (`memberID`,`telephoneNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `aybmember`
--
ALTER TABLE `aybmember`
  MODIFY `AYBMemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ezbamember`
--
ALTER TABLE `ezbamember`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `familyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `projectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
