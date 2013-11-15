-- MySQL dump 10.13  Distrib 5.5.27, for osx10.6 (i386)
--
-- Host: localhost    Database: the_daily_sportsman
-- ------------------------------------------------------
-- Server version	5.5.27

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (5,'Arsenal sign Messi','2013-11-14','Arsenal have announced the signing of Lionel Messi for a fee of Â£120million from Barcelona.\r\n\r\nThe 26-year-old, a four-time FIFA Ballon d\'Or winner, has signed a seven-year contract and is reported to earn a weekly salary of Â£300,000.\r\n\r\nArsenal boss Arsene Wenger had expressed his desire to bring Argentine Messi, who has 83 caps for his country, in the summer, before embarking on a lengthy campaign to sign the Barcelona striker.'),(6,'Bulls crowned champions','2013-11-13','Hereford United have been crowned champions of the Skrill Premier after a 4-0 away win at Lincoln City.\r\n\r\nThe Bulls, who had already guaranteed a top-two finish before Saturday\'s match at Sincil Bank, have secured a return to the Football League after a two-year absence.\r\n\r\nGoals from strikers Michael Rankine (2) and Sam Smith sandwiched a Danny Pilkington solo effort and secured the three-points the newly crowned champions required to lift the league title.'),(7,'Root century secures Ashes test victory','2013-11-13','A fine century from English batsman Joe Root proved to be the catalyst for England to chase down the 311 runs required to win the first of the five Ashes tests down under.\r\n\r\nRoot, 22, opened the batting with captain Alastair Cook and passed his half century off just 70 deliveries, before going on to reach 117 not out as the Yorkshireman and wicketkeeper Jonny Bairstow, deputising for the injured Matt Prior, were left to secure the winning runs.\r\n\r\nAustralia, bowled out for 286 in their second innings, bowled poorly, despite Mitchell Johnson taking 3-58. Peter Siddle was wayward whilst Ryan Harris, normally a tight, wicket-to-wicket bowler, leaked too many runs.'),(8,'England through to World Cup final','2013-11-05','England are through to only their second ever World Cup final after a 3-0 demolition of arch-rivals Germany in SÃ£o Paulo\'s semi-final.\r\n\r\nA Wayne Rooney penalty just 7 minutes into the match set the tone for the match as Germany failed to respond to England\'s aggressive, swift attacking style of play.\r\n\r\nJack Wilshere made it 2-0 moments before half-time with a wonderful solo effort, before the victory was sealed 12 minutes from time as Wilshere\'s Arsenal team mate Theo Walcott swept home a counter-attack after Germany failed to threaten with a corner of their own.\r\n\r\nEngland will meet the victor of the second semi-final, either Spain or hosts Brazil. Atletico Madrid star Diego Costa is set to go head-to-head with his country of birth for the first time since switching his allegiance to the country where he has played his club football for over 7 years.');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-15  1:26:34
