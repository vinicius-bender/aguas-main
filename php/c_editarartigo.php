<?php
include_once "link.php";
include_once "session.php";

$nome = mysqli_real_escape_string($link, $_POST['nome']);
$resumo = mysqli_real_escape_string($link, $_POST['resumo']);
$links = mysqli_real_escape_string($link, $_POST['link']);
$excluir = $_POST['excluir'];
$idArtigo = $_POST['idArtigo'];
$pdf = $_FILES['pdf']['name'];
$pdf_tmp = $_FILES['pdf']['tmp_name'];
$pdf_extension = strtolower(pathinfo($pdf, PATHINFO_EXTENSION));
$pdf_filename = uniqid() . '_' . time() . '.' . $pdf_extension;
$pdf_path = "pdf/" . $pdf_filename;
move_uploaded_file($pdf_tmp, $pdf_path);

$query = mysqli_query($link,"SELECT pdf FROM artigo WHERE idArtigo = $idArtigo") or die (mysqli_error($link));
$row = mysqli_fetch_assoc($query);
$path_bd = $row['pdf'];

if ($logado == NULL or FALSE) {
    ?>
    <script language="JavaScript" type="text/javascript"> alert("\n\n Conteudo restrito \n\n")</script>
    <script language="JavaScript">window.location = "index.php";</script>
    <?php
} elseif ($nome == "") {
    ?>
    <script language="JavaScript" type="text/javascript"> alert("\n\n O campo nome deve ser preenchido \n\n")</script>
    <script language="JavaScript">window.location = "index.php";</script>
    <?php
} else {

    if ($pdf != "") {
        mysqli_query($link, "UPDATE artigo SET nome='$nome', resumo='$resumo', pdf='$pdf_path', link='$links' WHERE idArtigo = $idArtigo");
    }else{
        mysqli_query($link, "UPDATE artigo SET nome='$nome', resumo='$resumo', link='$links' WHERE idArtigo = $idArtigo");
    }

    if($excluir == true){
        unlink($path_bd);
        mysqli_query($link, "UPDATE artigo SET pdf = NULL WHERE idArtigo = $idArtigo");   
    }
    ?>
    <script language="JavaScript" type="text/javascript"> alert("\n\n Artigo alterado com sucesso! \n\n")</script>
    <script language="JavaScript">window.location = "artigos.php";</script>
    <?php
}
?>
