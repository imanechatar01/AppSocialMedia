-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2025 at 03:48 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `amie`
--

CREATE TABLE `amie` (
  `id` int(11) NOT NULL,
  `id1` int(11) DEFAULT NULL,
  `id2` int(11) DEFAULT NULL,
  `etat` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `amie`
--

INSERT INTO `amie` (`id`, `id1`, `id2`, `etat`) VALUES
(10, 66, 69, 'active'),
(30, 67, 68, 'active'),
(32, 67, 70, 'active'),
(33, 66, 70, 'active'),
(35, 65, 67, 'active'),
(36, 65, 66, 'active'),
(37, 70, 65, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_post` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `commantaire` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `id_post`, `date`, `commantaire`) VALUES
(1, 66, 1, '2025-04-01 22:27:29', 'jjj'),
(2, 66, 1, '2025-04-01 22:27:32', 'jjj'),
(3, 66, 1, '2025-04-01 22:27:33', 'jjj'),
(4, 66, 1, '2025-04-01 22:27:33', 'jjj'),
(5, 66, 1, '2025-04-01 22:27:33', 'jjj'),
(6, 66, 1, '2025-04-01 22:27:34', 'jjj'),
(7, 66, 1, '2025-04-01 22:27:34', 'jjj'),
(8, 66, 1, '2025-04-01 22:27:35', 'jjj'),
(9, 66, 1, '2025-04-01 22:27:36', 'jjj'),
(10, 66, 1, '2025-04-01 22:27:36', 'jjj'),
(11, 66, 1, '2025-04-01 22:27:36', 'jjj'),
(12, 66, 9, '2025-04-01 22:28:59', 'me too'),
(13, 66, 9, '2025-04-01 22:29:11', 'c\'est bizare'),
(14, 66, 9, '2025-04-01 22:30:57', 'me too'),
(15, 66, 5, '2025-04-01 22:54:05', 'hi'),
(16, 65, 10, '2025-04-03 17:16:51', 'bonjour'),
(17, 65, 10, '2025-04-03 17:16:55', 'hi'),
(18, 65, 10, '2025-04-03 17:16:59', 'how are u'),
(19, 65, 10, '2025-04-03 17:17:03', 'good'),
(20, 65, 10, '2025-04-03 17:37:50', 'hhhhhhhhhh'),
(21, 65, 10, '2025-04-03 17:37:57', 'hh'),
(22, 65, 3, '2025-04-03 17:39:27', 'hi'),
(23, 65, 3, '2025-04-03 17:39:33', 'hihow are u'),
(24, 65, 3, '2025-04-03 17:40:45', 'how are u'),
(25, 65, 4, '2025-04-03 17:46:15', 'GOOD');

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE `db_user` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `prenom` varchar(40) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `pasword` varchar(90) DEFAULT NULL,
  `genre` varchar(30) DEFAULT NULL,
  `adress` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_user`
--

INSERT INTO `db_user` (`id`, `nom`, `prenom`, `email`, `date_naissance`, `pasword`, `genre`, `adress`, `photo`, `role`) VALUES
(65, 'user1', 'user1', 'user1@gmail.com', '2004-01-02', '202cb962ac59075b964b07152d234b70', 'M', '', 'p1.jpg', 'etd'),
(66, 'user2', 'user2', 'user2@gmail.com', '2004-01-02', '202cb962ac59075b964b07152d234b70', 'M', '', 'p2.jpg', 'etd'),
(67, 'chatar_2', 'imane', 'chatarimane02@gmail.com', '2000-12-02', 'd41d8cd98f00b204e9800998ecf8427e', 'F', 'kenitra', 'p3.jpg', 'etd'),
(68, 'chatar', 'imane', 'new@gmail.com', '0000-00-00', '202cb962ac59075b964b07152d234b70', 'M', '', 'drinving.jpeg', 'etd'),
(69, 'CHATAR', 'imane', 'user3@gmail.com', '0000-00-00', '202cb962ac59075b964b07152d234b70', 'M', '', 'Download Car steering wheel logo illustration vector for free.jpeg', 'etd'),
(70, 'user4', 'user4', 'user4@gmail.com', '0000-00-00', '202cb962ac59075b964b07152d234b70', 'M', '', '40503928-1d5c-47cc-9e7c-283f2e5da5ff.jpg', 'etd'),
(72, 'diata', 'aylane', 'aylane@gmail.com', '0000-00-00', '202cb962ac59075b964b07152d234b70', 'M', '', 'aylane.jpg', 'etd');

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

CREATE TABLE `invitation` (
  `id` int(11) NOT NULL,
  `idDest` int(11) DEFAULT NULL,
  `idExp` int(11) DEFAULT NULL,
  `dateEnvoi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invitation`
--

INSERT INTO `invitation` (`id`, `idDest`, `idExp`, `dateEnvoi`) VALUES
(19, 65, 67, '2025-03-18'),
(20, 66, 67, '2025-03-19'),
(21, 68, 67, '2025-03-19'),
(22, 67, 68, '2025-03-19'),
(23, 68, 65, '2025-03-19'),
(24, 68, 66, '2025-03-19'),
(25, 65, 66, '2025-03-19'),
(26, 65, 69, '2025-03-19'),
(27, 66, 69, '2025-03-19'),
(28, 69, 67, '2025-03-19'),
(30, 65, 70, '2025-03-19'),
(31, 66, 70, '2025-03-19'),
(32, 67, 66, '2025-03-19'),
(33, 70, 67, '2025-03-19'),
(34, 72, 67, '2025-03-19'),
(35, 72, 70, '2025-03-21'),
(36, 67, 70, '2025-03-21'),
(37, 66, 65, '2025-03-25'),
(38, 69, 65, '2025-03-25'),
(39, 70, 65, '2025-03-25'),
(40, 72, 65, '2025-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(3, 66, 1),
(12, 66, 9),
(15, 69, 10);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `idExp` int(11) DEFAULT NULL,
  `idDest` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `dateEnvoi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `idExp`, `idDest`, `message`, `dateEnvoi`) VALUES
(1, 67, 68, 'holla', '0000-00-00 00:00:00'),
(2, 67, 68, 'cava ??', '0000-00-00 00:00:00'),
(3, 67, 68, 'salam', '2025-03-19 00:00:00'),
(4, 67, 70, 'Bonjour', '2025-03-20 00:08:39'),
(5, 67, 68, 'hi', '2025-03-20 16:48:52'),
(10, 67, 68, 'labas ?!!', '2025-03-21 02:25:38'),
(11, 70, 67, 'hi', '2025-03-21 02:34:17'),
(12, 70, 67, 'hiv ', '2025-03-21 02:48:43'),
(13, 70, 67, 'd', '2025-03-21 02:48:47'),
(14, 70, 67, 'salam', '2025-03-21 02:51:13'),
(15, 70, 67, 'hii', '2025-03-21 03:34:49'),
(16, 70, 67, 'test', '2025-03-21 03:37:00'),
(17, 67, 70, 'test from edge', '2025-03-21 03:39:56'),
(18, 70, 67, 'repon de test', '2025-03-21 03:40:27'),
(19, 67, 70, 'reponse 2', '2025-03-21 03:42:48'),
(20, 70, 67, 'reponse 3', '2025-03-21 03:43:14'),
(21, 67, 66, 'hi', '2025-03-21 14:54:59'),
(22, 67, 68, 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '2025-03-21 15:14:59'),
(23, 67, 68, 'hi ', '2025-03-22 02:38:10'),
(24, 67, 70, 'salam', '2025-03-22 02:40:11'),
(25, 67, 68, 'g', '2025-03-22 02:59:27'),
(26, 67, 68, 'i\r\n', '2025-03-22 02:59:33'),
(27, 67, 65, 'hi', '2025-03-22 03:01:34'),
(28, 67, 68, 's', '2025-03-22 03:05:32'),
(29, 66, 69, 'bonjour!', '2025-03-25 10:16:18'),
(30, 66, 65, 'hello', '2025-03-25 10:16:37'),
(31, 65, 66, 'Bonjour', '2025-03-25 10:38:31'),
(32, 66, 65, 'salut', '2025-03-25 10:45:32'),
(33, 65, 66, 'hi', '2025-03-25 10:46:22'),
(34, 66, 65, 'bon', '2025-03-25 10:46:31'),
(35, 65, 66, 'hi', '2025-03-25 10:48:40'),
(36, 66, 65, 'hi', '2025-03-25 10:50:37'),
(37, 66, 65, 'HI', '2025-03-25 11:34:46'),
(38, 66, 65, 'HOLLA', '2025-03-25 11:34:53'),
(39, 65, 66, 'hi', '2025-03-25 11:43:32'),
(40, 65, 66, 'hi', '2025-03-25 11:45:50'),
(41, 66, 65, 'salut', '2025-03-25 11:46:18'),
(42, 66, 65, 'hi', '2025-04-03 19:15:24'),
(43, 65, 66, 'hi how are u today', '2025-04-03 19:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `text` text DEFAULT NULL,
  `piece_joint` varchar(255) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `deslikes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `id_user`, `date`, `text`, `piece_joint`, `likes`, `deslikes`) VALUES
(1, 65, '2025-04-01 00:00:00', 'hi', 'posts/postImg_65/post_67eb8c1cbb4c50.85510710.png', 6, 0),
(2, 66, '2025-04-01 00:00:00', 'test', 'posts/postImg_66/post_67eb919b1fc4f9.77773077.jpg', 1, 0),
(3, 66, '2025-04-01 00:00:00', '', 'posts/postImg_66/post_67eb989d1bf4c5.56308023.png', 1, 0),
(4, 66, '2025-04-01 00:00:00', 'bonjour', 'posts/postImg_66/post_67eba4390f6ef3.39415582.jpg', 15, 0),
(5, 65, '2025-04-01 00:00:00', 'what a day !', 'posts/postImg_65/post_67eba4d171c119.15317127.jpg', 7, 0),
(6, 66, '2025-04-01 00:00:00', 'look at thise', 'posts/postImg_66/post_67eba555548958.10265079.png', 1, 0),
(7, 65, '2025-04-01 00:00:00', 'salam !', 'posts/postImg_65/post_67eba58a021d17.04906171.jpg', 1, 0),
(8, 66, '2025-04-01 08:47:10', 'sun :)', 'posts/postImg_66/post_67eba80ee05250.11879948.jpg', 1, 0),
(9, 65, '2025-04-01 08:48:36', ':)', 'posts/postImg_65/post_67eba86427dfb7.42103799.jpg', 32, 0),
(10, 66, '2025-04-01 08:49:39', 'hoola mes amies', NULL, 5, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amie`
--
ALTER TABLE `amie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk3` (`id1`),
  ADD KEY `fk4` (`id2`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idUser_C` (`id_user`),
  ADD KEY `fk_idPost` (`id_post`);

--
-- Indexes for table `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1` (`idDest`),
  ADD KEY `fk2` (`idExp`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idExp` (`idExp`),
  ADD KEY `fk_idDest` (`idDest`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idUser` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amie`
--
ALTER TABLE `amie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `db_user`
--
ALTER TABLE `db_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `invitation`
--
ALTER TABLE `invitation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amie`
--
ALTER TABLE `amie`
  ADD CONSTRAINT `fk3` FOREIGN KEY (`id1`) REFERENCES `db_user` (`id`),
  ADD CONSTRAINT `fk4` FOREIGN KEY (`id2`) REFERENCES `db_user` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_idPost` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idUser_C` FOREIGN KEY (`id_user`) REFERENCES `db_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invitation`
--
ALTER TABLE `invitation`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`idDest`) REFERENCES `db_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2` FOREIGN KEY (`idExp`) REFERENCES `db_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `db_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_idDest` FOREIGN KEY (`idDest`) REFERENCES `db_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idExp` FOREIGN KEY (`idExp`) REFERENCES `db_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_idUser` FOREIGN KEY (`id_user`) REFERENCES `db_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
