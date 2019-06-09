<?php

session_start();
if (isset($_SESSION['login']) && isset($_SESSION['senha'])):
endif;

  include ('classes/Conexao.class.php');
  include ('classes/UsuarioDAO.class.php');

  $usuario = new UsuarioDAO();

$logout = $usuario->logout($_SESSION['login']);
?>
