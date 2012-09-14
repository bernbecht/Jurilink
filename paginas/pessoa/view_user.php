<?php
require_once '../template/header_user.php'; //chama o header
require_once '../config.php';     //chama as configurações de página!


$id_pessoa = $_SESSION['id_usuario'];

//Coleta dados de pessoa do banco para mostrar na tela
$query = "SELECT * FROM pessoa WHERE id_pessoa = $id_pessoa";
$pesq_pessoa = pg_query($conexao1, $query);
$pessoa = pg_fetch_object($pesq_pessoa);

$query = "SELECT * FROM usuario WHERE id_pessoa = $id_pessoa";
$pesq_user = pg_query($conexao1, $query);
$user = pg_fetch_object($pesq_user);

//Estado
$query = "SELECT uf.nome as nome_estado FROM uf,pessoa WHERE id_pessoa = $id_pessoa and pessoa.id_uf = uf.id_uf";
$pesq_uf = pg_query($conexao1, $query);
$estado = pg_fetch_object($pesq_uf);


if ($_SESSION['tipo_usuario'] == 0) {
    $query = "SELECT * FROM fisica WHERE fisica.id_pessoa = $id_pessoa";
    $pesq_fisica = pg_query($conexao1, $query);
    $fisica = pg_fetch_object($pesq_fisica);
} else if ($_SESSION['tipo_usuario'] == 1) {
    $query = "SELECT * FROM juridica WHERE juridica.id_pessoa = $id_pessoa";
    $pesq_juridica = pg_query($conexao1, $query);
    $juridica = pg_fetch_object($pesq_juridica);
}

/* Seleciona processos do usuário */
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

$pesq_proc_advocacia = pg_query($conexao1, $query);
$processos_advocacia = pg_fetch_object($pesq_proc_advocacia);
?>


<div class="container content">      
    <div class="row">        
        <div class="esquerda">
            <div class="header-pagina">            
                <h1><?php echo $pessoa->nome ?></h1>               
            </div>
        </div>
    </div>

    <div class="divisor_horizontal_view"></div>


    <div class="row show-grid">
        <div class="span2 offset1">
            <div class="view_pessoa">
                <div class="view_pessoa_legenda">
                    <p><strong>Nome</strong></p>
                    <p><strong>CPF/CNPJ</strong></p>
                    <p><strong>RG</strong></p>
                    <p><strong>E-mail</strong></p>
                    <p><strong>User</strong></p>
                </div>
            </div>

        </div>

        <div class="span3">
            <div class="view_pessoa">
                <div class="view_pessoa_dados">
                    <p><?php echo $pessoa->nome ?></p>
                    <p><?php echo $fisica->cpf ?></p>
                    <p><?php echo $fisica->rg ?></p>
                    <?php
                    if ($pessoa->email == '') {
                        echo '<p>Nao cadastrado</p>';
                    } else {
                        echo '<p>' . $pessoa->email . '</p>';
                    }
                    if ($user)
                        echo "<p>Sim</p>";
                    else
                        echo "<p>Nao</p>";
                    ?>                    
                </div>
            </div>
        </div>

        <div class="span2">
            <div class="view_pessoa">
                <div class="view_pessoa_legenda">
                    <p><strong>Telefone</strong></p>
                    <p><strong>Endereco</strong></p>
                    <p><strong>Bairro</strong></p>                    
                    <p><strong>Cidade</strong></p>
                    <p><strong>Estado</strong></p>                                       
                </div>
            </div>
        </div>

        <div class="span3">
            <div class="view_pessoa">
                <div class="view_pessoa_dados">
                    <p><?php echo $pessoa->tel ?></p>
                    <p><?php echo $pessoa->endereco ?></p>
                    <p><?php echo $pessoa->bairro ?></p>
                    <p><?php echo $pessoa->cidade ?></p>
                    <p><?php echo $estado->nome_estado ?></p>
                </div>
            </div>
        </div>

    </div>



    <div class="row row_view">
        <div class="esquerda">
            <h2>Processos com a Advocacia</h2>
        </div>
        <div class="direita">

            <button type="button" class="btn maximizar" data-toggle="collapse" data-target="#container_tabela_processo_cliente">
                <i class="icon-minus"></i>
            </button>
        </div>        
    </div>

    <div class="divisor_horizontal_view"></div>

    <div  class="row">
        <div id="container_tabela_processo_cliente" class="collapse in">
            <div id="tabela_processo_cliente" >
                <?php
                if (pg_num_rows($pesq_proc_advocacia) > 0) {
                    echo "<table = 'processos' class='table table-striped' >";
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
                    } while ($processos_advocacia = pg_fetch_object($pesq_proc_advocacia));

                    echo "</tbody>";
                    echo "</table>";
                    echo "<p class='centro'><button id='todos_processos_com' class='btn btn-primary'>Ver todos os Processos</button></p>";
                } else {
                    echo'<div class="alert"><h4>Esta pessoa nao tem processos com a advocacia no momento.</h4></div>';
                }
                ?>
            </div>
        </div>
    </div>

</div>

<input id="id" type="hidden" value="<?php echo $id_pessoa ?>"/>
<input id="tipo_pessoa" type="hidden" value="<?php echo $_SESSION['tipo_usuario'] ?>"/>

</body>
<?php
require_once '../template/scripts.php'; //chama scripts comuns as paginas
require_once 'scripts_view_pessoa.php';
?>
</html>



