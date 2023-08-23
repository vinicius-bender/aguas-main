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

    $link = mysqli_connect('localhost', 'root', 'rootadmin', 'siteaguas');
        if ($logado == FALSE or NULL) {
            ?>  
            <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Este conteudo é restrito \n\n")</SCRIPT>
            <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
            <?php
        }
?>
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-6 mt-5">
            <div id="map" style="height: 500px;"></div>
            <div class="mt-2">
                <button type="button" class="btn btn-primary" onclick="mudarMunicipio('iffar/ufsm')" class="mt-3'">IFFAR e UFSM</button>
                <button type="button" class="btn btn-primary" onclick="mudarMunicipio('frederico')" class="mt-3'">Frederico</button>
                <button type="button" class="btn btn-primary" onclick="mudarMunicipio('seberi')" class="mt-3'">Seberi</button>
                <button type="button" class="btn btn-primary" onclick="mudarMunicipio('taquarucu')" class="mt-3'">Taquaruçu do Sul</button>
                <button type="button" class="btn btn-primary" onclick="mudarMunicipio('palmitinho')" class="mt-3'">Palmitinho</button>
            </div>
        </div>
        <div class="gray ms-5 my-5 p-5 rounded-3 col-4">
            <form action="c_criarlocal.php" enctype='multipart/form-data' method="post">
                <h1>Adicional local de coleta</h1>
                <p>Adicione as informações para criar um local no mapa</p>
                <div class="mb-3 mt-3">
                    <label for="nome" class="form-label">Nome do Local:</label>
                    <input type="text" class="form-control" id="nome" placeholder="Nome do local" name="nome">
                </div>
                <div class="mb-3 mt-3">
                    <label for="img" class="form-label">Foto do Local:</label>
                    <input type="file" class="form-control" id="img" placeholder="Nome do local" name="foto">
                </div>
                <div class="mb-3">
                    <label for="lat" class="form-label">Latitude:</label>
                    <input type="text" class="form-control" readonly id="lat" placeholder="Latitude" name="lat" value="">
                </div>
                <div class="mb-3">
                    <label for="lat" id="lat" class="form-label">Longitude:</label>
                    <input type="text" class="form-control" readonly id="lng" placeholder="Longitude" name="lng" value="">
                </div>
                <div class="mb-3">
                    <label for="obs" class="form-label">Tipo de local:</label>
                    <input type="text" class="form-control" id="obs" placeholder="Ex: Lago, Rio, Coleta subterranea" name="tipo">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>
    <script src="../script/map.js"></script>
    <script>
        var marcador = {};
        map.on('click', function(e) {

            if (marcador != undefined) {
                map.removeLayer(marcador);
            };
            marcador = L.marker([e.latlng.lat,e.latlng.lng],{icon: Adicionar}).addTo(map);  
            document.getElementById('lat').value = e.latlng.lat;
            document.getElementById('lng').value = e.latlng.lng;
        });
        function mudarMunicipio(x){
            if(x == "iffar/ufsm"){
                map.setView([-27.394269338962207, -53.42852956659619]);
            }else if(x == "frederico"){
                map.setView([-27.358607273317116, -53.399438762936015]);
            }else if(x == "seberi"){
                map.setView([-27.483842144692485, -53.39941672588102]);
            }else if(x == "taquarucu"){
                map.setView([-27.399256401092764, -53.46704817973637]);
            }else if(x == "palmitinho"){
                map.setView([-27.35530307450152, -53.55827192685815]);
            }
        }
    </script>
<?php 
        $busca = mysqli_query($link,"SELECT * FROM LOCAL") or die (mysqli_error($link));

        if (isset($busca) && mysqli_num_rows($busca) > 0) {
            while ($puxa = mysqli_fetch_assoc($busca)) {
            ?> 
            <script>
                L.marker([<?php echo $puxa['lat']?>, <?php echo $puxa['lng']?>], {icon: Marcador}).addTo(map);
            </script> 
            <?php
            }
        }
?>