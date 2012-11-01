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
    echo 0;
}

 
else {
    $juizo = new CJuizo();

    $juizo->incluirJuizo($n,$id_c);
    
    echo 1;
}
?>


