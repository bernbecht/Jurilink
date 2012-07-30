<?php
include '../../classes/CNatureza_acao.php';

$n = $_POST['nome'];
$erro = "";

if (strlen($n) < 2) {
    $erro.= "nome menos que 2";
}


if ($erro != "") {
    echo $erro;
}

 
else {
    $natureza_acao = new CNatureza_acao();

    $natureza_acao->incluirNatureza_acao($n);
    
    echo "Natureza cadastrada!";
}
?>
<html>
<head>
<meta http-equiv="refresh" content="1 ;URL=../../../jurilink_main.php">
</head>
</html>

