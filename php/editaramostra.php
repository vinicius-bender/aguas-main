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
        if ($logado == FALSE or NULL) {
            ?>  
            <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Este conteudo é restrito \n\n")</SCRIPT>
            <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
            <?php
            die();
        }
    include_once "navbarL.php";
    include_once "link.php";

    $ponto = $_GET['ponto'];
    $query = mysqli_query($link,"SELECT * FROM AMOSTRA WHERE ponto = '$ponto'");
    $query2 = mysqli_query($link,"SELECT * FROM LOCAL  WHERE ponto = '$ponto'") or die (mysqli_error($link));
    $row = mysqli_fetch_assoc($query);
    $row2 = mysqli_fetch_assoc($query2);
    // $query3 = mysqli_query($link,"SELECT * FROM PERGUNTA") or die (mysqli_error($link));

    function formatarData($dataOriginal) {
        $novaData = date("d-m-Y", strtotime($dataOriginal));
        $novaData = str_replace('/', '-', $novaData);
        return $novaData;
    }
?>
    <div class='container-fluid mt-5'>
        <div class='row'>
            <div class='col-6'>
                <div id="map" class="ms-5" style="height: 500px;">
                    <script src="../script/map.js"></script>
                </div>
            </div>
            <div class='col-6'>
                <div class="container-fluid d-block mb-5" style="">
                    <div class="gray p-5 rounded-3">
                        <form action="c_editaramostra.php" method="post">
                            <h1>Editar amostra</h1>
                            <p>Adicione as informações para editar a amostra</p>
                            <label for="data" class="form-label">Local de coleta:</label>
                            <input type="text" class="form-control" id="nome" placeholder="Nome do local" name="localColetado" readonly value="<?php echo $row2['nome']; ?>">
                            <script>
                                idMarcador = {};
                            </script>
                            <script>
                                idMarcador['<?php echo $row2['ponto']; ?>'] = L.marker([<?php echo $row2['lat']?>, <?php echo $row2['lng']?>], {icon: Marcador,}).addTo(map);
                                map.setView([<?php echo $row2['lat']?>, <?php echo $row2['lng']?>], 15);
                            </script>
                            <div class="mb-3 mt-3">
                                <label for="dataPerfuracao" class="form-label">Data de perfuração:</label>
                                <input type="text" class="form-control" value="<?php echo formatarData($row['dataPerfuracao'])?>" name="dataPerfuracao" placeholder="dia-mês-ano">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="data" class="form-label">Data de análise:</label>
                                <input type="text" class="form-control" value="<?php echo formatarData($row['dataAnalise'])?>" name="dataAnalise" placeholder="dia-mês-ano">
                            </div>
                            
                            <div class="mb-3 mt-3">
                                <label class="form-label">Cota terreno:</label>
                                <input type="text" class="form-control" placeholder="Cota terreno" name="cotaTerreno" value="<?php echo $row['cotaTerreno']?>">                  
                            </div>
                            
                            <div class="mb-3 mt-3">
                                <label class="form-label">Profundidade final:</label>
                                <input type="text" class="form-control" placeholder="Profundidade final" name="profundidadeFinal" value="<?php echo $row['profundidadeFinal']?>">
                            </div>

                            <div class="mb-3 mt-3">
                                <label class="form-label">Nível dinâmico:</label>
                                <input type="text" class="form-control" placeholder="Nível dinâmico" name="nivelDinamico" value="<?php echo $row['nivelDinamico']?>">
                            </div>
                            
                            <div class="mb-3 mt-3">
                                <label class="form-label">Nível Estático:</label>
                                <input type="text" class="form-control" placeholder="Nível Estático" name="nivelEstatico" value="<?php echo $row['nivelEstatico']?>">
                            </div>

                            <div class="mb-3 mt-3">
                                <label class="form-label">Vazão específica:</label>
                                <input type="text" class="form-control" placeholder="Vazão" name="vazaoEspecifica" value="<?php echo $row['vazaoEspecifica']?>">
                            </div>

                            <div class="mb-3 mt-3">
                                <label class="form-label">Vazão estabilização:</label>
                                <input type="text" class="form-control" placeholder="Vazão" name="vazaoEstabilizacao" value="<?php echo $row['vazaoEstabilizacao']?>">
                            </div>

                            <div class="mb-3 mt-3">
                                <label class="form-label">Condutividade:</label>
                                <input type="text" class="form-control" placeholder="Condutividade" name="condutividade" value="<?php echo $row['condutividade']?>">
                            </div>

                            <div class="mb-3 mt-3">
                                <label class="form-label">Cor:</label>
                                <input type="text" class="form-control" placeholder="Cor" name="cor" value="<?php echo $row['cor']?>">
                            </div>

                            <div class="mb-3 mt-3">
                                <label class="form-label">Cor Parâmetro:</label>
                                <input type="text" class="form-control" placeholder="Cor Parâmetro" name="corParametro" value="<?php echo $row['corParametro']?>">
                            </div>

                            <div class="mb-3 mt-3">
                                <label class="form-label">Odor:</label>
                                <input type="text" class="form-control" placeholder="Odor" name="odor" value="<?php echo $row['odor']?>">
                            </div>

                            <div class="mb-3 mt-3">
                                <label class="form-label">Sabor:</label>
                                <input type="text" class="form-control" placeholder="Sabor" name="sabor" value="<?php echo $row['sabor']?>">
                            </div>

                            <div class="mb-3 mt-3">
                                <label class="form-label">Temperatura:</label>
                                <input type="text" class="form-control" placeholder="Temperatura" name="temperatura" value="<?php echo $row['temperatura']?>">
                            </div>

                            <div class="mb-3 mt-3">
                                <label class="form-label">Turbidez:</label>
                                <input type="text" class="form-control" placeholder="Turbidez" name="turbidez" value="<?php echo $row['turbidez']?>">
                            </div>
                            <input type="hidden" name="ponto" value="<?php echo $ponto; ?>">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>