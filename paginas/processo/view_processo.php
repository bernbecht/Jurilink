<?php

require_once  '../config.php';     //chama as configurações de página!

if(!isset($_GET['user']))
    require_once '../template/header.php'; //chama o header
else 
    include '../template/header_user.php'; //chama o header


//GET para ID do processo
if(isset($_GET['id'])) $id_processo = $_GET['id'];



/** TRATAMENTO DE PROCESSOS COM MAIS DE UM AUTOR OU RÉU**/

$query = "SELECT count(*) from autor where id_processo = $id_processo and flag_papel = 0";
$pesq_num_autores = pg_exec($conexao1,$query);
$num_autores = pg_fetch_object($pesq_num_autores);

$query = "SELECT count(*) from reu where id_processo = $id_processo and flag_papel = 0";
$pesq_num_reus = pg_exec($conexao1,$query);
$num_reus = pg_fetch_object($pesq_num_reus);

if ($num_autores->count == 1 and $num_reus->count == 1){
    $query = "SELECT processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padvautor.nome as nome_adv_autor, padvreu.nome as nome_adv_reu,
    natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, to_char(valor_causa, 'R$999G999G999D99') as valor_causa, 
    to_char(deposito_judicial, 'R$999G999G999D99') as deposito_judicial, juizo.nome as nome_juizo, to_char(auto_penhora, 'R$999G999G999D99') as auto_penhora,
    comarca.nome as nome_comarca, to_char(transito_em_julgado, 'DD/MM/YYYY') as transito_em_julgado, preu.id_pessoa as id_reu, pautor.id_pessoa as id_autor,
    padvautor.id_pessoa as id_advogado_autor, padvreu.id_pessoa as id_advogado_reu,pautor.tipo as tipo_autor, preu.tipo as tipo_reu
    from ((((((((((processo
    inner join natureza_acao on processo.id_processo = $id_processo and processo.id_natureza_acao = natureza_acao.id_natureza_acao) /*Busca nome da natureza da ação*/
    /*Busca nome do Autor*/
    inner join autor on processo.id_processo = autor.id_processo and autor.flag_papel = 0)
    inner join pessoa pautor on pautor.id_pessoa = autor.id_pessoa)
    /*Busca nome do Réu*/
    inner join reu on processo.id_processo = reu.id_processo and reu.flag_papel = 0)
    inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
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
}
else if ($num_autores->count > 1 && $num_reus->count == 1){
    $query = "SELECT pessoa.nome, pessoa.tipo, pessoa.id_pessoa from (processo
    inner join autor on autor.id_processo = processo.id_processo and autor.flag_papel = 0 and processo.id_processo = $id_processo)
    inner join pessoa on pessoa.id_pessoa = autor.id_pessoa";
    
    $pesq_autores = pg_exec($conexao1,$query);
    $autores = pg_fetch_object($pesq_autores);

    
    $query = "SELECT processo.numero_unificado,preu.nome as nome_reu ,padvautor.nome as nome_adv_autor, padvreu.nome as nome_adv_reu,
    natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, to_char(valor_causa, 'R$999G999G999D99') as valor_causa, 
    to_char(deposito_judicial, 'R$999G999G999D99') as deposito_judicial, juizo.nome as nome_juizo, to_char(auto_penhora, 'R$999G999G999D99') as auto_penhora,
    comarca.nome as nome_comarca, to_char(transito_em_julgado, 'DD/MM/YYYY') as transito_em_julgado, padvautor.id_pessoa as id_advogado_autor, padvreu.id_pessoa as id_advogado_reu,
    preu.tipo as tipo_reu, preu.id_pessoa as id_reu
    from ((((((((processo
    inner join natureza_acao on processo.id_processo = $id_processo and processo.id_natureza_acao = natureza_acao.id_natureza_acao) /*Busca nome da natureza da ação*/
    /*Busca nome do réu*/
    inner join reu on processo.id_processo = reu.id_processo and reu.flag_papel = 0)
    inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
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
}

else if ($num_autores->count == 1 && $num_reus->count > 1){
    $query = "SELECT pessoa.nome, pessoa.tipo, pessoa.id_pessoa from (processo
    inner join reu on reu.id_processo = processo.id_processo and reu.flag_papel = 0 and processo.id_processo = $id_processo)
    inner join pessoa on pessoa.id_pessoa = reu.id_pessoa";
    
    $pesq_reus = pg_exec($conexao1,$query);
    $reus = pg_fetch_object($pesq_reus);
   
    $query = "SELECT processo.numero_unificado,pautor.nome as nome_autor ,padvautor.nome as nome_adv_autor, padvreu.nome as nome_adv_reu,
    natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, to_char(valor_causa, 'R$999G999G999D99') as valor_causa, 
    to_char(deposito_judicial, 'R$999G999G999D99') as deposito_judicial, juizo.nome as nome_juizo, to_char(auto_penhora, 'R$999G999G999D99') as auto_penhora,
    comarca.nome as nome_comarca, to_char(transito_em_julgado, 'DD/MM/YYYY') as transito_em_julgado, padvautor.id_pessoa as id_advogado_autor, padvreu.id_pessoa as id_advogado_reu,
    pautor.tipo as tipo_autor, pautor.id_pessoa as id_autor
    from ((((((((processo
    inner join natureza_acao on processo.id_processo = $id_processo and processo.id_natureza_acao = natureza_acao.id_natureza_acao) /*Busca nome da natureza da ação*/
    /*Busca nome do autor*/
    inner join autor on processo.id_processo = autor.id_processo and autor.flag_papel = 0)
    inner join pessoa pautor on pautor.id_pessoa = autor.id_pessoa)
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
}

else if ($num_autores->count > 1 && $num_reus->count > 1){
    $query = "SELECT pessoa.nome, pessoa.tipo, pessoa.id_pessoa from (processo
    inner join autor on autor.id_processo = processo.id_processo and autor.flag_papel = 0 and processo.id_processo = $id_processo)
    inner join pessoa on pessoa.id_pessoa = autor.id_pessoa";
    
    $pesq_autores = pg_exec($conexao1,$query);
    $autores = pg_fetch_object($pesq_autores);
    
    $query = "SELECT pessoa.nome, pessoa.tipo, pessoa.id_pessoa from (processo
    inner join reu on reu.id_processo = processo.id_processo and reu.flag_papel = 0 and processo.id_processo = $id_processo)
    inner join pessoa on pessoa.id_pessoa = reu.id_pessoa";
    
    $pesq_reus = pg_exec($conexao1,$query);
    $reus = pg_fetch_object($pesq_reus);
    
    $query = "SELECT processo.numero_unificado,padvautor.nome as nome_adv_autor, padvreu.nome as nome_adv_reu,
    natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, to_char(valor_causa, 'R$999G999G999D99') as valor_causa, 
    to_char(deposito_judicial, 'R$999G999G999D99') as deposito_judicial, juizo.nome as nome_juizo, to_char(auto_penhora, 'R$999G999G999D99') as auto_penhora,
    comarca.nome as nome_comarca, to_char(transito_em_julgado, 'DD/MM/YYYY') as transito_em_julgado, padvautor.id_pessoa as id_advogado_autor, padvreu.id_pessoa as id_advogado_reu
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
}

$pesq_processo = pg_exec($conexao1,$query);
$processo = pg_fetch_object($pesq_processo);

$query = "SELECT * from ato";
$pesq_ato = pg_query ($conexao1,$query);
$ato = pg_fetch_object($pesq_ato);

/*Pesquisa atos do processo*/
$query = "SELECT to_char(data_atualizacao,'dd/mm/yyyy') as data_atualizacao, nome, previsao, descricao,flag_cliente from processo_ato inner join ato on
processo_ato.id_processo = $id_processo and processo_ato.id_ato = ato.id_ato order by data_atualizacao desc";
$pesq_ato_proc = pg_query($conexao1,$query);
$ato_proc = pg_fetch_object($pesq_ato_proc);

$query = "SELECT to_char(data,'dd/mm/yyyy') as data, local, tipo, id_audiencia from audiencia where audiencia.id_processo = $id_processo order by id_audiencia desc";
$pesq_audiencias = pg_query($conexao1,$query);
$audiencia = pg_fetch_object($pesq_audiencias);


?>

<div class ="container content">
    <div class ="esquerda"><h1> PROCESSO  </h1> </div>
    <?php
     if ($_SESSION['tipo_usuario'] == 2){
      echo "<div class=direita>        
        <a class='btn btn-warning btn-small' href='editar_processo.php?id=$id_processo'>
            <i class='icon-pencil icon-white'></i>
            EDITAR    
        </a>             
        </div>";
     }
     ?>
    
   
    <br/>
      <br/>
      <hr border ="20px" height ="50px">
  <div class="row show-grid">
          <div class="span2 offset1"><?php echo "<b>Data Distribui&ccedil;&atilde;o</b>" ?></div>
    <div class="span2"><?php echo $processo->data_distribuicao; ?></div>
    
    <div class="span2 offset1"><?php echo "<b>Tr&acirc;nsito em Julgado</b>" ?></div>
    <div class="span2"><?php  echo $processo->transito_em_julgado; ?></div>
        
    <div class="span2 offset1"><?php echo "<b>Autor(es)</b>" ?></div>
    <div class="span2">
        <?php
        if ($num_autores->count == 1){
            if ($processo->tipo_autor == 0){
                if ($_SESSION['tipo_usuario'] == 2)
                    echo  "<a href=../pessoa/view_pessoafisica.php?id=$processo->id_autor>".$processo->nome_autor."</a>";
                else echo $processo->nome_autor;
            }
            else if ($processo->tipo_autor == 1){
                   if ($_SESSION['tipo_usuario'] == 2)
                    echo  "<a href=../pessoa/view_pessoajuridica.php?id=$processo->id_autor>".$processo->nome_autor."</a>";
                   else echo $processo->nome_autor;
            }
        }
        else{
            $a = 0;
            while ($a!=$num_autores->count){
                if ($autores->tipo == 0){
                    if ($_SESSION['tipo_usuario'] == 2)
                        echo  "<a href=../pessoa/view_pessoafisica.php?id=$autores->id_pessoa>".$autores->nome."</a>";
                    else echo $autores->nome;
                }
            else if ($autores->tipo == 1){
                if ($_SESSION['tipo_usuario'] == 2)
                    echo  "<a href=../pessoa/view_pessoajuridica.php?id=$autores->id_pessoa>".$autores->nome."</a>";
                else echo $autores->nome; 
                
            }
            $autores = pg_fetch_object($pesq_autores);
            $a++;
            if ($a!=$num_autores->count)
                echo ", ";
            }
            
        }
        ?>
        
    </div>
        
    <div class="span2 offset1"><?php echo "<b>R&eacute;u(s)</b>" ?></div>
    <div class="span2">
        <?php
        if ($num_reus->count == 1){
            if ($processo->tipo_reu == 0){
                if ($_SESSION['tipo_usuario'] == 2)
                    echo  "<a href=../pessoa/view_pessoafisica.php?id=$processo->id_reu>".$processo->nome_reu."</a>";
                else echo $processo->nome_reu;
            }
            else if ($processo->tipo_reu == 1){
                   if ($_SESSION['tipo_usuario'] == 2)
                    echo  "<a href=../pessoa/view_pessoajuridica.php?id=$processo->id_reu>".$processo->nome_reu."</a>";
                   else echo $processo->nome_reu;
            }
        }
        else{
            $r = 0;
            while ($r!=$num_reus->count){
                if ($reus->tipo == 0){
                    if ($_SESSION['tipo_usuario'] == 2)
                        echo  "<a href=../pessoa/view_pessoafisica.php?id=$reus->id_pessoa>".$reus->nome."</a>";
                    else echo $reus->nome;
                }
            else if ($reus->tipo == 1){
                if ($_SESSION['tipo_usuario'] == 2)
                    echo  "<a href=../pessoa/view_pessoajuridica.php?id=$reus->id_pessoa>".$reus->nome."</a>";
                else echo $reus->nome; 
                
            }
            $reus = pg_fetch_object($pesq_reus);
            $r++;
            if ($r!=$num_reus->count)
                echo ", ";
            }
            
        }
        ?>
        
    </div>
    
    <div class="span2 offset1"><?php echo "<b>Advogado Autor(es)</b>" ?></div>
    <div class="span2">
        <?php
        if ($_SESSION['tipo_usuario'] == 2)
            echo "<a href=../pessoa/view_advogado.php?id=$processo->id_advogado_autor>".$processo->nome_adv_autor."</a>";
        else echo $processo->nome_adv_autor;
           
        ?>
    </div>

    <div class="span2 offset1"><?php echo "<b>Advogado R&eacute;u(s)</b>" ?></div>
    <div class="span2">
        <?php 
        if ($_SESSION['tipo_usuario'] == 2)
            echo "<a href=../pessoa/view_advogado.php?id=$processo->id_advogado_reu>".$processo->nome_adv_reu."</a>";
        else echo $processo->nome_adv_reu;
        ?>
    </div>
    
    <div class="span2 offset1"><?php echo "<b>Valor da Causa</b>" ?></div>
    <div class="span2"><?php echo $processo->valor_causa; ?></div>
    
    <div class="span2 offset1"><?php echo "<b>Natureza</b>" ?></div>
    <div class="span2"><?php echo $processo->nome_natureza; ?></div>
    
    <div class="span2 offset1"><?php echo "<b>Dep&oacute;sito Judicial</b>" ?></div>
    <div class="span2"><?php echo $processo->deposito_judicial; ?></div>
    
    <div class="span2 offset1"><?php echo "<b>Ju&iacute;zo</b>" ?></div>
    <div class="span2"><?php echo $processo->nome_juizo; ?></div>
    
    <div class="span2 offset1"><?php echo "<b>Auto da Penhora</b>" ?></div>
    <div class="span2"><?php echo $processo->auto_penhora; ?></div>
    
    <div class="span2 offset1"><?php echo "<b>Comarca</b>" ?></div>
    <div class="span2"><?php echo $processo->nome_comarca; ?></div>
    
  
  </div>
      
      <hr border ="20px" height ="50px">
     
       <div class ="esquerda"> <h1> ATOS </h1> </div>
    <?php
     if ($_SESSION['tipo_usuario'] == 2){
      echo " <div class =direita>        
        <a class='btn btn-small btn-success pessoa-modal' data-toggle='modal' href='#myModal'><i id='reu-modal' class='icon-plus icon-white'></i>
            INCLUIR ATO    
        </a>             
        </div>";
     }
     ?> 
 
      <div class="tabela"> 
    <?php 
        echo "<table = 'ato' class=table table-striped table-condensed >";
        echo "<thead>";
        echo "<tr>
                <th>Ato</th>
                <th>Data de Modifica&ccedil;&atilde;o</th>
                <th>Descri&ccedil;&atilde;o</th>
             </tr>
        </thead>";
        echo "<tbody>";
        if (pg_num_rows($pesq_ato_proc)>0){
            do {
                if ($_SESSION['tipo_usuario'] == 2){
                echo "<tr>	
                    <td>" . $ato_proc->nome . "</a></td>
                    <td>" . $ato_proc->data_atualizacao . "</td>
                    <td>" . $ato_proc->descricao . "</td>
                    </tr>";
                }
                else if($_SESSION['tipo_usuario'] == 1 || $_SESSION['tipo_usuario'] == 0){
                    if ($ato_proc->flag_cliente == 't'){
                         echo "<tr>	
                            <td>" . $ato_proc->nome . "</a></td>
                            <td>" . $ato_proc->data_atualizacao . "</td>
                            <td>" . $ato_proc->descricao . "</td>
                            </tr>";        
                    }
                    
                }
           }while ($ato_proc = pg_fetch_object($pesq_ato_proc));
        }
        
        echo "</tbody>";
        echo "</table>";
        

     ?>
     </div>
      
             
      <hr border ="20px" height ="50px">
     <div class ="esquerda"> <h1> AUDI&Ecirc;NCIAS </h1> </div>
    <?php
     if ($_SESSION['tipo_usuario'] == 2){
      echo " <div class =direita>        
        <a class='btn btn-small btn-success audiencia-modal' data-toggle='modal' href='#audienciaModal'><i id='audiencia-modal' class='icon-plus icon-white'></i>
            INCLUIR AUDI&Ecirc;NCIA    
        </a>             
        </div>";
     }
     ?>
  
      <div class="tabela"> 
    <?php 
        echo "<table = 'audiencia' class=table table-striped table-condensed >";
        echo "<thead>";
        echo "<tr>
                <th>Data</th>
                <th>Local</th>
                <th>Tipo</th>
            </tr>
        </thead>";
        echo "<tbody>";
        
        if (pg_num_rows($pesq_audiencias)>0){
                       
            do {
                echo "<tr>	
                    <td>" . $audiencia->data . "</a></td>
                    <td>" . $audiencia->local . "</td>
                    <td>" . $audiencia->tipo . "</td>
                    </tr>";

                    }while ($audiencia = pg_fetch_object($pesq_audiencias));
        }
              
        echo "</tbody>";
        echo "</table>";
    ?>
    
</div>
</div>

<!-- MODAL para ATUALIZAÇÃO DE ATOS-->
<div id="myModal" class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">x</button>
        <h3>Atualizar Ato</h3>
    </div>
    <div class="modal-body">
        <form id="form_atualiza_ato" class="form-horizontal AtoAjaxForm" method="post" action="../operacoes/CProcesso_ato/incluir_processo_ato_op.php">
            <fieldset>
                <!--Campos formulário --> 

                <div id="msg_resultado"></div>
                
                <div id="ato" class="control-group">
                    <label class="control-label" for="Ato">Atos</label>
                    <div class="controls">                    
                        <select  name="ato" id="ato_input" class="aviso">
                            <option value="-1">-</option>
                            <?php
                            if ($ato->id_ato != NULL) {
                                do {
                                    echo "<option value=$ato->id_ato>$ato->nome</option>";
                                } while ($ato = pg_fetch_object($pesq_ato));
                            }
                            ?>                     
                        </select>
                        <span  class="help-inline "></span>
                    </div>
                </div>

                <input type="hidden" class="input-xlarge" id="tipo_input" name="tipo"> 
                <input type="hidden" class="input-xlarge" id="id_processo" name="id_processo" value =<?php echo "$id_processo"?>>    

                </div>
            </fieldset>
        </form> 

        <div class="modal-footer"> 
            <a href="#" class="btn cancelar-modal" data-dismiss="modal">Cancelar</a>
            <button  id ="enviar"  type="button" class="btn btn-primary submit-ato-modal">Salvar</button>
        </div>
    </div>

<!-- MODAL para ATUALIZAÇÃO DE AUDIENCIAS-->
<div id="audienciaModal" class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">x</button>
        <h3>Incluir Audi&ecirc;ncia</h3>
    </div>
    <div class="modal-body">
        <form id="form_atualiza_audiencia" class="form-horizontal AudienciaAjaxForm" method="post" action="../operacoes/CAudiencia/incluir_audiencia_op.php">
            <fieldset>
                <!--Campos formulário --> 

                <div id="msg_resultado"></div>
                
                <div id="tipo_audiencia" class="control-group ">
                    <label class="control-label" for="tipo_audiencia">Tipo</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="tipo_audiencia_input" name="tipo_audiencia">    
                        <span  class="help-inline "></span> 
                    </div>
                </div>
                
                
                <div id="local" class="control-group ">
                    <label class="control-label" for="local">Local</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge aviso" id="local_input" name="local">    
                        <span  class="help-inline "></span> 
                    </div>
                </div>
                
                 <div id="data_audiencia" class="control-group">
                        <label class="control-label" for="data_audiencia">Data</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge aviso" id="data_audiencia_input" name="data_audiencia">                       
                            <span  class="help-inline ">Digite no formato dd/mm/aaaa Ex: 08/12/1990</span>                    
                        </div>
                    </div>
                
                <input type="hidden" class="input-xlarge" id="tipo_input" name="tipo"> 
                <input type="hidden" class="input-xlarge" id="id_processo" name="id_processo" value =<?php echo "$id_processo"?>>    

                </div>
            </fieldset>
        </form> 

        <div class="modal-footer"> 
            <a href="#" class="btn cancelar-modal" data-dismiss="modal">Cancelar</a>
            <button  id ="enviar"  type="button" class="btn btn-primary submit-audiencia-modal">Salvar</button>
        </div>
    </div>

</body>
</html>
<?php
require_once '../template/scripts.php'; //chama scripts comuns as paginas

?>