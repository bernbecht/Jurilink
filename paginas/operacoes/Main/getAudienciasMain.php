<?php

require_once '../../classes/CAudiencia.php';

require_once '../../config.php';

session_start();

$id_processo = $_POST['id_processo'];


$audiencia = new CAudiencia();

$sql = $audiencia->getTodasAudiencias(5);
$audiencia = pg_fetch_object($sql);


if (pg_num_rows($sql)>0) {
    echo '<div class="tabela_aud"> ';
    echo "<table = 'audiencia' class='table table-striped table-condensed' >";
    echo "<thead>";
    echo "<tr>
                            <th>Processo</th>
                            <th>Data</th>
                            <th>Local</th>
                            <th>Tipo</th>    
                            </tr>
                            </thead>";
    echo "<tbody>";


    do {
        echo "<tr>	
                    <td><a href=paginas/processo/view_processo.php?id=$audiencia->id_processo>" . $audiencia->numero_unificado . "</a></td>
                    <td>" . $audiencia->data . "</a></td>
                    <td>" . $audiencia->local . "</td>
                    <td>" . $audiencia->tipo . "</td>
                    </tr>";
    } while ($audiencia = pg_fetch_object($sql));


    echo "</tbody>";
    echo "</table>";
   
    echo'</div>';
} else {
    echo 0;
}

?>