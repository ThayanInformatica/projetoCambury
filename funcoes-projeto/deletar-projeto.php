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

$codProjeto = 0;

if (!empty($_GET['codProjeto'])) {
    $codProjeto = $_REQUEST['codProjeto'];
}

if (!empty($_POST)) {
    $codProjeto = $_POST['codProjeto'];

    //Delete do banco:
    $pdo = conectdb::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM tb_projeto where codProjeto = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($codProjeto));
    conectdb::desconectar();
    header("Location: ../usuario-logado.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Deletar Projeto | Faculdades Cambury</title>
    <link rel="stylesheet" href="../administrador/css/admin-page.css"/>
    <link rel="stylesheet" href="../funcoes-projeto/css/TelaDelete.css">
    <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    

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
    <!--    copiar e colar isto para as demais novas paginas-->

    <script type="text/javascript">

$(document).ready(function () {
    $('#myModal').modal('show');
})
</script>

</head>

<body>
<div id="header"></div>

<!-- Codido Antigo --
<h1 class="corteste">teste</h1>
    <div class=centralizandoCampos></div>
    <div class="container" >
        <div class="modals-page">
        <div class="span10 offset1">
        <div class="row">
                <h3  id="editandoTitulo">Deletar Projeto</h3>
            </div>

            <form class="form-horizontal" action="#" method="post">
                <input type="hidden" name="codProjeto" value="<?php echo $codProjeto; ?>"/>
                <div class="alert alert-danger"> Tem certeza que deseja deletar Projeto ?
                </div>
                <div class="form actions">
                    <button id="editSim" type="submit" class="btn btn-danger">Sim</button>
                    <a href="../usuario-logado.php" id="editNao" type="btn" class="btn btn-default">Não</a>
                </div>
            </form>
        </div>
        </div>
    </div>
</div> 
    -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

<div class="modals-page">
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3 class="well">Deseja deletar Projeto</h3>
            </div>
            <form class="form-horizontal" action="#" method="post">
                <input type="hidden" name="codProjeto" value="<?php echo $codProjeto; ?>"/>
                <div class="alert alert-danger"> Realmente deseja excluir seu projeto ?
                </div>
                <div class="form actions">
                    <button  type="submit" class="btn btn-danger">Sim</button>
                    <a href="../usuario-logado.php" id="editandoVoltar" type="btn" class="btn btn-default">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>



</body>

</html>
