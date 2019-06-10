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

require '../classes/conectdb.php';
$codProjeto = null;
if (!empty($_GET['codProjeto'])) {
    $codProjeto = $_REQUEST['codProjeto'];
}

if (null == $codProjeto) {
    header("Location: usuario-logado.php");
} elseif (null == $_SESSION['login']) {
    header("Location: index.php");
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

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <title>Informações do Projeto | Faculdades Cambury</title>

    <link rel="stylesheet" href="../css/projeto/projetos-page.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!--    footer e header para páginas-->
    <link rel="stylesheet" href="../components/css/header.css"/>
    <link rel="stylesheet" href="../components/css/footer.css"/>
    <link rel="icon" href="https://cambury.br/wp-content/themes/cambury/favicon.png"  type="image/ico" />
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
    <!--    copiar e colar isto para as demais novas paginas-->

    <style>
    @import url('https://fonts.googleapis.com/css?family=Questrial');
    </style>

</head>

<body>
<div id="header"></div>

<div class="container">
    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="editandoTitulo">Informações do Projeto</h3>
            </div>
            <div class="container">
                <div class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">Nome do Projeto</label>
                        <div class="controls">
                            <span style="font-weight: 200;" class="carousel-inner">
                                <?php echo $projeto['nomeProjeto']; ?>
                            </span>
                        </div>
                    </div>
                    </br>

                    <div class="control-group">
                        <label class="control-label">Nome do Orientador</label>
                        <div class="controls">
                            <span style="font-weight: 200;" class="carousel-inner">
                                <?php echo $projeto['nomeProfessor']; ?>
                            </span>
                        </div>
                    </div>
                    </br>


                    <div class="control-group">
                        <label class="control-label">Objetivo do Projeto</label>
                        <div class="controls">
                            <span style="font-weight: 200;" class="carousel-inner">
                                <?php echo $projeto['objetivo']; ?>
                            </span>
                        </div>
                    </div>
                    </br>

                    <div class="control-group">
                        <label class="control-label">Resumo do Projeto</label>
                        <div class="controls">
                            <span style="font-weight: normal; !important" class="carousel-inner">
                                <?php echo $projeto['resumo']; ?>
                            </span>
                        </div>
                    </div>
                    </br>

                    <div class="control-group">
                        <label class="control-label">Curso e Turma</label>
                        <div class="controls">
                            <span style="font-weight: 200;" class="carousel-inner">
                                <?php echo $projeto['curso']; ?> / <?php echo $projeto['turma']; ?>
                            </span>
                        </br>
                        </div>
                    </div>
                    <br/>
                    <div class="form-actions">
                        <a href="../usuario-logado.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                    </br>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="footer"></div>
</body>

</html>
