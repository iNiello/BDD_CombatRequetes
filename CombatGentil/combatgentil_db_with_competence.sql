--
-- Base de données : `combatgentil_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `Arme`
--

DROP TABLE IF EXISTS `Arme`;
CREATE TABLE `Arme` (
  `ID` tinyint(1) NOT NULL,
  `HerosID` tinyint(1),
  `Nom` varchar(50) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Degat` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
--
-- Structure de la table `Competence-Heros`
--

DROP TABLE IF EXISTS `Competence-Heros`;
CREATE TABLE `Competence-Heros` (
  `CompetenceID` tinyint(1) NOT NULL,
  `HerosID` tinyint(1) NOT NULL,
  `Nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------
--
-- Structure de la table `Competence`
--

DROP TABLE IF EXISTS `Competence`;
CREATE TABLE `Competence` (
  `ID` tinyint(1) NOT NULL,
  `Type` ENUM('Statut', 'PV', 'Defense', 'Bonus', 'ArmeEnMain', 'Immunite'),
  `Effet` varchar(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
--
-- Structure de la table `Heros`
--

DROP TABLE IF EXISTS `Heros`;
CREATE TABLE `Heros` (
  `ID` tinyint(1) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `PV` tinyint(2) NOT NULL,
  `Bonus` tinyint(2) NOT NULL,
  `Defense` tinyint(2) NOT NULL,
  `ArmeEnMain` tinyint(2) DEFAULT NULL,
  `Statut` varchar(100) NOT NULL,
  `Immunite` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Insertion des données de la table `Heros`
--

INSERT INTO `Heros` (`ID`, `Nom`, `PV`, `Bonus`, `Defense`, `ArmeEnMain`, `Statut`, `Immunite`) VALUES
(1, 'Comar', 40, 8, 7, 0, 'Joyeux', 'Tranchant'),
(2, 'Kirderf', 40, 5, 10, 0, 'Combatif', 'Contondant'),
(3, 'Liujen', 40, 10, 5, 0, 'Flegme', 'Perçant'),
(4, 'Jeanne-Cunégonde-Sophie', 50, 20, 0, 1, 'Nonchalente', 'Abusé'),
(5, 'Xéna', 45, 10, 10, 0, 'Furieuse', 'Aucun'),
(6, 'Toto', 5, 0, 25, 0, 'Hébété', 'Abusé');

--
-- Insertion des données de la table `Arme`
--

INSERT INTO `Arme` (`ID`, `HerosID`, `Nom`, `Type`, `Degat`) VALUES
(1, 4, 'Batte', 'Mousse', 0),
(99, 7, 'Blague nul', 'Tranchant', 99);

--
-- Insertion des données de la table `Compétence`
--

INSERT INTO `Competence` (`ID`, `Type`, `Effet`) VALUES
(1, 'PV', '-50'),
(2, 'ArmeEnMain', NULL),
(3, 'Immunite', 'Tranchant'),
(4, 'Defense', '50');

--
-- Insertion des données de la table `Compétence-Heros`
--

INSERT INTO `Competence-Heros` (`CompetenceID`, `HerosID`, `Nom`) VALUES
(1, 1, 'Reboot your brain'),
(3, 2, 'Bouclier Mac'),
(1, 3, 'Vanne divine'),
(2, 3, 'Vanne surprenante'),
(4, 2, 'Reboot your brain'),
(2, 2, 'DDOS your weapon');

--
-- Index pour la table `Arme`
--
ALTER TABLE `Arme`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `HerosID` (`HerosID`),
  ADD UNIQUE KEY `Arme.Nom` (`Nom`);

--
-- Index pour la table `Competence`
--
ALTER TABLE `Competence`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Heros`
--
ALTER TABLE `Heros`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Heros.Nom` (`Nom`);

--
-- Index pour la table `Competence-Heros`
--
ALTER TABLE `Competence-Heros`
  ADD KEY `HerosID` (`HerosID`),
  ADD KEY `CompetenceID` (`CompetenceID`);

--
-- AUTO_INCREMENT pour la table `Arme`
--
ALTER TABLE `Arme`
  MODIFY `ID` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Competence`
--
ALTER TABLE `Competence`
  MODIFY `ID` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Heros`
--
ALTER TABLE `Heros`
  MODIFY `ID` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour la table `Competence-Heros`
--
ALTER TABLE `Competence-Heros`
  ADD CONSTRAINT `FK_Heros` FOREIGN KEY (`HerosID`) REFERENCES `Heros` (`ID`),
  ADD CONSTRAINT `FK_Competence` FOREIGN KEY (`CompetenceID`) REFERENCES `Competence` (`ID`);

--
-- Contraintes pour la table `Arme`
--
ALTER TABLE `Arme`
  ADD CONSTRAINT `FK_Heros_Arme` FOREIGN KEY (`HerosID`) REFERENCES `Heros` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;