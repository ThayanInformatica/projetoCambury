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

$codProjeto = null;
if (!empty($_GET['codProjeto'])) {
    $codProjeto = $_REQUEST['codProjeto'];
}

if (null == $codProjeto) {
    header("Location: ../usuario-logado.php");
}

if (!empty($_POST)) {

    $nomeProjetoErro = null;
    $nomeProfessorErro = null;
    $objetivoErro = null;
    $resumoErro = null;
    $cursoErro = null;
    $turmaErro = null;

    $nomeProjeto = $_POST['nomeProjeto'];
    $nomeProfessor = $_POST['nomeProfessor'];
    $objetivo = $_POST['objetivo'];
    $resumo = $_POST['resumo'];
    $curso = $_POST['curso'];
    $turma = $_POST['turma'];

    //Validação
    $validacao = true;
    if (empty($nomeProjeto)) {
        $nomeProjetoErro = 'Por favor digite o nome!';
        $validacao = false;
    }

    if (empty($nomeProfessor)) {
        $nomeProfessorErro = 'Por favor digite o Orientador!';
        $validacao = false;
    }

    if (empty($objetivo)) {
        $objetivoErro = 'Por favor digite o Objetivo!';
        $validacao = false;
    }

    if (empty($resumo)) {
        $resumoErro = 'Por favor digite o Resumo!';
        $validacao = false;
    }

    if ($validacao) {
        $pdo = conectdb::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tb_projeto set nomeProjeto = ?, nomeProfessor = ?, objetivo = ?, resumo = ?, curso = ?, turma = ? WHERE codProjeto = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nomeProjeto, $nomeProfessor, $objetivo, $resumo, $curso, $turma, $codProjeto));
        conectdb::desconectar();
        header("Location: ../usuario-logado.php");
    }
} else {
    $pdo = conectdb::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM tb_projeto where codProjeto = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($codProjeto));
    $getProjeto = $q->fetch(PDO::FETCH_ASSOC);
    $nomeProjeto = $getProjeto['nomeProjeto'];
    $nomeProfessor = $getProjeto['nomeProfessor'];
    $objetivo = $getProjeto['objetivo'];
    $resumo = $getProjeto['resumo'];
    $curso = $getProjeto['curso'];
    $turma = $getProjeto['turma'];
    conectdb::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../funcoes-projeto/css/editarProjeto.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Marcellus+SC|Prompt|Rufina" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
    @import url('https://fonts.googleapis.com/css?family=Questrial');
    </style>

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

    <title>Editar Projeto | Faculdades Cambury</title>
</head>

<body>
<div id="header"></div>
<div class="container">

    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                
            <h3 class="well"> Editar Projeto </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="editar-projeto.php?codProjeto=<?php echo $codProjeto ?>"
                      method="post">

                    <div  class="form-group col-md-6">
                        <div class="campoProjeto" class="control-group <?php echo !empty($nomeProjeto) ? 'error' : ''; ?>">
                            <label class="control-label">Nome do Projeto:</label>
                            <div class="controls">
                                <input name="nomeProjeto" class="form-control" size="50" type="text" placeholder="Nome do Projeto"
                                    value="<?php echo !empty($nomeProjeto) ? $nomeProjeto : ''; ?>">
                                <?php if (!empty($nomeProjetoErro)): ?>
                                    <span class="help-inline"><?php echo $nomeProjetoErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div  class="form-group col-md-6">
                        <div class="campoOrientador" class="control-group <?php echo !empty($nomeProfessor) ? 'error' : ''; ?>">
                            <label class="control-label">Nome do Orientador:</label>
                            <div class="controls">
                                <input name="nomeProfessor" class="form-control" size="80" type="text" placeholder="Nome do Orientador"
                                    value="<?php echo !empty($nomeProfessor) ? $nomeProfessor : ''; ?>">
                                <?php if (!empty($nomeProfessorErro)): ?>
                                    <span class="help-inline"><?php echo $nomeProfessorErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div  class="form-group col-md-6">
                        <div  class="editandoObjProjeto" class="control-group <?php echo !empty($objetivo) ? 'error' : ''; ?>">
                            <label  class="control-label">Objetivo do Projeto:</label>
                            <div class="controls">
                                <input name="objetivo" class="form-control" size="30" type="text" placeholder="Objetivo"
                                    value="<?php echo !empty($objetivo) ? $objetivo : ''; ?>">
                                <?php if (!empty($objetivoErro)): ?>
                                    <span class="help-inline"><?php echo $objetivoErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div  class="form-group col-md-6">
                        <div class="editandoResumo" class="control-group <?php echo !empty($resumo) ? 'error' : ''; ?>">
                            <label  class="control-label">Resumo do Projeto:</label>
                            <div class="controls">
                                <input  name="resumo" class="form-control" size="40" type="text" placeholder="Resumo do Projeto"
                                class="areaDoInput"    value="<?php echo !empty($resumo) ? $resumo : ''; ?>">
                                <?php if (!empty($resumoErro)): ?>
                                    <span class="help-inline"><?php echo $resumoErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>    

                    
                    
                    <div id="editandoCursos" >
          
                    <label>Curso:</label>
                        <select class="form-control " name="curso">
                            <option value="TI">GESTÃO DA TECNOLOGIA DA INFORMAÇÃO</option>
                            <option value="C. CONTÁBEIS">CIÊNCIAS CONTÁBEIS</option>
                            <option value="ADMINISTRAÇÃO">ADMINISTRAÇÃO</option>
                            <option value="E. E COSMÉTIC">ESTÉTICA E COSMÉTICA</option>
                            <option value="MARKETING">MARKETING</option>
                            <option value="TPGS">TECNOLOGIA EM PROCESSOS GERENCIAIS</option>
                        </select>
                    </div>

                  
                   <div class="editandoTurma">
                    <label>Turma:</label>
                    <select class="form-control" name="turma" >
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                </select>
            </div>
                    <br/>
                    <br> 

                    <div  class="form-actions">
                        <div class="editandoBotoes">
                       <button type="submit" class="btn btn-warning">Atualizar</button>
                        <a href="../usuario-logado.php" id="editandoVoltar" type="btn" class="btn btn-default" class="editandoVoltar">Voltar</a>
                        </div>
                    </div>
    
                </form>
            </div>
        </div>
    </div>
</div>
<div id="footer"></div>

</body>

</html>
