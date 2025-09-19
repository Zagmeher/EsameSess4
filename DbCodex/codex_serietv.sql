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
INSERT INTO `serietv` VALUES (1,1,'Illum quo voluptatem.','Corrupti molestias itaque quia optio.',8,55,'Woody Allen','Roberto Benigni, Nicoletta Braschi',2009,0,13,15,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(2,3,'Ipsam vel voluptate.','Quas et consequatur nihil rerum assumenda.',8,66,'Christopher Nolan','Roberto Benigni, Nicoletta Braschi',1995,2010,7,3,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(3,3,'Dolorum amet repellat dolore.','Enim sint vel porro.',2,62,'Quentin Tarantino','Roberto Benigni, Nicoletta Braschi',1992,0,13,15,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(4,4,'Consectetur labore quia est.','Laudantium quia cum doloremque optio.',1,34,'Francis Ford Coppola','Tom Hanks, Meryl Streep',2016,0,3,9,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(5,5,'Id dolorem.','Qui quam rem corporis eaque.',4,93,'Francis Ford Coppola','Tom Hanks, Meryl Streep',2000,0,10,11,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(6,5,'Veniam veniam neque.','Voluptatibus et laboriosam sequi ut porro.',8,66,'Francis Ford Coppola','Tom Hanks, Meryl Streep',2010,2015,3,5,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(7,2,'Voluptate qui id eius odio.','Omnis earum sint est at voluptas ipsum.',5,3,'Woody Allen','Denzel Washington, Viola Davis',1991,1998,3,9,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(8,4,'Cumque fuga.','Unde dicta autem dolorem.',6,51,'Gabriele Muccino','Robert De Niro, Al Pacino',2014,2025,14,5,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(9,5,'Quia deserunt ipsam eos.','Dignissimos debitis in quibusdam.',1,12,'Francis Ford Coppola','Leonardo DiCaprio, Kate Winslet',2022,2022,1,13,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(10,5,'Soluta blanditiis eveniet.','Eius qui eum enim iure quae.',5,94,'Martin Scorsese','Robert De Niro, Al Pacino',2008,2016,2,12,'2025-09-19 12:11:01','2025-09-19 12:11:01');
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

-- Dump completed on 2025-09-19 16:24:27
