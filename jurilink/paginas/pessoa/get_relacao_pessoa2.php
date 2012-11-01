<?php

session_start();
require_once '../classes/CPessoa.php';

$modalidade = $_POST['modalidade'];
$tipo = $_POST['tipo'];
$limite = $_POST['limite'];

if ($modalidade == -1 || $modalidade==0){
    $_SESSION['cont'] = 0;
    $_SESSION['offset'] = 0;
    
}




if ($modalidade == 0)
    $offset = 0;
else if ($modalidade = 1)
    $offset = $_SESSION['offset'];

$pessoa = new CPessoa();

$sql = $pessoa->getPessoas($tipo, $limite, $offset);
$resultado = pg_fetch_object($sql[0]);

//tamanho do resultado
$total = $sql[1];
$registros = pg_fetch_object($total);
$total = $registros->count;

//quantas linhas foram mostradas na tela
$parcial = pg_num_rows($sql[0]);


echo "<div id='tabela'>";
echo "<table = 'fisica' class=table table-striped table-condensed >";
echo "<thead>";
echo "<tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>RG</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>A&ccedil;&otilde;es</th>
                </tr></thead>";
echo "<tbody>";

do {
    echo "<tr>	
                <td><a href=view_pessoafisica.php?id=$resultado->id_pessoa>" . $resultado->nome_pessoa . "</a></td>
                <td>" . $resultado->cpf . "</td>
                <td>" . $resultado->rg . "</td>
                <td>" . $resultado->email . "</td>
                <td>" . $resultado->tel . "</td>
                <td>" . $resultado->cidade . "</td>
                <td>" . $resultado->nome_estado . "</td> 
                <td>ACOES</td>
                </tr>";
} while ($resultado = pg_fetch_object($sql[0]));
echo "</tbody>";
echo "</table>";
echo "</div>";


$cont = $parcial;
if (isset($_SESSION['cont']))
    $_SESSION['cont'] = $_SESSION['cont'] + $parcial;
else
    $_SESSION['cont'] = $cont;


$_SESSION['offset'] = $offset + $limite;

if($modalidade == 2){
    $_SESSION['offset'] = $offset - $limite;
}

 /*echo "TOTAL: ".$total;
  echo "Parcial: ".$parcial;
  echo "Cont: ".$cont;
  echo "Sessao: ". $_SESSION['cont']; */
  
  if ($_SESSION['cont'] == $total) {
    $cont = $total;
    echo "!1";
}
else if($_SESSION['cont'] == 0){
    $cont = $total;
    echo "!1";
}
?>