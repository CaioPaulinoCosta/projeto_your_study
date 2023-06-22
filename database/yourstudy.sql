-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Jun-2023 às 21:34
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `yourstudy`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `grades`
--

CREATE TABLE `grades` (
  `id` smallint(11) UNSIGNED NOT NULL,
  `p1` varchar(250) DEFAULT NULL,
  `p2` varchar(250) DEFAULT NULL,
  `p3` varchar(250) DEFAULT NULL,
  `p4` varchar(250) DEFAULT NULL,
  `t1` varchar(250) DEFAULT NULL,
  `t2` varchar(250) DEFAULT NULL,
  `average` varchar(250) DEFAULT NULL,
  `users_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `grades`
--

INSERT INTO `grades` (`id`, `p1`, `p2`, `p3`, `p4`, `t1`, `t2`, `average`, `users_id`) VALUES
(6, '10', '10', '10', '10', '10', '10', '10.00', 2),
(9, '5', '6', '4', '5', '2', '1', '4.38', 3),
(10, '10', '9', '8', '10', '5', '10', '8.94', 4),
(11, '10', '8', '9', '10', '6', '8', '8.85', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lessons`
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
-- Extraindo dados da tabela `lessons`
--

INSERT INTO `lessons` (`id`, `title`, `description`, `content`, `image`, `video`, `category`, `users_id`, `reviews_id`) VALUES
(1, 'Aprenda Flutter em 20 minutos!', 'Nesta aula de curta duração, você será introduzido ao Flutter, uma poderosa estrutura para desenvolvimento de aplicativos móveis.', NULL, '35430b0a508d63df6b4ec767ad27a3d8445a69ad36795f36577ee77823339330d7eff5f84114bcb8e02d99af7637d56aa9559d08b73b9ac7dc7e5629jpg', 'https://www.youtube.com/embed/8vkGADckmiI', 'Flutter', 1, 1),
(2, 'Aprenda as principais funções do Java e suas vantagens.', 'Nesta aula de Java, você terá a oportunidade de explorar as principais funções da linguagem de programação Java e descobrir as vantagens que ela oferece para o desenvolvimento de software.', 'Durante o curso, você será guiado por instrutores experientes que compartilharão conhecimentos e técnicas essenciais para aproveitar ao máximo o Java. Você aprenderá sobre a sintaxe básica da linguagem, estruturas de controle de fluxo, manipulação de stri', '7e4e333b9a8652717069bf68f1c73c359a66e4f512295e20e2dc1ec834a03220c92754951ccf693da0d4ffd5d68aa15e228d544e450edb457039996ejpg', 'https://www.youtube.com/embed/YoXbfMkzBKA', 'Java', 1, NULL),
(3, 'Veja o poder do JavaScript e aprenda sua sintaxe!', 'Nesta aula, você terá a oportunidade de explorar o poderoso mundo do JavaScript e mergulhar na sintaxe desta linguagem de programação amplamente utilizada. O JavaScript é uma das linguagens mais populares para o desenvolvimento de aplicativos web interati', 'Durante o curso, você descobrirá como o JavaScript pode adicionar interatividade às suas páginas da web, permitindo que você crie elementos dinâmicos, manipule eventos, acesse e modifique o conteúdo da página em tempo real. Você aprenderá sobre variáveis,', 'fc9b9d295916befb28ce5856cf1c1c25ae30bdba3689bdaf13e7ed0b059f2b248c6bda50bdfe78966e04de5f7cad376a46d4d662ea2aab934646aa5ajpg', 'https://www.youtube.com/embed/YoXbfMkzBKA', 'Javascript', 1, NULL),
(4, 'Entenda os tipos de positions no CSS e como usar!', 'Nesta aula especial de CSS, você terá a oportunidade de compreender os diferentes tipos de positions disponíveis no CSS e aprender como utilizá-los adequadamente em seus projetos web.', 'O posicionamento de elementos é fundamental para criar layouts dinâmicos e responsivos. Durante o curso, você explorará os quatro principais tipos de positions no CSS: static, relative, absolute e fixed. Você entenderá as características e comportamentos ', '1cb398a6e5ce813594aa744ce514165aa4c74de660a6e50543285c93e5b44b25928301acd6e47b31fdcc46cfe2c57044b3de6f7c745cbc0ab970ef79jpg', 'https://www.youtube.com/embed/YoXbfMkzBKA', 'CSS', 1, NULL),
(5, 'Introdução Prática ao PHP', 'Nesta aula de 20 minutos, você mergulhará no mundo do PHP e descobrirá como criar aplicações web dinâmicas de \r\nforma prática e eficiente. O PHP é uma das linguagens de programação mais populares para o desenvolvimento web, \r\ne neste curso introdutório, v', 'Durante a aula, você será guiado passo a passo por um instrutor experiente, que fornecerá uma visão geral do PHP\r\n e de suas principais características. Você aprenderá a configurar um ambiente de desenvolvimento PHP, criar seu \r\nprimeiro arquivo PHP e exe', '9afe29fd793a255e1454e1ccbf352071e7908e7ade90140f892e6cc736dd8d88b884080d5f7e70f36054660f2c8ac53199c4a12491c1755cfbeefacejpg', 'https://www.youtube.com/embed/ABzDOSQkhTM', 'PHP', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) UNSIGNED NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `users_id` int(11) UNSIGNED DEFAULT NULL,
  `lessons_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `reviews`
--

INSERT INTO `reviews` (`id`, `rating`, `review`, `users_id`, `lessons_id`) VALUES
(1, 10, 'Aula muito boa!', 2, 1),
(2, 8, 'Aula interessante, deu para aprender bastante!', 2, 2),
(3, 10, 'Estou amando aprender Javascript!!', 2, 3),
(4, 9, 'Me salvou!! Estava com dificuldades para entender positions...', 2, 4),
(5, 7, 'Achei a aula boa demais, mas o audio estava um pouco ruim', 3, 4),
(6, 8, 'Estou gostando de aprender flutter!!!', 4, 1),
(7, 10, 'Aula excelente sobre PHP! Gostei demais!!!', 3, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `ra` varchar(250) DEFAULT NULL,
  `p1` varchar(250) DEFAULT NULL,
  `p2` varchar(250) DEFAULT NULL,
  `p3` varchar(250) DEFAULT NULL,
  `p4` varchar(250) DEFAULT NULL,
  `t1` varchar(250) DEFAULT NULL,
  `t2` varchar(250) DEFAULT NULL,
  `avarage` varchar(250) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `image`, `bio`, `ra`, `p1`, `p2`, `p3`, `p4`, `t1`, `t2`, `avarage`, `token`) VALUES
(1, 'Caio', 'Costa', 'caiopaulinocosta@hotmail.com', '$2y$10$0wcsxQ1WzGRyy8ZOqqDazOpcc2tdefOqXPCBK.fXTTbPcnIGvYQBK', 'd4311dca1529671e28ae3efead81b52fbf9dd519a9b61181f8a809c020536b6f0ddcf7c110676e40b4ca1b6a21407187a643df7c5194d3b56ee2e896.jpg', 'Sou professor da pagina!', '', NULL, '', NULL, '', NULL, NULL, NULL, '7e6ac8d005c91b8e3e888a747aa3fa2fe912b17664fa354139e96eaf4661f8e22cc56b350cda17785433e833dc4d7438d9a5'),
(2, 'Sylvie', 'Cantrell', 'sylviecantrell@hotmail.com', '$2y$10$wPS9wJwcH/mc/YT6hDCEuexKgI5rmCEAoP5IUIfaC3C3.xGiLr3Ca', '3fbb6ed0b178141850cf58bd18e2bae73680dd96235576b564d4de9403b45e85c466b237c88efad42a856681329e0549119ce06b410db4454175eac4.jpg', 'Sou aluna da pagina!', 'A2829', NULL, '', NULL, '', NULL, NULL, NULL, '9dec98f7037384ecd0a3b612fd9ac467fd00f88c5449eb20287099fa747382e30f154cebf00e9d634cd72fa2ead5819217f1'),
(3, 'Menino', 'Maluquinho', 'meninomaluquinho@hotmail.com', '$2y$10$JT9aXcFdHgCjrImBuwOnL.ijg6qDyg0lPPrX.0JTgxfvvn9WZqKYa', '1e6bc9aaf70b1ed973e36663893b86f9a7c994489723d3cfad8f1090554cfe6af983e70c468af4e1f5d19ac126370f237ccc9d77395a1b9c63155ce6.jpg', 'Me chamo Menino Maluquinho e sou aluno da pagina!', 'A3234', NULL, '', NULL, '', NULL, NULL, NULL, '51ec9066f7abb36ee659512b4f700a805125cab54b72c05daae5326893161146198fd22fd7df4a75ecfee46d5ba8b00a87c3'),
(4, 'Kick', 'Buttowski', 'kickbuttowski@hotmail.com', '$2y$10$teqp0AVxCW6WZbUSqB9emuRzqLqdEA3uf8/Ode1/RYVl.zT1iobwe', 'fc76650252b955089200611d86715b2356c9d813d6de0cf3b0e496e5a59bf2fab15651e91d81924cb79727bda02d0e03ada0d731cb356402eea43b25.jpg', 'Me chamo Kick Buttowski, gosto de esportes radicais e sou aluno da pagina!', 'A4982', NULL, '', NULL, '', NULL, NULL, NULL, 'c2251a4c0991ceaf61aa40dcbd6fd940103ffb55c461117d1ddca6c2b4a571d8200428acea4015ec3d95d511b6fa31ae6353'),
(7, 'Dino', 'Da Silva Sauro', 'dinodasilvasauro@hotmail.com', '$2y$10$Z.AMs2OxKAoW6Ox8llIAy..m9L4vh600M3AaESJlPy9Wi4rE63rry', '7fc98e862f7b048d43be7a90b320ffd5d53ea5c26b05f22cdd367ebd54721f3ffa4224aa58bc8f2095f6730f0e02e770edad30f01c60240e303edf36.jpg', NULL, 'A2343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0d1ea7c6788ae4ace2fc482a3c707b22f87cbc8c96bf55f29d71b19044999c768ebd5bca55a9ee8661e81beb66afe4001855'),
(8, 'Leandro', 'Silva', 'leandro@hotmail.com', '$2y$10$XgGphjuqrx6BonILmW8wTu.T5HVeFEx9K8bw..1uaD9CxZ8SHLDSe', NULL, NULL, 'A1293', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bdc84eb5fd337ea9f67d00ba1b94fa503711849876efa259765e5e8889ceac9f40e96acfe3e279d1eb6deb5fe10e5e56f6ac');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Índices para tabela `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `reviews_id` (`reviews_id`);

--
-- Índices para tabela `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `lessons_id` (`lessons_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `grades`
--
ALTER TABLE `grades`
  MODIFY `id` smallint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_id` FOREIGN KEY (`reviews_id`) REFERENCES `reviews` (`id`);

--
-- Limitadores para a tabela `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
