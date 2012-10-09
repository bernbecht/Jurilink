<?php
include '../../classes/CJuizo.php';

$id=$_POST['id_juizo_excluir'];

echo $id;

$juizo = new CJuizo();

$juizo->excluirJuizo($id);


?>
<html>
<head>
<meta http-equiv="refresh" content="1 ;URL=../../../jurilink_main.php">
</head>
</html>

