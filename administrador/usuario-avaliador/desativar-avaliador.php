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
    $sql = "UPDATE tb_usuario SET avaliador = 1 WHERE codUsuario = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($codUsuario));
    conectdb::desconectar();
    header("Location: validar-usuario-avaliador.php?=sucess");
    echo '<div class="alert alert-success">Usuário desativado como avaliador</div>';
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Desativar Avaliador | Faculdades Cambury</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../css/admin-page.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Marcellus+SC|Prompt|Rufina" rel="stylesheet">

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

    <script type="text/javascript">

        $(document).ready(function () {
            $('#myModal').modal('show');
        })
    </script>


    <title>Desativar Avaliador | Faculdades Cambury</title>
</head>

<body>
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
                    <h4 class="modal-title">Desativar Avaliador</h4>
                </div>

                <form class="form-horizontal" action="#" method="post">

                    <div class="modal-body">
                        <input type="hidden" name="codUsuario" value="<?php echo $codUsuario; ?>"/>
                        <div class="alert alert-danger"> Deseja Desativar o avaliador?
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Sim</button>
                        <a href="validar-usuario-avaliador.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>


        </div>
    </div>

</div>
</body>

</html>
