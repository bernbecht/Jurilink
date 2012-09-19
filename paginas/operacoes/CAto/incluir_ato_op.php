<?php

require_once '../../classes/CAto.php';
 require_once '../../config.php';

$n = $_POST['nome'];
$p = $_POST['previsao'];
$d = $_POST['descricao'];
$f = $_POST['user'];

$erro = "";

if($f==1){
    $f= true;
}
else{
    $f= false; 
}


if (strlen($n) < 2) {
    $erro.= "nome menos que 2";
}

if ($erro != "") {
    echo 0;
} 
else {
    $ato = new CAto();

    $ato->incluirAto($n,$p,$f,$d);
    
    echo 1;
   
}
?>

