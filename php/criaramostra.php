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

<body>
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

    $busca = mysqli_query($link,"SELECT * FROM LOCAL") or die (mysqli_error($link));
    $query2 = mysqli_query($link,"SELECT * FROM PERGUNTA") or die (mysqli_error($link));
?>
    <div class="row m-0">
            <div class="container-fluid d-md-flex d-sm-flex-column justify-content-center">
                <div class='col-xl-5 mx-5 mt-5'>
                    <div id="map" style="height: 500px;">
                        <script src="../script/map.js"></script>
                    </div>
                </div>
                <div class='col-xl-5 mx5 mt-5'>
                    <div class="container-fluid d-block mb-5" style="">
                        <div class="gray p-5 rounded-3">
                            <form action="c_criaramostra.php" method="post">
                                <h1>Registrar amostra</h1>
                                <p>Adicione as informações para registrar uma amostra</p>
                                <label for="data" class="form-label">Local de coleta:</label>
                                <select id = 'local' class="form-control" onchange='mudarLocal()' name="localColetado">
                                    <option value="" >Selecione...</option>
                                    <?php
                                        $busca = mysqli_query($link,"SELECT * FROM LOCAL") or die (mysqli_error($link));
                                        if (isset($busca) && mysqli_num_rows($busca) > 0) {?>
                                            <script>
                                                idMarcador = {};
                                            </script>
                                        <?php
                                            while ($puxa = mysqli_fetch_assoc($busca)) {
                                        ?>
                                            <option value="<?php echo $puxa['idLocal']; ?>"><?php echo $puxa['nome']; ?></option>
                                            <script>
                                                idMarcador['<?php echo $puxa['idLocal']; ?>'] = L.marker([<?php echo $puxa['lat']?>, <?php echo $puxa['lng']?>], {icon: Marcador,}).addTo(map).addEventListener("click", mudarLocal2);
                                                function mudarLocal2(e){
                                                    document.getElementById('local').value = '<?php echo $puxa['idLocal']; ?>'
                                                    mudarLocal()
                                                }
                                            </script>
                                        <?php
                                            }
                                        }else{
                                        ?>
                                            <option value="">Não ha locais disponiveis</option>
                                        <?php
                                        }
                                    ?>
                                </select>
                                <div class="mb-3 mt-3">
                                    <label for="dataReferencia" class="form-label">Data de referência:</label>
                                    <input type="date" class="form-control" name="dataReferencia">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="data" class="form-label">Data de coleta:</label>
                                    <input type="date" class="form-control" id="data" name="dataColeta">
                                </div>
                                <?php while ($row2 = mysqli_fetch_assoc($query2)) {
                                ?>
                                <div class="mb-3 mt-3">
                                    <label class="form-label"><?php echo $row2['titulo']?></label>
                                    <input type="text" class="form-control" placeholder="<?php echo $row2['titulo']?>" name="<?php echo $row2['idPergunta']?>">                   
                                </div>
                                <?php
                                }
                                ?>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    var valor1 = undefined
    function mudarLocal(){
        if(valor1 != undefined){
            idMarcador[valor1].setIcon(Marcador)
            idMarcador[document.getElementById('local').value].setIcon(Adicionar);
            valor1 = document.getElementById('local').value
            map.setView(idMarcador[document.getElementById('local').value].getLatLng())
        } else {
            idMarcador[document.getElementById('local').value].setIcon(Adicionar);
            valor1 = document.getElementById('local').value;
            map.setView(idMarcador[document.getElementById('local').value].getLatLng());
        };
    };
</script>
</body>