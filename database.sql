-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 14 mai 2018 à 23:16
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `projet5`
--

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `id` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `registration_date` datetime DEFAULT NULL,
  `authorization` tinyint(5) NOT NULL,
  `confirmation_token` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) NOT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`id`, `first_name`, `last_name`, `pseudo`, `password`, `email`, `registration_date`, `authorization`, `confirmation_token`, `avatar`, `is_active`) VALUES
(8, 'philippe', 'Traon', 'phil', '$2y$10$yX9kymMDnFMSCW8xu3Kzk.y7W8XX.0qwYS5Yv6S4cxifRVv1dWziq', 'ptraon@gmail.com', '2018-04-30 12:24:08', 1, 'vMfCuA3bj6dQzpxYLxbwzk1n4BTjOe5Pzrs6h27rI1NGbEgNm39blUGpvufEg0LfsE2pzZYKKkMexH4IwEdCH89931BSNGEzZLvo', 'Philippe.jpeg', 1),
(13, '', '', 'spiderman', '$2y$10$uPm0ElvnshqJ4vRBGduTcex92o8oZcmBMMglNEXOXXBm2icbSMJC6', 'philippe_traon@yahoo.fr', NULL, 0, 'jMcPt4zjpbMhM498qVFQZHO8Q8SagkkLT9ZtDjWJxWfiioK8lcA9ByLGr1vxtU0w2rdfUr4FPYhs7Hks4iHUFLpKMoKyLQVp6MZq', 'spiderman.jpeg', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
