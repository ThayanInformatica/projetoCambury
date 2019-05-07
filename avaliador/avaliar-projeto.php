<?php

session_start();

if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])):
    header('location: ../index.php');
endif;

if (isset($_SESSION['login']) && isset($_SESSION['senha']) && isset($_SESSION['avaliador']) && isset($_SESSION['codUsuario'])):
    if (isset($_SESSION['avaliador'])) {
        $avaliador = $_SESSION['avaliador'];
        if ($avaliador != 2) {
            header('location: ../usuario-logado.php');
        }
    }

    $codUsuario = $_SESSION['codUsuario'];

endif;

require '../classes/conectdb.php';

if (!empty($_GET['codProjeto'])) {
    $codProjeto = $_REQUEST['codProjeto'];
}

if (null == $codUsuario) {
    header("Location: ../usuario-logado.php");
}

if (!empty($_POST)) {

    $nota1Erro = null;
    $nota2Erro = null;
    $nota3Erro = null;
    $nota4Erro = null;

    $nota1 = trim(strip_tags($_POST['nota1'])); // atribui login à variavel, com funções contra sql inject
    $nota2 = trim(strip_tags($_POST['nota2'])); // atribui login à variavel, com funções contra sql inject
    $nota3 = trim(strip_tags($_POST['nota3'])); // atribui login à variavel, com funções contra sql inject
    $nota4 = trim(strip_tags($_POST['nota4'])); // atribui login à variavel, com funções contra sql inject

    //Validação
    $validacao = true;

    if (empty($nota1)) {
        $nota1Erro = 'Por favor insira a nota!';
        $validacao = false;
    }

    if (empty($nota2)) {
        $nota2Erro = 'Por favor insira a nota!';
        $validacao = false;
    }

    if (empty($nota3)) {
        $nota3Erro = 'Por favor insira a nota!';
        $validacao = false;
    }

    if (empty($nota4)) {
        $nota4Erro = 'Por favor insira a nota!';
        $validacao = false;
    }


    if ($validacao) {
        $pdo = conectdb::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO tb_avaliacao (codProjeto,codUsuario,nota_1,nota_2,nota_3,nota_4,user_avaliou) values (?,?,?,?,?,?,1)";
        $q = $pdo->prepare($sql);
        $q->execute(array($codProjeto, $codUsuario, $nota1, $nota2, $nota3, $nota4));
        conectdb::desconectar();
        header("Location: ../usuario-logado.php");
    }
}

if (null == $codProjeto) {
    header("Location: ../usuario-logado.php");
} elseif (null == $_SESSION['login']) {
    header("Location: ../index.php");
} else {
    $pdo = conectdb::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM tb_projeto where codProjeto = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($codProjeto));
    $projeto = $q->fetch(PDO::FETCH_ASSOC);
    conectdb::desconectar();
}
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
    function alteraPonto(valorInput) {
        $(valorInput).val(valorInput.val().replace(",", "."));
    }
</script>

<script>
    function maxValor(valorInput) {
        $(valorInput).on('keyup', function (event) {
            const valorMaximo = 10;
            if (event.target.value > valorMaximo)
                return event.target.value = valorMaximo;
        });
    }
</script>

<!--<script>-->
<!--minValor($(this));-->
<!--    function minValor(valorInputMin) {-->
<!--        $(valorInputMin).on('keyup', function (event) {-->
<!--            const valorMinimo = 0;-->
<!--            if (event.target.value < valorMinimo)-->
<!--                return event.target.value = valorMinimo;-->
<!--        });-->
<!--    }-->
<!--</script>-->

<script>
    function somenteNumeros(obj, e) {
        var tecla = (window.event) ? e.keyCode : e.which;
        if (tecla == 8 || tecla == 0)
            return true;
        if (tecla != 44 && tecla != 46 && tecla < 48 || tecla > 57)
            return false;
    }

</script>

<script>
    $(document).ready(function () { //Função para que o script comece quando a página carregar
        $('html, body').animate({
            scrollTop: $('#avaliar').offset().top
        }, 'slow');
    });
</script>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    $(function () {
        $("#footer").load("../components/footer.php");
    });
