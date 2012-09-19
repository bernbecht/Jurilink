<?php
require_once '../template/header.php'; //chama o header
require_once '../config.php';     //chama as configurações de página!


/* Lembrar de criar uma função que retorne o nome dos juízos e naturezas */
$pesq_uf = pg_exec($conexao1, "select * from uf order by nome");
$resultado = pg_fetch_object($pesq_uf);


$pesq_juizo = pg_exec($conexao1, "select * from juizo order by nome");
$resultado_juizo = pg_fetch_object($pesq_juizo);

$pesq_natureza = pg_exec($conexao1, "select * from natureza_acao order by nome");
$resultado_natureza = pg_fetch_object($pesq_natureza);
?>


<div class="container content">

    <form name ="form_processo" id="form_processo" class="form-horizontal" method="post" action="../operacoes/CProcesso/incluir_processo_op.php">
        <fieldset>

            <!--Campos formulário -->

            <legend><h1>Cadastrar Novo processo</h1></legend>

            <div id="msg_resultado_processo">
                <div class="alert alert-block fade in">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <p>Todos os itens com a tarja <b>amarela</b> são obrigatórios.</p></div>
            </div>


            <br/>

            <div class="row">                

                <div class="span5">
                    <!-- Campo numero unificado -->
                    <div id="numero_unificado" class="control-group">
                        <label class="control-label" for="numero_unificado">Número Unificado</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="numero_unificado_input" name="numero_unificado">                       
                            <span  class="help-inline ">Apenas dígitos</span>                    
                        </div>
                    </div>        
                </div>

                <div class="span5">
                    <!-- Campo data de distribuição -->
                    <div id="data_distribuicao" class="control-group">
                        <label class="control-label" for="data distribuicao">Data de Distribuição</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="data_dist_input" name="data_distribuicao">                       
                            <span  class="help-inline ">Digite no formato dd/dd/aaaa Ex: 12/10/2010</span>                    
                        </div>
                    </div>
                </div>             
            </div>

            <div class="row">
                <div class="span5">
                    <!-- Campo Juizo Combo -->
                    <div class="control-group" id="juizo-control">
                        <label class="control-label" for="juizo">Juízo</label>
                        <div class="controls">                    
                            <select  name="id_juizo" id="juizo" class="aviso">
                                <option value="-1">-</option>
                                <?php
                                if ($resultado_juizo->id_juizo != NULL) {
                                    do {
                                        echo "<option value=$resultado_juizo->id_juizo>$resultado_juizo->nome</option>";
                                    } while ($resultado_juizo = pg_fetch_object($pesq_juizo));
                                }
                                ?>                     
                            </select>
                            <span  class="help-inline "><i class="icon-search"></i></span>
                        </div>
                    </div>
                </div>

                <div class="span5">
                    <!-- Campo natureza COMBO -->
                    <div class="control-group" id="natureza-control">
                        <label class="control-label" for="natureza">Natureza da Ação</label>
                        <div class="controls">                    
                            <select name="id_natureza" id="natureza" class="aviso">
                                <option  value="-1" >-</option>
                                <?php
                                if ($resultado_natureza->id_natureza_acao != NULL) {
                                    do {
                                        echo "<option value=$resultado_natureza->id_natureza_acao>$resultado_natureza->nome</option>";
                                    } while ($resultado_natureza = pg_fetch_object($pesq_natureza));
                                }
                                ?>                           
                            </select>
                            <span  class="help-inline "><i class="icon-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="span5">
                    <!-- Campo valor da causa -->
                    <div id="valor_causa"class="control-group ">
                        <label class="control-label" for="valor_causa">Valor da Causa</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="valor_causa_input" name="valor_causa">     
                            <span  class="help-inline ">O valor deve ter vírgula Ex: 1200,00</span> 
                        </div>
                    </div>      
                </div>
            </div>

            <div class="divisor_horizontal"></div>

            <div class="row">
                <div id="msg_resultado_dica">
                    <div class="alert alert-info fade in">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <p><b>Dica:</b> Você pode adicionar mais de uma pessoa por campo. Basta adicionar uma vírgula após o nome. Ex: João<b>,</b>Maria
                        </p>
                    </div>
                </div>  
            </div>


            <div class="row">
                <div class="span5">
                    <!-- Campo autor -->
                    <div id="autor"class="control-group ">
                        <label class="control-label" for="autor">Autor</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="autor_input" name="autor"/>     
                            <span class="help-inline "><a rel="tooltip" data-placement="top" data-original-title="Adicionar um Autor não cadastrado" class="pessoa-modal tooltip_class" data-toggle="modal" href="#myModal"><i id="autor-modal" class="icon-plus"></i></a></span> 
                            <div id="autocompleteAutor" class="autocompleteBox"></div>
                        </div>                 
                    </div>   
                </div>
                
               
                <div class="span5">
                    <!-- Campo advogado autor -->
                    <div id="autor_advogado"class="control-group ">
                        <label class="control-label" for="ad1">Advogado do Autor</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="autor_ad_input" name="autor_advogado"/>     
                            <span class="help-inline "><a rel="tooltip" data-placement="top" data-original-title="Adicionar um Advogado não cadastrado" class="pessoa-modal tooltip_class" data-toggle="modal" href="#myModal"><i id="autor-modal" class="icon-plus"></i></a></span> 
                            <div id="autocompleteAdvogado1" class="autocompleteBox"></div>
                        </div>                 
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="span5">
                    <!-- Campo representante autor -->
                    <div id="autor_rep"class="control-group ">
                        <label class="control-label" for="autor">Representante Autor</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="autor_rep_input" name="autor_rep"/>     
                            <span class="help-inline "><a rel="tooltip" data-placement="top" data-original-title="Adicionar um Representante não cadastrado" class="pessoa-modal tooltip_class" data-toggle="modal" href="#myModal"><i id="autor-modal" class="icon-plus"></i></a></span> 
                            <div id="autocompleteAutorRep1" class="autocompleteBox"></div>
                        </div>                 
                    </div>  
                </div>
            </div>

            <div class="divisor_horizontal"></div>


            <div class="row">
                <div class="span5">
                    <!-- Campo Reu -->
                    <div id="reu"class="control-group ">
                        <label class="control-label" for="reu">Réu</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="reu_input" name="reu"/>     
                           <span class="help-inline "><a rel="tooltip" data-placement="top" data-original-title="Adicionar um Réu não cadastrado" class="pessoa-modal tooltip_class" data-toggle="modal" href="#myModal"><i id="autor-modal" class="icon-plus"></i></a></span> 
                            <div id="autocompleteReu" class="autocompleteBox"></div>
                        </div>                 
                    </div>
                </div>

                <div class="span5">
                    <!-- Campo advogado Réu -->
                    <div id="reu_advogado"class="control-group ">
                        <label class="control-label" for="ad2">Advogado do Réu</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="reu_ad_input" name="reu_advogado"/>     
                            <span class="help-inline "><a rel="tooltip" data-placement="top" data-original-title="Adicionar um Advogado não cadastrado" class="pessoa-modal tooltip_class" data-toggle="modal" href="#myModal"><i id="autor-modal" class="icon-plus"></i></a></span> 
                            <div id="autocompleteAdvogado2" class="autocompleteBox"></div>
                        </div>                 
                    </div>  
                </div>

            </div>


            <div class="row">
                <div class="span5">
                    <!-- Campo representante reu -->
                    <div id="reu_rep"class="control-group ">
                        <label class="control-label" for="autor">Representante Réu</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="reu_rep_input" name="reu_rep"/>     
                            <span class="help-inline "><a rel="tooltip" data-placement="top" data-original-title="Adicionar um Representante não cadastrado" class="pessoa-modal tooltip_class" data-toggle="modal" href="#myModal"><i id="autor-modal" class="icon-plus"></i></a></span> 
                            <div id="autocompleteAutorRep2" class="autocompleteBox"></div>
                        </div>                 
                    </div>  
                </div>              
            </div>

            <div class="divisor_horizontal"></div>


            <div class="row">
                <div class="span5">
                    <!-- Campo transito em julgado -->
                    <div id="transito_em_julgado" class="control-group">
                        <label class="control-label" for="Transito em Julgado">Trânsito em Julgado</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="tej_input" name="transito_em_julgado">                       
                            <span  class="help-inline ">Digite no formato dd/dd/aaaa Ex: 12/10/2010</span>                    
                        </div>
                    </div>
                </div>

                <div class="span5">
                    <!-- Campo deposito -->
                    <div id="deposito_judicial" class="control-group">
                        <label class="control-label" for="deposito judicial">Depósito Judicial</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="deposito_judicial_input" name="deposito_judicial">                       
                            <span  class="help-inline ">O valor deve ter vírgula Ex: 1200,00</span>                    
                        </div>
                    </div>   
                </div>
            </div>


            <div class="row">
                <div class="span5">
                    <!-- Campo auto da penhora -->
                    <div id="auto_penhora" class="control-group">
                        <label class="control-label" for="auto_penhora">Auto da Penhora</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <input type="text" class="input-large" id="auto_penhora_input" name="auto_penhora" />                       
                                <span  class="help-inline ">O valor deve ter vírgula Ex: 1200,00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--    Teste de BOX
            <div id="senha" class="control-group ">
                <label class="control-label" for="telefone">Senha</label>
                <div class="controls">
                    <div class="box"><span>Ber</span><span>André</span></div>    
                    <span  class="help-inline ">*</span> 
                </div>
            </div>
            
            -->

            <!-- Campo que dirá qual das pessoas (AUTOR, REU...) foi clicado -->
            <input type="hidden" class="input-xlarge" id="campo-modal" name="campo-modal">                       

            <!--Botões do formulário -->
            <div class="form-actions">
                <button  type="button" id="submit-processo"class="btn btn-primary">Salvar</button>
                <button  type="button" id="submit-outro-processo"class="btn btn-primary">Salvar e Adicionar Outro</button>
                <button  type="button" class="btn cancelar-processo">Cancelar</button>
            </div>
        </fieldset>
    </form>

