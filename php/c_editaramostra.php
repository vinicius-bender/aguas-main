<?php
    include_once "session.php"; 
    include_once "link.php";

    $localColetado = mysqli_real_escape_string($link,$_POST['localColetado']);
    $dataReferencia = mysqli_real_escape_string($link,$_POST['dataReferencia']);
    $dataColeta = mysqli_real_escape_string($link,$_POST['dataColeta']);

    if($logado == NULL or FALSE){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Conteudo restrito \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
    }
    
    if($dataReferencia == "" or $dataColeta == ""){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n \u00c9 nessesario preencher as datas de refer\u00eancia e coleta \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "editaramostra.php?idAmostra=";</SCRIPT>
        <?php
        die();
    }elseif ($localColetado == ""){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n É selecionar um local \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "editaramostra.php";</SCRIPT>
        <?php
        die();
    }

    $idEditor = $idUsuarioS;
    $idAmostra = mysqli_real_escape_string($link,$_POST['idAmostra']);

    $colunas = array('idEditor', 'localColetado', 'dataReferencia', 'dataColeta');
    $valores = array($idEditor, $localColetado, $dataReferencia, $dataColeta);

    $query = mysqli_query($link,"SELECT * FROM PERGUNTA");

    while ($row = mysqli_fetch_assoc($query)) {

        $valor = $row['idPergunta'];
        $coluna = $row['titulo'];

        $colunas[] = $coluna;
        $valores[] = $_POST[$valor];
        
    }
    for ($i = 0; $i < count($colunas); $i++) {
        $atualizacoes[] = "`" . $colunas[$i] . "` = '" . $valores[$i] . "'";
    }
    $setUpdate = implode(", ", $atualizacoes);

    mysqli_query($link,"UPDATE amostra SET $setUpdate WHERE idAmostra = $idAmostra")
    ?>
    <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Salvo com sucesso \n\n")</SCRIPT>
    <SCRIPT language="JavaScript">window.location = "amostra.php?idAmostra=<?php echo $idAmostra ?>";</SCRIPT>
    <?php
?>  