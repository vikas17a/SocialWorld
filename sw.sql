-- MySQL dump 10.13  Distrib 5.5.24, for Win32 (x86)
--
-- Host: localhost    Database: sw
-- ------------------------------------------------------
-- Server version	5.5.24-log

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
-- Table structure for table `sw_city`
--

DROP TABLE IF EXISTS `sw_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_city` (
  `c_id` int(5) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(20) NOT NULL,
  PRIMARY KEY (`c_id`),
  UNIQUE KEY `c_name` (`c_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_city`
--

LOCK TABLES `sw_city` WRITE;
/*!40000 ALTER TABLE `sw_city` DISABLE KEYS */;
INSERT INTO `sw_city` VALUES (8,'asc'),(2,'Batinda'),(3,'Fatehbad'),(7,'Jaipur'),(4,'Mountain VIew'),(6,'Mumbai'),(5,'Sanpada'),(1,'Sirsa');
/*!40000 ALTER TABLE `sw_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_connection`
--

DROP TABLE IF EXISTS `sw_connection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_connection` (
  `u1id` int(5) NOT NULL,
  `u2id` int(5) NOT NULL,
  `bool` int(1) NOT NULL,
  PRIMARY KEY (`u1id`,`u2id`),
  KEY `u2id` (`u2id`),
  CONSTRAINT `sw_connection_ibfk_1` FOREIGN KEY (`u1id`) REFERENCES `sw_ulogin` (`u_id`),
  CONSTRAINT `sw_connection_ibfk_2` FOREIGN KEY (`u2id`) REFERENCES `sw_ulogin` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_connection`
--

LOCK TABLES `sw_connection` WRITE;
/*!40000 ALTER TABLE `sw_connection` DISABLE KEYS */;
INSERT INTO `sw_connection` VALUES (7,12,1),(8,7,1),(8,11,0),(8,12,1),(9,7,1),(9,8,1),(10,8,1),(10,9,1),(11,9,1),(12,13,0),(14,7,1),(14,8,1);
/*!40000 ALTER TABLE `sw_connection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_country`
--

DROP TABLE IF EXISTS `sw_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_country` (
  `cn_id` int(4) NOT NULL AUTO_INCREMENT,
  `cn_name` varchar(20) NOT NULL,
  PRIMARY KEY (`cn_id`),
  UNIQUE KEY `cn_name` (`cn_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_country`
--

LOCK TABLES `sw_country` WRITE;
/*!40000 ALTER TABLE `sw_country` DISABLE KEYS */;
INSERT INTO `sw_country` VALUES (3,'dg'),(4,'England'),(1,'India'),(2,'US');
/*!40000 ALTER TABLE `sw_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_detail`
--

DROP TABLE IF EXISTS `sw_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_detail` (
  `u_id` int(5) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `c_id` int(5) NOT NULL,
  `s_id` int(5) NOT NULL,
  `cn_id` int(5) NOT NULL,
  `pic_id` int(10) NOT NULL,
  `bio` text,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `w_id` int(10) NOT NULL,
  `wl_id` int(10) NOT NULL,
  `dob` varchar(12) NOT NULL,
  UNIQUE KEY `u_id` (`u_id`),
  KEY `c_id` (`c_id`),
  KEY `s_id` (`s_id`),
  KEY `cn_id` (`cn_id`),
  KEY `pic_id` (`pic_id`),
  KEY `w_id` (`w_id`),
  KEY `wl_id` (`wl_id`),
  CONSTRAINT `sw_detail_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `sw_ulogin` (`u_id`),
  CONSTRAINT `sw_detail_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `sw_city` (`c_id`),
  CONSTRAINT `sw_detail_ibfk_3` FOREIGN KEY (`s_id`) REFERENCES `sw_state` (`s_id`),
  CONSTRAINT `sw_detail_ibfk_4` FOREIGN KEY (`cn_id`) REFERENCES `sw_country` (`cn_id`),
  CONSTRAINT `sw_detail_ibfk_5` FOREIGN KEY (`pic_id`) REFERENCES `sw_picup` (`pic_id`),
  CONSTRAINT `sw_detail_ibfk_6` FOREIGN KEY (`w_id`) REFERENCES `sw_profession` (`w_id`),
  CONSTRAINT `sw_detail_ibfk_7` FOREIGN KEY (`wl_id`) REFERENCES `sw_workl` (`wl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_detail`
--

LOCK TABLES `sw_detail` WRITE;
/*!40000 ALTER TABLE `sw_detail` DISABLE KEYS */;
INSERT INTO `sw_detail` VALUES (7,'M',3,1,1,1,'I am the best....','Sahil','Gheek',1,1,'1-Jan-1980'),(8,'M',7,5,1,18,'I am the smartest person ever you found....','Vikas','Aggarwal',1,1,'20-Jan-1994'),(9,'M',7,5,1,1,'I am tinkar...','Vikas','Tinkar',1,1,'1-Jan-1992'),(10,'M',7,5,1,27,'i am donor..','Vicky','Donor',1,1,'1-Jan-1980'),(11,'M',8,6,3,29,'vb','AbC','abc',3,5,'1-Jan-1980'),(12,'F',6,7,1,1,'I am a cool girl....','Tammana','Aggarwal',1,6,'1-Jan-1992'),(13,'M',6,7,1,1,'I am a CSE student.','aryan','arora',1,7,'1-Sep-1993'),(14,'M',7,8,4,1,'I am  the coolest sweeper ever found....','Shane','Warn',4,8,'1-Jan-1989');
/*!40000 ALTER TABLE `sw_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_ftype`
--

DROP TABLE IF EXISTS `sw_ftype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_ftype` (
  `ft_id` int(2) NOT NULL AUTO_INCREMENT,
  `ft_name` varchar(20) NOT NULL,
  PRIMARY KEY (`ft_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_ftype`
--

LOCK TABLES `sw_ftype` WRITE;
/*!40000 ALTER TABLE `sw_ftype` DISABLE KEYS */;
INSERT INTO `sw_ftype` VALUES (1,'image');
/*!40000 ALTER TABLE `sw_ftype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_gjoin`
--

DROP TABLE IF EXISTS `sw_gjoin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_gjoin` (
  `g_id` int(10) NOT NULL,
  `u_id` int(5) NOT NULL,
  `d_ate` date NOT NULL,
  `t_time` time NOT NULL,
  PRIMARY KEY (`g_id`,`u_id`),
  KEY `u_id` (`u_id`),
  CONSTRAINT `sw_gjoin_ibfk_1` FOREIGN KEY (`g_id`) REFERENCES `sw_group` (`g_id`),
  CONSTRAINT `sw_gjoin_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `sw_ulogin` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_gjoin`
--

LOCK TABLES `sw_gjoin` WRITE;
/*!40000 ALTER TABLE `sw_gjoin` DISABLE KEYS */;
INSERT INTO `sw_gjoin` VALUES (3,8,'2013-04-16','11:44:04'),(4,8,'2013-04-16','11:41:58'),(4,9,'2013-04-11','02:01:29'),(5,9,'2013-04-11','02:39:05'),(5,10,'2013-04-11','01:28:06'),(6,9,'2013-04-11','03:22:15'),(6,10,'2013-04-11','01:20:20'),(6,11,'2013-04-11','10:48:10'),(7,8,'2013-04-16','11:43:39'),(7,9,'2013-04-11','01:58:16'),(7,12,'2013-04-16','00:57:27'),(7,13,'2013-04-11','20:05:11'),(8,12,'2013-04-16','00:56:05');
/*!40000 ALTER TABLE `sw_gjoin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_gpost`
--

DROP TABLE IF EXISTS `sw_gpost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_gpost` (
  `g_id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `u_id` int(5) NOT NULL,
  `d_ate` date NOT NULL,
  `t_ime` time NOT NULL,
  KEY `g_id` (`g_id`),
  KEY `p_id` (`p_id`),
  KEY `u_id` (`u_id`),
  CONSTRAINT `sw_gpost_ibfk_1` FOREIGN KEY (`g_id`) REFERENCES `sw_group` (`g_id`),
  CONSTRAINT `sw_gpost_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `sw_pid` (`p_id`),
  CONSTRAINT `sw_gpost_ibfk_3` FOREIGN KEY (`u_id`) REFERENCES `sw_ulogin` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_gpost`
--

LOCK TABLES `sw_gpost` WRITE;
/*!40000 ALTER TABLE `sw_gpost` DISABLE KEYS */;
INSERT INTO `sw_gpost` VALUES (6,85,10,'2013-04-11','03:26:03'),(6,86,9,'2013-04-11','03:26:34');
/*!40000 ALTER TABLE `sw_gpost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_group`
--

DROP TABLE IF EXISTS `sw_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_group` (
  `g_id` int(10) NOT NULL AUTO_INCREMENT,
  `gp_name` varchar(12) NOT NULL,
  `ct_id` int(10) NOT NULL,
  `descr` longtext,
  `pic_id` int(10) NOT NULL,
  `on_id` int(5) NOT NULL,
  `d_ate` date NOT NULL,
  `t_ime` time NOT NULL,
  PRIMARY KEY (`g_id`),
  KEY `ct_id` (`ct_id`),
  KEY `pic_id` (`pic_id`),
  KEY `on_id` (`on_id`),
  CONSTRAINT `sw_group_ibfk_1` FOREIGN KEY (`ct_id`) REFERENCES `sw_pcategory` (`ct_id`),
  CONSTRAINT `sw_group_ibfk_2` FOREIGN KEY (`pic_id`) REFERENCES `sw_picup` (`pic_id`),
  CONSTRAINT `sw_group_ibfk_3` FOREIGN KEY (`on_id`) REFERENCES `sw_ulogin` (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_group`
--

LOCK TABLES `sw_group` WRITE;
/*!40000 ALTER TABLE `sw_group` DISABLE KEYS */;
INSERT INTO `sw_group` VALUES (3,'Collegates',8,'Group is to connect with your college mates...',22,8,'2013-04-10','19:06:22'),(4,'Chat',9,'Come and chat around the globe....',23,8,'2013-04-10','19:16:19'),(5,'No Name',8,'because we have no group....',25,10,'2013-04-10','23:10:24'),(6,'Season',6,'Season Freaks.....',26,10,'2013-04-11','01:09:15'),(7,'Fringe',6,'Fringe freaks......',28,10,'2013-04-11','01:54:28'),(8,'Simplicity',10,'How simple this world is ... ?',30,12,'2013-04-16','00:55:59');
/*!40000 ALTER TABLE `sw_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_message`
--

DROP TABLE IF EXISTS `sw_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_message` (
  `usend` int(5) NOT NULL,
  `urev_id` int(5) NOT NULL,
  `message` longtext NOT NULL,
  `d_ate` date DEFAULT NULL,
  `t_ime` time DEFAULT NULL,
  KEY `usend` (`usend`),
  KEY `urev_id` (`urev_id`),
  CONSTRAINT `sw_message_ibfk_1` FOREIGN KEY (`usend`) REFERENCES `sw_ulogin` (`u_id`),
  CONSTRAINT `sw_message_ibfk_2` FOREIGN KEY (`urev_id`) REFERENCES `sw_ulogin` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_message`
--

LOCK TABLES `sw_message` WRITE;
/*!40000 ALTER TABLE `sw_message` DISABLE KEYS */;
INSERT INTO `sw_message` VALUES (8,7,'hiii','2013-04-16','09:50:48'),(7,8,'hiii how are you ??','2013-04-16','09:52:48');
/*!40000 ALTER TABLE `sw_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_online`
--

DROP TABLE IF EXISTS `sw_online`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_online` (
  `u_id` int(5) NOT NULL,
  `d_ate` date DEFAULT NULL,
  `t_ime` time DEFAULT NULL,
  UNIQUE KEY `u_id` (`u_id`),
  CONSTRAINT `sw_online_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `sw_ulogin` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_online`
--

LOCK TABLES `sw_online` WRITE;
/*!40000 ALTER TABLE `sw_online` DISABLE KEYS */;
/*!40000 ALTER TABLE `sw_online` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_page`
--

DROP TABLE IF EXISTS `sw_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_page` (
  `page_id` int(5) NOT NULL,
  `u_id` int(5) NOT NULL,
  KEY `page_id` (`page_id`),
  KEY `u_id` (`u_id`),
  CONSTRAINT `sw_page_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `sw_paged` (`page_id`),
  CONSTRAINT `sw_page_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `sw_ulogin` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_page`
--

LOCK TABLES `sw_page` WRITE;
/*!40000 ALTER TABLE `sw_page` DISABLE KEYS */;
INSERT INTO `sw_page` VALUES (8,8),(9,9),(10,8),(11,10);
/*!40000 ALTER TABLE `sw_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_paged`
--

DROP TABLE IF EXISTS `sw_paged`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_paged` (
  `page_id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `ct_id` int(3) NOT NULL,
  `description` longtext,
  `pic_id` int(10) NOT NULL,
  PRIMARY KEY (`page_id`),
  KEY `ct_id` (`ct_id`),
  KEY `pic_id` (`pic_id`),
  CONSTRAINT `sw_paged_ibfk_1` FOREIGN KEY (`ct_id`) REFERENCES `sw_pcategory` (`ct_id`),
  CONSTRAINT `sw_paged_ibfk_2` FOREIGN KEY (`pic_id`) REFERENCES `sw_picup` (`pic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_paged`
--

LOCK TABLES `sw_paged` WRITE;
/*!40000 ALTER TABLE `sw_paged` DISABLE KEYS */;
INSERT INTO `sw_paged` VALUES (8,'Fringe',6,'This is a sci-fi season....',16),(9,'Person of Interest',6,'Best TV series ever found ....',17),(10,'Love',7,'Love.... is ... amazing.....',19),(11,'Fisher',10,'This is a fun page....',24);
/*!40000 ALTER TABLE `sw_paged` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_pcategory`
--

DROP TABLE IF EXISTS `sw_pcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_pcategory` (
  `ct_id` int(3) NOT NULL AUTO_INCREMENT,
  `ct_name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ct_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_pcategory`
--

LOCK TABLES `sw_pcategory` WRITE;
/*!40000 ALTER TABLE `sw_pcategory` DISABLE KEYS */;
INSERT INTO `sw_pcategory` VALUES (6,'Season'),(7,'Love'),(8,'College'),(9,'Chat'),(10,'Fun');
/*!40000 ALTER TABLE `sw_pcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_picup`
--

DROP TABLE IF EXISTS `sw_picup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_picup` (
  `pic_id` int(10) NOT NULL AUTO_INCREMENT,
  `pic` varchar(70) NOT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_picup`
--

LOCK TABLES `sw_picup` WRITE;
/*!40000 ALTER TABLE `sw_picup` DISABLE KEYS */;
INSERT INTO `sw_picup` VALUES (1,'avtar.jpg'),(16,'1365496563page2-img4.jpg'),(17,'1365499590400.jpg'),(18,'1365530381.jpeg'),(19,'1365530460page3-img4.jpg'),(22,'1365600982.jpeg'),(23,'1365601579.jpeg'),(24,'1365614879page1-img11.jpg'),(25,'1365615624.jpeg'),(26,'1365622755.jpeg'),(27,'1365622834.jpeg'),(28,'1365625468.jpeg'),(29,'1365657458.jpeg'),(30,'1366053959.jpeg');
/*!40000 ALTER TABLE `sw_picup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_pid`
--

DROP TABLE IF EXISTS `sw_pid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_pid` (
  `p_id` int(10) NOT NULL AUTO_INCREMENT,
  `post` varchar(200) NOT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `post` (`post`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_pid`
--

LOCK TABLES `sw_pid` WRITE;
/*!40000 ALTER TABLE `sw_pid` DISABLE KEYS */;
INSERT INTO `sw_pid` VALUES (82,'hello....'),(81,'Hii welcome to my page....'),(84,'hiii'),(74,'Hiii ....'),(87,'hiii...'),(83,'Hiiii..'),(76,'how are you ???'),(75,'my name is vikas'),(80,'Rv.......Rv.......Rv.......Rv.......Rv.......Rv.......Rv.......Rv.......\nHello how are you ??? \nRv.......Rv.......Rv.......Rv.......Rv.......Rv.......Rv.......Rv.......'),(85,'This group is open group........'),(77,'welcome to fringe divison...'),(79,'welcome to poi..'),(86,'Welcome to season.......'),(78,'You are being watched...please upload latest episodes.....');
/*!40000 ALTER TABLE `sw_pid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_post`
--

DROP TABLE IF EXISTS `sw_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_post` (
  `usend_id` int(5) NOT NULL,
  `urev_id` int(5) NOT NULL,
  `pid` int(10) NOT NULL,
  `d_ate` date DEFAULT NULL,
  `t_ime` time DEFAULT NULL,
  KEY `usend_id` (`usend_id`),
  KEY `urev_id` (`urev_id`),
  KEY `pid` (`pid`),
  CONSTRAINT `sw_post_ibfk_1` FOREIGN KEY (`usend_id`) REFERENCES `sw_ulogin` (`u_id`),
  CONSTRAINT `sw_post_ibfk_2` FOREIGN KEY (`urev_id`) REFERENCES `sw_ulogin` (`u_id`),
  CONSTRAINT `sw_post_ibfk_3` FOREIGN KEY (`pid`) REFERENCES `sw_pid` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_post`
--

LOCK TABLES `sw_post` WRITE;
/*!40000 ALTER TABLE `sw_post` DISABLE KEYS */;
INSERT INTO `sw_post` VALUES (7,7,74,'2013-04-09','13:32:21'),(8,8,75,'2013-04-09','13:34:37'),(10,10,83,'2013-04-11','01:04:45'),(8,8,87,'2013-04-11','10:37:52'),(12,8,82,'2013-04-16','00:49:49');
/*!40000 ALTER TABLE `sw_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_ppost`
--

DROP TABLE IF EXISTS `sw_ppost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_ppost` (
  `p_id` int(10) NOT NULL,
  `page_id` int(5) NOT NULL,
  `u_id` int(5) NOT NULL,
  `d_ate` date DEFAULT NULL,
  `t_ime` time DEFAULT NULL,
  PRIMARY KEY (`p_id`,`page_id`,`u_id`),
  KEY `page_id` (`page_id`),
  KEY `u_id` (`u_id`),
  CONSTRAINT `sw_ppost_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `sw_pid` (`p_id`),
  CONSTRAINT `sw_ppost_ibfk_2` FOREIGN KEY (`page_id`) REFERENCES `sw_paged` (`page_id`),
  CONSTRAINT `sw_ppost_ibfk_3` FOREIGN KEY (`u_id`) REFERENCES `sw_ulogin` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_ppost`
--

LOCK TABLES `sw_ppost` WRITE;
/*!40000 ALTER TABLE `sw_ppost` DISABLE KEYS */;
INSERT INTO `sw_ppost` VALUES (77,8,9,'2013-04-09','14:06:44'),(78,9,9,'2013-04-09','14:57:12'),(79,9,8,'2013-04-09','18:32:33'),(82,11,10,'2013-04-10','23:03:12');
/*!40000 ALTER TABLE `sw_ppost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_profession`
--

DROP TABLE IF EXISTS `sw_profession`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_profession` (
  `w_id` int(10) NOT NULL AUTO_INCREMENT,
  `profession` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`w_id`),
  UNIQUE KEY `profession` (`profession`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_profession`
--

LOCK TABLES `sw_profession` WRITE;
/*!40000 ALTER TABLE `sw_profession` DISABLE KEYS */;
INSERT INTO `sw_profession` VALUES (2,'CEO'),(3,'fgf'),(1,'Student'),(4,'Sweeper');
/*!40000 ALTER TABLE `sw_profession` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_state`
--

DROP TABLE IF EXISTS `sw_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_state` (
  `s_id` int(4) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(20) NOT NULL,
  PRIMARY KEY (`s_id`),
  UNIQUE KEY `s_name` (`s_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_state`
--

LOCK TABLES `sw_state` WRITE;
/*!40000 ALTER TABLE `sw_state` DISABLE KEYS */;
INSERT INTO `sw_state` VALUES (6,'asf'),(8,'Britain'),(3,'California'),(1,'Haryana'),(4,'Maharashtra'),(7,'Mahrashtra'),(2,'Punjab'),(5,'Rajasthan');
/*!40000 ALTER TABLE `sw_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_ulogin`
--

DROP TABLE IF EXISTS `sw_ulogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_ulogin` (
  `u_id` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  `type` varchar(5) NOT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_ulogin`
--

LOCK TABLES `sw_ulogin` WRITE;
/*!40000 ALTER TABLE `sw_ulogin` DISABLE KEYS */;
INSERT INTO `sw_ulogin` VALUES (7,'sahilgheek30@gmail.com','79273c2875ac872bf08cd87e973ea5e70fcb989c','free'),(8,'vikas17a@gmail.com','e973d86fc168d832d55019848e296c39e6f06bdf','free'),(9,'vikastinkar@gmail.com','e20570ed2a33a90cbc872fee527d7043aed9e4b6','free'),(10,'vikcy@donor.com','e20570ed2a33a90cbc872fee527d7043aed9e4b6','free'),(11,'acb@zc.com','e20570ed2a33a90cbc872fee527d7043aed9e4b6','free'),(12,'rockwidta@yahoo.com','e973d86fc168d832d55019848e296c39e6f06bdf','free'),(13,'a.arora@gmail.com','70d7ca344b3db0d0b598c8b398b89cc415ed2851','free'),(14,'shanewarn@gmail.com','e20570ed2a33a90cbc872fee527d7043aed9e4b6','free');
/*!40000 ALTER TABLE `sw_ulogin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_upload`
--

DROP TABLE IF EXISTS `sw_upload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_upload` (
  `f_id` int(10) NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) DEFAULT NULL,
  `ftype` int(2) NOT NULL,
  `p_ath` varchar(50) NOT NULL,
  `d_ate` date DEFAULT NULL,
  `t_ime` time DEFAULT NULL,
  `u_id` int(5) NOT NULL,
  PRIMARY KEY (`f_id`),
  UNIQUE KEY `p_ath` (`p_ath`),
  KEY `ftype` (`ftype`),
  KEY `u_id` (`u_id`),
  CONSTRAINT `sw_upload_ibfk_1` FOREIGN KEY (`ftype`) REFERENCES `sw_ftype` (`ft_id`),
  CONSTRAINT `sw_upload_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `sw_ulogin` (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_upload`
--

LOCK TABLES `sw_upload` WRITE;
/*!40000 ALTER TABLE `sw_upload` DISABLE KEYS */;
INSERT INTO `sw_upload` VALUES (5,'Array[tmp_name]',1,'1365496644ws_Checkered_1680x1050.jpg','2013-04-09','14:07:24',9),(9,'page1-img12.jpg',1,'1365614515page1-img12.jpg','2013-04-10','22:51:55',10),(10,'page1-img16.jpg',1,'1365622206page1-img16.jpg','2013-04-11','01:00:06',10),(11,'259.jpg',1,'1365622229259.jpg','2013-04-11','01:00:29',10),(12,'325.jpg',1,'1365622237325.jpg','2013-04-11','01:00:37',10),(13,'2.jpg',1,'13656574452.jpg','2013-04-11','10:47:25',11),(14,'00545_newyorkstreets_1680x1050',1,'136609062500545_newyorkstreets_1680x1050.jpg','2013-04-16','11:07:05',12),(15,'10.jpg',1,'136609076810.jpg','2013-04-16','11:09:28',12),(16,'ws_Merry_Christmas_1680x1050.j',1,'1366090777ws_Merry_Christmas_1680x1050.jpg','2013-04-16','11:09:37',12),(17,'0259.jpg',1,'13660907910259.jpg','2013-04-16','11:09:51',12),(19,'page3-img6.jpg',1,'1366091355page3-img6.jpg','2013-04-16','11:19:15',8),(20,'0240.jpg',1,'13660917380240.jpg','2013-04-16','11:25:38',14);
/*!40000 ALTER TABLE `sw_upload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sw_workl`
--

DROP TABLE IF EXISTS `sw_workl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sw_workl` (
  `wl_id` int(10) NOT NULL AUTO_INCREMENT,
  `work_add` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`wl_id`),
  UNIQUE KEY `work_add` (`work_add`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sw_workl`
--

LOCK TABLES `sw_workl` WRITE;
/*!40000 ALTER TABLE `sw_workl` DISABLE KEYS */;
INSERT INTO `sw_workl` VALUES (3,'CBI (fake) '),(6,'College'),(5,'fbv'),(8,'ICC'),(4,'IIT'),(7,'iit bombay'),(1,'LNMIIT'),(2,'SW');
/*!40000 ALTER TABLE `sw_workl` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-16 22:58:58
