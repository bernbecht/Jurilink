<?php
require_once '../template/header.php'; //chama o header
require_once ( '../config.php');     //chama as configurações de página!
?>

<div class="container">
    <form id="form_pessoa" class="form-horizontal" method="post" action="../operacoes/CPessoa/excluir_pessoa_op.php">
        <fieldset>

            <!--Campos formulário -->

            <legend>Excluir nova pessoa</legend>

            <div id="id" class="control-group">
                <label class="control-label" for="id">id</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="id_input" name="id_excluir">                       
                    <span  class="help-inline ">*</span>                    
                </div>
            </div>

            
            <!--Botões do formulário -->
            <div class="form-actions">
                <button  id ="enviar"  type="submit" class="btn btn-primary">Salvar</button>
                <button  type="button" class="btn">Cancelar</button>
            </div>

        </fieldset>
</form>
</div>



<?php
require_once '../template/scripts.php';

?>