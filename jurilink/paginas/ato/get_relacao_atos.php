<?php

session_start();
require_once '../classes/CAto.php';

$ato = new CAto();

$sql = $ato->getRelacaoAto();
$resultado = pg_fetch_object($sql);


//se nao tiver algum processo cadastrado, retorne 0
if (!$resultado) {
    echo 0;
} else {

    echo "<div id='tabela'>";
    echo "<table = 'atos' class='table table-striped table-condensed' >";
    echo "<thead>";
    echo "<tr>
                <th>Nome</th>
                <th class = 'centro'>Visibilidade ao cliente</th>
                <th class = 'centro'>Previsão (dias)</th>
                <th>Descrição</th>
                <th class = 'centro'>Ações</th>
                </tr></thead>";
    echo "<tbody>";
    do {
        echo "<tr>	
                <td>" . $resultado->nome . "</td>";
        if ($resultado->flag_cliente == 't')
                echo "<td class = 'centro'> SIM </td>";
        else  if ($resultado->flag_cliente == 'f')
            echo "<td class = 'centro'> NÃO </td>";
                echo "<td class='centro'>" . $resultado->previsao . "</td>
                <td>" . $resultado->descricao . "</td>
                <td class = 'centro'><a class='tooltip_class' rel='tooltip' data-placement='top' data-original-title='Excluir este Ato' href=#><i class='icon-remove-circle excluir-ato'></i></a></td>
                </tr>";
    } while ($resultado = pg_fetch_object($sql));
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
}

?>