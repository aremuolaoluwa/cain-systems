-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 11:29 AM
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
  `date` date DEFAULT curdate(),
  `program_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mark_attendance`
--

INSERT INTO `mark_attendance` (`id`, `name`, `reg_number`, `class`, `status`, `date`, `program_name`) VALUES
(1, 'Joseph Olaoluwa Aremu', 'cain/2024/12220', 'JSS1', 'Present', '2024-08-06', NULL),
(2, 'Joseph Olaoluwa Aremu', 'cain/2024/00225', 'JSS1', 'Present', '2024-08-06', NULL),
(3, 'Bello Olatomiwa James', 'CAIN/2024/052', 'SS2', 'Present', '2024-08-06', NULL),
(4, 'Joseph Olaoluwa Aremu', 'cain/2024/12220', 'JSS1', 'Present', '2024-08-06', 'Daily Tutorial'),
(5, 'Joseph Olaoluwa Aremu', 'cain/2024/00225', 'JSS1', 'Present', '2024-08-06', 'Daily Tutorial'),
(6, 'Bello Olatomiwa James', 'CAIN/2024/052', 'SS2', 'Present', '2024-08-06', 'Daily Tutorial');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `program` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `program`) VALUES
(2, 'Career Enrichment'),
(1, 'Daily Tutorial'),
(3, 'ICT4U'),
(5, 'Life Hacks'),
(4, 'Mentorship Class');

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `other_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `reg_number` varchar(50) NOT NULL,
  `class` enum('JSS1','JSS2','JSS3','SS1','SS2','SS3') NOT NULL,
  `dob` date NOT NULL,
  `name_of_school` varchar(255) NOT NULL,
  `state_of_origin` varchar(100) NOT NULL,
  `year_admitted` varchar(10) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `religion` enum('christianity','islam') NOT NULL,
  `guardian_name` varchar(100) NOT NULL,
  `guardian_phone` varchar(20) NOT NULL,
  `occupation` varchar(120) NOT NULL,
  `guardian_address` varchar(255) NOT NULL,
  `enrollment_status` enum('enrolled','unenrolled') DEFAULT 'unenrolled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_profile`
--

INSERT INTO `student_profile` (`id`, `first_name`, `other_name`, `last_name`, `reg_number`, `class`, `dob`, `name_of_school`, `state_of_origin`, `year_admitted`, `gender`, `religion`, `guardian_name`, `guardian_phone`, `occupation`, `guardian_address`, `enrollment_status`) VALUES
(2, 'Joseph', 'Olaoluwa', 'Aremu', 'cain/2024/12220', 'JSS1', '2024-07-23', 'School here', 'Lagos', '2024', 'male', 'christianity', 'Guardian Name Here', '234255566322', 'Tech Expert', '4, Guardian Adress Here', 'enrolled'),
(3, 'Joseph', 'Olaoluwa', 'Aremu', 'cain/2024/00225', 'JSS1', '2024-07-30', 'School here', 'Lagos', '2024', 'male', 'christianity', 'Guardian Name Here', '234255566322', 'Tech Expert', '4, Guardian Adress Here', 'unenrolled'),
(4, 'Bello', 'Olatomiwa', 'James', 'CAIN/2024/052', 'SS2', '2005-06-24', 'Glory Shines College, Lagos', 'Kogi State', '2024', 'male', 'islam', 'Mr James Adewunmi', '08025468955', 'Accountant', '3, George Madsison, Street, Ikotun, Lagos', 'unenrolled');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_program_name` (`program_name`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `program` (`program`);

--
-- Indexes for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_profile`
--
ALTER TABLE `student_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`reg_number`) REFERENCES `students` (`reg_number`);

--
-- Constraints for table `mark_attendance`
--
ALTER TABLE `mark_attendance`
  ADD CONSTRAINT `fk_program_name` FOREIGN KEY (`program_name`) REFERENCES `programs` (`program`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
