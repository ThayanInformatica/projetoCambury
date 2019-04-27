<?php
require '../classes/conectdb.php';

$codProjeto = 0;

if(!empty($_GET['codProjeto']))
{
    $codProjeto = $_REQUEST['codProjeto'];
}

if(!empty($_POST))
{
    $codProjeto = $_POST['codProjeto'];

    //Delete do banco:
    $pdo = conectdb::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE tb_projeto SET projetoAceito = 0 WHERE codProjeto = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($codProjeto));
    conectdb::desconectar();
    header("Location: admin.php?=sucess");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <title>Desaprovar Projeto</title>
</head>

<body>
<div class="container">
    <div class="span10 offset1">
        <div class="row">
            <h3 class="well">Desaprovar Projeto</h3>
        </div>
        <form class="form-horizontal" action="#" method="post">
            <input type="hidden" name="codProjeto" value="<?php echo $codProjeto;?>" />
            <div class="alert alert-danger"> Deseja desaprovar o projeto?
            </div>
            <div class="form actions">
                <button type="submit" class="btn btn-danger">Sim</button>
                <a href="admin.php" type="btn" class="btn btn-default">Não</a>
            </div>
        </form>
    </div>
</div>
</body>

</html>
