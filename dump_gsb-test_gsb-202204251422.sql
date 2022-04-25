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
-- Table structure for table `bareme_voiture`
--

DROP TABLE IF EXISTS `bareme_voiture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bareme_voiture` (
  `puissance_fiscal` varchar(100) NOT NULL,
  `formul_add` float DEFAULT NULL,
  `formul_plus` int(10) DEFAULT NULL,
  PRIMARY KEY (`puissance_fiscal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bareme_voiture`
--

LOCK TABLES `bareme_voiture` WRITE;
/*!40000 ALTER TABLE `bareme_voiture` DISABLE KEYS */;
INSERT INTO `bareme_voiture` VALUES ('3 CV et mois',0.3,1007),('4 CV',0.323,1262),('5 CV',0.339,1320),('6 CV',0.355,1382),('7 CV et plus',0.374,1435);
/*!40000 ALTER TABLE `bareme_voiture` ENABLE KEYS */;
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
INSERT INTO `fichefrais` VALUES ('f8','202111',NULL,NULL,'2021-11-25','CR'),('f8','202112',NULL,NULL,'2021-12-09','CR'),('f8','202201',NULL,NULL,'2022-01-03','CR'),('f8','202203',32,NULL,'2022-03-02','CR');
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
INSERT INTO `lignefraisforfait` VALUES ('f8','202111','ETP',1),('f8','202111','KM',10),('f8','202111','NUI',1),('f8','202111','REP',1),('f8','202112','ETP',2),('f8','202112','KM',55),('f8','202112','NUI',1),('f8','202112','REP',4),('f8','202201','ETP',7),('f8','202201','KM',420),('f8','202201','NUI',3),('f8','202201','REP',12),('f8','202203','ETP',5),('f8','202203','KM',160),('f8','202203','NUI',3),('f8','202203','REP',5);
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
  CONSTRAINT `lignefraishorsforfait_FK` FOREIGN KEY (`id_utlisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lignefraishorsforfait`
--

LOCK TABLES `lignefraishorsforfait` WRITE;
/*!40000 ALTER TABLE `lignefraishorsforfait` DISABLE KEYS */;
INSERT INTO `lignefraishorsforfait` VALUES (8,'f8','202203','Segond teste pour le horsfrait','2022-03-03',5000.00),(9,'f8','202203','Premier teste pour le horsfrait','2022-03-03',150.00),(10,'f8','202203','Premier teste pour le horsfrait','2022-03-06',5000.00),(11,'f8','202203','troisieme test','2022-03-17',753.00),(12,'f8','202203','quatiriÃ¨me esais','2022-03-17',951.00);
/*!40000 ALTER TABLE `lignefraishorsforfait` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_vehicule`
--

DROP TABLE IF EXISTS `type_vehicule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_vehicule` (
  `Type_vehicule` int(11) NOT NULL,
  `lablelle` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Type_vehicule`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_vehicule`
--

LOCK TABLES `type_vehicule` WRITE;
/*!40000 ALTER TABLE `type_vehicule` DISABLE KEYS */;
INSERT INTO `type_vehicule` VALUES (0,'voiture'),(1,'moto');
/*!40000 ALTER TABLE `type_vehicule` ENABLE KEYS */;
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
  `mdp` char(100) DEFAULT NULL,
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
INSERT INTO `utilisateur` VALUES ('a131','Villechalane','Louis','lvillachane','ca3983640f22d6a38a0708731ac697146026828b88594f9522ae5517960bd56d','8 rue des Charmes','46000','Cahors','2005-12-21',2),('a17','Andre','David','dandre','165a63d5371a0ccb21b23e8881d59116bfd8377d9cad418de1215da4af09e39d','1 rue Petit','46200','Lalbenque','1998-11-23',3),('a55','Bedos','Christian','cbedos','7461ef03c6debab576933c6e42e71bfdd9f070da3abbb5d8758fa1fc3fe65fc0','1 rue Peranud','46250','Montcuq','1995-01-12',2),('a93','Tusseau','Louis','ltusseau','227daca101749f45a829988faf79144d87d1d2e7a90ce07896ec56e697b7a449','22 rue des Ternes','46123','Gramat','2000-05-01',2),('b13','Bentot','Pascal','pbentot','e0020387b3eaa7414296fdfa7af5cfe48f6cf514f4350df2ff23b138e5e80e9e','11 allée des Cerises','46512','Bessines','1992-07-09',2),('b16','Bioret','Luc','lbioret','4dcb2c67707621b6bfa81c71db8ea33f6bfe217275bad06241d1f0cdd9171fd3','1 Avenue gambetta','46000','Cahors','1998-05-11',2),('b19','Bunisset','Francis','fbunisset','57b592489c1851ed5db43ab164cb2e3fbf88a3eeeba963518f41798260d0fdaa','10 rue des Perles','93100','Montreuil','1987-10-21',2),('b25','Bunisset','Denise','dbunisset','4de535fc4bb81bf16f8396701c72b84dbcfaa1232823cbc62fbf9d8295840921','23 rue Manin','75019','paris','2010-12-05',2),('b28','Cacheux','Bernard','bcacheux','9be0be929c729fe93b16b974b6a7f79ce77ecb399135f23ba8c47318bc3f0885','114 rue Blanche','75017','Paris','2009-11-12',3),('b34','Cadic','Eric','ecadic','ed5c1022a39ba567bf81c922e7bebcefe1ae1bb29f1ee4d68cb571096ab699cd','123 avenue de la République','75011','Paris','2008-09-23',2),('b4','Charoze','Catherine','ccharoze','659d7ec12a1ed4710ca30bacba2049029cba5f6f8946f55d5150301b2c2bb620','100 rue Petit','75019','Paris','2005-11-12',2),('b50','Clepkens','Christophe','cclepkens','7e9353475b3d90a2ffbedd346b8fd143ff42d8808b43aa8b804465d98827925c','12 allée des Anges','93230','Romainville','2003-08-11',2),('b59','Cottin','Vincenne','vcottin','264fa0634d763fefc9de03d9412af78b553304a1e59bc7c1faf8fd5b4fd26e48','36 rue Des Roches','93100','Monteuil','2001-11-18',2),('c14','Daburon','François','fdaburon','2558ad19d564eeafadc7395065d14f6fc244e21c9510079838d5d5c2aa660385','13 rue de Chanzy','94000','Créteil','2002-02-11',2),('c3','De','Philippe','pde','80a51081489841526217f5958fe37b1231a8385aa6195c4d5f13cda07ef112b1','13 rue Barthes','94000','Créteil','2010-12-14',2),('c54','Debelle','Michel','mdebelle','e87f267d00031b3853d13ea6c4abd3aa8ba9a7362f151b23b1d8ab7a36237661','181 avenue Barbusse','93210','Rosny','2006-11-23',3),('d13','Debelle','Jeanne','jdebelle','8447a77dcc8a1ab290625d2de92107ad506fe226f21ccc7b94db5576957371e9','134 allée des Joncs','44000','Nantes','2000-05-11',2),('d51','Debroise','Michel','mdebroise','d908f177158faee7d45535e52ca19d1182a4cfc2ac2c44cc6d56540a36b43e08','2 Bld Jourdain','44000','Nantes','2001-04-17',2),('e22','Desmarquest','Nathalie','ndesmarquest','045758ae4faff6e3a69776daea65b425c06df1806fb9fee23001b51ce8ad92f7','14 Place d Arc','45000','Orléans','2005-11-12',2),('e24','Desnost','Pierre','pdesnost','9afdf4579e4688162115b09e0a72a810a3a0db98c3142d2a524d2fbb7a1d83a9','16 avenue des Cèdres','23200','Guéret','2001-02-05',2),('e39','Dudouit','Frédéric','fdudouit','82189fa33089b33bda4fe93c84cc0ef3e9b5746222735ea948f85aa4faa92b8c','18 rue de l église','23120','GrandBourg','2000-08-01',3),('e49','Duncombe','Claude','cduncombe','1a96aed84026e53d447df5b3501f468b6b1a104d496183b80010aec0ed6e57e3','19 rue de la tour','23100','La souteraine','1987-10-10',2),('e5','Enault-Pascreau','Céline','cenault','5044827970b11b704c3f4bd8025c38a334df3a194247e6b03c3a330eab07316c','25 place de la gare','23200','Gueret','1995-09-01',2),('e52','Eynde','Valérie','veynde','9d3744e22dcada1717408fdf079bff21f3f8cb514e3402b19d990df01f33325e','3 Grand Place','13015','Marseille','1999-11-01',2),('f21','Finck','Jacques','jfinck','577d67f320202216ee7f2fe26b363daada983b0d06521a7c89aeb049eafc97f5','10 avenue du Prado','13002','Marseille','2001-11-10',2),('f39','Frémont','Fernande','ffremont','b409a4db2e8a88fb10f427ef3ff3452dd3489b75648a7593f6ad74d4572ae06b','4 route de la mer','13012','Allauh','1998-10-01',2),('f4','Gest','Alain','agest','a8a5b00ccbc425791ae7e9bdca16fc7e108c9d58e6d70b0c66f327b82b083ec9','30 avenue de la mer','13025','Berre','1985-11-01',2),('f8','Delforge','Clément','clem','50bf5a0968f05a39081d78ce7b58a4b3c3f9e3eb9531668a7b6ccf69af33170d','32 boulvard paul bezin','59000','Cambrai','2002-12-05',3);
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
  `Type_vehicule` int(11) NOT NULL,
  `nombre_chevaux_moto` varchar(100) DEFAULT NULL,
  `nombre_chveaux_voiture` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicule_FK` (`id_utilisateur`),
  KEY `vehicule_FK_2` (`Type_vehicule`),
  KEY `vehicule_FK_3` (`nombre_chveaux_voiture`),
  KEY `vehicule_FK_1` (`nombre_chevaux_moto`),
  CONSTRAINT `vehicule_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  CONSTRAINT `vehicule_FK_1` FOREIGN KEY (`nombre_chevaux_moto`) REFERENCES `bareme_moto` (`Pussance_fiscale`),
  CONSTRAINT `vehicule_FK_2` FOREIGN KEY (`Type_vehicule`) REFERENCES `type_vehicule` (`Type_vehicule`),
  CONSTRAINT `vehicule_FK_3` FOREIGN KEY (`nombre_chveaux_voiture`) REFERENCES `bareme_voiture` (`puissance_fiscal`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicule`
--

LOCK TABLES `vehicule` WRITE;
/*!40000 ALTER TABLE `vehicule` DISABLE KEYS */;
INSERT INTO `vehicule` VALUES (1,'f8',1,'plus de 5 CV',NULL),(5,'a17',0,NULL,'7 CV et plus');
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

-- Dump completed on 2022-04-25 14:22:05
