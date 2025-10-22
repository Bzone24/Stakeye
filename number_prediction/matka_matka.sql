-- MariaDB dump 10.19  Distrib 10.9.7-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: admin_satta
-- ------------------------------------------------------
-- Server version	10.9.7-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `BET_TRANSACTIONS`
--

DROP TABLE IF EXISTS `BET_TRANSACTIONS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BET_TRANSACTIONS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` varchar(255) DEFAULT NULL,
  `DATE_TIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `AMOUNT` int(10) DEFAULT NULL,
  `GAME_ID` int(10) DEFAULT NULL,
  `GAME` varchar(100) DEFAULT NULL,
  `NUMBER` varchar(100) DEFAULT NULL,
  `STATUS` varchar(100) DEFAULT NULL,
  `RESULT` varchar(100) DEFAULT NULL,
  `RAND` varchar(200) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `TYPE` varchar(100) DEFAULT NULL,
  `WIN_AMOUNT` int(10) DEFAULT NULL,
  `NUMBER1` int(10) DEFAULT NULL,
  `TIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BET_TRANSACTIONS`
--

LOCK TABLES `BET_TRANSACTIONS` WRITE;
/*!40000 ALTER TABLE `BET_TRANSACTIONS` DISABLE KEYS */;
INSERT INTO `BET_TRANSACTIONS` VALUES
(1,'1','2024-07-27 11:21:04',10,3,'JODI','00','CHECKED','PASS','868813487','2024-07-27','Jodi',90,NULL,NULL),
(2,'1','2024-07-27 11:21:04',10,3,'JODI','15','CHECKED','FAIL','868813487','2024-07-27','Jodi',NULL,NULL,NULL),
(3,'1','2024-07-27 11:21:04',10,3,'andar','1','CHECKED','FAIL','1748987790','2024-07-27','Andar',NULL,NULL,NULL),
(4,'1','2024-07-27 11:21:04',10,3,'andar','2','CHECKED','FAIL','1748987790','2024-07-27','Andar',NULL,NULL,NULL),
(5,'1','2024-07-27 11:21:47',10,9,'bahar','1','CHECKED','FAIL','313970820','2024-07-27','Bahar',NULL,NULL,NULL),
(6,'1','2024-07-27 11:21:47',10,9,'bahar','4','CHECKED','FAIL','313970820','2024-07-27','Bahar',NULL,NULL,NULL);
/*!40000 ALTER TABLE `BET_TRANSACTIONS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FREE_GAME`
--

DROP TABLE IF EXISTS `FREE_GAME`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FREE_GAME` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GAME_ID` varchar(255) DEFAULT NULL,
  `WHICH_ONE` varchar(255) DEFAULT NULL,
  `FIRST` varchar(255) DEFAULT NULL,
  `SECOND` varchar(255) DEFAULT NULL,
  `THIRD` varchar(255) DEFAULT NULL,
  `FORTH` varchar(255) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `FIFTH` varchar(255) DEFAULT NULL,
  `SIXTH` varchar(255) DEFAULT NULL,
  `SEVEN` varchar(255) DEFAULT NULL,
  `EIGHT` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FREE_GAME`
--

