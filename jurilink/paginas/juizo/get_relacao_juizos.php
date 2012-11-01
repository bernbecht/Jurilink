<?php

session_start();
require_once '../classes/CJuizo.php';

$juizo = new CJuizo();

$sql = $juizo->getRelacaoJuizo();
$resultado = pg_fetch_object($sql);


//se nao tiver algum processo cadastrado, retorne 0
if (!$resultado) {
    echo 0;
} else {

    echo "<div id='tabela'>";
    echo "<table = 'juizo' class='table table-striped table-condensed-secundaria' >";
    echo "<thead>";
    echo "<tr>
                <th>Nome</th>
                <th>Comarca</th>
                <th class = 'centro'>Ações</th>
                </tr></thead>";
    echo "<tbody>";
    do {
        echo "<tr>	
                <td>" . $resultado->nome . "</td>
                <td>" . $resultado->comarca . "</td>
                <td class = 'centro'><a class='tooltip_class' rel='tooltip' data-placement='top' data-original-title='Editar juízo' href=#><i class='icon-pencil editar-juizo'><input type='hidden' value = '" .$resultado->nome."|".$resultado->id_juizo."|".$resultado->comarca."|".$resultado->comarca_id."'/></i></a></td>
                </tr>";
    } while ($resultado = pg_fetch_object($sql));
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
}

?>