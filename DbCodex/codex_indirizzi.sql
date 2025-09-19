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
-- Table structure for table `indirizzi`
--

DROP TABLE IF EXISTS `indirizzi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `indirizzi` (
  `idIndirizzo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idTipoIndirizzo` int(10) unsigned NOT NULL,
  `idContatto` int(10) unsigned NOT NULL,
  `idNazione` int(10) unsigned NOT NULL,
  `idComuneItaliano` int(10) unsigned DEFAULT NULL,
  `cap` varchar(10) NOT NULL,
  `indirizzo` varchar(45) NOT NULL,
  `civico` varchar(10) NOT NULL,
  `localita` varchar(45) NOT NULL,
  `altro_1` varchar(100) DEFAULT NULL,
  `altro_2` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idIndirizzo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indirizzi`
--

LOCK TABLES `indirizzi` WRITE;
/*!40000 ALTER TABLE `indirizzi` DISABLE KEYS */;
INSERT INTO `indirizzi` VALUES (1,3,1,10,NULL,'19380','Rotonda Helga 655 Appartamento 33','98','Danilo ligure',NULL,NULL,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(2,1,2,20,NULL,'17114','Rotonda Rudy 79','727','Ninfa lido',NULL,NULL,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(3,3,3,8,NULL,'97274','Piazza Maruska 323 Appartamento 87','1','Borgo Joseph nell\'emilia',NULL,NULL,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(4,3,4,19,NULL,'38582','Piazza Neri 7','37','Luce umbro',NULL,NULL,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(5,3,5,3,NULL,'09581','Incrocio Pierina 3 Appartamento 72','26','Palmieri sardo',NULL,NULL,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(6,1,6,12,NULL,'35415','Via Moreno 724','623','Caruso salentino',NULL,NULL,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(7,2,7,9,NULL,'06122','Piazza De luca 8 Piano 3','462','Settimo Roberta',NULL,NULL,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(8,1,8,14,NULL,'17207','Borgo Longo 36','203','Anselmo ligure',NULL,NULL,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(9,3,9,4,NULL,'20435','Borgo Gallo 7','6','Mazza lido',NULL,NULL,'2025-09-19 12:11:01','2025-09-19 12:11:01'),(10,3,10,20,NULL,'88713','Strada D\'amico 69 Appartamento 99','1','Bibiana lido',NULL,NULL,'2025-09-19 12:11:01','2025-09-19 12:11:01');
/*!40000 ALTER TABLE `indirizzi` ENABLE KEYS */;
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
