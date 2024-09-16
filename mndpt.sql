-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 17, 2024 at 06:12 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mndpt`
--

-- --------------------------------------------------------

--
-- Table structure for table `commune`
--

DROP TABLE IF EXISTS `commune`;
CREATE TABLE IF NOT EXISTS `commune` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `districtID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `districtID` (`districtID`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commune`
--

INSERT INTO `commune` (`id`, `nom`, `type`, `districtID`) VALUES
(15, 'Fianarantsoa', '', 120),
(16, 'Andranovorivato', '', 120),
(17, 'Talata Ampano', '', 120),
(18, 'Nasandratrony', '', 121),
(19, 'Ambalavao', '', 122),
(20, 'Mahazogny', '', 122),
(21, 'Iarintsena', '', 122),
(22, 'Vohiboay', '', 122),
(23, 'Ikalamavony', '', 125),
(24, 'Imanody', '', 125),
(25, 'Soatanana', '', 121),
(26, 'Ambositra', '', 117),
(27, 'Vohipeno', '', 118),
(28, 'Ihosy', '', 123),
(29, 'Zazafotsy', '', 123),
(30, 'Malailay', '', 123),
(31, 'Be Voatavo', '', 123),
(32, 'Farafangana', '', 119),
(33, 'Manakara', '', 124);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
CREATE TABLE IF NOT EXISTS `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `regionID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `district_ibfk_1` (`regionID`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `nom`, `regionID`) VALUES
(117, 'Ambositra', 1),
(118, 'Vohipeno', 2),
(119, 'Farafangana', 3),
(120, 'Fianarantsoa', 4),
(121, 'Isandra', 4),
(122, 'Ambalavao', 4),
(123, 'Ihosy', 5),
(124, 'Manakara', 6),
(125, 'Ikalamavony', 4);

-- --------------------------------------------------------

--
-- Table structure for table `fokontany`
--

DROP TABLE IF EXISTS `fokontany`;
CREATE TABLE IF NOT EXISTS `fokontany` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `nom_chef` varchar(200) NOT NULL,
  `contact` varchar(13) NOT NULL,
  `communeID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `communeID` (`communeID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fokontany`
--

INSERT INTO `fokontany` (`id`, `nom`, `nom_chef`, `contact`, `communeID`) VALUES
(23, 'Anosy Isada', 'RABE Farihy', '0345896585', 15),
(24, 'Ampitakely', 'HAJA Rabetsarovana', '0324587895', 15),
(25, 'Soamiandrizafy', 'RAKOTONIRINA Jean Gilbert', '0337895211', 18),
(26, 'Androka', 'RAMANDIMBY Honoré', '0348956528', 19),
(27, 'Ankasina', 'FANOMEZANA André', '0345589623', 26),
(28, 'Ankidrisa', 'NIRINA Josette', '0345896528', 22),
(29, 'Manandrabary', 'RABE Jean Marie', '0325878956', 21),
(30, 'Asahamasy', 'MASY Rosette', '0335698758', 19),
(31, 'Ezaka', 'MANJATINA Maropaniry', '0325875968', 19);

-- --------------------------------------------------------

--
-- Table structure for table `livraison_district`
--

DROP TABLE IF EXISTS `livraison_district`;
CREATE TABLE IF NOT EXISTS `livraison_district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `districtID` int(11) NOT NULL,
  `recensementID` int(11) NOT NULL,
  `nom_remettant` varchar(200) NOT NULL,
  `nom_receptionaire` varchar(200) NOT NULL,
  `date_livraison` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `districtID` (`districtID`),
  KEY `recensementID` (`recensementID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `livraison_fokontany`
--

DROP TABLE IF EXISTS `livraison_fokontany`;
CREATE TABLE IF NOT EXISTS `livraison_fokontany` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_recensement` int(11) NOT NULL,
  `nombre_recu` int(11) NOT NULL,
  `nombre_doublon` int(11) NOT NULL,
  `nombre_distribue` int(11) NOT NULL,
  `nombre_reste_distribue` int(11) NOT NULL,
  `nombre_autre_anomalie` int(11) NOT NULL,
  `date_livraison` date DEFAULT NULL,
  `fokontanyID` int(11) NOT NULL,
  `observation` varchar(200) NOT NULL,
  `recensementID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `livraison_fokontany__ibfk_1` (`fokontanyID`),
  KEY `recensementID` (`recensementID`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `livraison_fokontany`
--

INSERT INTO `livraison_fokontany` (`id`, `nombre_recensement`, `nombre_recu`, `nombre_doublon`, `nombre_distribue`, `nombre_reste_distribue`, `nombre_autre_anomalie`, `date_livraison`, `fokontanyID`, `observation`, `recensementID`) VALUES
(138, 500, 420, 50, 400, 25, 30, '2024-09-15', 27, '1er lancement', 9),
(139, 200, 180, 20, 20, 0, 0, '2024-09-15', 23, 'Presque OK', 9),
(140, 201, 201, 0, 0, 0, 0, '2024-09-16', 26, 'Parfait', 9);

-- --------------------------------------------------------

--
-- Table structure for table `oublier`
--

DROP TABLE IF EXISTS `oublier`;
CREATE TABLE IF NOT EXISTS `oublier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `reset_token` varchar(200) DEFAULT NULL,
  `reset_token_expire` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `recensement`
--

DROP TABLE IF EXISTS `recensement`;
CREATE TABLE IF NOT EXISTS `recensement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_recensement` varchar(50) NOT NULL,
  `observation` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recensement`
--

INSERT INTO `recensement` (`id`, `nom_recensement`, `observation`, `status`) VALUES
(9, 'NOV 2024', 'Première lancement du projet Carnet Fokontany', 'Active'),
(10, 'REC TEST', 'Pour le demo', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `nom`) VALUES
(1, 'Amoron\' I Mania'),
(2, 'Atsimo Atsinana'),
(3, 'Fitovinany'),
(4, 'Haute Matsiatra'),
(5, 'Ihorombe'),
(6, 'Vatovavy');

-- --------------------------------------------------------

--
-- Table structure for table `registre`
--

DROP TABLE IF EXISTS `registre`;
CREATE TABLE IF NOT EXISTS `registre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `confirm_password` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registre`
--

INSERT INTO `registre` (`id`, `username`, `password`, `confirm_password`) VALUES
(1, 'Samirah', '$2y$10$knzd/3l04.kysOcJi61SSejZbdY8.Nnk50uijldowW7t0yd0G9IB6', '2024-09-13 06:21:20'),
(2, 'solo', '$2y$10$NWxHjvCy6DV2V/1Gr/e.ZuWaicM9HNwTmbnKZ0tOSXpIeW6gwVy7m', '2024-09-13 06:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `statistique`
--

DROP TABLE IF EXISTS `statistique`;
CREATE TABLE IF NOT EXISTS `statistique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre _population_recense` int(11) NOT NULL,
  `nombre _carnet_remis_pv` int(11) NOT NULL,
  `nombre _total_carnet_recu` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commune`
--
ALTER TABLE `commune`
  ADD CONSTRAINT `commune_ibfk_1` FOREIGN KEY (`districtID`) REFERENCES `district` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `district_ibfk_1` FOREIGN KEY (`regionID`) REFERENCES `region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fokontany`
--
ALTER TABLE `fokontany`
  ADD CONSTRAINT `fokontany_ibfk_1` FOREIGN KEY (`communeID`) REFERENCES `commune` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `livraison_district`
--
ALTER TABLE `livraison_district`
  ADD CONSTRAINT `livraison_district_ibfk_1` FOREIGN KEY (`districtID`) REFERENCES `district` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `livraison_district_ibfk_2` FOREIGN KEY (`recensementID`) REFERENCES `recensement` (`id`);

--
-- Constraints for table `livraison_fokontany`
--
ALTER TABLE `livraison_fokontany`
  ADD CONSTRAINT `livraison_fokontany_ibfk_1` FOREIGN KEY (`fokontanyID`) REFERENCES `fokontany` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `livraison_fokontany_ibfk_2` FOREIGN KEY (`recensementID`) REFERENCES `recensement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
