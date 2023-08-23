<?php
    include_once "session.php";

    if($logado == false){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Conteúdo restrito \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
        die();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Águas</title>
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
                <li class='nav-item'> 
                    <a class='nav-link active' href='criarusuario.php'>Menu do Administrador</a> 
                </li>
                <li class='nav-item'> 
                    <a class='nav-link' href='sair.php'>Sair</a> 
                </li>
            </ul>
        </div>
    </nav>
    <div class="row m-0 d-flex justify-content-center">
            <div class="gray container mx-5 rounded col-4 py-3 my-5">
                <form action="c_criarusuario.php" class="mx-3 mt-2" method="post">
                    <h1>Adicionar usuario</h1>
                    <p>Adicione as informações abaixo para criar uma conta para um usuario</p>
                    <div class="mt-3">
                        <label class="form-lable" for="email">Email</label>
                        <input class="form-control" placeholder="Email" type="email" name="email">
                    </div>
                    <div class="mt-3">
                        <label class="form-lable" for="senha">Senha</label>
                        <div class="d-flex">
                            <input id="senha1" class="form-control d-flex" placeholder="Senha" type="password" name="senha">
                            <button type="button" onclick="trocarVisibilidade()" class="ms-2 text-aligh-center btn btn-light"><i id="button1" class="d-flex justify-content-center bi bi-eye-slash-fill"></i></button>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-lable" for="senha">Repita a senha</label>
                        <div class="d-flex">
                            <input id="senha2" class="form-control d-flex pl-5" placeholder="Senha" type="password" name="senha2">
                            <button type="button" onclick="trocarVisibilidade2()" class="ms-2 text-aligh-center btn btn-light"><i id="button2" class="d-flex justify-content-center bi bi-eye-slash-fill"></i></button>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-lable" for="nome">Nome</label>
                        <input class="form-control" placeholder="Nome" type="text" name="nome">
                    </div>
                    <div class="my-3">
                        <label class="form-lable" for="matricula">Matrícula</label>
                        <input class="form-control" placeholder="Matrícula" type="text" class="matricula" name="matricula">
                    </div>
                    <div class="my-3">
                        <label class="form-lable" for="acesso">Nível de acesso</label>
                        <select class="form-control" name="nivel">
                            <option value="1">Nivel 1</option>
                            <option value="2">Nivel 2</option>
                        </select>
                        <p class="mt-2">
                            Os niveis de acesso são divididos em: <br><br>
                            Nivel 1 - Pode somente adicionar remover e editar entradas ao mapa; <br><br>
                            Nivel 2 - Possui total controle sobre a plataforma, pode criar artigos, adicionar usuarios além de poder realizar as mesmas ações do Nivel 1.
                        </p>
                    </div>
                    <button class="my-3 ms-3 btn btn-primary" type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        var button1 = document.getElementById("button1");
        var button2 = document.getElementById("button2");

        var senha1 = document.getElementById("senha1");
        var senha2 = document.getElementById("senha2");

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
        
        function trocarVisibilidade2(){
            if(senha2.type === "password"){
                senha2.type = "text";
                button2.classList.remove("bi-eye-slash-fill");
                button2.classList.add("bi-eye-fill");
            }else{
                senha2.type = "password";
                button2.classList.remove("bi-eye-fill");
                button2.classList.add("bi-eye-slash-fill");
            }
        }
    </script>
</body>
</html>