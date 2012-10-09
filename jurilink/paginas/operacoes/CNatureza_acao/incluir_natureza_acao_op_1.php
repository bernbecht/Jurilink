<?php
include '../../classes/CNatureza_acao.php';
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
    $incluir = null;
    pg_query($conexao1, "begin");
    
    $natureza_acao = new CNatureza_acao();

    $incluir = $natureza_acao->incluirNatureza_acao($conexao1,$n);
            
    if($incluir){
        pg_query ($conexao1, "commit");
        echo "1";
    }
    else{
        pg_query ($conexao1, "rollback");
        pg_close($conexao1);
        echo "0";
    }
    
    //echo "Natureza cadastrada!";
}
?>
<html>
<head>
<meta http-equiv="refresh" content="1 ;URL=../../../jurilink_main.php">
</head>
</html>

