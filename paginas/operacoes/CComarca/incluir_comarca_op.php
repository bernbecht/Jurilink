<?php

include '../../classes/CComarca.php';

$n = $_POST['nome'];
$erro = "";


if (strlen($n) < 2) {
    $erro.= "nome menos que 2";
}

if ($erro != "") {
    echo $erro;
} 
else {
    $comarca = new CComarca();

    $comarca->incluirComarca($n);
    
    echo "Comarca cadastrada!";
}
?>

<html>
<head>
<meta http-equiv="refresh" content="1 ;URL=../../../jurilink_main.php">
</head>
</html>
