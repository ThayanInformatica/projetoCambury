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

        $codUsuario = $_SESSION['codUsuario'];
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
    <title>Bem-Vindo | Faculdades Cambury</title>
    <script src="https://kit.fontawesome.com/2a0a6ae899.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <link href="administrador/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="css/style.css">
    <link href="components/css/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Marcellus+SC|Prompt|Rufina" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
    <link rel="icon" href="https://cambury.br/wp-content/themes/cambury/favicon.png" type="image/ico"/>

    <script>
        $(function () {
            $("#footer").load("components/footer.php");
        });
    </script>

</head>

<body>
<div style="font-family: 'Questrial', sans-serif;   ">
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
                    <!--                    <div class="user-pic">-->
                    <!--                        <img class="img-responsive img-rounded"-->
                    <!--                             src="../../images/User.png"-->
                    <!--                             alt="User picture">-->
                    <!--                    </div>-->
                    <div class="user-info">
          <span class="user-name"><?php echo $_SESSION['login'] ?>
              <!--            <strong>Smith</strong>-->
          </span>
                        <!--                        <span class="user-role">Administrator</span>-->
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
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a <?php echo 'href="funcoes-usuario/editar-usuario.php?codUsuario=' . $codUsuario . '"' ?> >Editar
                                            Perfil
                                            <!--                                            <span class="badge badge-pill badge-success">Pro</span>-->
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
                        <!--                        <li class="sidebar-dropdown">-->
                        <!--                            <a href="#">-->
                        <!--                                <i class="fa fa-shopping-cart"></i>-->
                        <!--                                <span>Usuários</span>-->
                        <!--                            <span class="badge badge-pill badge-danger">3</span>-->
                        <!--                            </a>-->
                        <!--                            <div class="sidebar-submenu">-->
                        <!--                                <ul>-->
                        <!--                                    <li>-->
                        <!--                                        <a href="listar-usuario.php">Listar Usuários-->
                        <!---->
                        <!--                                        </a>-->
                        <!--                                </li>-->
                        <!--                                <li>-->
                        <!--                                    <a href="#">Orders</a>-->
                        <!--                                </li>-->
                        <!--                                <li>-->
                        <!--                                    <a href="#">Credit cart</a>-->
                        <!--                                </li>-->
                        <!--                                </ul>-->
                        <!--                            </div>-->
                        <!--                        </li>-->
                        <!--                        <li class="sidebar-dropdown">-->
                        <!--                            <a href="#">-->
                        <!--                                <i class="far fa-gem"></i>-->
                        <!--                                <span>Avaliadores</span>-->
                        <!--                            </a>-->
                        <!--                            <div class="sidebar-submenu">-->
                        <!--                                <ul>-->
                        <!--                                    <li>-->
                        <!--                                        <a href="../usuario-avaliador/validar-usuario-avaliador.php">Aceitar Avaliador</a>-->
                        <!--                                    </li>-->
                        <!--                                    <li>-->
                        <!--                                        <a href="../usuario-avaliador/listar-avaliadores.php">Listar Avaliadores</a>-->
                        <!--                                    </li>-->
                        <!--                                <li>-->
                        <!--                                    <a href="#">Tables</a>-->
                        <!--                                </li>-->
                        <!--                                <li>-->
                        <!--                                    <a href="#">Icons</a>-->
                        <!--                                </li>-->
                        <!--                                <li>-->
                        <!--                                    <a href="#">Forms</a>-->
                        <!--                                </li>-->
                        <!--                                </ul>-->
                        <!--                            </div>-->
                        <!--                        </li>-->
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
                <a href="logout.php">Deslogar
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

        <main class="page-content">
            <div class="container">
                <br class="row">
                <?php
                if (isset($_GET['successprojeto'])) {
                    echo '<div class="alert alert-success">Projeto cadastrado!</div>';
                }

                if (isset($_GET['avaliado'])) {
                    echo '<div class="alert alert-success">Projeto Avaliado com Sucesso!</div>';
                }

                ?>

                <span>
                    <?php

                    include('classes/Conexao.class.php');
                    include('classes/ProjetoDAO.class.php');
                    include('classes/UsuarioDAO.class.php');

                    $usuario = new UsuarioDAO();
                    $usuarioProjeto = new ProjetoDAO();

                    $login = $_SESSION['login'];

                    $codUsuario = $usuario->CodDoUsuario($login);
                    $_SESSION['codUsuario'] = $codUsuario;

                    $avaliadorOK = $usuario->recuperarUsuarioAvaliador($codUsuario);
                    $_SESSION['avaliador'] = $avaliadorOK;

                    ?>

                    <div class="btn-resposivo-projeto">
                    <?php if ($_SESSION['nivel'] == 0 && $avaliadorOK < 2) {
                        echo '<a href="cadastro-projeto/criar-projeto.php" class="btn btn-success">Adicionar Projeto</a>';
                    }
                    ?>
                        </div>
                </span>

                </br>

                <div class="projetos">
                    <?php if ($avaliadorOK <= 1) {
                        ?>
                        <h2>Meus Projetos</h2>
                    <?php }
                    ?>

                    <?php if ($avaliadorOK == 2) {
                        ?>
                        <h2>Avaliar Projetos</h2>
                    <?php }
                    ?>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr class="colunas-projetos">
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
                    $sql = 'SELECT DISTINCT
    tb_projeto.codProjeto,
    tb_projeto.codUsuario,
    tb_projeto.nomeProjeto,
    tb_projeto.nomeProfessor,
    tb_projeto.objetivo,
    tb_projeto.resumo,
    tb_projeto.curso,
    tb_projeto.turma,
    tb_projeto.projetoAceito,
    tb_avaliacao.user_avaliou
