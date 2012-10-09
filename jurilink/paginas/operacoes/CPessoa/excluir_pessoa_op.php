<?php

include '../../classes/CPessoa.php';

$id=$_POST['id_excluir'];


echo $id;


$pessoa = new CPessoa();

$pessoa->excluirPessoa($id);

?>
