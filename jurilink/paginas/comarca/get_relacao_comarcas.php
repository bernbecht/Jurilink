<?php

session_start();
require_once '../classes/CComarca.php';

$comarca = new CComarca();

$sql = $comarca->getRelacaoComarca();
$resultado = pg_fetch_object($sql);


//se nao tiver algum processo cadastrado, retorne 0
if (!$resultado) {
    echo 0;
} else {
    echo "<div id='tabela'>";
    echo "<table = 'comarcas' class='table table-striped table-condensed' >";
    echo "<thead>";
    echo "<tr>
                <th>Nome</th>
                <th class = 'centro'>Ações</th>
                </tr></thead>";
    echo "<tbody>";
    do {
        echo "<tr>	
                <td>" . $resultado->nome . "</td>
                <td class='centro'><a class='tooltip_class' rel='tooltip' data-placement='top' data-original-title='Editar comarca' href='#'><i class='icon-pencil editar-comarca'><input type='hidden' value = '" .$resultado->nome."|".$resultado->id_comarca."'/></i></a></td>
             </tr>";
    } while ($resultado = pg_fetch_object($sql));
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
}
?>
