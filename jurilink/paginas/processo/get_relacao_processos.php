<?php

session_start();
require_once '../classes/CProcesso.php';

$modalidade = $_POST['modalidade'];
$limite = $_POST['limite'];

if ($modalidade == -1 || $modalidade == 0) {
    $_SESSION['offset'] = 0;
    $offset = $_SESSION['offset'];
    $_SESSION['count'] = 0;
    $_SESSION['last_parcial'] = 0;
} else if ($modalidade == 1) {
    $_SESSION['offset'] = $_SESSION['offset'] + $limite;
    ;
    $offset = $_SESSION['offset'];
} else if ($modalidade == 2) {
    $_SESSION['offset'] = $_SESSION['offset'] - $limite;
    ;
    $offset = $_SESSION['offset'];
}



$processo = new CProcesso();

$sql = $processo->getProcessoRelacao($limite, $offset);
$resultado = pg_fetch_object($sql[0]);

//tamanho do resultado
$total = $sql[1];

//echo "TOTAL: " . $total;
//quantas linhas foram mostradas na tela
$parcial = pg_num_rows($sql[0]);

//echo "Parcial:" . $parcial;

//se nao tiver algum processo cadastrado, retorne 0
if (!$resultado) {
    echo 0;
    
} else {

    echo "<div id='tabela'>";
    echo "<table = 'processos' class='table table-striped' >";
    echo "<thead>";
    echo "<tr>
                <th>N&uacute;mero</th>
                <th>Data Distribui&ccedil;&atilde;o</th>
                <th>Natureza</th>
                <th>Autor(es)</th>
                <th>R&eacute;u(s)</th>
                <th>Tr&acirc;nsito em Julgado</th>
                
                </tr></thead>";
    echo "<tbody>";
    do {
        echo "<tr>	
                <td><a href=view_processo.php?id=$resultado->id_processo>" . $resultado->numero_unificado . "</a></td>
                <td>" . $resultado->data_distribuicao . "</td>
                <td>" . $resultado->nome_natureza . "</td>
                <td>" . $resultado->autor . "</td>
                <td>" . $resultado->reu . "</td>
                <td>" . $resultado->transito_em_julgado . "</td>
                
                </tr>";
    } while ($resultado = pg_fetch_object($sql[0]));
    echo "</tbody>";
    echo "</table>";
    echo "</div>";



    if ($modalidade == 1 || $modalidade == 0 || $modalidade == -1) {
        $_SESSION['count'] = $_SESSION['count'] + $parcial;
        $_SESSION['last_parcial'] = $parcial;
    } else if ($modalidade == 2) {
        //echo "modal 2";
        $_SESSION['count'] = $_SESSION['count'] - $_SESSION['last_parcial'];
    }

    if ($offset == 0) {
        echo "!2";
    }
    if ($_SESSION['count'] == $total) {
        echo "!1";
    }
}
//echo " CONTA:" . $_SESSION['count'];
//echo 'offset: '.$offset;
?>