<?php
include '../../classes/CJuizo.php';

$n = $_POST['nome'];
$id_c = $_POST['id_comarca'];
$erro = "";


if (strlen($n) < 2) {
    $erro.= "nome menos que 2";
}
if ($id_c == -1) {
    $erro.= "ID invalido";
}

if ($erro != "") {
    echo $erro;
}

 
else {
    $juizo = new CJuizo();

    $juizo->incluirJuizo($n,$id_c);
    
    echo "Juizo cadastrado!";
}
?>
<html>
<head>
<meta http-equiv="refresh" content="1 ;URL=../../../jurilink_main.php">
</head>
</html>

