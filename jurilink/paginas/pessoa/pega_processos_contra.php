<?php

/*CÓDIGO QUE RECEBE UMA REQUISIÇÃO AJAX DO VIEW_PESSOA PARA 
 * PEGAR OS PROCESSOS TOTAIS CONTRA A ADVOCACIA
 */

require_once '../classes/CFisica.php';
require_once '../classes/CJuridica.php';

$id_pessoa = $_POST['id_pessoa'];
$href = $_POST['href'];
$tipo_pessoa = $_POST['tipo_pessoa'];

if ($href == 'pessoafisica' || $tipo_pessoa== 0) {
    $fisica = new CFisica();

    $processo = $fisica->getProcessosFisicaContraTotal($id_pessoa);
    $processos_advocacia = pg_fetch_object($processo);

    echo "<table = 'processos' class='table table-striped  table-condensed' >";
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
                    <td><div class = 'direita'\>" . $processos_advocacia->valor_causa . "</td> 
                    </tr>";
    } while ($processos_advocacia = pg_fetch_object($processo));
    echo "</tbody>";
    echo "</table>";
    echo "<p class='centro'><button id='todos_processos_contra' class='btn btn-primary'>Ver todos os Processos</button></p>";
} else if ($href == 'pessoajuridica' || $tipo_pessoa== 1) {
    $fisica = new CJuridica();

    $processo = $fisica->getProcessosJuridicaContraAdvocaciaTotal($id_pessoa);
    $processos_advocacia = pg_fetch_object($processo);

    echo "<table = 'processos' class='table table-striped  table-condensed' >";
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
                    <td><div class = 'direita'\>" . $processos_advocacia->valor_causa . "</td> 
                    </tr>";
    } while ($processos_advocacia = pg_fetch_object($processo));
    echo "</tbody>";
    echo "</table>";
    echo "<p class='centro'><button id='todos_processos_contra' class='btn btn-primary'>Ver todos os Processos</button></p>";
}
?>
