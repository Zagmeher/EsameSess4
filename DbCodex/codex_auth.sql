-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.2    Database: codex
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `auth`
--

DROP TABLE IF EXISTS `auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth` (
  `idAuth` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idContatto` int(10) unsigned NOT NULL,
  `user` varchar(255) NOT NULL,
  `sfida` varchar(255) NOT NULL,
  `secretJWT` varchar(255) NOT NULL,
  `scadenzaSfida` int(10) unsigned NOT NULL,
  `sale` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idAuth`),
  KEY `auth_idcontatto_foreign` (`idContatto`),
  CONSTRAINT `auth_idcontatto_foreign` FOREIGN KEY (`idContatto`) REFERENCES `contatti` (`idContatto`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth`
--

LOCK TABLES `auth` WRITE;
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` VALUES (1,1,'admin@example.com','$2y$12$qeYNFh4MytWa0hvzh291o.BrmSc4mFS4lA3m/ylymYsTEs2a1iMri','kUJXd51pdGTapr3HlvMGjFBXum4HIGPAM8ioioIhBZAhp5LUaRrRd9ZO12IniK2M',1760193094,'r3Gzg3HgzKrQe5tDzThX5n1Xlre7evew','2025-09-11 12:31:34','2025-09-11 12:31:34'),(2,2,'utente@example.com','$2y$12$xTf7KG5GdCA2j1DcqzFITu6YF3NLRvggjUjIKit.xdKDcKvj0q6sS','qW1cCgzT8xs5TS1RK6KcDVxh5KlVpCi9Bcm3TVI83jiPHrtzkYJTi6GKct3itRfm',1760193095,'FX2a2hRH0ruoo6rUcADUWSW7iAjcGR9O','2025-09-11 12:31:35','2025-09-11 12:31:35'),(3,11,'admin@example.com','$2y$12$8Wz2XcGjfYaKDxCUH7v33eVd6xLy60rujRHrsr72SAMdBz5SjQAMe','v5aKH0yvwDFk7KkGrG4775hK5N0Kpy4DH5xZakxE404lp4q0vgFwyYQ7sZaMJxvR',1760456511,'YHYzDL8gRTodl6a4xZT3fafl9iZ9Ra3V','2025-09-14 13:41:51','2025-09-14 13:41:51'),(4,12,'utente@example.com','$2y$12$c.bYcwjjPo1RYNFJkRUyQuoJaWhhvacItlNOgdJ/n4aHu68g7/lbC','QptRiQRHAhxollEg2XdGaozQQSW68OkNuEWbR2ZTdrgVmZL8cs4gC4oVkYY6B7JA',1760456512,'WavVu7hs90EqbupqGfphrsLkCXOtGarg','2025-09-14 13:41:52','2025-09-14 13:41:52');
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-15  9:40:12
