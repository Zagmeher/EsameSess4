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
INSERT INTO `contatti` VALUES (1,1,1,'prova','Montanari',1,'FRMUQ0VN9VEY3XLJ','37975335195','Italiana',1,'Emanuel laziale','BA','1979-09-30','2025-09-11 12:31:35','2025-09-14 15:50:57'),(2,2,3,'Valentina','Barone',1,'COMPY0FWALYTWIWQ','65458151365','Italiana',1,'Settimo Filomena','NA','1972-03-13','2025-09-11 12:31:35','2025-09-14 14:06:37'),(3,2,1,'Ruth','Bianchi',1,'3MSJRGRF8TNLI8XK','68661683468','Italiana',1,'Borgo Kayla','BA','1978-03-15','2025-09-11 12:31:35','2025-09-11 12:31:35'),(4,3,2,'Jack','Giordano',0,'PGYAXEMZYTUKUTLD','26117703583','Italiana',1,'Giordano umbro','RM','1976-07-24','2025-09-11 12:31:35','2025-09-11 12:31:35'),(5,1,1,'Kayla','Marchetti',1,'Q5MJISAJEUM5AY6R','50808720840','Italiana',1,'Maurizio sardo','TO','2003-09-15','2025-09-11 12:31:35','2025-09-11 12:31:35'),(6,3,3,'Evita','Ferretti',1,'SZPWLOO9SLS76LQJ','88155685491','Italiana',1,'San Giuseppe','FI','1997-01-20','2025-09-11 12:31:35','2025-09-11 12:31:35'),(7,3,1,'Gabriella','Bianchi',1,'MPYAF1IUMEARIP8B','27821210961','Italiana',1,'Sesto Marcello veneto','VE','1976-10-02','2025-09-11 12:31:35','2025-09-11 12:31:35'),(8,4,3,'Ninfa','Gatti',1,'YLQVOCMQZQPDGQTS','43310838984','Italiana',1,'Settimo Raffaella','RM','1986-10-29','2025-09-11 12:31:35','2025-09-11 12:31:35'),(9,2,2,'Abramo','Marchetti',0,'O1Q8GX26AKKY3R9L','44764999050','Italiana',1,'Guerra calabro','FI','1978-05-11','2025-09-11 12:31:35','2025-09-11 12:31:35'),(10,3,2,'Giobbe','Gatti',0,'8KZB2HJNTAY13RRC','37241241920','Italiana',1,'Barbieri del friuli','FI','1986-10-22','2025-09-11 12:31:35','2025-09-11 12:31:35'),(11,1,1,'Admin','Sistema',1,'DMNSTN80A01H501X','','Italiana',1,'Roma','RM','1980-01-01','2025-09-14 13:41:51','2025-09-14 13:41:51'),(12,2,1,'Utente','Normale',2,'RSSMRA85B01H501Y','','Italiana',1,'Milano','MI','1985-02-01','2025-09-14 13:41:51','2025-09-14 13:41:51');
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

-- Dump completed on 2025-09-15  9:40:13
