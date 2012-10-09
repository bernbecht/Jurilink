<?php

include '../../classes/CAto.php';
include_once '../../config.php';

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
    $incluir = null;
    $ato = new CAto();

    $incluir = $ato->incluirAto($conexao1,$n,$p,$f,$d);
    if ($incluir) {
        pg_query($conexao1, "commit");
        echo "1";
    } else {
        pg_query($conexao1, "rollback");
        pg_close($conexao1);
        echo "0";
    }
   
}
?>

<html>
<head>
<meta http-equiv="refresh" content="1 ;URL=../../../jurilink_main.php">
</head>
</html>

