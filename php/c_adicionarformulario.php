<?php

include_once "link.php";
include_once "session.php";

$titulo = mysqli_real_escape_string($link, $_POST['titulo']);
$visibilidade = mysqli_real_escape_string($link, $_POST['visibilidade']);
$char = mysqli_real_escape_string($link, $_POST['char']);
$teste = 0;

$query = mysqli_query($link,"SELECT titulo FROM pergunta");
while($row = mysqli_fetch_assoc($query)){
    $tituloAtual = $row['titulo'];
    if($titulo == $tituloAtual){
        $teste = 1;
    }
}


if ($logado == NULL or FALSE) {
    ?>
    <script language="JavaScript" type="text/javascript"> alert("\n\n Conteudo restrito \n\n")</script>
    <script language="JavaScript">window.location = "editarformulario.php";</script>
    <?php
}else if($nivelUsuario != 3){
    ?>
    <script language="JavaScript" type="text/javascript"> alert("\n\n Conteudo restrito \n\n")</script>
    <script language="JavaScript">window.location = "editarformulario.php";</script>
    <?php
}elseif ($titulo == "") {
    ?>
    <script language="JavaScript" type="text/javascript"> alert("\n\n O campo titulo deve ser preenchido \n\n")</script>
    <script language="JavaScript">window.location = "editarformulario.php";</script>
    <?php
}elseif ($teste == 1) {
    ?>
    <script language="JavaScript" type="text/javascript"> alert("\n\n Duas perguntas não podem ter o exato mesmo titulo \n\n")</script>
    <script language="JavaScript">window.location = "editarformulario.php";</script>
    <?php
}elseif ($visibilidade == "") {
    ?>
    <script language="JavaScript" type="text/javascript"> alert("\n\n Selecione uma visibilidade \n\n")</script>
    <script language="JavaScript">window.location = "editarformulario.php";</script>
    <?php
}elseif ($char > 100 or $char < 1) {
    ?>
    <script language="JavaScript" type="text/javascript"> alert("\n\n O maximo de caracteres deve ser entre 1 e 100 \n\n")</script>
    <script language="JavaScript">window.location = "editarformulario.php";</script>
    <?php
}else {

    mysqli_query($link,"INSERT INTO PERGUNTA (titulo, visibilidade) VALUES ('$titulo', '$visibilidade')") or die (mysqli_error($link));
    mysqli_query($link,"ALTER TABLE AMOSTRA ADD `$titulo` VARCHAR($char)") or die (mysqli_error($link));
    ?>
    <script language="JavaScript" type="text/javascript"> alert("\n\n Alterações salvas \n\n")</script>
    <script language="JavaScript">window.location = "editarformulario.php";</script>
    <?php

}
?>
