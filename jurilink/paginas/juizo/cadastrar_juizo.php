<?php
require_once '../template/header.php'; //chama o header
require_once ( '../config.php');     //chama as configura��es de p�gina!
require_once "../classes/CConexao.php";

$conexao = new CConexao();
$conexao1 = $conexao->novaConexao();


$pesq = pg_query($conexao1, "SELECT id_comarca, nome FROM comarca");
$result = pg_fetch_object($pesq);


if (!$result) {
    echo "Um erro ocorreu.\n";
    exit;
}
?>


<div class="container content">
    <form name = "form_juizo" form id="form_juizo" class="form-horizontal" method="post" action="../operacoes/CJuizo/incluir_juizo_op.php">
        <fieldset>
            <!--Campos formul�rio -->

            <legend><h1>Cadastrar Novo Juízo</h1></legend>
            
            <div id="msg_resultado">
               
            </div>   

            <div id="nome" class="control-group">
                <label class="control-label" for="Nome">Nome</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="nome_input" name="nome">                       
                    <span  class="help-inline ">Minimo 2 caracteres</span>                    
                </div>
            </div>
           <div id="comarca" class="control-group">
                <label class="control-label" for="comarca">Comarca</label>
                <div class="controls">                    
                    <select  name="id_comarca" id="comarca_option">
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
                <button  id ="submit-juizo"  type="button" class="btn btn-primary">Salvar</button>
                <button  type="button" class="btn cancelar-juizo">Cancelar</button>
            </div>

        </fieldset>

        <div id="callback">
        </div>
    </form>
</div>

<?php
require_once '../template/help/help_cadastrar_juizo.php';
?>

</body>

<?php
require_once '../template/scripts.php';
require_once 'scripts_juizo.php';
?>

</html>