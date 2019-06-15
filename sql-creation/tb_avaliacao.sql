
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projeto`
--

--
-- Estrutura da tabela `tb_avaliacao`
--

CREATE TABLE IF NOT EXISTS `tb_avaliacao` (
  `codAvaliacao` int(11) NOT NULL,
  `codProjeto` int(11) NOT NULL,
`codUsuario` int(11) NOT NULL,
  `nota_1` real NOT NULL,
  `nota_2` real NOT NULL,
  `nota_3` real NOT NULL,
  `nota_4` real NOT NULL,
  `user_avaliou` varchar(2) null
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usuario`
--

ALTER TABLE `tb_avaliacao`
 ADD CONSTRAINT `fk_tb_avaliacao_tb_usuario_idx` FOREIGN KEY (`codUsuario`) REFERENCES `tb_usuario` (`codUsuario`) ON DELETE CASCADE,
ADD CONSTRAINT `fk_tb_avaliacao_tb_projeto_idx` FOREIGN KEY (`codProjeto`) REFERENCES `tb_projeto` (`codProjeto`) ON DELETE CASCADE;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_avaliacao`
--
ALTER TABLE `tb_avaliacao`
 ADD PRIMARY KEY (`codAvaliacao`);
--
-- AUTO_INCREMENT for table `tb_projeto`
--
ALTER TABLE `tb_avaliacao`
MODIFY `codAvaliacao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
 

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
