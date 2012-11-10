<?php
require_once '../template/header.php'; //chama o header
require_once '../config.php';     //chama as configurações de página!

?>

<div class="container content">
    <div class="row">
        <div class ="esquerda"> <h1>Processos</h1> </div>        
    </div>
    
    <div class="divisor_horizontal_view"></div>
    
    <div class="row">
        <div class ="esquerda"> 
            <a href="cadastrar_processo.php">
                <button type="button" class="btn btn-small btn-success">
                    <i class="icon-plus icon-white"></i>
                    INCLUIR PROCESSO     
                </button>
            </a> 
        </div>   
        <div class ="direita">
             <input id="busca-input" type="text" class="input-medium search-query" placeholder="Pesquisa">
        </div>
        <br/>
    </div>
    
    
    <div class="row row_relacao">
        <div id="tabela_container">
            <div id="tabela"> 
                
            </div>
        </div>
    </div>
    
    <div class="row paginacao">
        <p class="centro">
            <button class="btn" id="botao_anterior"><i class=icon-chevron-left></i>Anterior</button>
            <select class ="span1" id="limite" >
                
                <option value=5>5</option>
                <option value=10>10</option>
                <option value=15>15</option>
                <option value=20>20</option>
            </select>
            <button type ="button" class="btn" id="botao_proximo">Próximo<i class=icon-chevron-right></i></button>
        </p>
    </div>
    
</div><!-- CONTAINER -->

<?php
require_once '../template/help/help-relacao-processo.php'; //chama scripts comuns as paginas
?>

</body>
<?php
require_once '../template/scripts.php'; //chama scripts comuns as paginas
require_once 'script_relacao_processos.php'; //chama scripts comuns as paginas
?>
</html>
