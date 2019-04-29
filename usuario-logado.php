<?php
session_start();

if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])):
    header('location: index.php');
endif;

if (isset($_SESSION['login']) && isset($_SESSION['senha']) && isset($_SESSION['nivel']) && isset($_SESSION['codUsuario'])):
    if (isset($_SESSION['nivel'])) {
        $nivel = $_SESSION['nivel'];
        if ($nivel != 0) {
            header('location: index.php');
        }
    }
    $codUsuario = $_SESSION['codUsuario'];

endif;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Cambury | PCA</title>

    <link rel="stylesheet" href="css/projeto/projetos-page.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <!--    footer e header para páginas-->
    <link rel="stylesheet" href="components/css/header.css"/>
    <link rel="stylesheet" href="components/css/footer.css"/>
    <script>
        $(function () {
            $("#header").load("components/header.php");
        });
    </script>
    <script>
        $(function () {
            $("#footer").load("components/footer.php");
        });
    </script>
    <!--    copiar e colar isto para as demais novas paginas-->

</head>

<body>
<div id="header"></div>

<div class="container">
    <div class="jumbotron">
        <h2>Olá <?php echo $_SESSION['login']; ?>!</h2> <br/>
        <a href="logout.php">Sair</a>
    </div>
    </br>

    <div class="btn-group" style="float: right;">
        <button  type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
            Menu <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <?php echo '<li><a href="funcoes-usuario/editar-usuario.php?codUsuario=' . $codUsuario . '">Editar Perfil</a></li>' ?>
<!--            <li><a href="#">Something else here</a></li>-->
<!--            <li><a href="listar-usuario.php">Listar usuarios</a></li>-->
<!--            <li role="separator" class="divider"></li>-->
<!--            <li><a href="#">Separated link</a></li>-->
        </ul>
    </div>

    <div class="row">
        <p>
            <?php if ($_SESSION['nivel'] == 0) {
                echo '<a href="cadastro-projeto/criar-projeto.php" class="btn btn-success">Adicionar Projeto</a>';
            }
            ?>

            <?php

            include('classes/Conexao.class.php');
            include('classes/ProjetoDAO.class.php');
            include('classes/UsuarioDAO.class.php');

            $usuario = new UsuarioDAO();
            $usuarioProjeto = new ProjetoDAO();

            $login = $_SESSION['login'];

            $codUsuario = $usuario->CodDoUsuario($login);
            $_SESSION['codUsuario'] = $codUsuario;

            ?>

        </p>

        <table class="table table-striped">
            <h2>Meus Projetos</h2>
            <thead>
            <tr>
                <th scope="col">Nome do Projeto</th>
                <th scope="col">Nome do Orientador</th>
                <th scope="col">Curso e Turma</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include 'classes/conectdb.php';
            $pdo = conectdb::conectar();
            $sql = 'SELECT codUsuario,codProjeto,nomeProjeto,nomeProfessor,objetivo,resumo,curso,turma,projetoAceito FROM tb_projeto ';

            foreach ($pdo->query($sql) as $getProjetos) {
                echo '<tr>';
                echo '<th scope="row">' . $getProjetos['nomeProjeto'] . '</th>';
                echo '<td>' . $getProjetos['nomeProfessor'] . '</td>';
                echo '<td>' . $getProjetos['curso'] . ' / ' . $getProjetos['turma'] . '</td>';
                echo '<td width=300>';
                echo '<a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Informações gerais do Projeto" href="funcoes-projeto/ler-projeto.php?codProjeto=' . $getProjetos['codProjeto'] . '">Info</a>';
                echo ' ';
                if ($getProjetos['projetoAceito'] == 0) {
                    echo '<a class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Após ser aceito, não poderá mais editar" href="funcoes-projeto/editar-projeto.php?codProjeto=' . $getProjetos['codProjeto'] . '">Editar</a>';
                    echo ' ';
                }
                if ($getProjetos['projetoAceito'] == 1) {
                    echo '<span class="alert alert-success" role="alert" data-toggle="tooltip">Projeto Aceito</span>';
                    echo ' ';
                }
                if ($getProjetos['projetoAceito'] == 0) {
                    echo '<a class="btn btn-danger" href="funcoes-projeto/deletar-projeto.php?codProjeto=' . $getProjetos['codProjeto'] . '">Excluir</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            conectdb::desconectar();
            ?>
            </tbody>
        </table>
    </div>
</div>
<div id="footer"></div>
</body>

</html>
