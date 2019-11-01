/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.36-MariaDB : Database - topsis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`topsis` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `topsis`;

/*Table structure for table `top_alternatif_handphone` */

DROP TABLE IF EXISTS `top_alternatif_handphone`;

CREATE TABLE `top_alternatif_handphone` (
  `id_alternatif` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `alternatif` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_alternatif`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `top_alternatif_handphone` */

insert  into `top_alternatif_handphone`(`id_alternatif`,`alternatif`,`gambar`,`deskripsi`) values (1,'Xiaomi','assets/img/xiaomi.jpg','Xiaomi adalah Handphone made in Cina'),(2,'Asus','assets/img/asus.jpg','Asus adalah Handphone made in Cina'),(3,'Samsung','assets/img/samsung.jpg','Samsung adalah Handphone made in Cina'),(4,'Huawei','assets/img/huawei.jpg','Huawei adalah Handphone made in Cina'),(5,'Nokia','assets/img/nokia.jpg','Nokia adalah Handphone made in Cina'),(6,'Iphone','assets/img/iphone.jpg','Iphone adalah Handphone made in Cina'),(7,'Meizu','assets/img/meizu.jpg','Meizu adalah Handphone made in Cina'),(8,'Realme','assets/img/realme.jpg','Realme adalah Handphone made in Cina'),(9,'Oppo','assets/img/oppo.jpg','Oppo adalah Handphone made in Cina'),(10,'Vivo','assets/img/vivo.jpg','Vivo adalah Handphone made in Cina');

/*Table structure for table `top_alternatif_makanan` */

DROP TABLE IF EXISTS `top_alternatif_makanan`;

CREATE TABLE `top_alternatif_makanan` (
  `id_alternatif` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `alternatif` varchar(100) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_alternatif`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `top_alternatif_makanan` */

insert  into `top_alternatif_makanan`(`id_alternatif`,`alternatif`,`gambar`,`deskripsi`) values (1,'Lontong Balap','assets/img/lontong-balap.jpg','Lontong balap adalah makanan khas Indonesia yang merupakan ciri khas kota Surabaya di Jawa Timur.'),(2,'Rujak Cingur','assets/img/rujak-cingur.jpg','Rujak cingur adalah makanan khas Indonesia yang merupakan ciri khas kota Surabaya di Jawa Timur.'),(3,'Tahu Campur','assets/img/tahu-campur.jpg','Tahu campur adalah makanan khas Indonesia yang merupakan ciri khas kota Surabaya di Jawa Timur.'),(4,'Sate','assets/img/sate.jpg','Sate adalah makanan khas Indonesia yang merupakan ciri khas kota Surabaya di Jawa Timur.'),(5,'Sego Sambel','assets/img/sego-sambel.jpg','Sego sambel adalah makanan khas Indonesia yang merupakan ciri khas kota Surabaya di Jawa Timur.'),(6,'Nasi Goreng','assets/img/nasi-goreng.jpg','Nasi goreng adalah makanan khas Indonesia yang merupakan ciri khas kota Surabaya di Jawa Timur.'),(7,'Tahu Telor','assets/img/tahu-telor.jpg','Tahu Telor adalah makanan khas Indonesia yang merupakan ciri khas kota Surabaya di Jawa Timur.'),(8,'Rawon','assets/img/rawon.jpg','Rawon adalah makanan khas Indonesia yang merupakan ciri khas kota Surabaya di Jawa Timur.'),(9,'Pecel','assets/img/pecel.jpg','Pecel adalah makanan khas Indonesia yang merupakan ciri khas kota Surabaya di Jawa Timur.'),(10,'Bebek','assets/img/bebek.jpg','Bebek adalah makanan khas Indonesia yang merupakan ciri khas kota Surabaya di Jawa Timur.');

/*Table structure for table `top_kriteria_handphone` */

DROP TABLE IF EXISTS `top_kriteria_handphone`;

CREATE TABLE `top_kriteria_handphone` (
  `id_kriteria` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `kriteria` varchar(100) NOT NULL,
  `bobot` float NOT NULL,
  `tipe` set('max','min') NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `top_kriteria_handphone` */

insert  into `top_kriteria_handphone`(`id_kriteria`,`kriteria`,`bobot`,`tipe`) values (1,'harga',30,'min'),(2,'procesor',20,'max'),(3,'kamera',15,'max'),(4,'memory',10,'max');

/*Table structure for table `top_kriteria_makanan` */

DROP TABLE IF EXISTS `top_kriteria_makanan`;

CREATE TABLE `top_kriteria_makanan` (
  `id_kriteria` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `kriteria` varchar(100) NOT NULL,
  `bobot` float NOT NULL,
  `tipe` set('max','min') NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `top_kriteria_makanan` */

insert  into `top_kriteria_makanan`(`id_kriteria`,`kriteria`,`bobot`,`tipe`) values (1,'harga',30,'min'),(2,'rasa',15,'max'),(3,'bergizi',20,'max'),(4,'higenis',15,'max');

/*Table structure for table `top_sample_handphone` */

DROP TABLE IF EXISTS `top_sample_handphone`;

CREATE TABLE `top_sample_handphone` (
  `id_sample` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_alternatif` tinyint(3) unsigned NOT NULL,
  `id_kriteria` tinyint(3) unsigned NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`id_sample`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `top_sample_handphone` */

insert  into `top_sample_handphone`(`id_sample`,`id_alternatif`,`id_kriteria`,`nilai`) values (1,1,1,8),(2,1,2,8),(3,1,3,7),(4,1,4,9),(5,2,1,5),(6,2,2,6),(7,2,3,8),(8,2,4,8),(9,3,1,4),(10,3,2,3),(11,3,3,3),(12,3,4,2),(13,4,1,7),(14,4,2,7),(15,4,3,8),(16,4,4,8),(17,5,1,4),(18,5,2,4),(19,5,3,3),(20,5,4,2),(21,6,1,5),(22,6,2,4),(23,6,3,4),(24,6,4,4),(25,7,1,3),(26,7,2,5),(27,7,3,4),(28,7,4,2),(29,8,1,7),(30,8,2,8),(31,8,3,7),(32,8,4,8),(33,9,1,2),(34,9,2,5),(35,9,3,5),(36,9,4,2),(37,10,1,6),(38,10,2,2),(39,10,3,2),(40,10,4,5);

/*Table structure for table `top_sample_makanan` */

DROP TABLE IF EXISTS `top_sample_makanan`;

CREATE TABLE `top_sample_makanan` (
  `id_sample` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_alternatif` tinyint(3) unsigned NOT NULL,
  `id_kriteria` tinyint(3) unsigned NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`id_sample`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `top_sample_makanan` */

insert  into `top_sample_makanan`(`id_sample`,`id_alternatif`,`id_kriteria`,`nilai`) values (1,1,1,2),(2,1,2,5),(3,1,3,4),(4,1,4,2),(5,2,1,3),(6,2,2,3),(7,2,3,5),(8,2,4,4),(9,3,1,4),(10,3,2,3),(11,3,3,3),(12,3,4,2),(13,4,1,3),(14,4,2,5),(15,4,3,5),(16,4,4,5),(17,5,1,4),(18,5,2,4),(19,5,3,3),(20,5,4,2),(21,6,1,5),(22,6,2,4),(23,6,3,4),(24,6,4,4),(25,7,1,3),(26,7,2,5),(27,7,3,4),(28,7,4,2),(29,8,1,2),(30,8,2,6),(31,8,3,4),(32,8,4,5),(33,9,1,2),(34,9,2,5),(35,9,3,5),(36,9,4,2),(37,10,1,6),(38,10,2,2),(39,10,3,2),(40,10,4,5);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
