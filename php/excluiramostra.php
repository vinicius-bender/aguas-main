<?php
    include_once "session.php";
    include_once "link.php";
    if ($logado == FALSE or NULL) {
         ?>  
         <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Este conteudo é restrito \n\n")</SCRIPT>
         <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
         <?php
         die();
    }
    $idAmostra = $_POST['idAmostra'];
    if ($idAmostra == NULL){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Erro desconhecido \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
        die();
    }
    $busca = mysqli_query($link,"DELETE FROM AMOSTRA WHERE AMOSTRA.idAmostra = $idAmostra") or die (mysqli_error($link));
?>
    <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Deletado com sucesso \n\n")</SCRIPT>
    <SCRIPT language="JavaScript">window.location = "amostras.php";</SCRIPT>
