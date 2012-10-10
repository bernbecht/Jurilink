<?php
require_once '../config.php';     //chama as configurações de página!
require_once "../classes/CConexao.php";

$conexao = new CConexao();
$conexao1 = $conexao->novaConexao();
$tipo_usuario = $_SESSION['tipo_usuario'];



if ($_SESSION['tipo_usuario'] == 2)
    require_once '../template/header.php'; //chama o header
else
    include '../template/header_user.php'; //chama o header
    

$id_pessoa = $_SESSION['id_usuario'];

$query = "select * from pessoa inner join usuario on pessoa.id_pessoa = $id_pessoa and usuario.id_pessoa = $id_pessoa";
$result = pg_query($conexao1,$query);

$pessoa = pg_fetch_object($result);

$pesq_uf = pg_exec($conexao1, "select * from uf order by nome");
$resultado = pg_fetch_object($pesq_uf);

$pesq_uf_pessoa = pg_exec($conexao1, "SELECT uf.id_uf, uf.nome from uf, pessoa where pessoa.id_pessoa = $id_pessoa and uf.id_uf = pessoa.id_uf");
$uf_pessoa = pg_fetch_object($pesq_uf_pessoa);


?>


<div class="container content">
    <div class="row">        
        <div class="esquerda">
            <div class="header-pagina">            
                <h1><?php echo $pessoa->nome; ?></h1>
            </div>
        </div>
        

    </div>
     <div class="divisor_horizontal_view"></div>
     <div id="msg_resultado"></div>
    <br/>
    <form id="form_pessoa" class="form-horizontal editConta" method="post" action="../operacoes/CPessoa/editar_conta_op.php">
        <fieldset>
            <!--Campos formulário -->
            <div class="esquerda">
                <h1>Editar Conta</h1>
            </div>
            <div id="loading_content">  
                    
            </div>                
            

            <div id="msg_resultado"></div>
            
            <br/>
            
            <div class="row">
                <div class="span5" >                    
                    <div id="email" class="control-group">
                        <label class="control-label" for="email">E-mail</label>
                        <div class="controls">                        
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-envelope"></i></span><input class="input-large" id="email_input" name="email" type="text" value= "<?php echo $pessoa->email ?>">
                            </div>
                            <span class="help-inline"></span>
                        </div>
                    </div>  
                </div> 
                <div class="span5" >
                    <div id="telefone" class="control-group ">
                        <label class="control-label" for="telefone">Telefone</label>
                        <div class="controls">
                            <input type="text" class="input-small aviso" id="telefone_input" name="telefone" value= "<?php echo $pessoa->tel ?>">    
                            <span  class="help-inline ">Apenas digitos</span> 
                        </div>
                    </div>                       
                </div>
            </div>
                              
                
            <div class ="row">
                <div class="span5" >
                    <div id="endereco" class="control-group ">
                        <label class="control-label" for="endereco">Endereço</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="endereco_input" name="endereco" value= "<?php echo $pessoa->endereco ?>">    
                         </div>
                    </div>                       
                </div>
                <div class="span5" >
                    <div id="bairro" class="control-group ">
                        <label class="control-label" for="bairro">Bairro</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="bairro_input" name="bairro" value= "<?php echo $pessoa->bairro ?>">    
                         </div>
                    </div>                       
                </div>
            </div>
            
            <div class ="row">
                 <div class="span5" >
                    <div id="cidade" class="control-group ">
                        <label class="control-label" for="cidade">Cidade</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="cidade_input" name="cidade" value= "<?php echo $pessoa->cidade ?>">    
                         </div>
                    </div>                       
                </div> 
                <div class="span5" > 
                    <div id="estado" class="control-group">
                        <label class="control-label" for="Estado">Estado</label>
                        <div class="controls">                    
                            <select  name="estado" id="estado_input" class="input-small aviso">
                                <?php echo "<option value= $uf_pessoa->id_uf>$uf_pessoa->nome</option>"; ?>
                                <?php
                                if ($resultado->id_uf != NULL) {
                                    do {
                                        if ($resultado->id_uf != $uf_pessoa->id_uf)
                                            echo "<option value=$resultado->id_uf>$resultado->nome</option>";
                                    } while ($resultado = pg_fetch_object($pesq_uf));
                                }
                                ?>                     
                            </select>
                            <span  class="help-inline "></span>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" class="input-xlarge" id="id_pessoa_input" name="id_pessoa" value="<?php echo $id_pessoa?>" >                  
            <input type="hidden" class="input-xlarge" id="id_tipo_usuario_input" name="tipo_usuario" value="<?php echo $tipo_usuario?>" >                  
             

           <div class="form-actions">
                <button  id ="enviar"  type="button" class="btn btn-primary edit-conta" >Salvar</button>
                <?php
                    if ($_SESSION['tipo_usuario'] == 2){
                        echo "<a href='../../index.php'><button type='button' class='btn'>Cancelar</button></a>";
                        
                    }
                    else 
                        echo "<a href='view_user.php'><button type='button' class='btn'>Cancelar</button></a>";
                        
                ?>
                
            </div>
            


        </fieldset>

    </form> 
    <form id="form_senha" class="form-horizontal trocaSenha" method="post" action="../operacoes/CPessoa/editar_pessoa_rollback_op.php">
        <fieldset>
            
            <div class="divisor_horizontal_view"></div>
            <div class ="row">
                <div class="esquerda">
                        <h1>Trocar Senha</h1>
                </div>
            </div>
            <div class ="row">
                <div class="span5" >
                    <div id="senha_atual" class="control-group ">
                        <label class="control-label" for="senha_atual">Atual</label>
                        <div class="controls">
                            <input type="password" class="input-xlarge aviso" id="senha_input" name="senha_atual">    
                            <span  class="help-inline ">Insira senha atual</span> 
                        </div>
                    </div>                       
                </div>
                
            </div>
              <div class ="row">
                <div class="span5" >
                    <div id="nova_senha" class="control-group ">
                        <label class="control-label" for="nova_senha">Nova Senha</label>
                        <div class="controls">
                            <input type="password" class="input-xlarge aviso" id="senha_input" name="nova_senha">    
                            <span  class="help-inline ">Insira nova senha</span> 
                        </div>
                    </div>                       
                </div>
                <div class="span5" >
                    <div id="c_nova_senha" class="control-group ">
                        <label class="control-label" for="c_nova_senha">Confirme Nova Senha</label>
                        <div class="controls">
                            <input type="password" class="input-xlarge aviso" id="c_senha_input" name="c_nova_senha">    
                            <span  class="help-inline ">Confirme nova senha</span> 
                        </div>
                    </div>                       
                </div>
            </div>
             <input value="<?php $id_pessoa?>" type="hidden" class="input-xlarge" id="id_pessoa_input" name="id_pessoa">

            <!--Botões do formulário -->
            <div class="form-actions">
                <button  id ="enviar"  type="button" class="btn btn-primary troca-senha" >Salvar</button>
                <?php
                    if ($_SESSION['tipo_usuario'] == 2){
                        echo "<a href='../../index.php'><button type='button' class='btn'>Cancelar</button></a>";
                        
                    }
                    else 
                        echo "<a href='view_user.php'><button type='button' class='btn'>Cancelar</button></a>";
                        
                ?>


            </div>



        </fieldset>

    </form> 
    
</div>
</body>
</html>
<?php
    require_once '../template/scripts.php'; //chama scripts comuns as paginas
?>