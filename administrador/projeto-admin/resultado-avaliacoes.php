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

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

        if (window.innerWidth < 768) {
            $("#close-sidebar").init(function () {
                $(".page-wrapper").removeClass("toggled");
            });
        }

        $("#close-sidebar").click(function () {
            $(".page-wrapper").removeClass("toggled");
        });


        $("#show-sidebar").click(function () {
            $(".page-wrapper").addClass("toggled");
        });
    });

</script>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>


<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>Administrador | Cambury</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <link href="../css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="../../components/css/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Marcellus+SC|Prompt|Rufina" rel="stylesheet">

</head>

<body>
<div style="font-family: 'Rufina', serif;">
<div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#" style="height: 100% !important;">
        <i class="material-icons">
            menu
        </i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
            <div class="sidebar-brand">
                <a href="#">Cambury PCA</a>
                <div id="close-sidebar">
                    <i class="material-icons">
                        keyboard_arrow_left
                    </i>
                </div>
            </div>
            <div class="sidebar-header">
                <div class="user-pic">
                    <img class="img-responsive img-rounded"
                         src="../../images/User.png"
                         alt="User picture">
                </div>
                <div class="user-info">
          <span class="user-name">André
              <!--            <strong>Smith</strong>-->
          </span>
                    <span class="user-role">Administrator</span>
                    <span class="user-status">
            <i class="material-icons" style="color: forestgreen; background: forestgreen; border-radius: 20px;">
                        radio_button_unchecked
                        </i>
            <span>Online</span>
          </span>
                </div>
            </div>
            <!-- sidebar-header  -->
            <div class="sidebar-search">
                <div>
                    <!--                    <div class="input-group">-->
                    <!--                        <input type="text" id="searchProjeto" onkeyup="mySearch() class="form-control search-menu" placeholder="Pesquise por Projeto">-->
                    <!--                        <div class="input-group-append">-->
                    <!--              <span class="input-group-text">-->
                    <!--                <i class="fa fa-search" aria-hidden="true"></i>-->
                    <!--              </span>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                </div>
            </div>
            <!-- sidebar-search  -->
            <div class="sidebar-menu">
                <ul>
                    <li class="header-menu">
                        <span>Menu</span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-tachometer-alt"></i>
                            <span>Meu Perfil</span>
                            <span class="badge badge-pill badge-warning">Novo</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a <?php echo 'href="../editar-perfil.php?codUsuario=' . $codUsuario . '"' ?> >Editar
                                        Perfil
                                        <span class="badge badge-pill badge-success">Pro</span>
                                    </a>
                                </li>
                                <!--                                <li>-->
                                <!--                                    <a href="#">Dashboard 2</a>-->
                                <!--                                </li>-->
                                <!--                                <li>-->
                                <!--                                    <a href="#">Dashboard 3</a>-->
                                <!--                                </li>-->
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Usuários</span>
                            <!--                            <span class="badge badge-pill badge-danger">3</span>-->
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="listar-usuario.php">Listar Usuários

                                    </a>
                                    <!--                                </li>-->
                                    <!--                                <li>-->
                                    <!--                                    <a href="#">Orders</a>-->
                                    <!--                                </li>-->
                                    <!--                                <li>-->
                                    <!--                                    <a href="#">Credit cart</a>-->
                                    <!--                                </li>-->
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="far fa-gem"></i>
                            <span>Avaliadores</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="../usuario-avaliador/validar-usuario-avaliador.php">Aceitar Avaliador</a>
                                </li>
                                <li>
                                    <a href="../usuario-avaliador/listar-avaliadores.php">Listar Avaliadores</a>
                                </li>
                                <!--                                <li>-->
                                <!--                                    <a href="#">Tables</a>-->
                                <!--                                </li>-->
                                <!--                                <li>-->
                                <!--                                    <a href="#">Icons</a>-->
                                <!--                                </li>-->
                                <!--                                <li>-->
                                <!--                                    <a href="#">Forms</a>-->
                                <!--                                </li>-->
                            </ul>
                        </div>
                    </li>
                    <!--                    <li class="sidebar-dropdown">-->
                    <!--                        <a href="#">-->
                    <!--                            <i class="fa fa-chart-line"></i>-->
                    <!--                            <span>Charts</span>-->
                    <!--                        </a>-->
                    <!--                        <div class="sidebar-submenu">-->
                    <!--                            <ul>-->
                    <!--                                <li>-->
                    <!--                                    <a href="#">Pie chart</a>-->
                    <!--                                </li>-->
                    <!--                                <li>-->
                    <!--                                    <a href="#">Line chart</a>-->
                    <!--                                </li>-->
                    <!--                                <li>-->
                    <!--                                    <a href="#">Bar chart</a>-->
                    <!--                                </li>-->
                    <!--                                <li>-->
                    <!--                                    <a href="#">Histogram</a>-->
                    <!--                                </li>-->
                    <!--                            </ul>-->
                    <!--                        </div>-->
                    <!--                    </li>-->
                    <!--                    <li class="sidebar-dropdown">-->
                    <!--                        <a href="#">-->
                    <!--                            <i class="fa fa-globe"></i>-->
                    <!--                            <span>Maps</span>-->
                    <!--                        </a>-->
                    <!--                        <div class="sidebar-submenu">-->
                    <!--                            <ul>-->
                    <!--                                <li>-->
                    <!--                                    <a href="#">Google maps</a>-->
                    <!--                                </li>-->
                    <!--                                <li>-->
                    <!--                                    <a href="#">Open street map</a>-->
                    <!--                                </li>-->
                    <!--                            </ul>-->
                    <!--                        </div>-->
                    <!--                    </li>-->
                    <!--                    <li class="header-menu">-->
                    <!--                        <span>Extra</span>-->
                    <!--                    </li>-->
                    <!--                    <li>-->
                    <!--                        <a href="#">-->
                    <!--                            <i class="fa fa-book"></i>-->
                    <!--                            <span>Documentation</span>-->
                    <!--                            <span class="badge badge-pill badge-primary">Beta</span>-->
                    <!--                        </a>-->
                    <!--                    </li>-->
                    <!--                    <li>-->
                    <!--                        <a href="#">-->
                    <!--                            <i class="fa fa-calendar"></i>-->
                    <!--                            <span>Calendar</span>-->
                    <!--                        </a>-->
                    <!--                    </li>-->
                    <!--                    <li>-->
                    <!--                        <a href="#">-->
                    <!--                            <i class="fa fa-folder"></i>-->
                    <!--                            <span>Examples</span>-->
                    <!--                        </a>-->
                    <!--                    </li>-->
                    <!--                </ul>-->
            </div>
            <!-- sidebar-menu  -->
        </div>
        <!-- sidebar-content  -->
        <div class="sidebar-footer">
            <a href="../../logout.php">
                <i class="material-icons" style="color: #c82333;" data-toggle="tooltip" data-placement="top"
                   title="Deslogar" role="alert" data-toggle="tooltip">power_settings_new</i>
            </a>
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
        </div>
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

                include('../../classes/Conexao.class.php');
                include('../../classes/ProjetoDAO.class.php');
                include('../../classes/UsuarioDAO.class.php');

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
                    <h2>Lista Notas dos Projetos</h2>
                    <thead>
                    <?php
                    if (isset($codProjeto)) {

                        ?>
                        <tr>
                            <th scope="col">Nome do Projeto</th>
                            <th scope="col">Nome do Orientador</th>
                            <th scope="col">Curso e Turma</th>
                            <th scope="col">Nota Total</th>
                            <th scope="col">Ações</th>
                        </tr>
                        <?php
                    }
                    ?>
                    </thead>
                    <tbody>

                    <?php

                    include '../../classes/conectdb.php';
                    $pdo = conectdb::conectar();
                    $sql = 'SELECT DISTINCT tb_projeto.codProjeto,tb_projeto.nomeProjeto, tb_projeto.nomeProfessor, tb_projeto.curso,tb_projeto.turma,tb_projeto.projetoAceito, (SELECT (tb_avaliacao.nota_1 + tb_avaliacao.nota_2 + tb_avaliacao.nota_3 + tb_avaliacao.nota_4)) as Total FROM tb_projeto LEFT JOIN tb_avaliacao ON tb_projeto.codProjeto = tb_avaliacao.codProjeto WHERE tb_projeto.projetoAceito = 1 ORDER BY Total Desc;';

                        foreach ($pdo->query($sql) as $getProjetos) {
                        if (isset($codProjeto ) && isset($getProjetos['Total'])) {
                            echo '<tr id="filterProjeto" class="projetos-admin">';
                            echo '<td  style="display: none;">' . $getProjetos['codProjeto'] . '</td>'; // get id do projeto deixar com display none
                            echo '<td >' . $getProjetos['nomeProjeto'] . '</td>';
                            echo '<td>' . $getProjetos['nomeProfessor'] . '</td>';
                            echo '<td>' . $getProjetos['curso'] . ' / ' . $getProjetos['turma'] . '</td>';
                            echo '<td>' . $getProjetos['Total'] . '</td>';
                            echo '<td width=200>';
                            echo '<a class="material-icons" data-toggle="tooltip" data-placement="top" title="Informações do Projeto" href="ler-projetos-com-notas.php?codProjeto=' . $getProjetos['codProjeto'] . '">info</a>';
                            echo ' ';
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
            <!--            <div>-->
            <!--    Ajuster img de selo apos subir para produção-->
            <!--            </div>-->
        </div>
    </main>
</div>

    <!-- page-wrapper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

</body>
</html>