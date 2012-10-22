<?php

session_start();
require_once '../classes/CPessoa.php';

$modalidade = $_POST['modalidade'];
$tipo = $_POST['tipo'];
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



$pessoa = new CPessoa();

$sql = $pessoa->getPessoas($tipo, $limite, $offset);
$resultado = pg_fetch_object($sql[0]);

//tamanho do resultado
$total = $sql[1];
$registros = pg_fetch_object($total);
$total = $registros->count;

//echo "TOTAL: " . $total;
//quantas linhas foram mostradas na tela
$parcial = pg_num_rows($sql[0]);

//echo "Parcial:" . $parcial;

if (!$resultado) {
    echo 0;
} else {

    echo "<div id='tabela'>";
    echo "<table = 'fisica' class='table table-striped table-condensed' >";
    echo "<thead>";
    echo "<tr>
  <th>Nome</th>
  <th>CPF/CNPJ</th>";

    if ($tipo == 0 || $tipo == 2) {
        echo '<th>RG</th>';
    }
    if ($tipo == 2) {
        echo '<th>OAB</th>';
    }

    echo "<th>E-mail</th>
  <th>Telefone</th>
  <th>Cidade</th>
  <th>Estado</th>
  
  </tr></thead>";
    echo "<tbody>";

    do {
        if ($tipo == 0 || $tipo == 2) {
            $dado_imposto = $resultado->cpf;
        } else {
            $dado_imposto = $resultado->cnpj;
        }

        if ($tipo == 0) {
            $url = 'view_pessoafisica.php?id=';
        } else if ($tipo == 1) {
            $url = 'view_pessoajuridica.php?id=';
        } else if ($tipo == 2) {
            $url = 'view_advogado.php?id=';
        }

        echo "<tr>
  <td><a href=$url$resultado->id_pessoa>" . $resultado->nome_pessoa . "</a></td>
  <td>" . $dado_imposto . "</td>";

        if ($tipo == 0 || $tipo == 2) {
            echo "<td>" . $resultado->rg . "</td>";
        }

        if ($tipo == 2) {
            echo "<td>" . $resultado->oab . "</td>";
        }


        echo"<td>" . $resultado->email . "</td>
  <td>" . $resultado->tel . "</td>
  <td>" . $resultado->cidade . "</td>
  <td>" . $resultado->nome_estado . "</td>

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