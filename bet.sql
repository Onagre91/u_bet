-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 17 sep. 2017 à 20:38
-- Version du serveur :  10.1.25-MariaDB
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bet`
--

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `id` int(255) NOT NULL,
  `team_a` varchar(255) NOT NULL,
  `team_b` varchar(255) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `date_debut` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `descrp` text NOT NULL,
  `bet_a` int(11) NOT NULL,
  `bet_b` int(11) NOT NULL,
  `ongame` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id_event`, `id`, `team_a`, `team_b`, `event_name`, `date_debut`, `date_fin`, `descrp`, `bet_a`, `bet_b`, `ongame`) VALUES
(1, 6, 'Ogaming', 'Millenium', 'Hearthstone', '2017-12-15 16:00:00', '2017-12-15 18:00:00', 'Rencontre Hearthstone entre deux joueurs franÃ§ais Ã  l\'occasion de la DreamHack 2017.', 226, 170, 0),
(2, 6, 'Protoss Guy', 'Zerg Dude', 'Starcraft 2', '2017-11-22 20:00:00', '2017-11-22 23:00:00', 'Affrontement pour la coupe entre le Protoss Guy et le Zerg Dude ! Qui remportera le trophÃ©e !?', 42, 0, 0),
(3, 6, 'Tartuffe', 'Jourdain', 'Overwatch', '2017-09-14 13:00:00', '2017-09-14 14:00:00', 'Test de fin dâ€™Ã©vÃ©nement dans ce super match opposant Hanzo Ã  Soldat 76 !', 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `bet_a` int(11) NOT NULL,
  `bet_b` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `token`
--

INSERT INTO `token` (`id`, `id_event`, `bet_a`, `bet_b`) VALUES
(8, 1, 0, 146),
(8, 1, 45, 0),
(8, 2, 42, 0),
(8, 1, 0, 24),
(8, 1, 181, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8_bin NOT NULL,
  `pwd` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `date_inscription` date NOT NULL,
  `role` int(10) NOT NULL,
  `token_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `pwd`, `email`, `date_inscription`, `role`, `token_count`) VALUES
(1, 'TonyJaco', 'c8e7a7bcc02ba9b6a0dd8f6fb45758cf1747fbe5', 'test.test@epitech.eu', '0000-00-00', 0, 0),
(2, 'Testtest', 'c8e7a7bcc02ba9b6a0dd8f6fb45758cf1747fbe5', 'test.test@epitech.eu', '0000-00-00', 0, 1000),
(3, 'Cocosan', '3f86ae6a83a57533b05b4c3fe45f8e1f65bc23ad', 'corentin.coquen@epitech.eu', '0000-00-00', 0, 0),
(4, 'LorisP', '2dd1e1f2527392b744db3058ed810c6ade6cac6e', 'coucou.hello@epitech.eu', '0000-00-00', 0, 0),
(5, 'Salut', '86663c57bf58cedd34b290425da7384cdc6e9f68', 'samsung.salut@epitech.eu', '0000-00-00', 0, 0),
(6, 'LouisC', '59701546c00abb946abad06ce558fda582189419', 'louis.castel@epitech.eu', '0000-00-00', 1, 0),
(7, 'Coucou', '0c08ffc3b6421c44e32a5943dcba61983ed5a5a7', 'pawel.trofimiuk@epitech.eu', '0000-00-00', 0, 0),
(8, 'Paricote', '8c63638066ee4e21097a0fa81da1516176a13465', 'pari.cote@epitech.eu', '0000-00-00', 0, 62);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
