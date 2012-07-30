<?php
require_once '../template/header.php'; //chama o header
require_once  '../config.php';     //chama as configurações de página!
include '../operacoes/CPessoa/relacao_pessoas_op.php';


session_start();
if(!isset($_SESSION['usuario'])) header("location:logout.php");

//Seta a quantidade de resultados caso tenha sido alterada
$limite = 4;

if(isset($_POST['limite'])) $limite = $_POST['limite'];

if(isset($_GET['limite'])) $limite = $_GET['limite'];



//Seta OFFSET para próxima página de resultados

$offset = 0; //Offset

if(isset($_POST['offset'])) $offset = $_POST['offset'];

if(isset($_GET['offset'])) $offset=$_GET['offset'];



$chama_funcao = getPessoas($conexao1, 0, $limite, $offset);

$pesq_fisica = $chama_funcao[0];
$resultado = pg_fetch_object($pesq_fisica);


$pesq_registros = $chama_funcao[1];
$registros = pg_fetch_object($pesq_registros);
 
$parcial_ant = 0;
if(isset($_POST['parcial_ant'])) $parcial_ant = $_POST['parcial_ant'];
if(isset($_GET['parcial_ant'])) $parcial_ant = $_GET['parcial_ant'];


$parcial = pg_num_rows($pesq_fisica); //Número de linhas mostradas na tela


echo "PARCIAL ANTERIOR:".$parcial_ant."<br/>";
echo "PARCIAL ATUAL:".$parcial."<br/>";

//Seta contador para "Próximo"
$cont = $parcial; //contador

if(isset($_POST['cont'])){
    $cont1=$_POST['cont'];
    if ($offset==0) $cont = $parcial;
    else{
        if($parcial_ant>$parcial) $cont = $cont1+($parcial_ant-$parcial);
        else $cont = $cont1+($parcial-$parcial_ant);
    }
    if ($cont>$registros->count) $cont = $registros->count;
    
}

if(isset($_GET['cont'])) $cont=$_GET['cont'];

//if ($cont > $parcial) $cont = $parcial;

/*TESTE*/
echo "REGISTROS TOTAIS:".$registros->count."<br/>";
echo "REGISTROS PARCIAIS:".$parcial."<br/>";
echo "SOMA REGISTROS:".$cont."<br/>";
echo "LIMITE:".$limite."<br/>";
echo "OFFSET:".$offset."<br/>";


?>

<div class="container">
    <div class ="esquerda"> <h1>Pessoa F&iacute;sica</h1> </div>
    <br/>
    <br/>
    <hr border ="20px" height ="50px">
    
        <div class ="esquerda">
        <a class="btn btn-small btn-success" href="#">
            <i class="icon-plus icon-white"></i>
            INCLUIR PESSOA F&Iacute;SICA     
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
                <td>" . $resultado->nome_pessoa . "</td>
                <td>" . $resultado->cpf . "</td>
                <td>" . $resultado->rg . "</td>
                <td>" . $resultado->email . "</td>
                <td>" . $resultado->tel . "</td>
                <td>" . $resultado->cidade . "</td>
                <td>" . $resultado->nome_estado . "</td> 
                <td>ACOES</td>
                </tr>";
        }while ($resultado = pg_fetch_object($pesq_fisica));
        echo "</tbody>";
        echo "</table>";
    ?>
    </div>
    <div class ="row">
        <div class = span2>
            <?php
                if ($offset>0) {
                 if ($offset>=$limite)   
                    echo "<a class= btn btn-small href=relacao_pfisica.php?offset=".($offset-$limite)."&limite=$limite&cont=".($cont-$parcial).">";
                 else echo "<a class= btn btn-small href=relacao_pfisica.php?offset=0&limite=$limite&cont=".($cont-$parcial).">";
                }
                else echo "<a class= btn btn-small disabled>"; 
                echo "<i class=icon-chevron-left></i>
                        Anterior
                    </a>";

            ?>
           
        </div>
        <div class="span3">
        <form name="num_resultados" action="relacao_pfisica.php" method="post">
            <select name="limite" onchange="valor()" >
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
            <?php
                echo '<input name="offset" type="hidden" value="'.$offset.'" />';
                
                echo '<input name="cont" type="hidden" value="'.$cont.'" />';
                
                echo '<input name="parcial_ant" type="hidden" value="'.$parcial.'" />';
                
             ?>
        </form>
        </div>
        <div class = span4>
        <?php
        if ($cont<$registros->count){
            $cont=$cont+$parcial;
            if ($cont>$registros->count) $cont = $registros->count;
            echo "<a class= btn btn-small href=relacao_pfisica.php?offset=".($limite+$offset)."&limite=$limite&cont=$cont&parcial_ant=$parcial>";
        }
        else echo "<a class= btn btn-small disabled>";
        
        echo "Pr&oacute;ximo
            <i class=icon-chevron-right></i>
            </a>";
                
        ?>
        </div>
    </div>
    
                    
    
</div> <!--Container-->
</body>
</html>
<?php
require_once '../template/scripts.php'; //chama scripts comuns as paginas

?>