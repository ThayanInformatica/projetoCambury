
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
`codProjeto` int(11)  NULL,
	`codUsuario` int(11)  NULL,
	  `nomeProjeto` varchar(100)  NULL,
  `nomeProfessor` varchar(30)  NULL,
  `objetivo` varchar(200)  NULL,
    `resumo` varchar(200)  NULL,
	    `curso` varchar(50)  NULL,
		    `turma` varchar(20)  NULL,
			`projetoAceito` varchar(2)  NULL DEFAULT 0
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_projeto`
--

INSERT INTO `tb_projeto` (`codProjeto`,`codUsuario`,`nomeProjeto`, `nomeProfessor`,`objetivo`,`resumo`,`curso`,`turma`) VALUES
(18, 24, 'Teste','Teste','Teste','Teste','ti','02');

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
 
 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
