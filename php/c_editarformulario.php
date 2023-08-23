<?php

include_once "link.php";
include_once "session.php";

# eu tinha feito um esquema de geração de ids super complicado pra salvar as variaveis vindas pelo post
# dai eu me toquei que eu n precisava salvar as variaveis usando ids pq ja tem uma tabela no banco de dados com as perguntas
# na minha cabeça poderia dar errado caso alguem tentasse excluir ou alterar a visibilidade
# de uma pergunta que não tivesse no banco de dados
# só que pra a pessoa poder excluir TEM QUE ESTAR NO BANCO DE DADOS.
# -12 horas.

#esse metodo é mais facil eu acho.

if ($logado == NULL or FALSE) {
    ?>
    <script language="JavaScript" type="text/javascript"> alert("\n\n Conteudo restrito \n\n")</script>
    <script language="JavaScript">window.location = "index.php";</script>
    <?php
    die();
}else if($nivelUsuario != 3){
    ?>
    <script language="JavaScript" type="text/javascript"> alert("\n\n Conteudo restrito \n\n")</script>
    <script language="JavaScript">window.location = "index.php";</script>
    <?php
    die();
}
$query = mysqli_query($link,"SELECT * FROM PERGUNTA");
    while($row = mysqli_fetch_assoc($query)){
    $idPergunta = $row['idPergunta'];
    $titulo = $row['titulo'];
    $visibilidadeAtual = $row['visibilidade'];

    $deletar = $_POST[$idPergunta . "-del"];
    $visibilidade = $_POST[$idPergunta];

    if($deletar != NULL){
        mysqli_query($link,"ALTER TABLE amostra DROP `$titulo`");
        mysqli_query($link,"DELETE FROM pergunta WHERE idPergunta = '$idPergunta'");
    }else if($visibilidadeAtual != $visibilidade){
        mysqli_query($link,"UPDATE pergunta SET visibilidade = '$visibilidade' WHERE idPergunta = '$idPergunta'");
    }
}
?>
<script language="JavaScript" type="text/javascript"> alert("\n\n Alterações salvas \n\n")</script>
<script language="JavaScript">window.location = "editarformulario.php";</script>
<?php
?>
