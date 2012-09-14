<?php
require_once '../template/header.php'; //chama o header
require_once ( '../config.php');     //chama as configurações de página!

//GET para ID da pessoa
if(isset($_GET['id'])) $id_pessoa = $_GET['id'];

$pesq_uf = pg_exec($conexao1, "select * from uf order by nome");
$resultado = pg_fetch_object($pesq_uf);

$pesq_uf_pessoa = pg_exec($conexao1, "SELECT uf.id_uf, uf.nome from uf, pessoa where pessoa.id_pessoa = $id_pessoa and uf.id_uf = pessoa.id_uf");
$uf_pessoa = pg_fetch_object($pesq_uf_pessoa);

$pesq_pessoa = pg_exec($conexao1, "SELECT * from pessoa, fisica, advogado where pessoa.id_pessoa = $id_pessoa and pessoa.id_pessoa = fisica.id_pessoa and advogado.id_pessoa = pessoa.id_pessoa");
$pessoa = pg_fetch_object($pesq_pessoa);

$pesq_user = pg_exec($conexao1, "select count (*) from usuario where usuario.id_pessoa = $id_pessoa");
$e_user = pg_fetch_object($pesq_user);
?>

<div class="container content">   


    <form id="form_pessoa" class="form-horizontal pessoaAjaxForm" method="post" action="../operacoes/CPessoa/editar_pessoa_rollback_op.php">
        <fieldset>
            <!--Campos formulário -->

            <legend>
                <div class="esquerda">
                    <h1>CEditar Advogado</h1>
                </div>
                <div id="loading_content">  
                    
                </div>                
            </legend> 
            
            <div id="msg_resultado"></div>
            <br/>
            <div class="controls">
                <input type="hidden" class="input-xlarge aviso" id="id_input" name="id_pessoa" value= "<?php echo $id_pessoa ?>">
            </div>
            <div class="row">
                <div class="span5" >
                    <div id="nome" class="control-group">
                        <label class="control-label" for="Nome">Nome</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="nome_input" name="nome" value= "<?php echo $pessoa->nome ?>">                       
                            <span  class="help-inline "></span>                    
                        </div>
                    </div>
                </div>

                <div class="divisor_maior"></div>

                <div class="span5" >
                    <div id="cpf" class="control-group">
                        <label class="control-label" for="cpf">CPF</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="cpf_input" name="cpf" value= "<?php echo $pessoa->cpf ?>">                       
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
                            <input type="text" class="input-xlarge aviso" id="rg_input" name="rg" value= "<?php echo $pessoa->rg ?>">                       
                            <span  class="help-inline ">Apenas digitos</span>                    
                        </div>
                    </div>
                </div>

                <div class="divisor_maior"></div>

                <div class="span5" >
                    <div id="comarca" class="control-group">
                        <label class="control-label" for="rg">Orgao Expedidor</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="comarca_input" name="comarca" value= "<?php echo $pessoa->orgao_expedidor ?>">                       
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
                            <input type="text" class="input-xlarge aviso" id="oab_input" name="oab" value= "<?php echo $pessoa->oab ?>">                       
                            <span  class="help-inline ">Minimo 4 digitos</span>                    
                        </div>
                    </div>                                 
                </div>

                <div class="divisor_maior"></div>

                <div class="span5" >
                    <div id="endereco"class="control-group">
                        <label class="control-label" for="endereco">Endereco</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="endereco_input" name="endereco" value= "<?php echo $pessoa->endereco ?>">     
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
                            <input type="text" class="input-xlarge aviso" id="bairro_input" name="bairro" value= "<?php echo $pessoa->bairro ?>">     
                            <span  class="help-inline "></span> 
                        </div>
                    </div>                    
                </div>

                <div class="divisor_maior"></div>

                <div class="span5" >
                    <div id="cidade" class="control-group">
                        <label class="control-label" for="cidade">Cidade</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="cidade_input" name="cidade" value= "<?php echo $pessoa->cidade ?>">       
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
                                <?php echo "<option value= $uf_pessoa->id_uf>$uf_pessoa->nome</option>";?>
                                <?php
                                if ($resultado->id_uf != NULL) {
                                    do {
                                        if ($resultado->id_uf!=$uf_pessoa->id_uf)
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
                            <input type="text" class="input-xlarge aviso" id="telefone_input" name="telefone" value= "<?php echo $pessoa->tel ?>">    
                            <span  class="help-inline ">Apenas digitos</span> 
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="span5">
                    <div id="email" class="control-group">
                        <label class="control-label" for="email">Email</label>
                        <div class="controls">                        
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-envelope"></i></span><input class="input-large" id="email_input" name="email" type="text" value= "<?php echo $pessoa->email ?>" />
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
                                <?php
                                    if ($e_user->count)
                                        echo "<input type='hidden' name='box1' value='0' />
                                            <input type='checkbox' name='userCheckbox' id='userCheckbox' value='1' CHECKED>";
                                    else echo "<input type='hidden' name='userCheckbox' value='0' />
                                        <input type='checkbox' name='userCheckbox' id='userCheckbox' value='1'>";
                                  ?>
                                A pessoa cadastrada tera acesso ao sistema
                            </label>
                        </div>                    
                    </div>
                </div>
            </div>             


            <input value="2" type="hidden" class="input-xlarge" id="tipo_input" name="tipo">  

            <!--Botões do formulário -->
            <div class="form-actions">
                <button  id ="enviar"  type="button" class="btn btn-primary edit-pessoa">Salvar</button>
                <a href="view_advogado.php?id=<?php echo $id_pessoa ?>"><button  type="button" class="btn">Cancelar</button></a>
            </div>

            

        </fieldset>

    </form> 

</div> <!-- container -->

<input id="id" type="hidden" value="<?php echo $id_pessoa ?>"/>
</body>


<?php
require_once '../template/scripts.php';
require_once 'scripts_cadastrar_pessoa.php';
?>
</html>