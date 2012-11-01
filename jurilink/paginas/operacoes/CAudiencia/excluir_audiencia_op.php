<?php

require_once '../../classes/CAudiencia.php';


$id_audiencia = $_POST['id_audiencia'];

$excluir = new CAudiencia();

$excluir->excluirAudiencia($id_audiencia);

if (!$excluir) {
    echo 0;
} else {
    echo 1;
}
?>
