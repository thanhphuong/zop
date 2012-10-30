/*
SQLyog Ultimate v8.61 
MySQL - 5.5.25a : Database - zop
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`zop` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `zop`;

/*Table structure for table `zop_account` */

DROP TABLE IF EXISTS `zop_account`;

CREATE TABLE `zop_account` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PID` varchar(30) DEFAULT NULL,
  `Email` varchar(200) NOT NULL,
  `Phone` varchar(30) DEFAULT NULL,
  `Password` varchar(30) DEFAULT NULL,
  `Full_Name` varchar(60) NOT NULL,
  `First_Name` varchar(30) NOT NULL,
  `Last_Name` varchar(30) NOT NULL,
  `Gender` int(1) NOT NULL,
  `Birthday` date NOT NULL,
  `Avatar` varchar(30) DEFAULT NULL,
  `Status` int(11) NOT NULL,
  `Created_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_Date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Data for the table `zop_account` */

insert  into `zop_account`(`ID`,`PID`,`Email`,`Phone`,`Password`,`Full_Name`,`First_Name`,`Last_Name`,`Gender`,`Birthday`,`Avatar`,`Status`,`Created_Date`,`Updated_Date`) values (5,NULL,'x',NULL,'g','a','a',' c',1,'1997-10-17',NULL,0,'2012-10-28 13:19:02',NULL),(6,NULL,'v',NULL,'x','b','v','x',1,'1996-10-17',NULL,0,'2012-10-28 13:23:42',NULL),(7,NULL,'wer@yahoo.com',NULL,'ae','c','wer','wer',1,'1997-11-17',NULL,0,'2012-10-28 13:54:52',NULL),(8,NULL,'Wer1@yahoo.com',NULL,'dfgdg','d','fg','dfg',0,'1995-11-17',NULL,0,'2012-10-28 23:32:50',NULL),(9,NULL,'dfg@yahoo.com',NULL,'ggdgf','f','dfg','dgdg',1,'1996-11-17',NULL,0,'2012-10-28 23:33:54',NULL),(10,NULL,'sadf@yahoo.com',NULL,'23','g','adf','sdf',1,'1996-11-16',NULL,0,'2012-10-28 23:38:59',NULL),(11,NULL,'sadf1@yahoo.com',NULL,'dsfgdg','s','sdf','df',1,'1996-11-17',NULL,0,'2012-10-28 23:57:08',NULL),(34,NULL,'btphuong2345@yahoo.com',NULL,'827ccb0eea8a706c4c34a16891f84e','Bui Thanh Phuong','Bui','Thanh Phuong',1,'1996-10-17',NULL,0,'2012-10-31 01:41:59',NULL),(35,'63494','btphuong2345@yahoo.com',NULL,'827ccb0eea8a706c4c34a16891f84e','Bui Thanh Phuong','Bui','Thanh Phuong',1,'1996-10-17',NULL,0,'2012-10-31 01:41:59',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
