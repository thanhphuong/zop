/*
SQLyog Ultimate v8.61 
MySQL - 5.5.25a : Database - zop
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`zop` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `zop`;

/*Table structure for table `zop_account` */

DROP TABLE IF EXISTS `zop_account`;

CREATE TABLE `zop_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(30) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `full_name` varchar(60) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `gender` int(1) NOT NULL,
  `birthday` date NOT NULL,
  `avatar` varchar(30) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

/*Data for the table `zop_account` */

insert  into `zop_account`(`id`,`pid`,`email`,`phone`,`password`,`full_name`,`first_name`,`last_name`,`gender`,`birthday`,`avatar`,`status`,`created_date`,`updated_date`) values (5,NULL,'x',NULL,'g','a','a',' c',1,'1997-10-17',NULL,0,'2012-10-28 13:19:02',NULL),(6,NULL,'v',NULL,'x','b','v','x',1,'1996-10-17',NULL,0,'2012-10-28 13:23:42',NULL),(7,NULL,'wer@yahoo.com',NULL,'ae','c','wer','wer',1,'1997-11-17',NULL,0,'2012-10-28 13:54:52',NULL),(8,NULL,'Wer1@yahoo.com',NULL,'dfgdg','d','fg','dfg',0,'1995-11-17',NULL,0,'2012-10-28 23:32:50',NULL),(9,NULL,'dfg@yahoo.com',NULL,'ggdgf','f','dfg','dgdg',1,'1996-11-17',NULL,0,'2012-10-28 23:33:54',NULL),(10,NULL,'sadf@yahoo.com',NULL,'23','g','adf','sdf',1,'1996-11-16',NULL,0,'2012-10-28 23:38:59',NULL),(11,NULL,'sadf1@yahoo.com',NULL,'dsfgdg','s','sdf','df',1,'1996-11-17',NULL,0,'2012-10-28 23:57:08',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
