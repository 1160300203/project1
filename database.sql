-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: project1
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `BroadCast`
--

DROP TABLE IF EXISTS `BroadCast`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BroadCast` (
  `BroadCastId` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `filmid` int(11) NOT NULL,
  `Houseid` int(11) NOT NULL,
  PRIMARY KEY (`BroadCastId`),
  KEY `filmid` (`filmid`),
  KEY `Houseid` (`Houseid`),
  CONSTRAINT `BroadCast_ibfk_1` FOREIGN KEY (`filmid`) REFERENCES `Film` (`Filmid`),
  CONSTRAINT `BroadCast_ibfk_2` FOREIGN KEY (`Houseid`) REFERENCES `House` (`Houseid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BroadCast`
--

LOCK TABLES `BroadCast` WRITE;
/*!40000 ALTER TABLE `BroadCast` DISABLE KEYS */;
INSERT INTO `BroadCast` VALUES (1,'2015-11-16','12:10:00',1,1),(2,'2015-11-16','13:10:00',1,3),(3,'2015-11-16','12:50:00',2,1),(4,'2015-11-16','13:20:00',2,2);
/*!40000 ALTER TABLE `BroadCast` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Comment`
--

DROP TABLE IF EXISTS `Comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comment` (
  `Commentid` int(11) NOT NULL AUTO_INCREMENT,
  `Comment` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL,
  `filmid` int(11) NOT NULL,
  PRIMARY KEY (`Commentid`),
  KEY `userid` (`userid`),
  KEY `filmid` (`filmid`),
  CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `User` (`userid`),
  CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`filmid`) REFERENCES `Film` (`Filmid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comment`
--

LOCK TABLES `Comment` WRITE;
/*!40000 ALTER TABLE `Comment` DISABLE KEYS */;
INSERT INTO `Comment` VALUES (1,'Good!',123,1),(2,'Very Good!',123,1),(3,'Not so bad.',123,2);
/*!40000 ALTER TABLE `Comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Film`
--

DROP TABLE IF EXISTS `Film`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Film` (
  `Filmid` int(11) NOT NULL AUTO_INCREMENT,
  `FilmName` varchar(50) NOT NULL,
  `Duration` int(11) NOT NULL,
  `Category` int(11) NOT NULL,
  `Language` varchar(20) NOT NULL,
  `Director` varchar(20) NOT NULL,
  PRIMARY KEY (`Filmid`),
  KEY `FilmName` (`FilmName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Film`
--

LOCK TABLES `Film` WRITE;
/*!40000 ALTER TABLE `Film` DISABLE KEYS */;
INSERT INTO `Film` VALUES (1,'Return Of The Cuckoo',103,2,'Cantonese','Patrick Kong'),(2,'Suffragette',106,2,'English','Sarah Gavron');
/*!40000 ALTER TABLE `Film` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HaveWatched`
--

DROP TABLE IF EXISTS `HaveWatched`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HaveWatched` (
  `userid` int(11) NOT NULL,
  `filmid` int(11) NOT NULL,
  KEY `userid` (`userid`),
  KEY `filmid` (`filmid`),
  CONSTRAINT `HaveWatched_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `User` (`userid`),
  CONSTRAINT `HaveWatched_ibfk_2` FOREIGN KEY (`filmid`) REFERENCES `Film` (`Filmid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HaveWatched`
--

LOCK TABLES `HaveWatched` WRITE;
/*!40000 ALTER TABLE `HaveWatched` DISABLE KEYS */;
INSERT INTO `HaveWatched` VALUES (123,1),(123,2);
/*!40000 ALTER TABLE `HaveWatched` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `House`
--

DROP TABLE IF EXISTS `House`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `House` (
  `Houseid` int(11) NOT NULL AUTO_INCREMENT,
  `HouseRow` int(11) NOT NULL,
  `HouseCol` int(11) NOT NULL,
  PRIMARY KEY (`Houseid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `House`
--

LOCK TABLES `House` WRITE;
/*!40000 ALTER TABLE `House` DISABLE KEYS */;
INSERT INTO `House` VALUES (1,10,10),(2,10,10),(3,10,10);
/*!40000 ALTER TABLE `House` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ticket`
--

DROP TABLE IF EXISTS `Ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ticket` (
  `Ticketid` int(11) NOT NULL AUTO_INCREMENT,
  `SeatNo` char(5) NOT NULL,
  `TicketType` int(11) NOT NULL,
  `TicketFee` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `BroadCastId` int(11) NOT NULL,
  PRIMARY KEY (`Ticketid`),
  KEY `userid` (`userid`),
  KEY `BroadCastId` (`BroadCastId`),
  CONSTRAINT `Ticket_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `User` (`userid`),
  CONSTRAINT `Ticket_ibfk_2` FOREIGN KEY (`BroadCastId`) REFERENCES `BroadCast` (`BroadCastId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ticket`
--

LOCK TABLES `Ticket` WRITE;
/*!40000 ALTER TABLE `Ticket` DISABLE KEYS */;
INSERT INTO `Ticket` VALUES (3,'A1',0,75,123,1),(5,'A2',0,75,123,1),(6,'A3',0,75,123,1),(7,'B4',0,75,123,1),(8,'B5',1,50,123,1),(9,'B3',0,75,123,1),(10,'E5',0,75,123,1),(11,'C2',0,75,123,1),(12,'H7',0,75,123,1),(13,'H6',0,75,123,1),(14,'J7',0,75,123,2),(15,'I6',0,75,123,2),(16,'J8',0,75,123,3),(17,'I7',0,75,123,3),(18,'H7',0,75,123,3),(19,'F4',1,50,123,1),(20,'G7',0,75,123,4);
/*!40000 ALTER TABLE `Ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `userid` int(11) NOT NULL,
  `password` char(10) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (123,'12345a');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-19 22:45:34
