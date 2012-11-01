<?php

include '../../classes/CAto.php';

$nome = $_POST['nome'];
$id_ato = $_POST['id_ato'];
$desc = $_POST['desc'];
$previsao = $_POST['previsao'];
$flag_cliente = $_POST['flag_cliente'];


$erro = "";


if (strlen($nome) < 2) {
    $erro.= "nome menos que 2";
}

if ($erro != "") {
    echo 0;
} 
else {
    $ato = new CAto();

    $ato->editarAto($nome,$id_ato,$desc,$previsao,$flag_cliente);
    
    echo 1;
}
?>

