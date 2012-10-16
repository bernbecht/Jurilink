<?php

require_once '../../classes/CAudiencia.php';

require_once '../../config.php';

session_start();

$id_processo = $_POST['id_processo'];

function diffDate($d1, $d2, $type = '', $sep = '-') {
    $d1 = explode($sep, $d1);
    $d2 = explode($sep, $d2);
    switch ($type) {
        case 'A':
            $X = 31536000;
            break;
        case 'M':
            $X = 2592000;
            break;
        case 'D':
            $X = 86400;
            break;
        case 'H':
            $X = 3600;
            break;
        case 'MI':
            $X = 60;
            break;
        default:
            $X = 1;
    }
    return floor( ( ( mktime(0, 0, 0, $d2[1], $d2[2], $d2[0]) - mktime(0, 0, 0, $d1[1], $d1[2], $d1[0] ) ) / $X ) );
}

$audiencia = new CAudiencia();

$hoje = date('Y-m-d');

$sql = $audiencia->getProximasAudiencias(5, $hoje);
$audiencia = pg_fetch_object($sql);


if (pg_num_rows($sql) > 0) {
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
                    <td><a href=paginas/processo/view_processo.php?id=$audiencia->id_processo>" . $audiencia->numero_unificado . "</a></td>";

        //echo "<td>" . $audiencia->data . "</a></td>";

       
        $aud = $audiencia->data;
        $hoje = date("Y-m-d");

        $diff = diffDate($hoje,$aud,'D');


        if ($diff <=3 && $diff>=1) {
            echo "<td><span class='label label-warning'>" . $audiencia->data . "</span></td>";
        } else if ($diff == 0 ) {
             echo "<td><span class='label label-important'>" . $audiencia->data . "</span></td>";
        }
        else{
            echo "<td><span class='label label'>" . $audiencia->data . "</span></td>";
        }

        echo "<td>" . $audiencia->local . "</td>
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
