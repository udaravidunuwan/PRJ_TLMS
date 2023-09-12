-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 01:15 PM
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
-- Table structure for table `tlms_admin`
--

CREATE TABLE `tlms_admin` (
  `tlms_admin_id` int(255) NOT NULL,
  `tlms_admin_type` int(255) NOT NULL,
  `tlms_admin_email` varchar(255) NOT NULL,
  `tlms_admin_password` varchar(255) NOT NULL,
  `tlms_admin_temp_pwd` varchar(255) NOT NULL,
  `tlms_admin_system_users_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tlms_admin`
--

INSERT INTO `tlms_admin` (`tlms_admin_id`, `tlms_admin_type`, `tlms_admin_email`, `tlms_admin_password`, `tlms_admin_temp_pwd`, `tlms_admin_system_users_id`) VALUES
(1, 1, 'admin@mail.com', 'admin', '', 0),
(2, 2, 'admin_cus@mail.com', 'admincus', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tlms_manager`
--

CREATE TABLE `tlms_manager` (
  `tlms_manager_id` int(255) NOT NULL,
  `tlms_manager_email` varchar(255) NOT NULL,
  `tlms_manager_password` varchar(255) NOT NULL,
  `tlms_manager_temp_pwd` varchar(255) NOT NULL,
  `tlms_manager_system_users_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tlms_manager`
--

INSERT INTO `tlms_manager` (`tlms_manager_id`, `tlms_manager_email`, `tlms_manager_password`, `tlms_manager_temp_pwd`, `tlms_manager_system_users_id`) VALUES
(1, 'manager@mail.com', 'manager', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tlms_system_users`
--

CREATE TABLE `tlms_system_users` (
  `tlms_system_users_id` int(255) NOT NULL,
  `tlms_system_users_first_name` varchar(255) NOT NULL,
  `tlms_system_users_last_name` varchar(255) NOT NULL,
  `tlms_system_users_user_role` varchar(255) NOT NULL,
  `tlms_system_users_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tlms_system_users`
--

INSERT INTO `tlms_system_users` (`tlms_system_users_id`, `tlms_system_users_first_name`, `tlms_system_users_last_name`, `tlms_system_users_user_role`, `tlms_system_users_email`) VALUES
(1, 'testuser', 'testname', 'Admin', 'testuser@mail.com'),
(2, 'test1', 'testname', 'Admin', 'test1@mail.com'),
(3, 'test2', 'testname', 'Manager', 'test2@gmail.com'),
(4, 'test3', 'testname', 'User', 'test3@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tlms_user`
--

CREATE TABLE `tlms_user` (
  `tlms_user_id` int(255) NOT NULL,
  `tlms_user_type` int(255) NOT NULL,
  `tlms_user_email` varchar(255) NOT NULL,
  `tlms_user_password` varchar(255) NOT NULL,
  `tlms_user_temp_pwd` varchar(255) NOT NULL,
  `tlms_user_system_users_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tlms_user`
--

INSERT INTO `tlms_user` (`tlms_user_id`, `tlms_user_type`, `tlms_user_email`, `tlms_user_password`, `tlms_user_temp_pwd`, `tlms_user_system_users_id`) VALUES
(1, 1, 'user@mail.com', 'user', '', 0),
(2, 2, 'usercus@mail.com', 'usercus', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tlms_admin`
--
ALTER TABLE `tlms_admin`
  ADD PRIMARY KEY (`tlms_admin_id`);

--
-- Indexes for table `tlms_manager`
--
ALTER TABLE `tlms_manager`
  ADD PRIMARY KEY (`tlms_manager_id`);

--
-- Indexes for table `tlms_system_users`
--
ALTER TABLE `tlms_system_users`
  ADD PRIMARY KEY (`tlms_system_users_id`);

--
-- Indexes for table `tlms_user`
--
ALTER TABLE `tlms_user`
  ADD PRIMARY KEY (`tlms_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tlms_admin`
--
ALTER TABLE `tlms_admin`
  MODIFY `tlms_admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tlms_manager`
--
ALTER TABLE `tlms_manager`
  MODIFY `tlms_manager_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tlms_system_users`
--
ALTER TABLE `tlms_system_users`
  MODIFY `tlms_system_users_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tlms_user`
--
ALTER TABLE `tlms_user`
  MODIFY `tlms_user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
