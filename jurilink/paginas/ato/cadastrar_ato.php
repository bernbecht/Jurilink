<?php
//
require_once '../template/header.php'; //chama o header
require_once ( '../config.php');     //chama as configurações de página!
?>

<div class="container content">
    <form id="form_ato" class="form-horizontal" method="post" action="../operacoes/CAto/incluir_ato_op.php">
        <fieldset>

            <!--Campos formulário -->

            <legend><h1>Cadastrar Novo Ato</h1></legend>

            <div id="msg_resultado_processo">

            </div>   

            <div id="nome" class="control-group">
                <label class="control-label" for="Nome">Nome</label>
                <div class="controls">
                    <input type="text" class="input-xlarge aviso" id="nome_input" name="nome">                       
                    <span  class="help-inline ">Mínimo 2 caracteres</span>                    
                </div>
            </div>
            <div id="previsao" class="control-group">
                <label class="control-label" for="Previsao">Previsão</label>
                <div class="controls">
                    <input type="text" class="input-xlarge aviso" id="previsao_input" name="previsao" placeholder="Ex: 10">                       
                    <span  class="help-inline ">Número de dias</span>                    
                </div>
            </div>
            <div id="descricao" class="control-group">
                <label class="control-label" for="Descricao">Descricao</label>
                <div class="controls">
                    <textarea class ="textArea-xlarge aviso" rows="4"  id="descricao_input" name="descricao"></textarea>
                   <!-- <input type="text" class="input-xlarge" id="descricao_input" name="descricao">  -->                     
                    <span  class="help-inline ">Mínimo 2 caracteres</span>                    
                </div>
            </div>
            <div id="flag_user" class="control-group">
                <label class="control-label" for="userCheckbox">User</label>
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" name="flag_userCheckbox" id="flag_userCheckbox" value="1">
                        O ato sera mostrado ao cliente
                    </label>
                </div>                    
            </div>

            <!--Bot�es do formul�rio -->
            <div class="form-actions">
                <button  id ="submit-ato"  type="button" class="btn btn-primary">Salvar</button>
                <button  type="button" class="btn cancelar-ato">Cancelar</button>
            </div>

        </fieldset>

        <div id="callback">
        </div>
    </form>
</div>

<?php
require_once '../template/help/help_cadastrar_ato.php';
?>

</body>
<?php
require_once '../template/scripts.php';
require_once 'scripts_ato.php';
?>

</html>