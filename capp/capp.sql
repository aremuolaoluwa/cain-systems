-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 11:30 AM
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
-- Database: `capp`
--

-- --------------------------------------------------------

--
-- Table structure for table `clockin`
--

CREATE TABLE `clockin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `clock_in_time` datetime NOT NULL,
  `clock_out_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clockin`
--

INSERT INTO `clockin` (`id`, `username`, `clock_in_time`, `clock_out_time`) VALUES
(1, 'admin', '2024-06-11 17:02:01', NULL),
(2, 'admin', '2024-06-13 14:10:51', NULL),
(3, 'admin', '2024-06-13 14:12:29', NULL),
(4, 'ade', '2024-06-13 16:39:02', NULL),
(5, 'joe', '2024-06-20 13:23:24', '2024-06-20 00:00:00'),
(6, 'joe', '2024-06-20 14:06:27', NULL),
(7, 'joe', '2024-06-20 14:06:31', NULL),
(8, 'joe', '2024-06-20 14:13:44', NULL),
(9, 'joe', '2024-06-20 14:13:50', NULL),
(10, 'marie', '2024-06-28 15:04:26', NULL),
(11, 'admin', '2024-07-11 11:10:07', NULL),
(12, 'johns', '2024-07-12 11:26:10', NULL),
(13, 'b_adeyemi', '2024-07-25 11:30:04', NULL),
(14, 'jerry_d', '2024-07-29 14:40:21', NULL),
(15, 'olaoluwa', '2024-07-30 15:47:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clockout`
--

CREATE TABLE `clockout` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `clock_out_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clockout`
--

INSERT INTO `clockout` (`id`, `username`, `clock_out_time`) VALUES
(1, 'joe', '2024-06-20 15:02:44'),
(2, 'marie', '2024-06-28 15:04:44'),
(3, 'admin', '2024-07-11 11:10:18'),
(4, 'johns', '2024-07-12 11:26:40'),
(5, 'b_adeyemi', '2024-07-25 12:10:56'),
(6, 'jerry_d', '2024-07-29 14:40:34'),
(7, 'olaoluwa', '2024-07-30 15:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` enum('student','staff') NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`username`, `firstname`, `lastname`, `email`, `phone`, `role`, `gender`, `password`, `registration_date`, `reset_token`) VALUES
('Olami', 'Joseph', 'Aremu', 'aremujnr@gmail.com', '07042750757', 'staff', 'male', '$2y$10$mG5WLIqQPMnFzRkR6oVKEecVgpIECFuR/FBM6ZNVQE3vhQj0PMHRu', '2024-07-30 08:57:23', 'e2ab66c3038a4cf8ffd4fd7dd716dde8'),
('olaoluwa', 'Joseph', 'Aremu', 'aremujnr@gmail.com', '07042750757', 'staff', 'male', '$2y$10$GXwhPgH4YweG6I75JXg53.y48y9zeF/bcKJ3afh5ss/jtehhDm2WC', '2024-07-30 14:46:10', 'e2ab66c3038a4cf8ffd4fd7dd716dde8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clockin`
--
ALTER TABLE `clockin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clockout`
--
ALTER TABLE `clockout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clockin`
--
ALTER TABLE `clockin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `clockout`
--
ALTER TABLE `clockout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
