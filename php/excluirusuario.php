<?php
    include_once "session.php";
    include_once "link.php";

    if ($logado == FALSE or NULL) {
         ?>  
         <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Este conteudo é restrito \n\n")</SCRIPT>
         <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
         <?php
         die();
    }else if($nivelUsuario != 3){
        ?>  
        <script language="JavaScript" type="text/javascript"> alert ("\n\n Conteudo restrito \n\n")</script>
        <script language="JavaScript">window.location = "index.php";</script>
        <?php
        die();
    }
    $idUsuario = $_POST['idUsuario'];
    if ($idUsuario == NULL){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Erro desconhecido \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
        die();
    }
    $busca = mysqli_query($link,"DELETE FROM USUARIO WHERE idUsuario = $idUsuario") or die (mysqli_error($link));
?>
    <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Deletado com sucesso \n\n")</SCRIPT>
    <SCRIPT language="JavaScript">window.location = "menuadministrador.php";</SCRIPT>
