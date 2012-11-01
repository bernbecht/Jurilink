<?php //
require_once '../template/header.php'; //chama o header
require_once ( '../config.php');     //chama as configurações de página!
?>

<div class="container content">
    <form id="form_comarca" class="form-horizontal" method="post" action="../operacoes/CComarca/incluir_comarca_op.php">
        <fieldset>

            <!--Campos formul�rio -->

            <legend><h1>Cadastrar Nova Comarca</h1></legend>
            <div id="msg_resultado_processo">
               
            </div>  
            <br/>
            <div id="nome" class="control-group">
                <label class="control-label" for="Nome">Nome</label>
                <div class="controls">
                    <input type="text" class="input-xlarge aviso" id="nome_input" name="nome">                       
                    <span  class="help-inline ">Minimo 2 caracteres</span>                    
                </div>
            </div>

            <!--Bot�es do formul�rio -->
            <div class="form-actions">
                <button  id ="submit-comarca"  type="button" class="btn btn-primary">Salvar</button>
                <button  type="button" class="btn cancelar-comarca">Cancelar</button>
            </div>

        </fieldset>
        
        <div id="callback">
        </div>
    </form>
</div>
</html>

<?php
require_once '../template/scripts.php';
require_once 'scripts_comarca.php';
//require_once 'scripts_cadastrar_pessoa.php';
?>
</body>