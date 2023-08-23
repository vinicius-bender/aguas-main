<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Águas</title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin=""/>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
</head>

<?php
    include_once "session.php";
    include_once "link.php";

    if ($logado == FALSE or NULL) {
    ?>
    <nav class="navbar navbar-expand dblue navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Mapa</a>
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
                    <a class="nav-link active" href="index.php">Mapa</a>
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
                    <a class='nav-link' href='menuadministrador.php'>Menu do Administrador</a> 
                </li>
                <li class='nav-item'> 
                    <a class='nav-link' href='sair.php'>Sair</a> 
                </li>
            </ul>
        </div>
    </nav>
    <?php }

    $busca = mysqli_query($link,"SELECT * FROM LOCAL") or die (mysqli_error($link));
?>
<body>
    <div class="container-fluid">
        <div class="row mt-5 m-0">
            <div class="col-lg-7 mx-lg-5 p-0 mb-5">
                <div id="map" class="custom-height"></div>
                <script src="../script/map.js"></script>
                <div class="mt-2">
                    <button type="button" class="btn btn-primary" onclick="mudarMunicipio('iffar/ufsm')" class="mt-3'">IFFAR e UFSM</button>
                    <button type="button" class="btn btn-primary" onclick="mudarMunicipio('frederico')" class="mt-3'">Frederico</button>
                    <button type="button" class="btn btn-primary" onclick="mudarMunicipio('seberi')" class="mt-3'">Seberi</button>
                    <button type="button" class="btn btn-primary" onclick="mudarMunicipio('taquarucu')" class="mt-3'">Taquaruçu do Sul</button>
                    <button type="button" class="btn btn-primary" onclick="mudarMunicipio('palmitinho')" class="mt-3'">Palmitinho</button>
                </div>
            </div>
            <div class="align-self-center col-lg-4 mb-5">
                <div id="texto">
                    <h1>Mapa Interativo</h1>
                    <p>Selecione um dos pontos indicados no mapa para ver suas informações</p>
                </div>
                <div id="cardMenu" class="card" hidden>
                    <div class="ratio ratio-16x9">
                        <img src="" alt="imagemLocal" class="rounded col-12" id="img">
                    </div>
                    <div class="card-body">
                        <h3 id="nomeLocal" class="mt-1"></h3>
                        <h3 id="tipo" class="text-secondary" style="font-size: 20px"></h3>
                        <div class="text-center">
                            <a id="verMais" type="button" href="" class="btn btn-primary">Ver Mais</a>
                        </div>
                    </div>
                </div>
                <?php
                if ($logado == TRUE) { ?>
                    <div class='list col-12 mt-5'>
                        <a href='locais.php' class="btn btn-primary d-block mb-2"  style="font-size: 25px">Ver locais de coleta</a> <br>
                        <a href='amostras.php' class="btn btn-primary d-block"  style="font-size: 25px">Ver amostras registradas</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
<?php
    if (isset($busca) && mysqli_num_rows($busca) > 0) {
        while ($puxa = mysqli_fetch_assoc($busca)) {
            ?> 
                <script>
                    L.marker([<?php echo $puxa['lat']?>, <?php echo $puxa['lng']?>], {icon: Marcador}).addTo(map).addEventListener("click", infoMarcador);
                    valor1 = undefined;
                    function infoMarcador(e) {
                        document.getElementById("img").src = "<?php echo$puxa['foto'] ?>";                        
                        document.getElementById("nomeLocal").innerHTML = "<?php echo$puxa['nome'] ?>";
                        document.getElementById("tipo").innerHTML = "<?php echo$puxa['tipo'] ?>";
                        document.getElementById("verMais").href = "local.php?ponto=<?php echo$puxa['ponto'] ?>";
                        document.getElementById("verMais").href = "local.php?ponto=<?php echo$puxa['ponto'] ?>";
                        texto.setAttribute("hidden","hidden");
                        cardMenu.removeAttribute("hidden");
                        map.setView([e.latlng.lat, e.latlng.lng]);
                        if(valor1 != undefined){
                            valor1.target.setIcon(Marcador),
                            e.target.setIcon(Adicionar),
                            valor1 = e;
                        } else {
                            e.target.setIcon(Adicionar),
                            valor1 = e;
                        }
                    };

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
        }
    }
?>
</html>