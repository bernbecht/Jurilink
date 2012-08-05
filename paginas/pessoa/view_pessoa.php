<?php
require_once '../template/header.php'; //chama o header
require_once  '../config.php';     //chama as configurações de página!

$id_user = $_SESSION['id_usuario'];
$query = "SELECT * FROM pessoa WHERE id_pessoa = $id_user";

$pesq_pessoa = pg_query($conexao1,$query);

$pessoa = pg_fetch_object($pesq_pessoa);



?>

<div class ="container">
    <div class ="esquerda"><h1><?php echo "NOME PESSOA"; ?>  </h1> </div>
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
    <div class="span2 offset1"><?php echo "Nome" ?></div>
    <div class="span2"><?php echo "COLUNA 2"?></div>
  
    <div class="span2 offset1"><?php echo "Telefone" ?></div>
    <div class="span2"><?php echo "COLUNA 2"?></div>
    
    <div class="span2 offset1"><?php echo "E-mail" ?></div>
    <div class="span2"><?php echo "COLUNA 2"?></div>
  
    <div class="span2 offset1"><?php echo "Endere&ccedil;o" ?></div>
    <div class="span2"><?php echo "Rua"?></div>    
    
    <div class="span2 offset1"><?php echo "RG" ?></div>
    <div class="span2"><?php echo "COLUNA 2"?></div>
  
    <div class="span2 offset1"><?php echo "Bairro" ?></div>
    <div class="span2"><?php echo "COLUNA 2"?></div>
    
    <div class="span2 offset1"><?php echo "CPF/CNPJ" ?></div>
    <div class="span2"><?php echo "COLUNA 2"?></div>
  
    <div class="span2 offset1"><?php echo "Cidade" ?></div>
    <div class="span2"><?php echo "COLUNA 2"?></div>
    
    <div class="span2 offset1"><?php echo "User" ?></div>
    <div class="span2"><?php echo "COLUNA 2"?></div>
  
    <div class="span2 offset1"><?php echo "Estado" ?></div>
    <div class="span2"><?php echo "COLUNA 2"?></div>
  </div>
      
      <hr border ="20px" height ="50px">
      <h3> PROCESSOS COM A ADVOCACIA </h3>
      <div class="tabela"> 
    <?php 
        echo "<table = 'processos' class=table table-striped table-condensed >";
        echo "<thead>";
        echo "<tr>
                <th>N&uacute;mero</th>
                <th>Data Distribui&ccedil;&atilde;o</th>
                <th>Natureza</th>
                <th>Autor(es)</th>
                <th>R&eacute;u(s)</th>
                <th>Tr&acirc;nsito em Julgado</th>
                <th>A&ccedil;&otilde;es</th>
                </tr></thead>";
        echo "<tbody>";
        echo "</tbody>";
        echo "</table>";
        
     ?>
     </div>
      
      
      
      <hr border ="20px" height ="50px">
      <h3> PROCESSOS CONTRA A ADVOCACIA </h3>
      
      
      

</div>

</body>
</html>
<?php
require_once '../template/scripts.php'; //chama scripts comuns as paginas

?>