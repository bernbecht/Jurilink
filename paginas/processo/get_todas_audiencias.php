<?php

require_once '../classes/CAudiencia.php';

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
                            <th>Tipo</th>
                            <th>Acoes</th>
                            </tr>
                            </thead>";
                    echo "<tbody>";
                    

                        do {
                            echo "<tr>	
                    <td>" . $audiencia->data . "</a></td>
                    <td>" . $audiencia->local . "</td>
                    <td>" . $audiencia->tipo . "</td>
                    <td>ACOES</td>
                    </tr>";
                        } while ($audiencia = pg_fetch_object($sql));
                 

                    echo "</tbody>";
                    echo "</table>";
                    echo "<p class='centro'><button id='todas_audiencias' class='btn btn-primary'>Ver todas as Audiencias</button></p>";
                } else {
                    echo'<div class="alert alert-info"><h4>Nao ha audiencias no momento</h4></div>';
                }
                echo'</div>';



?>
