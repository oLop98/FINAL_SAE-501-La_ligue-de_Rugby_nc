-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 18 oct. 2024 à 04:22
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
-- Base de données : `saerugby`
--

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

DROP TABLE IF EXISTS `action`;
CREATE TABLE IF NOT EXISTS `action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `images` text,
  `contenu` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `action`
--

INSERT INTO `action` (`id`, `titre`, `description`, `images`, `contenu`) VALUES
(6, 'Coupe des collèges', 'La Coupe des collèges est un tournoi annuel organisé par la Ligue de rugby de Nouvelle-Calédonie, destiné aux élèves des classes de 6ème.', '[]', '<p>La Coupe des collèges est un tournoi annuel organisé par la Ligue de rugby de Nouvelle-Calédonie, destiné aux élèves des classes de 6ème. Cette initiative s’inscrit dans le cadre du développement du rugby en milieu scolaire et a pour objectif de promouvoir la pratique du rugby auprès des jeunes tout en renforçant les liens entre les établissements scolaires et les clubs locaux.</p><p><strong>Organisation du tournoi :</strong></p><p>Le tournoi se déroule en deux étapes majeures, offrant aux jeunes une expérience progressive et structurée de la compétition :</p><p>&nbsp;&nbsp;	<u>Inscriptions des établissements :</u></p><p>Ouvertes à tous les collèges de Nouvelle-Calédonie.</p><p>Les conseillers techniques de clubs interviennent pendant les cycles d\'Éducation Physique et Sportive (EPS) dans les établissements inscrits, en fonction des demandes et des disponibilités.</p><p>&nbsp;	<u>Phase de secteurs (Juillet - Août - Septembre) :</u></p><p>Une première phase de sélection basée sur des critères géographiques, visant à organiser des rencontres régionales entre les différents collèges participants.</p><p>Cette phase permet de qualifier les meilleures équipes pour l\'étape suivante.</p><p>&nbsp;	<u>Finale Territoriale :</u></p><p>Les équipes qualifiées se retrouvent pour une finale à l’échelle territoriale, couronnant la meilleure équipe de collège de Nouvelle-Calédonie.</p><p>Objectifs pédagogiques et sportifs </p><p><strong>La Coupe des collèges vise à :</strong></p><ul><li>&nbsp;&nbsp;Encourager la pratique du rugby dès le plus jeune âge.</li><li>&nbsp;&nbsp;Favoriser la découverte des valeurs du rugby : esprit d’équipe, respect, solidarité.</li><li>&nbsp;&nbsp;Renforcer les liens entre le monde scolaire et les clubs de rugby, dans une logique de continuité entre l\'initiation en milieu scolaire et la pratique en club.</li></ul><p><strong>Liens avec le Projet d’Orientation Stratégique (POS) :</strong></p><p>Cette compétition s’inscrit dans les axes prioritaires du POS 2026 de la Ligue de rugby de Nouvelle-Calédonie, notamment :</p><p>&nbsp;&nbsp;Axe 2 : Développer le rugby sur le territoire calédonien en fidélisant les jeunes pratiquants et en s’ancrant dans le monde scolaire.</p><p>&nbsp;&nbsp;Axe 3 : Faire rayonner le rugby calédonien en développant un vivier de jeunes talents qui pourront par la suite intégrer les sélections régionales et nationales.</p>'),
(7, 'Le Projet d\'Orientation Stratégique 2026', 'Le Projet d\'Orientation Stratégique (POS) 2026 de la Ligue de rugby de Nouvelle-Calédonie est un plan ambitieux visant à structurer, développer et faire rayonner le rugby sur l’ensemble du territoire calédonien. Ce projet repose sur quatre axes clés qui g', '[]', '<p>Le Projet d\'Orientation Stratégique (POS) 2026 de la Ligue de rugby de Nouvelle-Calédonie est un plan ambitieux visant à structurer, développer et faire rayonner le rugby sur l’ensemble du territoire calédonien. Ce projet repose sur quatre axes clés qui guident toutes les actions de la Ligue et ses partenaires pour les années à venir.</p><p><strong><u>AXE 1 :</u></strong><u> Structurer le rugby néo-calédonien</u></p><p>Pour assurer une base solide au rugby calédonien, la structuration est essentielle. Cet axe s’articule autour des enjeux suivants :</p><p>&nbsp;&nbsp;<strong>Enjeu 1 :</strong> Structurer la Ligue calédonienne de rugby en développant une organisation efficace et durable.</p><p>&nbsp;&nbsp;<strong>Enjeu 2 :</strong> Accompagner les clubs dans leur structuration, afin d’assurer leur pérennité.</p><p>&nbsp;<strong>&nbsp;Enjeu 3 :</strong> Former pour la qualité et l’excellence, en mettant en place des formations pour les joueurs, les éducateurs, les entraîneurs et les arbitres.</p><p>&nbsp;&nbsp;<strong>Enjeu 4 :</strong> Consolider le corps arbitral, indispensable au bon fonctionnement des compétitions et au respect des règles.</p><p><strong><u>AXE 2 :</u></strong><u> Développer le rugby et fidéliser les pratiquants</u></p><p>Le rugby calédonien doit s’adapter et se diversifier pour répondre aux attentes de ses pratiquants, jeunes et moins jeunes. Ce deuxième axe vise à :</p><p>&nbsp;&nbsp;<strong>Enjeu 1 :</strong> S’ancrer dans le monde scolaire, en renforçant les partenariats avec les établissements et en proposant des compétitions telles que la Coupe des collèges.</p><p>&nbsp;&nbsp;<strong>Enjeu 2 :</strong> Développer le rugby féminin, une priorité pour la Ligue, afin d\'assurer une égalité des opportunités de pratique pour tous.</p><p>&nbsp;&nbsp;<strong>Enjeu 3 :</strong> Développer et renforcer les Écoles de Rugby (EDR) au sein des clubs, pour encourager les jeunes à découvrir ce sport dès leur plus jeune âge.</p><p>&nbsp;&nbsp;<strong>Enjeu 4 :</strong> Développer la pratique du rugby auprès des jeunes, par la mise en place d’initiatives locales adaptées à chaque territoire.</p><p><strong><u>AXE 3 :</u></strong><u> Faire rayonner le rugby calédonien</u></p><p>L’ambition de la Ligue est également de promouvoir le rugby calédonien au-delà de ses frontières. Cet axe se décline ainsi :</p><p>&nbsp;&nbsp;<strong>Enjeu 1 :</strong> Structurer la filière d’accès au haut niveau, que ce soit au niveau régional ou national, pour permettre aux meilleurs talents de se développer.</p><p>&nbsp;&nbsp;<strong>Enjeu 2 :</strong> Protéger les clubs et les jeunes en leur offrant un cadre sécurisé, particulièrement pour ceux qui s\'engagent dans un parcours hors du territoire.</p><p>&nbsp;<strong>&nbsp;Enjeu 3 :</strong> Rapprocher les moyens entre le Pôle Académie et la Ligue, afin de maximiser les synergies entre les deux entités.</p><p>&nbsp;<strong><em>&nbsp;</em>Enjeu 4 :</strong> Réfléchir aux sélections jeunes et seniors (U15, U16, U17, U19), pour représenter la Nouvelle-Calédonie lors des compétitions nationales et internationales.</p><p><strong><u>AXE 4 : </u></strong><u>Accompagner les investissements en infrastructures</u></p><p>Enfin, le développement du rugby passe par la construction et l’amélioration des infrastructures sportives. Le dernier axe du POS vise à :</p><p><strong>Enjeu :</strong> Constituer un patrimoine d’installations de rugby sur tout le territoire calédonien, afin que chaque club et chaque joueur puisse bénéficier d’équipements modernes et adaptés.</p><p>Le POS 2026 reflète la volonté de la Ligue de rugby de Nouvelle-Calédonie de bâtir un futur solide pour le rugby sur le territoire. À travers ces quatre axes, la Ligue souhaite renforcer ses bases, fidéliser ses pratiquants, développer des talents et permettre au rugby calédonien de s’épanouir et de rayonner à l’échelle nationale et internationale.</p>'),
(8, 'Centre de suivi -15 ans', 'Le Centre de suivi des moins de 15 ans est une initiative phare de la Ligue de rugby de Nouvelle-Calédonie, visant à détecter, former et accompagner les jeunes talents du rugby calédonien, tant chez les garçons de moins de 14 ans que chez les filles de mo', '[]', '<p>Le Centre de suivi des moins de 15 ans est une initiative phare de la Ligue de rugby de Nouvelle-Calédonie, visant à détecter, former et accompagner les jeunes talents du rugby calédonien, tant chez les garçons de moins de 14 ans que chez les filles de moins de 15 ans. Ce programme offre un encadrement physique, technique et mental, afin de préparer les joueurs et joueuses aux exigences du haut niveau et de développer l\'Esprit Bleu, l\'identité propre aux futurs talents du rugby calédonien.</p><p><u>Catégorie ciblée :</u></p><p>&nbsp;&nbsp;Garçons : Moins de 14 ans</p><p>&nbsp;&nbsp;Filles : Moins de 15 ans</p><p>Ces deux catégories représentent une étape cruciale dans le développement des jeunes joueurs et joueuses, avec une attention particulière portée aux capacités physiques, techniques et à l’attitude sur le terrain.</p><p>Objectifs :</p><p><u>Le Centre de suivi des moins de 15 ans poursuit plusieurs objectifs clés :</u></p><p>&nbsp;&nbsp;<strong>Détection des talents :</strong></p><p>&nbsp;&nbsp;&nbsp;&nbsp;Identifier les jeunes avec un fort potentiel, tant chez les garçons de moins de 14 ans que chez les filles de moins de 15 ans.</p><p>&nbsp;&nbsp;<strong>Préparation physique et technique :</strong></p><p>&nbsp;&nbsp;&nbsp;&nbsp;Accompagner les jeunes dans leur progression, en les préparant physiquement et techniquement selon le rythme exigé par l\'APE (Activité Physique et Éducative) et les exigences du rugby de haut niveau.</p><p>&nbsp;&nbsp;<strong>Développement de \"l’Esprit Bleu\" :</strong></p><p>&nbsp;&nbsp;&nbsp;&nbsp;Instiller des valeurs fortes de cohésion, de solidarité et de dépassement de soi, qui forment l’identité des jeunes talents du rugby calédonien.</p><p><u>Moyens mis en œuvre :</u></p><p>Pour atteindre ces objectifs, la Ligue de rugby met en place plusieurs moyens structurés et adaptés aux besoins des jeunes joueurs et joueuses :</p><p>&nbsp;&nbsp;<strong>5 stages intensifs :</strong></p><p>&nbsp;&nbsp;&nbsp;&nbsp;Ces stages de deux jours sont organisés à intervalles réguliers tout au long de la saison sportive. Ils permettent d\'assurer un suivi continu des jeunes talents et de les faire progresser dans un cadre structuré.</p><p>&nbsp;&nbsp;<strong>Évaluations physiques et techniques :</strong></p><p>&nbsp;&nbsp;&nbsp;&nbsp;À chaque stage, une évaluation complète des performances physiques et rugbystiques est réalisée. Ces évaluations permettent d’ajuster les programmes d’entraînement et de suivre l’évolution de chaque joueur et joueuse.</p><p>&nbsp;&nbsp;<strong>Suivi personnalisé entre les stages :</strong></p><p>&nbsp;&nbsp;&nbsp;&nbsp;En dehors des regroupements, un suivi rigoureux des jeunes est assuré par les encadrants, afin de vérifier la progression continue des joueurs et joueuses entre les stages.</p><p>&nbsp;&nbsp;<strong>Supervision des matchs et tournois :</strong></p><p>&nbsp;&nbsp;&nbsp;&nbsp;Les jeunes sont régulièrement observés lors des rencontres de clubs, des plateaux régionaux et des Journées de Détection Régionales (JDR), afin d’identifier les points forts et les axes d\'amélioration.</p><p><u>Finalité :</u></p><p>Le Centre de suivi des moins de 15 ans a pour finalité de préparer les jeunes talents à intégrer l’APER NC (Académie Pôle Espoir de Rugby de Nouvelle-Calédonie), une structure dédiée à l’élite du rugby calédonien. Les meilleurs potentiels détectés au sein du Centre seront présentés au concours d’entrée de l’APER NC, avec pour ambition de poursuivre leur développement dans un cadre d’excellence.</p><p>L’objectif ultime est d’accompagner ces jeunes sur le chemin du haut niveau, tout en préservant leur épanouissement personnel et en leur offrant les meilleures conditions pour réussir dans le rugby.</p><p>Le Centre de suivi des moins de 15 ans représente une étape cruciale dans la détection et la formation des jeunes talents du rugby calédonien. À travers un programme complet et adapté, la Ligue de rugby de Nouvelle-Calédonie offre à ces jeunes l’opportunité de progresser et de se préparer à intégrer les structures de haut niveau, tout en incarnant les valeurs de l’Esprit Bleu.</p>');

-- --------------------------------------------------------

--
-- Structure de la table `actualite`
--

DROP TABLE IF EXISTS `actualite`;
CREATE TABLE IF NOT EXISTS `actualite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `contenu` text NOT NULL,
  `fk_score` int DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_score` (`fk_score`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `actualite`
--

INSERT INTO `actualite` (`id`, `titre`, `description`, `contenu`, `fk_score`, `img`, `active`) VALUES
(1, 'Test', 'TEST', 'TEST', 3, 'assets/actualites/characters.png', 0),
(2, 'TESTTT', 'TESTTT', 'TESTTT', 4, 'assets/actualites/sheet.png', 0),
(3, 'Finale championnat à XV 2023', '', '', 5, '', 1),
(4, 'Finale championnat à XV 2022', '', '', 6, NULL, 1),
(5, 'Finale championnat à XV 2018', '', '', 7, NULL, 1),
(6, 'Finale championnat à XV 2019', '', '', 8, NULL, 1),
(7, 'Finale championnat à XV 2016', '', '', 9, NULL, 1),
(8, 'Finale championnat à XV 2015', '', '', 10, NULL, 1),
(9, 'Finale championnat à XV 2014', '', '', 11, NULL, 1),
(10, 'Finale championnat à XV 2013', '', '', 12, NULL, 1),
(11, 'Finale championnat à XV 2009', '', '', 13, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE IF NOT EXISTS `club` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `latitude` decimal(11,8) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `lien` varchar(255) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `president` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `club`
--

INSERT INTO `club` (`id`, `nom`, `image`, `longitude`, `latitude`, `adresse`, `lien`, `province`, `email`, `president`) VALUES
(30, 'Crevettes musclées', 'assets/clubs/crevette.png', 164.89997271, -21.12532693, 'Stade de Koniambou, Pouembout', 'https://www.facebook.com/groups/617471321687132?locale=fr_FR', 'Nord', 'crevettesmusclees@gmail.com', 'Arnaud BANFI'),
(29, 'Association Omnisports Nepoui', 'assets/clubs/nepoui.png', 165.02800000, -21.34500000, 'Club Inactif', '', 'Nord', '', ''),
(28, 'Comite Sportif Bouraillais', 'assets/clubs/bourail.jpeg', 165.49767016, -21.56725496, 'Stade Municipal de Bourail, Bourail', 'https://www.facebook.com/RugbyBourail/?locale=fr_FR', 'Sud', 'csbrugby2017@gmail.com', 'Frédéric LALEVE'),
(27, 'Association Sportive Kunie', 'assets/clubs/kunie.png', 167.44600000, -22.65800000, 'Données indisponibles', NULL, 'Sud', '', ''),
(26, 'Association Sportive de Magenta', 'assets/clubs/magenta.jpeg', 166.48488290, -22.23499362, 'Complexe Georges Merignac de Tina, Nouméa', 'https://www.facebook.com/asmagentatouch?locale=fr_FR', 'Sud', 'iv.hillaireau@gmail.com', 'Ivan HILLAIREAU'),
(25, 'Rugby Club Calédonien', 'assets/clubs/rugby-club-cal.jpeg', 166.43285274, -22.23749853, 'Complexe Sportif Logicoop, 71 Rue Boutmy, Nouméa', 'https://www.facebook.com/rugbyclubcaledonien?locale=fr_FR', 'Sud', 'rcc-noumea@outlook.fr', 'Jean BARUTAUT'),
(24, 'Le Petit Train Section Rugby', 'assets/clubs/paita.jpeg', 166.36627494, -22.14016295, 'Stade Municipal de Paita, Bretelle Save Express, Paita', 'lepetitrainrugby.rcp@gmail.com  https://www.facebook.com/p/Le-Petit-Train-RUGBY-CLUB-PAITA-2024-100086784015976/', 'Sud', 'lepetitrainrugby.rcp@gmail.com', 'Sanualio FAUPALA'),
(23, 'Olympique de Nouméa', 'assets/clubs/olympique-noumea.PNG', 166.46242239, -22.24170464, 'Complexe Municipal de Rugby Philemo Simutoga de Rivière Salée, 10 Avenue Bonaparte, Nouméa', 'https://www.facebook.com/profile.php?id=100063646597550&sk=about', 'Sud', 'olympique.de.noumea.rugby@gmail.com', 'Téva LEGRAS'),
(22, 'Vikings 988', 'assets/clubs/viking-988.jpeg', 166.48562128, -22.21887331, 'Complexe Sportif Normandie, 3 Rue Gustave Mouchet, Nouméa', 'https://www.facebook.com/jslnrugby98/?locale=fr_FR#', 'Sud', 'scrpnjpdrea2505@gmail.com', 'Jean-Philippe TUIFUA'),
(21, 'Rugby Club de Mont Dore', 'assets/clubs/rugby-mont-dore.png', 166.48546222, -22.22196174, 'Stade de Rugby Christian Blanc (Pont-des-Français), Rue Denise Frey, Mont-Dore', 'https://www.facebook.com/groups/403372356429502', 'Sud', 'rcmd.ecolederugby@gmail.com', 'Stéphane COURTE'),
(20, 'Association Stade Calédonien', 'assets/clubs/sc.jpeg', 166.46148336, -22.24161481, 'Complexe Municipal de Rugby Philemo Simutoga de Rivière Salée, 10 Avenue Bonaparte, Nouméa', 'https://www.facebook.com/profile.php?id=100057223488567', 'Sud', 'edr.stade.caledonien@gmail.com', 'Bruno DOUEPERE'),
(19, 'Union Rugby Club de Dumbéa', 'assets/clubs/dumbea.png', 166.46310992, -22.21392929, 'Stade Rocky Vaitanaki, Parc des Sports de Koutio, Dumbéa', 'https://www.facebook.com/unionrugbyclubdumbea?locale=fr_FR', 'Sud', 'unionrugbyclubdumbea@yahoo.fr', 'Frédéric HERVOUET'),
(18, 'Club de Rugby Educatif et Citoyen', 'assets/clubs/crec.jpeg', 166.44287666, -22.29743483, 'Stade Edouard Pentecost, 25 Rue Blaise Pascal, Nouméa', 'https://crecrugby.nc/', 'Sud', 'noumea.crec@gmail.com', 'Cédric ESTEVE'),
(32, 'Les Houps Club de Rugby de Poindimie', 'assets/clubs/houps.png', 165.33200000, -20.92500000, 'Club Inactif', NULL, 'Nord', '', ''),
(33, 'Nengone Ovalie Rugby Ensemble Saisissons l’Avenir', 'assets/clubs/nengone.jpeg', 168.02911828, -21.48275295, '', 'https://www.facebook.com/profile.php?id=100057795064115', 'Îles Loyauté', 'noresa.rugby@gmail.com', 'Hippolyte  SINEWAMI HTAMUMU'),
(39, 'RC La Foa', 'assets/clubs/RCLaFoa.png', 165.82926900, -21.70455990, 'Stade Xavier Mediara,  Route du Centre Aquatique, La Foa', '', 'Sud', 'patoghislain@gmail.com', 'Ghislain PATO');

-- --------------------------------------------------------

--
-- Structure de la table `joueurshorsnc`
--

DROP TABLE IF EXISTS `joueurshorsnc`;
CREATE TABLE IF NOT EXISTS `joueurshorsnc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `club` varchar(255) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(10,8) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

