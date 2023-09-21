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

    // Dados do formulário
    $novoNome = $_POST['localColetado'];
    $dataPerfuracao = $_POST['dataPerfuracao'];
    $dataAnalise = $_POST['dataAnalise'];
    $novoCotaTerreno = $_POST['cotaTerreno'];
    $novoProfundidade = $_POST['profundidadeFinal'];
    $novoNivelDinamico = $_POST['nivelDinamico'];
    $novoNivelEstatico = $_POST['nivelEstatico'];
    $novoVazaoEspecifica = $_POST['vazaoEspecifica'];
    $novoVazaoEstabilizacao = $_POST['vazaoEstabilizacao'];
    $novoCondutividade = $_POST['condutividade'];
    $novoCor = $_POST['cor'];
    $novoOdor = $_POST['odor'];
    $novoSabor= $_POST['sabor'];
    $novoTemperatura = $_POST['temperatura'];
    $novoTurbidez = $_POST['turbidez'];

    function formatarData($dataOriginal) {
        $novaData = date("m-d-Y", strtotime($dataOriginal));
        $novaData = str_replace('-', '/', $novaData);
        return $novaData;
    }

    $dataPerfuracaoFormatada = formatarData($dataPerfuracao);
    $dataAnaliseFormatada = formatarData($dataAnalise);
    
    $conn = new mysqli('localhost', 'root', 'rootadmin', 'siteaguas');

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Recuperar os dados existentes do banco de dados
    $sql = "SELECT dataPerfuracao, dataAnalise, cotaTerreno, profundidadeFinal, nivelDinamico, nivelEstatico, vazaoEstabilizacao,  condutividade,
    cor, odor, sabor, temperatura, turbidez FROM amostra WHERE ponto = '$ponto'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // Comparar os dados e construir a consulta UPDATE
    $updateFields = array();
    if ($dataPerfuracao != $row['dataPerfuracao']) {
        $updateFields[] = "dataPerfuracao = '$dataPerfuracaoFormatada'";
    }
    if ($dataAnalise != $row['dataAnalise']) {
        $updateFields[] = "dataAnalise = '$dataAnaliseFormatada'";
    }
    if ($novoCotaTerreno != $row['cotaTerreno']) {
        $updateFields[] = "cotaTerreno = '$novoCotaTerreno'";
    }
    if ($novoProfundidade != $row['profundidadeFinal']) {
        $updateFields[] = "profundidadeFinal = '$novoProfundidade'";
    }
    if ($novoNivelDinamico != $row['nivelDinamico']) {
        $updateFields[] = "nivelDinamico = '$novoNivelDinamico'";
    }
    if ($novoNivelEstatico != $row['nivelEstatico']) {
        $updateFields[] = "nivelEstatico = '$novoNivelEstatico'";
    }
    if ($novoVazaoEspecifica != $row['vazaoEspecifica']) {
        $updateFields[] = "vazaoEspecifica = '$novoVazaoEspecifica'";
    }
    if ($novoVazaoEstabilizacao != $row['vazaoEstabilizacao']) {
        $updateFields[] = "vazaoEstabilizacao = '$novoVazaoEstabilizacao'";
    }
    if ($novoCondutividade != $row['condutividade']) {
        $updateFields[] = "condutividade = '$novoCondutividade'";
    }
    if ($novoCor != $row['cor']) {
        $updateFields[] = "cor = '$novoCor'";
    }
    if ($novoOdor != $row['odor']) {
        $updateFields[] = "odor = '$novoOdor'";
    }
    if ($novoSabor != $row['sabor']) {
        $updateFields[] = "sabor = '$novoSabor'";
    }
    if ($novoTemperatura != $row['temperatura']) {
        $updateFields[] = "temperatura = '$novoTemperatura'";
    }
    if ($novoTurbidez != $row['turbidez']) {
        $updateFields[] = "turbidez = '$novoTurbidez'";
    }
    
    $updateNome = "UPDATE LOCAL SET nome='$novoNome' WHERE ponto='$ponto'";
    if ($conn->query($updateNome) === TRUE) {
        // echo "Dados atualizados com sucesso!";
      } else {
        echo "Erro na atualização: " . $conn->error;
      }

    if (!empty($updateFields)) {
        $updateQuery = "UPDATE AMOSTRA SET " . implode(', ', $updateFields) . " WHERE ponto = '$ponto'";
        if ($conn->query($updateQuery) === TRUE) {
            echo "Dados atualizados com sucesso!";
        } else {
            echo "Erro na atualização: " . $conn->error;
        }
    } // else {
    // echo "Nenhum dado foi alterado.";
    // }

    ?>
    <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Salvo com sucesso \n\n")</SCRIPT>
    <SCRIPT language="JavaScript">window.location = "amostra.php?ponto=<?php echo $ponto ?>";</SCRIPT>
    <?php
?>  