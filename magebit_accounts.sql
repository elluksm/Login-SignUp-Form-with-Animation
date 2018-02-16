-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 18, 2017 at 11:53 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magebit_accounts`
--
CREATE DATABASE IF NOT EXISTS `magebit_accounts` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `magebit_accounts`;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_names`
--

CREATE TABLE IF NOT EXISTS `attribute_names` (
  `attribute_id` int(11) NOT NULL,
  `field_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `field_text` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attribute_names`
--

INSERT INTO `attribute_names` (`attribute_id`, `field_name`, `field_text`) VALUES
(1, 'user_age', 'Age'),
(2, 'user_country', 'Country'),
(3, 'user_hobbies', 'Hobbies');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE IF NOT EXISTS `attribute_values` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `field_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `attribute_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `user_id`, `field_name`, `attribute_value`) VALUES
(1, 12, 'user_age', '18'),
(3, 12, 'user_country', 'Latvia'),
(16, 12, 'user_hobbies', 'Salsa'),
(19, 14, 'user_age', '31'),
(20, 14, 'user_country', 'USA'),
(30, 16, 'user_age', '45'),
(31, 16, 'user_country', 'Canada'),
(38, 17, 'user_age', '35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(12, 'Cris', '1@1', '$2y$10$L2ncx7/dG3Xd0vBoAHiiWundWQhu2RyDyYvnRvJXE2l3x5yp5/jvS', '2017-09-30 13:24:38'),
(14, 'User1', '2@2.lv', '$2y$10$Fqwsvbh3Gd19W7fL.sdIquCxNy/ZwcS8Znc7XBdqrmcLOIWVyVVkS', '2017-10-04 21:17:27'),
(15, 'User3', '3@3', '$2y$10$ikgyrDZ6J2zNA8S2HQiHCewdscK0BMurlNYTGeWPVAZk6hzgJqIfO', '2017-10-05 11:54:12'),
(16, 'User5', '12@a', '$2y$10$Bg0zUkv5aUXYBoCEx09pIeiVZZMpRrxPsOZozg0J0H4JnWkXxH9zK', '2017-10-17 14:27:39'),
(17, 'User6', '9@9.lv', '$2y$10$1bsSFgtRFjkEAW5JlQ.zTOs3gvJ6eIT/UZkH5hiAV3pyRvI6p1FYu', '2017-10-17 14:39:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attribute_names`
--
ALTER TABLE `attribute_names`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attribute_names`
--
ALTER TABLE `attribute_names`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
