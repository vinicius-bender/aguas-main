<?php
    include_once "session.php"; 
    include_once "link.php";

    $localColetado = mysqli_real_escape_string($link,$_POST['localColetado']);
    $dataPerfuracao = mysqli_real_escape_string($link,$_POST['dataPerfuracao']);
    $dataAnalise = mysqli_real_escape_string($link,$_POST['dataAnalise']);
    $setUpdate = $_POST['cotaTerreno'];

    if($logado == NULL or FALSE){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Conteudo restrito \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
    }
    
    if($dataPerfuracao == "" or $dataAnalise == ""){
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
    $ponto = mysqli_real_escape_string($link,$_POST['ponto']);

    // $colunas = array('idEditor', 'nome', 'dataPerfuracao', 'dataAnalise');
    // $valores = array($idEditor, $localColetado, $dataPerfuracao, $dataAnalise);

    // $query = mysqli_query($link,"SELECT * FROM PERGUNTA");

    // while ($row = mysqli_fetch_assoc($query)) {

    //     $valor = $row['idPergunta'];
    //     $coluna = $row['titulo'];

    //     $colunas[] = $coluna;
    //     $valores[] = $_POST[$valor];
        
    // }
    // for ($i = 0; $i < count($colunas); $i++) {
    //     $atualizacoes[] = "`" . $colunas[$i] . "` = '" . $valores[$i] . "'";
    // }
    // $setUpdate = implode(", ", $atualizacoes);

    mysqli_query($link,"UPDATE amostra SET cotaTerreno = '$setUpdate' WHERE ponto = '$ponto'");
    ?>
    <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Salvo com sucesso \n\n")</SCRIPT>
    <SCRIPT language="JavaScript">window.location = "amostra.php?ponto=<?php echo $ponto ?>";</SCRIPT>
    <?php
?>  