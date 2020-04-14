-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 14 Avril 2020 à 10:43
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `test2`
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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `item`
--

INSERT INTO `item` (`ID`, `Nom`, `Categorie`, `Description`, `Prix`, `vente_par_enchere`, `vente_immediat`, `vente_par_meilleure_offre`) VALUES
(1, 'Vase MING', 'BON_POUR_LE_MUSEE', 'La céramique chinoise, principalement connue pour la porcelaine que les Chinois ont inventée, est riche d''une longue tradition d''innovations techniques et stylistiques.', 1116, 1, 0, 0),
(2, 'Guitare ROCK', 'FERRAILLE_OU_TRESOR', 'La guitare est un instrument à cordes pincées. Les cordes sont disposées parallèlement à la table d''harmonie et au manche, généralement coupé de frettes, sur lesquelles on appuie les cordes, d''une main, pour produire des notes différentes.', 5500, 0, 1, 0),
(3, 'Hélicoptere black manba', 'ACCESSOIRE_VIP', 'Dans le mouvement de milice des États-Unis, l''hélicoptère noir est le symbole d''une prise de contrôle militaire conspiratrice présumée des États-Unis, bien qu''il ait également été associé à des OVNIS, des hommes en noir et des complots similaires.', 10000000, 0, 0, 1),
(4, 'Caisse de munitions de la WW2', 'BON_POUR_LE_MUSEE', 'Vends,caisse allemande ww2 complète avec rack Mun le I G 18 en bois pour 3 coups.Caisse très solide, pas de vers, le couvercle est movible une fois ouverte.Voir photos Livraison par LaPoste pour 10€\r\nPaiement par chèque, virement ou PayPal', 50, 0, 1, 1),
(5, 'Dents de T-REX', 'BON_POUR_LE_MUSEE', 'Véritable dents de t-rex issue de jurrasic park', 30, 1, 0, 0),
(6, 'Drapeau des Etats-Unis WW2', 'BON_POUR_LE_MUSEE', 'Drapeau issue de la bataille de berlin, en parfait état', 50, 0, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
