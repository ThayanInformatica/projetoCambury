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
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE IF NOT EXISTS `tb_usuario` (
`codUsuario` int(11) NOT NULL,
  `loginUsuario` varchar(30) NOT NULL,
  `nomeUsuario` varchar(30) NOT NULL,
  `senhaUsuario` varchar(30) NOT NULL,
  `cpfUsuario` varchar(30) NOT NULL,
  `emailUsuario` varchar(30) NOT NULL,
  `nivelDeUsuario` varchar(2) NULL DEFAULT 0
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`codUsuario`, `loginUsuario`, `nomeUsuario`,`senhaUsuario`,`cpfUsuario`,`emailUsuario`) VALUES
(18, '123', '123','123','12','100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
 ADD PRIMARY KEY (`codUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
MODIFY `codUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
