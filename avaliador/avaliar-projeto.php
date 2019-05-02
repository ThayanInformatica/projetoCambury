<?php

session_start();

if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])):
    header('location: ../index.php');
endif;

if (isset($_SESSION['login']) && isset($_SESSION['senha']) && isset($_SESSION['avaliador']) && isset($_SESSION['codUsuario'])):
    if (isset($_SESSION['avaliador'])) {
        $avaliador = $_SESSION['avaliador'];
        if ($avaliador != 2) {
            header('location: ../usuario-logado.php');
        }
    }

    $codUsuario = $_SESSION['codUsuario'];

endif;

require '../classes/conectdb.php';

if (!empty($_GET['codProjeto'])) {
    $codProjeto = $_REQUEST['codProjeto'];
}

if (null == $codUsuario) {
    header("Location: ../usuario-logado.php");
}

if (!empty($_POST)) {

    $nota1Erro = null;
    $nota2Erro = null;
    $nota3Erro = null;
    $nota4Erro = null;

    $nota1 = trim(strip_tags($_POST['nota1'])); // atribui login à variavel, com funções contra sql inject
    $nota2 = trim(strip_tags($_POST['nota2'])); // atribui login à variavel, com funções contra sql inject
    $nota3 = trim(strip_tags($_POST['nota3'])); // atribui login à variavel, com funções contra sql inject
    $nota4 = trim(strip_tags($_POST['nota4'])); // atribui login à variavel, com funções contra sql inject

    //Validação
    $validacao = true;

    if (empty($nota1)) {
        $nota1Erro = 'Por favor insira a nota!';
        $validacao = false;
    }

    if (empty($nota2)) {
        $nota2Erro = 'Por favor insira a nota!';
        $validacao = false;
    }

    if (empty($nota3)) {
        $nota3Erro = 'Por favor insira a nota!';
        $validacao = false;
    }

    if (empty($nota4)) {
        $nota4Erro = 'Por favor insira a nota!';
        $validacao = false;
    }


    if ($validacao) {
        $pdo = conectdb::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO tb_avaliacao (codProjeto,codUsuario,nota_1,nota_2,nota_3,nota_4) values (?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($codProjeto, $codUsuario, $nota1, $nota2, $nota3, $nota4));
        conectdb::desconectar();
        header("Location: ../usuario-logado.php");
    }
}

if (null == $codProjeto) {
    header("Location: ../../usuario-logado.php");
} elseif (null == $_SESSION['login']) {
    header("Location: ../../index.php");
} else {
    $pdo = conectdb::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM tb_projeto where codProjeto = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($codProjeto));
    $projeto = $q->fetch(PDO::FETCH_ASSOC);
    conectdb::desconectar();
}


include('../classes/Conexao.class.php');
include('../classes/ProjetoDAO.class.php');

$usuarioProjeto = new ProjetoDAO();

$validarSeProjetoTemNota = $usuarioProjeto->recuperarProjetosAvaliados($codProjeto);

if (isset($validarSeProjetoTemNota)) {
    header("Location: ../usuario-logado.php");
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

    <script>
        function alteraPonto(valorInput) {
            $(valorInput).val(valorInput.val().replace(",", "."));
        }
    </script>

    <script>
        function maxValor(valorInput) {
            $(valorInput).on('keyup', function (event) {
                const valorMaximo = 10;
                if (event.target.value > valorMaximo)
                    return event.target.value = valorMaximo;
            });
        }
    </script>

    <!--    copiar e colar isto para as demais novas paginas-->

    <title>Meu Perfil | Faculdades Cambury</title>
</head>

<body>

<div class="container">

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
                            <label class="control-label">Nome do Orientador</label>
                            <div class="controls">
                                <label class="carousel-inner">
                                    <?php echo $projeto['nomeProfessor']; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Objetivo do Projeto</label>
                            <div class="controls">
                                <label class="carousel-inner">
                                    <?php echo $projeto['objetivo']; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Resumo do Projeto</label>
                            <div class="controls">
                                <label class="carousel-inner">
                                    <?php echo $projeto['resumo']; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Curso e Turma</label>
                            <div class="controls">
                                <label class="carousel-inner">
                                    <?php echo $projeto['curso']; ?> / <?php echo $projeto['turma']; ?>
                                </label>
                            </div>
                        </div>
                        <br/>
                        <div class="form-actions">
                            <a href="../admin.php" type="btn" class="btn btn-default">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="span10 offset1" id="avaliar">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Avaliar notas deste Projeto </h3>
            </div>
            <div class="card-body">

                <form class="form-horizontal" action="#"
                      method="post">

                    <div class="control-group <?php echo !empty($nota1) ? 'error' : ''; ?>">
                        <label class="control-label">Contribuição do projeto para instituições envolvidas e/ou sociedade
                        </label>
                        <div class="controls">
                            <input onchange="alteraPonto($(this));" onkeyup="maxValor($(this))" name="nota1"
                                   class="form-control" size="10" type="text"
                                   placeholder="Ex: 9.6"
                                   value="<?php echo !empty($nota1) ? $nota1 : ''; ?>" maxlength="3">
                            <?php if (!empty($nota1Erro)): ?>
                                <br/>
                                <div class="alert alert-danger"><?php echo $nota1Erro; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($nota2) ? 'error' : ''; ?>">
                        <label class="control-label">Ambientação e exposição do projeto
                        </label>
                        <div class="controls">
                            <input onchange="alteraPonto($(this));" onkeyup="maxValor($(this))" name="nota2"
                                   class="form-control" size="40" type="text"
                                   placeholder="Ex: 10"
                                   value="<?php echo !empty($nota2) ? $nota2 : ''; ?>" maxlength="3">
                            <?php if (!empty($nota2Erro)): ?>
                                <br/>
                                <div class="alert alert-danger"><?php echo $nota2Erro; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($nota3) ? 'error' : ''; ?>">
                        <label class="control-label">Domínio nas explicações e dinâmica do projeto
                        </label>
                        <div class="controls">
                            <input onchange="alteraPonto($(this));" onkeyup="maxValor($(this))" name="nota3"
                                   class="form-control" size="40" type="text"
                                   placeholder="Ex: 1.2"
                                   value="<?php echo !empty($nota3) ? $nota3 : ''; ?>" maxlength="3">
                            <?php if (!empty($nota3Erro)): ?>
                                <br/>
                                <div class="alert alert-danger"><?php echo $nota3Erro; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($nota4) ? 'error' : ''; ?>">
                        <label class="control-label">Resultados obtidos com o projeto
                        </label>
                        <div class="controls">
                            <input onchange="alteraPonto($(this));" onkeyup="maxValor($(this))" name="nota4"
                                   class="form-control" size="40" type="text"
                                   placeholder="Ex: 5.9"
                                   value="<?php echo !empty($nota4) ? $nota4 : ''; ?>" maxlength="3">
                            <?php if (!empty($nota4Erro)): ?>
                                <br/>
                                <div class="alert alert-danger"><?php echo $nota4Erro; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <br/>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Avaliar o Projeto</button>
                        <a href="../usuario-logado.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                    </br>
                    </br>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div id="footer"></div>

</body>

</html>
