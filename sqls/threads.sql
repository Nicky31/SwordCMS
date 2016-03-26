-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 02 Février 2013 à 20:30
-- Version du serveur: 5.5.27
-- Version de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ancestra_other`
--

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `threads` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) CHARACTER SET latin1 NOT NULL,
  `text` text NOT NULL,
  `auteur` varchar(255) CHARACTER SET latin1 NOT NULL,
  `type` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT 'news',
  `date` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '?? / ?? / ????',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Contenu de la table `threads`
--

INSERT INTO `threads` (`id`, `titre`, `text`, `auteur`, `type`, `date`) VALUES
(47, 'CameleonCMS[EDIT]', 'Commencement du codage de [b]CameleonCMS[/b] le [b]Dimanche 13 Janvier 2013.[/b]\r\n\r\n[color=red][b]Changelog  v1:[/b][/color]\r\n- Implantation du design de TitaniumCMS\r\n- Connection / Deconnection [color=green]OK[/color]\r\n- Inscription [color=green]OK[/color]\r\n- Affichage infos du compte + modification [color=green]OK[/color]\r\n- Affichage news avec pagination [color=green]OK[/color]\r\n- Administration : Ajout news, delete news, edit news [color=green]OK[/color]\r\n- Page Nous Rejoindre [color=green]OK[/color]\r\n- Affichage Staff [color=green]OK[/color]\r\n- Classements Persos/Guildes/Voteurs [color=green]OK[/color]\r\n- Boutique [color=green]OK[/color] : Listage avec stats + screen, achat , ajout , delete\r\n- Vote avec protection anti multi-compte [color=green]OK[/color]\r\n\r\n[edit accomplete]', 'bourinpro', 'news', '2013-01-30 18:56:31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
