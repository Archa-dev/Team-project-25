-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: localhost    Database: u_210073009_team_project_2
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `basket`
--

DROP TABLE IF EXISTS `basket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `basket` (
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`customer_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customerdetails` (`customer_id`),
  CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `productdetails` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `basket`
--

LOCK TABLES `basket` WRITE;
/*!40000 ALTER TABLE `basket` DISABLE KEYS */;
INSERT INTO `basket` VALUES (1,1),(3,2),(1,3),(1,5),(3,17);
/*!40000 ALTER TABLE `basket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customerdetails`
--

DROP TABLE IF EXISTS `customerdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customerdetails` (
  `user_id` int DEFAULT NULL,
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `default_address` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `customerdetails_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `logindetails` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customerdetails`
--

LOCK TABLES `customerdetails` WRITE;
/*!40000 ALTER TABLE `customerdetails` DISABLE KEYS */;
INSERT INTO `customerdetails` VALUES (2,1,'Bob',NULL),(4,3,'Rob','');
/*!40000 ALTER TABLE `customerdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logindetails`
--

DROP TABLE IF EXISTS `logindetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logindetails` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `authorization_level` enum('admin','customer') COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logindetails`
--

LOCK TABLES `logindetails` WRITE;
/*!40000 ALTER TABLE `logindetails` DISABLE KEYS */;
INSERT INTO `logindetails` VALUES (1,'admin','admin1','$2y$10$s/CPs4CdgyNM7iw6DaDhVuKbd58UIHCKxxWn21zN8QTk6/qTUg.d2','admin1@xyzmail.com'),(2,'customer','customer1','$2y$10$urbv5YWeTcCTWaRufto1vu.YchMD8d22/G7moPiI.qehY.OlUmrHK','customer1@xyzmail.com'),(4,'customer','customer2','$2y$10$7Rd86FW/l6wPEChP9R.eAOBElfEBVww7a3vVMt7BZuP9FDQ.WVN7C','yzx@email.com');
/*!40000 ALTER TABLE `logindetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendingorders`
--

DROP TABLE IF EXISTS `pendingorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pendingorders` (
  `customer_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `shipping_address` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  KEY `customer_id` (`customer_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `pendingorders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customerdetails` (`customer_id`),
  CONSTRAINT `pendingorders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `productdetails` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendingorders`
--

LOCK TABLES `pendingorders` WRITE;
/*!40000 ALTER TABLE `pendingorders` DISABLE KEYS */;
/*!40000 ALTER TABLE `pendingorders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `previousorders`
--

DROP TABLE IF EXISTS `previousorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `previousorders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `date` date DEFAULT NULL,
  `shipping_address` varchar(200) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`order_id`,`customer_id`,`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `previousorders`
--

LOCK TABLES `previousorders` WRITE;
/*!40000 ALTER TABLE `previousorders` DISABLE KEYS */;
INSERT INTO `previousorders` VALUES (1,1,12,'2023-12-01','123 Main St, Cityville'),(2,1,5,'2023-12-02','456 Oak St, Townsville'),(3,1,23,'2023-12-03','789 Pine St, Villageland'),(4,1,17,'2023-12-04','321 Elm St, Hamletville'),(5,1,8,'2023-12-05','654 Birch St, Countryside');
/*!40000 ALTER TABLE `previousorders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productdetails`
--

DROP TABLE IF EXISTS `productdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productdetails` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `product_image` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` decimal(6,2) NOT NULL,
  `stock` int NOT NULL,
  `colour` enum('black','white','yellow','brown','green') COLLATE utf8mb4_general_ci NOT NULL,
  `gender` enum('male','female','unisex') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prescription` tinyint(1) DEFAULT NULL,
  `blue_light` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productdetails`
--

LOCK TABLES `productdetails` WRITE;
/*!40000 ALTER TABLE `productdetails` DISABLE KEYS */;
INSERT INTO `productdetails` VALUES (1,'Black Product 1','black_product1.jpg',29.99,50,'black','male',1,1),(2,'Black Product 2','black_product2.jpg',39.99,30,'black','male',0,1),(3,'Black Product 3','black_product3.jpg',49.99,20,'black','female',1,0),(4,'Black Product 4','black_product4.jpg',59.99,10,'black','female',0,0),(5,'Black Product 5','black_product5.jpg',69.99,5,'black','unisex',1,1),(6,'White Product 1','white_product1.jpg',29.99,50,'white','male',0,1),(7,'White Product 2','white_product2.jpg',39.99,30,'white','male',1,0),(8,'White Product 3','white_product3.jpg',49.99,20,'white','female',0,0),(9,'White Product 4','white_product4.jpg',59.99,10,'white','female',1,1),(10,'White Product 5','white_product5.jpg',69.99,5,'white','unisex',0,1),(11,'Yellow Product 1','yellow_product1.jpg',29.99,50,'yellow','male',1,0),(12,'Yellow Product 2','yellow_product2.jpg',39.99,30,'yellow','male',0,0),(13,'Yellow Product 3','yellow_product3.jpg',49.99,20,'yellow','female',1,1),(14,'Yellow Product 4','yellow_product4.jpg',59.99,10,'yellow','female',0,1),(15,'Yellow Product 5','yellow_product5.jpg',69.99,5,'yellow','unisex',1,0),(16,'Brown Product 1','brown_product1.jpg',29.99,50,'brown','male',0,0),(17,'Brown Product 2','brown_product2.jpg',39.99,30,'brown','male',1,1),(18,'Brown Product 3','brown_product3.jpg',49.99,20,'brown','female',0,1),(19,'Brown Product 4','brown_product4.jpg',59.99,10,'brown','female',1,0),(20,'Brown Product 5','brown_product5.jpg',69.99,5,'brown','unisex',0,0),(21,'Green Product 1','green_product1.jpg',29.99,50,'green','male',1,1),(22,'Green Product 2','green_product2.jpg',39.99,30,'green','male',0,1),(23,'Green Product 3','green_product3.jpg',49.99,20,'green','female',1,0),(24,'Green Product 4','green_product4.jpg',59.99,10,'green','female',0,0),(25,'Green Product 5','green_product5.jpg',69.99,5,'green','unisex',1,1);
/*!40000 ALTER TABLE `productdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productreviews`
--

DROP TABLE IF EXISTS `productreviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productreviews` (
  `product_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `star_rating` int DEFAULT NULL,
  `review_text` text COLLATE utf8mb4_general_ci,
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `productreviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `productdetails` (`product_id`),
  CONSTRAINT `productreviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `logindetails` (`user_id`),
  CONSTRAINT `productreviews_chk_1` CHECK (((`star_rating` >= 0) and (`star_rating` <= 5)))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productreviews`
--

LOCK TABLES `productreviews` WRITE;
/*!40000 ALTER TABLE `productreviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `productreviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitereviews`
--

DROP TABLE IF EXISTS `sitereviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sitereviews` (
  `user_id` int DEFAULT NULL,
  `star_rating` int DEFAULT NULL,
  `review_text` text COLLATE utf8mb4_general_ci,
  KEY `user_id` (`user_id`),
  CONSTRAINT `sitereviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `logindetails` (`user_id`),
  CONSTRAINT `sitereviews_chk_1` CHECK (((`star_rating` >= 0) and (`star_rating` <= 5)))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitereviews`
--

LOCK TABLES `sitereviews` WRITE;
/*!40000 ALTER TABLE `sitereviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `sitereviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'u_210073009_team_project_2'
--

--
-- Dumping routines for database 'u_210073009_team_project_2'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-09 16:21:05
