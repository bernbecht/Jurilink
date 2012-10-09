<?php

include '../../classes/CProcesso_ato.php';
include_once '../../config.php';

$id_p = $_POST['id_processo'];
$id_a = $_POST['id_ato'];
$da = $_POST['data_atualizacao'];
$erro = "";

if ($erro != "") {
    echo $erro;
} 
else {
    $incluir = null;
    pg_query($conexao1, "begin");
    $processo_ato = new CProcesso_ato();

    $incluir = $processo_ato->incluirProcesso_ato($conexao1,$id_p,$id_a,$da);
    if($incluir){
        pg_query ($conexao1, "commit");
        echo "1";
    }
    else{
        pg_query ($conexao1, "rollback");
        pg_close($conexao1);
        echo "0";
    }
    
}
?>

