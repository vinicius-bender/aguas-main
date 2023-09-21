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
    $ponto = $_POST['ponto'];
    if ($ponto == NULL){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Erro desconhecido \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
        die();
    }
    $query = mysqli_query($link,"SELECT foto FROM LOCAL WHERE ponto = $ponto") or die (mysqli_error($link));
    mysqli_query($link,"DELETE FROM LOCAL WHERE LOCAL.ponto = $ponto") or die (mysqli_error($link));
    mysqli_query($link,"DELETE FROM AMOSTRA WHERE AMOSTRA.ponto = $ponto") or die (mysqli_error($link));
    $row = mysqli_fetch_assoc($query);
    $foto = $row['foto'];
    if($foto != "img/nhfotos.png"){
        unlink($foto);
    }
?>
    <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Deletado com sucesso \n\n")</SCRIPT>
    <SCRIPT language="JavaScript">window.location = "locais.php";</SCRIPT>