LOCK TABLES `FREE_GAME` WRITE;
/*!40000 ALTER TABLE `FREE_GAME` DISABLE KEYS */;
INSERT INTO `FREE_GAME` VALUES
(1,'1','OPEN','0','1','2','3','2024-07-27',NULL,NULL,NULL,NULL),
(2,'1','JODI','11','22','33','44','2024-07-27','','','',''),
(3,'1','PATTI','3','6','4','5','2024-07-27',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `FREE_GAME` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GAMES`
--

DROP TABLE IF EXISTS `GAMES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GAMES` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(255) DEFAULT NULL,
  `TIME1` time DEFAULT NULL,
  `TIME2` time DEFAULT NULL,
  `PAGE` varchar(255) DEFAULT NULL,
  `GUESS` varchar(255) DEFAULT NULL,
  `HIGHLIGHT` varchar(255) DEFAULT NULL,
  `PANEL_RESULT` longtext DEFAULT NULL,
  `JODI_RESULT` longtext DEFAULT NULL,
  `DAYS` int(10) DEFAULT NULL,
  `REMARK2` varchar(255) DEFAULT NULL,
  `HOLIDAY` varchar(10) DEFAULT NULL,
  `INACTIVE` varchar(100) DEFAULT NULL,
  `AUTO_GUESS` varchar(200) DEFAULT NULL,
  `COLOR` varchar(255) DEFAULT NULL,
  `PLAY` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GAMES`
--

LOCK TABLES `GAMES` WRITE;
/*!40000 ALTER TABLE `GAMES` DISABLE KEYS */;
INSERT INTO `GAMES` VALUES
(1,'DESAWAR','05:00:00','00:00:00','desawar','','','','',7,NULL,NULL,NULL,'','','checked'),
(2,'NEW PUNJAB','11:00:00','00:00:00','newpunjab','','','','',7,NULL,'',NULL,'','','checked'),
(3,'FARIDABAD','18:00:00','00:00:00','faridabad','','','','',7,NULL,'',NULL,'','','checked'),
(4,'GHAZIABAD','21:00:00','00:00:00','ghaziabad','','','','',7,NULL,NULL,NULL,'','','checked'),
(5,'GALI','23:30:00','00:00:00','gali','','','','',7,NULL,NULL,NULL,'','','checked'),
(6,'DUBAI BAZAAR','14:15:00','00:00:00','dubaibazaar','','','','',7,NULL,NULL,NULL,'','','checked'),
(7,'MOHALI','15:00:00','00:00:00','mohali','','','','',7,NULL,NULL,NULL,'','','checked'),
(8,'DELHI BAZAR','15:00:00','00:00:00','delhibazar','','','','',7,NULL,NULL,NULL,'','','checked'),
(9,'AGRA CITY','19:20:00','00:00:00','agracity','','','','',7,NULL,'',NULL,'','','checked'),
(10,'NEW GHAZIABAD','21:25:00','00:00:00','newghaziabad','','','','',7,NULL,NULL,NULL,'','','checked'),
(11,'SANGRUR','22:10:00','00:00:00','sangrur','','','','',7,NULL,NULL,NULL,'','','checked'),
(12,'SHRI LAXMI','19:30:00','00:00:00','shrilaxmi','','','','',7,NULL,NULL,NULL,'','','checked');
/*!40000 ALTER TABLE `GAMES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OPEN_CLOSE_PATTI`
--

DROP TABLE IF EXISTS `OPEN_CLOSE_PATTI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OPEN_CLOSE_PATTI` (
  `OPEN_CLOSE_PATTI` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OPEN_CLOSE_PATTI`
--

LOCK TABLES `OPEN_CLOSE_PATTI` WRITE;
/*!40000 ALTER TABLE `OPEN_CLOSE_PATTI` DISABLE KEYS */;
INSERT INTO `OPEN_CLOSE_PATTI` VALUES
('00'),
('01'),
('02'),
('03'),
('04'),
('05'),
('06'),
('07'),
('08'),
('09'),
('10'),
('11'),
('12'),
('13'),
('14'),
('15'),
('16'),
('17'),
('18'),
('19'),
('20'),
('21'),
('22'),
('23'),
('24'),
('25'),
('26'),
('27'),
('28'),
('29'),
('30'),
('31'),
('32'),
('33'),
('34'),
('35'),
('36'),
('37'),
('38'),
('39'),
('40'),
('41'),
('42'),
('43'),
('44'),
('45'),
('46'),
('47'),
('48'),
('49'),
('50'),
('51'),
('52'),
('53'),
('54'),
('55'),
('56'),
('57'),
('58'),
('59'),
('60'),
('61'),
('62'),
('63'),
('64'),
('65'),
('66'),
('67'),
('68'),
('69'),
('70'),
('71'),
('72'),
('73'),
('74'),
('75'),
('76'),
('77'),
('78'),
('79'),
('80'),
('81'),
('82'),
('83'),
('84'),
('85'),
('86'),
('87'),
('88'),
('89'),
('90'),
('91'),
('92'),
('93'),
('94'),
('95'),
('96'),
('97'),
('98'),
('99');
/*!40000 ALTER TABLE `OPEN_CLOSE_PATTI` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PAYMENTS`
--

DROP TABLE IF EXISTS `PAYMENTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PAYMENTS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(255) DEFAULT NULL,
  `MODE` varchar(255) DEFAULT NULL,
  `DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `AMOUNT` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PAYMENTS`
--

LOCK TABLES `PAYMENTS` WRITE;
/*!40000 ALTER TABLE `PAYMENTS` DISABLE KEYS */;
INSERT INTO `PAYMENTS` VALUES
(1,'TXXt UXXr','','2024-07-27 11:26:58','100');
/*!40000 ALTER TABLE `PAYMENTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PAYMENT_QUEUE`
--

DROP TABLE IF EXISTS `PAYMENT_QUEUE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PAYMENT_QUEUE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(10) DEFAULT NULL,
  `AMOUNT` varchar(100) DEFAULT NULL,
  `TIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `IMAGE` varchar(100) DEFAULT NULL,
  `MODE` varchar(100) DEFAULT NULL,
  `STATUS` varchar(100) DEFAULT NULL,
  `TXN_ID` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PAYMENT_QUEUE`
--

LOCK TABLES `PAYMENT_QUEUE` WRITE;
/*!40000 ALTER TABLE `PAYMENT_QUEUE` DISABLE KEYS */;
INSERT INTO `PAYMENT_QUEUE` VALUES
(1,1,'100','2024-07-27 11:26:58','1_153745354.jpg','','COMPLETED',NULL);
/*!40000 ALTER TABLE `PAYMENT_QUEUE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RESULT`
--

DROP TABLE IF EXISTS `RESULT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RESULT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GAME_ID` varchar(255) DEFAULT NULL,
  `RESULT1` varchar(255) DEFAULT NULL,
  `RESULT2` varchar(255) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `REMARK` varchar(255) DEFAULT NULL,
  `REMARK2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RESULT`
--

LOCK TABLES `RESULT` WRITE;
/*!40000 ALTER TABLE `RESULT` DISABLE KEYS */;
INSERT INTO `RESULT` VALUES
(1,'3','00','0','2024-07-27','',NULL),
(2,'9','09','0','2024-07-27','',NULL);
/*!40000 ALTER TABLE `RESULT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SETTINGS`
--

DROP TABLE IF EXISTS `SETTINGS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SETTINGS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MOBILE` varchar(255) DEFAULT NULL,
  `SINGLE` varchar(255) DEFAULT NULL,
  `JODI` varchar(255) DEFAULT NULL,
  `SINGLE_PATTI` varchar(255) DEFAULT NULL,
  `DOUBLE_PATTI` varchar(255) DEFAULT NULL,
  `TRIPPLE_PATTI` varchar(255) DEFAULT NULL,
  `HALF_SANGAM` varchar(255) DEFAULT NULL,
  `FULL_SANGAM` varchar(255) DEFAULT NULL,
  `GPAY` varchar(100) DEFAULT NULL,
  `PAYTM` varchar(100) DEFAULT NULL,
  `PHONEPAY` varchar(100) DEFAULT NULL,
  `STARLINE` varchar(100) DEFAULT NULL,
  `STARLINE_SINGLE` varchar(100) DEFAULT NULL,
  `STARLINE_DOUBLE` varchar(100) DEFAULT NULL,
  `USERNAME` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `STARLINE_GAME` varchar(100) DEFAULT NULL,
  `APP_NAME` varchar(100) DEFAULT NULL,
  `GUESS` varchar(100) DEFAULT NULL,
  `GATEWAY` varchar(100) DEFAULT NULL,
  `GATEWAY_KEY` varchar(100) DEFAULT NULL,
  `RECHARGE` int(10) DEFAULT NULL,
  `WITHDRAW` int(10) DEFAULT NULL,
  `BONUS` int(10) DEFAULT NULL,
  `REFER` int(10) DEFAULT NULL,
  `OTP` varchar(100) DEFAULT NULL,
  `OTP_KEY` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SETTINGS`
--

LOCK TABLES `SETTINGS` WRITE;
/*!40000 ALTER TABLE `SETTINGS` DISABLE KEYS */;
INSERT INTO `SETTINGS` VALUES
(1,'9876543210','9','90','','','','','','demo@upi','','','','','','admin','$2y$12$fwN.wHkFaFBZcD9cjWv5Uuzx/JvNkx7E9KfTCnuLlxjyLdpGOZ36.','','','YES','MANUAL','123',100,120,20,10,'DVGROUP','123');
/*!40000 ALTER TABLE `SETTINGS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TRANSACTIONS`
--

DROP TABLE IF EXISTS `TRANSACTIONS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TRANSACTIONS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` varchar(255) DEFAULT NULL,
  `DATE_TIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `AMOUNT` int(10) DEFAULT NULL,
  `GAME_ID` int(10) DEFAULT NULL,
  `GAME` varchar(100) DEFAULT NULL,
  `BET_ID` int(10) DEFAULT NULL,
  `BALANCE` decimal(10,2) DEFAULT NULL,
  `REMARK` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TRANSACTIONS`
--

LOCK TABLES `TRANSACTIONS` WRITE;
/*!40000 ALTER TABLE `TRANSACTIONS` DISABLE KEYS */;
INSERT INTO `TRANSACTIONS` VALUES
(1,'1','2024-07-27 11:11:23',10,3,'JODI',1,1393.00,NULL),
(2,'1','2024-07-27 11:11:23',10,3,'JODI',2,1383.00,NULL),
(3,'1','2024-07-27 11:14:56',10,3,'andar',3,1373.00,NULL),
(4,'1','2024-07-27 11:14:56',10,3,'andar',4,1363.00,NULL),
(5,'1','2024-07-27 11:15:07',10,9,'bahar',5,1353.00,NULL),
(6,'1','2024-07-27 11:15:08',10,9,'bahar',6,1343.00,NULL),
(7,'1','2024-07-27 11:21:04',90,NULL,NULL,1,1433.00,'Game Win'),
(8,'1','2024-07-27 11:26:58',100,NULL,NULL,NULL,1533.00,'Added');
/*!40000 ALTER TABLE `TRANSACTIONS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `USERS`
--

DROP TABLE IF EXISTS `USERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USERS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `MOBILE` varchar(255) DEFAULT NULL,
  `WALLET` decimal(10,2) DEFAULT NULL,
  `PASSWORD` varchar(250) DEFAULT NULL,
  `GOOGLE_ID` varchar(250) DEFAULT NULL,
  `IMAGE` varchar(250) DEFAULT NULL,
  `REFER_BY` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USERS`
--

LOCK TABLES `USERS` WRITE;
/*!40000 ALTER TABLE `USERS` DISABLE KEYS */;
INSERT INTO `USERS` VALUES
(1,'Test User','test@gmail.com','9876543210',1533.00,'$2y$12$UoUU3AG.SgjTd2VhatcMzu6IOdh44Jh8K6Jo.bS/gCEUUiwgwHwgm',NULL,NULL,NULL);
/*!40000 ALTER TABLE `USERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `WINNERS`
--

DROP TABLE IF EXISTS `WINNERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WINNERS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(255) DEFAULT NULL,
  `GAME` varchar(255) DEFAULT NULL,
  `TIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `AMOUNT` varchar(255) DEFAULT NULL,
  `WIN_AMOUNT` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WINNERS`
--

LOCK TABLES `WINNERS` WRITE;
/*!40000 ALTER TABLE `WINNERS` DISABLE KEYS */;
INSERT INTO `WINNERS` VALUES
(1,'TXXt XXXr','FARIDABAD','2024-07-27 11:21:04','10','90');
/*!40000 ALTER TABLE `WINNERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `WITHDRAW`
--

DROP TABLE IF EXISTS `WITHDRAW`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WITHDRAW` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` varchar(255) DEFAULT NULL,
  `UPI` varchar(255) DEFAULT NULL,
  `AMOUNT` varchar(255) DEFAULT NULL,
  `TIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `STATUS` varchar(100) DEFAULT NULL,
  `BANK` varchar(255) DEFAULT NULL,
  `IFSC` varchar(255) DEFAULT NULL,
  `ACCOUNT` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WITHDRAW`
--

LOCK TABLES `WITHDRAW` WRITE;
/*!40000 ALTER TABLE `WITHDRAW` DISABLE KEYS */;
/*!40000 ALTER TABLE `WITHDRAW` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `FORGOT`;
CREATE TABLE FORGOT(
    ID int NOT NULL AUTO_INCREMENT,
    MOBILE varchar(255) NOT NULL,
    OTP varchar(255),
    STATUS varchar(255),
	DATE datetime,
    PRIMARY KEY (ID)
);

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-27 17:26:26
