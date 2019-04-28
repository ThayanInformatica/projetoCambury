<?php

session_start();
if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])):
endif;

require 'classes/conectdb.php';
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
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Informações do Contato</title>
</head>

<body>
<div class="container">
    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well">Informações do Projeto</h3>
            </div>
            <div class="container">
                <div class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">Nome do Projeto</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $projeto['nomeProjeto']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Orientador</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $projeto['nomeProfessor']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Telefone</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['telefone']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['email']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Sexo</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['sexo']; ?>
                            </label>
                        </div>
                    </div>
                    <br/>
                    <div class="form-actions">
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
