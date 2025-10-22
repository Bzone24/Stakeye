-- MySQL dump 10.13  Distrib 5.5.62, for Linux (x86_64)
--
-- Host: localhost    Database: bigdady
-- ------------------------------------------------------
-- Server version	5.5.62-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `5d`
--

DROP TABLE IF EXISTS `5d`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `5d` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `period` bigint(20) DEFAULT '0',
  `result` varchar(5) NOT NULL DEFAULT '0',
  `game` int(11) NOT NULL DEFAULT '1',
  `status` int(11) DEFAULT '0',
  `time` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=392491 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `5d`
--

LOCK TABLES `5d` WRITE;
/*!40000 ALTER TABLE `5d` DISABLE KEYS */;
INSERT INTO `5d` VALUES (392430,2022070129610,'11342',3,1,'1713446100794'),(392431,2022070121765,'06485',5,1,'1713446100985'),(392432,2022070168932,'20422',1,1,'1713446160649'),(392433,2022070168933,'44030',1,1,'1713446220711'),(392434,2022070168934,'27915',1,1,'1713446280928'),(392435,2022070129611,'92159',3,1,'1713446281003'),(392436,2022070168935,'14230',1,1,'1713446340928'),(392437,2022070121766,'99172',5,1,'1713446401426'),(392438,2022070168936,'24590',1,1,'1713446401702'),(392439,2022070115882,'70349',10,1,'1713446401796'),(392440,2022070168937,'76740',1,1,'1713446461492'),(392441,2022070129612,'21414',3,1,'1713446461552'),(392442,2022070168938,'93847',1,1,'1713446520464'),(392443,2022070168939,'23359',1,1,'1713446580636'),(392444,2022070168940,'38445',1,1,'1713446640730'),(392445,2022070129613,'53064',3,1,'1713446640899'),(392446,2022070168941,'52448',1,1,'1713446700785'),(392447,2022070121767,'83323',5,1,'1713446700800'),(392448,2022070168942,'15857',1,1,'1713446760907'),(392449,2022070168943,'02861',1,1,'1713446820972'),(392450,2022070129614,'08383',3,1,'1713446820977'),(392451,2022070168944,'51823',1,1,'1713446880892'),(392452,2022070168945,'74411',1,1,'1713446942073'),(392453,2022070168946,'60188',1,1,'1713447001356'),(392454,2022070115883,'89316',10,1,'1713447001775'),(392455,2022070129615,'21614',3,1,'1713447001958'),(392456,2022070121768,'85404',5,1,'1713447002244'),(392457,2022070168947,'09731',1,1,'1713447060460'),(392458,2022070168948,'25941',1,1,'1713447120715'),(392459,2022070168949,'21685',1,1,'1713447180883'),(392460,2022070129616,'55306',3,1,'1713447180954'),(392461,2022070168950,'96329',1,1,'1713447240866'),(392462,2022070168951,'06414',1,1,'1713447301200'),(392463,2022070121769,'28727',5,1,'1713447301516'),(392464,2022070129617,'09302',3,1,'1713447361150'),(392465,2022070168952,'32546',1,1,'1713447361242'),(392466,2022070168953,'87885',1,1,'1713447420188'),(392467,2022070168954,'13812',1,1,'1713447480223'),(392468,2022070168955,'40732',1,1,'1713447540434'),(392469,2022070129618,'05236',3,1,'1713447540455'),(392470,2022070168956,'65568',1,1,'1713447600578'),(392471,2022070121770,'41235',5,1,'1713447600654'),(392472,2022070115884,'79084',10,1,'1713447600804'),(392473,2022070168957,'70293',1,1,'1713447660581'),(392474,2022070129619,'93476',3,1,'1713447720699'),(392475,2022070168958,'64179',1,1,'1713447720715'),(392476,2022070168959,'03223',1,1,'1713447780719'),(392477,2022070168960,'93841',1,1,'1713447840815'),(392478,2022070168961,'23008',1,1,'1713447901150'),(392479,2022070121771,'44553',5,1,'1713447901215'),(392480,2022070129620,'08534',3,1,'1713447901363'),(392481,2022070168962,'78468',1,1,'1713447961426'),(392482,2022070168963,'18642',1,1,'1713448020125'),(392483,2022070168964,'02047',1,1,'1713448080366'),(392484,2022070129621,'93566',3,1,'1713448080616'),(392485,2022070168965,'43479',1,1,'1713448140403'),(392486,2022070168966,'85760',1,1,'1713448200545'),(392487,2022070121772,'0',5,0,'1713448200577'),(392488,2022070115885,'0',10,0,'1713448200600'),(392489,2022070168967,'0',1,0,'1713448260694'),(392490,2022070129622,'0',3,0,'1713448260721');
/*!40000 ALTER TABLE `5d` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wingo1` text NOT NULL,
  `wingo3` text NOT NULL,
  `wingo5` text NOT NULL,
  `wingo10` text NOT NULL,
  `k5d` text NOT NULL,
  `k5d3` text NOT NULL,
  `k5d5` text,
  `k5d10` text,
  `k3d` text,
  `k3d3` text,
  `k3d5` text,
  `k3d10` text,
  `win_rate` int(11) DEFAULT NULL,
  `telegram` varchar(100) DEFAULT NULL,
  `cskh` varchar(100) DEFAULT NULL,
  `app` text,
  `recharge_bonus` int(11) DEFAULT NULL,
  `recharge_bonus_2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'-1','-1','-1','-1','-1','-1','-1','-1','-1','-1','-1','-1',1,'https://telegram.me','https://telegram.me','',NULL,NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `balance_transfer`
--

DROP TABLE IF EXISTS `balance_transfer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `balance_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_phone` bigint(255) NOT NULL,
  `receiver_phone` bigint(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `balance_transfer`
--

LOCK TABLES `balance_transfer` WRITE;
/*!40000 ALTER TABLE `balance_transfer` DISABLE KEYS */;
/*!40000 ALTER TABLE `balance_transfer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_recharge`
--

DROP TABLE IF EXISTS `bank_recharge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_bank` varchar(50) NOT NULL DEFAULT '0',
  `name_user` varchar(100) NOT NULL DEFAULT '0',
  `stk` varchar(100) NOT NULL DEFAULT '0',
  `qr_code_image` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'bank',
  `time` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_recharge`
--

LOCK TABLES `bank_recharge` WRITE;
/*!40000 ALTER TABLE `bank_recharge` DISABLE KEYS */;
INSERT INTO `bank_recharge` VALUES (18,'Demo Bank','Demo User','demo@upi','usdt_wallet','momo','0');
/*!40000 ALTER TABLE `bank_recharge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crashbetrecord`
--

DROP TABLE IF EXISTS `crashbetrecord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crashbetrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(211) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(211) NOT NULL DEFAULT 'pending',
  `winpoint` float NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crashbetrecord`
--

LOCK TABLES `crashbetrecord` WRITE;
/*!40000 ALTER TABLE `crashbetrecord` DISABLE KEYS */;
/*!40000 ALTER TABLE `crashbetrecord` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `financial_details`
--

DROP TABLE IF EXISTS `financial_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `financial_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) NOT NULL DEFAULT '0',
  `phone_used` varchar(50) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `type` varchar(50) NOT NULL DEFAULT '0',
  `time` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `financial_details`
--

LOCK TABLES `financial_details` WRITE;
/*!40000 ALTER TABLE `financial_details` DISABLE KEYS */;
INSERT INTO `financial_details` VALUES (1,'AO02014YD','387636509',1000,'1','1657373080436'),(2,'AO02014YD','387636509',1000,'2','1657373264811'),(3,'AO02014YD','387636509',1000,'2','1657373269339'),(4,'AO02014YD','387636509',3000,'1','1657448535900'),(5,'AO02014YD','387636509',2000,'1','1657448801632');
/*!40000 ALTER TABLE `financial_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `k3`
--

DROP TABLE IF EXISTS `k3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `k3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `period` bigint(20) NOT NULL DEFAULT '0',
  `result` int(11) NOT NULL,
  `game` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '0',
  `time` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=392553 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `k3`
--

LOCK TABLES `k3` WRITE;
/*!40000 ALTER TABLE `k3` DISABLE KEYS */;
INSERT INTO `k3` VALUES (392495,2022070168964,544,1,1,'1713446220811'),(392496,2022070168965,122,1,1,'1713446281114'),(392497,2022070129625,115,3,1,'1713446281180'),(392498,2022070168966,233,1,1,'1713446341029'),(392499,2022070121778,136,5,1,'1713446401915'),(392500,2022070168967,163,1,1,'1713446402027'),(392501,2022070115890,252,10,1,'1713446402049'),(392502,2022070168968,266,1,1,'1713446461675'),(392503,2022070129626,156,3,1,'1713446461732'),(392504,2022070168969,453,1,1,'1713446520500'),(392505,2022070168970,565,1,1,'1713446580659'),(392506,2022070168971,632,1,1,'1713446640848'),(392507,2022070129627,342,3,1,'1713446641093'),(392508,2022070168972,212,1,1,'1713446700880'),(392509,2022070121779,225,5,1,'1713446700912'),(392510,2022070168973,545,1,1,'1713446760962'),(392511,2022070168974,423,1,1,'1713446821078'),(392512,2022070129628,461,3,1,'1713446821105'),(392513,2022070168975,651,1,1,'1713446880925'),(392514,2022070168976,563,1,1,'1713446942355'),(392515,2022070168977,565,1,1,'1713447001705'),(392516,2022070115891,421,10,1,'1713447002225'),(392517,2022070129629,612,3,1,'1713447002631'),(392518,2022070121780,446,5,1,'1713447002747'),(392519,2022070168978,556,1,1,'1713447060641'),(392520,2022070168979,644,1,1,'1713447120783'),(392521,2022070168980,635,1,1,'1713447181164'),(392522,2022070129630,621,3,1,'1713447181231'),(392523,2022070168981,441,1,1,'1713447241161'),(392524,2022070168982,461,1,1,'1713447301344'),(392525,2022070121781,262,5,1,'1713447301804'),(392526,2022070129631,621,3,1,'1713447361409'),(392527,2022070168983,256,1,1,'1713447361493'),(392528,2022070168984,341,1,1,'1713447420240'),(392529,2022070168985,532,1,1,'1713447480273'),(392530,2022070168986,311,1,1,'1713447540521'),(392531,2022070129632,112,3,1,'1713447540595'),(392532,2022070168987,152,1,1,'1713447600699'),(392533,2022070121782,446,5,1,'1713447600820'),(392534,2022070115892,145,10,1,'1713447601110'),(392535,2022070168988,512,1,1,'1713447660640'),(392536,2022070129633,561,3,1,'1713447720808'),(392537,2022070168989,355,1,1,'1713447720819'),(392538,2022070168990,645,1,1,'1713447780788'),(392539,2022070168991,643,1,1,'1713447840869'),(392540,2022070168992,461,1,1,'1713447901283'),(392541,2022070121783,635,5,1,'1713447901354'),(392542,2022070129634,413,3,1,'1713447901466'),(392543,2022070168993,144,1,1,'1713447961491'),(392544,2022070168994,224,1,1,'1713448020151'),(392545,2022070168995,221,1,1,'1713448080615'),(392546,2022070129635,524,3,1,'1713448080941'),(392547,2022070168996,251,1,1,'1713448140472'),(392548,2022070168997,334,1,1,'1713448200673'),(392549,2022070121784,0,5,0,'1713448200708'),(392550,2022070115893,0,10,0,'1713448200732'),(392551,2022070168998,0,1,0,'1713448260796'),(392552,2022070129636,0,3,0,'1713448260840');
/*!40000 ALTER TABLE `k3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level`
--

DROP TABLE IF EXISTS `level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL DEFAULT '0',
  `f1` varchar(50) NOT NULL,
  `f2` varchar(50) NOT NULL,
  `f3` varchar(50) NOT NULL,
  `f4` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level`
--

LOCK TABLES `level` WRITE;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` VALUES (0,0,'2','1','1','1'),(1,1,'0.25','0.25','0.25','0.25'),(2,2,'0.25','0.25','0.25','0.25'),(3,3,'0.25','0.25','0.25','0.25'),(4,4,'0.25','0.25','0.25','0.25'),(5,5,'0.25','0.25','0.25','0.25'),(6,6,'0.25','0.25','0.25','0.25'),(7,7,'0.25','0.25','0.25','0.25'),(8,8,'0.25','0.25','0.25','0.25'),(9,9,'0.25','0.25','0.25','0.25'),(10,10,'0.5','0.5','0.5','0.5'),(11,11,'0.5','0.5','0.5','0.5'),(12,12,'0.5','0.05','0.5','0.5'),(13,13,'0.5','0.5','0.5','0.5'),(14,14,'0.5','0.5','0.5','0.5');
/*!40000 ALTER TABLE `level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `minutes_1`
--

DROP TABLE IF EXISTS `minutes_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `minutes_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` varchar(100) NOT NULL DEFAULT '0',
  `phone` varchar(20) NOT NULL DEFAULT '0',
  `code` varchar(30) NOT NULL DEFAULT '0',
  `invite` varchar(30) NOT NULL DEFAULT '0',
  `stage` varchar(255) NOT NULL DEFAULT '0',
  `result` int(11) NOT NULL DEFAULT '0',
  `more` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `fee` int(11) NOT NULL DEFAULT '0',
  `get` int(11) NOT NULL DEFAULT '0',
  `game` varchar(50) NOT NULL DEFAULT '0',
  `bet` varchar(10) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `today` varchar(255) DEFAULT NULL,
  `time` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2134 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `minutes_1`
--

LOCK TABLES `minutes_1` WRITE;
/*!40000 ALTER TABLE `minutes_1` DISABLE KEYS */;
INSERT INTO `minutes_1` VALUES (2125,'20240416619878289941765','9876543210','rStMA54515','TLRUL40094','2022070168143',2,0,0,980,1,20,0,'wingo','0',2,'2024-04-16 8:23:20 AM','1713248600556');
/*!40000 ALTER TABLE `minutes_1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_list`
--

DROP TABLE IF EXISTS `point_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) NOT NULL DEFAULT '0',
  `telegram` varchar(100) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `money_us` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `total1` int(11) NOT NULL DEFAULT '20',
  `total2` int(11) NOT NULL DEFAULT '50',
  `total3` int(11) NOT NULL DEFAULT '150',
  `total4` int(11) NOT NULL DEFAULT '350',
  `total5` int(11) NOT NULL DEFAULT '850',
  `total6` int(11) NOT NULL DEFAULT '5000',
  `total7` int(11) NOT NULL DEFAULT '18050',
  `total8` int(11) NOT NULL DEFAULT '20000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=410 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_list`
--

LOCK TABLES `point_list` WRITE;
/*!40000 ALTER TABLE `point_list` DISABLE KEYS */;
INSERT INTO `point_list` VALUES (1,'9876543210','0',0,0,0,5,10,15,25,20,30,35,6000);
/*!40000 ALTER TABLE `point_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recharge`
--

DROP TABLE IF EXISTS `recharge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` varchar(100) NOT NULL DEFAULT '0',
  `transaction_id` varchar(100) DEFAULT '0',
  `utr` bigint(255) DEFAULT NULL,
  `phone` varchar(50) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `type` varchar(10) NOT NULL DEFAULT 'bank',
  `status` int(11) NOT NULL DEFAULT '0',
  `today` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `time` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recharge`
--

LOCK TABLES `recharge` WRITE;
/*!40000 ALTER TABLE `recharge` DISABLE KEYS */;
INSERT INTO `recharge` VALUES (1,'2024311446560615777813','NULL',566777755666,'9876543210',500,'upi_manual',1,'2024-14-04 1:21:40 PM','NULL','1713027516781');
/*!40000 ALTER TABLE `recharge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `redenvelopes`
--

DROP TABLE IF EXISTS `redenvelopes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `redenvelopes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_redenvelope` varchar(100) NOT NULL DEFAULT '0',
  `phone` varchar(50) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `used` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `time` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `redenvelopes`
--

LOCK TABLES `redenvelopes` WRITE;
/*!40000 ALTER TABLE `redenvelopes` DISABLE KEYS */;
/*!40000 ALTER TABLE `redenvelopes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `redenvelopes_used`
--

DROP TABLE IF EXISTS `redenvelopes_used`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `redenvelopes_used` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) NOT NULL DEFAULT '0',
  `phone_used` varchar(50) NOT NULL DEFAULT '0',
  `id_redenvelops` varchar(50) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `time` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `redenvelopes_used`
--

LOCK TABLES `redenvelopes_used` WRITE;
/*!40000 ALTER TABLE `redenvelopes_used` DISABLE KEYS */;
/*!40000 ALTER TABLE `redenvelopes_used` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `result_5d`
--

DROP TABLE IF EXISTS `result_5d`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `result_5d` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` varchar(100) NOT NULL DEFAULT '0',
  `phone` varchar(20) DEFAULT '0',
  `code` varchar(30) NOT NULL DEFAULT '0',
  `invite` varchar(30) NOT NULL DEFAULT '0',
  `stage` bigint(20) DEFAULT '0',
  `result` varchar(5) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `fee` int(11) NOT NULL DEFAULT '0',
  `get` int(11) NOT NULL DEFAULT '0',
  `game` int(11) NOT NULL,
  `join_bet` varchar(10) NOT NULL DEFAULT '0',
  `bet` varchar(20) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `time` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=435 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `result_5d`
--

LOCK TABLES `result_5d` WRITE;
/*!40000 ALTER TABLE `result_5d` DISABLE KEYS */;
INSERT INTO `result_5d` VALUES (155,'20230925238383980653384','9876543210','6fGGw42409','2cOCs36373',2022070133095,'35464',1,10,10,1,0,0,1,'a','1',2,'1695635294410'),(344,'20240103503375652978575','9876543210','vRter45609','6fGGw42409',2022070229077,'99043',1,1000,980,1,20,1960,1,'total','b',2,'1704305550572');
/*!40000 ALTER TABLE `result_5d` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `result_k3`
--

DROP TABLE IF EXISTS `result_k3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `result_k3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` varchar(100) NOT NULL DEFAULT '0',
  `phone` varchar(50) NOT NULL DEFAULT '0',
  `code` varchar(50) NOT NULL DEFAULT '0',
  `invite` varchar(50) NOT NULL DEFAULT '0',
  `stage` varchar(50) NOT NULL DEFAULT '0',
  `result` varchar(5) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `fee` int(11) NOT NULL DEFAULT '0',
  `get` int(11) NOT NULL DEFAULT '0',
  `game` varchar(5) NOT NULL DEFAULT '0',
  `join_bet` varchar(100) NOT NULL DEFAULT '0',
  `typeGame` varchar(100) NOT NULL DEFAULT '0',
  `bet` varchar(100) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `time` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=592 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `result_k3`
--

LOCK TABLES `result_k3` WRITE;
/*!40000 ALTER TABLE `result_k3` DISABLE KEYS */;
INSERT INTO `result_k3` VALUES (32,'20230801344357294580582','9876543210','6fGGw42409','2cOCs36373','2022070120460','345',1,1,1,1,0,0,'1','1','total','3',2,'1690867517152'),(500,'889386335076850','9876543210','vRter45609','6fGGw42409','2022070217463','266',1,10,10,1,0,0,'1','4','unlike','@u@',2,'1703607976765');
/*!40000 ALTER TABLE `result_k3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roses`
--

DROP TABLE IF EXISTS `roses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) DEFAULT '0',
  `code` varchar(50) NOT NULL DEFAULT '0',
  `invite` varchar(50) NOT NULL DEFAULT '0',
  `f1` int(11) NOT NULL DEFAULT '0',
  `f2` int(11) NOT NULL DEFAULT '0',
  `f3` int(11) NOT NULL DEFAULT '0',
  `f4` int(11) NOT NULL DEFAULT '0',
  `time` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roses`
--

LOCK TABLES `roses` WRITE;
/*!40000 ALTER TABLE `roses` DISABLE KEYS */;
/*!40000 ALTER TABLE `roses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salary`
--

DROP TABLE IF EXISTS `salary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `time` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salary`
--

LOCK TABLES `salary` WRITE;
/*!40000 ALTER TABLE `salary` DISABLE KEYS */;
INSERT INTO `salary` VALUES (2,'9876543210',1000,'daily','12/22/2023, 02:12:16 PM');
/*!40000 ALTER TABLE `salary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turn_over`
--

DROP TABLE IF EXISTS `turn_over`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turn_over` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(100) NOT NULL,
  `code` varchar(250) NOT NULL,
  `invite` varchar(250) NOT NULL,
  `daily_turn_over` decimal(20,2) NOT NULL DEFAULT '0.00',
  `total_turn_over` decimal(20,2) NOT NULL DEFAULT '0.00',
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turn_over`
--

LOCK TABLES `turn_over` WRITE;
/*!40000 ALTER TABLE `turn_over` DISABLE KEYS */;
INSERT INTO `turn_over` VALUES (1,'1111111111','11','11',11.00,11.00,'2023-11-20 14:20:03'),(21,'9876543210','oCtPJ28060','6fGGw42400',1037538.00,1037538.00,'2024-02-02 11:35:10'),(59,'3333333333','oCtPJ28060','6fGGw42400',12580.00,12580.00,'2024-02-15 20:40:38');
/*!40000 ALTER TABLE `turn_over` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_bank`
--

DROP TABLE IF EXISTS `user_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) NOT NULL DEFAULT '0',
  `name_bank` varchar(100) NOT NULL DEFAULT '0',
  `name_user` varchar(100) DEFAULT '0',
  `stk` varchar(100) NOT NULL DEFAULT '0',
  `tp` varchar(100) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '0',
  `sdt` varchar(20) DEFAULT '0',
  `tinh` varchar(100) NOT NULL DEFAULT '0',
  `chi_nhanh` varchar(100) NOT NULL DEFAULT '0',
  `time` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_bank`
--

LOCK TABLES `user_bank` WRITE;
/*!40000 ALTER TABLE `user_bank` DISABLE KEYS */;
INSERT INTO `user_bank` VALUES (1,'1111111111','41234324','DFDSFDSF','431242423','xvcx','dfvcv','zvcxv@ssdsd','1111111111','sdada','1700064130272'),(2,'7426995794','Sajjan Singh','SAJJAN','45080100015413','Jaipur','BARB0BRGBXX','Uabh@ybl','7426995794','Jj','1700646370915'),(3,'9343905371','Fino Payment Bank','CHANDRSHEKHAR MOURYA','20143741441','494222','FINO0001553','9343905371@ibl','9343905371','Bukhari Petrol Pump, Link Road, Bilaspur','1700806698089'),(4,'9926658073','State Bank of India','BHUPENDRA PATEL','31216373490','Sidhi churhat','SBIN0007644','91249','9926658073','ADB CHURHAT','1700834091374'),(5,'7303014951','hdfc','GAAFAFAF','3133242424244','bgr','13fc244','2324141','141414','141414','1700906912769'),(6,'8640033954','Federal Bank','TARUN OSWAL','55550102429832','Khandwa','FDRL0005555','taruno@fbl','8640033954','Samreli','1701097153303'),(7,'7404683369','Sarva Haryana gramin bank','SHUBHAM','80520100072980','Meham','PUNB0HGB001','7404683369@axl','7404683369','Meham,Rohtak(Haryana)','1701141975452'),(8,'9326503430','Kotak Mahindra Bank','RAHUL SATISH BAGRANIYA','4045447172','Mumbai','KKBK0001358','9326503430@paytm','9326503430','Dahisar east','1701144990441'),(9,'9430970061','PUNJAB NATIONAL BANK','ADARSH KUMAR SHRIVASTAVA','3048001500015087','MUZAFFARPUR','PUNB0304800','9142050714@paytm','9142050714','PANKAJ MARKET MUZAFFARPUR','1701167982478'),(10,'8544709163','Punjab National Bank','GOVINDA','3957001500034869','Himachal Pradesh','PUNB0395700','8544709163@paytm','8544709163','8544709163@paytm','1701186246681'),(11,'8544709163','Punjab National Bank','GOVINDA','3957001500034869','Himachal Pradesh','PUNB0395700','8544709163@paytm','8544709163','8544709163@paytm','1701186246681'),(12,'6207108192','Uco bank','NIGAM KUMAR','25353211020073','Gaya','UCBA0002535','6207108192@axl','6207108192','Bodhgaya','1701352936975'),(13,'6283815647','TARANVEER SINGH','UNION BANK OF INDIA','629502010003003','NABHA','UBIN0562955','taranveer785@oksbi','6283815647','NABHA','1701597536744'),(14,'1234567890','918277273','SURENDER','919288273','hhhg','Hahahiw','hhh@gg','1234567890','hjjjj','1710865234878'),(15,'9572508351','Prince','PRINFE','8000000000','0','Gghhhh','0','Ghhhhh','0','1708029426136'),(16,'6375884088','sbi','NAVEEN TAILOR','91206297914','0','sbin0031117','0','6375884088','0','1708053530903'),(17,'7357719707','Punjab National Bank','SUBAH RAAT','0517100100014998','0','PUNB0051710','0','9950037981','0','1708345755943'),(18,'8905515707','Paytm Payment Bank','PRAKASH TAILOR','917426016543','0','PYTM0123456','0','7426016543','0','1708428328726'),(19,'8905070735','PUNJAB NATIONAL BANK','PRADEEP TAILOR','0517101700027780','0','PUNB0051710','0','8905070735','0','1708525034793'),(20,'9934605090','sdcvsd','FVZFVSF','235465432456','0','dscvsac','0','1234354656','0','1708915836157'),(21,'7230830239','Bank of baroda','PAWAN TAWANIYA','01358100001832','0','BalARB0BIKANE','0','8290036918','0','1710872220008'),(22,'9649445761','Bank of Baroda','SHAKTI SINGH','92278100000031','0','BARB0DBSUJN','0','9649445761','0','1711632679374'),(23,'8529723709','Bank of Baroda','TARA KANWAR','20478100002211','0','BARB0TIHAWA','0','8955892019','0','1711636763372'),(24,'7627042144','Punjab National Bank','AMAN SINGH SHEKHAWAT','2635001700050328','0','PUNB0263500','0','7627042144','0','1711636849610'),(25,'8955833310','Au small finance bank','RAJAT SINGH SHEKHAWAT','1815241316661652','0','AUBL0002413','0','9079902050','0','1711721686743'),(26,'9680847624','Bank of Baroda','JYOTI KANWAR','92278100000018','0','BARBODBSUJN','0','7014652827','0','1711986875054'),(27,'6377889394','Bank of Baroda','JYOTI KANWAR','92278100000081','0','BARBODBSUJN','0','7014652827','0','1712221030250'),(28,'7676767676','Hhjj','FHH','57886455','0','Gyycc667','0','7668856','0','1712466798106'),(29,'9199752120','Central Bank of India','RAJU SINGH','3509173351','0','CBIN0283020','0','9199752120','0','1713246237724');
/*!40000 ALTER TABLE `user_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(50) NOT NULL DEFAULT '0',
  `phone` varchar(20) NOT NULL DEFAULT '0',
  `token` varchar(100) NOT NULL DEFAULT '0',
  `name_user` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '0',
  `plain_password` varchar(250) DEFAULT NULL,
  `money` int(11) NOT NULL DEFAULT '0',
  `total_money` int(11) NOT NULL DEFAULT '0',
  `roses_f1` int(11) NOT NULL DEFAULT '0',
  `roses_f` int(11) NOT NULL DEFAULT '0',
  `roses_today` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `rank` int(11) NOT NULL DEFAULT '0',
  `code` varchar(30) NOT NULL DEFAULT '0',
  `invite` varchar(30) NOT NULL DEFAULT '0',
  `ctv` varchar(50) NOT NULL DEFAULT '0',
  `veri` int(11) NOT NULL DEFAULT '0',
  `otp` varchar(10) NOT NULL DEFAULT '0',
  `ip_address` varchar(50) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `today` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time` varchar(50) NOT NULL DEFAULT '0',
  `time_otp` varchar(50) NOT NULL DEFAULT '0',
  `user_level` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=523 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (282,'26289','9876543210','1cd1b5ca738fae702d553c3f56b2bdc2','Member93658','e10adc3949ba59abbe56e057f20f883e','123456',10000,10500,0,0,0,1,1,'uVxnY75353','SUTFD37284','000000',1,'964411','::1',1,'2024-02-25 18:41:52','1708886512413','0',3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wingo`
--

DROP TABLE IF EXISTS `wingo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wingo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `period` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `game` varchar(10) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `time` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=394373 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wingo`
--

LOCK TABLES `wingo` WRITE;
/*!40000 ALTER TABLE `wingo` DISABLE KEYS */;
INSERT INTO `wingo` VALUES (394300,'2022070168711',3,'wingo',1,'1713445680814'),(394301,'2022070168712',3,'wingo',1,'1713445740919'),(394302,'2022070129406',2,'wingo3',1,'1713445740924'),(394303,'2022070168713',9,'wingo',1,'1713445800999'),(394304,'2022070121720',8,'wingo5',1,'1713445801002'),(394305,'2022070115876',9,'wingo10',1,'1713445801001'),(394306,'2022070168714',0,'wingo',1,'1713445860075'),(394307,'2022070168715',2,'wingo',1,'1713445920166'),(394308,'2022070129407',1,'wingo3',1,'1713445920183'),(394309,'2022070168716',5,'wingo',1,'1713445980255'),(394310,'2022070168717',8,'wingo',1,'1713446040335'),(394311,'2022070168718',4,'wingo',1,'1713446100453'),(394312,'2022070129408',2,'wingo3',1,'1713446100455'),(394313,'2022070121721',4,'wingo5',1,'1713446100456'),(394314,'2022070168719',7,'wingo',1,'1713446160531'),(394315,'2022070168720',0,'wingo',1,'1713446220611'),(394316,'2022070168721',9,'wingo',1,'1713446280724'),(394317,'2022070129409',5,'wingo3',1,'1713446280725'),(394318,'2022070168722',4,'wingo',1,'1713446340793'),(394319,'2022070121722',0,'wingo5',1,'1713446400963'),(394320,'2022070168723',2,'wingo',1,'1713446400980'),(394321,'2022070115877',8,'wingo10',1,'1713446400983'),(394322,'2022070168724',9,'wingo',1,'1713446461025'),(394323,'2022070129410',2,'wingo3',1,'1713446461027'),(394324,'2022070168725',4,'wingo',1,'1713446520155'),(394325,'2022070168726',7,'wingo',1,'1713446580277'),(394326,'2022070168727',0,'wingo',1,'1713446640374'),(394327,'2022070129411',8,'wingo3',1,'1713446640375'),(394328,'2022070168728',3,'wingo',1,'1713446700504'),(394329,'2022070121723',9,'wingo5',1,'1713446700505'),(394330,'2022070168729',8,'wingo',1,'1713446760556'),(394331,'2022070168730',9,'wingo',1,'1713446820646'),(394332,'2022070129412',0,'wingo3',1,'1713446820647'),(394333,'2022070168731',4,'wingo',1,'1713446880722'),(394334,'2022070168732',7,'wingo',1,'1713446940693'),(394335,'2022070168733',0,'wingo',1,'1713447000976'),(394336,'2022070115878',5,'wingo10',1,'1713447001042'),(394337,'2022070129413',0,'wingo3',1,'1713447001087'),(394338,'2022070121724',3,'wingo5',1,'1713447001102'),(394339,'2022070168734',0,'wingo',1,'1713447060172'),(394340,'2022070168735',4,'wingo',1,'1713447120392'),(394341,'2022070168736',6,'wingo',1,'1713447180503'),(394342,'2022070129414',0,'wingo3',1,'1713447180506'),(394343,'2022070168737',5,'wingo',1,'1713447240630'),(394344,'2022070168738',4,'wingo',1,'1713447300835'),(394345,'2022070121725',7,'wingo5',1,'1713447300836'),(394346,'2022070129415',5,'wingo3',1,'1713447360904'),(394347,'2022070168739',2,'wingo',1,'1713447360905'),(394348,'2022070168740',4,'wingo',1,'1713447420068'),(394349,'2022070168741',6,'wingo',1,'1713447480101'),(394350,'2022070168742',4,'wingo',1,'1713447540226'),(394351,'2022070129416',8,'wingo3',1,'1713447540246'),(394352,'2022070168743',1,'wingo',1,'1713447600347'),(394353,'2022070121726',4,'wingo5',1,'1713447600349'),(394354,'2022070115879',8,'wingo10',1,'1713447600351'),(394355,'2022070168744',0,'wingo',1,'1713447660401'),(394356,'2022070129417',2,'wingo3',1,'1713447720508'),(394357,'2022070168745',8,'wingo',1,'1713447720506'),(394358,'2022070168746',6,'wingo',1,'1713447780587'),(394359,'2022070168747',3,'wingo',1,'1713447840688'),(394360,'2022070168748',3,'wingo',1,'1713447900828'),(394361,'2022070121727',7,'wingo5',1,'1713447900868'),(394362,'2022070129418',0,'wingo3',1,'1713447900832'),(394363,'2022070168749',2,'wingo',1,'1713447960924'),(394364,'2022070168750',3,'wingo',1,'1713448020045'),(394365,'2022070168751',9,'wingo',1,'1713448080171'),(394366,'2022070129419',9,'wingo3',1,'1713448080173'),(394367,'2022070168752',9,'wingo',1,'1713448140291'),(394368,'2022070168753',3,'wingo',1,'1713448200456'),(394369,'2022070121728',0,'wingo5',0,'1713448200458'),(394370,'2022070115880',0,'wingo10',0,'1713448200460'),(394371,'2022070168754',0,'wingo',0,'1713448260587'),(394372,'2022070129420',0,'wingo3',0,'1713448260589');
/*!40000 ALTER TABLE `wingo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdraw`
--

DROP TABLE IF EXISTS `withdraw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` varchar(100) NOT NULL DEFAULT '0',
  `phone` varchar(50) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `stk` varchar(100) NOT NULL DEFAULT '0',
  `name_bank` varchar(100) NOT NULL DEFAULT '0',
  `name_user` varchar(100) NOT NULL DEFAULT '0',
  `ifsc` varchar(255) NOT NULL,
  `sdt` varchar(255) NOT NULL DEFAULT '0',
  `tp` varchar(211) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `today` varchar(255) DEFAULT NULL,
  `time` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdraw`
--

LOCK TABLES `withdraw` WRITE;
/*!40000 ALTER TABLE `withdraw` DISABLE KEYS */;
/*!40000 ALTER TABLE `withdraw` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-18 19:21:26
