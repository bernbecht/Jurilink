<?php
require_once '../template/header.php'; //chama o header
require_once '../config.php';     //chama as configurações de página!


$query = "select numero_unificado, to_char(data_distribuicao, 'DD/MM/YYYY')as data_distribuicao,
to_char(transito_em_julgado, 'DD/MM/YYYY') as transito_em_julgado, natureza_acao.nome as nome_natureza,
pautor.nome as autor, preu.nome as reu
from (((((processo 
inner join natureza_acao
on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
inner join autor on processo.id_processo = autor.id_processo and autor.flag_papel=0)
inner join reu on processo.id_processo = reu.id_processo and reu.flag_papel=0)
inner join pessoa preu on reu.id_pessoa = preu.id_pessoa)
inner join pessoa pautor on autor.id_pessoa = pautor.id_pessoa       
)";

$pesq_processo = pg_exec($conexao1, $query);
$resultado = pg_fetch_object($pesq_processo);


?>

<div class="container">
    <div class ="esquerda"> <h1>Processos</h1> </div>
    <br/>
    <br/>
    <hr border ="20px" height ="50px">
    
        <div class ="esquerda">
        <a class="btn btn-small btn-success" href="#">
            <i class="icon-plus icon-white"></i>
            INCLUIR PROCESSO     
        </a>             
        </div>
        <div class ="direita">
            <form class="navbar-form pull-left">
                <input type="text" class="search-query">
                <i class="icon-search"></i>
            </form>
        </div>
    <br/>
    <hr border ="20px" height ="50px">
    
    
    
    <div class="tabela"> 
    <?php 
        echo "<table = 'processos' class=table table-striped table-condensed >";
        echo "<thead>";
        echo "<tr>
                <th>N&uacute;mero</th>
                <th>Data Distribui&ccedil;&atilde;o</th>
                <th>Natureza</th>
                <th>Autor(es)</th>
                <th>R&eacute;u(s)</th>
                <th>Tr&acirc;nsito em Julgado</th>
                <th>A&ccedil;&otilde;es</th>
                </tr></thead>";
        echo "<tbody>";
        do {
            echo "<tr>	
                <td>" . $resultado->numero_unificado . "</td>
                <td>" . $resultado->data_distribuicao . "</td>
                <td>" . $resultado->nome_natureza . "</td>
                <td>" . $resultado->autor . "</td>
                <td>" . $resultado->reu . "</td>
                <td>" . $resultado->transito_em_julgado . "</td>
                <td> ACOES</td>
                </tr>";
        } while ($resultado = pg_fetch_object($pesq_processo));
        echo "</tbody>";
        echo "</table>";
    ?>
    </div>
    
    
</div>
</body>
</html>
<?php
require_once '../template/scripts.php'; //chama scripts comuns as paginas

?>