<?php

class ProjetoDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    // cadastra o projeto
    public function cadastra($codUsuario, $nomeProjeto, $nomeProfessor, $objetivoProjeto, $resumoProjeto, $cursoProjeto, $turmaProjeto)
    {

        $sql = "INSERT INTO tb_projeto (codUsuario,nomeProjeto,nomeProfessor,objetivo,resumo,curso,turma) VALUES ('$codUsuario','$nomeProjeto','$nomeProfessor','$objetivoProjeto','$resumoProjeto','$cursoProjeto','$turmaProjeto')";

        $executa = mysqli_query($this->conexao->getCon(), $sql);

        if (mysqli_affected_rows($this->conexao->getCon()) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function unicoProjeto($nomeProjeto)
    {

        $unic = "SELECT * FROM tb_projeto WHERE nomeProjeto = '$nomeProjeto'";

        $exec = mysqli_query($this->conexao->getCon(), $unic);

        if (mysqli_num_rows($exec) > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function aprovarProjeto($aprovarProjeto, $codProjeto)
    {

        $sql = " UPDATE tb_projeto SET (projetoAceito) = ('$aprovarProjeto') WHERE codProjeto = ('$codProjeto')";

        $executa = mysqli_query($this->conexao->getCon(), $sql);

        if (mysqli_affected_rows($this->conexao->getCon()) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function recuperarProjetosParaAvaliar()
    {

        $sql = "select * from tb_projeto where projetoAceito = 1";

        $executa = mysqli_query($this->conexao->getCon(), $sql);
        $OKProjeto = mysqli_fetch_array($executa);
        return $OKProjeto['projetoAceito'];
    }

    public function recuperarProjetosAvaliados($codProjeto)
    {
        $sql = "select nota_1,nota_2,nota_3,nota_4 from tb_avaliacao where codProjeto = '$codProjeto'";

        $executa = mysqli_query($this->conexao->getCon(), $sql);
        $existeNota = mysqli_fetch_array($executa);
        return $existeNota;
    }

}

//SELECT tb_projeto.codProjeto, tb_projeto.nomeProjeto, tb_projeto.nomeProfessor, tb_projeto.curso,tb_projeto.turma, (SELECT SUM(tb_avaliacao.nota_1 + tb_avaliacao.nota_2 + tb_avaliacao.nota_3 + tb_avaliacao.nota_4)) as Total FROM tb_projeto JOIN tb_avaliacao ON tb_projeto.codProjeto = tb_avaliacao.codProjeto where tb_projeto.codProjeto = 127 ORDER BY Total DESC;
//select SUM(nota_1 + nota_2 + nota_3 + nota_4) AS TotalItemsOrdered from tb_avaliacao WHERE codProjeto = $codProjeto ORDER BY;
//SELECT codProjeto,nomeProjeto,nomeProfessor FROM `tb_projeto` WHERE codUsuario=24;
