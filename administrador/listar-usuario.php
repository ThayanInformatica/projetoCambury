<?php

session_start();
if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])):
    header('location: ../index.php');
endif;

if (isset($_SESSION['login']) && isset($_SESSION['senha']) && isset($_SESSION['nivel'])):
    if (isset($_SESSION['nivel'])) {
        $nivel = $_SESSION['nivel'];
        if ($nivel != 99) {
            header('location: ../usuario-logado.php');
        }
    }

endif;

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Administrador | Faculdades Cambury</title>

    <link rel="stylesheet" href="css/admin-page.css"/>
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
    <link rel="stylesheet" href="../components/css/header.css"/>
    <link rel="stylesheet" href="../components/css/footer.css"/>
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

    <script>
        $('.dropdown-toggle').dropdown()
    </script>
    <!--    copiar e colar isto para as demais novas paginas-->

</head>
<body>
<div id="header"></div>

<div class="container">
    </br>
    <div class="row">

        <!--        <p>-->
        <!--            --><?php //if ($_SESSION['nivel'] == 99) {
        //                echo '<a href="cadastro-projeto/criar-projeto.php" class="btn btn-success">Aceitar Avaliador</a>';
        //            }
        //            ?>
        <!---->
        <!--            --><?php
        //
        //            include('../classes/Conexao.class.php');
        //            include('../classes/ProjetoDAO.class.php');
        //            include('../classes/UsuarioDAO.class.php');
        //
        //            $usuario = new UsuarioDAO();
        //            $usuarioProjeto = new ProjetoDAO();
        //
        //            $login = $_SESSION['login'];
        //
        //            $codUsuario = $usuario->CodDoUsuario($login);
        //            $_SESSION['codUsuario'] = $codUsuario;
        //            ?>
        <!---->
        <!--        </p>-->

        <table class="table table-striped">
            <h2>Lista de Usuarios</h2>
            <thead>
            <tr>
                <th scope="col">Nome do Usuário</th>
                <th scope="col">CPF</th>
                <th scope="col">Email</th>
                <th scope="col">Função</th>
            </tr>
            </thead>
            <tbody>
            <?php

            include '../classes/conectdb.php';
            $pdo = conectdb::conectar();
            $sql = 'SELECT codUsuario,nomeUsuario,cpfUsuario,emailUsuario,nivelUsuario from tb_usuario where nivelUsuario <= 50 ORDER BY nivelUsuario DESC ';

            foreach ($pdo->query($sql) as $getUsuarios) {
                echo '<tr>';
                echo '<td  style="display: none;">' . $getUsuarios['codUsuario'] . '</td>'; // get id do usuario
                echo '<td >' . $getUsuarios['nomeUsuario'] . '</td>';
                echo '<td>' . $getUsuarios['cpfUsuario'] . '</td>';
                echo '<td>' . $getUsuarios['emailUsuario'] . '</td>';
                if ($getUsuarios['nivelUsuario'] == 0) {
                    echo '<td>Orientador</td>';
                }
                if ($getUsuarios['nivelUsuario'] > 0) {
                    echo '<td>Avaliador</td>';
                }

                echo '<td width=350>';
//                echo '<a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Informações do Projeto" href="ler-projeto.php?codProjeto=' . $getProjetos['codProjeto'] . '">Info</a>';
//                echo ' ';
//                if ($_SESSION['nivel'] == 99 && $getProjetos['projetoAceito'] == 0) {
//                    echo '<a class="btn btn-success" href="aprovar.php?codProjeto=' . $getProjetos['codProjeto'] . '">Aceitar Projeto</a>';
//                    echo ' ';
//                }
//                if ($_SESSION['nivel'] == 99 && $getProjetos['projetoAceito'] == 0) {
//                    echo '<span class="alert alert-danger" role="alert" data-toggle="tooltip">Projeto Desaprovado</span>';
//                    echo ' ';
//                }
//                if ($_SESSION['nivel'] == 99 && $getProjetos['projetoAceito'] == 1) {
//                    echo '<a class="btn btn-danger" href="desaprovar.php?codProjeto=' . $getProjetos['codProjeto'] . '">Desaprovar Projeto</a>';
//                    echo '</td>';
//                    echo '</tr>';
//                }
            }
            conectdb::desconectar();
            ?>
            </tbody>
        </table>
        <a href="admin.php" type="btn" class="btn btn-default">Voltar</a>
    </div>
</div>
<div id="footer"></div>
</body>

</html>
