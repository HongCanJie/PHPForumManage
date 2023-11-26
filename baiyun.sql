-- MySQL dump 10.13  Distrib 5.7.31, for Win64 (x86_64)
--
-- Host: localhost    Database: baiyun
-- ------------------------------------------------------
-- Server version	5.7.31

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
-- Table structure for table `tbl_board`
--

DROP TABLE IF EXISTS `tbl_board`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_board` (
  `boardId` int(11) NOT NULL AUTO_INCREMENT COMMENT '版块编号',
  `boardName` varchar(50) NOT NULL COMMENT '版块名',
  `parentId` int(11) NOT NULL COMMENT '父版块编号',
  PRIMARY KEY (`boardId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_board`
--

LOCK TABLES `tbl_board` WRITE;
/*!40000 ALTER TABLE `tbl_board` DISABLE KEYS */;
INSERT INTO `tbl_board` VALUES (1,'.NET技术',0),(2,'Java技术',0),(3,'PHP技术',0),(4,'C#语言',1),(5,'WinForms',1),(6,'ADO.NET',1),(7,'Java基础',2),(8,'JSP技术',2),(9,'Servelt技术',2),(10,'Eclipse应用',2),(11,'PHP基础',3),(12,'MySQL',3),(13,'灌水乐园',14);
/*!40000 ALTER TABLE `tbl_board` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reply`
--

