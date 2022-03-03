-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: test_gsb
-- ------------------------------------------------------
-- Server version	5.7.31

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
-- Table structure for table `bareme_moto`
--

DROP TABLE IF EXISTS `bareme_moto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bareme_moto` (
  `Pussance_fiscale` varchar(100) NOT NULL,
  `Formuleadd` float DEFAULT NULL,
  `Fromuleplus` int(111) DEFAULT NULL,
  PRIMARY KEY (`Pussance_fiscale`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bareme_moto`
--

LOCK TABLES `bareme_moto` WRITE;
/*!40000 ALTER TABLE `bareme_moto` DISABLE KEYS */;
INSERT INTO `bareme_moto` VALUES ('1 ou 2 CV',0.094,845),('3 , 4 et 5 CV',0.078,1099),('plus de 5 CV',0.075,1502);
/*!40000 ALTER TABLE `bareme_moto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etat`
--

DROP TABLE IF EXISTS `etat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etat` (
  `id` char(2) NOT NULL,
  `libelle` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etat`
--

LOCK TABLES `etat` WRITE;
/*!40000 ALTER TABLE `etat` DISABLE KEYS */;
INSERT INTO `etat` VALUES ('CL','Saisie clôturée'),('CR','Fiche créée, saisie en cours'),('RB','Remboursée'),('VA','Validée et mise en paiement');
/*!40000 ALTER TABLE `etat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fichefrais`
--

DROP TABLE IF EXISTS `fichefrais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fichefrais` (
  `id_utilisateur` char(4) NOT NULL,
  `mois` char(6) NOT NULL,
  `nbJustificatifs` int(11) DEFAULT NULL,
  `montantValide` decimal(10,2) DEFAULT NULL,
  `dateModif` date DEFAULT NULL,
  `idEtat` char(2) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`,`mois`),
  KEY `fichefrais_FK` (`idEtat`),
  CONSTRAINT `fichefrais_FK` FOREIGN KEY (`idEtat`) REFERENCES `etat` (`id`),
  CONSTRAINT `fichefrais_FK_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fichefrais`
--

LOCK TABLES `fichefrais` WRITE;
/*!40000 ALTER TABLE `fichefrais` DISABLE KEYS */;
INSERT INTO `fichefrais` VALUES ('f8','202111',NULL,NULL,'2021-11-25','CR'),('f8','202112',NULL,NULL,'2021-12-09','CR'),('f8','202201',NULL,NULL,'2022-01-03','CR');
/*!40000 ALTER TABLE `fichefrais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fraisforfait`
--

DROP TABLE IF EXISTS `fraisforfait`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fraisforfait` (
  `id` char(3) NOT NULL,
  `libelle` char(20) DEFAULT NULL,
  `montant` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fraisforfait`
--

LOCK TABLES `fraisforfait` WRITE;
/*!40000 ALTER TABLE `fraisforfait` DISABLE KEYS */;
INSERT INTO `fraisforfait` VALUES ('ETP','Forfait Etape',110.00),('KM','Frais Kilométrique',0.62),('NUI','Nuitée Hôtel',80.00),('REP','Repas Restaurant',25.00);
/*!40000 ALTER TABLE `fraisforfait` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grade`
--

DROP TABLE IF EXISTS `grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grade` (
  `id_Grade` int(11) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_Grade`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grade`
--

LOCK TABLES `grade` WRITE;
/*!40000 ALTER TABLE `grade` DISABLE KEYS */;
INSERT INTO `grade` VALUES (2,'utilisateur'),(3,'comptable');
/*!40000 ALTER TABLE `grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lignefraisforfait`
--

DROP TABLE IF EXISTS `lignefraisforfait`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lignefraisforfait` (
  `id_utilisateur` char(4) NOT NULL,
  `mois` char(6) NOT NULL,
  `idFraisForfait` char(3) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`,`mois`,`idFraisForfait`),
  KEY `lignefraisforfait_FK_1` (`idFraisForfait`),
  CONSTRAINT `lignefraisforfait_FK` FOREIGN KEY (`id_utilisateur`, `mois`) REFERENCES `fichefrais` (`id_utilisateur`, `mois`),
  CONSTRAINT `lignefraisforfait_FK_1` FOREIGN KEY (`idFraisForfait`) REFERENCES `fraisforfait` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lignefraisforfait`
--

LOCK TABLES `lignefraisforfait` WRITE;
/*!40000 ALTER TABLE `lignefraisforfait` DISABLE KEYS */;
INSERT INTO `lignefraisforfait` VALUES ('f8','202111','ETP',1),('f8','202111','KM',10),('f8','202111','NUI',1),('f8','202111','REP',1),('f8','202112','ETP',2),('f8','202112','KM',55),('f8','202112','NUI',1),('f8','202112','REP',4),('f8','202201','ETP',7),('f8','202201','KM',420),('f8','202201','NUI',3),('f8','202201','REP',12);
/*!40000 ALTER TABLE `lignefraisforfait` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lignefraishorsforfait`
--

DROP TABLE IF EXISTS `lignefraishorsforfait`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lignefraishorsforfait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utlisateur` char(4) NOT NULL,
  `mois` char(6) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lignefraishorsforfait_FK` (`id_utlisateur`,`mois`),
  CONSTRAINT `lignefraishorsforfait_FK` FOREIGN KEY (`id_utlisateur`, `mois`) REFERENCES `fichefrais` (`id_utilisateur`, `mois`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lignefraishorsforfait`
--

LOCK TABLES `lignefraishorsforfait` WRITE;
/*!40000 ALTER TABLE `lignefraishorsforfait` DISABLE KEYS */;
INSERT INTO `lignefraishorsforfait` VALUES (5,'f8','202112','ce si est un test','2021-12-04',1099.00),(6,'f8','202112','voyage','2021-12-25',53.00);
/*!40000 ALTER TABLE `lignefraishorsforfait` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateur` (
  `id_utilisateur` char(4) NOT NULL,
  `nom` char(30) DEFAULT NULL,
  `prenom` char(30) DEFAULT NULL,
  `login` char(20) DEFAULT NULL,
  `mdp` char(20) DEFAULT NULL,
  `adresse` char(30) DEFAULT NULL,
  `cp` char(5) DEFAULT NULL,
  `ville` char(30) DEFAULT NULL,
  `dateEmbauche` date DEFAULT NULL,
  `id_Grade` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `utilisateur_FK` (`id_Grade`),
  CONSTRAINT `utilisateur_FK` FOREIGN KEY (`id_Grade`) REFERENCES `grade` (`id_Grade`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES ('a131','Villechalane','Louis','lvillachane','jux7g','8 rue des Charmes','46000','Cahors','2005-12-21',2),('a17','Andre','David','dandre','oppg5','1 rue Petit','46200','Lalbenque','1998-11-23',3),('a55','Bedos','Christian','cbedos','gmhxd','1 rue Peranud','46250','Montcuq','1995-01-12',2),('a93','Tusseau','Louis','ltusseau','ktp3s','22 rue des Ternes','46123','Gramat','2000-05-01',2),('b13','Bentot','Pascal','pbentot','doyw1','11 allée des Cerises','46512','Bessines','1992-07-09',2),('b16','Bioret','Luc','lbioret','hrjfs','1 Avenue gambetta','46000','Cahors','1998-05-11',2),('b19','Bunisset','Francis','fbunisset','4vbnd','10 rue des Perles','93100','Montreuil','1987-10-21',2),('b25','Bunisset','Denise','dbunisset','s1y1r','23 rue Manin','75019','paris','2010-12-05',2),('b28','Cacheux','Bernard','bcacheux','uf7r3','114 rue Blanche','75017','Paris','2009-11-12',3),('b34','Cadic','Eric','ecadic','6u8dc','123 avenue de la République','75011','Paris','2008-09-23',2),('b4','Charoze','Catherine','ccharoze','u817o','100 rue Petit','75019','Paris','2005-11-12',2),('b50','Clepkens','Christophe','cclepkens','bw1us','12 allée des Anges','93230','Romainville','2003-08-11',2),('b59','Cottin','Vincenne','vcottin','2hoh9','36 rue Des Roches','93100','Monteuil','2001-11-18',2),('c14','Daburon','François','fdaburon','7oqpv','13 rue de Chanzy','94000','Créteil','2002-02-11',2),('c3','De','Philippe','pde','gk9kx','13 rue Barthes','94000','Créteil','2010-12-14',2),('c54','Debelle','Michel','mdebelle','od5rt','181 avenue Barbusse','93210','Rosny','2006-11-23',3),('d13','Debelle','Jeanne','jdebelle','nvwqq','134 allée des Joncs','44000','Nantes','2000-05-11',2),('d51','Debroise','Michel','mdebroise','sghkb','2 Bld Jourdain','44000','Nantes','2001-04-17',2),('e22','Desmarquest','Nathalie','ndesmarquest','f1fob','14 Place d Arc','45000','Orléans','2005-11-12',2),('e24','Desnost','Pierre','pdesnost','4k2o5','16 avenue des Cèdres','23200','Guéret','2001-02-05',2),('e39','Dudouit','Frédéric','fdudouit','44im8','18 rue de l église','23120','GrandBourg','2000-08-01',3),('e49','Duncombe','Claude','cduncombe','qf77j','19 rue de la tour','23100','La souteraine','1987-10-10',2),('e5','Enault-Pascreau','Céline','cenault','y2qdu','25 place de la gare','23200','Gueret','1995-09-01',2),('e52','Eynde','Valérie','veynde','i7sn3','3 Grand Place','13015','Marseille','1999-11-01',2),('f21','Finck','Jacques','jfinck','mpb3t','10 avenue du Prado','13002','Marseille','2001-11-10',2),('f39','Frémont','Fernande','ffremont','xs5tq','4 route de la mer','13012','Allauh','1998-10-01',2),('f4','Gest','Alain','agest','dywvt','30 avenue de la mer','13025','Berre','1985-11-01',2),('f8','Clément','Delforge','clem','delf','32 boulvard paul bezin','59000','Cambrai','2002-12-05',3);
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` char(4) NOT NULL,
  `Type_vehicule` varchar(100) DEFAULT NULL,
  `nombre_chevaux` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicule_FK` (`id_utilisateur`),
  KEY `vehicule_FK_1` (`nombre_chevaux`),
  CONSTRAINT `vehicule_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  CONSTRAINT `vehicule_FK_1` FOREIGN KEY (`nombre_chevaux`) REFERENCES `bareme_moto` (`Pussance_fiscale`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicule`
--

LOCK TABLES `vehicule` WRITE;
/*!40000 ALTER TABLE `vehicule` DISABLE KEYS */;
INSERT INTO `vehicule` VALUES (1,'f8','1','plus de 5 CV');
/*!40000 ALTER TABLE `vehicule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'test_gsb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-03 13:34:51
