<?php
include '../../classes/CNatureza_acao.php';

$id=$_POST['id_natureza_acao_excluir'];

echo $id;

$natureza_acao = new CNatureza_acao();

$natureza_acao->excluirNatureza_acao($id);


?>
<html>
<head>
<meta http-equiv="refresh" content="1 ;URL=../../../jurilink_main.php">
</head>
</html>

