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
-- Table structure for table `episodi`
--

DROP TABLE IF EXISTS `episodi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `episodi` (
  `idEpisodio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idSerieTv` int(10) unsigned NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `descrizione` varchar(45) NOT NULL,
  `numeroStagione` tinyint(4) NOT NULL,
  `numeroEpisodio` tinyint(4) NOT NULL,
  `durata` tinyint(4) NOT NULL,
  `anno` smallint(6) NOT NULL,
  `idImmagine` int(10) unsigned NOT NULL,
  `idFilmato` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idEpisodio`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `episodi`
--

LOCK TABLES `episodi` WRITE;
/*!40000 ALTER TABLE `episodi` DISABLE KEYS */;
INSERT INTO `episodi` VALUES (1,1,'Laudantium et.','Qui est minus aut fugiat.',4,1,29,2020,47,4,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(2,1,'Quia tenetur ea.','Sunt dolor et quia. Facilis culpa unde ut.',2,2,48,2017,13,41,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(3,1,'Dignissimos sint.','Neque illo voluptatem dolorem.',3,3,36,2022,37,13,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(4,1,'Maxime placeat ducimus.','Aut magni animi quos dolor.',5,4,46,2018,27,27,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(5,1,'Aut ducimus magnam quasi.','Et ullam labore aperiam nobis.',3,5,34,2023,43,7,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(6,1,'Accusantium dicta recusandae esse.','Animi enim accusamus eius quia earum.',4,6,34,2023,32,40,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(7,1,'Voluptatibus et dignissimos.','Est sint et facere pariatur sit.',2,7,52,2019,25,39,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(8,1,'Ea rem ea.','At sed vero quia est est vel.',2,8,42,2024,35,15,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(9,1,'Ut et ad.','Pariatur ut magni harum quisquam magni.',2,9,56,2023,16,40,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(10,1,'Quo itaque molestiae animi.','Illum voluptas natus eos.',3,10,30,2016,40,37,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(11,2,'Sint temporibus et.','Est eveniet eum eaque eaque itaque laborum.',2,1,41,2020,86,54,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(12,2,'Sequi dolor cum ut.','Deserunt labore quod nulla incidunt.',1,2,35,2022,51,76,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(13,2,'Quod sed sit.','Nostrum natus eum rem placeat praesentium.',1,3,41,2024,92,65,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(14,2,'Consequatur et quas.','Blanditiis quos deserunt neque enim.',3,4,50,2023,76,75,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(15,2,'Omnis ut sapiente ut.','Sed rerum quae aut assumenda enim facilis.',1,5,38,2019,62,79,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(16,2,'Repellat occaecati similique.','Ullam quasi ut facilis alias.',2,6,55,2020,96,70,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(17,2,'In tempora enim.','Est ad voluptatem velit cum.',2,7,40,2019,97,74,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(18,2,'Qui consequatur occaecati.','Unde aut iste impedit repudiandae quo quia.',1,8,45,2019,58,87,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(19,2,'Ut harum quis quas.','Ratione quod eum odit repellat nulla velit.',3,9,47,2024,53,67,'2025-09-11 12:32:33','2025-09-11 12:32:33'),(20,2,'Est odit commodi explicabo.','Est omnis ea totam dicta.',3,10,53,2023,65,86,'2025-09-11 12:32:33','2025-09-11 12:32:33');
/*!40000 ALTER TABLE `episodi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-15  9:40:13
