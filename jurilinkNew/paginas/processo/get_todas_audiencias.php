<?php

require_once '../classes/CAudiencia.php';

require_once '../config.php';

session_start();

$id_processo = $_POST['id_processo'];
$limite = $_POST['limite'];

$audiencia = new CAudiencia();

$sql = $audiencia->getAudiencia($id_processo, $limite);
$audiencia = pg_fetch_object($sql);

echo '<div class="tabela_aud"> ';
if ($audiencia->local != '') {

    echo "<table = 'audiencia' class='table table-striped table-condensed' >";
    echo "<thead>";
    echo "<tr>
                            <th>Data</th>
                            <th>Local</th>
                            <th>Tipo</th>";
    if ($_SESSION['tipo_usuario'] == 2)
        echo "<th>Ações</th>
                            </tr>
                            </thead>";
    echo "<tbody>";


    do {
               
        echo "<tr>	
                    <td>" . $audiencia->data . "</a></td>
                    <td>" . $audiencia->local . "</td>
                    <td>" . $audiencia->tipo . "</td>";
        if ($_SESSION['tipo_usuario'] == 2)
            echo "<td><a class='tooltip_class' rel='tooltip' data-placement='top' data-original-title='Excluir esta audiência' data-toggle='modal' href='#exclusaoAudienciaModal'><i class='icon-remove-circle excluir-audiencia'><input type='hidden' value = '".$audiencia->id_audiencia."'/></i></a></td>
                    </tr>";
    } while ($audiencia = pg_fetch_object($sql));


    echo "</tbody>";
    echo "</table>";
    echo "<p class='centro'><button id='todas_audiencias' class='btn btn-primary'>Ver todas as Audiência</button></p>";
} else {
    echo'<div class="alert alert-info"><h4>Não há audiências no momento.</h4></div>';
}
echo'</div>';
?>
