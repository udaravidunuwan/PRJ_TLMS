-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 12:19 PM
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
  `tlms_admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tlms_admin`
--

INSERT INTO `tlms_admin` (`tlms_admin_id`, `tlms_admin_type`, `tlms_admin_email`, `tlms_admin_password`) VALUES
(1, 1, 'admin@mail.com', 'admin'),
(2, 2, 'admin_cus@mail.com', 'admincus');

-- --------------------------------------------------------

--
-- Table structure for table `tlms_manager`
--

CREATE TABLE `tlms_manager` (
  `tlms_manager_id` int(255) NOT NULL,
  `tlms_manager_email` varchar(255) NOT NULL,
  `tlms_manager_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tlms_manager`
--

INSERT INTO `tlms_manager` (`tlms_manager_id`, `tlms_manager_email`, `tlms_manager_password`) VALUES
(1, 'manager@mail.com', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `tlms_user`
--

CREATE TABLE `tlms_user` (
  `tlms_user_id` int(255) NOT NULL,
  `tlms_user_type` int(255) NOT NULL,
  `tlms_user_email` varchar(255) NOT NULL,
  `tlms_user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tlms_user`
--

INSERT INTO `tlms_user` (`tlms_user_id`, `tlms_user_type`, `tlms_user_email`, `tlms_user_password`) VALUES
(1, 1, 'user@mail.com', 'user'),
(2, 2, 'usercus@mail.com', 'usercus');

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
-- AUTO_INCREMENT for table `tlms_user`
--
ALTER TABLE `tlms_user`
  MODIFY `tlms_user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
