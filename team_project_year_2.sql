-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2024 at 03:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team project year 2`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`customer_id`, `product_id`, `quantity`) VALUES
(12, 5, 5);

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
(2, 1, 'Mark', 'ar'),
(9, 8, 'defw', 'dewf');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 'customer', 'customer1', '$2y$10$urbv5YWeTcCTWaRufto1vu.YchMD8d22/G7moPiI.qehY.OlUmrHK', 'customer1@xyzmail.com'),
(9, 'customer', 'dedfe', '$2y$10$nPGr7Ah/nEF3E7z1okoAVOsC1BoEg/j4eW21Dlmk5KkDj9c1Htyuy', 'mkdsa@email.com'),
(12, 'customer', 'testing', '$2y$10$VacXwIqCYJvKOtEUAtJS0uaQLbxTebiEcmZI0TJMf5AtKd8xRB73K', 'testemail@gmail.com');

-- --------------------------------------------------------
--
-- Table structure for table `pending_admin_accounts`
--

CREATE TABLE `pending_admin_accounts` (
  `pending_user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendingorders`
--

CREATE TABLE `pendingorders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `shipping_address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `previousorders`
--

CREATE TABLE `previousorders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `price` decimal(6,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `colour` enum('black','white','yellow','brown','green') NOT NULL,
  `category` enum('male','female','unisex','futuristic','blue_light') DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productdetails`
--

INSERT INTO `productdetails` (`product_id`, `product_name`, `price`, `stock`, `colour`, `category`, `image_id`) VALUES
(1, 'Black Product 1', '29.99', 50, 'black', 'male', NULL),
(2, 'Black Product 2', '39.99', 30, 'black', 'male', NULL),
(3, 'Black Product 3', '49.99', 20, 'black', 'female', NULL),
(4, 'Black Product 4', '59.99', 10, 'black', 'female', NULL),
(5, 'Black Product 5', '69.99', 5, 'black', 'unisex', NULL),
(6, 'White Product 1', '29.99', 50, 'white', 'male', NULL),
(7, 'White Product 2', '39.99', 30, 'white', 'male', NULL),
(8, 'White Product 3', '49.99', 20, 'white', 'female', NULL),
(9, 'White Product 4', '59.99', 10, 'white', 'female', NULL),
(10, 'White Product 5', '69.99', 5, 'white', 'unisex', NULL),
(11, 'Yellow Product 1', '29.99', 50, 'yellow', 'male', NULL),
(12, 'Yellow Product 2', '39.99', 30, 'yellow', 'male', NULL),
(13, 'Yellow Product 3', '49.99', 20, 'yellow', 'female', NULL),
(14, 'Yellow Product 4', '59.99', 10, 'yellow', 'female', NULL),
(15, 'Yellow Product 5', '69.99', 5, 'yellow', 'unisex', NULL),
(16, 'Brown Product 1', '29.99', 50, 'brown', 'male', NULL),
(17, 'Brown Product 2', '39.99', 30, 'brown', 'male', NULL),
(18, 'Brown Product 3', '49.99', 20, 'brown', 'female', NULL),
(19, 'Brown Product 4', '59.99', 10, 'brown', 'female', NULL),
(20, 'Brown Product 5', '69.99', 5, 'brown', 'unisex', NULL),
(21, 'Green Product 1', '29.99', 50, 'green', 'male', NULL),
(22, 'Green Product 2', '39.99', 30, 'green', 'male', NULL),
(23, 'Green Product 3', '49.99', 20, 'green', 'female', NULL),
(24, 'Green Product 4', '59.99', 10, 'green', 'female', NULL),
(25, 'Green Product 5', '69.99', 5, 'green', 'unisex', NULL);

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
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

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
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_image_id` (`image_id`);

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
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logindetails`
--
ALTER TABLE `logindetails`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pending_admin_accounts`
--
ALTER TABLE `pending_admin_accounts`
  MODIFY `pending_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD CONSTRAINT `fk_image_id` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
