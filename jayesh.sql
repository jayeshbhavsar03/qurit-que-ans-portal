-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2023 at 07:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jayesh`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'PHP'),
(2, 'HTML'),
(3, 'CSS'),
(4, 'JAVA'),
(5, 'Cyber Security'),
(6, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `utilisateur_id`, `question_id`) VALUES
(12, 1, 23),
(13, 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `auteur_id` int(11) NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `titre`, `categorie_id`, `auteur_id`, `date_creation`) VALUES
(19, 'what is php?', 1, 2, '2023-02-21 04:48:32'),
(20, 'How to create .java file?', 4, 2, '2023-02-21 04:48:57'),
(22, 'xyz', 3, 2, '2023-02-23 04:32:50'),
(23, 'abcd', 3, 20, '2023-02-23 04:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `repondre`
--

CREATE TABLE `repondre` (
  `utilisateurs_id` int(11) NOT NULL,
  `questions_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `reponse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `repondre`
--

INSERT INTO `repondre` (`utilisateurs_id`, `questions_id`, `date`, `reponse`) VALUES
(1, 22, '2023-03-06 04:04:33', 'xyz'),
(2, 23, '2023-02-23 04:19:06', 'xyz'),
(19, 20, '2023-02-21 03:57:57', 'it is very eazy'),
(19, 22, '2023-02-23 03:33:19', 'xyz'),
(20, 22, '2023-02-23 03:36:11', 'xyz2');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `avatar` varchar(500) NOT NULL,
  `genre` char(1) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `pseudo`, `email`, `mot_de_passe`, `avatar`, `genre`, `date_inscription`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', 'b6bc7b58510319a151d168ba3d5aecb3ac0a9708d06dd930f37fbc89b6cdc697', 'https://www.tenforums.com/geek/gars/images/2/types/thumb_15951118880user.png', 'H', '2023-01-11 20:35:43', 'admin'),
(2, 'user', 'user@gmail.com', 'b6bc7b58510319a151d168ba3d5aecb3ac0a9708d06dd930f37fbc89b6cdc697', 'https://www.tenforums.com/geek/gars/images/2/types/thumb_15951118880user.png', 'H', '2023-02-14 09:56:44', 'membre'),
(19, 'user1', 'user1@gmail.com', 'b6bc7b58510319a151d168ba3d5aecb3ac0a9708d06dd930f37fbc89b6cdc697', 'https://www.tenforums.com/geek/gars/images/2/types/thumb_15951118880user.png', 'M', '2023-02-21 04:50:17', 'membre'),
(20, 'user2', 'user2@gmail.com', 'b6bc7b58510319a151d168ba3d5aecb3ac0a9708d06dd930f37fbc89b6cdc697', 'https://www.tenforums.com/geek/gars/images/2/types/thumb_15951118880user.png', 'M', '2023-02-23 04:35:29', 'membre'),
(21, 'pratiik', 'arakpratik@gmail.com', 'b6bc7b58510319a151d168ba3d5aecb3ac0a9708d06dd930f37fbc89b6cdc697', 'https://www.tenforums.com/geek/gars/images/2/types/thumb_15951118880user.png', 'M', '2023-03-17 04:53:48', 'membre');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `auteur_id` (`auteur_id`);

--
-- Indexes for table `repondre`
--
ALTER TABLE `repondre`
  ADD PRIMARY KEY (`utilisateurs_id`,`questions_id`),
  ADD KEY `questions_id` (`questions_id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `question` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`auteur_id`) REFERENCES `utilisateurs` (`id`);

--
-- Constraints for table `repondre`
--
ALTER TABLE `repondre`
  ADD CONSTRAINT `repondre_ibfk_1` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `repondre_ibfk_2` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
