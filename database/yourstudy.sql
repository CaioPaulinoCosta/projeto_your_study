-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 04:40 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yourstudy`
--

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `users_id` int(11) UNSIGNED DEFAULT NULL,
  `reviews_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `title`, `description`, `content`, `image`, `video`, `category`, `users_id`, `reviews_id`) VALUES
(1, 'Aprenda Flutter em 20 minutos!', 'Aula de flutter de 20 minutos.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', '35430b0a508d63df6b4ec767ad27a3d8445a69ad36795f36577ee77823339330d7eff5f84114bcb8e02d99af7637d56aa9559d08b73b9ac7dc7e5629jpg', 'https://www.youtube.com/embed/8vkGADckmiI', 'Flutter', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) UNSIGNED NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `users_id` int(11) UNSIGNED DEFAULT NULL,
  `lessons_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `rating`, `review`, `users_id`, `lessons_id`) VALUES
(1, 10, 'Aula muito boa!', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `image`, `bio`, `token`) VALUES
(1, 'Caio', 'Costa', 'caiopaulinocosta@hotmail.com', '$2y$10$vyKLq2MET3o4LHrm41MhluhomItlOi.97KAaGUOz5HzaeMHcxS2Pe', '521fd5062a493dfbb285c9a578b35c0a8f548922630e91918408aed775fb67f774a6bf2a30a05b9eb1ecb4787030745a882ff69a71bc90c799c964bc.jpg', 'Sou bonito, sou gostoso, sou administrador e sou da Jessica!', '3acf689bda90f6eea01407ac0ae6f5a55bb2fd706c9df1908b0caed47ba8b5d08ec2acd95112b3ff7054f1f4561c3028c27f'),
(2, 'Jessjca', 'Costa', 'jessjca@hotmail.com', '$2y$10$9g1NT5wIqmsiL5MHcVAQ9eoNQSFjE7ZAyArRdpFJ93vzz6c/XxbB6', 'a1af70c62058fb91e94fae5a894ad090c69cbb8c3253cd92855b24f0977435a6099a61bde8219e5fa421ae646f21b9d1103f43bb4264d01e1aecf035.jpg', 'Sou bonita, sou gostosa e sou do Caio!', 'aa1a12d61adf8795d4edf43cb2d6c99c501defd0489b274b7efa9a329aafb71a7de4a483dc2214e0e2df77b713e8439762ba'),
(3, 'Travis', 'Scott', 'teste@hotmail.com', '$2y$10$JT9aXcFdHgCjrImBuwOnL.ijg6qDyg0lPPrX.0JTgxfvvn9WZqKYa', NULL, NULL, '24d76189ef58ca6e762ec3409f73d34bcfd7252dbb2d2d44bb9027f3b2aba86bf71e55481701d19e27061178c364dce5951d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `reviews_id` (`reviews_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `lessons_id` (`lessons_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_id` FOREIGN KEY (`reviews_id`) REFERENCES `reviews` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
