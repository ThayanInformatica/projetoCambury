<?php
session_start();

if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])):
    header('location: ../index.php');
endif;

if (isset($_SESSION['login']) && isset($_SESSION['senha']) && isset($_SESSION['nivel']) && isset($_SESSION['codUsuario'])):
    if (isset($_SESSION['nivel'])) {
        $nivel = $_SESSION['nivel'];
        if ($nivel != 99) {
            header('location: ../usuario-logado.php');
        }
    }
    $codUsuario = $_SESSION['codUsuario'];

endif;

?>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>Sidebar template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <link href="css/all.css" rel="stylesheet">

    <script>
        jQuery(function ($) {

            $(".sidebar-dropdown > a").click(function () {
                $(".sidebar-submenu").slideUp(200);
                if (
                    $(this)
                        .parent()
                        .hasClass("active")
                ) {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this)
                        .parent()
                        .removeClass("active");
                } else {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this)
                        .next(".sidebar-submenu")
                        .slideDown(200);
                    $(this)
                        .parent()
                        .addClass("active");
                }
            });

            $("#close-sidebar").click(function () {
                $(".page-wrapper").removeClass("toggled");
            });
            $("#show-sidebar").click(function () {
                $(".page-wrapper").addClass("toggled");
            });


        });
    </script>


</head>

<body>
<div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
            <div class="sidebar-brand">
                <a href="#">pro sidebar</a>
                <div id="close-sidebar">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="sidebar-header">
<!--                <div class="user-pic">-->
<!--                    <img class="img-responsive img-rounded"-->
<!--                         src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"-->
<!--                         alt="User picture">-->
<!--                </div>-->
                <div class="user-info">
          <span class="user-name">André
<!--            <strong>Smith</strong>-->
          </span>
                    <span class="user-role">Administrator</span>
                    <span class="user-status">
<!--            <i class="fa fa-circle"></i>-->
            <span>Online</span>
          </span>
                </div>
            </div>
            <!-- sidebar-header  -->
            <div class="sidebar-search">
                <div>
                    <div class="input-group">
                        <input type="text" class="form-control search-menu" placeholder="Search...">
                        <div class="input-group-append">
              <span class="input-group-text">
                <i class="fa fa-search" aria-hidden="true"></i>
              </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sidebar-search  -->
            <div class="sidebar-menu">
                <ul>
                    <li class="header-menu">
                        <span>General</span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                            <span class="badge badge-pill badge-warning">New</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="#">Dashboard 1
                                        <span class="badge badge-pill badge-success">Pro</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Dashboard 2</a>
                                </li>
                                <li>
                                    <a href="#">Dashboard 3</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span>E-commerce</span>
                            <span class="badge badge-pill badge-danger">3</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="#">Products

                                    </a>
                                </li>
                                <li>
                                    <a href="#">Orders</a>
                                </li>
                                <li>
                                    <a href="#">Credit cart</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="far fa-gem"></i>
                            <span>Components</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="#">General</a>
                                </li>
                                <li>
                                    <a href="#">Panels</a>
                                </li>
                                <li>
                                    <a href="#">Tables</a>
                                </li>
                                <li>
                                    <a href="#">Icons</a>
                                </li>
                                <li>
                                    <a href="#">Forms</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-chart-line"></i>
                            <span>Charts</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="#">Pie chart</a>
                                </li>
                                <li>
                                    <a href="#">Line chart</a>
                                </li>
                                <li>
                                    <a href="#">Bar chart</a>
                                </li>
                                <li>
                                    <a href="#">Histogram</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-globe"></i>
                            <span>Maps</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="#">Google maps</a>
                                </li>
                                <li>
                                    <a href="#">Open street map</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="header-menu">
                        <span>Extra</span>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span>Documentation</span>
                            <span class="badge badge-pill badge-primary">Beta</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-calendar"></i>
                            <span>Calendar</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-folder"></i>
                            <span>Examples</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- sidebar-menu  -->
        </div>
        <!-- sidebar-content  -->
