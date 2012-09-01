<?php
require_once '../template/header.php'; //chama o header
require_once  '../config.php';     //chama as configurações de página!

//GET para ID da pessoa
if(isset($_GET['id'])) $id_pessoa = $_GET['id'];

//Coleta dados de pessoa do banco para mostrar na tela
$query = "SELECT * FROM pessoa WHERE id_pessoa = $id_pessoa";
$pesq_pessoa = pg_query($conexao1,$query);
$pessoa = pg_fetch_object($pesq_pessoa);

//Estado
$query = "SELECT uf.nome as nome_estado FROM uf,pessoa WHERE id_pessoa = $id_pessoa and pessoa.id_uf = uf.id_uf";
$pesq_uf = pg_query($conexao1,$query);
$estado = pg_fetch_object($pesq_uf);


$query = "SELECT * FROM fisica WHERE fisica.id_pessoa = $id_pessoa";
$pesq_fisica = pg_query($conexao1,$query);
$fisica = pg_fetch_object($pesq_fisica);

$query = "SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
to_char(processo.valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
from ((((((((processo
inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
inner join autor autor1 on processo.id_processo = autor1.id_processo and autor1.id_pessoa = $id_pessoa and autor1.flag_papel = 0)
inner join pessoa pautor on pautor.id_pessoa = autor1.id_pessoa)
inner join autor advautor on advautor.flag_papel = 1 and advautor.id_processo = processo.id_processo)
inner join pessoa padv on padv.id_pessoa = advautor.id_pessoa)
inner join reu on reu.id_processo = processo.id_processo and reu.flag_papel = 0) 
inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.flag_func = TRUE)
UNION
SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
to_char(processo.valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
from (((((((processo
inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
inner join reu on processo.id_processo = reu.id_processo and reu.id_pessoa = $id_pessoa and reu.flag_papel = 0)
inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
inner join reu advreu on advreu.flag_papel = 1 and advreu.id_processo = processo.id_processo)
inner join pessoa padv on padv.id_pessoa = advreu.id_pessoa)
inner join autor on autor.id_processo = processo.id_processo and autor.flag_papel = 0)
inner join pessoa pautor on pautor.id_pessoa = autor.id_pessoa)
inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.flag_func = TRUE
order by data_distribuicao";
$pesq_proc_advocacia = pg_query($conexao1,$query);
$processos_advocacia = pg_fetch_object($pesq_proc_advocacia);


$query = "SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
to_char(valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
from (((((((processo
inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
inner join autor autor1 on processo.id_processo = autor1.id_processo and autor1.id_pessoa = $id_pessoa and autor1.flag_papel = 0)
inner join pessoa pautor on pautor.id_pessoa = autor1.id_pessoa)
inner join autor advautor on advautor.flag_papel = 1 and advautor.id_processo = processo.id_processo)
inner join pessoa padv on padv.id_pessoa = advautor.id_pessoa)
inner join reu on reu.id_processo = processo.id_processo and reu.flag_papel = 0) 
inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.flag_func = FALSE
UNION
SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
to_char(valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
from(((((((processo
inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
inner join reu on processo.id_processo = reu.id_processo and reu.id_pessoa = $id_pessoa and reu.flag_papel = 0)
inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
inner join reu advreu on advreu.flag_papel = 1 and advreu.id_processo = processo.id_processo)
inner join pessoa padv on padv.id_pessoa = advreu.id_pessoa)
inner join autor on autor.id_processo = processo.id_processo and autor.flag_papel = 0)
inner join pessoa pautor on pautor.id_pessoa = autor.id_pessoa)
inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.flag_func = FALSE
order by data_distribuicao";
$pesq_proc_c_advocacia = pg_query($conexao1,$query);

?>

<div class ="container content">
    <div class ="esquerda"><h1><?php echo $pessoa->nome; ?>  </h1> </div>
    <div class ="direita">        
        <?php
        echo "<a href=editar_pfisica.php?id=$id_pessoa class='btn btn-small btn-warning' >"
        ?>
            <i class="icon-pencil icon-white"></i>
            EDITAR     
        </a>             
        </div>
    
    
    <br/>
      <br/>
      <hr border ="20px" height ="50px">
  <div class="row show-grid">
    <div class="span2 offset1"><?php echo "<b>Nome</b>" ?></div>
    <div class="span2"><?php echo $pessoa->nome ?></div>
  
    <div class="span2 offset1"><?php echo "<b>Telefone</b>" ?></div>
    <div class="span2"><?php echo $pessoa->tel ?></div>
    
    <div class="span2 offset1"><?php echo "<b>E-mail</b>" ?></div>
    <div class="span2"><?php echo $pessoa->email ?></div>
  
    <div class="span2 offset1"><?php echo "<b>Endere&ccedil;o</b>" ?></div>
    <div class="span2"><?php echo $pessoa->endereco ?></div>    
    
    <?php
        echo "<div class='span2 offset1'><b>RG</b></div>
        <div class='span2'>$fisica->rg</div>";
    
    ?>
  
    <div class="span2 offset1"><?php echo "<b>Bairro</b>" ?></div>
    <div class="span2"><?php echo $pessoa->bairro ?></div>
    
    <div class="span2 offset1"><?php echo "<b>CPF/CNPJ</b>" ?></div>
    <div class="span2">
        <?php
        echo $fisica->cpf;
        ?>
    </div>
  
    <div class="span2 offset1"><?php echo "<b>Cidade</b>" ?></div>
    <div class="span2"><?php echo $pessoa->cidade ?></div>
    
    <div class="span2 offset1"><?php echo "<b>User</b>" ?></div>
    <div class="span2">
        <?php
            
            $pesq_user = pg_exec($conexao1, "select count (id_pessoa) from usuario where usuario.id_pessoa = $id_pessoa");
            $user = pg_fetch_object($pesq_user);
                    if($user->count)
                    echo "SIM";
            else echo "N&Atilde;O";
        ?>
    </div>
  
    <div class="span2 offset1"><?php echo "<b>Estado</b>" ?></div>
    <div class="span2"><?php echo $estado->nome_estado ?></div>
  </div>
      
      <hr border ="20px" height ="50px">
     
      <h3> PROCESSOS COM A ADVOCACIA </h3>
  
      <div class="tabela"> 
    <?php 
        echo "<table = 'processos' class=table table-striped table-condensed >";
        echo "<thead>";
        echo "<tr>
                <th>Data Distribui&ccedil;&atilde;o</th>
                <th>N&uacute;mero</th>
                <th>Natureza</th>
                <th>Autor(es)</th>
                <th>R&eacute;u(s)</th>
                <th>Advogado</th>
                <th>Valor da Causa</th>
            </tr>
        </thead>";
        echo "<tbody>";
        if (pg_num_rows($pesq_proc_advocacia)>0){
            do {
                echo "<tr>	
                    <td>" . $processos_advocacia->data_distribuicao . "</td>
                    <td><a href=../processo/view_processo.php?id=$processos_advocacia->id_processo>" . $processos_advocacia->numero_unificado . "</a></td>
                    <td>" . $processos_advocacia->nome_natureza . "</td>
                    <td>" . $processos_advocacia->nome_autor . "</td>
                    <td>" . $processos_advocacia->nome_reu . "</td>
                    <td>" . $processos_advocacia->nome_adv . "</td>
                    <td>" . $processos_advocacia->valor_causa . "</td> 
                    </tr>";

                    }while ($processos_advocacia = pg_fetch_object($pesq_proc_advocacia));
        }
        
        echo "</tbody>";
        echo "</table>";
        

     ?>
     </div>
      
      
      
      <hr border ="20px" height ="50px">
     
      <h3> PROCESSOS CONTRA A ADVOCACIA </h3>
  
      <div class="tabela"> 
    <?php 
        echo "<table = 'processos_contra' class=table table-striped table-condensed >";
        echo "<thead>";
        echo "<tr>
                <th>Data Distribui&ccedil;&atilde;o</th>
                <th>N&uacute;mero</th>
                <th>Natureza</th>
                <th>Autor(es)</th>
                <th>R&eacute;u(s)</th>
                <th>Advogado</th>
                <th>Valor da Causa</th>
            </tr>
        </thead>";
        echo "<tbody>";
        if (pg_num_rows($pesq_proc_c_advocacia)>0){
            $processos_advocacia = pg_fetch_object($pesq_proc_c_advocacia);
            
            do {
                echo "<tr>	
                    <td>" . $processos_advocacia->data_distribuicao . "</a></td>
                    <td><a href=../processo/view_processo.php?id=$processos_advocacia->id_processo>" . $processos_advocacia->numero_unificado . "</a></td>
                    <td>" . $processos_advocacia->nome_natureza . "</td>
                    <td>" . $processos_advocacia->nome_autor . "</td>
                    <td>" . $processos_advocacia->nome_reu . "</td>
                    <td>" . $processos_advocacia->nome_adv . "</td>
                    <td>" . $processos_advocacia->valor_causa . "</td> 
                    </tr>";

                    }while ($processos_advocacia = pg_fetch_object($pesq_proc_c_advocacia));
        }
              
        echo "</tbody>";
        echo "</table>";
        

     ?>
     </div>
      
      

</div>

</body>
</html>
<?php
require_once '../template/scripts.php'; //chama scripts comuns as paginas

?>