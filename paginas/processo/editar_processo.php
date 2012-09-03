<?php
require_once '../template/header.php'; //chama o header
require_once '../config.php';     //chama as configurações de página!

//GET para ID de processo
if(isset($_GET['id'])) $id_processo = $_GET['id'];

/* Lembrar de criar uma função que retorne o nome dos juízos e naturezas */
$pesq_uf = pg_exec($conexao1, "select * from uf order by nome");
$resultado = pg_fetch_object($pesq_uf);

$pesq_juizo = pg_exec($conexao1, "select * from juizo order by nome");
$resultado_juizo = pg_fetch_object($pesq_juizo);

$pesq_natureza = pg_exec($conexao1, "select * from natureza_acao order by nome");
$resultado_natureza = pg_fetch_object($pesq_natureza);

/*Pesquisa número de representantes de autor e réu*/
$pesq_qtde_rep_autores = pg_exec($conexao1,"SELECT count(*) from autor where autor.id_processo = $id_processo and autor.flag_papel = 2");
$qtde_rep_autores = pg_fetch_object($pesq_qtde_rep_autores);

$pesq_qtde_rep_reus = pg_exec($conexao1,"SELECT count(*) from reu where reu.id_processo = $id_processo and reu.flag_papel = 2");
$qtde_rep_reus = pg_fetch_object($pesq_qtde_rep_reus);

$n_rep_autores = $qtde_rep_autores->count;
$n_rep_reus = $qtde_rep_reus->count;

/*Pesquisa representantes de autor e réu*/
$pesq_rep_autor = pg_exec($conexao1,"SELECT pessoa.nome from autor, pessoa where autor.id_processo = $id_processo and autor.flag_papel = 2 and pessoa.id_pessoa = autor.id_pessoa");
$rep_autor = pg_fetch_object($pesq_rep_autor);

$pesq_rep_reu = pg_exec($conexao1,"SELECT pessoa.nome from reu, pessoa where reu.id_processo = $id_processo and reu.flag_papel = 2 and pessoa.id_pessoa = reu.id_pessoa");
$rep_reu = pg_fetch_object($pesq_rep_reu);

/*Pesquisa se há mais de um autor e réu*/
$pesq_qtde_autores = pg_exec($conexao1,"SELECT count(*) from autor where autor.id_processo = $id_processo and autor.flag_papel = 0");
$qtde_autores = pg_fetch_object($pesq_qtde_autores);

$pesq_qtde_reus = pg_exec($conexao1,"SELECT count(*) from reu where reu.id_processo = $id_processo and reu.flag_papel = 0");
$qtde_reus = pg_fetch_object($pesq_qtde_reus);

$n_autores = $qtde_autores->count;
$n_reus = $qtde_reus->count;

/*Pesquisa autor(es) e reu(s)*/
$pesq_autor = pg_query($conexao1, "SELECT pessoa.nome from autor, pessoa where autor.id_processo = $id_processo and autor.flag_papel = 0 and pessoa.id_pessoa = autor.id_pessoa");
$autores = pg_fetch_object($pesq_autor);

$pesq_reu = pg_query($conexao1, "SELECT pessoa.nome from reu, pessoa where reu.id_processo = $id_processo and reu.flag_papel = 0 and pessoa.id_pessoa = reu.id_pessoa");
$reus = pg_fetch_object($pesq_reu);

/*Seleciona dados do processo e advogados do autor e do réu*/
$query = "SELECT processo.numero_unificado, padvautor.nome as nome_adv_autor, padvreu.nome as nome_adv_reu,
    natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, trim(to_char(valor_causa, '999999999D99')) as valor_causa, 
    trim(to_char(deposito_judicial, '999G999G999D99')) as deposito_judicial, juizo.nome as nome_juizo, trim(to_char(auto_penhora, '999999999D99')) as auto_penhora,
    comarca.nome as nome_comarca, to_char(transito_em_julgado, 'DD/MM/YYYY') as transito_em_julgado, padvautor.id_pessoa as id_advogado_autor, 
    padvreu.id_pessoa as id_advogado_reu,processo.id_juizo, processo.id_natureza_acao
    from ((((((processo
    inner join natureza_acao on processo.id_processo = $id_processo and processo.id_natureza_acao = natureza_acao.id_natureza_acao) /*Busca nome da natureza da ação*/
     /*Busca advogado do autor*/
    inner join autor autor_adv on autor_adv.id_processo = processo.id_processo and autor_adv.flag_papel = 1)
    inner join pessoa padvautor on padvautor.id_pessoa = autor_adv.id_pessoa)
    /*Busca advogado do réu*/
    inner join reu reu_adv on reu_adv.id_processo = processo.id_processo and reu_adv.flag_papel = 1)
    inner join pessoa padvreu on padvreu.id_pessoa = reu_adv.id_pessoa)
    /*Busca Juízo*/
    inner join juizo on processo.id_juizo = juizo.id_juizo)
    /*Busca comarca*/
    inner join comarca on comarca.id_comarca = juizo.id_comarca
    order by data_distribuicao";

