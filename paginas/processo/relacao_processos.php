<?php
require_once '../template/header.php'; //chama o header
require_once '../config.php';     //chama as configurações de página!

/**Sessão**/
if(!isset($_SESSION['usuario'])) header("location:logout.php");

/* Aqui limita-se o número de registros por página */
$limite = 3;

if(isset($_POST['limite'])) $limite = $_POST['limite'];

if(isset($_GET['limite'])) $limite = $_GET['limite'];


/*Aqui gerencia-se o offset da query*/
$offset = 0;

if(isset($_GET['offset'])) $offset = $_GET['offset'];




$query = "select processo.id_processo, numero_unificado, to_char(data_distribuicao, 'DD/MM/YYYY')as data_distribuicao,
to_char(transito_em_julgado, 'DD/MM/YYYY') as transito_em_julgado, natureza_acao.nome as nome_natureza,
pautor.nome as autor, preu.nome as reu
from (((((processo 
inner join natureza_acao
on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
inner join autor on processo.id_processo = autor.id_processo and autor.flag_papel=0)
inner join reu on processo.id_processo = reu.id_processo and reu.flag_papel=0)
inner join pessoa preu on reu.id_pessoa = preu.id_pessoa)
inner join pessoa pautor on autor.id_pessoa = pautor.id_pessoa)
order by data_distribuicao limit $limite offset $offset";

$pesq_processo = pg_exec($conexao1, $query);
$resultado = pg_fetch_object($pesq_processo);

$parcial = pg_num_rows($pesq_processo);

$query = "select processo.id_processo, numero_unificado, to_char(data_distribuicao, 'DD/MM/YYYY')as data_distribuicao,
to_char(transito_em_julgado, 'DD/MM/YYYY') as transito_em_julgado, natureza_acao.nome as nome_natureza,
pautor.nome as autor, preu.nome as reu
from (((((processo 
inner join natureza_acao
on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
inner join autor on processo.id_processo = autor.id_processo and autor.flag_papel=0)
inner join reu on processo.id_processo = reu.id_processo and reu.flag_papel=0)
inner join pessoa preu on reu.id_pessoa = preu.id_pessoa)
inner join pessoa pautor on autor.id_pessoa = pautor.id_pessoa)
order by data_distribuicao";
$pesq_total = pg_query($conexao1,$query);
$total = pg_num_rows($pesq_total);

$cont = $parcial;
if(isset($_GET['cont'])) $cont = $_GET['cont'];
if ($cont>$total) $cont = $total;
?>

<div class="container content">
    <div class ="esquerda"> <h1>Processos</h1> </div>
    <br/>
    <br/>
    <hr border ="20px" height ="50px">
    
        <div class ="esquerda">
        <a class="btn btn-small btn-success" href="cadastrar_processo.php">
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
                <td><a href=view_processo.php?id=$resultado->id_processo>" . $resultado->numero_unificado . "</a></td>
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
        <div class ="row">
        <div class = "span2 offset3">
            <?php
                if ($offset>0)
                    echo "<a class= btn btn-small href=relacao_processos.php?offset=".($offset-$limite)."&limite=$limite>";
                else echo "<a class= btn btn-small disabled>";
                echo "<i class=icon-chevron-left></i>
                        Anterior
                    </a>";

            ?>
           
        </div>
        <div class="span2">
        <form name="num_resultados" action="relacao_processos.php" method="post">
            <select class ="span1" name="limite" onchange="valor()" >
                <?php 
                echo "<option value=$limite>$limite</option>
                <option value=1>1</option>
                <option value=2>2</option>
                <option value=3>3</option>
                <option value=4>4</option>
                <option value=5>5</option>
                <option value=6>6</option>
                <option value=7>7</option>
                <option value=8>8</option>";
                ?>
            </select>
        </form>
        </div>
        <div class = span4>
        <?php
        if ($cont<$total)
         echo "<a class= btn btn-small href=relacao_processos.php?offset=".($limite+$offset)."&limite=$limite&cont=".($cont+$parcial).">";
        else echo "<a class= btn btn-small disabled>";
       echo "Pr&oacute;ximo
            <i class=icon-chevron-right></i>
            </a>";
                
        ?>
        </div>
    </div>
    </div>

    
    
</div>
</body>
</html>
<?php
require_once '../template/scripts.php'; //chama scripts comuns as paginas

?>