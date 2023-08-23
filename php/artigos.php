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
                    <a class="nav-link active" href="artigos.php">Artigos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sobre.php">Sobre</a>
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
                    <a class="nav-link active" href="artigos.php">Artigos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sobre.php">Sobre</a>
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
    if(isset($_GET['pagina'])){
        $pagina = $_GET['pagina'];
    }
    else{
        $pagina = 1;
    }
    $resultados = 10;

    $limite_inicio = ($pagina - 1) * $resultados;
    $busca = $_GET['busca'];
    $query = mysqli_query($link,"SELECT * FROM artigo WHERE nome LIKE '%" . mysqli_real_escape_string($link, $busca) . "%' LIMIT $limite_inicio, $resultados");
    $contagem = mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(*) as count FROM artigo WHERE nome LIKE '%" . mysqli_real_escape_string($link, $busca) . "%'"));
if (isset($query) && mysqli_num_rows($query) > 0) {
?>
<div class="container-fluid">
    <div class="row m-0 d-flex justify-content-center">
    <div class='col-10'>
        <h1 class="mt-5">Artigos registrados:</h1>
        <?php if ($logado == true and $nivelUsuario > 1) {?>
            <div>
                <a class='btn btn-primary' href='criarartigo.php'>Criar novo artigo</a>
            </div>
        <?php } ?>
        <div class='d-flex justify-content-end my-5'>
            <h2>Pesquisar por artigo:</h2>
            <form action="artigos.php" method="get" class="ms-4 d-flex">
                <input type="text" name="busca" class="form-control">
                <button type="submit" class="btn btn-outline-dark ms-2">Buscar</button>
            </form>
            <form action="artigos.php" method="get" class="d-flex ms-2">
                <button type="submit" class="btn btn-outline-dark ms-2">Limpar Busca</button>
            </form>
        </div>
        <?php while($row = mysqli_fetch_assoc($query)) {?>
        <div class="card mb-3">
            <div class="p-5">
                <h1><?php echo $row['nome'] ?></h1>
                <p><?php echo $row['resumo'] ?></p>
            <?php if($row['link'] != null or $row['pdf'] != null){ ?>
                <h2>Anexos:</h2>
            <?php } ?>
            <?php if($row['link'] != null ){ ?>
                <a class="btn btn-primary" href="<?php echo $row['link'] ?>">Link do artigo completo</a>
            <?php } ?>
            <?php if($row['pdf'] != null ){ ?>
                <a class="btn btn-primary" download href="<?php echo $row['pdf'] ?>">Baixar PDF</a>
            <?php } ?>
            <?php if ($logado == TRUE and $nivelUsuario > 1) {?>
                <div class='d-flex justify-content-end'>
                    <form action="editarartigo.php" method="get" class='me-2'>
                        <input type="hidden" name="idArtigo" value="<?php echo $row['idArtigo']; ?>">
                        <button type="submit" class="btn btn-success">Editar</button>
                    </form>
                    <form action="excluirartigo.php" method="post">
                        <input type="hidden" name="idArtigo" value="<?php echo $row['idArtigo']; ?>">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você deseja excluir este artigo?');">Excluir</button>
                    </form>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php }
        $paginas = ceil($contagem['count'] / $resultados);
        $pagina_inicial = max($pagina - 2, 1);
        $pagina_final = min($pagina + 2, $paginas);
        ?>
        <div class="container-fluid d-flex justify-content-center my-5">
        <?php
        if ($pagina > 1) { ?>
            <a class="btn btn-primary mx-2" href="artigos.php?pagina=<?php echo ($pagina - 1)?>&busca=<?php echo $busca ?>"><</a>
    <?php }
        for ($i = max(1, $pagina - 3); $i <= min($pagina + 3, $paginas); $i++) { 
        if($i == $pagina){ ?>
            <a class="btn btn-primary mx-2" href="artigos.php?pagina=<?php echo $i?>&busca=<?php echo $busca ?>"><?php echo $i ?></a>
        <?php } else { ?>
            <a class="btn btn-outline-primary mx-2" href="artigos.php?pagina=<?php echo $i?>&busca=<?php echo $busca ?>"><?php echo $i ?></a>
        <?php }
        }
        if ($pagina < $paginas) { ?>
            <a class="btn btn-primary mx-2" href="artigos.php?pagina=<?php echo ($pagina + 1)?>&busca=<?php echo $busca ?>">></a>
        <?php 
            } 
        ?>
        </div>
    </div>
    
<?php } else { ?>
<div class="container-fluid">
    <div class="row m-0 d-flex justify-content-center">
        <div class='col-10'>
            <h1 class="mt-5">Artigos registrados:</h1>
            <div class='d-flex justify-content-end my-5'>
                <h2>Pesquisar por artigo:</h2>
                <form action="artigos.php" method="get" class="ms-4 d-flex">
                    <input type="text" name="busca" class="form-control">
                    <button type="submit" class="btn btn-outline-dark ms-2">Buscar</button>
                </form>
                <form action="artigos.php" method="get" class="d-flex ms-2">
                    <button type="submit" class="btn btn-outline-dark ms-2">Limpar Busca</button>
                </form>
            </div>
            <div class="card text-center mt-5">
                <h1>Não foi encontrado nem um artigo</h1>
                <?php if ($logado == true) {?>
                    <div class='my-3'>
                        <a class='btn btn-primary' href='criarartigo.php'>Criar novo artigo</a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php } ?>
