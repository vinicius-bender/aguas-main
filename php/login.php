<?php
    include_once "session.php";

    if($logado == true){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Você já esta logado \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
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
                    <a class="nav-link" href="sobre.php">Sobre</a>
                </li>
            </ul>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" href="login.html">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container d-block pt-5" style="width: 500px;">
        <div class="gray p-5 my-5 rounded-3">
            <form action="c_login.php" method="post">
                <h1>Login</h1>
                <p>Registre-se para adicionar informações ao mapa</p>
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                </div>
                <label class="form-lable" for="senha">Senha</label>
                <div class="d-flex">
                    <input id="senha1" class="form-control d-flex" placeholder="Senha" type="password" name="senha">
                    <button type="button" onclick="trocarVisibilidade()" class="ms-2 text-aligh-center btn btn-light"><i id="button1" class="d-flex justify-content-center bi bi-eye-slash-fill"></i></button>
                </div>
                <div class="mb-3">
                    <label for="matricula" class="form-label">Matricula:</label>
                    <input type="text" class="form-control" id="senha" placeholder="Matricula" name="matricula">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
              </form>
        </div>
    </div>
</body>
<script>
        var button1 = document.getElementById("button1");

        var senha1 = document.getElementById("senha1");

        function trocarVisibilidade(){
            if(senha1.type === "password"){
                senha1.type = "text";
                button1.classList.remove("bi-eye-slash-fill");
                button1.classList.add("bi-eye-fill");
            }else{
                senha1.type = "password";
                button1.classList.remove("bi-eye-fill");
                button1.classList.add("bi-eye-slash-fill");
            }
        }
</script>
</html>