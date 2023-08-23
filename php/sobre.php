<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre</title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</head>
<?php

require_once "link.php";
require_once "session.php";

if ($logado == FALSE or NULL) {
?>
<nav class="navbar navbar-expand dblue navbar-dark">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Mapa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="artigos.php">Artigos</a>
            </li>
            <li class="nav-item">
                <a class="nav-lin activek" href="sobre.php">Sobre</a>
            </li>
        </ul>
        <ul class="navbar-nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
        </ul>
    </div>
</nav>
<?php }else{ ?>
<nav class="navbar navbar-expand dblue navbar-dark">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Mapa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="artigos.php">Artigos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="sobre.php">Sobre</a>
            </li>
        </ul>
        <ul class="navbar-nav justify-content-end">
            <li class='nav-item'> 
                <a class='nav-link' href='menuadministrador.php'>Menu do Administrador</a> 
            </li>
            <li class='nav-item'> 
                <a class='nav-link' href='sair.php'>Sair</a> 
            </li>
        </ul>
    </div>
</nav>
<?php }

?>
<body>
    <div class="container mt-4 p-5 gray rounded">
        <h1>Sobre</h1>
        <p>Lorem ipsum...</p>
    </div>
</body>
</html>