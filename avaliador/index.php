<?php

session_start();
if (!isset($_SESSION['login']) && !isset($_SESSION['senha'])):
    header('location: ../index.php');
endif;

if (isset($_SESSION['login']) && isset($_SESSION['senha'])):
    header('location: ../index.php');
endif;

?>
