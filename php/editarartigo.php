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
    include_once "link.php";
    include_once "session.php";

    if ($logado == FALSE or NULL) {
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Este conteudo é restrito \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
        die();
    }
    
    include_once "navbarL.html";
    
    $idArtigo = $_GET['idArtigo'];
    $busca = mysqli_query($link,"SELECT * FROM artigo WHERE idArtigo = $idArtigo") or die (mysqli_error($link));
    $row = mysqli_fetch_assoc($busca);

    $nome = $row['nome'];
    $resumo = $row['resumo'];
    $pdf = $row['pdf'];
    $links = $row['link'];

    $path = "pdf/";
    $pdf_nome = str_replace($path,"",$pdf);
?>
    <div class="row m-0">
            <div class="container-fluid d-md-flex d-sm-flex-column justify-content-center">
                <div class='col-xl-5 mx5 mt-5'>
                    <div class="container-fluid d-block mb-5" style="">
                        <div class="gray p-5 rounded-3">
                            <form action="c_editarartigo.php" method="post">
                                <h1>Editar artigo</h1>
                                <p>Adicione as informações para alterar um artigo</p>
                                <div class="mb-3 mt-3">
                                    <label for="nome" class="form-label">Nome do artigo:</label>
                                    <input type="text" class="form-control" name="nome" value='<?php echo $nome?>'>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="resumo" class="form-label">Resumo do artigo:</label>
                                    <textarea type="text" class="form-control" name="resumo" style="resize: none;"><?php echo $resumo?></textarea>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="pdf" class="form-label">Alterar PDF:</label>
                                    <input type="file" class="form-control" name="pdf" files="<?php echo $pdf?>">
                                </div>
                                <?php if($pdf != ""){?>
                                <div class="mb-3 mt-3 d-flex flex-column">
                                    <a href="<?php echo $pdf ?>" download>Arquivo atual: <?php echo $pdf_nome?><a>
                                </div>
                                <div class="mb-2 mt-2">
                                    <input type="checkbox" class="form-check-input" name="excluir"></input>
                                    <label for="checkbox" class="form-check-label">Excluir PDF</label>
                                </div>
                                <?php } ?>
                                <div class="mb-3 mt-3">
                                    <label for="link" class="form-label">Adicionar link para o artigo completo:</label>
                                    <input type="text" class="form-control" name="link" value='<?php echo $links?>'>
                                </div>
                                <input type="hidden" name="idArtigo" value="<?php echo $idArtigo; ?>">
                                <button type="submit" class="btn btn-primary justify-self-center">Enviar</button>
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