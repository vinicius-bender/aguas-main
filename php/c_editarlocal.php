<?php
    include_once "link.php";
    include_once "session.php"; 
    if($logado == NULL or FALSE){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Conteudo restrito \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "index.php";</SCRIPT>
        <?php
    }
    
    $nome = mysqli_real_escape_string($link,$_POST['nome']);
    $lat = mysqli_real_escape_string($link,$_POST['lat']);
    $lng = mysqli_real_escape_string($link,$_POST['lng']);
    $tipo = mysqli_real_escape_string($link,$_POST['tipo']);
    $ponto = mysqli_real_escape_string($link,$_POST['pontoAtual']);
    $pontoNovo = mysqli_real_escape_string($link,$_POST['pontoNovo']);
    $sacAtiva = mysqli_real_escape_string($link,$_POST['sacAtiva']);
    $populacao = mysqli_real_escape_string($link,$_POST['populacao']);
    // $ponto = $_GET['ponto'];
    
    $busca = mysqli_query($link,"SELECT foto FROM LOCAL WHERE ponto = '$ponto'") or die (mysqli_error($link));
    $puxa = mysqli_fetch_assoc($busca);
    $foto_original = $puxa['foto'];

    $foto = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_extension = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
    $foto_filename = uniqid() . '_' . time() . '.' . $foto_extension;
    $foto_path = "../img/" . $foto_filename;


    if($nome == ""){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n É nessesario preencher um nome para o local \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "editarlocal.php?ponto=<?php echo $ponto?>";</SCRIPT>
        <?php
    }elseif ($ponto == ""){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n É nessesario preencher um ponto para o local \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "editarlocal.php?ponto=<?php echo $ponto?>";</SCRIPT>
        <?php
    }elseif ($lat == ""){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n É nessesario preencher a latitude do local \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "editarlocal.php?ponto=<?php echo $ponto?>";</SCRIPT>
        <?php
    }elseif ($lng == ""){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n É nessesario preencher a longitude do local \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "editarlocal.php?ponto=<?php echo $ponto?>";</SCRIPT>
        <?php
    }else{
        if ($foto == ""){
            mysqli_query($link,"UPDATE LOCAL SET ponto='$pontoNovo', nome='$nome', lat='$lat', lng='$lng', tipo='$tipo', sacAtiva='$sacAtiva', populacao='$populacao' WHERE ponto='$ponto'");
            mysqli_query($link,"UPDATE AMOSTRA SET ponto='$pontoNovo' WHERE ponto='$ponto'");
        } else {
            move_uploaded_file($foto_tmp, $foto_path); 
            mysqli_query($link, "UPDATE LOCAL SET ponto='$pontoNovo', nome='$nome', lat='$lat', lng='$lng', tipo='$tipo', foto='$foto_path', sacAtiva='$sacAtiva', populacao='$populacao' WHERE ponto = '$ponto'");
            mysqli_query($link, "UPDATE AMOSTRA SET ponto='$pontoNovo' WHERE ponto='$ponto'");
            if (file_exists($foto_original)) {
                unlink($foto_original);
            }
        }
        ?>
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Salvo com sucesso \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "local.php?ponto=<?php echo $pontoNovo; ?>"</SCRIPT>
        <?php
    }
?> 