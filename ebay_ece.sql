-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 14 Avril 2020 à 12:09
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ebay_ece`
--

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Categorie` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Prix` int(11) NOT NULL,
  `vente_par_enchere` tinyint(1) NOT NULL,
  `vente_immediat` tinyint(1) NOT NULL,
  `vente_par_meilleure_offre` tinyint(1) NOT NULL,
  `email_vendeur` varchar(240) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `item`
--

INSERT INTO `item` (`ID`, `Nom`, `Categorie`, `Description`, `Prix`, `vente_par_enchere`, `vente_immediat`, `vente_par_meilleure_offre`, `email_vendeur`) VALUES
(1, 'Vase MING', 'BON_POUR_LE_MUSEE', 'La céramique chinoise, principalement connue pour la porcelaine que les Chinois ont inventée, est riche d''une longue tradition d''innovations techniques et stylistiques.', 1116, 1, 0, 0, 'bidon@gmail.com'),
(2, 'Guitare ROCK', 'FERRAILLE_OU_TRESOR', 'La guitare est un instrument à cordes pincées. Les cordes sont disposées parallèlement à la table d''harmonie et au manche, généralement coupé de frettes, sur lesquelles on appuie les cordes, d''une main, pour produire des notes différentes.', 5500, 0, 1, 0, 'test@gmail.com'),
(3, 'Hélicoptere black manba', 'ACCESSOIRE_VIP', 'Dans le mouvement de milice des États-Unis, l''hélicoptère noir est le symbole d''une prise de contrôle militaire conspiratrice présumée des États-Unis, bien qu''il ait également été associé à des OVNIS, des hommes en noir et des complots similaires.', 10000000, 0, 0, 1, 'bidon@gmail.com'),
(4, 'Caisse de munitions de la WW2', 'BON_POUR_LE_MUSEE', 'Vends,caisse allemande ww2 complète avec rack Mun le I G 18 en bois pour 3 coups.Caisse très solide, pas de vers, le couvercle est movible une fois ouverte.Voir photos Livraison par LaPoste pour 10€\r\nPaiement par chèque, virement ou PayPal', 50, 0, 1, 1, 'bidon@gmail.com'),
(5, 'Dents de T-REX', 'BON_POUR_LE_MUSEE', 'Véritable dents de t-rex issue de jurrasic park', 30, 1, 0, 0, 'test@gmail.com'),
(6, 'Drapeau des Etats-Unis WW2', 'BON_POUR_LE_MUSEE', 'Drapeau issue de la bataille de berlin, en parfait état', 50, 0, 1, 1, 'test@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE IF NOT EXISTS `panier` (
  `email_client` varchar(240) NOT NULL,
  `numero_item` int(11) NOT NULL,
  PRIMARY KEY (`email_client`,`numero_item`),
  KEY `email_client` (`email_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`email_client`, `numero_item`) VALUES
('bidon@gmail.com', 2),
('bidon@gmail.com', 4),
('Hina.tunouscasselescouilles@gmail.com', 1),
('Hina.tunouscasselescouilles@gmail.com', 2),
('Polenski@gmail.com', 3),
('Polenski@gmail.com', 6);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `email` varchar(240) NOT NULL DEFAULT '',
  `nom` varchar(240) DEFAULT NULL,
  `prenom` varchar(240) DEFAULT NULL,
  `pseudo` varchar(240) DEFAULT NULL,
  `mot_de_passe` varchar(240) DEFAULT NULL,
  `type_utilisateur` varchar(240) DEFAULT NULL,
  `numero_carte` varchar(240) DEFAULT NULL,
  `type_carte` varchar(240) DEFAULT NULL,
  `date_expiration` date DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`email`, `nom`, `prenom`, `pseudo`, `mot_de_passe`, `type_utilisateur`, `numero_carte`, `type_carte`, `date_expiration`) VALUES
('admin.pro@gmail.com', NULL, NULL, 'Admin', 'Admin', 'Admin', NULL, NULL, NULL),
('bidon@gmail.com', 'Jean', 'Bidon', 'Bibi', '12345', 'VENDEUR', NULL, NULL, NULL),
('donnez.argent@gmail.com', 'Donnez', 'Argent', 'Money', 'money', 'ACHETEUR', '1234567890547896', 'visa', '2031-08-22'),
('Hina.tunouscasselescouilles@gmail.com', 'Hina', 'chiant', 'hina', '456789', 'ACHETEUR', '78945612307894561', 'master_card', '2020-08-20'),
('Polenski@gmail.com', 'Thierry', 'Poli', 'Thierry', 'Thierrylebg', 'ACHETEUR', '1782934785961452', 'visa_premier', '2021-02-11'),
('test@gmail.com', 'Kevin', 'Test', 'Keke', '14789', 'VENDEUR', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
