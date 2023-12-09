-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 08:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `team project year 2`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customerdetails`
--

CREATE TABLE `customerdetails` (
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `default_address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerdetails`
--

INSERT INTO `customerdetails` (`user_id`, `customer_id`, `name`, `default_address`) VALUES
(2, 1, 'Bob', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `logindetails` (
  `user_id` int(11) NOT NULL,
  `authorization_level` enum('admin','customer') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`user_id`, `authorization_level`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin1', '$2y$10$s/CPs4CdgyNM7iw6DaDhVuKbd58UIHCKxxWn21zN8QTk6/qTUg.d2', 'admin1@xyzmail.com'),
(2, 'customer', 'customer1', '$2y$10$urbv5YWeTcCTWaRufto1vu.YchMD8d22/G7moPiI.qehY.OlUmrHK', 'customer1@xyzmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pendingorders`
--

CREATE TABLE `pendingorders` (
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `shipping_address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `previousorders`
--

CREATE TABLE `previousorders` (
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `shipping_address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productdetails`
--

CREATE TABLE `productdetails` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_image` varchar(300) DEFAULT NULL,
  `price` decimal(6,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `colour` enum('black','white','yellow','brown','green') NOT NULL,
  `gender` enum('male','female','unisex') DEFAULT NULL,
  `prescription` tinyint(1) DEFAULT NULL,
  `blue_light` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productdetails`
--

INSERT INTO `productdetails` (`product_id`, `product_name`, `product_image`, `price`, `stock`, `colour`, `gender`, `prescription`, `blue_light`) VALUES
(1, 'Black Product 1', 'black_product1.jpg', '29.99', 50, 'black', 'male', 1, 1),
(2, 'Black Product 2', 'black_product2.jpg', '39.99', 30, 'black', 'male', 0, 1),
(3, 'Black Product 3', 'black_product3.jpg', '49.99', 20, 'black', 'female', 1, 0),
(4, 'Black Product 4', 'black_product4.jpg', '59.99', 10, 'black', 'female', 0, 0),
(5, 'Black Product 5', 'black_product5.jpg', '69.99', 5, 'black', 'unisex', 1, 1),
(6, 'White Product 1', 'white_product1.jpg', '29.99', 50, 'white', 'male', 0, 1),
(7, 'White Product 2', 'white_product2.jpg', '39.99', 30, 'white', 'male', 1, 0),
(8, 'White Product 3', 'white_product3.jpg', '49.99', 20, 'white', 'female', 0, 0),
(9, 'White Product 4', 'white_product4.jpg', '59.99', 10, 'white', 'female', 1, 1),
(10, 'White Product 5', 'white_product5.jpg', '69.99', 5, 'white', 'unisex', 0, 1),
(11, 'Yellow Product 1', 'yellow_product1.jpg', '29.99', 50, 'yellow', 'male', 1, 0),
(12, 'Yellow Product 2', 'yellow_product2.jpg', '39.99', 30, 'yellow', 'male', 0, 0),
(13, 'Yellow Product 3', 'yellow_product3.jpg', '49.99', 20, 'yellow', 'female', 1, 1),
(14, 'Yellow Product 4', 'yellow_product4.jpg', '59.99', 10, 'yellow', 'female', 0, 1),
(15, 'Yellow Product 5', 'yellow_product5.jpg', '69.99', 5, 'yellow', 'unisex', 1, 0),
(16, 'Brown Product 1', 'brown_product1.jpg', '29.99', 50, 'brown', 'male', 0, 0),
(17, 'Brown Product 2', 'brown_product2.jpg', '39.99', 30, 'brown', 'male', 1, 1),
(18, 'Brown Product 3', 'brown_product3.jpg', '49.99', 20, 'brown', 'female', 0, 1),
(19, 'Brown Product 4', 'brown_product4.jpg', '59.99', 10, 'brown', 'female', 1, 0),
(20, 'Brown Product 5', 'brown_product5.jpg', '69.99', 5, 'brown', 'unisex', 0, 0),
(21, 'Green Product 1', 'green_product1.jpg', '29.99', 50, 'green', 'male', 1, 1),
(22, 'Green Product 2', 'green_product2.jpg', '39.99', 30, 'green', 'male', 0, 1),
(23, 'Green Product 3', 'green_product3.jpg', '49.99', 20, 'green', 'female', 1, 0),
(24, 'Green Product 4', 'green_product4.jpg', '59.99', 10, 'green', 'female', 0, 0),
(25, 'Green Product 5', 'green_product5.jpg', '69.99', 5, 'green', 'unisex', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productreviews`
--

CREATE TABLE `productreviews` (
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `star_rating` int(11) DEFAULT NULL CHECK (`star_rating` >= 0 and `star_rating` <= 5),
  `review_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sitereviews`
--

CREATE TABLE `sitereviews` (
  `user_id` int(11) DEFAULT NULL,
  `star_rating` int(11) DEFAULT NULL CHECK (`star_rating` >= 0 and `star_rating` <= 5),
  `review_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`customer_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `customerdetails`
--
ALTER TABLE `customerdetails`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `logindetails`
--
ALTER TABLE `logindetails`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pendingorders`
--
ALTER TABLE `pendingorders`
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `previousorders`
--
ALTER TABLE `previousorders`
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `productreviews`
--
ALTER TABLE `productreviews`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sitereviews`
--
ALTER TABLE `sitereviews`
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customerdetails`
--
ALTER TABLE `customerdetails`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logindetails`
--
ALTER TABLE `logindetails`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productdetails`
--
ALTER TABLE `productdetails`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customerdetails` (`customer_id`),
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `productdetails` (`product_id`);

--
-- Constraints for table `customerdetails`
--
ALTER TABLE `customerdetails`
  ADD CONSTRAINT `customerdetails_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `logindetails` (`user_id`);

--
-- Constraints for table `pendingorders`
--
ALTER TABLE `pendingorders`
  ADD CONSTRAINT `pendingorders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customerdetails` (`customer_id`),
  ADD CONSTRAINT `pendingorders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `productdetails` (`product_id`);

--
-- Constraints for table `previousorders`
--
ALTER TABLE `previousorders`
  ADD CONSTRAINT `previousorders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customerdetails` (`customer_id`),
  ADD CONSTRAINT `previousorders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `productdetails` (`product_id`);

--
-- Constraints for table `productreviews`
--
ALTER TABLE `productreviews`
  ADD CONSTRAINT `productreviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `productdetails` (`product_id`),
  ADD CONSTRAINT `productreviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `logindetails` (`user_id`);

--
-- Constraints for table `sitereviews`
--
ALTER TABLE `sitereviews`
  ADD CONSTRAINT `sitereviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `logindetails` (`user_id`);
COMMIT;


INSERT INTO `basket` (`customer_id`, `product_id`) VALUES (1,1)(1,2)(2,1);