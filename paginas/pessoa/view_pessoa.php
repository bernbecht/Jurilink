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

//Checa se é física, jurídica ou advogado
if ($pessoa->tipo == 0){
    
        $query = "SELECT * FROM fisica WHERE fisica.id_pessoa = $id_pessoa";
        $pesq_fisica = pg_query($conexao1,$query);
        $fisica = pg_fetch_object($pesq_fisica);
    
    
}

else if ($pessoa->tipo ==1){
    $query = "SELECT * FROM juridica, pessoa WHERE juridica.id_pessoa = $id_pessoa";
    $pesq_juridica = pg_query($conexao1,$query);
    $juridica = pg_fetch_object($pesq_juridica);
}
else if ($pessoa->tipo == 2){
        $query = "SELECT * from fisica, advogado WHERE fisica.id_pessoa = $id_pessoa AND advogado.id_pessoa = $id_pessoa";
        $pesq_advogado = pg_query($conexao1,$query);
        $advogado = pg_fetch_object($pesq_advogado);    
    }

?>

<div class ="container">
    <div class ="esquerda"><h1><?php echo $pessoa->nome; ?>  </h1> </div>
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
    if ($pessoa->tipo == 0){
        echo "<div class='span2 offset1'><b>RG</b></div>
        <div class='span2'>$fisica->rg</div>";
    }
    if ($pessoa->tipo == 2){
        echo "<div class='span2 offset1'><b>RG</b></div>
        <div class='span2'>$advogado->rg</div>";
    }
    ?>
  
    <div class="span2 offset1"><?php echo "<b>Bairro</b>" ?></div>
    <div class="span2"><?php echo $pessoa->bairro ?></div>
    
    <div class="span2 offset1"><?php echo "<b>CPF/CNPJ</b>" ?></div>
    <div class="span2">
        <?php
            if ($pessoa->tipo == 0) echo $fisica->cpf;
            if ($pessoa->tipo == 2) echo $advogado->cpf;
            if ($pessoa->tipo == 1) echo $juridica->cnpj;
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
                <th>N&uacute;mero</th>
                <th>Data Distribui&ccedil;&atilde;o</th>
                <th>Natureza</th>
                <th>Autor(es)</th>
                <th>R&eacute;u(s)</th>
                <th>Tr&acirc;nsito em Julgado</th>
                <th>Advogado</th>
                </tr></thead>";
        echo "<tbody>";
        echo "</tbody>";
        echo "</table>";
        
/* --QUERY PARA PROCESSOS DA PESSOA FÍSICA--
select processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, padv.nome as nome_adv, 
natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY')as data_distribuicao, processo.valor_causa, padv.id_pessoa as id_advogado,
preu.nome
from ((((((processo
inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
inner join autor autor1 on processo.id_processo = autor1.id_processo and autor1.id_pessoa = 97 and autor1.flag_papel = 0)
inner join pessoa pautor on pautor.id_pessoa = autor1.id_pessoa)
inner join autor advautor on advautor.flag_papel = 1 and advautor.id_processo = processo.id_processo)
inner join pessoa padv on padv.id_pessoa = advautor.id_pessoa)
inner join reu on reu.id_processo = processo.id_processo and reu.flag_papel = 0) 
inner join pessoa preu on preu.id_pessoa = reu.id_pessoa
*/
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