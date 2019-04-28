<?php

header('location: ../index.php');

session_start();
if (isset($_SESSION['login']) && isset($_SESSION['senha']) && isset($_SESSION['nivel'])):
    if (isset($_SESSION['nivel'])) {
        $nivel = $_SESSION['nivel'];
        header('location: ../index.php');

    }

endif;
?>
