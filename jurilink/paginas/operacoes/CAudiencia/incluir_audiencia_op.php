<?php

require_once '../../classes/CAudiencia.php';

require_once '../../config.php';


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
    
    $sql= $audiencia->incluirAudiencia($data_audiencia, $local, $tipo, $id_processo);
     
    if($sql){
        echo 1;
    }
    else{
        echo 0;
    }
}
?>