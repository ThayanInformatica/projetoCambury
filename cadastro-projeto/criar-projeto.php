<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Cambury | Cadastro de Projeto</title>
</head>

<body>


    <div class="container">
        <div clas="span10 offset1">
          <div class="card">
            <div class="card-header">
                <h3 class="well"> Cadastro de Projeto </h3>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="#" method="post">

                <div class="control-group <?php echo !empty($nomeProjetoErro)?'error ' : '';?>">
                    <label class="control-label">Nome do Projeto</label>
                    <div class="controls">
                        <input size="50" class="form-control" name="nomeProjeto" type="text" placeholder="Digite o nome do projeto" required="" value="<?php echo !empty($nomeProjeto)?$nomeProjeto: '';?>">
                        <?php if(!empty($nomeProjetoErro)): ?>
                            <span class="help-inline"><?php echo $nomeProjetoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($nomeProfessorErro)?'error ': '';?>">
                    <label class="control-label">Prof°(a) Orientador</label>
                    <div class="controls">
                        <input size="80" class="form-control" name="nomeProfessor" type="text" placeholder="Digite o nome do Orientador" required="" value="<?php echo !empty($nomeProfessor)?$nomeProfessor: '';?>">
                        <?php if(!empty($nomeProfessorErro)): ?>
                            <span class="help-inline"><?php echo $nomeProfessorErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($objetivoErro)?'error ': '';?>">
                    <label class="control-label">Objetivo do Projeto</label>
                    <div class="controls">
                        <textarea size="35" class="form-control" name="objetivo" type="text" required="" value="<?php echo !empty($objetivo)?$objetivo: '';?>"> </textarea>
                        <?php if(!empty($objetivoErro)): ?>
                            <span class="help-inline"><?php echo $objetivoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($resumoErro)?'error ': '';?>">
                    <label class="control-label">Resumo do Projeto</label>
                    <div class="controls">
                        <textarea size="40" class="form-control" name="resumo" type="text" required="" value="<?php echo !empty($resumo)?$resumo: '';?>"></textarea>
                        <?php if(!empty($resumoErro)): ?>
                            <span class="help-inline"><?php echo $resumoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>


				<div class="col-sm-3">
			          <label>Curso</label>
      <select class="form-control" name="cursProjeto" >
        <option  value="ti">GESTÃO DA TECNOLOGIA DA INFORMAÇÃO</option>
        <option  value="contabil">CIÊNCIAS CONTÁBEIS</option>
		        <option value="adm">ADMINISTRAÇÃO</option>
				        <option  value="estetica">ESTÉTICA E COSMÉTICA</option>
						        <option value="mkt">MARKETING</option>
								        <option value="tpg">TECNOLOGIA EM PROCESSOS GERENCIAIS</option>
      </select>
    </div>
	
			  	  <div class="col-sm-3">
			          <span>Turma</span>
      <select class="form-control" name="turma" <?php echo !empty($turmaErro)?'error ': '';?> >
        <option value="<?php echo !empty($turma)?$turma: '01';?>">01</option>
        <option value="<?php echo !empty($turma)?$turma: '02';?>">02</option>
		        <option value="<?php echo !empty($turma)?$turma: '03';?>">03</option>
				        <option value="<?php echo !empty($turma)?$turma: '04';?>">04</option>
						        <option value="<?php echo !empty($turma)?$turma: '05';?>">05</option>
      </select>
    </div>

                <div class="form-actions">
                    <br/>

                    <button type="submit" class="btn btn-success">Adicionar</button>
                    <a href="index.php" type="btn" class="btn btn-default">Voltar</a>

                </div>
				
				<?php
			echo $_SERVER['REQUEST_METHOD'];
			
			  session_start();
		if(!isset($_SESSION['login']) && !isset($_SESSION['senha'])):
			header("Location: index.php");	
				endif;
								
			
			    if(empty($_POST['cadastrar'])) {
		
		    include ('../classes/Conexao.class.php');
			include ('../classes/ProjetoDAO.class.php');
			
		$cadastrarProjeto = new ProjetoDAO();
		
		$codUsuario = ($_SESSION['codUsuario']) ? $_SESSION['codUsuario'] : '1';
		$nomeProjeto = ($_POST['nomeProjeto']) ? $_POST['nomeProjeto'] : '1';
		$nomeProfessor = ($_POST['nomeProfessor']) ? $_POST['nomeProfessor'] : '1';
		$objetivo = ($_POST['objetivo']) ? $_POST['objetivo'] : '1';
		$resumo = ($_POST['resumo']) ? $_POST['resumo'] : '1';
		$cursProjeto = ($_POST['cursProjeto']) ? $_POST['cursProjeto'] : '1';
		$turma = ($_POST['turma']) ? $_POST['turma'] : '1';
					  
      $consultaProjeto = $cadastrarProjeto->unicoProjeto($nomeProjeto);
      // caso o login escolhido já exista no banco retorna erro
      if($consultaProjeto == false) {
        header('location:criar-projeto.php?repetido=senha');
      // caso não haja login parecido, inclui métoro de inserção de dados no banco de dados
      } else {
        $insere = $cadastrarProjeto->cadastraProjeto($codUsuario,$nomeProjeto,$nomeProfessor,$objetivo,$resumo,$cursProjeto,$turma);
        // caso o usuario seja cadastrado, exibir mensagem de sucesso
        if($insere == true) {
          header('location:index.php?successUser=cadastrado');
        }
      }

    }

?>
            </form>
          </div>
        </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

