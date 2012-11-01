<?php
include '../../classes/CNatureza_acao.php';

$n = $_POST['nome'];
$erro = "";

if (strlen($n) < 2) {
    $erro.= "nome menos que 2";
}


if ($erro != "") {
    echo 0;
}

 
else {
    $natureza_acao = new CNatureza_acao();

    $natureza_acao->incluirNatureza_acao($n);
    
    echo 1;
}
?>

