/*
SQLyog Enterprise - MySQL GUI v6.13
MySQL - 5.5.5-10.1.16-MariaDB : Database - mer_system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `mer_system`;

USE `mer_system`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `beneficiaries` */

DROP TABLE IF EXISTS `beneficiaries`;

CREATE TABLE `beneficiaries` (
  `beneficiary_id` varchar(50) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `business_name` text,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `contactno` varchar(20) DEFAULT NULL,
  `registeredby` varchar(100) DEFAULT NULL,
  `createdby` varchar(100) DEFAULT NULL,
  `modon` varchar(50) DEFAULT NULL,
  `modby` varchar(50) DEFAULT NULL,
  `createdat` varchar(50) DEFAULT NULL,
  `timeadded` decimal(20,0) DEFAULT NULL,
  PRIMARY KEY (`beneficiary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `beneficiaries` */

/*Table structure for table `beneficiaries_categories` */

DROP TABLE IF EXISTS `beneficiaries_categories`;

CREATE TABLE `beneficiaries_categories` (
  `id` varchar(20) NOT NULL,
  `beneficiary_id` varchar(20) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `district` text,
  `community` text,
  `longitude` varchar(30) DEFAULT NULL,
  `latitude` varchar(30) DEFAULT NULL,
  `classification` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `beneficiaries_categories` */

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_code` varchar(20) DEFAULT NULL,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `category` */

/*Table structure for table `descriptions` */

DROP TABLE IF EXISTS `descriptions`;

CREATE TABLE `descriptions` (
  `id` int(11) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `descriptions` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