</script>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>Bem-Vindo | Faculdades Cambury</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <link href="../administrador/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Marcellus+SC|Prompt|Rufina" rel="stylesheet">
    <link href="../components/css/footer.css">

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
                                <span class="badge badge-pill badge-warning">Novo</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a <?php echo 'href="../funcoes-usuario/editar-usuario.php?codUsuario=' . $codUsuario . '"' ?> >Editar
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
                <a href="../logout.php">
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
            <div class="container" style="padding-bottom: 0px !important;">

                <div class="container">
                    <div class="span10 offset1">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="well" style="font-weight: bold" id="info">Informações do Projeto</h3>
                            </div>
                            <div class="container">
                                <div class="form-horizontal">
                                    <div class="control-group">
                                        <label class="control-label" style="font-weight: bold">Nome do Projeto</label>
                                        <div class="controls">
                                            <label class="carousel-inner">
                                                <?php echo $projeto['nomeProjeto']; ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" style="font-weight: bold">Nome do
                                            Orientador</label>
                                        <div class="controls">
                                            <label class="carousel-inner">
                                                <?php echo $projeto['nomeProfessor']; ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" style="font-weight: bold">Objetivo do
                                            Projeto</label>
                                        <div class="controls">
                                            <label class="carousel-inner">
                                                <?php echo $projeto['objetivo']; ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" style="font-weight: bold">Resumo do Projeto</label>
                                        <div class="controls">
                                            <label class="carousel-inner">
                                                <?php echo $projeto['resumo']; ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" style="font-weight: bold">Curso e Turma</label>
                                        <div class="controls">
                                            <label class="carousel-inner">
                                                <?php echo $projeto['curso']; ?> / <?php echo $projeto['turma']; ?>
                                            </label>
                                        </div>
                                    </div>
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </br>
                </br>
                <div class="span10 offset1" id="avaliar">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="well" style="font-weight: bold"> Avaliar notas deste Projeto </h3>
                        </div>
                        <div class="card-body">

                            <form class="form-horizontal" action="#"
                                  method="post">

                                <div class="control-group <?php echo !empty($nota1) ? 'error' : ''; ?>">
                                    <label class="control-label" style="font-weight: bold">Contribuição do projeto para
                                        instituições envolvidas e/ou sociedade
                                    </label>
                                    <div class="controls">
                                        <input
                                                onkeyup="maxValor($(this));" onchange="alteraPonto($(this));"
                                                pattern="[0-9]+([,\.][0-9]+)?"
                                                onkeypress="return somenteNumeros( this , event ) ;" name="nota1"
                                                ng-model="numero.valor"
                                                class="form-control" size="10" type="text"
                                                placeholder="Ex: 9.6"
                                                value="<?php echo !empty($nota1) ? $nota1 : ''; ?>" maxlength="3"
                                                minlength="0"
                                                required>
                                        <?php if (!empty($nota1Erro)): ?>
                                            <br/>
                                            <div class="alert alert-danger"><?php echo $nota1Erro; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="control-group <?php echo !empty($nota2) ? 'error' : ''; ?>">
                                    <label class="control-label" style="font-weight: bold">Ambientação e exposição do
                                        projeto
                                    </label>
                                    <div class="controls">
                                        <input onkeyup="maxValor($(this))" onchange="alteraPonto($(this));"
                                               pattern="[0-9]+([,\.][0-9]+)?"
                                               onkeypress="return somenteNumeros( this , event ) ;" name="nota2"
                                               class="form-control" size="40" type="text"
                                               placeholder="Ex: 10"
                                               value="<?php echo !empty($nota2) ? $nota2 : ''; ?>" maxlength="3" min="0"
                                               required>
                                        <?php if (!empty($nota2Erro)): ?>
                                            <br/>
                                            <div class="alert alert-danger"><?php echo $nota2Erro; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="control-group <?php echo !empty($nota3) ? 'error' : ''; ?>">
                                    <label class="control-label" style="font-weight: bold">Domínio nas explicações e
                                        dinâmica do projeto
                                    </label>
                                    <div class="controls">
                                        <input
                                                onkeyup="maxValor($(this));" onchange="alteraPonto($(this));"
                                                pattern="[0-9]+([,\.][0-9]+)?"
                                                onkeypress="return somenteNumeros( this , event ) ;" name="nota3"
                                                class="form-control" size="40" type="text"
                                                placeholder="Ex: 1.2"
                                                value="<?php echo !empty($nota3) ? $nota3 : ''; ?>" maxlength="3"
                                                min="0"
                                                required>
                                        <?php if (!empty($nota3Erro)): ?>
                                            <br/>
                                            <div class="alert alert-danger"><?php echo $nota3Erro; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="control-group <?php echo !empty($nota4) ? 'error' : ''; ?>">
                                    <label class="control-label" style="font-weight: bold">Resultados obtidos com o
                                        projeto
                                    </label>
                                    <div class="controls">
                                        <input
                                                onkeyup="maxValor($(this));" onchange="alteraPonto($(this));"
                                                pattern="[0-9]+([,\.][0-9]+)?"
                                                onkeypress="return somenteNumeros( this , event ) ;" name="nota4"
                                                class="form-control" size="40" type="text"
                                                placeholder="Ex: 5.9"
                                                value="<?php echo !empty($nota4) ? $nota4 : ''; ?>" maxlength="3"
                                                min="0"
                                                required>
                                        <?php if (!empty($nota4Erro)): ?>
                                            <br/>
                                            <div class="alert alert-danger"><?php echo $nota4Erro; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <br/>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Avaliar o Projeto</button>
                                    <a href="../usuario-logado.php" type="btn" class="btn btn-default">Voltar</a>
                                </div>

                                </br>
                                </br>
                            </form>
                            <a href="#info">
                                <i id="arrow" data-toggle="tooltip" data-placement="top"
                                   title="Veja Informações do Projeto" class="material-icons"
                                   style="position:relative; font-size: 50px; cursor: pointer; color: #0d95e8">
                                    keyboard_arrow_up
                                </i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </main>
        <script>
            $(document).ready(function () {
                $("a").on('click', function (event) {

                    if (this.hash !== "") {
                        event.preventDefault();

                        var hash = this.hash;
                        $('html, body').animate({
                            scrollTop: $(hash).offset().top
                        }, 600, function () {

                            window.location.hash = hash;
                        });
                    } // End if
                });
            });
        </script>
        <script>

            $(document).ready(function () {

                const arrowAnimado = function () {
                    $("#arrow").animate({"top": "+=10px"}, 500);
                    $("#arrow").animate({"top": "-=10"}, 500);
                    arrowAnimado();
                }
                arrowAnimado();
            });

            // $( "#arrow").animate({ "top": "+=10px" }, "slow");
        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>


</body>

<div>
    <!--    Ajuster img de selo apos subir para produção-->
    <div class="barra-footer" style="  margin-top: 0%;
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

</html>