</div> <!-- container -->


<!-- MODAL para CADASTRO DE PESSOA-->
<div id="myModal" class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">x</button>
        <h3>Cadastrar Pessoa</h3>
    </div>
    <div class="modal-body">
        <form id="form_pessoa" class="form-horizontal pessoaAjaxForm" method="post" action="../operacoes/CPessoa/incluir_pessoa_rollback_op.php">
            <fieldset>
                <!--Campos formulário --> 

                <div id="msg_resultado"></div>
                <div id="" class="control-group ">
                    <label class="control-label" for="tipo">Tipo</label>
                    <div class="controls">
                        <button type="button" class="btn btn-primary disabled" id="fisica">Física</button>
                        <button type="button" class="btn btn-primary" id="juridica">Jurídica</button>
                        <button type="button" class="btn btn-primary" id="advogado">Advogado</button>
                    </div>
                </div>

                <div id="nome" class="control-group">
                    <label class="control-label" for="Nome">Nome</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="nome_input" name="nome">                       
                        <span  class="help-inline "></span>                    
                    </div>
                </div>

                <div id="cnpj" class="control-group">
                    <label class="control-label" for="cnpj">CNPJ</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="cnpj_input" name="cnpj">                       
                        <span  class="help-inline ">Use apenas dígitos</span>                    
                    </div>
                </div>

                <div id="cpf" class="control-group">
                    <label class="control-label" for="cpf">CPF</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="cpf_input" name="cpf">                       
                        <span  class="help-inline ">Use apenas dígitos</span>                    
                    </div>
                </div>

                <div id="rg" class="control-group">
                    <label class="control-label" for="rg">RG</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="rg_input" name="rg">                       
                        <span  class="help-inline ">Use apenas dígitos</span>                    
                    </div>
                </div>

                <div id="comarca" class="control-group">
                    <label class="control-label" for="rg">Orgao Expedidor</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="comarca_input" name="comarca">                       
                        <span  class="help-inline ">Minimo 2 caracteres</span>                    
                    </div>
                </div>
                <div id="oab" class="control-group">
                    <label class="control-label" for="oab">OAB</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="oab_input" name="oab">                       
                        <span  class="help-inline ">Mínimo 4 dígitos</span>                    
                    </div>
                </div>

                <div id="endereco"class="control-group ">
                    <label class="control-label" for="endereco">Endereço</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="endereco_input" name="endereco">     
                        <span  class="help-inline "></span> 
                    </div>
                </div>

                <div id="bairro"class="control-group ">
                    <label class="control-label" for="bairro">Bairro</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="bairro_input" name="bairro">     
                        <span  class="help-inline "></span> 
                    </div>
                </div>

                <div id="cidade" class="control-group ">
                    <label class="control-label" for="cidade">Cidade</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="cidade_input" name="cidade">       
                        <span  class="help-inline "></span> 
                    </div>
                </div>

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

                <div id="telefone" class="control-group ">
                    <label class="control-label" for="telefone">Telefone</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="telefone_input" name="telefone">    
                        <span  class="help-inline ">Use apenas dígitos</span> 
                    </div>
                </div>

                <div id="email" class="control-group ">
                    <label class="control-label" for="email">E-mail</label>
                    <div class="controls">                        
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span><input class="input-large" id="email_input" name="email" type="text">
                        </div>
                        <span class="help-inline"></span>
                    </div>
                </div>                 

                <div id="user" class="control-group">
                    <label class="control-label" for="userCheckbox">User</label>
                    <div class="controls">
                        <label class="checkbox">
                            <input type="checkbox" name="userCheckbox" id="userCheckbox" value="1">
                            A pessoa cadastrada terá acesso ao sistema
                        </label>
                    </div>                    
                </div>

                <div id="senha" class="control-group ">
                    <label class="control-label" for="telefone">Senha</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="senha_input" name="senha">    
                        <span  class="help-inline ">Mínimo de 7 dígitos alfanumericos</span> 
                    </div>
                </div>   

                <input type="hidden" class="input-xlarge" id="tipo_input" name="tipo">    

                </div>
            </fieldset>
        </form> 

        <div class="modal-footer"> 
            <a href="#" class="btn cancelar-modal" data-dismiss="modal">Close</a>
            <button  id ="enviar"  type="button" class="btn btn-primary submit-pessoa-modal">Salvar</button>
        </div>
    </div>






    <?php
    require_once '../template/scripts.php'; //chama scripts comuns as paginas
    require_once 'script_cadastrar_processo.php'; //chama o script da página
    ?>


