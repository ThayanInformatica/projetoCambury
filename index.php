<?php

session_start();
if (isset($_SESSION['login']) && isset($_SESSION['senha']) && isset($_SESSION['nivel'])):
    header('location: usuario-logado.php');
endif;

if (isset($_SESSION['nivel'])) {
    $nivel = $_SESSION['nivel'];
    if ($nivel == 99) {
        header('location: administrador/admin.php');
    }

}

if ($_POST) {
    include('classes/Conexao.class.php');
    include('classes/UsuarioDAO.class.php');

    $usuario = new UsuarioDAO();

    $login = addslashes($_POST['login']);
    $senha = addslashes($_POST['senha']);

    $user = $usuario->login($login, $senha);

    if ($user == true) {
        session_start();
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;
        $nivel = $usuario->nivelDeUsuario($login);
        $_SESSION['nivel'] = $nivel;
        $codUsuario = $usuario->CodDoUsuario($login);
        $_SESSION['codUsuario'] = $codUsuario;
        header('location: usuario-logado.php');
    } else {
        header('location:index.php?erro=senha');
    }

    if ($user == true && $nivel == 99) {
        header('location: administrador/admin.php');
    }

    if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])):
        header("location: index.php?erro=senha");
    endif;

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login PHP OO</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div class="container jumbotron">

    <?php

    if (isset($_GET['erro'])) {
        echo '<div class="alert alert-danger">Login ou Senha incorretos</div>';
    }

    if (isset($_GET['success'])) {
        echo '<div class="alert alert-success">Logout efetuado com sucesso</div>';
    }
    ?>
    <h2>Login</h2>
    <hr>
    <form action="#" method="post">

        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" name="login">
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha">
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="lembrar"> Check me out
            </label>
        </div>

        <input type="submit" class="btn btn-primary" name="logar" value="Logar">

    </form>


    <br>

    <a href="cadastro-usuario.php">Cadastre-se</a>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    setTimeout(function () {
        $('.alert').fadeOut();
    }, 3000);

</script>
</body>

</html>
