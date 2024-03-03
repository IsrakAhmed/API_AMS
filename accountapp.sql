-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2024 at 07:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


DROP DATABASE IF EXISTS accountapp;
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
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `account_title` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `balance` float(16,2) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `userid`, `account_title`, `account_type`, `balance`, `bank_name`, `branch_name`, `created_at`, `updated_at`) VALUES
(1, 3, 'SumaiyaS', 'Savings Account', 4900.00, 'ABC Bank', 'Main Branch', '2024-02-26 16:13:51', '2024-02-26 16:13:51'),
(2, 5, 'JamilS', 'Current Account', 10500.00, 'XYZ Bank', 'Downtown Branch', '2024-02-26 16:13:51', '2024-02-26 16:14:36'),
(3, 2, 'IsrakS', 'Investment Account', 23000.00, 'PQR Bank', 'City Branch', '2024-02-26 16:13:51', '2024-02-26 16:13:51'),
(4, 1, 'RiyaS', 'Savings Account', 7200.00, 'DEF Bank', 'West Branch', '2024-02-26 16:13:51', '2024-02-26 16:13:51'),
(5, 4, 'RizviS', 'Current Account', 2000.00, 'GHI Bank', 'East Branch', '2024-02-26 16:13:51', '2024-02-26 16:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` bigint(13) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `phone`, `email`, `address`, `profile_img`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 1234567890, 'john.doe@example.com', '123 Main St, City, Country', NULL, '2024-03-03 06:46:41', '2024-03-03 06:46:41'),
(2, 'Jane Smith', NULL, 'jane.smith@example.com', '456 Elm St, City, Country', NULL, '2024-03-03 06:46:41', '2024-03-03 06:46:41'),
(3, 'Michael Johnson', 9876543210, NULL, '789 Oak St, City, Country', NULL, '2024-03-03 06:46:41', '2024-03-03 06:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `buying_price` float(16,2) NOT NULL,
  `selling_price` float(16,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `stock`, `buying_price`, `selling_price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Product 1', 100, 10.50, 15.75, 'Description for Product 1', '2024-03-03 06:46:41', '2024-03-03 06:46:41'),
(2, 'Product 2', 150, 20.25, 30.50, 'Description for Product 2', '2024-03-03 06:46:41', '2024-03-03 06:46:41'),
(3, 'Product 3', 75, 8.99, 12.25, 'Description for Product 3', '2024-03-03 06:46:41', '2024-03-03 06:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `selling_price` float(16,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `name`, `selling_price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Service 1', 50.25, 'Description for Service 1', '2024-03-03 06:46:41', '2024-03-03 06:46:41'),
(2, 'Service 2', 75.99, 'Description for Service 2', '2024-03-03 06:46:41', '2024-03-03 06:46:41'),
(3, 'Service 3', 100.50, 'Description for Service 3', '2024-03-03 06:46:41', '2024-03-03 06:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `amount` float(16,2) NOT NULL,
  `balance_after_transaction` float(16,2) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_type_img` varchar(255) DEFAULT NULL,
  `debit` float(16,2) NOT NULL,
  `credit` float(16,2) NOT NULL,
  `reference` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `account_id`, `amount`, `balance_after_transaction`, `payment_type`, `payment_type_img`, `debit`, `credit`, `reference`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 100.00, 4900.00, 'Online Transfer', NULL, 100.00, 0.00, 'Ref123', 'Online transfer to friend', '2024-02-26 16:13:51', '2024-02-26 16:13:51'),
(2, 2, 500.00, 10500.00, 'Cash Deposit', NULL, 0.00, 500.00, 'Dep456', 'Cash deposit from client', '2024-02-26 16:13:51', '2024-02-26 16:13:51'),
(3, 3, 2000.00, 23000.00, 'Credit Card Payment', NULL, 2000.00, 0.00, 'Pay789', 'Credit card payment for bill', '2024-02-26 16:13:51', '2024-02-26 16:13:51'),
(4, 4, 300.00, 7200.00, 'Online Transfer', NULL, 300.00, 0.00, 'Ref234', 'Online transfer to family', '2024-02-26 16:13:51', '2024-02-26 16:13:51'),
(5, 5, 1000.00, 2000.00, 'Withdrawal', NULL, 1000.00, 0.00, 'WD567', 'Cash withdrawal for expenses', '2024-02-26 16:13:51', '2024-02-26 16:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` bigint(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `fullname`, `phone`, `email`, `address`, `profile_img`, `created_at`, `updated_at`) VALUES
(1, 'riya', '123456', 'Esrat Jahan', 8801789643367, 'riya@riya.com', 'Bogra, Bangladesh', NULL, '2024-02-26 15:55:18', '2024-02-26 15:55:18'),
(2, 'israk', '123456', 'Israk AHmed', 8801321400000, 'israk@israk.com', 'Rajshahi', NULL, '2024-02-26 15:55:18', '2024-02-26 15:55:18'),
(3, 'sumaiya', '321123', 'Sumaiya Tasnim', 8801700000000, 'sumaiya@sumaiya.com', 'Dhaka', NULL, '2024-02-26 15:55:18', '2024-02-26 15:55:18'),
(4, 'rizvi', '987789', 'Bakhtiar Rizvi', 8801900000000, 'rizvi@rizvi.com', 'Uganda', NULL, '2024-02-26 15:55:18', '2024-02-26 15:55:18'),
(5, 'jamil', '456654', 'Shahriar Jamil', 8801111410000, 'jamil@jamil.com', 'Nigeria', NULL, '2024-02-26 15:55:18', '2024-02-26 15:55:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
