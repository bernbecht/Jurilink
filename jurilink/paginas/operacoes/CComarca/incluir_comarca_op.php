<?php

//nao está sendo verificado se a comarca está REALMENTE sendo grava
//apenas se ela tem os parametros certos

include '../../classes/CComarca.php';

$n = $_POST['nome'];
$erro = "";


if (strlen($n) < 2) {
    $erro.= "nome menos que 2";
}

if ($erro != "") {
    echo 0;
} 
else {
    $comarca = new CComarca();

    $comarca->incluirComarca($n);
    
    echo 1;
}
?>

