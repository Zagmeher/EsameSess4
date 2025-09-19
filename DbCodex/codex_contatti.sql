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
-- Table structure for table `contatti`
--

DROP TABLE IF EXISTS `contatti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contatti` (
  `idContatto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idGruppo` int(10) unsigned NOT NULL,
  `idStato` int(10) unsigned NOT NULL,
  `nome` varchar(45) NOT NULL,
  `cognome` varchar(45) NOT NULL,
  `sesso` tinyint(4) NOT NULL,
  `codiceFiscale` varchar(45) NOT NULL,
  `partitaIva` varchar(45) NOT NULL,
  `cittadinanza` varchar(45) NOT NULL,
  `idNazioneNascita` tinyint(4) NOT NULL,
  `cittaNascita` varchar(45) NOT NULL,
  `provinciaNascita` varchar(45) NOT NULL,
  `dataNascita` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idContatto`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contatti`
--

LOCK TABLES `contatti` WRITE;
/*!40000 ALTER TABLE `contatti` DISABLE KEYS */;
INSERT INTO `contatti` VALUES (1,3,3,'Francesca','Basile',1,'JS60QG5PZWLMAN04','67270487218','Italiana',1,'Valentini ligure','BA','1982-02-08','2025-09-19 12:10:59','2025-09-19 12:10:59'),(2,3,3,'Ortensia','Benedetti',1,'SH7J0ESKYVE16BTX','97152716757','Italiana',1,'San Clea','BO','1996-10-26','2025-09-19 12:10:59','2025-09-19 12:10:59'),(3,4,2,'Gabriella','Rossetti',1,'OCGBDTS6W2XKNZ5S','52408726540','Italiana',1,'Greco terme','FI','1981-09-04','2025-09-19 12:10:59','2025-09-19 12:10:59'),(4,3,1,'Marcello','Riva',0,'8Z9HMZVFDINFF1P0','86612831874','Italiana',1,'San Sabino lido','FI','2002-03-07','2025-09-19 12:10:59','2025-09-19 12:10:59'),(5,1,3,'Radames','Messina',0,'HRHNYVL47FQUKCC9','92393804208','Italiana',1,'Brigitta salentino','MI','2002-11-30','2025-09-19 12:10:59','2025-09-19 12:10:59'),(6,2,2,'Costanzo','Ricci',0,'EV56QFQUVX8G7XUC','36563930075','Italiana',1,'Orlando del friuli','RM','1992-11-17','2025-09-19 12:10:59','2025-09-19 12:10:59'),(7,3,1,'Paolo','Fontana',0,'CWNARPQJCKX4SUGY','59771950453','Italiana',1,'Borgo Marieva ligure','RM','2001-02-28','2025-09-19 12:10:59','2025-09-19 12:10:59'),(8,5,3,'Domenico','Orlando',0,'IJSZLXOOQE2EMCHC','60270473328','Italiana',1,'Sesto Michelle','PA','2004-03-12','2025-09-19 12:10:59','2025-09-19 12:10:59'),(9,2,2,'Fatima','Villa',1,'GL5YCLZT0Y44FY6Y','57361670848','Italiana',1,'Sandra calabro','TO','2004-10-16','2025-09-19 12:10:59','2025-09-19 12:10:59'),(10,2,3,'Cesidia','Testa',1,'VDQFZXVACFJL6VHY','22346452631','Italiana',1,'Sesto Graziella calabro','MI','1992-05-23','2025-09-19 12:10:59','2025-09-19 12:10:59'),(11,1,1,'Admin','Sistema',1,'DMNSTN80A01H501X','','Italiana',1,'Roma','RM','1980-01-01','2025-09-19 12:10:59','2025-09-19 12:10:59'),(12,2,1,'Utente','Normale',2,'RSSMRA85B01H501Y','','Italiana',1,'Milano','MI','1985-02-01','2025-09-19 12:10:59','2025-09-19 12:10:59');
/*!40000 ALTER TABLE `contatti` ENABLE KEYS */;
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
