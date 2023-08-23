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
    $idLocal = $_POST['ponto'];
    
    $busca = mysqli_query($link,"SELECT foto FROM LOCAL") or die (mysqli_error($link));
    $foto_original = mysqli_fetch_assoc($busca);

    $foto = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_extension = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
    $foto_filename = uniqid() . '_' . time() . '.' . $foto_extension;
    $foto_path = "img/" . $foto_filename;

    if($nome == ""){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n É nessesario preencher um nome para o local \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "editarlocal.php?idLocal=<?php echo $idLocal?>";</SCRIPT>
        <?php
    }elseif ($lat == ""){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n É nessesario preencher a latitude do local \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "editarlocal.php?idLocal=<?php echo $idLocal?>";</SCRIPT>
        <?php
    }elseif ($lng == ""){
        ?>  
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n É nessesario preencher a longitude do local \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "editarlocal.php?idLocal=<?php echo $idLocal?>";</SCRIPT>
        <?php
    }else{
        if ($foto ==""){
            mysqli_query($link,"UPDATE local SET nome='$nome',lat='$lat',lng='$lng',tipo='$tipo' WHERE ponto='$idLocal'");
        } else {
            move_uploaded_file($foto_tmp, $foto_path); 
            mysqli_query($link,"UPDATE local SET nome='$nome',lat='$lat',lng='$lng',tipo='$tipo',foto='$foto_path' WHERE ponto='$idLocal'");
            unlink($foto_original);
        }
        ?>
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> alert ("\n\n Salvo com sucesso \n\n")</SCRIPT>
        <SCRIPT language="JavaScript">window.location = "local.php?idLocal=<?php echo $idLocal?>";</SCRIPT>
        <?php
    }
?> 