-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 01 mai 2019 à 23:08
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbvoyage`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

CREATE TABLE `activite` (
  `idActivite` int(11) NOT NULL,
  `idLieu` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `siteweb` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `circuit`
--

CREATE TABLE `circuit` (
  `idCircuit` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `nbEtapes` int(11) DEFAULT '1',
  `estActif` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `circuit`
--

INSERT INTO `circuit` (`idCircuit`, `titre`, `description`, `nbEtapes`, `estActif`) VALUES
(5, 'Romance pour deux', 'Un voyage d\'une semaine dans les villes les plus romantiques de l\'Europe', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
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
-- Déclencheurs `commande`
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
-- Structure de la table `depart`
--

CREATE TABLE `depart` (
  `idDepart` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idCircuit` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date DEFAULT NULL,
  `nbPlaces` int(11) DEFAULT '10',
  `prix` double NOT NULL,
  `titrePromotion` varchar(50) DEFAULT NULL,
  `rabais` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `detailsactivite`
--

CREATE TABLE `detailsactivite` (
  `idDetailsActivite` int(11) NOT NULL,
  `idActivite` int(11) NOT NULL,
  `idEtape` int(11) NOT NULL,
  `dateDebut` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `detailshebergement`
--

CREATE TABLE `detailshebergement` (
  `idDetailsHebergement` int(11) NOT NULL,
  `idHebergement` int(11) NOT NULL,
  `idEtape` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `nbJours` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `detailslieu`
--

CREATE TABLE `detailslieu` (
  `idDetailsLieu` int(11) NOT NULL,
  `idEtape` int(11) NOT NULL,
  `idLieu` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `nbJour` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `detailsmanger`
--

CREATE TABLE `detailsmanger` (
  `idDetailsManger` int(11) NOT NULL,
  `idManger` int(11) NOT NULL,
  `idEtape` int(11) NOT NULL,
  `typeRepas` varchar(50) DEFAULT NULL,
  `dateDebut` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

CREATE TABLE `etape` (
  `idEtape` int(11) NOT NULL,
  `idCircuit` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `ordre` int(11) NOT NULL,
  `nbJour` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `etape`
--

INSERT INTO `etape` (`idEtape`, `idCircuit`, `nom`, `description`, `ordre`, `nbJour`) VALUES
(5, 5, 'Paris', NULL, 1, 2),
(6, 5, 'Florence', NULL, 2, 2),
(7, 5, 'Venise', NULL, 3, 2),
(8, 5, 'Barcelone', NULL, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `hebergement`
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
-- Déchargement des données de la table `hebergement`
--

INSERT INTO `hebergement` (`idHebergement`, `idLieu`, `nom`, `typeHebergement`, `dejeunerInclus`, `siteweb`) VALUES
(1, 5, 'Hilton', 'Luxe', 1, 'hilton.com'),
(2, 5, 'L\'auberge d\'amour', 'Modeste', 1, NULL),
(3, 6, 'Hilton', 'Luxe', 1, 'hilton.com'),
(4, 6, 'L\'hotel à Bob', 'Rustique', 0, NULL),
(5, 7, 'Hilton', 'Luxe', 1, 'hilton.com'),
(6, 7, 'airBnB', 'Luxe', 0, 'airbnb.com'),
(7, 8, 'Hilton', 'Luxe', 1, 'hilton.com'),
(8, 8, 'On charge à l\'heure', 'taux horaire', 0, NULL),
(9, 4, 'Camping on foret', 'Camping', 0, NULL),
(10, 1, 'Chambre sur croisière', 'Luxe', 1, 'croisieredereve.com'),
(11, 5, 'Hilton', 'Luxe', 1, 'hilton.com'),
(12, 5, 'L\'auberge d\'amour', 'Modeste', 1, NULL),
(13, 6, 'Hilton', 'Luxe', 1, 'hilton.com'),
(14, 6, 'L\'hotel à Bob', 'Rustique', 0, NULL),
(15, 7, 'Hilton', 'Luxe', 1, 'hilton.com'),
(16, 7, 'airBnB', 'Luxe', 0, 'airbnb.com'),
(17, 8, 'Hilton', 'Luxe', 1, 'hilton.com'),
(18, 8, 'On charge à l\'heure', 'taux horaire', 0, NULL),
(19, 4, 'Camping on foret', 'Camping', 0, NULL),
(20, 1, 'Chambre sur croisière', 'Luxe', 1, 'croisieredereve.com');

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE `lieu` (
  `idLieu` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `pays` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lieu`
--

INSERT INTO `lieu` (`idLieu`, `nom`, `ville`, `pays`) VALUES
(1, 'Ocean pacifique', NULL, NULL),
(2, NULL, 'Montreal', 'Canada'),
(3, NULL, 'New-York', 'Etats-Unis'),
(4, 'Foret amazonie', NULL, 'Brezil'),
(5, NULL, 'Paris', 'France'),
(6, '', 'Florence', 'France'),
(7, NULL, 'Barcelone', 'Espagne'),
(8, NULL, 'Venise', 'Italie');

-- --------------------------------------------------------

--
-- Structure de la table `manger`
--

CREATE TABLE `manger` (
  `idManger` int(11) NOT NULL,
  `idLieu` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `siteweb` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `manger`
--

INSERT INTO `manger` (`idManger`, `idLieu`, `nom`, `siteweb`) VALUES
(46, 5, 'Le petit pain chaud', 'lepetitpainchaud.fr'),
(47, 5, 'Au café enchanté', 'enchanteCafe.fr'),
(48, 6, '', NULL),
(49, 6, 'La marmite à maman', 'marmitemarmite.fr'),
(50, 7, 'La soupe chaude', 'cestbondlasoupe.fr'),
(51, 7, 'Pizzaria mamamiya', 'mamamiya.com'),
(52, 8, 'Pasta pasta pasta', 'welovepasta.com'),
(53, 8, 'El restaurante bueno', 'lolwtf.com'),
(54, 6, 'De la bonne bouffe', NULL),
(55, 5, 'Le petit pain chaud', 'lepetitpainchaud.fr'),
(56, 5, 'Au café enchanté', 'enchanteCafe.fr'),
(57, 6, '', NULL),
(58, 6, 'La marmite à maman', 'marmitemarmite.fr'),
(59, 7, 'La soupe chaude', 'cestbondlasoupe.fr'),
(60, 7, 'Pizzaria mamamiya', 'mamamiya.com'),
(61, 8, 'Pasta pasta pasta', 'welovepasta.com'),
(62, 8, 'El restaurante bueno', 'lolwtf.com'),
(63, 6, 'De la bonne bouffe', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `idMessage` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `contenu` varchar(500) NOT NULL,
  `messageLu` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`idMessage`, `idUtilisateur`, `titre`, `contenu`, `messageLu`) VALUES
(1, 2, 'Annulation', 'J\'aimerais annuler mon voyage, car mon poisson rouge est malade et il a besoin de mon support morale. Merci de votre compréhension.', 0),
(2, 4, 'Très bon service à la clientèle', 'J\'ai été reçu par un gentilhomme nommé Abdel. Il avait un très bon service. Courtois, aimable, et beau. Puis-je avoir son numéro de téléphone stp?', 0),
(3, 2, 'Annulation', 'J\'aimerais annuler mon voyage, car mon poisson rouge est malade et il a besoin de mon support morale. Merci de votre compréhension.', 0),
(4, 4, 'Très bon service à la clientèle', 'J\'ai été reçu par un gentilhomme nommé Abdel. Il avait un très bon service. Courtois, aimable, et beau. Puis-je avoir son numéro de téléphone stp?', 0);

-- --------------------------------------------------------

--
-- Structure de la table `newletter`
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
-- Déchargement des données de la table `newletter`
--

INSERT INTO `newletter` (`idNewletter`, `idUtilisateur`, `titre`, `contenu`, `dateDebut`, `dateFin`) VALUES
(1, 6, 'Une tempête frappe Milan', 'Les destinations voyage en direction de Milan sont interrompu jusqu\'à nouvelle ordre. Merci de votre compréhension..', '2019-05-16', '2019-05-30'),
(2, 6, 'Une tempête frappe Milan', 'Les destinations voyage en direction de Milan sont interrompu jusqu\'à nouvelle ordre. Merci de votre compréhension..', '2019-05-16', '2019-05-30');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
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
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `courriel` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sexe` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `codePostal` varchar(50) DEFAULT NULL,
  `pays` varchar(50) DEFAULT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `prenom`, `nom`, `courriel`, `password`, `sexe`, `adresse`, `ville`, `codePostal`, `pays`, `role`) VALUES
(2, 'Charles', 'Tremblay', 'charles@hotmail.com', 'chatetchien', 'Homme', '123 rue de la porte', 'Montreal', 'H4K9D3', 'Canada', 'Membre'),
(3, 'Suzie', 'Karate', 'Suzi@outlook.com', 'ilovemaman', 'Femme', '345 rue Sherbrooke', 'Montreal', 'G8K9D7', 'Canada', 'Admin'),
(4, 'Jose', 'Gonzalez', 'jose@gmail.com', 'poutine', 'Homme', '9876 Saint-Andre', 'Montrel', 'H4K9D3', 'Canada', 'Membre'),
(5, 'Catherine', 'Cossette', 'catherine_45@hotmail.com', 'ryanna', 'Femmme', '5667 du Diable', 'Quebec', 'H4K9D3', 'Canada', 'Membre'),
(6, 'Admin', 'Istrateur', 'admin@gmail.com', 'admin', 'non-binaire', '456 rue de la programmation', 'Montreal', 'K9F3H6', 'Canada', 'Admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`idActivite`),
  ADD KEY `idLieu` (`idLieu`);

--
-- Index pour la table `circuit`
--
ALTER TABLE `circuit`
  ADD PRIMARY KEY (`idCircuit`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `idDepart` (`idDepart`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `depart`
--
ALTER TABLE `depart`
  ADD PRIMARY KEY (`idDepart`),
  ADD KEY `idUtilisateur` (`idUtilisateur`),
  ADD KEY `idCircuit` (`idCircuit`);

--
-- Index pour la table `detailsactivite`
--
ALTER TABLE `detailsactivite`
  ADD PRIMARY KEY (`idDetailsActivite`),
  ADD KEY `idActivite` (`idActivite`),
  ADD KEY `idEtape` (`idEtape`);

--
-- Index pour la table `detailshebergement`
--
ALTER TABLE `detailshebergement`
  ADD PRIMARY KEY (`idDetailsHebergement`),
  ADD KEY `idEtape` (`idEtape`),
  ADD KEY `idHebergement` (`idHebergement`);

--
-- Index pour la table `detailslieu`
--
ALTER TABLE `detailslieu`
  ADD PRIMARY KEY (`idDetailsLieu`),
  ADD KEY `idEtape` (`idEtape`),
  ADD KEY `idLieu` (`idLieu`);

--
-- Index pour la table `detailsmanger`
--
ALTER TABLE `detailsmanger`
  ADD PRIMARY KEY (`idDetailsManger`),
  ADD KEY `idEtape` (`idEtape`),
  ADD KEY `idManger` (`idManger`);

--
-- Index pour la table `etape`
--
ALTER TABLE `etape`
  ADD PRIMARY KEY (`idEtape`),
  ADD KEY `idCircuit` (`idCircuit`);

--
-- Index pour la table `hebergement`
--
ALTER TABLE `hebergement`
  ADD PRIMARY KEY (`idHebergement`),
  ADD KEY `idLieu` (`idLieu`);

--
-- Index pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`idLieu`);

--
-- Index pour la table `manger`
--
ALTER TABLE `manger`
  ADD PRIMARY KEY (`idManger`),
  ADD KEY `idLieu` (`idLieu`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idMessage`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `newletter`
--
ALTER TABLE `newletter`
  ADD PRIMARY KEY (`idNewletter`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`idPanier`),
  ADD KEY `idDepart` (`idDepart`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activite`
--
ALTER TABLE `activite`
  MODIFY `idActivite` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `circuit`
--
ALTER TABLE `circuit`
  MODIFY `idCircuit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `depart`
--
ALTER TABLE `depart`
  MODIFY `idDepart` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `detailsactivite`
--
ALTER TABLE `detailsactivite`
  MODIFY `idDetailsActivite` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `detailshebergement`
--
ALTER TABLE `detailshebergement`
  MODIFY `idDetailsHebergement` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `detailslieu`
--
ALTER TABLE `detailslieu`
  MODIFY `idDetailsLieu` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `detailsmanger`
--
ALTER TABLE `detailsmanger`
  MODIFY `idDetailsManger` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `etape`
--
ALTER TABLE `etape`
  MODIFY `idEtape` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `hebergement`
--
ALTER TABLE `hebergement`
  MODIFY `idHebergement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `idLieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `manger`
--
ALTER TABLE `manger`
  MODIFY `idManger` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `newletter`
--
ALTER TABLE `newletter`
  MODIFY `idNewletter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `idPanier` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activite`
--
ALTER TABLE `activite`
  ADD CONSTRAINT `activite_ibfk_1` FOREIGN KEY (`idLieu`) REFERENCES `lieu` (`idLieu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idDepart`) REFERENCES `depart` (`idDepart`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `depart`
--
ALTER TABLE `depart`
  ADD CONSTRAINT `depart_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `depart_ibfk_2` FOREIGN KEY (`idCircuit`) REFERENCES `circuit` (`idCircuit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `detailsactivite`
--
ALTER TABLE `detailsactivite`
  ADD CONSTRAINT `detailsactivite_ibfk_1` FOREIGN KEY (`idActivite`) REFERENCES `activite` (`idActivite`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailsactivite_ibfk_2` FOREIGN KEY (`idEtape`) REFERENCES `etape` (`idEtape`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `detailshebergement`
--
ALTER TABLE `detailshebergement`
  ADD CONSTRAINT `detailshebergement_ibfk_1` FOREIGN KEY (`idEtape`) REFERENCES `etape` (`idEtape`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailshebergement_ibfk_2` FOREIGN KEY (`idHebergement`) REFERENCES `hebergement` (`idHebergement`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `detailslieu`
--
ALTER TABLE `detailslieu`
  ADD CONSTRAINT `detailslieu_ibfk_1` FOREIGN KEY (`idEtape`) REFERENCES `etape` (`idEtape`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailslieu_ibfk_2` FOREIGN KEY (`idLieu`) REFERENCES `lieu` (`idLieu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `detailsmanger`
--
ALTER TABLE `detailsmanger`
  ADD CONSTRAINT `detailsmanger_ibfk_1` FOREIGN KEY (`idEtape`) REFERENCES `etape` (`idEtape`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailsmanger_ibfk_2` FOREIGN KEY (`idManger`) REFERENCES `manger` (`idManger`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etape`
--
ALTER TABLE `etape`
  ADD CONSTRAINT `etape_ibfk_1` FOREIGN KEY (`idCircuit`) REFERENCES `circuit` (`idCircuit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `hebergement`
--
ALTER TABLE `hebergement`
  ADD CONSTRAINT `hebergement_ibfk_1` FOREIGN KEY (`idLieu`) REFERENCES `lieu` (`idLieu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `manger`
--
ALTER TABLE `manger`
  ADD CONSTRAINT `manger_ibfk_1` FOREIGN KEY (`idLieu`) REFERENCES `lieu` (`idLieu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `newletter`
--
ALTER TABLE `newletter`
  ADD CONSTRAINT `newletter_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`idDepart`) REFERENCES `depart` (`idDepart`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
