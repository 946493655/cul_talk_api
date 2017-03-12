-- MySQL dump 10.13  Distrib 5.6.27, for Linux (i686)
--
-- Host: localhost    Database: cul_talk
-- ------------------------------------------------------
-- Server version	5.6.27

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '类别名称',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `intro` varchar(255) NOT NULL COMMENT '内容',
  `pid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '父类别',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '类别对应专栏id',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='专栏表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'三维系列',0,'特效之三维软件制作系列：',0,2,1489129886,1489130926),(2,'合成系列',0,'特效之合成软件：',0,2,1489131373,1489131390),(3,'剪辑系列',0,'视频剪辑画面处理：',0,2,1489131676,0),(4,'宣传片',0,'样片之宣传片',0,3,1489131810,0),(5,'广告片',0,'样片之广告',0,3,1489131842,0),(6,'微电影',0,'样片之微电影',0,3,1489131859,0),(7,'UI设计',0,'',0,4,1489132121,0),(8,'前端',0,'网站之前端制作',0,4,1489132722,0),(9,'程序',0,'网站制作之程序开发',0,4,1489132785,0),(10,'阅历',0,'',0,5,1489134747,0),(11,'事业',0,'',0,5,1489134774,0),(12,'生活',0,'',0,5,1489134787,0),(13,'点滴',0,'',0,5,1489134803,0);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `talks`
--

DROP TABLE IF EXISTS `talks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `talks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '名称',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题主题id',
  `cate` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '类别id',
  `intro` varchar(1000) NOT NULL COMMENT '创意内容',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布的用户id',
  `uname` varchar(50) NOT NULL COMMENT '用户名称',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级id',
  `read` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '是否显示：1不显示，2显示',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='话题表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `talks`
--

LOCK TABLES `talks` WRITE;
/*!40000 ALTER TABLE `talks` DISABLE KEYS */;
INSERT INTO `talks` VALUES (1,'模型制作',2,0,'12345',1,'jiuge',0,0,10,2,1489323321,0);
/*!40000 ALTER TABLE `talks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `talks_click`
--

DROP TABLE IF EXISTS `talks_click`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `talks_click` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `talkid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录用户id',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题点赞表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `talks_click`
--

LOCK TABLES `talks_click` WRITE;
/*!40000 ALTER TABLE `talks_click` DISABLE KEYS */;
/*!40000 ALTER TABLE `talks_click` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `talks_collect`
--

DROP TABLE IF EXISTS `talks_collect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `talks_collect` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `talkid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录用户id',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题收藏表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `talks_collect`
--

LOCK TABLES `talks_collect` WRITE;
/*!40000 ALTER TABLE `talks_collect` DISABLE KEYS */;
/*!40000 ALTER TABLE `talks_collect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `talks_follow`
--

DROP TABLE IF EXISTS `talks_follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `talks_follow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `talkid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录用户id',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题关注表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `talks_follow`
--

LOCK TABLES `talks_follow` WRITE;
/*!40000 ALTER TABLE `talks_follow` DISABLE KEYS */;
/*!40000 ALTER TABLE `talks_follow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '名称',
  `intro` varchar(255) NOT NULL COMMENT '内容',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '10' COMMENT '排序',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='专栏表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` VALUES (1,'自由话题','用户自定义类别的话题',11,1489106688,1489125475),(2,'图形软件','影视制作的一系列软件',14,1489106739,1489125443),(3,'视频作品','关于视频成品的话题',13,1489106943,1489125448),(4,'网站设计','关于网站制作、技术方面的探讨',12,1489106988,1489125470),(5,'人生足迹','可以记录个人的人生阅历',10,1489123170,0);
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-12 21:07:27
