<?php

include '../../classes/CNatureza_acao.php';

$nome = $_POST['nome'];
$id_natureza = $_POST['id_natureza'];

$erro = "";


if (strlen($nome) < 2) {
    $erro.= "nome menos que 2";
}

if ($erro != "") {
    echo 0;
} 
else {
    $natureza = new CNatureza_acao();

    $natureza->editarNatureza($nome,$id_natureza);
    
    echo 1;
}
?>

