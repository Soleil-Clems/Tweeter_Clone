-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 21, 2024 at 11:33 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tweeter_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_post` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_post`, `user_id`, `comment`) VALUES
(13, 23, 8, 'ok'),
(14, 23, 9, 'coup de com'),
(15, 25, 9, 'ui'),
(16, 23, 9, 'df'),
(17, 26, 9, 'good team guys');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

DROP TABLE IF EXISTS `follow`;
CREATE TABLE IF NOT EXISTS `follow` (
  `user_id` int NOT NULL,
  `follower` text NOT NULL,
  `following` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`user_id`, `follower`, `following`) VALUES
(8, ',9', ''),
(9, '', ',8'),
(10, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `hashtag`
--

DROP TABLE IF EXISTS `hashtag`;
CREATE TABLE IF NOT EXISTS `hashtag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `content` varchar(140) NOT NULL,
  `media` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `media`, `created_at`) VALUES
(23, 8, 'Ngine', '', '2024-06-21 09:28:16'),
(24, 8, 'remix', '', '2024-06-21 09:28:58'),
(25, 8, '', './uploads/8c00e8919688b8548621e20e2f23a466.jpg', '2024-06-21 09:30:54'),
(26, 9, '@Du13 teams', './uploads/40d88f5471ddee869d5f3b87ba05148f.jpg', '2024-06-21 12:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `reaction`
--

DROP TABLE IF EXISTS `reaction`;
CREATE TABLE IF NOT EXISTS `reaction` (
  `user_id` int NOT NULL,
  `id_post` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `reaction`
--

INSERT INTO `reaction` (`user_id`, `id_post`) VALUES
(9, 26),
(9, 25);

-- --------------------------------------------------------

--
-- Table structure for table `retweet`
--

DROP TABLE IF EXISTS `retweet`;
CREATE TABLE IF NOT EXISTS `retweet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `retweeter_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `retweet`
--

INSERT INTO `retweet` (`id`, `post_id`, `user_id`, `retweeter_id`) VALUES
(9, 25, 8, 9),
(10, 24, 8, 9),
(11, 24, 8, 9),
(12, 26, 9, 9),
(13, 26, 9, 9),
(14, 24, 8, 9),
(15, 24, 8, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `psw` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `bio` varchar(140) NOT NULL,
  `city` varchar(50) NOT NULL,
  `profil` varchar(50) NOT NULL,
  `banner` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stay` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `pseudo`, `email`, `psw`, `birthday`, `bio`, `city`, `profil`, `banner`, `created_at`, `stay`) VALUES
(8, 'admin', 'Du13', 'admin@gmail.com', '023e96622ced85ad8715f5b87370cdbb79661ee5', '2000-02-20', '', '', './uploads/c25f4997e955d83e4a94758192fc3ca0.png', './uploads/4ef86f3bbab1d055bf6bcd71beb97af2.png', '2024-06-21 09:19:21', 1),
(9, 'Slayer', 'Duvi32', 'slayer@gmail.com', '023e96622ced85ad8715f5b87370cdbb79661ee5', '2000-02-22', 'Duvi32', '', './uploads/de24d1e3f5a1d4ce8aca9de33151e73d.png', './uploads/291f922138c08386193163a3a21934e8.png', '2024-06-21 11:58:50', 1),
(10, 'One', 'Punch', 'one@gmail.com', '023e96622ced85ad8715f5b87370cdbb79661ee5', '2000-02-22', '', '', './uploads/defaultprofil.png', './uploads/defaultbanner.png', '2024-06-21 23:27:02', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
