-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 12:09 AM
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
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`customer_id`, `product_id`) VALUES
(1, 2),
(1, 5),
(1, 6),
(1, 7),
(1, 8);

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
(1, 'admin', 'admin1', '123', 'admin1@xyzmail.com'),
(2, 'customer', 'customer1', 'abc', 'customer1@xyzmail.com');

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
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `shipping_address` varchar(200) DEFAULT NULL,
  `date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `previousorders`
--

INSERT INTO `previousorders` (`order_id`, `customer_id`, `product_id`, `shipping_address`, `date`) VALUES
(1, 1, 12, '123 Main St, Cityville', '2023-12-01'),
(2, 1, 5, '456 Oak St, Townsville', '2023-12-02'),
(3, 1, 23, '789 Pine St, Villageland', '2023-12-03'),
(4, 1, 17, '321 Elm St, Hamletville', '2023-12-04'),
(5, 1, 8, '654 Birch St, Countryside', '2023-12-05');

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
  `colour` enum('black','white','yellow','brown','green') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productdetails`
--

INSERT INTO `productdetails` (`product_id`, `product_name`, `product_image`, `price`, `stock`, `colour`) VALUES
(1, 'Black Product 1', NULL, '29.99', 50, 'black'),
(2, 'Black Product 2', NULL, '39.99', 30, 'black'),
(3, 'Black Product 3', NULL, '49.99', 20, 'black'),
(4, 'Black Product 4', NULL, '59.99', 10, 'black'),
(5, 'Black Product 5', NULL, '69.99', 5, 'black'),
(6, 'White Product 1', NULL, '29.99', 50, 'white'),
(7, 'White Product 2', NULL, '39.99', 30, 'white'),
(8, 'White Product 3', NULL, '49.99', 20, 'white'),
(9, 'White Product 4', NULL, '59.99', 10, 'white'),
(10, 'White Product 5', NULL, '69.99', 5, 'white'),
(11, 'Yellow Product 1', NULL, '29.99', 50, 'yellow'),
(12, 'Yellow Product 2', NULL, '39.99', 30, 'yellow'),
(13, 'Yellow Product 3', NULL, '49.99', 20, 'yellow'),
(14, 'Yellow Product 4', NULL, '59.99', 10, 'yellow'),
(15, 'Yellow Product 5', NULL, '69.99', 5, 'yellow'),
(16, 'Brown Product 1', NULL, '29.99', 50, 'brown'),
(17, 'Brown Product 2', NULL, '39.99', 30, 'brown'),
(18, 'Brown Product 3', NULL, '49.99', 20, 'brown'),
(19, 'Brown Product 4', NULL, '59.99', 10, 'brown'),
(20, 'Brown Product 5', NULL, '69.99', 5, 'brown'),
(21, 'Green Product 1', NULL, '29.99', 50, 'green'),
(22, 'Green Product 2', NULL, '39.99', 30, 'green'),
(23, 'Green Product 3', NULL, '49.99', 20, 'green'),
(24, 'Green Product 4', NULL, '59.99', 10, 'green'),
(25, 'Green Product 5', NULL, '69.99', 5, 'green');

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
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD PRIMARY KEY (`product_id`);

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
-- AUTO_INCREMENT for table `previousorders`
--
ALTER TABLE `previousorders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
