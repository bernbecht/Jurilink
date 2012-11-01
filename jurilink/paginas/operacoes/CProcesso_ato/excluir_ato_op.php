<?php

require_once '../../classes/CProcesso_ato.php';

$id_processo = $_POST['id_processo'];
$id_ato = $_POST['id_ato'];

$excluir = new CProcesso_ato();

$excluir->excluirProcesso_ato($id_processo, $id_ato);

if (!$excluir) {
    echo 0;
} else {
    echo 1;
}
?>
