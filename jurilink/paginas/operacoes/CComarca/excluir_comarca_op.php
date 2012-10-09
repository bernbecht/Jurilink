<?php
include '../../classes/CComarca.php';

$id=$_POST['id_comarca_excluir'];

echo $id;

$comarca = new CComarca();

$comarca->excluirComarca($id);


?>
<html>
<head>
<meta http-equiv="refresh" content="1 ;URL=../../../jurilink_main.php">
</head>
</html>