<!--        <div class="sidebar-footer">-->
<!--            <a href="#">-->
<!--                <i class="fa fa-bell"></i>-->
<!--                <span class="badge badge-pill badge-warning notification">3</span>-->
<!--            </a>-->
<!--            <a href="#">-->
<!--                <i class="fa fa-envelope"></i>-->
<!--                <span class="badge badge-pill badge-success notification">7</span>-->
<!--            </a>-->
<!--            <a href="#">-->
<!--                <i class="fa fa-cog"></i>-->
<!--                <span class="badge-sonar"></span>-->
<!--            </a>-->
<!--            <a href="#">-->
<!--                <i class="fa fa-power-off"></i>-->
<!--            </a>-->
<!--        </div>-->
    </nav>
    <!-- sidebar-wrapper  -->
    <main class="page-content">
        <div class="container">
            </br>
            <div class="row">
                <!--        <p>-->
                <!--            --><?php //if ($_SESSION['nivel'] == 99) {
                //                echo '<a href="cadastro-projeto/criar-projeto.php" class="btn btn-success">Aceitar Avaliador</a>';
                //            }
                //            ?>
                <!---->
                <?php

                include('../classes/Conexao.class.php');
                include('../classes/ProjetoDAO.class.php');
                include('../classes/UsuarioDAO.class.php');

                $usuario = new UsuarioDAO();
                $usuarioProjeto = new ProjetoDAO();

                $login = $_SESSION['login'];

                $codUsuario = $usuario->CodDoUsuario($login);
                $_SESSION['codUsuario'] = $codUsuario;

                // Pegar ID de projetos de usuários

                $codProjeto = $usuario->recuperarProjetos($codUsuario);

                ?>
                <!---->
                <!--        </p>-->


                <table class="table table-striped">
                    <h2 style="text-align: center;">Lista de Projetos</h2>
                    <thead>
                    <?php
                    if (isset($codProjeto)) {

                        ?>
                        <tr>
                            <th scope="col">Nome do Projeto</th>
                            <th scope="col">Nome do Orientador</th>
                            <th scope="col">Curso e Turma</th>
                            <th scope="col">Ações</th>
                        </tr>
                        <?php
                    }
                    ?>
                    </thead>
                    <tbody>

                    <?php

                    include '../classes/conectdb.php';
                    $pdo = conectdb::conectar();
                    $sql = 'SELECT codUsuario,codProjeto,nomeProjeto,nomeProfessor,objetivo,resumo,curso,turma,projetoAceito FROM tb_projeto ORDER BY projetoAceito DESC ';

                    foreach ($pdo->query($sql) as $getProjetos) {
                        if (isset($codProjeto)) {
                            echo '<tr class="projetos-admin">';
                            echo '<td  style="display: none;">' . $getProjetos['codProjeto'] . '</td>'; // get id do projeto deixar com display none
                            echo '<td >' . $getProjetos['nomeProjeto'] . '</td>';
                            echo '<td>' . $getProjetos['nomeProfessor'] . '</td>';
                            echo '<td>' . $getProjetos['curso'] . ' / ' . $getProjetos['turma'] . '</td>';
                            echo '<td width=350>';
                            echo '<a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Informações do Projeto" href="projeto-admin/ler-projeto.php?codProjeto=' . $getProjetos['codProjeto'] . '">Info</a>';
                            echo ' ';
                            if ($_SESSION['nivel'] == 100) { // RN: Administrador não pode editar projeto
                                echo '<a class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Após ser aceito, não poderá mais editar" href="editar.php?id=' . $getProjetos['codProjeto'] . '">Editar</a>';
                                echo ' ';
                            }
                            if ($_SESSION['nivel'] == 99 && $getProjetos['projetoAceito'] == 1) {
                                echo '<span class="alert alert-success glyphicon glyphicon-ok" role="alert" data-toggle="tooltip">Aceito</span>';
                                echo ' ';
                            }
                            if ($_SESSION['nivel'] == 99 && $getProjetos['projetoAceito'] == 0) {
                                echo '<a class="btn btn-success" href="projeto-admin/aprovar.php?codProjeto=' . $getProjetos['codProjeto'] . '">Aceitar Projeto</a>';
                                echo ' ';
                            }
                            if ($_SESSION['nivel'] == 99 && $getProjetos['projetoAceito'] == 0) {
                                echo '<span class="glyphicon glyphicon-remove alert alert-danger  " role="alert" data-toggle="tooltip">Desaprovado</span>';
                                echo ' ';
                            }
                            if ($_SESSION['nivel'] == 99 && $getProjetos['projetoAceito'] == 1) {
                                echo '<a class="btn btn-danger" href="projeto-admin/desaprovar.php?codProjeto=' . $getProjetos['codProjeto'] . '">Desaprovar Projeto</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                    }

                    if (!isset($codProjeto)) {
                        echo '<div class="jumbotron">';
                        echo '<h2>Não existe projeto</h2>';
                    }
                    conectdb::desconectar();
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>