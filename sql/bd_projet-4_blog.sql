-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 22 mars 2020 à 21:24
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet-4_blog`
--
CREATE DATABASE IF NOT EXISTS `projet-4_blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `projet-4_blog`;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reportcomments`
--

CREATE TABLE IF NOT EXISTS `reportcomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `report` enum('commercial','heurter','enfants') NOT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_id` (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `visiteurs`
--

CREATE TABLE IF NOT EXISTS `visiteurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reportcomments`
--
ALTER TABLE `reportcomments`
  ADD CONSTRAINT `reportcomments_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

-- --------------------------------------------------------

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `creation_date`) VALUES
(39, 'Nemo enim ipsam voluptatem', 'Sed ut perspiciatis unde omnis iste natus error voluptatem accusannitos doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatta vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatue aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur , adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit aui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2020-02-18 13:10:17'),
(40, 'Quis autem vel eum iure', 'Sed ut perspiciatis unde omnis iste natus error voluptatem accusannitos doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatta vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatue aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur , adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit aui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2020-02-18 13:10:39'),
(41, 'Nisi ut aliquid ex ea commodi', 'Sed ut perspiciatis unde omnis iste natus error voluptatem accusannitos doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatta vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatue aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur , adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit aui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2020-02-18 14:36:53'),
(42, 'Vel illum qui dolorem consequatur', 'Sed ut perspiciatis unde omnis iste natus error voluptatem accusannitos doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatta vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatue aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur , adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit aui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2020-02-18 14:39:20'),
(43, 'Esse quam nihil molestiae laboriosam', 'Sed ut perspiciatis unde omnis iste natus error voluptatem accusannitos doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatta vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatue aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur , adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit aui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2020-02-18 14:40:40'),
(44, 'Numquam eius modi tempora incidunt ut labore', '<p>Sed ut perspiciatis unde omnis iste natus error voluptatem accusannitos doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatta vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatue aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur , adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit aui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>', '2020-02-18 14:41:28');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `comment`, `comment_date`, `approved`) VALUES
(1, 39, 'M@teo21', 'Un peu court ce billet !', '2010-03-25 16:49:53', 1),
(2, 39, 'Maxime', 'Oui, ça commence pas très fort ce blog...', '2010-03-25 16:57:16', NULL),
(3, 39, 'MultiKiller', '+1 !', '2010-03-25 17:12:52', NULL),
(4, 40, 'John', 'Preum\'s !', '2010-03-27 18:59:49', NULL),
(5, 40, 'Maxime', 'Excellente analyse de la situation !\r\nIl y arrivera plus tôt qu\'on ne le pense !', '2010-03-27 22:02:13', NULL),
(6, 40, 'romu', 'salut', '2020-01-05 22:48:35', NULL),
(7, 39, 'jean', 'comment vas tu?', '2020-01-06 16:02:16', NULL),
(8, 39, 'romu', 'ça va merci', '2020-01-06 16:06:21', NULL),
(9, 39, 'jean', 'quoi de neuf', '2020-01-06 16:08:10', NULL),
(10, 39, 'jean', 'ça va merci', '2020-01-06 16:24:30', 1),
(11, 40, 'romu', 'Comment ça va tout le monde?', '2020-01-07 21:37:13', 1),
(12, 40, 'romu', 'yo', '2020-01-07 21:56:57', NULL),
(13, 39, 'romu', 'yo', '2020-01-08 21:54:26', 0),
(14, 40, 'romu', 'hey\r\n', '2020-01-09 18:21:08', NULL),
(15, 40, 'romu', 'ahah', '2020-01-09 18:39:08', NULL),
(16, 40, 'romu', 'ca va', '2020-01-13 23:15:59', NULL),
(17, 40, 'romu', 'salut', '2020-01-21 23:50:38', 0),
(18, 39, 'romu', 'salam', '2020-02-02 00:00:00', 0),
(19, 39, 'romu', 'jgfhg', '2020-02-02 23:28:36', 0),
(20, 39, 'zeon', 'htgbngh', '2020-02-02 23:28:45', NULL),
(21, 39, 'zeon', 'htgbngh', '2020-02-02 23:31:07', NULL),
(22, 39, 'zeon', 'salam', '2020-02-02 23:31:24', NULL),
(23, 40, 'zeon', 'ffd', '2020-02-03 17:03:02', NULL),
(24, 39, 'gilbert', 'defefd', '2020-02-03 17:04:29', NULL),
(25, 40, 'gilbert', 'rfef', '2020-02-03 17:06:28', NULL),
(26, 40, 'romu', 'salam', '2020-02-03 17:16:31', NULL),
(27, 40, 'romu', 'salam', '2020-02-03 17:16:36', NULL),
(28, 39, 'romu', 'salut', '2020-02-03 17:16:53', NULL),
(29, 39, 'romu', 'salut', '2020-02-03 17:17:00', 0),
(30, 39, 'romu', 'yo', '2020-02-03 17:22:06', 0),
(31, 39, 'romu', 'yo', '2020-02-03 17:22:09', 0),
(32, 39, 'romu', 'yo', '2020-02-03 17:23:47', 0),
(33, 39, 'gilbert', 'hey', '2020-02-03 17:28:44', 0),
(34, 39, 'gilbert', 'hey', '2020-02-03 17:28:51', NULL),
(35, 39, 'gilbert', 'hey', '2020-02-03 17:38:39', 0),
(36, 39, 'gilbert', 'hey', '2020-02-03 17:40:00', NULL),
(37, 40, 'zeon', 'hey', '2020-02-03 17:40:27', 0),
(38, 40, 'zeon', 'hey', '2020-02-03 17:40:31', NULL),
(39, 40, 'gilbert', 'hv', '2020-02-03 17:41:32', 0),
(40, 40, 'gilbert', 'hv', '2020-02-03 17:41:44', NULL),
(41, 40, 'zeon', 'abcd', '2020-02-03 17:41:57', NULL),
(42, 39, 'yves', 'tryty', '2020-02-03 20:58:44', NULL),
(43, 39, 'yves', 'tryty', '2020-02-03 20:58:47', NULL),
(44, 40, 'yves', 'salut', '2020-02-03 20:59:15', NULL),
(45, 40, 'yves', 'salut', '2020-02-03 20:59:18', NULL),
(46, 39, 'zeon', 'yoyo', '2020-02-03 21:10:15', NULL),
(47, 39, 'zeon', 'yoyo', '2020-02-03 21:10:19', NULL),
(48, 39, 'romu', 'hey hey', '2020-02-03 21:32:04', NULL),
(49, 39, 'romu', 'hey hey', '2020-02-03 21:32:07', NULL),
(50, 39, 'romu', 'hey hey', '2020-02-03 21:32:54', NULL),
(51, 39, 'romu', 'hey hey', '2020-02-03 21:33:16', NULL),
(52, 39, 'gilbert', 'de retour', '2020-02-04 15:06:43', NULL),
(53, 39, 'gilbert', 'de retour', '2020-02-04 15:06:46', 0),
(54, 40, 'gilbert', 'et la aussi', '2020-02-04 15:06:57', 0),
(55, 40, 'gilbert', 'et la aussi', '2020-02-04 15:07:00', 0),
(56, 39, 'romu', 'salut', '2020-02-04 21:35:59', 0),
(57, 39, 'romu', 'salut', '2020-02-04 21:36:04', 0),
(58, 40, 'birame', 'salam', '2020-02-04 22:23:51', 0),
(59, 40, 'romu', 'salut', '2020-02-04 22:26:07', 0),
(60, 40, 'romu', 'salam', '2020-02-04 22:28:20', NULL),
(101, 43, 'gilbert', 'Très bel article.', '2020-02-18 14:49:12', 1),
(102, 44, 'yves', 'Adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', '2020-02-18 15:15:30', 1),
(103, 44, 'charles', 'Sit aspernatue aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem', '2020-02-18 15:17:05', 1),
(104, 44, 'Jean', 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi', '2020-02-18 15:18:19', 1),
(105, 43, 'Christophe', 'Quis autem vel eum iure reprehenderit aui in ea voluptate', '2020-02-18 15:19:10', 1),
(106, 43, 'Cedric', 'A quand le prochain article?', '2020-02-18 15:19:43', 1),
(107, 42, 'Alexandre', 'Ratione voluptatem sequi nesciunt.', '2020-02-18 15:22:32', 1),
(108, 42, 'Claude', 'Dolores eos qui ratione voluptatem sequi nesciunt.', '2020-02-18 15:22:58', 1),
(109, 42, 'Benoît', 'Vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2020-02-18 15:23:33', 1),
(110, 42, 'Michel', 'Sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi', '2020-02-18 15:24:05', 1),
(111, 41, 'Phillipe', 'Eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit aui in ea voluptate velit esse quam nihil molestiae', '2020-02-18 15:25:30', 1),
(112, 41, 'Patrick', 'Eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur , adipisci velit, sed quia non numquam', '2020-02-18 15:26:10', 1),
(113, 41, 'Alain', 'Ut perspiciatis unde omnis iste natus error voluptatem accusannitos doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatta vitae dicta sunt explicabo. Nemo enim ipsam voluptatem', '2020-02-18 15:26:35', 1),
(114, 40, 'Roger', 'Corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit aui in ea voluptate velit esse quam', '2020-02-18 15:27:52', 1),
(115, 40, 'Martin', 'Architecto beatta vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatue aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt', '2020-02-18 15:28:49', 1),
(116, 40, 'Robert', 'Aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid', '2020-02-18 15:29:09', 1),
(117, 40, 'Clément', 'Beatta vitae dicta', '2020-02-18 15:29:41', 1),
(118, 39, 'Léo', 'Sit amet, consectetur , adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex', '2020-02-18 15:30:29', 1),
(119, 39, 'Paul', 'Suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit aui in ea voluptate', '2020-02-18 15:31:27', 1),
(120, 39, 'Rémi', 'Enim ipsam voluptatem quia voluptas sit aspernatue aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur', '2020-02-18 15:31:44', 1),
(121, 39, 'Frédérick', 'Ut enim ad minima', '2020-02-18 15:32:00', 1),
(122, 44, 'James', 'Article génial!!!', '2020-02-18 17:35:29', 1),
(123, 42, 'romain', 'Pas mal, à quand le prochain livre', '2020-02-20 22:00:49', 1),
(124, 40, 'Louis', 'Quis autem vel eum', '2020-02-20 22:01:54', 1),
(139, 44, 'wdaweda', 'sfdsf', '2020-03-19 00:11:26', 0),
(140, 44, 'gilbert', 'rgrbb', '2020-03-19 00:11:36', 0),
(141, 44, 'cd', 'ce', '2020-03-19 00:16:58', 0),
(142, 43, 'asdsad', 'asdsadasd', '2020-03-20 15:16:26', 0),
(143, 43, 'sadsad', 'sdadsadsd', '2020-03-20 15:16:50', 0),
(144, 43, 'xczcxzc', 'zxczxczxc', '2020-03-20 15:19:30', NULL),
(145, 43, 'hnhn', 'nhnhn', '2020-03-20 15:26:06', NULL),
(146, 43, 'hnhgfn', 'nfhn', '2020-03-20 15:30:54', NULL),
(147, 43, 'gbg', 'bgbgb', '2020-03-20 15:36:47', 0),
(148, 43, 'as', 'asda', '2020-03-20 15:54:08', NULL),
(149, 43, 'sfgef', 'gfg', '2020-03-20 15:54:54', NULL),
(150, 44, 'htrgbgr', 'gbgbg', '2020-03-20 16:12:01', NULL),
(151, 43, 'asdsadas', 'asdsadasd', '2020-03-20 16:12:18', NULL),
(152, 44, 'gtreg', 'fbgb', '2020-03-20 16:12:50', NULL),
(153, 43, 'sadsad', 'asdasdasdadsdad', '2020-03-20 16:13:58', 0),
(154, 43, 'asdsad', 'asdsad', '2020-03-20 16:15:13', NULL),
(155, 43, 'asdasd', 'asdasdad', '2020-03-20 16:20:57', NULL),
(156, 43, 'sadsad', 'sdadsadsd', '2020-03-20 16:21:32', NULL),
(157, 44, 'egeerg', 'rfvgefvg', '2020-03-20 22:10:13', 0),
(158, 42, 'tghhgtr', 'gtgtb', '2020-03-21 18:59:26', 1);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `reportcomments`
--

INSERT INTO `reportcomments` (`id`, `comment_id`, `report`) VALUES
(14, 122, 'commercial'),
(15, 113, 'enfants'),
(16, 124, 'heurter');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'romuald', 'romuald');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `visiteurs`
--

INSERT INTO `visiteurs` (`id`, `pseudo`, `age`, `email`) VALUES
(1, 'romuald', 99, 'romuald@gmail.com'),
(2, 'robert', 32, 'robert@free.fr');



COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