FROM
    tb_projeto
LEFT JOIN tb_avaliacao ON tb_projeto.codProjeto = tb_avaliacao.codProjeto left Join tb_usuario on tb_projeto.codUsuario = tb_usuario.codUsuario
ORDER BY
    tb_avaliacao.user_avaliou DESC , tb_projeto.projetoAceito
DESC ;';

                    // FORMULÁRIO DE PROJETO PARARA ORIENTADOR

                    foreach ($pdo->query($sql) as $getProjetos) {
                        if ($getProjetos['codUsuario'] === $codUsuario && $avaliadorOK < 2) {
                            echo '
            <tr class="projetos-admin">';
                            echo '
                <td  scope="row">' . $getProjetos['nomeProjeto'] . '</td>
                ';
                            echo '
                <td>' . $getProjetos['nomeProfessor'] . '</td>
                ';
                            echo '
                <td>' . $getProjetos['curso'] . ' / ' . $getProjetos['turma'] . '</td>
                ';
                            echo '
                <td width=200>';
                            echo '<a class="material-icons" data-toggle="tooltip" data-placement="top" title="Informações do Projeto"
                             href="funcoes-projeto/ler-projeto.php?codProjeto=' . $getProjetos['codProjeto'] . '">info</a>';
                            echo ' ';
                            if ($getProjetos['projetoAceito'] == 0) {
                                echo '<a class="material-icons" style="color: #FFCD33;  cursor: pointer;" data-toggle="tooltip" data-placement="top" role="alert" data-toggle="tooltip"
                             title="Após ser aceito, não poderá mais editar"
                             href="funcoes-projeto/editar-projeto.php?codProjeto=' . $getProjetos['codProjeto'] . '">border_color</a>';
                                echo ' ';
                            }
                            if ($getProjetos['projetoAceito'] == 1) {
                                echo '<span class="material-icons" style="color: forestgreen;  cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Aprovado" role="alert" data-toggle="tooltip">check_circle</span>';
                                echo ' ';
                            }
                            if ($getProjetos['projetoAceito'] == 1 && $getProjetos['user_avaliou'] == 1) {
                                echo '<a class="material-icons" style="color: #fd7e14;  cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Veja notas deste projeto!" role="alert" data-toggle="tooltip" href="administrador/projeto-admin/ler-projetos-com-notas.php?codProjeto=' . $getProjetos['codProjeto'] . '">event_available</a>';
                                echo ' ';
                            }
                            if ($getProjetos['projetoAceito'] == 0) {
                                echo '<a class="material-icons" style="color: #c82333;" data-toggle="tooltip" data-placement="top" title="Excluir Projeto" role="alert" data-toggle="tooltip"
                             href="funcoes-projeto/deletar-projeto.php?codProjeto=' . $getProjetos['codProjeto'] . '">delete</a>';
                                echo '
                </td>
                ';
                                echo '
            </tr>
            ';
                            }

                        }
                    }
                    //            FORMULÁRIO DE TELA PARA AVALIADOR


                    $query = 'SELECT DISTINCT tb_projeto.codProjeto,tb_projeto.nomeProjeto,tb_projeto.nomeProfessor,tb_projeto.objetivo,tb_projeto.resumo,tb_projeto.curso,tb_projeto.turma,tb_projeto.projetoAceito FROM tb_projeto where tb_projeto.projetoAceito = 1 ';
                    $q2 = $pdo->prepare($query);
                    $q2->execute(array($codUsuario));

                    foreach ($q2 as $getProjeto) {

                        $codProjeto = $getProjeto['codProjeto'];

                        $ProjetosCheck = $usuarioProjeto->aprovarValidacaoDeUser($codUsuario, $codProjeto);

                        if ($avaliadorOK == 2) {

                            echo '
            <tr class="projetos-admin">';
                            echo '
                <td scope="row" >' . $getProjeto['nomeProjeto'] . '</td>
                ';
                            echo '
                <td>' . $getProjeto['nomeProfessor'] . '</td>
                ';
                            echo '
                <td>' . $getProjeto['curso'] . ' / ' . $getProjeto['turma'] . '</td>
                ';

                            echo '
                <td width=300>';
                            if ($ProjetosCheck == false) {
                                echo '<a class="material-icons" style="color: #33B0FF;" data-toggle="tooltip" data-placement="top" title="Avaliar Projeto" href="avaliador/avaliar-projeto.php?codProjeto=' . $getProjeto['codProjeto'] . '">check_circle_outline</a>';
                            }
                            echo ' ';

                            if ($ProjetosCheck == true) {
                                echo '<span class="material-icons" style="color: #33B0FF;" data-toggle="tooltip" data-placement="top" title="Avaliado !" >check_circle</span>';
                                echo '<a class="material-icons" data-toggle="tooltip" data-placement="top" title="Informações da minha Avaliação" href="funcoes-usuario/ler-projetos-com-notas.php?codProjeto=' . $getProjeto['codProjeto'] . '">info</a>';
                            }
                        }
                    }
                    conectdb::desconectar();
                    ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>

</main>

<div>
    <!--    Ajuster img de selo apos subir para produção-->
    <div class="barra-footer" style="  margin-top: 3%;
  text-align: center;
  padding-top: 20px;
  background-color: #132d3f;
  height: 185px;
  color: #FFFFFF;
  font-family: 'Open Sans','Arial';">
        <img src="http://localhost/projeto/components/img/selos.png" alt="Selos Cambury" style="  width: 300px;
  margin: 40px 0 0 0;" class="selos_footer">
    </div>
    <div class="direitos-reservados" style="  background: black;
  text-align: center;
  height: 30px;
  color: #FFFFFF;
  font-family: 'Open Sans','Arial';">
        <h1 style="  font-weight: 500;
  margin: 0 0 0 0;
  padding-top: 8px;
  font-size: 12px;
  color: #999;">Copyright © 2019 Faculdades Cambury - Todos os direitos reservados</h1>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>


</html>
