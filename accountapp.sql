-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 06:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE DATABASE accountapp;
USE accountapp;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accountapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone` bigint(13) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `fullname`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 'riya', '123456', 'Esrat Jahan', 8801789643367, 'riya@riya.com', 'Bogra, Bangladesh', '2024-02-23 21:00:26', '2024-02-24 05:12:00'),
(2, 'israk', '123456', 'Israk AHmed', 8801321400000, 'israk@israk.com', 'Rajshahi', '2024-02-23 21:21:25', '2024-02-24 05:11:52'),
(3, 'sumaiya', '321123', 'Sumaiya Tasnim', 8801700000000, 'sumaiya@sumaiya.com', 'Dhaka', '2024-02-24 05:08:35', '2024-02-24 05:08:35'),
(4, 'rizvi', '987789', 'Bakhtiar Rizvi', 8801900000000, 'rizvi@rizvi.com', 'Uganda', '2024-02-24 05:11:29', '2024-02-24 05:11:29'),
(5, 'jamil', '456654', 'Shahriar Jamil', 8801111410000, 'jamil@jamil.com', 'Nigeria', '2024-02-24 05:13:27', '2024-02-24 05:13:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
