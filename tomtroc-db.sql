-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 11 sep. 2025 à 13:17
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `opc_tomtroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `b_id` int(11) NOT NULL,
  `b_user_id` int(11) NOT NULL,
  `b_title` varchar(255) NOT NULL,
  `b_author` varchar(255) NOT NULL,
  `b_image` varchar(255) DEFAULT NULL,
  `b_description` text,
  `b_status` enum('available','unavailable') DEFAULT 'available',
  `b_created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`b_id`, `b_user_id`, `b_title`, `b_author`, `b_image`, `b_description`, `b_status`, `b_created_at`) VALUES
(4, 1, 'Le Chat Moe', 'Seb', '/uploads/book_Chirdon_1752776112.jpg', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. \n\nLes photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. \n\nChaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. \n\n\'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.', 'available', '2025-07-17 20:15:12'),
(5, 1, 'Le Chat Khal', 'Seb', '/uploads/book_Chirdon_1752776209.jpg', 'Livre sur mon chacal', 'unavailable', '2025-07-17 20:16:49'),
(6, 2, 'Clean Code', 'Oncle Bob', '/uploads/book_Tanguy_1752776327.jpg', 'Livre conseillé pour apprendre des trucs et réussir les entretiens', 'available', '2025-07-17 20:18:47'),
(8, 1, 'Asterix', 'Uderzo', '/uploads/book_Sebastien_1757096800.jpg', 'Un petit gaulois nommé Asterix', 'available', '2025-08-01 20:33:50'),
(9, 4, 'Le médecin malgré lui', 'Molière', '/uploads/book_Anaïs_1757591266.jpg', 'Sganarelle a beau protester, rien n\'y fait : on veut qu\'il soit médecin... Aux grands maux les grands remèdes, et ceux de ce médecin malgré lui sont des plus étonnants!\r\n\r\nUn mari bat sa femme qui se venge en faisant de lui un médecin des plus inattendus. Il découvre bientôt que ce métier pourrait bien être le meilleur du monde... Cette pièce est une des plus célèbres de Molière pour son art achevé de la farce et du comique de situation. Si elle nous fait toujours autant rire, elle sait aussi nous toucher et nous émouvoir.', 'available', '2025-09-05 17:30:11'),
(10, 6, 'PHP & MySQL pour les nuls', 'OpenClassrooms', '/uploads/book_Assane_1757592397.jpg', 'Ce livre vous introduira aux toutes dernières évolutions des deux langages. Vous apprendrez à manipuler tous les outils de gestion de sessions, les cookies, gérer le code XML et JavaScript, mettre en place des systèmes de sécurité, et bien d\'autres choses encore...', 'available', '2025-09-11 14:06:37');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `m_id` int(11) NOT NULL,
  `m_sender_id` int(11) NOT NULL,
  `m_receiver_id` int(11) NOT NULL,
  `m_content` text NOT NULL,
  `m_is_read` tinyint(1) DEFAULT '0',
  `m_created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`m_id`, `m_sender_id`, `m_receiver_id`, `m_content`, `m_is_read`, `m_created_at`) VALUES
(1, 1, 2, 'test', 1, '2025-08-29 16:28:22'),
(2, 1, 2, 'message pour tanguy', 1, '2025-08-29 16:30:32'),
(3, 1, 5, 'Mon petit chat\r\n', 1, '2025-08-29 17:15:33'),
(4, 5, 1, 'Coucou comment vas-tu ? Je parle tout seul je suis schizophrene ', 1, '2025-09-05 16:51:07'),
(5, 2, 1, 'Réponse de Tanguy', 1, '2025-09-05 17:07:30'),
(6, 1, 2, 'Anais?', 1, '2025-09-05 17:16:13'),
(7, 1, 4, 'Message de Seb à Anaïs', 1, '2025-09-05 17:26:57'),
(8, 5, 4, 'Message de Khal à Anaïs', 1, '2025-09-05 17:40:31'),
(9, 1, 4, 'Salut Anais', 1, '2025-09-05 20:32:42'),
(10, 1, 4, 'Comment vas-tu ?\r\n', 1, '2025-09-05 20:32:51'),
(11, 1, 5, 'Ca va très bien', 1, '2025-09-05 20:36:49'),
(12, 1, 4, 'Message', 1, '2025-09-05 20:39:37'),
(14, 1, 2, 'Bonjour', 1, '2025-09-08 14:17:09'),
(15, 2, 1, 'Comment vas-tu ?\r\n', 1, '2025-09-08 14:17:48'),
(16, 5, 4, 'Teste des notifications', 1, '2025-09-11 11:15:07'),
(17, 1, 4, 'Message', 1, '2025-09-11 11:30:48'),
(18, 4, 1, 'Message retour', 1, '2025-09-11 11:31:12'),
(19, 1, 4, 'anais', 1, '2025-09-11 11:33:17'),
(20, 1, 2, 'Test des notifications\r\n', 1, '2025-09-11 12:59:39'),
(21, 2, 1, 'Message\r\n', 1, '2025-09-11 13:00:11'),
(22, 2, 1, 'Changement', 1, '2025-09-11 13:01:50'),
(23, 1, 4, 'Notif', 1, '2025-09-11 13:08:42');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_username` varchar(50) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_avatar` varchar(10000) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`u_id`, `u_username`, `u_email`, `u_avatar`, `u_password`, `u_created_at`) VALUES
(1, 'Sebastien', 'sebastien.houssein@coqpit.fr', '/uploads/avatar_Sebastien_1757580841.webp', '$2y$10$U5ssDc3MLQxdU1jLVzOld.KggfE7vebGnJL0PwsJDDi6ie/i2k8Hm', '2023-12-13 17:04:38'),
(2, 'Tanguy', 'tanguy@mail.com', '', '$2y$10$fTkKSEVlWGp1zSNNmIRSA.Nod/DWLTGkzOT/KAGsizoMGTRP9FnKC', '2025-07-11 20:34:29'),
(3, 'Nicofilsdenicole', 'nico@mail.com', '/images/default-avatar.jpg', '$2y$10$scUIYfSGkZ6URGinhCoWVuD9jTztp4T27ml/s6pz64e9qM4DDUzdq', '2025-07-17 17:20:58'),
(4, 'Anaïs', 'anais@mail.mail', '/uploads/avatar_Anaïs_1757591260.webp', '$2y$10$Z.eJ9yAIPmlPeXxU2JwZQe0kwhlk4Fh8bT/TzTYxTb763dqQBryIC', '2025-07-25 16:11:53'),
(5, 'Khal', 'khal@mail.com', '/uploads/avatar_Khal_1754851132.png', '$2y$10$MeDLTWJAQErl.jMMaNQHi.r2Vi84TaEuTxrLos0DLy27TciAubt9W', '2025-08-10 20:38:08'),
(6, 'Assane', 'assane@mail.mail', '/uploads/avatar_Assane_1757591938.jpg', '$2y$10$DoP.7Ql2DIERRqML9mcmwePgxu0hsTrKwqH6hUJw2oxFXFVbPR3K2', '2025-09-11 13:54:30');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `b_user_id` (`b_user_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `m_sender_id` (`m_sender_id`),
  ADD KEY `m_receiver_id` (`m_receiver_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_username` (`u_username`),
  ADD UNIQUE KEY `u_email` (`u_email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`b_user_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`m_sender_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`m_receiver_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
