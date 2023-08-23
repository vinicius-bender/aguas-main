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
    $idArtigo = $_POST['idArtigo'];
    if ($idArtigo == NULL){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Erro desconhecido \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
        die();
    }
    $query = mysqli_query($link,"SELECT pdf FROM ARTIGO WHERE idArtigo = $idArtigo") or die (mysqli_error($link));
    $row = mysqli_fetch_assoc($query);
    $pdf_path = $row['pdf'];
    unlink($pdf_path);
    $busca = mysqli_query($link,"DELETE FROM ARTIGO WHERE ARTIGO.idArtigo = $idArtigo") or die (mysqli_error($link));
?>
    <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Deletado com sucesso \n\n")</SCRIPT>
    <SCRIPT language="JavaScript">window.location = "artigos.php";</SCRIPT>
