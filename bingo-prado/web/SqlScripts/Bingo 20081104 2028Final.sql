-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.51a-3ubuntu5.1-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema bingo
--

CREATE DATABASE IF NOT EXISTS bingo;
USE bingo;

--
-- Definition of table `ganador`
--

DROP TABLE IF EXISTS `ganador`;
CREATE TABLE `ganador` (
  `idparticipante` int(10) unsigned NOT NULL,
  `idjuego` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`idparticipante`,`idjuego`),
  KEY `participante_has_juego_FKIndex1` (`idparticipante`),
  KEY `participante_has_juego_FKIndex2` (`idjuego`),
  CONSTRAINT `ganador_ibfk_1` FOREIGN KEY (`idparticipante`) REFERENCES `participante` (`idparticipante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ganador_ibfk_2` FOREIGN KEY (`idjuego`) REFERENCES `juego` (`idjuego`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ganador`
--

/*!40000 ALTER TABLE `ganador` DISABLE KEYS */;
/*!40000 ALTER TABLE `ganador` ENABLE KEYS */;


--
-- Definition of table `juego`
--

DROP TABLE IF EXISTS `juego`;
CREATE TABLE `juego` (
  `idjuego` int(10) unsigned NOT NULL auto_increment,
  `nombre` varchar(100) default NULL,
  `fecha` date default NULL,
  `numeros_sorteados` smallint(5) unsigned default NULL,
  PRIMARY KEY  (`idjuego`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `juego`
--

/*!40000 ALTER TABLE `juego` DISABLE KEYS */;
INSERT INTO `juego` (`idjuego`,`nombre`,`fecha`,`numeros_sorteados`) VALUES 
 (1,'Juego 1','2008-11-04',0),
 (2,'Juego 2','2008-11-04',0),
 (3,'Juego 3','2008-11-04',0),
 (4,'Juego 4','2008-11-04',0),
 (5,'Juego 5',NULL,0),
 (6,'Juego 6','2008-11-04',0),
 (7,'Juego 7','2008-11-04',0),
 (8,'Juego 8','2008-11-04',0),
 (9,'Juego 9','2008-11-04',0),
 (10,'Juego 10','2008-11-04',0);
/*!40000 ALTER TABLE `juego` ENABLE KEYS */;


--
-- Definition of table `juego_numero`
--

DROP TABLE IF EXISTS `juego_numero`;
CREATE TABLE `juego_numero` (
  `idjuego_numero` int(10) unsigned NOT NULL auto_increment,
  `idjuego` int(10) unsigned NOT NULL,
  `numero` smallint(5) unsigned default NULL,
  PRIMARY KEY  (`idjuego_numero`),
  KEY `juego_numero_FKIndex1` (`idjuego`),
  CONSTRAINT `juego_numero_ibfk_1` FOREIGN KEY (`idjuego`) REFERENCES `juego` (`idjuego`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `juego_numero`
--

/*!40000 ALTER TABLE `juego_numero` DISABLE KEYS */;
/*!40000 ALTER TABLE `juego_numero` ENABLE KEYS */;


--
-- Definition of table `juego_terminado`
--

DROP TABLE IF EXISTS `juego_terminado`;
CREATE TABLE `juego_terminado` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `idjuego` int(10) unsigned NOT NULL,
  `idjuego_tipo` int(10) unsigned NOT NULL,
  `cantidad` smallint(5) unsigned default NULL,
  `date` datetime default NULL,
  PRIMARY KEY  (`id`,`idjuego`,`idjuego_tipo`),
  KEY `juego_has_juego_tipo_FKIndex1` (`idjuego`),
  KEY `juego_has_juego_tipo_FKIndex2` (`idjuego_tipo`),
  CONSTRAINT `juego_terminado_ibfk_1` FOREIGN KEY (`idjuego`) REFERENCES `juego` (`idjuego`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `juego_terminado_ibfk_2` FOREIGN KEY (`idjuego_tipo`) REFERENCES `juego_tipo` (`idjuego_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `juego_terminado`
--

/*!40000 ALTER TABLE `juego_terminado` DISABLE KEYS */;
INSERT INTO `juego_terminado` (`id`,`idjuego`,`idjuego_tipo`,`cantidad`,`date`) VALUES 
 (1,1,2,20,'2008-11-04 16:20:15'),
 (2,1,1,5,'2008-11-04 16:20:22'),
 (3,1,2,5,'2008-11-04 18:03:41'),
 (4,1,1,6,'2008-11-04 18:03:49'),
 (5,2,1,45,'2008-11-04 18:08:03');
/*!40000 ALTER TABLE `juego_terminado` ENABLE KEYS */;


--
-- Definition of table `juego_tipo`
--

DROP TABLE IF EXISTS `juego_tipo`;
CREATE TABLE `juego_tipo` (
  `idjuego_tipo` int(10) unsigned NOT NULL auto_increment,
  `nombre` varchar(100) default NULL,
  PRIMARY KEY  (`idjuego_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `juego_tipo`
--

/*!40000 ALTER TABLE `juego_tipo` DISABLE KEYS */;
INSERT INTO `juego_tipo` (`idjuego_tipo`,`nombre`) VALUES 
 (1,'Liena'),
 (2,'Bingo');
/*!40000 ALTER TABLE `juego_tipo` ENABLE KEYS */;


--
-- Definition of table `participante`
--

DROP TABLE IF EXISTS `participante`;
CREATE TABLE `participante` (
  `idparticipante` int(10) unsigned NOT NULL auto_increment,
  `nombre` varchar(100) default NULL,
  PRIMARY KEY  (`idparticipante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participante`
--

/*!40000 ALTER TABLE `participante` DISABLE KEYS */;
/*!40000 ALTER TABLE `participante` ENABLE KEYS */;


--
-- Definition of table `premio`
--

DROP TABLE IF EXISTS `premio`;
CREATE TABLE `premio` (
  `idpremio` int(10) unsigned NOT NULL auto_increment,
  `premio` varchar(100) default NULL,
  PRIMARY KEY  (`idpremio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `premio`
--

/*!40000 ALTER TABLE `premio` DISABLE KEYS */;
/*!40000 ALTER TABLE `premio` ENABLE KEYS */;


--
-- Definition of table `tarjeta`
--

DROP TABLE IF EXISTS `tarjeta`;
CREATE TABLE `tarjeta` (
  `idtarjeta` int(10) unsigned NOT NULL auto_increment,
  `idjuego` int(10) unsigned NOT NULL,
  `numero` smallint(5) unsigned default NULL,
  `fila` smallint(5) unsigned default NULL,
  `columna` smallint(5) unsigned default NULL,
  `visible` tinyint(1) default '0',
  `final` tinyint(1) default '0',
  `inicio` tinyint(1) default '0',
  `touch` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`idtarjeta`),
  KEY `juego_numero_FKIndex1` (`idjuego`),
  CONSTRAINT `tarjeta_ibfk_1` FOREIGN KEY (`idjuego`) REFERENCES `juego` (`idjuego`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9201 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarjeta`
--

/*!40000 ALTER TABLE `tarjeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tarjeta` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
