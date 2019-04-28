<?php

session_start();
if (isset($_SESSION['login']) && isset($_SESSION['senha']) && isset($_SESSION['nivel'])):
    header('location: usuario-logado.php');
endif;

if (isset($_SESSION['nivel'])) {
    $nivel = $_SESSION['nivel'];
    if ($nivel == 99) {
        header('location: administrador/admin.php');
    }

}

if (isset($_POST['cadastrar'])) {
    include('classes/Conexao.class.php');
    include('classes/UsuarioDAO.class.php');

    $cadastrar = new UsuarioDAO();

    $login = trim(strip_tags($_POST['login'])); // atribui login à variavel, com funções contra sql inject
    $nome = trim(strip_tags($_POST['nome'])); // atribui login à variavel, com funções contra sql inject
    $senha = trim(strip_tags($_POST['senha'])); // atribui login à variavel, com funções contra sql inject
    $rep_senha = trim(strip_tags($_POST['rep_senha'])); // atribui login à variavel, com funções contra sql inject
    $cpf = trim(strip_tags($_POST['cpf'])); // atribui login à variavel, com funções contra sql inject
    $email = trim(strip_tags($_POST['email'])); // atribui login à variavel, com funções contra sql inject

    // confere se as senhas são iguais

    if ($senha === $rep_senha) {
        $consulta = $cadastrar->unico($login);
        $consultaCPF = $cadastrar->unicoCpf($cpf);
        // caso o login escolhido já exista no banco retorna erro
        if ($consulta == false || $consultaCPF == false) {
            header('location:cadastro-usuario.php?repetido=senha');
            // caso não haja login parecido, inclui métoro de inserção de dados no banco de dados
        } else {
            $insere = $cadastrar->cadastra($login, $senha, $nome, $cpf, $email);
            // caso o usuario seja cadastrado, exibir mensagem de sucesso
            if ($insere == true) {
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

    <link rel="stylesheet" href="css/projeto/projeto.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>
    <body>

    
        
        <h1 class='h1Cambury'>Cambury</h1>

        <div class="centralizandoCadastro">
    <div class="container jumbotron">

        <?php
        // mensagem de erro caso as senhas não sejam iguais
        if (isset($_GET['erro'])) {
            echo '<div class="alert alert-danger">As senhas devem ser iguais!</div>';
        }
        // mensagem de erro caso o login escolhido já exista no banco de dados
        if (isset($_GET['repetido'])) {
            echo '<div class="alert alert-danger">Este Login ou CPF já foi escolhido por outra pessoa!</div>';
        }
        // mensagem de sucesso caso o usuario seja cadastrado corretamente
        if (isset($_GET['successUser'])) {
            echo '<div class="alert alert-success">Usuario cadastrado!</div>';
        }

        ?>

        <div class="container" >
            <div class="row" >
                    <h2 class="espacoCadastro">Cadastro</h2>
                    <hr>
                    <form action="#" method="post">
                    
                    <div class="centralizandoFormulario">
                        <div class="col-sm-5" class="tamanho-campoLogin">
                            <div class="form-group">
                                <label id="teste" for="login" style="">Login</label>
                                <input type="text" class="form-control" id="login" name="login" required autofocus>
                            </div>
                        </div>

                        <div class="col-sm-5" class="tamanho-campoNome">
                            <div class="form-group ">
                                <label for="nome">Nome: </label>
                                <input id="nome" type="text" class="form-control" name="nome" required>
                            </div>
                        </div>
                        <div class="col-sm-5" class="tamanho-campoSenha">
                            <div class="campo-senha" class="form-group">
                                <label for="senha">Senha:</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>
                        </div>

                        <div class="col-sm-5" class="tamanho-campoRepita">
                            <div class="form-group">
                                <label for="rep_senha">Repita a Senha:</label>
                                <input type="password" class="form-control" id="rep_senha" name="rep_senha" required>
                            </div>
                        </div>

                        <div class="col-sm-5" class="tamanho-campocpf">
                            <div class="form-group" class="form-horizontal">
                                <label for="cpf">CPF:</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11">
                            </div>
                        </div>

                        <div class="col-sm-5" class="tamanho-campoEmail">
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">@</div>
                                <input type="text" class="form-control" id="email" name="email" required>
                                
                            </div>
                        </div>
                        </div>
                        <div class="col-sm-5">
                        <button  type="submit" class="btn btn-primary" name="cadastrar">Cadastrar</button>
                        </div>
                    </form>
                    <hr>
                    
                    <div class="col-sm-5">
                    <a class="btn btn-primary" href="index.php">Voltar</a>
                 </div>
                    
            </div>
        </div>
    </div>
            <script>
                setTimeout(function () {
                    $('.alert').fadeOut();
                }, 3000);

            </script>
    </body>
</div>

</html>
