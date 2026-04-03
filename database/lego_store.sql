-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: lego_store
-- ------------------------------------------------------
-- Server version	8.0.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (21,41,90,1,6000000),(22,42,90,509,1064420.218037661),(23,43,91,4,600000),(24,44,93,4,120),(25,45,90,1,1064873.9980948165),(26,46,93,1,120),(27,47,91,1,576000),(28,48,60,3,500000),(29,49,93,7,120),(30,50,91,1,576000),(31,51,91,6,576000);
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Số nhà, tên đường',
  `shipping_ward` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_province` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_money` double DEFAULT '0',
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'COD',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'New',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (41,6,'Long Trần','0912345678','trần đình xu','Phường Ba Đình','Thành phố Hà Nội',6000000,'COD','2','2026-03-26 18:26:30'),(42,6,'Long Trần','0912345678','trần đình xu','Phường Ba Đình','Thành phố Hà Nội',541789890.9811695,'COD','3','2026-03-28 01:59:11'),(43,6,'Long Trần','0912345678','trần đình xu','Phường Thục Phán','Tỉnh Cao Bằng',2400000,'COD','0','2026-03-28 02:09:16'),(44,6,'qqq','0912345678','qqqq','Xã Ngọc Đường','Tỉnh Tuyên Quang',480,'COD','3','2026-03-28 02:40:00'),(45,6,'Long Trần','0912345678','trần đình xu','Phường Ngọc Hà','Thành phố Hà Nội',1064873.9980948165,'COD','0','2026-03-28 07:35:08'),(46,6,'Long Trần','0938182737','trần đình xu','Phường Ba Đình','Thành phố Hà Nội',120,'VNPAY Online','2','2026-04-03 02:59:24'),(47,6,'Tiểu Long','0837164536','trần đình xu','Phường Đức Xuân','Tỉnh Thái Nguyên',576000,'COD','3','2026-04-03 03:57:06'),(48,6,'Tiểu Long','0837164536','trần đình xu','Phường Đức Xuân','Tỉnh Thái Nguyên',1500000,'COD','3','2026-04-03 04:04:00'),(49,6,'Tiểu Long','0837164536','trần đình xu','Phường Đức Xuân','Tỉnh Thái Nguyên',840,'COD','3','2026-04-03 04:08:52'),(50,13,'Hoàng Thị Thu Hà','0989746535','100 Trần Đình Xu','Xã Đông Thạnh','Thành phố Hồ Chí Minh',576000,'COD','0','2026-04-03 17:38:51'),(51,13,'Hoàng Thị Thu Hà','0989746535','100 Trần Đình Xu','Xã Đông Thạnh','Thành phố Hồ Chí Minh',3456000,'VNPAY Online','0','2026-04-03 17:41:24');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `theme_id` int NOT NULL,
  `sku` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `piece_count` int DEFAULT NULL,
  `age_range` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_quantity` int DEFAULT '0',
  `low_stock_threshold` int DEFAULT '5',
  `import_price` double DEFAULT '0',
  `profit_margin` double DEFAULT '20',
  `status` tinyint DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sku` (`sku`),
  KEY `theme_id` (`theme_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'42115','Lamborghini Sian FKP 37','Đối với chủ nghĩa thoát ly thuần túy, không gì có thể đánh bại việc trượt sau tay lái của một chiếc siêu xe thể thao hàng đầu. Giờ đây, bạn có thể tạo lại cảm giác đó và dành thời gian cho cuộc sống hàng ngày với bộ xây dựng LEGO TECHNIC 42115 Siêu Xe Lamborghini Sian FKP 37 ( 3696 Chi tiết) tuyệt đẹp này. Nắm bắt thiết kế có tầm nhìn xa của chiếc xe ban đầu, mô hình tỷ lệ 1: 8 này được trang bị vô số chi tiết chân thực, đưa bạn đến gần hơn bao giờ hết với đồ thật.',3696,'18+','product-1.jpg',400,1,4000000,3,1,'2026-02-02 15:54:09'),(2,1,'42096','Porsche 911 RSR','Siêu xe hạng nặng',1580,'10+','product-2.jpg',500,1,2000000,25,1,'2026-02-02 15:54:09'),(3,2,'75192','Millennium Falcon',NULL,7541,'16+','product-3.jpg',200,1,200000,15,1,'2026-02-02 15:54:09'),(4,3,'71043','Hogwarts Castle',NULL,6020,'16+','product-4.jpg',250,1,4000000,20,1,'2026-02-02 15:54:09'),(41,1,'42143','Ferrari Daytona SP3','Siêu xe Ferrari chi tiết tỷ lệ 1:8',3778,'18+','product-5.jpg',10,1,6000000,20,1,'2026-03-12 16:14:02'),(42,1,'42125','Ferrari 488 GTE','Xe đua đường trường',1677,'18+','product-6.jpg',0,1,0,25,0,'2026-03-12 16:14:02'),(43,1,'42127','THE BATMAN - BATMOBILE','Xe của Batman',1360,'10+','product-7.jpg',50,1,2000000,25,1,'2026-03-12 16:14:02'),(45,1,'42110','Land Rover Defender','Xe địa hình huyền thoại',2573,'11+','product-9.jpg',5,1,500000,25,1,'2026-03-12 16:14:02'),(47,1,'42145','Airbus H155 Rescue Helicopter','Trực thăng cứu hộ',2001,'11+','product-11.jpg',30,5,12000000,100,1,'2026-03-12 16:14:02'),(51,2,'75327','Luke Skywalker (Red Five) Helmet','Mũ phi công của Luke',675,'18+','product-15.jpg',0,1,0,30,1,'2026-03-12 16:14:02'),(52,2,'75328','The Mandalorian N-1 Starfighter Microfighter','Phi thuyền của Mandalorian',584,'18+','product-16.jpg',30,1,800000,30,1,'2026-03-12 16:14:02'),(53,2,'75330','Yoda\'s Jedi Starfighter','Thuyền chiến của Jedi',1000,'18+','product-17.jpg',0,1,0,25,1,'2026-03-12 16:14:02'),(54,2,'75329','Death Star Trench Run Diorama','Cuộc đua rãnh Death Star',715,'18+','product-18.jpg',0,1,0,25,1,'2026-03-12 16:14:02'),(55,2,'75325','The Mandalorian N-1 Starfighter','Tàu chiến đấu N-1',412,'9+','product-19.jpg',1,1,290000,30,1,'2026-03-12 16:14:02'),(57,3,'76391','Hogwarts Icons - Collectors Edition','Các biểu tượng Hogwarts',3010,'18+','product-21.jpg',4,1,600000,25,1,'2026-03-12 16:14:02'),(58,3,'76405','Hogwarts Express - Collectors Edition','Tàu tốc hành Hogwarts',5129,'18+','product-22.jpg',20,1,500000,15,0,'2026-03-12 16:14:02'),(60,3,'76402','Hogwarts: Dumbledore Office','Văn phòng Dumbledore',654,'8+','1774633681_lego-76402-hogwarts-dumbledore-s-office-0-a93e6ec4.jpg',101,1,396534.65346534655,25,1,'2026-03-12 16:14:02'),(90,10,'CV-123','Honda Civic',NULL,1200,'7','1774634633_5818513-3840x2160-desktop-hd-laptop-background.jpg',1024,1,886642.7751144591,20,1,'2026-03-27 18:03:53'),(91,11,'7381','Batman',NULL,1200,'16','1774663588_batman.jpg',13,1,480000,20,0,'2026-03-28 02:06:28'),(94,11,'LEGO3994','LEGO siêu nhân','',123,'12','1775238487_z7354028273780_f23a2cc897e299557e34752d8c3d7ee5.jpg',2,5,7500,20,0,'2026-03-28 03:23:02');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipt_details`
--

DROP TABLE IF EXISTS `receipt_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receipt_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `receipt_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `remain_quantity` int NOT NULL DEFAULT '0',
  `import_price` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receipt_id` (`receipt_id`),
  CONSTRAINT `receipt_details_ibfk_1` FOREIGN KEY (`receipt_id`) REFERENCES `receipts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipt_details`
--

LOCK TABLES `receipt_details` WRITE;
/*!40000 ALTER TABLE `receipt_details` DISABLE KEYS */;
INSERT INTO `receipt_details` VALUES (57,65,90,10,0,5000000),(58,66,60,100,0,400000),(59,66,58,20,0,500000),(60,66,57,4,0,600000),(74,69,90,1000,0,850000),(75,70,91,10,0,500000),(76,71,91,10,0,420000),(77,72,91,4,0,600000),(78,73,93,10,0,100),(79,74,90,15,0,900000),(82,84,93,11000,0,500000),(83,85,57,1,0,4123),(84,86,60,1,0,50000),(85,87,94,1,0,10000),(86,88,90,1,0,500000),(87,89,94,1,0,5000),(88,90,55,1,0,290000),(89,91,93,1000,0,50000),(90,92,93,100,0,5000),(91,94,1,400,0,4000000),(92,94,2,500,0,2000000),(93,94,3,200,0,200000),(94,94,4,250,0,4000000),(95,94,41,10,0,6000000),(96,94,43,50,0,2000000),(97,94,45,5,0,500000),(99,94,52,30,0,800000),(100,95,47,30,0,12000000);
/*!40000 ALTER TABLE `receipt_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipts`
--

DROP TABLE IF EXISTS `receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receipts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL COMMENT 'ID của Admin lập phiếu (từ bảng users)',
  `total_amount` bigint DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0: Nháp, 1: Hoàn thành',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipts`
--

LOCK TABLES `receipts` WRITE;
/*!40000 ALTER TABLE `receipts` DISABLE KEYS */;
INSERT INTO `receipts` VALUES (65,1,50000000,1,'2026-03-26 18:23:03'),(66,1,52400000,1,'2026-03-28 01:42:12'),(69,1,850000000,1,'2026-03-28 01:57:43'),(70,1,5000000,1,'2026-03-28 02:06:49'),(71,1,4200000,1,'2026-03-28 02:09:49'),(72,1,2400000,1,'2026-03-28 02:10:33'),(73,1,1000,1,'2026-03-28 02:35:40'),(74,1,13500000,1,'2026-03-28 07:13:56'),(82,1,0,0,'2026-04-03 04:15:29'),(83,1,0,0,'2026-04-03 04:29:12'),(84,1,5500000000,1,'2026-04-03 04:29:32'),(85,1,4123,0,'2026-04-03 11:47:17'),(86,1,50000,1,'2026-04-03 11:51:11'),(87,1,10000,1,'2026-04-03 11:51:42'),(88,1,500000,1,'2026-04-03 11:55:59'),(89,1,5000,1,'2026-04-22 12:08:18'),(90,1,290000,1,'2025-12-15 12:08:47'),(91,1,50000000,1,'2026-03-09 16:55:48'),(92,1,500000,1,'2026-03-04 16:57:04'),(94,1,3826500000,1,'2026-03-16 17:26:12'),(95,1,360000000,1,'2026-03-16 17:50:42');
/*!40000 ALTER TABLE `receipts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` int NOT NULL DEFAULT '5',
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_reviews_product` (`product_id`),
  KEY `fk_reviews_user` (`user_id`),
  CONSTRAINT `fk_reviews_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_reviews_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,60,5,5,'Bộ này ráp mượt cực','2026-03-27 04:45:02');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `themes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themes`
--

LOCK TABLES `themes` WRITE;
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
INSERT INTO `themes` VALUES (1,'Technic','Dòng xe cộ máy móc phức tạp'),(2,'StarWars','Mô hình tàu vũ trụ chiến tranh giữa các vì sao'),(3,'Harry Potter','Thế giới phù thủy Hogwarts'),(10,'Cars',NULL),(11,'Siêu nhân',NULL);
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Số nhà, tên đường',
  `ward` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','customer') COLLATE utf8mb4_unicode_ci DEFAULT 'customer',
  `is_locked` tinyint DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Đặng Tiểu Long','dangtieulong362@gmail.com','e10adc3949ba59abbe56e057f20f883e','0912345678','THPT Lý Thường Kiệt - Thành phố Hồ Chí Minh',NULL,NULL,'customer',0,'2026-03-12 15:46:19'),(4,'Đặng Tiểu Long','dangtieulong0@gmail.com','e10adc3949ba59abbe56e057f20f883e','0312345678','THPT Lý Thường Kiệt - Thành phố Hồ Chí Minh',NULL,NULL,'admin',0,'2026-03-12 15:49:07'),(5,'Long Trần','nickphu216@gmail.com','e10adc3949ba59abbe56e057f20f883e','0938123821','',NULL,NULL,'admin',0,'2026-03-16 17:16:42'),(6,'Tiểu Long','tieulong@gmail.com','c33367701511b4f6020ec61ded352059','0837164536','trần đình xu','Phường Đức Xuân','Tỉnh Thái Nguyên','customer',0,'2026-03-17 12:12:23'),(13,'Hoàng Thị Thu Hà','tieulongne@gmail.com','e10adc3949ba59abbe56e057f20f883e','0989746535','100 Trần Đình Xu','Xã Đông Thạnh','Thành phố Hồ Chí Minh','customer',0,'2026-04-03 17:38:13');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-04  1:05:14
