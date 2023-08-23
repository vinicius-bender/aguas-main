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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
<?php
    include_once "session.php";

    if ($logado == FALSE or NULL) {
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Este conteudo é restrito \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
    }
    
    include_once "navbarL.php";
    include_once "link.php";

    $i = 0;
    $query = mysqli_query($link,"SELECT * FROM LOCAL") or die (mysqli_error($link));
    $query2 = mysqli_query($link,"SELECT * FROM PERGUNTA") or die (mysqli_error($link));

?>
    <div class="row m-0 d-flex justify-content-center mt-5">
        <div class="container-fluid col-5 d-block mb-5" style="">
            <div class="gray p-5 rounded-3">
                <form action="c_adicionarformulario.php" enctype='multipart/form-data' method="post">
                    <h1>Editar formulario</h1>
                    <p>Preencha o campo abaixo para adicionar uma nova pergunta ao formulario</p>
                    <div class="mb-3 mt-3">
                        <label for="titulo" class="form-label">Titulo da pergunta:</label>
                        <input type="text" class="form-control" name="titulo" placeholder="Exemplo: Ph, Condutividade...">
                    </div>
                    <div class="mb-3 mt-3">
                        <label class="form-label">Visibilidade:</label><br>
                        <input class="form-check-input" name="visibilidade" type="radio" id="" value="1">
                        <label class="form-check-label">Publico</label><br>
                        <input class="form-check-input" name="visibilidade" type="radio" id="" value="0">
                        <label class="form-check-label">Privado</label>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="char" class="form-label">Maximo de caracteres (Max 100)</label>
                        <input type="text" class="form-control" name="char" placeholder="Maximo de caracteres" value="50">
                    </div>
                    <button type="submit" class="btn btn-primary justify-self-center">Enviar</button>
                </form>
            </div>
        </div>
            <div class="container-fluid col-5 d-block mb-5" style="">
                <div class="gray p-5 rounded-3">
                    <form action="c_editarformulario.php" method="post">
                    <h1>Prévia do formulario</h1>
                    <p>Atualmente o formulario contém estas perguntas, utilize os botões para mudar a visibilidade das perguntas.</p>
                        <label for="data" class="form-label">Local de coleta:</label>
                        <select id = 'local' class="form-control" name="localColetado">
                            <option value="" >Selecione...</option>
                            <?php
                                if (isset($query) && mysqli_num_rows($query) > 0) {?>
                                <?php
                                    while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                    <option><?php echo $row['nome']; ?></option>
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
                            <input type="date" class="form-control" readonly>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="data" class="form-label">Data de coleta:</label>
                            <input type="date" class="form-control" id="data" readonly>
                        </div>
                        <?php while ($row2 = mysqli_fetch_assoc($query2)) {
                        ?>
                        <div class="mb-3 mt-3">
                            <label class="form-label"><?php echo $row2['titulo']?></label>
                            <input type="text" class="form-control" placeholder="<?php echo $row2['titulo']?>" name="<?php echo $row2['idPergunta']?>">
                            <label class="btn btn-primary mt-2">
                                <input type="radio" name="<?php echo $row2['idPergunta'] ?>" id="<?php echo $row2['idPergunta'] ?>-1" value="1"> Publico
                            </label>
                            <label class="btn btn-primary mt-2">
                                <input type="radio" name="<?php echo $row2['idPergunta'] ?>" id="<?php echo $row2['idPergunta'] ?>-0" value="0"> Privado
                            </label>
                            <label class="btn btn-danger mt-2">
                                <input type="checkbox" class="form-check-input" name="<?php echo $row2['idPergunta'] ?>-del"  value="1"> Deletar
                            </label>                     
                        </div>
                        <script>
                            if('<?php echo $row2['visibilidade']; ?>' == '0'){
                                document.getElementById("<?php echo $row2['idPergunta'] ?>-0").checked = true;
                            }else if('<?php echo $row2['visibilidade']; ?>' == '1'){
                                document.getElementById("<?php echo $row2['idPergunta'] ?>-1").checked = true;
                            }
                        </script>
                        <?php
                        }
                        ?>
                        <input type="hidden" name="iteracoes"  value="<?php echo $i ?>">
                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>