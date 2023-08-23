<?php
include_once "link.php";
include_once "session.php";

$nome = mysqli_real_escape_string($link, $_POST['nome']);
$resumo = mysqli_real_escape_string($link, $_POST['resumo']);
$links = mysqli_real_escape_string($link, $_POST['link']);
$pdf = $_FILES['pdf']['name'];
$pdf_tmp = $_FILES['pdf']['tmp_name'];
$pdf_extension = strtolower(pathinfo($pdf, PATHINFO_EXTENSION));
$pdf_filename = uniqid() . '_' . time() . '.' . $pdf_extension;
$pdf_path = "pdf/" . $pdf_filename;
move_uploaded_file($pdf_tmp, $pdf_path);

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
        mysqli_query($link, "INSERT INTO artigo (nome, resumo, pdf, link) VALUES ('$nome','$resumo','$pdf_path','$links')");
    }else{
        mysqli_query($link, "INSERT INTO artigo (nome, resumo, link) VALUES ('$nome','$resumo','$links')");
    }
    ?>
    <script language="JavaScript" type="text/javascript"> alert("\n\n Artigo criado com sucesso! \n\n")</script>
    <script language="JavaScript">window.location = "artigos.php";</script>
    <?php
}
?>
