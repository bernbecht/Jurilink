<?php

include '../../classes/CComarca.php';

$nome = $_POST['nome'];
$id_comarca = $_POST['id_comarca'];

$erro = "";


if (strlen($nome) < 2) {
    $erro.= "nome menos que 2";
}

if ($erro != "") {
    echo 0;
} 
else {
    $comarca = new CComarca();

    $comarca->editarComarca($nome,$id_comarca);
    
    echo 1;
}
?>

