-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 18-Out-2016 às 02:39
-- Versão do servidor: 5.5.52-0+deb8u1
-- PHP Version: 5.6.26-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_avaliacao`
--

CREATE TABLE IF NOT EXISTS `tb_avaliacao` (
  `codProjeto` int(11) NOT NULL,
`codUsuario` int(11) NOT NULL,
  `nota_1` real NOT NULL,
  `nota_2` real NOT NULL,
  `nota_3` real NOT NULL,
  `nota_4` real NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_avaliacao` (`codUsuario`, `codProjeto`, `nota_1`,`nota_2`,`nota_3`,`nota_4`) VALUES
(18, 113, 5.0,9.2,9.4,9.1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_avaliacao`
--
ALTER TABLE `tb_avaliacao`
 ADD PRIMARY KEY (`codProjeto`);