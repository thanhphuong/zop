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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` varchar(30) DEFAULT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `zop_account` */

insert  into `zop_account`(`id`,`pid`,`email`,`phone`,`password`,`full_name`,`first_name`,`last_name`,`gender`,`birthday`,`avatar`,`status`,`created_date`,`updated_date`) values (7,'48658','btphuong2345@yahoo.com',NULL,'cab47add236cbd300fd86e668e51e0','Bùi Thanh Phương','Bùi','Thanh Phương',2,'1996-04-16',NULL,0,'2012-11-02 09:38:34',NULL);

/*Table structure for table `zop_device` */

DROP TABLE IF EXISTS `zop_device`;

CREATE TABLE `zop_device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `zop_device` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
