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
endif;

require '../classes/conectdb.php';

$codUsuario = null;
if (!empty($_GET['codUsuario'])) {
    $codUsuario = $_REQUEST['codUsuario'];
}

if (null == $codUsuario) {
    header("Location: ../usuario-logado.php");
}

if (!empty($_POST)) {

    $loginErro = null;
    $nomeErro = null;
    $senhaErro = null;
    $rep_senhaErro = null;
    $cpfErro = null;
    $emailErro = null;

    $login = trim(strip_tags($_POST['login'])); // atribui login à variavel, com funções contra sql inject
    $nome = trim(strip_tags($_POST['nome'])); // atribui login à variavel, com funções contra sql inject
    $senha = trim(strip_tags($_POST['senha'])); // atribui login à variavel, com funções contra sql inject
    $rep_senha = trim(strip_tags($_POST['rep_senha'])); // atribui login à variavel, com funções contra sql inject
    $cpf = trim(strip_tags($_POST['cpf'])); // atribui login à variavel, com funções contra sql inject
    $email = trim(strip_tags($_POST['email'])); // atribui login à variavel, com funções contra sql inject

    //Validação
    $validacao = true;
    if ($senha != $rep_senha) {
        $senhaErro = 'Senhas não conferem';
        $validacao = false;
    }

    if (empty($nome)) {
        $nomeErro = 'Por favor digite o nome do usuario!';
        $validacao = false;
    }

    if (empty($email)) {
        $emailErro = 'Por favor digite o seu email!';
        $validacao = false;
    }

    if ($validacao) {
        $pdo = conectdb::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tb_usuario set nomeUsuario = ?, senhaUsuario = ?, emailUsuario = ? WHERE codUsuario = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $senha, $email, $codUsuario));
        conectdb::desconectar();
        header("Location: ../usuario-logado.php");
    }
} else {
    $pdo = conectdb::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM tb_usuario where codUsuario = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($codUsuario));
    $getUsuario = $q->fetch(PDO::FETCH_ASSOC);
    $login = $getUsuario['loginUsuario'];
    $nome = $getUsuario['nomeUsuario'];
    $cpf = $getUsuario['cpfUsuario'];
    $email = $getUsuario['emailUsuario'];
    conectdb::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
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

        document.getElementById('theInput').disabled = true;
    </script>
    <link rel="stylesheet" href="../components/css/menu-admin.css"/>
    <script>
        $(function () {
            $("#menu").load("../components/menu-administrador.php");
        });
    </script>

    <script>
        $(function () {
            $("#footer").load("../components/footer.php");
        });
    </script>
    <!--    copiar e colar isto para as demais novas paginas-->

    <title>Meu Perfil | Faculdades Cambury</title>
</head>

<body>
<div id="header"></div>
<div id="menu"></div>

<div class="container">

    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Meu Usuário </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="#"
                      method="post">

                    <div class="control-group <?php echo !empty($login) ? 'error' : ''; ?>">
                        <label class="control-label">Login</label>
                        <div class="controls">
                            <input name="login" id="login" class="form-control" size="50" type="text"
                                   value="<?php echo !empty($login) ? $login : ''; ?>" readonly="readonly">
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($nome) ? 'error' : ''; ?>">
                        <label class="control-label">Nome do Usuário</label>
                        <div class="controls">
                            <input name="nome" class="form-control" size="80" type="text" placeholder="Nome do Usuário"
                                   value="<?php echo !empty($nome) ? $nome : ''; ?>" minlength="5">
                            <?php if (!empty($nomeErro)): ?>
                                <br/>
                                <div class="alert alert-danger"><?php echo $nomeErro; ?></div>

                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($senha) ? 'error' : ''; ?>">
                        <label class="control-label">Senha</label>
                        <div class="controls">
                            <input name="senha" class="form-control" size="30" type="password"
                                   placeholder="Digite sua senha"
                                   value="<?php echo !empty($senha) ? $senha : ''; ?>" minlength="6">
                            <?php if (!empty($senhaErro)): ?>
                                <br/>
                                <div class="alert alert-danger"><?php echo $senhaErro; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($rep_senha) ? 'error' : ''; ?>">
                        <label class="control-label">Repetir Senha</label>
                        <div class="controls">
                            <input name="rep_senha" class="form-control" size="40" type="password"
                                   placeholder="Repita a senha"
                                   value="<?php echo !empty($rep_senha) ? $rep_senha : ''; ?>" minlength="6">
                            <?php if (!empty($rep_senhaErro)): ?>
                                <br/>
                                <div class="alert alert-danger"><?php echo $rep_senhaErro; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($cpf) ? 'error' : ''; ?>">
                        <label class="control-label">CPF</label>
                        <div class="controls">
                            <input name="cpf" class="form-control" size="14" type="number"
                                   value="<?php echo !empty($cpf) ? $cpf : ''; ?>" readonly="readonly">
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($email) ? 'error' : ''; ?>">
                        <label class="control-label">E-mail</label>
                        <div class="controls">
                            <input name="email" class="form-control" size="40" type="email"
                                   placeholder="Digite seu Email"
                                   value="<?php echo !empty($email) ? $email : ''; ?>">
                            <?php if (!empty($emailErro)): ?>
                                <br/>
                                <div class="alert alert-danger"><?php echo $emailErro; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <br/>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Atualizar</button>
                        <a href="../usuario-logado.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="footer"></div>

</body>

</html>
