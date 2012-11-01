<?php
require_once '../template/header.php'; //chama o header
require_once ( '../config.php');     //chama as configura��es de p�gina!
?>

<div class="container content">
    <form name = "form_natureza " form id="form_natureza" class="form-horizontal" method="post" action="../operacoes/CNatureza_acao/incluir_natureza_acao_op.php">
        <fieldset>

            <!--Campos formul�rio -->

            <legend><h1>Cadastrar Nova Natureza</h1></legend>
            
            <div id="msg_resultado_processo">
               
            </div>   

            <div id="nome" class="control-group">
                <label class="control-label" for="Nome">Nome</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="nome_input" name="nome">                       
                    <span  class="help-inline ">Minimo 2 caracteres</span>                    
                </div>
            </div>
			
			<!--Bot�es do formul�rio -->
            <div class="form-actions">
                <button  id ="submit-natureza"  type="button" class="btn btn-primary">Salvar</button>
                <button  type="button" class="btn cancelar-natureza">Cancelar</button>
            </div>

        </fieldset>
        
        <div id="callback">
        </div>
    </form>
</div>

</body>

<?php
require_once '../template/scripts.php';
require_once 'scripts_natureza.php';

?>

</html>
