<?php
require_once '../template/header.php'; //chama o header
require_once ( '../config.php');     //chama as configura��es de p�gina!
?>

<!------ Conex�o com o BD e busca comarcas para inser��o do Ju�zo na respectiva -->
<?php

$pesq = pg_query($conexao1, "SELECT id_comarca, nome FROM comarca");
$result = pg_fetch_object($pesq);


if (!$result) {
    echo "Um erro ocorreu.\n";
    exit;
}
?>


<div class="container content">
    <form name = "formulario_juizo" form id="form_juizo" class="form-horizontal" method="post" action="../operacoes/CJuizo/incluir_juizo_op.php">
        <fieldset>
            <!--Campos formul�rio -->

            <legend>Cadastrar novo Juizo</legend>

            <div id="nome" class="control-group">
                <label class="control-label" for="Nome">Nome</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="nome_input" name="nome">                       
                    <span  class="help-inline "></span>                    
                </div>
            </div>
           <div class="control-group">
                <label class="control-label" for="comarca">Comarca</label>
                <div class="controls">                    
                    <select  name="id_comarca" id="juizo">
                        <option value="-1">-</option>
                        <?php
                        if ($result->id_comarca != NULL) {
                            do {
                                echo "<option value=$result->id_comarca>$result->nome</option>";
                            } while ($result = pg_fetch_object($pesq));
                        }
                        ?>                     
                    </select>
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
