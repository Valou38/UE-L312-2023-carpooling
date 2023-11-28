-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 28 nov. 2023 à 16:15
-- Version du serveur : 8.0.31
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `carpooling`
--


--
-- Structure de la table `carpoolad`
--

DROP TABLE IF EXISTS `carpoolad`;
CREATE TABLE IF NOT EXISTS `carpoolad` (
   `id` int NOT NULL AUTO_INCREMENT,
  `users_cars_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `dateandtime` datetime NOT NULL,
  `departurelocation` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `availableseats` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;


-- Index pour la table `carpoolad`
--
ALTER TABLE `carpoolad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carpoolad_ibfk_1` (`users_cars_id`);



--
-- Structure de la table `cars`
--

CREATE TABLE `cars` (
   `id` int NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `mileage` varchar(7) NOT NULL,
  `color` varchar(255) NOT NULL,
  `nbrSlots` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;


-- Index pour la table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);


-- Déchargement des données de la table `cars`
--
INSERT INTO `cars` (`id`, `brand`, `model`, `year`, `mileage`, `color`, `nbrSlots`) VALUES
(2, 'AUDI', 'A6', '2001', '300', 'blue', 5),
(9, 'Twingo', 'Sport', '2023', '50000', 'red', 4);


--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
   `id` int NOT NULL AUTO_INCREMENT,
  `adid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `reservedseats` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;


-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_ibfk_1` (`adid`),
  ADD KEY `reservation_ibfk_2` (`userid`);


--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
   `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;


-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


-- Déchargement des données de la table `users`
--
INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `birthday`) VALUES
(1, 'Vincent', 'Godé', 'hello@vincentgo.fr', '1990-11-08 00:00:00'),
(2, 'Albert', 'Dupond', 'sonemail@gmail.com', '1985-11-08 00:00:00'),
(3, 'Thomas', 'Dumoulin', 'sonemail2@gmail.com', '1985-10-08 09:44:46');



--
-- Structure de la table `users_cars`
--

CREATE TABLE `users_cars` (
   `id` int NOT NULL AUTO_INCREMENT,
  `car_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;


-- Index pour la table `users_cars`
--
ALTER TABLE `users_cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_user` (`user_id`),
  ADD KEY `ID_car` (`car_id`);




--
-- Contraintes pour la table `carpoolad`
--

ALTER TABLE `carpoolad`
  ADD CONSTRAINT `carpoolad_ibfk_1` FOREIGN KEY (`users_cars_id`) REFERENCES `users_cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`adid`) REFERENCES `carpoolad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users_cars`
--
ALTER TABLE `users_cars`
  ADD CONSTRAINT `ID_car` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ID_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
