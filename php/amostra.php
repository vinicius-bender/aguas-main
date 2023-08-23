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
<body>
<?php

    include_once "session.php";
    include_once "link.php";
    
    if ($logado == FALSE or NULL) {
        include_once "navbar.php";
    }else{
        include_once "navbarL.php";
    }

    $idAmostra = $_GET['ponto'];

    $query = mysqli_query($link,"SELECT * FROM AMOSTRA WHERE ponto = $idAmostra") or die (mysqli_error($link));
    $row = mysqli_fetch_assoc($query);
    if(mysqli_num_rows($query) == 0){
        ?>
        <script language="JavaScript" type="text/javascript"> alert("\n\n Amostra não encontrada \n\n")</script>
        <script language="JavaScript">window.location = "index.php";</script>
        <?php
    }
    
    $idLocal = $row['ponto'];
    $idCriador = $row['idCriador'];
    $idEditor = $row['idEditor'];

    $query2 = mysqli_query($link,"SELECT nome, ponto FROM LOCAL WHERE ponto = $idLocal") or die (mysqli_error($link));
    $query3 = mysqli_query($link,"SELECT nome FROM USUARIO WHERE idUsuario = $idCriador") or die (mysqli_error($link));
    $query5 = mysqli_query($link,"SELECT * FROM PERGUNTA"); 

    $row2 = mysqli_fetch_array($query2);
    $row3 = mysqli_fetch_assoc($query3);
    $row4 = mysqli_fetch_assoc($query4);

    date_default_timezone_set('America/Sao_Paulo');


    function formatarData($dataOriginal) {
        $novaData = date("d-m-Y", strtotime($dataOriginal));
        $novaData = str_replace('-', '/', $novaData);
        return $novaData;
    }

?>
<div class='row'>
    <div class='d-flex justify-content-center'>
        <div class='container-fluid card col-10 m-5 p-2'>
            <div class="text-center">
                <h1>Informações da amostra:</h1>
                <p>Amostra coletada no dia: <?php echo formatarData($row['dataColeta']) ?> em <?php echo $row2['nome'] ?></p>
                
                <?php 
                if ($logado == TRUE) {
                    if($idCriador != 0){
                        ?>
                    <p>Criado amostra registrada por: <?php echo $row3['nome'] ?></p>
                        <?php
                    }else{
                        ?>
                    <p>O usuario que criou esta amostra foi excluido!</p>
                        <?php
                    }
                    ?>
                    <?php if($idEditor != 0){
                        ?>
                    <p>Editado pela ultima vez por: <?php echo $row4['nome'] ?></p>
                        <?php
                    }
                }
                ?>
            </div>

<?php
    if ($logado == TRUE) {?>
        <div class='d-flex justify-content-center'>
            <form action="editaramostra.php" method="get" class='me-2'>
                <input type="hidden" name="idAmostra" value="<?php echo $row['ponto']; ?>">
                <button type="submit" class="btn btn-primary">Editar</button>
            </form>
            <form action="excluiramostra.php" method="post">
                <input type="hidden" name="idAmostra" value="<?php echo $row['ponto']; ?>">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Você deseja excluir esta amostra?');">Excluir</button>
            </form>
        </div>
<?php
    }
?>
        <div class="mx-5 mt-5 d-flex">
            <p class="me-1">Coletada em:</p>
            <a href="local.php?ponto=<?php echo $row2['ponto'] ?>"><?php echo $row2['nome'] ?></a>
        </div>
        <div class="mx-5 d-flex">
            <p class="me-1">Data de Referencia:</p>
            <p><?php echo formatarData($row['dataPerfuracao']) ?></p>
        </div>
        <div class="mx-5 d-flex">
            <p class="me-1">Data de coleta:</p>
            <p><?php echo formatarData($row['dataAnalise']) ?></p>
        </div>
        <?php while ($row5 = mysqli_fetch_assoc($query5)) {
            $titulo = $row5['titulo'];
            $visibilidade = $row5['visibilidade'];
            if($logado == TRUE or $visibilidade == 1){
        ?>
            <div class="mx-5 d-flex">
                <p class="me-1"><?php echo $titulo ?>:</p>
                <p><?php echo $row[$titulo]; ?></p>
            </div>
        <?php
        }
        }
        ?>
        
    </div>
</div>
</body>