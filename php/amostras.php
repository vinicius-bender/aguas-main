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
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg="crossorigin=""></script>
</head>
<body>
    <?php

        include_once "session.php";
        include_once "link.php";
        include_once "navbarL.php";

        if ($logado == FALSE or NULL) {
            ?>
            <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Este conteudo é restrito \n\n")</SCRIPT>
            <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
            <?php

            die();
        }

        $pesquisa = $_GET['busca'];
        $pesquisa2 = $_GET['valor'];

        function formatarData($dataOriginal) {
            if ($dataOriginal == ""){
                return "Sem dados";
            }
            $novaData = date("d-m-Y", strtotime($dataOriginal));
            $novaData = str_replace('-', '/', $novaData);
            return $novaData;
        }
    ?>

    <div class='container-fluid'>
        <div class='row'>
            <div class='mt-5'>
                <div class="ms-5">
                    <h1>Amostras registradas:</h1>
                    <a class='btn btn-primary' href='criaramostra.php'>Registrar nova amostra</a>
                </div>
                <div class='d-flex justify-content-end my-5'>
                    <h2 class="me-2">Pesquisar por amostra:</h2>
                    <form action="amostras.php" method="get" class="d-flex">
                        <input type="text" name="busca" class="form-control">
                        <select name="valor" class="form-control">
                            <option value="municipio" selected>Município</option>
                            <option value="ponto">Número da amostra</option>
                            <option value="dataPerfuracao">Data de perfuração (dia-mês-ano)</option>
                            <option value="dataAnalise">Data de análise (dia-mês-ano)</option>
                        </select>
                        <button type="submit" class="btn btn-outline-dark ms-2">Buscar</button>
                    </form>
                    <form action="amostras.php" method="get" class="d-flex ms-2 me-5">
                        <button type="submit" class="btn btn-outline-dark ms-2">Limpar Busca</button>
                    </form>
                </div>
    <?php

        date_default_timezone_set('America/Sao_Paulo');
        if(isset($pesquisa)){
            if ($pesquisa2 === "dataPerfuracao" || $pesquisa2 === "dataAnalise"){
                $dataOri = $pesquisa;
                $pesquisa = date("m/d/Y", strtotime($dataOri));
                $pesquisa = str_replace('-', '/', $pesquisa);
                $busca = mysqli_query($link,"SELECT * FROM AMOSTRA WHERE `$pesquisa2` LIKE '%" . mysqli_real_escape_string($link, $pesquisa) . "%'");
            }else{
                $busca = mysqli_query($link,"SELECT * FROM AMOSTRA WHERE `$pesquisa2` LIKE '%" . mysqli_real_escape_string($link, $pesquisa) . "%'");
            }
        }else{
            $busca = mysqli_query($link,"SELECT * FROM AMOSTRA") or die (mysqli_error($link));
        }
        
        if (isset($busca) && mysqli_num_rows($busca) > 0) { 
            ?>
                <div class='overflow-auto scroll mx-5 mt-5' style="max-height: 650px">
            <?php
            while ($puxa = mysqli_fetch_assoc($busca)) {
                
                // $dataOriginal = $puxa['dataAnalise'];
                // $novaData = date("d-m-Y", strtotime($dataOriginal));
                // $novaData = str_replace('-', '/', $novaData);

                $ponto = $puxa['ponto'];
                $busca2 = mysqli_query($link,"SELECT * FROM LOCAL WHERE ponto = '$ponto'") or die (mysqli_error($link));
                $puxa2 = mysqli_fetch_array($busca2);

                $nAmostra = $puxa['ponto'];
                $nomeL = $puxa2['nome'];

    ?>

                <div class='card mb-1'>
                    <div class='card-body d-flex justify-content-between'>
                        <h2 style='font-size: 20px;' class="m-0">Ponto do poço: <?php echo $nAmostra ?> - Coletada dia: <?php echo formatarData($puxa['dataAnalise']) ?> em: <?php echo $nomeL ?> </h2>
                        <div class='d-flex justify-content-end'>
                            <form action="amostra.php" method="get" class='me-2'>
                                <input type="hidden" name="ponto" value="<?php echo $puxa['ponto'] ?>">
                                <button type="submit" class="btn btn-primary">Ver amostra</button>
                            </form>
                            <form action="editaramostra.php" method="get" class='me-2'>
                                <input type="hidden" name="ponto" value="<?php echo $puxa['ponto']; ?>">
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </form>
                            <form action="excluiramostra.php" method="post">
                                <input type="hidden" name="ponto" value="<?php echo $puxa['ponto']; ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Você deseja excluir esta amostra?');">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
                
            <?php
                }
            ?>
                </div>
            <?php
            }else{
            ?>
                <p class="mt-5">Ainda não há amostras registradas</p>
            <?php 
            }
    ?>
    </div>
</body>