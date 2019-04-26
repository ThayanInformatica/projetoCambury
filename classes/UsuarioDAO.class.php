<?php

  class UsuarioDAO {
    private $conexao;

    public function __construct() {
      $this->conexao = new Conexao();
    }

    // efetua login
    public function login($login, $senha) {

      $sql = "SELECT * FROM tb_usuario WHERE loginUsuario = '$login' AND senhaUsuario = '$senha'";

      $executa = mysqli_query($this->conexao->getCon(), $sql);

      if(mysqli_num_rows($executa) > 0) {
        return true;
      } else {
        return false;
      }
    }
	
	    // verificiar validacao de usuario
    public function nivelDeUsuario($login) {

      $sql = "SELECT nivelUsuario FROM tb_usuario WHERE loginUsuario = '$login'";

      $executa = mysqli_query($this->conexao->getCon(), $sql);
	  $nivelArray = mysqli_fetch_array($executa);
      return $nivelArray['nivelUsuario'];
    }
	
		    // verificiar validacao de usuario
    public function CodDoUsuario($login) {

      $sql = "SELECT codUsuario FROM tb_usuario WHERE loginUsuario = '$login'";

      $executa = mysqli_query($this->conexao->getCon(), $sql);
	  $codUsuarioArray = mysqli_fetch_array($executa);
      return $codUsuarioArray['codUsuario'];
    }


    // Verifica se já existe login com o nome escolhido
    public function unico($login) {

      $unic = "SELECT * FROM tb_usuario WHERE loginUsuario = '$login'";

      $exec = mysqli_query($this->conexao->getCon(), $unic);

      if(mysqli_num_rows($exec) > 0) {
        return false;
      } else {
        return true;
      }
    }
	
	    // Verifica se já existe cpf existente
		public function unicoCpf($cpf) {

      $unic = "SELECT * FROM tb_usuario WHERE cpfUsuario = '$cpf'";

      $exec = mysqli_query($this->conexao->getCon(), $unic);

      if(mysqli_num_rows($exec) > 0) {
        return false;
      } else {
        return true;
      }
    }

    // cadastra o usuário
    public function cadastra($login,$senha,$nome,$cpf,$email) {

      $sql = "INSERT INTO tb_usuario (loginUsuario,senhaUsuario,nomeUsuario,cpfUsuario,emailUsuario) VALUES ('$login','$senha','$nome',$cpf,'$email')";

      $executa = mysqli_query($this->conexao->getCon(), $sql);

      if(mysqli_affected_rows($this->conexao->getCon()) > 0) {
        return true;
      } else {
        return false;
      }
    }

    // efetua logout
    public function logout() {

      session_start();

      session_destroy();

      //setcookie("login" , "" , time()-60*5);
      header("Location:index.php?success=logout");
      exit();
    }
	

  }
