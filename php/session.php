<?php
    error_reporting(0);
    session_start();

    $idUsuarioS = $_SESSION['idUsuario'];
    $nomeUsuario = $_SESSION['nomeUsuario'];
    $matriculaUsuario = $_SESSION['matriculaUsuario'];
    $nivelUsuario = $_SESSION['nivelUsuario'];

    $logado = $_SESSION['logado'];
    if($logado == NULL or FALSE){
        $logado = FALSE;
    }
    else{
        $logado = TRUE;
    }
?>
