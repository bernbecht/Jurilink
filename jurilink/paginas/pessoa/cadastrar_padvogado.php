<?php
require_once '../config.php';     //chama as configurações de página!

if ($_SESSION['tipo_usuario'] == 2)
    require_once '../template/header.php'; //chama o header
else {
		include '../template/header_user.php'; //chama o header
		exit;
	}

require_once "../classes/CConexao.php";

$conexao = new CConexao();
$conexao1 = $conexao->novaConexao();



$pesq_uf = pg_exec($conexao1, "select * from uf order by nome");
$resultado = pg_fetch_object($pesq_uf);
?>

<div class="container content">   


    <form id="form_pessoa" class="form-horizontal pessoaAjaxForm" method="post" action="../operacoes/CPessoa/incluir_pessoa_rollback_op.php">
        <fieldset>
            <!--Campos formulário -->

           <legend>
                <div class="esquerda">
                    <h1>Cadastrar Novo Advogado</h1>
                </div>
                <div id="loading_content">  
                    
                </div>                
            </legend> 
            
            <div id="msg_resultado"></div>

            <div class="row">
                <div class="span5" >
                    <div id="nome" class="control-group">
                        <label class="control-label" for="Nome">Nome</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="nome_input" name="nome">                       
                            <span  class="help-inline "></span>                    
                        </div>
                    </div>
                </div>

                <div class="divisor_maior"></div>

                <div class="span5" >
                    <div id="cpf" class="control-group">
                        <label class="control-label" for="cpf">CPF</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="cpf_input" name="cpf">                       
                            <span  class="help-inline ">Apenas digitos</span>                    
                        </div>
                    </div>                   
                </div>
            </div>

            <div class="row">
                <div class="span5" >
                    <div id="rg" class="control-group">
                        <label class="control-label" for="rg">RG</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="rg_input" name="rg">                       
                            <span  class="help-inline ">Apenas digitos</span>                    
                        </div>
                    </div>
                </div>

                <div class="divisor_maior"></div>

                <div class="span5" >
                    <div id="comarca" class="control-group">
                        <label class="control-label" for="rg">Órgão Expedidor</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="comarca_input" name="comarca">                       
                            <span  class="help-inline ">Minimo 2 caracteres</span>                    
                        </div>
                    </div>                
                </div>
            </div>

            <div class="row">
                <div class="span5" >                    
                    <div id="oab" class="control-group">
                        <label class="control-label" for="oab">OAB</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="oab_input" name="oab">                       
                            <span  class="help-inline ">Minimo 4 digitos</span>                    
                        </div>
                    </div>                                 
                </div>

                <div class="divisor_maior"></div>

                <div class="span5" >
                    <div id="endereco"class="control-group">
                        <label class="control-label" for="endereco">Endereço</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="endereco_input" name="endereco">     
                            <span  class="help-inline "></span> 
                        </div>
                    </div>                    
                </div>
            </div>


            <div class="row">
                <div class="span5" >
                    <div id="bairro"class="control-group">
                        <label class="control-label" for="bairro">Bairro</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="bairro_input" name="bairro">     
                            <span  class="help-inline "></span> 
                        </div>
                    </div>                    
                </div>

                <div class="divisor_maior"></div>

                <div class="span5" >
                    <div id="cidade" class="control-group">
                        <label class="control-label" for="cidade">Cidade</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="cidade_input" name="cidade">       
                            <span  class="help-inline "></span> 
                        </div>
                    </div>               
                </div>
            </div>


            <div class="row">
                <div class="span5" >
                    <div id="estado" class="control-group">
                        <label class="control-label" for="Estado">Estado</label>
                        <div class="controls">                    
                            <select  name="estado" id="estado_input" class="aviso">
                                <option value="-1">-</option>
                                <?php
                                if ($resultado->id_uf != NULL) {
                                    do {
                                        echo "<option value=$resultado->id_uf>$resultado->nome</option>";
                                    } while ($resultado = pg_fetch_object($pesq_uf));
                                }
                                ?>                     
                            </select>
                            <span  class="help-inline "></span>
                        </div>
                    </div>                        
                </div>

                <div class="divisor"></div>

                <div class="span5" >                    
                    <div id="telefone" class="control-group ">
                        <label class="control-label" for="telefone">Telefone</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="telefone_input" name="telefone">    
                            <span  class="help-inline ">Apenas digitos</span> 
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="span5">
                    <div id="email" class="control-group">
                        <label class="control-label" for="email">E-mail</label>
                        <div class="controls">                        
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-envelope"></i></span><input class="input-large" id="email_input" name="email" type="text" />
                                <span class="help-inline"></span>
                            </div>                            
                        </div>
                    </div>                         
                </div>
            </div>


            <div class="row">
                <div class="span5" >
                    <div id="user" class="control-group">
                        <label class="control-label" for="userCheckbox">User</label>
                        <div class="controls">
                            <label class="checkbox">
                                <input type="checkbox" name="userCheckbox" id="userCheckbox" value="1">
                                A pessoa cadastrada terá acesso ao sistema
                            </label>
                        </div>                    
                    </div>
                </div>
            </div> 

            


            <input value="2" type="hidden" class="input-xlarge" id="tipo_input" name="tipo">  

            <!--Botões do formulário -->
            <div class="form-actions">
                <button  id ="enviar"  type="button" class="btn btn-primary submit-pessoa">Salvar</button>
                <button  id ="enviar"  type="button" class="btn btn-primary submit-outra-pessoa">Salvar e Adicionar Outro</button>
                <button  type="button" class="btn cancelar">Cancelar</button>
            </div>

            

        </fieldset>

    </form> 

</div> <!-- container -->

<?php
require_once '../template/scripts.php';
require_once 'scripts_cadastrar_pessoa.php';
?>
