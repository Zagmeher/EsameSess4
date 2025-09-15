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
INSERT INTO `indirizzi` VALUES (1,3,1,3,NULL,'50739','Contrada Riva 157','995','Settimo Sergio del friuli','prova',NULL,'2025-09-11 12:31:37','2025-09-14 15:53:09'),(2,3,2,2,NULL,'64044','Borgo Gallo 8 Appartamento 14','174','Battaglia sardo',NULL,NULL,'2025-09-11 12:31:37','2025-09-11 12:31:37'),(3,1,3,10,NULL,'32629','Piazza Patrizia 855 Piano 1','7','Sesto Mirko',NULL,NULL,'2025-09-11 12:31:37','2025-09-11 12:31:37'),(4,2,4,9,NULL,'63038','Incrocio Monti 15','7','Isira umbro',NULL,NULL,'2025-09-11 12:31:37','2025-09-11 12:31:37'),(5,3,5,14,NULL,'53062','Contrada Giacinto 13 Piano 1','94','Gatti laziale',NULL,NULL,'2025-09-11 12:31:37','2025-09-11 12:31:37'),(6,1,6,15,NULL,'69506','Piazza Joseph 31','130','Borgo Jole',NULL,NULL,'2025-09-11 12:31:37','2025-09-11 12:31:37'),(7,2,7,6,NULL,'81231','Borgo Silvestri 642 Appartamento 76','596','Lombardo ligure',NULL,NULL,'2025-09-11 12:31:37','2025-09-11 12:31:37'),(8,2,8,10,NULL,'27110','Contrada Cristina 4 Appartamento 33','878','Sesto Caio',NULL,NULL,'2025-09-11 12:31:37','2025-09-11 12:31:37'),(9,1,9,4,NULL,'60723','Contrada Fabbri 34','2','Sesto Rosanna',NULL,NULL,'2025-09-11 12:31:37','2025-09-11 12:31:37'),(10,2,10,20,NULL,'53906','Piazza Donatella 231','914','Ricci umbro',NULL,NULL,'2025-09-11 12:31:37','2025-09-11 12:31:37');
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

-- Dump completed on 2025-09-15  9:40:12
