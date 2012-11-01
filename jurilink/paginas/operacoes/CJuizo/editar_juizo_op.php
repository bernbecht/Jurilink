<?php

include '../../classes/CJuizo.php';

$nome = $_POST['nome'];
$id_juizo = $_POST['id_juizo'];
$id_comarca = $_POST['id_comarca'];

$erro = "";


if (strlen($nome) < 2) {
    $erro.= "nome menos que 2";
}

if ($erro != "") {
    echo 0;
} else {
    $juizo = new CJuizo();

    $juizo->editarjuizo($nome, $id_juizo, $id_comarca);

    echo 1;
}
?>

