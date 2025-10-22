-- MariaDB dump 10.19  Distrib 10.9.7-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: admin_matka
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BET_TRANSACTIONS`
--

LOCK TABLES `BET_TRANSACTIONS` WRITE;
/*!40000 ALTER TABLE `BET_TRANSACTIONS` DISABLE KEYS */;
INSERT INTO `BET_TRANSACTIONS` VALUES
(1,'1','2024-02-05 13:04:28',10,5,'open','1','CHECKED','PASS','749580803','2024-02-05','Single',100,NULL,NULL),
(2,'1','2024-07-08 13:42:41',100,5,'close','444','','','555957701','2024-07-08','Tripple Patti',NULL,NULL,NULL),
(3,'1','2024-07-08 13:43:19',200,5,'close','122','','','264558851','2024-07-08','Double Patti',NULL,NULL,NULL),
(4,'1','2024-07-08 19:06:27',10,1,'close','0','','','1480825866','2024-07-10','Single',NULL,NULL,NULL),
(5,'1','2024-07-08 19:06:27',10,1,'close','1','','','1480825866','2024-07-10','Single',NULL,NULL,NULL),
(6,'1','2024-07-09 15:43:44',50,8,'open','7','','','857678185','2024-07-10','Single',NULL,NULL,NULL),
(7,'1','2024-07-09 15:47:41',50,6,'close','128','','','823387570','2024-07-09','Single Patti',NULL,NULL,NULL),
(8,'1','2024-07-11 11:33:35',14,4,'close','137','','','1012989494','2024-07-11','Single Patti',NULL,NULL,NULL),
(9,'1','2024-07-11 11:34:30',13,6,'JODI','05','','','172419444','2024-07-11','Jodi',NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FREE_GAME`
--

