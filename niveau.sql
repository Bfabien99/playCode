-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 02 avr. 2022 à 14:59
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `niveau`
--

-- --------------------------------------------------------

--
-- Structure de la table `exercice`
--

CREATE TABLE `exercice` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `enonce` text NOT NULL,
  `correction` text NOT NULL,
  `aide` varchar(255) NOT NULL,
  `enable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `exercice`
--

INSERT INTO `exercice` (`id`, `titre`, `enonce`, `correction`, `aide`, `enable`) VALUES
(1, 'Hello', 'Ecrire un programme en PHP qui affiche <strong>\"Hello\"</strong>;', '<?php\r\necho \"Hello\";\r\n?>', 'Utiliser la fonction <em>echo</em> de PHP', 0),
(2, 'Somme', 'Ecrire un programme en PHP qui fera la somme des variables <strong>\"a\"</strong> et <strong>\"b\"</strong> dont les valeurs respectives sont <strong>\"3\"</strong> et <strong>\"4\"</strong>;', '<?php\r\n$a=3;\r\n$b=4;\r\necho $a+$b;\r\n?>', 'Utiliser la fonction la fonction <em>echo</em> de PHP.<br>Résultat attendu <em>7</em>.', 1),
(3, 'TOUT EN MAJUSCULE...', 'Ecrire un programme en PHP qui affichera le contenu de la variable <strong>\"mot\"</strong> en majuscule.\r\n</strong>\"mot\"</strong> a pour contenu <strong>\"vive le php\"</strong>\r\n', '<?php\r\n$mot=\"vive le php\";\r\necho strtoupper($mot);\r\n?>', 'Utiliser la fonction la fonction <em>echo</em> de PHP. La fonction <em>strtoupper</em> de PHP permet de mettre en majuscule des caractères.<br>On utilise <em>le signe dollard</em> suivit d\'au moins une lettre pour déclarer la variable.', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `exercice`
--
ALTER TABLE `exercice`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `exercice`
--
ALTER TABLE `exercice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
