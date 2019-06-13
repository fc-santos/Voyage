-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 13 juin 2019 à 20:43
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

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

--
-- Déchargement des données de la table `activite`
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
(11, 6, 'a', NULL, NULL),
(12, 49, 'Visite des musées', NULL, NULL),
(13, 50, 'Visite de sites historiques', NULL, NULL),
(14, 51, 'Visite des vignobles espagnols', NULL, NULL),
(15, 52, 'Match de soccer ', NULL, NULL),
(16, 53, 'Visite des musées', NULL, NULL),
(17, 54, 'Visite de sites historiques', NULL, NULL),
(18, 55, 'Activite Florence', NULL, NULL),
(19, 56, 'Activite Barcelone', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `alerts`
--

CREATE TABLE `alerts` (
  `idAlerte` int(11) NOT NULL,
  `textAlert` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `alerteLu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `circuit`
--

CREATE TABLE `circuit` (
  `idCircuit` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text,
  `estActif` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `circuit`
--

INSERT INTO `circuit` (`idCircuit`, `titre`, `description`, `estActif`) VALUES
(5, 'Romance pour deux', 'Un voyage d\'une semaine dans les villes les plus romantiques de l\'Europe', 1),
(13, 'Promenade sur la mer avec un beau couche de soleil', 'Yo!', 0),
(14, 'argr', 'ghg', 0),
(15, 'Flamenco, Olives et Paëlla', 'Partez à la découverte d’un pays, d’une histoire et d’un peuple passionnants et passionnés : de Madrid, la capitale, de Barcelone, reconnue mondialement, en passant par l’Andalousie, région au caractère si affirmé et où le mélange des différentes religions et civilisations se marie aussi bien que les différentes couleurs d’une toile de maître… Nous vous proposons également un détour par les trois côtes : Costa del Sol, Costa Blanca et Costa Brava. L’essentiel de l’Espagne en un voyage !', 0),
(16, 'Italie2', 'bonjour italie2', 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `idCommande` int(11) NOT NULL,
  `idDepart` int(11) NOT NULL,
  `nbAdultes` int(11) DEFAULT '1',
  `nbEnfants` int(11) DEFAULT '0',
  `resteAPayer` double DEFAULT NULL,
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
  `idCircuit` int(11) NOT NULL,
  `dateDebut` date DEFAULT NULL,
  `nbPlaces` int(11) DEFAULT '10',
  `prix` double DEFAULT NULL,
  `titrePromotion` varchar(50) DEFAULT NULL,
  `rabais` double DEFAULT NULL,
  `estActif` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `depart`
--

INSERT INTO `depart` (`idDepart`, `idCircuit`, `dateDebut`, `nbPlaces`, `prix`, `titrePromotion`, `rabais`, `estActif`) VALUES
(4, 5, '2019-06-02', 30, 5000, 'vfv', 10, 0),
(5, 5, '2019-06-10', 30, 6000, '8000', 4, 0),
(6, 5, '2019-07-02', 30, 9000, 'ded', 6, 0),
(7, 5, '2019-08-02', 30, 5000, 'vfv55', 10, 0),
(11, 13, '2019-05-22', 1, 7888, 'Gratuit pour les belles personnes', 100, 0),
(14, 15, '2019-06-17', 20, 7500, 'Promotion pour les nouveaux finissants', 0.03, 0),
(15, 13, '2019-06-13', 20, 3500, 'none', 0, 0),
(16, 13, '2019-06-13', 10, 4500, 'none', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `detailsimage`
--

CREATE TABLE `detailsimage` (
  `idDetailsImage` int(11) NOT NULL,
  `idCircuit` int(11) NOT NULL,
  `idImage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

CREATE TABLE `etape` (
  `idEtape` int(11) NOT NULL,
  `idCircuit` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `descriptionEtape` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `ordre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `etape`
--

INSERT INTO `etape` (`idEtape`, `idCircuit`, `nom`, `descriptionEtape`, `ordre`) VALUES
(5, 5, 'Paris', NULL, 1),
(6, 5, 'Florence', NULL, 2),
(7, 5, 'Venise', NULL, 3),
(8, 5, 'Barcelone', NULL, 4),
(37, 13, 'Dejeuner au caviare', 'Miam miam des oeuf de poissons', 0),
(38, 13, 'Saut de bonji', 'Youuuuuuh', 1),
(39, 14, 'htght', 'grgr', 0),
(40, 15, 'Étape 1', 'La première étape', 0),
(41, 15, 'Étape 2', 'La deuxième étape', 1);

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
(43, 45, 'airBnB', NULL, 0, NULL),
(44, 46, 'ddd', NULL, 0, NULL),
(45, 47, 'dddd', NULL, 0, NULL),
(46, 48, 'rrrr', NULL, 0, NULL),
(47, 49, 'Hebergement 1', NULL, 0, NULL),
(48, 50, 'Hbergement 1', NULL, 0, NULL),
(49, 51, 'Hebergement 3', NULL, 0, NULL),
(50, 52, 'Hebergement 4', NULL, 0, NULL),
(51, 53, 'Hebergement 1', NULL, 0, NULL),
(52, 54, 'Hebergement 1', NULL, 0, NULL),
(53, 55, 'Herbergement Florence', NULL, 0, NULL),
(54, 56, 'Hebergement Barcelone', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `idImage` int(11) NOT NULL,
  `idCircuit` int(11) DEFAULT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`idImage`, `idCircuit`, `url`) VALUES
(1, 0, 'assets/images/.jpg'),
(2, 15, 'assets/images/.jpg'),
(3, 16, 'assets/images/.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `jour`
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
-- Déchargement des données de la table `jour`
--

INSERT INTO `jour` (`idJour`, `idLieu`, `idEtape`, `idActivite`, `idHebergement`, `idDinner`, `idSouper`) VALUES
(26, 55, 37, 18, 53, 77, 76),
(27, 56, 38, 19, 54, 79, 78),
(28, 53, 40, 16, 51, 73, 72),
(29, 54, 40, 17, 52, 75, 74),
(30, 51, 41, 14, 49, 69, 68),
(31, 52, 41, 15, 50, 71, 70);

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
(1, NULL, NULL, NULL),
(50, NULL, 'Barcelone', NULL),
(56, NULL, 'Barcelone', NULL),
(7, NULL, 'Barcelone', 'Espagne'),
(51, NULL, 'Barcelone | Valence', NULL),
(55, NULL, 'Florence', NULL),
(6, NULL, 'Florence', 'France'),
(2, NULL, 'Montreal', 'Canada'),
(53, NULL, 'Montréal | Barcelone', NULL),
(3, NULL, 'New-York', 'Etats-Unis'),
(5, NULL, 'Paris', 'France'),
(8, NULL, 'Venise', 'Italie'),
(41, '1', NULL, NULL),
(42, '2', NULL, NULL),
(43, '3', NULL, NULL),
(44, '4', NULL, NULL),
(54, 'Barcelone', NULL, NULL),
(45, 'Barcelone Espagne', NULL, NULL),
(47, 'ddddd', NULL, NULL),
(46, 'ddr', NULL, NULL),
(49, 'Montréal | Barcelone', NULL, NULL),
(40, 'rr', NULL, NULL),
(48, 'rrrr', NULL, NULL),
(52, 'Valence | Tolede | Madrid', NULL, NULL),
(39, 'yt', NULL, NULL);

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
(63, 45, 'd', NULL),
(64, 49, 'Disfrutar Barcelona', NULL),
(65, 49, 'Viana Barcelona', NULL),
(66, 50, 'Lasarte', NULL),
(67, 50, 'Uma', NULL),
(68, 51, 'La gastronomica', NULL),
(69, 51, 'Can Dende', NULL),
(70, 52, 'El National', NULL),
(71, 52, 'Koy Shunka', NULL),
(72, 53, 'Disfrutar Barcelona', NULL),
(73, 53, 'Viana Barcelona', NULL),
(74, 54, 'Lasarte', NULL),
(75, 54, 'Uma', NULL),
(76, 55, 'Souper Florence', NULL),
(77, 55, 'Dinner Florence', NULL),
(78, 56, 'Souper Barcelone', NULL),
(79, 56, 'Dinner Barcelone', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `idMessage` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `contenu` varchar(500) NOT NULL,
  `date` datetime DEFAULT NULL,
  `messageLu` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`idMessage`, `idUtilisateur`, `titre`, `contenu`, `date`, `messageLu`) VALUES
(1, 2, 'Annulation', 'J\'aimerais annuler mon voyage, car mon poisson rouge est malade et il a besoin de mon support morale. Merci de votre compréhension.', '2019-05-03 14:16:07', 1),
(2, 4, 'Très bon service à la clientèle', 'J\'ai été reçu par un gentilhomme nommé Abdel. Il avait un très bon service. Courtois, aimable, et beau. Puis-je avoir son numéro de téléphone stp?', '2019-06-02 18:51:29', 1),
(3, 3, 'Modification page circuits', 'Notez le changement dans la page circuits. Il fault notifier a tous les administrateurs.', '2019-03-02 02:06:03', 1),
(4, 6, 'Notification', 'Le serveur va être mis à jour la prochaine semaine. Tous les services seront inaccesibles.', '2019-06-02 15:24:24', 1),
(5, 3, 'Problème avec un client', 'Un client veut changer la date de son circuit, mais le circuit pour la date qu\'il a choisi est complet', '2019-06-03 07:00:00', 1),
(7, 3, 'test', 'test contenu', '2019-06-01 08:00:00', 1);

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
(1, 6, 'Une tempête frappe Milan', 'Les destinations voyage en direction de Milan sont interrompu jusqu\'à nouvelle ordre. Merci de votre compréhension..', '2019-05-16', '2019-05-20'),
(2, 6, 'message1', 'problems!!!', '2019-05-21', '2019-05-22'),
(3, 6, 'Chaleur extreme au bresil', 'Creme soleil obligatoire.', '2019-05-21', '2019-05-22');

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
  `password` varchar(100) NOT NULL DEFAULT 'p@ssw0rd',
  `sexe` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `codePostal` varchar(50) DEFAULT NULL,
  `pays` varchar(50) DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'Membre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `prenom`, `nom`, `courriel`, `password`, `sexe`, `adresse`, `ville`, `codePostal`, `pays`, `role`) VALUES
(1, 'Anonyme', '', 'anonyme@example.com', '$2y$10$/DyGubSYI39Fq468Ig.8J.IwCFbgxmQiWC/hW54YpvdIHZ1w6ftFy', NULL, NULL, NULL, NULL, NULL, 'Admin'),
(2, 'Charles', 'Tremblay', 'charles@hotmail.com', 'chatetchien', 'Homme', '123 rue de la porte', 'Montreal', 'H4K9D3', 'Canada', 'Membre'),
(3, 'Suzie', 'Karate', 'Suzi@outlook.com', 'ilovemaman', 'Femme', '345 rue Sherbrooke', 'Montreal', 'G8K9D7', 'Canada', 'Membre'),
(4, 'Jose', 'Gonzalez', 'jose@gmail.com', 'poutine', 'Homme', '9876 Saint-Andre', 'Montrel', 'H4K9D3', 'Canada', 'Admin'),
(5, 'Catherine', 'Cossette', 'catherine_45@hotmail.com', 'ryanna', 'Femmme', '5667 du Diable', 'Quebec', 'H4K9D3', 'Canada', 'Admin'),
(6, 'Admin', 'Istrateur', 'admin@gmail.com', 'admin', 'non-binaire', '456 rue de la programmation', 'Montreal', 'K9F3H6', 'Canada', 'Admin'),
(13, 'Julien', 'Ouellet', 'exemple@hotmail.fr', '$2y$10$huvRPBPr8CzAHA1g0p7gHe3EHTtQAy6/EVX7RyOt1RdWjlxm4X/0K', NULL, NULL, NULL, NULL, NULL, 'Admin'),
(15, 'tt', 'tt', 'ttt@s.com', '$2y$10$c80KFdmlSxlWJ7DR/mjC7uzplufnPoh0JPiAvhMGSpt/o4Y8BnL5W', NULL, NULL, NULL, NULL, NULL, 'Admin'),
(16, 'rrrrr', 'rrrr', 'ttrrt@s.com', '$2y$10$DI8iCyJ6sxiFI1ScfbMcrOPT19tdUDFGJffQBIvWtz6bQhY/3LfmW', NULL, NULL, NULL, NULL, NULL, 'Admin'),
(17, 'qqqq', 'qqqq', 'sss@gmail.com', '$2y$10$FaYXVGdF4ZURenyDpQeH1.mwbsIYQY/0Fs7BIQQxNnLXLt9kOtsFC', NULL, NULL, NULL, NULL, NULL, 'Admin'),
(18, 'Abdel17', 'Hidalgo1', 'abdel.hidalgo@gmail.com', '$2y$10$dvbR1xS.NYfolfY0kk5Roeh3AWzuj9KRU2Ju.CVxc6RLUZ7KiWJze', NULL, NULL, NULL, NULL, NULL, 'Admin'),
(19, 'abdel1', 'abdel1', 'abdel1@gmail.com', '$2y$10$tgCGA2464OAe6.432QoY2umsGOMZ1Vt7IYiZ/FvOTRFhfaSuwZ0OS', NULL, NULL, NULL, NULL, NULL, 'Admin'),
(20, 'gtgtgggggtg', 'gtgggg', 'gtgtg@gmail.com', '$2y$10$dM8uCwe7qJ4juMtt6bDgfeAW8YXPsCooRR0PEJVlOQYE0JDVr3x6G', NULL, NULL, NULL, NULL, NULL, 'Admin'),
(21, 'frfr', 'frfr', 'frfr@gmail.com', '$2y$10$Jb0q344hyEosp0L804m/yuewO4QfhGc3zh665h0XOTG1Z4bJrBtde', NULL, NULL, NULL, NULL, NULL, 'Admin'),
(22, 'cdcd', 'cdc', 'dcdc@gmail.com', '$2y$10$FzQpLWQz2gNUmoBSQU8JgedsH1.Yli0/Hn6cYl/tOMWROTpXS.7vO', NULL, NULL, NULL, NULL, NULL, 'Admin'),
(23, 'frfrf', 'frfrf', 'frfrxsxsxxx@gmail.com', '$2y$10$Z48JChOY.9bVHij8WUeJme34R8oemW8IPSLwXAntQy06p5ncnL6q2', NULL, NULL, NULL, NULL, NULL, 'Admin'),
(24, 'frfrfrf', 'rfrf', 'dedde@gmail.com', '$2y$10$c1Y9Y4swMacjr0uLJlOJYe1M.Z54Xr9DAxH34.JSkEXksumcDFdLy', NULL, NULL, NULL, NULL, NULL, 'Admin'),
(25, 'Filipe', 'Santos', 'fsantos.yourcpt@gmail.com', '$2y$10$tDvsQpgEEDJC4geixvQHNeI8C8VrziGKfS3o1l5OPeyhVSJw5PFjS', NULL, NULL, NULL, NULL, NULL, 'Admin'),
(26, 'Genie', 'Logiciel', 'genielogicielmaisonneuve@gmail.com', 'p@ssw0rd', NULL, NULL, NULL, NULL, NULL, 'Membre');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`idActivite`),
  ADD UNIQUE KEY `idLieu_2` (`idLieu`,`nom`),
  ADD KEY `idLieu` (`idLieu`);

--
-- Index pour la table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`idAlerte`);

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
  ADD KEY `idCircuit` (`idCircuit`);

--
-- Index pour la table `detailsimage`
--
ALTER TABLE `detailsimage`
  ADD PRIMARY KEY (`idDetailsImage`),
  ADD KEY `idCircuit` (`idCircuit`),
  ADD KEY `idImage` (`idImage`);

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
  ADD UNIQUE KEY `idLieu_2` (`idLieu`,`nom`),
  ADD KEY `idLieu` (`idLieu`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`idImage`);

--
-- Index pour la table `jour`
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
-- Index pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`idLieu`),
  ADD UNIQUE KEY `nom` (`nom`,`ville`,`pays`);

--
-- Index pour la table `manger`
--
ALTER TABLE `manger`
  ADD PRIMARY KEY (`idManger`),
  ADD UNIQUE KEY `idLieu_2` (`idLieu`,`nom`),
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
  MODIFY `idActivite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `idAlerte` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `circuit`
--
ALTER TABLE `circuit`
  MODIFY `idCircuit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `depart`
--
ALTER TABLE `depart`
  MODIFY `idDepart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `detailsimage`
--
ALTER TABLE `detailsimage`
  MODIFY `idDetailsImage` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `etape`
--
ALTER TABLE `etape`
  MODIFY `idEtape` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT pour la table `hebergement`
--
ALTER TABLE `hebergement`
  MODIFY `idHebergement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `idImage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `jour`
--
ALTER TABLE `jour`
  MODIFY `idJour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `idLieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT pour la table `manger`
--
ALTER TABLE `manger`
  MODIFY `idManger` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `newletter`
--
ALTER TABLE `newletter`
  MODIFY `idNewletter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `idPanier` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
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
  ADD CONSTRAINT `depart_ibfk_2` FOREIGN KEY (`idCircuit`) REFERENCES `circuit` (`idCircuit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `detailsimage`
--
ALTER TABLE `detailsimage`
  ADD CONSTRAINT `detailsimage_ibfk_1` FOREIGN KEY (`idCircuit`) REFERENCES `circuit` (`idCircuit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailsimage_ibfk_2` FOREIGN KEY (`idImage`) REFERENCES `image` (`idImage`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Contraintes pour la table `jour`
--
ALTER TABLE `jour`
  ADD CONSTRAINT `jour_ibfk_1` FOREIGN KEY (`idEtape`) REFERENCES `etape` (`idEtape`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jour_ibfk_2` FOREIGN KEY (`idActivite`) REFERENCES `activite` (`idActivite`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jour_ibfk_3` FOREIGN KEY (`idDinner`) REFERENCES `manger` (`idManger`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jour_ibfk_4` FOREIGN KEY (`idHebergement`) REFERENCES `hebergement` (`idHebergement`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jour_ibfk_6` FOREIGN KEY (`idSouper`) REFERENCES `manger` (`idManger`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jour_ibfk_7` FOREIGN KEY (`idLieu`) REFERENCES `lieu` (`idLieu`) ON DELETE CASCADE ON UPDATE CASCADE;

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
