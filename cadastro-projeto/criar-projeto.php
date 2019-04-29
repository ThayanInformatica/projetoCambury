<?php

session_start();
if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])):
    header('location: ../index.php');
endif;

if (isset($_SESSION['login']) && isset($_SESSION['senha']) && isset($_SESSION['nivel'])):
    if (isset($_SESSION['nivel'])) {
        $nivel = $_SESSION['nivel'];
        if ($nivel != 0) {
            header('location: ../usuario-logado.php');
        }
    }

endif;


if (isset($_POST['cadastrar'])) {
    include('../classes/Conexao.class.php');
    include('../classes/ProjetoDAO.class.php');

    $cadastrar = new ProjetoDAO();

    $codUsuario = $_SESSION['codUsuario'];
    $nomeProjeto = trim(strip_tags($_POST['nomeProjeto']));
    $nomeProfessor = trim(strip_tags($_POST['nomeProfessor']));
    $objetivoProjeto = trim(strip_tags($_POST['objetivoProjeto']));
    $resumoProjeto = trim(strip_tags($_POST['resumoProjeto']));
    $cursoProjeto = trim(strip_tags($_POST['cursoProjeto']));
    $turmaProjeto = trim(strip_tags($_POST['turmaProjeto']));


    if (isset($codUsuario)) {
        $consulta = $cadastrar->unicoProjeto($nomeProjeto);
        if ($consulta == false) {
            header('location:criar-projeto.php?error=naoReconheceId');
        } else {
            $insere = $cadastrar->cadastra($codUsuario, $nomeProjeto, $nomeProfessor, $objetivoProjeto, $resumoProjeto, $cursoProjeto, $turmaProjeto);
            if ($insere == true) {
                header('location:../usuario-logado.php?successprojeto=cadastrado');
            }
        }

    } else {
        header('location:criar-projeto.php?erro');
    }

}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <title>Cambury | Cadastro de Projeto</title>

    <link rel="stylesheet" href="../components/css/header.css"/>
    <link rel="stylesheet" href="../components/css/footer.css"/>
    <link rel="stylesheet" href="assets/css/cssCadastroProjeto.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="components/css/header.css"/>
    <link rel="stylesheet" href="components/css/footer.css"/>
    <script>
        $(function () {
            $("#header").load("../components/header.php");
        });
    </script>
    <script>
        $(function () {
            $("#footer").load("../components/footer.php");
        });
    </script>


</head>


    <div id="header"></div>
<body>


<div class="container">
    <?php
    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger">Algo aconteceu de errado ao criar, tente novamente!</div>';
    }
    if (isset($_GET['erro'])) {
        echo '<div class="alert alert-danger">Tente novamente mais tarde</div>';
    }
    if (isset($_GET['successprojeto'])) {
        echo '<div class="alert alert-success">Projeto cadastrado!</div>';
    }

    ?>


    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Cadastro de Projeto </h3>
            </div>
            <div class="card-body">

                <form action="#" method="post">
                    <div class="campoProjeto" class="control-group">
                        <label class="control-label">Nome do Projeto:</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="nomeProjeto" type="text"
                                   placeholder="Digite o nome do projeto" required=""
                            >
                        </div>
                    </div>

                    <div class="campoOrientador" class="control-group">
                        <label class="control-label">Prof° Orientador:</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="nomeProfessor" type="text"
                                   placeholder="Digite o nome do Orientador" required=""
                            >
                        </div>
                    </div>
            </div>

            <div class="editandoObjetivo" class="control-group>
                <label class=" control-label
            ">Objetivo do Projeto</label>
            <div class="controls">
                            <textarea size="35" class="form-control" name="objetivoProjeto" type="text" required=""
                            > </textarea>
            </div>
        </div>

        <div class="editandoResumo" class="control-group>
            <label class=" control-label
        ">Resumo do Projeto</label>
        <div class="controls">
                            <textarea size="40" class="form-control" name="resumoProjeto" type="text" required=""
                            ></textarea>
        </div>
    </div>


    <div class="col-sm-3">
        <label>Curso</label>
        <select class="form-control" name="cursoProjeto">
            <option value="TI">GESTÃO DA TECNOLOGIA DA INFORMAÇÃO</option>
            <option value="CIÊNCIAS CONTÁBEIS">CIÊNCIAS CONTÁBEIS</option>
            <option value="ADMINISTRAÇÃO">ADMINISTRAÇÃO</option>
            <option value="ESTÉTICA E COSMÉTIC">ESTÉTICA E COSMÉTICA</option>
            <option value="MARKETING">MARKETING</option>
            <option value="TECNOLOGIA EM PROCESSOS GERENCIAIS">TECNOLOGIA EM PROCESSOS GERENCIAIS</option>
        </select>
    </div>

    <div class="col-sm-3">
        <label>Turma</label>
        <select class="form-control" name="turmaProjeto">
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
        </select>
    </div>

    <div class="form-actions">
        <br/>

        <button type="submit" class="btn btn-success" name="cadastrar">Adicionar</button>
        <a href="../usuario-logado.php" type="btn" class="btn btn-default">Voltar</a>

    </div>

    </form>
</div>
</div>
</div>
</div>
</div>
</body>
<div id="footer"></div>
</html>

