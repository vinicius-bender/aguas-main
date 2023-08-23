<?php

require_once "link.php";

header("Content-type: application/pdf");



$idArtigo = $_GET['idArtigo'];
$busca = mysqli_query($link,"SELECT pdf FROM artigo WHERE idArtigo = $idArtigo") or die (mysqli_error($link));
$linha = mysqli_fetch_assoc($busca);
$pdf = $linha['pdf'];
echo $pdf;
readfile($pdf)
?>