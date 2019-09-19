-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 19 sep. 2019 à 13:50
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `qrproject_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL,
  `gender` char(1) NOT NULL,
  `birth_date` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmation_token` varchar(70) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `phone`, `gender`, `birth_date`, `password`, `confirmation_token`, `confirmed_at`) VALUES
(56, 'bejjaj', 'badr', 'bejjaj', 'bejjajbadr@gmail.com', 1234567890, 'm', '2019-09-10', '$2y$10$K5q20mus5BFYg57NYJx88.MtP.MxYnOC3wWTvpz00/nUk5.0kIN46', 'NYUetKyFoRHQvTPZ2Rqgpk0e5xu1MGYj47Gj8yKoBcZXw4uQbmufLAehRGrD', NULL),
(55, 'badr', 'bejjaj', 'badrbejjaj', 'badrbejjaj@gmail.com', 696845064, 'm', '1998-11-11', '$2y$10$ZfOE5Gi8xzznFk7ZA8VJXOdyAdJJhog12DXaBRC9MzfRwd4CIl13u', NULL, '2019-09-19 11:43:05'),
(57, 'AZDEAZD', 'AZDAZD', 'AZDAZD', 'AZDAZD@AZD.zefef', 1234567890, 'm', '2019-09-25', '$2y$10$Yum/CAxN8HuR/ov1A9UC6O3nZZQNZnLYEpZstGKdy88AE8BimcTTe', NULL, '2019-09-19 11:38:56');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
