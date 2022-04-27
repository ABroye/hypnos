CREATE DATABASE hypnos;
-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 22 avr. 2022 à 01:13
-- Version du serveur :  10.6.7-MariaDB-log
-- Version de PHP : 8.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sql_hypnos`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `UserName`, `Password`, `createdate`, `updatedate`) VALUES
(1, 'Alain', 'BROYE', 'admin', 'f0258b6685684c113bad94d91b8fa02a', '2022-04-18 21:15:00', '2022-04-18 21:15:00');

-- --------------------------------------------------------

--
-- Structure de la table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `city` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `managers`
--

INSERT INTO `managers` (`id`, `firstname`, `lastname`, `address`, `zipcode`, `city`, `email`, `password`) VALUES
(1, 'Charles', 'De Pontignac', '1 Boulevard de la Reine', '78000', 'Versailles', 'c.de-pontignac@hypnos-group.com', 'f0258b6685684c113bad94d91b8fa02a'),
(2, 'Eva', 'Gunther', '43 Boulevard de la Plage', '33120', 'Arcachon', 'e.gunther@hypnos-group.com', 'f0258b6685684c113bad94d91b8fa02a'),
(3, 'Alice', 'Shepard', '41 Rue Branda', '29200', 'Brest', 'a.shepard@hypnos-group.com', 'f0258b6685684c113bad94d91b8fa02a'),
(4, 'Li', 'Lungfan', '10 Rue des Allobroges', '74120', 'Megève', 'l.lungfan@hypnos-group.com', 'f0258b6685684c113bad94d91b8fa02a'),
(5, 'Anges', 'Martin', '3 Rue la Fontaine', '06400', 'Cannes', 'a.martin@hypnos-group.com', 'f0258b6685684c113bad94d91b8fa02a'),
(6, 'Éric', 'Turpin', '112 Rue Victor Hugo', '14800', 'Deauville', 'e.turpin@hypnos-group.com', 'f0258b6685684c113bad94d91b8fa02a'),
(7, 'Julie', 'Hieronimus', '3 rue gambetta', '64000', 'Pau', 'j.hieronimus@hypnos-group.com', 'f0258b6685684c113bad94d91b8fa02a');

-- --------------------------------------------------------

--
-- Structure de la table `msg`
--

CREATE TABLE `msg` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `emailid` varchar(100) DEFAULT NULL,
  `phonenumber` char(15) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `postingdate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `msg`
--

