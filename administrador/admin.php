<?php

  session_start();

?>
 <!DOCTYPE html>
 <html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login PHP OO</title>

 	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
      <!--[if lt IE 9]>
        <script src = "http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
</head>
<body>
  <div class="container jumbotron">

    <h2>Bem-Vindo Administrador <?php echo $_SESSION['login']; ?>!</h2>

    <a href="../logout.php">Sair</a>

  </div>

  <div class="container">
      </br>
      <div class="row">
          <p>
              <?php if ($_SESSION['nivel'] == 99) {
                  echo '<a href="cadastro-projeto/criar-projeto.php" class="btn btn-success">Aceitar Avaliador</a>';
              }
              ?>

              <?php

              include('../classes/Conexao.class.php');
              include('../classes/ProjetoDAO.class.php');
              include('../classes/UsuarioDAO.class.php');

              $usuario = new UsuarioDAO();
              $usuarioProjeto = new ProjetoDAO();

              $login = $_SESSION['login'];

              $codUsuario = $usuario->CodDoUsuario($login);
              $_SESSION['codUsuario'] = $codUsuario;

              ?>

          </p>

          <table class="table table-striped">
              <h2>Lista de Projetos</h2>
              <thead>
              <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Endereço</th>
                  <th scope="col">Telefone</th>
                  <th scope="col">Email</th>
                  <th scope="col">Sexo</th>
                  <th scope="col">Ação</th>
              </tr>
              </thead>
              <tbody>
              <?php
              include '../classes/conectdb.php';
              $pdo = conectdb::conectar();
              $sql = 'SELECT codUsuario,codProjeto,nomeProjeto,nomeProfessor,projetoAceito FROM tb_projeto ';

              foreach ($pdo->query($sql) as $getProjetos) {
                  echo '<tr>';
                  echo '<th scope="row">' . $getProjetos['codProjeto'] . '</th>';
                  echo '<td>' . $getProjetos['nomeProjeto'] . '</td>';
                  echo '<td>' . $getProjetos['nomeProfessor'] . '</td>';
                  echo '<td width=250>';
                  echo '<a class="btn btn-primary" href="ler-projeto.php?codProjeto=' . $getProjetos['codProjeto'] . '">Info</a>';
                  echo ' ';
                  if ($_SESSION['nivel'] == 100) { // RN: Administrador não pode editar projeto
                      echo '<a class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Após ser aceito, não poderá mais editar" href="editar.php?id=' . $getProjetos['codProjeto'] . '">Editar</a>';
                      echo ' ';
                  }
//                echo '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">Excluir</a>';
                  echo '</td>';
                  echo '</tr>';
              }
              conectdb::desconectar();
              ?>
              </tbody>
          </table>
      </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>

</html>
