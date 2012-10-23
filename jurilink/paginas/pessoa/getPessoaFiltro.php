<?php

//Arquivo que faz o filtro das PESSOAS na página de Relações
//Autor: Berhell

require_once '../classes/CPessoa.php';
require_once '../classes/CFisica.php';
require_once '../classes/CJuridica.php';
require_once '../classes/CAdvogado.php';

$txt = $_POST['txt'];
$modalidade = $_POST['modalidade'];


//expressão regular pra não deixar incluir caracteres que podem dar problema na query e espaços desncessários
$dadoRegex = "/^[a-zA-Z0-9]+$/";

//se o campo está vazio, manda um sinal para que o estado inicial seja recarregado
if ($txt == '') {
    echo 1;
}
//se não passar na expressão regular
else if (!preg_match($dadoRegex, $txt)) {

    echo -1;
}
//se for uma string válida
else {
    //variável que receberá o resultado de busca por OAB
    $resultadoA = NULL;

    //1:fisica
    //2:juridica
    //3:advogado
    if ($modalidade == 1) {
        $fisica = new CFisica;
        if (is_numeric($txt)) {
            $sql = $fisica->getFisicaCpfRGTipo2($txt, 0);
        } else {
            $sql = $fisica->getFisicaPorNome($txt);
        }
    } else if ($modalidade == 2) {
        $juridica = new CJuridica;
        if (is_numeric($txt)) {
            $sql = $juridica->getJuridicaCNPJFiltro($txt);
        } else {
            $sql = $juridica->getJuridicaPorNome($txt);
        }
    } else {
        $fisica = new CFisica;
        $ad = new CAdvogado();
        
        if (is_numeric($txt)) {
            $sql = $fisica->getFisicaCpfRGTipo2($txt, 2);
            $sqlAd = $ad->getAdvogadoOabFiltro($txt);
            $resultadoA = pg_fetch_object($sqlAd);
        }
        else{
            $sql = $ad->getAdvogadoPassaNome($txt);
        }
    }


    $resultado = pg_fetch_object($sql);


    if ($resultado == NULL && $resultadoA == NULL)
        echo 0;
    else {

        echo "<div id='tabela'>";
        echo "<table = 'fisica' class=table table-striped table-condensed >";
        echo "<thead>";
        echo "<tr>
                <th>Nome</th>
                <th>CPF/CNPJ</th>";

        if ($modalidade == 1 || $modalidade == 3) {
            echo '<th>RG</th>';
        }
        if ($modalidade == 3) {
            echo '<th>OAB</th>';
        }

        echo "<th>E-mail</th>
                 <th>Telefone</th>
                 <th>Cidade</th>
                 <th>Estado</th>
  
            </tr></thead>";
        echo "<tbody>";

        if ($resultado != NULL) {
            do {
                if ($modalidade == 1 || $modalidade == 3) {
                    $dado_imposto = $resultado->cpf;
                } else if ($modalidade == 2) {
                    $dado_imposto = $resultado->cnpj;
                }

                if ($modalidade == 1) {
                    $url = 'view_pessoafisica.php?id=';
                } else if ($modalidade == 2) {
                    $url = 'view_pessoajuridica.php?id=';
                } else if ($modalidade == 3) {
                    $url = 'view_advogado.php?id=';
                }

                echo "<tr>
                    <td><a href=$url$resultado->id_pessoa>" . $resultado->nome . "</a></td>
                    <td>" . $dado_imposto . "</td>";

                if ($modalidade == 1 || $modalidade == 3) {
                    echo "<td>" . $resultado->rg . "</td>";
                }

                if ($modalidade == 3) {
                    echo "<td>" . $resultado->oab . "</td>";
                }

                echo"<td>" . $resultado->email . "</td>
                    <td>" . $resultado->tel . "</td>
                    <td>" . $resultado->cidade . "</td>
                    <td>" . $resultado->estado . "</td>

                    </tr>";
            } while ($resultado = pg_fetch_object($sql));
        }//if RESULTADO
        if ($resultadoA != NULL) {
            do {
                if ($modalidade == 1 || $modalidade == 3) {
                    $dado_imposto = $resultadoA->cpf;
                } else if ($modalidade == 2) {
                    $dado_imposto = $resultadoA->cnpj;
                }

                if ($modalidade == 1) {
                    $url = 'view_pessoafisica.php?id=';
                } else if ($modalidade == 2) {
                    $url = 'view_pessoajuridica.php?id=';
                } else if ($modalidade == 3) {
                    $url = 'view_advogado.php?id=';
                }

                echo "<tr>
                    <td><a href=$url$resultadoA->id_pessoa>" . $resultadoA->nome . "</a></td>
                    <td>" . $dado_imposto . "</td>";

                if ($modalidade == 1 || $modalidade == 3) {
                    echo "<td>" . $resultadoA->rg . "</td>";
                }

                if ($modalidade == 3) {
                    echo "<td>" . $resultadoA->oab . "</td>";
                }

                echo"<td>" . $resultadoA->email . "</td>
                    <td>" . $resultadoA->tel . "</td>
                    <td>" . $resultadoA->cidade . "</td>
                    <td>" . $resultadoA->estado . "</td>

                    </tr>";
            } while ($resultadoA = pg_fetch_object($sqlAd));
        }//if RESULTADO
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    }//else
}
?>
