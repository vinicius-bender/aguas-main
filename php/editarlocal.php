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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<?php

    include_once "session.php";
    include_once "navbarL.php";
    include_once "link.php";

    if ($logado == FALSE or NULL) {
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Este conteudo é restrito \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
        die();
    }
    $ponto = $_GET['ponto'];
    if ($ponto === NULL){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Erro desconhecido \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
        die();
    }
    $busca = mysqli_query($link,"SELECT * FROM LOCAL WHERE ponto = '$ponto'") or die (mysqli_error($link));
    $puxa = mysqli_fetch_assoc($busca);
    $nome = $puxa['nome'];
    $foto = $puxa['foto'];
    $lat = $puxa['lat'];
    $lng = $puxa['lng'];
    $tipo = $puxa['tipo'];
?>
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div id="map" class='col-6 mt-5' style="height: 500px;"></div>
        <div class="gray ms-5 my-5 p-5 rounded-3 col-4">
            <form action="c_editarlocal.php" method="post" enctype='multipart/form-data'>
                <h1>Alterar local de coleta</h1>
                <p>Adicione as informações para alterar um local do mapa</p>
                <div class="mb-3 mt-3">
                    <label for="nome" class="form-label">Nome do local:</label>
                    <input type="text" class="form-control" id="nome" placeholder="Nome do local" name="nome" value='<?php echo $nome?>'>
                </div>
                <div class="mb-3 mt-3">
                    <label for="foto" class="form-label">Foto do Local:</label>
                    <input type="file" class="form-control" name="foto">
                    <?php if($foto != ""){ ?>
                    <label class="mt-3" for="foto" class="form-label">Foto atual:</label>
                    <div class="ratio ratio-16x9 mt-2">
                        <img src="<?php echo $foto?>" alt="imagemLocal" class="rounded col-12">
                    </div>
                    <a class="btn btn-primary mt-1" download href="<?php echo $foto ?>">Baixar Foto</a>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="lat" class="form-label">Latitude:</label>
                    <input type="text" class="form-control" id="lat" placeholder="Latitude" name="lat" readonly value="<?php echo $lat?>">
                </div>
                <div class="mb-3">
                    <label for="lng" class="form-label">Longitude:</label>
                    <input type="text" class="form-control" id="long" placeholder="Longitude" name="lng" readonly value="<?php echo $lng?>">   
                </div>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo do local:</label>
                    <input type="text" class="form-control" placeholder="Exemplo: Rio, lago..." name="tipo" value="<?php echo $tipo?>">
                </div>
                    <input type="hidden" name="ponto" value="<?php echo $ponto; ?>">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>
    <script src="../script/map.js"></script>
    <script>
        var marcador = L.marker([<?php echo $puxa['lat']?>, <?php echo $puxa['lng']?>],{icon: Adicionar}).addTo(map);;
        map.on('click', function(e) {

            if (marcador != undefined) {
                map.removeLayer(marcador);
            };
            marcador = L.marker([e.latlng.lat,e.latlng.lng],{icon: Adicionar}).addTo(map); 
            document.getElementById('lat').value = e.latlng.lat;
            document.getElementById('long').value = e.latlng.lng;
        });

    </script>
<?php 
        $busca2 = mysqli_query($link,"SELECT * FROM LOCAL WHERE ponto != $ponto") or die (mysqli_error($link));

        if (isset($busca2) && mysqli_num_rows($busca2) > 0) {
            while ($puxa2 = mysqli_fetch_assoc($busca2)) {
            ?> 
            <script>
                L.marker([<?php echo $puxa2['lat']?>, <?php echo $puxa2['lng']?>], {icon: Marcador}).addTo(map).addEventListener("hover", myFunction);
                function myFunction() {

                };
            </script> 
            <?php
            }
        }
?>