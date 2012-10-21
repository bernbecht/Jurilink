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
    echo "<table = 'atos' class=table table-striped table-condensed >";
    echo "<thead>";
    echo "<tr>
                <th>Nome</th>
                <th>Visibilidade ao cliente</th>
                <th>Previsão (dias)</th>
                <th>Descrição</th>
                <th>Ações</th>
                </tr></thead>";
    echo "<tbody>";
    do {
        echo "<tr>	
                <td>" . $resultado->nome . "</td>";
        if ($resultado->flag_cliente == 't')
                echo "<td> SIM </td>";
        else  if ($resultado->flag_cliente == 'f')
            echo "<td> NÃO </td>";
                echo "<td align='center'>" . $resultado->previsao . "</td>
                <td>" . $resultado->descricao . "</td>
                <td><a class='tooltip_class' rel='tooltip' data-placement='top' data-original-title='Excluir este ato' href=#><i class='icon-remove-circle excluir-ato'></i></a></td>
                </tr>";
    } while ($resultado = pg_fetch_object($sql));
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
}

?>