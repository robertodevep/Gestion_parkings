-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 04 mai 2025 à 11:52
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `parkings`
--

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(11) NOT NULL,
  `numero_pay` varchar(255) NOT NULL,
  `moyen_pay` varchar(255) NOT NULL,
  `montantpaiement` double NOT NULL,
  `statut` varchar(255) NOT NULL,
  `datepaiement` date NOT NULL,
  `id_reservation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paiement`, `numero_pay`, `moyen_pay`, `montantpaiement`, `statut`, `datepaiement`, `id_reservation`) VALUES
(1, '680149603', 'MTN', 2400, 'payer', '2025-05-01', 1),
(2, '689146798', 'ORANGE', 400, 'payer', '2025-05-01', 4),
(3, '647483930', 'ORANGE', 2400, 'payer', '2025-05-02', 1),
(4, '637384637', 'ORANGE', 1900, 'payer', '2025-05-02', 24);

-- --------------------------------------------------------

--
-- Structure de la table `parking_vh`
--

CREATE TABLE `parking_vh` (
  `id_parking` int(11) NOT NULL,
  `nbplace` int(11) NOT NULL,
  `localisation` varchar(244) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `numero` varchar(122) NOT NULL,
  `nbplace_disponible` int(11) NOT NULL,
  `tarifhoraire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `parking_vh`
--

INSERT INTO `parking_vh` (`id_parking`, `nbplace`, `localisation`, `statut`, `numero`, `nbplace_disponible`, `tarifhoraire`) VALUES
(1, 24, 'Makepe', 'disponible', 'A2', 24, 100),
(2, 30, 'Bonamoussadi', 'disponible', 'A11', 29, 2000),
(3, 20, 'DOUALA', 'disponible', 'A112', 20, 2000),
(4, 24, 'BUEA', 'disponible', 'A11', 24, 1000),
(5, 2, 'Brazzaville', 'disponible', 'A55', 1, 100),
(6, 1, 'Amerique', 'indisponible', 'A43', 0, 100);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `statut` varchar(255) NOT NULL,
  `montant_total` double NOT NULL,
  `numero_place` int(11) NOT NULL,
  `nombre_heure` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_parking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `date_debut`, `date_fin`, `statut`, `montant_total`, `numero_place`, `nombre_heure`, `id_user`, `id_parking`) VALUES
(1, '2025-04-25', '2025-04-26', 'terminee', 2400, 1, 24, 5, 1),
(2, '2025-04-25', '2025-04-26', 'terminee', 2400, 1, 24, 12, 5),
(3, '2025-04-25', '2025-04-26', 'terminee', 2600, 2, 26, 15, 5),
(4, '2025-04-25', '2025-04-25', 'terminee', 400, 2, 4, 13, 1),
(5, '2025-04-25', '2025-04-26', 'terminee', 2400, 1, 24, 16, 5),
(6, '2025-04-28', '2025-04-29', 'terminee', 2600, 1, 26, 7, 5),
(7, '2025-04-28', '2025-04-28', 'terminee', 800, 1, 8, 7, 5),
(8, '2025-04-28', '2025-04-29', 'terminee', 2400, 1, 24, 7, 5),
(9, '2025-04-28', '2025-04-30', 'terminee', 4500, 1, 45, 7, 5),
(10, '2025-04-28', '2025-04-29', 'terminee', 2500, 1, 25, 12, 5),
(11, '2025-04-28', '2025-04-30', 'terminee', 5600, 1, 56, 12, 5),
(12, '2025-04-28', '2025-04-30', 'terminee', 3400, 1, 34, 12, 5),
(13, '2025-04-29', '2025-04-30', 'terminee', 6700, 1, 67, 12, 5),
(14, '2025-04-28', '2025-04-28', 'terminee', 10000, 1, 5, 12, 3),
(15, '2025-04-28', '2025-04-30', 'terminee', 6700, 1, 67, 12, 5),
(16, '2025-04-29', '2025-04-29', 'terminee', 5500, 1, 55, 16, 5),
(17, '2025-04-28', '2025-04-29', 'terminee', 3400, 1, 34, 16, 5),
(18, '2025-04-28', '2025-04-29', 'terminee', 2400, 1, 24, 16, 5),
(19, '2025-04-28', '2025-04-30', 'terminee', 5600, 1, 56, 16, 5),
(20, '2025-04-28', '2025-04-30', 'terminee', 134000, 1, 67, 6, 2),
(21, '2025-04-28', '2025-04-28', 'terminee', 5000, 1, 5, 6, 4),
(22, '2025-04-28', '2025-04-30', 'terminee', 4500, 1, 45, 12, 5),
(23, '2025-04-30', '2025-05-01', 'active', 14000, 1, 7, 5, 2),
(24, '2025-05-01', '2025-05-02', 'active', 1900, 2, 19, 13, 5),
(25, '2025-05-02', '2025-05-10', 'terminee', 6000, 2, 6, 5, 4),
(26, '2025-05-02', '2025-05-03', 'active', 2400, 1, 24, 5, 6);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` int(11) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `statut` varchar(150) DEFAULT 'disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_user`, `nom`, `prenom`, `ville`, `email`, `telephone`, `passwords`, `roles`, `statut`) VALUES
(5, 'Laurelle', 'Marie', 'Douala', 'Laurelle@gmail.com', 647382945, '$2y$10$j7gZmQB4QXHIvFgbcV0XxuiTFDcVno8p/n1tPREooSV32iFg0ElRu', 'utilisateur', 'disponible'),
(6, 'Stephanie', 'Takam', 'Douala', 'Stephanie@gmail.com', 647382942, '$2y$10$4xjRApvKD4X0yJVoPY.k.OubQ1Vdza8xbcCIwOafiLZ6ddiNLZA4W', 'utilisateur', 'disponible'),
(7, 'Franck', 'Loic', 'Douala', 'Franck@gmail.com', 645362739, '$2y$10$jBlarmjNWYJup5jNwKWpROmnX6slxOC1m1mrVXHqmzuMsWP7DaTWa', 'admin', 'disponible'),
(12, 'Paul', 'Franck', 'Douala', 'paul@gmail.com', 657483946, '$2y$10$ya7gAfbUQRwl20bIKOSqZu4/dE0mQe/KBcDWlFT1VcyTEVfVJswoS', 'utilisateur', 'disponible'),
(13, 'christiano', 'christ', 'Yaounder', 'christiano@gmail.com', 645362738, '$2y$10$IqMJAZGFw50EQi06NbOfYOWZUkZmuiWQ7ZxpMOHjWje9OKzJKf.Ha', 'utilisateur', 'indisponible'),
(14, 'Roland', 'mac', 'Yaounder', 'roland@gmail.com', 637382936, '$2y$10$fpG5IjV/I4MKS2JkfpeLX.2fPSk2vToFJTEDBriyu8.Cugu.YFv96', 'utilisateur', 'indisponible'),
(15, 'Leo', 'Messi', 'Douala', 'Messi@gmail.com', 647569022, '$2y$10$z2JhChh2ntcu2jEuqBR31ucrCwAWKGfgnyF/ZV6Mp3I9zW0bkIdzm', 'utilisateur', 'disponible'),
(16, 'Landry', 'Bakogo', 'Douala', 'landry@gmail.com', 647383536, '$2y$10$47k.kEWeafeZFOSNRe6mkuaZrin2IATEyKTTW7K.Ej/AALHWNVNf6', 'utilisateur', 'disponible'),
(17, 'John', 'Doe', 'Douala', 'john@gmail.com', 683944635, '$2y$10$Iq581I3A6PzQt95Xu1xlG.A33Uxs0wimQHV9pYejXW83dcM5umG0u', 'rtyui', 'disponible');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paiement`),
  ADD KEY `id_reservation` (`id_reservation`);

--
-- Index pour la table `parking_vh`
--
ALTER TABLE `parking_vh`
  ADD PRIMARY KEY (`id_parking`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_parking` (`id_parking`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id_paiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `parking_vh`
--
ALTER TABLE `parking_vh`
  MODIFY `id_parking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id_reservation`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `utilisateurs` (`id_user`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`id_parking`) REFERENCES `parking_vh` (`id_parking`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