LOCK TABLES `FREE_GAME` WRITE;
/*!40000 ALTER TABLE `FREE_GAME` DISABLE KEYS */;
INSERT INTO `FREE_GAME` VALUES
(1,'1','OPEN','111','222','333','444','2024-02-05',NULL,NULL,NULL,NULL),
(2,'1','JODI','11','22','33','44','2024-02-05','55','66','77','88'),
(3,'1','PATTI','123','234','345','456','2024-02-05',NULL,NULL,NULL,NULL),
(4,'2','OPEN','112','222','333','444','2024-02-05',NULL,NULL,NULL,NULL),
(5,'2','JODI','11','22','33','44','2024-02-05','55','66','77','88'),
(6,'2','PATTI','123','234','345','456','2024-02-05',NULL,NULL,NULL,NULL),
(7,'3','OPEN','111','222','333','444','2024-02-05',NULL,NULL,NULL,NULL),
(8,'3','JODI','3','6','9','2','2024-02-05','','','',''),
(9,'3','PATTI','999','888','777','666','2024-02-05',NULL,NULL,NULL,NULL),
(10,'4','OPEN','123','456','789','567','2024-02-05',NULL,NULL,NULL,NULL),
(11,'4','JODI','00','11','77','88','2024-02-05','','','',''),
(12,'4','PATTI','768','456','890','468','2024-02-05',NULL,NULL,NULL,NULL),
(13,'5','OPEN','389','479','356','289','2024-02-05',NULL,NULL,NULL,NULL),
(14,'5','JODI','00','11','22','77','2024-02-05','','','',''),
(15,'5','PATTI','479','790','357','689','2024-02-05',NULL,NULL,NULL,NULL),
(16,'6','OPEN','689','356','378','579','2024-02-05',NULL,NULL,NULL,NULL),
(17,'6','JODI','87','54','99','33','2024-02-05','','','',''),
(18,'6','PATTI','235','468','470','567','2024-02-05',NULL,NULL,NULL,NULL),
(19,'7','OPEN','111','666','888','999','2024-02-05',NULL,NULL,NULL,NULL),
(20,'7','JODI','67','88','99','55','2024-02-05','','','',''),
(21,'7','PATTI','567','990','467','110','2024-02-05',NULL,NULL,NULL,NULL),
(22,'8','OPEN','678','880','440','220','2024-02-05',NULL,NULL,NULL,NULL),
(23,'8','JODI','11','56','77','08','2024-02-05','','','',''),
(24,'8','PATTI','111','566','889','880','2024-02-05',NULL,NULL,NULL,NULL),
(25,'9','OPEN','178','456','200','222','2024-02-05',NULL,NULL,NULL,NULL),
(26,'9','JODI','20','78','90','76','2024-02-05','','','',''),
(27,'9','PATTI','799','778','445','770','2024-02-05',NULL,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GAMES`
--

LOCK TABLES `GAMES` WRITE;
/*!40000 ALTER TABLE `GAMES` DISABLE KEYS */;
INSERT INTO `GAMES` VALUES
(1,'MILAN MORNING','10:15:00','11:15:00','milanmorning','','','','',7,NULL,NULL,NULL,'','','checked'),
(2,'SRIDEVI','11:35:00','12:35:00','sridevi','','','','',7,NULL,NULL,NULL,'','','checked'),
(3,'MAIN BAJAR DAY','15:00:00','17:00:00','mainbajarday','','','','',7,NULL,NULL,NULL,'','','checked'),
(4,'KALYAN','16:00:00','18:00:00','kalyan','','','','',7,NULL,NULL,NULL,'','','checked'),
(5,'SRIDEVI NIGHT','19:00:00','20:00:00','sridevinight','','','','',7,NULL,NULL,NULL,'','','checked'),
(6,'MILAN NIGHT','21:00:00','23:00:00','milannight','','','','',7,NULL,NULL,NULL,'','','checked'),
(7,'MAIN BAZAR','21:40:00','23:45:00','mainbazar','','','','',7,NULL,NULL,NULL,'','','checked'),
(8,'TIME BAZAR','13:00:00','14:00:00','timebazar','','','','',7,NULL,NULL,NULL,'','','checked'),
(9,'TIME BAZAR','13:00:00','14:00:00','timebazar','','','','',7,NULL,NULL,NULL,'','','checked');
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
('100'),
('119'),
('155'),
('227'),
('335'),
('344'),
('399'),
('588'),
('669'),
('200'),
('110'),
('228'),
('255'),
('336'),
('499'),
('660'),
('688'),
('778'),
('300'),
('166'),
('229'),
('337'),
('355'),
('445'),
('599'),
('779'),
('788'),
('400'),
('112'),
('220'),
('266'),
('338'),
('446'),
('455'),
('699'),
('770'),
('500'),
('113'),
('122'),
('177'),
('339'),
('366'),
('447'),
('799'),
('889'),
('600'),
('114'),
('277'),
('330'),
('448'),
('466'),
('556'),
('880'),
('899'),
('700'),
('115'),
('133'),
('188'),
('223'),
('377'),
('449'),
('557'),
('566'),
('800'),
('116'),
('224'),
('233'),
('288'),
('440'),
('477'),
('558'),
('990'),
('900'),
('117'),
('144'),
('199'),
('225'),
('388'),
('559'),
('577'),
('667'),
('550'),
('668'),
('244'),
('299'),
('226'),
('488'),
('677'),
('118'),
('334'),
('128'),
('137'),
('146'),
('236'),
('245'),
('290'),
('380'),
('470'),
('489'),
('560'),
('678'),
('579'),
('129'),
('138'),
('147'),
('156'),
('237'),
('246'),
('345'),
('390'),
('480'),
('570'),
('679'),
('120'),
('139'),
('148'),
('157'),
('238'),
('247'),
('256'),
('346'),
('490'),
('580'),
('670'),
('689'),
('130'),
('149'),
('158'),
('167'),
('239'),
('248'),
('257'),
('347'),
('356'),
('590'),
('680'),
('789'),
('140'),
('159'),
('168'),
('230'),
('249'),
('258'),
('267'),
('348'),
('357'),
('456'),
('690'),
('780'),
('123'),
('150'),
('169'),
('178'),
('240'),
('259'),
('268'),
('349'),
('358'),
('457'),
('367'),
('790'),
('124'),
('160'),
('179'),
('250'),
('269'),
('278'),
('340'),
('359'),
('368'),
('458'),
('467'),
('890'),
('125'),
('134'),
('170'),
('189'),
('260'),
('279'),
('350'),
('369'),
('378'),
('459'),
('567'),
('468'),
('126'),
('135'),
('180'),
('234'),
('270'),
('289'),
('360'),
('379'),
('450'),
('469'),
('478'),
('568'),
('127'),
('136'),
('145'),
('190'),
('235'),
('280'),
('370'),
('479'),
('460'),
('569'),
('389'),
('578'),
('589'),
('000'),
('111'),
('222'),
('333'),
('444'),
('555'),
('666'),
('777'),
('888'),
('999');
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
(1,'TXXt UXXr','ONLINE','2024-07-11 14:27:31','100');
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PAYMENT_QUEUE`
--

LOCK TABLES `PAYMENT_QUEUE` WRITE;
/*!40000 ALTER TABLE `PAYMENT_QUEUE` DISABLE KEYS */;
INSERT INTO `PAYMENT_QUEUE` VALUES
(1,1,'1','2024-07-07 14:32:09','1616930352','ONLINE',NULL,NULL),
(2,1,'1','2024-07-07 14:33:01','1757722510','ONLINE',NULL,NULL),
(3,1,'1','2024-07-07 14:56:17','549720625','ONLINE',NULL,NULL),
(4,1,'1','2024-07-07 15:05:06','1002364619','ONLINE',NULL,NULL),
(5,1,'1','2024-07-07 15:06:16','475956557','ONLINE',NULL,NULL),
(6,1,'1','2024-07-07 15:06:46','239109240','ONLINE',NULL,NULL),
(7,1,'10','2024-07-07 15:07:16','539366416','ONLINE',NULL,NULL),
(8,1,'1','2024-07-07 17:21:47','2102485479','ONLINE',NULL,NULL),
(9,1,'1','2024-07-07 17:22:24','442210659','ONLINE',NULL,NULL),
(10,1,'1','2024-07-07 17:23:08','50454792','ONLINE',NULL,NULL),
(11,1,'1','2024-07-07 17:23:32','753089710','ONLINE',NULL,NULL),
(12,1,'1','2024-07-07 17:30:40','1793304138','ONLINE',NULL,NULL),
(13,1,'1','2024-07-07 17:32:08','201918098','ONLINE',NULL,NULL),
(14,1,'10','2024-07-08 09:44:54','1851467365','ONLINE',NULL,NULL),
(15,1,'1000','2024-07-08 13:15:37','446983963','ONLINE',NULL,NULL),
(16,1,'1','2024-07-08 13:15:51','830798166','ONLINE',NULL,NULL),
(17,1,'1','2024-07-08 13:28:30','1241113857','ONLINE',NULL,NULL),
(18,1,'1','2024-07-08 19:06:35','138859915','ONLINE',NULL,NULL),
(19,1,'1','2024-07-09 03:49:20','650834073','ONLINE',NULL,NULL),
(20,1,'1','2024-07-09 03:49:22','1798500697','ONLINE',NULL,NULL),
(21,1,'1','2024-07-09 03:49:23','1306837141','ONLINE',NULL,NULL),
(22,1,'1','2024-07-09 03:49:25','223425737','ONLINE',NULL,NULL),
(23,1,'1','2024-07-09 03:49:27','1508537702','ONLINE',NULL,NULL),
(24,1,'1','2024-07-09 03:49:32','100923361','ONLINE',NULL,NULL),
(25,1,'1','2024-07-09 03:49:35','929419446','ONLINE',NULL,NULL),
(26,1,'1','2024-07-09 06:32:38','913559958','ONLINE',NULL,NULL),
(27,1,'10','2024-07-09 23:45:05','241767793','ONLINE',NULL,NULL),
(28,2,'1','2024-07-10 17:07:52','1441572367','ONLINE',NULL,NULL),
(29,2,'1001','2024-07-10 17:07:58','739609096','ONLINE',NULL,NULL),
(30,1,'100','2024-07-11 14:27:31','933015410','ONLINE','COMPLETED',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RESULT`
--

LOCK TABLES `RESULT` WRITE;
/*!40000 ALTER TABLE `RESULT` DISABLE KEYS */;
INSERT INTO `RESULT` VALUES
(1,'1','100','120','2024-02-05','',NULL),
(2,'5','119','123','2024-02-05','',NULL),
(3,'2','111','122','2024-02-05','',NULL),
(4,'8','119','246','2024-02-05','',NULL),
(5,'9','378','460','2024-02-05','',NULL),
(6,'3','499','990','2024-02-05','',NULL),
(7,'4','278','999','2024-02-05','',NULL),
(8,'6','278','778','2024-02-05','',NULL),
(10,'1','000','100','2024-07-09','',NULL);
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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SETTINGS`
--

LOCK TABLES `SETTINGS` WRITE;
/*!40000 ALTER TABLE `SETTINGS` DISABLE KEYS */;
INSERT INTO `SETTINGS` VALUES
(1,'9876543210','100','1000','100','200','300','800','400','9876543210','9876543210','9876543210','100','','','admin','$2y$12$fwN.wHkFaFBZcD9cjWv5Uuzx/JvNkx7E9KfTCnuLlxjyLdpGOZ36.','','','YES','UPIGATEWAY','123',100,120);
/*!40000 ALTER TABLE `SETTINGS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `STARLINE`
--

DROP TABLE IF EXISTS `STARLINE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STARLINE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `RESULT` varchar(255) DEFAULT NULL,
  `GAME_ID` varchar(100) DEFAULT NULL,
  `TIME` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `STARLINE`
--

LOCK TABLES `STARLINE` WRITE;
/*!40000 ALTER TABLE `STARLINE` DISABLE KEYS */;
INSERT INTO `STARLINE` VALUES
(1,'12','','2024-02-05 09:00:00'),
(2,'13','','2024-02-05 10:00:00'),
(3,'14','','2024-02-05 11:00:00'),
(4,'22','','2024-02-05 12:00:00'),
(5,'66','','2024-02-05 13:00:00'),
(6,'88','','2024-02-05 14:00:00');
/*!40000 ALTER TABLE `STARLINE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `STARLINE_GAMES`
--

DROP TABLE IF EXISTS `STARLINE_GAMES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STARLINE_GAMES` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(255) DEFAULT NULL,
  `INACTIVE` varchar(100) DEFAULT NULL,
  `START_HOUR` varchar(100) DEFAULT NULL,
  `INTERVAL_HOUR` varchar(100) DEFAULT NULL,
  `END_HOUR` varchar(100) DEFAULT NULL,
  `STATUS` varchar(100) DEFAULT NULL,
  `PAGE` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `STARLINE_GAMES`
--

LOCK TABLES `STARLINE_GAMES` WRITE;
/*!40000 ALTER TABLE `STARLINE_GAMES` DISABLE KEYS */;
INSERT INTO `STARLINE_GAMES` VALUES
(1,'POONA STARLINE',NULL,'9','6','14','ACTIVE','POONA'),
(2,'JK STARLINE',NULL,'9','6','14','ACTIVE','JK'),
(3,'GUJRAT STARLINE',NULL,'12','4','15','DEACTIVE','GUJRAT'),
(4,'GOLD LINE',NULL,'10','6','15','ACTIVE','GOLDLINE');
/*!40000 ALTER TABLE `STARLINE_GAMES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `STARLINE_GUESS`
--

DROP TABLE IF EXISTS `STARLINE_GUESS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STARLINE_GUESS` (
  `PATTI` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `STARLINE_GUESS`
--

LOCK TABLES `STARLINE_GUESS` WRITE;
/*!40000 ALTER TABLE `STARLINE_GUESS` DISABLE KEYS */;
/*!40000 ALTER TABLE `STARLINE_GUESS` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TRANSACTIONS`
--

LOCK TABLES `TRANSACTIONS` WRITE;
/*!40000 ALTER TABLE `TRANSACTIONS` DISABLE KEYS */;
INSERT INTO `TRANSACTIONS` VALUES
(1,'1','2024-02-05 13:00:45',1000,NULL,NULL,NULL,1000.00,''),
(2,'1','2024-02-05 13:01:02',-100,NULL,NULL,NULL,900.00,''),
(3,'1','2024-02-05 13:01:25',10,5,'open',1,890.00,NULL),
(4,'1','2024-02-05 13:01:58',100,NULL,NULL,NULL,990.00,'Added'),
(5,'1','2024-02-05 13:04:28',100,NULL,NULL,1,1090.00,'Game Win'),
(6,'1','2024-07-08 13:42:41',100,5,'close',2,990.00,NULL),
(7,'1','2024-07-08 13:43:19',200,5,'close',3,790.00,NULL),
(8,'1','2024-07-08 19:06:27',10,1,'close',4,780.00,NULL),
(9,'1','2024-07-08 19:06:27',10,1,'close',5,770.00,NULL),
(10,'1','2024-07-09 15:43:44',50,8,'open',6,720.00,NULL),
(11,'1','2024-07-09 15:47:41',50,6,'close',7,670.00,NULL),
(12,'1','2024-07-11 11:33:35',14,4,'close',8,656.00,NULL),
(13,'1','2024-07-11 11:34:30',13,6,'JODI',9,643.00,NULL),
(14,'1','2024-07-11 14:27:31',100,NULL,NULL,NULL,743.00,'Added');
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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USERS`
--

LOCK TABLES `USERS` WRITE;
/*!40000 ALTER TABLE `USERS` DISABLE KEYS */;
INSERT INTO `USERS` VALUES
(1,'Test User','test@gmail.com','9876543210',383.00,'$2y$12$UoUU3AG.SgjTd2VhatcMzu6IOdh44Jh8K6Jo.bS/gCEUUiwgwHwgm',NULL,NULL),
(2,'Avinash ','avinashcgandrakar172@gmail.com','9669876540',0.00,'$2y$12$gL5C7Dfza6oFFURVM.DE2ObnFJMcuS0XBq9KEZ3SDHp5ijAFGrd2e',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WINNERS`
--

LOCK TABLES `WINNERS` WRITE;
/*!40000 ALTER TABLE `WINNERS` DISABLE KEYS */;
INSERT INTO `WINNERS` VALUES
(1,'DXXpXk ChXXh','STARLINE','2021-12-28 11:55:34','10','100'),
(4,'NXRXXH XXHRXX','STARLINE','2021-12-30 06:42:01','10','100'),
(5,'DXXpXk ChXXh','STARLINE','2021-12-30 09:35:02','10','100'),
(6,'PRXKXXH','','2022-03-13 16:35:01','10','100'),
(7,'NXRXXH XXHRXX','','2022-03-14 04:35:01','56','560'),
(8,'TXXt XXXr','SRIDEVI NIGHT','2024-02-05 13:04:28','10','100');
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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WITHDRAW`
--

LOCK TABLES `WITHDRAW` WRITE;
/*!40000 ALTER TABLE `WITHDRAW` DISABLE KEYS */;
INSERT INTO `WITHDRAW` VALUES
(1,'1','upi1@upi.com','120','2024-07-11 14:42:36','COMPLETED'),
(2,'1','upi2@upi.com','120','2024-07-11 16:18:48','COMPLETED'),
(3,'1','upi1@upi.com','120','2024-07-11 16:32:27','REJECTED'),
(4,'1','upi1@upi.com','120','2024-07-11 16:32:32','COMPLETED');
/*!40000 ALTER TABLE `WITHDRAW` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-11 22:27:07
