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
<html lang="pt-br" xmlns="http://www.w3.org/1999/html">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <link rel="icon" href="https://cambury.br/wp-content/themes/cambury/favicon.png"  type="image/ico" />
    <style>
    @import url('https://fonts.googleapis.com/css?family=Questrial');
    </style>
    
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


    <div id="header">Cadastro Projeto</div>
<body>


<div class="container">
    <?php
    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger">Algo aconteceu de errado ao criar, tente novamente!</div>';
    }
    if (isset($_GET['erro'])) {
        echo '<div class="alert alert-danger">Tente novamente mais tarde</div>';
    }

    ?>

     <!-- Codigo antigo Caso houver erro -->

            <!--  <form action="#" method="post">
                    <div class="campoProjeto" class="form-group col-md-6">>
                        <label class="control-label" for="NameProjeto">Nome do Projeto:</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="nomeProjeto" type="text"
                                   placeholder="Digite o nome do projeto" required=""
                            >
                        </div>
                    </div>

                    <div class="campoOrientador" class="form-group col-md-6">
                        <label class="control-label">Prof° Orientador:</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="nomeProfessor" type="text"
                                   placeholder="Digite o nome do Orientador" required=""
                            >
                        </div>
                    </div>
            </div>-->
    


    <div clas="span10 offset1">
        <div class="card">
            
           
        <div  class="editandoCadastro"  class="container">
            <div class="row">
            </br>
            </br>

                    <div class="card-body">

                    <form action="#" method="post">
                    <div class="editandoEspacamentoProjetoOrientador"
                        
                            <div class="form-row">
                    <div  class="form-group col-md-6">
                    <label for="nomeProjeto">Nome do Projeto:</label>
                    <input name="nomeProjeto" type="text" class="form-control" id="nomeProjeto" placeholder="Digite o nome do projeto" required>
                    </div>
                    <div  class="form-group col-md-6">
                    <label for="nomeProfessor">Prof° Orientador:</label>
                    <input type="text" class="form-control" name="nomeProfessor" id="nomeProfessor" placeholder="Digite o nome do Orientador" required>
                    </div>
                </div>
                
        </div>
                    
                    <div class="editandoObjetivo" class="control-group>
                        <label class=" control-label
                    ">Objetivo do Projeto:</label>
                    <div class="controls">
                                    <textarea size="35" class="form-control"  name="objetivoProjeto" type="text" required
                                    > </textarea>
                                    
                    </div>
                </div>

                <div class="editandoResumo" class="control-group>
                    <label class=" control-label
                ">Resumo do Projeto:</label>
                <div class="controls">
                                    <textarea size="40" class="form-control" name="resumoProjeto" type="text" required
                                    ></textarea>
                </div>
            </div>

            <div class="espacamentoCursoTurma">
            <div class="col-sm-3">
                <label>Curso:</label>
                <select class="form-control" name="cursoProjeto">
                    <option value="TI">GESTÃO DA TECNOLOGIA DA INFORMAÇÃO</option>
                    <option value="C. CONTÁBEIS">CIÊNCIAS CONTÁBEIS</option>
                    <option value="ADMINISTRAÇÃO">ADMINISTRAÇÃO</option>
                    <option value="E. E COSMÉTIC">ESTÉTICA E COSMÉTICA</option>
                    <option value="MARKETING">MARKETING</option>
                    <option value="TPGS">TECNOLOGIA EM PROCESSOS GERENCIAIS</option>
                </select>
            </div>

            <div class="col-sm-3">
                <label>Turma:</label>
                <select class="form-control" name="turmaProjeto">
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                </select>
            </div>

            <div class="form-actions">
                <br/>

                <button type="submit" class="btn btn-primary" id="espacamentoAdicionar" name="cadastrar">Adicionar</button>
                <a href="../usuario-logado.php" type="btn" id="espacamentoVoltar" class="btn btn-primary" href="index.php"s>Voltar</a>
            </div>
            
            </form>
        </div>
</div>
    
    
</div>
</div>
</div>
</div>
</div>
</body>
<div id="footer"></div>
</html>

