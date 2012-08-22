<?php
require_once '../template/header.php'; //chama o header
require_once  '../config.php';     //chama as configurações de página!
include '../operacoes/CPessoa/relacao_pessoas_op.php';

/**Sessão**/
if(!isset($_SESSION['usuario'])) header("location:logout.php");

/* Aqui limita-se o número de registros por página */
$limite = 1;

if(isset($_POST['limite'])) $limite = $_POST['limite'];

if(isset($_GET['limite'])) $limite = $_GET['limite'];


/*Aqui gerencia-se o offset da query*/
$offset = 0;

if(isset($_GET['offset'])) $offset = $_GET['offset'];

/*Chama getPessoas que retorna um array:
 * Array[0] = Busca de resultados no BD com limite e offset, ordenados por 'nome'
 * Array[1] = Busca número total de registros na mesma query
 */
$chamar_funcao = getPessoas($conexao1, 2, $limite, $offset);

$pesq_advogado = $chamar_funcao[0]; //pega a posição 0 do array de retorno
$resultado = pg_fetch_object($pesq_advogado);

$total = $chamar_funcao[1];
$registros = pg_fetch_object($total);

$total = $registros->count; //Total de registros

/*Gerencia botão 'Próximo'*/
$parcial = pg_num_rows($pesq_advogado);
//echo $parcial;

$cont = $parcial;
if(isset($_GET['cont'])) $cont = $_GET['cont'];
if ($cont>$total) $cont = $total;

?>

<div class="container content">
    <div class ="esquerda"> <h1>Advogado</h1> </div>
    <br/>
    <br/>
    <hr border ="20px" height ="50px">
    
        <div class ="esquerda">
        <a class="btn btn-small btn-success" href="#">
            <i class="icon-plus icon-white"></i>
            INCLUIR ADVOGADO     
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
        echo "<table = 'advogados' class=table table-striped table-condensed >";
        echo "<thead>";
        echo "<tr>
                <th>Nome</th>
                <th>Funcionario</th>
                <th>OAB</th>
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
                <td><a href=view_advogado.php?id=$resultado->id_pessoa>" . $resultado->nome_pessoa . "</a></td>";
                if ($resultado->flag_func == 't')
                    echo "<td> Sim </td>";
                else echo "<td> N&atilde;o </td>";
                echo "<td>" . $resultado->oab. "</td>
                <td>" . $resultado->cpf. "</td>
                <td>" . $resultado->rg. "</td>
                <td>" . $resultado->email. "</td>
                <td>" . $resultado->tel. "</td>
                <td>" . $resultado->cidade. "</td>
                <td>" . $resultado->nome_estado. "</td>
                <td> ACOES</td>
                </tr>";
        } while ($resultado = pg_fetch_object($pesq_advogado));
        echo "</tbody>";
        echo "</table>";
    ?>
    </div>
<div class ="row">
        <div class = "span2 offset3">
            <?php
                if ($offset>0)
                    echo "<a class= btn btn-small href=relacao_advogados.php?offset=".($offset-$limite)."&limite=$limite>";
                else echo "<a class= btn btn-small disabled>";
                echo "<i class=icon-chevron-left></i>
                        Anterior
                    </a>";

            ?>
           
        </div>
        <div class="span2">
        <form name="num_resultados" action="relacao_advogados.php" method="post">
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
         echo "<a class= btn btn-small href=relacao_advogados.php?offset=".($limite+$offset)."&limite=$limite&cont=".($cont+$parcial).">";
        else echo "<a class= btn btn-small disabled>";
       echo "Pr&oacute;ximo
            <i class=icon-chevron-right></i>
            </a>";
                
        ?>
        </div>
    </div>
    
    
    
</div>
</body>
</html>
<?php
require_once '../template/scripts.php'; //chama scripts comuns as paginas

?>