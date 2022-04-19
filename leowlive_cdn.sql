-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 19, 2022 at 12:41 PM
-- Server version: 10.6.7-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leowlive_cdn`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `id` int(11) NOT NULL,
  `token` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `user_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `file_limit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `file_db`
--

CREATE TABLE `file_db` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `file_name` varchar(40) NOT NULL,
  `file_name_system` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`,`user_name`);

--
-- Indexes for table `file_db`
--
ALTER TABLE `file_db`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `file_name_system` (`file_name_system`),
  ADD UNIQUE KEY `file_name_system_2` (`file_name_system`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_db`
--
ALTER TABLE `file_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
