-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2024 at 09:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `commune` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `districtID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commune`
--

INSERT INTO `commune` (`id`, `nom`, `type`, `districtID`) VALUES
(13, 'Fianarantsoa', '', 115),
(14, 'AMBALAVAO1', '', 116);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `regionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `nom`, `regionID`) VALUES
(115, 'Fianarantsoa I', 3),
(116, 'AMBALAVAO', 3);

-- --------------------------------------------------------

--
-- Table structure for table `fokontany`
--

CREATE TABLE `fokontany` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `nom_chef` varchar(200) NOT NULL,
  `contact` varchar(13) NOT NULL,
  `communeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fokontany`
--

INSERT INTO `fokontany` (`id`, `nom`, `nom_chef`, `contact`, `communeID`) VALUES
(21, 'TANAMBAO', 'RAKOTO Jean Baptiste', '0341258960', 13),
(22, 'ANDROKA', 'RAZAFY Mahefa', '0348956584', 14);

-- --------------------------------------------------------

--
-- Table structure for table `livraison_district`
--

CREATE TABLE `livraison_district` (
  `id` int(11) NOT NULL,
  `districtID` int(11) NOT NULL,
  `recensementID` int(11) NOT NULL,
  `nom_remettant` varchar(200) NOT NULL,
  `nom_receptionaire` varchar(200) NOT NULL,
  `date_livraison` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `livraison_fokontany`
--

CREATE TABLE `livraison_fokontany` (
  `id` int(11) NOT NULL,
  `nombre_recensement` int(11) NOT NULL,
  `nombre_recu` int(11) NOT NULL,
  `nombre_doublon` int(11) NOT NULL,
  `nombre_distribue` int(11) NOT NULL,
  `nombre_reste_distribue` int(11) NOT NULL,
  `nombre_autre_anomalie` int(11) NOT NULL,
  `date_livraison` date DEFAULT NULL,
  `commune_id` int(11) NOT NULL,
  `fokontanyID` int(11) NOT NULL,
  `observation` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `livraison_fokontany`
--

INSERT INTO `livraison_fokontany` (`id`, `nombre_recensement`, `nombre_recu`, `nombre_doublon`, `nombre_distribue`, `nombre_reste_distribue`, `nombre_autre_anomalie`, `date_livraison`, `commune_id`, `fokontanyID`, `observation`) VALUES
(131, 5, 4, 4, 3, 3, 3, '2024-09-14', 0, 21, 'IO VE?'),
(133, 7, 7, 6, 7, 4, 6, '2024-09-27', 0, 22, 'EFA AO');

-- --------------------------------------------------------

--
-- Table structure for table `oublier`
--

CREATE TABLE `oublier` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `reset_token` varchar(200) DEFAULT NULL,
  `reset_token_expire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `recensement`
--

CREATE TABLE `recensement` (
  `id` int(11) NOT NULL,
  `nom_recensement` varchar(50) NOT NULL,
  `observation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recensement`
--

INSERT INTO `recensement` (`id`, `nom_recensement`, `observation`) VALUES
(1, 'JAN 2024', 'Statistique à la date du 1/03/20245'),
(8, '20/01/kl', 'stastique');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `nom`) VALUES
(3, 'Haute Matsiatra'),
(4, 'Atsimo Atsinana'),
(6, 'Ihorombe'),
(7, 'Amoron\' I Mania'),
(8, 'Fitovinany'),
(10, 'Vatovavy');

-- --------------------------------------------------------

--
-- Table structure for table `registre`
--

CREATE TABLE `registre` (
  `id` int(11) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `confirm_password` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `statistique` (
  `id` int(11) NOT NULL,
  `nombre _population_recense` int(11) NOT NULL,
  `nombre _carnet_remis_pv` int(11) NOT NULL,
  `nombre _total_carnet_recu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commune`
--
ALTER TABLE `commune`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districtID` (`districtID`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_ibfk_1` (`regionID`);

--
-- Indexes for table `fokontany`
--
ALTER TABLE `fokontany`
  ADD PRIMARY KEY (`id`),
  ADD KEY `communeID` (`communeID`);

--
-- Indexes for table `livraison_district`
--
ALTER TABLE `livraison_district`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districtID` (`districtID`),
  ADD KEY `recensementID` (`recensementID`);

--
-- Indexes for table `livraison_fokontany`
--
ALTER TABLE `livraison_fokontany`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livraison_fokontany__ibfk_1` (`fokontanyID`);

--
-- Indexes for table `oublier`
--
ALTER TABLE `oublier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recensement`
--
ALTER TABLE `recensement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registre`
--
ALTER TABLE `registre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistique`
--
ALTER TABLE `statistique`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commune`
--
ALTER TABLE `commune`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `fokontany`
--
ALTER TABLE `fokontany`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `livraison_district`
--
ALTER TABLE `livraison_district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `livraison_fokontany`
--
ALTER TABLE `livraison_fokontany`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `oublier`
--
ALTER TABLE `oublier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recensement`
--
ALTER TABLE `recensement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `registre`
--
ALTER TABLE `registre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `statistique`
--
ALTER TABLE `statistique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
