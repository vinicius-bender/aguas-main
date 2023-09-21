<?php

    include_once "link.php";
    include_once "session.php";

    $localColetado = mysqli_real_escape_string($link,$_POST['localColetado']);
    $ponto = mysqli_real_escape_string($link,$_POST['ponto']);
    $municipio = mysqli_real_escape_string($link,$_POST['municipio']);
    $dataPerfuracao = mysqli_real_escape_string($link,$_POST['dataPerfuracao']);
    $dataAnalise = mysqli_real_escape_string($link,$_POST['dataAnalise']);
    $cotaTerreno = mysqli_real_escape_string($link,$_POST['cotaTerreno']);
    $profundidadeFinal = mysqli_real_escape_string($link,$_POST['profundidadeFinal']);
    $nivelDinamico = mysqli_real_escape_string($link,$_POST['nivelDinamico']);
    $nivelEstatico = mysqli_real_escape_string($link,$_POST['nivelEstatico']);
    $vazaoEspecifica = mysqli_real_escape_string($link,$_POST['vazaoEspecifica']);
    $vazaoEstabilizacao = mysqli_real_escape_string($link,$_POST['vazaoEstabilizacao']);
    $condutividade = mysqli_real_escape_string($link,$_POST['condutividade']);
    $cor = mysqli_real_escape_string($link,$_POST['cor']);
    $corParametro = mysqli_real_escape_string($link,$_POST['corParametro']);
    $odor = mysqli_real_escape_string($link,$_POST['odor']);
    $sabor = mysqli_real_escape_string($link,$_POST['sabor']);
    $temperatura = mysqli_real_escape_string($link,$_POST['temperatura']);
    $turbidez = mysqli_real_escape_string($link,$_POST['turbidez']);
    $idCriador = $idUsuarioS;
    $idEditor = $idUsuarioS;

    if($logado == FALSE or NULL){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Conteudo restrito \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
        die();
    }else if($localColetado == "" or $dataPerfuracao == "" or $dataAnalise == "" or $ponto == "" or $municipio == ""){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n \u00c9 nessesario preencher as datas de refer\u00eancia e coleta e o local coletado \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "criaramostra.php";</SCRIPT>
        <?php
        die();
    }

    function formatarData($dataOriginal) {
        $novaData = date("m-d-Y", strtotime($dataOriginal));
        $novaData = str_replace('-', '/', $novaData);
        return $novaData;
    }

    $dataPerfuracaoFormatada = formatarData($dataPerfuracao);
    $dataAnaliseFormatada = formatarData($dataAnalise);

    // try{
    mysqli_query($link,"INSERT INTO amostra (ponto, municipio, idCriador, idEditor, dataPerfuracao, dataAnalise, cotaTerreno,
    profundidadeFinal, nivelDinamico, nivelEstatico, vazaoEspecifica, vazaoEstabilizacao, condutividade,
    cor, corParametro, odor, sabor, temperatura, turbidez)
    VALUES ('$ponto', '$municipio', '$idCriador', '$idEditor', '$dataPerfuracaoFormatada', '$dataAnaliseFormatada', '$cotaTerreno', '$profundidadeFinal', 
    '$nivelDinamico', '$nivelEstatico', '$vazaoEspecifica', '$vazaoEstabilizacao', '$condutividade', '$cor', 
    '$corParametro', '$odor', '$sabor', '$temperatura', '$turbidez')");
    // }catch(Exception $erro){
    //     echo $erro;
    //     echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'> alert ('\n\n $erro \n\n')</SCRIPT>";
    // }

    ?>  
    <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Salvo com sucesso \n\n")</SCRIPT>
    <SCRIPT language="JavaScript">window.location = "amostras.php";</SCRIPT>
    <?php
?>