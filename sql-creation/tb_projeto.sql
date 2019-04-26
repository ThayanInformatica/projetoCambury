
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
-- Estrutura da tabela `tb_projeto`
--

CREATE TABLE IF NOT EXISTS `tb_projeto` (
`codProjeto` int(11) NOT NULL,
	`codUsuario` int(11) NOT NULL,
  `nomeProfessor` varchar(30) NOT NULL,
  `objetivo` varchar(200) NOT NULL,
    `resumo` varchar(200) NOT NULL,
	    `curso` varchar(50) NOT NULL,
		    `turma` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_projeto`
--

INSERT INTO `tb_projeto` (`codProjeto`,`codUsuario`, `nomeProfessor`, `objetivo`,`resumo`,`curso`,`turma`) VALUES
(18, 24, 'Teste','Teste','Teste','ti','02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_projeto`
--
ALTER TABLE `tb_projeto`
 ADD PRIMARY KEY (`codProjeto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_projeto`
--
ALTER TABLE `tb_projeto`
MODIFY `codProjeto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;

--
-- Relação entre tableas for table `tb_projeto` and tb_usuario
--

ALTER TABLE `tb_projeto`
 CONSTRAINT PK_CodUsuario_CodProjeto PRIMARY KEY(codProjeto),
 CONSTRAINT FK_CodProjeto_CodUsuario FOREIGN KEY(codUsuario) REFERENCES tb_usuario(codUsuario);
 
 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
