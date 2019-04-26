<?php

  if(isset($_POST['cadastrar'])) {
    include ('classes/Conexao.class.php');
    include ('classes/UsuarioDAO.class.php');

    $cadastrar = new UsuarioDAO();

    $login = trim(strip_tags($_POST['login'])); // atribui login à variavel, com funções contra sql inject
	    $nome = trim(strip_tags($_POST['nome'])); // atribui login à variavel, com funções contra sql inject
		    $senha = trim(strip_tags($_POST['senha'])); // atribui login à variavel, com funções contra sql inject
				$rep_senha = trim(strip_tags($_POST['rep_senha'])); // atribui login à variavel, com funções contra sql inject
					$cpf = trim(strip_tags($_POST['cpf'])); // atribui login à variavel, com funções contra sql inject
						$email = trim(strip_tags($_POST['email'])); // atribui login à variavel, com funções contra sql inject
						
    // confere se as senhas são iguais
    
    if($senha === $rep_senha) {
      $consulta = $cadastrar->unico($login);
	  $consultaCPF = $cadastrar->unicoCpf($cpf);
      // caso o login escolhido já exista no banco retorna erro
      if($consulta == false || $consultaCPF == false) {
        header('location:cadastro-usuario.php?repetido=senha');
      // caso não haja login parecido, inclui métoro de inserção de dados no banco de dados
      } else {
        $insere = $cadastrar->cadastra($login,$senha,$nome,$cpf,$email);
        // caso o usuario seja cadastrado, exibir mensagem de sucesso
        if($insere == true) {
          header('location:index.php?successUser=cadastrado');
        }
      }

    } else {
      header('location:cadastro-usuario.php?erro=senha');
    }

  }

 ?>
 


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login PHP OO</title>

    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../dist/css/bootstrapValidator.css"/>

    <!-- Include the FontAwesome CSS if you want to use feedback icons provided by FontAwesome -->
    <!--<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />-->

    <script type="text/javascript" src="../vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../dist/js/bootstrapValidator.js"></script>

 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src = "http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
</head>
<body>

  <div class="container jumbotron">

    <?php
      // mensagem de erro caso as senhas não sejam iguais
      if(isset($_GET['erro'])) {
        echo '<div class="alert alert-danger">As senhas devem ser iguais!</div>';
      }
      // mensagem de erro caso o login escolhido já exista no banco de dados
      if(isset($_GET['repetido'])) {
        echo '<div class="alert alert-danger">Este Login ou CPF já foi escolhido por outra pessoa!</div>';
      }
      // mensagem de sucesso caso o usuario seja cadastrado corretamente
      if(isset($_GET['successUser'])) {
        echo '<div class="alert alert-success">Usuario cadastrado!</div>';
      }

    ?>
    <h2>Cadastro</h2>
    <hr>
    <form action="#" method="post">

      <div class="form-group">
        <label for="login">Login</label>
        <input type="text" class="form-control" id="login" name="login" required autofocus>
      </div>
	  
	  	        <div class="form-group">
        <label for="nome">Nome: </label>
        <input type="text" class="form-control" id="nome" name="nome" required>
      </div>

      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" class="form-control" id="senha" name="senha" required>
      </div>

      <div class="form-group">
        <label for="rep_senha">Repita a Senha:</label>
        <input type="password" class="form-control" id="rep_senha" name="rep_senha" required>
      </div>
	  
			<div class="form-group" class="form-horizontal">
             <label for="cpf">CPF</label>
             <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11" >
         </div>
	  
	        <div class="form-group">
        <label for="email">E-mail</label>
        <input type="text" class="form-control" id="email" name="email" required>
      </div>

      <button type="submit" class="btn btn-primary" name="cadastrar">Cadastrar</button>

    </form>
    <hr>
    <a href="index.php">Voltar</a>

  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script>
    setTimeout(function() {
      $('.alert').fadeOut();
    }, 3000);

  </script>
</body>

</html>
