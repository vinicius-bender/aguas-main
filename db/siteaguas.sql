-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 17/06/2023 às 18:00
-- Versão do servidor: 5.6.13
-- Versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `siteaguas`
--
CREATE DATABASE IF NOT EXISTS `siteaguas` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `siteaguas`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `amostra`
--

CREATE TABLE IF NOT EXISTS `amostra` (
  `idAmostra` int(11) NOT NULL AUTO_INCREMENT,
  `idCriador` int(11) NOT NULL,
  `idEditor` int(11) NOT NULL,
  `localColetado` int(11) NOT NULL,
  `dataReferencia` date NOT NULL,
  `dataColeta` date NOT NULL,
  `Pergunta 1` varchar(100) DEFAULT NULL,
  `Pergunta 2` varchar(100) DEFAULT NULL,
  `Pergunta 3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idAmostra`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Fazendo dump de dados para tabela `amostra`
--

INSERT INTO `amostra` (`idAmostra`, `idCriador`, `idEditor`, `localColetado`, `dataReferencia`, `dataColeta`, `Pergunta 1`, `Pergunta 2`, `Pergunta 3`) VALUES
(26, 0, 3, 1, '2023-06-11', '2023-06-11', '3', '3', '3'),
(27, 0, 0, 1, '2023-06-11', '2023-06-11', '1', '2', '3'),
(28, 3, 0, 1, '2023-06-11', '2023-06-11', '1', '2', '3'),
(29, 3, 0, 1, '2023-06-11', '2023-06-11', '1', '2', '3'),
(30, 3, 0, 2, '2023-06-12', '2023-06-12', '', '', ''),
(31, 3, 0, 2, '2023-06-12', '2023-06-12', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `artigo`
--

CREATE TABLE IF NOT EXISTS `artigo` (
  `nome` varchar(150) CHARACTER SET utf8 NOT NULL,
  `resumo` varchar(300) CHARACTER SET utf8 NOT NULL,
  `pdf` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `link` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `idArtigo` int(11) NOT NULL AUTO_INCREMENT,
  `idCriador` int(11) NOT NULL,
  PRIMARY KEY (`idArtigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `local`
--

CREATE TABLE IF NOT EXISTS `local` (
  `idLocal` int(11) NOT NULL AUTO_INCREMENT,
  `idCriador` int(11) NOT NULL,
  `idEditor` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `lat` varchar(30) NOT NULL,
  `lng` varchar(30) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `foto` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idLocal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `local`
--

INSERT INTO `local` (`idLocal`, `idCriador`, `idEditor`, `nome`, `lat`, `lng`, `tipo`, `foto`) VALUES
(1, 1, 1, 'Sem foto', '-27.393545381909657', '-53.4292325461536', '123', '../img/nhfotos.png'),
(2, 2, 0, 'Sem foto 2', '-27.394840880655217', '-53.42704328819886', 'Rio', '../img/nhfotos.png'),
(5, 3, 0, 'Local 3', '-27.39257374788883', '-53.42280853043916', 'Rio', '../img/nhfotos.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pergunta`
--

CREATE TABLE IF NOT EXISTS `pergunta` (
  `titulo` varchar(100) NOT NULL,
  `idPergunta` int(11) NOT NULL AUTO_INCREMENT,
  `visibilidade` tinyint(1) NOT NULL,
  PRIMARY KEY (`idPergunta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Fazendo dump de dados para tabela `pergunta`
--

INSERT INTO `pergunta` (`titulo`, `idPergunta`, `visibilidade`) VALUES
('Pergunta 1', 9, 0),
('Pergunta 2', 16, 0),
('Pergunta 3', 21, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `email` varchar(150) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `matricula` varchar(20) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `nivel` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`email`, `senha`, `matricula`, `nome`, `nivel`, `idUsuario`) VALUES
('adm1@adm1', 'adm1', '1', 'Administrador 1', 2, 1),
('map1@map1', 'map1', '1', 'Mapeador 1', 1, 2),
('teste@teste', '123', '123', 'Adm', 3, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
