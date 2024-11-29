<?php
    session_start();   
    unset(
        $_SESSION
    );   
    $_SESSION['logindeslogado'] = "Deslogado com sucesso";
    session_destroy();
    //redirecionar o usuario para a página de login
    header(header: "Location: ../View/index.php");
?>