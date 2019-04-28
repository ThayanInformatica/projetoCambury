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

include('../classes/Conexao.class.php');
include('../classes/UsuarioDAO.class.php');

$usuario = new UsuarioDAO();

$login = $_SESSION['login'];

$nivel = $usuario->nivelDeUsuario($login);
$_SESSION['nivel'] = $nivel;

?>
