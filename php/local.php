<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Águas</title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css"integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14="crossorigin=""/>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg="crossorigin=""></script>
</head>
<?php

    include_once "session.php";
    include_once "link.php";
    if ($logado == NULL or FALSE) {
        include_once 'navbar.php';
    }elseif ($logado = TRUE) {
        include_once 'navbarL.php';
    }

    $idLocal = $_GET['ponto'];
    $busca = mysqli_query($link,"SELECT * FROM LOCAL WHERE ponto = '$idLocal'") or die (mysqli_error($link));
    $puxa = mysqli_fetch_assoc($busca);
    $idCriador = $puxa['idCriador'];
    $idEditor = $puxa['idEditor'];
    
    $busca2 = mysqli_query($link,"SELECT * FROM AMOSTRA WHERE ponto = '$idLocal' ORDER BY dataAnalise") or die (mysqli_error($link));
    $busca3 = mysqli_query($link,"SELECT nome FROM USUARIO WHERE idUsuario = '$idCriador'") or die (mysqli_error($link));
    $busca4 = mysqli_query($link,"SELECT nome FROM USUARIO WHERE idUsuario = '$idEditor'") or die (mysqli_error($link));
    $puxa3 = mysqli_fetch_assoc($busca3);
    $puxa4 = mysqli_fetch_assoc($busca4);

    function formatarData($dataOriginal) {
        $novaData = date("d-m-Y", strtotime($dataOriginal));
        $novaData = str_replace('-', '/', $novaData);
        return $novaData;
    }
?>
<body>
    <div class='container-fluid'>
        <div class='row'>
            <div class="col-4 mt-5">
                <div id="map" style="height: 350px;" class="ms-5"></div>
                    <script>
                        var map = L.map('map',{ zoomControl: false , scrollWheelZoom: false , doubleClickZoom:false, boxZoom: false}).setView([<?php echo $puxa['lat']; ?>,<?php echo $puxa['lng']; ?>], 17);
                        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            minZoom: 15,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        }).addTo(map);
                        var Marcador = L.icon({
                            iconUrl: 'marcador.png',
                            iconSize:     [32, 32], 
                            iconAnchor:   [16, 32],
                        });
                        map.dragging.disable();
                        L.marker([<?php echo $puxa['lat']?>, <?php echo $puxa['lng']?>], {icon: Marcador}).addTo(map).addEventListener("click", myFunction);
                        function myFunction(e) {
                            map.flyTo([e.latlng.lat, e.latlng.lng],17);
                        };
                        
                    </script>   
            <div class='list mt-3 ms-5' style='font-size:20px'>
                <h1 class="mb-0"> <?php echo $puxa['nome']; ?></h1>
                <p class="mb-0"> <?php echo $puxa['tipo']; ?></p>
                <p> <?php echo $puxa['lat']; ?>, <?php echo $puxa['lng']; ?></p>
                <?php if($nivelUsuario > 1){?>
                <p>Adicionado por: <?php echo $puxa3['nome']?></p>
                <?php if($idEditor != 0){ ?>
                <p>Ultima vez editado por: <?php echo $puxa4['nome']?></p>
                <?php } 
                }
                ?>
                </div>
            <?php if ($logado == TRUE) {?>
                    <div class='d-flex justify-content-center mt-3 ms-5'>
                        <form action="editarlocal.php" method="get" class='me-3'>
                            <input type="hidden" name="ponto" value="<?php echo $puxa['ponto']; ?>">
                            <button type="submit" class="btn btn-primary" style='width: 100px;'>Editar</button>
                        </form>
                        <form action="excluirlocal.php" method="post">
                            <input type="hidden" name="ponto" value="<?php echo $puxa['ponto']; ?>">
                            <button type="submit" class="btn btn-primary" style='width: 100px;' onclick="return confirm('Você deseja excluir este local?\nTodas as amostras ligadas a este local tambem serão excluidas');">Excluir</button>
                        </form>
                    </div>
                </div>
                <?php 
                    }else{ 
                ?> 
                    </div> 
                <?php 
                    } 
                ?>
            <div class='col-8 mt-5'>
        
<?php
    if (isset($busca2) && mysqli_num_rows($busca2) > 0) {

            date_default_timezone_set('America/Sao_Paulo');

            ?>
            <h1 style='font-size:40px' class='mt-3'>Amostras coletadas neste local:</h1>
            <div class='overflow-auto me-5' style="height: 700px;">
            <?php
        while ($puxa2 = mysqli_fetch_assoc($busca2)) {

            // $dataOriginal = $puxa2['dataAnalise'];
            // $novaData = date("d-m-Y", strtotime($dataOriginal));

            ?>
                <div class='card'>
                    <div class='card-body'>
                        <div class='d-flex justify-content-start'>
                            <h2 style="font-size: 20px;" class='align-self-center mb-0'>Ponto do poço: <?php echo $puxa2['ponto']?> - Coletada dia <?php echo formatarData($puxa2['dataAnalise']); ?></h2>
                        </div>
                        <div class='d-flex justify-content-end'>
                            <a class='btn btn-primary align-self-center ' href="amostra.php?ponto=<?php echo $puxa2['ponto']?>">Ver Mais</a> <br>
                        </div>
                    </div>
                </div>    
            <?php
        };
    } else { ?>
        <h1>Ainda não há amostras registradas neste local</h1>
    </div>
    <?php };
?>
</body>