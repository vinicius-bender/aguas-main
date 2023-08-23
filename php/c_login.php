<?php

    require_once "link.php";
    require_once "session.php";
    
    
    $senha = mysqli_real_escape_string($link,$_POST['senha']);
    $email =  mysqli_real_escape_string($link,$_POST['email']);
    $matricula =  mysqli_real_escape_string($link,$_POST['matricula']);

    if ($senha == "" or $email == "" or $matricula == ""){
    ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Preencha todos os dados informados \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "login.php";</SCRIPT>
    <?php
    }
    else{
        $query = mysqli_query($link,"SELECT * FROM USUARIO WHERE email = '$email' and senha = '$senha' and matricula = '$matricula'") or die (mysqli_error($link));
        $row = mysqli_fetch_array($query);
        if ($row['senha'] == $senha and $row['email'] == $email and $row['matricula'] == $matricula){
            $_SESSION['logado'] = true;
            $_SESSION['idUsuario'] = $row['idUsuario'];
            $_SESSION['nomeUsuario'] = $row['nome'];
            $_SESSION['matriculaUsuario'] = $row['matricula'];
            $_SESSION['nivelUsuario'] = $row['nivel'];
            ?>  
                <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Logado com sucesso \n\n")</SCRIPT>
                <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
            <?php
        }else{
        ?>
            <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Login ou senha incorretos \n\n")</SCRIPT>
            <SCRIPT language="JavaScript">window.location = "login.php";</SCRIPT>
        <?php
        }
    }

?>