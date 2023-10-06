-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2023 at 11:21 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tlms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tlms_jobs`
--

CREATE TABLE `tlms_jobs` (
  `tlms_jobs_id` int(255) NOT NULL,
  `tlms_jobs_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tlms_jobs_customer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tlms_jobs_created_date` date NOT NULL,
  `tlms_jobs_recieved_date` date DEFAULT NULL,
  `tlms_jobs_started_date` date DEFAULT NULL,
  `tlms_jobs_completed_date` date DEFAULT NULL,
  `tlms_jobs_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tlms_jobs_assigned_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tlms_jobs`
--

INSERT INTO `tlms_jobs` (`tlms_jobs_id`, `tlms_jobs_name`, `tlms_jobs_customer`, `tlms_jobs_created_date`, `tlms_jobs_recieved_date`, `tlms_jobs_started_date`, `tlms_jobs_completed_date`, `tlms_jobs_status`, `tlms_jobs_assigned_to`) VALUES
(1, 'SPOIN', 'KGH / DB Schenker', '2023-09-01', '2023-09-04', '2023-09-12', '2023-09-21', 'Completed', 'manager manager'),
(2, 'BBT', 'KGH / DB Schenker', '2023-10-04', '2023-10-05', NULL, NULL, 'Pending', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `tlms_system_users`
--

CREATE TABLE `tlms_system_users` (
  `tlms_system_users_id` int(255) NOT NULL,
  `tlms_system_users_first_name` varchar(255) NOT NULL,
  `tlms_system_users_last_name` varchar(255) NOT NULL,
  `tlms_system_users_user_role` varchar(255) NOT NULL,
  `tlms_system_users_email` varchar(255) NOT NULL,
  `tlms_system_users_password` varchar(255) DEFAULT NULL,
  `tlms_system_users_temp_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tlms_system_users`
--

INSERT INTO `tlms_system_users` (`tlms_system_users_id`, `tlms_system_users_first_name`, `tlms_system_users_last_name`, `tlms_system_users_user_role`, `tlms_system_users_email`, `tlms_system_users_password`, `tlms_system_users_temp_password`) VALUES
(1, 'admin', 'admin', 'Admin', 'admin@mail.com', 'admin', NULL),
(2, 'manager', 'manager', 'Manager', 'manager@mail.com', 'manager', NULL),
(3, 'user', 'user', 'User', 'user@mail.com', 'user', NULL),
(27, 'test', 'user', 'Admin', 'testuser@mail.com', 'test', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tlms_jobs`
--
ALTER TABLE `tlms_jobs`
  ADD PRIMARY KEY (`tlms_jobs_id`);

--
-- Indexes for table `tlms_system_users`
--
ALTER TABLE `tlms_system_users`
  ADD PRIMARY KEY (`tlms_system_users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tlms_jobs`
--
ALTER TABLE `tlms_jobs`
  MODIFY `tlms_jobs_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tlms_system_users`
--
ALTER TABLE `tlms_system_users`
  MODIFY `tlms_system_users_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
