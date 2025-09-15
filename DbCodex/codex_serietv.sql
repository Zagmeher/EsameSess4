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
-- Table structure for table `serietv`
--

DROP TABLE IF EXISTS `serietv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `serietv` (
  `idSerieTv` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idCategoria` tinyint(4) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descrizione` varchar(45) NOT NULL,
  `totaleStaioni` tinyint(4) NOT NULL,
  `numeroEpisodio` tinyint(4) NOT NULL,
  `regista` varchar(45) NOT NULL,
  `attori` varchar(45) NOT NULL,
  `annoInizio` smallint(6) NOT NULL,
  `annoFine` smallint(6) NOT NULL,
  `idImmagine` int(10) unsigned NOT NULL,
  `idFilmato` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idSerieTv`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serietv`
--

LOCK TABLES `serietv` WRITE;
/*!40000 ALTER TABLE `serietv` DISABLE KEYS */;
INSERT INTO `serietv` VALUES (1,4,'Et non omnis.','Illum accusamus deleniti nesciunt magni.',8,88,'Martin Scorsese','Denzel Washington, Viola Davis',1991,2017,16,12,'2025-09-11 12:32:18','2025-09-11 12:32:18'),(2,3,'Et nihil quo.','Et voluptatem sit est ex ducimus quisquam.',4,68,'Federico Fellini','Leonardo DiCaprio, Kate Winslet',1996,2007,2,3,'2025-09-11 12:32:18','2025-09-11 12:32:18'),(3,4,'Perferendis sed.','Facilis sint rerum est quaerat omnis enim.',3,45,'Federico Fellini','Denzel Washington, Viola Davis',2017,0,14,4,'2025-09-11 12:32:18','2025-09-11 12:32:18'),(4,3,'Ut tempora placeat quia.','Nihil quis beatae eum ad.',1,99,'Martin Scorsese','Robert De Niro, Al Pacino',1996,2024,18,15,'2025-09-11 12:32:18','2025-09-11 12:32:18'),(5,1,'Molestiae unde odit autem.','Ut ea asperiores illum.',4,55,'Francis Ford Coppola','Tom Hanks, Meryl Streep',1993,0,16,8,'2025-09-11 12:32:18','2025-09-11 12:32:18'),(6,5,'Quo maxime quaerat.','Odit tempora soluta sit quis.',8,61,'Quentin Tarantino','Denzel Washington, Viola Davis',2016,2025,1,3,'2025-09-11 12:32:18','2025-09-11 12:32:18'),(7,3,'Suscipit doloremque eaque.','Ea ab voluptatem eius commodi quo enim.',1,92,'Francis Ford Coppola','Julia Roberts, Richard Gere',1992,2009,5,2,'2025-09-11 12:32:18','2025-09-11 12:32:18'),(8,5,'Temporibus reprehenderit excepturi.','Minima id qui nihil molestiae quidem.',10,93,'Spike Lee','Robert De Niro, Al Pacino',2003,0,3,2,'2025-09-11 12:32:18','2025-09-11 12:32:18'),(9,3,'Voluptas nemo praesentium nulla.','Dolor dolor voluptatum repellat id quia.',8,15,'Martin Scorsese','Jennifer Lawrence, Bradley Cooper',1996,2008,1,1,'2025-09-11 12:32:18','2025-09-11 12:32:18'),(10,1,'Voluptatem qui dignissimos.','Et dolorem unde non.',7,52,'Federico Fellini','Tom Hanks, Meryl Streep',2016,0,17,7,'2025-09-11 12:32:18','2025-09-11 12:32:18');
/*!40000 ALTER TABLE `serietv` ENABLE KEYS */;
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
