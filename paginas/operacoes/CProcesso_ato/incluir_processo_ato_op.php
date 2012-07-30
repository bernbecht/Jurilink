<?php

include '../../classes/CProcesso_ato.php';

$id_p = $_POST['id_processo'];
$id_a = $_POST['id_ato'];
$da = $_POST['data_atualizacao'];
$erro = "";

if ($erro != "") {
    echo $erro;
} 
else {
    $processo_ato = new CProcesso_ato();

    $processo_ato->incluirProcesso_ato($id_p,$id_a,$da);
}
?>

