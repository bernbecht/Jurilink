<?php
require_once '../template/header.php'; //chama o header
require_once '../config.php';     //chama as configurações de página!
?>

<div class="container content">
    <div class="row">
        <div class ="esquerda"> <h1>Comarcas</h1> </div>        
    </div>
    

    <div class="divisor_horizontal_view"></div>
    
    <div id="aviso">
        
        
    </div>

    <div class="row">
        <div class ="esquerda"> 
            <a href="cadastrar_comarca.php">
                <button type="button" class="btn btn-small btn-success">
                    <i class="icon-plus icon-white"></i>
                    INCLUIR COMARCA     
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

<!-- Modal para edição de COMARCA -->
<div id="myModal" class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">x</button>
        <h3>Edição de Comarca</h3>
    </div>   
    <div class="modal-body">
        <form id="form_comarca" class="form-horizontal altera_comarca_Ajax" method="post" action="../operacoes/CComarca/editar_comarca_op.php">
            <fieldset>

                <div id="msg_resultado_edita_comarca"></div>

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
            <button id ="nome" type="button" class="btn btn-primary ok-modal-comarca">OK</button>
        </div>
    </div>

</body>
<?php
require_once '../template/scripts.php'; //chama scripts comuns as paginas
require_once 'script_relacao_comarca.php'; //chama scripts comuns as paginas
//require_once 'scripts_comarca.php'; //chama scripts comuns as paginas
?>
</html>
