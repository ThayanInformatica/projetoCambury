<?php
session_start();
if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])):
endif;

include('../classes/Conexao.class.php');
include('../classes/UsuarioDAO.class.php');

$usuario = new UsuarioDAO();

$login = $_SESSION['login'];

$nivel = $usuario->nivelDeUsuario($login);
$_SESSION['nivel'] = $nivel;

if ($nivel >= 0) {
    header('location: criar-projeto.php');
}

?>
