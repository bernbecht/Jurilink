<?php
require_once '../template/header.php'; //chama o header
require_once '../config.php';     //chama as configurações de página!
?>

<div class="container content">
    <div class="row">
        <div class ="esquerda"> <h1>Naturezas de Ação</h1> </div>        
    </div>
    

    <div class="divisor_horizontal_view"></div>
    
    <div id="aviso">    </div>

    <div class="row">
        <div class ="esquerda"> 
            <a href="cadastrar_natureza_acao.php">
                <button type="button" class="btn btn-small btn-success">
                    <i class="icon-plus icon-white"></i>
                    INCLUIR NATUREZA DE AÇÃO     
                </button>
            </a> 
        </div>   
        <div class ="direita">

        </div>
        <br/>
    </div>


    <div class="row row_relacao">
        <div id="tabela_container">
            <div id="tabela"> 

            </div>
        </div>
    </div>




</div><!-- CONTAINER -->

<!-- Modal para edição de NATUREZA DE AÇÃO -->
<div id="myModal" class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">x</button>
        <h3>Edição de Comarca</h3>
    </div>   
    <div class="modal-body">
        <form id="form_natureza" class="form-horizontal altera_natureza_Ajax" method="post" action="../operacoes/CNatureza_acao/editar_natureza_acao_op.php">
            <fieldset>

                <!--Campos formulário --> 
                <div id="nome" class="control-group">
                    <label class="control-label" for="Nome">Nome</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="nome_input" name="nome">                       
                        <span  class="help-inline ">Minimo 2 caracteres</span>                    
                    </div>
                </div>  
                <input type="hidden" class="input-xlarge aviso" id="id_input" name="id">


            </fieldset>
        </form> 

        <div class="modal-footer"> 
            <a href="#" class="btn cancelar-modal-senha" data-dismiss="modal">Cancelar</a>
            <button id ="nome" type="button" class="btn btn-primary ok-modal-natureza">OK</button>
        </div>
    </div>

</body>
<?php
require_once '../template/scripts.php'; //chama scripts comuns as paginas
require_once 'script_relacao_natureza.php'; //chama scripts comuns as paginas
?>
</html>
