-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 15-Abr-2022 às 15:42
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cms`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(254) DEFAULT '$2y$10$iusesomecrazystrings22',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(20, 'Adesanya', '$2y$10$yonS/VxMXcyurhONUgzG6OZV059xmCFRNCQgf/wCojWCj46H0Gr1u', 'Israel', 'Adesanya', 'izzy.ufc@gmail.com', NULL, 'admin', '$2y$10$iusesomecrazystrings22'),
(2, 'Lotus', '$2y$12$xdZHaRZ7tT/5yV9TByw89.GwPfQAHSQCGrwYF58tG.27Uh2h9G.Ya', 'Black Lotus', 'Diaz', 'lotus@gmail.com', NULL, 'admin', NULL),
(9, 'DarkFenix', '$1$Kc4oJAhS$9ntXpOqoLVUhqkWAsXepG.', 'DarkFenix', 'Almirante', 'luc32as@jpg.com', NULL, 'admin', '$2y$10$iusesomecrazystring22'),
(18, 'master', '$2y$12$/ChL4/qzBc79McCPOxqjuulZ6luUJZG.w2dqI/Q4V4c8.MD8E1hDe', NULL, NULL, 'metstre@sa.com', NULL, 'admin', '$2y$10$iusesomecrazystrings22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
