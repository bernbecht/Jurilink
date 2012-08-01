<?php
require_once '../template/header.php'; //chama o header
require_once  '../config.php';     //chama as configurações de página!
include '../operacoes/CPessoa/relacao_pessoas_op.php';


$query = "select pessoa.nome as nome_pessoa, fisica.cpf, fisica.rg, pessoa.email, 
                pessoa.tel, pessoa.cidade, uf.nome as nome_estado from pessoa, fisica, uf where
                pessoa.id_pessoa = fisica.id_pessoa and pessoa.id_uf = uf.id_uf order by nome_pessoa 
                limit $limite offset $offset";
$pesq_processo = pg_exec($conexao,$query);
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
                <th>Advogado</th>
                <th>Tr&acirc;nsito em Julgado</th>
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