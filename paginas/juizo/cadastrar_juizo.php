<?php
require_once '../template/header.php'; //chama o header
require_once ( '../config.php');     //chama as configura��es de p�gina!
?>

<!------ Conex�o com o BD e busca comarcas para inser��o do Ju�zo na respectiva -->
<?php
$conexao1 = new CConexao();
$conexao = $conexao1->novaConexao();
$result = pg_query($conexao, "SELECT id_comarca, nome FROM comarca");

if (!$result) {
    echo "Um erro ocorreu.\n";
    exit;
}
?>


<div class="container">
    <form name = "formulario_juizo" form id="form_juizo" class="form-horizontal" method="post" action="../operacoes/CJuizo/incluir_juizo_op.php">
        <fieldset>

            <!--Campos formul�rio -->

            <legend>Cadastrar novo Juizo</legend>

            <div id="nome" class="control-group">
                <label class="control-label" for="Nome">Nome</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="nome_input" name="nome">                       
                    <span  class="help-inline ">*</span>                    
                </div>
            </div>
            <div class="span6 drop">
                <div class="drag">
                    <div class="barra-titulo">
                        <div class="esquerda">
                            <h3>
                                Comarcas
                            </h3>
                        </div>
                        <div class="direita">
                            <a class="btn btn-small btn-success" href="#">
                                <i class="icon-plus icon-white"></i>

                            </a>
                        </div>
                    </div>
                    <div class="tabela"> 
                        <?php
                        echo "<table = 'teste' class=table table-striped table-condensed >";
                        echo "<thead>";
                        echo "<tr><th>ID</th><th>Nome</th></tr></thead>";
                        echo "<tbody>";
                        while ($row = pg_fetch_row($result)) {
                            echo "<tr>	
                                <td>" . $row[0] . "</td>
                                <td>" . $row[1] . "</td>
                               <a class=btn btn-small btn-success href='#' onClick='getId2($row[0])'>
												
                               <td><i class=icon-ok icon-white></i>
                              </a>
		</td>
	</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        ?>
                    </div>
                </div>
            </div>

            <div id="id_comarca" class="control-group">
                <label class="control-label" for="IDComarca">ID Comarca</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="id_comarca_input" name="idcomarca">                       
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
?>
