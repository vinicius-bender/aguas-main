<?php
    include_once "link.php";
    include_once "session.php";

    if($logado == null or false){
        ?>  
        <script language="JavaScript" type="text/javascript"> alert ("\n\n Conteudo restrito \n\n")</script>
        <script language="JavaScript">window.location = "index.php";</script>
        <?php
        die();
    }else if($nivelUsuario != 3){
        ?>  
        <script language="JavaScript" type="text/javascript"> alert ("\n\n Conteudo restrito \n\n")</script>
        <script language="JavaScript">window.location = "index.php";</script>
        <?php
        die();
    }
    $query = mysqli_query($link,"SELECT * FROM USUARIO WHERE idUsuario != $idUsuarioS");

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
                    <a class='nav-link active' href='menuadministrador.php'> Menu do Administrador</a> 
                </li>
                <li class='nav-item'> 
                    <a class='nav-link' href='sair.php'> Sair </a> 
                </li>
            </ul>
        </div>
    </nav>
    <div class="row m-0">
        <div class="col-8 container gray p-5 my-5">
            <h1>Olá <?php echo $nomeUsuario ?>!</h1>
            <div class="d-flex">
                <a class="btn btn-primary me-2" href="editarformulario.php">Editar formulario</a>
                <a class="btn btn-primary" href="criarusuario.php">Criar novo usuario</a>
            </div>
            <p>Lista de usuários:</p>
            <div class="overflow-auto pe-1" style="height: 500px;">
            <?php
                if(mysqli_num_rows($query) < 0){
                    ?>
                    </div>
                    <h2>Não há usuarios registrados</h2> 
                    <?php
                }else{
                    while($row = mysqli_fetch_assoc($query)){

                        $idUsuario = $row['idUsuario'];
                        $nome = $row['nome'];
                        $email = $row['email'];
                        $matricula = $row['matricula'];
                        $nivel = $row['nivel'];

                        ?>
                        <div class="card mt-2 py-3 px-5">
                            <h1> <?php echo $nome ?> </h1>
                            <p>Nivel de acesso: <?php echo $nivel ?> </p>
                            <p>Email: <?php echo $email ?> </p>
                        <?php
                            if($matricula != null){ ?>
                                <p>Matricula: <?php echo $matricula ?> </p>
                        <?php
                            }
                        ?>
                            <div class='d-flex justify-content-end'>
                                <form action="editarusuario.php" method="get" class='me-2'>
                                    <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
                                    <button type="submit" class="btn btn-primary">Editar</button>
                                </form>
                                <form action="excluirusuario.php" method="post">
                                    <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Você deseja excluir este usuario?');">Excluir</button>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                }
            ?>

            </div>
        </div>
    </div>
</body>