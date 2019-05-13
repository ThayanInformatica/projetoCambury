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

$codProjeto = 0;

if (!empty($_GET['codProjeto'])) {
    $codProjeto = $_REQUEST['codProjeto'];
}

if (!empty($_POST)) {
    $codProjeto = $_POST['codProjeto'];

    //Delete do banco:
    $pdo = conectdb::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE tb_projeto SET projetoAceito = 1 WHERE codProjeto = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($codProjeto));
    conectdb::desconectar();
    header("Location: ../admin.php?=sucess");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Aprovar Projeto | Faculdades Cambury</title>

    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="icon" href="https://cambury.br/wp-content/themes/cambury/favicon.png"  type="image/ico" />
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!--    footer e header para páginas-->
    <!--    <link rel="stylesheet" href="../../components/css/header.css"/>-->
    <!--    <link rel="stylesheet" href="../../components/css/footer.css"/>-->
    <!--    <script>-->
    <!--        $(function () {-->
    <!--            $("#header").load("../../components/header.php");-->
    <!--        });-->
    <!--    </script>-->
    <!--    <script>-->
    <!--        $(function () {-->
    <!--            $("#footer").load("../../components/footer.php");-->
    <!--        });-->
    <!--    </script>-->
    <!--        copiar e colar isto para as demais novas paginas-->
    <!---->
    <!--    <link rel="stylesheet" href="../../components/css/menu-admin.css"/>-->
    <!--    <script>-->
    <!--        $(function () {-->
    <!--            $("#menu").load("../../components/menu-administrador-topage.php");-->
    <!--        });-->
    <!--    </script>-->

    <script type="text/javascript">

        $(document).ready(function () {
            $('#myModal').modal('show');
        })
    </script>

</head>

<body>
<!--<div id="header"></div>-->
<!--<div id="menu"></div>-->

<div class="container">
    <!--    <h2>Modal Example</h2>-->
    <!-- Trigger the modal with a button -->
    <!--    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Aceitar Projeto</h4>
                </div>
                <form class="form-horizontal" action="#" method="post">

                    <div class="modal-body">
                        <input type="hidden" name="codProjeto" value="<?php echo $codProjeto; ?>"/>
                        <div class="alert alert-success"> Deseja aceitar o projeto?
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Sim</button>
                        <a href="../admin.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
            </div>
            </form>

        </div>
    </div>

</div>

</body>
<!--<div id="footer"></div>-->
</html>

<!--Antiga modal-->

<!--<div class="modals-page">-->
<!--    <div class="container" style="border: 1.2px solid lightgreen;">-->
<!--        <div class="span10 offset1">-->
<!--            <div class="row">-->
<!--                <h3 class="well">Aceitar Projeto</h3>-->
<!--            </div>-->
<!--            <form class="form-horizontal" action="#" method="post">-->
<!--                <input type="hidden" name="codProjeto" value="--><?php //echo $codProjeto; ?><!--"/>-->
<!--                <div class="alert alert-success"> Deseja aceitar o projeto?-->
<!--                </div>-->
<!--                <div class="form actions">-->
<!--                    <button type="submit" class="btn btn-success">Sim</button>-->
<!--                    <a href="../admin.php" type="btn" class="btn btn-default">Voltar</a>-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->