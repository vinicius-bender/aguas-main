<?php

    include_once "link.php";
    include_once "session.php";

    $localColetado = mysqli_real_escape_string($link,$_POST['localColetado']);
    $dataReferencia = mysqli_real_escape_string($link,$_POST['dataReferencia']);
    $dataColeta = mysqli_real_escape_string($link,$_POST['dataColeta']);
    $idCriador = $idUsuarioS;

    $colunas = array('idCriador', 'municipio', 'dataPerfuracao', 'dataAnalise');
    $valores = array($idCriador, $localColetado, $dataReferencia, $dataColeta);

    if($logado == FALSE or NULL){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Conteudo restrito \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
        die();
    }else if($localColetado == "" or $dataReferencia == "" or $dataColeta == ""){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n \u00c9 nessesario preencher as datas de refer\u00eancia e coleta e o local coletado \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "criaramostra.php";</SCRIPT>
        <?php
        die();
    }

    // $query = mysqli_query($link,"SELECT * FROM PERGUNTA");

    // while ($row = mysqli_fetch_assoc($query)) {

    //     $valor = $row['idPergunta'];
    //     $coluna = $row['titulo'];

    //     $colunas[] = $coluna;
    //     $valores[] = $_POST[$valor];
    // }


    $colunasStr = '`' . implode('`, `', $colunas) . '`';
    $valoresStr = "'" . implode("', '", $valores) . "'";

    mysqli_query($link,"INSERT INTO amostra ($colunasStr) VALUES ($valoresStr)");

    ?>  
    <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Salvo com sucesso \n\n")</SCRIPT>
    <SCRIPT language="JavaScript">window.location = "amostras.php";</SCRIPT>
    <?php
?>