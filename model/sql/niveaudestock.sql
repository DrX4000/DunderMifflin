-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 13 mai 2024 à 09:46
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `niveaudestock`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_categories` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom_categories`) VALUES
(1, 'Fournitures bureau'),
(2, 'papèterie'),
(3, 'Fournitures artisanats'),
(4, 'Matériaux d\'emballage');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_categories` int NOT NULL,
  `nom_produit` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ref_produit` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categories` (`id_categories`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `id_categories`, `nom_produit`, `ref_produit`) VALUES
(1, 1, 'Papiers pour imprimante', '236589'),
(2, 1, 'Papier coloré ', '350879'),
(3, 1, 'Papiers spéciaux', '405214'),
(4, 2, 'Cahier', '496542'),
(5, 2, 'Enveloppes', '100000'),
(6, 2, 'Lettre/carte postale', '303201'),
(7, 3, 'Papier construction', '102365'),
(8, 3, 'Papier origami', '100365'),
(9, 3, 'Papier d\'art', '200458'),
(10, 4, 'Boîte en carton', '247569\r\n'),
(11, 4, 'Sac en papier', '366632'),
(12, 4, 'Papier d\'emballage', '400314');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_produit` int NOT NULL,
  `id_type_operation` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `quantite` int NOT NULL,
  `date_operation` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produit` (`id_produit`),
  KEY `id_type_operation` (`id_type_operation`),
  KEY `id_type_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `id_produit`, `id_type_operation`, `id_utilisateur`, `quantite`, `date_operation`) VALUES
(1, 12, 2, 3, -2000, '2023-11-30 15:11:37'),
(2, 4, 1, 2, 4000, '2023-08-01 15:13:43'),
(3, 1, 1, 2, 10000, '2023-09-01 15:14:42'),
(4, 12, 1, 2, 4000, '2023-10-30 15:17:56'),
(5, 12, 3, 1, 2000, '2024-01-01 15:18:41'),
(6, 1, 2, 2, -12000, '2023-10-01 15:28:21'),
(7, 1, 1, 2, 10000, '2023-04-30 13:29:34'),
(8, 1, 2, 2, -2000, '2023-05-10 15:30:07'),
(9, 1, 3, 1, 34000, '2024-01-01 15:32:23');

-- --------------------------------------------------------

--
-- Structure de la table `type_operation`
--

DROP TABLE IF EXISTS `type_operation`;
CREATE TABLE IF NOT EXISTS `type_operation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_operation` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_operation`
--

INSERT INTO `type_operation` (`id`, `nom_operation`) VALUES
(1, 'Achats'),
(2, 'Ventes'),
(3, 'Inventaire');

-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateur`
--

DROP TABLE IF EXISTS `type_utilisateur`;
CREATE TABLE IF NOT EXISTS `type_utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`id`, `utilisateur`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_type_utilisateur` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type_utilisateur` (`id_type_utilisateur`),
  KEY `id_type_utilisateur_2` (`id_type_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `id_type_utilisateur`, `nom`, `prenom`, `login`, `mot_de_passe`) VALUES
(1, 1, 'SCOTT\r\n', 'Micheal', 'micheal.scott@dundermifflin.com', 'EatMyShorts'),
(2, 2, 'CORDRAY', 'Danny', 'danny.cordray@dundermifflin.com', 'Th*s_is_a_diffiCULT_pw8'),
(3, 2, 'BEESLY', 'Pam', 'pam.beesly@dundermufflin.com', 'revelation');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_5` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`id_type_operation`) REFERENCES `type_operation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_ibfk_3` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`id_type_utilisateur`) REFERENCES `type_utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
