-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: e_learning
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.16.04.1

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
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_admin` (
  `id_admin` varchar(45) NOT NULL,
  `nama_admin` varchar(45) DEFAULT NULL,
  `password` text,
  `active` enum('true','false') DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admin`
--

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` VALUES ('60900114063','Andi Akbar','2fCzXHvsnodK4kd1OWvLEJVIuUXd0DZvn7pLpw03C4p0r7EfloFHCcZ2t66gvdztMlLIi154kbjyc~QYiwS5fQ--','true','60900114063.png');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_guru`
--

DROP TABLE IF EXISTS `tbl_guru`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_guru` (
  `id_guru` varchar(45) NOT NULL,
  `nama_guru` varchar(45) DEFAULT NULL,
  `password` text,
  `active` enum('true','false') DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_guru`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_guru`
--

LOCK TABLES `tbl_guru` WRITE;
/*!40000 ALTER TABLE `tbl_guru` DISABLE KEYS */;
INSERT INTO `tbl_guru` VALUES ('60900114064','Hermansyah','UtC9~6QDQZbyZZzNPEb30RXSbzXvNZofOlX4cC9dIk5cZYxIODY8pnMp8FPvxi9RodtcY0INToRmYp1Inzcfig--','true','60900114064.jpg');
/*!40000 ALTER TABLE `tbl_guru` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mapel`
--

