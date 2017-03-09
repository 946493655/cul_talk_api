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
  `name` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题id',
  `intro` varchar(255) NOT NULL COMMENT '内容',
  `pid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '父类别',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='专栏表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
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
  `name` varchar(255) NOT NULL COMMENT '名称',
  `themeid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题主题id',
  `intro` varchar(2000) NOT NULL COMMENT '创意内容',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布的用户id',
  `uname` varchar(50) NOT NULL COMMENT '用户名称',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级id',
  `read` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='话题表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `talks`
--

LOCK TABLES `talks` WRITE;
/*!40000 ALTER TABLE `talks` DISABLE KEYS */;
INSERT INTO `talks` VALUES (1,'话题1',0,'<p>而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表</p>',1,'',0,0,10,0,20160417,20160417),(2,'话题2 222',0,'<p>不服该办法呢GV热豆腐还不太高和今年投入富家女我我的是女附近的八个人工我可v别沮丧的v比对方不能交电费表肯定是你鄙视吧v那地方就不能hiu二个IE人根据IE如何隔日给举动被GV的人覅偶包过户的人发货不固定不v个is独具不</p><p>55555555555555555555555555555</p>',1,'',0,0,10,0,20160419,1482905650),(3,'话题3333333',0,'<p>               这里可以排版文字，插入或粘贴图片\r\n     </p><p>5151516515615165156165561562626516516515       </p>',1,'',0,0,10,0,20160422,1482905518);
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
-- Table structure for table `theme待删除`
--

DROP TABLE IF EXISTS `theme待删除`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme待删除` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '主题名称',
  `intro` varchar(255) NOT NULL COMMENT '内容说明',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id，0代表默认专栏',
  `uname` varchar(50) NOT NULL COMMENT '用户名称',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站：0不删除，1删除',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='话题主题表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme待删除`
--

LOCK TABLES `theme待删除` WRITE;
/*!40000 ALTER TABLE `theme待删除` DISABLE KEYS */;
INSERT INTO `theme待删除` VALUES (1,'视频制作','<p>视频视频视频视频视频视频视频上视频拍摄拍视频视频视频视频视频上刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏是视频视频视频视频说啪啪啪啪啪啪啪啪啪刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏刷屏视频视频视频视频上视频拍摄拍视频视频视频视频视频上</p>',0,'本站',10,0,1470905599,1482913014),(2,'屏幕','<p>无法对被告人不服管</p>',0,'',10,0,1470972254,0),(3,'测试1226','匿名购买父母',0,'本站',10,0,1482910711,1482912952);
/*!40000 ALTER TABLE `theme待删除` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题id',
  `intro` varchar(255) NOT NULL COMMENT '内容',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='专栏表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
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

-- Dump completed on 2017-03-09 16:49:09
