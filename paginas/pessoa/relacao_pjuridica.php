<?php
require_once '../template/header.php'; //chama o header
require_once  '../config.php';     //chama as configurações de página!
include '../operacoes/CPessoa/relacao_pessoas_op.php';

$limite = 10;
$offset = 0;

$pesq_juridica = getPessoas($conexao1, 1,$limite,$offset);
$resultado = pg_fetch_object($pesq_juridica);
?>

<div class="container">
    <div class ="esquerda"> <h1>Pessoa Jur&iacute;dica</h1> </div>
    <br/>
    <br/>
    <hr border ="20px" height ="50px">
    
        <div class ="esquerda">
        <a class="btn btn-small btn-success" href="#">
            <i class="icon-plus icon-white"></i>
            INCLUIR PESSOA JUR&Iacute;DICA     
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
        echo "<table = 'juridica' class=table table-striped table-condensed >";
        echo "<thead>";
        echo "<tr>
                <th>Nome</th>
                <th>CNPJ</th>
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
                <td>" . $resultado->cnpj . "</td>
                <td>" . $resultado->email . "</td>
                <td>" . $resultado->tel . "</td>
                <td>" . $resultado->cidade . "</td>
                <td>" . $resultado->nome_estado . "</td>
                <td> ACOES</td>
                </tr>";
        } while ($resultado = pg_fetch_object($pesq_juridica));
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