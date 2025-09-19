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
  `inizioSfida` timestamp NULL DEFAULT NULL,
  `secretJWT` varchar(255) NOT NULL,
  `scadenzaSfida` int(10) unsigned NOT NULL,
  `sale` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idAuth`),
  KEY `auth_idcontatto_foreign` (`idContatto`),
  CONSTRAINT `auth_idcontatto_foreign` FOREIGN KEY (`idContatto`) REFERENCES `contatti` (`idContatto`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth`
--

LOCK TABLES `auth` WRITE;
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` VALUES (1,11,'admin@example.com','$2y$12$dZYItEhY4WHFFmZd3rHelOiRUIVrzu07Bxn9p5pmMlpapNNGAaCK.',NULL,'DICxTdqbyQGDFik7xKjuwEXktXSCjP6lDVSTMYDKj6aaqaf7QNzXoRnYmLPLyJTe',1760883059,'DFJ1BP2yDmlPdP0Rn5AdMiD3Ak0Dl2Z7','2025-09-19 12:10:59','2025-09-19 12:10:59'),(2,12,'utente@example.com','$2y$12$Z6.c/c.KaYn1WR2bMxqM8.pyZcnUKFeFoFDr7ubn7/0sGoxW4HSdS','2025-09-19 12:12:45','ea4b8bbfef4d95c23173e0dbce1f1027c0bc80c9efb6a27900f5c8d8e9c6a1f51967f02ae5c33c1b4655709e61dc67bbc63ebdac006492d14e87fdca526732ed',1760883059,'qOKtctLL6O274p8ytKYAHlqq5G81UPey','2025-09-19 12:10:59','2025-09-19 12:12:45');
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

-- Dump completed on 2025-09-19 16:24:26