DROP TABLE IF EXISTS `partenaire`;
CREATE TABLE IF NOT EXISTS `partenaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `partenaire`
--

INSERT INTO `partenaire` (`id`, `nom`, `img`) VALUES
(3, 'Canal +', 'assets/partenaires/canal_plus.jpg'),
(4, 'Arc en ciel', 'assets/partenaires/arc_en_ciel.jpeg'),
(5, 'Armée de l\'air et de l\'espace', 'assets/partenaires/armee_de_l_air_et_de_l_espace.png'),
(6, 'Defender', 'assets/partenaires/defender.png'),
(7, 'Europcar', 'assets/partenaires/europcar.png'),
(8, 'Geocal', 'assets/partenaires/geocal.png'),
(9, 'Maison du pneu', 'assets/partenaires/maison_du_pneu.png'),
(10, 'Manpower', 'assets/partenaires/manpower.png'),
(11, 'Meca13', 'assets/partenaires/meca13.jpg'),
(12, 'Eau de source naturelle du Mont-Dore', 'assets/partenaires/mont_dore.png'),
(13, 'Signs', 'assets/partenaires/signs.png'),
(14, 'Société générale', 'assets/partenaires/societe-generale.png'),
(15, 'Total Energies', 'assets/partenaires/total_energies.png');

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

DROP TABLE IF EXISTS `score`;
CREATE TABLE IF NOT EXISTS `score` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fk_equipeWinner` int NOT NULL,
  `fk_equipeLooser` int NOT NULL,
  `date_match` date NOT NULL,
  `score_winner` int NOT NULL,
  `score_looser` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_equipeWinner` (`fk_equipeWinner`),
  KEY `fk_equipeLooser` (`fk_equipeLooser`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `score`
--

INSERT INTO `score` (`id`, `fk_equipeWinner`, `fk_equipeLooser`, `date_match`, `score_winner`, `score_looser`) VALUES
(1, 0, 0, '0000-00-00', 0, 0),
(2, 0, 0, '0000-00-00', 0, 0),
(3, 29, 23, '2024-08-08', 5, 10),
(4, 29, 20, '2024-08-11', 5, 8),
(5, 23, 18, '2023-10-21', 26, 19),
(6, 23, 19, '2022-10-22', 55, 21),
(7, 23, 19, '2018-10-20', 30, 19),
(8, 23, 22, '2019-10-21', 37, 10),
(9, 23, 19, '2016-10-22', 22, 10),
(10, 19, 23, '2015-10-24', 16, 13),
(11, 23, 21, '2014-10-18', 38, 12),
(12, 21, 23, '2013-10-19', 27, 10),
(13, 23, 22, '2009-10-24', 18, 12);

-- --------------------------------------------------------

--
-- Structure de la table `score_jeux`
--

DROP TABLE IF EXISTS `score_jeux`;
CREATE TABLE IF NOT EXISTS `score_jeux` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `temps` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `score_jeux`
--

INSERT INTO `score_jeux` (`id`, `pseudo`, `temps`) VALUES
(1, 'Le P', 16);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `DroitScore` tinyint(1) DEFAULT NULL,
  `DroitActualite` tinyint(1) DEFAULT NULL,
  `DroitUser` tinyint(1) DEFAULT NULL,
  `DroitClub` tinyint(1) DEFAULT NULL,
  `DroitPartenaire` tinyint(1) DEFAULT NULL,
  `DroitAction` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `DroitScore`, `DroitActualite`, `DroitUser`, `DroitClub`, `DroitPartenaire`, `DroitAction`) VALUES
(2, 'test', '$2y$10$sjvDGNXSN75k/IWyoSCREenkdSiQ/Hj./u0XMHOS2GzJ1os2KXQOS', 1, 1, 1, 0, 0, 0),
(4, 'liguerugbyadmin', '$2y$10$ftAMpp0Lewz3j2EyyflTYeaHQhJy/tXt9kPQP..qYfj3PFLERG6du', 1, 1, 1, 1, 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
