<?php

session_start();
if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])):
    header('location: ../../index.php');
endif;

if (isset($_SESSION['login']) && isset($_SESSION['senha']) && isset($_SESSION['nivel'])):
    if (isset($_SESSION['nivel'])) {
        $nivel = $_SESSION['nivel'];
        if ($nivel != 99) {
            header('location: ../../usuario-logado.php');
        }
    }

endif;


require '../../classes/conectdb.php';

$codUsuario = 0;

if (!empty($_GET['codUsuario'])) {
    $codUsuario = $_REQUEST['codUsuario'];
}

if (!empty($_POST)) {
    $codUsuario = $_POST['codUsuario'];

    //Delete do banco:
    $pdo = conectdb::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE tb_usuario SET avaliador = 0 WHERE codUsuario = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($codProjeto));
    conectdb::desconectar();
    header("Location: ../admin.php?=sucess");
    echo '<div class="alert alert-success">Usuário desativado como avaliador</div>';
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../css/admin-page.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

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

    <title>Desativar Avaliador | Faculdades Cambury</title>
</head>

<body>
<div id="header"></div>

<div class="modals-page">
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3 class="well">Desativar Avaliador</h3>
            </div>
            <form class="form-horizontal" action="#" method="post">
                <input type="hidden" name="codProjeto" value="<?php echo $codUsuario; ?>"/>
                <div class="alert alert-danger"> Deseja desativar o avaliador?
                </div>
                <div class="form actions">
                    <button type="submit" class="btn btn-danger">Sim</button>
                    <a href="../admin.php" type="btn" class="btn btn-default">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="footer"></div>
</body>

</html>
