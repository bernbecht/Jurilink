<?php
require_once '../template/header.php'; //chama o header
require_once  '../config.php';     //chama as configurações de página!

//GET para ID da pessoa
if(isset($_GET['id'])) $id_processo = $_GET['id'];

echo $id_processo;

$query = "SELECT count(*) from autor where id_processo = $id_processo and flag_papel = 0";
$pesq_num_autores = pg_exec($conexao1,$query);
$num_autores = pg_fetch_object($pesq_num_autores);

$query = "SELECT count(*) from reu where id_processo = $id_processo and flag_papel = 0";
$pesq_num_reus = pg_exec($conexao1,$query);
$num_reus = pg_fetch_object($pesq_num_reus);


?>

<div class ="container content">
    <div class ="esquerda"><h1> PROCESSO  </h1> </div>
    <div class ="direita">        
        <a class="btn btn-small btn-warning" href="#">
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
                    <td>" . $processos_advocacia->data_distribuicao . "</a></td>
                    <td>" . $processos_advocacia->numero_unificado . "</td>
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
                    <td>" . $processos_advocacia->numero_unificado . "</td>
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

</body>
</html>
<?php
require_once '../template/scripts.php'; //chama scripts comuns as paginas

?>