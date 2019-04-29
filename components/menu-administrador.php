<?php
session_start();

if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])):
    header('location: ../index.php');
endif;

if (isset($_SESSION['login']) && isset($_SESSION['senha']) && isset($_SESSION['nivel']) && isset($_SESSION['codUsuario'])):
    if (isset($_SESSION['nivel'])) {
        $nivel = $_SESSION['nivel'];
        if ($nivel != 99) {
            header('location: ../usuario-logado.php');
        }
    }
    $login = $_SESSION['login'];
    $codUsuario = $_SESSION['codUsuario'];

endif;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login PHP OO</title>

    <link rel="stylesheet" href="css/menu-admin.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>
<nav class="navbar navbar-default">
    <div class="alinhamento-menu">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="../index.php">Cambury - PCA</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="../administrador/usuario-avaliador/validar-usuario-avaliador.php">Adicionar Avaliador
                            <span class="sr-only">(current)</span></a></li>
                    <li><a href="../administrador/listar-usuario.php">Listar Usuários</a></li>
                    <?php echo'<li><a href="../administrador/editar-perfil.php?codUsuario=' . $codUsuario . '"">Editar Perfil</a></li>'; ?>
                    <li><a href="../logout.php">Deslogar</a></li>
                </ul>
            </div>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

</body>

</html>
