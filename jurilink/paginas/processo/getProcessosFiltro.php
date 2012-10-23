<?php

//Arquivo que faz o filtro dos processos na página de Relações

require_once '../classes/CProcesso.php';

$txt = $_POST['txt'];


//expressão regular pra não deixar incluir caracteres que podem dar problema na query
$dadoRegex = "/^[a-zA-Z0-9]+|\/$/";


if ($txt == '') {
    echo 1;
} 

else if (!preg_match($dadoRegex, $txt)) {
        
    echo -1;
    }

else {

    $processo = new CProcesso;
    $dataRegex = "/^([0-9]{2}\/[0-9]{2}\/[0-9]{4})$/";

    //se for data
    if (preg_match($dataRegex, $txt)) {
                
        $data = explode("/",$txt);
        
        $newData = $data[2]."-".$data[1]."-".$data[0];
        
        //echo $data[0];
        
        $sql = $processo->getProcessoData($newData);

        $resultado = pg_fetch_object($sql);
        
        //echo $newData;
    }
    //se for numero
    else if (is_numeric($txt)) {

        $sql = $processo->getProcessoRelacaoComNumUni($txt);

        $resultado = pg_fetch_object($sql);
    } 
    //se for nome
    else {
        $sql = $processo->getProcessoPessoa($txt);

        $resultado = pg_fetch_object($sql);
    }

    if ($resultado == NULL)
        echo 0;
    else {
        echo "<div id='tabela'>";
        echo "<table = 'processos' class=table table-striped table-condensed >";
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
        } while ($resultado = pg_fetch_object($sql));
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    }
}
?>