DROP TABLE IF EXISTS `tbl_mapel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mapel` (
  `id_mapel` varchar(24) NOT NULL,
  `nama_mapel` varchar(45) DEFAULT NULL,
  `id_guru` varchar(45) DEFAULT NULL,
  `slug` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mapel`),
  UNIQUE KEY `index2` (`id_guru`),
  CONSTRAINT `fk_tbl_mapel_1` FOREIGN KEY (`id_guru`) REFERENCES `tbl_guru` (`id_guru`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mapel`
--

LOCK TABLES `tbl_mapel` WRITE;
/*!40000 ALTER TABLE `tbl_mapel` DISABLE KEYS */;
INSERT INTO `tbl_mapel` VALUES ('BHS-IDO','Bahasa Indonesia','60900114064','bahasa-indonesia.html');
/*!40000 ALTER TABLE `tbl_mapel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_materi`
--

DROP TABLE IF EXISTS `tbl_materi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_materi` (
  `id_materi` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(45) DEFAULT NULL,
  `materi` varchar(45) DEFAULT NULL,
  `video` varchar(45) DEFAULT NULL,
  `id_mapel` varchar(25) DEFAULT NULL,
  `slug` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_materi`),
  KEY `fk_tbl_materi_1_idx` (`id_mapel`),
  CONSTRAINT `fk_tbl_materi_1` FOREIGN KEY (`id_mapel`) REFERENCES `tbl_mapel` (`id_mapel`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_materi`
--

LOCK TABLES `tbl_materi` WRITE;
/*!40000 ALTER TABLE `tbl_materi` DISABLE KEYS */;
INSERT INTO `tbl_materi` VALUES (1,'wawancara','BHS-IDO_wawancara.docx','BHS-IDO_wawancara.mp4','BHS-IDO','wawancara.html'),(2,'Cerpen','BHS-IDO_Cerpen.pdf','BHS-IDO_Cerpen.mp4','BHS-IDO','cerpen.html'),(3,'Iklan','BHS-IDO_Iklan.pdf','BHS-IDO_Iklan.mp4','BHS-IDO','iklan.html'),(4,'Andi Akbar Noob','BHS-IDO_Andi-Akbar-Noob.pdf','BHS-IDO_Andi-Akbar-Noob.mp4','BHS-IDO','andi-akbar-noob.html'),(5,'Coba sharing','BHS-IDO_Coba-sharing.pdf','BHS-IDO_Coba-sharing.mp4','BHS-IDO','coba-sharing.html'),(6,'asda','BHS-IDO_asda.pdf','BHS-IDO_asda.mp4','BHS-IDO','asda.html'),(7,'cvfff','BHS-IDO_cvfff.pdf','BHS-IDO_cvfff.mp4','BHS-IDO','cvfff.html'),(8,'asdad dd','BHS-IDO_asdad-dd.pdf','BHS-IDO_asdad-dd.mp4','BHS-IDO','asdad-dd.html'),(9,'materi apa ya','BHS-IDO_materi-apa-ya.docx','BHS-IDO_materi-apa-ya.mp4','BHS-IDO','materi-apa-ya.html'),(10,'asda jis','BHS-IDO_asda-jis.docx','BHS-IDO_asda-jis.mp4','BHS-IDO','asda-jis.html'),(11,'teman','BHS-IDO_teman.docx','BHS-IDO_teman.mp4','BHS-IDO','teman.html'),(12,'ops','BHS-IDO_ops.pdf','BHS-IDO_ops.mp4','BHS-IDO','ops.html');
/*!40000 ALTER TABLE `tbl_materi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nilai`
--

DROP TABLE IF EXISTS `tbl_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_soal` int(11) DEFAULT NULL,
  `id_siswa` varchar(45) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `index2` (`id_siswa`),
  KEY `fk_tbl_nilai_1_idx` (`id_soal`),
  CONSTRAINT `fk_tbl_nilai_1` FOREIGN KEY (`id_soal`) REFERENCES `tbl_soal` (`id_soal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_nilai_2` FOREIGN KEY (`id_siswa`) REFERENCES `tbl_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nilai`
--

LOCK TABLES `tbl_nilai` WRITE;
/*!40000 ALTER TABLE `tbl_nilai` DISABLE KEYS */;
INSERT INTO `tbl_nilai` VALUES (1,2,'60900111233',0);
/*!40000 ALTER TABLE `tbl_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_siswa`
--

DROP TABLE IF EXISTS `tbl_siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_siswa` (
  `id_siswa` varchar(45) NOT NULL,
  `nama_siswa` varchar(45) DEFAULT NULL,
  `password` text,
  `active` enum('true','false') DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_siswa`
--

LOCK TABLES `tbl_siswa` WRITE;
/*!40000 ALTER TABLE `tbl_siswa` DISABLE KEYS */;
INSERT INTO `tbl_siswa` VALUES ('163329','A. Asfar',NULL,NULL,NULL),('60900111233','Andi Asfar','aEZXR81cWNuOPJfan9cEaEq6hfCKc03SJHLjv0QFtNvjpaECx3d4mydvFLjixiRDdBYnrbtOiI3KJ5TwGgDICw--','true',NULL);
/*!40000 ALTER TABLE `tbl_siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_soal`
--

DROP TABLE IF EXISTS `tbl_soal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_soal` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `soal` text,
  `a` varchar(45) DEFAULT NULL,
  `b` varchar(45) DEFAULT NULL,
  `c` varchar(45) DEFAULT NULL,
  `d` varchar(45) DEFAULT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `img_soal` varchar(45) DEFAULT NULL,
  `img_a` varchar(45) DEFAULT NULL,
  `img_b` varchar(45) DEFAULT NULL,
  `img_c` varchar(45) DEFAULT NULL,
  `img_d` varchar(45) DEFAULT NULL,
  `benar` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_soal`),
  KEY `fk_tbl_soal_1_idx` (`id_materi`),
  CONSTRAINT `fk_tbl_soal_1` FOREIGN KEY (`id_materi`) REFERENCES `tbl_materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_soal`
--

LOCK TABLES `tbl_soal` WRITE;
/*!40000 ALTER TABLE `tbl_soal` DISABLE KEYS */;
INSERT INTO `tbl_soal` VALUES (1,'Berikut ini merupakan defenisi wawancara kecuali',' Tanya jawab','diskusi','main kelereng','makan',1,NULL,NULL,NULL,NULL,NULL,'D'),(2,'ddf',' sdfs','sdf','sdf','sdfs',1,NULL,NULL,NULL,NULL,NULL,'C'),(3,'sdfsdf',' sdf','sdf','sdf','sdf',1,NULL,NULL,NULL,NULL,NULL,'A'),(4,'asdasd','  asd','asd','asd','asd',1,NULL,NULL,NULL,NULL,NULL,'C'),(5,'sdadasd','  asd','asd','asd','asd',1,NULL,NULL,NULL,NULL,NULL,'B'),(6,'asdasd','  asd','asda','asd','asd',1,NULL,NULL,NULL,NULL,NULL,'B'),(7,'dsdd',' d','d','dd','dd',1,NULL,NULL,NULL,NULL,NULL,'D'),(8,'dfgdfg',' dfg','dfg','dfg','dfg',1,NULL,NULL,NULL,NULL,NULL,'C'),(9,'d','d ','d','d','d',1,NULL,NULL,NULL,NULL,NULL,'A'),(10,'sd',' sdf','sd','s','s',1,NULL,NULL,NULL,NULL,NULL,'C'),(11,'s',' f','f','f','f',1,NULL,NULL,NULL,NULL,NULL,'B');
/*!40000 ALTER TABLE `tbl_soal` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-30  1:26:53
