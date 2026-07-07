-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2026 at 01:42 PM
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
-- Database: `empanada_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `activity_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_log`
--

INSERT INTO `audit_log` (`log_id`, `user_id`, `activity`, `activity_date`) VALUES
(1, 1, 'Registered New Account', '2026-07-07 13:45:14'),
(2, 2, 'Registered New Account', '2026-07-07 13:49:33'),
(3, 3, 'Registered New Account', '2026-07-07 13:53:20'),
(4, 5, 'Registered New Account', '2026-07-07 15:27:29'),
(5, 5, 'User Logged In', '2026-07-07 15:28:14'),
(6, 5, 'User Logged Out', '2026-07-07 15:42:45'),
(7, 5, 'User Logged In', '2026-07-07 15:43:01'),
(8, 5, 'User Logged Out', '2026-07-07 15:47:28'),
(9, 5, 'User Logged In', '2026-07-07 15:47:46'),
(10, 5, 'Placed Order #1', '2026-07-07 16:16:17'),
(11, 5, 'User Logged Out', '2026-07-07 17:01:04'),
(12, 5, 'User Logged In', '2026-07-07 17:01:33'),
(13, 5, 'User Logged Out', '2026-07-07 17:28:51'),
(14, 5, 'User Logged In', '2026-07-07 17:29:02');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `delivery_address` text DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_amount`, `payment_method`, `delivery_address`, `order_date`, `order_status`) VALUES
(1, 5, 65.00, NULL, NULL, '2026-07-07 16:16:17', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `quantity`, `subtotal`) VALUES
(1, 1, 2, 1, 30.00),
(2, 1, 4, 1, 35.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category`, `product_name`, `description`, `price`, `stock`, `image`) VALUES
(1, 'Chicken', 'Chicken Empanada', 'Savory chicken filling', 25.00, 100, NULL),
(2, 'Beef', 'Beef Empanada', 'Ground beef filling', 30.00, 99, NULL),
(3, 'Tuna', 'Tuna Empanada', 'Tuna and vegetables', 28.00, 100, NULL),
(4, 'Cheese', 'Cheese Empanada', 'Creamy cheese filling', 35.00, 99, NULL),
(5, 'Special', 'Special Empanada', 'House special flavor', 40.00, 100, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'buyer',
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `address`, `contact`, `role`, `status`) VALUES
(1, 'basti quiambao', 'quiambao.basti@gmail.com', '$2y$10$QrOrJ9/4CKkqGqZCfvvUaO0r875VTbGub0sqJewuDDQ/dtEJG1Dpi', 'Barangay Silangan Rd', '0999199199', 'buyer', 'pending'),
(2, 'test name', 'john@gmail.com', '$2y$10$tfhFHq9hDSODZss1LrT7u.K9UItbQtv58TGqE8Diti2Jeq6zD1a7m', 'blk 9 lot 7 kamote Q St marikina', '0999888999', 'buyer', 'pending'),
(3, 'panco', 'acquiambao@fit.edu.ph', '$2y$10$4Tb9APV6nZ78MNfKcRTV9uJzZf7QuBr5J8bq1z5z4HxGutVrJYKNG', 'asdfg', '0998756543', 'buyer', 'pending'),
(5, 'admin', 'admin@leg8t.com', '$2y$10$TXi.Rp1XLu1vew4PVtT8QO2SuH3iTDo0nVbRmSSYfG/2ehLp06BvG', 'test', '000000000', 'admin', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
