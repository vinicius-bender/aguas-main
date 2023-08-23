<?php
    require_once "link.php";
    require_once "session.php";

    if($logado == NULL or FALSE){
        ?>  
        <script language="JavaScript" type="text/javascript"> alert ("\n\n Conteudo restrito \n\n")</script>
        <script language="JavaScript">window.location = "index.php";</script>
        <?php
    }

    $email = mysqli_real_escape_string($link,$_POST['email']);
    $senha = mysqli_real_escape_string($link,$_POST['senha']);
    $senha2 = mysqli_real_escape_string($link,$_POST['senha2']);
    $nome = mysqli_real_escape_string($link,$_POST['nome']);
    $matricula = mysqli_real_escape_string($link,$_POST['matricula']);
    $nivel = $_POST['nivel'];
    

    if ($email == "" or $email == null) {
        ?>
        <script language="JavaScript" type="text/javascript"> alert ("\n\n É necessário registrar um email \n\n")</script>
        <script language="JavaScript">window.location = "criarusuario.php";</script>
        <?php
    } else if ($senha == "" or $senha == null) {
        ?>
        <script language="JavaScript" type="text/javascript"> alert ("\n\n É necessário registrar uma senha \n\n")</script>
        <script language="JavaScript">window.location = "criarusuario.php";</script>
        <?php
    } else if ($nome == "" or $nome == null) {
        ?>
        <script language="JavaScript" type="text/javascript"> alert ("\n\n É necessário registrar um nome \n\n")</script>
        <script language="JavaScript">window.location = "criarusuario.php";</script>
        <?php
    } else if ($matricula == "" or $matricula == null) {
        ?>
        <script language="JavaScript" type="text/javascript"> alert ("\n\n É necessário registrar uma matrícula \n\n")</script>
        <script language="JavaScript">window.location = "criarusuario.php";</script>
        <?php
    } else if ($nivel == "" or $nivel == null) {
        ?>
        <script language="JavaScript" type="text/javascript"> alert ("\n\n É necessário registrar um nível \n\n")</script>
        <script language="JavaScript">window.location = "criarusuario.php";</script>
        <?php
    }elseif($senha != $senha2){
        ?>  
        <script language="JavaScript" type="text/javascript"> alert ("\n\n Senhas informadas não são identicas \n\n")</script>
        <script language="JavaScript">window.location = "criarusuario.php";</script>
        <?php
    }else{
        $query = mysqli_query($link, "INSERT INTO usuario (email, senha, nome, matricula, nivel) VALUES ('$email', '$senha', '$nome', '$matricula', '$nivel')");
    }
?>