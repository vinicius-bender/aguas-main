<?php
    include_once "link.php";
    include_once "session.php"; 

    if($logado == NULL or FALSE){
        ?>  
        <script language="JavaScript" type="text/javascript"> alert ("\n\n Conteudo restrito \n\n")</script>
        <script language="JavaScript">window.location = "index.php";</script>
        <?php
    }

    $nome = mysqli_real_escape_string($link,$_POST['nome']);
    $ponto = mysqli_real_escape_string($link,$_POST['ponto']);
    $lat = mysqli_real_escape_string($link,$_POST['lat']);
    $lng = mysqli_real_escape_string($link,$_POST['lng']);
    $tipo = mysqli_real_escape_string($link,$_POST['tipo']);
    $foto = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_extension = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
    $foto_filename = uniqid() . '_' . time() . '.' . $foto_extension;
    $foto_path = "../img/" . $foto_filename;

    if($nome == ""){
        ?>  
        <script language="JavaScript" type="text/javascript"> alert ("\n\n É necessário preencher um nome para o local \n\n")</script>
        <script language="JavaScript">window.location = "criarlocal.php";</script>
        <?php
    } elseif ($ponto == "") {
        ?>  
        <script language="JavaScript" type="text/javascript"> alert ("\n\n É necessário preencher um ponto para o local \n\n")</script>
        <script language="JavaScript">window.location = "criarlocal.php";</script>
        <?php
    } elseif ($lat == ""){
        ?>  
        <script language="JavaScript" type="text/javascript"> alert ("\n\n É necessário preencher a latitude do local \n\n")</script>
        <script language="JavaScript">window.location = "criarlocal.php";</script>
        <?php
    } elseif ($lng == ""){
        ?>  
        <script language="JavaScript" type="text/javascript"> alert ("\n\n É necessário preencher a longitude do local \n\n")</script>
        <script language="JavaScript">window.location = "criarlocal.php";</script>
        <?php
    } else {
        if($foto == "" or $foto == null){
            $foto_path = "../img/nhfotos.png";
        }
        move_uploaded_file($foto_tmp, $foto_path);
        mysqli_query($link,"INSERT INTO LOCAL (ponto, idCriador, idEditor, nome, lat, lng, tipo, foto) VALUES ('$ponto', '$idUsuarioS', '$idUsuarioS', '$nome', '$lat', '$lng','$tipo', '$foto_path')");
        ?>
        <script language="JavaScript" type="text/javascript"> alert ("\n\n Local registrado com sucesso! \n\n")</script>
        <script language="JavaScript">window.location = "index.php";</script>
        <?php
    }
?>  
