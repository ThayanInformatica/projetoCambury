<?php
session_start();

if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])):
    header('location: ../../index.php');
endif;

if (isset($_SESSION['login']) && isset($_SESSION['senha']) && isset($_SESSION['nivel']) && isset($_SESSION['codUsuario'])):
    if (isset($_SESSION['nivel'])) {
        $nivel = $_SESSION['nivel'];
        if ($nivel != 99) {
            header('location: ../../usuario-logado.php');
        }
    }
    $codUsuario = $_SESSION['codUsuario'];

endif;

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Administrador | Faculdades Cambury</title>

    <link rel="stylesheet" href="../../css/projeto/projetos-page.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <![endif]-->

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <!--    footer e header para páginas-->
    <link rel="stylesheet" href="../../components/css/header.css"/>
    <link rel="stylesheet" href="../../components/css/footer.css"/>
    <script>
        $(function () {
            $("#header").load("../../components/header.php");
        });
    </script>
    <script>
        $(function () {
            $("#footer").load("../../components/footer.php");
        });
    </script>
    <!--    copiar e colar isto para as demais novas paginas-->
    <link rel="stylesheet" href="../../components/css/menu-admin.css"/>
    <script>
        $(function () {
            $("#menu").load("../../components/menu-administrador-topage.php");
        });
    </script>

</head>
<body>
<div id="header"></div>
<div id="menu"></div>

<div class="container">
    </br>

<!--    <div class="btn-group">-->
<!--        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"-->
<!--                aria-expanded="false">-->
<!--            Menu <span class="caret"></span>-->
<!--        </button>-->
<!--        <ul class="dropdown-menu">-->
<!--            --><?php //echo '<li><a href="editar-perfil.php?codUsuario=' . $codUsuario . '">Editar Perfil</a></li>' ?>
<!--            <li><a href="#"></a></li>-->
<!--            <li><a href="listar-usuario.php">Listar usuarios</a></li>-->
<!--            <li role="separator" class="divider"></li>-->
<!--            <li><a href="#">Separated link</a></li>-->
<!--        </ul>-->
<!--    </div>-->

    <div class="row">
        <!--        <p>-->
        <!--            --><?php //if ($_SESSION['nivel'] == 99) {
        //                echo '<a href="cadastro-projeto/criar-projeto.php" class="btn btn-success">Aceitar Avaliador</a>';
        //            }
        //            ?>
        <!---->
        <?php

        include('../../classes/Conexao.class.php');
        include('../../classes/ProjetoDAO.class.php');
        include('../../classes/UsuarioDAO.class.php');

        $usuario = new UsuarioDAO();
        $usuarioProjeto = new ProjetoDAO();

        $login = $_SESSION['login'];

        $codUsuario = $usuario->CodDoUsuario($login);
        $_SESSION['codUsuario'] = $codUsuario;
        ?>
        <!---->
        <!--        </p>-->

        <table class="table table-striped">
            <h2>Adicionar Avaliador</h2>
            <thead>
            <tr>
                <th scope="col">Nome do Usuário</th>
                <th scope="col">CPF</th>
                <th scope="col">Email</th>
                <th scope="col">Ação / Função</th>
            </tr>
            </thead>
            <tbody>
            <?php

            include '../../classes/conectdb.php';
            $pdo = conectdb::conectar();
            $sql = 'SELECT codUsuario,nomeUsuario,cpfUsuario,emailUsuario,nivelUsuario,avaliador from tb_usuario where nivelUsuario <= 0 ORDER BY nivelUsuario DESC ';

            foreach ($pdo->query($sql) as $getUsuarios) {
                echo '<tr>';
                echo '<td  style="display: none;">' . $getUsuarios['codUsuario'] . '</td>'; // get id do usuario
                echo '<td >' . $getUsuarios['nomeUsuario'] . '</td>';
                echo '<td>' . $getUsuarios['cpfUsuario'] . '</td>';
                echo '<td>' . $getUsuarios['emailUsuario'] . '</td>';
                echo '<td width=350>';
                echo ' ';
                if ($getUsuarios['avaliador'] == 0) {
                    echo '<a class="btn btn-success" href="aceitar-avaliador.php?codUsuario=' . $getUsuarios['codUsuario'] . '">Aceitar como Avaliador</a>';
                    echo ' ';
                }
                if ($getUsuarios['avaliador'] == 1) {
                    echo '<span class="alert alert-success glyphicon glyphicon-ok" role="alert" data-toggle="tooltip">Avaliador</span>';
                    echo ' ';
                }
                if ($getUsuarios['avaliador'] == 1) {
                    echo '<a class="btn btn-danger" href="desativar-avaliador.php?codUsuario=' . $getUsuarios['codUsuario'] . '">Desativar Avaliador</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                if ($getUsuarios['avaliador'] == 0) {
                    echo '<span class="alert alert-danger glyphicon glyphicon-remove" role="alert" data-toggle="tooltip">Orientador</span>';
                    echo ' ';
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
