<?php

/* CÓDIGO QUE RECEBE UMA REQUISIÇÃO AJAX DO VIEW_PESSOA PARA 
 * PEGAR OS PROCESSOS TOTAIS COM A ADVOCACIA
 */

require_once 'paginas/classes/CAdvogado.php';


$fisica = new CAdvogado();

$processo = $fisica->getProcessosAdvogadoTotal(4);
$processos_advocacia = pg_fetch_object($processo);


if(pg_num_rows($processo)>0) {

    echo "<table = 'processos' class='table table-striped ' >";
    echo "<thead>";
    echo "<tr>
                    <th>Data Distribui&ccedil;&atilde;o</th>
                    <th>N&uacute;mero</th>
                    <th>Natureza</th>
                    <th>Autor(es)</th>
                    <th>R&eacute;u(s)</th>
                    <th>Advogado</th>
                    <th>Valor da Causa</th>
                    </tr>
                    </thead>";
    echo "<tbody>";

    do {
        echo "<tr>	
                    <td>" . $processos_advocacia->data_distribuicao . "</td>
                    <td><a href=../processo/view_processo.php?id=$processos_advocacia->id_processo>" . $processos_advocacia->numero_unificado . "</a></td>
                    <td>" . $processos_advocacia->nome_natureza . "</td>
                    <td>" . $processos_advocacia->nome_autor . "</td>
                    <td>" . $processos_advocacia->nome_reu . "</td>
                    <td>" . $processos_advocacia->nome_adv . "</td>
                    <td>" . $processos_advocacia->valor_causa . "</td> 
                    </tr>";
    } while ($processos_advocacia = pg_fetch_object($processo));
    echo "</tbody>";
    echo "</table>";
}
else{
    echo 0;
}
?>
