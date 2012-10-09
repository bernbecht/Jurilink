<?php

include '../../classes/CComarca.php';
include_once '../../config.php';


$n = $_POST['nome'];
$erro = "";


if (strlen($n) < 2) {
    $erro.= "nome menos que 2";
}

if ($erro != "") {
    echo $erro;
} 
else {
    //Procedimento ROLLBACK
    $incluir = null;
    pg_query($conexao1, "begin");
    $comarca = new CComarca();
    
    $incluir = $comarca->incluirComarca($conexao1,$n);
    
    if ($incluir){
        pg_query($conexao1,"commit");
        echo "1";
    }
    else{
        pg_query($conexao1,"rollback");
        pg_close($conexao1);
        echo "0";
    }
}
?>