$pesq_processo = pg_query($conexao1,$query);
$processo = pg_fetch_object($pesq_processo); //Contem dados do processo

?>


<div class="container content">

    <form name ="form_processo" id="form_processo" class="form-horizontal" method="post" action="../operacoes/CProcesso/incluir_processo_op.php">
        <fieldset>

            <!--Campos formulário -->

            <legend><h1>Editar processo</h1></legend>

            <div id="msg_resultado_processo">
                <div class="alert alert-block fade in">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <p>Todos os itens com a tarja <b>amarela</b> sao obrigatorios</p></div>
            </div>   
            <br/>
            <div class="controls">
                <input type="hidden" class="input-xlarge aviso" id="id_input" name="id_processo" value= "<?php echo $id_processo ?>">
            </div>
            <div class="row">                

                <div class="span5">
                    <!-- Campo numero unificado -->
                    <div id="numero_unificado" class="control-group">
                        <label class="control-label" for="numero_unificado">Numero Unificado</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="numero_unificado_input" name="numero_unificado" value="<?php echo $processo->numero_unificado?>">                       
                            <span  class="help-inline ">Apenas digitos</span>                    
                        </div>
                    </div>        
                </div>

                <div class="span5">
                    <!-- Campo data de distribuição -->
                    <div id="data_distribuicao" class="control-group">
                        <label class="control-label" for="data distribuicao">Data Distribuicao</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="data_dist_input" name="data_distribuicao" value="<?php echo $processo->data_distribuicao?>">                       
                            <span  class="help-inline ">Digite no formato dd/dd/aaaa Ex: 12/10/2010</span>                    
                        </div>
                    </div>
                </div>             
            </div>

            <div class="row">
                <div class="span5">
                    <!-- Campo Juizo Combo -->
                    <div class="control-group" id="juizo-control">
                        <label class="control-label" for="juizo">Juizo</label>
                        <div class="controls">                    
                            <select  name="id_juizo" id="juizo" class="aviso">
                                <?php echo "<option value=$processo->id_juizo>$processo->nome_juizo</option>" ?>
                                <?php
                                if ($resultado_juizo->id_juizo != NULL) {
                                    do {
                                        if ($resultado_juizo->id_juizo != $processo->id_juizo){
                                            echo "<option value=$resultado_juizo->id_juizo>$resultado_juizo->nome</option>";
                                        }
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
                        <label class="control-label" for="natureza">Natureza Acao</label>
                        <div class="controls">                    
                            <select name="id_natureza" id="natureza" class="aviso">
                                 <?php echo "<option value=$processo->id_natureza_acao>$processo->nome_natureza</option>" ?>
                                <?php
                                if ($resultado_natureza->id_natureza_acao != NULL) {
                                    do {
                                        if ($resultado_natureza->id_natureza_acao != $processo->id_natureza_acao)
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
                        <label class="control-label" for="valor_causa">Valor da causa</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="valor_causa_input" name="valor_causa" value="<?php echo $processo->valor_causa?>">     
                            <span  class="help-inline ">O valor deve ter vigula Ex: 1200,00</span> 
                        </div>
                    </div>      
                </div>
            </div>

            <div class="divisor_horizontal"></div>


            <div class="row">
                <div class="span5">
                    <!-- Campo autor -->
                    <div id="autor"class="control-group ">
                        <label class="control-label" for="autor">Autor</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="autor_input" name="autor" 
                           value="<?php $i = 0; while ($i<$n_autores) { echo $autores->nome; $i++; if ($i!=$n_autores) echo ", ";$autores=pg_fetch_object($pesq_autor);}?>"/>     
                            <span class="help-inline "><a class="pessoa-modal" data-toggle="modal" href="#myModal"><i id="autor-modal" class="icon-plus"></i></a></span> 
                            <div id="autocompleteAutor" class="autocompleteBox"></div>
                        </div>                 
                    </div>   
                </div>

                <div class="span5">
                    <!-- Campo advogado autor -->
                    <div id="autor_advogado"class="control-group ">
                        <label class="control-label" for="ad1">Advogado do Autor</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="autor_ad_input" name="autor_advogado" value="<?php echo $processo->nome_adv_autor?>"/>     
                            <span  class="help-inline "><a class="pessoa-modal" data-toggle="modal" href="#myModal"><i id="autor-ad-modal" class="icon-plus"></i></a></span> 
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
                            <input type="text" class="input-xlarge" id="autor_rep_input" name="autor_rep"
                           value="<?php $i = 0; while ($i<$n_rep_autores) { echo $rep_autor->nome; $i++; if ($i!=$n_rep_autores) echo ", ";$rep_autor=pg_fetch_object($pesq_rep_autor);}?>"/>
                            <span  class="help-inline "><a class="pessoa-modal" data-toggle="modal" href="#myModal"><i id="autor-rep-modal" class="icon-plus"></i></a></span> 
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
                        <label class="control-label" for="reu">Reu</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="reu_input" name="reu" 
                                   value="<?php $i = 0; while ($i<$n_reus) { echo $reus->nome; $i++; if ($i!=$n_reus) echo ", ";$reus=pg_fetch_object($pesq_reu);}?>"/>     
                            <span  class="help-inline "><a class="pessoa-modal" data-toggle="modal" href="#myModal"><i id="reu-modal" class="icon-plus"></i></a></span> 
                            <div id="autocompleteReu" class="autocompleteBox"></div>
                        </div>                 
                    </div>
                </div>

                <div class="span5">
                    <!-- Campo advogado Réu -->
                    <div id="reu_advogado"class="control-group ">
                        <label class="control-label" for="ad2">Advogado do Reu</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="reu_ad_input" name="reu_advogado" value="<?php echo $processo->nome_adv_reu?>"/>     
                            <span  class="help-inline "><a class="pessoa-modal" data-toggle="modal" href="#myModal"><i id="reu-ad-modal" class="icon-plus"></i></a></span> 
                            <div id="autocompleteAdvogado2" class="autocompleteBox"></div>
                        </div>                 
                    </div>  
                </div>

            </div>


            <div class="row">
                <div class="span5">
                    <!-- Campo representante reu -->
                    <div id="reu_rep"class="control-group ">
                        <label class="control-label" for="autor">Representante Reu</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="reu_rep_input" name="reu_rep"
                        value="<?php $i = 0; while ($i<$n_rep_reus) { echo $rep_reu->nome; $i++; if ($i!=$n_rep_reus) echo ", ";$rep_reu=pg_fetch_object($pesq_rep_reu);}?>"/>     
                            <span  class="help-inline "><a class="pessoa-modal" data-toggle="modal" href="#myModal"><i id="reu-rep-modal" class="icon-plus"></i></a></span> 
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
                        <label class="control-label" for="Transito em Julgado">Transito em Julgado</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="tej_input" name="transito_em_julgado" value="<?php echo $processo->transito_em_julgado?>">                       
                            <span  class="help-inline ">Digite no formato dd/dd/aaaa Ex: 12/10/2010</span>                    
                        </div>
                    </div>
                </div>

                <div class="span5">
                    <!-- Campo deposito -->
                    <div id="deposito_judicial" class="control-group">
                        <label class="control-label" for="deposito judicial">Deposito Judicial</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="deposito_judicial_input" name="deposito_judicial" value="<?php echo $processo->deposito_judicial?>">                       
                            <span  class="help-inline ">O valor deve ter vigula Ex: 1200,00</span>                    
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
                                <input type="text" class="input-large" id="auto_penhora_input" name="auto_penhora" value="<?php echo $processo->auto_penhora?>"/>                       
                                <span  class="help-inline ">O valor deve ter vigula Ex: 1200,00</span>
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
                <button  type="button" class="btn opa">Cancelar</button>
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
                        <button type="button" class="btn btn-primary disabled" id="fisica">Fisica</button>
                        <button type="button" class="btn btn-primary" id="juridica">Juridica</button>
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
                        <span  class="help-inline ">Use apenas digitos</span>                    
                    </div>
                </div>

                <div id="cpf" class="control-group">
                    <label class="control-label" for="cpf">CPF</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="cpf_input" name="cpf">                       
                        <span  class="help-inline ">Use apenas digitos</span>                    
                    </div>
                </div>

                <div id="rg" class="control-group">
                    <label class="control-label" for="rg">RG</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="rg_input" name="rg">                       
                        <span  class="help-inline ">Use apenas digitos</span>                    
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
                        <span  class="help-inline ">Minimo 4 dígitos</span>                    
                    </div>
                </div>

                <div id="endereco"class="control-group ">
                    <label class="control-label" for="endereco">Endereco</label>
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
                        <span  class="help-inline ">Use apenas digitos</span> 
                    </div>
                </div>

                <div id="email" class="control-group ">
                    <label class="control-label" for="email">Email</label>
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
                            A pessoa cadastrada tera acesso ao sistema
                        </label>
                    </div>                    
                </div>

                <div id="senha" class="control-group ">
                    <label class="control-label" for="telefone">Senha</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="senha_input" name="senha">    
                        <span  class="help-inline ">Minimo de 7 digitos alfanumericos</span> 
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