INSERT INTO `msg` (`id`, `firstname`, `lastname`, `emailid`, `phonenumber`, `subject`, `message`, `postingdate`, `status`) VALUES
(7, 'Alain', 'BROYE', 'alain.broye@live.fr', '0607080910', 'Demande de renseignement sur une suite', 'Test du 20 avril 2022 à 20h10', '2022-04-20 18:11:33', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `msg_users`
--

CREATE TABLE `msg_users` (
  `id` int(11) NOT NULL,
  `useremail` varchar(100) DEFAULT NULL,
  `request` varchar(100) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `postingdate` timestamp NULL DEFAULT current_timestamp(),
  `responseresort` mediumtext DEFAULT NULL,
  `responsedate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `msg_users`
--

INSERT INTO `msg_users` (`id`, `useremail`, `request`, `message`, `postingdate`, `responseresort`, `responsedate`) VALUES
(20, 'alain.broye39@gmail.com', 'Réclamation', 'Réclamation du 20/04/2022 à 20h16', '2022-04-20 18:16:40', NULL, NULL),
(21, 'alain.broye39@gmail.com', 'Service supplémentaire', 'Commande du 20/0402022 à 20h17', '2022-04-20 18:17:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT '',
  `detail` longtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`id`, `type`, `detail`) VALUES
(1, 'terms', '												\r\nConditions générales d\'utilisation\r\n\r\nEn vigueur au 21 avril 2022\r\n\r\nLes présentes conditions générales d\'utilisation (dites « CGU ») ont pour objet l\'encadrement juridique des modalités de mise à disposition du site et des services par et de définir les conditions d’accès et d’utilisation des services par « l\'Utilisateur ».\r\n\r\nLes présentes CGU sont accessibles sur le site à la rubrique «CGU».\r\nArticle 1 : Les mentions légales\r\n\r\nL’édition et la direction de la publication du site hypnos-group.com est assurée par Charles De Pontignac, domicilié  Boulevard de la Reine 78000 Versailles.\r\n\r\nNuméro de téléphone est +33 (0)1 23 45 67 89\r\n\r\nSon adresse électronique est : contact@hypnos-group.com\r\n\r\nL\'hébergeur du site hypnos-group.com est la société hypnos-group Ltd, dont le siège social est situé au  Boulevard de la Reine 78000 Versailles, avec le numéro de téléphone : +33 (0)1 23 45 67 89.\r\n\r\nARTICLE 2 : Accès au site\r\n\r\nLe site hypnos-group.com permet à l\'Utilisateur un accès gratuit aux services suivants :\r\n\r\nLe site internet propose les services suivants :\r\n\r\nEn tant que visiteur :\r\n   - Consultation des pages du site web,\r\n   - Contacter Hypnos Group via le formulaire de contact,\r\n   - Créer un compte client,\r\n\r\nEn tant que client :\r\n   - Se connecter à son espace client,\r\n   - Réserver une suite,\r\n   - Envoyer un courriel au service clients via le formulaire privé,\r\n   - Voir et modifier ses informations,\r\n   - Modifier son mot de passe,\r\n   - Consulter l\'historique de ses réservations,\r\n   - Annuler une réservation,\r\n   - Consulter l\'historique de ses échanges avec le service client.\r\n\r\nLe site est accessible gratuitement en tout lieu à tout Utilisateur ayant un accès à Internet. Tous les frais supportés par l\'Utilisateur pour accéder au service (matériel informatique, logiciels, connexion Internet, etc.) sont à sa charge.\r\nARTICLE 3 : Collecte des données\r\n\r\nLe site est exempté de déclaration à la Commission Nationale Informatique et Libertés (CNIL) dans la mesure où il ne collecte aucune donnée concernant les Utilisateurs.\r\nARTICLE 4 : Propriété intellectuelle\r\n\r\nLes marques, logos, signes ainsi que tous les contenus du site (textes, images, son…) font l\'objet d\'une protection par le Code de la propriété intellectuelle et plus particulièrement par le droit d\'auteur.\r\n\r\nL\'Utilisateur doit solliciter l\'autorisation préalable du site pour toute reproduction, publication, copie des différents contenus. Il s\'engage à une utilisation des contenus du site dans un cadre strictement privé, toute utilisation à des fins commerciales et publicitaires est strictement interdite.\r\n\r\nToute représentation totale ou partielle de ce site par quelque procédé que ce soit, sans l’autorisation expresse de l’exploitant du site Internet constituerait une contrefaçon sanctionnée par l’article L 335-2 et suivants du Code de la propriété intellectuelle.\r\n\r\nIl est rappelé conformément à l’article L122-5 du Code de propriété intellectuelle que l’Utilisateur qui reproduit, copie ou publie le contenu protégé doit citer l’auteur et sa source.\r\nARTICLE 5 : Responsabilité\r\n\r\nLes sources des informations diffusées sur le site hypnos-group.com sont réputées fiables mais le site ne garantit pas qu’il soit exempt de défauts, d’erreurs ou d’omissions.\r\n\r\nLes informations communiquées sont présentées à titre indicatif et général sans valeur contractuelle. Malgré des mises à jour régulières, le site hypnos-group.com ne peut être tenu responsable de la modification des dispositions administratives et juridiques survenant après la publication. De même, le site ne peut être tenue responsable de l’utilisation et de l’interprétation de l’information contenue dans ce site.\r\n\r\nLe site hypnos-group.com ne peut être tenu pour responsable d’éventuels virus qui pourraient infecter l’ordinateur ou tout matériel informatique de l’Internaute, à la suite de son utilisation, à l’accès, ou au téléchargement provenant de ce site.\r\n\r\nLa responsabilité du site ne peut être engagée en cas de force majeure ou du fait imprévisible et insurmontable d\'un tiers.\r\nARTICLE 6 : Liens hypertextes\r\n\r\nDes liens hypertextes peuvent être présents sur le site. L’Utilisateur est informé qu’en cliquant sur ces liens, il sortira du site hypnos-group.com. Ce dernier n’a pas de contrôle sur les pages web sur lesquelles aboutissent ces liens et ne saurait, en aucun cas, être responsable de leur contenu.\r\nARTICLE 7 : Cookies\r\n\r\nL’Utilisateur est informé que lors de ses visites sur le site, un cookie peut s’installer automatiquement sur son logiciel de navigation.\r\n\r\nLes cookies sont de petits fichiers stockés temporairement sur le disque dur de l’ordinateur de l’Utilisateur par votre navigateur et qui sont nécessaires à l’utilisation du site hypnos-group.com. Les cookies ne contiennent pas d’information personnelle et ne peuvent pas être utilisés pour identifier quelqu’un. Un cookie contient un identifiant unique, généré aléatoirement et donc anonyme. Certains cookies expirent à la fin de la visite de l’Utilisateur, d’autres restent.\r\n\r\nL’information contenue dans les cookies est utilisée pour améliorer le site hypnos-group.com.\r\n\r\nEn naviguant sur le site, L’Utilisateur les accepte.\r\n\r\nL’Utilisateur pourra désactiver ces cookies par l’intermédiaire des paramètres figurant au sein de son logiciel de navigation.\r\nARTICLE 8 : Droit applicable et juridiction compétente\r\n\r\nLa législation française s\'applique au présent contrat. En cas d\'absence de résolution amiable d\'un litige né entre les parties, les tribunaux français seront seuls compétents pour en connaître\r\n\r\nPour toute question relative à l’application des présentes CGU, vous pouvez joindre l’éditeur aux coordonnées inscrites à l’ARTICLE 1.\r\n											'),
(2, 'privacy', '\r\nMentions légales\r\n\r\nEn vigueur au 21 avril 2022\r\n\r\nConformément aux dispositions des Articles 6-III et 19 de la Loi n°2004-575 du 21 juin 2004 pour la Confiance dans l’économie numérique, dite L.C.E.N., il est porté à la connaissance des utilisateurs et visiteurs, ci-après l’« Utilisateur », du site www.hypnos-group.com , ci-après le « Site », les présentes mentions légales.\r\n\r\nLa connexion et la navigation sur le Site par l’Utilisateur implique acceptation intégrale et sans réserve des présentes mentions légales.\r\n\r\nCes dernières sont accessibles sur le Site à la rubrique « Mentions légales ».\r\nARTICLE 1 - L\'EDITEUR\r\n\r\nL’édition et la direction de la publication du Site est assurée par Charles De PONTIGNAC, domiciliée 1 Boulevard de la Reine 78000 Versailles, dont le numéro de téléphone est +33(0)6 07 08 09 10, et l\'adresse c.de-pontignac@hypnos-group.com\r\n\r\nCi-après l\' « Éditeur ».\r\nARTICLE 2 - L\'HEBERGEUR\r\n\r\nL\'hébergeur du Site est la société hypnos-group dont le siège social est situé au 1 Boulevard de la Reine 78000 Versailles , avec le numéro de téléphone : +33 (0)1 23 45 67 89 + adresse mail de contact : contact@hypnos-group.com\r\nARTICLE 3 - ACCES AU SITE\r\n\r\nLe Site est accessible en tout endroit, 7j/7, 24h/24 sauf cas de force majeure, interruption programmée ou non et pouvant découlant d’une nécessité de maintenance.\r\n\r\nEn cas de modification, interruption ou suspension du Site, l\'Editeur ne saurait être tenu responsable.\r\nARTICLE 4 - COLLECTE DES DONNEES\r\n\r\nLe Site assure à l\'Utilisateur une collecte et un traitement d\'informations personnelles dans le respect de la vie privée conformément à la loi n°78-17 du 6 janvier 1978 relative à l\'informatique, aux fichiers et aux libertés.\r\n\r\nEn vertu de la loi Informatique et Libertés, en date du 6 janvier 1978, l\'Utilisateur dispose d\'un droit d\'accès, de rectification, de suppression et d\'opposition de ses données personnelles.\r\nL\'Utilisateur exerce ce droit :\r\n\r\n    par mail à l\'adresse email : contact@hypnos-group.com\r\n    via un formulaire de contact\r\n    via son espace personnel\r\n\r\nToute utilisation, reproduction, diffusion, commercialisation, modification de toute ou partie du Site, sans autorisation de l’Editeur est prohibée et pourra entraînée des actions et poursuites judiciaires telles que notamment prévues par le Code de la propriété intellectuelle et le Code civil.'),
(3, 'aboutus', ''),
(11, 'contact', '																				<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Address------J-890 Dwarka House New Delhi-110096</span>');

-- --------------------------------------------------------

--
-- Structure de la table `pages_resort`
--

CREATE TABLE `pages_resort` (
  `pageid` int(11) NOT NULL,
  `pagename` varchar(100) NOT NULL,
  `pagetitle` varchar(255) NOT NULL,
  `pagedescription` text NOT NULL,
  `pageaddress` text NOT NULL,
  `pagezipcode` int(10) NOT NULL,
  `pagecity` varchar(100) NOT NULL,
  `pageimage` varchar(100) NOT NULL,
  `resortid` int(11) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `pages_resort`
--

INSERT INTO `pages_resort` (`pageid`, `pagename`, `pagetitle`, `pagedescription`, `pageaddress`, `pagezipcode`, `pagecity`, `pageimage`, `resortid`, `createdate`, `updatedate`) VALUES
(1, 'Hôtel Hypnos Arcachon', 'Bienvenue sur la page de l\'hôtel Hypnos d\'arcachon', 'Notre hôtel est niché au bord de l\'océan atlantique avec vue imprenable sur la baie d\'Arcachon.', '43 Boulevard de la Plage', 33120, 'Arcachon', 'arcachon.webp', 1, '2022-04-19 07:01:43', '2022-04-19 07:25:05'),
(2, 'Page Pau', 'Hypnos Brest', 'Description Brest', '41 Rue Branda', 29200, 'Brest', 'brest.webp', 6, '2022-04-20 17:29:37', '2022-04-20 21:46:42'),
(3, 'Page Brest', 'Hypnos Brest', 'Description Brest', '41 Rue Branda', 29200, 'Brest', 'brest.webp', 2, '2022-04-20 17:29:37', '2022-04-20 20:49:37'),
(4, 'Versailles', 'Hypnos Versailles', 'Notre hôtel est idéalement situé à proximité du château et vous permettra de flâner dans ses jardin et son orangeraie mondialement connue.', '1 Boulevard de la Reine', 78000, 'Versailles', 'Versailles.webp', 7, '2022-04-20 17:29:37', '2022-04-21 10:38:48'),
(5, 'Page Megève', 'Hypnos Brest', 'Description Brest', '41 Rue Branda', 29200, 'Brest', 'brest.webp', 5, '2022-04-20 17:29:37', '2022-04-20 21:42:28'),
(6, 'Page Cannes', 'Hypnos Brest', 'Description Brest', '41 Rue Branda', 29200, 'Brest', 'brest.webp', 3, '2022-04-20 17:29:37', '2022-04-20 21:42:57'),
(7, 'Page Dauville', 'Hypnos Brest', 'Description Brest', '41 Rue Branda', 29200, 'Brest', 'brest.webp', 4, '2022-04-20 17:29:37', '2022-04-20 21:42:57');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `bookingid` int(11) NOT NULL,
  `suiteid` int(11) DEFAULT NULL,
  `resortid` int(11) DEFAULT NULL,
  `useremail` varchar(100) DEFAULT NULL,
  `datein` varchar(100) DEFAULT NULL,
  `dateout` varchar(100) DEFAULT NULL,
  `usercomment` text DEFAULT NULL,
  `createdate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL,
  `cancelledby` varchar(5) DEFAULT NULL,
  `updatedate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`bookingid`, `suiteid`, `resortid`, `useremail`, `datein`, `dateout`, `usercomment`, `createdate`, `status`, `cancelledby`, `updatedate`) VALUES
(1, 1, NULL, 'alain.broye39@gmail.com', '2022-04-30', '2022-05-07', 'Test réservation', '2022-04-19 19:00:36', 0, '', NULL),
(2, 1, NULL, 'laurence.estellon@gmail.com', '2022-04-29', '2022-05-01', 'Réservation Laurence', '2022-04-20 16:58:56', 1, NULL, NULL),
(3, 7, NULL, 'alain.broye@live.fr', '2022-04-22', '2022-04-24', 'Réservation Alain', '2022-04-20 17:31:15', 2, 'a', NULL),
(4, 2, NULL, 'alain.broye39@gmail.com', '2022-05-01', '2022-05-01', 'Vacances', '2022-04-20 18:08:34', 0, NULL, NULL),
(5, 1, NULL, 'alain.broye39@gmail.com', '2022-05-01', '2022-06-01', 'Vacances du 01/05/2022 au 01/06/2022 Alain', '2022-04-20 18:14:21', 0, NULL, NULL),
(6, 4, NULL, 'alain.broye39@gmail.com', '2022-04-21', '2022-04-22', 'Ma Ninnie Love', '2022-04-20 18:15:03', 0, NULL, NULL),
(7, 1, NULL, 'alain.broye39@gmail.com', '2022-05-01', '2022-05-03', 'jjnkjnkj', '2022-04-20 21:11:58', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `resorts`
--

CREATE TABLE `resorts` (
  `resortid` int(11) NOT NULL,
  `resortname` varchar(100) NOT NULL,
  `resortaddress` varchar(255) NOT NULL,
  `resortzipcode` int(10) NOT NULL,
  `resortcity` varchar(100) NOT NULL,
  `resortdescription` text NOT NULL,
  `resortimage` varchar(100) NOT NULL,
  `managerid` int(11) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `resorts`
--

INSERT INTO `resorts` (`resortid`, `resortname`, `resortaddress`, `resortzipcode`, `resortcity`, `resortdescription`, `resortimage`, `managerid`, `createdate`, `updatedate`) VALUES
(1, 'Hypnos Arcachon', '43 Boulevard de la Plage', 33120, 'Arcachon', 'Description Hypnos Megève', 'arcachon.webp', 2, '2022-04-19 06:38:25', '2022-04-19 06:38:25'),
(2, 'Hypnos Brest', '41 Rue Branda', 29200, 'Brest', 'Description Hypnos Brest', 'brest.webp', 3, '2022-04-19 06:21:52', '2022-04-19 06:21:52'),
(3, 'Hypnos Cannes', '3 Rue la Fontaine', 6400, 'Cannes', 'Description Hypnos Cannes', 'cannes.webp', 5, '2022-04-19 06:22:17', '2022-04-19 06:22:17'),
(4, 'Hypnos Deauville', '112 Rue Victor Hugo', 14800, 'Deauville', 'Description Hypnos Deauville', 'deauville.webp', 6, '2022-04-19 06:24:41', '2022-04-19 06:24:41'),
(5, 'Hypnos Megève', '10 Rue des Allobroges', 74120, 'Megève', 'Description Hypnos Megève', 'megeve.webp', 4, '2022-04-19 06:21:03', '2022-04-19 06:21:03'),
(6, 'Hypnos Pau', '3 rue gambetta', 64000, 'Pau', 'Description Hypnos Pau', 'pau.webp', 5, '2022-04-20 18:40:15', '2022-04-20 18:40:15'),
(7, 'Hypnos Versailles', '1 Boulevard de la Reine', 78000, 'Versailles', 'Hôtel hypnos Versailles', 'versailles.webp', 1, '2022-04-21 12:32:26', '2022-04-21 12:32:26');

-- --------------------------------------------------------

--
-- Structure de la table `suites`
--

CREATE TABLE `suites` (
  `suiteid` int(11) NOT NULL,
  `suitename` varchar(100) DEFAULT NULL,
  `suitetitle` varchar(200) DEFAULT NULL,
  `suitelocation` varchar(100) NOT NULL,
  `resortid` int(11) DEFAULT NULL,
  `suiteprice` int(11) DEFAULT NULL,
  `suiteservices` varchar(255) DEFAULT NULL,
  `suitedescription` text DEFAULT NULL,
  `suiteimage` varchar(100) DEFAULT NULL,
  `createdate` timestamp NULL DEFAULT current_timestamp(),
  `updatedate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `suites`
--

INSERT INTO `suites` (`suiteid`, `suitename`, `suitetitle`, `suitelocation`, `resortid`, `suiteprice`, `suiteservices`, `suitedescription`, `suiteimage`, `createdate`, `updatedate`) VALUES
(1, 'Éléonore', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', 'Hypnos Arcachon', 1, 890, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo a quos explicabo sint vero ad rem accusantium, ea iure dolor omnis laborum deleniti odit commodi fuga voluptatibus perferendis quidem velit!', 'room-1.png', '2022-04-10 20:22:05', '2022-04-21 12:44:17'),
(2, 'Adélaïde', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'Hypnos Brest', 2, 890, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo a quos explicabo sint vero ad rem accusantium, ea iure dolor omnis laborum deleniti odit commodi fuga voluptatibus perferendis quidem velit!', 'room-2.png', '2022-04-12 09:24:48', '2022-04-21 12:44:32'),
(3, 'Amandine', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'Hypnos Cannes', 3, 690, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo a quos explicabo sint vero ad rem accusantium, ea iure dolor omnis laborum deleniti odit commodi fuga voluptatibus perferendis quidem velit!', 'room-3.png', '2022-04-15 09:31:06', '2022-04-21 12:44:42'),
(4, 'Élodie', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'Hypnos Deauville', 4, 590, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo a quos explicabo sint vero ad rem accusantium, ea iure dolor omnis laborum deleniti odit commodi fuga voluptatibus perferendis quidem velit!', 'room-4.png', '2022-04-15 20:19:56', '2022-04-21 12:44:52'),
(5, 'Clémence', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'Hypnos Megève', 5, 990, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo a quos explicabo sint vero ad rem accusantium, ea iure dolor omnis laborum deleniti odit commodi fuga voluptatibus perferendis quidem velit!', 'room-5.png', '2022-04-15 21:50:07', '2022-04-21 12:45:03'),
(6, 'Louise', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'hypnos Pau', 6, 590, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo a quos explicabo sint vero ad rem accusantium, ea iure dolor omnis laborum deleniti odit commodi fuga voluptatibus perferendis quidem velit!', 'room-6.png', '2022-04-18 19:45:06', '2022-04-21 12:45:14'),
(7, 'Chloé', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'Hypnos Versailles', 7, 890, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo a quos explicabo sint vero ad rem accusantium, ea iure dolor omnis laborum deleniti odit commodi fuga voluptatibus perferendis quidem velit!', 'room-7.png', '2022-04-18 19:47:40', '2022-04-21 12:45:25'),
(8, 'Gaëlle', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'Hypnos Arcachon', 1, 590, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo a quos explicabo sint vero ad rem accusantium, ea iure dolor omnis laborum deleniti odit commodi fuga voluptatibus perferendis quidem velit!', 'room-8.png', '2022-04-20 18:30:15', '2022-04-21 12:45:34');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `phonenumber` char(10) DEFAULT NULL,
  `emailid` varchar(70) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `createdate` timestamp NULL DEFAULT current_timestamp(),
  `updatedate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `phonenumber`, `emailid`, `password`, `createdate`, `updatedate`) VALUES
(6, 'Alain François', 'BROYE', '0607080910', 'alain.broye39@gmail.com', '93bdce74179ca1b91858d42048b6ec1e', '2022-04-19 15:38:18', '2022-04-20 17:54:35'),
(7, 'Laurence', 'ESTELLON', '0607080910', 'laurence.estellon@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2022-04-20 16:55:41', '2022-04-20 17:01:34'),
(8, 'Alain', 'Broye', '0749839900', 'alain.broye@live.fr', '93bdce74179ca1b91858d42048b6ec1e', '2022-04-20 17:29:21', '2022-04-20 17:29:21'),
(9, 'Laurence', 'Estellon', '0767801841', 'laurence.estellon@gmail.com', '7fb5aec2d5444ad2907b15e63a175b67', '2022-04-20 17:32:54', '2022-04-20 17:32:54');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `msg_users`
--
ALTER TABLE `msg_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pages_resort`
--
ALTER TABLE `pages_resort`
  ADD PRIMARY KEY (`pageid`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`bookingid`);

--
-- Index pour la table `resorts`
--
ALTER TABLE `resorts`
  ADD PRIMARY KEY (`resortid`);

--
-- Index pour la table `suites`
--
ALTER TABLE `suites`
  ADD PRIMARY KEY (`suiteid`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmailId` (`emailid`),
  ADD KEY `EmailId_2` (`emailid`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `msg`
--
ALTER TABLE `msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `msg_users`
--
ALTER TABLE `msg_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `pages_resort`
--
ALTER TABLE `pages_resort`
  MODIFY `pageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `bookingid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `resorts`
--
ALTER TABLE `resorts`
  MODIFY `resortid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `suites`
--
ALTER TABLE `suites`
  MODIFY `suiteid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
