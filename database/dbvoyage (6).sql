-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2019 at 07:09 PM
-- Server version: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbvoyage`
--

-- --------------------------------------------------------

--
-- Table structure for table `activite`
--

CREATE TABLE `activite` (
  `idActivite` int(11) NOT NULL,
  `idLieu` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `siteweb` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activite`
--

INSERT INTO `activite` (`idActivite`, `idLieu`, `nom`, `description`, `siteweb`) VALUES
(1, 1, '', NULL, NULL),
(2, 8, 'test activite', 'descritption test activite', 'http://www.testactivite.com'),
(3, 3, 's', NULL, NULL),
(4, 40, 'r', NULL, NULL),
(5, 7, 'g', NULL, NULL),
(6, 41, '1', NULL, NULL),
(7, 43, '3', NULL, NULL),
(8, 44, '4', NULL, NULL),
(9, 6, 'r', NULL, NULL),
(10, 6, 'e', NULL, NULL),
(11, 6, 'a', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `circuit`
--

CREATE TABLE `circuit` (
  `idCircuit` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `estActif` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `circuit`
--

INSERT INTO `circuit` (`idCircuit`, `titre`, `description`, `estActif`) VALUES
(5, 'Romance pour deux', 'Un voyage d\'une semaine dans les villes les plus romantiques de l\'Europe', 1),
(13, 'Promenade sur la mer avec un beau couche de soleil', 'Yo!', 0);

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `idCommande` int(11) NOT NULL,
  `idDepart` int(11) NOT NULL,
  `nbAdultes` int(11) DEFAULT '1',
  `nbEnfants` int(11) DEFAULT '0',
  `resteAPayer` int(11) DEFAULT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `commande`
--
DELIMITER $$
CREATE TRIGGER `updateNbPlacesDepart` AFTER INSERT ON `commande` FOR EACH ROW BEGIN
  update depart Set nbPlaces=nbPlaces-(new.nbAdultes+new.nbEnfants)
    where idDepart=new.idDepart;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `depart`
--

CREATE TABLE `depart` (
  `idDepart` int(11) NOT NULL,
  `idCircuit` int(11) NOT NULL,
  `dateDebut` date DEFAULT NULL,
  `nbPlaces` int(11) DEFAULT '10',
  `prix` double DEFAULT NULL,
  `titrePromotion` varchar(50) DEFAULT NULL,
  `rabais` double DEFAULT NULL,
  `estActif` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `depart`
--

INSERT INTO `depart` (`idDepart`, `idCircuit`, `dateDebut`, `nbPlaces`, `prix`, `titrePromotion`, `rabais`, `estActif`) VALUES
(4, 5, '2019-06-02', 30, 5000, 'vfv', 10, 0),
(5, 5, '2019-06-10', 30, 6000, '8000', 4, 0),
(6, 5, '2019-07-02', 30, 9000, 'ded', 6, 0),
(7, 5, '2019-08-02', 30, 5000, 'vfv55', 10, 0),
(11, 13, '2019-05-22', 1, 7888, 'Gratuit pour les belles personnes', 100, 0),
(12, 13, '2019-05-21', 1, 2345, 'cdcd', 23, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detailsimage`
--

CREATE TABLE `detailsimage` (
  `idDetailsImage` int(11) NOT NULL,
  `idCircuit` int(11) NOT NULL,
  `idImage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `etape`
--

CREATE TABLE `etape` (
  `idEtape` int(11) NOT NULL,
  `idCircuit` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `ordre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `etape`
--

INSERT INTO `etape` (`idEtape`, `idCircuit`, `nom`, `description`, `ordre`) VALUES
(5, 5, 'Paris', NULL, 1),
(6, 5, 'Florence', NULL, 2),
(7, 5, 'Venise', NULL, 3),
(8, 5, 'Barcelone', NULL, 4),
(37, 13, 'Dejeuner au caviare', 'Miam miam des oeuf de poissons', 0),
(38, 13, 'Saut de bonji', 'Youuuuuuh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hebergement`
--

CREATE TABLE `hebergement` (
  `idHebergement` int(11) NOT NULL,
  `idLieu` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `typeHebergement` varchar(50) DEFAULT NULL,
  `dejeunerInclus` tinyint(1) DEFAULT '0',
  `siteweb` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hebergement`
--

INSERT INTO `hebergement` (`idHebergement`, `idLieu`, `nom`, `typeHebergement`, `dejeunerInclus`, `siteweb`) VALUES
(1, 1, '', NULL, 0, NULL),
(2, 5, 'L\'auberge d\'amour', 'Modeste', 1, NULL),
(3, 6, 'Hilton', 'Luxe', 1, 'hilton.com'),
(4, 6, 'L\'hotel à Bob', 'Rustique', 0, NULL),
(5, 7, 'Hilton', 'Luxe', 1, 'hilton.com'),
(6, 7, 'airBnB', 'Luxe', 0, 'airbnb.com'),
(7, 8, 'Hilton', 'Luxe', 1, 'hilton.com'),
(8, 8, 'On charge à l\'heure', 'taux horaire', 0, NULL),
(19, 4, 'Camping on foret', 'Camping', 0, NULL),
(32, 3, 's', NULL, 0, NULL),
(33, 39, 't', NULL, 0, NULL),
(34, 40, 'r', NULL, 0, NULL),
(35, 7, 'g', NULL, 0, NULL),
(36, 41, '1', NULL, 0, NULL),
(37, 42, '2', NULL, 0, NULL),
(38, 43, '3', NULL, 0, NULL),
(39, 44, '4', NULL, 0, NULL),
(40, 6, 'r', NULL, 0, NULL),
(41, 2, 'e', NULL, 0, NULL),
(42, 6, 'a', NULL, 0, NULL),
(43, 45, 'airBnB', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `idImage` int(11) NOT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jour`
--

CREATE TABLE `jour` (
  `idJour` int(11) NOT NULL,
  `idLieu` int(10) DEFAULT NULL,
  `idEtape` int(11) NOT NULL,
  `idActivite` int(11) DEFAULT NULL,
  `idHebergement` int(11) DEFAULT NULL,
  `idDinner` int(11) DEFAULT NULL,
  `idSouper` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `jour`
--

INSERT INTO `jour` (`idJour`, `idLieu`, `idEtape`, `idActivite`, `idHebergement`, `idDinner`, `idSouper`) VALUES
(26, 6, 37, 11, 42, 54, 54),
(27, 45, 38, 1, 43, 63, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lieu`
--

CREATE TABLE `lieu` (
  `idLieu` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `pays` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lieu`
--

INSERT INTO `lieu` (`idLieu`, `nom`, `ville`, `pays`) VALUES
(1, NULL, NULL, NULL),
(7, NULL, 'Barcelone', 'Espagne'),
(6, NULL, 'Florence', 'France'),
(2, NULL, 'Montreal', 'Canada'),
(3, NULL, 'New-York', 'Etats-Unis'),
(5, NULL, 'Paris', 'France'),
(8, NULL, 'Venise', 'Italie'),
(41, '1', NULL, NULL),
(42, '2', NULL, NULL),
(43, '3', NULL, NULL),
(44, '4', NULL, NULL),
(45, 'Barcelone Espagne', NULL, NULL),
(40, 'rr', NULL, NULL),
(39, 'yt', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manger`
--

CREATE TABLE `manger` (
  `idManger` int(11) NOT NULL,
  `idLieu` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `siteweb` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manger`
--

INSERT INTO `manger` (`idManger`, `idLieu`, `nom`, `siteweb`) VALUES
(1, 1, '', NULL),
(46, 5, 'Le petit pain chaud', 'lepetitpainchaud.fr'),
(47, 5, 'Au café enchanté', 'enchanteCafe.fr'),
(48, 6, '', NULL),
(49, 6, 'La marmite à maman', 'marmitemarmite.fr'),
(50, 7, 'La soupe chaude', 'cestbondlasoupe.fr'),
(51, 7, 'Pizzaria mamamiya', 'mamamiya.com'),
(52, 8, 'Pasta pasta pasta', 'welovepasta.com'),
(53, 8, 'El restaurante bueno', 'lolwtf.com'),
(54, 6, 'De la bonne bouffe', NULL),
(55, 3, 's', NULL),
(56, 40, 'r', NULL),
(57, 7, 'g', NULL),
(58, 41, '1', NULL),
(59, 42, '2', NULL),
(60, 43, '3', NULL),
(61, 44, '4', NULL),
(62, 2, 'e', NULL),
(63, 45, 'd', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `idMessage` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `contenu` varchar(500) NOT NULL,
  `messageLu` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`idMessage`, `idUtilisateur`, `titre`, `contenu`, `messageLu`) VALUES
(1, 2, 'Annulation', 'J\'aimerais annuler mon voyage, car mon poisson rouge est malade et il a besoin de mon support morale. Merci de votre compréhension.', 0),
(2, 4, 'Très bon service à la clientèle', 'J\'ai été reçu par un gentilhomme nommé Abdel. Il avait un très bon service. Courtois, aimable, et beau. Puis-je avoir son numéro de téléphone stp?', 0),
(3, 2, 'Annulation', 'J\'aimerais annuler mon voyage, car mon poisson rouge est malade et il a besoin de mon support morale. Merci de votre compréhension.', 0),
(4, 4, 'Très bon service à la clientèle', 'J\'ai été reçu par un gentilhomme nommé Abdel. Il avait un très bon service. Courtois, aimable, et beau. Puis-je avoir son numéro de téléphone stp?', 0);

-- --------------------------------------------------------

--
-- Table structure for table `newletter`
--

CREATE TABLE `newletter` (
  `idNewletter` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `contenu` varchar(500) NOT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newletter`
--

INSERT INTO `newletter` (`idNewletter`, `idUtilisateur`, `titre`, `contenu`, `dateDebut`, `dateFin`) VALUES
(1, 6, 'Une tempête frappe Milan', 'Les destinations voyage en direction de Milan sont interrompu jusqu\'à nouvelle ordre. Merci de votre compréhension..', '2019-05-16', '2019-05-20'),
(2, 6, 'message1', 'problems!!!', '2019-05-21', '2019-05-22'),
(3, 6, 'Chaleur extreme au bresil', 'Creme soleil obligatoire.', '2019-05-21', '2019-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `idPanier` int(11) NOT NULL,
  `idDepart` int(11) NOT NULL,
  `nbAdultes` int(11) DEFAULT '1',
  `nbEnfants` int(11) DEFAULT '0',
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `courriel` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT 'p@ssw0rd',
  `sexe` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `codePostal` varchar(50) DEFAULT NULL,
  `pays` varchar(50) DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'Membre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `prenom`, `nom`, `courriel`, `password`, `sexe`, `adresse`, `ville`, `codePostal`, `pays`, `role`) VALUES
(2, 'Charles', 'Tremblay', 'charles@hotmail.com', 'chatetchien', 'Homme', '123 rue de la porte', 'Montreal', 'H4K9D3', 'Canada', 'Membre'),
(3, 'Suzie', 'Karate', 'Suzi@outlook.com', 'ilovemaman', 'Femme', '345 rue Sherbrooke', 'Montreal', 'G8K9D7', 'Canada', 'Admin'),
(4, 'Jose', 'Gonzalez', 'jose@gmail.com', 'poutine', 'Homme', '9876 Saint-Andre', 'Montrel', 'H4K9D3', 'Canada', 'Membre'),
(5, 'Catherine', 'Cossette', 'catherine_45@hotmail.com', 'ryanna', 'Femmme', '5667 du Diable', 'Quebec', 'H4K9D3', 'Canada', 'Membre'),
(6, 'Admin', 'Istrateur', 'admin@gmail.com', 'admin', 'non-binaire', '456 rue de la programmation', 'Montreal', 'K9F3H6', 'Canada', 'Admin'),
(13, 'Julien', 'Ouellet', 'exemple@hotmail.fr', '$2y$10$huvRPBPr8CzAHA1g0p7gHe3EHTtQAy6/EVX7RyOt1RdWjlxm4X/0K', NULL, NULL, NULL, NULL, NULL, 'Membre'),
(14, 'Abdel', 'Hidalgo', 'abdel.hidalgo@gmail.com', 'p@ssw0rd', NULL, NULL, NULL, NULL, NULL, 'Membre');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`idActivite`),
  ADD UNIQUE KEY `idLieu_2` (`idLieu`,`nom`),
  ADD KEY `idLieu` (`idLieu`);

--
-- Indexes for table `circuit`
--
ALTER TABLE `circuit`
  ADD PRIMARY KEY (`idCircuit`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `idDepart` (`idDepart`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Indexes for table `depart`
--
ALTER TABLE `depart`
  ADD PRIMARY KEY (`idDepart`),
  ADD KEY `idCircuit` (`idCircuit`);

--
-- Indexes for table `detailsimage`
--
ALTER TABLE `detailsimage`
  ADD PRIMARY KEY (`idDetailsImage`),
  ADD KEY `idCircuit` (`idCircuit`),
  ADD KEY `idImage` (`idImage`);

--
-- Indexes for table `etape`
--
ALTER TABLE `etape`
  ADD PRIMARY KEY (`idEtape`),
  ADD KEY `idCircuit` (`idCircuit`);

--
-- Indexes for table `hebergement`
--
ALTER TABLE `hebergement`
  ADD PRIMARY KEY (`idHebergement`),
  ADD UNIQUE KEY `idLieu_2` (`idLieu`,`nom`),
  ADD KEY `idLieu` (`idLieu`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`idImage`);

--
-- Indexes for table `jour`
--
ALTER TABLE `jour`
  ADD PRIMARY KEY (`idJour`),
  ADD KEY `idEtape` (`idEtape`),
  ADD KEY `idActivite` (`idActivite`),
  ADD KEY `idDinner` (`idDinner`),
  ADD KEY `idHebergement` (`idHebergement`),
  ADD KEY `idSouper` (`idSouper`),
  ADD KEY `idLieu` (`idLieu`);

--
-- Indexes for table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`idLieu`),
  ADD UNIQUE KEY `nom` (`nom`,`ville`,`pays`);

--
-- Indexes for table `manger`
--
ALTER TABLE `manger`
  ADD PRIMARY KEY (`idManger`),
  ADD UNIQUE KEY `idLieu_2` (`idLieu`,`nom`),
  ADD KEY `idLieu` (`idLieu`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idMessage`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Indexes for table `newletter`
--
ALTER TABLE `newletter`
  ADD PRIMARY KEY (`idNewletter`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`idPanier`),
  ADD KEY `idDepart` (`idDepart`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activite`
--
ALTER TABLE `activite`
  MODIFY `idActivite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `circuit`
--
ALTER TABLE `circuit`
  MODIFY `idCircuit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `depart`
--
ALTER TABLE `depart`
  MODIFY `idDepart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `detailsimage`
--
ALTER TABLE `detailsimage`
  MODIFY `idDetailsImage` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `etape`
--
ALTER TABLE `etape`
  MODIFY `idEtape` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `hebergement`
--
ALTER TABLE `hebergement`
  MODIFY `idHebergement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `idImage` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jour`
--
ALTER TABLE `jour`
  MODIFY `idJour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `idLieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `manger`
--
ALTER TABLE `manger`
  MODIFY `idManger` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `newletter`
--
ALTER TABLE `newletter`
  MODIFY `idNewletter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `idPanier` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `activite`
--
ALTER TABLE `activite`
  ADD CONSTRAINT `activite_ibfk_1` FOREIGN KEY (`idLieu`) REFERENCES `lieu` (`idLieu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idDepart`) REFERENCES `depart` (`idDepart`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `depart`
--
ALTER TABLE `depart`
  ADD CONSTRAINT `depart_ibfk_2` FOREIGN KEY (`idCircuit`) REFERENCES `circuit` (`idCircuit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detailsimage`
--
ALTER TABLE `detailsimage`
  ADD CONSTRAINT `detailsimage_ibfk_1` FOREIGN KEY (`idCircuit`) REFERENCES `circuit` (`idCircuit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailsimage_ibfk_2` FOREIGN KEY (`idImage`) REFERENCES `image` (`idImage`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `etape`
--
ALTER TABLE `etape`
  ADD CONSTRAINT `etape_ibfk_1` FOREIGN KEY (`idCircuit`) REFERENCES `circuit` (`idCircuit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hebergement`
--
ALTER TABLE `hebergement`
  ADD CONSTRAINT `hebergement_ibfk_1` FOREIGN KEY (`idLieu`) REFERENCES `lieu` (`idLieu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jour`
--
ALTER TABLE `jour`
  ADD CONSTRAINT `jour_ibfk_1` FOREIGN KEY (`idEtape`) REFERENCES `etape` (`idEtape`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jour_ibfk_2` FOREIGN KEY (`idActivite`) REFERENCES `activite` (`idActivite`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jour_ibfk_3` FOREIGN KEY (`idDinner`) REFERENCES `manger` (`idManger`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jour_ibfk_4` FOREIGN KEY (`idHebergement`) REFERENCES `hebergement` (`idHebergement`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jour_ibfk_6` FOREIGN KEY (`idSouper`) REFERENCES `manger` (`idManger`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jour_ibfk_7` FOREIGN KEY (`idLieu`) REFERENCES `lieu` (`idLieu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manger`
--
ALTER TABLE `manger`
  ADD CONSTRAINT `manger_ibfk_1` FOREIGN KEY (`idLieu`) REFERENCES `lieu` (`idLieu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `newletter`
--
ALTER TABLE `newletter`
  ADD CONSTRAINT `newletter_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`idDepart`) REFERENCES `depart` (`idDepart`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
