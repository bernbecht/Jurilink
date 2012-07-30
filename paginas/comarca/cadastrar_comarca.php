<?php //
require_once '../template/header.php'; //chama o header
require_once ( '../config.php');     //chama as configurações de página!
?>

<div class="container">
    <form id="form_pessoa" class="form-horizontal" method="post" action="../operacoes/CComarca/incluir_comarca_op.php">
        <fieldset>

            <!--Campos formul�rio -->

            <legend>Cadastrar nova comarca</legend>

            <div id="nome" class="control-group">
                <label class="control-label" for="Nome">Nome</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="nome_input" name="nome">                       
                    <span  class="help-inline ">*</span>                    
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
//require_once 'scripts_cadastrar_pessoa.php';
?>
