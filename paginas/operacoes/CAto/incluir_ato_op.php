<?php

include '../../classes/CAto.php';

$n = $_POST['nome'];
$p = $_POST['previsao'];
$d = $_POST['descricao'];
$f = $_POST['flag_userCheckbox'];

$erro = "";


if (strlen($n) < 2) {
    $erro.= "nome menos que 2";
}

if ($erro != "") {
    echo $erro;
} 
else {
    $ato = new CAto();

    $ato->incluirAto($n,$p,$f,$d);
   
}
?>

