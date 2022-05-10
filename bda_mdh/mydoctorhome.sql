-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 29 Septembre 2020 à 08:40
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mydoctorhome`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonne`
--

CREATE TABLE `abonne` (
  `idAbonne` int(11) NOT NULL,
  `Avatar` text NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Prenom` varchar(45) NOT NULL,
  `Date_naissance` date NOT NULL,
  `Sexe` varchar(1) NOT NULL,
  `Numero` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `password` varchar(200) NOT NULL,
  `Profession` varchar(45) DEFAULT NULL,
  `Attestation` varchar(100) DEFAULT NULL,
  `cat_abonne` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `abonne`
--

INSERT INTO `abonne` (`idAbonne`, `Avatar`, `Nom`, `Prenom`, `Date_naissance`, `Sexe`, `Numero`, `Email`, `password`, `Profession`, `Attestation`, `cat_abonne`) VALUES
(1, 'images (1).jpeg', 'KANA', 'smeth', '2020-08-07', 'M', '066474000', 'kana@gmail.com', 'smeth', NULL, NULL, NULL),
(2, 'mandela.jpg', 'BALENVOKOLO', 'ferol', '2020-09-16', 'M', '064339456', 'arthur@gmail.com', 'charles', 'Soignant', 'Array', NULL),
(3, '7efdcc1f0996f5481f42670ecca2b3fc.jpgimage/jpegC:\\wamp64\\tmp\\php1B64.tmp0157329', 'BALENVOKOLO', 'charles ferol', '2020-09-03', 'M', '069341772', 'ferol@gmail.com', 'ferol', NULL, NULL, NULL),
(4, '2a7c9f20dca4f70f0841f690ea89a3ba.jpgimage/jpegC:\\wamp64\\tmp\\php1501.tmp0175052', 'M\'BENGUET', 'marnelle', '1999-07-14', 'F', '065084615', 'ammbeguet@gmail.com', 'marnelle', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE `amis` (
  `id` int(11) NOT NULL,
  `user_id1` int(11) DEFAULT NULL,
  `user_id2` int(11) DEFAULT NULL,
  `statut` enum('0','1') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `amis`
--

INSERT INTO `amis` (`id`, `user_id1`, `user_id2`, `statut`) VALUES
(5, 2, 1, '1');

-- --------------------------------------------------------

--
-- Structure de la table `cat_abonne`
--

CREATE TABLE `cat_abonne` (
  `idcat_abonne` int(11) NOT NULL,
  `Nom_cat_abonne` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cat_pro`
--

CREATE TABLE `cat_pro` (
  `idCat_Pro` int(11) NOT NULL,
  `Nom_Cat_Pro` varchar(45) DEFAULT NULL,
  `Produit_idProduit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cat_pro`
--

INSERT INTO `cat_pro` (`idCat_Pro`, `Nom_Cat_Pro`, `Produit_idProduit`) VALUES
(1, 'ALLERGIE', NULL),
(2, 'PREMIERS SOIN', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cat_sujet`
--

CREATE TABLE `cat_sujet` (
  `idCat_Sujet` int(11) NOT NULL,
  `Nom_Cat` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cat_sujet`
--

INSERT INTO `cat_sujet` (`idCat_Sujet`, `Nom_Cat`) VALUES
(1, 'COVID 19'),
(2, 'Paludisme');

-- --------------------------------------------------------

--
-- Structure de la table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text,
  `image` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `image`, `timestamp`, `status`) VALUES
(1, 1, 3, 'bonjour daurian', NULL, '2020-05-25 15:21:06', 1),
(2, 3, 1, 'bonjour carmen', NULL, '2020-05-25 15:53:29', 1),
(3, 3, 1, 'alors, quelle nouvelle ?', NULL, '2020-05-25 15:57:24', 1),
(4, 1, 3, 'rien de spÃ©cial, et de ton cÃ´tÃ© ?', NULL, '2020-05-25 15:58:00', 1),
(5, 3, 1, 'pareil', NULL, '2020-05-25 21:55:02', 1),
(6, 1, 3, 'd\'accord', NULL, '2020-05-25 21:57:00', 1),
(7, 1, 5, 'hello daurian', NULL, '2020-05-26 10:32:23', 1),
(8, 5, 1, 'hello emavy', NULL, '2020-05-26 10:32:42', 1),
(9, 3, 4, 'bonjour carmen', NULL, '2020-05-26 10:54:13', 1),
(10, 4, 3, 'bonjour charles', NULL, '2020-05-26 10:58:04', 1),
(11, 1, 4, 'whatsapp', NULL, '2020-05-26 13:03:22', 1),
(12, 4, 1, 'salut', NULL, '2020-05-26 13:56:01', 1),
(13, 4, 1, 'salut charles comment tu vas', NULL, '2020-05-28 12:16:03', 1),
(14, 1, 4, 'je vais daurian et toi', NULL, '2020-05-28 12:17:33', 1),
(15, 1, 4, 'bonjour daurian', NULL, '2020-06-02 08:06:50', 1),
(25, 4, 1, 'coartem', NULL, '2020-06-16 22:35:07', NULL),
(26, 4, 1, 'salut', NULL, '2020-06-17 08:07:00', NULL),
(27, 4, 1, 'ah ca', NULL, '2020-06-17 08:09:28', NULL),
(28, 4, 1, 'waou', NULL, '2020-06-17 08:10:18', NULL),
(29, 4, 4, 'aspirine 100mg', NULL, '2020-06-17 21:10:46', NULL),
(30, 4, 5, 'aspirine 500mg', NULL, '2020-06-17 21:11:49', NULL),
(31, 4, 5, 'advil pour enfant', '7efdcc1f0996f5481f42670ecca2b3fc.jpgimage/jpegC:\\wamp64\\tmp\\php6780.tmp0157329', '2020-06-17 21:31:49', NULL),
(32, 4, 1, 'nivaquine', '0034d3461b6f68741173ab526683f890.jpgimage/jpegC:\\wamp64\\tmp\\phpD753.tmp0129291', '2020-06-17 22:37:58', NULL),
(33, 4, 1, 'ampiciline pour adulte', '29d638ac67068561fb02fbdeaa70801f.jpgimage/jpegC:\\wamp64\\tmp\\phpB7A5.tmp095501', '2020-06-17 23:06:05', NULL),
(34, 4, 1, 'advil grand', NULL, '2020-06-21 13:44:33', NULL),
(35, 3, 1, 'ðŸ˜‚', NULL, '2020-06-21 14:08:39', 1),
(36, 5, 4, 'salut', NULL, '2020-07-01 21:10:09', 1),
(37, 4, 5, 'bonjour', NULL, '2020-07-02 05:51:57', 1),
(38, 5, 4, 'coucou', NULL, '2020-07-03 05:10:27', 1),
(39, 5, 4, 'ðŸ˜‚', NULL, '2020-07-04 06:13:25', 1),
(40, 15, 5, 'salut daurian comment tu vas?', NULL, '2020-07-04 22:10:25', 1),
(41, 5, 15, 'je vais bien ma clÃ¨se et toi?', NULL, '2020-07-04 22:11:09', 1),
(42, 4, 5, 'amoxi', '2a7c9f20dca4f70f0841f690ea89a3ba.jpgimage/jpegC:\\wamp64\\tmp\\php8A97.tmp0175052', '2020-07-04 23:22:40', NULL),
(43, 4, 15, 'paracetamol', 'reussir_son_site_internet.pdfapplication/pdfC:\\wamp64\\tmp\\phpB2AF.tmp01258723', '2020-07-11 19:47:06', NULL),
(44, 4, 15, 'advil', 'dddd.docxapplication/vnd.openxmlformats-officedocument.wordprocessingml.documentC:\\wamp64\\tmp\\php342B.tmp012553', '2020-07-11 19:49:50', NULL),
(78, 4, 15, 'coucou', NULL, '2020-07-11 20:21:14', 1),
(104, 5, 4, 'salut mon gar', NULL, '2020-07-16 04:39:57', 1),
(105, 4, 15, 'aspirine', '7efdcc1f0996f5481f42670ecca2b3fc.jpgimage/jpegC:\\wamp64\\tmp\\phpD47B.tmp0157329', '2020-07-25 21:06:11', NULL),
(106, 4, 15, 'aspirine', '29d638ac67068561fb02fbdeaa70801f.jpgimage/jpegC:\\wamp64\\tmp\\php54FD.tmp095501', '2020-07-25 21:07:35', NULL),
(107, 4, 15, 'local', '2a7c9f20dca4f70f0841f690ea89a3ba.jpgimage/jpegC:\\wamp64\\tmp\\php8313.tmp0175052', '2020-07-25 21:07:47', NULL),
(108, 4, 15, 'local', '2a7c9f20dca4f70f0841f690ea89a3ba.jpgimage/jpegC:\\wamp64\\tmp\\php4A4C.tmp0175052', '2020-07-25 21:08:38', NULL),
(109, 3, 23, 'bonjour mon coeur comment tu vas ', NULL, '2020-08-25 19:30:36', 1),
(110, 1, 2, 'salut grand', NULL, '2020-09-25 16:27:10', 1),
(111, 1, 2, 'comment tu vas', NULL, '2020-09-28 13:46:58', 1),
(112, 2, 1, 'salut', NULL, '2020-09-28 13:48:52', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_forum`
--

CREATE TABLE `commentaire_forum` (
  `idSujet` int(11) NOT NULL,
  `IdAbonne` int(11) NOT NULL,
  `Commentaire` text NOT NULL,
  `Date_Com` datetime NOT NULL,
  `idCom_forum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_reseau`
--

CREATE TABLE `commentaire_reseau` (
  `idcom` int(11) NOT NULL,
  `idAbonne` int(11) NOT NULL,
  `idPublication` int(11) NOT NULL,
  `Date_Com_Reseau` datetime DEFAULT NULL,
  `commentaire_reseaucol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `like_pub`
--

CREATE TABLE `like_pub` (
  `idAbonne` int(11) NOT NULL,
  `idPublication` int(11) NOT NULL,
  `Date_Like` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `id`, `last_activity`, `is_type`) VALUES
(1, 1, '2020-05-25 13:16:23', 'no'),
(2, 1, '2020-05-25 13:16:23', 'no'),
(3, 1, '2020-05-25 13:16:23', 'no'),
(4, 1, '2020-05-25 13:17:02', 'no'),
(5, 1, '2020-05-25 13:27:58', 'no'),
(6, 1, '2020-05-25 14:32:28', 'no'),
(7, 3, '2020-05-25 13:33:47', 'no'),
(8, 3, '2020-05-25 16:41:16', 'no'),
(9, 3, '2020-05-25 21:49:21', 'no'),
(10, 1, '2020-05-25 22:01:48', 'no'),
(11, 3, '2020-05-25 21:59:48', 'no'),
(12, 3, '2020-05-25 22:36:21', 'no'),
(13, 1, '2020-05-25 22:03:59', 'no'),
(14, 4, '2020-05-25 22:05:35', 'no'),
(15, 5, '2020-05-25 22:36:30', 'no'),
(16, 1, '2020-05-26 10:33:12', 'no'),
(17, 4, '2020-05-26 10:25:52', 'no'),
(18, 5, '2020-05-26 10:33:25', 'no'),
(19, 4, '2020-05-26 13:04:24', 'no'),
(20, 3, '2020-05-26 10:52:37', 'no'),
(21, 3, '2020-05-26 11:34:00', 'no'),
(22, 1, '2020-05-26 13:06:05', 'no'),
(23, 1, '2020-05-26 13:56:42', 'no'),
(24, 4, '2020-05-26 13:57:50', 'no'),
(25, 1, '2020-05-26 13:58:56', 'no'),
(26, 1, '2020-05-28 12:16:32', 'no'),
(27, 4, '2020-05-28 12:17:42', 'no'),
(28, 1, '2020-05-28 12:27:02', 'no'),
(29, 1, '2020-06-02 08:05:58', 'no'),
(30, 4, '2020-06-02 08:07:00', 'no'),
(31, 1, '2020-06-02 08:21:09', 'no'),
(32, 1, '2020-06-02 10:42:22', 'no'),
(33, 1, '2020-06-03 19:30:28', 'no'),
(34, 4, '2020-06-02 10:45:36', 'no'),
(35, 4, '2020-06-04 18:21:59', 'no'),
(36, 1, '2020-06-05 16:52:59', 'no'),
(37, 4, '2020-06-06 07:44:31', 'no'),
(38, 1, '2020-06-09 13:28:01', 'no'),
(39, 1, '2020-06-09 13:33:03', 'no'),
(40, 1, '2020-06-09 13:38:37', 'no'),
(41, 1, '2020-06-09 13:44:40', 'no'),
(42, 1, '2020-06-09 13:49:57', 'no'),
(43, 1, '2020-06-09 13:54:34', 'no'),
(44, 7, '2020-06-09 13:53:04', 'no'),
(45, 5, '2020-06-09 13:53:58', 'no'),
(46, 1, '2020-06-09 14:13:32', 'no'),
(47, 4, '2020-06-10 05:24:24', 'no'),
(48, 1, '2020-06-10 06:02:48', 'no'),
(49, 7, '2020-06-10 19:35:12', 'no'),
(50, 5, '2020-06-10 19:35:38', 'no'),
(51, 1, '2020-06-10 20:27:27', 'no'),
(52, 4, '2020-06-11 08:09:20', 'no'),
(53, 1, '2020-06-11 08:23:49', 'no'),
(54, 1, '2020-06-11 08:29:51', 'no'),
(55, 5, '2020-06-11 08:30:07', 'no'),
(56, 1, '2020-06-11 14:16:07', 'no'),
(57, 5, '2020-06-11 21:13:55', 'no'),
(58, 4, '2020-06-11 23:02:51', 'no'),
(59, 1, '2020-06-13 07:40:07', 'no'),
(60, 1, '2020-06-13 07:43:27', 'no'),
(61, 4, '2020-06-13 08:41:24', 'no'),
(62, 1, '2020-06-13 12:29:01', 'no'),
(63, 1, '2020-06-15 12:14:17', 'no'),
(64, 4, '2020-06-15 12:49:16', 'no'),
(65, 7, '2020-06-15 12:49:44', 'no'),
(66, 1, '2020-06-16 21:49:44', 'no'),
(67, 4, '2020-06-16 20:37:03', 'no'),
(68, 4, '2020-06-17 23:12:06', 'no'),
(69, 1, '2020-06-17 07:17:29', 'no'),
(70, 1, '2020-06-17 20:30:04', 'no'),
(71, 5, '2020-06-17 21:31:21', 'no'),
(72, 1, '2020-06-17 22:37:38', 'no'),
(73, 1, '2020-06-17 23:23:12', 'no'),
(74, 1, '2020-06-19 07:39:27', 'no'),
(75, 4, '2020-06-21 05:15:22', 'no'),
(76, 1, '2020-06-21 05:30:12', 'no'),
(77, 1, '2020-06-21 14:53:39', 'no'),
(78, 4, '2020-06-21 05:43:20', 'no'),
(79, 4, '2020-06-21 14:06:05', 'no'),
(80, 3, '2020-06-21 14:11:44', 'no'),
(81, 4, '2020-06-21 19:45:24', 'no'),
(82, 1, '2020-06-24 11:55:02', 'no'),
(83, 1, '2020-06-24 13:00:25', 'no'),
(84, 1, '2020-06-24 13:11:03', 'no'),
(85, 1, '2020-06-24 13:18:00', 'no'),
(86, 1, '2020-06-24 13:22:20', 'no'),
(87, 5, '2020-06-24 13:45:48', 'no'),
(88, 1, '2020-06-24 13:46:14', 'no'),
(89, 1, '2020-06-24 15:57:09', 'no'),
(90, 1, '2020-06-25 21:58:42', 'no'),
(91, 4, '2020-06-25 22:41:29', 'no'),
(92, 1, '2020-06-26 18:57:28', 'no'),
(93, 4, '2020-06-26 20:17:39', 'no'),
(94, 4, '2020-06-27 05:28:11', 'no'),
(95, 4, '2020-06-27 05:51:30', 'no'),
(96, 7, '2020-06-28 06:28:08', 'no'),
(97, 5, '2020-06-28 06:31:36', 'no'),
(98, 3, '2020-06-28 06:32:01', 'no'),
(99, 1, '2020-06-28 06:33:05', 'no'),
(100, 4, '2020-06-29 19:41:43', 'no'),
(101, 1, '2020-06-29 19:13:49', 'no'),
(102, 4, '2020-06-29 19:15:50', 'no'),
(103, 1, '2020-06-29 19:17:05', 'no'),
(104, 11, '2020-06-29 19:56:22', 'no'),
(105, 12, '2020-06-29 20:08:52', 'no'),
(106, 13, '2020-06-29 20:13:09', 'no'),
(107, 14, '2020-06-29 20:17:05', 'no'),
(108, 4, '2020-06-29 20:33:50', 'no'),
(109, 4, '2020-06-29 20:39:07', 'no'),
(110, 4, '2020-06-29 20:45:34', 'no'),
(111, 4, '2020-06-29 21:11:43', 'no'),
(112, 4, '2020-07-03 05:12:25', 'no'),
(113, 5, '2020-07-02 06:31:25', 'no'),
(114, 4, '2020-07-03 05:50:23', 'no'),
(115, 5, '2020-07-03 05:19:57', 'no'),
(116, 15, '2020-07-03 05:42:59', 'no'),
(117, 5, '2020-07-03 06:17:56', 'no'),
(118, 4, '2020-07-03 05:56:45', 'no'),
(119, 4, '2020-07-04 06:25:39', 'no'),
(120, 15, '2020-07-04 04:59:25', 'no'),
(121, 5, '2020-07-04 22:10:31', 'no'),
(122, 4, '2020-07-05 00:03:30', 'no'),
(123, 15, '2020-07-04 22:11:08', 'no'),
(124, 5, '2020-07-05 00:03:32', 'no'),
(125, 4, '2020-07-05 07:13:18', 'no'),
(126, 4, '2020-07-05 07:35:01', 'no'),
(127, 4, '2020-07-06 07:06:06', 'no'),
(128, 4, '2020-07-06 07:18:57', 'no'),
(129, 15, '2020-07-06 07:29:43', 'no'),
(130, 4, '2020-07-06 07:30:03', 'no'),
(131, 4, '2020-07-06 14:14:21', 'no'),
(132, 4, '2020-07-09 14:42:02', 'no'),
(133, 4, '2020-07-11 07:32:26', 'no'),
(134, 16, '2020-07-09 15:08:37', 'no'),
(135, 4, '2020-07-09 15:59:35', 'no'),
(136, 4, '2020-07-09 16:02:04', 'no'),
(137, 5, '2020-07-11 07:21:30', 'no'),
(138, 4, '2020-07-11 10:39:44', 'no'),
(139, 4, '2020-07-15 20:37:21', 'no'),
(140, 15, '2020-07-15 20:37:11', 'no'),
(141, 4, '2020-07-16 19:12:37', 'no'),
(142, 4, '2020-07-17 04:44:44', 'no'),
(143, 4, '2020-07-17 05:27:26', 'no'),
(144, 4, '2020-07-17 05:40:11', 'no'),
(145, 4, '2020-07-17 05:53:38', 'no'),
(146, 4, '2020-07-17 05:55:20', 'no'),
(147, 4, '2020-07-17 11:10:15', 'no'),
(148, 4, '2020-07-18 18:52:18', 'no'),
(149, 4, '2020-07-20 20:01:00', 'no'),
(150, 4, '2020-07-21 22:26:42', 'no'),
(151, 4, '2020-07-24 04:43:14', 'no'),
(152, 4, '2020-07-24 04:20:15', 'no'),
(153, 4, '2020-07-24 04:55:40', 'no'),
(154, 4, '2020-07-24 05:00:24', 'no'),
(155, 4, '2020-07-24 15:54:40', 'no'),
(156, 17, '2020-07-24 19:42:38', 'no'),
(157, 18, '2020-07-24 19:51:19', 'no'),
(158, 19, '2020-07-24 19:56:15', 'no'),
(159, 4, '2020-07-24 20:50:59', 'no'),
(160, 4, '2020-07-24 22:40:57', 'no'),
(161, 4, '2020-07-24 23:09:19', 'no'),
(162, 15, '2020-07-25 21:08:51', 'no'),
(163, 15, '2020-07-25 21:16:44', 'no'),
(164, 4, '2020-07-25 22:15:55', 'no'),
(165, 15, '2020-07-25 22:16:47', 'no'),
(166, 4, '2020-07-26 13:05:14', 'no'),
(167, 4, '2020-07-26 13:10:03', 'no'),
(168, 4, '2020-07-26 13:10:47', 'no'),
(169, 4, '2020-07-26 13:19:37', 'no'),
(170, 4, '2020-07-26 13:47:42', 'no'),
(171, 16, '2020-07-26 14:52:13', 'no'),
(172, 17, '2020-07-26 14:55:58', 'no'),
(173, 4, '2020-07-26 14:59:19', 'no'),
(174, 4, '2020-07-26 15:10:19', 'no'),
(175, 4, '2020-07-26 19:15:14', 'no'),
(176, 4, '2020-07-29 20:22:57', 'no'),
(177, 5, '2020-07-26 19:19:57', 'no'),
(178, 19, '2020-07-26 19:22:16', 'no'),
(179, 18, '2020-07-26 19:28:44', 'no'),
(180, 4, '2020-07-26 19:37:49', 'no'),
(181, 4, '2020-07-26 22:35:28', 'no'),
(182, 4, '2020-07-28 06:08:36', 'no'),
(183, 4, '2020-07-31 14:47:54', 'no'),
(184, 4, '2020-07-28 21:05:22', 'no'),
(185, 4, '2020-07-31 14:58:43', 'no'),
(186, 4, '2020-07-31 15:33:39', 'no'),
(187, 4, '2020-07-31 15:37:17', 'no'),
(188, 4, '2020-07-31 15:52:02', 'no'),
(189, 4, '2020-07-31 16:13:58', 'no'),
(190, 4, '2020-07-31 20:43:55', 'no'),
(191, 4, '2020-07-31 20:56:10', 'no'),
(192, 4, '2020-07-31 22:09:13', 'no'),
(193, 4, '2020-08-01 15:21:29', 'no'),
(194, 4, '2020-08-02 13:12:08', 'no'),
(195, 4, '2020-08-02 20:53:38', 'no'),
(196, 4, '2020-08-04 08:35:52', 'no'),
(197, 3, '2020-08-04 09:21:03', 'no'),
(198, 4, '2020-08-04 09:26:02', 'no'),
(199, 1, '2020-08-04 09:31:50', 'no'),
(200, 4, '2020-08-04 19:32:45', 'no'),
(201, 3, '2020-08-04 19:33:08', 'no'),
(202, 20, '2020-08-05 13:41:17', 'no'),
(203, 21, '2020-08-05 13:53:58', 'no'),
(204, 22, '2020-08-05 13:55:25', 'no'),
(205, 4, '2020-08-05 13:55:55', 'no'),
(206, 22, '2020-08-05 14:39:02', 'no'),
(207, 21, '2020-08-05 14:39:45', 'no'),
(208, 21, '2020-08-05 14:39:58', 'no'),
(209, 21, '2020-08-05 14:43:41', 'no'),
(210, 20, '2020-08-05 14:45:40', 'no'),
(211, 4, '2020-08-05 14:48:46', 'no'),
(212, 4, '2020-08-05 14:49:36', 'no'),
(213, 22, '2020-08-05 14:50:46', 'no'),
(214, 4, '2020-08-05 14:52:53', 'no'),
(215, 20, '2020-08-05 15:03:06', 'no'),
(216, 4, '2020-08-05 15:04:33', 'no'),
(217, 1, '2020-08-05 15:05:49', 'no'),
(218, 4, '2020-08-05 19:06:51', 'no'),
(219, 3, '2020-08-05 19:22:12', 'no'),
(220, 4, '2020-08-05 19:23:29', 'no'),
(221, 1, '2020-08-05 19:24:11', 'no'),
(222, 4, '2020-08-05 19:24:48', 'no'),
(223, 22, '2020-08-05 19:40:01', 'no'),
(224, 4, '2020-08-05 19:43:38', 'no'),
(225, 22, '2020-08-05 19:46:07', 'no'),
(226, 3, '2020-08-05 19:46:51', 'no'),
(227, 4, '2020-08-05 20:06:31', 'no'),
(228, 3, '2020-08-05 20:07:09', 'no'),
(229, 4, '2020-08-05 20:55:16', 'no'),
(230, 1, '2020-08-05 21:05:14', 'no'),
(231, 4, '2020-08-05 21:14:24', 'no'),
(232, 4, '2020-08-07 21:40:30', 'no'),
(233, 4, '2020-08-07 10:54:17', 'no'),
(234, 21, '2020-08-07 20:25:32', 'no'),
(235, 1, '2020-08-07 21:40:31', 'no'),
(236, 3, '2020-08-08 19:55:50', 'no'),
(237, 4, '2020-08-14 13:12:51', 'no'),
(238, 4, '2020-08-14 15:20:33', 'no'),
(239, 4, '2020-08-15 19:47:10', 'no'),
(240, 4, '2020-08-19 21:01:59', 'no'),
(241, 3, '2020-08-19 21:23:26', 'no'),
(242, 4, '2020-08-20 13:31:37', 'no'),
(243, 3, '2020-08-20 15:34:47', 'no'),
(244, 4, '2020-08-20 16:12:30', 'no'),
(245, 4, '2020-08-21 13:46:26', 'no'),
(246, 4, '2020-08-21 13:53:18', 'no'),
(247, 3, '2020-08-22 07:21:14', 'no'),
(248, 4, '2020-08-22 07:29:52', 'no'),
(249, 4, '2020-08-22 21:15:48', 'no'),
(250, 3, '2020-08-22 21:45:19', 'no'),
(251, 4, '2020-08-25 11:35:16', 'no'),
(252, 3, '2020-08-25 12:19:47', 'no'),
(253, 23, '2020-08-25 19:28:52', 'no'),
(254, 3, '2020-08-25 19:29:20', 'no'),
(255, 23, '2020-08-25 19:30:57', 'no'),
(256, 3, '2020-08-26 08:44:51', 'no'),
(257, 1, '2020-08-26 09:36:54', 'no'),
(258, 2, '2020-08-26 09:39:20', 'no'),
(259, 2, '2020-08-26 09:44:24', 'no'),
(260, 2, '2020-08-26 20:18:11', 'no'),
(261, 1, '2020-08-26 20:47:18', 'no'),
(262, 2, '2020-08-26 21:27:38', 'no'),
(263, 1, '2020-08-27 19:24:17', 'no'),
(264, 1, '2020-08-28 11:07:33', 'no'),
(265, 1, '2020-08-28 11:08:21', 'no'),
(266, 1, '2020-08-31 04:12:32', 'no'),
(267, 2, '2020-08-31 04:21:46', 'no'),
(268, 1, '2020-08-31 05:52:28', 'no'),
(269, 1, '2020-09-01 12:32:22', 'no'),
(270, 2, '2020-09-01 13:15:08', 'no'),
(271, 2, '2020-09-01 13:33:26', 'no'),
(272, 1, '2020-09-23 21:20:30', 'no'),
(273, 1, '2020-09-24 07:51:00', 'no'),
(274, 2, '2020-09-24 08:24:51', 'no'),
(275, 1, '2020-09-24 10:48:39', 'no'),
(276, 2, '2020-09-24 10:49:56', 'no'),
(277, 1, '2020-09-24 19:09:00', 'no'),
(278, 2, '2020-09-24 19:21:53', 'no'),
(279, 2, '2020-09-25 16:42:07', 'no'),
(280, 1, '2020-09-25 11:16:55', 'no'),
(281, 1, '2020-09-28 14:16:51', 'no'),
(282, 1, '2020-09-26 08:32:22', 'no'),
(283, 2, '2020-09-28 13:08:57', 'no'),
(284, 2, '2020-09-28 13:49:06', 'no'),
(285, 2, '2020-09-28 14:26:11', 'no'),
(286, 1, '2020-09-28 14:26:24', 'no'),
(287, 2, '2020-09-28 14:27:45', 'no'),
(288, 2, '2020-09-28 14:28:12', 'no'),
(289, 1, '2020-09-28 14:28:41', 'no'),
(290, 1, '2020-09-28 14:30:03', 'no'),
(291, 2, '2020-09-28 14:30:50', 'no'),
(292, 2, '2020-09-28 14:32:15', 'no'),
(293, 2, '2020-09-29 07:30:31', 'no'),
(294, 2, '2020-09-29 07:31:22', 'no'),
(295, 2, '2020-09-29 07:46:38', 'no'),
(296, 3, '2020-09-29 08:04:22', 'no'),
(297, 4, '2020-09-29 08:29:16', 'no'),
(298, 1, '2020-09-29 08:39:49', 'no');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `name` varchar(20) NOT NULL,
  `msg` text NOT NULL,
  `posted` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`name`, `msg`, `posted`) VALUES
('supreme', 'bonsoir', '2020-05-27 13:24:49'),
('daurian', 'bonsoir', '2020-05-27 13:25:02'),
('ferol', 'bonsoir Ã  vous  deux', '2020-05-27 13:50:00'),
('emavy', 'Ã§a va', '2020-05-27 21:17:22'),
('emavy', 'bonsoir', '2020-05-28 14:02:53'),
('supreme', 'bonsoir', '2020-05-27 13:24:49'),
('daurian', 'bonsoir', '2020-05-27 13:25:02'),
('ferol', 'bonsoir Ã  vous  deux', '2020-05-27 13:50:00'),
('emavy', 'Ã§a va', '2020-05-27 21:17:22'),
('emavy', 'bonsoir', '2020-05-28 14:02:53'),
('supreme', 'bonsoir', '2020-05-27 13:24:49'),
('daurian', 'bonsoir', '2020-05-27 13:25:02'),
('ferol', 'bonsoir Ã  vous  deux', '2020-05-27 13:50:00'),
('emavy', 'Ã§a va', '2020-05-27 21:17:22'),
('emavy', 'bonsoir', '2020-05-28 14:02:53');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `statut` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id`, `nom`, `message`, `statut`, `date`) VALUES
(4, 'servet', 'message de servet', 'unread', '2020-05-28 00:00:00'),
(5, 'daurian', 'message', 'unread', '2020-05-28 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `categorie_produit` varchar(255) NOT NULL,
  `titre_produit` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `prix_produit` int(11) NOT NULL,
  `description_produit` text NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `utilisation` text NOT NULL,
  `composition` text NOT NULL,
  `client` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`id`, `id_produit`, `categorie`, `categorie_produit`, `titre_produit`, `image`, `prix_produit`, `description_produit`, `email_user`, `stock`, `utilisation`, `composition`, `client`, `quantite`) VALUES
(1, 1, 'AUTRES', 'ALLERGIE', 'COVID19', '4_44.jpg', 305, 'produit dÃ©couvert au madagascar pour traiter la pandÃ©mie du covid19', 'charles@gmail.com', 6, '', '', 16, 4),
(35, 6, 'HOMME', 'AUDIO', 'LOPRADE', 'ANGEL_~1.JPG', 100, 'diarrhÃ©e', 'charles@gmail.com', 31, '', '', 4, 2),
(36, 10, 'FEMME', 'DETOX ET VITALITE', 'COARTEM', 'FB_IMG_15555196301882874.jpg', 100, 'boisson sans degres', 'charles@gmail.com', 55, 'comme tu veux', 'loungouila', 3, 2),
(38, 10, 'FEMME', 'DETOX ET VITALITE', 'COARTEM', 'FB_IMG_15555196301882874.jpg', 100, 'boisson sans degres', 'charles@gmail.com', 55, 'comme tu veux', 'loungouila', 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `partage_pub_reseau`
--

CREATE TABLE `partage_pub_reseau` (
  `Abonne_idAbonne` int(11) NOT NULL,
  `Publication_idPublication` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `idPays` int(11) NOT NULL,
  `Nom_pays` varchar(45) NOT NULL DEFAULT 'France'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pharmacie`
--

CREATE TABLE `pharmacie` (
  `id_pharmacie` int(11) NOT NULL,
  `nom_pharmacie` varchar(255) NOT NULL,
  `ville_pharmacie` varchar(255) NOT NULL,
  `mail_pharmacie` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pharmacie`
--

INSERT INTO `pharmacie` (`id_pharmacie`, `nom_pharmacie`, `ville_pharmacie`, `mail_pharmacie`) VALUES
(1, 'EURL PHARMACIE GERAULT', 'HAMBYE', 'arthur@gmail.com'),
(2, 'PHARMACIE ALLAIN', 'BREHAL', 'kana@gmail.com'),
(3, 'PHARMACIE ANDRY', 'SAINT LO', NULL),
(4, 'PHARMACIE ANTOINE-COUDRIN-BOYER', 'SAINT PAIR SUR MER', NULL),
(6, 'PHARMACIE BEDEL', 'JUVIGNY LE TERTRE', NULL),
(7, 'PHARMACIE BENOIS', 'GRANVILLE', NULL),
(8, 'PHARMACIE BERNARD-BRIGNOT', 'MARIGNY', NULL),
(9, 'PHARMACIE BINET', 'GER', NULL),
(10, 'PHARMACIE BLANDAMOUR', 'MORTAIN', NULL),
(11, 'PHARMACIE BLEMUS', 'QUERQUEVILLE', NULL),
(12, 'PHARMACIE BONNIN', 'PERCY', NULL),
(13, 'PHARMACIE BOUILLON', 'SAINT JEAN DES BAISANTS', NULL),
(14, 'PHARMACIE BOULOGNE', 'MARCEY LES GREVES', NULL),
(15, 'PHARMACIE BOULOT-PIGAILLEM', 'GRANVILLE', NULL),
(16, 'EURL PHARMACIE GERAULT', 'HAMBYE', NULL),
(20, 'PHARMACIE AUZOU', 'EQUEURDREVILLE HAINNEVILL', NULL),
(31, 'PHARMACIE BOURGEON', 'CHERBOURG OCTEVILLE', NULL),
(32, 'PHARMACIE BOZIER-SOUTY', 'SAINT JAMES', NULL),
(33, 'PHARMACIE BREINS-MARIE', 'GOUVILLE SUR MER', NULL),
(34, 'PHARMACIE BRIEUC-LECLERE', 'HEBECREVON', NULL),
(35, 'PHARMACIE BRISSET', 'FLAMANVILLE', NULL),
(36, 'PHARMACIE BUIN-RENOUF', 'EQUEURDREVILLE HAINNEVILL', NULL),
(37, 'PHARMACIE CAHAN', 'LES PIEUX', NULL),
(38, 'PHARMACIE CHAIB', 'ISIGNY LE BUAT', NULL),
(39, 'PHARMACIE CHEVALIER & AUVRAY', 'SAINT LO', NULL),
(40, 'PHARMACIE CORBIN GENDRIN', 'LA HAYE PESNEL', NULL),
(41, 'PHARMACIE CORVEZ', 'TOURLAVILLE', NULL),
(42, 'PHARMACIE COUBRUN-KUSZTOS', 'PONT-HEBERT', NULL),
(43, 'PHARMACIE COUETOUX DU TERTRE', 'LESSAY', NULL),
(44, 'PHARMACIE DE CERISY LA FORET', 'CERISY LA FORET', NULL),
(45, 'PHARMACIE DE CREANCES', 'CREANCES', NULL),
(46, 'PHARMACIE DE JULLOUVILLE', 'JULLOUVILLE', NULL),
(47, 'PHARMACIE DE LA DOUVE', 'PICAUVILLE', NULL),
(48, 'PHARMACIE DE LA SEE', 'BRECEY', NULL),
(49, 'PHARMACIE DE L\'AURORE', 'SAINT LO', NULL),
(50, 'PHARMACIE DE PONT-MARAIS', 'TOURLAVILLE', NULL),
(51, 'PHARMACIE DE SAINT-FROMOND', 'SAINT-FROMOND', NULL),
(52, 'PHARMACIE DELARUE-MITTAUX', 'TESSY SUR VIRE', NULL),
(53, 'PHARMACIE DELAUNOY', 'CHERBOURG OCTVEILLE', NULL),
(54, 'PHARMACIE DEMULDER-LEROUVILLOIS', 'TOURLAVILLE', NULL),
(55, 'PHARMACIE DES MANUSCRITS', 'AVRANCHES', NULL),
(56, 'PHARMACIE DESERT', 'SAINT SAMSON DE BONFOSSE', NULL),
(57, 'PHARMACIE DESQUESNES', 'CHERBOURG OCTEVILLE', NULL),
(58, 'PHARMACIE DORNER-CHER', 'SAINT HILAIRE DU HARCOUET', NULL),
(59, 'PHARMACIE DU CHATEAU', 'TORIGNI SUR VIRE', NULL),
(60, 'PHARMACIE DU DONJON ', 'BRICQUEBEC', NULL),
(61, 'PHARMACIE BOURGEON', 'CHERBOURG OCTEVILLE', NULL),
(62, 'PHARMACIE BOZIER-SOUTY', 'SAINT JAMES', NULL),
(63, 'PHARMACIE BREINS-MARIE', 'GOUVILLE SUR MER', NULL),
(64, 'PHARMACIE BRIEUC-LECLERE', 'HEBECREVON', NULL),
(65, 'PHARMACIE BRISSET', 'FLAMANVILLE', NULL),
(66, 'PHARMACIE BUIN-RENOUF', 'EQUEURDREVILLE HAINNEVILL', NULL),
(67, 'PHARMACIE CAHAN', 'LES PIEUX', NULL),
(68, 'PHARMACIE CHAIB', 'ISIGNY LE BUAT', NULL),
(69, 'PHARMACIE CHEVALIER & AUVRAY', 'SAINT LO', NULL),
(70, 'PHARMACIE CORBIN GENDRIN', 'LA HAYE PESNEL', NULL),
(71, 'PHARMACIE CORVEZ', 'TOURLAVILLE', NULL),
(72, 'PHARMACIE COUBRUN-KUSZTOS', 'PONT-HEBERT', NULL),
(73, 'PHARMACIE COUETOUX DU TERTRE', 'LESSAY', NULL),
(74, 'PHARMACIE DE CERISY LA FORET', 'CERISY LA FORET', NULL),
(75, 'PHARMACIE DE CREANCES', 'CREANCES', NULL),
(76, 'PHARMACIE DE JULLOUVILLE', 'JULLOUVILLE', NULL),
(77, 'PHARMACIE DE LA DOUVE', 'PICAUVILLE', NULL),
(78, 'PHARMACIE DE LA SEE', 'BRECEY', NULL),
(79, 'PHARMACIE DE L\'AURORE', 'SAINT LO', NULL),
(80, 'PHARMACIE DE PONT-MARAIS', 'TOURLAVILLE', NULL),
(81, 'PHARMACIE DE SAINT-FROMOND', 'SAINT-FROMOND', NULL),
(82, 'PHARMACIE DELARUE-MITTAUX', 'TESSY SUR VIRE', NULL),
(83, 'PHARMACIE DELAUNOY', 'CHERBOURG OCTVEILLE', NULL),
(84, 'PHARMACIE DEMULDER-LEROUVILLOIS', 'TOURLAVILLE', NULL),
(85, 'PHARMACIE DES MANUSCRITS', 'AVRANCHES', NULL),
(86, 'PHARMACIE DESERT', 'SAINT SAMSON DE BONFOSSE', NULL),
(87, 'PHARMACIE DESQUESNES', 'CHERBOURG OCTEVILLE', NULL),
(88, 'PHARMACIE DORNER-CHER', 'SAINT HILAIRE DU HARCOUET', NULL),
(89, 'PHARMACIE DU CHATEAU', 'TORIGNI SUR VIRE', NULL),
(90, 'PHARMACIE DU DONJON ', 'BRICQUEBEC', NULL),
(91, 'PHARMACIE DU HAVRE', 'PORTBAIL', NULL),
(92, 'PHARMACIE DU LITTRE', 'AVRANCHES', NULL),
(93, 'PHARMACIE DU MARAIS', 'CARENTAN', NULL),
(94, 'PHARMACIE DU VAUPREUX', 'QUETTEHOU', NULL),
(95, 'PHARMACIE DUJARDIN', 'PERIERS', NULL),
(96, 'PHARMACIE DUPAS-LEPETIT', 'CHERBPOURG OCTEVILLE', NULL),
(97, 'PHARMACIE DUVAL ET LAPEYRE', 'DUCEY', NULL),
(98, 'PHARMACIE ESNOL', 'MARTINVAST', NULL),
(99, 'PHARMACIE FABRE-POISSON', 'GRANVILLE', NULL),
(100, 'PHARMACIE FICHET HELAINE', 'COUTANCES', NULL),
(101, 'PHARMACIE FILLAUT-LEDUC', 'PONTORSON', NULL),
(102, 'PHARMACIE FIQUET', 'TOURLAVILLE', NULL),
(103, 'PHARMACIE GAMAS', 'CARENTAN', NULL),
(104, 'PHARMACIE GOFFIN', 'CHERBOURG OCTEVILLE', NULL),
(105, 'PHARMACIE GROSHAENY', 'LA GLACERIE', NULL),
(106, 'PHARMACIE GUERARD', 'EQUEURDREVILLE HAINNEVILL', NULL),
(107, 'PHARMACIE GUERARD LE FRANCOIS', 'BRIX', NULL),
(108, 'PHARMACIE GUILLEMET-LAMOUREUX', 'VILLEDIEU LES POELES', NULL),
(109, 'PHARMACIE HAMEAU', 'REMILLY SUR LOZON', NULL),
(110, 'PHARMACIE HAMEL', 'CHERBOURG OCTEVILLE', NULL),
(111, 'PHARMACIE HARDEL', 'VILLEDIEU LES POELES', NULL),
(112, 'PHARMACIE HARDY-MARTIN', 'SAINT JEAN DE DAYE', NULL),
(113, 'PHARMACIE HAUTEMANIERE FRANCOIS', 'VALOGNES', NULL),
(114, 'PHARMACIE HOLAT ALAIN', 'SAINTENY', NULL),
(115, 'PHARMACIE HOORNAERT-MONMARSON', 'CHERBOURG OCTEVILLE', NULL),
(116, 'PHARMACIE HOUYVET', 'SAINT PIERRE EGLISE', NULL),
(117, 'PHARMACIE JOANNON-JAUNET', 'GRANVILLE', NULL),
(118, 'PHARMACIE KARAM-CHAUVIN', 'PARIGNY', NULL),
(119, 'PHARMACIE LAMARCHE', 'CERISY LA SALLE', NULL),
(120, 'PHARMACIE LANGENAIS', 'SAINT MARTIN DES CHAMPS', NULL),
(121, 'PHARMACIE DU HAVRE', 'PORTBAIL', NULL),
(122, 'PHARMACIE DU LITTRE', 'AVRANCHES', NULL),
(123, 'PHARMACIE DU MARAIS', 'CARENTAN', NULL),
(124, 'PHARMACIE DU VAUPREUX', 'QUETTEHOU', NULL),
(125, 'PHARMACIE DUJARDIN', 'PERIERS', NULL),
(126, 'PHARMACIE DUPAS-LEPETIT', 'CHERBPOURG OCTEVILLE', NULL),
(127, 'PHARMACIE DUVAL ET LAPEYRE', 'DUCEY', NULL),
(128, 'PHARMACIE ESNOL', 'MARTINVAST', NULL),
(129, 'PHARMACIE FABRE-POISSON', 'GRANVILLE', NULL),
(130, 'PHARMACIE FICHET HELAINE', 'COUTANCES', NULL),
(131, 'PHARMACIE FILLAUT-LEDUC', 'PONTORSON', NULL),
(132, 'PHARMACIE FIQUET', 'TOURLAVILLE', NULL),
(133, 'PHARMACIE GAMAS', 'CARENTAN', NULL),
(134, 'PHARMACIE GOFFIN', 'CHERBOURG OCTEVILLE', NULL),
(135, 'PHARMACIE GROSHAENY', 'LA GLACERIE', NULL),
(136, 'PHARMACIE GUERARD', 'EQUEURDREVILLE HAINNEVILL', NULL),
(137, 'PHARMACIE GUERARD LE FRANCOIS', 'BRIX', NULL),
(138, 'PHARMACIE GUILLEMET-LAMOUREUX', 'VILLEDIEU LES POELES', NULL),
(139, 'PHARMACIE HAMEAU', 'REMILLY SUR LOZON', NULL),
(140, 'PHARMACIE HAMEL', 'CHERBOURG OCTEVILLE', NULL),
(141, 'PHARMACIE HARDEL', 'VILLEDIEU LES POELES', NULL),
(142, 'PHARMACIE HARDY-MARTIN', 'SAINT JEAN DE DAYE', NULL),
(143, 'PHARMACIE HAUTEMANIERE FRANCOIS', 'VALOGNES', NULL),
(144, 'PHARMACIE HOLAT ALAIN', 'SAINTENY', NULL),
(145, 'PHARMACIE HOORNAERT-MONMARSON', 'CHERBOURG OCTEVILLE', NULL),
(146, 'PHARMACIE HOUYVET', 'SAINT PIERRE EGLISE', NULL),
(147, 'PHARMACIE JOANNON-JAUNET', 'GRANVILLE', NULL),
(148, 'PHARMACIE KARAM-CHAUVIN', 'PARIGNY', NULL),
(149, 'PHARMACIE LAMARCHE', 'CERISY LA SALLE', NULL),
(150, 'PHARMACIE LANGENAIS', 'SAINT MARTIN DES CHAMPS', NULL),
(151, 'PHARMACIE LAPORTE', 'SAINT LO', NULL),
(152, 'PHARMACIE LAUNAY-MAROLLE', 'TOURLAVILLE', NULL),
(153, 'PHARMACIE LE BAS BONVOISIN LE BOLZ', 'AGNEAUX', NULL),
(154, 'PHARMACIE LE BRIS-GOUDAL', 'VALOGNES', NULL),
(155, 'PHARMACIE LE GARCON', 'MONTMARTIN SUR MER', NULL),
(156, 'PHARMACIE LE HAGUE DIKE', 'BEAUMONT HAGUE CEDEX', NULL),
(157, 'PHARMACIE LE POULTIER', 'SAINT MARTIN DE LANDELLES', NULL),
(158, 'PHARMACIE LE SAINT', 'GRANVILLE', NULL),
(159, 'PHARMACIE LEBRET', 'BARENTON', NULL),
(160, 'PHARMACIE LECONTE ', 'SAINT SAUVEUR LENDELIN', NULL),
(161, 'PHARMACIE LEDUNOIS', 'SAINT LO', NULL),
(162, 'PHARMACIE LEFRANC', 'QUETTREVILLE SUR SIENNE', NULL),
(163, 'PHARMACIE LEGENDRE', 'BARFLEUR', NULL),
(164, 'PHARMACIE LEGRAS', 'AVRANCHES', NULL),
(165, 'PHARMACIE LENOIR', 'AVRANCHES', NULL),
(166, 'PHARMACIE LEPAS', 'COUTANCES', NULL),
(167, 'PHARMACIE LEPLATOIS', 'SAINT LO', NULL),
(168, 'PHARMACIE LEPOITTEVIN-BERGEOT', 'EQUEURDREVILLE HAINNEVILL', NULL),
(169, 'PHARMACIE LEPRESLE', 'COUTANCES', NULL),
(170, 'PHARMACIE LEQUENNE', 'CHERBOURG OCTEVILLE', NULL),
(171, 'PHARMACIE LEQUERTIER', 'SAINT PIERRE EGLISE', NULL),
(172, 'PHARMACIE LE ROUGE-DAVID', 'CANISY', NULL),
(173, 'PHARMACIE LEROUX', 'SAINT LO', NULL),
(174, 'PHARMACIE LETAROUILLY', 'VALOGNES', NULL),
(175, 'PHARMACIE LETOURNEUR', 'CERENCES', NULL),
(176, 'PHARMACIE LEVEE', 'EQUEURDREVILLE HAINNEVILL', NULL),
(177, 'PHARMACIE LEVOS', 'QUERQUEVILLE', NULL),
(178, 'PHARMACIE LHONNEUR HERBERT', 'LA HAYE DU PUITS', NULL),
(179, 'PHARMACIE LINGREVILLE', 'LINGREVILLE', NULL),
(180, 'PHARMACIE MAHE', 'COUTANCES', NULL),
(181, 'PHARMACIE LAPORTE', 'SAINT LO', NULL),
(182, 'PHARMACIE LAUNAY-MAROLLE', 'TOURLAVILLE', NULL),
(183, 'PHARMACIE LE BAS BONVOISIN LE BOLZ', 'AGNEAUX', NULL),
(184, 'PHARMACIE LE BRIS-GOUDAL', 'VALOGNES', NULL),
(185, 'PHARMACIE LE GARCON', 'MONTMARTIN SUR MER', NULL),
(186, 'PHARMACIE LE HAGUE DIKE', 'BEAUMONT HAGUE CEDEX', NULL),
(187, 'PHARMACIE LE POULTIER', 'SAINT MARTIN DE LANDELLES', NULL),
(188, 'PHARMACIE LE SAINT', 'GRANVILLE', NULL),
(189, 'PHARMACIE LEBRET', 'BARENTON', NULL),
(190, 'PHARMACIE LECONTE ', 'SAINT SAUVEUR LENDELIN', NULL),
(191, 'PHARMACIE LEDUNOIS', 'SAINT LO', NULL),
(192, 'PHARMACIE LEFRANC', 'QUETTREVILLE SUR SIENNE', NULL),
(193, 'PHARMACIE LEGENDRE', 'BARFLEUR', NULL),
(194, 'PHARMACIE LEGRAS', 'AVRANCHES', NULL),
(195, 'PHARMACIE LENOIR', 'AVRANCHES', NULL),
(196, 'PHARMACIE LEPAS', 'COUTANCES', NULL),
(197, 'PHARMACIE LEPLATOIS', 'SAINT LO', NULL),
(198, 'PHARMACIE LEPOITTEVIN-BERGEOT', 'EQUEURDREVILLE HAINNEVILL', NULL),
(199, 'PHARMACIE LEPRESLE', 'COUTANCES', NULL),
(200, 'PHARMACIE LEQUENNE', 'CHERBOURG OCTEVILLE', NULL),
(201, 'PHARMACIE LEQUERTIER', 'SAINT PIERRE EGLISE', NULL),
(202, 'PHARMACIE LE ROUGE-DAVID', 'CANISY', NULL),
(203, 'PHARMACIE LEROUX', 'SAINT LO', NULL),
(204, 'PHARMACIE LETAROUILLY', 'VALOGNES', NULL),
(205, 'PHARMACIE LETOURNEUR', 'CERENCES', NULL),
(206, 'PHARMACIE LEVEE', 'EQUEURDREVILLE HAINNEVILL', NULL),
(207, 'PHARMACIE LEVOS', 'QUERQUEVILLE', NULL),
(208, 'PHARMACIE LHONNEUR HERBERT', 'LA HAYE DU PUITS', NULL),
(209, 'PHARMACIE LINGREVILLE', 'LINGREVILLE', NULL),
(210, 'PHARMACIE MAHE', 'COUTANCES', NULL),
(211, 'PHARMACIE MARIE', 'EQUEURDREVILLE HAINNEVILL', NULL),
(212, 'PHARMACIE MARIE-AMIOT', 'GRANVILLE', NULL),
(213, 'PHARMACIE MASSIN', 'LE TEILLEUL', NULL),
(214, 'PHARMACIE MATEOS', 'MONTEBOURG', NULL),
(215, 'PHARMACIE MAUGER-RENOUF-GAUMER', 'CONDE SUR VIRE', NULL),
(216, 'PHARMACIE MENUT', 'DUCEY', NULL),
(217, 'PHARMACIE MOINARD', 'SAINT LO', NULL),
(218, 'PHARMACIE NGUYEN', 'SAINT LO', NULL),
(219, 'PHARMACIE NICERON ESCLAPEZ', 'DIGOSVILLE', NULL),
(220, 'PHARMACIE NOYON-GUESDON', 'VIRANDEVILLE', NULL),
(221, 'PHARMACIE OZENNE', 'SAINT HILAIRE DU HARCOUET', NULL),
(222, 'PHARMACIE PALIN', 'CHERBOURG OCTEVILLE', NULL),
(223, 'PHARMACIE PALLIX', 'AGNEAUX', NULL),
(224, 'PHARMACIE PANASSIE', 'CHERBOURG OCTEVILLE', NULL),
(225, 'PHARMACIE PASTEUR', 'CHERBOURG OCTEVILLE', NULL),
(226, 'PHARMACIE PATIN FRANCOIS', 'BREHAL', NULL),
(227, 'PHARMACIE PAYS-LE BIHAN', 'SARTILLY', NULL),
(228, 'PHARMACIE PELLET BARTHELEMY RENOUF', 'SAINT SAUVEUR LE VICOMTE', NULL),
(229, 'PHARMACIE PERCY', 'TORIGNI SUR VIRE', NULL),
(230, 'PHARMACIE PERON', 'CARENTAN', NULL),
(231, 'PHARMACIE PHARM ET PRICE', 'SOURDEVAL', NULL),
(232, 'PHARMACIE PIGNOT PEREZ', 'CHERBOURG OCTEVILLE', NULL),
(233, 'PHARMACIE PITT-THIBOUT', 'CHERBOURG OCTEVILLE', NULL),
(234, 'PHARMACIE PLAIDEUX-LADVENU', 'URVILLE NACQUEVILLE', NULL),
(235, 'PHARMACIE POMME', 'DONVILLE LES BANIS', NULL),
(236, 'PHARMACIE PONT D\'ORSON', 'PONTORSON', NULL),
(237, 'PHARMACIE QUONIAM', 'CHERBOURG OCTEVILLE', NULL),
(238, 'PHARMACIE RAULT', 'CARENTAN', NULL),
(239, 'PHARMACIE RENAN TRIPON', 'EQUEURDREVILLE HAINNEVILL', NULL),
(240, 'PHARMACIE RENET', 'CHERBOURG OCTEVILLE', NULL),
(241, 'PHARMACIE MARIE', 'EQUEURDREVILLE HAINNEVILL', NULL),
(242, 'PHARMACIE MARIE-AMIOT', 'GRANVILLE', NULL),
(243, 'PHARMACIE MASSIN', 'LE TEILLEUL', NULL),
(244, 'PHARMACIE MATEOS', 'MONTEBOURG', NULL),
(245, 'PHARMACIE MAUGER-RENOUF-GAUMER', 'CONDE SUR VIRE', NULL),
(246, 'PHARMACIE MENUT', 'DUCEY', NULL),
(247, 'PHARMACIE MOINARD', 'SAINT LO', NULL),
(248, 'PHARMACIE NGUYEN', 'SAINT LO', NULL),
(249, 'PHARMACIE NICERON ESCLAPEZ', 'DIGOSVILLE', NULL),
(250, 'PHARMACIE NOYON-GUESDON', 'VIRANDEVILLE', NULL),
(251, 'PHARMACIE OZENNE', 'SAINT HILAIRE DU HARCOUET', NULL),
(252, 'PHARMACIE PALIN', 'CHERBOURG OCTEVILLE', NULL),
(253, 'PHARMACIE PALLIX', 'AGNEAUX', NULL),
(254, 'PHARMACIE PANASSIE', 'CHERBOURG OCTEVILLE', NULL),
(255, 'PHARMACIE PASTEUR', 'CHERBOURG OCTEVILLE', NULL),
(256, 'PHARMACIE PATIN FRANCOIS', 'BREHAL', NULL),
(257, 'PHARMACIE PAYS-LE BIHAN', 'SARTILLY', NULL),
(258, 'PHARMACIE PELLET BARTHELEMY RENOUF', 'SAINT SAUVEUR LE VICOMTE', NULL),
(259, 'PHARMACIE PERCY', 'TORIGNI SUR VIRE', NULL),
(260, 'PHARMACIE PERON', 'CARENTAN', NULL),
(261, 'PHARMACIE PHARM ET PRICE', 'SOURDEVAL', NULL),
(262, 'PHARMACIE PIGNOT PEREZ', 'CHERBOURG OCTEVILLE', NULL),
(263, 'PHARMACIE PITT-THIBOUT', 'CHERBOURG OCTEVILLE', NULL),
(264, 'PHARMACIE PLAIDEUX-LADVENU', 'URVILLE NACQUEVILLE', NULL),
(265, 'PHARMACIE POMME', 'DONVILLE LES BANIS', NULL),
(266, 'PHARMACIE PONT D\'ORSON', 'PONTORSON', NULL),
(267, 'PHARMACIE QUONIAM', 'CHERBOURG OCTEVILLE', NULL),
(268, 'PHARMACIE RAULT', 'CARENTAN', NULL),
(269, 'PHARMACIE RENAN TRIPON', 'EQUEURDREVILLE HAINNEVILL', NULL),
(270, 'PHARMACIE RENET', 'CHERBOURG OCTEVILLE', NULL),
(271, '', '', NULL),
(272, 'PHARMACIE RENOUF', 'CHERBOURG OCTEVILLE', NULL),
(273, 'PHARMACIE RIGAULEAU', 'VILLEDIEU LES POELES', NULL),
(274, 'PHARMACIE RIHAOUI', 'SAINTE MERE EGLISE', NULL),
(275, 'PHARMACIE RILLON', 'SAINT VAAST LA HOUGUE', NULL),
(276, 'PHARMACIE ROBBE', 'AGON COUTAINVILLE', NULL),
(277, 'PHARMACIE ROUSSEAU', 'SAINT POIS', NULL),
(278, 'PHARMACIE RUCHE-REPUBLIQUE', 'COUTANCES', NULL),
(279, 'PHARMACIE SAINT LAUD', 'SAINT LO', NULL),
(280, 'PHARMACIE SAUVAGE-GRANIER', 'SAINT JEAN DES CHAMPS', NULL),
(281, 'PHARMACIE SAVARY-RENARD', 'BARNEVILLE CARTERET', NULL),
(282, 'PHARMACIE SEILLIER', 'AGON COUTAINVILLE', NULL),
(283, 'PHARMACIE SIMON', 'LA GLACERIE', NULL),
(284, 'PHARMACIE SONNET', 'PERIERS', NULL),
(285, 'PHARMACIE TACHE CHIABRERO', 'SAINT JAMES', NULL),
(286, 'PHARMACIE TRAVERT', 'TOURNEVILLE', NULL),
(287, 'PHARMACIE VASSELIN', 'TOURLAVILLE', NULL),
(288, 'PHARMACIE VERGNE', 'SAINT CLAIR SUR ELLE', NULL),
(289, 'PHARMACIE VIGOT XENIDIS', 'LA HAYE DU PUITS', NULL),
(290, 'PHARMACIE WALA-CANDON', 'RONCEY', NULL),
(291, 'PHARMACIE WELMANE-RAGAIN', 'GRANVILLE', NULL),
(292, 'SELARL PHARMACIE BOULLOT', 'COUTANCES', NULL),
(293, 'SELARL PHARMACIE DE GAVRAY', 'GAVRAY', NULL),
(294, 'SELARL PHARMACIE DES CAPS', 'LES PIEUX', NULL),
(295, 'SELARL PHARMACIE LEFRANC-LEVEQUE', 'DONVILLE LES BAINS', NULL),
(296, '', '', NULL),
(297, 'PHARMACIE RENOUF', 'CHERBOURG OCTEVILLE', NULL),
(298, 'PHARMACIE RIGAULEAU', 'VILLEDIEU LES POELES', NULL),
(299, 'PHARMACIE RIHAOUI', 'SAINTE MERE EGLISE', NULL),
(300, 'PHARMACIE RILLON', 'SAINT VAAST LA HOUGUE', NULL),
(301, 'PHARMACIE ROBBE', 'AGON COUTAINVILLE', NULL),
(302, 'PHARMACIE ROUSSEAU', 'SAINT POIS', NULL),
(303, 'PHARMACIE RUCHE-REPUBLIQUE', 'COUTANCES', NULL),
(304, 'PHARMACIE SAINT LAUD', 'SAINT LO', NULL),
(305, 'PHARMACIE SAUVAGE-GRANIER', 'SAINT JEAN DES CHAMPS', NULL),
(306, 'PHARMACIE SAVARY-RENARD', 'BARNEVILLE CARTERET', NULL),
(307, 'PHARMACIE SEILLIER', 'AGON COUTAINVILLE', NULL),
(308, 'PHARMACIE SIMON', 'LA GLACERIE', NULL),
(309, 'PHARMACIE SONNET', 'PERIERS', NULL),
(310, 'PHARMACIE TACHE CHIABRERO', 'SAINT JAMES', NULL),
(311, 'PHARMACIE TRAVERT', 'TOURNEVILLE', NULL),
(312, 'PHARMACIE VASSELIN', 'TOURLAVILLE', NULL),
(313, 'PHARMACIE VERGNE', 'SAINT CLAIR SUR ELLE', NULL),
(314, 'PHARMACIE VIGOT XENIDIS', 'LA HAYE DU PUITS', NULL),
(315, 'PHARMACIE WALA-CANDON', 'RONCEY', NULL),
(316, 'PHARMACIE WELMANE-RAGAIN', 'GRANVILLE', NULL),
(317, 'SELARL PHARMACIE BOULLOT', 'COUTANCES', NULL),
(318, 'SELARL PHARMACIE DE GAVRAY', 'GAVRAY', NULL),
(319, 'SELARL PHARMACIE DES CAPS', 'LES PIEUX', NULL),
(320, 'SELARL PHARMACIE LEFRANC-LEVEQUE', 'DONVILLE LES BAINS', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idProduit` int(11) NOT NULL,
  `Nom_Pro` varchar(45) NOT NULL,
  `image_Pro` varchar(200) NOT NULL,
  `Prix_Pro` float NOT NULL,
  `Description_Pro` varchar(200) NOT NULL,
  `Qte_Pro` int(11) NOT NULL,
  `Composition_Pro` varchar(100) DEFAULT NULL,
  `Utilisation_Pro` varchar(100) DEFAULT NULL,
  `idAbonne` int(11) NOT NULL,
  `idCat_Pro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `Nom_Pro`, `image_Pro`, `Prix_Pro`, `Description_Pro`, `Qte_Pro`, `Composition_Pro`, `Utilisation_Pro`, `idAbonne`, `idCat_Pro`) VALUES
(1, 'ARTEFENAC', '0034d3461b6f68741173ab526683f890.jpg', 34, 'pour homme et femmes', 10, 'paracetamol, 300mg piment', 'matin et soir interdit aux femmes enceintes', 2, 2),
(2, 'PARACETAMOL', '7efdcc1f0996f5481f42670ecca2b3fc.jpg', 100, 'pour femme', 7, 'fievre', 'chaque soir', 2, 1),
(3, 'ADVIL', '2a7c9f20dca4f70f0841f690ea89a3ba.jpg', 100, 'hhhhhhhhhh', 12, 'rrrrrrr', 'jjyyykggygygy', 2, 1),
(4, 'ADVIL', '2a7c9f20dca4f70f0841f690ea89a3ba.jpg', 100, 'hhhhhhhhhh', 12, 'rrrrrrr', 'jjyyykggygygy', 2, 1),
(5, 'NIVAQUINE', '20200131_181032.jpg', 100, 'aaaaaaaaaaz', 11, 'ddddddddddd', 'aaaaaaaaaaaaa', 2, 2),
(6, 'AMOXICILINE', '20200131_181126.jpg', 100, 'ssssssssssssssssss', 6, 'zzzzzzzzzzzzz', 'aaaaaaaaaaaaaaaaaa', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `idPublication` int(11) NOT NULL,
  `Titre_Pub` varchar(50) DEFAULT NULL,
  `Description_Pub` text,
  `Image` varchar(200) DEFAULT NULL,
  `Date_Pub` datetime DEFAULT NULL,
  `idAbonne` int(11) DEFAULT NULL,
  `idAbonne2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `publication`
--

INSERT INTO `publication` (`idPublication`, `Titre_Pub`, `Description_Pub`, `Image`, `Date_Pub`, `idAbonne`, `idAbonne2`) VALUES
(37, NULL, 'bonjour', NULL, '2020-09-25 14:40:06', 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `qte`
--

CREATE TABLE `qte` (
  `id` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stock_restant`
--

CREATE TABLE `stock_restant` (
  `id` int(11) NOT NULL,
  `stock_restant` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stock_restant`
--

INSERT INTO `stock_restant` (`id`, `stock_restant`, `id_produit`) VALUES
(8, -3, 2),
(9, -3, 2),
(15, -1, 2),
(14, -1, 2),
(16, -3, 2),
(17, -1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `sujet_discution`
--

CREATE TABLE `sujet_discution` (
  `idSujet` int(11) NOT NULL,
  `idAbonne` int(11) NOT NULL,
  `Titre_Sujet` varchar(100) NOT NULL,
  `Description_Sujet` text NOT NULL,
  `Date_Sujet` datetime DEFAULT NULL,
  `idCat_Sujet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `abonne`
--
ALTER TABLE `abonne`
  ADD PRIMARY KEY (`idAbonne`),
  ADD KEY `fk_Abonne_cat_abonne_idx` (`cat_abonne`);

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id1` (`user_id1`),
  ADD KEY `user_id2` (`user_id2`);

--
-- Index pour la table `cat_abonne`
--
ALTER TABLE `cat_abonne`
  ADD PRIMARY KEY (`idcat_abonne`);

--
-- Index pour la table `cat_pro`
--
ALTER TABLE `cat_pro`
  ADD PRIMARY KEY (`idCat_Pro`),
  ADD KEY `fk_Cat_Pro_Produit1_idx` (`Produit_idProduit`);

--
-- Index pour la table `cat_sujet`
--
ALTER TABLE `cat_sujet`
  ADD PRIMARY KEY (`idCat_Sujet`);

--
-- Index pour la table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Index pour la table `commentaire_forum`
--
ALTER TABLE `commentaire_forum`
  ADD PRIMARY KEY (`idCom_forum`),
  ADD KEY `fk_Sujet_Discution_has_Abonne_Abonne1_idx` (`IdAbonne`),
  ADD KEY `fk_Sujet_Discution_has_Abonne_Sujet_Discution1_idx` (`idSujet`);

--
-- Index pour la table `commentaire_reseau`
--
ALTER TABLE `commentaire_reseau`
  ADD PRIMARY KEY (`idcom`),
  ADD KEY `fk_Abonne_has_Publication_Publication1_idx` (`idPublication`),
  ADD KEY `fk_Abonne_has_Publication_Abonne1_idx` (`idAbonne`);

--
-- Index pour la table `like_pub`
--
ALTER TABLE `like_pub`
  ADD PRIMARY KEY (`idAbonne`,`idPublication`),
  ADD KEY `fk_Abonne_has_Publication1_Publication1_idx` (`idPublication`),
  ADD KEY `fk_Abonne_has_Publication1_Abonne1_idx` (`idAbonne`);

--
-- Index pour la table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partage_pub_reseau`
--
ALTER TABLE `partage_pub_reseau`
  ADD PRIMARY KEY (`Abonne_idAbonne`,`Publication_idPublication`),
  ADD KEY `fk_Abonne_has_Publication2_Publication1_idx` (`Publication_idPublication`),
  ADD KEY `fk_Abonne_has_Publication2_Abonne1_idx` (`Abonne_idAbonne`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`idPays`);

--
-- Index pour la table `pharmacie`
--
ALTER TABLE `pharmacie`
  ADD PRIMARY KEY (`id_pharmacie`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `fk_Produit_Abonne1_idx` (`idAbonne`),
  ADD KEY `fk_idCat_pro` (`idCat_Pro`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`idPublication`),
  ADD KEY `fk_pub` (`idAbonne`),
  ADD KEY `fk_partage` (`idAbonne2`);

--
-- Index pour la table `qte`
--
ALTER TABLE `qte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock_restant`
--
ALTER TABLE `stock_restant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sujet_discution`
--
ALTER TABLE `sujet_discution`
  ADD PRIMARY KEY (`idSujet`),
  ADD KEY `fk_Sujet_Discution_Abonne1_idx` (`idAbonne`),
  ADD KEY `fk_Sujet_Discution_Cat_Sujet1_idx` (`idCat_Sujet`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `abonne`
--
ALTER TABLE `abonne`
  MODIFY `idAbonne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `amis`
--
ALTER TABLE `amis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `cat_abonne`
--
ALTER TABLE `cat_abonne`
  MODIFY `idcat_abonne` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cat_pro`
--
ALTER TABLE `cat_pro`
  MODIFY `idCat_Pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT pour la table `commentaire_forum`
--
ALTER TABLE `commentaire_forum`
  MODIFY `idCom_forum` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `commentaire_reseau`
--
ALTER TABLE `commentaire_reseau`
  MODIFY `idcom` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `idPays` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pharmacie`
--
ALTER TABLE `pharmacie`
  MODIFY `id_pharmacie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `idProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `idPublication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `qte`
--
ALTER TABLE `qte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `stock_restant`
--
ALTER TABLE `stock_restant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `sujet_discution`
--
ALTER TABLE `sujet_discution`
  MODIFY `idSujet` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `abonne`
--
ALTER TABLE `abonne`
  ADD CONSTRAINT `fk_Abonne_cat_abonne` FOREIGN KEY (`cat_abonne`) REFERENCES `cat_abonne` (`idcat_abonne`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `cat_pro`
--
ALTER TABLE `cat_pro`
  ADD CONSTRAINT `fk_Cat_Pro_Produit1` FOREIGN KEY (`Produit_idProduit`) REFERENCES `produit` (`idProduit`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `commentaire_forum`
--
ALTER TABLE `commentaire_forum`
  ADD CONSTRAINT `fk_Sujet_Discution_has_Abonne_Abonne1` FOREIGN KEY (`IdAbonne`) REFERENCES `abonne` (`idAbonne`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaire_reseau`
--
ALTER TABLE `commentaire_reseau`
  ADD CONSTRAINT `fk_Abonne_has_Publication_Abonne1` FOREIGN KEY (`idAbonne`) REFERENCES `abonne` (`idAbonne`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Abonne_has_Publication_Publication1` FOREIGN KEY (`idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `like_pub`
--
ALTER TABLE `like_pub`
  ADD CONSTRAINT `fk_Abonne_has_Publication1_Abonne1` FOREIGN KEY (`idAbonne`) REFERENCES `abonne` (`idAbonne`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Abonne_has_Publication1_Publication1` FOREIGN KEY (`idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `partage_pub_reseau`
--
ALTER TABLE `partage_pub_reseau`
  ADD CONSTRAINT `fk_Abonne_has_Publication2_Abonne1` FOREIGN KEY (`Abonne_idAbonne`) REFERENCES `abonne` (`idAbonne`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Abonne_has_Publication2_Publication1` FOREIGN KEY (`Publication_idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `fk_Produit_Abonne1` FOREIGN KEY (`idAbonne`) REFERENCES `abonne` (`idAbonne`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idCat_pro` FOREIGN KEY (`idCat_Pro`) REFERENCES `cat_pro` (`idCat_Pro`);

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `fk_partage` FOREIGN KEY (`idAbonne2`) REFERENCES `abonne` (`idAbonne`),
  ADD CONSTRAINT `fk_pub` FOREIGN KEY (`idAbonne`) REFERENCES `abonne` (`idAbonne`);

--
-- Contraintes pour la table `sujet_discution`
--
ALTER TABLE `sujet_discution`
  ADD CONSTRAINT `fk_Sujet_Discution_Abonne1` FOREIGN KEY (`idAbonne`) REFERENCES `abonne` (`idAbonne`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Sujet_Discution_Cat_Sujet1` FOREIGN KEY (`idCat_Sujet`) REFERENCES `cat_sujet` (`idCat_Sujet`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
