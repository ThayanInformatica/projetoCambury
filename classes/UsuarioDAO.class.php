<?php

class UsuarioDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    // efetua login
    public function login($login, $senha)
    {

        $sql = "SELECT * FROM tb_usuario WHERE loginUsuario = '$login' AND senhaUsuario = '$senha'";

        $executa = mysqli_query($this->conexao->getCon(), $sql);

        if (mysqli_num_rows($executa) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function logado($login)
    {

        $sql = "UPDATE tb_usuario SET logado = 1 WHERE loginUsuario = '$login'";

        $executa = mysqli_query($this->conexao->getCon(), $sql);

        if (mysqli_num_rows($executa) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyLogger($login)
    {

        $sql = "SELECT logado FROM tb_usuario WHERE loginUsuario = '$login'";

        $executa = mysqli_query($this->conexao->getCon(), $sql);
        $verifylog = mysqli_fetch_array($executa);
        return $verifylog['logado'];
    }

    // verificiar validacao de usuario
    public function nivelDeUsuario($login)
    {

        $sql = "SELECT nivelUsuario FROM tb_usuario WHERE loginUsuario = '$login'";

        $executa = mysqli_query($this->conexao->getCon(), $sql);
        $nivelArray = mysqli_fetch_array($executa);
        return $nivelArray['nivelUsuario'];
    }

    // verificiar validacao de usuario
    public function CodDoUsuario($login)
    {

        $sql = "SELECT codUsuario FROM tb_usuario WHERE loginUsuario = '$login'";

        $executa = mysqli_query($this->conexao->getCon(), $sql);
        $codUsuarioArray = mysqli_fetch_array($executa);
        return $codUsuarioArray['codUsuario'];
    }


    // Verifica se já existe login com o nome escolhido
    public function unico($login)
    {

        $unic = "SELECT * FROM tb_usuario WHERE loginUsuario = '$login'";

        $exec = mysqli_query($this->conexao->getCon(), $unic);

        if (mysqli_num_rows($exec) > 0) {
            return false;
        } else {
            return true;
        }
    }

    // Verifica se já existe cpf existente
    public function unicoCpf($cpf)
    {

        $unic = "SELECT * FROM tb_usuario WHERE cpfUsuario = '$cpf'";

        $exec = mysqli_query($this->conexao->getCon(), $unic);

        if (mysqli_num_rows($exec) > 0) {
            return false;
        } else {
            return true;
        }
    }

    // cadastra o usuário
    public function cadastra($login, $senha, $nome, $cpf, $email, $avaliador)
    {

        $sql = "INSERT INTO tb_usuario (loginUsuario,senhaUsuario,nomeUsuario,cpfUsuario,emailUsuario,avaliador) VALUES ('$login','$senha','$nome','$cpf','$email','$avaliador')";

        $executa = mysqli_query($this->conexao->getCon(), $sql);

        if (mysqli_affected_rows($this->conexao->getCon()) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // efetua logout
    public function logout($login)
    {
        $sql = "UPDATE tb_usuario SET logado = 0 WHERE loginUsuario = '$login'";

        $executa = mysqli_query($this->conexao->getCon(), $sql);

        session_start();

        session_destroy();

        //setcookie("login" , "" , time()-60*5);
        header("Location:index.php?logout=sucess");
        exit();
    }

    public function logoutLogado($login)
    {

        session_destroy();

        //setcookie("login" , "" , time()-60*5);
        header('location: index.php?logado=account');

        exit();
    }

    public function ifsessionExists()
    {

        if (isset($_SESSION)) {
            return true;
        } else {
            return false;
        }
    }

    public function CodDoProjetoPeloUsuario($codUsuario)
    {

        $sql = "select codProjeto from tb_projeto where codUsuario = '$codUsuario'";

        $executa = mysqli_query($this->conexao->getCon(), $sql);
        $codProjeto = mysqli_fetch_array($executa);
        return $codProjeto['codProjeto'];
    }

    public function recuperarProjetos($codUsuario)
    {

        $sql = "select * from tb_projeto";

        $executa = mysqli_query($this->conexao->getCon(), $sql);
        $codProjeto = mysqli_fetch_array($executa);
        return $codProjeto['codProjeto'];
    }

    public function recuperarUsuarioAvaliador($codUsuario)
    {

        $sql = "select avaliador from tb_usuario where codUsuario = '$codUsuario'";

        $executa = mysqli_query($this->conexao->getCon(), $sql);
        $OKAvaliador = mysqli_fetch_array($executa);
        return $OKAvaliador['avaliador'];
    }


}
