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


/*Table structure for table `zop_account` */

DROP TABLE IF EXISTS `zop_account`;

CREATE TABLE `zop_account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `full_name` varchar(60) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `gender` int(1) NOT NULL,
  `birthday` date NOT NULL,
  `avatar` varchar(30) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `zop_account` */

insert  into `zop_account`(`id`,`pid`,`email`,`phone`,`password`,`full_name`,`first_name`,`last_name`,`gender`,`birthday`,`avatar`,`status`,`created_date`,`updated_date`) values (1,1001,'btphuong2345@yahoo.com',NULL,'755de30edbc2c7356743a18292dc360b','Bùi Thanh Phương','Bùi','Thanh Phương',2,'1995-11-17',NULL,1,'2012-12-27 09:21:14','2012-12-27 09:21:14'),(2,90827,'btphuong2345@gmail.com',NULL,'755de30edbc2c7356743a18292dc360b','Bùi Thanh Phương','Bùi','Thanh Phương',2,'1995-11-17',NULL,0,'2012-12-27 09:23:41',NULL);

/*Table structure for table `zop_location` */

DROP TABLE IF EXISTS `zop_location`;

CREATE TABLE `zop_location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `altitude` double DEFAULT NULL,
  `accuracy` float DEFAULT NULL,
  `speed` float DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  CONSTRAINT `FK_zop_location` FOREIGN KEY (`pid`) REFERENCES `zop_account` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `zop_location` */

insert  into `zop_location`(`id`,`pid`,`time`,`latitude`,`longitude`,`altitude`,`accuracy`,`speed`,`created_date`) values (2,1001,'2012-12-27 09:50:11',10,106,NULL,0,NULL,'2012-12-27 09:51:19'),(3,1001,'2012-12-27 09:50:12',-3.776559,121.984862,NULL,NULL,NULL,'2012-12-27 16:31:46');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