DROP TABLE IF EXISTS `tbl_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_reply` (
  `replyId` int(11) NOT NULL AUTO_INCREMENT COMMENT '回帖编号',
  `replyTitle` varchar(50) NOT NULL COMMENT '回帖标题',
  `replyContent` varchar(1000) NOT NULL COMMENT '回帖内容',
  `replyPublishTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '回帖时间',
  `replyModifyTime` timestamp NULL DEFAULT NULL COMMENT '回帖修改时间',
  `topicId` int(11) NOT NULL COMMENT '帖子编号',
  `uId` int(11) NOT NULL COMMENT '用户编号',
  PRIMARY KEY (`replyId`),
  KEY `FK_TID` (`topicId`),
  KEY `FK_UID` (`uId`),
  CONSTRAINT `tbl_reply_ibfk_1` FOREIGN KEY (`topicId`) REFERENCES `tbl_topic` (`topicId`),
  CONSTRAINT `tbl_reply_ibfk_2` FOREIGN KEY (`uId`) REFERENCES `tbl_user` (`uId`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reply`
--

LOCK TABLES `tbl_reply` WRITE;
/*!40000 ALTER TABLE `tbl_reply` DISABLE KEYS */;
INSERT INTO `tbl_reply` VALUES (1,'不为谁而作的歌','原谅我这一首，不为谁而作的歌。','2021-09-25 13:29:53','2021-12-22 01:07:29',1,1),(2,'画','我把你化成画，未开的一朵花','2021-09-25 13:29:53','2021-12-22 01:07:32',2,2),(5,'倔强','我和我最后的倔强','2021-10-22 08:34:31','2021-12-22 01:07:35',3,2),(6,'稻香','随着河流和稻香继续奔跑','2021-10-22 08:36:21','2021-12-22 01:07:40',4,2),(7,'青花瓷','天青色等烟雨，而我在等你','2021-10-22 08:37:07','2021-12-22 01:07:43',5,2),(8,'反向的钟','所有回忆都对我进攻','2021-10-22 08:38:10','2021-12-22 01:07:46',1,5),(9,'离人愁','今夜断了肠，今天各一方','2021-10-22 01:01:07','2021-10-22 01:01:07',3,6),(13,'世间美好与你环环相扣','偏偏秉烛夜游，午夜星辰似奔走之友','2021-10-22 00:59:43','2021-12-22 01:07:50',2,3),(23,'111','3rfdfdhf','2021-12-21 03:37:56','2021-12-21 03:37:56',4,7),(25,'晴天','故事的小黄花，从出生那年就飘着','2021-12-21 03:49:35','2021-12-22 01:07:53',5,7),(27,'testtest','testest','2021-12-21 17:06:45','2021-12-21 17:06:45',4,7);
/*!40000 ALTER TABLE `tbl_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_topic`
--

DROP TABLE IF EXISTS `tbl_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_topic` (
  `topicId` int(11) NOT NULL AUTO_INCREMENT COMMENT '帖子编号',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `content` varchar(1000) NOT NULL COMMENT '帖子内容',
  `publishTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发帖时间',
  `modifyTime` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  `uId` int(11) NOT NULL COMMENT '用户编号',
  `boardId` int(11) NOT NULL COMMENT '版本编号',
  PRIMARY KEY (`topicId`),
  KEY `FK_UID` (`uId`),
  KEY `FK_BID` (`boardId`),
  CONSTRAINT `tbl_topic_ibfk_1` FOREIGN KEY (`uId`) REFERENCES `tbl_user` (`uId`),
  CONSTRAINT `tbl_topic_ibfk_2` FOREIGN KEY (`boardId`) REFERENCES `tbl_board` (`boardId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_topic`
--

LOCK TABLES `tbl_topic` WRITE;
/*!40000 ALTER TABLE `tbl_topic` DISABLE KEYS */;
INSERT INTO `tbl_topic` VALUES (1,'一个测试','测试插入帖子的内容','2021-09-25 13:06:59','2021-12-22 01:08:00',1,1),(2,'白云之歌','白云白云飞满天，满天飘着青春的誓言。。','2021-09-25 13:16:21','2021-12-22 01:08:02',2,2),(3,'逃与追','hahahahahaha','2021-09-25 13:16:21','2021-10-21 01:15:50',3,3),(4,'倔强','下一站是不是天堂，就算失望不能绝望！','2021-09-25 13:17:23','2021-12-22 01:08:04',4,4),(5,'国王与乞丐','抱紧你的我~比国王富有。曾多么快乐。','2021-10-21 00:51:52','2021-12-22 01:08:07',5,5),(6,'给我一首歌的时间','能不能给我一首歌的时间','2021-11-10 14:24:20','2021-12-22 01:08:12',6,6),(7,'送别','长亭外，古道边','2021-11-10 14:25:08','2021-12-22 01:08:14',7,7),(8,'鸽子','美丽的鸽子鸽子我喜欢你','2021-11-10 14:25:45','2021-12-22 01:08:17',2,8),(9,'茉莉花','好一朵美丽的茉莉花','2021-11-10 14:26:27','2021-12-22 01:08:20',1,9),(10,'平凡之路','我曾今快过山河和大海','2021-11-10 14:28:16','2021-12-22 01:08:23',1,10),(11,'离人愁','今夜断了肠，今各一方','2021-11-10 14:29:27','2021-12-22 01:08:25',2,11),(12,'出山','在夜半三更过天桥，从来不敢回头看','2021-11-10 14:30:19','2021-12-22 01:08:27',1,12),(13,'兄弟抱一下','兄弟抱一下，说说你心里话','2021-11-10 14:31:03','2021-12-22 01:08:29',2,13),(14,'test1','test1','2021-12-21 16:36:04','2021-12-22 01:08:32',7,4),(15,'test2','test2','2021-12-21 16:36:19','2021-12-22 01:08:35',7,4),(16,'test3','test3','2021-12-21 16:36:36','2021-12-22 01:08:41',7,4),(17,'1223','2324','2021-12-21 16:57:12','2021-12-22 01:08:44',7,4),(18,'34565','35465','2021-12-21 17:01:10','2021-12-22 01:08:46',7,4),(19,'test','testtest','2021-12-21 17:07:14','2021-12-21 17:07:14',7,4);
/*!40000 ALTER TABLE `tbl_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `uId` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户编号',
  `uName` varchar(50) NOT NULL COMMENT '用户名',
  `uPass` varchar(32) NOT NULL,
  `head` varchar(50) NOT NULL COMMENT '头像',
  `regTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `gender` smallint(6) NOT NULL COMMENT '性别',
  PRIMARY KEY (`uId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'小明','e10adc3949ba59abbe56e057f20f883e','1.gif','2021-09-25 12:30:41',1),(2,'小兰','e10adc3949ba59abbe56e057f20f883e','2.gif','2021-09-25 12:34:10',2),(3,'小白','e10adc3949ba59abbe56e057f20f883e','3.gif','2021-09-25 12:38:10',1),(4,'小黑','e10adc3949ba59abbe56e057f20f883e','3.gif','2021-12-14 02:29:33',1),(5,'小李','e10adc3949ba59abbe56e057f20f883e','5.gif','2021-09-25 12:38:25',1),(6,'小红','e10adc3949ba59abbe56e057f20f883e','6.gif','2021-09-25 12:38:31',2),(7,'小张','827ccb0eea8a706c4c34a16891f84e7b','7--刺客伍六七.jpg','2021-12-21 16:58:44',1),(9,'1','e10adc3949ba59abbe56e057f20f883e','2.gif','2022-12-10 22:55:32',1),(15,'小洪','fcea920f7412b5da7be0cf42b8c93759','7.gif','2022-12-10 23:53:19',1);
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-11 16:10:43
