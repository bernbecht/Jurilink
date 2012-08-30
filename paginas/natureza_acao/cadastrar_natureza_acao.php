<?php
require_once '../template/header.php'; //chama o header
require_once ( '../config.php');     //chama as configura��es de p�gina!
?>

<div class="container content">
    <form name = "formulario_natureza_acao " form id="form_nat_acao" class="form-horizontal" method="post" action="../operacoes/CNatureza_acao/incluir_natureza_acao_op.php">
        <fieldset>

            <!--Campos formul�rio -->

            <legend>Cadastrar nova natureza</legend>

            <div id="nome" class="control-group">
                <label class="control-label" for="Nome">Nome</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="nome_input" name="nome">                       
                    <span  class="help-inline "></span>                    
                </div>
            </div>
			
			<!--Bot�es do formul�rio -->
            <div class="form-actions">
                <button  id ="enviar"  type="submit" class="btn btn-primary">Salvar</button>
                <button  type="button" class="btn">Cancelar</button>
            </div>

        </fieldset>
        
        <div id="callback">
        </div>
    </form>
</div>

<?php
require_once '../template/scripts.php';

?>
