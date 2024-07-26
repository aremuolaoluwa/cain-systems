-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2024 at 11:44 AM
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
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `class` enum('JSS1','JSS2','JSS3','SS1','SS2','SS3') DEFAULT NULL,
  `reg_number` varchar(255) DEFAULT NULL,
  `status` enum('Present','Absent') DEFAULT NULL,
  `attendance_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mark_attendance`
--

CREATE TABLE `mark_attendance` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `reg_number` varchar(255) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `status` enum('Present','Absent') DEFAULT NULL,
  `date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mark_attendance`
--

INSERT INTO `mark_attendance` (`id`, `name`, `reg_number`, `class`, `status`, `date`) VALUES
(1, 'Joseph Aremu', 'CAIN/JSS2/0267', 'JSS2', 'Absent', '2024-05-27'),
(2, 'Joseph Aremu', 'CAIN/JSS2/0267', 'JSS2', 'Absent', '2024-05-27'),
(3, 'Oluwakemi Olurinola', 'CAIN/SS1/0221', 'SS1', 'Absent', '2024-05-27'),
(4, 'Joseph Aremu', 'CAIN/JSS2/0267', 'JSS2', 'Present', '2024-05-27'),
(5, 'Oluwakemi Olurinola', 'CAIN/SS1/0221', 'SS1', 'Present', '2024-05-27'),
(6, 'Joseph Aremu', 'CAIN/JSS2/0267', 'JSS2', 'Present', '2024-05-28'),
(7, 'Oluwakemi Olurinola', 'CAIN/SS1/0221', 'SS1', 'Present', '2024-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `reg_number` varchar(255) NOT NULL,
  `class` enum('JSS1','JSS2','JSS3','SS1','SS2','SS3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `reg_number`, `class`) VALUES
(1, 'Joseph', 'Aremu', 'CAIN/JSS2/0267', 'JSS2'),
(2, 'Oluwakemi', 'Olurinola', 'CAIN/SS1/0221', 'SS1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reg_number` (`reg_number`);

--
-- Indexes for table `mark_attendance`
--
ALTER TABLE `mark_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_number` (`reg_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mark_attendance`
--
ALTER TABLE `mark_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`reg_number`) REFERENCES `students` (`reg_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
