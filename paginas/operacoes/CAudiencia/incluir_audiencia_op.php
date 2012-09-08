<?php

include '../../classes/CAudiencia.php';


$id_processo = $_POST['id_processo'];
$tipo = $_POST['tipo_audiencia'];
$local= $_POST['local'];
$data_audiencia= $_POST['data_audiencia'];


$erro = "";
if ($erro != "") {
    echo $erro;
} 

else {
    $audiencia = new CAudiencia();
    
    $audiencia->incluirAudiencia($data_audiencia, $local, $tipo, $id_processo);
    
}
?>