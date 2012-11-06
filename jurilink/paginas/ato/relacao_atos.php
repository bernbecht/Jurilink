<?php
require_once '../template/header.php'; //chama o header
require_once '../config.php';     //chama as configurações de página!
?>

<div class="container content">
    <div class="row">
        <div class ="esquerda"> <h1>Atos</h1> </div>        
    </div>

    <div class="divisor_horizontal_view"></div>

    <div class="row">
        <div class ="esquerda"> 
            <a href="cadastrar_ato.php">
                <button type="button" class="btn btn-small btn-success">
                    <i class="icon-plus icon-white"></i>
                    INCLUIR ATO     
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

<!-- Modal para edição de ATO -->
<div id="myModal" class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">x</button>
        <h3>Edição de Ato</h3>
    </div>   
    <div class="modal-body">

        <div id="aviso">


        </div>

        <form id="form_ato" class="form-horizontal altera_ato_Ajax" method="post" action="../operacoes/CAto/editar_ato_op.php">
            <fieldset>

                <!--Campos formulário --> 
                <div id="nome" class="control-group">
                    <label class="control-label" for="Nome">Nome</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="nome_input" name="nome">                       
                        <span  class="help-inline ">Mínimo 2 caracteres</span>                    
                    </div>
                </div>
                <div id="previsao" class="control-group">
                    <label class="control-label" for="Previsao">Previsão</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="previsao_input" name="previsao"> <br/>
                        <span  class="help-inline ">Apenas números</span>                    
                    </div>
                </div>
                <div id="descricao" class="control-group">
                    <label class="control-label" for="Descricao">Descricao</label>
                    <div class="controls">
                        <textarea class ="textArea-xlarge" rows="4"  id="descricao_input" name="descricao"></textarea>
                       <!-- <input type="text" class="input-xlarge" id="descricao_input" name="descricao">  -->                     
                        <span  class="help-inline ">Mínimo 2 caracteres</span>                    
                    </div>
                </div>
                <div id="flag_user" class="control-group">
                    <label class="control-label" for="userCheckbox">Usuário</label>
                    <div class="controls">
                        <label class="checkbox">
                            <input type="checkbox" name="flag_userCheckbox" id="flag_userCheckbox" value="1">
                            O ato será mostrado ao cliente
                        </label>
                    </div>                    
                </div>  
                <input type="hidden" class="input-xlarge aviso" id="id_input" name="id">    


            </fieldset>
        </form> 

        <div class="modal-footer"> 
            <a href="#" class="btn cancelar-modal-ato" data-dismiss="modal">Cancelar</a>
            <button id ="nome" type="button" class="btn btn-primary ok-modal-ato">OK</button>
        </div>
    </div>

</body>
<?php
require_once '../template/scripts.php'; //chama scripts comuns as paginas
require_once 'script_relacao_ato.php'; //chama scripts comuns as paginas
?>
</html>
