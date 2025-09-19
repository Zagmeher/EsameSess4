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
INSERT INTO `episodi` VALUES (1,1,'Deserunt quo reprehenderit.','Rem magnam consequatur nihil eos libero at.',5,1,29,2020,27,29,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(2,1,'Eos in cumque.','Voluptates delectus et sed sit aut minima.',3,2,48,2024,42,36,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(3,1,'Amet ut animi.','Quod quia esse tenetur at aut adipisci.',2,3,32,2025,48,36,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(4,1,'Sed veniam eveniet maxime.','Quaerat unde ut et consequatur non aut.',4,4,35,2022,14,3,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(5,1,'Sint sit eos consequatur.','Asperiores atque ea labore adipisci non.',5,5,29,2021,28,20,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(6,1,'Recusandae unde.','Deleniti reprehenderit aliquid rem.',2,6,32,2019,36,7,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(7,1,'Reiciendis rerum libero natus.','Ut enim voluptatibus sit et ea unde.',1,7,28,2025,43,24,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(8,1,'Vel placeat repellat beatae.','Aliquam aspernatur rem rerum ullam ea.',4,8,48,2017,14,25,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(9,1,'Et a modi.','Dolorem quisquam cum ut.',2,9,48,2021,25,43,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(10,1,'Sit aspernatur ea qui.','Illo alias voluptatibus occaecati veniam.',5,10,23,2023,43,23,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(11,2,'Est cumque culpa.','Hic nemo nesciunt praesentium molestiae.',2,1,45,2022,78,84,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(12,2,'Quasi accusamus nostrum eius.','Nesciunt nostrum omnis molestiae.',1,2,29,2018,86,67,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(13,2,'Corrupti in hic.','Eos possimus alias sed.',1,3,33,2022,65,58,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(14,2,'Nihil sit eius distinctio.','Ut animi officiis aut eum soluta.',1,4,52,2025,80,65,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(15,2,'Quas est eos ex.','Aut soluta alias quam distinctio ut id.',2,5,37,2018,98,61,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(16,2,'Debitis voluptate aut vel praesentium.','Et dolorum excepturi asperiores.',1,6,28,2019,98,76,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(17,2,'Aspernatur nemo et assumenda et.','Eaque voluptas sed sit quis voluptatibus.',2,7,52,2024,52,95,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(18,2,'Voluptas enim et consequatur.','Est ea eaque ut.',3,8,41,2020,97,57,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(19,2,'Totam cumque repudiandae.','Est neque dolores ullam qui sint.',2,9,38,2019,55,89,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(20,2,'Et voluptate a magni.','Est qui necessitatibus et et nesciunt.',1,10,38,2018,73,60,'2025-09-19 12:11:01','2025-09-19 12:11:01');
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

-- Dump completed on 2025-09-19 16:24:27
