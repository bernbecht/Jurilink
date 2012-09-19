<?php

require_once '../classes/CProcesso_ato.php';

require_once '../config.php';

session_start();

$id_processo = $_POST['id_processo'];
$limite = $_POST['limite'];

$ato = new CProcesso_ato();

$sql = $ato->getProcesso_Ato($id_processo, $limite);

$ato_proc = pg_fetch_object($sql);

echo ' <div class="tabela_at">';

if ($ato_proc->nome != '') {
    echo "<table = 'ato' class='table table-striped table-condensed' >";
    echo "<thead>";
    echo "<tr>
                <th>Ato</th>
                <th>Data de Modifica&ccedil;&atilde;o</th>
                <th>Descri&ccedil;&atilde;o</th>";
    if ($_SESSION['tipo_usuario'] == 2)
        echo "<th>Acoes</th>
             </tr>
        </thead>";
    echo "<tbody>";
    if ($ato_proc->nome) {
        do {
            if ($_SESSION['tipo_usuario'] == 2) {
                echo "<tr>	
                    <td>" . $ato_proc->nome . "</a></td>
                    <td>" . $ato_proc->data_atualizacao . "</td>
                    <td>" . $ato_proc->descricao . "</td>
                        <td><a href=#><i class='icon-remove-circle excluir-ato'><input type='hidden' value = '".$ato_proc->id_ato."|".$ato_proc->id_processo."'/></i></a></td>
                    </tr>";
            } else if ($_SESSION['tipo_usuario'] == 1 || $_SESSION['tipo_usuario'] == 0) {
                if ($ato_proc->flag_cliente == 't') {
                    echo "<tr>	
                            <td>" . $ato_proc->nome . "</a></td>
                            <td>" . $ato_proc->data_atualizacao . "</td>
                            <td>" . $ato_proc->descricao . "</td>
                            </tr>";
                }
            }
        } while ($ato_proc = pg_fetch_object($sql));
    }

    echo "</tbody>";
    echo "</table>";
    echo "<p class='centro'><button id='todos_atos' class='btn btn-primary'>Ver todos os atos</button></p>";
} else {
    echo'<div class="alert alert-info"><h4>Não há atos no momento.</h4></div>';
}

echo '</div>';
?>
