-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 11, 2023 at 07:21 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testnew`
--

-- --------------------------------------------------------

--
-- Table structure for table `CourseOfferings`
--

CREATE TABLE `CourseOfferings` (
  `OID` int(11) NOT NULL,
  `CourseCode` varchar(7) NOT NULL,
  `Prof` varchar(255) NOT NULL,
  `Semester` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CourseOfferings`
--

INSERT INTO `CourseOfferings` (`OID`, `CourseCode`, `Prof`, `Semester`) VALUES
(1, 'CPS101', 'Smith', 'F2022'),
(2, 'PHL201', 'Descartes', 'F2022'),
(3, 'MKT213', 'Chan', 'F2022'),
(4, 'CPS102', 'Smith', 'W2023'),
(5, 'BIO303', 'Curie', 'W2023');

-- --------------------------------------------------------

--
-- Table structure for table `Courses`
--

CREATE TABLE `Courses` (
  `CourseCode` varchar(7) NOT NULL,
  `CourseName` varchar(255) NOT NULL,
  `Dept` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Courses`
--

INSERT INTO `Courses` (`CourseCode`, `CourseName`, `Dept`) VALUES
('BIO303', 'Genetics', 'Biology'),
('CPS101', 'Computer Science I', 'Computer Science'),
('CPS102', 'Computer Science II', 'Computer Science'),
('MKT213', 'Marketing Plans', 'Marketing'),
('PHL201', 'Ethics', 'Philosophy');

-- --------------------------------------------------------

--
-- Table structure for table `StRec`
--

CREATE TABLE `StRec` (
  `StudentID` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Major` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `StRec`
--

INSERT INTO `StRec` (`StudentID`, `FirstName`, `LastName`, `Email`, `Major`) VALUES
(1, 'John', 'Doe', 'john.doe@university.edu', 'Computer Science'),
(2, 'Jane', 'Doe', 'jane.doe@university.edu', 'Business Management'),
(3, 'Bill', 'Gates', 'bgates@university.edu', 'Computer Science'),
(4, 'John', 'Roberts', 'jroberts@university.edu', 'Undeclared'),
(5, 'Julia', 'Roberts', 'jroberts2@university.edu', 'Biology');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CourseOfferings`
--
ALTER TABLE `CourseOfferings`
  ADD PRIMARY KEY (`OID`),
  ADD KEY `CourseCode` (`CourseCode`);

--
-- Indexes for table `Courses`
--
ALTER TABLE `Courses`
  ADD PRIMARY KEY (`CourseCode`);

--
-- Indexes for table `StRec`
--
ALTER TABLE `StRec`
  ADD PRIMARY KEY (`StudentID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CourseOfferings`
--
ALTER TABLE `CourseOfferings`
  ADD CONSTRAINT `courseofferings_ibfk_1` FOREIGN KEY (`CourseCode`) REFERENCES `Courses` (`CourseCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
